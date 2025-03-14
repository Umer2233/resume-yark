<template>
  <div>
    <!-- <headernav
      :education_enhacements="education_enhacements"
      :isLoggedIn="isLoggedIn"
      :currentpage="parseInt(5)"
      :page="parseInt(page)"
    ></headernav> -->
    <section
      class="page-resume-editor page-contact-info remove-space-sides-mobile"
    >
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
              This is the most important part of creating your resume, so don’t
              rush this! Take a break if you need to. Below are questions that
              employers will use to judge whether they think you will be a good
              fit for the job you are applying for. These questions are tailored
              to the position you selected on the last screen, so create a new
              resume for every position you expect to apply for. The more
              questions you answer, the more I will have to work with when
              creating your resume. <br />Start your answers with an action
              word: "Slashed costs by 5,000% by…"
            </p>
          </div>
          <span class="new_icon_close" @click="showHideTip()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
      <div class="container experience_finder_right_container">
        <div class="row">
          <div class="col-md-2">
            <SideMenu
              :page="parseInt(5)"
              activePage="experience_finder"
              step="1"
            ></SideMenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div class="resume-editor-div space-control-top-and-bottom">
              <h2>
                <span class="icon">
                  <i class="fas fa-search-plus"></i>
                </span>
                Experience Finder
              </h2>

              <div
                class="row"
                style="max-width: 750px; margin: 0px auto !important"
              >
                <div
                  class="col-md-12 col-sm-12 group mr-2 experience_finder_content_section"
                  style="margin-top: 20px"
                >
                  <div id="accordionExample">
                    <div
                      v-for="(ExperienceQuestion, index) in ExperienceQuestions"
                      v-bind:key="index"
                      class="accordion accordion_finder"
                    >
                      <h2 v-if="aditionalQuestionIndex == index">
                        Additional Questions
                      </h2>
                      <div class="card finder_card">
                        <div
                          @click="openquestion()"
                          class="card-header finder_head"
                          :id="'heading' + (index + 1)"
                        >
                          <div
                            class="experience-finder-toggle"
                            data-toggle="collapse"
                            :data-target="'#collapse' + (index + 1)"
                            aria-expanded="false"
                            :aria-controls="'collapse' + (index + 1)"
                            @click="activeTab(index)"
                          >
                            <div class="tab-number">
                              <span>{{ index + 1 }}.</span>
                            </div>
                            <div class="tab-content-div" :class="'id-' + index">
                              <p v-if="ExperienceQuestion.profile_question">
                                {{ ExperienceQuestion.profile_question }}
                              </p>
                              <p v-else>{{ ExperienceQuestion.question }}</p>
                              <button
                                v-if="ExperienceQuestion.experience_time > 0"
                                type="button"
                                class="btn btn-link fill_number"
                              >
                                <span>{{
                                  ExperienceQuestion.experience_time
                                }}</span>
                              </button>
                              <button v-else class="btn btn-link" type="button">
                                <i class="fa fa-plus"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div
                          :id="'collapse' + (index + 1)"
                          class="collapse"
                          :aria-labelledby="'heading' + (index + 1)"
                          data-parent="#accordionExample"
                        >
                          <div
                            class="card-body-content acordian-card-experience-finder space-control-on-mobile-acordian-box"
                          >
                            <div
                              v-if="
                                ExperienceQuestion.experience_time < 1 ||
                                edit == true
                              "
                              class="card-body"
                            >
                              <div
                                class="row finder_text"
                                style="padding-left: 5px; padding-right: 5px"
                              >
                                <div class="col-12">
                                  <textarea
                                    @keyup="
                                      experienceDescription($event, index)
                                    "
                                    style="width: 100%"
                                    :value="experience_object[index]"
                                  >
                                  </textarea>
                                  <!-- <textarea
                                    style="width: 100%"
                                    v-model="experince_description"
                                  ></textarea> -->

                                  <span
                                    v-if="
                                      experience_object[index] &&
                                      experience_object[index].length > 50
                                    "
                                    class="label"
                                    :class="
                                      experience_object[index].length > 195
                                        ? 'success-red'
                                        : experience_object[index].length > 130
                                        ? 'success-yellow'
                                        : 'success-green'
                                    "
                                  >
                                    {{
                                      experience_object[index]
                                        .replace(/(^\s*)|(\s*$)/gi, "")
                                        .replace(/[ ]{2,}/gi, " ")
                                        .replace(/\n /, "\n")
                                        .split(" ").length
                                    }}
                                    Words
                                  </span>
                                </div>

                                <div class="col-12 center-box-flex">
                                  <div
                                    class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                  >
                                    <input
                                      class="custom-control-input form-check-input"
                                      type="checkbox"
                                      :id="'made_money' + index"
                                      value="option1"
                                      @click="checkBoxClick('made_money')"
                                      :checked="
                                        experince_type == 'made_money'
                                          ? true
                                          : false
                                      "
                                    />
                                    <button
                                      class="custom-control-label form-check-label hide-btn-specs"
                                      :for="'made_money' + index"
                                      @click="checkBoxClick('made_money')"
                                    >
                                      Made Money
                                    </button>
                                  </div>

                                  <div
                                    class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                  >
                                    <input
                                      class="custom-control-input form-check-input"
                                      type="checkbox"
                                      :id="'more_efficient' + index"
                                      value="option2"
                                      :checked="
                                        experince_type == 'more_efficient'
                                      "
                                      @click="checkBoxClick('more_efficient')"
                                    />
                                    <button
                                      class="custom-control-label form-check-label hide-btn-specs"
                                      :for="'more_efficient' + index"
                                      @click="checkBoxClick('more_efficient')"
                                    >
                                      More Efficient
                                    </button>
                                  </div>

                                  <div
                                    class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                  >
                                    <input
                                      class="custom-control-input form-check-input"
                                      type="checkbox"
                                      :id="'cut_cost' + index"
                                      value="option3"
                                      :checked="experince_type == 'cut_cost'"
                                      @click="checkBoxClick('cut_cost')"
                                    />
                                    <button
                                      class="custom-control-label form-check-label hide-btn-specs"
                                      :for="'cut_cost' + index"
                                      @click="checkBoxClick('cut_cost')"
                                    >
                                      Cut Costs
                                    </button>
                                  </div>
                                  <div
                                    class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                  >
                                    <input
                                      class="custom-control-input form-check-input"
                                      type="checkbox"
                                      :id="'solve_problem' + index"
                                      value="option4"
                                      :checked="
                                        experince_type == 'solve_problem'
                                      "
                                      @click="checkBoxClick('solve_problem')"
                                    />
                                    <button
                                      class="custom-control-label form-check-label hide-btn-specs"
                                      :for="'solve_problem' + index"
                                      @click="checkBoxClick('solve_problem')"
                                    >
                                      Solved a Problem
                                    </button>
                                  </div>
                                  <div
                                    class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                  >
                                    <input
                                      class="custom-control-input form-check-input"
                                      type="checkbox"
                                      :id="'other' + index"
                                      value="option5"
                                      :checked="experince_type == 'other'"
                                      @click="checkBoxClick('other')"
                                    />

                                    <button
                                      class="custom-control-label form-check-label hide-btn-specs"
                                      :for="'other' + index"
                                      @click="checkBoxClick('other')"
                                    >
                                      Other
                                    </button>
                                  </div>
                                </div>

                                <div
                                  class="col-md-5 col-sm-6 job_finder_label space-left-control-mobile"
                                  style="max-width: 280px"
                                >
                                  <p
                                    class="experience-finder-position-font font-size-control-mobile-text"
                                  >
                                    Position this experience relates to:
                                  </p>
                                </div>
                                <div
                                  class="col-md-6 select-arrow-side border-or-arrow-control col-sm-6 job_name_finder inputP55"
                                  :class="
                                    arrowTrue == 'position' ? 'arrowUp' : ''
                                  "
                                >
                                  <select
                                    @click="arrownUpDown('position')"
                                    @mouseleave="
                                      mouseLeaveInputPosition('position')
                                    "
                                    name="job_name"
                                    id
                                    class="select-item select-item-job-name input mouseLeave"
                                    style="
                                      -webkit-appearance: none;
                                      padding-right: 25px !important;
                                    "
                                    v-model="experince_job_name"
                                  >
                                    <option value="0">Select</option>
                                    <option
                                      :value="Job.id"
                                      v-for="(Job, index) in JobDropDown"
                                      v-bind:key="index"
                                    >
                                      {{ Job.position }} ({{ Job.company }})
                                    </option>
                                    <!-- <option value="school_volu_exp">
                                      School / Volunteer Experience
                                    </option> -->
                                  </select>
                                </div>
                              </div>

                              <div
                                class="confirm confirm_finder"
                                style="
                                  text-align: right;
                                  display: flex;
                                  flex-direction: row-reverse;
                                  width: 100%;
                                "
                              >
                                <i
                                  class="fa fa-check-circle"
                                  @click="save(index)"
                                  style="
                                    font-size: 30px;
                                    color: rgb(251, 100, 62);
                                  "
                                ></i>
                                <i
                                  class="fa fa-times-circle"
                                  @click="cancel(index)"
                                  style="
                                    font-size: 30px;
                                    color: rgb(251, 100, 62);
                                  "
                                ></i>
                                <i
                                  v-if="
                                    ExperienceQuestion.experience_time > 0 &&
                                    (edit != true || isnew == false)
                                  "
                                  data-toggle="modal"
                                  @click="delete_exp(index)"
                                  data-target="#exampleModal"
                                  class="fa fa-2x fa fa-trash experience-trash"
                                  style="
                                    border: 1px solid rgb(251, 100, 62);
                                    color: rgb(251, 100, 62);
                                    padding: 4px 6px;
                                    border-radius: 50%;
                                    font-size: 20px;
                                  "
                                ></i>
                              </div>
                            </div>
                            <div
                              v-if="
                                ExperienceQuestion.experience_time > 0 &&
                                edit != true
                              "
                            >
                              <div
                                class="card-body"
                                v-for="(
                                  Experience, k2
                                ) in ExperienceQuestion.Experience"
                                :key="k2"
                              >
                                <div
                                  class="containers"
                                  @click="editQuestion(Experience, index, k2)"
                                >
                                  <div
                                    class="row finder_text"
                                    style="
                                      padding-left: 5px;
                                      padding-right: 5px;
                                    "
                                  >
                                    <div class="col-12 text-left save-text">
                                      <div class="hover-text">
                                        {{ Experience.description }}
                                      </div>
                                      <br />
                                      <span class="hover-text">
                                        <strong
                                          v-if="Experience.type == 'made_money'"
                                          >Made Money</strong
                                        >
                                        <strong
                                          v-if="
                                            Experience.type == 'more_efficient'
                                          "
                                          >More Efficient</strong
                                        >
                                        <strong
                                          v-if="Experience.type == 'cut_cost'"
                                          >Curt Cost</strong
                                        >
                                        <strong
                                          v-if="
                                            Experience.type == 'solve_problem'
                                          "
                                          >Solve a Problem</strong
                                        >
                                        <strong
                                          v-if="Experience.type == 'other'"
                                          >Other</strong
                                        >
                                        <span
                                          v-for="(Job, index) in JobDropDown"
                                          v-bind:key="index"
                                        >
                                          <span
                                            v-if="Job.id == Experience.job_id"
                                          >
                                            as
                                            <strong>{{ Job.position }}</strong>
                                            at
                                            <strong>{{ Job.company }}</strong>
                                          </span>
                                        </span>
                                      </span>
                                      <div class="middle">
                                        <div class="text">
                                          <img
                                            class="edit-image"
                                            :src="
                                              EnvPath + 'images/button/edit.svg'
                                            "
                                            alt
                                          />
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="myDynamicDiv" v-if="dynamicForm">
                              <div v-if="dynamicFormIndex === index">
                                <div
                                  v-for="(form, key) of dynamicFormLoopArray"
                                  :key="key"
                                >
                                  <form-experience-finder-vue
                                    :id="ExperienceQuestion.id"
                                    :formId="index"
                                    :resume_id="resume_id"
                                    :position_id="
                                      ExperienceQuestion.position_id
                                    "
                                    :JobDropDown="JobDropDown"
                                    :ExperienceQuestions="ExperienceQuestions"
                                    @removeCard="index, key"
                                    @dynamicFormAction="hideDynamicForm"
                                    @validationPopUp="showValidatoinPopUp"
                                    @addMoreQuestionsStatus="
                                      addMoreQuestionsStatus
                                    "
                                    @loadExperince="loadExperince"
                                  ></form-experience-finder-vue>
                                </div>
                              </div>
                            </div>
                            <div v-if="edit != true" class="col-12">
                              <button
                                @click="addnew(index)"
                                type="button"
                                class="btn btn-block"
                                style="
                                  border: 3px solid rgb(244, 244, 245);
                                  color: rgb(223, 223, 223);
                                  padding: 8px 0px;
                                  font-size: 18px;
                                  margin-top: 20px;
                                  margin-bottom: 15px;
                                  border-radius: 10px;
                                "
                              >
                                +Add New
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <span
                    v-if="more"
                    class="add-more-question"
                    @click="addMoreQuestionsbtn()"
                    >Add More Questions</span
                  >
                </div>
                <div
                  class="text-center"
                  style="display: block; margin: 25px auto 15px"
                >
                  <!-- <button
                    @click="exp_next()"
                    class="btn1 btn-rounded btn-next mt-4"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-5">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </button> -->
                  <!-- <router-link
                    :to="{ name: 'job_descriptions' }"
                    class="btn1 btn-rounded btn-next mt-4 router-link-no-text-decoration"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-1">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </router-link> -->

                  <button
                    class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right"
                    @click="moveToNextPage()"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-1">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
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

        <!-- popup -->
        <!-- popup validation -->
        <div class="popup-container" v-if="notValid">
          <div class="poup-sub-container">
            <div class="pop-content-section pop_confused_content">
              <div class="container">
                <div class="row">
                  <div class="col-4">
                    <img
                      :src="EnvPath + 'images/logo/Confused.png'"
                      alt="Confused"
                    />
                  </div>
                  <div class="col-8">
                    <h4>Uh oh</h4>
                    <p>
                      You must complete all of the fields to add a new
                      experience.
                    </p>
                    <button @click="closePoup()" class="btnOk btn-rounded">
                      Ok
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup next button -->
        <div class="popup-container" v-if="DeleteData">
          <div class="poup-sub-container">
            <div
              class="pop-content-section pop_confused_content space-control-top-bottom"
            >
              <div class="container">
                <div class="row delete-button-experience-finder-page">
                  <div class="col-4">
                    <img
                      :src="EnvPath + 'images/bg/yak-port.png'"
                      alt="Confused"
                    />
                  </div>
                  <div class="col-8">
                    <h4>Are You Sure?</h4>
                    <p>Are you sure you want to delete this experience?.</p>
                    <div class="flex-control-popup">
                      <button
                        class="btnOption btn-rounded mb-0"
                        @click="deleteNo()"
                        style="float: left"
                      >
                        No
                      </button>
                      <button
                        class="btnOption btn_color_option btn-rounded mb-0"
                        @click="deleteRecourd()"
                        style="float: right"
                      >
                        Yes
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup -->

        <!-- popup for add more question -->
        <div class="popup-container" v-if="nextQuestions">
          <div class="poup-sub-container">
            <div class="pop-content-section pop_confused_content">
              <div class="container">
                <div class="row">
                  <div class="col-4">
                    <img
                      :src="EnvPath + 'images/logo/yak-port.png'"
                      alt="Confused"
                    />
                  </div>
                  <div class="col-8">
                    <h4>More Experiences?</h4>
                    <p>
                      We have only shown you questions related to the position
                      you are seeking. Before moving on, would you like to see
                      all the questions related to the past positions you've
                      held?
                    </p>
                    <button
                      class="btnOption btn-rounded"
                      @click="cancelBtn()"
                      style="float: left"
                    >
                      No Thanks
                    </button>
                    <button
                      class="btnOption btn_color_option btn-rounded"
                      @click="showMeMoreQuestion()"
                      style="float: right"
                    >
                      Show More ?'s
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup -->

        <!-- popup for add more question -->
        <div class="popup-container" v-if="addQuestionBtn">
          <div class="poup-sub-container">
            <div class="pop-content-section pop_confused_content">
              <div class="container">
                <div class="row">
                  <div class="col-4">
                    <img
                      :src="EnvPath + 'images/logo/Confused.png'"
                      alt="Confused"
                    />
                  </div>
                  <div class="col-8">
                    <h4>Are you sure?</h4>
                    <p>
                      Would you like to see all of the questions related to past
                      positions you've held. These questions won't be directly
                      relevant to the positions you are applying for.
                    </p>
                    <div class="flex-style-popup">
                      <button
                        class="btnOption btn-rounded"
                        @click="cancelBtn()"
                        style="float: left"
                      >
                        Cancel
                      </button>
                      <button
                        class="btnOption btn_color_option btn-rounded"
                        @click="showMeMoreQuestion()"
                        style="float: right"
                      >
                        Show More ?'s
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- popup -->
      </div>
    </section>
  </div>
