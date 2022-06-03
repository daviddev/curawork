<?php

namespace Database\Seeders;

use App\Models\Connection;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $connections = [
            [
                'user_from_id' => 1,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 2,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 3,
                'user_to_id' => 1,
                'status' => Connection::STATUS_ACCEPTED,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 5,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 8,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 9,
                'user_to_id' => 1,
                'status' => Connection::STATUS_ACCEPTED,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 2,
                'user_to_id' => 9,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 12,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 13,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 14,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 15,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 16,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 17,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 18,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 19,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 20,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 21,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 22,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 23,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 24,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 25,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 31,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 35,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 36,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 1,
                'user_to_id' => 37,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 38,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 40,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 42,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 45,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_from_id' => 50,
                'user_to_id' => 1,
                'status' => Connection::STATUS_PENDING,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        Connection::insert($connections);
    }
}
