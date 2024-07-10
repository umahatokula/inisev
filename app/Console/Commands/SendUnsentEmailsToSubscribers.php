<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Website;
use App\Mail\PostPublished;
use App\Models\EmailHistory;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendUnsentEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-unsent-emails-to-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to subscribers for all new posts that haven\'t been sent yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = Website::all();

        foreach ($websites as $website) {
            // Get all posts for curent website
            $posts = Post::where('website_id', $website->id)->get();

            foreach ($posts as $post) {
                $subscriptions = Subscription::where('website_id', $post->website_id)->get();
                foreach ($subscriptions as $subscription) {
                    // Check if post has been sent to subscirber before
                    if (!EmailHistory::where('post_id', $post->id)->where('subscription_id', $subscription->id)->exists()) {
                        Mail::to($subscription->user->email)->send(new PostPublished($post));
                        EmailHistory::create([
                            'post_id' => $post->id,
                            'subscription_id' => $subscription->id,
                        ]);
                    }
                }
            }
        }

        $this->info('successful');
    }
}
