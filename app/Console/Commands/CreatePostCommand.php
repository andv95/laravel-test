<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class CreatePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::create([
            'title' => "A Nguyen",
            'content' => "This is content",
            'publish' => 1
        ]);
    }
}
