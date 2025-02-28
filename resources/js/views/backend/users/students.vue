<template>
    <page_layouts :pageTitle="Students" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="dataForm" defaultObject="/admin/users/studentregfrom" page-title="Student List --  "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.class" class="form-select">
                    <option value="" >Filter by Classes</option>
                    <option :value="data.name" v-for="data in generalData.allClasses" > {{data.name}}</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-6 ">
                <select @change="getDataList()" v-model="formFilter.section" class="form-select">
                    <option value="" >Filter by Section</option>
                    <option :value="data.name" v-for="data in generalData.allSection" > {{data.name}}</option>
                </select>
            </div>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td @click="redirectWithId(data.id ,'studentprofile')">
                    <a>
                        <img :src="data.photo ? baseUrl + '/' + data.photo : 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png'" alt="Profile" height="40px" width="40px" class="rounded-circle">
                    </a>
                    {{ data.name }}
                </td>
                <td @click="redirectWithId(data.id ,'studentprofile')">{{data.email}}</td>
                <td @click="redirectWithId(data.id ,'studentprofile')">{{data.gender}}</td>
                <td @click="redirectWithId(data.id ,'studentprofile')">{{data.phone}}</td>
                <td>
                    <a v-if="can('students_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <a v-if="can('students_update','students_edit')" @click="editFormData(data ,data.id ,'/admin/users/teacherregfrom')"><i class="fas fa-edit fs-6"></i></a>
                        <a v-if="can('students_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></a>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "students",
    components: {PageTop, modalLayouts, page_layouts},
    data() {
        return {
            headers: ['Id' , 'Name', 'Email','Gender','Phone', 'Status','Actions'],
        }
    },
    mounted() {
        this.formFilter.class =''
        this.formFilter.section =''
        this.getGeneralData('genareldata');
        this.getDataList();
    }
}
</script>
<style scoped>

</style>
