<template>
    <div class="dashboard">
        <h2 style="padding-top: 0px, margin-top: 0px">
            Admin dashboard (Order parameters data)
        </h2>
        <vue-table
            :item="items.parameterTypes"
            :index="0"
            name="Parametrų tipai"
            :showHeader="true"
            @clicked="getSearchedData"
            @delete="deleteType"
            @edit="editParamType"
            @refresh="handleClose"
            @submitItem="submitParamType">
            <template v-slot:editItem>
                <input type="text" v-model="paramTypeForm.title">
                <input type="text" v-model="paramTypeForm.title_en">
                <input type="checkbox" v-model="paramTypeForm.allow_many">
                <!-- <button @click="handleClose">Cancel</button>
                <button @click="submitParamType">Submit</button> -->
            </template>
        </vue-table>
        <vue-table
            :item="items.parameters"
            :index="1"
            name="Parametrai"
            :showHeader="false">
        </vue-table>
    </div>
</template>
<script>
import VueTable from '../components/Table.vue'
export default {
    components: {
        VueTable
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
                        { dataIndex: 'id', title: '#' },
                        { dataIndex: 'title', title: 'title' },
                        { dataIndex: 'title_en', title: 'english title' },
                        { dataIndex: 'allow_many', title: 'allow many' },
                        { dataIndex: 'actions', title: 'actions' },
                    ],
                    data: []
                },
                parameters: {
                    columns: [
                        { dataIndex: 'id', title: '#' },
                        { dataIndex: 'title', title: 'title' },
                        { dataIndex: 'title_en', title: 'title_en' },
                        { dataIndex: 'price', title: 'price' },
                        { dataIndex: 'parameter_type_id', title: 'parameter type' },
                        { dataIndex: 'door_type_id', title: 'door type' },
                    ],
                    data: []
                }
            }
        }
    },
    computed: {
        dataSource () {
            return this.paramTypes.filter(elem => !this.search || elem.title.includes(this.search) || elem.title_en.includes(this.search))
        }
    },
    created(){
        this.fetchPTData();
        this.fetchPData();
        this.fetchDoorData();
        this.origPTForm = _.cloneDeep(this.paramTypeForm);
    },
    methods: {
        getSearchedData (search) {
            this.search = search
            this.items.parameterTypes.data = this.dataSource
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
        deleteType(type){
            axios.delete('/api/param-types/' + type.id)
            .then((response) => {
                let item = this.paramTypes.find(el => el.id == type.id)
                let index = this.paramTypes.indexOf(item)
                this.paramTypes.splice(index, 1);
            })
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
</style>
