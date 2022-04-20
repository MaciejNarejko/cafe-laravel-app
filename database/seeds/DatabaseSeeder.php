<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([[
            'id' => '1',
            'name' => 'pracownik',
        ],
            [
                'id' => '2',
                'name' => 'manager',
            ],
        ]);

        DB::table('users')->insert([[
            'name' => 'manager',
            'email' => 'manager@kawiarnia.com',
            'id_group' => '2',
            'password' => Hash::make('password'),
        ],
            [
                'name' => 'pracownik',
                'email' => 'pracownik@kawiarnia.com',
                'id_group' => '1',
                'password' => Hash::make('password'),
            ],
        ]);


        DB::table('categories')->insert([[
            'name' => 'kawa',
        ],
            [
                'name' => 'herbata',
            ],
            [
                'name' => 'ciasto',
            ],
            [
                'name' => 'zimne napoje',
            ]

        ]);
        DB::table('sizes')->insert([[
            'name' => 'mała',
            'volume' => '200 ml',
        ],
            [
                'name' => 'średnia',
                'volume' => '350 ml',
            ],
            [
                'name' => 'duża',
                'volume' => '500 ml',
            ],
            [
                'name' => 'porcja',
                'volume' => '100 gr',
            ],
        ]);
        DB::table('types')->insert([[
            'name' => 'latte',
            'id_category' => '1',
            'details' => 'podgrzane mleka z kawą espresso z pianą',
        ],
            [
                'name' => 'espresso',
                'id_category' => '1',
                'details' => 'parzona z kilku gatunków kaw w ekspresie pod ciśnieniem',
            ],
            [
                'name' => 'czarna',
                'id_category' => '2',
                'details' => 'zaparzana z liści herbaty Cejlon',
            ],
            [
                'name' => 'zielona',
                'id_category' => '2',
                'details' => 'zaparzana z liści herbaty chińskiej',
            ],
            [
                'name' => 'szarlotka',
                'id_category' => '3',
                'details' => 'Kruche ciasto z jabłkami w środku',
            ],
            [
                'name' => 'sernik',
                'id_category' => '3',
                'details' => 'o delikatnym smaku z lekkiego twarogu',
            ],
            [
                'name' => 'woda mineralna gazowana',
                'id_category' => '4',
                'details' => 'woda mineralna gazowana',
            ],
            [
                'name' => 'sok pomarańczowy',
                'id_category' => '4',
                'details' => 'świeżo wyciskany sok z pomarańczyk',
            ],
        ]);
        DB::table('tables')->insert([[
            'name' => 'okno1',
            'capacity' => '4',
            'availability' => '1',
        ],
            [
                'name' => 'okno2',
                'capacity' => '6',
                'availability' => '1',
            ],
            [
                'name' => 'środek1',
                'capacity' => '2',
                'availability' => '1',
            ],
            [
                'name' => 'środek2',
                'capacity' => '8',
                'availability' => '1',
            ]
        ]);
        DB::table('menus')->insert([[
            'id_type' => '1',
            'id_size' => '1',
            'price' => '8.00',
        ],
            [
                'id_type' => '1',
                'id_size' => '2',
                'price' => '9.50',
            ],
            [
                'id_type' => '1',
                'id_size' => '3',
                'price' => '10.00',
            ],
            [
                'id_type' => '3',
                'id_size' => '1',
                'price' => '5.00',
            ],
            [
                'id_type' => '3',
                'id_size' => '2',
                'price' => '6.00',
            ],
            [
                'id_type' => '3',
                'id_size' => '3',
                'price' => '7.00',
            ],
            [
                'id_type' => '5',
                'id_size' => '4',
                'price' => '11.00',
            ],
        ]);
        DB::table('payments')->insert([[
            'id' => '1',
            'method' => 'gotówka',
        ],
            [
                'id' => '2',
                'method' => 'karta',
            ],
        ]);
        DB::table('order_statuses')->insert([[
            'id' => '1',
            'name' => 'niezapłacone',
        ],
            [
                'id' => '2',
                'name' => 'zapłacone',
            ],
        ]);
    }
}
