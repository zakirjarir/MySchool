<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Subject List -- "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.class_id" class="form-select">
                    <option value="" >Filter by Classes</option>
                    <option :value="data.id" v-for="data in generalData.allClasses" > {{data.name}}</option>
                </select>
            </div>
            </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox"></td>
                <td>{{index + 1 }}</td>
                <td>{{data.name}}</td>
                <td>{{data.code}}</td>
                <td>
                    <a v-if="can('subjects_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <p v-if="can('subjects_update','subjects_edit')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('subjects_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="Add Subject">
        <div class="form-group">
            <label class="col-form-label">Subject Name</label>
            <input v-model="formData.name" type="text" name="name" :class="{'border-danger':errors.name}" class="form-control " placeholder="Enter Subject name">
            <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Subject Code</label>
            <input v-model="formData.code" type="number" name="name" :class="{'border-danger':errors.code}" class="form-control " placeholder="Enter Subject Code">
            <span class="text-danger" v-if="errors.code">{{errors.code[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Class</label>
            <select class="form-select" v-model="formData.class_id">
                <option value="">Select Class</option>
                <option :value="data.id" v-for="data in generalData.allClasses">{{data.name}}</option>
            </select>
        </div>
    </modal-layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "subject",
    components: {PageTop, modalLayouts, page_layouts},
    data(){
        return {
            headers: ['id', 'name','Subject Code' ,'status','Actions'],
        }
    },
    mounted() {
        this.formData.class_id = ''
        this.formFilter.class_id = ''
        this.getGeneralData('genareldata');
        this.getDataList()
    }
}
</script>
<style scoped>

</style>
