<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{

    public function index()
    {
        $allLessons = Lesson::paginate(5);
        if (!$allLessons) {
            return response(['error' => 'There is no lesson']);
        }
        return response()->json($allLessons);
    }

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

    public function show($id)
    {
        $lesson = Lesson::where('id', '=', (int)$id)->first();
        if (!$lesson) {
            return response(['error' => 'Lesson not found']);
        }
        return response()->json($lesson);
    }

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
