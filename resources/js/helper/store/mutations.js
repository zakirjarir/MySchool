const mutations = {
    dataList(state, data) {
        state.dataList = data;
    },
    data(state, data) {
        state.data = data;
    },
    generalData(state, data) {
        state.generalData = data;
    },
    moduleList(state, data) {
        state.moduleList = data;
    },
    allModule(state, data) {
        state.allModule = data;
    },
    permissions(state, data) {
        state.permissions = data;
    },
    formFilter(state, data) {
        state.formFilter = data;
    },
    formData(state, data) {
        state.formData = data;
    },
    updateId(state, data) {
        state.updateId = data;
    },
    errors(state, data) {
        state.errors = data;
    },
    selectData(state, data) {
        state.selectData = data;
    },
}

export default mutations;
