<template>
  <div>
    <a href="#"
      ><span class="icon"><i class="fas fa-list-ul"></i></span>
      <template v-if="getCurrentResume">
        {{ getCurrentResume.name }}
      </template>
      <template v-else> Resume Name </template>
      <span class="icon icon_right"><i class="fas fa-caret-down"></i></span
    ></a>
    <div class="resume_name_sub_menu">
      <span class="icon"><i class="fas fa-caret-up"></i></span>

      <ul
        class="resume-header-list space-control-header-box space-control-hearder-top-icon-active-page"
      >
        <li
          v-if="currentPage == 5"
          :class="[
            'visited-page',
            currentPage == 5
              ? 'current-page'
              : pageFromDB >= 5
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'experience-finder' }"
            exact-active-class="active"
            class="text-left"
          >
            Experience Finder</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 5 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 5">
            <router-link
              :to="{ name: 'experience-finder' }"
              exact-active-class="active"
              class="text-left"
            >
              Experience Finder</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur">
              Experience Finder
            </router-link>
          </span>
        </li>

        <li
          v-if="currentPage == 6"
          :class="[
            'visited-page',
            currentPage == 6
              ? 'current-page'
              : pageFromDB >= 6
              ? 'visited-page'
              : 'color-blur',
          ]"
        >
          <router-link
            :to="{ name: 'job_descriptions' }"
            exact-active-class="active"
          >
            Job Description</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 6 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 6">
            <router-link
              :to="{ name: 'job_descriptions' }"
              exact-active-class="active"
              class="text-left"
            >
              Job Description
            </router-link>
          </span>
          <span v-else>
            <router-link to="#" class="color-blur">
              Job Description
            </router-link>
          </span>
        </li>

        <li
          v-if="currentPage == 7"
          :class="[
            'visited-page',
            currentPage == 7
              ? 'current-page'
              : pageFromDB >= 7
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link :to="{ name: 'skills' }" exact-active-class="active">
            Skills</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 7 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 7">
            <router-link
              :to="{ name: 'skills' }"
              exact-active-class="active"
              class="text-left"
            >
              Skills</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur"> Skills </router-link>
          </span>
        </li>

        <li
          v-if="currentPage == 8"
          :class="[
            'visited-page',
            currentPage == 8
              ? 'current-page'
              : pageFromDB >= 8
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'endorsements' }"
            exact-active-class="active"
          >
            Endorsements</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 8 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 8">
            <router-link
              :to="{ name: 'endorsements' }"
              exact-active-class="active"
              class="text-left"
            >
              Endorsements</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur"> Endorsements </router-link>
          </span>
        </li>

        <li
          v-show="showEducation"
          v-if="currentPage == 9"
          :class="[
            'visited-page',
            currentPage == 9
              ? 'current-page'
              : pageFromDB >= 9
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'education_enhancement' }"
            exact-active-class="active"
          >
            Educational Enhancement</router-link
          >
        </li>
        <li
          v-else-if="showEducation"
          :class="['w3-opacity-less', pageFromDB >= 9 ? 'visited-page' : '']"
          class="love-me"
        >
          <span v-if="pageFromDB >= 9">
            <router-link
              :to="{ name: 'education_enhancement' }"
              exact-active-class="active"
              class="text-left"
            >
              Educational Enhancements</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur">
              Educational Enhancements
            </router-link>
          </span>
        </li>

        <li
          v-if="currentPage == 10"
          :class="[
            'visited-page',
            currentPage == 10
              ? 'current-page'
              : pageFromDB >= 10
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'resume_type' }"
            exact-active-class="active"
          >
            Resume Type</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 10 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 10">
            <router-link
              :to="{ name: 'resume_type' }"
              exact-active-class="active"
              class="text-left"
            >
              Resume Type</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur"> Resume Type </router-link>
          </span>
        </li>
        <li
          v-if="currentPage == 11"
          :class="[
            'visited-page',
            currentPage == 11
              ? 'current-page'
              : pageFromDB >= 11
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'TwoPageResume' }"
            exact-active-class="active"
          >
            Resume Builder</router-link
          >
        </li>
        <li
          v-else
          :class="['w3-opacity-less', pageFromDB >= 11 ? 'visited-page' : '']"
        >
          <span v-if="pageFromDB >= 11">
            <router-link
              :to="{ name: 'TwoPageResume' }"
              exact-active-class="active"
              class="text-left"
            >
              Resume Builder</router-link
            >
          </span>
          <span v-else>
            <router-link to="#" class="color-blur">
              Resume Builder
            </router-link>
          </span>
        </li>

        <!-- <div
          v-if="this.$store.state.SchoolData.length > 0"
          class="border-professional-bottom"
        >
          <li
            v-if="pageFromDB < 10 || Page == 10"
            :class="[
              'visited-page',
              Page == 10
                ? 'current-page'
                : pageFromDB >= 10
                ? 'visited-page'
                : 'w3-opacity-less',
            ]"
          >
            <router-link :to="{ name: 'education_enhancement' }"
              >Educational Enhancements</router-link
            >
          </li>
          <li v-else :class="[Page == 10 ? 'current-page' : 'visited-page']">
            <router-link :to="{ name: 'education_enhancement' }"
              >Educational Enhancement</router-link
            >
          </li>
        </div> -->
        <!--
        <li
          v-if="pageFromDB < 11 || Page == 11"
          :class="[
            'visited-page',
            Page == 11
              ? 'current-page'
              : pageFromDB >= 11
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{
              name: 'resume_type',
            }"
            >Resume Type</router-link
          >
        </li> -->
        <!-- <li v-else :class="[Page == 11 ? 'current-page' : 'visited-page']">
          <router-link
            :to="{
              name: 'resume_type',
            }"
            >Resume Type</router-link
          >
        </li> -->

        <!-- <li
          v-if="pageFromDB < 13 || Page == 13"
          :class="[
            'visited-page',
            Page == 7
              ? 'current-page'
              : pageFromDB >= 13
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{
              name: 'TwoPageResume',
              query: { resume_id: 185 },
            }"
            >Resume Builder</router-link
          >
        </li>
        <li v-else :class="[Page == 12 ? 'current-page' : 'visited-page']">
          <router-link
            :to="{
              name: 'TwoPageResume',
              query: { resume_id: 185 },
            }"
            >Resume Builder</router-link
          >
        </li> -->
      </ul>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
