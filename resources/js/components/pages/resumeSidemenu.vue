<template>
  <!-- <ul class="vertical-center">
          <li :style="[page == 5 ? {'color': '#2684fe !important'}: page > 5 ? {'color': '#467d86 !important'}:{'color': '#9dc5cc !important'}]">
            <i><img :src="EnvPath + 'images/logo/finder.png'" /></i> Experience Finder
          </li>

          <li class="visited-page">
             <istyle="
          padding-left: 6.82px !important;
          padding-right: 6.82px !important;
        "
        ><img :src="EnvPath + 'images/logo/education-ench.png'"
      /></i> Education Enhancements
            <a href="/contact/#/store"><i class="fas fa-briefcase" style="background:#CCCCCC"></i> Work History</a>
          </li>


          <li v-if="parseInt(page) > 2" class="visited-page">
            <a href="/contact/#/workadd"><i class="fas fa-book-open" style="background:#CCCCCC"></i> Education </a>
          </li>
 </ul> -->
  <ul class="vertical-center">
    <li
      v-if="pageFromDB < 5 || Page == 5"
      :class="[
        Page == 5
          ? 'active_nav'
          : pageFromDB >= 5
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <i><img :src="EnvPath + 'images/logo/finder.png'" /></i> Experience Finder
    </li>
    <li v-else :class="[Page == 5 ? 'active_nav' : 'visited-page']">
      <a
        href="/builder/contact/#/experience-finder"
        style="text-decoration: none; font-weight: bold"
        ><i><img :src="EnvPath + 'images/logo/finder.png'" /></i> Experience
        Finder</a
      >
    </li>

    <li
      v-if="pageFromDB < 6 || Page == 6"
      :class="[
        Page == 6
          ? 'active_nav'
          : pageFromDB >= 6
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <i
        style="
          padding-left: 6.82px !important;
          padding-right: 6.82px !important;
        "
        ><img :src="EnvPath + 'images/logo/education-ench.png'"
      /></i>
      <span class="edu_first"
        >Educational<br />
        <span>Enhancements</span></span
      >
    </li>
    <li v-else :class="[Page == 6 ? 'active_nav' : 'visited-page']">
      <a
        href="/builder/contact/#/education_enhancement"
        style="text-decoration: none; font-weight: bold"
      >
        <i
          style="
            padding-left: 6.82px !important;
            padding-right: 6.82px !important;
          "
          ><img :src="EnvPath + 'images/logo/education-ench.png'"
        /></i>
        <span class="edu_first"
          >Educational<br />
          <span>Enhancements</span></span
        >
      </a>
    </li>

    <li
      :class="[
        Page == 7
          ? 'active_nav'
          : pageFromDB >= 7
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <i style="padding-top: 4px"
        ><img :src="EnvPath + 'images/logo/job-description.png'"
      /></i>
      Job Descriptions
    </li>
    <li
      v-if="pageFromDB < 8 || Page == 8"
      :class="[
        Page == 8
          ? 'active_nav'
          : pageFromDB >= 8
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <i><img :src="EnvPath + 'images/logo/skills.png'" /></i>
      Skills
    </li>
    <li v-else :class="[Page == 8 ? 'active_nav' : 'visited-page']">
      <a
        href="/builder/contact/#/skills"
        style="text-decoration: none; font-weight: bold"
        ><i><img :src="EnvPath + 'images/logo/skills.png'" /></i> Skills</a
      >
    </li>
    <li
      :class="[
        Page == 9
          ? 'active_nav'
          : pageFromDB >= 9
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
      <i><img :src="EnvPath + 'images/logo/endorsment.png'" /></i>
      Endorsements
    </li>
    <li
      :class="[
        Page == 10
          ? 'active_nav'
          : pageFromDB >= 10
          ? 'visited-page'
          : 'w3-opacity-less',
      ]"
    >
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
</template>

<script>
import store from "../../store";
import { environment_api } from "../../env";

export default {
  name: "resumeSidemenu",
  props: {
    Page: {
      type: Number,
    },
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
      resume_name: "",
      pageFromDB: 0,
    };
  },
  beforeMount() {
    console.log("userData", this.$store.state.userData.page);
    if (this.$store.state.userData.page != null) {
      this.pageFromDB = this.$store.state.userData.page;
    }
    this.resume_name = localStorage.getItem("resume_name");
    this.pageFromDB = localStorage.getItem("page");
    //this.Page = localStorage.getItem('page');
    if (this.$store.state.ResumeName_Data !== "") {
      if (this.$store.state.ResumeName_Data.data.length > 0) {
        localStorage.removeItem("resume_name");
        // this.resume_name = this.$store.state.ResumeName_Data.data[
        //   this.$store.state.ResumeName_Data.data.length - 1
        // ].name;
        if (
          localStorage.getItem("resume_id") != "" ||
          localStorage.getItem("resume_id") != undefined
        ) {
          var resume_id = localStorage.getItem("resume_id");
          var that = this;
          console.log(
            "that.$store.state.ResumeName_Data.data",
            that.$store.state.ResumeName_Data.data
          );
          that.$store.state.ResumeName_Data.data.map(function (value, id) {
            localStorage.setItem("resume_id", value.resume_id);
            console.log("value.resume_id", value.resume_id);
            if (value.resume_id == resume_id) {
              that.resume_name = value.name;
            }
          });
        } else {
          this.resume_name =
            this.$store.state.ResumeName_Data.data[
              this.$store.state.ResumeName_Data.data.length - 1
            ].name;
        }
      }
    }
  },
};
</script>
