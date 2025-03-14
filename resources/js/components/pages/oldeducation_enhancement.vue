<template>
  <div>
    <headernav
      :education_enhacements="education_enhacements"
      :isLoggedIn="isLoggedIn"
      :currentpage="parseInt(6)"
      :page="parseInt(page)"
    ></headernav>
    <section class="page-resume-editor page-contact-info">
      <div class="container">
        <div
          class="row alert_yak_finder"
          style="max-width: 85%; margin: 20px auto"
        >
          <div class="col-md-2">
            <img :src="EnvPath + 'images/bg/logo.png'" alt="YAK" />
            <!-- <img src="/images/bg/yak-head.png" alt="YAK" /> -->
          </div>
          <div class="col-md-10 col-sm-8">
            <p>
              While employers are most interested in your professional
              accomplishments, it is still a good idea to highlight your
              educational achievements
            </p>
          </div>
          <span class="icon icon_close">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
      <div class="container experience_finder_right_container">
        <div class="row">
          <div class="col-md-2">
            <div class="sidebar experience_finder_sidebar">
              <resumeSidemenu v-bind:page="6" />
              <!-- <ul class="vertical-center">
                <li class="w3-opacity-less visited-page">
                  <i><img :src="EnvPath+'images/logo/finder.png'" /></i> Experience Finder
                </li>
                <li
                  v-if="this.$store.state.grad_Date == true || this.$store.state.AC2 == true"
                >
                  <i
                    style="
                      padding-left: 6.82px !important;
                      padding-right: 6.82px !important;
                    "
                    ><img :src="EnvPath+'images/logo/education-ench.png'"
                  /></i>
                  <span class="edu_first"
                    >Education<br />
                    <span>Enhancements</span></span
                  >
                </li>
                <li class="w3-opacity-less">
                  <i style="padding-top: 4px"
                    ><img :src="EnvPath+'images/logo/job-description.png'"
                  /></i>
                  Job Descriptions
                </li>
                <li class="w3-opacity-less">
                  <i style="background: rgb(204, 204, 204)"
                    ><img :src="EnvPath+'images/logo/skills.png'"
                  /></i>
                  Skills
                </li>
                <li class="w3-opacity-less">
                  <i style="background: rgb(204, 204, 204)"
                    ><img :src="EnvPath+'images/logo/endorsment.png'"
                  /></i>
                  Endorsements
                </li>
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
              </ul> -->
            </div>
          </div>
          <div
            class="col-md-10 grid-container experience_finder_rightside"
            v-if="
              this.$store.state.grad_Date == true ||
                this.$store.state.AC2 == true
            "
          >
            <div class="resume-editor-div">
              <h2>
                <span class="icon">
                  <i class="fas fa-graduation-cap"></i>
                </span>
                Education Enhancements
              </h2>
              <div
                class="row"
                style="max-width: 750px; margin: 0px auto !important"
              >
                <div
                  class="
                    col-md-12 col-sm-12
                    group
                    mr-2
                    education_enhacement_content_section
                  "
                  style="margin-top: 20px"
                >
                  <div class="" v-if="this.$store.state.isGrade == true">
                    <div
                      class="education_enhancement_sections"
                      v-for="(input, k) in this.$store.state.SchoolData"
                      :key="k"
                    >
                      <div
                        v-if="input.name !== null"
                        class="edu_section_heading"
                      >
                        GPA and Minors for {{ input.name }}
                      </div>
                      <div v-else class="edu_section_heading">
                        GPA and Minors for {{ input.school }}
                      </div>
                      <div class="edu_section_content">
                        <div class="edu_fields_section">
                          <label>Overall GPA:</label>
                          <input
                            type="text"
                            value=""
                            v-on:blur="insertData(k)"
                            class="gpa-field"
                            v-model="overallgpa[k]"
                          />
                          <span class="of-gpa">of</span>
                          <input
                            type="text"
                            value=""
                            v-on:blur="insertData(k)"
                            class="gpa-field"
                            v-model="totaloverallgpa[k]"
                          />
                        </div>
                        <div class="edu_fields_section">
                          <label>Major GPA:</label>
                          <input
                            type="text"
                            value=""
                            v-on:blur="insertData(k)"
                            class="gpa-field"
                            v-model="majorgpa[k]"
                          />
                          <span class="of-gpa">of</span>
                          <input
                            type="text"
                            value=""
                            v-on:blur="insertData(k)"
                            class="gpa-field"
                            v-model="totalmajorgpa[k]"
                          />
                        </div>
                        <div class="edu_fields_section edu_fields_section_more">
                          <div
                            class="edu_fields_section col-2"
                            v-tooltip="tooltipData"
                          >
                            <label
                              ><img
                                :src="EnvPath + 'images/logo/yak-icon.png'"
                                style="margin-right: 2px"
                              />
                              Minor:</label
                            >
                          </div>
                          <div
                            class="minor-field-section float-right col-10"
                            v-for="(input, i) in minor[k]"
                            :key="i"
                          >
                            <input
                              type="text"
                              value=""
                              v-on:blur="insertData(k)"
                              name="minor-field-1"
                              v-on:keyup="addMinorOnKey(k, i)"
                              v-model="input.name"
                              class="minor-text-field"
                            />
                            <span
                              class="icon removebtn remove_honor_field"
                              @click="removeMinor(k, i)"
                              v-show="i || (!i && minor.length > 1 && i !== 0)"
                              ><i class="fa fa-minus"></i
                            ></span>
                            <span
                              class="icon"
                              @click="addMinor(k, i)"
                              v-show="i == 0"
                              ><i class="fa fa-plus"></i
                            ></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--//for loop end-->
                  </div>
                  <div
                    class="education_enhancement_sections"
                    v-if="this.$store.state.AC2 == true"
                  >
                    <div class="edu_section_heading">
                      <img
                        :src="EnvPath + 'images/logo/yak-icon.png'"
                        v-tooltip="this.$store.state.tips[1]['tip']"
                      />Credits Completed for [ABC School]
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section">
                        <input
                          type="text"
                          value=""
                          v-on:blur="insertData()"
                          @keypress="isNumber($event)"
                          class="credits-text-field"
                          placeholder="e.g. Completed 37 credits toward a bachelors degree"
                          v-model="credits_completed"
                        />
                      </div>
                    </div>
                  </div>
                  <div
                    class="education_enhancement_sections"
                    v-if="this.$store.state.isGrade == true"
                  >
                    <div class="edu_section_heading">
                      <img
                        v-tooltip="this.$store.state.tips[3]['tip']"
                        :src="EnvPath + 'images/logo/yak-icon.png'"
                      />Honors and Academic Achievements
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_honors_fields_more">
                        <div
                          class="minor-field-section float-right"
                          style="width: 100%"
                          v-for="(input, k) in academic_achievement"
                          :key="k"
                        >
                          <input
                            type="text"
                            @blur="totaloverallgpa(e)"
                            v-model="education.totaloverallgpa"
                            class="gpa-field"
                            placeholder="4.0"
                          />
                          <span
                            class="icon removebtn remove_honor_field"
                            @click="removeAcademicAchievement(k)"
                            v-show="
                              k ||
                                (!k &&
                                  academic_achievement.length > 1 &&
                                  k !== 0)
                            "
                          >
                            <li>
                              <input
                                @blur="
                                  changeMinor(e, m, sminor.id, sminor.name)
                                "
                                style="
                                  width: 88% !important;
                                  display: unset;
                                  float: none !important;
                                "
                                class="minor-text-field"
                                type="text"
                                v-model="sminor.name"
                              />
                              <span
                                style="border: 2px solid #f94848"
                                class="icon add_more_minor_fields"
                              >
                                <a
                                  @click="removeMinor(e, m, sminor.id)"
                                  href="javascript:void(0)"
                                >
                                  <i style="color: red" class="fa fa-minus"></i>
                                </a>
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div
                      v-if="education.credits_completed"
                      class="education_enhancement_sections"
                    >
                      <div class="edu_section_heading edu_section_heading_logo">
                        <img
                          :src="EnvPath + 'images/bg/help.png'"
                          v-tooltip="credit_completed_tip"
                        />
                        Credits Completed for [{{ education.school }}]
                      </div>
                      <div class="edu_section_content">
                        <div class="edu_fields_section">
                          <input
                            @blur="update_credits_completed_phrase(e)"
                            v-model="education.credits_completed_phrase"
                            type="text"
                            value
                            class="credits-text-field"
                            placeholder="e.g. Completed 37 credits toward a bachelors degree"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="education_enhancement_sections"
                    v-if="this.$store.state.isGrade == true"
                  >
                    <div class="edu_section_heading">
                      <img
                        :src="EnvPath + 'images/logo/yak-icon.png'"
                        v-tooltip="this.$store.state.tips[2]['tip']"
                      />Societies, Clubs and Organizations
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_socities_fields_more">
                        <div class="minor-field-section" style="width: 100%">
                          <input
                            v-on:keyup.enter="addOrganizations()"
                            type="text"
                            v-model="txtOrganizations"
                            name="society-field-1"
                            class="minor-text-field"
                          />
                          <!--onKeyPress="if(event.keyCode==13){this.addMinorField();}" -->
                          <span
                            class="icon removebtn remove_honor_field"
                            @click="removeClubsOrganizations(k)"
                            v-show="
                              k ||
                                (!k &&
                                  clubs_organizations.length > 1 &&
                                  k !== 0)
                            "
                            ><i class="fa fa-minus"></i
                          ></span>
                          <span
                            class="icon"
                            @click="addClubsOrganizations(k)"
                            v-show="k == 0"
                            ><i class="fa fa-plus"></i
                          ></span>
                        </div>
                      </div>
                    </div>
                    <div>
                      <ul
                        v-for="(organization, o) in organizations"
                        :key="o"
                        class="minor-field-section"
                        style="
                          list-style: none;
                          text-align: left;
                          padding-left: 21px;
                          width: 97%;
                        "
                      >
                        <li>
                          <input
                            @blur="
                              changeOrganization(
                                a,
                                organization.id,
                                organization.name
                              )
                            "
                            class="minor-text-field"
                            type="text"
                            v-model="organization.name"
                          />
                          <span
                            style="border: 2px solid #f94848"
                            class="icon add_more_minor_fields"
                          >
                            <a
                              @click="removeOrganization(o, organization.id)"
                              href="javascript:void(0)"
                            >
                              <i style="color: red" class="fa fa-minus"></i>
                            </a>
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div
                  class="text-center"
                  style="display: block; margin: 25px auto 15px"
                >
                  <button class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right">
                    <span style="margin-left: 54px;">Next</span>
                    <span class="pl-1"
                      ><i class="next-icon fas fa-chevron-right"></i
                    ></span>
                  </button>
                </div>
                <!-- <button data-v-c64f6442="" type="button" class="btn btn-block" style="border: 3px solid rgb(244, 244, 245); color: rgb(223, 223, 223); padding: 11px 0px; font-size: 18px; margin-top:20px; margin-bottom:5px; border-radius: 6px;">+Add New</button>-->
              </div>
            </div>
            <div class="resume-bottom">
              <div class="row mt-3">
                <div class="col-md-7 col-sm-12">
                  <ul>
                    <li>
                      <a href>
                        <strong>Sitemap</strong>
                      </a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href>
                        <strong>Privacy Policy</strong>
                      </a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href>
                        <strong>Terms of Use</strong>
                      </a>
                      <i
                        class="fas fa-circle"
                        style="color: rgb(102, 105, 109); font-size: 25%"
                      ></i>
                    </li>
                    <li>
                      <a href>
                        <strong>About Us</strong>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-5 col-sm-12">
                  <p class="text-center">
                    2024 Resume Yak. All rights reserved
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Common from "../../mixins/Common";
import store from "../../store";
import { environment_api } from "../../env";
import resumeSidemenu from "./resumeSidemenu";
import sidemenu from "../sidemenu";
import headernav from "./header_nav";

