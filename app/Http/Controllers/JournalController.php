<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$date)
    {
         // Retrieve the content from the request
        $text = $request->input('text');
        $html = $request->input('html');
        $image = $request->file('image');

        // Create a new DateContent model and save the content
        $dateContent = new Journal();
        $dateContent->date = $date;
        $dateContent->text = $text;
        $dateContent->html = $html;

        // Handle image upload
        if ($image) {
            $imagePath = $image->store('images', 'public');
            $dateContent->image = $imagePath;
        }

        $dateContent->save();

        return response()->json(['message' => 'Content added successfully']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date, $id)
    {
        // Retrieve the content from the request
        $text = $request->input('text');
        $html = $request->input('html');
        $image = $request->file('image');

        // Find the DateContent model by ID
        $dateContent = Journal::findOrFail($id);
        $dateContent->date = $date;
        $dateContent->text = $text;
        $dateContent->html = $html;

        // Handle image upload
        if ($image) {
            $imagePath = $image->store('images', 'public');
            $dateContent->image = $imagePath;
        }

        $dateContent->save();

        return response()->json(['message' => 'Content updated successfully']);

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
}
