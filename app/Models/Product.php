<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image'];


//CODIGO PARA O CAMPO DE PESQUISA
    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })//->toSql();
        ->paginate();
//PAGINATE PQ PODE TER VARIOS RESULTADOS
        return $results;
    }
}
