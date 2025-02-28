<template>
    <page_layouts :pageTitle="Parents" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="dataForm" defaultObject="/admin/users/parentregfrom" page-title="Parents List --  "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6 ">
                <multiselect v-if="generalData && generalData.allStudent" class="border border-dark" v-model="formFilter.student_id" :options="generalData.allStudent.map(s => ({ id: s.id, name: s.name }))" label="name" track-by="id" placeholder="Search & Select Student" :searchable="true" @select="getDataList()"/>
            </div>
        </template>
        <template v-slot:thead >
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th v-if="can('parents_status')" >Status</th>
            <th v-if="can('parents_destroy' ,'parents_update','parents_edit')">Actions</th>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td>
                    <a>
                        <img :src="data.profile_photo ? baseUrl + '/' + data.profile_photo : 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png'" alt="Profile" height="40px" width="40px" class="rounded-circle">
                    </a>
                    {{ data.name }}
                </td>
                <td>{{data.email}}</td>
                <td>{{data.gender}}</td>
                <td>{{data.phone}}</td>
                <td>
                    <a v-if="can('parents_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <a v-if="can('parents_update','students_edit')" @click="editFormData(data ,data.id ,'/admin/users/teacherregfrom')"><i class="fas fa-edit fs-6"></i></a>
                        <a v-if="can('parents_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></a>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import PageTop from "../components/pageTop.vue";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

export default {
    name: "parents",
    components: {Multiselect, PageTop, page_layouts},
    data() {
        return {

        }
    },
    watch: {
        generalData: {
            handler(newVal) {
                if (newVal && newVal.allStudent) {
                    console.log("Student Data Loaded:", newVal.allStudent);
                }
            },
            deep: true,
            immediate: true
        }
    },
    mounted() {
        this.formFilter.student_id =''
        this.getDataList();
        this.getGeneralData('genareldata');
    }
}
</script>
<style scoped>


</style>
