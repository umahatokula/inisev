<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use App\Mail\PostPublished;
use App\Models\EmailHistory;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-new-post-to-subscribers {postId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to subscribers for all new posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postId = $this->argument('postId');
        $post = Post::find($postId);

        if (!$post) {
            $this->error("Post with ID $postId not found.");
            return;
        }

        $subscriptions = Subscription::where('website_id', $post->website_id)->get();
        foreach ($subscriptions as $subscription) {
            if (!EmailHistory::where('post_id', $post->id)->where('subscription_id', $subscription->id)->exists()) {
                Mail::to($subscription->user->email)->send(new PostPublished($post));
                EmailHistory::create([
                    'post_id' => $post->id,
                    'subscription_id' => $subscription->id,
                ]);
            }
        }

        $this->info('successful');
    }
}
