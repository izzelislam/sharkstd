<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            "name"          => "Admin Account", 
            "email"         => "admin@mail.com", 
            "password"      => "secret1234",
            "email_verified_at" => Carbon::now(), 
            "role"          => "administrator",
            "status"        => 1
        ]);
    }
}
