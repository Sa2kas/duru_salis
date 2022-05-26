<template>
    <div class="edit-gallery">
        <div class="gallery-header"></div>
        <div class="gallery-title" style="margin-botton:20px">
            Tvarkyti galeriją
        </div>
        <!-- <form @submit.prevent="submit">
            <input type="file" @change="onChange">
            <input type="submit" Value="Upload">
        </form> -->
        <div style="margin-top: 20px">
            <form @submit="formSubmit" enctype="multipart/form-data">
                <input type="file" class="form-control" v-on:change="onChange">
                <button class="btn btn-primary btn-block">Upload</button>
            </form>
            <img :src="photoForm.path" width="200px" alt="">
            <div class="door-form-item">
                <div class="door-form-label">
                    Durų tipas
                </div>
                <div class="door-form-data">
                    <select style="height: 28px" v-model="photoForm.door_type"  class="door-input">
                        <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">{{doorType.title}}</option>
                    </select>
                </div>
            </div>
            <div class="door-form-item">
                <div class="door-form-label">
                    Plokštės tipas
                </div>
                <div class="door-form-data">
                    <select v-if="availablePanels.length != 0" style="height: 28px" v-model="photoForm.panel"  class="door-input">
                        <option v-for="panel in availablePanels" :key="panel.id" :value="panel.id">{{panel.title}}</option>
                    </select>
                    <select v-else style="height: 28px" class="door-input" disabled></select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    components: {
    },
    mounted() {
    },
    data () {
        return {
            photoForm: {
                door_type: '1',
                panel: '3',
                name: '', //failo pavadinimas
                path: '', //failo kelias
            },
            doorTypes: [],
            panels: [],
            url:'',
        }
    },
    computed: {
        availablePanels () {
          return this.panels.filter(elem => elem.door_type_id == this.photoForm.door_type && this.photoForm.door_type != 0)
      },
    },
    methods: {
        onChange(e) {
                this.photoForm.path = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let data = new FormData();
                data.append('file', this.photoForm.path);
                data.append('door_type', this.photoForm.door_type)
                data.append('panel', this.photoForm.panel)
                axios.post('api/photos', data, config)
                    .then(function (res) {
                        existingObj.success = res.data.success;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            },
        // onChange(e) {
        //     const file = e.target.files[0]
        //     this.url = URL.createObjectURL(file)
        // },
        setImage() {
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
    },
    created () {
        this.fetchDTData();
        this.fetchPanelData();
    }
}
</script>
<style>
    .edit-gallery {
        display: block;
        padding-bottom: 5vh;
    }
    .gallery-header {
        background-image: url('/images/check.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position: center;
        margin-bottom: 3%;
    }
    .gallery-title {
        background-color: rgb(252, 252, 252);
        width: 80vw;
        height: min(10vh, 10vw);
        max-height: 50px;
        margin: 0 auto;
        padding: min(min(4vh, 4vw), 14px) 0 0 0;
        position: absolute;
        top: min(min(63vh, 63vw), 365px);
        left: 10vw;
        display: block;
        font-size: min(6vw, 34px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        letter-spacing: 0.08em;
        text-align: center;
        box-shadow: 0px 3px 3px #444;
        border-radius: 3px;
        line-height: min(6vw, 34px);
    }
    .preview{
        float: right;
        margin: 30px;
        width: 200px;
        height: 300px;
        background-color: rgb(59, 144, 144);
    }
    #image {
        margin: 5px;
        width: 200px;
        height: 200px;
        /* transform: scaleX(-1); */
        object-fit: cover;
    }
    .image {
        width: 200px;
        height: 200px;
        /* transform: scaleX(-1); */
        object-fit: cover;
    }
    .box {
        position: relative;
        width: 200px;
        padding: 0;
        margin: 0;
        margin-left: 20px;
    }
    .box #output-canvas {
        width: 100%;
        height: 100%;
        position: absolute;
        box-shadow: 0 2px 5px #444;
        bottom: 0;
        left: 0;
        transform: scaleX(-1);
    }
    @media (max-width: 1400px) {
    }
</style>
