<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo các role cơ bản
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'description' => 'Quản trị viên hệ thống'
            ],
            [
                'name' => 'author',
                'guard_name' => 'web',
                'description' => 'Tác giả truyện'
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
                'description' => 'Người dùng thông thường'
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
} 