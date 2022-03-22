<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::latest()->paginate(5);
        return view("admin.brand.index",compact("brands"));
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
            'name' => 'required|unique:brands|max:255',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $imgName=time().'.'.$request->image->extension();
        $uploadLocation="images/uploads/brand/";
        // $request->image->move(public_path("images/uploads/brand"),$imgName);
        Image::make($request->image)->resize(300,200)->save($uploadLocation.$imgName);
        $brand=new Brand;
        $brand->name=$request->name;
        $brand->image=$uploadLocation.$imgName;
        $brand->save();

        return Redirect()->back()->with("success","Brand created successfully!");
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
        $brand=Brand::find($id);
        return view("admin.brand.edit",compact("brand"));
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
            'name' => 'required|max:255',
        ]);
        if($request->image){
            unlink($request->oldImage);
            $imgName=time().'.'.$request->image->extension();
            $uploadLocation="images/uploads/brand/";
            $request->image->move(public_path("images/uploads/brand"),$imgName);
            Brand::find($id)->update([
                "name"=>$request->name,
                "image"=>$uploadLocation.$imgName
            ]);
        }else{
            Brand::find($id)->update([
                "name"=>$request->name,
            ]);
        }
        return Redirect()->route("brands.index")->with("success","Brand updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBrand($id)
    {
        $brand = Brand::find($id);
        unlink($brand->image);
        $brand->delete();
        return Redirect()->route("brands.index")->with("success","Brand deleted permanently!");
    }
}
