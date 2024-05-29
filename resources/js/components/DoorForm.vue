<template>
    <div class="door-component">
        <div class="border">
                <form class="door-form" v-on:submit.prevent>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Aukštis (mm)' : 'Height (mm)'}}
                        </div>
                        <div class="door-form-data">
                            <input type="number" min="1800" v-model="doorForm.length" class="door-input">
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Plotis (mm)' : 'Width (mm)'}}
                        </div>
                        <div class="door-form-data">
                            <input type="number" min="900" v-model="doorForm.width" class="door-input">
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Rankena' : 'Handle'}}
                        </div>
                        <div class="door-form-data">
                            <select style="height: 28px" v-model="doorForm.left"  class="door-input">
                                <option :value="1">{{($i18n.locale == 'lt') ? 'Kairėje' : 'On the left'}}</option>
                                <option :value="0">{{($i18n.locale == 'lt') ? 'Dešinėje' : 'On the right'}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Durų tipas' : 'Door type'}}
                        </div>
                        <div class="door-form-data">
                            <select style="height: 28px" v-model="doorForm.door_type_id"  class="door-input">
                                <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">{{$i18n.locale == 'lt' ? doorType.title : doorType.title_en}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Plokštės tipas' : 'Panel type'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="availablePanels.length != 0" style="height: 28px" v-model="doorForm.panel_id"  class="door-input">
                                <option v-for="panel in availablePanels" :key="panel.id" :value="panel.id">{{$i18n.locale == 'lt' ? panel.title : panel.title_en}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Apdaila' : 'Decoration'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="availableDecors.length != 0" style="height: 28px" v-model="doorForm.decoration_id"  class="door-input">
                                <option v-for="decor in availableDecors" :key="decor.id" :value="decor.id">
                                    {{$i18n.locale == 'lt' ? decor.title : decor.title_en}}
                                    </option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Pagrindinė spyna' : 'Main lock'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="mainLocks != 0" style="height: 28px" v-model="doorForm.main_lock"  class="door-input">
                                <option v-for="param in mainLocks" :key="param.id" :value="param.title">
                                    {{$i18n.locale == 'lt' ? param.title : param.title_en}}
                                </option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Seifinė spyna' : 'Safe lock'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="safeLocks != 0" style="height: 28px" v-model="doorForm.safe_lock"  class="door-input">
                                <option v-for="param in safeLocks" :key="param.id" :value="param.title">{{$i18n.locale == 'lt' ? param.title : param.title_en}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Montavimas' : 'Installation'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="jobs != 0" style="height: 28px" v-model="doorForm.installation"  class="door-input">
                                <option v-for="param in jobs" :key="param.id" :value="param.title">{{$i18n.locale == 'lt' ? param.title : param.title_en}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Raštas' : 'Pattern'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="availablePatterns != 0" style="height: 28px" v-model="doorForm.pattern_id"  class="door-input" @change="setUrl(doorForm.pattern_id, $event)">
                                <option v-for="pattern in availablePatterns" :key="pattern.id" :value="pattern.id">{{$i18n.locale == 'lt' ? pattern.title : pattern.title_en}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Spalva' : 'Color'}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="availableColors != 0" style="height: 28px" v-model="doorForm.color_id"  class="door-input" @change="setUrl2(doorForm.color_id, $event)">
                                <option v-for="color in availableColors" :key="color.id" :value="color.id">
                                    {{$i18n.locale == 'lt' ? color.title : color.title_en}}
                                </option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Kiekis' : 'Quantity'}}
                        </div>
                        <div class="door-form-data">
                            <input v-model="doorForm.quantity" type="number" class="door-input" min="1">
                        </div>
                    </div>
                    <div>
                        <img v-show="false" id="image" :src="url" width="200px" alt="" style="box-shadow: none">
                        <div class="box" style="box-shadow: none">
                        <img :src="url2" alt="" class="image" style="box-shadow: none">
                        <canvas id="output-canvas"></canvas>
                        </div>
                        <br/>
                    </div>
                </form>
                <div class="door-form-submit">
                    <button class="door-submit" @click="calculatePrice">
                        {{$i18n.locale == 'lt' ? 'Apskaičiuoti kainą' : 'Calculate the price'}}
                    </button>
                    <div id="error1"></div>
                    <div class="door-form-total"  v-show="showPrice">
                        <span>{{$i18n.locale == 'lt' ? 'Viso' : 'Total'}} : {{total}} &euro;</span>
                        <button class="door-add" @click="addDoor">
                            {{$i18n.locale == 'lt' ? 'Pateikti užsakymo užklausą' : 'Submit an order request'}}
                        </button>
                    </div>
                        <div class="door-customer-data" v-show="showCustomer">
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    {{$i18n.locale == 'lt' ? 'Vardas, pavardė' : 'Name, surname'}}
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="orderForm.customer" class="door-input">
                                </div>
                            </div>
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    {{$i18n.locale == 'lt' ? 'Telefono nr.' : 'Phone number'}}
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="orderForm.phone" class="door-input">
                                </div>
                            </div>
                            <div class="door-form-item">
                                <div class="door-form-label">
                                    {{$i18n.locale == 'lt' ? 'El. paštas' : 'Email'}}
                                </div>
                                <div class="door-form-data">
                                    <input type="text" v-model="orderForm.email" class="door-input">
                                </div>
                            </div>
                            <button class="door-add" @click="postDoor">
                                {{$i18n.locale == 'lt' ? 'Pateikti' : 'Submit'}}
                            </button>
                    </div>
                </div>
                
        </div>
    </div>
</template>
<script>
import emailjs from 'emailjs-com';
export default {
    data () {
    return {
        url: '/images/R1.jpg',
        url2: '/images/none.jpg',
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
    this.fetchDoorData();
    this.fetchDTData();
    this.fetchPanelData();
    this.fetchDecorData();
    this.fetchParamData();
    this.fetchPatternData();
    this.fetchColorData();
  },
  methods: {
    initCanvas() {
      this.image = document.getElementById('image');
      this.c1 = document.getElementById('output-canvas');
      this.c1.width = 200;
      this.c1.height = 200;
      this.ctx1 = this.c1.getContext('2d');

      this.c_tmp = document.createElement('canvas');
      this.c_tmp.setAttribute('width', 200);
      this.c_tmp.setAttribute('height', 200);
      this.ctx_tmp = this.c_tmp.getContext('2d');

      this.computeFrame();
    },
    computeFrame() {
      let coef = 200 / this.image.naturalWidth;
    //   this.ctx1.scale(-1, 1);
      this.ctx_tmp.drawImage(
        this.image,
        0,
        0,
        this.image.naturalWidth * coef,
        this.image.naturalHeight * coef
      );
      let frame = this.ctx_tmp.getImageData(
        0,
        0,
        this.image.naturalWidth,
        this.image.naturalHeight
      );

      for (let i = 0; i < frame.data.length * 4; i += 4) {
        let r = frame.data[i]; //red
        let g = frame.data[i + 1]; //green
        let b = frame.data[i + 2]; //blue
        let a = frame.data[i + 3];

        if (r >= 176 && r < 255 && g > 176 && g < 255 && b > 176 && b < 255) {
          frame.data[i + 3] = a * 0.05;
        }
      }
      this.ctx1.putImageData(frame, 0, 0);
    },
    
    setUrl(id, event) {
        if (event.target.value) {
            this.url = this.patterns.find(elem => elem.id == this.doorForm.pattern_id).photo ? this.patterns.find(elem => elem.id == this.doorForm.pattern_id).photo : "/images/R1.jpg"
        this.initCanvas()
        }
        
        
    },
    setUrl2(id, event) {
        if (event.target.value) {
            this.url2 = this.colors.filter(elem => elem.id == id)[0].photo ? this.colors.filter(elem => elem.id == id)[0].photo : '/images/none.jpg'
        }
        // this.url2 = this.colors.filter(elem => elem.id == id)[0].photo ? this.colors.filter(elem => elem.id == id)[0].photo : '/images/none.jpg'
        
    },
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
      sendEmail(id) {
            try {
                let x = this.doorForm.left;
                let y = this.$i18n.locale;
                emailjs.send("service_4dqaodp","uzsakymo_pateikimas",{
                    id: id,
                    text_id:this.$i18n.locale == 'lt' ? 'Jūsų užsakymo numeris: ' : 'Your order id: ',
                    height: this.doorForm.length,
                    width: this.doorForm.width,
                    door_type: this.$i18n.locale == 'lt' ? this.doorTypes.filter(elem => elem.id == this.doorForm.door_type_id)[0].title : this.doorTypes.filter(elem => elem.id == this.doorForm.door_type_id)[0].title_en,
                    handle: (x == 1 && y == 'lt') ? "Kairėje" : (x == 1 && y == 'en') ? "On the left" : (x == 0 && y == 'lt') ? "Dešinėje" : "On the right",
                    panel_type: this.$i18n.locale == 'lt' ? this.panels.filter(elem => elem.id == this.doorForm.panel_id)[0].title : this.panels.filter(elem => elem.id == this.doorForm.panel_id)[0].title_en,
                    decoration: this.$i18n.locale == 'lt' ? this.decorations.filter(elem => elem.id == this.doorForm.decoration_id)[0].title : this.decorations.filter(elem => elem.id == this.doorForm.decoration_id)[0].title_en,
                    lock: this.$i18n.locale == 'lt' ? this.mainLocks.filter(elem => elem.title == this.doorForm.main_lock)[0].title : this.mainLocks.filter(elem => elem.title == this.doorForm.main_lock)[0].title_en,
                    safe_lock: this.$i18n.locale == 'lt' ? this.safeLocks.filter(elem => elem.title == this.doorForm.safe_lock)[0].title : this.safeLocks.filter(elem => elem.title == this.doorForm.safe_lock)[0].title_en,
                    installation: this.$i18n.locale == 'lt' ? this.jobs.filter(elem => elem.title == this.doorForm.installation)[0].title : this.jobs.filter(elem => elem.title == this.doorForm.installation)[0].title_en,
                    pattern: this.$i18n.locale == 'lt' ? this.patterns.filter(elem => elem.id == this.doorForm.pattern_id)[0].title : this.patterns.filter(elem => elem.id == this.doorForm.pattern_id)[0].title_en,
                    color: this.$i18n.locale == 'lt' ? this.colors.filter(elem => elem.id == this.doorForm.color_id)[0].title : this.colors.filter(elem => elem.id == this.doorForm.color_id)[0].title_en,
                    quantity: this.doorForm.quantity,
                    text_title: (this.$i18n.locale === 'lt') ? "Durų parametrai" : "Door parameters",
                    text_height: (this.$i18n.locale === 'lt') ? "Aukštis (mm)" : "Height (mm)",
                    text_width: (this.$i18n.locale === 'lt') ? "Plotis (mm)" : "Width (mm)",
                    text_door_type: (this.$i18n.locale === 'lt') ? "Durų tipas" : "Door type",
                    text_handle: (this.$i18n.locale === 'lt') ? "Rankena" : "Handle",
                    text_panel_type: (this.$i18n.locale === 'lt') ? "Plokštės tipas" : "Panel type",
                    text_decoration: (this.$i18n.locale === 'lt') ? "Apdaila" : "Decoration",
                    text_lock: (this.$i18n.locale === 'lt') ? "Pagrindinė spyna" : "Main lock",
                    text_safe_lock: (this.$i18n.locale === 'lt') ? "Seifinė spyna" : "Safe lock",
                    text_pattern: (this.$i18n.locale === 'lt') ? "Raštas" : "Pattern",
                    text_color: (this.$i18n.locale === 'lt') ? "Spalva" : "Color",
                    text_quantity: (this.$i18n.locale === 'lt') ? "Kiekis" : "Quantity",
                    text_installation: (this.$i18n.locale === 'lt') ? "Montavimas" : "Installation",
                    text1: (this.$i18n.locale === 'lt') ? "Sveiki," : "Hello,",
                    text2: (this.$i18n.locale === 'lt') ? "Džiaugiamės gavę Jūsų užsakymo užklausą!" : "We are glad to receive your order request!",
                    text3: (this.$i18n.locale === 'lt') ? "Jus dominančių durų parametrai:" : "Door parameters you are interested in:",
                    text4: (this.$i18n.locale === 'lt') ? "Su Jumis per artimiausias 1-3d.d. susisieks mūsų vadybininkai." : "Our managers will contact you within the next 1-3 working days.",
                    text5: (this.$i18n.locale === 'lt') ? "Kilus klausimams maloniai kviečiame kreiptis numeriu: +370 616 03034 arba elektroniniu paštu info@durusalis.lt" : "If you have any questions, please feel free to contact us at +370 616 03034 or via email at info@durusalis.lt",
                    text6: (this.$i18n.locale === 'lt') ? "Gražios dienos," : "Have a great day,",
                    text7: (this.$i18n.locale === 'lt') ? "Durų šalies komanda" : "Durų šalis team",
                    text8: (this.$i18n.locale === 'lt') ? "Preliminari bendra suma: " : "Preliminary total price: ",
                    receiver: this.orderForm.email,
                    sender: "duru.informacija2@gmail.com",
                    total: this.doorForm.price,
                    subject: (this.$i18n.locale === 'lt') ? 'UAB "Durų šalis" užsakymo užklausa' : 'UAB "Durų šalis" order request',
                }, 'xOnownoRFQ2QGLw-6');
                //alert('užsakymo užklausa išsiųsta')
            } 
            catch(error) {
                alert(error)
            }
        },
      postDoor () {
        axios.post('/api/orders', this.orderForm)
        .then(response => {
            this.doorForm.order_id = response.data.data.id
            axios.post('/api/doors', this.doorForm)
            .then(response => {
                console.log(response.data)
                    // this.doors.push(response.data.data)
                    // alert(response.data.data.id)
                    this.sendEmail(response.data.data.order_id)
                    alert(this.$i18n.locale === 'lt'? 'Duomenys apie užsakymą buvo išsiųsti' : 'Order details have been sent')
                // this.handleClose();
            })
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
        max-width: 600px;
    }
    .door-form-label {
        font-family: "Open Sans", sans-serif;
        color: #432310;
        letter-spacing: -0.02em;
        max-width: 600px;
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
        color: #FF0000;
        /* float: right; */
        /* margin-bottom: 25px; */
    }
    .box #output-canvas {
        box-shadow: none !important;
    }
</style>
