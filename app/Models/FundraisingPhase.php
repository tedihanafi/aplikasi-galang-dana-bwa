<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingPhase extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'notes',
        'photo',
        'fundraising_id',
    ];

    public function fundraising(){
        return $this->belongsTo(Fundraising::class);
    }



}