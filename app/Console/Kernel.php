<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Experience_telegrams;
use App\Experience_telegrams_user_distribution;
use App\Experience_telegrams_user;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\TelegramController;
use DB;
class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('get', "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11");
            $responseJSON = json_decode($response->getBody(), true);
            $Experience_telegrams = Experience_telegrams::first();
            $Experience_telegrams->course = round((1/$responseJSON[0]['buy'])*$responseJSON[2]['buy'], 6);
            $Experience_telegrams->save();
        })->everyMinute();

        $schedule->call(function () {
            $Experience_telegrams = Experience_telegrams::first();
            $send_data['text'] = "Текущий курс ".$Experience_telegrams->course."₽";

            $history_user = Experience_telegrams_user_distribution::get();
            foreach ($history_user as $key => $h) {
                $user = Experience_telegrams_user::where([
                    'id' => $h->id_user,
                ])->first();
                $send_data['chat_id'] = $user->telegrams_chat_id;
                TelegramController::sendTelegram('sendMessage', $send_data);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
