<template>
    <div class="outside-door">
        <div class="outside-header"></div>
        <div class="outside-title">
            Spynos
        </div>
        <div class="outside-door-body">
            <div class="outside-item">
                <div class="home-card-title">
                    EVVA EPS
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            Komplektojama su Dorma 712 spynos korpusu
                            <br>
                            Patentuota rakinimo sistema, patentuotas dvigubas rakto profilis (patento galiojimas iki 2026 metų);
                            <br>
                            Teisiškai, techniškai bei organizacine prasme nuo nelegalaus kopijavimo apsaugotas raktas, rakto kopija daroma tik pateikus raktą bei identifikacinę kortelę;
                            <br>
                            Aukščiausia 6-toji saugumo klasė pagal pagrindinį Europos spynų cilindrų saugumą reglamentuojantį standartą EN 1303:2005;
                            <br>
                            Atsparus dėvėjimuisi nikelio sidabro lydinio raktas;
                        </div>
                    </div>
                    <div class="body-item-right">
                        <img class="door-photo" src="/images/evva.png">
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    ISEO 66360
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            Ši spyna skirta metalinėms durims.
                            <br>
                            Nikeliu chromu priekinė spynos plokštelė.
                            <br>
                            Pateikiama su poliruoto chromo raktaskylėmis.
                            <br>
                            Rakinasi trim kryptim. Komplekte yra 5 raktai.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <img class="door-photo" src="/images/663.jpeg">
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    FIAM 672
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            cilindrinė krumpliaratinė spyna, skirta aukšto saugumo lygio šarvo durims
                            <br>
                            Unikalus spynos krumpliaratinis rakinimo mechanizmas: spyna rakinama ypač tyliai ir švelniai, mažiau dėvisi cilindras.
                            <br>
                            Speciali krumpliaratinio mechanizmo konstrukcija bei jame esantys grūdinto plieno strypai saugo nuo kaiščių sustūmimo ir mechanizmo pragręžimo.
                            <br>
                            Patentuotas, stiprus cilindro tvirtinimas, saugantis nuo cilindro išmušimo ir sulaužymo.
                            <br>
                            Pagrindiniai saugumo parametrai atitinka 7-osios − aukščiausiosio saugumo klasės reikalavimus pagal EN 12209.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <img class="door-photo" src="/images/FIAM.jpeg">
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    Dierre 6000
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            Plokštelinė (6 plokštelės) seifinė, perkoduojama spyna. Su apsaugine plokštele, keičiama kasete.
                            <br>
                            Apsauga nuo gręžimo, rūgšties, pjovimo, visrakčio. Mechanizmą galima keisti daug kartų be meistro pagalbos.
                            <br>
                            Teisiškai, techniškai bei organizacine prasme nuo nelegalaus kopijavimo apsaugotas raktas, rakto kopija daroma tik pateikus raktą bei identifikacinę kortelę;
                            <br>
                            Rakina trimis kryptimis. Komplekte 5 dideli raktai įpakuoti dežutėje + 1 statybinis raktas.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <img class="door-photo" src="/images/diere.jpeg">
                    </div>
                </div>
            </div>
            <div class="outside-item">
                <div class="home-card-title">
                    MOTTURA 52N883
                </div>
                <div class="body-item">
                    <div class="body-item-left">
                        <div class="home-card-data">
                            7-oji, aukščiausioji, spynos saugumo klasė pagal EN 12209 ir priešgaisrinis sertifikatas.
                            <br>
                            Patentuota MOTTURA ANTIDECO II sistema, sauganti nuo atrakinimo visrakčiu.
                            <br>
                            Penki galingi kaiščiai atlaiko net 1,5 tonos (15 kN) šoninę spaudimo jėgą.
                            <br>
                            Standartiškai tiekiama su 2 mm grūdinto manganinio plieno apsauga, kuri saugo svarbiausius spynos taškus nuo pragręžimo.
                            <br>
                            Komplekte yra 5 asimetriniai raktai su ergonomiškomis gumos bei plastiko mišinio galvutėmis, pateikiami sandarioje pakuotėje, kuri atidaroma tik pirkėjui matant.
                        </div>
                    </div>
                    <div class="body-item-right">
                        <img class="door-photo" src="/images/52n.jpeg">
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
        background-image: url('/images/lock.jpg');
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
        width: 48%;
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
        /* width: 100%; */
        object-fit: cover;
        height: 300px;
        object-fit:scale-down;
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
