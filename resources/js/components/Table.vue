<template>
  <div id="table">
    <expand-collapse :index="index" :name="name">
      <div class="table-header" :style="[showHeader ? {'display': 'flex'} : {'display': 'none'}]">
        <div class="set-records-number">
          <div class="records-number-title">
            {{$i18n.locale == 'lt' ? 'Įrašų puslapyje' : 'Records per page'}}
          </div>
          <div id="records" class="records-number">
            <input class="choose-records-number" v-model="perPage">
            <div class="number-options">
              <ul :id="'number-options' + index">
                <li @click="perPage = 5">5</li>
                <li @click="perPage = 10">10</li>
                <li @click="perPage = 15">15</li>
                <li @click="perPage = 20">20</li>
                <li @click="perPage = 25">25</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="search">
          <input @keyup="searchData" @keydown="searchData" type="text" class="search" :placeholder="$i18n.locale == 'lt' ? 'Ieškoti...' : 'Search...'" v-model="search">
        </div>
      </div>
      <div class="empty-table" v-if="splitedArray.length == 0">{{$i18n.locale == 'lt' ? 'Įrašų nėra' : 'This section contains no values yet'}}</div>
      <table id="table" class="data-table" v-else>
        <thead>
          <tr>
            <td v-for="(column, indexC) in item.columns" :key="indexC">
              <th class="th">{{column.name}}</th>
            </td>
          </tr>
        </thead>
          <tbody>
          <slot name="tableRow">
            <tr class="row-div" v-for="(data, indexD) in splitedArray[currentPage - 1]" :key="indexD">
              <td class="td" v-for="(column, indexC) in item.columns" :key="indexC">
                <div class="data-header">{{column.name}}</div>
                <slot name="tableData" v-bind:data="data" v-bind:column="column">
                  <div v-if="column.dataIndex == 'allow_many'" class="table-data">
                    <span v-if="data[column.dataIndex] == 0">
                      {{$i18n.locale == 'lt' ? 'Neleista' : 'Not allowed'}}
                    </span>
                    <span v-if="data[column.dataIndex] == 1">
                      {{$i18n.locale == 'lt' ? 'Leista' : 'Allowed'}}
                    </span>
                  </div>
                  <div v-else-if="column.dataIndex == 'role_id'" class="table-data">
                    <span v-if="data[column.dataIndex] == 1">
                      {{$i18n.locale == 'lt' ? 'Vadovas' : 'CEO'}}
                    </span>
                    <span v-if="data[column.dataIndex] == 2">
                      {{$i18n.locale == 'lt' ? 'Vadybininkas' : 'Manager'}}
                    </span>
                    <span v-if="data[column.dataIndex] == 3">
                      {{$i18n.locale == 'lt' ? 'Produkcijos vadybininkas' : 'PM'}}
                    </span>
                  </div>
                  <div v-else-if="column.dataIndex == 'status_id'" class="table-data">
                    <span v-for="status in statuses" :key="status.id">
                      <span v-if="status.id == data[column.dataIndex]">{{$i18n.locale == 'lt' ? status.title : status.title_en}}</span>
                    </span>
                  </div>
                  <div v-else-if="column.dataIndex == 'parameter_type_id'" class="table-data">
                    <span v-for="param in parameters" :key="param.id">
                      <span v-if="param.id == data[column.dataIndex]">{{$i18n.locale == 'lt' ? param.title : param.title_en}}</span>
                    </span>
                  </div>
                  <div v-else-if="column.dataIndex == 'door_type_id'" class="table-data">
                    <span v-for="type in doorTypes" :key="type.id">
                      <span v-if="type.id == data[column.dataIndex]">{{$i18n.locale == 'lt' ? type.title : type.title_en}}</span>
                    </span>
                  </div>
                  <div v-else class="table-data">{{data[column.dataIndex]}}</div>
                  <span v-if="column.dataIndex == 'actions' && !pdf">
                    <button class="iconButton" v-if="!status" @click="showModal(data, false);edit = true"><img src="/images/edit.png" alt=""></button>
                    <button v-if="allowDelete" class="iconButton" @click="deleteData(data)"><img src="/images/delete.png" alt=""></button>
                    <span v-if="column.dataIndex == 'actions' && document">
                      <button class="iconButton" @click="showModal(data, true);edit = false"><img src="/images/approve.png" alt=""></button>
                    </span>
                  </span>
                  <span v-if="column.dataIndex == 'actions' && pdf">
                    <button class="iconButton" @click="showPdf(data);edit = true"><img src="/images/generate.svg" alt=""></button>
                  </span>
                </slot>
              </td>
            </tr>
          </slot>
        </tbody>
      </table>
        <div class="table-footer">
          <vuci-pagination
          :totalPages="splitedArray.length"
          :perPage="perPage"
          :currentPage="currentPage"
          @pagechanged="onPageChange"
          />
      </div>
      <button v-show="showAdd" class="control-btn" @click="showModal();edit = false">{{$i18n.locale == 'lt' ? 'Pridėti' : 'Add'}}</button>
      </expand-collapse>
      <modal 
        v-show="isModalVisible && $i18n.locale == 'lt'"
        @close="closeModal()"
        :name="edit == true ? 'Redaguoti' : 'Pridėti'"
        :approve="approve">
        <template>
          <slot name="editItem"></slot>
          <slot name="editOrder"></slot>
          <div class="modal-buttons">
            <button class="modal-control-btn" @click="closeModal">Atšaukti</button>
            <button class="modal-control-btn" @click="submitItem">Patvirtinti</button>
          </div>
        </template>
      </modal>
      <modal 
        v-show="isModalVisible && $i18n.locale == 'en'"
        @close="closeModal()"
        :name="edit == true ? 'Edit' : 'Create'"
        :approve="approve">
        <template>
          <slot name="editItem"></slot>
          <slot name="editOrder"></slot>
          <div class="modal-buttons">
            <button class="modal-control-btn" @click="closeModal">Cancel</button>
            <button class="modal-control-btn" @click="submitItem">Submit</button>
          </div>
        </template>
      </modal>
      <!-- <document 
        v-show="isModalVisible && $i18n.locale == 'lt'"
        @close="closeModal()"
        :name="edit == true ? 'Redaguoti' : 'Pridėti'">
        <template>
          <slot name="editDocument"></slot>
          <div class="modal-buttons">
            <button class="modal-control-btn" @click="closeModal">Atšaukti</button>
            <button class="modal-control-btn" @click="submitItem">Patvirtinti</button>
          </div>
        </template>
      </document>
      <document 
        v-show="isModalVisible && $i18n.locale == 'en'"
        @close="closeModal()"
        :name="edit == true ? 'Edit' : 'Create'">
        <template>
          <slot name="editDocument"></slot>
          <div class="modal-buttons">
            <button class="modal-control-btn" @click="closeModal">Cancel</button>
            <button class="modal-control-btn" @click="submitItem">Submit</button>
          </div>
        </template>
      </document> -->
      <pdf-generator 
      v-show="pdfVisible"
      :item="selectedItem"
      :doors="doors"
      :colors="colors"
      :decorations="decorations"
      :panels="panels"
      :params="parameters"
      :patterns="patterns"
      :types="doorTypes"
      @close="closePdf()"
      >
      </pdf-generator>
  </div>
