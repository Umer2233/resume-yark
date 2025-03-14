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
            <p class="alert_yak_finder_para space-left-box-bar">
              Endorsements are a great way to highlight an accomplishment or
              important characteristic with greater credibility. We’ll later
              give you a few options on where you can place them on your resume.
            </p>
          </div>
          <span class="new_icon_close" @click="handleFeildTip()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
      <div class="container experience_finder_right_container">
        <div class="row">
          <div class="col-md-2">
            <sidemenu
              :page="parseInt(8)"
              :education_enhacements="education_enhacements"
              step="4"
            ></sidemenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div
              class="resume-editor-div endorsment-height-control white-height-box"
            >
              <h2 class="space-mobile-text-box mt-2">
                <span class="icon">
                  <img :src="EnvPath + 'images/logo/endorsement-icon.png'" />
                </span>
                Endorsements
              </h2>
              <div id="accordionExample2">
                <div
                  v-for="(single_endorsement, index2) in Endorsement"
                  v-bind:key="index2"
                  class="education_enhancement_sections endrosement_section_saved"
                >
                  <div
                    class="endorement_saved_item space-bottom-control-accordian-box"
                  >
                    <div class id="headingOne">
                      <div
                        data-toggle="collapse"
                        :data-target="'#collapseOne_' + index2"
                        aria-expanded="false"
                        :aria-controls="'#collapseOne_' + index2"
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
                      :id="'collapseOne_' + index2"
                      aria-labelledby="headingOne"
                      data-parent="#accordionExample2"
                      class="edu_section_content spacing-control-on-mobile collapse"
                    >
                      <div class="enhancement_fields_section">
                        <div class="row finder_text">
                          <div class="col-12">
                            <p
                              class="endorsment-text-line-height-issue align-text-box-bar"
                            >
                              <span>
                                What positive things (endorsements) has someone
                                said or written about you?
                              </span>
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
                              class="grey-text-color-endrosment"
                            ></textarea>
                          </div>

                          <div class="col-12 center-box-flex">
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
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
                              class="credits-text-field input grey-text-color-endrosment"
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
                              class="credits-text-field yak_filed_img input input-width-on-tablet grey-text-color-endrosment"
                              style="display: inline-block; float: left"
                            />
                            <img
                              class="tooltip-mobile-control"
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
                            class="col-md-6 select-arrow-side col-sm-6 job_name_finder inputP55 arrow-up-style"
                          >
                            <select
                              v-model="single_endorsement.job_id"
                              name="job_name"
                              id
                              class="select-item select-item-job-name input mouseLeave grey-text-color-endrosment"
                              style="
                                -webkit-appearance: none;
                                padding-right: 30px !important;
                              "
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
              </div>
              <div
                class="row space-sides-design-control"
                style="margin: 0px auto !important"
              >
                <div
                  class="col-md-12 col-sm-12 group mr-2 education_enhacement_content_section"
                >
                  <div v-if="showAddNew" class="education_enhancement_sections">
                    <div class="edu_section_heading">New Endorsement</div>
                    <div class="edu_section_content">
                      <div class="enhancement_fields_section">
                        <div class="row finder_text">
                          <div class="col-12">
                            <p class="endorsment-text-line-height-issue">
                              What positive things (endorsements) has someone
                              said or written about you?
                              <img
                                :src="EnvPath + 'images/logo/yak-icon.png'"
                                style="margin-left: 10px; width: 35px"
                                v-tooltip="endorsement_value"
                              />
                            </p>
                            <textarea
                              v-model="value"
                              placeholder="Billy helped our company grow by more than 25% last year. "
                              style="width: 100%"
                              class="grey-text-color-endrosment"
                            ></textarea>
                          </div>

                          <div class="col-12 center-box-flex">
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check space-control-label"
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
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check space-control-label"
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
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check space-control-label"
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
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check space-control-label"
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
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check space-control-label"
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

                          <!-- <div
                            class="col-12 d-flex justify-content-between mb-3"
                          >
                            <div class="endorsment-input-check-box">
                              <input
                                :checked="result_id == 1"
                                @click="checkBoxClick(1, -1)"
                                type="checkbox"
                                id="customCheck123"
                                value="option1"
                              />
                              <label for="customCheck123">Made Money</label>
                            </div>

                            <div class="endorsment-input-check-box">
                              <input
                                :checked="result_id == 2"
                                @click="checkBoxClick(2, -1)"
                                type="checkbox"
                                id="customCheck124"
                                value="option2"
                              />
                              <label for="customCheck124">More Efficient</label>
                            </div>

                            <div class="endorsment-input-check-box">
                              <input
                                :checked="result_id == 3"
                                @click="checkBoxClick(3, -1)"
                                type="checkbox"
                                id="inlineCheckbox125"
                                value="option3"
                              />
                              <label for="inlineCheckbox125">Cut Costs</label>
                            </div>

                            <div class="endorsment-input-check-box">
                              <input
                                :checked="result_id == 4"
                                @click="checkBoxClick(4, -1)"
                                type="checkbox"
                                id="inlineCheckbox4126"
                                value="option4"
                              />
                              <label for="inlineCheckbox4126"
                                >Solved a Problem</label
                              >
                            </div>

                            <div class="endorsment-input-check-box">
                              <input
                                :checked="result_id == 5"
                                @click="checkBoxClick(5, -1)"
                                type="checkbox"
                                id="inlineCheckbox127"
                                value="option5"
                              />
                              <label for="inlineCheckbox127">Other</label>
                            </div>
                          </div> -->

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
                              class="credits-text-field input grey-text-color-endrosment"
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
                              class="credits-text-field yak_filed_img input input-width-on-tablet grey-text-color-endrosment"
                              style="display: inline-block; float: left"
                            />
                            <img
                              class="tooltip-mobile-control"
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
                            class="col-md-6 select-arrow-side col-sm-6 job_name_finder inputP55 arrow-up-style"
                          >
                            <select
                              v-model="job_id"
                              name="job_name"
                              id
                              class="select-item select-item-job-name input mouseLeave grey-text-color-endrosment"
                              style="
                                -webkit-appearance: none;
                                padding-right: 30px !important;
                              "
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
                      class="btn btn-block mt-0"
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
                  style="display: block; margin: 0 auto 0"
                >
                  <button
                    @click="gotoResumeType"
                    class="btn1 btn-rounded btn-next mt-3 btn-text-arrow-right"
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
                  <div class="popup-btn-fixes flex-direction-column-box">
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
      </div>

      <div v-if="showNewButtonConfirm" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row column-direction-box">
                <div class="col-md-3 col-sm-12 col-12">
                  <img src="images/logo/Confused.png" alt="Confused" />
                </div>
                <div class="col-md-9 col-sm-12 col-12">
                  <h4>Are you Sure?</h4>
                  <p>
                    You haven't yet saved the changes you have made. What do you
                    want to do?
                  </p>
                  <div
                    class="d-flex justify-content-between align-items-center"
                  >
                    <button
                      @click="cancelNewButtonConfirm(true)"
                      class="btnOption btn-rounded"
                    >
                      Cancel
                    </button>
                    <button
                      @click="abandonNewButtonConfirm(true)"
                      class="btnOption btn-rounded"
                    >
                      Abandon Changes
                    </button>
                    <button
                      @click="saveNewButtonConfirm"
                      class="btnOption btn_color_option btn-rounded"
                    >
                      Save
                    </button>
                  </div>
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
                  <div class="d-flex justify-content-center">
                    <button @click="requiredOK" class="btnOption btn-rounded">
                      OK
                    </button>
                  </div>
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
import store from "../../store";
import { mapGetters } from "vuex";
import Common from "../../mixins/Common.js";

