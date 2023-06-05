<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    use HasFactory;

    protected $table = "reuniao";

    protected $fillable = [
        'nome', 'email', 'data', 'horario'
    ];

    public static function rules()
    {
        return  [
            'nome' => 'required|max:120',
            'email' => 'nullable|email|max:100',
            'data' => 'required|date',
            'horario' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.max' => 'Só é permitido 120 caracteres',
            'email.max' => 'Só é permitido 100 caracteres',
            'data.required' => 'A data é obrigatória',
            'data.date' => 'Formato de data inválido',
            'horario.required' => 'O horário é obrigatório',
        ];
    }
}
