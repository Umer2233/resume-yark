<template>
  <div class="sidebar experience_finder_sidebar">
    <ul class="vertical-center">
      <!--Experience Finder Start-->
      <li v-if="page == 1">
        <i>
          <img :src="EnvPath + 'images/logo/finder.png'" />
        </i>
        Experience Finder
      </li>
      <li v-else :class="['w3-opacity-less', page > 1 ? 'visited-page' : '']">
        <router-link :to="{ name: 'experience-finder' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          Experience Finder
        </router-link>
      </li>
      <!--Experience Finder End-->
      <!--Job Descriptions Start-->
      <li v-if="page == 2">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/job-description.png'" />
        </i>
        Job Descriptions
      </li>
      <li v-else :class="['w3-opacity-less', page > 2 ? 'visited-page' : '']">
        <router-link :to="{ name: 'job_descriptions' }">
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/job-description.png'" />
          </i>
          Job Descriptions
        </router-link>
      </li>
      <!--Job Descriptions End-->
      <!--Skills Start-->
      <li v-if="page == 3">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/skills.png'" />
        </i>
        Skills
      </li>
      <li v-else :class="['w3-opacity-less', page > 3 ? 'visited-page' : '']">
        <router-link :to="{ name: 'skills' }">
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/skills.png'" />
          </i>
          Skills
        </router-link>
      </li>
      <!--Skills End-->
      <!--Endorsements Start-->
      <li v-if="page == 4">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/endorsment.png'" />
        </i>
        Endorsements
      </li>
      <li v-else :class="['w3-opacity-less', page > 4 ? 'visited-page' : '']">
        <router-link :to="{ name: 'endorsements' }">
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/endorsment.png'" />
          </i>
          Endorsements
        </router-link>
      </li>
      <!--Endorsements End-->
      <!--Professional Enhancements Start-->
      <li v-if="page == 5">
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
        >
          <img :src="EnvPath + 'images/logo/education-ench.png'" />
        </i>
        <span class="edu_first">
          Professionals
          <br />
          <span>Enhancements tik</span>
        </span>
      </li>
      <li v-else :class="['w3-opacity-less', page > 5 ? 'visited-page' : '']">
        <router-link :to="{ name: 'education_enhancement' }">
          <i
            style="
              padding-left: 6.82px !important;
              padding-right: 6.82px !important;
            "
          >
            <img :src="EnvPath + 'images/logo/education-ench.png'" />
          </i>
          <span class="edu_first">
            Professional
            <br />
            <span>Enhancementf tek</span>
          </span>
        </router-link>
      </li>
      <!--Professional Enhancements End-->
      <!--Resume Type Start-->
      <li v-if="page == 6">
        <i>
          <img :src="EnvPath + 'images/logo/finder.png'" />
        </i>
        Resume Type
      </li>
      <li v-else :class="['w3-opacity-less', page > 6 ? 'visited-page' : '']">
        <router-link :to="{ name: 'resume_type' }">
          <i>
            <img :src="EnvPath + 'images/logo/finder.png'" />
          </i>
          Resume Type
        </router-link>
      </li>
      <!--Resume Type End-->
      <li class="w3-opacity-less">
        <i
          class="fas fa-ellipsis-h"
          style="
            background: rgb(204, 204, 204);
            padding: 7px 6.82px 7px 6.83px !important;
          "
        ></i>
        More
      </li>
    </ul>
  </div>
</template>

<script>
import { environment_api } from "../../env";
import store from "../../store";

export default {
  props: {
    step: String,
    activePage: String,
    page: String,
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
      //education_enhacements: false
    };
  },
  mounted() {},
  methods: {},
};
</script>

<style scoped>
.sidebar {
  position: absolute;
  top: 14rem !important;
  background: red !important;
  width: 100%;
}


.sidebar.experience_finder_sidebar {
    position: relative;
}
</style>
