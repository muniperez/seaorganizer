<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Certificate;

use App\Notifications\CertificateExpiring;

class CheckCertificates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seaorganizer:check-certificates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks certificates and queue notifications';

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
     * @return mixed
     */
    public function handle()
    {
        // Carbon instance for the current time
        $now = new Carbon();

        // Array of days to alert
        $alertLevels = [360, 180, 120, 90, 60, 30, 20, 15, 10, 5];
        $lastKey = count($alertLevels) - 1;

        // All certificates expiring in 360 days
        $certificates = Certificate::alertable()->get();

        if(count($certificates) > 0)    {

            foreach ($certificates as $c) {
                
                if($c->user->subscribed('main'))    {

                    print('------- START ID: ' . $c->id . PHP_EOL);

                    // Check number of days to expiration (dto, Days to expire)
                    $daysLeft = $c->expiration()->diffInDays($now);

                    // When notification is sent, this value is set to TRUE
                    $notified = false;  
                        
                    foreach ($alertLevels as $key => $alertLevel) {
                        
                        if($notified === false) {
                            
                            $previousKey = $key - 1;

                            $previousLevel = ( $key > 0 ? $alertLevels[$previousKey] : $alertLevels[0] );
                            //$nextLevel = ($key < $lastKey  0 ? $alertLevels[$key++], $alertLevels[$lastKey] );

                            print("Days left: $daysLeft | Prev level: $previousLevel | Current level: $alertLevel | Certificate level: " . $c->alert_level . PHP_EOL);

                            // Number of days left is between current level and previous level
                            if($daysLeft <= $previousLevel && $daysLeft > $alertLevel) {

                                print("---- Level: $alertLevel" . PHP_EOL);

                                // If current day is smaller than last alert, then checks if it is equal to previous level
                                if($daysLeft < $c->alert_level || !$c->alert_level) {

                                    if($c->alert_level > $alertLevel || !$c->alert_level)    {

                                        print('-------------- Previous level is bigger than alert_level, sending alert' . PHP_EOL);

                                        // Certificate doesn't have a notification on that level yet
                                        $c->alert_level = $alertLevel;
                                        $c->save();

                                        // Notify user
                                        $c->user->notify(new CertificateExpiring($c));
                                    }
                                }
                                else {

                                    print('B' . PHP_EOL);

                                }
                            }
                        }
                    }

                    print("------------------------------" . PHP_EOL . PHP_EOL);
                

                    // if($dto <= 360 && $dto > 180 )  {

                    //     if(!$c->alert_level || $c->alert_level > 360)   {

                    //         /*
                    //             Certificate doesn't have notifications or the last one sent was more than 360 days from the expiration date
                    //             Then sends a notification
                    //         */


                    //     }
                    //     elseif(!$c->alert_level || $c->alert_level > 360)   {

                    //         /*
                    //             Certificate doesn't have notifications or the last one sent was more than 360 days from the expiration date
                    //             Then sends a notification
                    //         */

                            
                    //     }

                    // }
                }
            }
        }
    }
}
