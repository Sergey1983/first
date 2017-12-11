<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\Request;

class OperatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $operators = Operator::paginate(50);

        return view('Operators.index', compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'Создать';

        return view('Operators.create_or_update', compact('action'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Operator::create($request->toArray());

        return redirect()->route('operators.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show(Operator $operator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function edit(Operator $operator)
    {
        $action = 'Редактировать';

        return view('Operators.create_or_update', compact('action', 'operator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operator $operator)
    {
        $operator->update($request->toArray());

        return redirect()->route('operators.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operator $operator)
    {
        //
    }
}
