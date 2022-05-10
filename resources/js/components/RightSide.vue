<template>
  <div class="right-side">
    <div class="links">
      <div class="links-item" >
        <div class="languages">
          <div :class="$i18n.locale == 'lt' ? 'language-selected' : 'language'" @click="changeLang('lt')">LT </div>| 
          <div :class="$i18n.locale == 'en' ? 'language-selected' : 'language'" @click="changeLang('en')"> EN</div>
        </div>               
      </div>
      <div class="links-item" v-if="!authenticated">
        <router-link :to="'/login'">
          <div class="links-item-data">{{ $t("header.login") }}</div>                
        </router-link>
      </div>
      <div  v-else>
        <div class="links-item">
          rolė: 
          <div class="links-item-data"  @click="logout()">
            {{ user.name }}
          </div>
        </div>
        <div class="links-item">
          <div class="links-item-data"  @click="logout()">
            {{ $t("header.logout") }}
          </div>
        </div>
      </div>
    </div>
    <div class="side-line"></div>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      username: '',
    }
  },
  methods: {
    ...mapActions({
        signOut:'auth/logout'
    }),
    logout(){
        this.signOut()
    },
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
      routeName() {
          return this.$route.name;
      }
  },
}
</script>
<style>
.right-side {
  justify-content: space-between;
  display: flex;
  width: 100%;
  background-color: #fff;
}
.links {
  margin-top: 30px;
  margin-left: 30px;
}
.links-item {
  font-family: "Oswald",sans-serif;
  font-weight: 400;
  font-size: 16px;
  text-transform: uppercase;
  cursor: pointer;
  margin-bottom: 20px;
  color: #6f6f6f;
  display: flex;
  flex-direction: column;
}
.links-item a {
  text-decoration: none;
  color: #723B1B;
}
.links-item:hover a {
  text-decoration: none;
  color: #221108;
}
.links-item .languages {
  margin: 0;
}
.links-item .language:first-child, .language-selected:first-child {
  margin-left: 0;
}
.side-line {
  background: #723B1B;
  width: 56px;
  height: 100%;
}
@media only screen and (max-width: 1100px) {

}
</style>