<template>
  <div class="menu">
    <div class="left-menu-side"/>
    <div class="right-menu-side">
      <div class="tab-title">
          Meniu
      </div>
      <div class="right-side-title">
          <router-link :to="'/'">
            <div class="right-side-title">
              Pagrindinis
            </div>
          </router-link>
      </div>
      <div v-if="!authenticated" class="right-side-title">
          <router-link :to="'/calculate_price'">
            Apskaičiuoti užsakymą
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 1">
          <router-link :to="'/dashboard'">
            Admin dashboard
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 2">
          <router-link :to="'/dashboard2'">
            Manager dashboard
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 3">
          <router-link :to="'/dashboard3'">
            Product manager dashboard
          </router-link>
      </div>
      <div class="right-side-title" v-if="authenticated">
          <router-link :to="'/orders'">
            Užsakymai
          </router-link>
      </div>
      <div class="right-side-title" v-if="userRole == 1">
          <router-link :to="'/users'">
            Naudotojai
          </router-link>
      </div>
      <div class="right-side-title">
          <router-link :to="'/contacts'">
            Kontaktai
          </router-link>
      </div>
      <div class="right-side-title">
          <router-link :to="'/comments'">
            Atsiliepimai
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