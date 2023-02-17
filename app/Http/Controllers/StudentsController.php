<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Batch;
use App\Issuestud;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studbatches = Batch::all();

        return view('students.create')->with('studbatches', $studbatches);
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
            'roll'=>'required',
            'name' => 'required',
            'batch_id' => 'required'
        ]);

        $student = new Student;
        $student->roll = $request->input('roll');
        $student->name = $request->input('name');
        $student->batch_id = $request->batch_id;

        $student->save(); 

        return redirect('/batches')->with('success','Successfully Added New Student.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studissues = Issuestud::where('student_id', $id)->paginate(10);
        $student = Student::find($id);

        return view('students.show', ['studissues' =>$studissues, 'student' =>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studbatches = Batch::all();
        $student = Student::find($id);

        return view('students.edit', ['studbatches'=> $studbatches, 'student'=> $student]);
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
            'roll'=>'required',
            'name' => 'required',
            'batch_id' => 'required'
        ]);

        $student = Student::find($id);
        $student->roll = $request->input('roll');
        $student->name = $request->input('name');
        $student->batch_id = $request->batch_id;

        $student->save(); 

        return redirect('/batches/'. $student->batch_id)->with('success','Successfully Updated Student Info.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect('/batches')->with('success','Student Removed');
    }


    public function searchStud(Request $request)
    {
        $this->validate($request,[
            'search' => 'required'
        ]);

        $search = $request->input('search');
        $batchstuds = Student::where('roll', 'LIKE', "%$search%")->paginate(5);

        return view('students.search', ['search'=> $search, 'batchstuds'=> $batchstuds]);
    }


    public static function studentCount($id)
    {
        $studentCount = Student::where('batch_id', $id)->count();
        
        return $studentCount;
    }
}
