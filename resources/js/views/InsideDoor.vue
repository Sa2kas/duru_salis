<template>
    <div class="outside-door">
        <div class="outside-header"></div>
        <div class="outside-title">
            {{$i18n.locale == 'lt' ? 'Šarvuotos buto durys' : 'Armored apartment door'}}
        </div>
        <div class="outside-door-body">
            <div class="outside-item">
                <div class="home-card-title">
                    {{$i18n.locale == 'lt' ? 'Standartas' : 'Standart'}}
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data" v-show="$i18n.locale == 'lt'">
                            Durys pagamintos naudojant laminuotą medžio drožlių plokštę LMDP. Laminuotas paviršius atsparus drėgmei ir aukštesnei temperatūrai.
                            <br>
                            Šios durys standartiškai komplektuojamos su pagrindine Dorma 712 ir seifine ISEO 66360 spynomis, bet galima rinktis ir kitas spynas.
                            <br>
                            Durų stakta 80 mm apšiltinta kombinuotai – akmens vata ir putų polistirolu.
                            <br>
                            Durų varčia 66 mm apšiltinta akmens vata.
                            <br>
                            Komplektacijoje nerūdijančio plieno slenktis ir durų apvadai.
                        </div>
                        <div class="home-card-data" v-show="$i18n.locale == 'en'">
                            The doors are made using laminated wood chipboard LMDP. The laminated surface is resistant to moisture and high temperature.
                            <br>
                            These doors are standardly equipped with the main Dorma 712 lock and the safe ISEO 66360 lock, but other locks can also be chosen.
                            <br>
                            The door frame is 80 mm insulated with a combination of mineral wool and foam polystyrene.
                            <br>
                            The door leaf is 66 mm insulated with mineral wool.
                            <br>
                            Stainless steel threshold and door trims are included in the package.
                        </div>
                    </div>
                    <!-- <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="photo in photos3" :key="photo.id">
                                <div v-if="photo.panel == 3" class="mySlides fade">
                                    <img class="door-photo" :src="photo.path">
                                </div>
                            </div>
                            <a class="prev" @click="plusSlides(-1)">❮</a>
                            <a class="next" @click="plusSlides(1)">❯</a>
                        </div>
                    </div> -->
                </div>
            </div>
            
            <div class="outside-item">
                <div class="home-card-title">
                    {{$i18n.locale == 'lt' ? 'Laminuotos' : 'Laminated'}}
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data" v-show="$i18n.locale == 'lt'">
                            Tokios durys gaminamos iš medžio drožlių plokštės,vėliau plokštė užlaminuojama drėgmei atsparia PVC plėvele. Ši apdaila turi kietą paviršių, gerą estetinį vaizdą, duris lengva prižiūrėti, neblunka, atspari mechaniniams pažeidimams.
                            <br>
                            Šios durys standartiškai komplektuojamos su pagrindine Dorma 712 ir seifine ISEO 66360 spynomis, bet galima rinktis ir kitas spynas. Taip pat gali būti su akute ar be jos.
                            <br>
                            Durų stakta 80 mm apšiltinta kombinuotai – akmens vata ir putų polistirolu.
                            <br>
                            Durų varčia 66 mm apšiltinta akmens vata.
                        </div>
                        <div class="home-card-data" v-show="$i18n.locale == 'en'">
                            These doors are made of wood chipboard, and the board is laminated with a moisture-resistant PVC film. This finish has a solid surface, a good aesthetic appearance, the doors are easy to maintain, do not fade, and are resistant to mechanical damage.
                            <br>
                            These doors are standardly equipped with the main Dorma 712 lock and the safe ISEO 66360 lock, but other locks can also be chosen. They can also be with or without an eyepiece.
                            <br>
                            The door frame is 80 mm insulated with a combination of mineral wool and foam polystyrene.
                            <br>
                            The door leaf is 66 mm insulated with mineral wool.
                        </div>
                    </div>
                    <!-- <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="photo in photos2" :key="photo.id">
                                <div v-if="photo.panel == 2" class="mySlides fade">
                                    <img class="door-photo" :src="photo.path">
                                </div>
                            </div>
                            <a class="prev" @click="plusSlides(-1)">❮</a>
                            <a class="next" @click="plusSlides(1)">❯</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            slideIndex: 1,
            photos1:[],
            photos2:[],
            photos3:[],
        }
    },
    created(){
        this.fetchPhotoData();
        // this.showSlides(this.slideIndex);
    },
    mounted() {
        // this.fetchPhotoData();
        // this.plusSlides(this.slideIndex)
        // this.showSlides(this.slideIndex);
    },
    methods: {
        fetchPhotoData(){
            axios.get('/api/photos')
            .then(response => {
                this.photos1 = response.data.data;
                this.photos2 = response.data.data;
                this.photos3 = response.data.data;
            });
        }, 
        plusSlides(n) {
            this.showSlides(this.slideIndex += n);
        },
        currentSlide(n) {
            this.showSlides(this.slideIndex = n);
        },
        showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            // let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {this.slideIndex = 1}    
            if (n < 1) {this.slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            // for (i = 0; i < dots.length; i++) {
            //     dots[i].className = dots[i].className.replace(" active", "");
            // }
            slides[this.slideIndex-1].style.display = "block";  
            // dots[this.slideIndex-1].className += " active";
        }
    }
}
</script>
<style>
    .outside-door {
        display: block;
        padding-bottom: 5vh;
    }
    .outside-header {
        background-image: url('/images/inside.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position: center;
        margin-bottom: 3%;
    }
    .outside-title {
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
    .outside-door-body {
        padding: 20px 5px;
    }
    .outside-item {
        width: 96%;
        min-height: 300px;
        box-shadow: 0 2px 5px #444;
        padding: 10px;
        margin: 20px auto;
        border-radius: 2px;
    }
    .body-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        flex-direction: row;
    }
    .body-item-left {
        width: 100%;
        min-height: 280px;
        /* background-color: aquamarine; */
        position: relative;
        display: flex;
        flex-direction: row;
        margin: 1%;
    }
    .body-item-right {
        width: 48%;
        /* min-height: 380px;
        background-color:darksalmon; */
        position: relative;
        display: flex;
        float: right;
        margin: 1%;
    }
    .door-photo {
        width: 100%;
        object-fit: cover;
        height: 400px;
        /* background-color: #444; */
    }
    @media (max-width: 800px) {
        .body-item-left {
            width: 90%
        }
        .body-item-right {
            width: 90%
        }
    }
    .mySlides {
        display: none;
    }
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 100%;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.4);
}

/* The dots/bullets/indicators */
/* .dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
} */

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
