<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void{
    $trail->push('Home', route('home'),['image'=>URL::secureAsset('/static/logo.png')]);
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Blog', route('blog'),['image'=>URL::secureAsset('/assets/img/logo.png')]);
});

// Editor Dashboard
Breadcrumbs::for('editor.dashboard', function (BreadcrumbTrail $trail): void{
    $trail->push('Editor', route('editor.dashboard'));
});

// Author Dashboard
Breadcrumbs::for('author.dashboard', function (BreadcrumbTrail $trail): void{
    $trail->push('Author', route('author.dashboard'));
});

// Home > About
Breadcrumbs::for('about', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('About Us', route('about'),['image'=>URL::secureAsset('/assets/img/about.jpg')]);
});

// Home > Contact
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Contact Us', route('contact'));
});

// Home > Portfolio
Breadcrumbs::for('portfolio', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Portfolio', route('portfolio'));
});

// Home > Private Policy
Breadcrumbs::for('policy', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Private Policy', route('policy'));
});

// Home > Terms Of Service
Breadcrumbs::for('terms.of.service', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Terms Of Service', route('terms.of.service'));
});

// Home > SEO Route
Breadcrumbs::for('services.seo', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Search Engine Optimization Services', route('services.seo'));
});

// Home > Tailwind Css Route
Breadcrumbs::for('services.tailwindcss', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Tailwind Css Services', route('services.tailwindcss'));
});

// Home > Backend Programming Route
Breadcrumbs::for('services.backend', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Backend Programming', route('services.backend'));
});

// Home > Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

// Home > Register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

// Home > Change Password
Breadcrumbs::for('visitor.change.password', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push('Change Password', route('visitor.change.password'));
});

// Home > User Profile
Breadcrumbs::for('visitor.profile', function (BreadcrumbTrail $trail): void{
    $trail->parent('home');
    $trail->push(auth()->user()->name." ".'Profile', route('visitor.profile'));
});

// Home > Author Profile
Breadcrumbs::for('author.profile', function (BreadcrumbTrail $trail): void{
    $trail->parent('author.dashboard');
    $trail->push(auth()->user()->name." ".'Profile', route('author.profile'));
});

// Home > Editor Profile
Breadcrumbs::for('editor.profile', function (BreadcrumbTrail $trail): void{
    $trail->parent('editor.dashboard');
    $trail->push(auth()->user()->name." ".'Profile', route('editor.profile'));
});
// Home > Category 
Breadcrumbs::for('category.articles', function (BreadcrumbTrail $trail, Category $category): void{
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
    $trail->push($category->name, route('category.articles',['slug'=>$category->slug]));  
});

// Home > Tag
Breadcrumbs::for('tag.articles', function (BreadcrumbTrail $trail, Tag $tag): void{
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
    $trail->push($tag->name, route('tag.articles',['slug'=>$tag->slug]));
});

// Home > Author
Breadcrumbs::for('articleBy.articles', function (BreadcrumbTrail $trail, User $author): void{
    $trail->parent('home');
    $trail->push($author->name.' '.'Articles', route('articleBy.articles',['slug'=>$author->slug]));
});

// Home > Category > Article Details
Breadcrumbs::for('article.details', function (BreadcrumbTrail $trail, Article $article): void{
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
    $trail->push($article->category->name, route('category.articles',['slug'=>$article->category->slug]));
    $trail->push($article->title, route('article.details',['slug'=>$article->slug]),['image'=>URL::secureAsset('/storage/storage/'.$article->image)]);
});
