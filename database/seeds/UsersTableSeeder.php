<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `users` 
                                (
                                `first_name`,
                                `last_name`,
                                `nick_name`,
                                `age`,
                                `email`,
                                `group_id`,
                                `city_id`,
                                `user_attributes_id`                                        
                                ) 
                    values (?, ?, ?, ?, ?, ?, ?, ?)');
    }
}
