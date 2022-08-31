<?php

namespace App\Models;

use App\Models\Psychotest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychotestParticipant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function psychotest(){
        return $this->belongsTo(Psychotest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');
            });
        });
    }


}
