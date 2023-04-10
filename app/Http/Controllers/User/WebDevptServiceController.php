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

class WebDevptServiceController extends Controller
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
        $websiteName = config('app.name');
        $title = 'Magnific Coding Website Development Services';
        $service = 'Website Development Services';
        $desc = 'The website development services offered at Magnific Coding Kenya Limited';
        $keywords = 'web development services, website development services, web design and development services, web design and development in Kenya, web design services, web design, web development';
        $url = URL::current();
        $tel = '+254 724351952';
        $logo = 'https://www.magnificcoding.com/static/logo.jpg';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($desc);
        SEOMeta::setCanonical($url);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($desc);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type','Service');
        OpenGraph::addProperty('locale','en-US');

        Twitter::setTitle($title);
        Twitter::setSite('@CodingMagnific');
        Twitter::setDescription($desc);
        Twitter::setUrl($url);

        JsonLd::setTitle($title);
        JsonLd::setDescription($desc);
        JsonLd::setType('Service');
        JsonLd::addImage($logo);

        $back = Schema::Service()
                ->name($service)
                ->headline($title)
                ->description($desc)
                ->keywords($keywords)
                ->email('magnificcoding@gmail.com')
                ->url($url)
                ->contactPoint(Schema::ContactPoint()->telephone($tel)->areaServed('Worldwide'))
                ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('5200'))
                ->sameAS("https://www.magnificcoding.com")
                ->logo(Schema::ImageObject()->url($logo));
                
        echo $back->toScript();

        return view('user.services.web_devpt_service');
    }
}
