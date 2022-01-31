<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'campaign_title' => substr($faker->sentence(2), 0, -1),
        'campaign_description' => $faker->paragraph,
        'payment_iban' => substr($faker->sentence(2), 0, -1),
        'payment_name' => substr($faker->sentence(2), 0, -1),
        'payment_iban' => substr($faker->sentence(2), 0, -1),
        'payment_desc' => $faker->paragraph,
        'paypalme_url' => $faker->url,
    ];
});
