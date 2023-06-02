<template>
  <div class="menu">
    <div class="left-menu-side"/>
    <div class="right-menu-side">
      <div class="tab-title">
          {{$i18n.locale == 'lt' ? 'Meniu' : 'Menu'}}
      </div>
      <div class="right-side-title" @click="close">
          <router-link :to="'/'">
            <div class="right-side-title">
              {{$i18n.locale == 'lt' ? 'Pagrindinis' : 'Home'}}
            </div>
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/calculate_price'">
            {{$i18n.locale == 'lt' ? 'Apskaičiuoti užsakymo kainą' : 'Calculate the order price'}}
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/check_order'">
            {{$i18n.locale == 'lt' ? 'Tikrinti užsakymo būseną' : 'Check order status'}}
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/inside_doors'">
            {{$i18n.locale == 'lt' ? 'Šarvuotos buto durys' : 'Armored apartment door'}}
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/outside_doors'">
            {{$i18n.locale == 'lt' ? 'Šarvuotos lauko durys' : 'Armored front door'}}
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/locks'">
            {{$i18n.locale == 'lt' ? 'Spynos' : 'Locks'}}
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 1" @click="close">
          <router-link :to="'/dashboard'">
            {{$i18n.locale == 'lt' ? 'Administratoriaus puslapis' : 'Admin dashboard'}}
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 2" @click="close">
          <router-link :to="'/dashboard2'">
            {{$i18n.locale == 'lt' ? 'Vadybininko puslapis' : 'Manager dashboard'}}
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 3" @click="close">
          <router-link :to="'/dashboard3'">
            {{$i18n.locale == 'lt' ? 'Produktų vadybininko puslapis' : 'Product manager dashboard'}}
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 1" @click="close">
          <router-link :to="'/orders'">
            {{$i18n.locale == 'lt' ? 'Užsakymai' : 'Orders'}}
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 1" @click="close">
          <router-link :to="'/users'">
            {{$i18n.locale == 'lt' ? 'Naudotojai' : 'Users'}}
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title" @click="close">
          <router-link :to="'/contacts'">
            {{$i18n.locale == 'lt' ? 'Kontaktai' : 'Contacts'}}
          </router-link>
      </div>
      <div v-if="userRole == 1 || userRole == 2" class="right-side-title" @click="close">
          <router-link :to="'/edit_gallery'">
            {{$i18n.locale == 'lt' ? 'Tvarkyti galeriją' : 'Edit gallery'}}
          </router-link>
      </div>
      <div class="right-side-title" @click="close">
          <router-link :to="'/comments'">
            {{$i18n.locale == 'lt' ? 'Atsiliepimai' : 'Comments'}}
          </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data () {
    return {
      openKeys: [],
      selectedKeys: [],
      focusPath: null
    }
  },
  computed: {
    authenticated(){
        return this.$store.getters['auth/authenticated'];
    },
    user(){
        return this.$store.getters['auth/user'];
    },
    userRole(){
        return this.user ? this.user.role_id : 0
    },
  },
  watch: {
  },
  methods: {
    close: function () {
      this.$emit('close')
    }
  },
}
</script>

<style>
.menu {
  min-width: 300px;
  width: max-content;
  display: flex;
  opacity: 1 !important;
  background-color: #fff;
  height: 100%;
}
.left-menu-side {
  background: #723B1B;
  display: flex;
  flex-direction: column;
  color: #fff;
  text-align: center;
  padding-top: 171px;
  min-width: 56px;
  max-width: 56px;
}
.right-menu-side {
  background-color: #fff;
  padding: 164px 2.5vw;
  width: 100%;
  font-family: "Oswald",sans-serif;
  text-transform: uppercase;
}
.right-side-title a {
  text-decoration: none;
  color: #723B1B;
}
.right-side-title:hover a {
  text-decoration: none;
  color: #221108;
}
.tab-title {
  max-width: 100%;
  color: #444;
  font-size: 30px;
  text-decoration: underline;
  margin-bottom: 30px
}
@media only screen and (max-width: 1100px) {

}
</style>