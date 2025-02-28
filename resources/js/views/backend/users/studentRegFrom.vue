<template>
    <div class="container my-2 border border-dark bg-gray-500">
        <h2 class="text-center my-4 text-uppercase">Student Registration Form</h2>
        <form @submit.prevent="submitForm()" class="p-4 shadow bg-white">
            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input :class="{'border-danger': errors.name}" type="text" class="form-control" v-model="formData.name" name="name" placeholder="Enter full name">
                <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
            </div>

            <!-- Email & Phone -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input :class="{'border-danger': errors.email}" type="email" class="form-control" v-model="formData.email" name="email" placeholder="Enter email address">
                    <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input :class="{'border-danger': errors.phone}" type="text" class="form-control" v-model="formData.phone" name="phone" placeholder="Enter phone number">
                    <span class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</span>
                </div>
            </div>

            <!-- Date of Birth & Gender -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input :class="{'border-danger': errors.dob}" type="date" class="form-control" v-model="formData.dob" name="dob">
                    <span class="text-danger" v-if="errors.dob">{{ errors.dob[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select :class="{'border-danger': errors.gender}" class="form-select" v-model="formData.gender" name="gender">
                        <option value="" disabled>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <span class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</span>
                </div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea :class="{'border-danger': errors.address}" class="form-control" name="address" v-model="formData.address" rows="2" placeholder="Enter full address"></textarea>
                <span class="text-danger" v-if="errors.address">{{ errors.address[0] }}</span>
            </div>

            <!-- Roll Number & Class -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Class</label>
                    <select :class="{'border-danger': errors.class}" class="form-select" v-model="formData.class" name="class_id">
                        <option value="" disabled>Select class</option>
                        <option v-for="cls in generalData.allClasses" :value="cls.name">{{ cls.name }}</option>
                    </select>
                    <span class="text-danger" v-if="errors.class">{{ errors.class[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <!-- Blood Group -->
                    <label class="form-label">Blood Group</label>
                    <input :class="{'border-danger': errors.blood_group}" type="text" class="form-control" v-model="formData.blood_group" name="blood_group" placeholder="Enter blood group">
                    <span class="text-danger" v-if="errors.blood_group">{{ errors.blood_group[0] }}</span>
                </div>
            </div>

            <!-- Guardian's Name & Phone -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Guardian's Name</label>
                    <input :class="{'border-danger': errors.guardian_name}" type="text" class="form-control" v-model="formData.guardian_name" name="guardian_name" placeholder="Enter guardian's name">
                    <span class="text-danger" v-if="errors.guardian_name">{{ errors.guardian_name[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Guardian's Phone</label>
                    <input :class="{'border-danger': errors.guardian_phone}" type="text" class="form-control" v-model="formData.guardian_phone" name="guardian_phone" placeholder="Enter guardian's phone">
                    <span class="text-danger" v-if="errors.guardian_phone">{{ errors.guardian_phone[0] }}</span>
                </div>
            </div>

            <!-- Guardian's Relation & Address -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Guardian's Relation</label>
                    <input :class="{'border-danger': errors.guardian_relation}" type="text" class="form-control" v-model="formData.guardian_relation" name="guardian_relation" placeholder="Enter relation with guardian">
                    <span class="text-danger" v-if="errors.guardian_relation">{{ errors.guardian_relation[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Guardian's Address</label>
                    <textarea :class="{'border-danger': errors.guardian_address}" class="form-control" v-model="formData.guardian_address" name="guardian_address" rows="2" placeholder="Enter guardian's address"></textarea>
                    <span class="text-danger" v-if="errors.guardian_address">{{ errors.guardian_address[0] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Section</label>
                    <select :class="{'border-danger': errors.section}" class="form-select" v-model="formData.section">
                        <option value="" disabled>Select section</option>
                        <option v-for="section in generalData.allSection"  :value="section.name">{{ section.name }}</option>
                    </select>
                    <span class="text-danger" v-if="errors.section">{{ errors.section[0] }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <!-- Profile Photo -->
                    <label class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" @change="fileUpload($event, formData, 'photo')">
                </div>
            </div>
            <div class="text-center mt-3" v-if="formData.phto">
                <img :src="`${baseUrl}/${formData.photo}`" class="img-fluid border border-2 border-dark " height="300" width="150"/>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark py-2">Register Student</button>
            </div>
        </form>
    </div>
</template>



<script>
export default {
    name: "studentRegFrom",
    mounted() {
        this.formData.gender = ""
        this.formData.class = ""
        this.formData.section = ""
        this.getGeneralData('genareldata');
    }
}
</script>

<style scoped>

</style>
