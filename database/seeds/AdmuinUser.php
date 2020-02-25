<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profile;

class AdmuinUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role([
			
			'name'	=> 'customer',
			'description' => 'customer role',
		]);
		$role->save();
		
		$role = new Role([
			
			'name'	=> 'Admin',
			'description' => 'Admin role',
		]);
		$role->save();
		
		$user = new User([
			
			'email' => 'admin1@blog.com',
			'password' => bcrypt('admin'),
			'role_id'  => $role->id,
		]);
		$user->save();
		
		$profile = new Profile([
			
			'user_id' => $user->id,
		]);
		$profile->save();
    }
}
