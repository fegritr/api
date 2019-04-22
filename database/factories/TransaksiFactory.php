<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Transaksi;
use Faker\Generator as Faker;

$factory->define(Transaksi::class, function (Faker $faker) {
    return [
        'nama_barang' => $faker->name,
        'harga'=> $faker->numberBetween(1000, 100000),
        'tanggal_transaksi' => $faker->dateTimeThisMonth($max = 'now', $timezone = 'Asia/Jakarta'),
    ];
});
