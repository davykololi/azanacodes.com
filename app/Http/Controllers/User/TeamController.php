<?php

namespace App\Http\Controllers\User;

use SEOMeta;
use OpenGraph;
use Twitter;
use JsonLd;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //Team Dashboard
        $websiteName = config('app.name');
        $title = 'Magnific Coding Team';
        $desc = 'The team behind all services offered at Magnific Coding';
        $keywords = 'team, working team, programming team, web development team, web design team, management team, magnific coding team';
        $url = URL::current();
        $tel = '+254 724351952';
        $logo = 'https://www.magnificcoding.com/static/logo.jpg';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','Team');
        OpenGraph::addProperty('locale','en-US');

        Twitter::setTitle($title);
        Twitter::setSite('@CodingMagnific');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('Team');
        JsonLd::addImage($logo);

        $schema = Schema::Organization()
                ->name($title)
                ->description($desc)
                ->keywords($keywords)
                ->email('magnificcoding@gmail.com')
                ->url($url)
                ->contactPoint(Schema::ContactPoint()->telephone($tel)->areaServed('Worldwide'))
                ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('5200'))
                ->sameAS("https://www.magnificcoding.com")
                ->logo(Schema::ImageObject()->url($logo));
                
        echo $schema->toScript();

        return view('user.team.team_dashboard');
    }
}
