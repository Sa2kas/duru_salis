<template>
    <div class="home">
        <div class="main-page-image" id="home-image">
            <h1>
                {{ $t("home.title") }}
            </h1>
        </div>
        <h3 @click="scroll()"><span></span>{{ $t("home.scroll") }}</h3>
        <div id="after-image">
            <h1 style="margin: 0">
                Kaip išsirinkti
            </h1>
            <h2>
                Apie lauko duris
            </h2>
            <h2>
                Apie vidaus duris
            </h2>
            <h2>
                Apie spynas
            </h2>
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
        padding-top: calc(min(100vh, 100vw)*0.17);
        margin-bottom: 0;
        text-shadow: 0 0 2px rgb(0, 0, 0);
    }
        
    #after-image {
        width: 100%;
        min-height: calc(100vh - 40px);
        background-color: rgba(168, 86, 39, 0.05)
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
