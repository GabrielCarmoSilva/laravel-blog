<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $categories_ids = Category::all()->pluck('id')->toArray();
    $random_category = array_rand($categories_ids);
    $users_ids = User::all()->pluck('id')->toArray();
    $random_user = array_rand($users_ids);
    return [
        'title' => $faker->sentence(),
        'subtitle' => $faker->sentence(),
        'abstract' => $faker->sentence(),
        'text' => $faker->text(),
        'image' => 'img/imagem.jpg',
        'category_id' => $categories_ids[$random_category],
        'creation_date' => $faker->date(),
        'user_id' => $users_ids[$random_user],
    ];
});
