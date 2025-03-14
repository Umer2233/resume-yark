import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import { environment_api } from "./env";

import createPersistedState from "vuex-persistedstate";
//Modules
import TwoPageResumeModule from "./modules/two_page_resume";

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [
    createPersistedState({
      storage: window.sessionStorage,
    }),
  ],
  state: {
    EnvPath: environment_api.api_base_url,
    isLoggedIn: false,
    token: localStorage.getItem("token"),
    countriesData: [],
    statesData: [],
    contact_Data: [],
    personal_data: {},
    work_Hisory: [],
    position_Data: [],
    education_History: [],
    grad_Date: "",
    tips: [],
    userData: [],
    AC2: false,
    isGrade: false,
    SchoolData: [],
    newSecArray: [],
    minorDate: [],
    ResumeName_Data: [],
    load_Questions: [],
    get_job: [],
    Skills_Data: [],
    User_Skills_Data: [],
    Two_Page_Resume: [],
    jobArray: [],
    eduArray: [],
    kaunArray: [],
    endorseArray: [],
    skillArray: [],
    eduSubSectionArray: [],
    contact_sorted_list: [],
    Subscription_Data: [],
    Subscription_count: 0,
    ExperienceFinder_Object: {},
    contact_address: "",
    pro_sug_titles: [],
    proSummarySubSectionArray: [],
    resumeExperiencesArray: [],
    skillSubSectionArray: [],
    pageCount: 0,
    currentPage: 0,
    currentResume: null,
    jobDescriptions: [],
    showEducationEnhancement: false,
    card_list: [],
    checkLoader: false,
    updateCancelBtn: false,
    resume_address: "",
    jobDescriptionsArray: [],
    resumeHeightClasses: false,
    forth_sidebar_font_color: "",
  },

  getters: {
    getResumeName(state) {
      // console.log("Resume Data", state.ResumeName_Data);
      if (
        typeof state.ResumeName_Data.data !== "undefined" &&
        state.ResumeName_Data.data.length >= 1
      ) {
        return state.ResumeName_Data.data[0].name;
      } else {
        return localStorage.getItem("resume_name");
      }
    },

    getContactSortedItemsFromState(state) {
      let data = null;
      if (state.Two_Page_Resume.resume_sorting) {
        state.Two_Page_Resume.resume_sorting.map((value) => {
          if (value.type == "contact") {
            data = value.value ? JSON.parse(value.value) : null;
          }
        });
      }
      return data;
    },
    fieldSuggestionsFromState(state) {
      return state.Two_Page_Resume.field_suggestions;
    },
    getTwoPageResume(state) {
      return state.Two_Page_Resume;
    },
    getUserData(state) {
      return state.userData;
    },
    getShowEducationEnhancement(state) {
      return state.showEducationEnhancement;
    },
    getCurrentResume(state) {
      return state.currentResume;
    },
    auth(state) {
      return state.isLoggedIn;
    },
    token(state) {
      return state.token;
    },
    getContactAddress(state) {
      return state.contact_address;
    },
    getNewSectionArray(state) {
      return state.newSecArray;
    },
    getJobArray(state) {
      return state.jobArray;
    },
    getEduArray(state) {
      return state.eduArray;
    },
    getCheckLoader(state) {
      return state.checkLoader;
    },
    getUpgradeCancelbtns(state) {
      return state.updateCancelBtn;
    },
    getKaunArray(state) {
      return state.kaunArray;
    },
    getEndorseArray(state) {
      return state.endorseArray;
    },
    getSkillArray(state) {
      return state.skillArray;
    },
    getProTitles(state) {
      return state.pro_sug_titles;
    },
    getPersonalDetail(state) {
      return state.personal_data;
    },
    getEduSubSectionArray(state) {
      return state.eduSubSectionArray;
    },
    getProSummSubSectionArray(state) {
      return state.proSummarySubSectionArray;
    },
    getResumeExperiencesArray(state) {
      return state.resumeExperiencesArray;
    },
    getSkillSubSectionArray(state) {
      return state.skillSubSectionArray;
    },
    getPageCount(state) {
      return state.pageCount;
    },
    getCurrentPage(state) {
      return state.currentPage;
    },
    getJobDescriptions(state) {
      return state.jobDescriptions;
    },
    getSubcriptionArray(state) {
      return state.Subscription_Data;
    },
    getSubcriptionCount(state) {
      return state.Subscription_count;
    },
    getCardList(state) {
      return state.card_list;
    },
    getStateData(state) {
      return state.statesData;
    },
    getCountriesData(state) {
      return state.countriesData;
    },
    getResumeAddress(state) {
      return state.resume_address;
    },
    getForthSidebarFontColor(state) {
      return state.forth_sidebar_font_color;
    },
    getJobDescriptionsArray(state) {
      return state.jobDescriptionsArray;
    },
    getResumeBuilderClasses(state) {
      return state.resumeHeightClasses;
    },
  },
  mutations: {
    LoginUser(state, data) {
      state.isLoggedIn = true;
      let token = data.access_token;
      state.token = token;
      localStorage.setItem("token", token);
      const expirationTimeInMilliseconds = 60 * 60 * 2000; // 2 hour in milliseconds
      setTimeout(() => {
        localStorage.removeItem("token");
        localStorage.removeItem("user_id");
        localStorage.removeItem("resume_id");
        localStorage.removeItem("pageCount");
        localStorage.removeItem("CurrentResume");
        localStorage.removeItem("CurrentPage");
        localStorage.removeItem("page");
        localStorage.removeItem("savedDate");
      }, expirationTimeInMilliseconds);
    },
    NewLoginUserMethod(state, status) {
      state.isLoggedIn = status;
    },

    LogoutUser(state) {
      state.isLoggedIn = null;
      state.personal_data = {};
      state.token = localStorage.removeItem("token");
      state.userData = [];
      state.card_list = [];
      state.SchoolData = [];
      state.newSecArray = [];
      state.ResumeName_Data = [];
      state.Skills_Data = [];
      state.User_Skills_Data = [];
      state.Two_Page_Resume = [];
      state.pageCount = 0;
      state.currentPage = 0;
      state.currentResume = null;
      state.showEducationEnhancement = false;
      localStorage.removeItem("resume_id");
      localStorage.removeItem("pageCount");
      localStorage.removeItem("CurrentResume");
      localStorage.removeItem("CurrentPage");
      localStorage.removeItem("page");
      localStorage.removeItem("user_id");
      localStorage.removeItem("token");
      localStorage.removeItem("savedDate");
    },
    tokenStored(state) {
      state.token = localStorage.getItem("token");
    },
    LocationData(state, data) {
      if ("states" in data) {
        state.statesData = data.states;
      } else {
        state.countriesData = data.countries;
      }
    },

    contactData(state, data) {
      state.contact_Data = data.user[0];
    },
    workHisory(state, data) {
      state.work_Hisory = data;
    },
    positionData(state, data) {
      state.position_Data = data;
    },
    storeCardDetail(state, data) {
      state.personal_data = data;
    },
    storeCheckLoader(state, data) {
      state.checkLoader = data;
    },
    storeUpgradeCancelbtns(state, data) {
      state.updateCancelBtn = data;
    },
    storeProSugTitle(state, data) {
      state.pro_sug_titles = data;
    },
    storeCurrentResume(state, data) {
      state.currentResume = data;
    },
    storeResumeBuilderClasses(state, data) {
      state.resumeHeightClasses = data;
    },
    storeResumeAddress(state, data) {
      state.resume_address = data;
    },
    storeForthSidebarColor(state, data) {
      state.forth_sidebar_font_color = data;
    },
    storeJobDescriptionsArray(state, data) {
      state.jobDescriptionsArray = data;
    },
    educationHistory(state, data) {
      state.education_History = data;
    },
    EducationEnhancementData(state, data) {
      state.grad_Date = data.user.isgradDate;
      state.tips = data.user.tips;
      state.userData = data.user;
      state.isGrade = data.user.isGrade;
      state.SchoolData = data.user.educationData;
      state.minorDate = data.user.minorDatePush;
      if (data.user.academic_achievement !== null) {
        state.AC2 = true;
      } else if (data.user.clubs_organizations !== null) {
        state.AC2 = true;
      } else if (
        data.user.credits_completed !== null &&
        data.user.majorgpa !== null &&
        data.user.overallgpa !== null
      ) {
        state.AC2 = true;
      }
    },
    updateUserPage(state, page) {
      state.userData.page = page;
    },
    ResumeNameData(state, data) {
      state.ResumeName_Data = data;
    },
    storeCardList(state, data) {
      state.card_list = data;
    },
    ResumeName(state, name) {
      if (state.ResumeName_Data.data.length > 0) {
        state.ResumeName_Data.data[state.ResumeName_Data.data.length - 1].name =
          name;
      }
    },
    TwoPageResumeData(state, data) {
      state.Two_Page_Resume = data;
    },
    storePageCount(state, data) {
      state.pageCount = data;
    },
    storeCurrentPage(state, data) {
      state.currentPage = data;
    },
    storeJobDescriptions(state, data) {
      state.jobDescriptions = data;
    },
    storeJobArray(state, data) {
      state.jobArray = data;
    },
    storeEduArray(state, data) {
      state.eduArray = data;
    },
    storeSkillArray(state, data) {
      state.skillArray = data;
    },
    storeKaunArray(state, data) {
      state.kaunArray = data;
    },
    storeEndorseArray(state, data) {
      state.endorseArray = data;
    },
    storeEduSubSectionArray(state, data) {
      state.eduSubSectionArray = data;
    },
    storeContactAddress(state, data) {
      state.contact_address = data;
    },
    storeNewSectionArray(state, data) {
      state.newSecArray = data;
    },
    storeproSummSubSectionArray(state, data) {
      state.proSummarySubSectionArray = data;
    },
    storeSkillSubSectionArray(state, data) {
      state.skillSubSectionArray = data;
    },
    storeResumeExperiencesArray(state, data) {
      state.resumeExperiencesArray = data;
    },
    updateContactSortedList(state, data) {
      state.contact_sorted_list = data;
    },
    loadQuestions(state, data) {
      state.load_Questions = data;
    },
    GetJob(state, data) {
      state.get_job = data;
    },

    SkillsData(state, data) {
      state.Skills_Data = data;
    },
    UserSkillData(state, data) {
      state.User_Skills_Data = data;
    },
    ExperienceFinderObjectMutation(state, data) {
      state.ExperienceFinder_Object = data;
    },
    SubscriptionData(state, data) {
      state.Subscription_Data = data;
    },
    SubscriptionCount(state, data) {
      state.Subscription_count = data;
    },
    updateResumeLastStep(state, page) {
      state.currentResume.last_step = page;
    },
    updateResumeCurrentId(state, id) {
      state.contact_Data.current_resume_id = id;
    },
    storeShowEducationEnhancement(state, data) {
      state.showEducationEnhancement = data;
    },
  },
  actions: {
    ExperienceFinderObject({ commit }, data) {
      commit("ExperienceFinderObjectMutation", data);
    },
    setResumeAddress({ commit }, resume) {
      let address = "";
      if (!resume.resume_setting.is_info_location) {
      }
      if (
        resume.user.street_address &&
        (resume.resume_setting.is_info_full_address ||
          resume.resume_setting.is_info_full_address_city)
      ) {
        address += resume.user.street_address + " ";
      }

      if (resume.user.city) {
        address += resume.user.city + " ";
      }

      if (resume.user.state) {
        address += resume.user.state.state + " ";
      }

      if (
        resume.user.countries.country_name &&
        resume.resume_setting.is_info_full_address_city
      ) {
        address += resume.user.countries.country_name;
      }

      // this.resume_address = address;
      commit("storeResumeAddress", address);
    },
    updateUserPage({ commit, state }, page) {
      return axios
        .post(state.EnvPath + "api/update-user-page", { page })
        .then(({ data }) => {
          if (data.status) {
            commit("updateUserPage", page);
            // state.userData.page = page;
          }
        })
        .catch((error) => console.log(error));
    },
    updateResumeLastStep({ commit, state }, data) {
      return axios
        .post(state.EnvPath + "api/update-resume-last-step", {
          page: data.step,
          resume_id: data.r_id,
        })
        .then(({ data }) => {
          if (data.status) {
            commit("updateResumeLastStep", data.page);
          }
        })
        .catch((error) => console.log(error));
    },
  },
  modules: {
    TwoPageResume: TwoPageResumeModule,
  },
});
