<?php

namespace App\Http\Controllers;

use App\PayMethod;
use Illuminate\Http\Request;

class PayMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pay_methods_ = PayMethod::paginate(100);

        return view('PayMethods.index', compact('pay_methods_'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'Создать';

        return view('PayMethods.create_or_update', compact('action'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PayMethod::create($request->toArray());

        return redirect()->route('pay_methods.index');   
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PayMethod $pay_method)
    {
        $action = 'Редактировать';

        return view('PayMethods.create_or_update', compact('action', 'pay_method'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayMethod $pay_method)
    {
        
        $pay_method->update($request->toArray());

        return redirect()->route('pay_methods.index');


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
