<template>
  <div>
    <!-- <headernav
      :education_enhacements="education_enhacements"
      :isLoggedIn="isLoggedIn"
      :currentpage="parseInt(5)"
      :page="parseInt(page)"
    ></headernav> -->
    <section class="page-resume-editor page-contact-info">
      <div class="container">
        <div
          class="row alert_yak_finder"
          style="max-width: 85%; margin: 20px auto"
        >
          <div class="col-md-2">
            <img :src="EnvPath + 'images/bg/yak-port.png'" alt="YAK" />
          </div>
          <div class="col-md-10 col-sm-8 job_description_alert_text">
            <p>
              Endorsements are a great way to highlight an accomplishment or
              important characteristic with greater credibility. We’ll later
              give you a few options on where you can place them on your resume.
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
            <sidemenu
              page="4"
              activePage="job_descriptions"
              step="4"
            ></sidemenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div class="resume-editor-div">
              <h2>
                <span class="icon">
                  <img :src="EnvPath + 'images/logo/endorsement-icon.png'" />
                </span>
                Endorsements
              </h2>
              <div
                v-for="(single_endorsement, index2) in Endorsement"
                v-bind:key="index2"
                class="education_enhancement_sections endrosement_section_saved"
                id="accordionExample2"
              >
                <div class="endorement_saved_item">
                  <div class id="headingOne">
                    <div
                      @click="openEndorsment(index2)"
                      data-toggle="collapse"
                      :data-target="'#collapseOne' + index2"
                      aria-expanded="false"
                      aria-controls="collapseOne"
                      class="edu_section_heading endrosement_section_saved_heading"
                    >
                      <p>
                        “{{ single_endorsement.value }}”
                        <span>
                          - {{ single_endorsement.author }},
                          {{ single_endorsement.author_description }}
                        </span>
                      </p>
                      <span class="icon">
                        <i class="fas fa-chevron-circle-down"></i>
                      </span>
                    </div>
                  </div>
                  <div
                    :id="'collapseOne' + index2"
                    aria-labelledby="headingOne"
                    data-parent="#accordionExample2"
                    class="edu_section_content collapse"
                  >
                    <div class="enhancement_fields_section">
                      <div class="row finder_text">
                        <div class="col-12">
                          <p>
                            What positive things (endorsements) has someone said
                            or written about you?
                            <img
                              :src="EnvPath + 'images/logo/yak-icon.png'"
                              style="margin-left: 10px"
                              v-tooltip="endorsement_value"
                            />
                          </p>
                          <textarea
                            v-model="single_endorsement.value"
                            placeholder="Billy helped our company grow by more than 25% last year. "
                            style="width: 100%"
                          ></textarea>
                        </div>
                        <div class="col-12">
                          
                          <div class="custom-control custom-checkbox form-check form-check-inline finder_job_check">
                            <input
                              :checked="single_endorsement.result_id == 1"
                              @click="checkBoxClick(1, index2)"
                              type="checkbox"
                              id="customCheck"
                              value="option1"
                              class="custom-control-input form-check-input"
                            />
                            <label
                              for="customCheck"
                              class="custom-control-label form-check-label"
                              >Made Money</label
                            >
                          </div>

                          <div
                            class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                          >
                            <input
                              :checked="single_endorsement.result_id == 2"
                              @click="checkBoxClick(2, index2)"
                              type="checkbox"
                              id="customCheck"
                              value="option2"
                              class="custom-control-input form-check-input"
                            />
                            <label
                              for="customCheck"
                              class="custom-control-label form-check-label"
                              >More Efficient</label
                            >
                          </div>
                          <div
                            class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                          >
                            <input
                              :checked="single_endorsement.result_id == 3"
                              @click="checkBoxClick(3, index2)"
                              type="checkbox"
                              id="inlineCheckbox3"
                              value="option3"
                              class="custom-control-input form-check-input"
                            />
                            <label
                              for="inlineCheckbox3"
                              class="custom-control-label form-check-label"
                              >Cut Costs</label
                            >
                          </div>
                          <div
                            class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                          >
                            <input
                              :checked="single_endorsement.result_id == 4"
                              @click="checkBoxClick(4, index2)"
                              type="checkbox"
                              id="inlineCheckbox4"
                              value="option4"
                              class="custom-control-input form-check-input"
                            />
                            <label
                              for="inlineCheckbox4"
                              class="custom-control-label form-check-label"
                              >Solved a Problem</label
                            >
                          </div>
                          <div
                            class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                          >
                            <input
                              :checked="single_endorsement.result_id == 5"
                              @click="checkBoxClick(5, index2)"
                              type="checkbox"
                              id="inlineCheckbox5"
                              value="option5"
                              class="custom-control-input form-check-input"
                            />
                            <label
                              for="inlineCheckbox5"
                              class="custom-control-label form-check-label"
                              >Other</label
                            >
                          </div>
                        </div>
                        <div
                          class="col-sm-4 author_label"
                          style="max-width: 180px"
                        >
                          <p>Author Name:</p>
                        </div>
                        <div class="col-sm-8 yak_author_field">
                          <input
                            type="text"
                            v-model="single_endorsement.author"
                            placeholder="Peter Parker"
                            class="credits-text-field input"
                          />
                        </div>
                        <div
                          class="col-sm-4 author_label"
                          style="max-width: 180px"
                        >
                          <p>Author Description:</p>
                        </div>
                        <div class="col-sm-8 yak_author_field">
                          <input
                            type="text"
                            v-model="single_endorsement.author_description"
                            placeholder="CEO of Cyber Systems"
                            class="credits-text-field yak_filed_img input"
                            style="display: inline-block; float: left"
                          />
                          <img
                            v-tooltip="endorsement_author_description"
                            :src="EnvPath + 'images/logo/yak-icon.png'"
                          />
                        </div>
                        <div
                          class="col-md-5 col-sm-6 job_finder_label"
                          style="max-width: 280px"
                        >
                          <p>Position this experience relates to:</p>
                        </div>
                        <div class="col-md-6 select-arrow-side col-sm-6 job_name_finder inputP55">
                          <select
                            v-model="single_endorsement.job_id"
                            name="job_name"
                            id
                            class="select-item select-item-job-name input mouseLeave"
                            style="-webkit-appearance: none"
                          >
                            <option value="0">Select</option>
                            <option
                              :value="Job.id"
                              v-for="(Job, index) in JobDropDown"
                              v-bind:key="index"
                            >
                              {{ Job.position }}, {{ Job.company }}
                            </option>
                            <option value="999">Other / Not Applicable</option>
                          </select>
                        </div>
                      </div>
                      <div
                        class="confirm confirm_finder"
                        style="
                          text-align: right;
                          display: inline-block;
                          width: 100%;
                        "
                      >
                        <i
                          class="fa fa-check-circle"
                          style="font-size: 30px; color: rgb(251, 100, 62)"
                          @click="saveEndorsment(index2)"
                        ></i>
                        <i
                          class="fa fa-times-circle"
                          @click="cancelEndorsment(index2)"
                          style="font-size: 30px; color: rgb(251, 100, 62)"
                        ></i>
                        <i
                          class="fa fa-2x fa fa-trash"
                          @click="deleteEndorsment(index2)"
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
                  </div>
                </div>
              </div>
              <div
                class="row"
                style="max-width: 750px; margin: 0px auto !important"
              >
                <div
                  class="col-md-12 col-sm-12 group mr-2 education_enhacement_content_section"
                  style="margin-top: 20px"
                >
                  <div v-if="showAddNew" class="education_enhancement_sections">
                    <div class="edu_section_heading">New Endorsement</div>
                    <div class="edu_section_content">
                      <div class="enhancement_fields_section">
                        <div class="row finder_text">
                          <div class="col-12">
                            <p>
                              What positive things (endorsements) has someone
                              said or written about you?
                              <img
                                :src="EnvPath + 'images/logo/yak-icon.png'"
                                style="margin-left: 10px"
                                v-tooltip="endorsement_value"
                              />
                            </p>
                            <textarea
                              v-model="value"
                              placeholder="Billy helped our company grow by more than 25% last year. "
                              style="width: 100%"
                            ></textarea>
                          </div>
                          <div class="col-12">
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                :checked="result_id == 1"
                                @click="checkBoxClick(1, -1)"
                                type="checkbox"
                                id="customCheck"
                                value="option1"
                                class="custom-control-input form-check-input"
                              />
                              <label
                                for="customCheck"
                                class="custom-control-label form-check-label"
                                >Made Money</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                :checked="result_id == 2"
                                @click="checkBoxClick(2, -1)"
                                type="checkbox"
                                id="customCheck"
                                value="option2"
                                class="custom-control-input form-check-input"
                              />
                              <label
                                for="customCheck"
                                class="custom-control-label form-check-label"
                                >More Efficient</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                :checked="result_id == 3"
                                @click="checkBoxClick(3, -1)"
                                type="checkbox"
                                id="inlineCheckbox3"
                                value="option3"
                                class="custom-control-input form-check-input"
                              />
                              <label
                                for="inlineCheckbox3"
                                class="custom-control-label form-check-label"
                                >Cut Costs</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                :checked="result_id == 4"
                                @click="checkBoxClick(4, -1)"
                                type="checkbox"
                                id="inlineCheckbox4"
                                value="option4"
                                class="custom-control-input form-check-input"
                              />
                              <label
                                for="inlineCheckbox4"
                                class="custom-control-label form-check-label"
                                >Solved a Problem</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                :checked="result_id == 5"
                                @click="checkBoxClick(5, -1)"
                                type="checkbox"
                                id="inlineCheckbox5"
                                value="option5"
                                class="custom-control-input form-check-input"
                              />
                              <label
                                for="inlineCheckbox5"
                                class="custom-control-label form-check-label"
                                >Other</label
                              >
                            </div>
                          </div>
                          <div
                            class="col-sm-4 author_label"
                            style="max-width: 180px"
                          >
                            <p>Author Name:</p>
                          </div>
                          <div class="col-sm-8 yak_author_field">
                            <input
                              type="text"
                              v-model="author"
                              placeholder="Peter Parker"
                              class="credits-text-field input"
                            />
                          </div>
                          <div
                            class="col-sm-4 author_label"
                            style="max-width: 180px"
                          >
                            <p>Author Description:</p>
                          </div>
                          <div class="col-sm-8 yak_author_field">
                            <input
                              type="text"
                              v-model="author_description"
                              placeholder="CEO of Cyber Systems"
                              class="credits-text-field yak_filed_img input"
                              style="display: inline-block; float: left"
                            />
                            <img
                              v-tooltip="endorsement_author_description"
                              :src="EnvPath + 'images/logo/yak-icon.png'"
                            />
                          </div>
                          <div
                            class="col-md-5 col-sm-6 job_finder_label"
                            style="max-width: 280px"
                          >
                            <p>Position this experience relates to:</p>
                          </div>
                          <div
                            class="col-md-6 select-arrow-side col-sm-6 job_name_finder inputP55"
                          >
                            <select
                              v-model="job_id"
                              name="job_name"
                              id
                              class="select-item select-item-job-name input mouseLeave"
                              style="-webkit-appearance: none"
                            >
                              <option value="0">Select</option>
                              <option
                                :value="Job.id"
                                v-for="(Job, index) in JobDropDown"
                                v-bind:key="index"
                              >
                                {{ Job.position }}, {{ Job.company }}
                              </option>
                              <option value="999">
                                Other / Not Applicable
                              </option>
                            </select>
                          </div>
                        </div>
                        <div
                          class="confirm confirm_finder"
                          style="
                            text-align: right;
                            display: inline-block;
                            width: 100%;
                          "
                        >
                          <i
                            class="fa fa-check-circle"
                            style="font-size: 30px; color: rgb(251, 100, 62)"
                            @click="saveEndorsment(-1)"
                          ></i>
                          <i
                            class="fa fa-times-circle"
                            style="font-size: 30px; color: rgb(251, 100, 62)"
                            @click="cancelEndorsment(-1)"
                          ></i>
                          <i
                            v-if="false"
                            class="fa fa-2x fa fa-trash"
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
                    </div>
                  </div>
                  <div v-if="!showAddNew" class="col-12" style="padding: 0">
                    <button
                      @click="addNew"
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
                <div
                  class="text-center"
                  style="display: block; margin: 25px auto 15px"
                >
                  <!-- <button @click="gotoResumeType" class="btn1 btn-rounded btn-next mt-4">
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-5">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </button> -->
                  <router-link
                    :to="{ name: 'education_enhancement' }"
                    class="btn1 btn-rounded btn-next mt-4 router-link-no-text-decoration"
                  >
                    <span style="margin-left: -14px">Next</span>
                    <span class="pl-1">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </router-link>
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

      <div v-if="showDeleteEndorsment" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Surprise.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Are You Sure?</h4>
                  <p>
                    Are you sure you want to delete this endorsement (Did you
                    make this endorsement up)?
                  </p>
                  <button
                    @click="cancelDeleteEndorsment()"
                    class="btnOption btn-rounded"
                    style="float: left"
                  >
                    No
                  </button>
                  <button
                    @click="confirmDeleteEndorsment(currentIndex)"
                    class="btnOption btn_color_option btn-rounded"
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

      <div v-if="showNewButtonConfirm" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Confused.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Are you Sure?</h4>
                  <p>
                    You haven't yet saved the changes you have made. What do you
                    want to do?
                  </p>
                  <button
                    @click="cancelNewButtonConfirm(true)"
                    style="float: left"
                    class="btnOption btn-rounded"
                  >
                    Cancel
                  </button>
                  <button
                    @click="abandonNewButtonConfirm(true)"
                    style="float: left"
                    class="btnOption btn-rounded"
                  >
                    Abandon Changes
                  </button>
                  <button
                    @click="saveNewButtonConfirm"
                    class="btnOption btn_color_option btn-rounded"
                    style="float: right"
                  >
                    Save
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="showNewButtonIncompleteConfirm" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Confused.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Are you Sure?</h4>
                  <p>
                    You haven't yet saved the changes you have made. What do you
                    want to do?
                  </p>
                  <button
                    @click="cancelNewButtonConfirm(false)"
                    style="float: left"
                    class="btnOption btn_color_option btn-rounded"
                  >
                    Cancel
                  </button>
                  <button
                    @click="abandonNewButtonConfirm(false)"
                    style="float: right"
                    class="btnOption btn-rounded"
                  >
                    Abandon Changes
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="showRequiredField" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Confused.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Nope!</h4>
                  <p>You must complete all of the fields before saving</p>
                  <button @click="requiredOK" class="btnOption btn-rounded">
                    OK
                  </button>
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
import { environment_api } from "../../env";
import sidemenu from "../sidemenu";
import headernav from "./header_nav";
import JQuery from "jquery";
import axios from "axios";
let $ = JQuery;

