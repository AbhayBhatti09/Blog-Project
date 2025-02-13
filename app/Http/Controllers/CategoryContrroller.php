<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryContrroller extends Controller
{
    public function index(){
        $Categories=category::latest()->paginate(10);
        return view('category.index',compact('Categories'));
    }
    //create category form
    public function create(){
        return view('category.create');
    }
    
    //store
    public function store(request $request){
        //dd($request->all());
        $request->validate([
            'name'=>'required|unique:category'
        ]);

        $Category=new Category();
        $Category->name=$request->name;
        $date=now();
       // dd($date);
        $Category->save();

        return redirect('category')->with('success','New Category Added');

    }
    //edit view
    public function edit($id){
        $Category=Category::find($id);

        return view('category.edit',compact('Category'));
       // dd($Category);
       // dd($id);
    }
    //update 
    public function update($id,request $request){
       // dd($request->all());
       // dd($id);
       $request->validate([
        'name'=>'required'
       ]);
       $Category = Category::where('id', $id)->update(['name' => $request->name]);

       return redirect('category')->with('success','category Updated');
    }

    //delete category
    public function delete($id){
      //  dd($id);
      $Category=Category::find($id);
      $Category->delete();
      
      return redirect('category')->with('success','Category deleted ');
    }
}
