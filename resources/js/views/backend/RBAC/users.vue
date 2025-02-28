<template>
    <pageLayouts :pageTitle="pageTitle" :buttonTitle="buttonTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top  :treger="openModal" page-title="Users -- "></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-2 col-sm-6">
                <select @change="getDataList()" v-model="formFilter.role_id" class="form-select">
                    <option value="" >Select Role</option>
                    <option :value="data.id" v-for="data in generalData.data" > {{data.display_name}}</option>
                </select>
            </div>
        </template>
        <template v-slot:data>
            <tr v-for="(data ,index) in dataList.data" >
                <td><input type="checkbox"></td>
                <td>{{index +1}}</td>
                <td>
                    <a>
                        <img id="img" :src="data.profile_picture ? baseUrl + '/' + data.profile_picture : 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png'" alt="Profile" height="40px" width="40px" class="rounded-circle">
                    </a>
                    {{ data.name }}
                </td>
                <td>{{data.email}}</td>
                <td>
                    <a v-if="can('users_status')" @click="tryChangeStatus(data.id)" v-html="showStatus(data.status)"></a>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <p v-if="can('users_edit','users_update')" @click="editData(data ,data.id)"><i class="fa-regular fa-pen-to-square"></i></p>
                        <p v-if="can('users_destroy')" @click="deletData(data.id)"><i class="far fa-trash-alt text-danger"></i></p>
                    </div>
                </td>
            </tr>
        </template>
    </pageLayouts>
    <modal-layouts modalTitle=" Add User">
        <div>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input :class="{'border-danger': errors.name}" class="form-control" type="text" v-model="formData.name" placeholder="Enter Name..">
                <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
            </div>
           <div class="form-group">
               <label class="form-label">Email</label>
               <input :class="{'border-danger': errors.email}" class="form-control" type="email" name="permission" v-model="formData.email" placeholder="Enter Email..">
               <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span>
           </div>
           <div class="form-group">
               <label class="form-label">Select Role</label>
               <select :class="{'border-danger': errors.role_id}" v-model="formData.role_id" class="form-select">
                   <option disabled value=""> Select one</option>
                   <option :value="data.id" v-for="data  in generalData.data" >{{data.display_name}}</option>
               </select>
               <span class="text-danger" v-if="errors.role_id">{{errors.role_id[0]}}</span>
           </div>
            <div v-if="updateId" >
                <div class="form-group">
                    <label class="form-label"> Old Password</label>
                    <input :class="{'border-danger': errors.old_password}" class="form-control" type="text"  v-model="formData.old_password" placeholder="Enter Password..">
                    <span class="text-danger" v-if="errors.old_password">{{errors.old_password[0]}}</span>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input :class="{'border-danger': errors.new_password}" class="form-control" type="text"  v-model="formData.new_password" placeholder="Enter Password..">
                    <span class="text-danger" v-if="errors.new_password">{{errors.new_password[0]}}</span>
                </div>
            </div>
            <div v-else class="form-group">
                <label class="form-label">Password</label>
                <input :class="{'border-danger': errors.password}" class="form-control" type="text" name="password" v-model="formData.password" placeholder="Enter Password..">
                <span class="text-danger" v-if="errors.name">{{errors.password[0]}}</span>
            </div>

        </div>
    </modal-layouts>

</template>
<script>
import pageLayouts from "../components/pageLayouts.vue";
import ModalLayouts from "../components/modalLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "users",
    components: {PageTop, ModalLayouts, pageLayouts},
    data() {
        return {
            showAddButton: false,
            headers: ["ID", "Name", "Email", "Status","Action"],
        }
    },
    mounted() {
        this.getDataList()
        this.getGeneralData();
        this.formFilter.role_id = ""
        this.formData.role_id = ""
    }
}
</script>
<style scoped>

</style>
