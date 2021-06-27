<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Permission;

class AdminController extends Controller
{

    private $objLesson;
    private $objUser;
    private $objPermission;

    public function __construct()
    {
        $this->objLesson = new Lesson;
        $this->objUser = new User;
        $this->objPermission = new Permission;
    }

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
        $permission = $this->validatePermission(Auth::user()->type, 'adminPermission', 'Visualization');
        $permissions = $this->objPermission->get();

        if ($permission) {
            return view('adminPermission', compact('permissions'));
        } else {
            $message = 'Você não possui permissão para acessar as permissões';
            return view('home', compact('message'));
        }
    }

    public function registerPermission()
    {
        $permission = $this->validatePermission(Auth::user()->type, 'adminPermission', 'Modify');
        if ($permission) {
            return view('adminRegisterPermission');
        } else {
            $message = 'Você não possui permissão para criar uma permissão';
            return view('home', compact('message'));
        }
    }

    public function updatePermission($id)
    {
        $permission = $this->objPermission->where('id', '=', $id)->first();
        $per = $this->validatePermission(Auth::user()->type, 'updatePermission', 'Modify');

        if ($per) {
            return view('adminUpdateRegister', compact('permission'));
        } else {
            $message = 'Ops, algo de errado ocorreu';
            return view('home', compact('message'));
        }
    }

    public function createPermission(Request $request)
    {
        $name = isset($request->name) ? $request->name : '';
        $type_user = isset($request->type_user) ? $request->type_user : '';
        $type_permission = isset($request->type_permission) ? $request->type_permission : '';

        $permission = $this->objPermission->create([
            'type_user' => $type_user,
            'route' => $name,
            'type_permission' => $type_permission
        ]);

        if ($permission) {
            return redirect('adminPermission');
        } else {
            $message = 'Ops, algo de errado ocorreu';
            return view('home', compact('message'));
        }
    }

    public function permissionUpdate(Request $request)
    {
        $name = isset($request->name) ? $request->name : '';
        $type_user = isset($request->type_user) ? $request->type_user : '';
        $type_permission = isset($request->type_permission) ? $request->type_permission : '';

        $permission = $this->objPermission->where(['id'=>$request->permission_id])->update([
            'type_user' => $type_user,
            'route' => $name,
            'type_permission' => $type_permission
        ]);
        if ($permission) {
            return redirect('adminPermission');
        } else {
            $message = 'Ops, algo de errado ocorreu';
            return view('home', compact('message'));
        }
    }

    public function destroyPermission($id)
    {
        $permission = $this->validatePermission(Auth::user()->type, 'destroyPermission', 'Modify');
        if ($permission) {
            $id = $this->objPermission->find((int) $id);
            $removed = $id->delete();
            return redirect('adminPermission');
        } else {
            $message = 'Você não possui permissão para excluir a permissão';
            return view('home', compact('message'));
        }
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
        $permission = $this->validatePermission(Auth::user()->type, 'registerLesson', 'Visualization');
        if ($permission) {
            return view('adminLessonRegister', compact('profs', 'students'));
        } else {
            $message = 'Você não possui permissão para criar uma aula';
            return view('home', compact('message'));
        }
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

        $permission = $this->validatePermission(Auth::user()->type, 'lessorFormUpdate', 'Visualizaton');
        if ($permission) {
            return view('adminLessonUpdate', compact('lessons', 'profs', 'teacher_lesson', 'students'));
        } else {
            $message = 'Você não possui permissão para acessar a página de atualização das lições';
            return view('home', compact('message'));
        }

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
        if (empty($students)) {
            $students = null;
        }
        $type = Auth::user()->type;
        $permission = $this->validatePermission(Auth::user()->type, 'lessonInfo', 'Modify');
        if ($permission) {
            return view('adminLessonInfo', compact('lessons', 'teacher', 'students', 'type', 'id'));
        } else {
            $message = 'Você não possui permissão para ver as informações da aula';
            return view('home', compact('message'));
        }
    }

    public function destroyLesson($id)
    {
        $permission = $this->validatePermission(Auth::user()->type, 'destroyLesson', 'Modify');
        if ($permission) {
            $id = $this->objLesson->find((int) $id);
            $removed = $id->delete();
            return redirect('adminClass');
        } else {
            $message = 'Você não possui permissão para deletar as lições';
            return view('home', compact('message'));
        }

    }

    public function adminStudent()
    {
        $studants = $this->objUser->where('type', '=', 'A')->get();
        $permission = $this->validatePermission(Auth::user()->type, 'adminStudent', 'Visualizaton');
        if ($permission) {
            return view('adminStudent', compact('studants'));
        } else {
            $message = 'Você não possui permissão para acessar a página de estudantes';
            return view('home', compact('message'));
        }
    }

    public function adminProf()
    {
        $profs = $this->objUser->where('type', '=', 'P')->get();
        $permission = $this->validatePermission(Auth::user()->type, 'adminProf', 'Modify');
        if ($permission) {
            return view('adminProf', compact('profs'));
        } else {
            $message = 'Você não possui permissão para acessar a página de professores';
            return view('home', compact('message'));
        }
    }

    public function createUser()
    {
        $permission = $this->validatePermission(Auth::user()->type, 'adminRegister', 'Modify');
        if ($permission) {
            return view('adminUserRegister');
        } else {
            $message = 'Você não possui permissão para criar um usuário';
            return view('home', compact('message'));
        }
    }

    public function createdUser(Request $request)
    {

        $permission = $this->validatePermission(Auth::user()->type, 'adminProfRegister', 'Modify');
        if ($permission) {
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
        } else {
            $message = 'Você não possui permissão para criar um usuário';
            return view('home', compact('message'));
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
        $permission = $this->validatePermission(Auth::user()->type, 'adminProfDelete', 'Modify');
        if ($permission) {
            return view('adminUserInfo', compact('user'));
        } else {
            $message = 'Você não possui permissão para visualizar as informações dos usuários';
            return view('home', compact('message'));
        }
    }

    public function userDelete($id)
    {
        $id = $this->objUser->find((int) $id);
        $removed = $id->delete();

        $permission = $this->validatePermission(Auth::user()->type, 'adminProfDelete', 'Modify');
        if ($permission) {
            return redirect('home');
        } else {
            $message = 'Você não possui permissão para excluir os usuários';
            return view('home', compact('message'));
        }
    }

    public function validatePermission($type_user, $route, $type_permission = 'Modify')
    {
        if (isset($type_user) && $type_user == 'AD') {
            return true;
        } else {
            $permission = $this->objPermission->where('type_user', '=', $type_user)->where('route', '=', $route)->first();
            if (!empty($permission->type_permission)) {
                $type_route = '';
                if ($type_permission == 'Modify') {
                    $type_route = 'M';
                } else if ($type_permission == 'Visualizaton') {
                    $type_route = 'V';
                }
                if ($permission->type_permission == $type_route || $permission->type_permission == 'M') {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
}
