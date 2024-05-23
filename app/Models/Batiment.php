<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ListIp;
use App\Models\Etage;
use App\Models\Commutateur;
class Batiment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nbetage',
        'nbswitch',
        'descr',
        'image',
        'type_reseaux',
        'adresse_reseau',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commutateurs()
    {
        return $this->hasMany(Commutateur::class);
    }
    public function etages()
    {
        return $this->hasMany(Etage::class);
    }
    public function list_ips()
    {
        return $this->hasMany(ListIp::class);
    }
}
