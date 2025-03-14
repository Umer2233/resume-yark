<template>
  <ul class="navbar main_navigation" id="toShowAndHide">
    <li class="active_nav has_sub_nav_my_profile hover-btn-header">
      <a href="#" class=""
        ><span class="icon"><i class="fas fa-user-alt"></i></span> My Profile
        <span class="icon icon_right_blue"
          ><i class="fas fa-caret-down"></i></span
      ></a>
      <div class="my_profile_sub_menu">
        <span class="icon"><i class="fas fa-caret-up"></i></span>
        <ul class="profile-links">
          <!-- <li>
            <router-link active-class="active" :to="{ name: 'new' }">
              Contact Info</router-link
            >
          </li> -->
          <li
            v-if="currentPage == 1"
            :class="[
              'visited-page',
              currentPage == 1
                ? 'current-page'
                : pageFromDB >= 1
                ? 'visited-page'
                : 'w3-opacity-less',
            ]"
          >
            <span>
              <router-link :to="{ name: 'new' }" active-class="active">
                Contact Info</router-link
              >
            </span>
          </li>
          <li
            v-else
            :class="['w3-opacity-less', pageFromDB >= 1 ? 'visited-page' : '']"
          >
            <span v-if="pageFromDB >= 1">
              <router-link
                :to="{ name: 'new' }"
                exact-active-class="active"
                class="text-left"
              >
                Contact Info</router-link
              >
            </span>
            <span v-else>
              <router-link to="#" class="color-blur">
                Contact Info
              </router-link>
            </span>
          </li>
          <li
            v-if="currentPage == 2"
            style=""
            :class="[
              'visited-page',
              currentPage == 2
                ? 'current-page'
                : pageFromDB >= 2
                ? 'visited-page'
                : 'w3-opacity-less',
            ]"
          >
            <router-link :to="{ name: 'Store' }" active-class="active">
              Work History</router-link
            >
          </li>
          <li
            v-else
            style=""
            :class="['w3-opacity-less', pageFromDB >= 2 ? 'visited-page' : '']"
          >
            <span v-if="pageFromDB >= 2">
              <router-link
                :to="{ name: 'Store' }"
                exact-active-class="active"
                class="text-left"
              >
                Work History</router-link
              >
            </span>
            <span v-else>
              <router-link to="#" class="color-blur">
                Work History
              </router-link>
            </span>
          </li>

          <!-- <li>
            <button class="profile-btn" id="education-nav">
              <router-link active-class="active" :to="{ name: 'WorkAdd' }">
                Education</router-link
              >
            </button>
          </li> -->

          <li
            v-if="
              currentPage == 3 &&
              this.$route.name != 'account-details' &&
              this.$route.name != 'subscription'
            "
            :class="[
              'visited-page',
              currentPage == 3
                ? 'current-page'
                : pageFromDB >= 3
                ? 'visited-page'
                : 'w3-opacity-less',
            ]"
          >
            <router-link :to="{ name: 'WorkAdd' }" active-class="active">
              Education</router-link
            >
          </li>
          <li
            v-else
            :class="['w3-opacity-less', pageFromDB >= 3 ? 'visited-page' : '']"
          >
            <span v-if="pageFromDB >= 3">
              <router-link
                :to="{ name: 'WorkAdd' }"
                exact-active-class="active"
                class="text-left"
              >
                Education</router-link
              >
            </span>
            <span v-else>
              <router-link to="#" class="color-blur"> Education </router-link>
            </span>
          </li>

          <!-- stripe  -->
          <li
            v-if="loggedIn"
            :class="[
              'visited-page',
              this.$route.name == 'account-details'
                ? 'current-page'
                : 'w3-opacity-less',
            ]"
          >
            <span>
              <router-link
                :to="{ name: 'account-details' }"
                active-class="active"
              >
                Account Details</router-link
              >
            </span>
          </li>

          <!-- stripe end -->
          <LogoutHeader />
        </ul>
      </div>
    </li>
    <!-- {{
      pageFromDB
    }}
    ,
    {{
      currentPage
    }} -->
    <!-- <li class="my_resumes">
      <router-link :to="{ name: 'my-resume' }" class="hover-btn-header"
        ><span class="icon"><i class="fas fa-file-alt"></i></span> My Resumes
      </router-link>
    </li> -->

    <li
      v-if="currentPage == 4"
      style=""
      :class="[
        'visited-page',
        currentPage == 4
          ? 'current-page'
          : pageFromDB >= 2
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <router-link :to="{ name: 'my-resume' }" active-class="active">
        <i class="fas fa-file yellow-icon-pdf"></i> My Resumes</router-link
      >
    </li>
    <li
      v-else
      style=""
      :class="[
        'w3-opacity-less myresume-not-allowed',
        pageFromDB >= 2 ? 'visited-page' : '',
      ]"
    >
      <span v-if="pageFromDB >= 2">
        <router-link
          :to="{ name: 'my-resume' }"
          exact-active-class="active"
          class="text-left"
        >
          <i class="fas fa-file yellow-icon-pdf"></i> My Resume</router-link
        >
      </span>
      <span v-else>
        <!-- color-blur -->
        <router-link to="#" class="">
          <i class="fas fa-file yellow-icon-pdf"></i> My Resume
        </router-link>
      </span>
    </li>

    <!-- resume name dropdown from vue js  -->

    <li
      class="active_nav has_sub_nav show-menu-btn"
      :class="{ 'active-toggle': isToggle }"
      @click="toggleActive"
    >
      <ResumeNameHeader />
    </li>
  </ul>
