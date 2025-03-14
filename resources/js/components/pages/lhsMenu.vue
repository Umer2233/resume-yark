<template>
  <div class="col-md-2">
    <div class="sidebar1">
      <ul class="vertical-center">
        <li v-if="currentpage == 1">
          <i class="fas fa-phone-volume"></i> Contact Info
        </li>
        <li v-else class="visited-page">
          <router-link :to="{ name: 'new' }">
            <i class="fas fa-phone-volume"></i> Contact Info
          </router-link>
        </li>
        <li v-if="currentpage == 2">
          <i class="fas fa-briefcase qq"></i>
          Work History
        </li>
        <li v-else-if="parseInt(page) > 1" class="visited-page">
          <router-link :to="{ name: 'Store' }">
            <i class="fas fa-briefcase" style="background:#CCCCCC"></i> Work
            History
          </router-link>
        </li>
        <li v-else class="w3-opacity-max" style="color:black;">
          <i
            class="fas fa-briefcase"
            style="background: black;opacity: 0.3;"
          ></i>
          Work History
        </li>
        <li v-if="currentpage == 3" style="margin-right: 19px; ">
          <i class="fas fa-book-open"></i>
          Education
        </li>
        <li v-else-if="parseInt(page) > 2" class="visited-page">
          <router-link :to="{ name: 'WorkAdd' }">
            <i class="fas fa-book-open" style="background:#CCCCCC"></i>
            Education
          </router-link>
        </li>
        <li
          v-else
          class="w3-opacity-max"
          style="color:black; margin-right: 19px; "
        >
          <i
            class="fas fa-book-open"
            style="background: black;opacity: 0.3;"
          ></i>
          Education
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import store from "../../store";
import { environment_api } from "../../env";
import resumeNameStart from "./ResumeNameHeader";

export default {
  components: {
    resumeNameStart
  },
  props: {
    page: Number,
    currentpage: Number
  },
  data() {
    return {
      EnvPath: environment_api.api_url
    };
  },
  mounted() {},
  methods: {}
};
</script>