let $ = JQuery;

export default {
  name: "endorsements",
  mixins: [Common],

  data() {
    return {
      EnvPath: environment_api.api_base_url,
      JobDropDown: [],
      Endorsement: [],
      value: "",
      author: "",
      author_description: "",
      job_id: 0,
      result_id: 0,
      education_enhacements: false,
      isLoggedIn: this.$store.state.isLoggedIn,
      // page: this.$store.state.contact_Data.page,
      page: "4",
      showAddNew: true,
      showDeleteEndorsment: false,
      currentIndex: -1,
      showNewButtonConfirm: false,
      showNewButtonIncompleteConfirm: false,
      endorsement_value: "",
      endorsement_author_description: "",
      resume_id: 0,
      showRequiredField: false,
    };
  },
  components: {
    sidemenu,
    headernav,
  },
  mounted() {
    store.commit("storeCurrentPage", 8);
    localStorage.setItem("CurrentPage", 8);
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

    localStorage.setItem("page", 8);
    this.getJob();
    this.getEndorsements();
    this.loadToolTipse();
    // this.getEducationEnhancement();
  },
  computed: {
    ...mapGetters([
      "getUserData",
      "getCurrentResume",
      "getShowEducationEnhancement",
    ]),
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
    handleFeildTip() {
      $(".alert_yak_finder").fadeOut();
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
      axios
        .get(this.EnvPath + "api/get-endorsement-tooltip")
        .then(({ data }) => {
          if (data.status == 1) {
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
            });
          }
        });
    },
    gotoResumeType() {
      if (this.getCurrentResume.last_step < 9) {
        var data = {
          r_id: this.getCurrentResume.resume_id,
          step: 9,
        };
        this.$store.dispatch("updateResumeLastStep", data);
        store.commit("storePageCount", 9);
        localStorage.setItem("pageCount", 9);
      }

      if (this.getShowEducationEnhancement) {
        this.$router.push({ name: "education_enhancement" });
      } else {
        this.$router.push({ name: "resume_type" });
      }
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
    abandonNewButtonConfirm(isComplete) {
      if (isComplete) {
        this.showNewButtonConfirm = false;
        this.showAddNew = true;
        this.cancelEndorsment(this.currentIndex);
        this.currentIndex = -1;
      } else {
        this.showNewButtonIncompleteConfirm = false;
        this.cancelEndorsment(this.currentIndex);
        this.showAddNew = true;
        this.currentIndex = -1;
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
      if (this.currentIndex !== -1) {
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
        console.log(this.currentIndex, "this.currentIndex");
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
        .post(this.EnvPath + "delete-endorsements", {
          endorsements_id: this.Endorsement[index].id,
          resume_id: this.resume_id,
        })
        .then(({ data }) => {
          if (data.success == true) {
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
      if (index == -1) {
        if (
          this.value == "" ||
          this.author == "" ||
          this.author_description == "" ||
          this.job_id == "" ||
          this.result_id == "" ||
          this.resume_id == ""
        ) {
          this.showRequiredField = true;
          return;
        }
        axios
          .post(this.EnvPath + "save-endorsements", {
            id: 0,
            value: this.value,
            author: this.author,
            author_description: this.author_description,
            job_id: this.job_id,
            result_id: this.result_id,
            resume_id: this.resume_id,
          })
          .then(({ data }) => {
            if (data.success == true) {
              that.Endorsement[that.Endorsement.length] = {
                id: data.id,
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
            }

            that.showNewButtonConfirm = false;
          });
      } else {
        if (
          that.Endorsement[index].value == "" ||
          that.Endorsement[index].author == "" ||
          that.Endorsement[index].author_description == "" ||
          that.Endorsement[index].job_id == "" ||
          that.Endorsement[index].result_id == "" ||
          that.resume_id == ""
        ) {
          that.showRequiredField = true;
          return;
        }

        axios
          .post(that.EnvPath + "save-endorsements", {
            id: that.Endorsement[index].id,
            value: that.Endorsement[index].value,
            author: that.Endorsement[index].author,
            author_description: that.Endorsement[index].author_description,
            job_id: that.Endorsement[index].job_id,
            result_id: that.Endorsement[index].result_id,
            resume_id: that.resume_id,
          })
          .then(({ data }) => {
            if (data.success == true) {
              //that.$root.$emit("bv::toggle::collapse", "#collapseOne" + index);
              $("#collapseOne" + index).collapse("hide");
              this.currentIndex = -1;
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
      // const userId = this.$store.state.userData.user_id;

      const userId = this.$store.state.contact_Data.id;
      console.log("User ID", userId);
      axios
        .post(this.EnvPath + "api/get-endorsements", { id: userId })
        .then(({ data }) => {
          // if (data.status == 1) {
          //store.commit("GetJob", data.data);
          if (data != null) {
            this.Endorsement = data;
            this.showAddNew = this.Endorsement.length > 0 ? false : true;
            /*
              this.Endorsement.forEach((element, index) => {
                this.Endorsement[index].result = JSON.parse(element.result);
              });
              */
          }
          // }
        });
    },
  },
};
</script>

<style>
@media (max-width: 450px) {
  .d-flex.justify-content-between.align-items-center {
    flex-wrap: wrap;
  }

  .row.space-sides-design-control {
    padding: 0 !important;
  }

  .btnOption {
    white-space: nowrap;
    padding: 0;
  }

  p.endorsment-text-line-height-issue {
    line-height: 1.9;
    margin-top: 0;
  }

  .spacing-control-on-mobile {
    padding: 20px !important;
  }

  .tooltip-mobile-control {
    margin-top: 5px;
  }
  .yak_author_field
    input.credits-text-field.yak_filed_img.input.input-width-on-tablet {
    width: 86% !important;
  }
  .flex-direction-column-box {
    flex-direction: column;
  }
  .column-direction-box {
    flex-direction: column;
    align-items: center;
  }
  .column-direction-box .pop_confused_content img {
    max-width: 130px;
  }
  button.btn1.btn-rounded.btn-next.mt-3.btn-space-top-bar {
    margin-top: 15px !important;
  }
  h2.space-mobile-text-box {
    margin-top: 0 !important;
    margin-bottom: 20px !important;
  }
  .endorement_saved_item.space-bottom-control-accordian-box {
    margin-bottom: 0px !important;
  }
}

@media (max-width: 993px) {
  .space-bottom-control-accordian-box {
    margin-bottom: 5px !important;
  }
  .btn1.btn-rounded.btn-next.mt-3.btn-space-top-bar {
    margin-top: 30px !important;
  }
}
@media (max-width: 990px) {
  input.credits-text-field.yak_filed_img.input.input-width-on-tablet {
    width: 80% !important;
  }
  .align-text-box-bar {
    display: flex;
    align-items: center;
  }
}

.edu_section_heading.endrosement_section_saved_heading[aria-expanded="true"]
  i.fas.fa-chevron-circle-down {
  transform: rotate(180deg);
  transition: all 0.3s ease-in-out;
}
.edu_section_heading.endrosement_section_saved_heading[aria-expanded="false"] {
  border-radius: 10px !important;
}

.edu_section_heading.endrosement_section_saved_heading[aria-expanded="true"] {
  border-radius: 10px 10px 0 0 !important;
}

.edu_section_heading.endrosement_section_saved_heading[aria-expanded="false"]
  i.fas.fa-chevron-circle-down {
  transition: all 0.3s ease-in-out;
  transform: rotate(0deg);
}

p.space-left-box-bar {
  padding-left: 30px !important;
}

.grey-text-color-endrosment,
input.credits-text-field.input.grey-text-color-endrosment,
select.select-item.select-item-job-name.input.mouseLeave.grey-text-color-endrosment {
  color: #767676 !important;
}

select.select-item.select-item-job-name.input.mouseLeave.grey-text-color-endrosment {
  border-radius: 100px !important;
}

.col-md-6.select-arrow-side.col-sm-6.job_name_finder.inputP55.arrow-up-style:before {
  right: 15px !important;
  top: 6px !important;
}

.endorsment-height-control {
  min-height: 55vh;
}
.btn-space-top-bar {
  margin-top: 57px !important;
}
.space-sides-design-control {
  padding: 0 30px !important;
}

.endorsment-input-check-box label {
  position: relative;
  font-size: 15px !important;
  top: 0 !important;
  left: 0 !important;
  color: #999999 !important;
  right: 0 !important;
  padding-left: 7px !important;
  margin: 0 !important;
}

.endorsment-input-check-box {
  display: flex;
  float: left;
}

.endorsment-input-check-box input {
  width: 15px !important;
}

/* .custom-control.custom-checkbox.form-check.form-check-inline.finder_job_check.space-control-label
  input,
  .custom-control.custom-checkbox.form-check.form-check-inline.finder_job_check input {
  position: absolute;
  width: 115px !important;
  border: 1px solid red !important;
  right: 0;
}

.custom-control.custom-checkbox.form-check.form-check-inline.finder_job_check.space-control-label {
  position: relative;
  margin: 0 20px;
}
*/

.white-height-box {
  min-height: 59vh !important;
}

.center-box-flex {
  display: flex;
  justify-content: space-evenly;
}
</style>
