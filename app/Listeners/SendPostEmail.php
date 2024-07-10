<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Events\PostPublishedEvent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostPublishedEvent $event)
    {
        // dd($event->post);
        Artisan::call('emails:send-new-post-to-subscribers', ['postId' => $event->post->id]);
    }
}
