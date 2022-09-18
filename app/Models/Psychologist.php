<?php

namespace App\Models;

use App\Models\Psychotest;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Psychologist extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function psychotest(){
        return $this->hasMany(Psychotest::class);
    }

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%');
            });
        });

        $query->when($fillters['status'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('status', $search);
            });
        });
    }
}
