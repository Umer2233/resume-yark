<template>
  <div id="app">
    <h2>Static template:</h2>
    <Button>Hello</Button>
    <Button type="primary">Hello</Button>

    <h2>Dynamically inserted:</h2>
    <div ref="container">
      <button @click="onClick">Click to insert</button>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
// import Button from "./components/pages/Button.vue";
import Button from "./pages/Button.vue";
export default {
  name: "app",
  components: { Button },
  methods: {
    onClick() {
      var ComponentClass = Vue.extend(Button);
      var instance = new ComponentClass({
        propsData: { type: "primary" },
      });
      instance.$slots.default = ["Click me!"];
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
  margin-top: 60px;
}
</style>
