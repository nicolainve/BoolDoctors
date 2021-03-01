<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(Message::class, function (Faker $faker) {
        $now = Carbon::now();
        $info = App\Info::pluck('id')->toArray();
        return [
            'info_id' => $faker->randomElement($info), //FKey
            'author' => $faker->name,
            'mail' => $faker->email,
            // 'body' => $faker->randomElement(['Buon Giorno Dottore, volevo sapere se aveva disponibilità per una visita per venerdì prossimo', 'Salve Dottore, vorrei prenotare una visita per la prossima settimana, possibilmente la mattina', 'Non riesco a contattarla al telefono, avrei bisogno con urgenza di parlarle", "Qual è il primo giorno disponibile per una visita?','Sarebbe disponibile questo sabato?' 'Non riesco a contattarla al cellulare']),
            'body' => $faker->realText(200),
            'created_at' =>$faker-> dateTimeBetween('-3 years', $now)
     ];

});
