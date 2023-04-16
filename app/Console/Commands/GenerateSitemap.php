<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\RequestOptions;
use Spatie\Sitemap\Crawler\Profile;
use Spatie\Sitemap\SitemapGenerator;

use Spatie\Sitemap\Tags\Url;
use App\Models\Posts;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

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
        $generator = SitemapGenerator::create('https://jondecasa.com')
        ->shouldCrawl(function ($url) {
            
            if(strpos($url->getPath(), '/descargas') === false &&
                    strpos($url->getPath(), '/politica-privacidad') ===false &&
                    strpos($url->getPath(), '/politica-cookies') === false 
            ){
                return true;
            }
            return false;

            
        });

        $posts = Posts::where("visible", "S");

        foreach($posts as $post){
            $generator->add(Url::create($post->slug)->setPriority(0.5));
        }
        
        $generator->writeToFile(public_path("sitemap.xml"));
    }
}
