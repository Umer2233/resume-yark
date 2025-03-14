<template>
  <div>
    <card-form
      :save="saveCard"
      :replaceOrEdit="replaceAndEdit"
      @close-collapse="closeCollapse"
      @loader-actions="loaderActions"
    ></card-form>
  </div>
</template>
<script>
import CardForm from "./CardForm.vue";
import Common from "../../mixins/Common.js";
import Vue from "vue";
import JQuery from "jquery";
import store from "../../store";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";

export default {
  name: "CreditCardActions",
  mixins: [Common],
  components: {
    CardForm,
  },
  data() {
    return {
      countries: this.$store.state.countriesData,
      saveCard: "update",
    };
  },
  props: ["cardInputAction", "replaceAndEdit"],
  mounted() {},
  updated() {},

  methods: {
    closeCollapse() {
      this.$emit("close-collapse");
    },
    loaderActions(data) {
      this.$emit("loader-actions", data);
    },
  },
};
</script>
