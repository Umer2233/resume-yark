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
import ContactInfo from "./components/pages/contactInfo.vue";
import ContactProfile from "./components/pages/contactProfile.vue";
import ContactProfileAdd from "./components/pages/contactProfileAdd.vue";
import education_enhancement from "./components/pages/education_enhancement.vue";
import MyResume from "./components/pages/MyResume";
import login from "./components/pages/login";
import AccountDetails from "./components/pages/accountDetails";
import ForgotPassword from "./components/pages/ForgotPassword";
import ResetPassword from "./components/pages/ResetPassword.vue";
import CreatePassword from "./components/pages/CreatePassword";
import ExperienceFinder from "./components/pages/ExperienceFinder";
import Skills from "./components/pages/skills.vue";
import Logout from "./components/pages/logout.vue";
import Endorsements from "./components/pages/Endorsements.vue";
import ResumeType from "./components/pages/ResumeType.vue";
import JobDescriptions from "./components/pages/JobDescriptions.vue";
import Subscription from "./components/pages/Subscription.vue";
import TwoPageResume from "./components/pages/TwoPageResume";
import { environment_api } from "./env";

Vue.use(BootstrapVue);
Vue.use(Vuelidate);
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

// { path: "/", component: login, name: "login" },
const routes = [
  { path: "/", component: ContactInfo, name: "contact" },
  { path: "/builder/login", component: login, name: "login" },
  {
    path: "/builder/account-details",
    component: AccountDetails,
    name: "account-details",
  },
  { path: "/builder/contact", component: ContactInfo, name: "new" },
  { path: "/builder/work-history", component: ContactProfile, name: "Store" },
  { path: "/builder/education", component: ContactProfileAdd, name: "WorkAdd" },
  { path: "/builder/resumes", component: MyResume, name: "my-resume" },
  {
    path: "/builder/education_enhancement",
    component: education_enhancement,
    name: "education_enhancement",
  },
  {
    path: "/builder/forgotpassword",
    component: ForgotPassword,
    name: "forgot-password",
  },
  {
    path: "/builder/reset-password/:token",
    component: ResetPassword,
    name: "reset-password",
  },
  {
    path: "/create-password/:token",
    component: CreatePassword,
    name: "create-password",
  },
  {
    path: "/builder/experience-finder",
    component: ExperienceFinder,
    name: "experience-finder",
  },
  { path: "/builder/skills", component: Skills, name: "skills" },
  { path: "/logout", component: Logout, name: "logout" },
  {
    path: "/builder/endorsements",
    component: Endorsements,
    name: "endorsements",
  },
  {
    path: "/builder/subscription",
    component: Subscription,
    name: "subscription",
  },
  { path: "/builder/resume-type", component: ResumeType, name: "resume_type" },
  {
    path: "/builder/job_descriptions",
    component: JobDescriptions,
    name: "job_descriptions",
  },
  // { path: "/resume_type", component: ResumeType, name: "resume_type" },
  // { path: "/job_descriptions", component: JobDescriptions, name: "resume_type" },
  {
    path: "/builder/two-page-resume",
    component: TwoPageResume,
    name: "TwoPageResume",
  },
];

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
    // $("span.icon_menu").on("click", function() {
    //   if ($("ul.main_navigation").is(":visible")) {
    //     $("ul.main_navigation").hide();
    //   } else {
    //     $("ul.main_navigation").show();
    //   }
    // });
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
    // navbar hide show
    $("#click-to-see-menu").on("click", function () {
      $("#toShowAndHide").toggleClass("showMenu");
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
  },
});
