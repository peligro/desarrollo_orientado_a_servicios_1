<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorias as Categorias;
class Productos extends Model
{
    protected $guarded =[];

    public function categoria()
    {
    	return $this->belongsTo(Categorias::class);
    }
}
