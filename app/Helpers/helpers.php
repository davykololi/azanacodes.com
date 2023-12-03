<?php

use App\Models\Category;

function categories()
{
	return Category::eagerLoaded()->whereIn('name',['Laravel','React Js','Tailwind Css','Vue Js'])->limit(10)->get();
}

function footer_categories()
{
	return Category::eagerLoaded()->whereIn('name',['Laravel','React Js','Tailwind Css','Vue Js'])->get();
}

function addWwwToUrl($url) {

   $bits = parse_url($url);

   $newHost = substr($bits["host"],0,4) !== "www." ? "www." . $bits["host"] : $bits["host"];

   $newUrl = $bits["scheme"]. "://" . $newHost . (isset($bits["port"]) ? ":" . $bits["port"] : "" ) . (isset($bits["path"]) ? $bits["path"] : "" ) . (!empty($bits["query"])? "?" . $bits["query"]: "");

   return $newUrl;
}
