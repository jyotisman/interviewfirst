<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::all()->toArray();
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'coinname' => 'required',
          'coinprice'=> 'required|numeric',
        ]); 
        
        $form= new Form();
        $form->coinname=$request->get('coinname');
        $form->coinprice=$request->get('coinprice');
        $checkbox = implode(",", $request->get('option'));
        $form->dropdown=$request->get('dropdown');
        $form->radio=$request->get('radio');
        $form->checkbox = $checkbox; 
        $form->save();
        return redirect('forms')->with('success', 'Coin has been added');
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
    public function edit($id)
    {
        $form = Form::find($id);
        return view('forms.edit',compact('form','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $request->validate([
          'coinname' => 'required',
          'coinprice'=> 'required|numeric',
        ]); 
        $form = Form::find($id);
        $form->coinname=$request->get('coinname');
        $form->coinprice=$request->get('coinprice');
        $checkbox = implode(",", $request->get('option'));
        $form->dropdown=$request->get('dropdown');
        $form->radio=$request->get('radio');
        $form->checkbox = $checkbox; 
        $form->save();
        return redirect('forms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = form::find($id);
        $form->delete();
        return redirect('forms')->with('success','Coin has been  deleted');
    }
}
