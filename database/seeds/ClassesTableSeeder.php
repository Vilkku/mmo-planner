<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'tank' => [
                'name' => 'Tank',
                'id' => null
            ],
            'healer' => [
                'name' => 'Healer',
                'id' => null
            ],
            'melee'  => [
                'name' => 'Melee',
                'id' => null
            ],
            'ranged' => [
                'name' => 'Ranged',
                'id' => null
            ]
        ];

        $charclasses = [
            [
                'name' => 'Warrior',
                'color' => '#C79C6E',
                'roles' => ['tank', 'melee']
            ],
            [
                'name' => 'Paladin',
                'color' => '#F58CBA',
                'roles' => ['tank', 'healer', 'melee']
            ],
            [
                'name' => 'Hunter',
                'color' => '#ABD473',
                'roles' => ['ranged']
            ],
            [
                'name' => 'Rogue',
                'color' => '#FFF569',
                'roles' => ['melee']
            ],
            [
                'name' => 'Priest',
                'color' => '#FFFFFF',
                'roles' => ['healer', 'ranged']
            ],
            [
                'name' => 'Death Knight',
                'color' => '#C41F3B',
                'roles' => ['tank', 'melee']
            ],
            [
                'name' => 'Shaman',
                'color' => '#0070DE',
                'roles' => ['healer', 'melee', 'ranged']
            ],
            [
                'name' => 'Mage',
                'color' => '#69CCF0',
                'roles' => ['ranged']
            ],
            [
                'name' => 'Warlock',
                'color' => '#9482C9',
                'roles' => ['ranged']
            ],
            [
                'name' => 'Monk',
                'color' => '#00FF96',
                'roles' => ['tank', 'healer', 'melee']
            ],
            [
                'name' => 'Druid',
                'color' => '#FF7D0A',
                'roles' => ['tank', 'healer', 'melee', 'ranged']
            ],
            [
                'name' => 'Demon Hunter',
                'color' => '#A330C9',
                'roles' => ['tank', 'melee']
            ]
        ];

        foreach ($roles as $slug => $role) {
            $roles[$slug]['id'] = DB::table('roles')->insertGetId([
                'name' => $role['name']
            ]);
        }

        foreach ($charclasses as $charclass) {
            $id = DB::table('charclasses')->insertGetId([
                'name' => $charclass['name'],
                'color' => $charclass['color']
            ]);

            foreach ($charclass['roles'] as $role) {
                DB::table('charclass_role')->insert([
                    'charclass_id' => $id,
                    'role_id' => $roles[$role]['id']
                ]);
            }
        }
    }
}
