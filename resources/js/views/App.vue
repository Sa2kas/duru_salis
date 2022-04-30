<template>
  <div class="page">
    <div class="page-header">
      <vue-header/>
    </div>
    <div class="page-body">
      <router-view></router-view>
    </div>
    <div class="page-footer">
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
    }
}
</script>
<style scoped>
.page {
  flex-direction: column;
  display: flex;
}
.page-header {
  position: absolute;
  width: 100%;
}
.page-body {
  min-height: calc(100vh - 40px);
  max-width: 100%;
}
.page-footer {
  max-width: 100%;
}
/* @media only screen and (max-width: 1100px) {
  .page-left-side {
    display: none;
  }
  .content-header {
    display: none;
  }
  .page-header {
    display: unset;
  }
  .page-body {
  margin-top: 76px;
  }
  .page-content {
    width: 100vw;
  }
}
@media only screen and (max-width: 500px) {
  .page-content {
    padding: unset;
  }
} */
</style>