<?php

namespace App\Http\Controllers\User;

use Str;
use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use Share;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndArticleController extends Controller
{
    protected $url,$appLogo,$appSubDomain,$appMail,$orgName;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = URL::current();
        $this->appLogo = URL::secureAsset('/static/logo.png');
        $this->appSubDomain = "https://www.magnificcoding.com";
        $this->appMail = 'magnificcoding@gmail.com';
        $this->orgName = config('app.name');
    }

    // Category Articles
    public function category($slug,Request $request)
    { 
        if($request->filled('search')){
            $allArticles = Article::search($request->search)->paginate(2);
        }else{
            $category = Category::whereSlug($slug)->eagerLoaded()->firstOrFail();
            $categoryArticles = $category->articles()->eagerLoaded()->published()->latest('id')->paginate(10);
            $asides = $category->articles()->latest('id')->published()->eagerLoaded()->limit(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->latest('id')->limit(10)->get();

            $laravel = Category::laravelCategory();
            $laravelArticles = $laravel->articles()->published()->latest('id')->limit(5)->get();

            $reactJs = Category::reactJsCategory();
            $reactJsArticles = $reactJs->articles()->published()->latest('id')->limit(5)->get();

            $vueJs = Category::vueJsCategory();
            $vueJsArticles = $vueJs->articles()->published()->latest('id')->limit(5)->get();

            $tailwindCss = Category::tailwindCssCategory();
            $tailwindCssArticles = $tailwindCss->articles()->published()->latest('id')->limit(5)->get();

            $title = $category->name;
            $desc = $category->description;
            $publishedDate = $category->created_at;
            $modifiedDate = $category->updated_at;

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setKeywords($category->keywords);
            SEOMeta::setCanonical($this->url);

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($this->url);
            OpenGraph::addProperty('type','articles');

            Twitter::setTitle($title);
            Twitter::setSite('@CodingMagnific');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('articleSection');
        
            foreach($categoryArticles as $article){
                OpenGraph::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://www.magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
                ]);
                JsonLd::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
            }

            $newsArticles = Schema::Article()
                    ->articleSection($title)
                    ->description($desc)
                    ->datePublished($publishedDate)
                    ->dateModified($modifiedDate)
                    ->email($this->appMail)
                    ->url($this->url)
                    ->sameAS($this->appSubDomain)
                    ->logo(Schema::ImageObject()->url($this->appLogo));
            echo $newsArticles->toScript();

            $data = [
                'title' => $title,
                'category' => $category,
                'categoryArticles' => $categoryArticles,
                'asides' => $asides,
                'categories' => $categories,
                'tags' => $tags,
                'allArticles' => $allArticles,
                'allArticlesAside' => $allArticlesAside,
                'laravel' => $laravel,
                'laravelArticles' => $laravelArticles,
                'reactJs' => $reactJs,
                'reactJsArticles' => $reactJsArticles,
                'vueJs' => $vueJs,
                'vueJsArticles' => $vueJsArticles,
                'tailwindCss' => $tailwindCss,
                'tailwindCssArticles' => $tailwindCssArticles,
            ];
        }

        return view('user.category.articles',$data);
    }
    
    public function article($slug,Request $request)
    {
        if($request->has('search')){
            $allArticles = Article::search($request->search)->paginate(2);
        }else{
            Article::where('slug',$slug)->published()->firstOrFail()->increment('total_views');
            $article = Article::where('slug',$slug)->published()->eagerLoaded()->firstOrFail();
            $all = Article::published()->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->latest('id')->limit(10)->get();
            $asides = $article->category->articles()->published()->latest('id')->eagerLoaded()->limit(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();

            $laravel = Category::laravelCategory();
            $laravelArticles = $laravel->articles()->published()->latest('id')->limit(5)->get();

            $reactJs = Category::reactJsCategory();
            $reactJsArticles = $reactJs->articles()->published()->latest('id')->limit(5)->get();

            $vueJs = Category::vueJsCategory();
            $vueJsArticles = $vueJs->articles()->published()->latest('id')->limit(5)->get();

            $tailwindCss = Category::tailwindCssCategory();
            $tailwindCssArticles = $tailwindCss->articles()->published()->latest('id')->limit(5)->get();

            $title = $article->title;
            $desc = $article->description;
            $publishedDate = $article->created_at;
            $modifiedDate = $article->updated_at;
            $author = $article->user->name;
            $imageUrl = 'https://www.magnificcoding.com/storage/storage/'.$article->image;
            if(!empty($article->user->profile->image)){
                $authorUrl = 'https://www.magnificcoding.com/storage/avatars/'.$article->user->profile->image;
            }else{
                $authorUrl = 'https://www.magnificcoding.com/static/avatar.png';
            }
            
            $width = '1200';
            $height = '628';

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setKeywords($article->keywords);
            SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(),'property');
            SEOMeta::addMeta('article:modified_time', $article->updated_at->toW3CString(),'property');
            SEOMeta::addMeta('article:section', strtolower($article->category->name),'property');
            foreach($article->tags as $tag){
                SEOMeta::addMeta('article:tag', $tag->name,'property');
            }

            SEOMeta::setCanonical($this->url);
            SEOMeta::addMeta('article:author',$article->user->name,'property');

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($this->url);
            OpenGraph::addProperty('type','Article');
            OpenGraph::addProperty('locale','en-US');
            OpenGraph::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://www.magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
            ]);

            Twitter::setTitle($title);
            Twitter::setSite('@CodingMagnific');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Article');
            JsonLd::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image);

            $newsArticles = Schema::Article()
                    ->headline($title)
                    ->description($desc)
                    ->datePublished($publishedDate)
                    ->dateModified($modifiedDate)
                    ->image(Schema::ImageObject()->url($imageUrl)->width($width)->height($height))
                    ->author(Schema::Person()->name($author)->url($authorUrl))
                    ->publisher(Schema::Organization()->name($this->orgName))
                    ->email($this->appMail)
                    ->url($this->url)
                    ->sameAS($this->appSubDomain)
                    ->affiliate(Schema::Organization()->name($this->orgName))
                    ->logo(Schema::ImageObject()->url($this->appLogo));
            echo $newsArticles->toScript();

            $shareComponent = Share::currentPage()
                ->facebook()
                ->twitter()
                ->linkedin()
                ->whatsapp()
                ->reddit()
                ->telegram();

            return view('user.article_details',compact('title','article','allArticles','allArticlesAside','shareComponent','asides','categories','tags','laravel','laravelArticles','reactJs','reactJsArticles','vueJs','vueJsArticles','tailwindCss','tailwindCssArticles'));
        }
    }

    public function tag($slug,Request $request)
    {
        if($request->has('search')){
            $allArticles = Article::search($request->search)->paginate(2);
        }else{
            $tag = Tag::whereSlug($slug)->eagerLoaded()->firstOrFail();
            $tagArticles = $tag->articles()->published()->eagerLoaded()->latest()->paginate(10);
            $asides = $tag->articles()->published()->latest('id')->eagerLoaded()->take(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->latest('id')->limit(10)->get();

            $laravel = Category::laravelCategory();
            $laravelArticles = $laravel->articles()->published()->latest('id')->limit(5)->get();

            $reactJs = Category::reactJsCategory();
            $reactJsArticles = $reactJs->articles()->published()->latest('id')->limit(5)->get();

            $vueJs = Category::vueJsCategory();
            $vueJsArticles = $vueJs->articles()->published()->latest('id')->limit(5)->get();

            $tailwindCss = Category::tailwindCssCategory();
            $tailwindCssArticles = $tailwindCss->articles()->published()->latest('id')->limit(5)->get();

            $title = $tag->name;
            $desc = $tag->description;
            $publishedDate = $tag->created_at;
            $modifiedDate = $tag->updated_at;

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setKeywords($tag->keywords);
            SEOMeta::setCanonical($this->url);

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($this->url);
            OpenGraph::addProperty('type','Articles');

            Twitter::setTitle($title);
            Twitter::setSite('@CodingMagnific');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Articles');

            foreach($tagArticles as $article){
                OpenGraph::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://www.magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
                ]);
                JsonLd::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
            }

            $tagArts = Schema::Article()
                    ->headline($title)
                    ->description($desc)
                    ->datePublished($publishedDate)
                    ->dateModified($modifiedDate)
                    ->email($this->appMail)
                    ->url($this->url)
                    ->sameAS($this->appSubDomain)
                    ->logo(Schema::ImageObject()->url($this->appLogo));
            echo $tagArts->toScript();
        
            $data = [
                'title' => $title,
                'tag' => $tag,
                'tagArticles' => $tagArticles,
                'asides' => $asides,
                'categories' => $categories,
                'tags' => $tags,
                'allArticles' => $allArticles,
                'allArticlesAside' => $allArticlesAside,
                'laravel' => $laravel,
                'laravelArticles' => $laravelArticles,
                'reactJs' => $reactJs,
                'reactJsArticles' => $reactJsArticles,
                'vueJs' => $vueJs,
                'vueJsArticles' => $vueJsArticles,
                'tailwindCss' => $tailwindCss,
                'tailwindCssArticles' => $tailwindCssArticles,
            ];  
        }

        return view('user.tag.articles',$data);
    }

    public function articleAuthor($slug,Request $request)
    {
        if($request->has('search')){
            $allArticles = Article::search($request->search)->paginate(2);
        }else{
            $author = User::whereRole('author')->whereSlug($slug)->eagerLoaded()->firstOrFail();
            $authorArticles = $author->articles()->published()->latest('id')->eagerLoaded()->paginate(10);
            $asides = $author->articles()->published()->latest('id')->eagerLoaded()->limit(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->latest('id')->limit(10)->get();

            $laravel = Category::laravelCategory();
            $laravelArticles = $laravel->articles()->published()->latest('id')->limit(5)->get();

            $reactJs = Category::reactJsCategory();
            $reactJsArticles = $reactJs->articles()->published()->latest('id')->limit(5)->get();

            $vueJs = Category::vueJsCategory();
            $vueJsArticles = $vueJs->articles()->published()->latest('id')->limit(5)->get();

            $tailwindCss = Category::tailwindCssCategory();
            $tailwindCssArticles = $tailwindCss->articles()->published()->latest('id')->limit(5)->get();

            $name = $author->name;
            $title = 'Articles By'." ".$name;
            $email = $author->email;
            $image = 'https://www.magnificcoding.com/storage/storage/'.$author->image;
            $publishedDate = $author->created_at;
            $modifiedDate = $author->updated_at;
            $phone = $author->phone_no;
            $area = $author->area;

            SEOMeta::setTitle($name);
            SEOMeta::setDescription($title);
            SEOMeta::setKeywords($author->keywords);
            SEOMeta::setCanonical($this->url);

            OpenGraph::setTitle($name);
            OpenGraph::setDescription($title);
            OpenGraph::setUrl($this->url);
            OpenGraph::addProperty('type','Person');

            Twitter::setTitle($name);
            Twitter::setSite('@CodingMagnific');
            Twitter::setDescription($title);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($name);
            JsonLd::setDescription($title);
            JsonLd::setType('Person');

            foreach($authorArticles as $article){
                OpenGraph::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image,['height'=>'628','width' =>'1200']);
                JsonLd::addImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://www.magnificcoding.com/storage/storage/'.$article->image);
            }

            $userArticles = Schema::Person()
                    ->name($name)
                    ->image($image)
                    ->logo(Schema::ImageObject()->url($this->appLogo))
                    ->url($this->url)
                    ->sameAS($this->appSubDomain)
                    ->datePublished($publishedDate)
                    ->dateModified($modifiedDate)
                    ->contactPoint([Schema::ContactPoint()->email($email)->phone($phone)->areaServed($area)])
                    ->affiliate(Schema::Organization()->name($this->orgName)->email($this->appMail));
            echo $userArticles->toScript();
        
            $data = [
                'title' => $title,
                'author' => $author,
                'authorArticles' => $authorArticles,
                'asides' => $asides,
                'categories' => $categories,
                'tags' => $tags,
                'allArticles' => $allArticles,
                'allArticlesAside' => $allArticlesAside,
                'laravel' => $laravel,
                'laravelArticles' => $laravelArticles,
                'reactJs' => $reactJs,
                'reactJsArticles' => $reactJsArticles,
                'vueJs' => $vueJs,
                'vueJsArticles' => $vueJsArticles,
                'tailwindCss' => $tailwindCss,
                'tailwindCssArticles' => $tailwindCssArticles,
            ]; 
        }

        return view('user.author.articles',$data);
    }
}
