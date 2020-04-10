<?php

namespace App\Http\Controllers\Dashboard;

use App\Medicine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$medicines = Medicine::all();
		if(request()->ajax())
        {
            return DataTables::of($medicines)->addColumn('action',function($medicine){
              
                $button = '<a type="button" name="show" href=" /dashboard/medicines/'.$medicine->id.'" id="'.$medicine->id.'" class="btn btn-success"><i class="fa fa-eye"></i></a>';
                $button .= '<a type="button" name="edit" href=" /dashboard/medicines/'.$medicine->id.'/edit" id="'.$medicine->id.'" class="btn btn-primary" ><i class="fas fa-edit"></i></a>';
                $button .= '<button type="button" name="delete" onclick="deleteMedicine('.$medicine->id.')" id="'.$medicine->id.'" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                
            })->rawColumns(['action'])
                 ->make(true);
        }
        return view('medicines.index');

	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		Medicine::create([
			'name' => $request->name,
			'address' => $request->address
		]);

		return redirect()->route('dashboard.medicines.index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  Medicine  $medicine
	 * @return \Illuminate\Http\Response
	 */
    public function show(Medicine $medicine)
    {
		return view('medicines.show', [
			'medicine' => $medicine
		]);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Medicine  $medicine
	 * @return \Illuminate\Http\Response
	 */
    public function edit(Medicine $medicine)
    {
		return view('medicines.edit', [
			'medicine' => $medicine
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  Medicine  $medicine
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, Medicine $medicine)
    {
		$medicine->update([
			'name' => $request->name,
			'address' => $request->address
		]);

		return redirect()->route('dashboard.medicines.index');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Medicine  $medicine
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(Medicine $medicine)
    {
  		$medicine->delete();
    }
}