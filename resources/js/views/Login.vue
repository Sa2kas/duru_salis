<template>
  <div class="login-page">
    <div class="login-container">
      <div class="login-left">
        <!-- <img class="teltonika" src="/icons/teltonika.svg" alt="teltonika"> -->
        <div class="login-title">{{$t('login.auth_req')}}</div>
        <div class="login-info">
          {{$t('login.info')}}
        </div>
      </div>
      <div class="login-right">
        <form :model="form" onsubmit="return false">
          <div class="form-div">
            <input class="login-input" v-model="form.email" @pressEnter="handleLogin" :placeholder="'Please input email'"/>
            <label class="form-label">{{$t('login.email')}}</label>
          </div>
          <div class="form-div">
            <input class="login-input" id="password" v-model="form.password" @pressEnter="handleLogin" type="password" :placeholder="'Please input password'"/>
            <label class="form-label">{{$t('login.password')}}</label>
          </div>
          <div id="error">
            {{$t('login.error')}}
          </div>
          <button id="login" @click="handleLogin">{{$t('login.login')}}</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      form: {
        email: '',
        password: ''
      },
      show: false
    }
  },
  methods:{
    ...mapActions({
      signIn:'auth/login'
    }),
    handleLogin(){      
      axios.get('/api/csrf-cookie').then(response => {
        axios.post('/login', this.form).then(({data})=>{
          this.signIn()
        }).catch(({response:{data}})=>{
          alert(data.message)
        })/*.finally(()=>{
          this.processing = false
        })*/
      });
    }
  },
//   methods: {
//     handleLogin () {
//       this.$session.login(this.form.email, this.form.password).then((ok) => {
//         if (ok) {
//           this.$router.push('/')
//           return
//         }
//         document.getElementById('error').style.height = '16.25px'
//         document.getElementById('error').style.visibility = 'visible'
//       })
//     },
//     showHidePassword () {
//       if (this.show === true) {
//         document.querySelector('#password').setAttribute('type', 'password')
//         document.getElementById('showHide').style.background = 'url("/icons/input_show.svg") no-repeat 80%'
//         this.show = false
//       } else {
//         document.querySelector('#password').setAttribute('type', 'text')
//         document.getElementById('showHide').style.background = 'url("/icons/input_hide.svg") no-repeat 80%'
//         this.show = true
//       }
//     }
//   },
//   created () {
//     this.$session.logout()
//   }
}
</script>

<style>
.login-page {
  display: block;
}
.login-container {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: max-content;
  height: 426px;
  display: flex;
}
.login-left {
  width: 360px;
  /* background-color: #0054a6; */
  background-image: url('/images/login.jpg');
  background-repeat: no-repeat;
  background-size: cover, contain;
  background-position: 0 center;
  padding: 50px 40px;
  border-radius: 7px;
}
.login-right {
  width: 422.5px;
  height: 224px;
  background-color: #ffffff;
  padding: 100px 20px 60px 20px;
  margin: 20px 0;
  border: 1.25px solid #e4e4e4;
  border-radius: 0 7px 7px 0;
}
.login-title {
  letter-spacing: 0.12em;
  width: 100%;
  font-family: "Oswald", sans-serif;
  font-size: 19px;
  text-transform: uppercase;
  margin-bottom: 19px;
  display: block;
  color: #ffffff;
  text-shadow: 0 0 5px #000;
}
.login-info {
  text-shadow: 0 0 5px #000;
  color: #ffffff;
  display: block;
  font-family: "Open Sans", sans-serif;
  font-size: 14px;
  width: 60%;
  margin-bottom: 20px;
  line-height: 19px;
}
.form-div {
  position: relative;
  width: 300px;
  height: 40px;
  margin-bottom: 20px;
  margin-left: auto;
  margin-right: auto;
}
.login-input {
  width: 250px;
  height: 30px;
  margin-bottom: 20px;
  color: #000;
  font-size: 11px;
  font-weight: 400;
  font-family: Arial, Helvetica, sans-serif;
  display: flex;
  padding: 6.6px 40px 5.5px 5.5px;
  border: 1.5px solid #afafaf;
  border-radius: 7px;
  position: relative;
}
.login-input:focus {
  outline: none;
  box-shadow: 0px 0px 5px rgba(24, 143, 255, 0.5);
  border: 1.5px solid rgba(24, 143, 255, 0.5);
  transition: 0.2s;
}
#showHide {
  position: absolute;
  width: 27px;
  height: 25px;
  background: url("/icons/input_show.svg") no-repeat 80%;
  top: 0.5em;
  left: 19em;
  border: none;
  cursor: pointer;
  z-index: 5;
}
.form-label {
  position: absolute;
  /* sito nereik, bet tada neatrodo taip nukirsta */
  /* background: linear-gradient(to right, #ffffff00 0%, #ffffff 5px, #ffffff calc(100% - 5px), #ffffff00 100%); */
  background-color: #ffffff;
  color: #9090a5;
  font-size: 12px;
  display: inline-block;
  padding: 0 6px;
  z-index: 1;
  font-weight: 400;
  font-family: "Open Sans", sans-serif;
  letter-spacing: 0.01em;
  padding: 0 0.5em;
  top: -0.75em;
  left: 1em;
}
#error {
  width: 300px;
  height: 0px;
  color: #dd4b39;
  font-size: 12px;
  font-weight: 400;
  text-align: center;
  font-family: "Open Sans", sans-serif;
  margin-bottom: 16.25px;
  visibility: hidden;
}
#login {
  background-color: #ffffff;
  padding: 0.2em 0.5em;
  border: 1.5px solid rgba(68, 68, 68, 0.5);
  border-radius: 5px;
  cursor: pointer;
  display: block;
  font-family: "Oswald", sans-serif;
  font-weight: 300;
  font-size: 14px;
  letter-spacing: 0.04em;
  margin: 0 auto;
  text-transform: uppercase;
  color: #444;
}
#login:hover {
    border: 1.5px solid rgba(15, 47, 117, 0.7);
    box-shadow: 0 0 5px rgba(15, 47, 117, 0.2);
}
@media only screen and (max-width: 920px) {
  .login-container {
    display: block;
    position: relative;
    min-width: unset;
    top: unset;
    left: unset;
    transform: unset;
    width: 100%;
    height: 100%;
  }
  .login-left {
    width: initial;
    border-radius: 0;
    padding: 50px 40px 50px 40px;
  }
  .login-right {
    border: unset;
    width: max-content;
    margin-left: auto;
    margin-right: auto;
    padding: 60px 20px 40px 20px;
  }
  .form-div {
    margin-left: unset;
  }
}
@media only screen and (max-width: 500px) {
  #login {
    max-width: 160px;
    font-size: 13px;
    padding: 1px 12.5px;
  }
}
</style>