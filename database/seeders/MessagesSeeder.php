<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'subject' => 'Hello',
                'body' => 'Hi there, how are you?',
                'is_read' => false,
                'sender_id' => 1,
                'recipient_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject' => 'Meeting tomorrow',
                'body' => 'Just a reminder that we have a meeting tomorrow at 10am.',
                'is_read' => false,
                'sender_id' => 2,
                'recipient_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject' => 'Question about project',
                'body' => 'Hey, can you help me with a question about the project?',
                'is_read' => false,
                'sender_id' => 3,
                'recipient_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject' => 'Re: Question about project',
                'body' => 'Sure, what do you need help with?',
                'is_read' => false,
                'sender_id' => 1,
                'recipient_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject' => 'New feature request',
                'body' => 'Hi, I have a request for a new feature in the app.',
                'is_read' => false,
                'sender_id' => 2,
                'recipient_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
