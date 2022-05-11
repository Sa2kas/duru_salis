<template>
    <div class="door-component">
        <div class="border">
            {{doorForm}}
            <div class="door-form">
                <div class="door-form-item">
                    <div class="door-form-label">
                        Ilgis (mm)
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Plotis (mm)
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Rankena kairėje
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Durų tipas
                    </div>
                    <div class="door-form-data">
                        <select style="width: 180px; height: 28px" v-model="doorForm.door_type_id"  class="door-input">
                            <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">{{doorType.title}}</option>
                        </select>
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Plokštės tipas
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Apdaila
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Pagrindinė spyna
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Seifinė spyna
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Montavimas
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Raštas
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Spalva
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">
                        Kiekis
                    </div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
                <div class="door-form-item">
                    <div class="door-form-label">Kaina</div>
                    <div class="door-form-data">
                        <input type="text" class="door-input">
                    </div>
                </div>
            </div>
            <div class="door-form-submit">
                <button class="door-submit">
                    Apskaičiuoti
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
    return {
        doorTypes: [],
        doorForm: {
            length: 0,
            width: 0,
            left: true,
            door_type_id: 0,
            panel_id: 0,
            decoration_id: 0,
            main_lock: '',
            safe_lock: '',
            installation: '',
            patern_id: 0,
            color_id: 0,
            quantity: 1,
            price: 0

        }
    }
  },
  created () {
    this.fetchDTData();
  },
  methods: {
    fetchDTData(){
        axios.get('/api/door-types')
        .then(response => {
            this.doorTypes = response.data.data;
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
        min-height: 300px;
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
    }
    .door-submit {
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
    .door-submit:hover {
        cursor: pointer;
        background-color: #723B1B;
        color: #fff;
        border: 1px solid #fff;
        transition: 0.5s;
    }
</style>
