<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Tests\Feature\UserSignInTest;

$factory->define(Post::class, function (Faker $faker) {
    $user = UserSignInTest::userForTest();

    return [
        'user_id' => $user->id,
        'text' => $faker->realText(140)
    ];
});
