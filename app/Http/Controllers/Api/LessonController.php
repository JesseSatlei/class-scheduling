<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allLessons = Lesson::paginate(5);
        if (!$allLessons) {
            return response(['error' => 'There is no lesson']);
        }
        return response()->json($allLessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson;
        $lesson->date = $request->date;
        $lesson->matter = $request->matter;
        $lesson->students = $request->students;
        $lesson->teacher_id = $request->teacher_id;
        $lesson->save();

        return response()->json($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::where('id', '=', (int)$id)->first();
        if (!$lesson) {
            return response(['error' => 'Lesson not found']);
        }
        return response()->json($lesson);
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
        $lesson = Lesson::where('id', '=', (int)$id)->first();
        if (!$lesson) {
            return response(['error' => 'Lesson not found']);
        }

        $lesson->date = $request->date;
        $lesson->matter = $request->matter;
        $lesson->students = $request->students;
        $lesson->teacher_id = $request->teacher_id;
        $lesson->save();

        return response()->json($lesson);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::where('id', '=', (int)$id)->first();
        if (!$lesson) {
            return response(['error' => 'Lesson not found']);
        }
        $lesson->delete();
        return response()->json(['sucess' => 'Lesson deleted']);
    }
}
