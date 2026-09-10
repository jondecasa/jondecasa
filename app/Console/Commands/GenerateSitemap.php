<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = SitemapGenerator::create('https://jondecasa.com')
            ->shouldCrawl(function ($url) {
                return strpos($url->getPath(), '/descargas') === false
                    && strpos($url->getPath(), '/politica-privacidad') === false
                    && strpos($url->getPath(), '/politica-cookies') === false;
            })
            ->getSitemap();

        Posts::where('visible', 'S')->get()->each(function ($post) use ($sitemap) {
            $sitemap->add(Url::create($post->slug)->setPriority(0.5));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generado en public/sitemap.xml');

        return self::SUCCESS;
    }
}
