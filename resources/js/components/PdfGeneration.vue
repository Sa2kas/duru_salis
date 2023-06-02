<template>
  <div class="pdf-gen">
    <div class="pdf-gen-overlay" @click="close"/>
    <div class="pdf-gen-container">
      <div class="pdf-gen-body" id="pdf">
        
        <div>
        <div style="display: flex;">
          <div style="margin-top: 15px; width: 70%;">
            <img src="/images/logo.jpg" height="60" width="160">
          </div>

          <div style="margin-top: 2.5em;display: block; text-align: center;">
            <h1 style="font-weight: bold; margin-bottom: 0.5rem; font-size: 1.5em;">{{ lang ? "Sąskaita" : "Invoice" }}</h1>
            <dl style="display: block;">
              <div style="">{{ lang ? "Nr" : "No" }}: {{ item.id }}</div>
              <br>
              <div style="display: block; margin-top: -1rem"> {{ lang ? "Data" : "Date" }}: {{ currentDate }}</div>
            </dl>
          </div>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; align-items: center;">
          <div style="border: 2px solid #104c8d; padding: 0.3rem; width: 45%;">
            {{ item.customer }}<br>
            {{ item.email }}<br>
            {{ item.phone }}
          </div>
        </div>

        <table style="border-collapse: collapse; margin-bottom: 2rem; width: 100%;">
          <thead>
            <tr style="background-color: #104c8d; color: white;">
              <th style="font-weight: normal; text-align: left;" colspan="3">{{ lang ? "Užsakymas:" : "Order:" }}</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Durų tipas" : "Door type" }}</strong></td>
              <td style="text-align: left;">{{ type || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Aukštis (mm)" : "Height (mm)"}}</strong></td>
              <td style="text-align: left;">{{ door.length || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Plotis (mm)" : "Width (mm)"}}</strong></td>
              <td style="text-align: left;">{{ door.width || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Rankena" : "Handle" }}</strong></td>
              <td style="text-align: left;">{{ handle || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Plokštės tipas" : "Panel type" }}</strong></td>
              <td style="text-align: left;">{{ panel }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Apdaila" : "Decoration" }}</strong></td>
              <td style="text-align: left;">{{ decoration.split('-')[0] }}</td>
              <td style="text-align: left;">{{ decoration.split('-')[1] }}</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Pagrindinė spyna" : "Main lock" }}</strong></td>
              <td style="text-align: left;">{{ mainLock.split('-')[0] }}</td>
              <td style="text-align: left;">{{ mainLock.split('-')[1] }}</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Seifinė spyna" : "Safe lock" }}</strong></td>
              <td style="text-align: left;">{{ safeLock.split('-')[0] }}</td>
              <td style="text-align: left;">{{ safeLock.split('-')[1] }}</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Raštas" : "Pattern" }}</strong></td>
              <td style="text-align: left;">{{ pattern || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Spalva" : "Color" }}</strong></td>
              <td style="text-align: left;">{{ color || '' }}</td>
              <td style="text-align: left;">0€</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Kiekis" : "Quantity" }}</strong></td>
              <td style="text-align: left;">{{ door.quantity || '' }}</td>
              <td style="text-align: left;">-</td>
            </tr>
            <tr style="border: 1px solid #104c8d">
              <td style="text-align: left;"><strong>{{ lang ? "Montavimas" : "Installation" }}</strong></td>
              <td style="text-align: left;">{{ job.split('-')[0] || '' }}</td>
              <td style="text-align: left;">{{ job.split('-')[1] || '' }}</td>
            </tr>
          </tbody>
        </table>

        <div style="display: flex; margin-bottom: 2rem;">
          <dl style="background-color: #cce5fe; display: flex; flex-wrap: wrap; margin-left: auto; padding: 0.5rem; width: 40%;">
            <div style="display: block; margin: 0; padding: 0; padding-left: 1rem; width: 60%;">{{ lang ? "Viso:" : "Total:" }} €{{ door.price }}</div>
          </dl>
        </div>
        <hr>
        <p style="margin-top: 1rem; text-align: center;">
          <small style="text-align: center">
            {{ companyInfo }}
          </small>
        </p>
        </div>
      </div>
      
      <button @click="generate" class="pdf-btn">{{ lang ? "Generuoti PDF" : "Generate PDF" }}</button>
    </div>
  </div>
  
</template>

<script>
import axios from 'axios';
import html2pdf from "html2pdf.js";
export default {
  data() {
    return {
      // lang: this.$i18n.locale == 'lt',
      // orders: [],
      // doorTypes: [],
      // doors: [],
      // panels: [],
      // decorations: [],
      // parameters: [],
      // patterns: [],
      // colors: [],
      // params: [],
      gaidys: 100006,
      cycleClasses: ['bg-white', 'bg-blue-100'],
      companyInfo: `UAB "Durų šalis"
      Žiemgalių g. 8, Kaunas
      Įm. kodas 303224483
      A/s LT94 7300 0101 5166 3393
      AB bankas Swedbank`,
      // currentDate: '',
      // job: '',
      // mainLock: '',
      // safeLock: '',
      // order: '',
      // door: '',
      // color: '',
      // panel: '',
      // decoration: '',
      // pattern: '',
      // type: '',
      // handle: ''
    };
  },
  props: {
    item: {
      type: Object,
      require: true
    },
    doors: {
      type: Array,
      require: true
    },
    types: {
      type: Array,
      require: true
    },
    colors: {
      type: Array,
      require: true
    },
    patterns: {
      type: Array,
      require: true
    },
    params: {
      type: Array,
      require: true
    },
    decorations: {
      type: Array,
      require: true
    },
    panels: {
      type: Array,
      require: true
    },
    
  },
  computed: {
      lang () {
        return this.$i18n.locale == 'lt'
      },
      mainLock() { return (this.params.find(elem => elem.title == this.door.main_lock)?.[this.lang ? 'title' : 'title_en']) + `-${(this.params.find(elem => elem.title == this.door.main_lock)?.price || '')} €` || ''; },

      safeLock() { return (this.params.find(elem => elem.title == this.door.safe_lock)?.[this.lang ? 'title' : 'title_en']) + `-${(this.params.find(elem => elem.title == this.door.safe_lock)?.price || '')} €` || ''; },

      job() { return (this.params.find(elem => elem.title == this.door.installation)?.[this.lang ? 'title' : 'title_en']) + `-${(this.params.find(elem => elem.title == this.door.installation)?.price || '')} €` || ''; },

      order() { return this.orders.find(elem => elem.id == this.gaidys) || {}; },

      door() { return this.doors.find(elem => elem.order_id == this.item.id) || {}; },

      color() { return (this.colors.find(elem => elem.id == this.door.color_id)?.[this.lang ? 'title' : 'title_en']) || ''; },

      panel() { return (this.panels.find(elem => elem.id == this.door.panel_id)?.[this.lang ? 'title' : 'title_en']) || ''; },

      decoration() { return (this.decorations.find(elem => elem.id == this.door.decoration_id)?.[this.lang ? 'title' : 'title_en']) + `-${(this.decorations.find(elem => elem.id == this.door.decoration_id)?.price || '')} €` || ''; },

      pattern() { return (this.patterns.find(elem => elem.id == this.door.pattern_id)?.[this.lang ? 'title' : 'title_en']) || ''; },

      type () {
        return (this.types.find(elem => elem.id == this.door.door_type_id)?.[this.lang == 'lt' ? 'title' : 'title_en']) ?? '';
      },
      handle () {
        let x = this.door.left
        let y = this.lang
        return ((x == 1 && y == 'lt') ? "Kairėje" : (x == 1 && y == 'en') ? "On the left" : (x == 0 && y == 'lt') ? "Dešinėje" : "On the right") || ''
      },
      currentDate() {
        return new Date().toISOString().split('T')[0]
      }
  },
  created() {
    // this.fetchOrderData();
    // this.fetchDTData();
    // this.fetchPanelData();
    // this.fetchDecorData();
    // this.fetchDoorData();
    // this.fetchParamData();
    // this.fetchPatternData();
    // this.fetchColorData();
  },
  mounted() {
    // this.fetchOrderData();
    // this.fetchDTData();
    // this.fetchPanelData();
    // this.fetchDecorData();
    // this.fetchDoorData();
    // this.fetchParamData();
    // this.fetchPatternData();
    // this.fetchColorData();
  },
  methods: {
    close: function () {
      this.$emit('close')
    },
    generate() {
        let pdfDiv = document.getElementById('pdf');
        let prevHeight = pdfDiv.style.height;
        pdfDiv.style.height = 'auto'; // Set height to auto to include all content

        html2pdf().from(pdfDiv).toPdf().save('invoice.pdf').then(() => {
            pdfDiv.style.height = prevHeight; // Reset the height to the previous value once PDF is saved
        });
    },
    fetchDoorData(){
        axios.get('/api/doors')
        .then(response => {
          this.doors = response.data.data
        });
    }, 
    fetchOrderData(){
        axios.get('/api/orders')
        .then(response => {
          this.orders = response.data.data
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
  },
};
</script>

<style>

.table td,
.table th {
  border: 1px solid white;
  padding: 0.25rem 1rem;
}

.numeric-tabular {
  /* Sets the numbers width so that they stay aligned vertically. */
  font-variant-numeric: tabular-nums;
}
.pdf-btn {
    background-color: #fff;
    font-family: "Oswald", sans-serif;
    font-size: 16px;
    font-weight: 300;
    border: 1px solid #723B1B;
    letter-spacing: 0.05em;
    border-radius: 5px;
    padding: 0.5em 1em;
    float: center;
    margin: 0.25em 39%;
    color: #723B1B;
    transition: 0.5s;
    text-transform: uppercase;
    letter-spacing: -0.01em;
}
.pdf-btn:hover {
    cursor: pointer;
    background-color: #723B1B;
    color: #fff;
    border: 1px solid #fff;
    transition: 0.5s;
}
.pdf-gen {
  position: fixed;
  left: 50%;
  top: 70px;
  z-index: 1;
  display: block;
  transition: all 1s ease-in;
}
.pdf-gen-overlay {
  cursor: auto;
  display: flex;
  position: fixed;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.25);
  top: 0;
  left: 0;
  z-index: 1;
  transition: opacity .15s linear;
}
.pdf-gen-container {
  left: -50%;
  /* min-width: 80vw; */
  cursor: auto;
  width: 50vw;
  max-width: 1000px;
  position: relative;
  border-radius: 7px;
  z-index: 2;
  background: #fff;
  /* max-height: 80vh; */
  height: 83vh;
  padding: 7px 15px 7px 15px;
  transition: scale .2s ease-in;
  display: block;
  border: solid 1px rgba(0, 0, 0, 0.25);
}
.pdf-gen-header {
  position: relative;
  height: 30px;
  margin-right: 15;
  margin-top: 12px;
  display: block;
}
.pdf-gen-close {
  width: 20px;
  height: 20px;
  margin-left: auto;
  display: block;
}
.pdf-gen-close-button {
  position: absolute;
  right: 0;
  top: 0;
  width: 9px;
  height: 15px;
  display: block;
}
.pdf-gen-close-button::before {
  transition-duration: .3s;
  content: " ";
  background-color: #444;
  position: absolute;
  height: 17px;
  width: 2px;
  right: 9px;
  transform: rotate(-45deg);
}
.pdf-gen-close-button::after {
  transition-duration: .3s;
  content: " ";
  background-color: #444;
  position: absolute;
  height: 17px;
  width: 2px;
  right: 9px;
  transform: rotate(45deg);
}
.pdf-gen-close-button:hover::before,
.pdf-gen-close-button:hover::after {
  background-color: #0054a6;
  cursor: pointer;
}
.pdf-gen-body {
  /* min-height: calc(80vh - 116px); */
  overflow: auto;
  height: 68vh;
  /* border: 1px solid #e4e4e4;
  border-radius: unset;
  border-bottom-right-radius: 7px;
  border-bottom-left-radius: 7px; */
  padding: 0 38px 60px 38px;
}
</style>
