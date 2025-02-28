<template>
    <div class="container my-2 border border-dark bg-gray-500" >
        <h2 class="text-center my-4 text-uppercase">Teacher Registration Form</h2>
        <form @submit.prevent="submitForm()" class="p-4 shadow bg-white">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input :class="{'border-danger': errors.name}" type="text" class="form-control" v-model="formData.name" name="name" placeholder="Enter full name" >
                <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
            </div>

            <!-- Email & Phone -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input :class="{'border-danger': errors.email}" type="email" class="form-control" v-model="formData.email" name="email" placeholder="Enter email address" >
                    <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input :class="{'border-danger': errors.phone}" type="text" class="form-control" v-model="formData.phone" name="phone" placeholder="Enter phone number">
                    <span class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</span>
                </div>
            </div>

            <!-- Gender & Date of Birth -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select :class="{'border-danger': errors.gender}" class="form-select" v-model="formData.gender" name="gender">
                        <option value="" disabled>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Female">Other</option>
                    </select>
                    <span class="text-danger" v-if="errors.gender">{{errors.gender[0]}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input :class="{'border-danger': errors.dob}" type="date" class="form-control" v-model="formData.dob" name="dob">
                    <span class="text-danger" v-if="errors.dob">{{errors.dob[0]}}</span>
                </div>
            </div>

            <!-- Blood Group & NID -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Blood Group</label>
                    <input :class="{'border-danger': errors.blood_group}" type="text" class="form-control" v-model="formData.blood_group" name="blood_group" placeholder="Enter blood group">
                    <span class="text-danger" v-if="errors.blood_group">{{errors.blood_group[0]}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">National ID</label>
                    <input :class="{'border-danger': errors.nid}" type="text" class="form-control" v-model="formData.nid" name="nid" placeholder="Enter national ID">
                    <span class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</span>
                </div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea :class="{'border-danger': errors.address}" class="form-control" name="address" v-model="formData.address" rows="2" placeholder="Enter full address"></textarea>
                <span class="text-danger" v-if="errors.address">{{errors.address[0]}}</span>
            </div>

            <!-- Qualification & Designation -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Qualification</label>
                    <textarea :class="{'border-danger': errors.qualification}" class="form-control" name="address" v-model="formData.qualification" rows="2" placeholder="Enter full address"></textarea>
                    <span class="text-danger" v-if="errors.qualification">{{errors.qualification[0]}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Designation</label>
                    <input :class="{'border-danger': errors.designation}" type="text" class="form-control" v-model="formData.designation" placeholder="Enter designation">
                    <span class="text-danger" v-if="errors.designation">{{errors.designation[0]}}</span>
                </div>
            </div>

            <!-- Department & Subjects -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Department</label>
                    <select :class="{'border-danger': errors.class}" v-model="formData.class" class="form-select" >
                        <option value="" disabled>Select Department</option>
                        <option v-for="data in generalData.allClasses" :value="data.id">{{data.name}}</option>
                    </select>
                    <span class="text-danger" v-if="errors.class">{{errors.class[0]}}</span>

                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subjects</label>
                    <select :class="{'border-danger': errors.subject}" v-model="formData.subject" class="form-select" >
                        <option value="" disabled>Select Subject</option>
                        <option v-for="data in generalData.allSubjects" :value="data.id">{{data.name}}</option>
                    </select>
                    <span class="text-danger" v-if="errors.subject">{{errors.subject[0]}}</span>
                </div>
            </div>

            <!-- Joining Date & Salary -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Joining Date</label>
                    <input :class="{'border-danger': errors.joining_date}" type="date" class="form-control" v-model="formData.joining_date" name="joining_date">
                    <span class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Salary</label>
                    <input :class="{'border-danger': errors.salary}" type="number" class="form-control" v-model="formData.salary" name="salary" placeholder="Enter salary amount">
                    <span class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</span>
                </div>
            </div>
            <!-- Role Selection -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Role</label>
                    <select :class="{'border-danger': errors.role}" class="form-select" v-model="formData.role" name="role">
                        <option value="2" selected>Teacher</option>
                    </select>
                </div>
                <!-- Profile Picture -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input  @change="fileUpload($event, formData, 'profile_picture')" type="file" id="profile_picture" :class="{'border-danger': errors.profile_picture}"  class="form-control" name="profile_picture">
                </div>
            </div>

            <div class="text-center mt-3" v-if="formData.profile_picture">
               <img :src="`${baseUrl}/${formData.profile_picture}`" class="img-fluid border border-2 border-dark " height="300" width="150"/>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-outline-dark py-2">Register</button>
            </div>
        </form>
    </div>
</template>


<script>
export default {
    name: "teacherRegFrom",
    mounted() {
        this.formData.subject = ""
        this.formData.role = "2"
        this.formData.gender = ""
        this.formData.class = ""
        this.getGeneralData('genareldata');
    }
}
</script>

<style scoped>

</style>
