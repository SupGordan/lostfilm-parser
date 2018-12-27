<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Films;
use HtmlDom;

class ParserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser {all?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parser new films from LostFilms';

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
        $flag_work = true;
        $check_base = true;
        if($this->argument('all')) {
            Films::truncate();
        }
        if(!Films::all()->toArray()) $check_base = false;
        $html = file_get_contents('https://www.lostfilm.tv/new/');
        while ($flag_work) {
            if (isset($next->parent->href)) {
                $html = file_get_contents('https://www.lostfilm.tv'. $next->parent->href);
            }
            $dom = new HtmlDom($html);
            $series = $dom->find('a[style=text-decoration:none;display:block]');
            foreach ($series as $item) {
                $filmName = $item->children(1)->children(0)->plaintext;
                $seriesName = $item->children(1)->children(4)->children(0)->plaintext;
                $releaseDate = $item->children(1)->children(4)->children(3)->plaintext;
                $url = 'https://www.lostfilm.tv'. $item->href;
                if ($check_base) {
                    if (Films::where(['film_name' => $filmName, 'series_name' => $seriesName])->get()->toArray()) {
                        $this->info('Ready');
                        return;
                    }
                }
                $film = new Films();
                $film->film_name = $filmName;
                $film->series_name = $seriesName;
                $film->release_date = date("Y-m-d", strtotime(substr($releaseDate, 26)));
                $film->url = $url;
                $film->save();
            }
            $next = $dom->find('.next-link', 0);
            if ($next->class != "next-link active") $flag_work = false;
        }
        $this->info('Ready');
        return;
    }
}
