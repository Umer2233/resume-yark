<template>
  <div>
    <section class="page-resume-editor page-contact-info">
      <div class="container">
        <div
          class="row alert_yak_finder"
          style="max-width: 85%; margin: 20px auto"
        >
          <div class="col-md-2">
            <img :src="EnvPath + 'images/bg/yak-port.png'" alt="YAK" />
          </div>
          <div class="col-md-10 col-sm-8">
            <p>
              While employers are most interested in your professional
              accomplishments, it is still a good idea to highlight your
              educational achievements
            </p>
          </div>
          <span class="new_icon_close" @click="feildTipHandler()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
      <div class="container experience_finder_right_container">
        <div class="row">
          <div class="col-md-2">
            <sidemenu
              :page="parseInt(9)"
              activePage="job_descriptions"
              step="5"
            ></sidemenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div class="resume-editor-div space-heading-control">
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
                  class="col-md-12 col-sm-12 group mr-2 education_enhacement_content_section"
                  style="margin-top: 20px"
                >
                  <div v-for="(education, e) in educations" :key="e">
                    <div
                      class="education_enhancement_sections job-discription-font-size"
                    >
                      <div class="edu_section_heading">
                        GPA and Minors for [{{ education.school }}]
                      </div>
                      <div class="edu_section_content">
                        <div class="edu_fields_section">
                          <label>Overall GPA:</label>
                          <input
                            id="gpa-number-box"
                            step="0.1"
                            min="0"
                            max="4"
                            @blur="overallgpa(e)"
                            v-model="education.overallgpa"
                            class="gpa-field"
                            @keyup="validateInput($event, e, 'overallgpa')"
                          />
                          <span class="of-gpa">of</span>
                          <input
                            type="text"
                            @blur="totaloverallgpa(e)"
                            v-model="education.totaloverallgpa"
                            class="gpa-field"
                            placeholder="4.0"
                            readonly
                          />
                        </div>
                        <div class="edu_fields_section">
                          <label>Major GPA:</label>
                          <input
                            @blur="majorgpa(e)"
                            id="gpa-number-box"
                            step="0.1"
                            min="0"
                            max="4"
                            v-model="education.majorgpa"
                            @keyup="validateInput($event, e, 'majorgpa')"
                            class="gpa-field"
                          />
                          <span class="of-gpa">of</span>
                          <input
                            type="text"
                            @blur="totalmajorgpa(e)"
                            v-model="education.totalmajorgpa"
                            class="gpa-field"
                            placeholder="4.0"
                            readonly
                          />
                        </div>
                        <div class="edu_fields_section edu_fields_section_more">
                          <div
                            style="width: 100% !important"
                            class="minor-field-section"
                          >
                            <span
                              class="align-edu-endrosment minors-design-mobile"
                            >
                              <div class="minors-box">
                                <img
                                  :src="EnvPath + 'images/bg/help.png'"
                                  style="margin-right: 2px"
                                  v-tooltip="minor_tip"
                                />
                                <span>Minor:</span>
                              </div>
                              <input
                                v-on:keyup.enter="addMinor(e)"
                                v-model="txtMinor[e]"
                                type="text"
                                value
                                name="minor-field-1"
                                class="minor-text-field minor-text-box-control"
                                id="minorInput"
                              />
                            </span>
                            <span
                              class="icon add_more_minor_fields space-control-add-btn"
                            >
                              <a
                                style="text-decoration: none"
                                @click="addMinor(e)"
                                href="javascript:void(0)"
                              >
                                <i class="fa fa-plus"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                        <div>
                          <ul
                            v-for="(sminor, m) in education.minor"
                            :key="m"
                            class="minor-field-section add-minors-box"
                          >
                            <li>
                              <input
                                @blur="
                                  changeMinor(e, m, sminor.id, sminor.name)
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
                  <div class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img
                        :src="EnvPath + 'images/bg/help.png'"
                        v-tooltip="academic_achievements_tip"
                      />Honors and Academic Achievements
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_honors_fields_more">
                        <div class="minor-field-section" style="width: 100%">
                          <input
                            v-on:keyup.enter="addAchivements()"
                            type="text"
                            v-model="txtAchivements"
                            class="minor-text-field education-enhancement-plus-icon"
                            id="achivementsInput"
                          />
                          <span class="icon add_more_hononrs_fields">
                            <a
                              style="text-decoration: none"
                              @click="addAchivements()"
                              href="javascript:void(0)"
                            >
                              <i class="fa fa-plus"></i>
                            </a>
                          </span>
                        </div>
                      </div>
                      <div>
                        <ul
                          v-for="(achivement, a) in achivements"
                          :key="a"
                          class="minor-field-section"
                          style="
                            list-style: none;
                            text-align: left;
                            padding-left: 0;
                            width: 100%;
                          "
                        >
                          <li>
                            <input
                              @blur="
                                changeAchivements(
                                  a,
                                  achivement.id,
                                  achivement.name
                                )
                              "
                              class="minor-text-field"
                              type="text"
                              v-model="achivement.name"
                            />
                            <span
                              style="border: 2px solid #f94848"
                              class="icon add_more_minor_fields"
                            >
                              <a
                                @click="removeAchivements(a, achivement.id)"
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
                  <div class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img
                        :src="EnvPath + 'images/bg/help.png'"
                        v-tooltip="organization_tip"
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
                            class="minor-text-field education-enhancement-plus-icon"
                            id="organizationInput"
                          />
                          <span class="icon add_more_socities_fields">
                            <a
                              style="text-decoration: none"
                              @click="addOrganizations()"
                              href="javascript:void(0)"
                            >
                              <i class="fa fa-plus"></i>
                            </a>
                          </span>
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
                            padding-left: 0;
                            width: 100%;
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
                              class="minor-text-field education-enhancement-plus-icon"
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
                </div>
                <div
                  class="text-center"
                  style="
                    display: block;
                    margin: 25px auto 15px;
                    margin-bottom: 0;
                  "
                >
                  <button
                    @click="btn_education_enhancement_next()"
                    class="btn1 btn-rounded btn-next space-remove-ob-mobile btn-text-arrow-right"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-1">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </button>
                  <!-- <router-link
                    :to="{ name: 'resume_type' }"
                    class="btn1 btn-rounded btn-next mt-4 router-link-no-text-decoration"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-5">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </router-link> -->
                </div>
                <!-- <button data-v-c64f6442="" type="button" class="btn btn-block" style="border: 3px solid rgb(244, 244, 245); color: rgb(223, 223, 223); padding: 11px 0px; font-size: 18px; margin-top:20px; margin-bottom:5px; border-radius: 6px;">+Add New</button>-->
              </div>
            </div>
            <Footer />
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
import Footer from "../includes/Footer.vue";
import { mapGetters } from "vuex";

