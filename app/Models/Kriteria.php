<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bobot()
    {
        return $this->hasOne(Bobot::class, 'kriteria_id');
    }

    public function maximum()
    {
        return $this->bobot->result()
            ->orderBy('value', 'desc')
            ->first();
    }
}