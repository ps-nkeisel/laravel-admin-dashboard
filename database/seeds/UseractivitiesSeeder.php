<?php

use Illuminate\Database\Seeder;
use App\Models\Useraction;

class UseractivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('useractions')->delete();
		
		for ($i = 1; $i <= 3; $i ++) {
			Useraction::create([
				'active' => 1,
				'type' => 1,
				'assigntype' => 9,
				'assigntonew' => 0,
				'assigntoold' => 0,
				'lang' => 1,
				'version' => 0,
				'destination' => 0,
				'code' => '',
				'comment' => '',
				'created_ip' => '127.0.0.1',
				'created_user' => 1
			]);
		}
		for ($i = 1; $i <= 5; $i ++) {
			Useraction::create([
				'active' => 1,
				'type' => 1,
				'assigntype' => 7,
				'assigntonew' => 0,
				'assigntoold' => 0,
				'lang' => 1,
				'version' => 0,
				'destination' => 0,
				'code' => '',
				'comment' => 0,
				'created_ip' => '127.0.0.1',
				'created_user' => 1,
			]);
		}
    }
}
