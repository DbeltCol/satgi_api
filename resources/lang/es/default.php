<?php

return [
    // message of requests
    'name' => [
        'required' => 'El nombre es obligatorio',
        'max' => 'El nombre no puede tener más de 255 caracteres',
        'string' => 'El nombre debe ser una cadena de texto',
        'unique' => 'El nombre ya está registrado',
    ],
    'email' => [
        'required' => 'El correo es obligatorio',
        'email'    => 'Debes ingresar un correo válido',
        'unique'   => 'Este correo ya está registrado',
    ],
    'description' => [
        'required' => 'La descripción es obligatoria',
        'max' => 'La descripción no puede tener más de 255 caracteres',
        'string' => 'La descripción debe ser una cadena de texto',
    ],
    'symbol' => [
        'required' => 'El símbolo es obligatorio',
        'max' => 'El símbolo no puede tener más de 255 caracteres',
        'string' => 'El símbolo debe ser una cadena de texto',
        'unique' => 'El símbolo ya está registrado',
    ],
    'role_id' => [
        'required' => 'El rol es obligatorio',
        'exists' => 'El rol no existe',
    ],

    'sucursal_id' => [
        'required' => 'La sucursal es obligatoria',
        'exists' => 'La sucursal no existe',
    ],
    'type_measurement_id' => [
        'required' => 'El tipo de medida es obligatorio',
        'exists' => 'El tipo de medida no existe',
    ],
    'type_sensor_id' => [
        'required' => 'El tipo de sensor es obligatorio',
        'exists' => 'El tipo de sensor no existe',
    ],
    'code' => [
        'required' => 'El código es obligatorio',
        'string' => 'El código debe ser una cadena de texto',
        'max' => 'El código no puede tener más de 255 caracteres',
    ],
    'measurement' => [
        'required' => 'La medida es obligatoria',
        'numeric' => 'La medida debe ser un número',
    ],

    // message of models
    'user' => [
        'deleted' => 'Usuario eliminado correctamente',
        'get_all_users' => 'Obtener todos los usuarios',
        'get_user_by_id' => 'Obtener usuario por id',
        'create_user' => 'Crear usuario',
        'edit_user' => 'Editar usuario',
        'delete_user' => 'Eliminar usuario',
    ],
    'role' => [
        'admin' => 'Administrador',
        'get_all_roles' => 'Obtener todos los roles',
        'get_role_by_id' => 'Obtener rol por id',
        'create_role' => 'Crear rol',
        'edit_role' => 'Editar rol',
        'delete_role' => 'Eliminar rol',
    ],
    'type_measurement' => [
        'get_all_type_measurements' => 'Obtener todos los tipos de medidas',
        'get_type_measurement_by_id' => 'Obtener tipo de medida por id',
        'create_type_measurement' => 'Crear tipo de medida',
        'edit_type_measurement' => 'Editar tipo de medida',
        'delete_type_measurement' => 'Eliminar tipo de medida',
    ],
    'type_sensor' => [
        'get_all_type_sensors' => 'Obtener todos los tipos de sensores',
        'get_type_sensor_by_id' => 'Obtener tipo de sensor por id',
        'create_type_sensor' => 'Crear tipo de sensor',
        'edit_type_sensor' => 'Editar tipo de sensor',
        'delete_type_sensor' => 'Eliminar tipo de sensor',
    ],

    'sensor' => [
        'get_all_sensors' => 'Obtener todos los sensores',
        'get_sensor_by_id' => 'Obtener sensor por id',
        'create_sensor' => 'Crear sensor',
        'edit_sensor' => 'Editar sensor',
        'delete_sensor' => 'Eliminar sensor',
    ],

    'unauthorized' => 'No tienes permisos para realizar esta acción',
];