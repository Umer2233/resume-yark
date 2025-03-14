<template>
  <div>
      <div class="loader-container" v-if="isLoading">
        <div class="loader">
          <!-- Replace this with your preferred loading spinner or animation -->
          <div class="spinner"></div>
          <p>Please Wait</p>
        </div>
      </div>
    <section class="page-resume-editor page-login-info hide-space-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12 grid-container">
        <div class="section-footer-height">
            <a href="">
            <img
              :src="EnvPath + 'images/logo/logo.png'"
              alt="Resume Yak"
              class="logo_login_page"
            />
            </a>
            <div class="resume-editor-div" style="padding: 34px 25px 40px 25px;">
              <h2 class="m-0">Login</h2>
              <div
                class="alert alert-warning text-center"
                v-if="loginError && errors.message"
              >
                <span>{{ errors.message[0] }}</span>
              </div>
                <p v-if="RequiredErrors.length">
                  <p v-for="(error,index) in RequiredErrors" :key='index' class="alert alert-warning text-center" style="font-size: 14px;">{{ error }}</p>
                </p>
              <div class="login_input_field label-red-text-box">
                <input
                  type="email"
                  class="input_text_info login-input-feild-left-space mouseLeave"
                  v-model="email"
                  @mouseleave="mouseLeaveInput('emailAddress')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name label_name_color"
                  :class="(email!='') ?'mouseleavefill':''"
                  >Email Address:</label
                >
              </div>
              <div class="login_input_field label-red-text-box">
                <input
                  type="password"
                  class="input_text_info login-input-feild-left-space mouseLeave"
                  v-model="password"
                  @mouseleave="mouseLeaveInput('password')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name label_name_color"
                   :class="(password!='') ?'mouseleavefill':''"
                  >Password</label
                >
              </div>
              <button
                class="btnOk btn-rounded btn-hover-login"
                style="margin-top: 6px"
                @click="login()"
              >
                Login
              </button>
            </div>
        <!-- account password -->
          <div class="resume-bottom">
              <div class="row mt-3">
              <div class="col-md-12 create_reset_button reset-btn-links">
                  <a href="javascript::void(0)"  @click="redirectRoute('forgot-password')">Reset Password?</a
                  >
                  <!-- <a href="#">Create Account</a> -->
                </div>
              </div>
          </div>
        <!-- account password -->
        </div>
            <div class="resume-bottom">
              <div class="row mt-3">
                <!-- <div class="col-md-12 create_reset_button">
                  <a href="javascript::void(0)"  @click="redirectRoute('forgot-password')">Forgot Password?</a
                  ><a href="#">Create Account</a>
                </div> -->
                <div class="col-md-12 col-sm-12">
                  <ul style="padding-left: 0px">
                    <li>
                      <a href=""><strong>Sitemap</strong></a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href=""><strong>Privacy Policy</strong></a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href=""><strong>Terms of Use</strong></a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href=""><strong>About Us</strong></a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-12 col-sm-12">
                  <p class="text-center">
                    2024 Resume Yak. All rights reserved
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- More Custom Script -->
</template>


<script>
import store from "../../store";
import { environment_api } from "../../env";
import Common from "../../mixins/Common";

export default {
  name: "login",
  mixins: [Common],
  data() {
    return {
      isLoading: false,
      EnvPath: environment_api.api_base_url,
      email: "",
      password: "",
      loginError: false,
      RequiredErrors: [],
      errors: {},
      isProgress: false,
      isMouseLeaveEmailAddress: false,
      isMouseLeavePassword: false,
    };
  },
  mounted() {
    $("#aLogout").parent().removeClass("resume-visited-page");
    $("#aLogout").parent().removeClass("current-page");
    this.loadCountries();
    this.loadStates();
  },

  methods: {
    redirectRoute(name) {
      this.$router.push({ name: name });
    },
    login() {
      this.isLoading = true;
      if (this.email != "" && this.password != "") {
        if (!this.validEmail(this.email)) {
          this.errors = [];
          this.RequiredErrors = [];
          this.RequiredErrors.push("Valid email required");
        } else {
          window.axios
            .post(this.EnvPath + "auth/login", {
              email: this.email,
              password: this.password,
            })
            .then((response) => {
              if (response.data.success == true) {
                setTimeout(() => {
                  this.isProgress = false;
                  store.commit("LoginUser", response.data);
                  store.commit("storePageCount", 4);
                  localStorage.setItem("pageCount", 4);
                  store.commit("storeCurrentPage", 4);
                  localStorage.setItem("CurrentPage", 4);
                  localStorage.setItem("page", 4);
                  window.location.href = this.EnvPath + "resumes";
                }, 1000);
              } else {
                this.isLoading = false;
                this.RequiredErrors = [];
                this.isProgress = true;
                setTimeout(() => {
                  this.isProgress = false;
                  this.loginError = true;
                  this.errors = response.data.errors;
                }, 1000);
              }
            })
            .catch((error) => {
              this.isLoading = false;
              this.RequiredErrors = [];
              this.isProgress = false;
              this.loginError = true;
              this.errors = error.response.data.errors;
            });
        }
      } else {
        this.isLoading = false;
        this.errors = [];
        this.RequiredErrors = [];
        this.RequiredErrors.push("Please complete all of the fields");
      }
    },
    mouseLeaveInput(inputName) {
      if (inputName === "emailAddress") {
        this.isMouseLeaveEmailAddress = true;
      }
      if (inputName === "password") {
        this.isMouseLeavePassword = true;
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
  },
};
</script>


<style>
.section-footer-height {
  /* min-height: 87vh; */
}

.reset-btn-links a:hover {
  text-decoration: underline !important;
}

@media (max-width: 450px) {
  .col-md-12.create_reset_button.reset-btn-links a {
    font-size: 14px !important;
    padding: 10px;
  }
}

.login-input-feild-left-space {
  padding-left: 15px !important;
}

/* .label-red-text-box:focus~label,
.label-red-text-box:valid~label {
    top: 3px;
    font-size: 11px;
    color: #fb643e !important;
    padding-left: 6.8px !important;
    left: 10px;
} */

.label-red-text-box:focus-within label {
  color: #fb643e !important;
}
button.btnOk.btn-rounded.btn-hover-login:hover {
  background-color: #0d5fca !important;
}
button.btnOk.btn-rounded.btn-hover-login {
  font-size: 16px;
  padding: 8px;
  min-width: 170px !important;
}
.loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(
    255,
    255,
    255,
    0.8
  ); /* Adjust the background color and opacity */
  backdrop-filter: blur(1px); /* Adjust the blur intensity */
  z-index: 999999; /* Adjust the z-index to ensure it's on top of other elements */
}

.loader {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.spinner {
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@media (max-width: 460px) {
  section.page-resume-editor.page-login-info.hide-space-top {
    margin-top: 0 !important;
  }
}
</style>
