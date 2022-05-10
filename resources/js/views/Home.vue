<template>
    <div class="home">
        <div class="main-page-image" id="home-image">
            <h1>
                {{ $t("home.title") }}
            </h1>
        </div>
        <h3 @click="scroll()"><span></span>{{ $t("home.scroll") }}</h3>
        <div id="after-image">
            <div class="after-image-title">
                Ką galime Jums pasiūlyti
            </div>
            <div class="image-title-after"/>
            <div class="flex-wrap">
                <div class="after-image-flex">
                    <div class="after-image-card">
                        <div class="home-card-title">
                            Lauko durys
                        </div>
                        <div class="home-card-data">
                            Lauko durys - tai namo vizitinė kortelė, jas pastebi kiekvienas. Dažniausiai name varstomos durys turi būti ne tik gražios, derėti prie namo išorės, bet ir ilgai tarnauti. <br/>
                            Šarvuotų lauko durų apdailai turi būti naudojamos atmosferiniam poveikiui atsparios plokštės. Atsižvelgiant į tai, mes siūlome: <br/>
                            Šarvuotas lauko duris <strong>OKOUME</strong> <br/>
                            Šarvuotas lauko duris <strong>UMIDAX (MDF)</strong> <br/>
                            Šarvuotas lauko duris <strong>EKONOMIK (LFSF, bakalitas)</strong> <br/>
                        </div>
                        <button class="more-info">Daugiau informacijos</button>
                    </div>
                    <div class="after-image-card">
                        <div class="home-card-title">
                            Buto durys
                        </div>
                        <div class="home-card-data">
                            Šarvuotos vidaus patalpų durys - skirtos patalpų apsaugai vidaus sąlygomis: daugiabučio gyvenamojo namo butų, biurų, kasos patalpų ir pan. Šios durys yra padengtos medžio imitacijos LMDP arba MDF plokšte, todėl jų negalima naudoti lauko sąlygomis arba ten, kur didelis drėgnumas. <br/>
                            Šarvuotos vidaus durys <strong>Standartas (LMDP)</strong><br/>
                            Šarvuotos vidaus durys <strong>Laminuotos (MDF)</strong><br/><br/>
                        </div>
                        <button class="more-info">Daugiau informacijos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ExampleComponent from '../components/ExampleComponent.vue'
export default {
    components: {
        ExampleComponent
    },
    data(){
        return {    
            langs: [
                'ja',
                'en'
            ]     
        }
    },
    methods: {
        scroll () {
            document.getElementById('after-image').scrollIntoView({block: 'start', behavior: 'smooth', })
        }
    }
}
</script>
<style>
    .home {
        display: block;
    }
    .main-page-image {
        width: 100%;
        height: min(100vh, 100vw);
        background-image: url('/images/bike-door.jpg');
        background-size: cover;
        background-position:center;
        opacity: 1;
        z-index: 0;
    }
    .main-page-image h1 {
        cursor: default;
        position: absolute;
        top: calc(min(100vh, 100vw));
        left: 50%;
        z-index: 2;
        transform: translate(-50%, -110%);
        color: #fff;
        font-family: "Open Sans", sans-serif;
        font-size: min(5vw, 42px);
        letter-spacing: 0.08em;
        font-weight: 300;
        text-align: center;
        white-space: nowrap;
        background: linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,0.7) 50%,rgba(0,0,0,0.7) 100%);
        width: 100%;
        padding-bottom: calc(min(100vh, 100vw)*0.13);
        padding-top: calc(min(100vh, 100vw)*0.17 - 10px);
        margin-bottom: 0;
    }
        
    #after-image {
        width: 100%;
        min-height: calc(100vh - 40px);
        background-color: rgba(252, 252, 252);
        display: block;
    }
    .after-image-title {
        text-align: center;
        font-size: 26px;
        font-family: "Open Sans", sans-serif;
        color: #221108;
        /* width: 100vw; */
        /* background-color: aqua; */
        margin: 0.5vh auto;
        padding: 8vh 0.5vw 1vh 0.5vw;
        /* box-shadow: 0px 4px 4px rgba(88, 72, 62, 0.5); */
    }
    .image-title-after {
        width: 90%;
        background: linear-gradient(to top,rgba(0,0,0,0) 0,rgba(0,0,0,0.2) 60%,rgba(0,0,0,0.6) 100%);
        border-radius: 2px;
        height: 5px;
        margin: 0 auto;
        margin-bottom: 5vh;
        /* box-shadow: 0px 4px 4px rgba(88, 72, 62, 0.5); */
    }
    .after-image-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        flex-direction: row;
    }
    .after-image-card {
        width: min(80vw, 80vh);
        max-width: 100vw;
        min-height: 280px;
        max-height: 460px;
        padding: 20px 15px;
        border: 1px solid #e4e4e4;
        border-radius: 3px;
        margin: 2vh 1vw;
        box-shadow: 0px 4px 5px rgba(88, 72, 62, 0.4);
    }
    .home-card-title {
        font-size: 26px;
        font-weight: 300;
        color: #221108;
        font-family: "Oswald", sans-serif;
        letter-spacing: 0.1em;
        border-bottom: 1px solid rgba(34, 17, 8, 0.5);
        margin-bottom: 1em;
    }
    .home-card-data {
        padding: 1vh 0.5vw;
        font-size: 16px;
        font-family: "Open Sans", sans-serif;
        font-weight: 300;
        letter-spacing: 0.01em;
        word-spacing: 0.15em;
    }
    .home-card-data strong {
        font-weight: 600;
    }
    .more-info {
        background-color: #fff;
        font-family: "Oswald", sans-serif;
        font-size: 16px;
        font-weight: 300;
        border: 1px solid #723B1B;
        letter-spacing: 0.05em;
        border-radius: 5px;
        padding: 0.5em 1em;
        float: right;
        margin: 2em 1em 0.5em 1em;
        color: #723B1B;
        transition: 0.5s;
        text-transform: uppercase;
        letter-spacing: -0.01em;
    }
    .more-info:hover {
        cursor: pointer;
        background-color: #723B1B;
        color: #fff;
        border: 1px solid #fff;
        transition: 0.5s;
    }
    @media (max-width: 1400px) {
        .after-image-card {
            width: 88%;
        }
    }
    .home h3 {
        position: absolute;
        top: calc(min(100vh, 100vw) * 0.94);
        left: 50%;
        z-index: 2;
        display: inline-block;
        transform: translate(-50%, -70%);
        color: #fff;
        font-family: "Open Sans", sans-serif;
        letter-spacing: 0.15em;
        font-weight: 200;
        font-size: min(3vw, 24px);
        text-decoration: none;
        transition: opacity 0.25s;
        padding-top: calc(min(100vh, 100vw) * 0.08);
        text-shadow: 0 0 2px rgb(0, 0, 0);
        margin: 0;
        cursor: pointer;
    }
    .home h3:hover {
        opacity: 0.7;
    }
    .home h3 span {
        position: absolute;
        top: 0;
        left: 50%;
        width: min(3vw, 3vh);
        height: min(3vw, 3vh);
        margin-left: calc(min(1.5vw,1.5vh)*(-1));
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: rotate(-45deg);
        animation: sdb01 1.5s infinite;
    }
    @keyframes sdb01 {
        0% {
            transform: rotate(-45deg) translate(0, 0);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: rotate(-45deg) translate(calc(min(1vh, 1vw)*(-3)), calc(min(1vh, 1vw)*3));
            opacity: 0;
        }
    }
    html {
        scroll-behavior: smooth;
    }
</style>
