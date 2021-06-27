<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Types Permission N = Without permission, M = Modify
        $permissions = [
            //PERMISSIONS TEACHER
            //ROUTES ADMIN LESSON
            ['type_user' => 'P', 'route' => 'adminPermission','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminClass','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'registerLesson','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'lessorFormUpdate','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'lessonInfo','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'createLesson','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'lessonUpdate','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'destroyLesson','type_permission' => 'M'],
            //ROUTES ADMIN PROF AND STUDENT
            ['type_user' => 'P', 'route' => 'adminStudent','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminProf','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminUserUpdate','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminUserInfo','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminProfRegister','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'userUpdate','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminProfDelete','type_permission' => 'N'],
            ['type_user' => 'P', 'route' => 'adminRegister','type_permission' => 'N'],
            //ROUTES CLASS USER GENERIC
            ['type_user' => 'P', 'route' => 'class','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classForm','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classInfo','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classEnter','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classCancelation','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classStudent','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classStore','type_permission' => 'M'],
            ['type_user' => 'P', 'route' => 'classStudentConfirm','type_permission' => 'M'],

            //PERMISSIONS STUDENT
            //ROUTES ADMIN LESSON
            ['type_user' => 'A', 'route' => 'adminPermission','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminClass','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'registerLesson','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'lessorFormUpdate','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'lessonInfo','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'createLesson','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'lessonUpdate','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'destroyLesson','type_permission' => 'N'],
            //ROUTES ADMIN PROF AND STUDENT
            ['type_user' => 'A', 'route' => 'adminStudent','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminProf','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminUserUpdate','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminUserInfo','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminProfRegister','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'userUpdate','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminProfDelete','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'adminRegister','type_permission' => 'N'],
            //ROUTES CLASS USER GENERIC
            ['type_user' => 'A', 'route' => 'class','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'classForm','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'classInfo','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'classEnter','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'classCancelation','type_permission' => 'M'],
            ['type_user' => 'A', 'route' => 'classStudent','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'classStore','type_permission' => 'N'],
            ['type_user' => 'A', 'route' => 'classStudentConfirm','type_permission' => 'N'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
