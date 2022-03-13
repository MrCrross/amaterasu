<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Post;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'name' => 'Врач-косметолог',
            ]
        ];
        $users = [
            [
                'name' => 'alekseevaOlga',
                'avatar' => 'storage/users/1.jpg',
                'password' => Hash::make('qweqwe123')
            ],
            [
                'name' => 'client',
                'avatar' => 'storage/user.png',
                'password' => Hash::make('qweqwe123')
            ],
        ];

        $roles = [
            [
                'name' => 'Работник'
            ],
            [
                'name' => 'Клиент'
            ]
        ];

        $clients = [
            [
                'last_name' => 'Иванова',
                'first_name' => 'Юлия',
                'phone' => '+7(964)6592999',
                'birthday' => '2000-05-03',
                'user_id' => 3
            ],
        ];

        $workers = [
            [
                'last_name' => 'Алексеева',
                'first_name' => 'Ольга',
                'img' => 'storage/images/workers/1.jpg',
                'birthday' => '1998-02-20',
                'user_id' => 2,
                'post_id' => 1
            ]
        ];

        foreach ($posts as $post) {
            Post::create([
                'name' => $post['name']
            ]);
        }

        foreach ($users as $key => $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'avatar' => $user['avatar'],
                'password' => $user['password'],
            ]);
            $role = Role::create([
                'name' => $roles[$key]['name']
            ]);
            if ($role->name === 'Клиент') $role->syncPermissions(['client-order-list']);
            if ($role->name === "Работник") $role->syncPermissions(['worker-order-list']);
            $newUser->assignRole([$role->id]);
        }
        foreach ($clients as $client) {
            Client::create([
                'last_name' => $client['last_name'],
                'first_name' => $client['first_name'],
                'phone' => $client['phone'],
                'birthday' => $client['birthday'],
                'user_id' => $client['user_id'],
            ]);
        }
        foreach ($workers as $worker) {
            Worker::create([
                'last_name' => $worker['last_name'],
                'img' => $worker['img'],
                'first_name' => $worker['first_name'],
                'birthday' => $worker['birthday'],
                'user_id' => $worker['user_id'],
                'post_id' => $worker['post_id'],
            ]);
        }
    }

}
