<template>
  <div class="document">
    <div class="document-overlay" @click="close"/>
    <div class="document-container">
      <div class="document-header">
        <div class="document-close">
          <div class="document-close-button" @click="close"/>
        </div>
      </div>
      <div class="document-body">
        <h3 class="table-title">
          {{name}}
        </h3>
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
    }
  },
  methods: {
    close: function () {
      this.$emit('close')
    }
  },
  props: {
    index: {
      type: Number,
      required: false,
      default: 0
    },
    name: {
      type: String,
      required: true
    },
    item: {
      type: Object,
      require: true
    }
  }
}
</script>
<style>
.document {
  position: fixed;
  left: 50%;
  top: 15vh;
  z-index: 1;
  display: block;
  transition: all 1s ease-in;
}
.document-overlay {
  cursor: auto;
  display: flex;
  position: fixed;
  align-items: center;
  justify-content: center;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.25);
  top: 0;
  left: 0;
  z-index: 1;
  transition: opacity .15s linear;
}
.document-container {
  left: -50%;
  /* min-width: 80vw; */
  cursor: auto;
  width: 50vw;
  max-width: 1000px;
  position: relative;
  border-radius: 7px;
  z-index: 2;
  background: #fff;
  max-height: 80vh;
  padding: 7px 15px 7px 15px;
  transition: scale .2s ease-in;
  display: block;
}
.document-header {
  position: relative;
  height: 30px;
  margin-right: 15;
  margin-top: 12px;
  display: block;
}
.document-close {
  width: 20px;
  height: 20px;
  margin-left: auto;
  display: block;
}
.document-close-button {
  position: absolute;
  right: 0;
  top: 0;
  width: 9px;
  height: 15px;
  display: block;
}
.document-close-button::before {
  transition-duration: .3s;
  content: " ";
  background-color: #444;
  position: absolute;
  height: 17px;
  width: 2px;
  right: 9px;
  transform: rotate(-45deg);
}
.document-close-button::after {
  transition-duration: .3s;
  content: " ";
  background-color: #444;
  position: absolute;
  height: 17px;
  width: 2px;
  right: 9px;
  transform: rotate(45deg);
}
.document-close-button:hover::before,
.document-close-button:hover::after {
  background-color: #0054a6;
  cursor: pointer;
}
.document-body {
  height: calc(80vh - 116px);
  overflow: auto;
  max-height: calc(80vh - 56px);
  border: 1px solid #e4e4e4;
  border-radius: unset;
  border-bottom-right-radius: 7px;
  border-bottom-left-radius: 7px;
  padding: 0 38px 60px 38px;
}
@media (max-width: 700px) {
  .document-container {
    width: 85vw;
  }
}
</style>