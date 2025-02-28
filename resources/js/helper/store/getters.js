const getters = {
    dataList(state) {
        return state.dataList;
    },
    data(state) {
        return state.data;
    },
    generalData(state) {
        return state.generalData;
    },
    moduleList(state) {
        return state.moduleList;
    },
    allModule(state) {
        return state.allModule;
    },
    permissions(state) {
        return state.permissions;
    },
    formFilter(state) {
        return state.formFilter;
    },
    formData(state) {
        return state.formData;
    },
    updateId(state) {
        return state.updateId;
    },
    errors(state) {
        return state.errors;
    },
    selectData(state) {
        return state.selectData;
    },
}

export default getters;
