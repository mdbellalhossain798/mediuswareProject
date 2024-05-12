<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\App;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'user_id','transactions_type','amount','fee','created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id'); // Use "belongsTo" to define the inverse relationship
    }
}
