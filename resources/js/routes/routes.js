import AccountDetails from "../components/pages/accountDetails.vue";

import stripe from "../components/stripe";
import stripeTwo from "../components/stripeTwo";
import resume from "../components/resume";
import pdf from "../components/pdf";
import ContactInfo from "../components/pages/contactInfo.vue";
import ContactProfile from "../components/pages/contactProfile.vue";
import ContactProfileAdd from "../components/pages/contactProfileAdd.vue";
import education_enhancement from "../components/pages/education_enhancement.vue";
import MyResume from "../components/pages/MyResume";
import login from "../components/pages/login";
import ForgotPassword from "../components/pages/ForgotPassword";
import ResetPassword from "../components/pages/ResetPassword";
import CreatePassword from "../components/pages/CreatePassword";
import ExperienceFinder from "../components/pages/ExperienceFinder";
import Skills from "../components/pages/skills.vue";
import Logout from "../components/pages/logout.vue";
import Endorsements from "../components/pages/Endorsements.vue";
import ResumeType from "../components/pages/ResumeType.vue";
import JobDescriptions from "../components/pages/JobDescriptions.vue";
import Subscription from "../components/pages/Subscription.vue";
import TwoPageResume from "../components/pages/TwoPageResume";
import { environment_api } from "../env";

//Middlewares
import auth from "../middlewares/auth";
import guest from "../middlewares/guest";
const routes = [
  {
    path: environment_api.route_base_url + "/",
    component: ContactInfo,
    name: "contact",
  },
  {
    path: environment_api.route_base_url + "login",
    component: login,
    name: "login",
    beforeEnter: guest,
  },
  {
    path: environment_api.route_base_url + "contact",
    component: ContactInfo,
    name: "new",
  },

  {
    path: environment_api.route_base_url + "stripe",
    component: stripe,
  },
  {
    path: environment_api.route_base_url + "stripeTwo",
    component: stripeTwo,
  },
  {
    path: environment_api.route_base_url + "resume",
    component: resume,
  },
  {
    path: environment_api.route_base_url + "pdf",
    component: pdf,
  },
  {
    path: environment_api.route_base_url + "work-history",
    component: ContactProfile,
    name: "Store",
  },
  {
    path: environment_api.route_base_url + "education",
    component: ContactProfileAdd,
    name: "WorkAdd",
  },
  {
    path: environment_api.route_base_url + "account-details",
    component: AccountDetails,
    name: "account-details",
  },
  {
    path: environment_api.route_base_url + "resumes",
    component: MyResume,
    name: "my-resume",
  },
  {
    path: environment_api.route_base_url + "education_enhancement",
    component: education_enhancement,
    name: "education_enhancement",
  },
  {
    path: environment_api.route_base_url + "forgotpassword",
    component: ForgotPassword,
    name: "forgot-password",
  },
  {
    path: environment_api.route_base_url + "reset-password/:token",
    component: ResetPassword,
    name: "reset-password",
  },
  {
    path: environment_api.route_base_url + "create-password/:token",
    component: CreatePassword,
    name: "create-password",
  },
  {
    path: environment_api.route_base_url + "experience-finder",
    component: ExperienceFinder,
    name: "experience-finder",
  },
  {
    path: environment_api.route_base_url + "skills",
    component: Skills,
    name: "skills",
  },
  {
    path: environment_api.route_base_url + "logout",
    component: Logout,
    name: "logout",
  },
  {
    path: environment_api.route_base_url + "endorsements",
    component: Endorsements,
    name: "endorsements",
  },
  {
    path: environment_api.route_base_url + "subscription",
    component: Subscription,
    name: "subscription",
  },
  {
    path: environment_api.route_base_url + "resume-type",
    component: ResumeType,
    name: "resume_type",
  },
  {
    path: environment_api.route_base_url + "job_descriptions",
    component: JobDescriptions,
    name: "job_descriptions",
  },
  // { path: "/resume_type", component: ResumeType, name: "resume_type" },

  // { path: "/job_descriptions", component: JobDescriptions, name: "resume_type" },
  {
    path: environment_api.route_base_url + "two-page-resume",
    component: TwoPageResume,
    name: "TwoPageResume",
  },
];

export default routes;

//Routing ----------------------------------
