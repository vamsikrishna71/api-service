<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryRequest;
use App\Models\Category;
use Sentry;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('created_at', 'desc')->paginate();
        return view('pages.subcategory.index',compact('subcategories'))->with('i',(request()
        ->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('status',true)->get();
        return view('pages.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();
            $subcategories = Subcategory::create($validatedData);
            DB::commit();
            if($subcategories){
                session()->flash('status','Subcategory created successfully.');
                return redirect()->route('subcategory.index');
            }else{
                session()->flash('status','failed to add new Subcategory');
                return back();
            }
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
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
        try {
            DB::beginTransaction();
            $categories = Category::all();
            $subcategory= Subcategory::findorfail($id);
            DB::commit();
            return view('pages.subcategory.edit', compact('subcategory','categories'));
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $Subcategory = Subcategory::findOrFail($id);
            $validatedData = $request->validated();
            $Subcategory->update($validatedData);
            DB::commit();
            session()->flash('status','Subcategory updated successfully.');
            return redirect()->route('subcategory.index');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Subcategory::findorfail($id)->delete();
            DB::commit();
            session()->flash('status','Subcategory deleted successfully.');
            return back();
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }

    /**
     * API getByCategory
     * API Get subcategories by category. This is used to generate links to other   categories
     * @param  mixed $category
     * @return json
     */
    public function getByCategory(Category $category){
        $subcategories = $category->subcategories;
        return response()->json($subcategories);
    }

    /**
     * API getSubCategory
     * API Get a subcategory by id. This is a wrapper for the parent class
     * @param  mixed $id
     * @return json
     */
    public function getSubCategory($id){
        return Subcategory::findOrFail($id);
    }

    /**
     * API getSubcategoriesByCategory
     * API Get subcategories by category. This is used to generate ajax calls to get all subcategories
     * @return json
     */
    public function getSubcategoriesByCategory(){
        $subcategories = Category::with('subcategories')->distinct()->get();
        return response()->json($subcategories);
    }

}
