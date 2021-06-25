<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lesson;


class ClassController extends Controller
{
    private $objClass;
    private $objUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objClass = new Lesson;
        $this->objUsers = new User;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $classes = $this->objClass->get();

        $permission = false;

        if (Auth::user()->type == 'AD' || Auth::user()->type == 'P') {
            $permission = true;
        }

        $type = Auth::user()->type;

        $solicitation = false;
        if ($type == 'P') {
            $classes = $this->objClass->where('teacher_id', '=', Auth::user()->id)->get();
            if ($classes) {
                foreach ($classes as $key => $lesson) {
                    if ($lesson->students) {
                        $lesson_students = json_decode($lesson->students);
                        foreach ($lesson_students as $key => $value) {
                            if ($value->present == false || $value->present == true) {
                                $solicitation = true;
                            }
                        }
                    }
                }
            }
        }
        return view('class', compact('classes', 'permission', 'type', 'solicitation'));
    }

    public function form()
    {
        return view('classForm');
    }

    public function studentRequest()
    {
        $classes_teacher = $this->objClass->where('teacher_id', '=', Auth::user()->id)->get();
        $classes = array();
        $students = array();
        foreach ($classes_teacher as $key => $lesson) {
            if ($lesson->students) {
                $classes = json_decode($lesson->students);
                foreach ($classes as $key_class => $value) {
                    $student = $this->objUsers->where('id', '=', $value->student_id)->get();
                    if (isset($classes[$key]->present)) {
                        $students[] = array(
                            'present' => $classes[$key]->present,
                            'student_id' => $classes[$key]->student_id,
                            'name' => $student[0]->name,
                            'lesson_id' => $lesson->id
                        );
                    }
                }
            }
        }
        return view('classStudentRequest', compact('students'));
    }

    public function confirmStudent(Request $request)
    {
        $lesson = $this->objClass->where('id', '=', $request->lesson_id)->get();
        $lesson = $lesson[0];
        if ($lesson->students) {
            $students = json_decode($lesson->students);
            foreach ($students as $key => $value) {
                if ($value->present == true && $value->student_id == $request->student_id) {
                    unset($students[$key]);
                    $students = json_encode($students);
                    $atualizaton_lesson = $this->objClass->where(['id'=>$request->lesson_id])->update([
                        'students' => $students
                    ]);
                    return redirect ('class');
                } else if ($value->present == false && $value->student_id == $request->student_id) {
                    $students[$key]->present = true;
                    $students = json_encode($students);
                    $atualizaton_lesson = $this->objClass->where(['id'=>$request->lesson_id])->update([
                        'students' => $students
                    ]);
                    return redirect ('class');
                }
            }
        }
    }

    public function store(Request $request)
    {

        $class = $this->objClass->create([
            'date' => $request->hourclass,
            'matter' => $request->matter,
            'students' => '',
            'teacher_id' => Auth::user()->id,
            'accept' => 0
        ]);

        if ($class) {
            return redirect('class');
        } else {
            dd('Algo de incorreto ocorreu');
        }
    }

    public function info($id)
    {
        $lessons = $this->objClass->where('id', '=', (int) $id)->get();
        $students = array();
        if ($lessons[0]->students) {
            foreach (json_decode($lessons[0]->students) as $key => $value) {
                if ($value->student_id) {
                    $student = $this->objUsers->where('id', '=', (int)$value->student_id)->first();
                    if ($student) {
                        $students[] = $student->name;
                    }
                }
            }

        }
        $teacher = $this->objUsers->where('id', '=', (int) $lessons[0]->teacher_id)->get();
        $teacher_name = $teacher[0]->name;
        return view('classInfo', compact('lessons', 'teacher_name', 'students'));
    }

    public function enter($id)
    {
        $students = array();

        $lessons = $this->objClass->where('id', '=', (int) $id)->get();

        if ($lessons[0]->students) {
            $verification = 3;
            foreach (json_decode($lessons[0]->students) as $student) {
                if (Auth::user()->id == $student->student_id && $student->present == false) {
                    $verification = 1;
                    $status = 'Aguardando Aprovação';
                    $id_lesson = $lessons[0]->id;
                    return view('classVerification', compact('status', 'id_lesson'));
                } else if (Auth::user()->id == $student->student_id && $student->present == true) {
                    $verification = 2;
                    $status = 'Presente na Aula';
                    $id_lesson = $lessons[0]->id;
                    return view('classVerification', compact('status', 'id_lesson'));
                }
            }
            if ($verification == 3) {
                $students = json_decode($lessons[0]->students);
                $students[] = array(
                    'present' => false,
                    'student_id' => Auth::user()->id
                );
                $students = json_encode($students);
                $atualizaton_lesson = $this->objClass->where(['id'=>$id])->update([
                    'students' => $students
                ]);
                if ($atualizaton_lesson) {
                    return redirect('class');
                }
            }
        } else {
            $students[] = array(
                    'present' => false,
                    'student_id' => Auth::user()->id
            );
            $students = json_encode($students);

            $atualizaton_lesson = $this->objClass->where(['id'=>$id])->update([
                'students' => $students
            ]);
            
            if ($atualizaton_lesson) {
                return redirect ('class');
            }
            
        }
    }

    public function cancelation($id)
    {
        $lessons = $this->objClass->where('id', '=', (int) $id)->get();
        if ($lessons[0]->students) {
            $lessons = json_decode($lessons[0]->students);
            foreach ($lessons as $key => $value) {
                if (Auth::user()->id == $value->student_id) {
                    unset($lessons[$key]);
                    $lessons = json_encode($lessons);
                    $atualizaton_lesson = $this->objClass->where(['id'=>$id])->update([
                        'students' => $lessons
                    ]);
                    return redirect ('class');
                }
            }
        }
        return redirect ('class');
    }
}
