<template>
    <div class="orders">
        <div class="nepatvirtinta">
            <!-- {{items}} -->
            <vue-table
                :item="items.doors"
                :index="0"
                name="Nepatvirtintos durys"
                :showHeader="false">
            </vue-table>
        </div>
    </div>
</template>
<script>
import VueTable from '../components/Table.vue'
export default {
        components: {
        VueTable
    },
    data () {
        return {
            doors: [],
            items: {
                doors : {
                    columns: [
                        { dataIndex: 'id', title: '#' },
                        { dataIndex: 'ordered', title: 'užsakyta' },
                        { dataIndex: 'customer', title: 'klientas' },
                        { dataIndex: 'email', title: 'email' },
                        { dataIndex: 'phone', title: 'phone' },
                    ],
                    data: []
                },
            }
        }
    },
    created () {
        this.fetchDoorData();
    },
    methods: {
        fetchDoorData(){
            axios.get('/api/doors')
            .then(response => {
                this.items.doors.data = response.data.data;
            });
        }, 
    }
}
</script>
<style>
    .orders {
        display: block;
        padding: 70px 1vw 0 1vw;
    }
</style>
