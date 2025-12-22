<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear todos los permisos primero
        $userPermissions = [
            ['name' => 'get_all_users', 'description' => __('default.user.get_all_users')],
            ['name' => 'get_user_by_id', 'description' => __('default.user.get_user_by_id')],
            ['name' => 'create_user', 'description' => __('default.user.create_user')],
            ['name' => 'edit_user', 'description' => __('default.user.edit_user')],
            ['name' => 'delete_user', 'description' => __('default.user.delete_user')],
        ];

        $rolePermissions = [
            ['name' => 'get_all_roles', 'description' => __('default.role.get_all_roles')],
            ['name' => 'get_role_by_id', 'description' => __('default.role.get_role_by_id')],
            ['name' => 'create_role', 'description' => __('default.role.create_role')],
            ['name' => 'edit_role', 'description' => __('default.role.edit_role')],
            ['name' => 'delete_role', 'description' => __('default.role.delete_role')],
        ];

        $sucursalsPermissions = [
            ['name' => 'get_all_sucursals', 'description' => __('default.sucursals.get_all_sucursals')],
            ['name' => 'get_sucursal_by_id', 'description' => __('default.sucursals.get_sucursal_by_id')],
            ['name' => 'create_sucursal', 'description' => __('default.sucursals.create_sucursal')],
            ['name' => 'edit_sucursal', 'description' => __('default.sucursals.edit_sucursal')],
            ['name' => 'delete_sucursal', 'description' => __('default.sucursals.delete_sucursal')],
        ];

        $typeMeasurementsPermissions = [
            ['name' => 'get_all_type_measurements', 'description' => __('default.type_measurements.get_all_type_measurements')],
            ['name' => 'get_type_measurement_by_id', 'description' => __('default.type_measurements.get_type_measurement_by_id')],
            ['name' => 'create_type_measurement', 'description' => __('default.type_measurements.create_type_measurement')],
            ['name' => 'edit_type_measurement', 'description' => __('default.type_measurements.edit_type_measurement')],
            ['name' => 'delete_type_measurement', 'description' => __('default.type_measurements.delete_type_measurement')],
        ];

        $typeSensorsPermissions = [
            ['name' => 'get_all_type_sensors', 'description' => __('default.type_sensors.get_all_type_sensors')],
            ['name' => 'get_type_sensor_by_id', 'description' => __('default.type_sensors.get_type_sensor_by_id')],
            ['name' => 'create_type_sensor', 'description' => __('default.type_sensors.create_type_sensor')],
            ['name' => 'edit_type_sensor', 'description' => __('default.type_sensors.edit_type_sensor')],
            ['name' => 'delete_type_sensor', 'description' => __('default.type_sensors.delete_type_sensor')],
        ];

        $sensorsPermissions = [
            ['name' => 'get_all_sensors', 'description' => __('default.sensors.get_all_sensors')],
            ['name' => 'get_sensor_by_id', 'description' => __('default.sensors.get_sensor_by_id')],
            ['name' => 'create_sensor', 'description' => __('default.sensors.create_sensor')],
            ['name' => 'edit_sensor', 'description' => __('default.sensors.edit_sensor')],
            ['name' => 'delete_sensor', 'description' => __('default.sensors.delete_sensor')],
            ['name' => 'change_state_sensor', 'description' => __('default.sensors.change_state_sensor')],
        ];

        $sensorMeasurementsPermissions = [
            ['name' => 'get_measurements_by_sensor', 'description' => __('default.sensor_measurements.get_measurements_by_sensor')],
            ['name' => 'create_measurements_by_sensor', 'description' => __('default.sensor_measurements.create_measurements_by_sensor')],
        ];

        // Crear permisos de usuarios
        foreach ($userPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Crear permisos de roles
        foreach ($rolePermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Crear permisos de sucursales
        foreach ($sucursalsPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Crear permisos de tipo de medidas
        foreach ($typeMeasurementsPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }
        
        // Crear permisos de tipo de sensores
        foreach ($typeSensorsPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Crear permisos de sensores
        foreach ($sensorsPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Crear permisos de medidas de sensores
        foreach ($sensorMeasurementsPermissions as $perm) {
            Permission::create([
                'guard_name' => 'api',
                'name' => $perm['name'],
                'description' => $perm['description']
            ]);
        }

        // Limpiar caché después de crear los permisos
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Crear el rol después de crear los permisos
        $admin = Role::create([
            'guard_name' => 'api',
            'name' => 'admin',
            'description' => __('default.role.admin')
        ]);

        // 3. Asignar los permisos al rol
        $admin->givePermissionTo(array_merge(
            array_column($userPermissions, 'name'),
            array_column($rolePermissions, 'name'),
            array_column($sucursalsPermissions, 'name'),
            array_column($typeMeasurementsPermissions, 'name'),
            array_column($typeSensorsPermissions, 'name'),
            array_column($sensorsPermissions, 'name'),
            array_column($sensorMeasurementsPermissions, 'name'),
        ));
    }
}
