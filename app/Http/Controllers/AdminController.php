<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Lesson;

class AdminController extends Controller
{

    private $objLesson;
    private $objUser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objLesson = new Lesson;
        $this->objUser = new User;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permission = false;
        $type = Auth::user()->type;
        if (Auth::user()->type == 'AD') {
            $permission = true;
        }

        return view('home', compact('permission', 'type'));
    }

    public function adminPermission()
    {
        return view('adminPermission');
    } 

    public function adminClass()
    {
        $lessons = $this->objLesson->get();
        return view('adminClass', compact('lessons'));
    }

    public function registerLesson()
    {
        $profs = $this->objUser->where('type', '=', 'P')->get();
        $students = $this->objUser->where('type', '=', 'A')->get();
        return view('adminLessonRegister', compact('profs', 'students'));
    }
    
    public function createLesson(Request $request)
    {
        $class = null;
        if ($request->prof) {
            $students = isset($request->student) ? $request->student : '';
            if (!empty($students)) {
                $student_class = array();
                foreach ($students as $key => $value) {
                    $student_class[] = [
                        'present' => true,
                        'student_id' => $value
                    ];
                }
                $students = json_encode($student_class);
            }

            $class = $this->objLesson->create([
                'date' => $request->hourclass,
                'matter' => $request->matter,
                'students' => $students,
                'teacher_id' => $request->prof
            ]);
        }

        if ($class) {
            return redirect('adminClass');
        } else {
            $profs = $this->objUser->where('type', '=', 'P')->get();
            $students = $this->objUser->where('type', '=', 'A')->get();
            $message = 'Algo de incorreto ocorreu';
            return view('adminLessonRegister', compact('profs', 'students', 'message'));
        }

    }

    public function lessorFormUpdate($id)
    {
        $lessons = $this->objLesson->where('id', '=', (int)$id)->get();
        $lessons = $lessons[0];

        $profs = $this->objUser->where('type', '=', 'P')->get();

        $teacher = $this->objUser->where('id', '=', (int)$lessons->id)->get();
        $teacher_lesson = $lessons->teacher_id;
        $students = $this->objUser->where('type', '=', 'A')->get();

        return view('adminLessonUpdate', compact('lessons', 'profs', 'teacher_lesson', 'students'));
    }

    public function lessonUpdate(Request $request)
    {
        $students = isset($request->student) ? $request->student : '';
        if (!empty($students)) {
            $student_class = array();
            foreach ($students as $key => $value) {
                $student_class[] = [
                    'present' => true,
                    'student_id' => $value
                ];
            }
            $students = json_encode($student_class);
        }

        $lesson = [];
        if (!empty($students)) {
            $lesson = $this->objLesson->where(['id'=>$request->lesson_id])->update([
                'teacher_id' => $request->prof,
                'matter' => $request->matter,
                'date' => $request->hourclass,
                'students' => $students
            ]);
        } else {
            $lesson = $this->objLesson->where(['id'=>$request->lesson_id])->update([
                'teacher_id' => $request->prof,
                'matter' => $request->matter,
                'date' => $request->hourclass
            ]);
        }
        if (!empty($lesson)) {
            return redirect('adminClass');
        } else {
            $message = 'Ops, algo de Errado ocorreu';
            return view('adminClass', compact('message'));
        }
    }

    public function lessonInfo($id)
    {
        $lessons = $this->objLesson->where('id', '=', (int)$id)->get();
        $lessons = $lessons[0];

        $teacher = $this->objUser->where('id', '=', (int)$lessons->teacher_id)->first();

        $students = [];
        if ($lessons->students) {
            $students = json_decode($lessons->students);
            $students_id = [];
            foreach ($students as $key => $value) {
                $students_id[] = $value->student_id;
            }
            $students = $this->objUser->whereIn('id', $students_id)->get();

        }

        return view('adminLessonInfo', compact('lessons', 'teacher', 'students'));
    }

    public function destroyLesson($id)
    {
        $id = $this->objLesson->find((int) $id);
        $removed = $id->delete();

        return redirect('adminClass');
    }

    public function adminStudent()
    {
        $studants = $this->objUser->where('type', '=', 'A')->get();
        return view('adminStudent', compact('studants'));
    }

    public function adminProf()
    {
        $profs = $this->objUser->where('type', '=', 'P')->get();
        return view('adminProf', compact('profs'));
    }

    public function createUser()
    {
        return view('adminUserRegister');
    }

    public function createdUser(Request $request)
    {
        $new_user = User::create([
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ]);

        if ($new_user) {
            return redirect('home');
        } else {
            $message = 'Ops, algo de errado ocorreu';
            return view('adminUserRegister', compact('message'));
        }
    }

    public function userForm($id)
    {
        $user = $this->objUser->where('id', '=', (int)$id)->get();
        $user = $user[0];
        return view('adminUserUpdate', compact('user'));
    }

    public function userUpdate(Request $request)
    {

        $user = $this->objUser->where(['id'=>$request->user_id])->update([
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ]);

        if ($user) {
            return redirect('home');
        } else {
            $message = 'Ops, algo de Errado ocorreu';
            return view('adminUserRegister', compact('message'));
        }
    }

    public function userInfo($id)
    {
        $user = $this->objUser->where('id', '=', (int)$id)->get();
        $user = $user[0];
        return view('adminUserInfo', compact('user'));
    }

    public function userDelete($id)
    {
        $id = $this->objUser->find((int) $id);
        $removed = $id->delete();

        return redirect('home');
    }
}
