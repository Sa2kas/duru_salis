<template>
    <div class="dashboard">
        <h2 style="padding-top: 0px, margin-top: 20px">
            
        </h2>
        <vue-table
            :item="items.parameterTypes"
            :index="0"
            :name="$i18n.locale == 'lt' ? 'Parametrų tipai' : 'Parameter types'"
            :showHeader="false"

            @delete="deleteType"
            @edit="editParamType"
            @refresh="handleClose"
            @submitItem="submitParamType">
            <template v-slot:editItem>
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'LT antraštė' : 'LT title'}}</div>
                <input class="modal-form-input" type="text" v-model="paramTypeForm.title">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'EN antraštė' : 'EN title'}}</div>
                <input class="modal-form-input" type="text" v-model="paramTypeForm.title_en">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Leisti daug' : 'Allow many'}}</div>
                <div><input class="modal-form-checkbox" type="checkbox" v-model="paramTypeForm.allow_many"></div>
                <!-- <button @click="handleClose">Cancel</button>
                <button @click="submitParamType">Submit</button> -->
            </template>
        </vue-table>
        <vue-table
            @clicked="getSearchedData2"
            :item="items.parameters"
            :index="1"
            :name="$i18n.locale == 'lt' ? 'Parametrai' : 'Parameters'"
            :showHeader="true"
            :showAdd="false">
            <template v-slot:editItem>
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'LT antraštė' : 'LT title'}}</div>
                <input class="modal-form-input" type="text" v-model="paramTypeForm.title">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'EN antraštė' : 'EN title'}}</div>
                <input class="modal-form-input" type="text" v-model="paramTypeForm.title_en">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Parametro tipas' : 'Parameter type'}}</div>
                <select style="height: 28px" v-model="paramForm.parameter_type_id"  class="modal-form-input">
                    <option v-for="type in paramTypes" :key="type.id" :value="type.id" >
                        {{$i18n.locale == 'lt' ? type.title : type.title_en}}
                    </option>
                </select>
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Durų tipas' : 'Door type'}}</div>
                <select style="height: 28px" v-model="paramForm.parameter_type_id"  class="modal-form-input">
                    <option v-for="type in doorTypes" :key="type.id" :value="type.id" >
                        {{$i18n.locale == 'lt' ? type.title : type.title_en}}
                    </option>
                </select>
            </template>
        </vue-table>
    </div>
