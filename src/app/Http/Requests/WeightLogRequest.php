<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
public function authorize()
{
return true; // 認証が必要な場合、必要に応じて変更
}

public function rules()
{
return [
'date' => 'required|date',
'weight' => 'required|numeric|max:9999|min:0|regex:/^\d{1,4}(\.\d{1})?$/', // 数字4桁以内、小数点1桁
'calories' => 'required|numeric',
'exercise_time' => 'required|date_format:H:i', // 時間形式 H:i
'exercise_content' => 'required|string|max:120', // 最大120文字
];
}

public function messages()
{
return [
'date.required' => '日付を入力してください',
'weight.required' => '体重を入力してください',
'weight.numeric' => '数字で入力してください',
'weight.max' => '4桁までの数字で入力してください',
'weight.regex' => '小数点は1桁で入力してください',
'calories.required' => '摂取カロリーを入力してください',
'calories.numeric' => '数字で入力してください',
'exercise_time.required' => '運動時間を入力してください',
'exercise_time.date_format' => '運動時間はH:iの形式で入力してください',
'exercise_content.required' => '運動内容を入力してください',
'exercise_content.max' => '120文字以内で入力してください',
];
}
}