<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issueteacher;
use App\Teacher;
use App\Accessno;
use App\Book;

class IssueteachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issueteachers = Issueteacher::orderBy('id', 'asc')->paginate(10);

        return view('issueteachers.index')->with('issueteachers', $issueteachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::pluck('name', 'id');

        return view('issueteachers.create')->with('teachers', $teachers);
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
            'access_no' => 'required',
        ]);

        $access = $request->input('access_no');
        $teaAccess = Accessno::where('access_no', $access)->first();

        if(!$teaAccess){
            return redirect('/issueteachers')->with('error', 'Invalid Access no');
        }

        $issueteacher = new Issueteacher;
        $issueteacher->teacher_id = $request->input('teacher_id');
        $issueteacher->access_id = $teaAccess->id;
        $issueteacher->book_id = $teaAccess->book->id;

        $issueteacher->save();

        return redirect('/issueteachers')->with('success', 'Issued A New Book');
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
        $teachers = Teacher::pluck('name', 'id');
        $issueteacher = Issueteacher::find($id);

        return view('issueteachers.edit', ['issueteacher' => $issueteacher, 'teachers' => $teachers]);
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
            'access_no' => 'required',
        ]);

        $access = $request->input('access_no');
        $teaAccess = Accessno::where('access_no', $access)->first();

        if(!$teaAccess){
            return redirect('/issueteachers')->with('error', 'Invalid Access no');
        }

        $issueteacher = Issueteacher::find($id);
        $issueteacher->teacher_id = $request->input('teacher_id');
        $issueteacher->access_id = $teaAccess->id;
        $issueteacher->book_id = $teaAccess->book->id;

        $issueteacher->save();

        return redirect('/issueteachers')->with('success', 'Updated Issued Information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issueteacher = Issueteacher::find($id);
        $issueteacher->delete();

        return redirect('/issueteachers')->with('success', 'Removed Info');
    }
    

    public static function issueCount($id)
    {
        $issueCount = Issueteacher::where('teacher_id', $id)->count();

        return $issueCount;
    }
}
