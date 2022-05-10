<template>
    <div class="comments">
        <div class="comments-header"></div>
        <div class="comments-title">
            Klientų atsiliepimai
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
    .comments {
        display: block;
        padding-bottom: 5vh;
    }
    .comments-header {
        background-image: url('/images/cup-phone.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position:center;
        margin-bottom: 3%;
    }
    .comments-title {
        background-color: rgb(252, 252, 252);
        width: 80vw;
        height: min(18vh, 18vw);
        max-height: 65px;
        min-height: 50px;
        margin: 0 auto;
        padding: min(min(5vh, 5vw), 15px) 0 0 0;
        position: absolute;
        top: min(min(60vh, 60vw), 350px);
        left: 10vw;
        display: block;
        font-size: min(6vw, 34px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        letter-spacing: 0.08em;
        text-align: center;
        box-shadow: 0px 3px 3px #444;
        border-radius: 3px;
    }
    
    @media (max-width: 1400px) {
    }
</style>
