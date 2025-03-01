<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal" page-title="Syllabus List -- "></page-top>
        </template>
        <template v-slot:filter>
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.category" class="form-select">
                    <option value="">Filter by Category</option>
                    <option :value="data.name" v-for="data in generalData.allCategory">{{ data.name }}</option>
                </select>
            </div>
        </template>
        <template v-slot:data>
            <tr v-for="(data, index) in dataList.data" :key="data.id">
                <td><input type="checkbox"></td>
                <td>{{ index + 1 }}</td>
                <td>{{ data.title }}</td>
                <td>{{ data.description }}</td>
                <td>{{ data.author }}</td>
                <td>
                    <a v-if="data.file && data.status == 1" class="btn btn-outline-dark rounded-0" @click="downloadFile(data.file)"><i class="fa-solid fa-download"></i></a>
                </td>
                <td>
                    <a v-if="can('syllabus_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3">
                        <p v-if="can('syllabus_update', 'syllabus_edit')" @click="editData(data, data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('syllabus_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="ADD NOTICE">
        <div class="form-group">
            <label class="col-form-label">Select Category</label>
            <select v-model="formData.category" :class="{'border-danger': errors.category}" class="form-select">
                <option value="">Select Category</option>
                <option :value="category.name" v-for="category in generalData.allCategory">{{ category.name }}</option>
            </select>
            <span class="text-danger" v-if="errors.category && errors.category[0]">{{ errors.category[0] }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Expiry Date</label>
            <input v-model="formData.expiry_date" type="date" :class="{'border-danger': errors.expiry_date}" class="form-control" placeholder="Enter Expiry Date">
            <span class="text-danger" v-if="errors.expiry_date && errors.expiry_date[0]">{{ errors.expiry_date[0] }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Title</label>
            <input v-model="formData.title" type="text" :class="{'border-danger': errors.title}" class="form-control" placeholder="Enter title">
            <span class="text-danger" v-if="errors.title && errors.title[0]">{{ errors.title[0] }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Author</label>
            <input v-model="formData.author" type="text" :class="{'border-danger': errors.author}" class="form-control" placeholder="Enter Author">
            <span class="text-danger" v-if="errors.author && errors.author[0]">{{ errors.author[0] }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Description</label>
            <div class="form-floating">
                <textarea :class="{'border-danger': errors.description}" v-model="formData.description" class="form-control" placeholder="Leave a Description here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Description</label>
            </div>
            <span class="text-danger" v-if="errors.description && errors.description[0]">{{ errors.description[0] }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">File</label>
            <input type="file" class="form-control" @change="fileUpload($event, formData, 'file')" :class="{'border-danger': errors.file}">
            <span class="text-danger" v-if="errors.file && errors.file[0]">{{ errors.file[0] }}</span>
        </div>
    </modal-layouts>
</template>


<script>
import PageTop from "../components/pageTop.vue";
import page_layouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";

export default {
    name: "notice",
    components: {modalLayouts, page_layouts, PageTop},
    data(){
        return {
            headers: ['Id', 'Title','Description','Author','File','Status','Actions'],
        }
    },
    mounted() {
        this.formData.category = ''
        this.formFilter.category = ''
        this.getDataList()
        this.getGeneralData('genareldata')
    }
}
</script>

<style scoped>

</style>
