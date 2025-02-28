<template>
    <pageLayouts :pageTitle="pageTitle" :buttonTitle="buttonTitle" :showAddButton="showAddButton" :headers="headers">
        <template v-slot:page_top>
            <page-top page-title="Role Permission"></page-top>
        </template>
        <template v-slot:filter >
            <div class="col-md-4">
                <select @change="getDataList()" v-model="formFilter.role_id" class="form-select">
                    <option disabled value="" >Select One</option>
                    <option :value="data.id" v-for="data in generalData.data" > {{data.display_name}}</option>
                </select>
            </div>
        </template>
        <template v-slot:thead>
            <tr>
                <th class="text-center"><input type="checkbox"></th>
                <th class="text-center">Index</th>
                <th class="text-start">Name</th>
                <th class="text-center">Permission</th>
                <th class="text-center">Action</th>
            </tr>
        </template>

        <template v-slot:data>
            <tr v-for="(mod, index) in allModules.data" :key="mod.id">
                <td><input @click="selectModule($event , mod)" type="checkbox"></td>
                <td class="text-center">{{ index + 1 }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <input :checked="modules.includes(mod.id)" class="me-2" @click="setParmissions($event, mod.id, null)" type="checkbox">
                        <label class="fw-bold">{{ mod.display_name }}</label>
                    </div>
                    <!-- Permissions -->
                    <div class=" ms-4 mt-1 d-flex flex-wrap gap-2">
                        <div v-for="par in mod.permissions" :key="par.id" class="">
                            <input  :checked="permissions.includes(par.id)" class="me-1" @click="setParmissions($event, null, par.id)" type="checkbox">
                            <label class="fw-medium">{{ par.display_name }}</label>
                        </div>
                    </div>
                </td>

                <!-- Submenus -->
                <td>
                    <div class="row">
                        <div v-for="sub in mod.submenus" :key="sub.id" class="mb-2  col-md-4 col-lg-4 col-sm-12">
                            <div class="d-flex align-items-center">
                                <input :checked="modules.includes(sub.id)" class="me-2" @click="setParmissions($event, sub.id, null)" type="checkbox">
                                <label class="fw-semibold">{{ sub.display_name }}</label>
                            </div>

                            <!-- Submenu Permissions -->
                            <div  v-if="sub.permissions && sub.permissions.length" class="ps-4">
                                <div v-for="subpar in sub.permissions" :key="subpar.id" class="d-flex align-items-center">
                                    <input  :checked="permissions.includes(subpar.id)" class="me-2" @click="setParmissions($event, subpar.id, null)" type="checkbox">
                                    <label class="">{{ subpar.display_name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- Delete Button -->
                <td class="text-center">
                    <a class="text-danger fs-6 " @click="dataDelet(mod.id)">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
        </template>


    </pageLayouts>
</template>
<script>
import pageLayouts from "../components/pageLayouts.vue";
import PageTop from "../components/pageTop.vue";

export default {
    name: "rolePermission",
    components: {PageTop, pageLayouts},
    data() {
        return {
            showAddButton: false,
        };
    },
    methods:{
        setParmissions(event , module_id = 0 ,permission_id = 0 ) {
            const _this = this;

            this.formData.role_id = this.formFilter.role_id;

            console.log( this.formData);

            if (event.target.checked){
                _this.formData.module_id = (module_id);
                _this.formData.permission_id = (permission_id);
                _this.formData.type = 'insert';
            }else{
                _this.formData.module_id = (module_id);
                _this.formData.permission_id = (permission_id);
                _this.formData.type = 'remove';
            }
            _this.httpRequest(
                { method : 'post', url: _this.urlGenerate(), data: _this.formData },
                function (readData) {
                    if( parseInt(readData.status) ===2000) {
                        _this.toastAlert('success', readData.message);
                        _this.getConfigurations()
                    } else {
                        _this.toastAlert('error',readData.message);
                    }
                }
            );

        },

        selectModule(event , module = {} ) {
            if (event.target.checked) {
                console.log(module);
            };
        }
    },
    computed:{
        allModules(){
            const _this = this;
            if (_this.dataList.all_modules !== undefined){
                return _this.dataList.all_modules;
            }
            return {}
        },
        modules(){
            const _this = this;
            if (_this.dataList.modules !== undefined){
                return _this.dataList.modules;
            }
            return [];
        },
        permissions(){
            const _this = this;
            if (_this.dataList.permissions !== undefined){
                return _this.dataList.permissions;
            }
            return [];
        },
    },
    mounted() {
        this.formFilter.role_id =  '';
        this.getDataList();
        this.getGeneralData();
    }
}
</script>

<style scoped>

</style>
