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
