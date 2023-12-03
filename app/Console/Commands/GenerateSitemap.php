<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

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
    protected $description = 'Generate the sitemap';

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
        $homeUrl = "https://www.magnificcoding.com";
        $blogUrl = "https://www.magnificcoding.com/blog";
        $newsletterUrl = "https://www.magnificcoding.com/newsletter";
        $contactUrl = "https://www.magnificcoding.com/contact";
        $aboutUrl = "https://www.magnificcoding.com/about";
        $portfolioUrl = "https://www.magnificcoding.com/portfolio";
        $policyUrl = "https://www.magnificcoding.com/policy";
        $tosUrl = "https://www.magnificcoding.com/terms-of-service";
        $servicesUrl = "https://www.magnificcoding.com/services";
        $seoServiceUrl = "https://www.magnificcoding.com/seo-service";
        $webDevptServiceUrl = "https://www.magnificcoding.com/website-development-service";

        $sitemap = Sitemap::create()
            ->add($homeUrl)
            ->add($blogUrl)
            ->add($newsletterUrl)
            ->add($contactUrl)
            ->add($aboutUrl)
            ->add($portfolioUrl)
            ->add($policyUrl)
            ->add($tosUrl)
            ->add($servicesUrl)
            ->add($seoServiceUrl)
            ->add($webDevptServiceUrl);

        $categories = Category::all();
        foreach($categories as $category){
            $categoryUrl = "https://www.magnificcoding.com/category/".$category->slug;
            $sitemap->add($categoryUrl);
        }

        $articles = Article::published()->get();
        foreach($articles as $article){
            $articleUrl = "https://www.magnificcoding.com/article/".$article->published_at. "/" .$article->slug;
            $sitemap->add($articleUrl);
        }

        $tags = Tag::all();
        foreach($tags as $tag){
            $tagUrl = "https://www.magnificcoding.com/tag/".$tag->slug;
            $sitemap->add($tagUrl);
        }

        $users = User::whereRole('author')->get();
        foreach($users as $user){
            $authorUrl = "https://www.magnificcoding.com/article-author/".$user->slug;
            $sitemap->add($authorUrl);
        }
        
        $sitemap->writeToFile(public_path('sitemap.xml'));      
    }
}
