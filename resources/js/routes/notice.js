import baseLayout from "../views/backend/layouts/baseLayout.vue";
import notice from "../views/backend/notice/notice.vue";
import notice_categories from "../views/backend/notice/notice_categories.vue";

export default [{
    path: '/admin/notice/',
    name: 'Admin_notice',
    component:baseLayout,
    children: [
        {
            path: 'notice',
            name: 'notice',
            component:notice,
            meta:{dataUrl:'notice/notice'},
        },
        {
            path: 'notice_categories',
            name: 'notice_categories',
            component:notice_categories,
            meta:{dataUrl:'notice/notice_categories'},
        }
    ]
}]
