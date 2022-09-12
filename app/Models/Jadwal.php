<?php

namespace App\Models;

use App\Models\JadwalsUser;
use App\Models\Psychologist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function participant(){
        return $this->hasMany(JadwalsUser::class);
    }

    public function psychologist(){
        return $this->belongsTo(Psychologist::class, 'psikolog_id');
    }

    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('psikolog_id', 'like', '%'. $search. '%')
                ->orWhere('jenis_test', 'like', '%'. $search. '%')
                ->orWhere('waktu', 'like', '%'. $search. '%')
                ->orWhere('kuota', 'like', '%'. $search. '%');
            });
        });
    }


}
