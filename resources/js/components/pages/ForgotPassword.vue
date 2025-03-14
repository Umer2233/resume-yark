<template>
  <div>
    <section class="page-resume-editor page-login-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12 grid-container">
            <router-link :to="{ name: 'login' }">
              <img
                :src="EnvPath + 'images/logo/logo.png'"
                alt="Resume Yak"
                class="logo_login_page remove-on-mobile"
              />
            </router-link>
            <div class="height-div-box">
              <div class="resume-editor-div" style="padding: 34px 25px">
                <h2>Forgot Password?</h2>
                <p v-if="MailSent == ''">
                  Enter your email address and we'll send you an link to reset
                  password
                </p>

                <div class="alert alert-success text-center" v-if="MailSent">
                  <span>{{ MailSent }}</span>
                </div>

                <div class="alert alert-warning text-center" v-if="error">
                  <span>{{ error }}</span>
                </div>
                <div class="login_input_field" v-if="MailSent == ''">
                  <input
                    type="email"
                    class="input_text_info login-input-feild-left-space mouseLeave"
                    v-model="email"
                  />
                  <!-- <span class="highlight"></span> -->
                  <span class="bar"></span>
                  <label
                    class="label_name label_name_color"
                    :class="email != '' ? 'mouseleavefill' : ''"
                    >Email Address:</label
                  >
                </div>

                <button
                  v-if="MailSent == ''"
                  class="btnOk btn-rounded btn-send-mail"
                  style="margin-top: 6px"
                  @click="Forgotpassword()"
                >
                  Send Mail
                </button>
              </div>
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
import { mapGetters } from "vuex";

export default {
  name: "forgot-password",
  data() {
    return {
      EnvPath: environment_api.api_base_url,
      email: "",
      password: "",
      loginError: false,
      error: "",
      RequiredErrors: [],
      isProgress: false,
      isMouseLeaveEmailAddress: false,
      isMouseLeavePassword: false,
      MailSent: "",
    };
  },
  mounted() {
    this.addClassByExistingClass();
    this.addEmail();
  },
  computed: {
    ...mapGetters(["getUserData"]),
  },
  methods: {
    addEmail() {
      if (this.getUserData) {
        this.email = this.getUserData.email;
      }
    },
    addClassByExistingClass(existingClass, newClass) {
      var element = document.querySelector(".page-contact-info");
      if (element) {
        element.classList.add("mt-15");
      }
    },
    Forgotpassword() {
      if (this.email != "") {
        if (!this.validEmail(this.email)) {
          this.error = "";
          this.error = "Valid email required";
        } else {
          window.axios
            .post(this.EnvPath + "forgotpassword", {
              email: this.email,
            })
            .then((response) => {
              if (response.data.status == 1) {
                this.error = "";
                this.MailSent = "Please check your mail";
              } else {
                setTimeout(() => {
                  this.error = response.data.error;
                }, 1000);
              }
            })
            .catch((error) => {
              this.error = error.response.data.error;
            });
        }
      } else {
        this.error = "";
        this.error = "Please enter email address";
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
.btn-send-mail:hover {
  background-color: #0d5fca !important;
}
.btn-send-mail {
  font-size: 16px;
  padding: 8px;
  min-width: 170px !important;
}

@media (max-width: 450px) {
  .logo_login_page.remove-on-mobile {
    display: none !important;
  }
  .height-div-box {
    display: flex;
    align-items: center;
    height: 80vh;
  }
}
</style>
