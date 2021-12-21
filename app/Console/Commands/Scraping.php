<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use  App\SexyActress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        
        //$targetUrl = 'https://www.dmm.co.jp/digital/videoa/-/actress/=/keyword=wa/sort=count/';
        //$targetUrl = 'https://www.mgstage.com/?form=prestige_18kin&utm_medium=official&utm_source=prestige&utm_campaign=prestige_18kin&agef=1';
        //$targetUrl = 'https://www.prestige-av.com/';

        $cookies = ['uuid', '38dbd6482dfd41c1002f71bd9f3862af'];

        $client = new \Goutte\Client();

        $client->getCookieJar()->updateFromSetCookie($cookies);

        $targetUrl = 'https://www.mgstage.com/?form=prestige_18kin&utm_medium=official&utm_source=prestige&utm_campaign=prestige_18kin&agef=1';

        $crawler = $client->request('GET', $targetUrl);


        $link = $crawler->selectLink('女優一覧へ')->link();

        $clicked = $client->click($link);

        $clicked->filter('div.push_actress')->each(function ($div) {
            
            $div->filter('li')->each(function ($li) {
                $sexy_actress = new SexyActress();
                $sexy_actress->name = $li->text();
                $sexy_actress->purchase_link = $li->filter('a')->attr('href');
                $sexy_actress->image_name = $li->filter('img')->attr('src');
                
        
                DB::beginTransaction();
                try {
                    $sexy_actress->save();
                    DB::commit();
                    Log::notice('スクレイピングバッチの実行が成功しました。');

                } catch (\Exception $exception) {
                    Log::error('AV女優の更新に失敗しました', [
                    'exception' => $exception->getMessage(),
                    'file' => __FILE__,
                    'method' => __FUNCTION__,
                    'line' => __LINE__
                    ]);
                    DB::rollBack();
                }
            });

        });

    }       
 }

