<template>
    <div class="admin-users">
        <h2>
            <vue-table
            :item="items"
            :index="1"
            name="Darbuotojai"
            :showHeader="false">
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
                    { dataIndex: 'id', title: '#' },
                    { dataIndex: 'name', title: 'darbuotojas' },
                    { dataIndex: 'email', title: 'elektroninis paštas' },
                    { dataIndex: 'role_id', title: 'rolė' },
                ]
            }
        }
    },
    methods: {
        fetchUsersData(){
            axios.get('/api/users')
            .then(response => {
                this.items.data = response.data.data;
            });
        }, 
    },
    created() {
        this.fetchUsersData()
    }
}
</script>
<style>
    .admin-users {
        padding: 53px 1vw 0 1vw;
    }
    
</style>
