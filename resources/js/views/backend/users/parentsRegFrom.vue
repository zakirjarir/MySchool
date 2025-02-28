<template>
    <div class="container my-2 border border-dark bg-gray-500">
        <h2 class="text-center my-4 text-uppercase">Parent Registration Form</h2>
        <form @submit.prevent="submitForm()" class="p-4 shadow bg-white">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input :class="{'border-danger': errors.name}" type="text" class="form-control" v-model="formData.name" placeholder="Enter full name">
                <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
            </div>

            <!-- Email & Phone -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input :class="{'border-danger': errors.email}" type="email" class="form-control" v-model="formData.email" placeholder="Enter email">
                    <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input :class="{'border-danger': errors.phone}" type="text" class="form-control" v-model="formData.phone" placeholder="Enter phone number">
                    <span class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</span>
                </div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea :class="{'border-danger': errors.address}" class="form-control" v-model="formData.address" rows="2" placeholder="Enter address"></textarea>
                <span class="text-danger" v-if="errors.address">{{ errors.address[0] }}</span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <!-- Profile Picture -->
                    <label class="form-label">Profile Picture</label>
                    <input @change="fileUpload($event, formData, 'profile_photo')" type="file" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Student</label>
                    <multiselect
                        v-if="generalData && generalData.allStudent"
                        class="border border-gray-700"
                        v-model="formData.student_id"
                        :options="generalData.allStudent.map(s => ({ id: s.id, name: s.name }))"
                        label="name"
                        track-by="id"
                        placeholder="Search & Select Student"
                        :searchable="true"
                    />
                    <p v-else>Loading students...</p>

                </div>
            </div>


            <!-- Password -->
<!--            <div class="mb-3">-->
<!--                <label class="form-label"></label>-->
<!--                <input :class="{'border-danger': errors.password}" type="password" class="form-control" v-model="formData.password" placeholder="Enter password">-->
<!--                <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>-->
<!--            </div>-->

            <div class="text-center mt-3" v-if="formData.profile_photo">
                <img :src="`${baseUrl}/${formData.profile_photo}`" class="img-fluid border border-2 border-dark " height="300" width="150"/>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark py-2">Register</button>
            </div>
        </form>
    </div>
</template>


<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

export default {
    name: "parentsRegFrom",
    components: { Multiselect },
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
        this.getGeneralData('genareldata');

    }
}
</script>

<style scoped>

</style>
