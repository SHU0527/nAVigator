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

        for ($i = 1; $i <= 248; $i++) {

        $client = new \Goutte\Client();

        if ($i === 1) {
            $targetUrl = "https://www.dmm.co.jp/digital/videoa/-/list/narrow/=/article=keyword/id=1039/n1=DgRJTglEBQ4G2P6FxA__/sort=ranking/";
        } else {
            $targetUrl = "https://www.dmm.co.jp/digital/videoa/-/list/narrow/=/article=keyword/id=1039/n1=DgRJTglEBQ4G2P6FxA__/sort=ranking/page=${i}/"; 
        }

        $crawler = $client->request('GET', $targetUrl);

        $link = $crawler->selectLink('はい')->link();

        $clicked = $client->click($link);


        $clicked->filter('ul#list')->each(function ($ul) {
            
            $ul->filter('li')->each(function ($li) {
                $li->filter('p.sublink')->each(function ($p) {
                    if ($p->text() !== '----') {
                        Log::notice($p->text());
                        $sexy_actress = SexyActress::where('name', '=', $p->text())->first();
                        if ($sexy_actress !== null) {
                            if (empty($sexy_actress->category_id)) {
                                $sexy_actress->category_id = 2;
                                Log::notice('カテゴリーIDを2に変更します');
                            }
                
                        DB::beginTransaction();
                        try {
                            $sexy_actress->save();
                            DB::commit();
                            Log::notice('AV女優テーブルへの更新が完了しました');

                        } catch (\Exception $exception) {
                            Log::error('AV女優の更新に失敗しました', [
                            'exception' => $exception->getMessage(),
                            'file' => __FILE__,
                            'method' => __FUNCTION__,
                            'line' => __LINE__
                            ]);
                            DB::rollBack();
                        };
                    }
                    }
                });
            });
        }); 
		  sleep(2);      
    }
}
}

