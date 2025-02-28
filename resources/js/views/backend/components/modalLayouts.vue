<script>
export default {
    name: "modalLayouts",
    props: {
        resetFormData: {
            type: [Boolean],
            default: true
        },
        modalTitle:{
            type: String,
            default: "Modal Title"
        },
        modalId: {
            type: [String],
            default: 'modal'
        },
        modalSize: {
            type: [String],
            default: 'modal-xl'
        },
        backDrop : {
            type: [String],
            default: 'static'
        }
    },
}
</script>

<template>
    <div class="modal" :id="modalId"  tabindex="-1">
        <div class="modal-dialog">
            <form @submit.prevent="submitModal()">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" :id="modalId">{{modalTitle}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-outline-dark rounded-0 btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary rounded-0 btn-sm">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
