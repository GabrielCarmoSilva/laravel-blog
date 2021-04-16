<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191|string',
            'email' => 'email|required|min:6|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'confirm_password' => 'required_with:password',
            'user_level' => 'required|string|max:1',
            'image' => 'nullable|file|max:512',
        ];
    }

    public function attributes(){
        return[
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'confirm_password' => 'confirme sua senha',
            'user_level' => 'nível de usuário',
            'image' => 'foto de perfil',
        ];
    }
}
