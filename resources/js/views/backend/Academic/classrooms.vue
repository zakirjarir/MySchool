<template>
    <page_layouts :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Class Room  -- "></page-top>
        </template>
        <template v-slot:data>
            <tr v-for="(data , index) in dataList.data">
                <td><input type="checkbox" v-model="selectData" :value="data.id"></td>
                <td>{{index + 1 }}</td>
                <td>{{data.name}}</td>
                <td>{{data.room_number}}</td>
                <td>{{data.seats}}</td>
                <td>
                    <a v-if="can('classrooms_status')" @click="changeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-3 ">
                        <p v-if="can('classrooms_update','classrooms_edit')" @click="editData(data,data.id)"><i class="fas fa-edit fs-6"></i></p>
                        <p v-if="can('classrooms_destroy')" @click="deletData(data.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="Add Room">
        <div class="form-group">
            <label class="col-form-label">Room Name</label>
            <input v-model="formData.name" type="text" name="name" :class="{'border-danger':errors.name}" class="form-control " placeholder="Enter class name">
            <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Room No</label>
            <input v-model="formData.room_number" type="number"  :class="{'border-danger':errors.room_number}" class="form-control " placeholder="Enter Rome Number">
            <span class="text-danger" v-if="errors.room_number">{{errors.room_number[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Total Seats</label>
            <input v-model="formData.seats" type="number"  :class="{'border-danger':errors.seats}" class="form-control " placeholder="Enter Capacity (optional)">
            <span class="text-danger" v-if="errors.seats">{{errors.seats[0]}}</span>
        </div>
    </modal-layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "classrooms",
    components: {PageTop, modalLayouts, page_layouts},
    data(){
        return {
            headers: [ 'Id', 'Name', 'Number', 'Seats', 'Status', 'Actions'],
        }
    },
    mounted() {
        this.getDataList();
    }
}
</script>


<style scoped>

</style>
