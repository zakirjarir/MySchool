import baseLayout from "../views/backend/layouts/baseLayout.vue";

export default [{
    path: '/admin/exam/',
    name: 'Admin_exam',
    component:baseLayout,
    children: [
        {
            path: 'exam_categoris',
            name: 'exam_categoris',
            component:notice,
            meta:{dataUrl:'exam/exam_categoris'},
        },
    ]
}]
