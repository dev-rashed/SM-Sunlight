<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    $user = User::where('email', 'admin@gmail.com')->first();
    if (!$user) {
      User::create([
        'name' => "Admin",
        'user_name' => "Admin",
        'email' => 'admin@gmail.com',
        'role' => 'admin',
        'phone' => '01890010841',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
      ]);
    }
    Store::create([
      'name' => 'মায়ের দোয়া ব্যাটারি এন্ড আই পি এস',
      'address' => 'আশিক প্লাজা টিনপট্টি রোড  গোস্তহাটির মোড় নওগাঁ।',
      'phone' => '01957667711',
    ]);
    Store::create([
      'name' => 'সানলাইট ব্যাটারি হাউজ',
      'address' => 'বাইপাস চারমাতা, বরুণকান্দি মোড় বদলগাছি রোড নওগাঁ।',
      'phone' => '01300945925',
    ]);
    Store::create([
      'name' => 'সানলাইট ব্যাটারি এন্ড আইপিএস',
      'address' => 'চকগৌরী রোড দেলুয়াবাড়ি বাজার মান্দা  নওগাঁ।',
      'phone' => '01300945925',
    ]);
  }
}
