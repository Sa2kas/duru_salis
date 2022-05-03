/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//import App from './components/App.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router'
import store from './store'
import VueI18n from 'vue-i18n'
//
Vue.use(VueI18n)

require('./bootstrap');

//window.Vue = require('vue').default;
Vue.use(VueRouter)

// Ready translated locale messages
const messages = {
    en: {
      header: {
        login: 'login',
        logout: 'logout'
      },
      home: {
        title: 'Choose the door of your dreams',
        scroll: 'Scroll'
      },
      login: {
        auth_req: 'authorization required',
        info: 'Please enter your email and password',
        email: 'Email',
        password: 'Password',
        login: 'Login',
        error: 'Invalid email and/or password! Please try again.'
      }
    },
    lt: {
      header: {
        login: 'prisijungti',
        logout: 'atsijungti'
      },
      home: {
        title: 'Išsirinkite savo svajonių duris',
        scroll: 'Slinkti'
      },
      login: {
        auth_req: 'Reikalinga autorizacija',
        info: 'Prašome įvesti elektroninį paštą ir slaptažodį',
        email: 'El. paštas',
        password: 'Slaptažodis',
        login: 'Prisijungti',
        error: 'Neteisingas slaptažodis arba el. paštas. Bandykite dar kartą.'
      }
    }
  }
  
  // Create VueI18n instance with options
  const i18n = new VueI18n({
    locale: 'ja', // set locale
    messages, // set locale messages
  })


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./views/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // el: '#app',
    router,
    store:store,
    i18n
}).$mount('#app')

i18n.locale = 'lt'
