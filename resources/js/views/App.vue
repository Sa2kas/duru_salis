<template>
  <div class="page">
    <div class="page-header" v-show="routeName != 'login'" >
      <vue-header/>
    </div>
    <div class="page-body">
      <router-view></router-view>
    </div>
    <div class="page-footer" v-show="routeName != 'login'">
      <vue-footer/>
    </div>
  </div>
</template>

<script>
  import VueHeader from '../components/Header.vue'
  import VueFooter from '../components/Footer.vue'
  export default {
    components: {
        VueHeader,
        VueFooter
    },
    data(){
        return {           
        }
    },
    computed: {
      routeName() {
        return this.$route.name;
    }
  }
}
</script>
<style scoped>
.page {
  flex-direction: column;
  display: flex;
}
.page-header {
  width: 100%;
  z-index: 3;
  position: fixed;
}

.page-body {
  min-height: calc(100vh - 40px);
  width: 100%;
}
.page-footer {
  max-width: 100%;
  z-index: 10;
}
</style>
