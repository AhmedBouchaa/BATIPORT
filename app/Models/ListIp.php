<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Port;

class ListIp extends Model
{
    use HasFactory;
    protected $fillable = [
        'adresseIP',
        'batiment_id',
        'bureau_id',
        'port_id',
        'type_reseaux',

    ];
    public function port()
    {
        return $this->belongsTo(Port::class);
    }
}
