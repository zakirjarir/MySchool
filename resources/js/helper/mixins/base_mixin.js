import * as XLSX from "xlsx";
import jsPDF from "jspdf";
import "jspdf-autotable";


const base_mixin = {
    data(){
        return {
            // selectData : []
        }
    },
    computed: {
        dataList() {
            return this.$store.getters.dataList;
        },
        data() {
            return this.$store.getters.data;
        },
        generalData() {
            return this.$store.getters.generalData;
        },
        moduleList() {
            return this.$store.getters.moduleList;
        },
        allModule() {
            return this.$store.getters.allModule;
        },
        permissions() {
            return this.$store.getters.permissions;
        },
        formFilter() {
            return this.$store.getters.formFilter;
        },
        formData() {
            return this.$store.getters.formData;
        },
        updateId() {
            return this.$store.getters.updateId;
        },
        selectData() {
            return this.$store.getters.selectData;
        },
        errors() {
            return this.$store.getters.errors;
        },
    },
    methods: {
        openModal: function (openModal = {}) {
            const _this = this;
            $.each(openModal, function (key, value) {
                _this.formData[key] = value;
            });

            $('#modal').modal('show');
        },

        dataForm: function (path) {
            this.$router.push(path);
        },

        redirect: function () {
            if (this.$router) {
                this.$router.go(-1);
            } else {
                window.history.back();
            }
        },

        haidModal: function (callback = false) {
            $('#modal').modal('hide');
            if (typeof callback == 'function') {
                callback(true);
            }
        },

        resetForm: function (formData) {
            $.each(formData, function (index,) {
                formData[index] = '';
            });
        },

        editData(data, id) {
            this.$store.commit('formData', data);
            this.$store.commit('updateId', id);
            this.openModal();
            console.log(id, this.updateId);
        },

        editFormData(data, id, path) {
            this.formData = data;
            this.updateId = id;
            this.$router.push(`${path}/${id}`);
            this.getEditForaData()
        },


        urlGenerate(customUrl = false) {
            const _this = this;
            if (customUrl) {
                return `${baseUrl}/${customUrl}`;
            }
            return `${baseUrl}/${_this.$route.meta.dataUrl}`;
        },


        urlGenerateWithId(url = false, id = null) {
            if (url && id) {
                return `${this.baseUrl}/${url}/${id}`;
            } else if (id) {
                return `${this.baseUrl}/${this.$route.meta.dataUrl}/${id}`;
            } else if (url) {
                return `${this.baseUrl}/${url}`;
            } else {
                return `${this.baseUrl}/${this.$route.meta.dataUrl}`;
            }
        },


        handleKeyword(event) {
            this.formFilter.keyword = event.target.value;
            console.log(this.formFilter.keyword);
        },


        textShorten(text, limit = 100) {
            if (text.length > limit) {
                return text.substring(0, limit) + ' ' + ' ....';
            }
            return text;
        },
        can(...permissions) {
            if (!this.moduleList || !this.moduleList.permissions) {
                return false;
            }
            return permissions.some(permission => this.moduleList.permissions.includes(permission));
        },


        limitData(data, limit) {
            const firstFour = data.slice(0, limit);
            console.log(firstFour);
            return firstFour;
        },

        downloadExcel(data, name) {
            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, name);
            XLSX.writeFile(workbook, name + ".xlsx");
        },

        downloadPDF(title = 'Class Routine', data = '#table') {
            const doc = new jsPDF();
            doc.text(title, 10, 10);
            doc.autoTable({ html: data });
            doc.save("class_routine.pdf");
        },

        filterData(dataList = []) {
            let result = [];
            if (Array.isArray(dataList) && dataList.length > 0) {
                for (const data of dataList) {
                    if (Array.isArray(data)) {
                        result = result.concat(filterData(data));
                    } else if (typeof data === 'object' && data !== null) {
                        result.push(data);
                    }
                }
            }
            return result;
        },

        showStatus : function (status, activeTest = 'Active', inActiveTest = 'Inactive') {
            if (parseInt(status) === 1){
                return `<span class="badge badge-success">${activeTest}</span>`
            }
            return `<span class="badge badge-danger">${activeTest}</span>`
        },

        tryChangeStatus(id) {
            if(id === 1){
                this.toastAlert('error','Sorry This is Owner')
                return
            }
            this.changeStatus(id)
        },

        selectAll(event) {
            if (event.target.checked) {
                this.selectedIds = this.dataList.data.map(item => item.id);
            } else {
                this.selectedIds = [];
            }
        },


        downloadFile(filePath) {
            const fullUrl = `${this.baseUrl}/${filePath}`;
            const link = document.createElement("a");
            link.href = fullUrl;
            link.setAttribute("download", filePath.split("/").pop());
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },

        print() {
            window.print();
        },



        redirectWithId(id , path) {
            this.$router.push({ name: path, params: { id } });
        },
    }
}
export default base_mixin

