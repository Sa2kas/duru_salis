<template>
    <div class="orders">
        <div class="nepatvirtinta">
            <!-- {{items}} -->
            <vue-table
                :item="items.norders"
                :index="0"
                name="Nepatvirtinti užsakymai"
                :showHeader="false">
            </vue-table>
            <vue-table
                :item="items.orders"
                :index="0"
                name="Patvirtinti užsakymai"
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
                        { dataIndex: 'customer', title: 'klientas' },
                        { dataIndex: 'email', title: 'email' },
                        { dataIndex: 'phone', title: 'phone' },
                        { dataIndex: 'status_id', title: 'statusas' },
                    ],
                    data: []
                },
                orders : {
                    columns: [
                        { dataIndex: 'id', title: '#' },
                        { dataIndex: 'customer', title: 'klientas' },
                        { dataIndex: 'email', title: 'email' },
                        { dataIndex: 'phone', title: 'phone' },
                        { dataIndex: 'status_id', title: 'statusas' },
                    ],
                    data: []
                },
                norders : {
                    columns: [
                        { dataIndex: 'id', title: '#' },
                        { dataIndex: 'customer', title: 'klientas' },
                        { dataIndex: 'email', title: 'email' },
                        { dataIndex: 'phone', title: 'phone' },
                        { dataIndex: 'status_id', title: 'statusas' },
                    ],
                    data: []
                },
            }
        }
    },
    computed: {
        dataSource () {
            return this.items.orders.filter(elem => elem.status_id == 1)
        }
    },
    created () {
        this.fetchDoorData();
        this.fetchOrderData();
    },
    methods: {
        fetchDoorData(){
            axios.get('/api/doors')
            .then(response => {
                this.items.doors.data = response.data.data;
            });
        }, 
        fetchOrderData(){
            axios.get('/api/orders')
            .then(response => {
                this.items.orders.data = response.data.data.filter(elem => elem.status_id != 1);
                this.items.norders.data = response.data.data.filter(elem => elem.status_id == 1)
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
