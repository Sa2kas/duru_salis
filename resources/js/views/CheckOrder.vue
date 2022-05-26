<template>
    <div class="check-order">
        <div class="check-header"></div>
        <div class="check-title">
            Tikrinti užsakymo būseną
        </div>
        <h3>
            Norėdami patikrinti pateikto užsakymo būseną įveskite užsakymo numerį
        </h3>
        <input v-model="orderId" type="text" class="order-id-check">
        <br>
        <button @click="fetchOrderData(); showError=true" class="check-order">Tikrinti</button>
        <span v-if="order.length != 0 && showError == true">
            {{order}}
        </span>
         <span v-if="order.length == 0 && showError == true">
            Užsakymas nerastas
        </span>
        <form @submit.prevent="submit">
            <input type="file" @change="onChange">
            <input type="submit" Value="Upload">
        </form>
        <img :src="url" width="200px" alt="">
    <button @click="url2='/images/oakWood.jpg'">pirmas</button>  
    <button @click="url2='/images/lock.jpg'">antras</button>  
    <img v-show="false" id="image" src="images/R1.jpg" width="200px" alt="">
    <div class="box">
        <img :src="url2" alt="" class="image">
        <canvas id="output-canvas"></canvas>
    </div>
    <br/>
    <input type="button" id="button" value="Change"/>
    </div>
</template>
<script>

export default {
    components: {
    },
    mounted() {
            let image,image2,c1,ctx1,c_tmp,ctx_tmp; 
            function init() {
                image = document.getElementById('image');

                c1 = document.getElementById('output-canvas');
                c1.width = 200
                c1.height = 200
                ctx1 = c1.getContext('2d');

                c_tmp = document.createElement('canvas');
                c_tmp.setAttribute('width', 200);
                c_tmp.setAttribute('height', 200);
                ctx_tmp = c_tmp.getContext('2d');

                computeFrame()
            }
        function computeFrame() {

            let coef =200 / image.naturalWidth
            ctx_tmp.drawImage(image, 0, 0, image.naturalWidth*coef, image.naturalHeight*coef);
            let frame = ctx_tmp.getImageData(0, 0, image.naturalWidth , image.naturalHeight );

            for (let i = 0; i < frame.data.length*4; i+=4) {
                let r = frame.data[i]; //red
                let g = frame.data[i + 1]; //green
                let b = frame.data[i + 2]; //blue
                let a = frame.data[i + 3];

                if (r >= 176 && r < 255 && g > 176 && g < 255 && b > 176 && b < 255) 
                {  
                    frame.data[i + 3] = a * 0.05
                }
            }
            ctx1.putImageData(frame, 0, 0);
            
        }

        var button = document.getElementById("button");
        button.addEventListener("click", init,false);
        document.addEventListener("DOMContentLoaded", () => {
            init();
        });
    },
    data () {
        return {
            orderId: '',
            order: [],
            showError: false,
            url: '/images/none.jpg',
            url2: '/images/none.jpg',
            height: null,
            count: 0,
            
        }
    },
    computed: {
        dataSource () {
            return this.paramTypes.filter(elem => !this.search || elem.title.toLowerCase().includes(this.search.toLowerCase()) || elem.title_en.includes(this.search))
        }
    },
    methods: {
        onChange(e) {
            const file = e.target.files[0]
            this.url = URL.createObjectURL(file)
        },
        fetchOrderData(){
            axios.get('/api/orders')
            .then(response => {
                this.order = response.data.data.filter(elem => elem.id == this.orderId);
            });
        }, 
        
        setImage() {
        },
    }
}
</script>
<style>
    .check-order {
        display: block;
        padding-bottom: 5vh;
    }
    .check-header {
        background-image: url('/images/check.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position: center;
        margin-bottom: 3%;
    }
    .check-title {
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
    @media (max-width: 1400px) {
    }
</style>
