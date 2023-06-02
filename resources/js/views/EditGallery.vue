<template>
    <div class="edit-gallery">
        <div class="gallery-header"></div>
        <div class="gallery-title" style="margin-botton:20px">
            {{$i18n.locale == 'lt' ? 'Tvarkyti galeriją' : "Edit gallery"}}
        </div>
        <div style="margin-top: 20px">
            <div style="display: flex; align-items: right; margin: 3rem 1rem 1rem 1rem; flex-direction: row-reverse;">
                <button @click="showAddSection = true" class="header-button">{{$i18n.locale == 'lt' ? 'Pridėti' : 'Add'}}</button>
            </div>
            <div v-show="showAddSection" style="margin: 1rem 0;">
                <form @submit="formSubmit" enctype="multipart/form-data">
                    <input
                    class="form-control"
                    ref="actualBtn"
                    type="file"
                    id="actual-btn"
                    style="display: none"
                    @change="onChange"
                    hidden
                    />
                    <label for="actual-btn" class="header-button">Choose File</label>
                    <span id="file-chosen">{{ selectedFileName }}</span>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Durų tipas' : "Door type"}}
                        </div>
                        <div class="door-form-data">
                            <select style="height: 28px" v-model="photoForm.door_type"  class="door-input">
                                <option v-for="doorType in doorTypes" :key="doorType.id" :value="doorType.id">{{$i18n.locale == 'lt' ? doorType.title : doorType.title_en}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="door-form-item">
                        <div class="door-form-label">
                            {{$i18n.locale == 'lt' ? 'Plokštės tipas' : "Panel type"}}
                        </div>
                        <div class="door-form-data">
                            <select v-if="availablePanels.length != 0" style="height: 28px" v-model="photoForm.panel"  class="door-input">
                                <option v-for="panel in availablePanels" :key="panel.id" :value="panel.id">{{$i18n.locale == 'lt' ? panel.title : panel.title_en}}</option>
                            </select>
                            <select v-else style="height: 28px" class="door-input" disabled></select>
                        </div>
                    </div>
                    <div style="display: flex; align-items: right; flex-direction: row-reverse; mergin-right: 1rem">
                        <button class="header-button" @click="setImage">
                            {{$i18n.locale == 'lt' ? 'Įkelti' : "Upload"}}
                        </button>
                    </div>
                </form>
            </div>
            <!-- <img :src="photoForm.path" width="200px" alt=""> -->
        </div>
        <div class="flex-wrap">
            <div class="gallery-elements">
                <div class="gallery-card" v-for="image in photos" :key="image.id">
                    <div class="image-delete-x">
                        <span @click="removePhoto(image.id)">✕</span>
                    </div>
                    <div class="image-container">
                        <img class="gallery-image" :src="image.path" alt="">
                    </div>
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
                door_type: '',
                panel: '',
                name: '', 
                path: '', 
            },
            doorTypes: [],
            panels: [],
            url:'',
            photos: [],
            selectedFileName: '',
            showAddSection: false
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
            this.selectedFileName = e.target.files[0].name;
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
                    existingObj.photoForm.path = ''; 
                    e.target.reset();
                    this.selectedFileName = '';
                    this.fetchPhotosData()
                    //window.location.reload();
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
            window.location.reload();
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
        fetchPhotosData() {
            axios.get('/api/photos')
            .then(response => {
                this.photos = response.data.data;
            });
        },
        removePhoto(photoId) {
        axios.delete(`/api/photos/${photoId}`)
            .then(response => {
            console.log('Photo removed successfully!');
            this.fetchPhotosData()
            })
            .catch(error => {
            console.error('Failed to remove photo:', error);
            });
        }
    },
    created () {
        this.fetchDTData();
        this.fetchPanelData();
        this.fetchPhotosData()
    },
    mounted() {
        this.fetchPhotosData()
    },
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
    .gallery-elements {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        flex-direction: row;
    }
    .gallery-card {
        width: min(40vw, 40vh);
        height: 280px;
        border: 1px solid #e4e4e4;
        border-radius: 3px;
        margin: 0.5rem;
        box-shadow: 0px 4px 5px rgba(88, 72, 62, 0.4);
        display: flex;
        flex-direction: column;
        position: relative;
  }

  .image-delete-x {
    position: absolute;
    top: 5px;
    right: 10px;
    cursor: pointer;
    z-index: 1;
  }

  .image-container {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .gallery-image {
    object-fit: cover;
    max-height: 260px;
    max-width: 260px;
  }
    @media (max-width: 1400px) {
    }
</style>
