<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Class List -- "></page-top>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td>{{data.name}}</td>
                <td>
                    <a v-if="('classes_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <p v-if="can('classes_edit','classes_update')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('classes_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="Add Class">
        <div class="form-group">
            <label class="col-form-label">Class Name</label>
            <input v-model="formData.name" type="text" name="name" :class="{'border-danger':errors.name}" class="form-control " placeholder="Enter class name">
            <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
        </div>
    </modal-layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import pagination from "../../../helper/plugins/pagination/pagination.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "classes",
    components: {PageTop, modalLayouts, pagination, page_layouts},
    data(){
        return {
            headers: ["ID", "Name","Status","Action"],
        }
    },
    mounted() {
        this.getDataList();
    }
}
</script>


<style scoped>

</style>
