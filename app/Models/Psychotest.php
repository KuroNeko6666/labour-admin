<?php

namespace App\Models;

use App\Models\Psychologist;
use App\Models\PsychotestParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Psychotest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function participant(){
        return $this->hasMany(PsychotestParticipant::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class);
    }

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['status'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('status', $search);
            });
        });
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('location', 'like', '%'. $search. '%')
                ->orWhere('date', 'like', '%'. $search. '%')
                ->orWhere('time', 'like', '%'. $search. '%')
                ->orWhere('quota', 'like', '%'. $search. '%');
            });
        });
    }

}
