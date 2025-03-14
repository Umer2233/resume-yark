<template>
  <div class="sidebar experience_finder_sidebar">
    <!-- <ul class="vertical-center">
      <li v-if="step == 1">
        <i>
          <img :src="EnvPath + 'images/logo/finder.png'" />
        </i>
        Experience Finder
      </li>
      <li v-if="step > 1" class="w3-opacity-less visited-page">
        <router-link :to="{ name: 'experience-finder' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          Experience Finder
        </router-link>
      </li>
      <li v-if="education_enhacements && step > 4" class="w3-opacity-less visited-page">
        <router-link :to="{ name: 'job_descriptions' }">
          <i style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            ">
            <img :src="EnvPath + 'images/logo/job-description.png'" />
          </i>
          Job Descriptions
        </router-link>
      </li>
      <li v-else class="w3-opacity-less side-menu-icons-bar">
        <i style="padding-top: 4px">
          <img :src="EnvPath + 'images/logo/job-description.png'" />
        </i>
        Job Descriptions
      </li>
      <li class="w3-opacity-less side-menu-icons-bar">
        <i style="background: rgb(204, 204, 204)">
          <img :src="EnvPath + 'images/logo/skills.png'" />
        </i>
        Skills
      </li>
      <li class="w3-opacity-less side-menu-icons-bar">
        <i style="background: rgb(204, 204, 204)">
          <img :src="EnvPath + 'images/logo/endorsment.png'" />
        </i>
        Endorsements
      </li>
      <li class="w3-opacity-less side-menu-icons-bar">
        <i style="background: rgb(204, 204, 204)">
          <img :src="EnvPath + 'images/logo/education-ench.png'" />
        </i>
        <span class="edu_first">
          Professional
          <br />
          <span>Enhancements</span>
        </span>
      </li>
      <li v-if="page > 2" class="w3-opacity-less visited-page">
        <router-link :to="{ name: 'resume_type' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          Resume Type
        </router-link>
      </li>
      <li v-else>
        <i>
          <img :src="EnvPath + 'images/logo/finder.png'" />
        </i>
        Resume Type
      </li>
      <li v-if="education_enhacements && step == 3">
        <i style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          ">
          <img :src="EnvPath + 'images/logo/education-ench.png'" />
        </i>
        <span class="edu_first">
          Education
          <br />
          <span>Enhancements</span>
        </span>
      </li>
      <li v-else-if="education_enhacements && (step > 3 || page > step)" class="w3-opacity-less visited-page">
        <router-link :to="{ name: 'education_enhancement' }">
          <i style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            ">
            <img :src="EnvPath + 'images/logo/education-ench.png'" />
          </i>
          <span class="edu_first">
            Education
            <br />
            <span>Enhancements</span>
          </span>
        </router-link>
      </li>
      <li v-else-if="education_enhacements && step < 3" class="w3-opacity-less side-menu-icons-bar">
        <i style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          ">
          <img :src="EnvPath + 'images/logo/education-ench.png'" />
        </i>
        <span class="edu_first">
          Education
          <br />
          <span>Enhancements</span>
        </span>
      </li>

      <li v-if="education_enhacements && step == 4">
        <i style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          ">
          <img :src="EnvPath + 'images/logo/job-description.png'" />
        </i>
        Job Descriptions
      </li>
      <li class="w3-opacity-less side-menu-icons-bar">
        <i class="fas fa-ellipsis-h" style="
            background: rgb(204, 204, 204);
            padding: 7px 6.82px 7px 6.83px !important;
          "></i>
        More
      </li>
    </ul> -->
    <ul class="vertical-center li-after-align-code w-100">
      <!--Experience Finder Start-->
      <li v-if="page == 5">
        <router-link :to="{ name: 'experience-finder' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          <span class="text-side-menu">Experience Finder</span>
        </router-link>
      </li>
      <li
        v-else
        :class="['w3-opacity-less', getPageCount >= 5 ? 'visited-page' : '']"
      >
        <router-link :to="{ name: 'experience-finder' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>

          <span class="text-side-menu">Experience Finder</span>
        </router-link>
      </li>
      <!--Experience Finder End-->
      <!--Job Descriptions Start-->

      <li v-if="page == 6" class="cursor-pointer">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/job-description.png'" />
        </i>
        <span class="text-side-menu">Job Descriptions</span>
      </li>
      <li
        v-else
        :class="['w3-opacity-less', getPageCount >= 6 ? 'visited-page' : '']"
      >
        <span v-if="getPageCount >= 6">
          <router-link
            :to="{ name: 'job_descriptions' }"
            class="d-flex align-items-center"
          >
            <i
              style="
                padding-left: 6.82px !important;
                padding-right: 6.82px !important;
                width: 30px !important;
                display: flex;
                height: 30px !important;
                justify-content: center;
                align-items: center;
              "
            >
              <img :src="EnvPath + 'images/logo/job-description.png'" />
            </i>
            <span class="text-side-menu">Job Descriptions</span>
          </router-link>
        </span>
        <span v-else>
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
              width: 30px !important;
              display: flex;
              height: 30px !important;
              justify-content: center;
              align-items: center;
            "
          >
            <img :src="EnvPath + 'images/logo/job-description.png'" />
          </i>

          <span class="text-side-menu">Job Descriptions</span>
        </span>
      </li>
      <!--Job Descriptions End-->
      <!--Skills Start-->
      <li v-if="page == 7" class="cursor-pointer">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/skills.png'" />
        </i>
        <span class="text-side-menu">Skills</span>
      </li>
      <li
        v-else
        :class="['w3-opacity-less', getPageCount >= 7 ? 'visited-page' : '']"
      >
        <span v-if="getPageCount >= 7">
          <router-link :to="{ name: 'skills' }">
            <i
              style="
                padding-left: 6.82px !important;
                padding-right: 6.82px !important;
              "
            >
              <img :src="EnvPath + 'images/logo/skills.png'" />
            </i>
            <span class="text-side-menu">Skills</span>
          </router-link>
        </span>
        <span v-else>
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/skills.png'" />
          </i>

          <span class="text-side-menu">Skills</span>
        </span>
      </li>
      <!--Skills End-->
      <!--Endorsements Start-->
      <li v-if="page == 8">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/endorsment.png'" />
        </i>
        <span class="text-side-menu">Endorsements</span>
      </li>
      <li
        v-else
        :class="['w3-opacity-less', getPageCount >= 8 ? 'visited-page' : '']"
      >
        <span v-if="getPageCount >= 8">
          <router-link :to="{ name: 'endorsements' }">
            <i
              style="
                padding-left: 6.82px !important;
                padding-right: 6.82px !important;
              "
            >
              <img :src="EnvPath + 'images/logo/endorsment.png'" />
            </i>
            <span class="text-side-menu">Endorsements</span>
          </router-link>
        </span>
        <span v-else>
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/endorsment.png'" />
          </i>
          <span class="text-side-menu">Endorsements</span>
        </span>
      </li>
      <!--Endorsements End-->
      <!--Professional Enhancements Start-->
      <!-- v-if="this.$store.state.SchoolData.length > 0" -->
      <div>
        <li v-show="getShowEducationEnhancement" v-if="page == 9">
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/education-ench.png'" />
          </i>
          <span class="edu_first education-display-inherti">
            Educational
            <br />Enhancements
          </span>
        </li>
        <li
          v-else-if="getShowEducationEnhancement"
          :class="['w3-opacity-less', getPageCount >= 9 ? 'visited-page' : '']"
        >
          <span v-if="getPageCount >= 9">
            <router-link :to="{ name: 'education_enhancement' }">
              <i
                style="
                  padding-left: 6.82px !important;
                  padding-right: 6.82px !important;
                "
              >
                <img :src="EnvPath + 'images/logo/education-ench.png'" />
              </i>
              <span class="edu_first education-display-inherti">
                Educational
                <br />Enhancements
              </span>
            </router-link>
          </span>
          <span v-else>
            <i
              style="
                padding-left: 6.82px !important;
                padding-right: 6.82px !important;
              "
            >
              <img :src="EnvPath + 'images/logo/education-ench.png'" />
            </i>
            <span class="edu_first education-display-inherti">
              Educational
              <br />Enhancements
            </span>
          </span>
        </li>
      </div>
      <!--Professional Enhancements End-->
      <!--Resume Type Start-->
      <li v-if="page == 10">
        <i>
          <img :src="EnvPath + 'images/logo/finder.png'" />
        </i>

        <span class="text-side-menu">Resume Type</span>
      </li>

      <li
        v-else
        :class="['w3-opacity-less', getPageCount >= 10 ? 'visited-page' : '']"
      >
      
        <span v-if="getPageCount >= 10">
          <router-link :to="{ name: 'resume_type' }">
            <i>
              <img :src="EnvPath + 'images/logo/finder.png'" />
            </i>
            <span class="text-side-menu">Resume Type</span>
          </router-link>
        </span>

        <span v-else>
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          <span class="text-side-menu">Resume Type</span>
        </span>

      </li>
      <!--Resume Type End-->

      <li class="w3-opacity-less visited-page" v-if="getPageCount >= 11">
        <span>
          <router-link :to="{ name: 'TwoPageResume' }">
            <i>
              <img :src="EnvPath + 'images/logo/finder.png'" />
            </i>
            <span class="text-side-menu">Resume Builder</span>
          </router-link>
        </span>
      </li>


      <li class="w3-opacity-less" v-else>
        <span>
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          <span class="text-side-menu">Resume Builder</span>
        </span>
      </li>


    </ul>
  </div>
