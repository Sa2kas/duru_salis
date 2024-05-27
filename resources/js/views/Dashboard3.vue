<template>
    <div class="orders">
        <div class="nepatvirtinta">
            <!-- {{items}} -->
            <vue-table
                :item="items.orders"
                :index="0"
                :name="$i18n.locale == 'lt' ? 'Patvirtinti užsakymai' : 'Confirmed orders'"
                :showHeader="false"
                :pdf="false"
                @delete="deleteOrder"
                @edit="editDoorOrder"
                @refresh="handleClose"
                @submitItem="postDoor"
                @getOrder="getOrder"
                :status="false"
                :doors="doors"
                :document="false"
                :allowDelete="false">
                <template v-slot:editItem>
                    <span v-if="!showDocument">
                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Durų tipas' : 'Door type'}}</div>
                        <select style="height: 28px" v-model="orderForm.status_id" class="modal-form-input">
                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                {{$i18n.locale == 'lt' ? status.title : status.title_en}}
                            </option>
                        </select>
                    </span>
                </template>
            </vue-table>
        </div>
    </div>
</template>
<script>
import VueTable from '../components/Table.vue'
import PdfGenerator from '../components/PdfGeneration.vue'
import emailjs from 'emailjs-com';
export default {
        components: {
        VueTable,
        PdfGenerator
    },
    data () {
        return {
            origOrder: {},
            origDoor: {},
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
            },
            doorTypes: [],
            doors: [],
            panels: [],
            decorations: [],
            parameters: [],
            patterns: [],
            colors: [],
            total: 0,
            showPrice: false,
            showCustomer: false,
            newDoors: [],
            documentOrder: 0,
            showDocument: false,
            statuses: [],
        }
    },
    computed: {
        dataSource() {
            return this.items.orders.filter((elem) => elem.status_id == 1);
        },
        availablePanels() {
            if (this.doorForm && this.doorForm.door_type_id !== 0) {
            return this.panels.filter((elem) => elem.door_type_id == this.doorForm.door_type_id);
            }
            return [];
        },
        availableDecors() {
            if (this.doorForm && this.doorForm.panel_id !== 0) {
            return this.decorations.filter((elem) => elem.panel_id == this.doorForm.panel_id);
            }
            return [];
        },
        mainLocks() {
            if (this.doorForm && this.doorForm.door_type_id !== 0) {
            return this.parameters.filter(
                (elem) => elem.parameter_type_id == 1 && elem.door_type_id == this.doorForm.door_type_id
            );
            }
            return [];
        },
        safeLocks() {
            if (this.doorForm && this.doorForm.door_type_id !== 0) {
            return this.parameters.filter(
                (elem) => elem.parameter_type_id == 2 && elem.door_type_id == this.doorForm.door_type_id
            );
            }
            return [];
        },
        jobs() {
            if (this.doorForm && this.doorForm.door_type_id !== 0) {
            return this.parameters.filter(
                (elem) => elem.parameter_type_id == 4 && elem.door_type_id == this.doorForm.door_type_id
            );
            }
            return [];
        },
        availablePatterns() {
            if (this.doorForm && this.doorForm.panel_id !== 0) {
            return this.patterns.filter((elem) => elem.panel_id == this.doorForm.panel_id);
            }
            return [];
        },
        availableColors() {
            if (this.doorForm && this.doorForm.panel_id !== 0) {
            return this.colors.filter((elem) => elem.panel_id == this.doorForm.panel_id);
            }
            return [];
        },
    },

    created () {
        this.origDoor = _.cloneDeep(this.doorForm);
        this.origOrder = _.cloneDeep(this.orderForm);
        // this.fetchOrderData();
        // this.fetchDoorData();
        // this.fetchDTData();
        // this.fetchPanelData();
        // this.fetchDecorData();
        // this.fetchParamData();
        // this.fetchPatternData();
        // this.fetchColorData();
    },
    mounted() {
        this.getCurrentUser()
        this.fetchOrderData();
        // this.fetchDoorData();
        // this.fetchDTData();
        // this.fetchPanelData();
        // this.fetchDecorData();
        // this.fetchParamData();
        // this.fetchPatternData();
        // this.fetchColorData();
        this.fetchStatuses();
    },
    methods: {
        sendEmail(receiver) {
            try {
                let info_lt = "Norime pranešti, kad Jūsų užsakymas sistemoje buvo pažymėtas kaip pagamintas. " + 
                "Dėl tolimesnių veiksmų per 1-3 darbo dienas su jumis susisieks mūsų darbuotojai arba galite kreiptis sistemoje norodytais kontaktais"
                let info_en = "We would like to inform you that your order in the system has been marked as completed. " +
                "Our staff will contact you within 1-3 business days for further actions, or you can reach out to us using the contact information provided in the system"
                
                emailjs.send("service_4dqaodp","baigtas_uzsakymas", {
                    subject: this.$i18n.locale == 'lt' ? "Jūsų užsakymas buvo pagamintas!" : "Your order has been made!",
                    hi_text: this.$i18n.locale == 'lt' ? "Sveiki" : "Hello",
                    info_text: this.$i18n.locale == 'lt' ? info_lt : info_en,
                    day_text: this.$i18n.locale == 'lt' ? "Gražios dienos," : "Have a nice day,",
                    team_text: this.$i18n.locale == 'lt' ? '"Durų šalis" komanda' : '"Durų šalis" team',
                    receiver: receiver,
                    sender: "duru.informacija@gmail.com",
                }, 
                'xOnownoRFQ2QGLw-6'
                );
                alert('užsakymo užklausa išsiųsta')
            } 
            catch(error) {
                alert(error)
            }
        },
        deleteOrder(order) {
            let door = this.doors.find(elem => elem.order_id == order.id);

            if (door) {
                axios
                .delete('/api/doors/' + door.id)
                .then((response) => {
                    let index = this.doors.indexOf(door);
                    if (index !== -1) {
                    this.doors.splice(index, 1);
                    }
                    this.deleteOrderRequest(order);
                    // window.location.reload();
                })
                .catch((err) => {
                    console.error(err);
                    // Handle error
                });
            } else {
                this.deleteOrderRequest(order);
                // window.location.reload();
            }
        },

        deleteOrderRequest(order) {
            if (order && order.id) {
                axios
                .delete('/api/orders/' + order.id)
                .then((response) => {
                    let index = this.orders.indexOf(order);
                    if (index !== -1) {
                    this.orders.splice(index, 1);
                    }
                })
                .catch((err) => {
                    //console.error(err);
                    //alert(this.$i18n.locale == 'lt' ? 'Elementas negali būti pašalintas' : 'Element cannot be removed');
                    this.fetchOrderData()
                });
            } else {
                console.error('Invalid order');
            }
        },


        calculatePrice () {
          try {
            var decoprice = this.availableDecors.find(elem => elem.id == this.doorForm.decoration_id).price
            var mainLockPrice = this.mainLocks.find(elem => elem.title == this.doorForm.main_lock).price
            var safeLockPrice = this.safeLocks.find(elem => elem.title == this.doorForm.safe_lock).price
            var installationPrice = this.jobs.find(elem => elem.title == this.doorForm.installation).price
            this.total = (decoprice + mainLockPrice + safeLockPrice + installationPrice) * this.doorForm.quantity
            this.doorForm.price = this.total
          }
          catch(err) {
            //   document.getElementById("error1").textContent = 'Įvesti ne visi duomenys';
          }
      },
      postDoor () {
        this.calculatePrice()
        axios.post('/api/orders', this.orderForm)
        .then(response => {
            //this.doorForm.order_id = response.data.data.id
            // this.orders.push(response.data.data)
            // this.fetchOrderData()
            // axios.post('/api/doors', this.doorForm)
            // .then(response => {
            //     console.log(response.data)
            //     this.handleClose();
            //     this.fetchDoorData()
            //         // this.doors.push(response.data.data)
            //         // alert(response.data.data.id)
            //         //this.sendEmail()
                
            // })
            if (this.orderForm.status_id == 5) {
                this.sendEmail(this.orderForm.email)
            }
        })
      },
      getOrder(order) {
        this.documentOrder = order.id
      },
      editDoorOrder(order, document) {
        this.orderForm = order;
        this.showDocument = document
        if (document) {
            this.orderForm.status_id = 2
            this.orderForm.signed_by = this.currentUser.name
            this.orderForm.order_date = new Date(new Date().setMonth(new Date().getMonth() + 3)).toISOString().split('T')[0]
            // console.log(this.currentUser)
            // this.orderForm.
        }
        this.fetchDoorData()
            .then(() => {
            // console.log(order.id);
            this.doorForm = this.doors.find(elem => elem.order_id == order.id);
            // console.log(this.doors);
            })
            .catch(error => {
            // console.error(error);
            // Handle error
            });
        },

        async fetchDoorData() {
        try {
            const response = await axios.get('/api/doors');
            this.items.doors.data = response.data.data;
            this.doors = response.data.data;
        } catch (error) {
            // console.error(error);
            // Handle error
            throw error;
        }
        },
      handleClose() {
            this.orderForm = _.cloneDeep(this.origOrder);
            this.doorForm = _.cloneDeep(this.origDoor);
            // console.log(this.doorForm)

            // this.fetchOrderData();
            // this.fetchDoorData()
        },
      fetchDTData(){
        axios.get('/api/door-types')
        .then(response => {
            this.doorTypes = response.data.data;
        });
    },
    
    fetchPanelData(){
        axios.get('/api/panels')
        .then(response => {
            this.panels = response.data.data;
        });
    },
    
    fetchDecorData(){
        axios.get('/api/decorations')
        .then(response => {
            this.decorations = response.data.data;
        });
    },
    
    fetchParamData(){
        axios.get('/api/params')
        .then(response => {
            this.parameters = response.data.data;
        });
    },
    fetchPatternData(){
        axios.get('/api/patterns')
        .then(response => {
            this.patterns = response.data.data;
        });
    },
    fetchColorData(){
        axios.get('/api/colors')
        .then(response => {
            this.colors = response.data.data;
        });
    },
    fetchStatuses(){
        axios.get('/api/statuses')
        .then(response => {
            this.statuses =  response.data.data.filter(elem => elem.id != 1 && elem.id != 3 );
        });
    },
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
        // fetchDoorData(callback) {
        // axios.get('/api/doors')
        //     .then(response => {
        //     this.items.doors.data = response.data.data;
        //     this.doors = response.data.data;
        //     callback(); // Invoke the callback function after fetching the data
        //     })
        //     .catch(error => {
        //     console.error(error);
        //     // Handle error
        //     });
        // },
        fetchOrderData(){
            axios.get('/api/orders')
            .then(response => {
                this.items.orders.data = response.data.data.filter(elem => elem.status_id != 1 && elem.status_id != 3);
                //this.items.norders.data = response.data.data.filter(elem => elem.status_id == 1)
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