export default {
  name: "endorsements",
  data() {
    return {
      EnvPath: environment_api.api_url,
      JobDropDown: [],
      Endorsement: [],
      value: "",
      author: "",
      author_description: "",
      job_id: 0,
      result_id: 0,
      education_enhacements: false,
      isLoggedIn: this.$store.state.isLoggedIn,
      page: this.$store.state.contact_Data.page,
      showAddNew: true,
      showDeleteEndorsment: false,
      currentIndex: -1,
      showNewButtonConfirm: false,
      showNewButtonIncompleteConfirm: false,
      endorsement_value: "",
      endorsement_author_description: "",
      resume_id: 0,
      showRequiredField: false,
      OldEndorsement: [],
    };
  },
  components: {
    sidemenu,
    headernav,
  },
  mounted() {
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

    localStorage.setItem("page", 9);
    this.getJob();
    this.getEndorsements();
    this.loadToolTipse();
  },
  methods: {
    toGetEndorsement() {
      // Two_Page_Resume.user.endorsements
      console.log(this.$store.state.Two_Page_Resume.user.endorsements);
    },
    checkBoxClick(result_id, index) {
      if (index == -1) {
        this.result_id = result_id;
      } else {
        this.Endorsement[index].result_id = result_id;
      }
    },
    loadToolTipse() {
      let that = this;
      axios.get(this.EnvPath + "get-endorsement-tooltip").then(({ data }) => {
        if (data.status == 1) {
          console.log("***********************");
          //store.commit("GetJob", data.data);
          that.endorsement_value = "";
          that.endorsement_author_description = "";
          let field_tips = JSON.parse(data.field_tips);
          field_tips.forEach(function (obj) {
            if (obj.field == "endorsement_value") {
              that.endorsement_value = obj.tip;
            } else if (obj.field == "endorsement_author_description") {
              that.endorsement_author_description = obj.tip;
            }
            //console.log(obj.field);
            //console.log(obj.tip);
          });
          //console.log(data.field_tips);
        }
      });
    },
    gotoResumeType() {
      this.$router.push({ name: "resume_type" });
    },
    requiredOK() {
      this.showRequiredField = false;
    },
    cancelNewButtonConfirm(isComplete) {
      if (isComplete) {
        this.showNewButtonConfirm = false;
      } else {
        this.showNewButtonIncompleteConfirm = false;
      }
    },
    abandonNewButtonConfirm() {
      if (isComplete) {
        this.showNewButtonConfirm = false;
        this.showAddNew = true;
        this.cancelEndorsment(this.currentIndex);
      } else {
        this.showNewButtonIncompleteConfirm = false;
        this.cancelEndorsment(this.currentIndex);
        this.showAddNew = true;
      }
    },
    saveNewButtonConfirm() {
      this.showNewButtonConfirm = false;
      this.showAddNew = true;
      this.saveEndorsment(this.currentIndex);
    },
    openEndorsment(index2) {
      this.cancelEndorsment(-1);
      if (this.currentIndex != index2) {
        this.currentIndex = index2;
      } else {
        this.currentIndex = -1;
      }

      //need to indentify endorsment close
    },
    addNew() {
      if (this.currentIndex != -1) {
        if (
          this.Endorsement[this.currentIndex].value != "" &&
          this.Endorsement[this.currentIndex].author != "" &&
          this.Endorsement[this.currentIndex].author_description != "" &&
          this.Endorsement[this.currentIndex].job_id != 0
        ) {
          this.showNewButtonConfirm = true;
        } else {
          this.showNewButtonIncompleteConfirm = true;
        }
      } else {
        if (
          this.value != "" &&
          this.author != "" &&
          this.author_description != "" &&
          this.job_id != 0
        ) {
          this.showNewButtonConfirm = true;
        } else {
          this.cancelEndorsment(-1);
          this.showAddNew = true;
        }
      }
      //this.showAddNew = true;
    },
    cancelDeleteEndorsment() {
      this.showDeleteEndorsment = false;
      this.currentIndex = -1;
    },
    confirmDeleteEndorsment(index) {
      axios
        .post(this.EnvPath + "api/delete-endorsements", {
          endorsements_id: this.Endorsement[index].id,
          resume_id: this.resume_id,
        })
        .then(({ data }) => {
          if (data.status == "success") {
            this.Endorsement.splice(index, 1);
            this.showDeleteEndorsment = false;
            this.currentIndex = -1;
          }
        });
    },
    deleteEndorsment(index) {
      this.showDeleteEndorsment = true;
      this.currentIndex = index;
    },
    saveEndorsment(index) {
      let that = this;
      let userData = this.$store.state.contact_Data;
      if (index == -1) {
        axios
          .post(this.EnvPath + "api/save-endorsements", {
            user_id: userData.id,
            value: this.value,
            author: this.author,
            author_description: this.author_description,
            job_id: this.job_id,
            result_id: this.result_id,
            resume_id: this.resume_id,
          })
          .then(({ data }) => {
            console.log("-1 Data", data);
            if (data.status == "success") {
              that.Endorsement[that.Endorsement.length] = {
                id: data.data.id,
                value: that.value,
                author: that.author,
                author_description: that.author_description,
                job_id: that.job_id,
                result_id: that.result_id,
              };

              that.value = "";
              that.author = "";
              that.author_description = "";
              that.job_id = 0;
              that.result_id = 0;
              // this.$router.push({ path: 'builder/myresume' });
            }
          });
      } else {
        let that = this;
        axios
          .post(this.EnvPath + "api/save-endorsements", {
            user_id: userData.id,
            id: this.Endorsement[index].id,
            value: this.Endorsement[index].value,
            author: this.Endorsement[index].author,
            author_description: this.Endorsement[index].author_description,
            job_id: this.Endorsement[index].job_id,
            result_id: this.Endorsement[index].result_id,
            resume_id: this.resume_id,
          })
          .then(({ data }) => {
            if (data.status == "success") {
              //that.$root.$emit("bv::toggle::collapse", "#collapseOne" + index);
              console.log($.fn.jquery);
              console.log("#collapseOne" + index);
              $("#collapseOne" + index).collapse("hide");
              console.log("save");
              console.log("this.Endorsement", this.Endorsement);
            }
          });
      }
    },
    cancelEndorsment(index) {
      if (index == -1) {
        this.showAddNew = false;
        this.value = "";
        this.author = "";
        this.author_description = "";
        this.job_id = 0;
        this.result_id = 0;
      } else {
        this.getEndorsements();
        $("#collapseOne" + index).collapse("hide");
      }
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
    getEndorsements() {
      axios.get(this.EnvPath + "get-endorsements").then(({ data }) => {
        if (data.status == 1) {
          //store.commit("GetJob", data.data);
          if (data != null) {
            this.Endorsement = data.data;
            this.showAddNew = this.Endorsement.length > 0 ? false : true;
            /*
            this.Endorsement.forEach((element, index) => {
              this.Endorsement[index].result = JSON.parse(element.result);
            });
            */
          }
        }
      });
    },
  },

  created() {
    this.OldEndorsement = this.toGetEndorsement();
    console.log(this.OldEndorsement);

    console.log(this.Endorsement);
  },
};
</script>
