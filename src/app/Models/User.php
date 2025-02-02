<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
use HasApiTokens, HasFactory, Notifiable;

/**
* 一括代入可能な属性
*
* @var array<int, string>
    */
    protected $fillable = [
    'name',
    'email',
    'password',
    'remember_token',
    ];

    /**
    * ユーザーの目標体重（複数）を取得
    */
    public function weightTargets()
    {
    return $this->hasMany(WeightTarget::class);
    }

    /**
    * ユーザーの最新の目標体重を取得
    */
    public function latestWeightTarget()
    {
    return $this->hasOne(WeightTarget::class)->latest();
    }

    /**
    * ユーザーの体重ログを取得（デフォルトで日付昇順）
    */
    public function weightLogs()
    {
    return $this->hasMany(WeightLog::class)->orderBy('date', 'asc');
    }

    /**
    * シリアライズ時に隠す属性
    *
    * @var array<int, string>
        */
        protected $hidden = [
        'password',
        'remember_token',
        ];

        /**
        * キャストすべき属性
        *
        * @var array<string, string>
            */
            protected $casts = [
            'email_verified_at' => 'datetime',
            ];
            }