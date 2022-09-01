<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacancy extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('lowongan', 'like', '%'. $search. '%')
                ->orWhere('skill', 'like', '%'. $search. '%')
                ->orWhere('gaji', 'like', '%'. $search. '%')
                ->orWhere('jobdesk', 'like', '%'. $search. '%');
            });
        });
    }
}
