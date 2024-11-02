<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder;
use App\Models\Reservation;
use Carbon\Carbon;

class SendReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminder email at 8 AM';

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
        $today = Carbon::now()->format('Y-m-d');
        $todaysReservations = Reservation::where('date', $today)
            ->with(['user', 'shop'])
            ->get();

        foreach ($todaysReservations as $reservation) {
            Mail::to($reservation->user->email)->send(new Reminder($reservation));
        }

        $this->info('Daily report email sent successfully.');
    }
}
