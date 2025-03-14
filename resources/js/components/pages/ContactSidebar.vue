<template>
  <div class="sidebar1 sidebar experience_finder_sidebar">
    <ul
      class="vertical-center space-links-contact-page w-100"
      style="width: 90% !important; margin-left: 16px"
    >
      <li v-if="currentPage == 1 && this.$route.name != 'account-details'">
        <router-link :to="{ name: 'new' }">
          <i class="fas fa-phone-volume"></i>
          Contact Info
        </router-link>
      </li>
      <li
        v-else
        :class="['w3-opacity-less', pageFromDB >= 1 ? 'visited-page' : '']"
      >
        <router-link :to="{ name: 'new' }">
          <i class="fas fa-phone-volume"></i>
          Contact Info
        </router-link>
      </li>

      <li v-if="currentPage == 2 && this.$route.name != 'account-details'"  class="cursor-pointer">
        <i class="fas fa-briefcase aaa"> </i>
        Work History
      </li>
      <li
        v-else
        :class="['w3-opacity-less', pageFromDB >= 2 ? 'visited-page' : '']"
      >
        <span v-if="pageFromDB >= 2">
          <router-link :to="{ name: 'Store' }">
            <i class="fas fa-briefcase aaa"> </i>
            Work History
          </router-link>
        </span>
        <span v-else>
          <i class="fas fa-briefcase aaa"> </i>
          Work History
        </span>
      </li>
      <li
        v-if="currentPage == 3 && this.$route.name != 'account-details'"
        class="cursor-pointer"
      >
        <i class="fas fa-book-open"> </i>
        Education
      </li>
      <li
        v-else
        :class="['w3-opacity-less', pageFromDB >= 3 ? 'visited-page' : '']"
      >
        <span v-if="pageFromDB >= 3">
          <router-link :to="{ name: 'WorkAdd' }">
            <i class="fas fa-book-open"> </i>
            Education
          </router-link>
        </span>
        <span v-else>
          <i class="fas fa-book-open"> </i>
          Education
        </span>
      </li>

      <li
        v-if="loggedIn"
        :class="[
          this.$route.name == 'account-details'
            ? 'cursor-pointer'
            : 'w3-opacity-less visited-page',
        ]"
      >
        <router-link :to="{ name: 'account-details' }">
         <i class="fal fa-credit-card"></i>
          Account Details
        </router-link>
      </li>

      <!-- <li v-if="parseInt(page) > 1" class="visited-page">
        <router-link :to="{ name: 'Store' }"
          ><i class="fas fa-briefcase aaa" style="background: #cccccc"></i>Work
          History</router-link
        >
      </li> -->
      <!-- <li v-else class="w3-opacity-max" style="color: black">
        <i class="fas fa-briefcase" style="background: black; opacity: 0.3"></i>
        Work History
      </li> -->
      <!-- <li v-if="parseInt(page) > 2" class="visited-page">
        <router-link
          ><i class="fas fa-book-open" style="background: #cccccc"></i
          >Education</router-link
        >
      </li>
      <li
        v-else
        class="w3-opacity-max"
        style="color: black; margin-right: 19px"
      >
        <i class="fas fa-book-open" style="background: black; opacity: 0.3"></i
        >Education
      </li> -->
    </ul>
  </div>
</template>
<script>
import { mapGetters, mapState } from "vuex";
import store from "../../store";

export default {
  name: "ContactSidebar",
  data() {
    return {
      page: 1,
    };
  },
  computed: {
    ...mapGetters(["getPageCount"]),
    currentPage() {
      return this.$store.state.currentPage;
    },
    pageFromDB() {
      return this.getPageCount
        ? this.getPageCount
        : localStorage.getItem("pageCount");
    },
    loggedIn() {
      return this.$store.state.token;
    },
  },
  mounted() {},
};
</script>
<style></style>
