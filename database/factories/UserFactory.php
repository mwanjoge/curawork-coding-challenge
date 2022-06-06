<?php

namespace Database\Factories;

use App\Models\CommonConnection;
use App\Models\User;
use App\Models\UserConnection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            //remove duplicate connection for the first user
            if($user->id == 1){
                foreach($user->userConnections as $connect){
                    if($connect->id != 1){
                        $connect->delete();}
                }
            }

            //get all users except the current current created user
            $users = User::all()->except($user->id)->lazy();

            //get current user connections
            $userConnections = $user->userConnections;

            foreach($users as $connectedUser){
                //get connection of each other user
                $connectUserConnections = $connectedUser->userConnections;

                //get common connection from other user with the current user
                $commonConnections = User::whereIn('id',$userConnections->pluck('connected_user_id'))
                ->pluck('id')
                ->intersect($connectUserConnections->pluck('connected_user_id'));

                //create common connection when available
                if($commonConnections->count() > 0){
                    foreach($commonConnections as $common){
                        $commonConnect = new CommonConnection(['user_id' => $user->id, 'common_user_id' => $common]);
                        $commonConnect->save();
                    }
                }
            }

            // update common connectio statistica and status
            $user->has_common = $user->commonConnections->count() > 0 ? true : false;
            $user->common_count = $user->commonConnections->count();
            $user->save();

        });
    }
}
