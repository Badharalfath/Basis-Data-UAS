<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Empleado;
use Illuminate\Http\Request;
// Remove files from storage
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['empleados'] = Empleado::paginate(10);
        return view('empleado.main', $data);
    }

    public function viewEmployee()
    {
        $data['empleados'] = Empleado::join('division', 'division.idDivision', '=', 'empleados.idDivision')->paginate(10);
        return view('empleado.employee', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['division'] = Division::get();
        return view('empleado.create', $data);
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
            'lastname'=>'required|string|max:50',
            'email'=>'required|email',
            'phone'=>'required|string|max:20',
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        $this->validate($request, $fields, $messages);

        // Get all the data except token
        $empleadoData = request()->except('_token');

        // Insert the record in the database
        Empleado::insert($empleadoData);
        return redirect('employee')->with('message', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        // FindOrFail finds a record from DB
        $data['empleado'] = Empleado::findOrFail($id);
        $data['division'] = Division::get();

        // Compact allows to pass an object to a view
        return view('empleado.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // Field validation
        $fields = [
            'name'=>'required|string|max:50',
            'lastname'=>'required|string|max:50',
            'email'=>'required|email',
            'phone'=>'required|string|max:20',
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        $this->validate($request, $fields, $messages);

        // Get all the data except token and method
        $empleadoData = request()->except('_token', '_method');
        // Check if the field Picture has an image
        Empleado::where('id','=',$id)->update($empleadoData);
        return redirect('empleado')->with('message', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // Find the employee in DB
        $empleado = Empleado::findOrFail($id);
        // Remove their picture from storage
        if (Storage::delete('public/'.$empleado->picture)) {
            // Once the picture is deleted, remove employee from DB
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('message', 'Employee removed successfully!');
    }
}
