<?php

use Illuminate\Database\Seeder;

use App\Certificate;
use App\User;
use App\Flag;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(User::class, 50)->create()->each( 

        	function($user) {

        		factory(Certificate::class, 20)->create(['user_id' => $user->id])->each(

        			function($certificate) {

        				factory(Flag::class)->create(['certificate_id' => $certificate->id, 'user_id' => $certificate->user->id]);

        			});

        	});
    }
}
