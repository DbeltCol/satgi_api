<?php

return [
    'name' => [
        'required' => 'El nombre es obligatorio',
        'max' => 'El nombre no puede tener más de 255 caracteres',
        'string' => 'El nombre debe ser una cadena de texto',
    ],
    'email' => [
        'required' => 'El correo es obligatorio',
        'email'    => 'Debes ingresar un correo válido',
        'unique'   => 'Este correo ya está registrado',
    ],
    'user' => [
        'deleted' => 'Usuario eliminado correctamente',
    ],
];