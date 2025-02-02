<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    protected $fillable = ['user_id', 'target_weight'];

    /**
     * モデル間のリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
