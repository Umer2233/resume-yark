<template>
  <li v-if="loggedIn" class="ml-1 current-page mt-2 mb-2">
    <a @click="logoutUser">Logout </a>
  </li>
</template>
<script>
import { mapState } from "vuex";
import store from "../../store";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";
import Common from "../../mixins/Common";
export default {
  name: "logout-start",
  mixins: [Common],
  components: {},
  data() {
    return {
      // loggedIn: false,
      logout: localStorage.getItem("token")
        ? localStorage.getItem("token")
        : "",
    };
  },

  mounted() {},
  computed: {
    ...mapGetters(["auth"]),
    ...mapState({
      // arrow functions can make the code very succinct!
      // loggedIn: (state) => state.isLoggedIn,
    }),
    loggedIn() {
      return this.$store.state.token;
    },
  },
  mounted() {
    // this.checkLogin();
  },
  methods: {
    checkLogin() {
      if (localStorage.getItem("token")) {
        this.loggedIn = true;
      } else {
        this.loggedIn = false;
      }
    },
    logoutUser() {
      axios
        .post(
          environment_api.api_base_url + "api/logoutUser",
          {},
          { headers: { Authorization: "Bearer " + this.$store.state.token } }
        )
        .then(({ data }) => {
          store.commit("LogoutUser");
          window.location.href = environment_api.api_base_url + "login";
        });
    },
  },
};
</script>
