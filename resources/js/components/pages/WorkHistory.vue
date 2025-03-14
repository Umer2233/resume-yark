<template>
  <div id="app">
    <div ref="container">
      <button @click="onClick">Click to insert</button>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
// import Button from "./components/pages/Button.vue";
import Button from "./Button.vue";
export default {
  name: "app",
  components: { Button },
  methods: {
    onClick() {
      var ComponentClass = Vue.extend(Button);
      var instance = new ComponentClass({
        propsData: { type: "primary" },
      });
      //   instance.$slots.default = ["Click me!"];
      instance.$mount(); // pass nothing
      //         console.log(this.$refs)
      this.$refs.container.appendChild(instance.$el);
    },
  },
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

@media (max-width: 450px) {
  .col-md-3.col-sm-12.workdate p {
    text-align: left !important;
    margin-bottom: 0 !important;
  }
}
</style>
