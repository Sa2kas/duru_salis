<template>
    <div class="dashboard">
        <h2>
            Manager dashboard
        </h2>
        <input type="text" v-model="paramTypeForm.title">
        <input type="checkbox" v-model="paramTypeForm.allow_many">
        <button @click="clearParamTypeForm">Cancel</button>
        <button @click="submitParamType">Submit</button>
        <table>
            <thead>
                 <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Allow many</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="type in paramTypes" :key="type.id">
                    <td>
                        {{type.id}}
                    </td>
                    <td>
                        {{type.title}}
                    </td>
                    <td>
                        {{type.allow_many}}
                    </td>
                    <td>
                        <button @click="editParamType(type)">Edit</button>
                        <button @click="deleteType(type)">Delete</button>
                    </td>
                </tr>
            </tbody>           
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            paramTypeForm: {
                title: '',
                allow_many: false,
            },
            origTypeForm: {},
            paramTypes: [],
        }
    },
    created(){
        this.fetchData();
        this.origTypeForm = _.cloneDeep(this.paramTypeForm);
    },
    methods: {
        fetchData(){
            axios.get('/api/param-types')
            .then(response => {
                this.paramTypes = response.data.data;
            });
        },
        deleteType(type){
            axios.delete('/api/param-types/' + type.id)
            .then(response => {
                let item = this.paramTypes.find(el => el.id == type.id)
                let index = this.paramTypes.indexOf(item)
                this.paramTypes.splice(index, 1);
            })
        },
        editParamType(type){
            this.paramTypeForm = type;
        },
        clearParamTypeForm(){
            this.paramTypeForm = _.cloneDeep(this.origTypeForm);
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
                this.clearParamTypeForm();
            })
        }
    }
}
</script>
<style>
    .dashboard {
        min-height: calc(100vh - 40px);
    }
</style>
