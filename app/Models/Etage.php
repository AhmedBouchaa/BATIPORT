<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Batiment;
use App\Models\Bureau;
class Etage extends Model
{
    use HasFactory;
    protected $fillable = [
        'num',
        'nbbureau',
    ];
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }
    public function bureaux()
    {
        return $this->hasMany(Bureau::class);
    }
    
}
