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
              Provide your reaction to the next several statements and I will
              recommend which resume type will be the best fit for your
              situation.
            </p>
            <p style="font-weight: 600">
              The functional resume type is a paid feature. If you are a
              cheapskate, then you can just select the chronological format.
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
              :page="parseInt(10)"
              :education_enhacements="education_enhacements"
              step="2"
            ></sidemenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div class="resume-editor-div">
              <h2>
                <span class="icon" style="font-size: inherit !important">
                  <img src="images/logo/resume_type.jpg" />
                </span>
                Resume Type
              </h2>
              <div
                class="row"
                style="max-width: 780px; margin: 0px auto !important"
              >
                <div
                  v-for="(single_question, e) in resume_type_questions"
                  :key="e"
                  class="selection_resume_options"
                >
                  <p>{{ single_question.question }}</p>
                  <div class="questions_options_list">
                    <div
                      class="custom-control custom-radio form-check form-check-inline resume_type_radio"
                    >
                      <input
                        v-on:change="disagree(e, 100)"
                        type="radio"
                        :id="'customRadio' + e"
                        value="option2"
                        :name="'my_work' + e"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        :for="'customRadio' + e"
                        class="custom-control-label form-check-label"
                        >I strongly disagree</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline resume_type_radio"
                    >
                      <input
                        v-on:change="disagree(e, 50)"
                        type="radio"
                        :id="'customRadio' + e"
                        value="option3"
                        :name="'my_work' + e"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        :for="'customRadio' + e"
                        class="custom-control-label form-check-label"
                        >I disagree</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline resume_type_radio"
                    >
                      <input
                        type="radio"
                        :id="'customRadio' + e"
                        value="option4"
                        :name="'my_work' + e"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        :for="'customRadio' + e"
                        class="custom-control-label form-check-label"
                        >I’m neutral</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline resume_type_radio"
                    >
                      <input
                        v-on:change="agree(e, 50)"
                        type="radio"
                        :id="'customRadio' + e"
                        value="option5"
                        :name="'my_work' + e"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        :for="'customRadio' + e"
                        class="custom-control-label form-check-label"
                        >I agree</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline resume_type_radio"
                    >
                      <input
                        v-on:change="agree(e, 100)"
                        type="radio"
                        :id="'customRadio' + e"
                        value="option6"
                        :name="'my_work' + e"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        :for="'customRadio' + e"
                        class="custom-control-label form-check-label"
                        >I strongly agree</label
                      >
                    </div>
                  </div>
                </div>

                <p
                  v-if="
                    Math.round(
                      (functional / (chronological + functional)) * 100 * 100
                    ) /
                      100 >=
                      75 && score.length >= 3
                  "
                  style="
                    color: #767676;
                    font-size: 16px;
                    font-family: 'Hind', sans-serif;
                    margin-top: 15px;
                  "
                >
                  Based on your answers, I strongly recommend you choose the
                  functional resume format. It will put a greater amount of
                  focus on your accomplishments and less focus on your work
                  history.
                </p>
                <p
                  v-else-if="
                    Math.round(
                      (functional / (chronological + functional)) * 100 * 100
                    ) /
                      100 >
                      50 && score.length >= 3
                  "
                  style="
                    color: #767676;
                    font-size: 16px;
                    font-family: 'Hind', sans-serif;
                    margin-top: 15px;
                  "
                >
                  Based on your answers, I recommend you choose the functional
                  resume format. It will put a greater amount of focus on your
                  accomplishments and less focus on your work history.
                </p>
                <p
                  v-else-if="
                    Math.round(
                      (chronological / (chronological + functional)) * 100 * 100
                    ) /
                      100 >=
                      75 && score.length >= 3
                  "
                  style="
                    color: #767676;
                    font-size: 16px;
                    font-family: 'Hind', sans-serif;
                    margin-top: 15px;
                  "
                >
                  Based on your answers, I strongly recommend you choose the
                  chronological resume format. This is the most common format
                  used for resumes and a solid fit for your situation.
                </p>
                <p
                  v-else-if="
                    Math.round(
                      (chronological / (chronological + functional)) * 100 * 100
                    ) /
                      100 >=
                      50 && score.length >= 3
                  "
                  style="
                    color: #767676;
                    font-size: 16px;
                    font-family: 'Hind', sans-serif;
                    margin-top: 15px;
                  "
                >
                  Based on your answers, I recommend you choose the
                  chronological resume format. This is the most common format
                  used for resumes and a solid fit for your situation.
                </p>
                <p
                  v-if="selected_type == 'chronological'"
                  class="alert alert-warning text-center"
                  style="
                    font-size: 14px;
                    margin-bottom: -10px;
                    color: #857b26 !important;
                  "
                >
                  You have already selected the Chronological resume format. If
                  you change to the Functional format, you will lose any changes
                  you have made to the work history section of your resume.
                </p>
                <p
                  v-if="selected_type == 'functional'"
                  class="alert alert-warning text-center"
                  style="
                    font-size: 14px;
                    margin-bottom: -10px;
                    color: #857b26 !important;
                  "
                >
                  You have already selected the Functional resume format. If you
                  change to the Chronological format, you will lose any changes
                  you have made to the work history section of your resume.
                </p>
                <div
                  class="text-center buttons_function_chro_container"
                  style="display: block; margin: 25px auto 15px"
                >
                  <button
                    @click="btnFunctional"
                    class="btn-rounded mt-4 btnPlusButton_White mb-2"
                    v-bind:class="{
                      btnPlusButton_White:
                        functional <= chronological ||
                        (functional == 0 && chronological == 0),
                      btnPlusButton_White_selected:
                        functional > chronological && functional != 0,
                      'btn-solid-chronological': functional > chronological,
                    }"
                  >
                    <span class="plus_part">Plus</span><span>Functional</span>
                    <span
                      v-if="chronological + functional > 0"
                      style="font-weight: normal"
                    >
                      ({{
                        Math.round(
                          (functional / (chronological + functional)) * 100
                        )
                      }}%)
                    </span>
                  </button>

                  <button
                    @click="btnChronological"
                    class="btnonlyBorder btn-rounded mt-4 mb-2"
                    v-bind:class="{
                      btnonlyBorder_selected:
                        functional <= chronological ||
                        (functional == '0' && chronological == '0'),
                      btnonlyBorder:
                        functional > chronological && functional != 0,
                      'btn-solid-chronological': chronological > functional,
                    }"
                  >
                    Chronological
                    <span
                      v-if="chronological + functional > 0"
                      style="font-weight: normal"
                    >
                      ({{
                        Math.round(
                          (chronological / (chronological + functional)) * 100
                        )
                      }}%)
                    </span>
                  </button>
                  <br />
                  <a
                    href="#"
                    class="see_example_link see_example_link_first see-example-resumetype"
                    style="padding: 5px 60px 5px 0px; color: #d3d3d3"
                    >See example</a
                  >
                  <a
                    href="#"
                    style="color: #d3d3d3; padding: 5px 0px 5px 50px"
                    class="see_example_link see-example-resumetype"
                    >See example</a
                  >
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
import { mapGetters } from "vuex";
var querystring = require("querystring");
export default {
  name: "education_enhancement",
  mixins: [Common],

  data() {
    return {
      EnvPath: environment_api.api_base_url,
      resume_id: 0,
      isLoggedIn: this.$store.state.isLoggedIn,
      // page: this.$store.state.contact_Data.page,
      page: "6",
      education_enhacements: false,
      resume_type_questions: [],
      resume_type: "chronological",
      chronological: 0.0,
      functional: 0.0,
      score: [],
      selected_type: false,
    };
  },
  components: {
    resumeSidemenu,
    sidemenu,
    headernav,
  },
  mounted() {
    store.commit("storeCurrentPage", 10);
    localStorage.setItem("CurrentPage", 10);
    // this.getEducationEnhancement();
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

    axios
      .get(this.EnvPath + "get_all_types/" + this.resume_id)
      .then((response) => {
        //console.log("^^^^^^^^^^^^^^^^^^^^^^^^^^^");
        //console.log(response);
        if (response.data.status == 1) {
          console.log(response.data.data);
          this.resume_type_questions = response.data.data;
          this.selected_type = response.data.selected_type;
        }
      })
      .catch((error) => console.log(error));
    this.education_enhacements_menu();
  },
  computed: {
    ...mapGetters(["getUserData", "getCurrentResume"]),
  },
  methods: {
    getEducationEnhancement() {
      axios
        .get(this.EnvPath + "education_enhancement2")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
        })
        .catch((error) => console.log(error));
    },
    feildTipHandler() {
      $(".alert_yak_finder").fadeOut();
    },
    alredy_have_type() {
      //hhjgj
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
    update_resume_types(resume_type) {
      window.axios
        .post(
          this.EnvPath + "update-resume-type",
          querystring.stringify({
            resume_id: localStorage.getItem("resume_id"),
            resume_type: resume_type,
            chronological_score:
              this.score.length > 0
                ? Math.round(
                    (this.chronological /
                      (this.chronological + this.functional)) *
                      100 *
                      100
                  ) / 100
                : "NULL",
            type_assessment_questions: this.score.length,
          })
        )
        .then(({ data }) => {
          if (data.status == 1) {
            if (resume_type == "chronological") {
              //update before goto next page.

              // if (this.education_enhacements) {
              //   this.$router.push({ name: "education_enhancement" });
              // } else {
              //   this.$router.push({ name: "job_descriptions" });
              // }

              if (this.getCurrentResume.last_step < 11) {
                var data = {
                  r_id: this.getCurrentResume.resume_id,
                  step: 11,
                };
                this.$store.dispatch("updateResumeLastStep", data);
              }
              this.$router.push({ name: "TwoPageResume" });
            } else {
              console.log("paid");
              //paid
              axios
                .get(
                  this.EnvPath +
                    "get-subscription-status/" +
                    this.$store.state.userData.user_id
                )
                .then((response) => {
                  console.log(response.data);
                  if (response.data.paid == 1 && response.data.expired == 0) {
                    //if we alredy have subscription
                    if (this.education_enhacements) {
                      this.$router.push({ name: "education_enhancement" });
                    } else {
                      this.$router.push({ name: "job_descriptions" });
                    }
                  } else {
                    this.$router.push({ name: "subscription" });
                  }
                });
            }
          }
        });
    },
    btnFunctional() {
      this.update_resume_types("functional");
    },
    btnChronological() {
      this.update_resume_types("chronological");
    },
    agree(index, percentage) {
      console.log(this.resume_type_questions[index]);
      this.score[index] = {
        score: this.resume_type_questions[index].weight * (percentage / 100),
        type: this.resume_type_questions[index].agree_type, //need to modify this
      };
      let that = this;
      this.chronological = 0.0;
      this.functional = 0.0;
      this.score.forEach(function (single_score) {
        if (single_score.type == "chronological") {
          that.chronological += single_score.score;
        } else {
          that.functional += single_score.score;
        }
      });
    },
    disagree(index, percentage) {
      console.log(this.resume_type_questions[index]);
      this.score[index] = {
        score: this.resume_type_questions[index].weight * (percentage / 100),
        type: this.resume_type_questions[index].disagree_type,
      };
      let that = this;
      this.chronological = 0.0;
      this.functional = 0.0;
      this.score.forEach(function (single_score) {
        if (single_score.type == "chronological") {
          that.chronological += single_score.score;
        } else if (single_score.type == "functional") {
          that.functional += single_score.score;
        } else {
          //that.functional += single_score.score;
        }
      });
    },
    nutral(index, percentage) {
      //this.score.splice(index, 1);
      this.score[index].score = 0;
    },
  },
};
</script>

<style>
@media (max-width: 430px) {
  a.see_example_link.see_example_link_first.see-example-resumetype {
    padding-top: 0 !important;
    margin-top: -73px;
  }

  .main_navigation li ul {
    box-shadow: none !important;
  }
}

.btn-solid-chronological {
  background-color: #2684fe !important;
  color: #ffffff !important;
}

button.btnonlyBorder.btn-rounded.mt-4.mb-2.btn-solid-chronological:hover {
  background-color: #0d5fca !important;
  border-color: #0d5fca !important;
}
</style>
