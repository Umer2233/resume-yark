<template>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <router-link class="navbar-brand" :to="{ name: 'contact' }">
          <img
            :src="EnvPath + 'images/logo/logo.png'"
            alt="Resume Yak"
            class="logo"
          />
        </router-link>
        <span class="icon icon_menu">
          <i class="fas fa-bars"></i>
        </span>
        <ul class="navbar main_navigation show">
          <li class="active_nav has_sub_nav_my_profile">
            <a
              style="opacity: 0.3 !important"
              v-if="parseInt(currentpage) > 4"
              href="#"
            >
              <span class="icon">
                <i class="fas fa-user-alt"></i>
              </span>
              My Profile
              <span class="icon icon_right_blue">
                <i class="fas fa-caret-down"></i>
              </span>
            </a>
            <a v-else href="#">
              <span class="icon">
                <i class="fas fa-user-alt"></i>
              </span>
              My Profile
              <span class="icon icon_right_blue">
                <i class="fas fa-caret-down"></i>
              </span>
            </a>
            <div class="my_profile_sub_menu">
              <span class="icon">
                <i class="fas fa-caret-up"></i>
              </span>
              <ul>
                <li v-if="currentpage == 1" class="current-page">
                  <a href="javaScript:void(0);">Contact Info</a>
                </li>
                <li v-else class="resume-visited-page">
                  <router-link :to="{ name: 'new' }">Contact Info</router-link>
                </li>
                <li v-if="currentpage == 2" class="current-page">
                  <a href="javaScript:void(0);">Work History</a>
                </li>
                <li v-else-if="parseInt(page) > 1" class="visited-page">
                  <router-link :to="{ name: 'Store' }"
                    >Work History</router-link
                  >
                </li>
                <li v-else>
                  <a href="javaScript:void(0);">Work History</a>
                </li>
                <li v-if="currentpage == 3" class="current-page">
                  <a href="javaScript:void(0);">Education</a>
                </li>
                <li v-else-if="parseInt(page) > 2" class="visited-page">
                  <router-link :to="{ name: 'WorkAdd' }">Education</router-link>
                </li>
                <li v-else>
                  <a href="javaScript:void(0);">Education</a>
                </li>
                <li v-if="isLoggedIn" class="current-page">
                  <router-link :to="{ name: 'logout' }">Logout</router-link>
                </li>
              </ul>
            </div>
          </li>

          <li v-if="parseInt(currentpage) > 4" class="my_resumes">
            <router-link
              style="opacity: 1 !important"
              :to="{ name: 'my-resume' }"
            >
              <span class="icon">
                <i class="fas fa-file-alt"></i>
              </span>
              My Resumes
            </router-link>
          </li>

          <li v-else class="my_resumes">
            <router-link :to="{ name: 'my-resume' }">
              <span class="icon">
                <i class="fas fa-file-alt"></i>
              </span>
              My Resumes
            </router-link>
          </li>
          <!-- resume name dropdoen from vue js  -->
          <resumeNameStart
            :education_enhacements="education_enhacements"
            :currentpage="currentpage"
            ref="rns"
          ></resumeNameStart>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
import store from "../../store";
import { environment_api } from "../../env";
import resumeNameStart from "./ResumeNameHeader";

export default {
  components: {
    resumeNameStart,
  },
  props: {
    page: Number,
    currentpage: Number,
    isLoggedIn: Boolean,
    education_enhacements: Boolean,
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
    };
  },
  mounted() {
    console.log("currentpage ****" + this.currentpage);
  },
  methods: {},
};
</script>
