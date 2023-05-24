<template>
    <div class="admin-users">
        <h2>
            <vue-table
            :item="items"
            :index="0"
            :name="$i18n.locale == 'lt' ? 'Darbuotojai' : 'Employees'"
            :showHeader="true"
            @delete="deleteUser"
            @edit="editUser"
            @refresh="handleClose"
            @submitItem="submitUser">
            <template v-slot:editItem>
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Vardas, pavardė' : 'Name, surname'}}</div>
                <input class="modal-form-input" type="text" v-model="userForm.name">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'El. paštas' : 'Email'}}</div>
                <input class="modal-form-input" type="text" v-model="userForm.email">
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Rolė' : 'Role'}}</div>
                <select style="height: 28px" v-model="userForm.role_id"  class="modal-form-input">
                    <option v-for="role in roles" :key="role.id" :value="role.id" >
                        {{$i18n.locale == 'lt' ? role.title : role.title_en}}
                    </option>
                </select>
                <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Slaptažodis' : 'Password'}}</div>
                <input class="modal-form-input" type="text" v-model="userForm.password">
            </template>
        </vue-table>
        </h2>
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
    data () {
        return {
            items: {
                data: [],
                columns: [
                    { dataIndex: 'id', title: '#', name: '#' },
                    { dataIndex: 'name', title: 'darbuotojas', name: this.$i18n.locale == 'lt' ? 'Darbuotojas' : 'Employee' },
                    { dataIndex: 'email', title: 'elektroninis paštas', name: this.$i18n.locale == 'lt' ? 'El. paštas' : 'Email' },
                    { dataIndex: 'role_id', title: 'rolė', name: this.$i18n.locale == 'lt' ? 'Rolė' : 'Role' },
                    { dataIndex: 'actions', title: 'actions', name: this.$i18n.locale == 'lt' ? 'Veiksmai' : 'Actions' },
                ]
            },
            roles: [],
            userForm: {
                name: '',
                email: '',
                role_id: 0,
                password: '',
            },
            origUserForm: {},
        }
    },
    methods: {
        fetchUsersData(){
            axios.get('/api/users')
            .then(response => {
                this.items.data = response.data.data;
            });
        }, 
        fetchRolesData() {
            axios.get('/api/roles')
            .then(response => {
                this.roles = response.data.data;
            })
        },
        deleteUser(user){
            axios.delete('/api/users/' + user.id)
            .then((response) => {
                let item = this.items.data.find(el => el.id == user.id)
                let index = this.items.data.indexOf(item)
                this.items.data.splice(index, 1);
            })
        },
        editUser(user){
            this.userForm = user;
        },
        clearUserForm(){
            this.userForm = _.cloneDeep(this.origUserForm);
        },
        submitUser(){
            axios.post('/api/users', this.userForm)
            .then(response => {
                if(this.userForm.id){
                    let item = this.items.data.find(el => el.id == response.data.data.id)
                    let index = this.items.data.indexOf(item);
                    // this.paramTypes[index] = response.data.data <= taip nedaryti
                    this.$set(this.items.data, index, response.data.data)
                }else{
                    this.items.data.push(response.data.data)
                }
                this.handleClose();
            })
        },
        handleClose() {
            this.userForm = _.cloneDeep(this.origUserForm);
            this.fetchUsersData();
        }
    },
    created() {
        this.fetchUsersData()
        this.fetchRolesData()
        this.origUserForm = _.cloneDeep(this.userForm);
    }
}
</script>
<style>
    .admin-users {
        padding: 53px 1vw 0 1vw;
    }
    
</style>
