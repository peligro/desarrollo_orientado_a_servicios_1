<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as User;
class Usuarios extends Model
{
    protected $guarded =[];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
