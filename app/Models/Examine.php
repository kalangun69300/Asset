<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examine extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'asset_pass',
        'asset_problem',
    ];

    public function assets()
    {
        return $this->hasOne(Asset::class,'asset_id','id');
    
    }
}
