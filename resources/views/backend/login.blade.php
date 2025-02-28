<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.47/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{asset('backend/css/login.css')}}">
</head>
<body>
<div class="pagebody" style="background-image: url('https://s39613.pcdn.co/wp-content/uploads/2019/08/iStock-528978494-170719.jpg');">
    <div class="login-container" id="app">
        <h3 class="text-center mb-4 text-primary">Login</h3>
        <span v-if="errors" class="text-danger text-center">@{{errors }}</span>
        <form @submit.prevent="login()">
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="formData.email" :class="{' border border-2 border-danger': errors.email}" type="email" id="email" class="form-control" placeholder="Enter your email" >
                <span class="text-danger" v-if="message.email">@{{message.email[0]}} </span>
            </div>
            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input v-model="formData.password" :class="{' border border-2 border-danger': errors.password}" type="password" id="password" class="form-control" placeholder="Enter your password" >
                    <span class="input-group-text" @click="togglePassword()">
                        <i id="toggleIcon" class="bi bi-eye"></i>
                    </span>
                </div>
                <span class="text-danger" v-if="message.password">@{{message.password[0]}} </span>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Forgot Password -->
        <div class="text-center mt-3">
            <a href="#" class="text-decoration-none text-primary">Forgot Password?</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script type="module">

    // import axios from "axios";
    const app = Vue.createApp({
        data() {
            return {
                formData: {
                    email: '',
                    password: ''
                },
                errors: '',
                message: ''
            };
        },
        methods: {
            async login() {
                try {
                    const response = await axios.post('api/login', this.formData);
                    if (parseInt(response.data.status) === 2000) {
                        console.log('fhcbdjfvb')
                        location.replace('/admin/dashboard')
                    } else {
                        this.errors = response.data.result;
                        console.log(this.message);
                        this.message = response.data.message;
                    }
                } catch (error) {
                    console.error('An error occurred:', error);
                    this.errors = 'Something went wrong. Please try again.';
                }
            },


            togglePassword() {
                let passwordInput = document.getElementById("password");
                let toggleIcon = document.getElementById("toggleIcon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    toggleIcon.classList.remove("bi-eye");
                    toggleIcon.classList.add("bi-eye-slash");
                } else {
                    passwordInput.type = "password";
                    toggleIcon.classList.remove("bi-eye-slash");
                    toggleIcon.classList.add("bi-eye");
                }
            }
        }
    });
    app.mount('#app');
</script>

</body>
</html>
