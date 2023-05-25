<template>
    <div class="orders">
        <div class="nepatvirtinta">
            <!-- {{items}} -->
            <vue-table
                :item="items.norders"
                :index="0"
                name="Nepatvirtinti užsakymai"
                :showHeader="false"
                :pdf="false">
            </vue-table>
            <vue-table
                :item="items.orders"
                :index="0"
                name="Patvirtinti užsakymai"
                :showHeader="false"
                :showAdd="false"
                :pdf="true">
            </vue-table>
        </div>
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
            lang: this.$i18n.locale,
            currentUser: '',
            doorForm: {
                length: 1800,
                width: 900,
                left: 1,
                door_type_id: 0,
                panel_id: 0,
                decoration_id: 0,
                main_lock: '',
                safe_lock: '',
                installation: '',
                pattern_id: 0,
                color_id: 0,
                quantity: 1,
                price: 0,
                order_id: 0
            },
            orderForm: {
                customer: '',
                phone: '',
                email: '',
                status_id: 1
            },
            documentForm: {
                name: '',
                surname: '',
                order_id: '',
                today: new Date().toISOString().split('T')[0],
                planned_completion_date: new Date(new Date().setMonth(new Date().getMonth() + 3)).toISOString().split('T')[0],
                total: 0,
                avance: 0,
                address: '',
                manager: ''
            },
            items: {
                doors : {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#' },
                        { dataIndex: 'customer', title: 'klientas', name: this.lang == 'lt' ? 'Klientas' : 'Customer' },
                        { dataIndex: 'email', title: 'email', name: this.lang == 'lt' ? 'El. paštas' : 'Email' },
                        { dataIndex: 'phone', title: 'phone', name: this.lang == 'lt' ? 'Tel. numeris' : 'Phone' },
                        { dataIndex: 'status_id', title: 'statusas', name: this.lang == 'lt' ? 'Statusas' : 'Status' },
                    ],
                    data: []
                },
                orders : {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#' },
                        { dataIndex: 'customer', title: 'klientas', name: this.lang == 'lt' ? 'Klientas' : 'Customer' },
                        { dataIndex: 'email', title: 'email', name: this.lang == 'lt' ? 'El. paštas' : 'Email' },
                        { dataIndex: 'phone', title: 'phone', name: this.lang == 'lt' ? 'Tel. numeris' : 'Phone' },
                        { dataIndex: 'status_id', title: 'statusas', name: this.lang == 'lt' ? 'Statusas' : 'Status' },
                        { dataIndex: 'actions', title: 'actions', name: this.lang == 'lt' ? 'Veiksmai' : 'Actions' },
                    ],
                    data: []
                },
                norders : {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#' },
                        { dataIndex: 'customer', title: 'klientas', name: this.lang == 'lt' ? 'Klientas' : 'Customer' },
                        { dataIndex: 'email', title: 'email', name: this.lang == 'lt' ? 'El. paštas' : 'Email' },
                        { dataIndex: 'phone', title: 'phone', name: this.lang == 'lt' ? 'Tel. numeris' : 'Phone' },
                        { dataIndex: 'status_id', title: 'statusas', name: this.lang == 'lt' ? 'Statusas' : 'Status' },
                        
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
    mounted() {
        this.getCurrentUser()
    },
    methods: {
        getCurrentUser() {
            axios.get('/api/user')
            .then(response => {
                this.currentUser = response.data;
                console.log(this.currentUser)
            })
            .catch(error => {
                console.error(error);
            });
        },
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
        padding: 70px 1vw 15vh 1vw;
    }
</style>
