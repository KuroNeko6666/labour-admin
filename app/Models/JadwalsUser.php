<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalsUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function psychotest(){
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');
            });
        });
        $query->when($fillters['psychotest'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('jadwal_id', $search);
            });
        });
    }
}
