<?php

namespace App\Http\Controllers\Dashboard;

use App\Medicine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

		return view('medicines.index', [
			'medicines' => $medicines
		]);
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

		return redirect()->route('dashboard.medicines.index');
    }
}