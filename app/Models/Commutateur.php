<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Port;
use App\Models\Batiment;

class Commutateur extends Model
{
    use HasFactory;
        protected $fillable = [
        'num',
        'nbport',
        'nbportdispo',
    ];
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }
    public function ports()
    {
        return $this->hasMany(Port::class);
    }
}
