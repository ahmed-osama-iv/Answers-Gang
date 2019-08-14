<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $qs = Question::all();
        return view('question_index')->with('qs' , $qs);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question_create');
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
            'conten' => 'required',
            'title' => 'required'
        ]);


        $o = new Question();
        $o->publisher_id = $request->publisher_id;
        $o->title = $request->title;
        $o->content = $request->conten;
        $o->group_id = 1;
        $o->save();
        return redirect('/questions/show/'.$o->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $o = Question::find($id);
        $user = auth::id();
        return view('question_show')->with('o',$o);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('viewAny',Question::class);
        $o = Question::find($id);
        return view('question_edit')->with('o',$o);
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
        //
        $this->authorize('viewAny',Question::class);
        $o = Question::find($id);
        $o->title = $request->title;
        $o->content = $request->conten;
        $o->save();
        return redirect('/questions/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('viewAny',Question::class);
        //
        Question::find($id)->delete();

        return redirect('/questions/show');

    }
}
