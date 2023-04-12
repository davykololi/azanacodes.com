<?php

namespace App\Http\Controllers\User;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $search = $request->has('search');
        if($search){
            $allArticles = Article::search($request->search)->paginate(10);
        }else{
            $featuredArticles = Article::latest('id')->eagerLoaded()->published()->paginate(2);
            $allArticles = Article::query()->published()->eagerLoaded()->inRandomOrder()->limit(10)->get();
            $allArticlesAside = Article::published()->latest('id')->eagerLoaded()->limit(10)->get();
            $categories = categories();
            $tags = Tag::with('articles')->get();

            $laravel = Category::laravelCategory();
            $laravelArticles = $laravel->articles()->published()->latest()->limit(5)->get();

            $reactJs = Category::reactJsCategory();
            $reactJsArticles = $reactJs->articles()->published()->latest()->limit(5)->get();

            $vueJs = Category::vueJsCategory();
            $vueJsArticles = $vueJs->articles()->published()->latest()->limit(5)->get();

            $tailwindCss = Category::tailwindCssCategory();
            $tailwindCssArticles = $tailwindCss->articles()->published()->latest()->limit(5)->get();

            $websiteName = config('app.name');
            $title = 'Blog';
            $desc = 'The Magnific Coding Blog';
            $keywords = 'magnific coding blog';
            $url = URL::current();
            $tel = '+254724351952';
            $logo = 'https://magnificcoding.com/static/logo.jpg';

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setCanonical($url);

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($url);
            OpenGraph::addProperty('type','articles');
            OpenGraph::addProperty('locale','en-US');

            Twitter::setTitle($title);
            Twitter::setSite('@CodingMagnific');
            Twitter::setDescription($desc);
            Twitter::setUrl($url);

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Articles');
            JsonLd::addImage($logo);

            $webSite = Schema::Organization()
                    ->name($websiteName)
                    ->headline($title)
                    ->description($desc)
                    ->keywords($keywords)
                    ->email('magnificcoding@gmail.com')
                    ->url($url)
                    ->contactPoint(Schema::ContactPoint()->telephone($tel)->areaServed('Worldwide'))
                    ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('5200'))
                    ->sameAS("https://www.magnificcoding.com")
                    ->logo(Schema::ImageObject()->url($logo));
                
            echo $webSite->toScript();

            $data = [
                'title' => $title,
                'categories' => $categories,
                'allArticles' => $allArticles,
                'featuredArticles' =>$featuredArticles,
                'allArticlesAside' => $allArticlesAside,
                'tags' => $tags,
                'laravel' => $laravel,
                'laravelArticles' => $laravelArticles,
                'reactJs' => $reactJs,
                'reactJsArticles' => $reactJsArticles,
                'vueJs' => $vueJs,
                'vueJsArticles' => $vueJsArticles,
                'tailwindCss' => $tailwindCss,
                'tailwindCssArticles' => $tailwindCssArticles,
            ];
            return view('user.blog',$data);
        }    
    }
}
