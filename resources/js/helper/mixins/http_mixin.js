import Swal from 'sweetalert2';
import router from "../../routes";
const http_mixin = {
    data() {
        return {
            baseUrl: baseUrl,
            loading:false
        }
    },
    methods: {
        httpRequest : function(httpObject = {method : 'get', url : false, data : {}, params : {}}, callback = false) {
            const _this = this;
            const httpMethod = httpObject.method !== undefined ? httpObject.method : 'get';
            const httpData = httpObject.data || {};
            const httpParams = httpObject.params || {};
            const httpUrl = httpObject.url;

            _this.axios({
                method: httpMethod,
                url: httpUrl,
                params: httpParams,
                data: httpData
            }).then(response => {
                if (typeof callback === 'function') {
                    callback(response.data);
                }
            })
            //     .catch(function(error) {
            //     _this.toastAlert('error' , 'Whoops..!! something went wrong', error);
            //     console.log(error);
            // });
        },

        getDataList : function (page = 1, callback  = false) {
            const _this = this;
            this.loading = true;
            _this.httpRequest({
                url :_this.urlGenerate(),
                params : Object.assign({page:page}, _this.formFilter)
            },function (readData) {
                if (parseInt(readData.status) === 2000) {
                    _this.loading = false;
                    _this.$store.commit('dataList', readData.result);
                }
                else if (parseInt(readData.status) === 4001) {
                    router.push('/notfound');
                }
            })
        },
        getData(id = null , url  = false) {
            const _this = this;
            this.loading = true;
            _this.httpRequest({
                url :_this.urlGenerateWithId( url , id),
            },function (readData) {
                if (parseInt(readData.status) === 2000) {
                    _this.loading = false;
                    _this.$store.commit('data', readData.result);
                }
                else if (parseInt(readData.status) === 4001) {
                    router.push('/notfound');
                }
            })
        },

        getGeneralData : function (url = 'rbac/roles') {
            const _this = this;
            _this.httpRequest({
                url :_this.urlGenerate(url),
                method : 'get',
            },function (readData) {
                if (readData.result) {
                    _this.$store.commit('generalData', readData.result);
                }
            })
        },

        getEditForaData : function () {
            const _this = this;
            this.loading = true;
            this.formFilter.id = this.$route.params.id;
            console.log(this.$route.params.id);
            _this.httpRequest({
                url :_this.urlGenerate(),
                params : Object.assign(_this.formFilter)
            },function (readData) {
                _this.loading = false;
                if (parseInt(readData.status) === 2000) {
                    _this.$store.commit('dataList', readData.result);
                }
                else if (parseInt(readData.status) === 4001) {
                    router.push('/notfound');
                }
            })
        },

        submitModal: function (formData = this.formData  ) {
            const _this = this;
            console.log(_this.updateId);
            const method = _this.updateId > 0 ? 'PUT' : 'POST';
            const requestUrl = _this.updateId > 0 ? this.urlGenerateWithId('',`${_this.updateId}`):_this.urlGenerate();
            _this.httpRequest(
                { method : method, url: requestUrl, data: formData },
                function (readData) {
                    if (parseInt(readData.status) === 2000) {
                        _this.haidModal()
                        _this.getDataList()
                        _this.resetForm( _this.formData)
                        _this.toastAlert('success' , readData.message);
                    } else {
                        _this.$store.commit('errors', readData.message);
                        _this.toastAlert('error' , readData.type);
                    }
                }
            );
        },

        submitForm: function (formData = this.formData ) {
            const _this = this;
            const method = this.updateId > 0 ? 'PUT' : 'POST';
            const requestUrl = this.updateId > 0 ? this.urlGenerateWithId('',`${this.updateId}`):this.urlGenerate();
            _this.loading = true;
            _this.httpRequest(
                { method : method, url: requestUrl, data: formData },
                function (readData) {
                    if (parseInt(readData.status) === 2000) {
                        _this.loading = false;
                        _this.redirect();
                        _this.getDataList()
                        _this.resetForm( _this.formData)
                        _this.toastAlert('success' , readData.message);

                    } else {
                        _this.$store.commit('errors', readData.message);
                        console.log(readData);
                        _this.toastAlert('error' , readData.result);
                    }
                }
            );
        },

        fileUpload: function(event, dataObject, dataModel) {
            const _this = this;
            const file = event.target.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('file', file);

                this.httpRequest({ method: 'post', url: `${this.baseUrl}/upload`, data: formData }, function (readData) {
                    if (parseInt(readData.status) === 2000) {
                        dataObject[dataModel] = readData.result;
                        console.log("Uploaded File Path:", dataObject[dataModel]);
                        console.log("Updated Form Data:", _this.formData);
                        _this.toastAlert('success', readData.message);
                    } else {
                        _this.swalAlert('error', 'Upload failed!', 'Oops...!');
                    }
                });
            } else {
                _this.swalAlert('error', 'No file selected!', 'Oops...!');
            }
        },


        deletData: function (id) {
            const _this = this;

            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure to delete this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    _this.loading = true;
                    _this.httpRequest(
                        { method: 'delete', url: _this.urlGenerateWithId('', id) },
                        function (readData) {
                            if (parseInt(readData.status) === 2000) {
                                _this.loading = false;
                                _this.toastAlert('success' , readData.message);
                                _this.getDataList();
                            }else {
                                _this.toastAlert('error' , readData.message);
                            }

                        }
                    );
                }
            });
        },

        deletMaltipleData: function (id) {
            const _this = this;

            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure to delete this data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    _this.loading = true;
                    _this.httpRequest(
                        { method: 'delete', url: _this.urlGenerateWithId('', id) },
                        function (readData) {
                            if (parseInt(readData.status) === 2000) {
                                _this.loading = false;
                                _this.toastAlert('success' , readData.message);
                                _this.getDataList();
                            }else {
                                _this.toastAlert('error' , readData.message);
                            }

                        }
                    );
                }
            });
        },

        changeStatus(id) {
            const _this = this;
            _this.loading = true;
            _this.httpRequest({
                url: _this.urlGenerate(`${_this.$route.meta.dataUrl}/status?id=${id}`),
                method: "POST",
            }, function (readData) {
                if (parseInt(readData.status) === 2000) {
                    _this.loading = false;
                    _this.getDataList();
                    _this.toastAlert('success' , readData.message);
                } else {
                    _this.toastAlert('error' , readData.message);
                }
            });
        },

        getConfigurations : function () {
            const _this = this;
            this.loading = true;
            _this.httpRequest({method:'get', url :_this.urlGenerate('api/configurations')},function (readData) {
                if(parseInt(readData.status) === 2000) {
                    _this.loading = false;
                    _this.$store.commit('moduleList', readData.result);
                }else {
                    _this.toastAlert('error' , readData.message);
                }
            })
        },

    }
}
export default http_mixin
