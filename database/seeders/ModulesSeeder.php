<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\RBAC\Modules;
use App\Models\RBAC\Permission;
use App\Models\RBAC\RoleModules;
use App\Models\RBAC\RolePermissions;
use App\Models\RBAC\Roles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable Foreign Key Checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('modules')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_modules')->truncate();
        DB::table('role_permissions')->truncate();
        DB::table('users')->truncate();

        $resourcePermissions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'status',];

        $modules = [
                [
                    'display_name' => 'Dashboard',
                    'name' => 'dashboard',
                    'parent_id' => 0,
                    'link' => '/admin/dashboard',
                    'permissions' => ['view', 'report', 'print'],
                    'icon' => 'fa-dashboard',
                    'submenus' =>[]
                ],
                [
                    'display_name' => 'RBAC Accesses',
                    'name' => 'RBAC_accesses',
                    'link' => '#',
                    'permissions' => ['show'],
                    'icon' => 'fa-shield',
                    'submenus' => [
                        [
                            'display_name' => 'Modules',
                            'name' => 'modules',
                            'link' => '/admin/rbac/modules',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Roles',
                            'name' => 'roles',
                            'link' => '/admin/rbac/roles',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Role Permissions',
                            'name' => 'role_permissions',
                            'link' => '/admin/rbac/role_permissions',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Users',
                            'name' => 'users',
                            'link' => '/admin/rbac/users',
                            'permissions' => $resourcePermissions,
                        ],
                    ]
                ],
                [
                    'display_name' => 'Academics',
                    'name' => 'Academics',
                    'link' => '#',
                    'permissions' => ['show'],
                    'icon' => 'fas fa-chalkboard-teacher',
                    'submenus' => [
                        [
                          'display_name' => 'Subjects',
                          'name' => 'subjects',
                          'link' => '/admin/academics/subjects',
                          'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Classes',
                            'name' => 'classes',
                            'link' => '/admin/academics/classes',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                          'display_name' => 'Syllabus',
                          'name' => 'syllabus',
                          'link' => '/admin/academics/syllabus',
                          'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Sections',
                            'name' => 'sections',
                            'link' => '/admin/academics/sections',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Classrooms',
                            'name' => 'classrooms',
                            'link' => '/admin/academics/Classrooms',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Class Routines',
                            'name' => 'class_routines',
                            'link' => '/admin/academics/class_routines',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Day',
                            'name' => 'day',
                            'link' => '/admin/academics/day',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Attendance',
                            'name' => 'attendance',
                            'link' => '/admin/academics/attendance',
                            'permissions' => $resourcePermissions,
                        ]
                    ]
                ],
                [
                    'display_name' => 'Users',
                    'name' => 'Users',
                    'link' => '#',
                    'permissions' => ['show'],
                    'icon' => 'fa-regular fa-user',
                    'submenus' => [
                        [
                            'display_name' => 'Teachers',
                            'name' => 'teachers',
                            'link' => '/admin/users/teachers',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Students',
                            'name' => 'students',
                            'link' => '/admin/users/students',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Parents',
                            'name' => 'parents',
                            'link' => '/admin/users/parents',
                            'permissions' => $resourcePermissions,
                        ]
                    ]
                ],
                [
                    'display_name' => 'Notice',
                    'name' => 'Notice',
                    'link' => '#',
                    'permissions' => ['show'],
                    'icon' => 'fas fa-bullhorn',
                    'submenus' => [
                        [
                            'display_name' => 'Notice Categories',
                            'name' => 'notice_categories',
                            'link' => '/admin/notice/notice_categories',
                            'permissions' => $resourcePermissions,
                        ],
                        [
                            'display_name' => 'Notice',
                            'name' => 'notice',
                            'link' => '/admin/notice/notice',
                            'permissions' => $resourcePermissions,
                        ]
                    ]
                ],
                [
                    'display_name' => 'Examination',
                    'name' => 'examination',
                    'link' => '#',
                    'permissions' => ['show'],
                    'icon' => 'fas fa-user-graduate',
                    'submenus' => [
                        [
                            'display_name' => 'Exam Categories',
                            'name' => 'exam_categories',
                            'link' => '/admin/exam/exam_categories',
                            'permissions' => $resourcePermissions,
                        ],
                    ]
                ]

        ];

        $roleModel = new Roles();
        $roleModel->fill([
            'name' => 'Super_admin',
            'display_name' => 'Super Admin',
            'status' => 1,
        ]);
        $roleModel->save();

        $user = new User();
        $user->fill([
            'name' => 'Zakir Jarir',
            'role' => 'Super Administrator',
            'role_id' => $roleModel->id,
            'email' => 'zakirjarir@gmail.com',
            'email_verified_at' => Carbon::now(),
            'status' => '1',
            'otp' => '123456',
            'otp_expiry' => Carbon::now()->addMinutes(10),
            'password' => Hash::make('123456'),
            'phone_number' => '01989197909',
            'profile_picture' => 'https://lh3.googleusercontent.com/a/ACg8ocLPlXZn7huCKB63nAHgCIb8CHymB7uVvKTnVm-zAFBeKGzH5ZM=s360-c-no',
            'address' => '123, Some Street, City, Country',
            'gender' => 'male',
            'last_login' => Carbon::now(),
            'is_2fa_enabled' => true,
            'is_suspended' => false,
            'locale' => 'en',
            'email_notifications' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->save();



        foreach ($modules as $module) {
            $submenus = $module['submenus'];
            $permissions = $module['permissions'];
            unset($module['submenus']);
            unset($module['permissions']);

            $moduleModel = new Modules();
            $moduleModel->fill($module);
            $moduleModel->save();

            $roleModuleModel = new RoleModules();
            $roleModuleModel->fill([
                'module_id' => $moduleModel->id,
                'role_id' => $roleModel->id,
            ]);
            $roleModuleModel->save();
            $this->addPermission($moduleModel, $permissions, $roleModel);

            foreach ($submenus as $submenu) {
                $permissions = $submenu['permissions'];
                unset($submenu['permissions']);

                $subModuleModel = new Modules();
                $subModuleModel->fill($submenu);
                $subModuleModel->parent_id = $moduleModel->id;
                $subModuleModel->save();

                $roleModuleModel = new RoleModules();
                $roleModuleModel->fill([
                    'module_id' => $subModuleModel->id,
                    'role_id' => $roleModel->id,
                ]);
                $roleModuleModel->save();

                $this->addPermission($subModuleModel, $permissions, $roleModel);
            }
        }




    }

    public function addPermission($module, $permissions, $roleModuleModel)
    {
        foreach ($permissions as $permission) {
            $permissionModel = new Permission();
            $permissionModel->permission = "$module->name"."_"."$permission";
            $permissionModel->display_name = "$module->display_name"." "."$permission";
            $permissionModel->module = "$module->display_name";
            $permissionModel->module_id = $module->id;
            $permissionModel->save();

            $rolePermission = new RolePermissions();
            $rolePermission->fill([
                'permission_id' => $permissionModel->id,
                'role_id' => $roleModuleModel->id,
            ]);
            $rolePermission->save();
        }
    }
}