</template>

<script>
import { environment_api } from "../env";
import store from "../store";
import { mapGetters, mapState, mapActions } from "vuex";
import Common from "../mixins/Common.js";

export default {
  mixins: [Common],
  name: "sidemenu",
  props: {
    step: String,
    activePage: String,
    // page: Number,
  },
  data() {
    return {
      EnvPath: environment_api.api_base_url,
    };
  },
  mounted() {
    // function from mixin common
    // this.checkEducationInfiveYears();
  },
  computed: {
    ...mapGetters(["getUserData", "getShowEducationEnhancement"]),
    page() {
      return this.$store.state.currentPage;
    },
    getPageCount() {
      return this.$store.state.currentResume
        ? this.$store.state.currentResume.last_step
        : 0;
    },
  },

  methods: {},
};
</script>

<style>
.sidebar.experience_finder_sidebar ul.vertical-center li a:after {
  left: 28px !important;
}

li.w3-opacity-less.visited-page a {
  display: flex;
  align-items: center;
}
ul.vertical-center.li-after-align-code li {
  width: 30px !important;
  height: 30px !important;
  display: flex;
  align-items: center;
  margin-bottom: 20px !important;
}

ul.vertical-center.li-after-align-code.w-100 {
  padding: 15px 15px 0px 10px !important;
}
</style>
