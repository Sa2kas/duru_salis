<template>
  <div class="right-side">
    <div class="links">
      <!-- <div class="links-item">
        user
        <div class="links-item-data">
          {{username}}
        </div>
      </div>
      <div class="links-item">
        fw version
        <div class="links-item-data">
          {{fw}}
        </div>
      </div> -->
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
      fw: ''
    }
  },
//   timers: {
//     getFW: { time: 2000, autostart: true, immediate: true, repeat: true }
//   },
  methods: {
    // logout () {
    //   this.$router.push('/login')
    // },
    // getFW () {
    //   this.$system.getInfo().then(({ release }) => { this.fw = release.revision })
    // }
    ...mapActions({
        signOut:'auth/logout'
    }),
    logout(){
        this.signOut()
    },
  },
//   created () {
//     this.username = this.$session.username()
//   }
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
.links-item .languages {
  margin: 0;
}
.links-item .language:first-child, .language-selected:first-child {
  margin-left: 0;
}
.links-item-data {
  color: #0054a6;
}
.side-line {
  background: rgba(168, 86, 39, 0.9);
  width: 56px;
  height: 100%;
}
@media only screen and (max-width: 1100px) {

}
</style>