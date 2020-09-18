<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Music;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Music::class, function (Faker $faker) {

	$artist = $faker->name;

    return [
        'artist' => $artist,
        'slug' => Str::slug($artist),
        'country' => $faker->country,
        'genre' => $faker->name,
        'latest_album' => $faker->name,
        'latest_hit' => $faker->name,
    ];
});
