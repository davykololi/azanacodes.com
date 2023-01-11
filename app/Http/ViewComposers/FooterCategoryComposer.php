<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class FooterCategoryComposer 
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */

    public function compose(View $view){
        $footerCategories = footer_categories();
        $view->with(['footerCategories'=>$footerCategories]); 
    }
}
