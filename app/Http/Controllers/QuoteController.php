<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Category;
use Sentry;
use App\Models\SubCategory;
use App\Imports\QuoteImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\QuoteDataRequest;

class QuoteController extends Controller
{

    /**
    * Invoke the middleware and return the response to the client. This is called by __invoke () and should not be called directly
    */
    public function __invoke()
    {
        $this->middleware('auth');
    }



    /**
    * Display a listing of the Quote. GET / quotes?page = 1&limit = 5. Requires authentication.
    *
    *
    * @return View to display the list of quotes and pagination information for the user to navigate to the next page of the
    */
    public function index()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->paginate();
        return view('pages.quote.index',compact('quotes'))->with('i',(request()
        ->input('page', 1) - 1) * 5);
    }



    /**
    * Show the form for creating a new quote. This is a view that allows the user to create a quote in the admin.
    *
    * @param $request
    *
    * @return view to show to the user with the form to create a quote in the admin. Empty if there is no form
    */
    public function create(Request $request)
    {
        $categories = Category::where('status',true)->get();
        $subcategories = SubCategory::all();
        return view('pages.quote.create',
        compact('categories','subcategories'));
    }



    /**
    * Store a newly created quote in storage. POST / quote / { id }. If success redirect to quote index else redirect to error.
    *
    * @param $request
    *
    * @return Return object representing success or failure of the operation. Redirect to quote index if successfull or to error
    */
    public function store(QuoteDataRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $quotes= Quote::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name' => $request->name,
            ]);
            DB::commit();
            // Add a new quote to the quote list.
            if($quotes){
                session()->flash('status', "New quote added");
                return redirect()->route('quote.index');
            }else{
                session()->flash('status', "Something went wrong!");
                return back();
            }
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }



    /**
    * Display the specified resource. GET / quotes / { id }. Produces JSON with true or false on success or failure.
    *
    * @param $id
    *
    * @return JSON with true or false on success or failure. Example : 1. Request : GET / quotes / { id
    */
    public function show($id)
    {
        //
        $quote = Quote::findOrFail($id);
        return response()->json(['data'=>$quote]);
    }



    /**
    * Show the form for editing the specified quote. This is the view used to edit a quote. If you want to add a new quote use the add () method
    *
    * @param $id
    *
    * @return view that renders the quote edit form or redirect to the quote edit page if there is an error
    */
    public function edit($id)
    {
        try {
            DB::beginTransaction();
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $quote = Quote::findOrFail($id);
            DB::commit();
            return view('pages.quote.edit',compact('categories','subcategories','quote'));
        } catch(\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }

    }



    /**
    * Update the quote in the database. This is a web service that allows you to update the quote in the database.
    *
    * @param $request
    * @param $id
    *
    * @return response containing the success or failure of the update operation. If the update was successful the response will contain the status code
    */
    public function update(QuoteDataRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $quote = Quote::findOrFail($id);
            $validatedData = $request->validated();
            $quote->update($validatedData);
            DB::commit();
            return redirect()->route('quote.index')
                ->with('success', 'Quote updated successfully.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }



    /**
    * Remove the specified Quote from storage. DELETE / quote / { id }. Safety : Destroy does not check permissions.
    *
    * @param $id
    *
    * @return Redirects on successful deletion renders view otherwise ( HTTP 404 ) and prints error message to view. This is because we need to know if the Quote is in use
    */
    public function destroy($id){
        try {
            DB::beginTransaction();
            Quote::findorfail($id)->delete();
            DB::commit();
            session()->flash('status','Quote deleted successfully.');
            return redirect()->route('quote.index');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }



    /**
    * View for importing quote data. This is a shortcut for view ('pages. quote. import').
    *
    *
    * @return quote import view to display in the admin interface or false if there is no view to display for the user
    */
    public function importView(){

        return view('pages.quote.import');
    }



    /**
    * Import quotes from Excel file. This will be used by ajax requests and the user will be redirected to quote index
    *
    * @param $request
    *
    * @return View to display the import results or redirect to quote index if there is an error. Redirects to the
    */
    public function import(Request $request) {
        try {
            DB::beginTransaction();
            $request->validate([
                'file' => 'required',
            ]);

            Excel::import(new QuoteImport, request()->file('file'));
            DB::commit();
            session()->flash('status','Quotes Imported successfully.');
            return redirect()->route('quote.index');
        }  catch (\Throwable $exception) {
            DB::rollBack();
            Sentry::captureException($exception);
            return back();
        }
    }



    /**
    * Get all quotes in the database. This is a shortcut for \ Doctrine \ ORM \ Query :: select ().
    *
    *
    * @return set of all quotes in the database that have been marked as " active " ( true ) or " not
    */
    public function getOnlyQuotes() {

        return Quote::select('name')->get();
    }


    /**
    * Get all quotes for the authenticated user. Response will be JSON with one row per quote. This method is used by ajax calls to get all quotes for the authenticated user.
    *
    *
    * @return JSON object with one row per quote or an error message if there was a problem with the quotes
    */
    public function getQuotes(){

        $categories = Category::with('subcategories.quotes')
                    ->distinct()
                    ->get();
        return response()->json([
            'Quotes' => $categories
        ],200);

    }



    /**
    * Get the quote that should be shown. This is a wrapper around Quote :: findOrfail ().
    *
    * @param $id
    *
    * @return The quote that should be shown or false if not found or not showing is disabled by the user ( for example if there is no quote
    */
    public function getShowQuote($id){

        return Quote::findOrfail($id);
    }



    /**
    * Get all quotes by category and subcategory names. This is used to show a list of all quotes in the database.
    *
    *
    * @return JSON with data on success or error message on failure. Note : the response is json but not json
    */
    public function getQuoteByNames(){
        $categories    = Quote::select('category_id')
                        ->with('category')
                        ->distinct()
                        ->get();
        $subcategories = Quote::select('subcategory_id')
                        ->with('subcategory')
                        ->distinct()
                        ->get();

        return response()->json([
            'categories_data'    => $categories,
            'subcategories_data' => $subcategories,
        ],200);
    }



    /**
    * Get quotes with month. This method is used to get all quotes with month. Example URL : / api / v1 / quotes?month = 2023&year = 2023&month = 6
    *
    *
    * @return Response with json object with quotes in array. Example Response : Status code 200 OK Response : Data is returned in json
    */
    public function getQuotesWithMonth(){
        $quotes = new Quote();
        $year = 2023;
        $month = 6;
        $results = $quotes->getQuotesByMonth($year, $month);
        return response()->json($results,200);
    }

    /**
    * Get Quotes by Date ( API v1. 0 ). This function is used to get all quotes for a date.
    *
    *
    * @return JSON with data in data key " data " is an array of quotes and data is true if quotes
    */
    public function getQuotesByDate(){
        $quotes = new Quote();
        $date = "29";
        $results = $quotes->getQuotesDay( $date);
        return response()->json(["data" => $results
        ],200);
    }
}
