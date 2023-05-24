<template>
  <div class="check-order">
    <div class="check-header"></div>
    <div class="check-title">
      {{$i18n.locale == 'lt' ? 'Tikrinti užsakymo būseną' : 'Check order status'}}
    </div>
    <div class="check-info">
        <span>
            {{$i18n.locale == 'lt' ? 'Norėdami patikrinti pateikto užsakymo būseną įveskite užsakymo numerį' : 'Enter the order number to check the status of your order'}}
        </span>
        <div class="check-place">
            <input v-model="orderId" type="text" class="order-id-check">
            <br>
            <button @click="fetchOrderData" :disabled="!orderId" :class="{'disabled-check-button' : !orderId, 'check-order-button' : orderId }">{{$i18n.locale == 'lt' ? 'Tikrinti' : 'Check'}}</button>
            
        </div>
        <div style="font-size: min(3.2vw, 14px);">
            <span v-if="order && status.length">
            {{$i18n.locale == 'lt' ? 'Jūsų užsakymo būsena: ': 'Your order status: '}}
            <span style="text-transform: uppercase; font-weight: 500">{{status}}</span>
            </span>
            <span v-if="showError" style="color: #723B1B;">
            {{$i18n.locale == 'lt' ? 'Užsakymas nerastas' : 'Order not found'}}
            </span>
        </div>
    </div>
    
    <!-- <form @submit.prevent="submit">
      <input type="file" @change="onChange">
      <input type="submit" value="Upload">
    </form>
    <img :src="url" width="200px" alt="">
    <button @click="setUrl('/images/oakWood.jpg')">pirmas</button>  
    <button @click="setUrl('/images/lock.jpg')">antras</button>  
    <button @click="flip()">flip</button>
    <img v-show="false" id="image" src="images/R1.jpg" width="200px" alt="">
    <div class="box">
      <img :src="url2" alt="" class="image">
      <canvas id="output-canvas"></canvas>
    </div>
    <br/>
    <input type="button" id="button" value="Change" @click="initCanvas"> -->
  </div>
</template>

<script>
export default {
  mounted() {
    //this.initCanvas();
  },
  data() {
    return {
      side: 'left',
      orderId: '',
      order: {},
      status: '',
      showError: false,
      url: '/images/none.jpg',
      url2: '/images/none.jpg',
      height: null,
      count: 0,
      image: null,
      c1: null,
      ctx1: null,
      c_tmp: null,
      ctx_tmp: null,
    };
  },
  methods: {
    flip() {
        this.ctx_tmp.scale(-1, 1);
    },
    initCanvas() {
      this.image = document.getElementById('image');
      this.c1 = document.getElementById('output-canvas');
      this.c1.width = 200;
      this.c1.height = 200;
      this.ctx1 = this.c1.getContext('2d');

      this.c_tmp = document.createElement('canvas');
      this.c_tmp.setAttribute('width', 200);
      this.c_tmp.setAttribute('height', 200);
      this.ctx_tmp = this.c_tmp.getContext('2d');

      this.computeFrame();
    },
    computeFrame() {
      let coef = 200 / this.image.naturalWidth;
      this.ctx1.scale(-1, 1);
      this.ctx_tmp.drawImage(
        this.image,
        0,
        0,
        this.image.naturalWidth * coef,
        this.image.naturalHeight * coef
      );
      let frame = this.ctx_tmp.getImageData(
        0,
        0,
        this.image.naturalWidth,
        this.image.naturalHeight
      );

      for (let i = 0; i < frame.data.length * 4; i += 4) {
        let r = frame.data[i]; //red
        let g = frame.data[i + 1]; //green
        let b = frame.data[i + 2]; //blue
        let a = frame.data[i + 3];

        if (r >= 176 && r < 255 && g > 176 && g < 255 && b > 176 && b < 255) {
          frame.data[i + 3] = a * 0.05;
        }
      }
      this.ctx1.putImageData(frame, 0, 0);
    },
    
    setUrl(url) {
      this.url2 = url;
    },
    onChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    fetchOrderData() {
      axios
        .get('/api/orders')
        .then(response => {
          this.order = response.data.data.filter(elem => elem.id == this.orderId)[0];
          this.showError = this.order ? false : true
          if (this.order.status_id) {
            axios
            .get('/api/statuses')
            .then(response => {
            let status_object = this.order.status_id ? response.data.data.filter(elem => elem.id == this.order.status_id)[0] : {}
            this.status = this.$i18n.locale == 'lt' && status_object ? status_object.title : status_object.title_en
            });
          }
        });
        
        // console.log(this.showError)
        // console.log(this.order)
    },
  },
//   watch: {
//         side(newSide) {
//             this.ctx1.scale(-1, 1);
//         }
//     }
};
</script>

<style>
    .check-order {
        padding-bottom: 10vh;
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
    .check-info {
        background-color: rgb(220, 217, 217);
        padding: 5vh 10vw;
        margin: 12vh 0 8vh 0;
        left: 10vw;
        display: block;
        font-size: min(3.5vw, 18px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        letter-spacing: 0.04em;
    }
    .check-place {
        display: flex;
        padding: 10px 0;
        justify-content: space-between;
    }
    .order-id-check {
        padding: 10px;
        width: 40vw;
    }
    .check-order-button, .disabled-check-button {
        background-color: #fff;
        font-family: "Oswald", sans-serif;
        font-size: 14px;
        font-weight: 400;
        border: 1px solid #723B1B;
        letter-spacing: 0.1em;
        border-radius: 5px;
        padding: 0.3em 1em;
        color: #723B1B;
        transition: 0.5s;
        margin-right: -15px;
    }
    .check-order-button:hover {
        cursor: pointer;
        background-color: #723B1B;
        color: #fff;
        border: 1px solid #fff;
        transition: 0.5s;
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
