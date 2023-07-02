<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;

class CategoryController extends Controller {
    /**
     * @throws Exception
     */
    public function getPostsByCategory( $id ) {
        $category      = Category::findOrFail( $id );
        $categoryName  = $category->name;
        $categoryID    = $category->id;
        $category_data = $category->posts;
        $latestPost    = $category->latestPost;

        return view( 'category',
            [ 'categories' => $category_data, 'categoryName' => $categoryName, 'categoryID' => $categoryID, 'latestPost' => $latestPost ] );
    }
}
