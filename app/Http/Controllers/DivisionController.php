<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
// Remove files from storage
use Illuminate\Support\Facades\Storage;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['divisiados'] = Division::paginate(10);
        return view('divisiado.divisi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisiado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field validation
        $fields = [
            'name'=>'required|string|max:50',
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        $this->validate($request, $fields, $messages);

        // Get all the data except token
        $divisionData = [
            'nameDivision' => $request->input('name')
        ];

        // Insert the record in the database
        Division::insert($divisionData);
        return redirect('division')->with('message', 'Division created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        // FindOrFail finds a record from DB
        $division = Division::findOrFail($id);
        // Compact allows to pass an object to a view
        return view('divisiado.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // Field validation
        $fields = [
            'name'=>'required|string|max:50',
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        $this->validate($request, $fields, $messages);

        $divisionData = [
            'nameDivision' => $request->input('name')
        ];
        // Update the record in the database
        Division::where('idDivision','=',$id)->update($divisionData);
        return redirect('division')->with('message', 'Division updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // Find the Division in DB
        $division = Division::findOrFail($id);
        return redirect('division')->with('message', 'Division removed successfully!');
    }
}
