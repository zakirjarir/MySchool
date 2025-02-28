import baseLayout from "../views/backend/layouts/baseLayout.vue";
import home from "../views/backend/home.vue";
import dashboard from "../views/backend/dashboard.vue";
import students from "../views/backend/students.vue";
import modules from "../views/backend/RBAC/modules.vue";
import role from "../views/backend/RBAC/role.vue";
import rolePermission from "../views/backend/RBAC/rolePermission.vue";
import users from "../views/backend/RBAC/users.vue";

export default [{
    path: '/admin/',
    component: baseLayout,
    children: [
        {
            path: 'rbac/modules',
            name: 'Modules',
            component: modules,
            meta: {dataUrl:'rbac/modules' }
        },
        {
          path: 'rbac/roles',
          name: 'Roles',
          component: role,
          meta: {dataUrl:'rbac/roles' }
        },
        {
            path: 'rbac/users',
            name: 'Users',
            component: users,
            meta: {dataUrl:'rbac/users' }
        },
        {
            path: 'rbac/role_permissions',
            name: 'RolePermissions',
            component: rolePermission,
            meta: {dataUrl:'rbac/role_permissions' }
        },
        {
            path: 'home',
            name: 'Home',
            component: home
        },
        {
            path: 'dashboard',
            name: 'Dashboard',
            component: dashboard,
            meta:{dataUrl: 'api/dashboard'}
        },
        {
            path:'students',
            name: 'Students',
            component: students,
            meta:{dataUrl: 'api/students'}
        },
    ]
}]

