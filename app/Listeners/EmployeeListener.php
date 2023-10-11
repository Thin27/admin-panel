<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

use App\Events;

class EmployeeListener
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

    public function create(Events\CreatingEmployee $event) {
        $message = PHP_EOL . 'Employee ' . $event->employee->id . ' Created' .PHP_EOL;
        $message = $message . $event->employee . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }

    public function update(Events\UpdatingEmployee $event) {
        $message = PHP_EOL . 'Employee ' . $event->newEmployee->id . ' Updated' .PHP_EOL;
        $message = $message . '(new) ' . $event->newEmployee . PHP_EOL;
        $message = $message . '(old) ' . $event->oldEmployee . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }

    public function delete(Events\DeletingEmployee $event) {
        $message = PHP_EOL . 'Employee ' . $event->employee->id . ' Deleted' .PHP_EOL;
        $message = $message . $event->employee . PHP_EOL;
        $message = $message . 'by user ' . Auth::id();
        app('log')->info($message);
    }
}
