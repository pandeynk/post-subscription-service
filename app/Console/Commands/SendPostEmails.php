<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Mail\PostNotification;
use Illuminate\Support\Facades\Mail;

class SendPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('is_sent', false)->get();
    
    foreach ($posts as $post) {
        $subscribers = $post->website->subscribers;
        
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new PostNotification($post));
        }

        $post->update(['sent' => true]);
    }
    }
}
