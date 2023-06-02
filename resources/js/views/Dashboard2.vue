<template>
    <div class="orders">
        <div class="nepatvirtinta">
            <!-- {{items}} -->
            <vue-table
                :item="items.norders"
                :index="0"
                :name="$i18n.locale == 'lt' ? 'Nepatvirtinti užsakymai' : 'Unconfirmed orders'"
                :showHeader="false"
                :pdf="false"
                @delete="deleteOrder"
                @edit="editDoorOrder"
                @refresh="handleClose"
                @submitItem="postDoor"
                @getOrder="getOrder"
                :status="false"
                :doors="doors"
                :document="true">
                <template v-slot:editItem>
                    <span v-if="!showDocument">
                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Aukštis' : 'Height'}}</div>
                        <input v-if="doorForm" class="modal-form-input" type="number" v-model="doorForm.length">

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Plotis' : 'Width'}}</div>
                        <input v-if="doorForm" class="modal-form-input" type="number" v-model="doorForm.width">

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Rankena' : 'Handle'}}</div>
                        <select v-if="doorForm" style="height: 28px" v-model="doorForm.left" class="modal-form-input">
                            <option :value="1">{{$i18n.locale == 'lt' ? 'Kairėje' : 'On the left'}}</option>
                            <option :value="0">{{$i18n.locale == 'lt' ? 'Dešinėje' : 'On the right'}}</option>
                        </select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Durų tipas' : 'Door type'}}</div>
                        <select v-if="doorForm" style="height: 28px" v-model="doorForm.door_type_id" class="modal-form-input">
                            <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">
                                {{$i18n.locale == 'lt' ? doorType.title : doorType.title_en}}
                            </option>
                        </select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Plokštės tipas' : 'Panel type'}}</div>
                        <select v-if="availablePanels.length != 0  && doorForm" style="height: 28px" v-model="doorForm.panel_id" class="modal-form-input">
                            <option v-for="panel in availablePanels" :key="panel.id" :value="panel.id">
                                {{$i18n.locale == 'lt' ? panel.title : panel.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Apdaila' : 'Decoration'}}</div>
                        <select v-if="availableDecors.length != 0 && doorForm" style="height: 28px" v-model="doorForm.decoration_id" class="modal-form-input">
                            <option v-for="decor in availableDecors" :key="decor.id" :value="decor.id">
                                {{$i18n.locale == 'lt' ? decor.title : decor.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Pagrindinė spyna' : 'Main lock'}}</div>
                        <select v-if="mainLocks.length != 0 && doorForm" style="height: 28px" v-model="doorForm.main_lock" class="modal-form-input">
                            <option v-for="param in mainLocks" :key="param.id" :value="param.title">
                                {{$i18n.locale == 'lt' ? param.title : param.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Seifinė spyna' : 'Safe lock'}}</div>
                        <select v-if="safeLocks.length != 0 && doorForm" style="height: 28px" v-model="doorForm.safe_lock" class="modal-form-input">
                            <option v-for="param in safeLocks" :key="param.id" :value="param.title">
                                {{$i18n.locale == 'lt' ? param.title : param.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Montavimas' : 'Installation'}}</div>
                        <select v-if="jobs.length != 0 && doorForm" style="height: 28px" v-model="doorForm.installation" class="modal-form-input">
                            <option v-for="param in jobs" :key="param.id" :value="param.title">
                                {{$i18n.locale == 'lt' ? param.title : param.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Raštas' : 'Pattern'}}</div>
                        <select v-if="availablePatterns.length != 0 && doorForm" style="height: 28px" v-model="doorForm.pattern_id" class="modal-form-input">
                            <option v-for="pattern in availablePatterns" :key="pattern.id" :value="pattern.id">
                                {{$i18n.locale == 'lt' ? pattern.title : pattern.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Spalva' : 'Color'}}</div>
                        <select v-if="availableColors.length != 0 && doorForm" style="height: 28px" v-model="doorForm.color_id" class="modal-form-input">
                            <option v-for="color in availableColors" :key="color.id" :value="color.id">
                                {{$i18n.locale == 'lt' ? color.title : color.title_en}}
                            </option>
                        </select>
                        <select v-else style="height: 28px" class="modal-form-input" disabled></select>

                        <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Kiekis' : 'Quantity'}}</div>
                        <input v-if="doorForm" v-model="doorForm.quantity" type="number" class="modal-form-input" min="1">

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Vardas, pavardė' : 'Name, surname'}}</div>
                            <div class="modal-form-data">
                                <input type="text" v-model="orderForm.customer" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Telefono nr.' : 'Phone number'}}</div>
                            <div class="modal-form-data">
                                <input type="text" v-model="orderForm.phone" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'El. paštas' : 'Email'}}</div>
                            <div class="modal-form-data">
                                <input type="text" v-model="orderForm.email" class="modal-form-input">
                            </div>
                        </div>
                        
                        <!-- <button @click="handleClose">Cancel</button>
                        <button @click="submitParamType">Submit</button> -->
                    </span>
                    <span v-else>
                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Vardas, pavardė' : 'Name, surname'}}</div>
                            <div class="modal-form-data">
                                <input disabled type="text" v-model="orderForm.customer" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Telefono nr.' : 'Phone number'}}</div>
                            <div class="modal-form-data">
                                <input disabled type="text" v-model="orderForm.phone" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'El. paštas' : 'Email'}}</div>
                            <div class="modal-form-data">
                                <input disabled type="text" v-model="orderForm.email" class="modal-form-input">
                            </div>
                        </div>
                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Adresas' : 'Address'}}</div>
                            <div class="modal-form-data">
                                <input type="text" v-model="orderForm.address" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Avansas' : 'Addvance'}}</div>
                            <div class="modal-form-data">
                                <input type="number" v-model="orderForm.advance" class="modal-form-input">
                            </div>
                        </div>

                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Numatoma užsakymo data' : 'Estimated order date'}}</div>
                            <div class="modal-form-data">
                                <input disabled type="text" v-model="orderForm.order_date" class="modal-form-input">
                            </div>
                        </div>
                        <div class="modal-form-item">
                            <div class="modal-form-label">{{$i18n.locale == 'lt' ? 'Pasirašė' : 'Signed by'}}</div>
                            <div class="modal-form-data">
                                <input disabled type="text" v-model="orderForm.signed_by" class="modal-form-input">
                            </div>
                        </div>
                    </span>
                </template>
            </vue-table>
            <vue-table
                :item="items.orders"
                :index="0"
                :name="$i18n.locale == 'lt' ? 'Patvirtinti užsakymai' : 'Confirmed orders'"
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
                norders : {
                    columns: [
                        { dataIndex: 'id', title: '#', name: '#' },
                        { dataIndex: 'customer', title: 'klientas', name: this.lang == 'lt' ? 'Klientas' : 'Customer' },
                        { dataIndex: 'email', title: 'email', name: this.lang == 'lt' ? 'El. paštas' : 'Email' },
                        { dataIndex: 'phone', title: 'phone', name: this.lang == 'lt' ? 'Tel. numeris' : 'Phone' },
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
        this.fetchDoorData();
        this.fetchDTData();
        this.fetchPanelData();
        this.fetchDecorData();
        this.fetchParamData();
        this.fetchPatternData();
        this.fetchColorData();
    },
    methods: {
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
            this.doorForm.order_id = response.data.data.id
            // this.orders.push(response.data.data)
            this.fetchOrderData()
            axios.post('/api/doors', this.doorForm)
            .then(response => {
                console.log(response.data)
                this.handleClose();
                this.fetchDoorData()
                    // this.doors.push(response.data.data)
                    // alert(response.data.data.id)
                    //this.sendEmail()
                
            })
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
