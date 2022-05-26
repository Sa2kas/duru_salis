<template>
    <div class="outside-door">
        <div class="outside-header"></div>
        <div class="outside-title">
            Šarvuotos lauko durys
        </div>
        <div class="outside-door-body">
            <div class="outside-item">
                <div class="home-card-title">
                    Šarvuotos lauko durys OKOUME
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            Šios durys gaminamos su VAF plokšte dar vadinama Okoume plokšte, gaminama iš gabonmedžio. Ši plokštė ypatingai atspari aplinkos poveikiui ir visiškai nebijo drėgmės. Okoume plokštė impregnuojama, gruntuojama ir lakuojama naudojant profesionalią produkciją. Šios produkcijos dėka, plokštė apsaugoma optimaliausiai.
                            <br>
                            Šioms durims rekomenduojame Dorma 712 arba Assa 565 vokiškos kokybės spynas.
                            <br>
                             Durų stakta 80 mm apšiltinta kombinuotai – akmens vata ir puta.
                            <br>
                            Durų varčia 76 mm apšiltinta akmens vata.
                            <br>
                            Komplektacijoje nerūdijančio plieno slenktis ir durų apvadai.
                            <br>
                            Šilumos perdavimo koef. Uw=1.
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
                    Šarvuotos lauko durys UMIDAX (MDF)
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                        Tai šiltos ir saugios durys. Durų apdailai naudojama drėgmei atspari, lauko sąlygoms skirta medžio dulkių plokštė (MDF).
                        <br>
                        UMIDAX plokštė gruntuojama ir dažoma bet kuria užsakovo pageidaujama spalva iš plataus RAL spalvyno
                        <br>
                        Šioms durims rekomenduojame Dorma 712 arba Assa 565 vokiškos kokybės spynas.
                        <br>
                        Durų stakta 80 mm apšiltinta kombinuotai – akmens vata ir puta.
                        <br>
                        Durų varčia 76 mm apšiltinta akmens vata.
                        <br>
                        Komplektacijoje nerūdijančio plieno slenktis ir durų apvadai.
                    </div>
                    </div>
                    <!-- <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="photo in photos1" :key="photo.id">
                                <div v-if="photo.panel == 1" class="mySlides fade">
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
                    Šarvuotos lauko durys EKONOMIK (LFSF, bakalitas)
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            Šios durys priskiriamos ekonominei klasei, nes gaminamos iš laminuotos daugiasluoksnės faneros LFSF, kitaip vadinamos jūrine fanera arba bakalitu. Faneros sluoksniai suklijuoti vandeniui atspariais klijais, išorinės laminuotos faneros pusės padengtos specialiu popieriumi, įmirkytu fenolio derva.
                            <br>
                            Šioms durims rekomenduojame Dorma 712 arba Assa 565 vokiškos kokybės spynas.
                            <br>
                            Durų stakta 80 mm apšiltinta kombinuotai – akmens vata ir putų polistirolu.
                            <br>
                            Durų varčia 76 mm apšiltinta akmens vata.
                            <br>
                            Komplektacijoje nerūdijančio plieno slenktis ir durų apvadai.
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
        background-image: url('/images/outside.jpg');
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
