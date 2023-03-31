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
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/blog'))
            ->add(Url::create('/newsletter'))
            ->add(Url::create('/contact'))
            ->add(Url::create('/about'))
            ->add(Url::create('/portfolio'))
            ->add(Url::create('/policy'))
            ->add(Url::create('/terms-of-service'))
            ->add(Url::create('/services/seo'))
            ->add(Url::create('/services/backend'));

        $categories = Category::all();
        foreach($categories as $category){
            $sitemap->add(Url::create('/category/'.$category->slug));
        }

        $articles = Article::published()->get();
        foreach($articles as $article){
            $sitemap->add(Url::create('/article/'.$article->slug));
        }

        $tags = Tag::all();
        foreach($tags as $tag){
            $sitemap->add(Url::create('/tag/'.$tag->slug));
        }

        $users = User::whereRole('author')->get();
        foreach($users as $user){
            $sitemap->add(Url::create('/article-author/'.$user->slug));
        }
        
        $sitemap->writeToFile(public_path('sitemap.xml'));      
    }
}
