<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

use App\Events;

class FactoryListeners
{
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
    public function handle(object $event): void
    {
        // 
    }

    public function create(Events\CreatingFactory $event) {
        $message = PHP_EOL . 'Factory ' . $event->factory->id . ' Created' .PHP_EOL;
        $message = $message . $event->factory . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }

    public function update(Events\UpdatingFactory $event) {
        $message = PHP_EOL . 'Factory ' . $event->newFactory->id . ' Updated' .PHP_EOL;
        $message = $message . '(new) ' . $event->newFactory . PHP_EOL;
        $message = $message . '(old) ' . $event->oldFactory . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }

    public function delete(Events\DeletingFactory $event) {
        $message = PHP_EOL . 'Factory ' . $event->factory->id . ' Deleted' .PHP_EOL;
        $message = $message . $event->factory . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }
}
