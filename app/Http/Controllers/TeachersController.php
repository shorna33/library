<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Issueteacher;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderBy('name','asc')->paginate(10);

        return view('teachers.index')->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
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
            'name' => 'required',
            'desig' => 'required'
        ]);

        $teacher = new Teacher;
        $teacher->name = $request->input('name');
        $teacher->desig = $request->input('desig');
        $teacher->save();

        return redirect('/teachers')->with('success','New Teacher Added');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);
        $issueteachers = Issueteacher::where('teacher_id', $id)->paginate(10);

        return view('teachers.show', ['teacher'=> $teacher, 'issueteachers' =>$issueteachers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return view('teachers.edit')->with('teacher', $teacher);
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
            'name' => 'required',
            'desig' => 'required'
        ]);

        $teacher = Teacher::find($id);
        $teacher->name = $request->input('name');
        $teacher->desig = $request->input('desig');
        $teacher->save();

        return redirect('/teachers')->with('success','Updated Teacher Info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();

        return redirect('/teachers')->with('success', "Teacher's Info Removed ");
    }


    public function searchTea(Request $request)
    {
        $this->validate($request,[
            'search' => 'required',
        ]);

        $search = $request->input('search');
        $teachers = Teacher::where('name', 'LIKE', "%$search%")->paginate(5);

        return view('teachers.search', ['search'=> $search, 'teachers'=> $teachers]);
    }
}
