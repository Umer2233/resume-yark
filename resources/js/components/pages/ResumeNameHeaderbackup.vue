<template>
  <div>
    <a href="#"
      ><span class="icon"><i class="fas fa-list-ul"></i></span>
      <template v-if="getResumeName">
        {{ getResumeName }}
      </template>
      <template v-else> Resume Name </template>
      <span class="icon icon_right"><i class="fas fa-caret-down"></i></span
    ></a>
    <div class="resume_name_sub_menu">
      <span class="icon"><i class="fas fa-caret-up"></i></span>
      <ul>
        <li
          v-if="pageFromDB < 5 || Page == 5"
          :class="[
            'visited-page',
            Page == 5
              ? 'current-page'
              : pageFromDB >= 5
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{ name: 'experience-finder' }"
            exact-active-class="active"
          >
            Experience Finder</router-link
          >
        </li>
        <li v-else :class="[pageFromDB == 5 ? 'current-page' : 'visited-page']">
          <router-link :to="{ name: 'experience-finder' }"
            >Experience Finder</router-link
          >
        </li>
        <li class="visited-page">
          <router-link :to="{ name: 'job_descriptions' }"
            >Job Descriptions</router-link
          >
        </li>
        <li
          v-if="pageFromDB < 8 || Page == 8"
          :class="[
            'visited-page',
            Page == 8
              ? 'current-page'
              : pageFromDB >= 8
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{
              name: 'skills',
            }"
            >Skills</router-link
          >
        </li>
        <li
          v-else
          :class="[currentpage == 8 ? 'current-page' : 'visited-page']"
        >
          <router-link :to="{ name: 'job_descriptions' }"
            >Job Descriptions</router-link
          >
        </li>
        <li
          v-if="pageFromDB < 9 || Page == 9"
          :class="[
            'visited-page',
            Page == 9
              ? 'current-page'
              : pageFromDB >= 9
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <router-link
            :to="{
              name: 'endorsements',
            }"
            >Endorsements</router-link
          >
        </li>
        <li
          v-else
          :class="[currentpage == 9 ? 'current-page' : 'visited-page']"
        >
          <router-link :to="{ name: 'skills' }">Job Descriptions</router-link>
        </li>
        <!-- <li v-if="
          this.$store.state.grad_Date == true || this.$store.state.AC2 == true
        " :class="['visited-page',
            Page == 6
              ? 'current-page'
              : pageFromDB >= 6
                ? 'visited-page'
                : 'w3-opacity-less'
          ]">
          <a v-if="pageFromDB < 6 || Page == 6" href="#">
            <router-link :to="{ name: 'education_enhancement' }">Professional Enhancements</router-link>
          </a>
          <a v-else href="/builder/contact/#/education_enhancement">
            <router-link :to="{ name: 'education_enhancement' }">Professional Enhancements</router-link>
          </a>
        </li> -->
        <!-- <li v-if="pageFromDB < 7 || Page == 7" :class="['visited-page',
          Page == 7
            ? 'current-page'
            : pageFromDB >= 7
              ? 'visited-page'
              : 'w3-opacity-less'
        ]">
          <router-link v-if="pageFromDB < 7 || Page == 7" :to="{ name: 'education_enhancement' }">Education
            Enhancements</router-link>
          <router-link v-else :to="{ name: 'education_enhancement' }">Education Enhancements</router-link>
        </li> -->

        <div
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
        </div>

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
        </li>
        <li v-else :class="[Page == 11 ? 'current-page' : 'visited-page']">
          <router-link
            :to="{
              name: 'resume_type',
            }"
            >Resume Type</router-link
          >
        </li>

        <li
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
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
// import Header from '../../mixins/Header';
export default {
  name: "resume-name-start",
  //mixins: [Header],

  data() {
    return {
      Page: localStorage.getItem("page"),
      pageFromDB: "",
    };
  },
  computed: {
    ...mapGetters(["getResumeName", "getPageCount"]),
  },

  // mounted() {

  // console.log("userData", this.$store.state.userData.page);
  // if (this.$store.state.userData.page != null) {
  //   this.page = this.$store.state.userData.page;
  // }
  // if (this.$store.state.ResumeName_Data !== "") {
  //   if (this.$store.state.ResumeName_Data.data.length > 0) {
  //     this.resume_name = this.$store.state.ResumeName_Data.data[
  //       this.$store.state.ResumeName_Data.data.length - 1
  //     ].name;
  //   }
  // },
};
</script>
<style scoped>
.active {
  color: red;
}
</style>