</template>
<script>
import ExpandCollapse from './ExpandCollapse.vue'
import VuciPagination from './Pagination.vue'
import Modal from './Modal.vue'
import Document from './Document.vue'
import PdfGenerator from '../components/PdfGeneration.vue'
export default {
  components: {
    VuciPagination,
    ExpandCollapse,
    Modal,
    Document,
    PdfGenerator
  },
  data () {
    return {
      currentPage: 1,
      perPage: 10,
      search: '',
      edit: false,
      isModalVisible: false,
      pdfVisible: false,
      selectedItem: {},
      orders: [],
      doorTypes: [],
      doors: [],
      panels: [],
      decorations: [],
      parameters: [],
      patterns: [],
      colors: [],
      params: [],
      statuses: [],
      approve: false,
    }
  },
  props: {
    item: {
      type: Object,
      required: true
    },
    index: {
      type: Number,
      required: false,
      default: 0
    },
    name: {
      type: String,
      required: false,
      default: 'lentele'
    },
    document: {
      type: Boolean,
      required: false,
      default: false
    },
    allowDelete: {
      type: Boolean,
      required: false,
      default: true
    },
    showHeader: {
      type: Boolean,
      required: false,
      default: false
    },
    showAdd: {
      type: Boolean,
      required: false,
      default: true
    },
    pdf: {
      type: Boolean,
      required: false,
      default: false
    },
    status: {
      type: Boolean,
      required: false,
      default: false
    },
  },
  created() {
    // this.fetchOrderData();
    
    // this.fetchDTData();
    // this.fetchPanelData();
    // this.fetchDecorData();
    // this.fetchParamData();
    // this.fetchPatternData();
    // this.fetchColorData();
    // this.fetchDoorData();
  },
  mounted() {
    this.fetchOrderData();
    this.fetchStatuses();
    this.fetchDTData();
    this.fetchPanelData();
    this.fetchDecorData();
    this.fetchParamData();
    this.fetchPatternData();
    this.fetchColorData();
    this.fetchDoorData();
  },
  methods: {
    fetchStatuses(){
        axios.get('/api/statuses')
        .then(response => {
          this.statuses = response.data.data
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
    onPageChange (page) {
      this.currentPage = page
    },
    showNumberOptions () {
      document.getElementById('number-options' + this.index).style.display = 'block'
    },
    hideNumberOptions () {
      document.getElementById('number-options' + this.index).style.display = 'none'
    },
    searchData () {
      this.$emit('clicked', this.search)
    },
    showDocument (modalData, document) {
      console.log(modalData)
      this.$emit('getOrder', modalData, document)
      this.isModalVisible = true
    },
    showModal (modalData, document) {
      console.log(modalData)
      this.approve = document
      if (modalData) {
        this.editData(modalData, document)
      }
      this.isModalVisible = true
    },
    closeModal () {
      this.refresh()
      this.approve = false
      this.isModalVisible = false
    },
    showPdf (data) {
      this.pdfVisible = true
      this.selectedItem = data
    },
    closePdf () {
      this.refresh()
      this.pdfVisible = false
    },
    deleteData (element) {
      this.$emit('delete', element)
    },
    editData (element, document) {
      this.$emit('edit', element, document)
    },
    refresh () {
      this.$emit('refresh')
    },
    submitItem () {
      this.$emit('submitItem')
      this.isModalVisible = false
    }
  },
  computed: {
    splitedArray () {
      var arrayOfArrays = []
      for (var y = 0; y < this.item.data.length; y += this.perPage) {
        arrayOfArrays.push(this.item.data.slice(y, y + this.perPage))
      }
      return arrayOfArrays
    }
  }
}
</script>
<style>
  .table-header {
    /* display: none; */
    justify-content: space-between;
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
    font-size: 12px;
    text-transform: none;
    height: 40px;
    padding: 6px 0;
  }
  .set-records-number {
    width: max-content;
    display: flex;
    justify-content: flex-end;
    vertical-align: middle;
  }
  .records-number-title {
    padding-top: 3px;
    margin-right: 5px;
    color: #444;
  }
  .choose-records-number {
    width: 50px;
    border: 1px solid #afafaf;
    border-radius: 7px;
    position: relative;
    flex-grow: 1;
    margin-left: 5px;
    height: 24px;
    background-image: url(/images/arrow_down.svg);
    background-repeat: no-repeat;
    background-size: 12px 8px;
    appearance: none;
    padding: 2px 24px 2px 5px;
    background-position: center right 7px;
    cursor: pointer;
    color: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* tas mirksintis cursorius */
    caret-color: transparent;
  }
  .choose-records-number:focus + .number-options{
    display: block;
  }
  .number-options:hover {
    display: block;
  }
  .number-options {
    width: 50px;
    position: relative;
    display: none;
  }
  .number-options ul {
    border: 1px solid #e4e4e4;
    box-shadow: 0 10px 5px 0 rgb(0 0 0 / 25%);
    width: 50px;
    padding-left: 0;
    max-height: 200px;
    overflow: auto;
    position: absolute;
    left: 5px;
    z-index: 1;
    background-color: #fff;
  }
  .number-options li {
    color: #444;
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
    font-size: 11px;
    text-transform: none;
    list-style: none;
    text-align: left;
    padding: 0.3em 1em;
    cursor: pointer;
  }
  .number-options li:hover {
    border-left: 3px solid #0054a6;
    color: #0054a6;
  }
  div.search {
    position: relative;
    flex-grow: 1;
    justify-content: flex-end;
  }
  input.search {
    width: 100%;
    max-width: 175px;
    border: 1px solid #afafaf;
    border-radius: 7px;
    transition: border .2s linear,box-shadow .2s linear;
    position: relative;
    display: flex;
    float: right;
    font-size: 11px;
    padding: 0.3em 1em;
    height: 22px;
  }
  input:focus {
    outline: none;
    box-shadow: 0px 0px 5px rgba(24, 143, 255, 0.5);
    border: 1.5px solid rgba(24, 143, 255, 0.5);
    transition: 0.2s;
  }
  input:hover {
    all: none;
  }
  .data-table {
    cursor: default;
    border-collapse: collapse;
    width: 100%;
    display: table;
    text-indent: initial;
    border-spacing: 2px;
    border-color: grey;
    color: #444;
    font-family: "Open Sans", sans-serif;
    font-size: 12px;
  }
  .th {
    font-family: "Oswald",sans-serif;
    font-weight: 400;
    font-size: 15px;
    text-transform: uppercase;
    padding: 8px;
    text-align: left;
    position: relative;
    color: #444;
    display: table-cell;
    vertical-align: inherit;
  }
  .td {
    padding: 8px;
    padding-left: 16px;
  }
  .data-header {
    display: none;
  }
  .table-data {
    min-width: 60px;
  }
  .row-div {
    border: unset;
    border-top: 1px solid #e4e4e4;
    width: 100%;
  }
  .row-div:hover {
    background-color: #f7f7f7;
  }
  .iconButton {
    padding: 0;
    background: none;
    border: none;
    margin: 1px 3px;
    cursor: pointer;
  }
  .iconButton img{
    height: 24px;
    width: 24px;
  }
  .empty-table {
    padding: 8px;
    font-family: "Open Sans", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #444;
  }
  .empty-table:hover {
    background-color: #f7f7f7;
  }
  .table-footer {
    display: block;
  }
  .control-btn, .modal-control-btn {
    background-color: #fff;
    font-family: "Oswald", sans-serif;
    font-size: 14px;
    font-weight: 300;
    border: 1px solid #444;
    letter-spacing: 0.05em;
    border-radius: 5px;
    padding: 0.2em 1em;
    margin: 2em 1em 0.5em 1em;
    color: #444;
    transition: 0.5s;
    text-transform: uppercase;
    letter-spacing: -0.01em;
    /* position: absolute; */
    /* float: right; */
    display: block;
  }
  .control-btn:hover, .modal-control-btn:hover {
    cursor: pointer;
    background-color: #808080;
    color: #fff;
    border: 1px solid #808080;
    transition: 0.5s;
    }
  .modal-buttons {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
  }
  @media only screen and (max-width: 1100px) {
    thead {
      display: none;
    }
    tbody {
      width: 100%;
    }
    .row-div {
      border: unset;
      border-top: 1px solid #e4e4e4;
      display: flex;
      flex-direction: column;
    }
    .row-div:nth-child(1) {
      border-top: none;
    }
    .td {
      display: flex;
      justify-content: space-between;
      padding: 8px;
    }
    .data-header {
      display: block;
      margin-right: 25%;
    }
    .table-title {
      font-size: 15.6px;
    }
  }
  @media only screen and (max-width: 500px) {
    .row-div, .row-div:nth-child(1) {
      border-radius: 7px;
      border: 1px solid #e4e4e4;
      margin-top: 15px;
      max-width: 99.5%;
    }
    .td {
      border: unset;
      border-top: 1px solid #e4e4e4;
      flex-direction: column;
      color: #777;
    }
    .td:nth-child(1) {
      border-top: none;
    }
    .data-header {
      color: #444;
      font-family: "Oswald", sans-serif;
      font-weight: 400;
      font-size: 13.2px;
      text-transform: uppercase;
    }
  }
</style>