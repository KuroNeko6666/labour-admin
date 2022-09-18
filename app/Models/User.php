<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\PsychotestParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

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

    public function participant(){
        return $this->hasMany(PsychotestParticipant::class);
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
