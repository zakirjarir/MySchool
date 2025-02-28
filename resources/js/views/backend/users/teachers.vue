<template>
    <page_layouts :pageTitle="Teachers" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="dataForm" defaultObject="/admin/users/teacherregfrom" page-title="Teacher List --  "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-3 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.department" class="form-select">
                    <option value="" >Filter by Classes</option>
                    <option :value="data.id" v-for="data in generalData.allClasses" > {{data.name}}</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-6 ">
                <select @change="getDataList()" v-model="formFilter.subject" class="form-select">
                    <option value="" >Filter by subject</option>
                    <option :value="data.id" v-for="data in generalData.allSubjects" > {{data.name}}</option>
                </select>
            </div>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td></td>
                <td>{{index + 1 }}</td>
                <td>
                    <a>
                        <img :src="data.profile_picture ? baseUrl + '/' + data.profile_picture : 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png'" alt="Profile" height="40px" width="40px" class="rounded-circle">
                    </a>
                    {{ data.name }}
                </td>
                <td>{{data.email}}</td>
                <td>{{data.gender}}</td>
                <td>{{data.phone}}</td>
                <td>
                    <a v-if="can('teachers_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <a v-if="can('teachers_edit','teachers_update')" @click="editFormData(data ,data.id ,'/admin/users/teacherregfrom')"><i class="fas fa-edit fs-6"></i></a>
                        <a v-if="can('teachers_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></a>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import pagination from "../../../helper/plugins/pagination/pagination.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "teachers",
    components: {PageTop, modalLayouts, pagination, page_layouts},
    data() {
        return {
            headers: ['Id' , 'Name', 'Email','Gender','Phone', 'Status','Actions'],
        }
    },
    mounted() {
        this.formFilter.department =''
        this.formFilter.subject =''
        this.getGeneralData('genareldata');
        this.getDataList();
    }
}
</script>

<style scoped>

</style>
