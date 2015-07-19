<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Storage\User\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( App::environment() === 'production' ) {
            die('Database seeding should not be run on a production server.');
        }

        //Truncate the user table before each seed, to be a bit more efficient. 
        User::truncate();

        //Disable mass assignment rules in the Eloquent model, need to be able to add all fields here.
        Model::unguard();

        //Calls the model factory and creates and stores objects corresponding to the specified class. 
        factory(User::class, 100)->create();

        //Re-enables mass assignment rules. 
        Model::reguard();
    }
}
