<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::latest()->paginate(5);
        $trashedCategories=Category::onlyTrashed()->latest()->paginate(5);
        return view("admin.category.index",compact("categories","trashedCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        
        $category=new Category;
        $category->name=$request->name;
        $category->user_id=Auth::user()->id;
        $category->save();

        return Redirect()->back()->with("success","Category created successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view("admin.category.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        Category::find($id)->update([
            "name"=>$request->name
        ]);
        return Redirect()->route("categories.index")->with("success","Category updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function softDelete($id){
        $category = Category::find($id);
        $category->delete();
        return Redirect()->route("categories.index")->with("success","Category has been trashed successfully!");
    }
    public function restore($id){
        $category = Category::withTrashed()->find($id);
        $category->restore();
        return Redirect()->route("categories.index")->with("success","Category has been restored successfully!");
    }
    public function permanentDelete($id){
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return Redirect()->route("categories.index")->with("success","Category deleted permanently!");
    }
}
