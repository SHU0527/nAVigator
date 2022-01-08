<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\SexyActress;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class SaveImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:save_image';

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
        $all_images = SexyActress::get(['image_name']);
        foreach ($all_images as $image) {
            $sexy_actress = SexyActress::where('image_name', $image->image_name)->first();
            //画像のURL
            $url = $image->image_name;

            //URLからファイル名を取得 ここはお好きな方法でファイル名を決めてください。
            $file_name = substr(strrchr($url,"/"),1);

            $sexy_actress->image_name = $file_name;
            
            $sexy_actress->save();
            //URLからファイル取得
            if (strpos($url, 'mgstage') !== false) {
                $options = array('http' => array('method' => 'GET', 'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',"ignore_errors"=>true));
                //コンテンツ取得
                $img_downloaded = file_get_contents($url, false, stream_context_create($options)); 

            } else {
                $img_downloaded = file_get_contents($url);
            }
            //一時ファイル作成
            $tmp = tmpfile();
            //一時ファイルに画像を書き込み
            fwrite($tmp, $img_downloaded);
            //一時ファイルのパスを取得
            $tmp_path = stream_get_meta_data($tmp)['uri'];
            //storageに保存。
            Storage::putFileAs('public/img', new File($tmp_path), $file_name);
            //一時ファイル削除
            fclose($tmp);
        }
    }
}
