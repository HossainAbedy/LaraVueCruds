<?php

namespace App\Listeners;
use App\Employee;
use App\Mail\Welcome;
use App\Events\EmployeeEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmployee implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public $event;

    // public function __construct(EmployeeEvent $event)
    // {
    //     $this->event=$event;
    // }

    /**
     * Handle the event.
     *
     * @param  EmployeeEvent  $event
     * @return void
     */
    public function handle(EmployeeEvent $event)
    {
        sleep(10);
        \Mail::to($event->employee->email)->send(new Welcome($event));
    }
}