</template>

<script>
import LogoutHeader from "./LogoutHeader.vue";
import ResumeNameHeader from "./ResumeNameHeader.vue";
import { mapGetters } from "vuex";

export default {
  components: { LogoutHeader, ResumeNameHeader },
  created() {},
  computed: {
    ...mapGetters(["getResumeName", "getPageCount", "getUserData"]),
    currentPage() {
      return this.$store.state.currentPage;
    },
    loggedIn() {
      return this.$store.state.token;
    },
    pageFromDB() {
      return this.getPageCount
        ? this.getPageCount
        : localStorage.getItem("pageCount");
    },
  },
  data() {
    return {
      isToggle: false,
    };
  },
  mounted() {},
  methods: {
    toggleActive() {
      this.isToggle = !this.isToggle;
      if (this.isToggle) {
        window.addEventListener("click", this.handleClickOutside);
      } else {
        window.removeEventListener("click", this.handleClickOutside);
      }
    },

    handleClickOutside(event) {
      const dropdown = this.$el;
      if (!(dropdown && dropdown.contains(event.target))) {
        this.isToggle = false;
        window.removeEventListener("click", this.handleClickOutside);
      }
    },
  },
};
</script>

<style>
.hover-btn-header {
  opacity: 0.4;
}

.hover-btn-header:hover {
  opacity: 1;
}

ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less,
ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less
  span
  a {
  cursor: not-allowed !important;
}

ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less.visited-page,
ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less.visited-page
  span
  a {
  cursor: pointer !important;
}

ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less
  span
  a:hover {
  color: #a2bec2 !important;
}

ul.resume-header-list.space-control-header-box.space-control-hearder-top-icon-active-page
  li.w3-opacity-less.visited-page
  span
  a:hover {
  color: #2684fe !important;
}

i.yellow-icon-pdf {
  color: #f6de61 !important;
  background: none !important;
  margin-right: 7px;
  margin-top: -4px;
}

@media (max-width: 450px) {
  li.active_nav.has_sub_nav.show-menu-btn.active-toggle .resume_name_sub_menu {
    display: block !important;
  }

  .resume_name_sub_menu {
    display: none !important;
  }
}

li.w3-opacity-less.myresume-not-allowed,
li.w3-opacity-less.myresume-not-allowed span,
li.w3-opacity-less.myresume-not-allowed span a {
  cursor: not-allowed !important;
}

li.w3-opacity-less.myresume-not-allowed.visited-page,
li.w3-opacity-less.myresume-not-allowed.visited-page span,
li.w3-opacity-less.myresume-not-allowed.visited-page span a {
  cursor: pointer !important;
}

a.router-link-exact-active.active:hover i,
li.w3-opacity-less.myresume-not-allowed.visited-page span a:hover i {
  background-color: transparent !important;
}

ul.profile-links li.w3-opacity-less,
ul.profile-links li.w3-opacity-less span,
ul.profile-links li.w3-opacity-less span a{
  cursor: not-allowed !important;
}

ul.profile-links li.w3-opacity-less.visited-page,
ul.profile-links li.w3-opacity-less.visited-page span,
ul.profile-links li.w3-opacity-less.visited-page span a{
  cursor: pointer !important;
}
</style>
