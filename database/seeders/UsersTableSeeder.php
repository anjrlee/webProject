<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Insert admin user
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'gender' => '不願意透露',
                'department' => 'IT',
                'bio' => 'Administrator',
            ],
            [
                'name' => 'Flyer',
                'email' => 'user1@gmail.com',
                'gender' => '男',
                'department' => '資管四',
                'bio' => 'I\'m flying~',
            ],
            [
                'name' => '大阪燒好吃',
                'email' => 'user2@gmail.com',
                'gender' => '男',
                'department' => '大氣四',
                'bio' => '大阪燒真的很好吃',
            ],
            [
                'name' => 'candy',
                'email' => 'user3@gmail.com',
                'gender' => '女',
                'department' => '工院學士班一',
                'bio' => '我想轉學',
            ],
            [
                'name' => 'zzaaqq',
                'email' => 'user4@gmail.com',
                'gender' => '女',
                'department' => '數學三',
                'bio' => '高微真的好難...',
            ],
            [
                'name' => 'Steve',
                'email' => 'user5@gmail.com',
                'gender' => '男',
                'department' => '經濟一',
                'bio' => '老王可以不要當我嗎拜託QQ',
            ],
            [
                'name' => '番茄差不多是個馬鈴薯',
                'email' => 'user6@gmail.com',
                'gender' => '男',
                'department' => '電機三',
                'bio' => 'mato tomato',
            ],
            [
                'name' => '八卦人',
                'email' => 'user7@gmail.com',
                'gender' => '男',
                'department' => '客社四',
                'bio' => '只聽不說',
            ],
            [
                'name' => 'CEC1',
                'email' => 'user8@gmail.com',
                'gender' => '女',
                'department' => '生科一',
                'bio' => '菜鳥一隻><',
            ],
            [
                'name' => '不是我想是這樣啦',
                'email' => 'user9@gmail.com',
                'gender' => '男',
                'department' => '統計所碩一',
                'bio' => '想留學',
            ],
            [
                'name' => 'J',
                'email' => 'user10@gmail.com',
                'gender' => '男',
                'department' => '資管二',
                'bio' => '好想睡覺',
            ],
            [
                'name' => 'pauline',
                'email' => 'user11@gmail.com',
                'gender' => '女',
                'department' => '法文二',
                'bio' => 'yee',
            ],
        ]);

        // Insert password for admin user
        $userId = DB::table('users')->where('email', 'admin@example.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('adminpassword'),
        ]);
        
        $userId = DB::table('users')->where('email', 'user1@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password01'),
        ]);

        $userId = DB::table('users')->where('email', 'user2@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password02'),
        ]);

        $userId = DB::table('users')->where('email', 'user3@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password03'),
        ]);

        $userId = DB::table('users')->where('email', 'user4@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password04'),
        ]);

        $userId = DB::table('users')->where('email', 'user5@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password05'),
        ]);

        $userId = DB::table('users')->where('email', 'user6@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password06'),
        ]);

        $userId = DB::table('users')->where('email', 'user7@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password07'),
        ]);

        $userId = DB::table('users')->where('email', 'user8@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password08'),
        ]);

        $userId = DB::table('users')->where('email', 'user9@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password09'),
        ]);

        $userId = DB::table('users')->where('email', 'user10@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password10'),
        ]);

        $userId = DB::table('users')->where('email', 'user11@gmail.com')->first()->id;
        DB::table('psw')->insert([
            'user_id' => $userId,
            'password' => Hash::make('password011'),
        ]);
    }
}
