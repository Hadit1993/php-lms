<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
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

    public function EditCategory($id) {

        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request, $id) {
        $category = Category::find($id);
        if($request->file('image')) {
            $image = $request->file('image');
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $imageUrl = 'upload/category/'.$imageName;
            ImageManager::gd()->read($image)->resize(370, 246)->save($imageUrl);
            @unlink(public_path($category->image));
            $category->image = $imageUrl;
        }

        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '_', $request->category_name));
        $category->save();

        $notification = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);

    }

    public function DeleteCategory ($id) {
        $category = Category::find($id);
        @unlink(public_path($category->image));
        $category->delete();
        $notification = [
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function AllSubCategory() {
        $subCategories = SubCategory::all();
        return view('admin.backend.subcategory.all_subcategory', compact('subCategories'));
    }

    public function AddSubCategory() {
        $categories = Category::all();
        return view('admin.backend.subcategory.add_subcategory', compact('categories'));
    }

    public function StoreSubCategory(Request $request) {
       
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = $request->subcategory_name;
        $subCategory->subcategory_slug = strtolower(str_replace(' ', '_', $request->subcategory_name));
        $subCategory->save();
        $notification = [
            'message' => 'SubCategory created successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function EditSubCategory($id) {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);
        return view('admin.backend.subcategory.edit_subcategory', compact('subCategory', 'categories'));
    }

    public function UpdateSubCategory(Request $request, $id) {
        $subCategory = SubCategory::find($id);
       

        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = $request->subcategory_name;
        $subCategory->subcategory_slug = strtolower(str_replace(' ', '_', $request->subcategory_name));
        $subCategory->save();

        $notification = [
            'message' => 'SubCategory updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);

    }

    public function DeleteSubCategory ($id) {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        $notification = [
            'message' => 'SubCategory deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    

}
