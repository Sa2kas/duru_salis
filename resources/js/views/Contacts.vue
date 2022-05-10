<template>
    <div class="contacts">
        <div class="contact-header"></div>
        <div class="contact-title">
            Turite klausimų? Susisiekite
        </div>
        <div class="contact-body">
            <div class="body-card">
                <div class="card-title">
                    UAB Durų šalis
                </div>
                <div class="card-data">
                    <strong>PVM kodas:</strong> LT100008314016 <br/>
                    <strong>Įmonės kodas:</strong> 303224483 <br/>
                    <strong>A/s</strong> LT94 7300 0101 5166 3393, “Swedbank”, AB
                </div>
                <div class="card-data">
                    <strong>Adresas:</strong> Žiemgalių g. 8, Kaunas LT-48230
                </div>
                <div class="card-data">
                    <strong>El.paštas:</strong> info@durusalis.lt
                </div>
                <div class="card-data">
                    <strong>Darbo laikas:</strong> <br/>
                    Pirm - Penkt: 9:00 iki 18:00 <br/>
                    Šeštadienį: NEDIRBAME <br/>
                    Sekmadienį: NEDIRBAME <br/>
                </div>
                <div>
                    
                </div>
            </div>
            <div class="body-card">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2292.681551564004!2d23.87505521600804!3d54.92606006291441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46e71f4f4705cfd9%3A0xe9567e4168c50550!2s%C5%BDiemgali%C5%B3+g.+8%2C+Kaunas+48230!5e0!3m2!1sen!2slt!4v1560949332303!5m2!1sen!2slt" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
    .contacts {
        display: block;
        padding-bottom: 5vh;
    }
    .contact-header {
        background-image: url('/images/contact.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position:center;
        margin-bottom: 3%;
    }
    .contact-title {
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
    .contact-body {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        flex-direction: row;
        padding: min(10vh, 10vw) 18px 28px 28px;
    }
    .body-card {
        width: min(80vw, 80vh);
        max-width: 100vw;
        height: 350px;
        padding: 20px 15px;
        border: 1px solid #e4e4e4;
        border-radius: 3px;
        margin: 1vh 1vw 2vh 1vw;
        box-shadow: 0px 4px 5px #58483E;
    }
    .body-card:nth-child(2) {
        padding: 0;
        height: 390px;
        width: calc(min(80vw, 80vh) + 30px);
    }
    .card-title {
        font-family: "Open Sans", sans-serif;
        font-size: 26px;
        padding: 0.5vh 2vw;
        color: #723B1B;
        font-weight: 500;
        margin-bottom: 10px;
    }
    .card-data {
        font-family: "Open Sans", sans-serif;
        font-size: 16px;
        padding: 0.5vh 0.5vw;
        color: #221108;
    }
    @media (max-width: 1400px) {
        .body-card {
            width: 90%;
        }
        .body-card:nth-child(2) {
            width: calc(90% + 30px);
        }
    }
</style>
