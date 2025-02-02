<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;
use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Http\Requests\WeightTargetRequest;

class WeightLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 体重記録の一覧表示
    public function index()
    {
        // ユーザーが認証されているかチェック
        $user = auth()->user();

        if ($user) {
            // 目標体重を取得（データがない場合は "未設定"）
            $targetWeight = optional($user->latestWeightTarget)->target_weight ?? '未設定';

            // 初期体重を取得（データがない場合は 0）
            $initialWeight = optional($user->weightLogs()->orderBy('date', 'asc')->first())->weight ?? 0;

            // 残りの目標体重を計算（null によるエラーを防ぐ）
            $remainingWeight = floatval($targetWeight) - floatval($initialWeight);
        } else {
            // ユーザーが認証されていない場合のデフォルト値
            $targetWeight = '未設定';
            $initialWeight = 0;
            $remainingWeight = 0;
        }

        // 体重ログを取得
        $weightLogs = WeightLog::where('user_id', auth()->id())->get();

        return view('weight_logs.index', compact('weightLogs', 'targetWeight', 'initialWeight', 'remainingWeight'));

    }


    // 体重記録登録画面
    public function create()
    {
        return view('weight_logs.create');
    }

    // 体重記録の保存
    public function store(WeightLogRequest $request)
    {
        // バリデーション済みのデータを取得
        $validated = $request->validated();

        $exerciseTime = $validated['exercise_time'];
        if (strlen($exerciseTime) === 5) {  // 例: 08:03
            $exerciseTime .= ':00';  // 秒を補完
        }

        // 新しい体重記録を作成
        $weightLog = new WeightLog();
        $weightLog->user_id = auth()->id();
        $weightLog->date = $validated['date'];
        $weightLog->weight = $validated['weight'];
        $weightLog->calories = $validated['calories'];
        $weightLog->exercise_time = $validated['exercise_time'];
        $weightLog->exercise_content = $validated['exercise_content'];
        $weightLog->save();

        // 成功メッセージと共にリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '体重記録が保存されました。');
    }

    // 体重記録編集画面
    public function edit($id)
    {
        $weightLog = WeightLog::findOrFail($id);
        return view('weight_logs.edit', compact('weightLog'));
    }

    // 体重記録の更新
    public function update(WeightLogRequest $request, $id)
    {
        $validated = $request->validated();
        $weightLog = WeightLog::findOrFail($id);
        $weightLog->update($validated);

        $exerciseTime = $validated['exercise_time'];
        if (empty($exerciseTime) && $weightLog->exercise_time) {
            $validated['exercise_time'] = $weightLog->exercise_time;  // 以前の値を使用
        } elseif (!empty($exerciseTime) && strlen($exerciseTime) === 5) {
            $validated['exercise_time'] .= ':00';  // 秒を補完
        }

        return redirect()->route('weight_logs.index')->with('success', '体重記録が更新されました。');
    }

    // 体重記録の削除
    public function destroy($id)
    {
        $weightLog = WeightLog::findOrFail($id);
        $weightLog->delete();

        return redirect()->route('weight_logs.index')->with('success', '体重記録が削除されました。');
    }

    public function goalSettingForm()
    {
        return view('weight_logs.goal_setting');
    }

    public function goalSetting(WeightTargetRequest $request)
    {
        $targetWeight = new WeightTarget();
        $targetWeight->user_id = auth()->id();
        $targetWeight->target_weight = $request->target_weight;
        $targetWeight->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重が設定されました');
    }

    public function search(Request $request)
    {
        // バリデーション
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => '開始日を選択してください。',
            'end_date.required'   => '終了日を選択してください。',
            'end_date.after_or_equal' => '終了日は開始日より後の日付を選択してください。',
        ]);

        // 検索処理
        $query = WeightLog::where('user_id', auth()->id());

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $weightLogs = $query->get();
        $count = $weightLogs->count();

        // **目標体重・初期体重・達成までの体重を取得**
        // 目標体重を取得（データがない場合は "未設定"）
        $targetWeight = auth()->user()->latestWeightTarget ? auth()->user()->latestWeightTarget->target_weight : '未設定';

        // 初期体重を取得（データがない場合は 0）
        $initialWeight = auth()->user()->weightLogs()->orderBy('date', 'asc')->first() ? auth()->user()->weightLogs()->orderBy('date', 'asc')->first()->weight : 0;

        $remainingWeight = $targetWeight - $initialWeight;

        return view('weight_logs.index', compact('weightLogs', 'count', 'request', 'targetWeight', 'initialWeight', 'remainingWeight'));
    }

}
