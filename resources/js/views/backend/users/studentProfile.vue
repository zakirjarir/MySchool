<template>
    <div class="container mt-5">
        <div class="profile-container" id="printProfile">
            <div class="profile-header">
                <img :src="data.photo ? baseUrl + '/' + data.photo : 'https://static-00.iconduck.com/assets.00/profile-default-icon-2048x2045-u3j7s5nj.png'" height="200" width="200" class="rounded-circle">
                <h3>{{data.name}}</h3>
                <p class="text-muted">{{data.Student_id}}</p>
            </div>

            <div class="row">
                <!-- Personal Info -->
                <div class="col-md-6">
                    <div class="info-card">
                        <h5 class="mb-3">🧑 Personal Information</h5>
                        <div class="info-item"><i class="fas fa-envelope"></i> Email : {{data.email}}</div>
                        <div class="info-item"><i class="fas fa-phone"></i> Phone : {{data.phone}}</div>
                        <div class="info-item"><i class="fas fa-calendar"></i> DOB : {{data.dob}}</div>
                        <div class="info-item"><i class="fas fa-venus-mars"></i> Gender : {{data.gender}}</div>
                        <div class="info-item"><i class="fas fa-map-marker-alt"></i> Address : {{data.address}}</div>
                        <div class="info-item"><i class="fas fa-tint"></i> Blood Group : {{data.blood_group}}</div>
                    </div>
                </div>

                <!-- Academic Info -->
                <div class="col-md-6">
                    <div class="info-card">
                        <h5 class="mb-3">🎓 Academic Information</h5>
                        <div class="info-item"><i class="fas fa-user-graduate"></i> Roll No: {{data.roll_no}}</div>
                        <div class="info-item"><i class="fas fa-school"></i> Class : {{data.class}}</div>
                        <div class="info-item"><i class="fas fa-users"></i> Section : A</div>
                        <div class="info-item"><i class="fas fa-id-badge"></i> Admission No : {{data.admission_no}}</div>
                        <div class="info-item"><i class="fas fa-calendar-check"></i> Admission Date: {{data.admission_date}}</div>
                    </div>
                </div>

                <!-- Guardian Info -->
                <div class="col-md-6">
                    <div class="info-card">
                        <h5 class="mb-3">👨‍👩‍👦 Guardian Information</h5>
                        <div class="info-item"><i class="fas fa-user"></i> Guardian : {{data.guardian_name}}</div>
                        <div class="info-item"><i class="fas fa-phone"></i> Phone : {{data.guardian_phone}}</div>
                        <div class="info-item"><i class="fas fa-user-friends"></i> Relation : {{data.guardian_relation}}</div>
                        <div class="info-item"><i class="fas fa-home"></i> Address :{{data.guardian_address}} </div>
                    </div>
                </div>

                <!-- Security Info -->
                <div class="col-md-6">
                    <div class="info-card">
                        <h5 class="mb-3">🔐 Security Information</h5>
                        <div class="info-item"><i class="fas fa-fingerprint"></i> Fingerprint : {{data.fingerprint_template}}</div>
                        <div class="info-item"><i class="fas fa-id-card"></i> RFID Card : {{data.rfid_card_number}}</div>
                        <div class="info-item"><i class="fas fa-toggle-on"></i> Status : {{data.status == 1 ? 'Active' : 'Inactive' }}</div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex  justify-content-end gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="print()">📜 Print Profile</button>
                <button class="btn btn-outline-dark btn-sm">✏ Edit Profile</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "studentProfile",
    mounted() {
        this.getData(this.$route.params.id ,'users/students');
    }
}
</script>

<style scoped>

.profile-container {
    max-width: 900px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
.profile-header {
    text-align: center;
    margin-bottom: 20px;
}
.profile-header img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #28a745;
}
.info-card {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
}
.info-item {
    display: flex;
    align-items: center;
    font-size: 16px;
    margin-bottom: 10px;
}
.info-item i {
    width: 30px;
    color: #28a745;
    font-size: 18px;
    margin-right: 10px;
}

/* Print Styling */
@media print {

    .btn-group {
        display: none;
    }
}

</style>