</template>
<script>
import VueTable from '../components/Table.vue'
import PdfGenerator from '../components/PdfGeneration.vue'
export default {
    components: {
        VueTable,
        PdfGenerator
    },
    data() {
        return {
            paramTypeForm: {
                title: '',
                title_en: '',
                allow_many: false,
            },
            paramForm: {
                title: '',
                title_en: '',
                price: 0,
                parameter_type_id: '',
                door_type_id: ''
            },
            origPTForm: {},
            paramTypes: [],
            params: [],
            doorTypes: [],
            search: '',
            items: {
                parameterTypes : {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#'},
                        { dataIndex: 'title', title: 'title', name: this.$i18n.locale == 'lt' ? 'LT antraštė' : 'LT title' },
                        { dataIndex: 'title_en', title: 'english title', name: this.$i18n.locale == 'lt' ? 'EN antraštė' : 'EN title' },
                        { dataIndex: 'allow_many', title: 'allow many', name: this.$i18n.locale == 'lt' ? 'Leisti daug' : 'Allow many' },
                        { dataIndex: 'actions', title: 'actions', name: this.$i18n.locale == 'lt' ? 'Veiksmai' : 'Actions' },
                    ],
                    data: []
                },
                parameters: {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#' },
                        { dataIndex: 'title', title: 'title', name: this.$i18n.locale == 'lt' ? 'LT antraštė' : 'LT title' },
                        { dataIndex: 'title_en', title: 'title_en', name: this.$i18n.locale == 'lt' ? 'EN antraštė' : 'EN title' },
                        { dataIndex: 'price', title: 'price', name: this.$i18n.locale == 'lt' ? 'Kaina' : 'Price' },
                        { dataIndex: 'parameter_type_id', title: 'parameter type', name: this.$i18n.locale == 'lt' ? 'Parametrų tipo id' : 'Parameter type id' },
                        { dataIndex: 'door_type_id', title: 'door type', name: this.$i18n.locale == 'lt' ? 'Durų tipo id' : 'Door type id' },
                    ],
                    data: []
                }
            }
        }
    },
    computed: {
        dataSource () {
            return this.paramTypes.filter(elem => !this.search || elem.title.toLowerCase().includes(this.search.toLowerCase()) || elem.title_en.includes(this.search))
        },
        dataSource2 () {
            return this.params.filter(elem => !this.search || elem.title.toLowerCase().includes(this.search.toLowerCase()) || elem.title_en.includes(this.search))
        },
    },
    created(){
        this.fetchPTData();
        this.fetchDTData();
        this.fetchPData();
        this.fetchDoorData();
        this.origPTForm = _.cloneDeep(this.paramTypeForm);
    },
    methods: {
        getSearchedData (search) {
            this.search = search
            this.items.parameterTypes.data = this.dataSource
        },
        getSearchedData2 (search) {
            this.search = search
            this.items.parameters.data = this.dataSource2
        },
        fetchDoorData(){
            axios.get('/api/doors')
            .then(response => {
                this.doors = response.data.data;
            });
        }, 
        fetchPTData(){
            axios.get('/api/param-types')
            .then(response => {
                this.paramTypes = response.data.data;
                this.items.parameterTypes.data = response.data.data;
            });
        },
        fetchPData(){
            axios.get('/api/params')
            .then(response => {
                this.params = response.data.data;
                this.items.parameters.data = response.data.data;
            });
        },
        fetchDTData(){
            axios.get('/api/door-types')
            .then(response => {
                this.doorTypes = response.data.data;
            });
        },
        deleteType(type){
            axios.delete('/api/param-types/' + type.id)
            .then((response) => {
                let item = this.paramTypes.find(el => el.id == type.id)
                let index = this.paramTypes.indexOf(item)
                this.paramTypes.splice(index, 1);
            })
            .catch(function (err) {
                    alert(this.$i18n == 'lt' ? 'Elementas negali būti pašalintas' : "Element cannot be removed")
                });
        },
        editParamType(type){
            this.paramTypeForm = type;
        },
        clearParamTypeForm(){
            this.paramTypeForm = _.cloneDeep(this.origPTForm);
        },
        submitParamType(){
            axios.post('/api/param-types', this.paramTypeForm)
            .then(response => {
                if(this.paramTypeForm.id){
                    let item = this.paramTypes.find(el => el.id == response.data.data.id)
                    let index = this.paramTypes.indexOf(item);
                    // this.paramTypes[index] = response.data.data <= taip nedaryti
                    this.$set(this.paramTypes, index, response.data.data)
                }else{
                    this.paramTypes.push(response.data.data)
                }
                this.handleClose();
            })
        },
        handleClose() {
            this.paramTypeForm = _.cloneDeep(this.origPTForm);
            this.fetchPTData();
        }
    }
}
</script>
<style>
    .dashboard {
        padding: 53px 1vw 0 1vw;
    }
    .modal-form-label {
        font-size: min(3.5vw, 16px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        margin: 1rem 0 0.2rem 0;
    }
    .modal-form-input {
        width: 100%;
        max-width: 175px;
        border: 1px solid #afafaf;
        border-radius: 7px;
        transition: border .2s linear,box-shadow .2s linear;
        font-size: 11px;
        padding: 0.3em 1em;
        height: 22px;
    }
    .modal-form-checkbox {
        border: 1px solid #afafaf;
        border-radius: 4px;
        transition: border .2s linear,box-shadow .2s linear;
        display: flex;
        float: left;
        font-size: 11px;
        height: 14px;
        margin-left: -1px;
    }
</style>
