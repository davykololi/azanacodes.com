<?php

namespace App\Http\Controllers;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
            $websiteName = config('app.name');
            $title = 'Home';
            $desc = 'The platform for laravel, vue js, react js, tailwind css and bootstrap tutorials and other latest programming online tutorials';
            $keywords = 'react js tutorials, vue js tutorials, laravel tutorials,tailwind css tutorials, programming tutorials';
            $url = URL::current();
            $tel = '+254724351952';
            $logo = 'https://magnificcoding.com/static/logo.jpg';

            SEOMeta::setTitle($title);
            SEOMeta::setDescription($desc);
            SEOMeta::setCanonical($url);

            OpenGraph::setTitle($title);
            OpenGraph::setDescription($desc);
            OpenGraph::setUrl($url);
            OpenGraph::addProperty('type','Website');
            OpenGraph::addProperty('locale','en-US');

            Twitter::setTitle($title);
            Twitter::setSite('@magnificcoding');
            Twitter::setDescription($desc);
            Twitter::setUrl($url);

            JsonLd::setTitle($title);
            JsonLd::setDescription($desc);
            JsonLd::setType('Website');
            JsonLd::addImage($logo);

            $webSite = Schema::Organization()
                    ->name($websiteName)
                    ->headline($title)
                    ->description($desc)
                    ->keywords($keywords)
                    ->email('magnificcoding@.com')
                    ->url($url)
                    ->contactPoint(Schema::ContactPoint()->telephone($tel)->areaServed('Worldwide'))
                    ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('688'))
                    ->sameAS("http://www.magnificcoding.com")
                    ->logo(Schema::ImageObject()->url($logo));
                
            echo $webSite->toScript();

        return view('home');
    }
}
