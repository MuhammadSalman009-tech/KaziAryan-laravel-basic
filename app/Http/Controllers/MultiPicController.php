<?php

namespace App\Http\Controllers;

use App\Models\MultiPic;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MultiPicController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $MultiPics=MultiPic::all();
        return view("admin.multi-pic.index",compact("MultiPics"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach($request->images as $image){
            $imgName=hexdec(uniqid()).'.'.$image->extension();
        $uploadLocation="images/uploads/multi-pics/";
        Image::make($image)->resize(300,300)->save($uploadLocation.$imgName);
        $MultiPic=new MultiPic();
        $MultiPic->image=$uploadLocation.$imgName;
        $MultiPic->save();
        }

        return Redirect()->back()->with("success","Multi Pics created successfully!");
    }
}