export default {
  name: "education_enhancement",
  mixins: [Common],

  data() {
    return {
      EnvPath: environment_api.api_url,
      tooltipData: "",
      credits_completed: "",
      error: false,
      errors: {},
      success: false,
      isProgress: false,
      x: 1,
      i: 0,
      overallgpa: [],
      majorgpa: [],
      totaloverallgpa: [],
      totalmajorgpa: [],
      minor: [],
      academic_achievement: [
        {
          name: "",
        },
      ],
      clubs_organizations: [
        {
          name: "",
        },
      ],
      closeBtn: true,
    };
  },
  components: {
    resumeSidemenu,
    sidemenu,
    headernav,
  },
  mounted() {
    console.log("%%%%%%%%" + this.$store.state.contact_Data.page);
    console.log(this.$store.state.contact_Data);
    if (
      localStorage.getItem("resume_id") != "" ||
      localStorage.getItem("resume_id") != undefined
    ) {
      this.resume_id = localStorage.getItem("resume_id");
    } else if (this.$store.state.ResumeName_Data !== "") {
      if (this.$store.state.ResumeName_Data.data.length > 0) {
        this.resume_id =
          this.$store.state.ResumeName_Data.data[
            this.$store.state.ResumeName_Data.data.length - 1
          ].resume_id;
      }
    }
    //update

    axios
      .get(this.EnvPath + "education_enhancement2")
      .then((response) => {
        store.commit("EducationEnhancementData", response.data);
        console.log("user_id " + this.$store.state.userData.user_id);
        axios
          .get(
            this.EnvPath +
              "get-education-enhancement/" +
              this.$store.state.userData.user_id +
              "/" +
              this.resume_id
          )
          .then(({ data }) => {
            if (data.status == 1) {
              this.educations = data.educations;
              this.achivements = data.academic_achivements;
              this.organizations = data.clubs_organizations;
              this.minor_tip = data.minor_tip;
              this.credit_completed_tip = data.credit_completed_tip;
              this.academic_achievements_tip = data.academic_achievements_tip;
              this.organization_tip = data.organization_tip;
            }
          });
      })
      .catch((error) => console.log(error));

    this.education_enhacements_menu();
  },
  methods: {
    education_enhacements_menu: function () {
      axios
        .get(
          this.EnvPath +
            "education_enhacements_status/" +
            this.$store.state.userData.user_id
        )
        .then(({ data }) => {
          if (data.status == 1) {
            if (data.count > 0) {
              this.education_enhacements = true;
            } else {
              this.education_enhacements = false;
            }
          }
        });
    },
    btn_education_enhancement_next: function () {
      this.$router.push({ name: "job_descriptions" });
    },
    addAchivements: function () {
      axios
        .post(this.EnvPath + "add_achivements", {
          achivements: this.txtAchivements,
          user_id: this.$store.state.userData.user_id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.achivements[this.achivements.length] = {
              id: data.id,
              name: this.txtAchivements,
            };
            this.txtAchivements = "";
          }
        });
    },
    changeAchivements: function (a, id, name) {
      axios
        .post(this.EnvPath + "change_achivements", {
          achivement_id: id,
          achivement: name,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.achivements.name = name;
          }
        });
    },
    removeAchivements: function (a, id) {
      axios
        .post(this.EnvPath + "remove_achivements", {
          achivement_id: id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.achivements.splice(a, 1);
          }
        });
    },
    addOrganizations: function () {
      axios
        .post(this.EnvPath + "add_organizations", {
          organizations: this.txtOrganizations,
          user_id: this.$store.state.userData.user_id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.organizations[this.organizations.length] = {
              id: data.id,
              name: this.txtOrganizations,
            };
            this.txtOrganizations = "";
          }
        });
    },
    changeOrganization: function (o, id, name) {
      axios
        .post(this.EnvPath + "change_organizations", {
          organization_id: id,
          organization: name,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.organizations.name = name;
          }
        });
    },
    removeOrganization: function (o, id) {
      axios
        .post(this.EnvPath + "remove_organizations", {
          organization_id: id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            this.organizations.splice(o, 1);
          }
        });
    },
    update_credits_completed_phrase: function (e) {
      axios
        .post(this.EnvPath + "update_credits_completed_phrase", {
          user_id: this.$store.state.userData.user_id,
          education_id: this.educations[e].id,
          credits_completed_phrase: this.educations[e].credits_completed_phrase,
        })
        .then(({ data }) => {
          if (data.success == true) {
          }
        });
    },
    overallgpa: function (e) {
      //this.educations[e].overallgpa
      axios
        .post(this.EnvPath + "update_overallgpa", {
          user_id: this.$store.state.userData.user_id,
          education_id: this.educations[e].id,
          overallgpa: this.educations[e].overallgpa,
        })
        .then(({ data }) => {
          if (data.success == true) {
          }
        });
    },
    totaloverallgpa: function (e) {
      axios
        .post(this.EnvPath + "update_totaloverallgpa", {
          user_id: this.$store.state.userData.user_id,
          education_id: this.educations[e].id,
          totaloverallgpa: this.educations[e].totaloverallgpa,
        })
        .then(({ data }) => {
          if (data.success == true) {
          }
        });
    },
    majorgpa: function (e) {
      axios
        .post(this.EnvPath + "update_majorgpa", {
          user_id: this.$store.state.userData.user_id,
          education_id: this.educations[e].id,
          majorgpa: this.educations[e].majorgpa,
        })
        .then(({ data }) => {
          if (data.success == true) {
          }
        });
    },
    totalmajorgpa: function (e) {
      axios
        .post(this.EnvPath + "update_totalmajorgpa", {
          user_id: this.$store.state.userData.user_id,
          education_id: this.educations[e].id,
          totalmajorgpa: this.educations[e].totalmajorgpa,
        })
        .then(({ data }) => {
          if (data.success == true) {
          }
        });
    },
    changeMinor: function (e, m, id, name) {
      axios
        .post(this.EnvPath + "change_minor", {
          minor_id: id,
          minor: name,
        })
        .then(({ data }) => {
          this.educations[e].minor.name = name;
          console.log("Change minor");
        });
    },
    removeMinor: function (e, m, id) {
      axios
        .post(this.EnvPath + "remove_minor", {
          minor_id: id,
        })
        .then(({ data }) => {
          this.educations[e].minor.splice(m, 1);
          console.log("Remove minor");
        });
    },
    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    insertData: function () {
      this.x = 0;
      var mID = 0;
      console.log(this.$store.state.SchoolData);
      for (var i = 0; i < this.$store.state.SchoolData.length; i++) {
        axios
          .post(this.EnvPath + "add_education_enhancement", {
            user_id: this.$store.state.userData.user_id,
            education_id: this.$store.state.SchoolData[i].id,
            minor_id: this.$store.state.minorDate[i][mID].id,
            overallgpa: this.overallgpa[i],
            majorgpa: this.majorgpa[i],
            totaloverallgpa: this.totaloverallgpa[i],
            totalmajorgpa: this.totalmajorgpa[i],
            minor: this.minor[i],
            credits_completed: this.credits_completed,
            academic_achievement: this.academic_achievement,
            clubs_organizations: this.clubs_organizations,
            token: this.$store.state.token,
          })
          .then((response) => {
            this.isProgress = true;
            if (response.data.success == true) {
              console.log("response.data", response.data);
              setTimeout(() => {
                this.isProgress = false;
                store.commit("LoginUser", response.data);
              }, 10);
            }
          })
          .catch((error) => {
            this.isProgress = false;
            this.error = true;
            this.errors = error.response.data.errors;
          });
      }
    },

    addMinorOnKey: function (k, i) {
      this.x++; //counter increment
      if (this.x == 2) {
        if (this.minor[k][this.minor[k].length - 1]["name"] !== "") {
          this.minor[k].push({ name: "" });
        }
      }
    },

    addAcademicAchievementOnKey: function (index) {
      this.x++; //counter increment
      if (this.x == 2) {
        if (
          this.academic_achievement[this.academic_achievement.length - 1][
            "name"
          ] !== ""
        ) {
          this.academic_achievement.push({ name: "" });
        }
      }
    },

    addClubsOrganizationsOnKey: function (index) {
      this.x++; //counter increment
      if (this.x == 2) {
        if (
          this.clubs_organizations[this.clubs_organizations.length - 1][
            "name"
          ] !== ""
        ) {
          this.clubs_organizations.push({ name: "" });
        }
      }
    },

    addMinor(k, i) {
      if (this.minor[k][this.minor[k].length - 1]["name"] !== "") {
        this.minor[k].push({ name: "" });
      }
    },
    removeMinor(k, i) {
      this.insertData();
      this.x = 0;
      this.minor[k].splice(i, 1);
    },

    addAcademicAchievement(index) {
      console.log(
        this.academic_achievement[this.academic_achievement.length - 1]
      );
      if (
        this.academic_achievement[this.academic_achievement.length - 1][
          "name"
        ] !== ""
      ) {
        this.academic_achievement.push({ name: "" });
      }
    },
    removeAcademicAchievement(index) {
      this.insertData();
      this.x = 0;
      this.academic_achievement.splice(index, 1);
    },
    addClubsOrganizations(index) {
      if (
        this.clubs_organizations[this.clubs_organizations.length - 1][
          "name"
        ] !== ""
      ) {
        this.clubs_organizations.push({ name: "" });
      }
    },
    removeClubsOrganizations(index) {
      this.insertData();
      this.x = 0;
      this.clubs_organizations.splice(index, 1);
    },
    close: function (event) {
      console.log("this.$store.state.grad_Date", this.$store.state);
      this.closeBtn = !this.closeBtn;
    },

    getEducationEnhancement() {
      axios
        .get(this.EnvPath + "education_enhancement")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
          console.log("user_data", response.data);
        })
        .catch((error) => console.log(error));
    },
  },

  mounted() {
    console.log("userData11 == " + this.$store.state.userData);
    localStorage.setItem("page", 6);
    this.getEducationEnhancement();
    $(".my_resumes").removeClass("active_nav");
    $(".has_sub_nav_my_profile").removeClass("active_nav");
    // console.log('minor data',this.$store.state.minorDate);
    // console.log('minor data',this.$store.state.minorDate[0][0].minor);
    this.tooltipData = this.$store.state.tips[0]["tip"];
    this.overallgpa = this.$store.state.userData.overallgpa;
    this.majorgpa = this.$store.state.userData.majorgpa;
    this.totaloverallgpa = this.$store.state.userData.totaloverallgpa;
    this.totalmajorgpa = this.$store.state.userData.totalmajorgpa;
    this.credits_completed = this.$store.state.userData.credits_completed;
    var minordata = this.$store.state.minorDate;
    var minorNew = [];
    // var minors = this.$store.state.minorDate.minor;
    console.log(this.$store.state.minorDate);
    let m = 0;
    minordata.map(function (values, key) {
      var minorArr = values[0].minor.split(",");
      var arraysMinor = [];
      minorArr.map(function (value, key) {
        var array = { name: value };
        arraysMinor.push(array);
      });
      minorNew.push(arraysMinor);
      m++;
    });
    this.minor = minorNew;

    //academic_achievements start here
    var academic_achievements = this.$store.state.userData.academic_achievement;
    var academic_achievementArr = academic_achievements.split(",");

    var arraysAcademicAchievement = [];
    academic_achievementArr.map(function (value, key) {
      var array = { name: value };
      arraysAcademicAchievement.push(array);
    });
    this.academic_achievement = arraysAcademicAchievement;

    //clubs_organizationss start here
    var clubs_organizationss = this.$store.state.userData.clubs_organizations;
    var clubs_organizationsArr = clubs_organizationss.split(",");

    var arraysClubsOrganizations = [];
    clubs_organizationsArr.map(function (value, key) {
      var array = { name: value };
      arraysClubsOrganizations.push(array);
    });
    this.clubs_organizations = arraysClubsOrganizations;

    //overallgpas start here
    var overallgpas = this.$store.state.SchoolData;
    var arraysoverallgpas = [];
    overallgpas.map(function (value, key) {
      var array = value.overallgpa;
      arraysoverallgpas.push(array);
    });
    this.overallgpa = arraysoverallgpas;

    //majorgpas start here
    var majorgpas = this.$store.state.SchoolData;
    var arraysmajorgpas = [];
    majorgpas.map(function (value, key) {
      var array = value.majorgpa;
      arraysmajorgpas.push(array);
    });
    this.majorgpa = arraysmajorgpas;

    //totaloverallgpas start here
    var totaloverallgpas = this.$store.state.SchoolData;
    var arraystotaloverallgpas = [];
    totaloverallgpas.map(function (value, key) {
      var array = value.totaloverallgpa;
      arraystotaloverallgpas.push(array);
    });
    this.totaloverallgpa = arraystotaloverallgpas;

    //totalmajorgpas start here
    var totalmajorgpas = this.$store.state.SchoolData;
    var arraystotalmajorgpas = [];
    totalmajorgpas.map(function (value, key) {
      var array = value.totalmajorgpa;
      arraystotalmajorgpas.push(array);
    });
    this.totalmajorgpa = arraystotalmajorgpas;
  },
  beforeMount() {
    this.loadResumes();
  },
};
</script>
