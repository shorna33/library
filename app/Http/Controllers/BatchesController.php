<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\Student;

class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::orderBy('title', 'desc')->paginate(5);

        return view('batches.index')->with('batches', $batches);
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
        $this->validate($request,[
            'batch' => 'required',
            'program' => 'required'
        ]);

        $batch = new Batch;
        $batch->title = $request->input('batch');
        $batch->program = $request->input('program');

        $batch->save();
        
        return redirect('/batches')->with('success','Batch Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batchstuds = Student::where('batch_id', $id)->orderBy('roll', 'asc')->paginate(20);
        $bat = Batch::find($id);

        return view('batches.show', ['batchstuds'=> $batchstuds, 'bat'=> $bat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batch = Batch::find($id);
        
        return view('batches.edit')->with('batch', $batch);
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
        $this->validate($request,[
            'batch' => 'required',
            'program' => 'required'
        ]);
        $batch = Batch::find($id);
        $batch->title = $request->input('batch');
        $batch->program = $request->input('program');

        $batch->save();

        return redirect('/batches')->with('success','Batch Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);

        $batch->delete();

        return redirect('/batches')->with('success','Batch Removed');
    }
}
