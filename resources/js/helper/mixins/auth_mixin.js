import Swal from "sweetalert2";
const auth_mixin = {
    data(){
        return {

        }
    },
    methods: {
        logout() {
            const _this = this;
            const urll = this.urlGenerate('api/logout');
            // SweetAlert2 Confirmation Dialog with custom width and height
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to log out?',
                icon: 'warning',
                showCancelButton: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    _this.httpRequest({ method: 'POST', url: urll }, function (readData) {
                        if (parseInt(readData.status) === 2000) {
                            window.location.replace('/login')
                            location.reload();
                        } else {
                            // SweetAlert 2 error message with custom size
                            Swal.fire({
                                title: 'Error!',
                                text: readData.data.error || 'There was an issue during logout.',
                                icon: 'error',
                                confirmButtonText: 'Ok',
                                width: '400px', // Custom width for error message
                                heightAuto: false // Keep fixed height
                            });
                        }
                    });
                } else {
                    // If user cancels logout
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Logout has been cancelled.',
                        icon: 'info',
                        confirmButtonText: 'Ok',
                        width: '400px', // Custom width for cancelled message
                        heightAuto: false // Keep fixed height
                    });
                }
            });
        }
    }
}
export default auth_mixin;
