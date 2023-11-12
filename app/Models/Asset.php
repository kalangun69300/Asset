<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_code',
        'asset_name',
        'asset_amount',
        'asset_brand',
        'asset_type',
        'asset_price',
        'asset_recieve',
        'asset_giver',
        'recieve_date',
        'cancel_date',
        'asset_status',
        'asset_image',
        'asset_pass',
        'asset_problem'
    ];
    public function borrowRequest()
    {
        return $this->hasOne(BorrowRequest::class, 'asset', 'id');
    }

    public function assets()
    {
        return $this->hasOne(Asset::class,'asset_id','id');
    
    }
}
