<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Syllabus List -- "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.class" class="form-select">
                    <option value="" >Filter by Classes</option>
                    <option :value="data.name" v-for="data in generalData.allClasses" > {{data.name}}</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.subject" class="form-select">
                    <option value="" >Filter by Subject</option>
                    <option :value="data.name" v-for="data in generalData.allSubjects" > {{data.name}}</option>
                </select>
            </div>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td>{{data.title}}</td>
                <td>{{data.class}}</td>
                <td>{{data.subject}}</td>
                <td>{{data.description}}</td>
                <td>
                <a v-if="data.file_path && data.status == 1 " class="btn btn-outline-dark rounded-0" @click="downloadFile(data.file_path)"><i class="fa-solid fa-download"></i></a>
                </td>
                <td>
                    <a v-if="can('syllabus_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <p v-if="can('syllabus_update','syllabus_edit')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('syllabus_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="ADD SYLLABUS">
        <div class="form-group">
            <label class="col-form-label">Title </label>
            <input v-model="formData.title" type="text"  :class="{'border-danger':errors.title}" class="form-control " placeholder="Enter title">
        </div>
        <div class="form-group">
            <label class="col-form-label">Class </label>
            <select :class="{'border-danger':errors.class}" class="form-select" v-model="formData.class" >
                <option value="">Select Class</option>
                <option :value="data.id" v-for="data in generalData.allClasses">{{data.name}}</option>
            </select>
            <span class="text-danger" v-if="errors.class">{{errors.class[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Class </label>
            <select :class="{'border-danger':errors.subject}" class="form-select" v-model="formData.subject" >
                <option value="">Select Class</option>
                <option :value="data.name" v-for="data in generalData.allSubjects">{{data.name}}</option>
            </select>
            <span class="text-danger" v-if="errors.subject">{{errors.subject[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Description </label>
            <div class="form-floating">
                <textarea :class="{'border-danger':errors.description}" v-model="formData.description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Description</label>
            </div>
            <span class="text-danger" v-if="errors.description">{{errors.description[0]}}</span>
        </div>

        <div class="form-group">
            <label class="col-form-label">File </label>
            <input type="file" class="form-control" @change="fileUpload($event, formData, 'file_path')" :class="{'border-danger':errors.file_path}" >
            <span class="text-danger" v-if="errors.file_path">{{errors.file_path[0]}}</span>
        </div>
    </modal-layouts>
</template>

<script>
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";
import page_layouts from "../components/pageLayouts.vue";

export default {
    name: "syllabus",
    components: {page_layouts, PageTop, modalLayouts},
    data(){
        return {
            headers: ['id', 'Title','Class','Subject',' description' , 'File','status','Actions'],
        }
    },
    mounted() {
        this.formData.class = ''
        this.formData.subject = ''
        this.formFilter.class = ''
        this.formFilter.subject = ''
        this.getGeneralData('genareldata');
        this.getDataList()
    }
}
</script>
<style scoped>

</style>
