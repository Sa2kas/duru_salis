<template>
    <div class="outside-door">
        <div class="outside-header"></div>
        <div class="outside-title">
            {{$i18n.locale == 'lt' ? 'Šarvuotos lauko durys' : 'Armored front door'}}
        </div>
        <div class="outside-door-body">
            <div class="outside-item">
                <div class="home-card-title">
                    {{$i18n.locale == 'lt' ? 'Šarvuotos lauko durys OKOUME' : 'Armored front door OKOUME'}}
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data" v-show="$i18n.locale == 'lt'">
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
                        <div class="home-card-data" v-show="$i18n.locale == 'en'">
                            These doors are made with VAF board, also known as Okoume board, which is made from gabon wood. This board is particularly resistant to environmental impact and is completely unafraid of moisture. The Okoume board is impregnated, primed, and coated using professional production methods to provide optimal protection.
                            <br>
                            We recommend using German quality locks such as Dorma 712 or Assa 565 for these doors.
                            <br>
                            The door frame is 80 mm insulated with a combination of mineral wool and foam.
                            <br>
                            The door leaf is 76 mm insulated with mineral wool.
                            <br>
                            Stainless steel threshold and door trims are included in the package.
                            <br>
                            Heat transfer coefficient Uw=1.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="(photo, index) in photos3" :key="photo.id" class="mySlides" :class="{ active: index === slideIndex3 }">
                                <img class="door-photo" :src="photo.path">
                            </div>
                            <a class="prev" @click="plusSlides(-1, 3)">❮</a>
                            <a class="next" @click="plusSlides(1, 3)">❯</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    {{$i18n.locale == 'lt' ? 'Šarvuotos lauko durys UMIDAX (MDF)' : 'Armored front door UMIDAX (MDF)'}}
                </div>
                <div class="body-item">
                    <div class="body-item-left" >
                        <div class="home-card-data" v-show="$i18n.locale == 'lt'">
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
                        <div class="home-card-data" v-show="$i18n.locale == 'en'">
                            These are warm and secure doors. The door finish uses moisture-resistant, outdoor-grade wood particle board (MDF).
                            <br>
                            The UMIDAX board is primed and painted in any desired color from a wide range of RAL colors.
                            <br>
                            We recommend using German quality locks such as Dorma 712 or Assa 565 for these doors.
                            <br>
                            The door frame is 80 mm insulated with a combination of mineral wool and foam.
                            <br>
                            The door leaf is 76 mm insulated with mineral wool.
                            <br>
                            Stainless steel threshold and door trims are included in the package.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="(photo, index) in photos1" :key="photo.id" class="mySlides" :class="{ active: index === slideIndex1 }">
                                <img class="door-photo" :src="photo.path">
                            </div>
                            <a class="prev" @click="plusSlides(-1, 1)">❮</a>
                            <a class="next" @click="plusSlides(1, 1)">❯</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    {{$i18n.locale == 'lt' ? 'Šarvuotos lauko durys EKONOMIK (LFSF, bakalitas)' : 'Armored front door EKONOMIK (LSFS, bakelite)'}}
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data" v-show="$i18n.locale == 'lt'">
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
                        <div class="home-card-data" v-show="$i18n.locale == 'en'">
                            These doors belong to the economic class as they are made from laminated multilayer plywood LFSF, also known as marine plywood or bakelite. The layers of plywood are bonded with water-resistant adhesives, and the outer laminated sides are covered with special paper impregnated with phenolic resin.
                            <br>
                            We recommend using German quality locks such as Dorma 712 or Assa 565 for these doors.
                            <br>
                            The door frame is 80 mm insulated with a combination of mineral wool and foam polystyrene.
                            <br>
                            The door leaf is 76 mm insulated with mineral wool.
                            <br>
                            Stainless steel threshold and door trims are included in the package.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <div class="slideshow-container">
                            <div v-for="(photo, index) in photos2" :key="photo.id" class="mySlides" :class="{ active: index === slideIndex2 }">
                                <img class="door-photo" :src="photo.path">
                            </div>
                            <a class="prev" @click="plusSlides(-1, 2)">❮</a>
                            <a class="next" @click="plusSlides(1, 2)">❯</a>
                        </div>
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
    data() {
        return {
            slideIndex1: 0,
            slideIndex2: 0,
            slideIndex3: 0,
            photos1:[],
            photos2:[],
            photos3:[],
        }
    },
    created() {
    this.fetchPhotoData();
  },
  methods: {
    async fetchPhotoData() {
      try {
        const response = await axios.get('/api/photos');
        this.photos3 = response.data.data.filter(elem => elem.panel == 3 && elem.door_type == 1);
        this.photos2 = response.data.data.filter(elem => elem.panel == 2 && elem.door_type == 1);
        this.photos1 = response.data.data.filter(elem => elem.panel == 1 && elem.door_type == 1);
        this.showSlides(this.slideIndex3, 3);
        this.showSlides(this.slideIndex2, 2);
        this.showSlides(this.slideIndex1, 1);
      } catch (error) {
        console.error(error);
      }
    },
    plusSlides(n, index) {
      if (index == 1) {
        this.slideIndex1 = (this.slideIndex1 + n + this.photos1.length) % this.photos1.length;
      }  else if (index == 2) {
        this.slideIndex2 = (this.slideIndex2 + n + this.photos1.length) % this.photos2.length;
      } else if (index == 3) {
        this.slideIndex3 = (this.slideIndex3 + n + this.photos3.length) % this.photos3.length;
      }
    },
    showSlides(n, index) {
      if (index == 1) {
        this.slideIndex1 = n;
      }  else if (index == 2) {
        this.slideIndex2 = n;
      } else if (index == 3) {
        this.slideIndex3 = n;
      }
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
    .mySlides.active {
        display: block;
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
