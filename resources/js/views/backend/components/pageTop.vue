<template>
    <div class="them-bg pt-1 pb-1 px-1 mb-1 d-flex flex-column flex-md-row justify-content-between align-items-center shadow-lg text-center text-md-start rounded-0">
        <div class="d-flex align-items-center">
            <select @change="getDataList()" v-model="formFilter.par_page" class="form-select form-select-lg fs-6 border-0 font-weight-bold text-uppercase shadow-none">
                <option v-for="item in 5" :value="item*5">{{ pageTitle }} {{item*5}}</option>
            </select>
        </div>
        <button v-if="showAddButton" @click="treger(defaultObject)" class="btn btn-outline-dark rounded-0 btn-sm shadow-lg px-2">
            + {{ buttonTitle }}
        </button>
    </div>
</template>
<script>
export default {
    name: "pageTop",
    props: {
        treger: {
            type: Function,
            default: () => {}
        },
        defaultObject: {
            type: Object,
            default: () => ({})
        },
        buttonTitle: {
            type: String,
            default: 'ADD NEW'
        },
        pageTitle: {
            type: String,
            default: ''
        },
        showAddButton: {
            type: Boolean,
            default: true
        },
    }
}
</script>
<style scoped>

</style>
