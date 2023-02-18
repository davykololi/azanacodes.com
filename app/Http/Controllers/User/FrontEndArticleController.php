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
        $this->appSubDomain = "http://www.magnificcoding.com";
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
            $categoryArticles = $category->articles()->eagerLoaded()->published()->latest('id')->paginate(2);
            $asides = $category->articles()->latest('id')->published()->limit(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->latest('id')->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->inRandomOrder()->limit(10)->get();

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
            Twitter::setSite('@magnificcoding');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('articleSection');
        
            foreach($categoryArticles as $article){
                OpenGraph::addImage('https://magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
                ]);
                JsonLd::addImage('https://magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://magnificcoding.com/storage/storage/'.$article->image);
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
            $all = Article::published()->latest('id')->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->inRandomOrder()->limit(10)->get();
            $asides = $article->category->articles()->published()->inRandomOrder()->eagerLoaded()->limit(10)->get();
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
            $imageUrl = 'https://magnificcoding.com/storage/storage/'.$article->image;
            if(!empty($article->user->profile->image)){
                $authorUrl = 'https://magnificcoding.com/storage/avatars/'.$article->user->profile->image;
            }else{
                $authorUrl = 'https://magnificcoding.com/static/avatar.png';
            }
            
            $width = '1200';
            $height = '628';

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setKeywords($article->keywords);
            SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(),'property');
            SEOMeta::addMeta('article:section', strtolower($article->category->name),'property');
            SEOMeta::setCanonical($this->url);

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($this->url);
            OpenGraph::addProperty('type','Article');
            OpenGraph::addProperty('locale','en-US');
            OpenGraph::addImage('https://magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
            ]);

            Twitter::setTitle($title);
            Twitter::setSite('@magnificcoding');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setImage('https://magnificcoding.com/storage/storage/'.$article->image);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Article');
            JsonLd::addImage('https://magnificcoding.com/storage/storage/'.$article->image);

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
            $tagArticles = $tag->articles()->published()->eagerLoaded()->latest()->paginate(2);
            $asides = $tag->articles()->published()->latest('id')->take(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->latest('id')->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->inRandomOrder()->limit(10)->get();

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
            OpenGraph::addProperty('type','Place');

            Twitter::setTitle($title);
            Twitter::setSite('@magnificcoding');
            Twitter::setDescription($desc);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Article');

            foreach($tagArticles as $article){
                OpenGraph::addImage('https://magnificcoding.com/storage/storage/'.$article->image,
                ['secure_url' => 'https://magnificcoding.com/storage/storage/'.$article->image,
                'height'=>'628','width' =>'1200'
                ]);
                JsonLd::addImage('https://magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://magnificcoding.com/storage/storage/'.$article->image);
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

    public function articleBy($slug,Request $request)
    {
        if($request->has('search')){
            $allArticles = Article::search($request->search)->paginate(2);
        }else{
            $author = User::whereRole('author')->whereSlug($slug)->eagerLoaded()->firstOrFail();
            $authorArticles = $author->articles()->published()->latest('id')->eagerLoaded()->paginate(2);
            $asides = $author->articles()->published()->latest('id')->limit(10)->get();
            $categories = categories();
            $tags = Tag::eagerLoaded()->get();
            $all = Article::published()->latest('id')->eagerLoaded();
            $allArticles = $all->inRandomOrder()->limit(10)->get();
            $allArticlesAside = $all->inRandomOrder()->limit(10)->get();

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
            $image = 'https://magnificcoding.com/storage/storage/'.$author->image;
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
            Twitter::setSite('@magnificcoding');
            Twitter::setDescription($title);
            Twitter::setUrl($this->url);
            Twitter::setType('summary_large_image');

            JsonLd::setTitle($name);
            JsonLd::setDescription($title);
            JsonLd::setType('Person');

            foreach($authorArticles as $article){
                OpenGraph::addImage('https://magnificcoding.com/storage/storage/'.$article->image,['height'=>'628','width' =>'1200']);
                JsonLd::addImage('https://magnificcoding.com/storage/storage/'.$article->image);
                Twitter::setImage('https://magnificcoding.com/storage/storage/'.$article->image);
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
