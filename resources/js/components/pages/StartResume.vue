<template>
  <div>
    <form action @submit.prevent="submit">
      <div>
        <div class="custom-control custom-checkbox d-flex">
          <input
            type="checkbox"
            class="custom-control-input"
            v-model="terms_check"
          />

          <label
            class="custom-control-label pointer"
            :class="{ 'text-danger': !submitStatus === 'ERROR' }"
            for="termsCheckbox"
            @click="changeTerms()"
          ></label>
          <img
            :src="url + '/images/bg/yak-head.png'"
            alt
            class="yak-head-img pl-2 pe-2"
            v-tooltip="tooltip"
          />

          <div class="mobile-tooltip">
            <p>
              <span
                class="start-resume"
                data-tooltip="I heard you have to give away your first-born child to use this site, so you better read these carefully!"
              >
                <img
                  :src="'/images/bg/yak-head.png'"
                  alt
                  class="start-page-tooltip pl-2 pe-2"
                />
              </span>
            </p>
          </div>

          <p class="m-0 space-control-top-text">
            I have read and agree to Resume Yak’s
            <a href="#" target="_blank" style="color: #fb643e">
              Term’s of Use
            </a>
            &
            <a href="#" target="_blank" style="color: #fb643e"
              >Privacy Policy</a
            >
          </p>
        </div>
        <p
          v-if="submitStatus === 'ERROR'"
          class="alert alert-warning"
          style="margin-bottom: -15px; font-size: 14px"
        >
          You need to accept our Terms of Use and Privacy Policy
        </p>
      </div>
      <div class="text-center mt-4">
        <button
          class="btn1 btn-rounded btn-next text-center space-control-top-btn"
          type="submit"
          v-if="submitStatus !== 'ERROR'"
        >
          Next
          <!-- <span class>Next</span> -->
          <span class="pl-1">
            <i class="next-icon fas fa-chevron-right"></i>
          </span>
        </button>

        <button
          class="btn1 btn-rounded btn-next mt-2"
          type="submit"
          v-else-if="submitStatus !== 'OK'"
          disabled
        >
          <span class>Next</span>
          <span class="pl-1">
            <i class="next-icon fas fa-chevron-right"></i>
          </span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import JQuery from "jquery";
import store from "../../store";
import { mapGetters } from "vuex";
import { environment_api } from "../../env";
import Common from "../../mixins/Common.js";

let $ = JQuery;
export default {
  mixins: [Common],
  props: {
    url: {
      type: String,
      required: true,
    },
    tooltip: {
      type: String,
      required: true,
      defaultTrigger: "click",
    },
  },
  computed: {
    ...mapGetters(["getPageCount"]),
  },
  mounted() {
    this.removeLocalStorage();
  },
  data() {
    return {
      terms_check: false,
      submitStatus: "",
      EnvPath: environment_api.api_base_url,
      currentDate: new Date().toISOString().split("T")[0], // Get current date in YYYY-MM-DD format
      previousDate: localStorage.getItem("savedDate"),
    };
  },

  validations: {
    terms_check: {
      required,
    },
  },

  methods: {
    changeTerms() {
      this.terms_check = !this.terms_check;

      if (this.terms_check) {
        this.submitStatus = "OK";
      } else {
        this.submitStatus = "ERROR";
      }
    },

    submit() {
      $(".custom-checkbox").removeClass("animated shake");
      localStorage.setItem("visited", "false");

      // console.log("asdasd", localStorage.getItem("visited"));
      if (!this.terms_check) {
        this.submitStatus = "ERROR";
        $(".custom-checkbox").addClass("animated shake");
      } else {
        this.submitStatus = "OK";
        // Insert into the database...

        var querystring = require("querystring");
        window.axios.post(this.EnvPath + "acc_tnc").then(({ data }) => {
          if (data.status == 1) {
            if (this.getPageCount < 1) {
              store.commit("storePageCount", 1);
              localStorage.setItem("pageCount", 1);
            }

            // For design redirect to contact info page
            if (this.url.includes("builder")) {
              window.location = this.url + "/contact";
            } else {
              window.location = this.url + "/builder/contact";
            }

            // this.$router.push({ name: "contact" });
          } else {
          }
        });
      }
    },
  },
};
</script>

<style>
.space-control-top-text {
  margin-top: -5px !important;
}
</style>