export default {
  name: "education_enhancement",
  mixins: [Common],

  data() {
    return {
      EnvPath: environment_api.api_base_url,
      educations: [],
      txtMinor: [],
      tooltipData: "",
      credits_completed: "",
      error: false,
      errors: {},
      success: false,
      isProgress: false,
      x: 1,
      i: 0,
      txtAchivements: "",
      txtOrganizations: "",
      achivements: [],
      organizations: [],
      minor_tip: "",
      credit_completed_tip: "",
      academic_achievements_tip: "",
      organization_tip: "",
      resume_id: 0,
      isLoggedIn: this.$store.state.isLoggedIn,
      // page: this.$store.state.contact_Data.page,
      page: "5",
      education_enhacements: false,
      //overallgpa: [],
      //majorgpa: [],
      //totaloverallgpa: [],
      //totalmajorgpa: [],
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
    Footer,
  },
  mounted() {
    store.commit("storeCurrentPage", 9);
    localStorage.setItem("CurrentPage", 9);
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
  computed: {
    ...mapGetters(["getUserData", "getCurrentResume"]),
  },
  methods: {
    validateInput: function ($event, e, type) {
      if (type === "overallgpa") {
        if ($event.target._value > 4.0) {
          this.educations[e].overallgpa = "";
          return;
        }
        this.educations[e].overallgpa = this.educations[e].overallgpa.replace(
          /[^\d.]/g,
          ""
        );
        return;
      }
      if (type === "majorgpa") {
        if ($event.target._value > 4.0) {
          this.educations[e].majorgpa = "";
          return;
        }
        this.educations[e].majorgpa = this.educations[e].majorgpa.replace(
          /[^\d.]/g,
          ""
        );
        return;
      }

      // if (type === "majorgpa") {
      //   const regex = /^(?:[0-3](?:\.\d+)?|4(?:\.0)?)$/;
      //   if (!regex.test(this.educations[e].majorgpa)) {
      //     this.educations[e].majorgpa = "";
      //     return;
      //   }
      // }
    },

    feildTipHandler: function () {
      $(".alert_yak_finder").fadeOut();
    },
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
      if (this.getCurrentResume.last_step < 10) {
        var data = {
          r_id: this.getCurrentResume.resume_id,
          step: 10,
        };
        this.$store.dispatch("updateResumeLastStep", data);
        store.commit("storePageCount", 10);
        localStorage.setItem("pageCount", 10);
        localStorage.setItem("page", 10);
      }

      this.$router.push({ name: "resume_type" });
    },
    addAchivements: function () {
      if (this.txtAchivements === "") {
        var inputField = document.getElementById("achivementsInput");
        inputField.focus();
        return;
      }
      axios
        .post(this.EnvPath + "add_achivements", {
          achivements: this.txtAchivements,
          user_id: this.$store.state.userData.user_id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            var newAchievement = {
              id: data.id,
              name: this.txtAchivements,
            };
            this.achivements.unshift(newAchievement);

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
      if (this.txtOrganizations === "") {
        var inputField = document.getElementById("organizationInput");
        inputField.focus();
        return;
      }
      axios
        .post(this.EnvPath + "add_organizations", {
          organizations: this.txtOrganizations,
          user_id: this.$store.state.userData.user_id,
        })
        .then(({ data }) => {
          if (data.success == true) {
            // this.organizations[this.organizations.length] = {
            //   id: data.id,
            //   name: this.txtOrganizations,
            // };
            var newOrganizations = {
              id: data.id,
              name: this.txtOrganizations,
            };
            this.organizations.unshift(newOrganizations);
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

    addMinorOnKey: function (e) {},

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

    addMinor: function (e) {
      if (this.txtMinor[e] === "" || this.txtMinor.length === 0) {
        var inputField = document.getElementById("minorInput");
        inputField.focus();
        return;
      }

      axios
        .post(this.EnvPath + "add_minor", {
          education_id: this.educations[e].id,
          minor: this.txtMinor[e],
        })
        .then(({ data }) => {
          if (data.success == true) {
            if (!!this.educations[e].minor) {
              this.educations[e].minor.unshift({
                id: data.minor_id,
                name: this.txtMinor[e],
              });
              this.txtMinor[e] = "";
            } else {
              this.educations[e].minor = [];
              this.educations[e].minor[0] = {
                id: data.minor_id,
                name: this.txtMinor[e],
              };
              this.txtMinor[e] = "";
            }
          }
        });
    },

    addAcademicAchievement(index) {
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
      this.closeBtn = !this.closeBtn;
    },

    // getEducationEnhancement() {
    //   axios
    //     .get("/education_enhancement2")
    //     .then((response) => {
    //       store.commit("EducationEnhancementData", response.data);
    //     })
    //     .catch((error) => console.log(error));
    // },
  },
};
</script>

<style>
@media (max-width: 450px) {
  input.minor-text-field.education-enhancement-plus-icon,
  .minor-field-section .minor-text-field {
    width: 82% !important;
  }
  .space-remove-ob-mobile {
    margin-top: 0 !important;
  }
  .resume-editor-div.space-heading-control h2 {
    margin-top: 0;
  }
  .minors-box {
    margin-bottom: 10px;
  }
  .minors-design-mobile {
    flex-direction: column;
    align-items: flex-start;
  }

  .space-control-add-btn {
    margin-top: 45px !important;
  }
  .minor-text-field.minor-text-box-control {
    width: 96% !important;
  }

  .add-minors-box {
    padding-left: 0 !important;
  }
  .edu_section_content ul.minor-field-section.add-minors-box li input {
    width: 83% !important;
    margin-left: 0 !important;
  }
}

.minors-box span {
  font-weight: 600;
  font-size: 16px;
  font-family: "Hind";
  color: #767676;
}

.minor-text-box-control {
  width: 85% !important;
  display: unset;
  float: none !important;
}
.add-minors-box {
  list-style: none;
  text-align: left;
  padding-left: 92px;
  width: 100%;
}
ul.minor-field-section.add-minors-box li input {
  width: 90% !important;
  margin-left: 6px;
  display: unset;
  float: none !important;
}

.minors-box {
  display: flex;
  align-items: center;
}

/* @media (max-width: 993px) { */
.minors-box {
  padding-right: 17px;
}
/* } */
</style>
