<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Etage;
use App\Models\Port;
class Bureau extends Model
{
    use HasFactory;
    protected $table = 'bureaux';
    protected $fillable = [
        'titre',
        'num',
        'nbport',
    ];
    public function etage()
    {
        return $this->belongsTo(Etage::class);
    }
    public function ports()
    {
        return $this->hasMany(Port::class);
    }
}
