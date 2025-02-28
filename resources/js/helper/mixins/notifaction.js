import Swal from 'sweetalert2';

const notifaction = {
    data(){
        return {

        }
    },
    methods: {
        swalAlert(type = success  , message = 'Are you sure?' ,title = 'Are you sure?'){
            Swal.fire({
                icon: type,
                title: title,
                text: message,
            })
        },
        toastAlert(type = 'error', message = 'No message found') {
            this.$toast[type](message);
        }
    }
}
export default notifaction
