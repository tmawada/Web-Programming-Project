<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'title' => 'Cyberpunk 2077',
                'description' => 'An open-world, action-adventure RPG set in the megalopolis of Night City, where you play as a cyberpunk mercenary wrapped up in a do-or-die fight for survival.',
                'price' => 59.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2mjs.jpg',
                'platform' => 'PC, PS5, Xbox',
                'genre' => 'RPG',
                'publisher' => 'CD Projekt Red',
                'release_date' => '2020-12-10',
            ],
            [
                'title' => 'Deus Ex: Mankind Divided',
                'description' => 'Now an experienced covert operative, Adam Jensen is forced to operate in a world that has grown to despise his kind.',
                'price' => 29.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1r7w.jpg',
                'platform' => 'PC, PS4, Xbox',
                'genre' => 'Action RPG',
                'publisher' => 'Square Enix',
                'release_date' => '2016-08-23',
            ],
            [
                'title' => 'Ghostrunner',
                'description' => 'Ghostrunner is a hardcore FPP slasher packed with lightning-fast action, set in a grim, cyberpunk megastructure.',
                'price' => 29.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2dvo.jpg',
                'platform' => 'PC, PS5, Xbox',
                'genre' => 'Action Platformer',
                'publisher' => '505 Games',
                'release_date' => '2020-10-27',
            ],
            [
                'title' => 'Stray',
                'description' => 'Lost, alone and separated from family, a stray cat must untangle an ancient mystery to escape a long-forgotten city.',
                'price' => 29.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49wj.jpg',
                'platform' => 'PC, PS5',
                'genre' => 'Adventure',
                'publisher' => 'Annapurna Interactive',
                'release_date' => '2022-07-19',
            ],
            [
                'title' => 'The Ascent',
                'description' => 'The Ascent is a solo and co-op Action-shooter RPG set on Veles, a packed cyberpunk world.',
                'price' => 29.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2yl2.jpg',
                'platform' => 'PC, Xbox',
                'genre' => 'Action RPG',
                'publisher' => 'Curve Digital',
                'release_date' => '2021-07-29',
            ],
            [
                'title' => 'Ruiner',
                'description' => 'RUINER is a brutal action shooter set in the year 2091 in the cyber metropolis Rengkok.',
                'price' => 19.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1qbb.jpg',
                'platform' => 'PC, PS4, Xbox',
                'genre' => 'Action',
                'publisher' => 'Devolver Digital',
                'release_date' => '2017-09-26',
            ],
             [
                'title' => 'Cloudpunk',
                'description' => 'A neon-noir story in a rain-drenched cyberpunk metropolis. It’s your first night on the job as a driver for Cloudpunk.',
                'price' => 19.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co21m6.jpg',
                'platform' => 'PC, PS4, Xbox, Switch',
                'genre' => 'Adventure',
                'publisher' => 'Merge Games',
                'release_date' => '2020-04-23',
            ],
             [
                'title' => 'System Shock',
                'description' => 'A first-person fight to the death in the depths of space.',
                'price' => 39.99,
                'cover_image' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6az8.jpg',
                'platform' => 'PC, PS5, Xbox',
                'genre' => 'Action Adventure',
                'publisher' => 'Prime Matter',
                'release_date' => '2023-05-30',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
