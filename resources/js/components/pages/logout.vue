<template>
</template>

<script>
import store from "../../store";
import { environment_api } from "../../env";

export default {
  name: "logout",
  data() {
    return {
      EnvPath: environment_api.api_url,
      loginError: false,
      isProgress: false,      
    };
  },
  mounted() {
    window.axios
    .get(this.EnvPath+"auth/logout")
    .then((response) => {
      if (response.data.success == true) {
        localStorage.clear();
        console.log(response.data);
        window.location.href = '/login';
        setTimeout(() => {
          this.isProgress = false;
          store.commit("LogoutUser", response.data);
          //this.$router.push({ name: "login" });
        }, 2000);
      } else {
        this.isProgress = true;
        setTimeout(() => {
          this.isProgress = false;
          this.loginError = true;
          this.errors = response.data.errors;
        }, 1000);
      }
    })
    .catch((error) => {
      this.isProgress = false;
      this.loginError = true;
      this.errors = error.response.data.errors;
    });
  },
};
</script>