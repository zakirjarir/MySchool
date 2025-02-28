<template>
    <slot name="page_top"></slot>
    <div class="card rounded-0">
        <div class="card-header">
            <slot name="tableTitle"></slot>
            <div class="row ">
                <div v-if="showSerch" class="col-md-2 col-sm-6 col-xs-6 ">
                    <input v-model="formFilter.keyword" type="text" class="form-control " placeholder="Search...">
                </div>
                <slot name="filter"></slot>
                <div  v-if="showSerch" class="col-md-1 col-sm-4 col-xs-4 d-flex gap-2 ">
                    <button @click="getDataList()" class="btn btn-outline-dark">Filter</button>
                    <button @click="getDataList()" class="btn btn-outline-dark">Refres</button>
                </div>

                <div class="col d-flex justify-content-end align-items-center gap-2">
                    <i v-if="selectData > 0" class="fas fa-trash text-danger delete-icon"></i>
                   <div v-if="downlod">
                       <button @click="downloadExcel(dataList.data ,'mySchool')" class="btn btn-outline-dark me-3"><i class="fa-solid fa-file-excel"></i></button>
                       <button @click="print()" class="btn btn-outline-dark me-3"><i class="fa-solid fa-print"></i></button>
                   </div>
                    <slot name="button"></slot>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered  table-responsive-sm ">
                <thead  class="thead-dark ">
                <tr>
                    <th v-if="showChakebox"><input type="checkbox"></th>
                    <slot name="thead"></slot>
                    <th v-for="header in headers" :key="header">{{ header }}</th>
                </tr>
                </thead>
                <tbody>
                <slot name="data"></slot>
                </tbody>
            </table>
            <div v-if="dataList.data && dataList.data.length == 0">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="/backend/img/data_not_found.png" alt="Data Not Found" width="400" height="200" />
                </div>
                <h2 class="text-center mt-3">Data Not Found</h2>
            </div>
            <pagination :data="dataList" @paginateTo="getDataList"/>
        </div>
    </div>
</template>
<script>
import pagination from "../../../helper/plugins/pagination/pagination.vue";

export default {
    name: "PageLayouts",
    components: {pagination},
    data(){
        return {

        }
    },
    props: {
        headers: {
            type: Array,
            required: true
        },
        showSerch:{
            type: Boolean,
            default: true
        }  ,
        showChakebox:{
            type: Boolean,
            default: true
        } ,
        downlod:{
            type: Boolean,
            default: true
        }
        // dataList: {
        //     type: Object,
        //     required: true,
        //     default: () => ({ data: [], links: [] })
        // },
        // getDataList: {
        //     type: Function,
        //     required: true,
        //     default: () => () => {}
        // }

    },
};
</script>
<style scoped>
.delete-icon {
    cursor: pointer;
    font-size: 20px;
    margin-right: 10px;
}
</style>
