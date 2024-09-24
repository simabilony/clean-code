<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class NewUserDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {}

    public function handle()
    {
        Project::create([
            'user_id' => $this->user->id,
            'name' => 'Demo project 1',
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'name' => 'Demo category 1',
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'name' => 'Demo category 2',
        ]);
    }
}
