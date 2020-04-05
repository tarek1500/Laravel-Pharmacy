<?php

namespace App\Http\Controllers\Dashboard;

use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$areas = Area::all();

		return view('areas.index', [
			'areas' => $areas
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		Area::create([
			'name' => $request->name,
			'address' => $request->address
		]);

		return redirect()->route('dashboard.areas.index');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  Area  $area
	 * @return \Illuminate\Http\Response
	 */
    public function show(Area $area)
    {
		return view('areas.show', [
			'area' => $area
		]);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Area  $area
	 * @return \Illuminate\Http\Response
	 */
    public function edit(Area $area)
    {
		return view('areas.edit', [
			'area' => $area
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  Area  $area
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, Area $area)
    {
		$area->update([
			'name' => $request->name,
			'address' => $request->address
		]);

		return redirect()->route('dashboard.areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
		$area->delete();

		return redirect()->route('dashboard.areas.index');
    }
}