// import Header from '../../mixins/Header';
import store from "../../store";
import Common from "../../mixins/Common.js";

export default {
  name: "resume-name-start",
  //mixins: [Header],
  mixins: [Common],

  data() {
    return {
      Page: localStorage.getItem("page"),
      pageFromDBd: "",
      current_page: "",
      currentYear: new Date().getFullYear(),
    };
  },
  computed: {
    ...mapGetters([
      "getResumeName",
      "getPageCount",
      "getUserData",
      "getCurrentResume",
      "getShowEducationEnhancement",
    ]),
    showEducation() {
      return this.$store.state.showEducationEnhancement;
    },
    currentPage() {
      if (
        this.$store.state.currentPage == null &&
        localStorage.getItem("CurrentPage") !== null
      ) {
        store.commit("storeCurrentPage", localStorage.getItem("CurrentPage"));
      }

      return this.$store.state.currentPage !== null
        ? this.$store.state.currentPage
        : localStorage.getItem("CurrentPage")
        ? localStorage.getItem("CurrentPage")
        : "";
    },
    pageFromDB() {
      if (
        this.$store.state.currentResume == null &&
        localStorage.getItem("CurrentResume") !== null
      ) {
        store.commit(
          "storeCurrentResume",
          JSON.parse(localStorage.getItem("CurrentResume"))
        );
      }
      return this.$store.state.currentResume !== null
        ? this.$store.state.currentResume.last_step
        : localStorage.getItem("CurrentResume") !== null
        ? JSON.parse(localStorage.getItem("CurrentResume")).last_step
        : "";
    },
  },
  created() {},
  mounted() {
    // this.checkEducationInfiveYears();
  },
  beforeMount() {},
  methods: {},

  h: {},
};
</script>
<style scoped>
.active {
  color: red;
}

ul.space-control-header-box li.visited-page.current-page {
  padding: 0 !important;
}

@media (max-width: 450px) {
  .see_example_link {
    padding: 0px 20px !important;
  }

  .resume_name_sub_menu
    ul.space-control-hearder-top-icon-active-page
    li.visited-page.current-page {
    padding: 0 !important;
  }
}

ul.space-control-hearder-top-icon-active-page li.visited-page.current-page {
  padding: 6px 0 !important;
}
</style>