</template>

<script>
// import sidemenu from "../sidemenu";
import SideMenu from "../sidemenu.vue";
import headernav from "./header_nav";
import store from "../../store";
import FormExperienceFinderVue from "../child/FormExperienceFinder.vue";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";

export default {
  name: "experience-finder",

  data() {
    return {
      addNewQuestion: true,
      EnvPath: environment_api.api_base_url,
      arrowTrue: "",
      ExperienceQuestions: [],
      resume_id: 0,
      JobDropDown: [],
      experince_description: "",
      experince_type: "",
      experince_job_name: 0,
      edit: false,
      isnew: true,
      experince_id: 0,
      DeleteData: false,
      addQuestionBtn: false,
      nextQuestions: false,
      deleteIndex: 0,
      notValid: false,
      more: true,
      experince_db_id: 0,
      aditionalQuestionIndex: -1,
      morequestionbutton: false,
      isLoggedIn: this.$store.state.isLoggedIn,
      page: this.$store.state.contact_Data.page,
      education_enhacements: false,
      experience_object: {},
      dynamicForm: false,
      dynamicFormIndex: null,
      dynamicFormLoop: 0,
      dynamicFormLoopArray: [],
      edit_exp_description: "",
    };
  },
  components: {
    SideMenu,
    headernav,
    FormExperienceFinderVue,
  },
  mounted() {
    store.commit("storeCurrentPage", 5);
    localStorage.setItem("CurrentPage", 5);
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
    this.loadExperince();
    this.getJob();
    this.addMoreQuestionsStatus();
    this.education_enhacements_menu();
    // this.getEducationEnhancement();
  },
  computed: {
    ...mapGetters(["getUserData", "getCurrentResume"]),
  },
  methods: {
    arrownUpDown(inputName) {
      if (inputName === "position") {
        this.arrowTrue = inputName;
      }
    },

    mouseLeaveInputPosition(inputName) {
      if (inputName === "position") {
        this.arrowTrue = "";
      }
    },

    getEducationEnhancement() {
      localStorage.setItem("page", 5);
      axios
        .get(this.EnvPath + "education_enhancement2")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
        })
        .catch((error) => console.log(error));
    },
    hideDynamicForm: function () {
      this.addNewQuestion = true;
      this.dynamicFormIndex = null;
    },
    showValidatoinPopUp: function () {
      this.notValid = true;
    },
    moveToNextPage: function () {
      if (this.getCurrentResume && this.getCurrentResume.last_step < 6) {
        var data = {
          r_id: this.getCurrentResume.resume_id,
          step: 6,
        };
        this.$store.dispatch("updateResumeLastStep", data);
        store.commit("storePageCount", 6);
        localStorage.setItem("pageCount", 6);
      }

      this.$router.push({ name: "job_descriptions" });
    },
    removeCard: function () {},
    activeTab: function (index) {
      this.addNewQuestion = true;
      if ($(".id-" + index).hasClass("activeTable")) {
        $(".id-" + index).removeClass("activeTable");
      } else {
        $(".id-" + index).addClass("activeTable");
      }
    },
    showHideTip: function () {
      $(".alert_yak_finder").fadeOut();
    },
    experienceDescription: function (e, index) {
      let value = e.target?.value;

      let experience_obj = {
        [index]: value,
      };

      let objectData = this.experience_object;

      this.experience_object = { ...objectData, ...experience_obj };
      this.$store.dispatch("ExperienceFinderObject", this.experience_object);
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
    addMoreQuestionsbtn: function () {
      this.addQuestionBtn = true;
      this.morequestionbutton = true;
    },
    addMoreQuestionsStatus: function () {
      var data = {
        resume_id: this.resume_id,
      };
      axios
        .post(this.EnvPath + "check-next-condition", data)
        .then(({ data }) => {
          if (data.status == 1) {
            if (data.expand_experienc == 1) {
              this.more = false;
              this.addMoreQuestions(0);
            } else {
              this.more = true;
            }
          }
        });
    },
    showMeMoreQuestion: function () {
      this.addMoreQuestions(1);
      this.addQuestionBtn = false;
      this.nextQuestions = false;
    },
    cancelBtn: function () {
      this.addQuestionBtn = false;
      this.nextQuestions = false;
      if (!this.morequestionbutton) {
        this.$router.push({ name: "resume_type" });
      }
    },
    exp_next: function () {
      if (this.more) {
        var data = {
          resume_id: this.resume_id,
        };
        axios
          .post(this.EnvPath + "check-next-condition", data)
          .then(({ data }) => {
            if (data.status == 1) {
              if (!data.popup) {
                //this.more = false;
                //this.addMoreQuestions(0);
                this.$router.push({ name: "resume_type" });
              } else {
                this.nextQuestions = true;
              }
            }
          });
      } else {
        //next page
        this.$router.push({ name: "resume_type" });
      }
    },
    openquestion: function () {
      this.edit = false;
    },
    addMoreQuestions: function (buttonclick) {
      //AddMoreQuestions
      axios
        .post(this.EnvPath + "show-more-question", {
          resume_id: this.resume_id,
          btnClick: buttonclick == 1 ? "showMeMoreQuestion" : "FromOtherCall",
        })
        .then(({ data }) => {
          if (data.status == 1) {
            //this.MoreExperienceQuestions = data.data;
            //Array.prototype.push.apply(this.ExperienceQuestions, data.data);
            this.ExperienceQuestions = this.ExperienceQuestions.concat(
              data.data
            );
            this.more = false;
            if (buttonclick) {
              //update resume.expand_experience_finder = 1
            }
          }
        });
    },
    checkBoxClick: function (type) {
      if (this.experince_type === type || this.experince_type == "undefined") {
        this.experince_type = "";
      } else {
        this.experince_type = type;
      }
    },
    deleteNo: function () {
      this.DeleteData = false;
      //this.deleteIndex
    },
    closePoup: function () {
      this.notValid = false;
    },
    deleteRecourd: function () {
      axios
        .post(this.EnvPath + "delete-experience-finder", {
          id: this.experince_db_id,
        })
        .then(({ data }) => {
          if (data.status == 1) {
            this.DeleteData = false;
            this.ExperienceQuestions[this.deleteIndex].Experience.splice(
              this.experince_id,
              1
            );
            this.ExperienceQuestions[this.deleteIndex].experience_time =
              this.ExperienceQuestions[this.deleteIndex].experience_time - 1;
            if (
              this.ExperienceQuestions[this.deleteIndex].Experience.length == 0
            ) {
              this.isnew = true;
            }
            this.experince_description =
              this.experience_object[this.deleteIndex];

            this.edit = false;
            this.experince_id = 0;
            this.experince_description = "";
            this.experience_object[this.deleteIndex] = "";
            this.experince_type = "";
            this.experince_job_name = 0;
          }
        });
    },
    delete_exp: function (index, experince) {
      //index
      this.deleteIndex = index;
      this.DeleteData = true;
    },
    editQuestion: function (Experience, index, k2) {
      // this.experince_description = this.$store.state.ExperienceFinder_Object[index];
      this.experience_object[index] = Experience.description;

      this.edit = true;
      this.experince_description = Experience.description;
      this.edit_exp_description = this.experince_description;
      this.experince_type = Experience.type;
      this.experince_job_name = Experience.job_id;
      this.experince_db_id = Experience.id;
      this.isnew = false;
      this.experince_id = k2;
    },
    addnew: function (index) {
      if (!this.addNewQuestion) {
        this.notValid = true;
        return;
      } else {
        this.addNewQuestion = false;
      }
      if (index === this.dynamicFormIndex) {
        this.dynamicForm = this.dynamicForm ? true : false;
        let start = 0;
        // this.dynamicFormLoopArray = [];
        this.dynamicFormLoop = this.dynamicFormLoop++;
        while (start < this.dynamicFormLoop) {
          this.dynamicFormLoopArray.push(this.dynamicFormLoop);
          start++;
        }
      } else {
        this.dynamicForm = false;
        this.dynamicForm = true;
        this.dynamicFormLoop = 0;
        this.dynamicFormLoop++;
        this.dynamicFormLoopArray = [];

        let start = 0;
        while (start < this.dynamicFormLoop) {
          this.dynamicFormLoopArray.push(this.dynamicFormLoop);
          start++;
        }
      }

      this.dynamicFormIndex = index;
      // this.edit = true;
      // this.experince_description = "";
      // this.experince_type = "";
      // this.experince_job_name = 0;
    },
    save: function (index) {
      console.log(index, "here");
      this.experince_description = this.experience_object[index];
      if (this.experince_db_id == 0) {
        this.isnew = true;
      }
      if (
        this.experince_description != "" &&
        this.experince_type != "" &&
        this.experince_job_name != 0
      ) {
        this.addNewQuestion = true;
        console.log(this.addNewQuestion, "this.addNewQuestion");
        if (this.isnew) {
          /*
          this.ExperienceQuestions[index].Experience[
            this.ExperienceQuestions[index].Experience.length
          ] = {
            //created_at: "2021-07-03 14:02:58",
            description: this.experince_description,
            //id: 229,
            job_id: this.experince_job_name,
            position_id: this.ExperienceQuestions[index].position_id,
            question_id: this.ExperienceQuestions[index].question_id,
            result_id: null,
            type: this.experince_type
            //updated_at: "2021-07-03 14:02:58",
            //user_id: 99
          };
          */

          //add to db
          const obj = {
            description: this.experince_description,
            job_id: this.experince_job_name,
            question_id: this.ExperienceQuestions[index].question_id,
            position_id: this.ExperienceQuestions[index].position_id,
            result_id: null,
            resume_id: this.resume_id,
            type: this.experince_type,
            page: 1,
            id: null,
          };

          axios
            .post(this.EnvPath + "save-experience-finder", obj)
            .then(({ data }) => {
              if (data.status == 1) {
                if (data.experience_id) {
                  obj.id = data.experience_id;
                  this.ExperienceQuestions[index].Experience.push(obj);

                  this.ExperienceQuestions[index].experience_time =
                    this.ExperienceQuestions[index].experience_time + 1;
                }

                // this.$store.dispatch(
                //   "ExperienceFinderObject",
                //   this.experience_object
                // );
                this.experince_description = "";
                this.experince_type = "";
                this.experince_job_name = 0;
                this.edit = false;
                // this.addMoreQuestionsStatus();
                // this.loadExperince();
              }
            });
        } else {
          this.ExperienceQuestions[index].Experience[this.experince_id] = {
            //created_at: "2021-07-03 14:02:58",
            description: this.experince_description,
            id: this.experince_db_id,
            job_id: this.experince_job_name,
            position_id: this.ExperienceQuestions[index].position_id,
            question_id: this.ExperienceQuestions[index].question_id,
            result_id: null,
            type: this.experince_type,
            //updated_at: "2021-07-03 14:02:58",
            //user_id: 99
          };
          const obj = {
            id: this.experince_db_id,
            description: this.experince_description,
            job_id: this.experince_job_name,
            question_id: this.ExperienceQuestions[index].question_id,
            position_id: this.ExperienceQuestions[index].position_id,
            result_id: null,
            resume_id: this.resume_id,
            type: this.experince_type,
            page: 6,
          };

          axios
            .post(this.EnvPath + "edit-experience-finder", obj)
            .then(({ data }) => {
              if (data.status == 1) {
                //this.ExperienceQuestions = data.data;
                this.experince_description = "";
                this.experince_type = "";
                this.experince_job_name = 0;
                this.edit = false;
                this.experince_db_id = 0;
              }
            });
        }
      } else {
        this.notValid = true;
      }
      //$("#collapse" + (index + 1)).removeClass("show");
    },
    cancel: function (index) {
      this.experince_description = "";
      this.experince_type = "";
      this.experince_job_name = 0;
      this.edit = false;
      this.isnew = false;
    },
    loadExperince: function () {
      axios
        .post(this.EnvPath + "load-questions", { resume_id: this.resume_id })
        .then(({ data }) => {
          if (data.status == 1) {
            this.ExperienceQuestions = data.data;
            this.aditionalQuestionIndex = this.ExperienceQuestions.length;
          }
        });
    },
    getJob() {
      axios.get(this.EnvPath + "get-job").then(({ data }) => {
        if (data.status == 1) {
          //store.commit("GetJob", data.data);
          if (data != null) {
            this.JobDropDown = data.data;
          }
        }
      });
    },
  },
};
</script>
<style>
#app {
  background-position: bottom !important;
  background-size: 100% !important;
  background-color: #d5f8f0 !important;
}
.new_icon_close {
  position: absolute;
  right: 10px;
  top: 5px;
  color: #fff;
  cursor: pointer;
}

