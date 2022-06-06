<?php

namespace Database\Seeders;

use App\Models\CommonConnection;
use App\Models\User;
use App\Models\UserConnection;
use Database\Factories\CommonConnectionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(50)
            ->hasUserRequests(15)
            ->has(
                UserConnection::factory()
                    ->count(20)
                    ->state(function (array $attributes, User $user){
                        $id = '';
                        $done = false;
                        //privent duplicate connection by geting random unique id from user range
                        while(!$done){
                            $numbers = range(1, 10);
                            shuffle($numbers);
                            $done = true;
                            if($user->id != 1){
                                foreach($numbers as $key => $val){
                                    $id = $val;
                                    if($key == $val){
                                        $done = false;
                                        break;
                                    }
                                }
                            }
                        }
                        // privent creation of 0 id from the first user
                        if($user->id != 1)
                            return ['connected_user_id' => $id];
                        else
                            return [];

                    })
            )
            ->create();
    }
}
