<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Intervention\Image\ImageManager;

class CategoryController extends Controller
{

    public function AllCategory(): View
    {

        $categories = Category::all();
        return view('admin.backend.category.all_category', compact('categories'));
    }

    public function AddCategory(): View
    {
        return view('admin.backend.category.add_category');
    }

    public function StoreCategory (Request $request) {

        $image = $request->file('image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $imageUrl = 'upload/category/'.$imageName;
        ImageManager::gd()->read($image)->resize(370, 246)->save($imageUrl);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '_', $request->category_name));
        $category->image = $imageUrl;
        $category->save();
        $notification = [
            'message' => 'Category created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);

    }

}
