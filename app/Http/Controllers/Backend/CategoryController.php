<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function AllCategory(): View
    {

        $categories = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('categories'));
    }

    public function AddCategory(): View
    {
        return view('admin.backend.category.add_category');
    }

}
