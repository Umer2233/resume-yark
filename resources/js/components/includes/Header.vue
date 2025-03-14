<template>
  <ul class="navbar main_navigation">
    <li class="active_nav has_sub_nav_my_profile">
      <a href="#">
        <span class="icon"><i class="fas fa-user-alt"></i></span>My Profile
        <span class="icon icon_right_blue"
          ><i class="fas fa-caret-down"></i
        ></span>
      </a>
      <div class="my_profile_sub_menu">
        <span class="icon"><i class="fas fa-caret-up"></i></span>
        <ul class="profile-links">
          <li>
            <router-link active-class="active" to="/builder/contact">
              Contact Info
            </router-link>
          </li>
          <li>
            <button class="profile-btn" id="work-history-nav">
              <router-link active-class="active" to="/builder/work-history">
                Work History
              </router-link>
            </button>
          </li>
          <li>
            <button class="profile-btn" id="education-nav">
              <router-link active-class="active" to="/builder/education">
                Education
              </router-link>
            </button>
          </li>
          <LogoutHeader />
        </ul>
      </div>
    </li>
    <li class="my_resumes">
      <router-link :to="{ name: 'my-resume' }"> My Resumes</router-link>
    </li>
    <li class="active_nav has_sub_nav">
      <ResumeNameHeader />
    </li>
  </ul>
</template>

<script>
import LogoutHeader from "../pages/LogoutHeader.vue";
import ResumeNameHeader from "../pages/ResumeNameHeader.vue";

export default {
  components: { LogoutHeader, ResumeNameHeader },
  data() {
    return {
     
    };
  },

  methods: {
   
  },
};
</script>

<style scoped></style>
