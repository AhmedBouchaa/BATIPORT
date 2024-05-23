<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bureau;
use App\Models\ListIp;
use App\Models\Commutateur;
class Port extends Model
{
    use HasFactory;
    protected $fillable = [
        'num',
        'active',
    ];
    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }
    public function listip()
    {
        return $this->belongsTo(ListIp::class);
    }
    public function commutateur()
    {
        return $this->belongsTo(Commutateur::class);
    }
}
