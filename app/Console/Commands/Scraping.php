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
        
        $targetUrl = 'https://www.dmm.co.jp/digital/videoa/-/actress/=/keyword=wa/sort=count/';
        $client = new \Goutte\Client();
        $goutte = GoutteFacade::request('GET', $targetUrl);
        $link = $goutte->selectLink("はい")->link();
        $clicked = $client->click($link);


        $div = $clicked->filter('div.act-box');
        $div->filter('li')->each(function($li) {
            $sexy_actress = new SexyActress();
            $sexy_actress->name = $li->filter('img')->attr('alt');
            $sexy_actress->image_name = $li->filter('img')->attr('src');
            $sexy_actress->purchase_link = $li->filter('a')->attr('href');
        
            DB::beginTransaction();
        try {
            $sexy_actress->save();
            DB::commit();
            Log::notice('スクレイピングバッチの実行が成功しました。');

        } catch (\Exception $exception) {
            Log::error('記事の更新に失敗しました', [
                'exception' => $exception->getMessage(),
                'file' => __FILE__,
                'method' => __FUNCTION__,
                'line' => __LINE__
            ]);
            DB::rollBack();
        }
    });

        }       

    }