.activeTable {
  /* color: #fff !important;
  background-color: #3d96f9 !important; */
}

.space-control-top-and-bottom {
  padding: 40px 15px !important;
}

.experience-finder-position-font {
  font-family: Hind;
  font-weight: 700;
  font-size: 16px;
  color: #767676;
  text-align: left;
}
@media (max-width: 450px) {
  .experience-finder-position-font {
    font-size: 14px;
  }
  p.experience-finder-position-font.font-size-control-mobile-text {
    font-size: 13px;
  }
  .space-left-control-mobile {
    padding-left: 7px !important;
  }
  .delete-button-experience-finder-page .col-4 img {
    max-width: 65% !important;
    margin-bottom: 15px;
  }
  .delete-button-experience-finder-page .flex-control-popup {
    flex-direction: column;
  }
  .pop-content-section.pop_confused_content.space-control-top-bottom {
    padding: 30px 0 40px 0 !important;
  }
  .acordian-card-experience-finder .card-body {
    background: #f4f4f5 !important;
    margin-bottom: 15px;
    padding: 15px 5px;
  }
  .space-control-on-mobile-acordian-box .card-body {
    margin: 15px !important;
  }
}
.border-or-arrow-control
  select.select-item.select-item-job-name.input.mouseLeave {
  border-radius: 100px !important;
}
.select-arrow-side.border-or-arrow-control:before {
  right: 19px !important;
  top: 7px;
  transform: rotate(0deg);
}

.experience-finder-toggle[aria-expanded="true"] .tab-content-div {
  background-color: #3d96f9 !important;
  color: #ffffff !important;
}
.experience-finder-toggle.collapsed {
  background-color: #ffffff !important;
}

.center-box-flex {
  display: flex;
  justify-content: space-evenly;
}

.select-arrow-side.arrowUp:before {
  transform: rotate(180deg);
}
</style>
