<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use App\Models\User;

class BorrowRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'create_by',
        'borrow_date',
        'return_date',
        'asset',
        'quantity',
        'description',
        'status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','create_by');
    }

    public function assets()
{
    //return $this->belongsTo(Asset::class,'asset','id');
    return $this->hasOne(Asset::class,'id','asset');
}
    
}
