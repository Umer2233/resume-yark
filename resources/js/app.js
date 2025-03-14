import Vue from "vue";
import VueRouter from "vue-router";
import Vuelidate from "vuelidate";
import VTooltip from "v-tooltip";
import BootstrapVue from "bootstrap-vue";
import store from "./store";
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
import "./bootstrap";
window.$ = require("jquery");
window.JQuery = require("jquery");
window.Vue = require("vue");
import { environment_api } from "./env";
import Router from "./routes/routes";
import { Modal } from "vue-js-modal";

Vue.use(BootstrapVue);
Vue.use(Vuelidate);
Vue.use(Modal);
Vue.use(VueRouter);
Vue.use(VTooltip);
Vue.use(Toaster, { timeout: 2000 });
// require('dotenv').config();
Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue").default
);
Vue.component(
  "page-start",
  require("./components/pages/StartResume.vue").default
);
Vue.component(
  "resume-header-file",
  require("./components/pages/ResumeHeaderFile.vue").default
);
Vue.component(
  "resume-name-start",
  require("./components/pages/ResumeNameHeader.vue").default
);
Vue.component("page-footer", require("./components/pages/Footer.vue").default);
Vue.component(
  "page-workhistory",
  require("./components/pages/WorkHistory.vue").default
);
Vue.component(
  "logout-start",
  require("./components/pages/LogoutHeader.vue").default
);

const routes = Router;

const router = new VueRouter({
  mode: "history",
  routes,
});

const app = new Vue({
  mode: "history",
  el: "#app",
  router,
  store,

  mounted() {
    this.getAndSetContactInfoState();
    this.checkAndSetIsUserLoggedIn();
    this.getCurrentResumeData();

    this.$nextTick(() => {
      $(".template-slidre-box").slick({
        slidesToShow: 3,
        autoplay: true,
        // autoplaySpeed:100,
        dots: true,
        arrows: true,
        responsive: [
          {
            breakpoint: 993,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "0px",
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "0px",
              slidesToShow: 1,
            },
          },
        ],
      });
    });

    $(document).ready(function () {
      if ($(window).width() <= 450) {
        let valueOfVar = $('.new-top-header-menu').parent().find('header').addClass('none-bars');
        console.log(valueOfVar, "value of var");
      } else {
        $('.new-top-header-menu').parent().find('header').removeClass('none');
      }
    })

    $(window).resize(function () {
      if ($(window).width() <= 450) {
        let valueOfVar = $('.new-top-header-menu').parent().find('header').addClass('none');
        console.log(valueOfVar, "value of var");
      } else {
        $('.new-top-header-menu').parent().find('header').removeClass('none');
      }
    });

    $("li.has_sub_nav_resume_name").on("click", function () {
      if ($("div.resume_name_sub_menu").is(":visible")) {
        $("div.resume_name_sub_menu").hide();
      } else {
        $("div.resume_name_sub_menu").show();
      }
    });
    $("li.has_sub_nav_my_profile").on("click", function () {
      if ($("div.my_profile_sub_menu").is(":visible")) {
        $("div.my_profile_sub_menu").hide();
      } else {
        $("div.my_profile_sub_menu").show();
      }
    });

    $("#click-to-see-menu").on("click", function () {
      $(this).children().toggleClass("fa fa-times");
      $("#toShowAndHide").toggleClass("showMenu");
    });

    $("select.select-item").on("click", function () {
      if ($(this).parent().hasClass("show-side-arrow")) {
        $(this).parent().removeClass("show-side-arrow");
      } else {
        $(this).parent().addClass("show-side-arrow");
      }
    });

    $("#click-to-add").on("click", function () {
      $("#cross-finder").toggleClass("section-height-footer");
    });

    $(".edu_section_heading").on("click", function () {
      $(this)
        .parent()
        .parent(".endorement_saved_item")
        .toggleClass("finder_active");
    });

    $(".show-menu-btn").mouseenter(function () {
      $(".resume_name_sub_menu").addClass("show-menu");
    });
    $(".show-menu-btn").mouseleave(function () {
      $(".resume_name_sub_menu").removeClass("show-menu");
    });
  },
  methods: {
    getAndSetContactInfoState() {
      axios
        .get(environment_api.api_base_url + "getcontact")
        .then(({ data }) => {
          if (data.status == 1) {
            store.commit("contactData", data);
          }
        });
    },
    checkAndSetIsUserLoggedIn() {
      axios
        .get(environment_api.api_base_url + "api/check_logged_in")
        .then(({ data }) => {
          store.commit("NewLoginUserMethod", data.status ? data.status : false);
        });
    },
    getCurrentResumeData() {
      var r_id = localStorage.getItem("resume_id");
      if (r_id) {
        store.commit("updateResumeCurrentId", r_id);
        axios
          .post(environment_api.api_base_url + "get-resume/" + r_id, {})
          .then(({ data }) => {
            if (data.data.length > 0) {
              store.commit("storeCurrentResume", data.data[0]);
            }
          });
      }
    },
  },
});
