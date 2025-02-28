<script>
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";
import page_layouts from "../components/pageLayouts.vue";

export default {
    name: "attendance",
    components: {page_layouts, PageTop, modalLayouts}
}
</script>

<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Section -- "></page-top>
        </template>
        <template v-slot:thead>
            <th>
                <span class="glyphicon glyphicon-chevron-down"> Date </span><br>
                <span class="glyphicon glyphicon-chevron-down"> Student </span>
            </th>
            <th v-for=" (att, ind)  in 31"> {{ind + 1}}</th>
            <th>Status</th>
            <th>Action</th>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td>{{data.name}}</td>
                <td>
                    <a v-if="can('sections_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <p v-if="can('sections_update','sections_edit')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('sections_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="Add Class">
        <div>
            <div class="form-group">
                <label class="col-form-label">Section Name</label>
                <input v-model="formData.name" type="text" name="name" :class="{'border-danger':errors.name}" class="form-control " placeholder="Enter class name">
                <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">Section Class</label>
                <select v-model="formData.class_id" class="form-select">
                    <option value="">Select Class</option>
                    <option v-for="data in generalData.allClasses" :value="data.id">{{data.name}}</option>
                </select>
            </div>
        </div>
    </modal-layouts>
</template>

<style scoped>

</style>
