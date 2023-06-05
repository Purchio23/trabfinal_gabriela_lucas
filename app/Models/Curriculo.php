<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    use HasFactory;
    
    protected $table = "curriculo";

    protected $fillable = [
        'nome', 'idade', 'genero', 'email', 'arquivo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public static function rules()
    {
        return  [
            'nome' => 'required|max:120',
            'idade' => 'required|max:3',
            'genero' => 'nullable|max:120',
            'email' => 'required|email|max:100',
            'arquivo' => 'required|mimes:pdf|max:2048',
        ];
    }    

    public static function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 120 caracteres',
            'idade.required' => 'A idade é obrigatória',
            'email.max' => 'Só é permitido 100 caracteres',
            'arquivo.required' => 'O currículo é obrigatório',
        ];
    }
}
