<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top  :treger="openModal" :default-object="{test_se:1}" page-title="Role List"></page-top>
        </template>
        <template v-slot:data>
        <tr v-for="(data , index) in dataList.data">
            <td> <input type="checkbox"></td>
            <td>{{index + 1 }}</td>
            <td>{{data.display_name}}</td>
            <td>
                <a v-if="can('roles_status')" @click="tryChangeStatus(data.id)" v-html="showStatus(data.status)"></a>
            </td>
            <td>
                <div class="d-flex gap-3 ">
                    <p v-if="can('roles_edit','roles_update')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                    <p v-if="can('roles_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                </div>
            </td>
        </tr>
            <pagination :data="dataList" @paginateTo="getDataList"/>

    </template>
    </page_layouts>
    <modal-layouts :modalTitle="modalTitle">
        <div class="mb-2">
            <label class="col-form-label">Name</label>
            <input v-model="formData.name" type="text" name="name" :class="{'border-danger':errors.name}" class="form-control " placeholder="Role name">
            <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
        </div>
        <div class="mb-2">
            <label class="col-form-label">Display Name</label>
            <input v-model="formData.display_name" type="text" name="display_name" class="form-control  " placeholder="Display Name" :class="{'border-danger': errors.display_name}" >
            <span class="text-danger" v-if="errors.display_name">{{errors.display_name[0]}}</span>
        </div>
<!--        <div class="mb-2">-->
<!--            <label class="col-form-label">Display Name:</label>-->
<!--           <select v-model="formData.test_se">-->
<!--               <option value="1">1</option>-->
<!--               <option value="2">2</option>-->
<!--           </select>-->
<!--        </div>-->
    </modal-layouts>
</template>

<script>
import PageLayouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";
import pagination from "../../../helper/plugins/pagination/pagination.vue";
export default {
    name: "role",
    components: {PageTop, page_layouts: PageLayouts, modalLayouts ,pagination},
    data() {
        return {
            pageTitle: "Roles",
            showAddButton: true,
            headers: ["ID", "Name", "Status", "Action"],
            modalTitle: " Add Role",

        };
    },
    mounted() {
        this.getDataList()
    }
}
</script>

<style scoped>

</style>
