<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerService;
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
            ],
            [
                'name' => 'Приемная'
            ]
        ];
        $users = [
            [
                'name' => 'alekseevaOlga',
                'avatar' => 'storage/users/1.jpg',
                'password' => Hash::make('qweqwe123'),
                'role' => 4
            ],
            [
                'name' => 'client',
                'avatar' => 'storage/user.png',
                'password' => Hash::make('qweqwe123'),
                'role' => 3
            ],
            [
                'name' => 'glizkoAlena',
                'avatar' => 'storage/users/2.jpg',
                'password' => Hash::make('qweqwe123'),
                'role' => 2
            ],
        ];

        $roles = [
            [
                'name' => 'Приемная'
            ],
            [
                'name' => 'Клиент'
            ],
            [
                'name'=> 'Врач'
            ]
        ];

        $clients = [
            [
                'last_name' => 'Иванова',
                'first_name' => 'Юлия',
                'phone' => '+7(964)659-29-99',
                'email' => 'mrcrross38@vk.com',
                'birthday' => '2000-05-03',
                'user_id' => 3
            ],
        ];

        $workers = [
            [
                'last_name' => 'Алексеева',
                'first_name' => 'Ольга',
                'img' => 'storage/workers/1.jpg',
                'birthday' => '1998-02-20',
                'description' => 'Образование. 2003-2011 Иркутский Государственный Медицинский Университет лечебный факультет.
2007-2008 Медицинская сестра урологического отделения Областной Онкологический диспансер.
2009-2012 Врач консультант Фармгарант.
2010-2011 ИГМУ ординатура по дерматовенерологии.
2011-2012 Областной кожно-венерологический диспансер -врач дерматовенеролог.
2012-2015 Боханская ЦРБ врач дерматовенеролог.
2015-2016 Аптека «Фармгарант» врач-консультант.
2016 Курсы по косметологии Иркутский университет повышения квалификации врачей.
2016-2019 ООО «Лазермед» врач косметолог.
с 2019 по н.в. ООО «Бьютимед», врач косметолог.',
                'user_id' => 2,
                'post_id' => 1
            ],
            [
                'last_name' => 'Глызко',
                'first_name' => 'Алёна',
                'img' => 'storage/workers/2.jpg',
                'birthday' => '1982-04-20',
                'description' => 'Медицинский стаж - 29 лет, закончила Иркутский государственный медицинский институт в 1989 г по специализации "Лечебное дело", после института работала терапевтом в поликлинике, закончила ординатуру по дерматовенерологии в 1999 г., первичную специализацию по косметологии получила в 1999 г. в г. Москва на кафедре эстетической медицины РУДН, стаж в косметологии 19 лет. Владеет всеми инъекционными методиками, аппаратными методами, занимается коррекцией проблемной кожи. В 2017 году стала победителем регионального этапа I Всероссийского чемпионата врачей-косметологов "Сияние Байкала" в номинации PRO (Иркутск, Улан-Удэ, Чита), заняла II место на Всероссийском чемпионате.',
                'user_id' => 4,
                'post_id' => 2
            ]
        ];

        foreach ($posts as $post) {
            Post::create([
                'name' => $post['name']
            ]);
        }
        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role['name']
            ]);
            if ($role->name === 'Клиент') $role->syncPermissions(['order-client-list']);
            if ($role->name === "Врач") $role->syncPermissions(['order-worker-list']);
            if ($role->name === "Приемная") $role->syncPermissions(['record-list','record-update','order-list']);
        }

        foreach ($users as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'avatar' => $user['avatar'],
                'password' => $user['password'],
            ]);
            $newUser->assignRole([$user['role']]);
        }
        foreach ($clients as $client) {
            Client::create([
                'last_name' => $client['last_name'],
                'first_name' => $client['first_name'],
                'phone' => $client['phone'],
                'email' => $client['email'],
                'birthday' => $client['birthday'],
                'user_id' => $client['user_id'],
            ]);
        }
        foreach ($workers as $worker) {
            Worker::create([
                'last_name' => $worker['last_name'],
                'img' => $worker['img'],
                'first_name' => $worker['first_name'],
                'description' => $worker['description'],
                'birthday' => $worker['birthday'],
                'user_id' => $worker['user_id'],
                'post_id' => $worker['post_id'],
            ]);
        }
    }

}
