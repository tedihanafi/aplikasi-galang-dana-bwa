<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name'  => 'owner'
        ]);

        $fundraiserRole = Role::create([
            'name'  => 'fundraiser'
        ]);

        $userOwner = User::create([
            'name'  => 'Tedi Hanafiah',
            'avatar'  => 'images/default-avatar.png',
            'email'  => 'tedihanafiah12@gmail.com',
            'password'  => bcrypt('admin123')
        ]);
        $userOwner->assignRole($ownerRole);
    }
}