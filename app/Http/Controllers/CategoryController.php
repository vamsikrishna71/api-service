<?php

namespace App\Http\Controllers;

use Sentry;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    /**
    * Invoke the middleware and return the response to the client. This is called by __invoke () and should not be called directly
    */
    public function __invoke()
    {
        $this->middleware('auth');
    }


    /**
    * Display a listing of categories. This is the default action for this controller. You can override this method to customize the behavior.
    *
    *
    * @return View to display the categories list and paginate the categories in alphabetical order by created_at timestamp. Show 5 categories per page
    */
    public function index()
    {
        //
        $categories = Category::orderBy('created_at', 'desc')->paginate();
        return view('pages.category.index',compact('categories'))->with('i',(request()
        ->input('page', 1) - 1) * 5);

    }


    /**
    * Show the form for creating a new category. GET / pages / categories / { id }. View category view to create a new category.
    *
    *
    * @return View for creating a category with id = $id and name = $name or view to edit it
    */
    public function create()
    {
        //
        return view('pages.category.create');

    }


    /**
    * Store a newly created category in storage. POST / categories. If success return the index page. If failure return back to index
    *
    * @param $request
    *
    * @return Redirect to index page or back to index if failed to create a category in storage ( 404 not found
    */
    public function store(CategoryRequest $request)
    {
        // dd($request->input());
        //
        try{
            DB::beginTransaction();
            $validatedData = $request->validated();
            Category::create($validatedData);
            DB::commit();
            session()->flash('status', 'Category created successfully');
            return redirect()->route('category.index');
        }catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }

    }


    /**
    * Display the specified resource. GET / pages / { id } / categories / { id }. View categories
    *
    * @param $id
    *
    * @return $categories The categories that match the request. GET / pages / { id } / categories / { id
    */
    public function show($id)
    {
        //
        $categories = Category::where('status',true)->get();
        return view('pages.category.show',compact('categories'))->with('i');
    }


    /**
    * Show the form for editing the specified category. GET / categories / { id } / edit. html
    *
    * @param $id
    *
    * @return category view with the details of the category or the slug of the category if it doesn't exist
    */
    public function edit($id)
    {
        try{
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            DB::commit();
            return view('pages.category.edit', compact('category'));
        }catch(\Throwable $exception){
            DB::rollBack();
            \Log::error("Error updating category with ID {$id}: ". $exception->getMessage());
            Sentry::captureException($exception);
        }

    }


    /**
    * Update the specified category in storage. This will overwrite any existing data if the name is changed. If you want to update a category without having to check the existence of the parent use $this - > check ()
    *
    * @param $request
    * @param $id
    *
    * @return View to display
    */
    public function update(CategoryRequest $request, $id)
    {
    try {
        DB::beginTransaction();
        $category = Category::findOrFail($id);
        $validatedData = $request->validated();
        $category->update($validatedData);
        DB::commit();
        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully.');
    } catch(\Throwable $exception) {
        DB::rollback();
        \Log::error("Error updating category with ID {$id}: ". $exception->getMessage());
        Sentry::captureException($exception);
        return back();
    }
}


    /**
    * Updates the status of a category. This is a controller action and should be used as a before / after filter
    *
    * @param $id
    *
    * @return Redirect to the success page with the status updated or error message if something went wrong. The status is toggled by 1
    */
    public function updateStatus($id)
    {
        try {
            DB::beginTransaction();
            // dd($request->input('status'));
            $category = Category::findOrFail($id);
            $category->status = !$category->status;
            $category->save();
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
        }

    }


    /**
    * Remove the specified resource from storage. DELETE / categories / { id }. Default action is DELETE.
    *
    * @param $id
    *
    * @return JSON representation of the deleted resource on success or false on failure. Note : this does not delete the resource in storage
    */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Category::findOrfail($id)->delete();
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Deleted Successfully.');
        } catch(\Exception $e) {
            DB::rollBack();
            \Log::error("Error deleting a record".$e->getMessage());
        }
    }


    /**
    * Get all categories from database. This is used to show all categories in admin panel. The response is JSON with a status of 200 on success.
    *
    *
    * @return $categories Response with status of 200 on success and error message on failure. Note : this method does not return anything
    */
    public function getCategory(){
        $categories = Category::all();
        return response()->json($categories);
    }


    /**
    * Returns the category that should be shown. This is used by ajax to show a category. If you don't want to show it return null
    *
    * @param $id
    *
    * @return category that should be
    */
    public function getShowCategory($id){
        return Category::findOrFail($id);
    }


    /**
    * Get subcategories by category. This is used to show all subcategories of a category. The response is a JSON array with one key'subcategories'which is a set of Category objects.
    *
    * @param $id
    *
    * @return JSON array with one key'subcategories'which is a set of Category objects or false if no category with that ID
    */
    public function getShowSubcategoriesByCategory($id){
        $subcategories = Category::with('subcategories')->distinct()->findOrfail($id);
        return response()->json($subcategories);
    }
}
