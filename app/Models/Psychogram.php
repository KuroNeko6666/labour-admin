<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychogram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('file', 'like', '%'. $search. '%');
            });
        });
    }

}
