<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Column::all()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required'
        ]);

        $column = Column::create($request->all());

        $column->state()->create([]);

        return $column;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function show(Column $column)
    {
        //
        $cards = $column->cards;
        $cardStates = $column->state->column_state;

        $data = [
            'cards' => $cards,
            'state' => json_decode($cardStates),
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function edit(Column $column)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Column $column)
    {
        //
        $update = $column->update($request->toArray());

        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function destroy(Column $column)
    {
        //
        $column->delete();

        return response()->json("ok");
    }

    public function columnCards(Column $column) {

        $cards = $column->cards;

        return response()->json($cards);
    }

    public function saveState(Request $request) {

        $stateCollection = collect($request->toArray());
        $column = $stateCollection->pluck('column')->first();
        $ordering = $stateCollection->pluck('cardIndex');

        $successSaved = Column::find($column)->state->update([
            'column_state' => json_encode($ordering)
        ]);

        return response()->json($successSaved);
    }
}
