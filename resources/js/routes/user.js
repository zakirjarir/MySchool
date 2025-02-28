import baseLayout from "../views/backend/layouts/baseLayout.vue";
import teachers from "../views/backend/users/teachers.vue";
import teacherRegFrom from "../views/backend/users/teacherRegFrom.vue";
import students from "../views/backend/users/students.vue";
import studentRegFrom from "../views/backend/users/studentRegFrom.vue";
import parents from "../views/backend/users/parents.vue";
import parentsRegFrom from "../views/backend/users/parentsRegFrom.vue";
import studentProfile from "../views/backend/users/studentProfile.vue";

export default [{
    path: '/admin/users/',
    name: 'users',
    component: baseLayout,
    children: [
        {
            path: 'teachers',
            name: 'teachers',
            component: teachers,
            meta:{dataUrl : 'users/teachers'},
        },
        {
            path: 'teacherregfrom/',
            name: 'teacherregfrom',
            component: teacherRegFrom,
            meta:{dataUrl : 'users/teacherregfrom'},
        },
        {
            path: 'students',
            name: 'students',
            component: students,
            meta:{dataUrl : 'users/students'},
        },
        {
          path: 'studentprofile/:id' ,
          name: 'studentprofile',
          component: studentProfile,
          meta:{dataUrl : 'users/studentprofile'},
        },
        {
            path: 'studentregfrom',
            name: 'studentregfrom',
            component: studentRegFrom,
            meta:{dataUrl : 'users/studentregfrom'},
        },
        {
          path: 'parents',
          name: 'parents',
          component: parents,
          meta:{dataUrl : 'users/parents'},
        },
        {
            path: 'parentregfrom',
            name: 'parentregfrom',
            component: parentsRegFrom,
            meta:{dataUrl : 'users/parentregfrom'},
        }
    ]
}]
