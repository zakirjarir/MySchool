
<template>
    <pageLayouts :pageTitle="pageTitle" :buttonTitle="buttonTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top  :treger="openModal" :default-object="{test_se:1}" page-title="Modules"></page-top>
        </template>
        <template v-slot:data>
            <tr v-for="(data ,index) in dataList" >
                <td>{{index +1 }}.{{data.parent_id}}</td>
                <td>{{data.display_name}}</td>
                <td>
                    <div  class="d-flex gap-1 ">
                        <p v-for="parmission in data.permissions" class=" badge badge-info  ">{{parmission.display_name}}</p>
                    </div>
                </td>
                <td>
                    <a v-if="can('modules_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td><p v-if="can('modules_destroy')" @click="editData(data ,data.id)"><i class="fa-regular fa-pen-to-square"></i></p>
                </td>
            </tr>
        </template>
    </pageLayouts>
    <modal-layouts modalTitle="Module Permission">
        <div>
            <label class="form-label">Select module</label>
            <select v-model="formData.module_id" class="form-select">
                <option disabled value=" "> Select one</option>
                <option :value="data.id" v-for="data  in dataList" >{{data.display_name}}</option>
            </select>
            <br>
            <label class="form-label">Module Permission</label>
            <input class="form-control" type="text" name="permission" v-model="formData.display_name" placeholder="Enter Permisssion..">
        </div>
    </modal-layouts>

</template>

<script>
import pageLayouts from "../components/pageLayouts.vue";
import PageTop from "../components/pageTop.vue";
import ModalLayouts from "../components/modalLayouts.vue";
export default {
    name: "modules",
    components: {ModalLayouts, PageTop,  pageLayouts },
    data() {
        return {
            showAddButton: false,
            headers: ["ID", "Modules", "Parmission", "Status","Action"],


        };
    },
    mounted() {
        this.getDataList();
        this.formData.module_id = " "

    }
}
</script>
<style scoped>

</style>
