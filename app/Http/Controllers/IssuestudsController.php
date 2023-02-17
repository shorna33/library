<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issuestud;
use App\Student;
use App\Book;
use App\Batch;
use App\Accessno;

class IssuestudsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issuestuds = Issuestud::orderBy('id','asc')->paginate(15);

        return view('issuestuds.index')->with('issuestuds', $issuestuds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batchissues = Batch::all();

        return view('issuestuds.create')->with('batchissues', $batchissues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'batch_id'  => 'required',
            'roll'      => 'required',
            'access_no' => 'required',
            'return'    => 'required|date_format:Y-m-d'
        ]);

        $sroll = $request->input('roll');
        $stud = Student::where('roll', $sroll)->first();
        if(!$stud){
            return redirect('/issuestuds')->with('error', 'Invalid Student ID');
        }

        if(IssuestudsController::issuedBook($stud->id) >= 4){
            return redirect('/issuestuds')->with('error', 'Student can not take more than 4 books');
        }

        $bookaccess = $request->input('access_no');
        $access = Accessno::where('access_no', $bookaccess)->first();
        if(!$access){
            return redirect('/issuestuds')->with('error', 'Invalid Access no');
        }
            
        $issuestud = new Issuestud;
        $issuestud->batch_id = $request->input('batch_id');
        $issuestud->student_id = $stud->id;
        $issuestud->access_id = $access->id;
        $issuestud->book_id = $access->book->id;
        $issuestud->return = $request->input('return');

        $issuestud->save(); 

        return redirect('/issuestuds')->with('success','Successfully Issued New Book.');
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
        $issuestud = Issuestud::find($id);
        $batchissues = Batch::all();

        return view('issuestuds.edit', ['issuestud' =>$issuestud, 'batchissues' =>$batchissues]);
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
        $this->validate($request, [
            'batch_id'  => 'required',
            'roll'      => 'required',
            'access_no' => 'required',
            'return' => 'required|date_format:Y-m-d'
        ]);

        $sroll = $request->input('roll');
        $stud = Student::where('roll', $sroll)->first();
        if(!$stud){
            return redirect('/issuestuds')->with('error', 'Invalid Student ID');
        }

        $bookaccess = $request->input('access_no');
        $access = Accessno::where('access_no', $bookaccess)->first();
        if(!$access){
            return redirect('/issuestuds')->with('error', 'Invalid Access no');
        }

        $issuestud = Issuestud::find($id);
        $issuestud->batch_id = $request->input('batch_id');
        $issuestud->student_id = $stud->id;
        $issuestud->access_id = $access->id;
        $issuestud->book_id = $access->book->id;
        $issuestud->return = $request->input('return');

        $issuestud->save(); 

        return redirect('/issuestuds')->with('success','Successfully Updated Issued Book.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issuestud = Issuestud::find($id);
        $issuestud->delete();

        return redirect('/issuestuds')->with('success','Removed');
    }


    public static function issuedBook($id)
    {
        $issuedBook = Issuestud::where('student_id', $id)->count();

        return $issuedBook;
    }

}
