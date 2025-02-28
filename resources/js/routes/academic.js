import baseLayout from "../views/backend/layouts/baseLayout.vue";
import classes from "../views/backend/Academic/classes.vue";
import section from "../views/backend/Academic/section.vue";
import classrooms from "../views/backend/Academic/classrooms.vue";
import routines from "../views/backend/Academic/routines.vue";
import subject from "../views/backend/Academic/subject.vue";
import day from "../views/backend/Academic/day.vue";
import syllabus from "../views/backend/Academic/syllabus.vue";
import attendance from "../views/backend/Academic/attendance.vue";
import takeAttendance from "../views/backend/Academic/takeAttendance.vue";


export default [{
    path: '/admin/academics/',
    name: 'academic',
    component: baseLayout,
    children: [
        {
          path: 'subjects',
          name: 'subjects',
          component: subject,
          meta: {dataUrl: 'academics/subjects'}
        },
        {
            path: 'classes',
            name: 'classes',
            component: classes,
            meta:{dataUrl : 'academics/classes'},
        },
        {
            path: 'sections',
            name: 'sections',
            component: section,
            meta:{dataUrl : 'academics/sections'},
        },
        {
          path: 'Classrooms',
          name: 'Classrooms',
          component: classrooms,
            meta:{dataUrl : 'academics/classrooms'},
        },
        {
            path: 'class_routines',
            name: 'class_routines',
            component: routines,
            meta:{dataUrl : 'academics/class_routines'},
        },
        {
            path: 'day',
            name: 'day',
            component: day,
            meta: {dataUrl : 'academics/day'},
        },
        {
            path: 'syllabus',
            name: 'syllabus',
            component: syllabus,
            meta: {dataUrl : 'academics/syllabus'},
        },
        {
            path: 'attendance',
            name: 'attendance',
            component: attendance,
            meta: {dataUrl : 'academics/attendance'},
        },
        {
            path: 'takeAttendance',
            name: 'takeAttendance',
            component: takeAttendance,
        }
    ]

}]
