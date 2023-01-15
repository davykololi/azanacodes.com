<?php

namespace App\Http\Controllers\User;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;
use Spatie\SchemaOrg\Schema;
use App\Jobs\SendContactJob;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
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

    //
    public function contact()
    {
    	$allArticles = Article::latest()->published()->paginate(2);
        $asides = Article::latest()->published()->limit(10)->get();
        $categories = Category::with('articles')->limit(10)->get();
        $category = Category::with('articles')->limit(10)->get();
        $tags = Tag::with('articles')->get();

        $title = 'Contact Us';
        $desc = 'Magnific Coding Contact Us Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('contact us');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','ContactPage');

        Twitter::setTitle($title);
        Twitter::setSite('@magnificcoding');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('ContactPage');

        $contact = Schema::ContactPage()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://magnificcoding.com/static/logo.png")
                ->sameAS("https://www.magnificcoding.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('+254724351952')
                ->email('magnificcoding@gmail.com')]);
        echo $contact->toScript();

        $data = array(
            'title' => $title,
        	'categories' => $categories,
            'allArticles' => $allArticles,
            'asides' => $asides,
            'tags' => $tags,
        );
    	
    	return view('user.contact',$data);
    }

    public function store(ContactFormRequest $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        // Mail Delivery logic goes here
        SendContactJob::dispatch($contact)->delay(Carbon::now()->addMinutes(2));
        toastr()->success(ucwords('Thank you for contacting us. We will get back to you soon'));

        return redirect()->back();
        //  return redirect()->route('contact.create');
    }

    public function portfolio()
    {
        $title = 'Portfolio';
        $desc = 'Magnific Coding Portfolio Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('portfolio');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','PortfolioPage');

        Twitter::setTitle($title);
        Twitter::setSite('@magnificcoding');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('PortfolioPage');

        $portfolio = Schema::ContactPage()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://magnificcoding.com/static/logo.png")
                ->sameAS("https://www.magnificcoding.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('+254724351952')
                ->email('magnificcoding@gmail.com')]);
        echo $portfolio->toScript();

        $data = array(
            'title' => $title,
        );

        return view('user.portfolio',$data);
    }

    public function about()
    {
        $title = 'About Us';
        $desc = 'Magnific Coding About Us Page';
        $url = URL::current();

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setKeywords('about us');
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','AboutPage');

        Twitter::setTitle($title);
        Twitter::setSite('@magnificcoding');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('AboutPage');

        $about = Schema::Organization()
                ->name($title)
                ->description($desc)
                ->url($url)
                ->logo("https://magnificcoding.com/static/logo.png")
                ->sameAS("https://www.magnificcoding.com")
                ->contactPoint([Schema::ContactPoint()
                ->telephone('+254724351952')
                ->email('magnificcoding@gmail.com')]);
        echo $about->toScript();

        $data = array(
            'title' => $title,
        );

        return view('user.about',$data);
    }

    public function policy()
    {
        return view('user.policy');
    }
}
