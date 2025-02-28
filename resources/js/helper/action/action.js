export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        window.document.title = to.meta.pageTitle !== undefined ? to.meta.pageTitle : '';
        store.state.dataList = {};
        // store.state.generalData = {};
        // store.state.permissions = {};
        // store.state.formData = {};
        // store.state.errors = {};
        // store.state.updateId = '';

        store.formFilter = {
            keyword : '',
            par_page : 10,
            status : '',
        };

        next();
    });
}


