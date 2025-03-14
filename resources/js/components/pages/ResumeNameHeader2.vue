<template>
  <li
    v-if="this.$store.state.userData.page >= 5 || Page >= 5"
    class="active_nav has_sub_nav"
  >
    <a href="#">
      <span class="icon">
        <i class="fas fa-list-ul"></i>
      </span>
      <template v-if="resume_name">{{ resume_name }}</template>
      <template v-else>Resume Name</template>
      <span class="icon icon_right">
        <i class="fas fa-caret-down"></i>
      </span>
    </a>
    <div class="resume_name_sub_menu">
      <span class="icon">
        <i class="fas fa-caret-up"></i>
      </span>
      <ul>
        <!-- :style="[
              page == 5
                ? { color: '#2684fe !important' }
                : page > 5
                ? { color: '#467d86 !important' }
                : { color: '#9dc5cc !important' },
        ]"-->
        <li
          v-if="pageFromDB < 5 || Page == 5"
          :class="[
            Page == 5
              ? 'current-page'
              : pageFromDB >= 5
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Experience Finder</a>
        </li>
        <li v-else :class="[Page == 5 ? 'current-page' : 'visited-page']">
          <a href="/builder/contact/#/experience-finder">Experience Finder</a>
        </li>

        <li
          v-if="
            this.$store.state.grad_Date == true || this.$store.state.AC2 == true
          "
          :class="[
            Page == 6
              ? 'current-page'
              : pageFromDB >= 6
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a v-if="pageFromDB < 6 || Page == 6" href="#"
            >Education Enhancements</a
          >
          <a v-else href="/builder/contact/#/education_enhancement"
            >Education Enhancements</a
          >
        </li>
        <li
          v-if="pageFromDB < 7 || Page == 7"
          :class="[
            Page == 7
              ? 'current-page'
              : pageFromDB >= 7
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Job Descriptions</a>
        </li>
        <li v-else :class="[Page == 7 ? 'current-page' : 'visited-page']">
          <a href="/builder/contact/#/job_description">Job Descriptions</a>
        </li>

        <li
          v-if="pageFromDB < 8 || Page == 8"
          :class="[
            Page == 8
              ? 'current-page'
              : pageFromDB >= 8
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Skills</a>
        </li>
        <li v-else :class="[Page == 8 ? 'current-page' : 'visited-page']">
          <a href="/builder/contact/#/skills">Skills</a>
        </li>

        <li
          v-if="pageFromDB < 9 || Page == 9"
          :class="[
            Page == 9
              ? 'current-page'
              : pageFromDB >= 9
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Endorsements</a>
        </li>
        <li v-else :class="[Page == 9 ? 'current-page' : 'visited-page']">
          <a href="#">Endorsements</a>
        </li>

        <li
          v-if="pageFromDB < 10 || Page == 10"
          :class="[
            Page == 10
              ? 'current-page'
              : pageFromDB >= 10
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Educational Enhancements</a>
        </li>
        <li v-else :class="[Page == 10 ? 'current-page' : 'visited-page']">
          <a href="#">Educational Enhancements</a>
        </li>

        <li
          v-if="pageFromDB < 11 || Page == 11"
          :class="[
            Page == 11
              ? 'current-page'
              : pageFromDB >= 11
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Resume Type</a>
        </li>
        <li v-else :class="[Page == 11 ? 'current-page' : 'visited-page']">
          <a href="#">Resume Type</a>
        </li>

        <li
          v-if="pageFromDB < 12 || Page == 12"
          :class="[
            Page == 12
              ? 'current-page'
              : pageFromDB >= 12
              ? 'visited-page'
              : 'w3-opacity-less',
          ]"
        >
          <a href="#">Resume Builder</a>
        </li>
        <li v-else :class="[Page == 12 ? 'current-page' : 'visited-page']">
          <a href="#">Resume Builder</a>
        </li>
      </ul>
    </div>
  </li>
</template>

<script>
import store from "../../store";
// import Header from '../../mixins/Header';
export default {
  name: "ResumeNameHeader",
  //mixins: [Header],

  data() {
    return {
      resume_name: "",
      Page: localStorage.getItem("page"),
      pageFromDB: "",
    };
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
  // }
  // },

  mounted() {
    this.initheader();
  },
  methods: {
    initheader: function () {
      console.log("userDatasss", this.$store.state.userData);
      if (this.$store.state.userData.page != null) {
        this.pageFromDB = this.$store.state.userData.page;
      }
      console.log("test 123 321");
      console.log(this.$store.state.ResumeName_Data);
      if (this.$store.state.ResumeName_Data != "") {
        if (this.$store.state.ResumeName_Data.data.length > 0) {
          //localStorage.removeItem('resume_name');
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
              //localStorage.setItem('resume_id', value.resume_id)
              console.log("value.resume_id", value.resume_id);
              console.log(resume_id);
              if (value.resume_id == resume_id) {
                that.resume_name = value.name;
              }
            });
          } else {
            if (this.$store.state.ResumeName_Data !== "") {
              if (this.$store.state.ResumeName_Data.data.length > 0) {
                this.resume_name =
                  this.$store.state.ResumeName_Data.data[
                    this.$store.state.ResumeName_Data.data.length - 1
                  ].name;
                console.log(this.resume_name);
              }
            }
          }
        }
      }
    },
  },
};
</script>
