<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['member'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('member', $search);
            });
        });

        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%');
            });
        });
    }
}
