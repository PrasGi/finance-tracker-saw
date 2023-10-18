<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function bobot()
    {
        return $this->belongsTo(Bobot::class, 'bobot_id');
    }


    public function kriteria()
    {
        return $this->hasOneThrough(Kriteria::class, Bobot::class, 'id', 'id', 'bobot_id', 'kriteria_id');
    }
}