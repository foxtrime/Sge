<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $fillable =[
        'tipo',
        'material_id',
        'funcionario_id',
        'quantidade',
    ];

    public function material()
    {
        return $this->belongsTo('App\Material');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }

}
