<template>
    <page_layouts :pageTitle="pageTitle" :showAddButton="showAddButton"  :headers="headers">
        <template v-slot:page_top>
            <page-top :treger="openModal"  page-title="Class Routines -- "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6">
                <select @change="filtter()"  v-model="formFilter.class" class="form-select">
                    <option value="" >Filter by Classes</option>
                    <option :value="data.name" v-for="data in generalData.classes" > {{data.name}}</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-6 ">
                <select @change="filtter()" v-model="formFilter.section" class="form-select">
                    <option value="" >Filter by Section</option>
                    <option :value="data.name" v-for="data in generalData.section" > {{data.name}}</option>
                </select>
            </div>
        </template>
<!--        <template v-slot:button >-->
<!--            <div class="col-md-10 ms-5 col-sm-6 ">-->
<!--               <p @click="downloadPDF()"><i class=" fs-4 text-success fa-solid fa-file-pdf"></i></p>-->
<!--            </div>-->
<!--        </template>-->
        <template v-slot:thead>
            <th width="10%"> DAY</th>
            <th width="90%">CLASSES</th>
        </template>
        <template v-slot:data>
            <tr v-for="(data ) in dataList.data">
                <td  class="text-center align-middle">
                    <input type="checkbox">
                </td>

                <td v-if="data.class_routines" class="text-center align-middle">
                    <div class=" fs-4 font-weight-bold " >
                         {{ data.name }}
                    </div>
                </td>

                <td class="d-flex gap-3" >
                    <div v-for="rutin in data.class_routines">
                        <div class="card rounded-0 ">
                            <div class="card-header text-center py-3" >
                                <h5 class="mb-0 fw-bold">{{ rutin.subject }}</h5>
                            </div>
                            <div class="card-body text-center p-3">
                                <div class="mb-2">
                                    <div class="font-weight-bold">Time</div>
                                    <div class="fw-semibold text-dark"></div> {{ rutin.start_time }} - {{ rutin.end_time }}
                                </div>
                                <div class="mb-2">
                                    <div class="font-weight-bold">Teacher</div>
                                    <span class=" text-dark">{{ rutin.teacher }}</span>

                                </div>
                                <div >
                                    <div class="font-weight-bold">Room No</div>
                                    <span class=" text-dark">{{ rutin.room_number }}</span>
                                </div>
                                <div class=" d-flex justify-content-end gap-2">
                                    <a v-if="can('sections_status')" @click="changeStatus(rutin.id)" v-html="showStatus(rutin.status)"></a>
                                    <p v-if="can('class_routines_update','class_routines_edit')" @click="editData(rutin,rutin.id)"><i class="fas fa-edit fs-6"></i></p>
                                    <p v-if="can('class_routines_destroy')" @click="deletData(rutin.id)"><i class="fas fa-trash text-danger fs-6"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </template>
    </page_layouts>
    <modal-layouts modalTitle="Add Routines">
        <div class="form-group">
            <label class="col-form-label">Day</label>
            <select :class="{'border-danger':errors.day}" @change="filtter()" class="form-select" v-model="formData.day">
                <option value="" disabled>Select Day</option>
                <option v-for="data in generalData.day" :value="data.name">{{data.name}}</option>
            </select>
            <span class="text-danger" v-if="errors.day">{{errors.day[0]}}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Class</label>
            <select  @change="filtter()" v-model="formData.class_id" class="form-select">
                <option value="">Select Class</option>
                <option v-for="cls in generalData.classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Section</label>
            <select  @change="filtter()" v-model="formData.section_id" class="form-select">
                <option value="">Select Section</option>
                <option v-for="sec in generalData.section" :key="sec.id" :value="sec.id">{{ sec.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label">Subject</label>
            <select  @change="filtter()" v-model="formData.subject" class="form-select">
                <option value="">Select Subject</option>
                <option v-for="sub in generalData.allSubject" :key="sub.id" :value="sub.name">{{ sub.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Start Time</label>
            <input  @change="filtter()" type="time" v-model="formData.start_time" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">End Time</label>
            <input  @change="filtter()" type="time" v-model="formData.end_time" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Teacher</label>
            <select @change="filtter()" v-model="formData.teacher_id" class="form-select">
                <option value="">Select Teacher</option>
                <option v-for="teacher in generalData.teachers" :key="teacher.id" :value="teacher.id">{{ teacher.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label">Room Number</label>
            <select  @change="filtter()" v-model="formData.room_id" class="form-select">
                <option value="">Select Room</option>
                <option v-for="room in generalData.rooms" :key="room.id" :value="room.id">{{room.name}} --({{ room.room_number }})</option>
            </select>
        </div>
    </modal-layouts>
</template>

<script>
import page_layouts from "../components/pageLayouts.vue";
import modalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "routines",
    components: {PageTop, modalLayouts, page_layouts},

    methods: {
        filtter(){
            const _this = this;
            _this.httpRequest({
                url :_this.urlGenerate('filtter_routines'),
                params : Object.assign(_this.formData),
            },function (readData) {
                _this.loading = false;
                if (parseInt(readData.status) === 2000) {
                    _this.$store.commit('generalData', readData.result);
                }else {
                    console.log(readData);
                }
            })
        },
    },
    mounted() {
        this.formFilter.section = ''
        this.formFilter.class = ''
        this.formData.day = ''
        this.formData.class_id = ''
        this.formData.section_id = ''
        this.formData.subject = ''
        this.formData.teacher_id = ''
        this.formData.room_id = ''
        this.filtter()
        this.getDataList()
    }
}
</script>


<style scoped>

</style>
