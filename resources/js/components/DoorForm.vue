<template>
    <div class="door-component">
        <div class="border">
            <!-- {{this.doors}} <br>       -->
                <form class="door-form" v-on:submit.prevent>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Aukštis (mm)
                        </div>
                        <div class="door-form-data">
                            <input type="number" min="1800" v-model="doorForm.length" class="door-input">
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Plotis (mm)
                        </div>
                        <div class="door-form-data">
                            <input type="number" min="900" v-model="doorForm.width" class="door-input">
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Rankena
                        </div>
                        <div class="door-form-data">
                            <select style="height: 28px" v-model="doorForm.left"  class="door-input">
                                <option :value="1">kairėje</option>
                                <option :value="0">dešinėje</option>
                            </select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Durų tipas
                        </div>
                        <div class="door-form-data">
                            <select style="height: 28px" v-model="doorForm.door_type_id"  class="door-input">
                                <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">{{doorType.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Plokštės tipas
                        </div>
                        <div class="door-form-data">
                            <select v-if="availablePanels.length != 0" style="height: 28px" v-model="doorForm.panel_id"  class="door-input">
                                <option v-for="panel in availablePanels" :key="panel.id" :value="panel.id">{{panel.title}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Apdaila
                        </div>
                        <div class="door-form-data">
                            <select v-if="availableDecors.length != 0" style="height: 28px" v-model="doorForm.decoration_id"  class="door-input">
                                <option v-for="decor in availableDecors" :key="decor.id" :value="decor.id">
                                    {{decor.title}}
                                    </option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Pagrindinė spyna
                        </div>
                        <div class="door-form-data">
                            <select v-if="mainLocks != 0" style="height: 28px" v-model="doorForm.main_lock"  class="door-input">
                                <option v-for="param in mainLocks" :key="param.id" :value="param.title">
                                    {{param.title}}
                                </option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Seifinė spyna
                        </div>
                        <div class="door-form-data">
                            <select v-if="safeLocks != 0" style="height: 28px" v-model="doorForm.safe_lock"  class="door-input">
                                <option v-for="param in safeLocks" :key="param.id" :value="param.title">{{param.title}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Montavimas
                        </div>
                        <div class="door-form-data">
                            <select v-if="jobs != 0" style="height: 28px" v-model="doorForm.installation"  class="door-input">
                                <option v-for="param in jobs" :key="param.id" :value="param.title">{{param.title}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Raštas
                        </div>
                        <div class="door-form-data">
                            <select v-if="availablePatterns != 0" style="height: 28px" v-model="doorForm.pattern_id"  class="door-input">
                                <option v-for="pattern in availablePatterns" :key="pattern.id" :value="pattern.id">{{pattern.title}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Spalva
                        </div>
                        <div class="door-form-data">
                            <select v-if="availableColors != 0" style="height: 28px" v-model="doorForm.color_id"  class="door-input">
                                <option v-for="color in availableColors" :key="color.id" :value="color.id">{{color.title}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            Kiekis
                        </div>
                        <div class="door-form-data">
                            <input v-model="doorForm.quantity" type="number" class="door-input" min="1">
                        </div>
                    </div>
                </form>
                <div class="door-form-submit">
                    <button class="door-submit" @click="calculatePrice">
                        Apskaičiuoti
                    </button>
                    <div id="error1"></div>
                    <div class="door-form-total"  v-show="showPrice">
                        <span>Viso : {{total}} &euro;</span>
                        <button class="door-add" @click="addDoor">
                            Pateikti durų informaciją
                        </button>
                    </div>
                        <div class="door-customer-data" v-show="showCustomer">
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    Vardas, pavardė
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="doorForm.customer" class="door-input">
                                </div>
                            </div>
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    Telefono nr.
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="doorForm.phone" class="door-input">
                                </div>
                            </div>
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    El. paštas
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="doorForm.email" class="door-input">
                                </div>
                            </div>
                            <button class="door-add" @click="postDoor">
                                Pateikti užsakymo užklausą
                            </button>
                    </div>
                </div>
        </div>
        <button class="door-add" @click="postDoor">
            Pateikti užsakymo užklausą
        </button>
    </div>
</template>
<script>
import emailjs from 'emailjs-com';
export default {
    data () {
    return {
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
            customer: '',
            phone: '',
            email: '',
            ordered: 0
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
        newDoors: []
    }
  },
  computed: {
      availablePanels () {
          return this.panels.filter(elem => elem.door_type_id == this.doorForm.door_type_id && this.doorForm.door_type_id != 0)
      },
      availableDecors () {
          return this.decorations.filter(elem => elem.panel_id == this.doorForm.panel_id && this.doorForm.panel_id != 0)
      },
      mainLocks () {
          return this.parameters.filter(elem => elem.parameter_type_id == 1 && elem.door_type_id == this.doorForm.door_type_id)
      },
      safeLocks () {
          return this.parameters.filter(elem => elem.parameter_type_id == 2 && elem.door_type_id == this.doorForm.door_type_id)
      },
      jobs () {
          return this.parameters.filter(elem => elem.parameter_type_id == 4 && elem.door_type_id == this.doorForm.door_type_id)
      },
      availablePatterns () {
          return this.patterns.filter(elem => elem.panel_id == this.doorForm.panel_id && this.doorForm.panel_id != 0)
      },
      availableColors () {
          return this.colors.filter(elem => elem.panel_id == this.doorForm.panel_id && this.doorForm.panel_id != 0)
      },
  },
  created () {
    this.fetchDTData();
    this.fetchPanelData();
    this.fetchDecorData();
    this.fetchDoorData();
    this.fetchParamData();
    this.fetchPatternData();
    this.fetchColorData();
  },
  methods: {
      calculatePrice () {
          try {
            var decoprice = this.availableDecors.filter(elem => elem.id == this.doorForm.decoration_id)[0].price
            var mainLockPrice = this.mainLocks.filter(elem => elem.title == this.doorForm.main_lock)[0].price
            var safeLockPrice = this.safeLocks.filter(elem => elem.title == this.doorForm.safe_lock)[0].price
            var installationPrice = this.jobs.filter(elem => elem.title == this.doorForm.installation)[0].price
            this.total = (decoprice + mainLockPrice + safeLockPrice + installationPrice) * this.doorForm.quantity
            this.doorForm.price = this.total
            this.showPrice = true
            document.getElementById("error1").textContent = '';
          }
          catch(err) {
              document.getElementById("error1").textContent = 'Įvesti ne visi duomenys';
          }
      },
      addDoor () {
          this.showCustomer = true
        try {
            
          }
          catch(err) {
              document.getElementById("error1").textContent = 'Įvesti ne visi duomenys';
          }
      },
      sendEmail(e) {
            try {
                emailjs.send('service_l2bh374','template_yl7r9y7', {
                    order_id: 1,
                    to_name: this.doorForm.customer,
                    receiver: this.doorForm.email,
                }, 
                'xOnownoRFQ2QGLw-6'
                );
                alert('užsakymo užklausa išsiųsta')
            } 
            catch(error) {
                alert(error)
            }
        },
      postDoor () {
        this.newDoors = this.doorForm
        axios.post('/api/doors', this.doorForm)
        .then(response => {
            if(this.doorForm.id){
                let item = this.doors.find(el => el.id == response.data.data.id)
                let index = this.doors.indexOf(item);
                // this.paramTypes[index] = response.data.data <= taip nedaryti
                this.$set(this.doors, index, response.data.data)
            }else{
                this.doors.push(response.data.data)
                this.sendEmail()
            }
            // this.handleClose();
        })
      },
     fetchDoorData(){
        axios.get('/api/doors')
        .then(response => {
            this.doors = response.data.data;
        });
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
  }
}
</script>
<style>
    .door-component {
        padding: min(8vh, 8vw) 1vw;
    }
    .border {
        width: 95%;
        box-shadow: 0 2px 4px rgba(86, 71, 63, 0.5);
        min-height: 600px;
        margin: 1vw auto;
        border-radius: 3px;
        padding: 1vh 1vw;
    }
    .door-form-item {
        display: flex;
        justify-content: space-between;
        margin: 8px;
    }
    .door-form-label {
        font-family: "Open Sans", sans-serif;
        color: #432310;
        letter-spacing: -0.02em;
    }
    .door-input {
        padding: 0.3em 1em 0.3em 0.5em;
        font-family: "Open Sans", sans-serif;
        font-size: 13px;
        height: 18px;
        border-radius: 3px;
        border: 1px solid #432310;
        color: #432310;
        width: 260px
    }
    input.door-input {
        width: 238px
    }
    .door-form-total {
        text-align: right;
        text-transform: uppercase;
        font-family: "Open Sans", sans-serif;
        font-size: 28px;
        color: #432310;
        margin-right: 1em;
        margin-bottom: 1em;
    }
    .door-submit, .door-add {
        background-color: #fff;
        font-family: "Oswald", sans-serif;
        font-size: 16px;
        font-weight: 300;
        border: 1px solid #723B1B;
        letter-spacing: 0.05em;
        border-radius: 5px;
        padding: 0.3em 0.6em;
        margin: 2em 1em 0.5em 1em;
        color: #723B1B;
        transition: 0.5s;
        text-transform: uppercase;
        letter-spacing: -0.01em;
        /* position: absolute; */
        /* float: right; */
        display: block;
    }
    .door-submit:hover, .door-add:hover {
        cursor: pointer;
        background-color: #723B1B;
        color: #fff;
        border: 1px solid #fff;
        transition: 0.5s;
    }
    #error1 {
        visibility: visible;
        font-size: 16px;
        display: flex;
        text-align: right;
        margin: 0.1em;
        padding-bottom: 0.1em;
        /* float: right; */
        /* margin-bottom: 25px; */
    }
</style>
