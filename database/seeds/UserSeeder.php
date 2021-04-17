<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 6)->create();
        User::updateOrCreate([
            'email' => 'admin@admin.com.br',
            'password' => bcrypt('123456'),
            'user_level' => "0",
            'status' => true,
        ],[
            'name' => 'admin',
            'email' => 'admin@admin.com.br',
            'password' => bcrypt('123456'),
            'user_level' => "1",
            'image' => 'img/imagem.jpg',
            'status' => true,
        ]);
    }
}
