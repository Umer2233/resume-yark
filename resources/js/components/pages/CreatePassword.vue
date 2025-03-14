<template>
  <div>
    <section class="page-resume-editor page-login-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12 grid-container">
            <img
              :src="EnvPath + 'images/logo/logo.png'"
              alt="Resume Yak"
              class="logo_login_page"
            />
            <div class="resume-editor-div" style="padding: 34px 25px">
              <h2>Create Your Password</h2>
              <div class="alert alert-warning text-center" v-if="errors">
                <span>{{ errors }}</span>
              </div>
              <div class="login_input_field" v-if="!errors">
                <input
                  type="password"
                  class="input_text_info mouseLeave"
                  :class="isMouseLeavePassword ? 'mouseLeave' : ''"
                  @mouseleave="mouseLeaveInput('password')"
                  v-model="password"
                  v-on:click="hideContactError('password')"
                  v-on:blur="checkPasswordValidation()"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name label_name_color"
                  :class="
                    isMouseLeavePassword && password != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  >Password</label
                >
                <span
                  ><img
                    data-v-7969e6e8=""
                    :src="EnvPath + 'images/logo/yak-icon.png'"
                    alt=""
                    data-original-title="null"
                    class="small_logo has-tooltip v-tooltip-open"
                    :class="passTipOpen ? 'has-tooltip v-tooltip-open' : ''"
                  />
                  <div
                    aria-hidden="false"
                    x-placement="top"
                    class="tooltip"
                    :style="[
                      passTipOpen ? { visibility: 'visible !important' } : '',
                    ]"
                    style="
                      position: absolute;
                      will-change: transform;
                      top: -120px;
                      right: 0px;
                      display: none;
                      visibility: hidden;
                      width: 320px;
                    "
                  >
                    <div
                      class="tooltip-arrow"
                      style="right: 17px; left: inherit"
                    ></div>
                    <div class="tooltip-inner">
                      Password must contain:
                      <ul style="padding-left: 25px; line-height: 23px">
                        <li>At least 8 characters</li>
                        <li>A number or special character</li>
                        <li>A capitalized letter</li>
                      </ul>
                    </div>
                  </div></span
                >
              </div>
              <div class="login_input_field" v-if="!errors">
                <input
                  type="password"
                  class="input_text_info mouseLeave"
                  @mouseleave="mouseLeaveInput('confirmPassword')"
                  v-model="confirmPassword"
                  v-on:keyup="hideContactError()"
                  v-tooltip="{
                    content: valiErrors,
                    trigger: 'manual',
                    show: isOpen,
                    placement: 'top',
                  }"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name label_name_color"
                  :class="
                    isMouseLeaveConfirmPassword && confirmPassword != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  >Confirm Password</label
                >
              </div>
              <button
                class="btnOk btn-rounded"
                @click="insertData()"
                v-if="!errors"
                style="margin-top: 6px"
              >
                Create Password
              </button>
            </div>
            <div class="resume-bottom">
              <div class="row mt-3">
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

export default {
  name: "create-password",
  data() {
    return {
      EnvPath: environment_api.api_base_url,
      password: "",
      chkPassword: "",
      confirmPassword: "",
      errors: "",
      RequiredErrors: [],
      isMouseLeavePassword: false,
      isMouseLeaveConfirmPassword: false,
      isOpen: false,
      passTipOpen: false,
      valiErrors: [],
      id: "",
    };
  },
  methods: {
    insertData: function () {
      if (this.password != "" && this.confirmPassword != "") {
        if (this.password !== this.confirmPassword) {
          this.valiErrors = [];
          this.valiErrors.push("The passwords don't match");
          this.isOpen = true;
        } else if (this.checkPasswordValidation() === true) {
        } else {
          var querystring = require("querystring");
          var token = window.location.pathname.split("/")[3];
          console.log("token", token);
          window.axios
            .post(
              "/auth/reset_password",
              querystring.stringify({
                password: this.password,
                id: this.id,
                token: token,
              })
            )
            .then(({ data }) => {
              if (data.status == 1) {
                this.$router.push({ name: "login" });
              } else {
                this.valiErrors = [];
                this.valiErrors.push(data.message);
              }
            });
        }
      } else {
        this.RequiredErrors = [];
        this.RequiredErrors.push("Please complete all of the fields");
      }
    },
    checkPasswordValidation: function () {
      var regularExpression =
        /^(?=.*[0-9])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}$/;
      if (this.password.match(regularExpression)) {
        return (this.passTipOpen = false);
      } else {
        return (this.passTipOpen = true);
      }
    },
    hideContactError: function (e = "") {
      if (e !== "") {
        this.passTipOpen = false;
      }
      this.valiErrors = [];
      if (this.password != "" && this.confirmPassword != "") {
        this.valiErrors = [];
      }
    },
    mouseLeaveInput(inputName) {
      if (inputName === "confirmPassword") {
        this.isMouseLeaveConfirmPassword = true;
      }
      if (inputName === "password") {
        this.isMouseLeavePassword = true;
      }
    },
    chkToken() {
      window.axios
        .post(this.EnvPath + "resetpw", {
          token: this.$route.params.token,
        })
        .then((response) => {
          if (response.data.success == true) {
            if (response.data.status == 2) {
              this.errors = response.data.msg;
              this.id = response.data.id;
            } else if (response.data.status == 0) {
              this.id = response.data.id;
            }
          } else {
            setTimeout(() => {}, 1000);
          }
        });
    },
  },
  mounted() {
    this.chkToken();
  },
};
</script>
