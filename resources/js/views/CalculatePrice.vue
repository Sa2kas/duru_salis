<template>
    <div class="calculate-price">
        <div class="calculate-header"></div>
        <div class="calculate-title">
            {{this.$i18n.locale == 'lt' ? 'Preliminarios kainos apskaičiavimas' : 'Preliminary price calculation'}}
        </div>
        <door-form></door-form>
    </div>
</template>
<script>
import DoorForm from '../components/DoorForm.vue'
export default {
    components: {
        DoorForm
    }
}
</script>
<style>
    .calculate-price {
        display: block;
        padding-bottom: 5vh;
    }
    .calculate-header {
        background-image: url('/images/cup-phone.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position: bottom;
        margin-bottom: 3%;
    }
    .calculate-title {
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
        font-size: min(5vw, 34px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        letter-spacing: 0.08em;
        text-align: center;
        box-shadow: 0px 3px 3px #444;
        border-radius: 3px;
        line-height: min(6vw, 34px);
    }
    
    @media (max-width: 1400px) {
    }
</style>
