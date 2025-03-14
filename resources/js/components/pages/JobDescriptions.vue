<template>
  <div>
    <!-- <headernav :education_enhacements="education_enhacements" :isLoggedIn="isLoggedIn" :currentpage="parseInt(7)"
      :page="parseInt(page)"></headernav> -->
    <section class="page-resume-editor page-contact-info">
      <div class="container">
        <div class="row alert_yak_finder" style="max-width: 85%; margin: 20px auto;">
          <div class="col-md-2">
            <img :src="EnvPath + 'images/bg/yak-port.png'" alt="YAK" />
          </div>
          <div class="col-md-10 col-sm-8 job_description_alert_text">
            <p>
              <span v-if="vovels.includes(pos_name.charAt(0).toLowerCase())">
                We want to custom tailor the descriptions of your previous jobs
                to highlight the responsibilities and qualities that are needed
                for an {{ pos_name }}.
              </span>
              <span v-else>
                We want to custom tailor the descriptions of your previous jobs
                to highlight the responsibilities and qualities that are needed
                for a {{ pos_name }}.
              </span>
              <span>
                Job descriptions are not the most compelling content on your
                resume, but we should use them to demonstrate that you have had
                similar responsibilities. I suggest that each job description
                contain the following 3 elements:
              </span>
              <span>
                1. Key responsibilities
                <br />2. Scope of responsibility (how many people you managed, budget,
                locations, etc)
                <br />3. Who (title) you reported to
              </span>
              <span>
                Example: Managed the marketing and lead generation for three
                major product lines. Supervised nine employees and multiple
                contractors. Reported to Chief Executive Officer
              </span>
            </p>
          </div>
          <span class="new_icon_close" id="click-to-add" @click="fieldTipHandler()">
            <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
      <div class="container experience_finder_right_container">
        <div class="row">
          <div class="col-md-2 job-discription-sidebar">
            <sidemenu :page="parseInt(6)" activePage="job_descriptions" step="2"></sidemenu>
          </div>
          <div class="col-md-10 grid-container experience_finder_rightside">
            <div class="" id="cross-finder">
            <div class="resume-editor-div space-control-top-upperbox">
              <h2 class="space-control-top-margin">
                <span class="icon">
                  <img :src="EnvPath + 'images/logo/job-description-icon.png'" />
                </span>
                Job Descriptions
              </h2>
                  <div id="accordionExample2">
                <div v-if="jobDescriptionsArray.length > 0"
                v-for="(job_descriprion, index2) in jobDescriptionsArray"
                v-bind:key="index2"
                class="education_enhancement_sections endrosement_section_saved"

              >

                <div class="endorement_saved_item">
                  <div class id="headingOne">
                    <div
                      @click="openJobDescription(index2)"
                      data-toggle="collapse"
                      :data-target="'#collapseOne' + index2"
                      aria-expanded="false"
                      aria-controls="collapseOne"
                      class="edu_section_heading endrosement_section_saved_heading"
                    >
                     <p>
                     Job:   {{ job_descriprion.job ? job_descriprion.job.company :   'enter job' }}
                      </p>
                    <p>
                     Scope:   {{ job_descriprion.scope }}
                      </p>
                      <p>Final statement: {{ job_descriprion.final_job_description}}</p>
                      <span class="icon">
                        <i class="fas fa-chevron-circle-down"></i>
                      </span>
                    </div>
                  </div>
                    <div
                    v-if="showEditJobDesc"
                    :id="'collapseOne' + index2"
                    aria-labelledby="headingOne"
                    data-parent="#accordionExample2"
                    class="edu_section_content collapse"
                  >

                    <div   class="col-md-12 col-sm-12 group mr-2 education_enhacement_content_section job-discription-font-size"
                  style="margin-top: 20px;">
                  <div class="education_enhancement_sections">
                    <div class="edu_section_heading job_description_position">
                      Select the position you would like to create a job
                      description for
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section select-arrow-side">
                        <select @change="change_selected_position($event.target.value)"  name="job_name" id
                          class="select-item select-item-job-name job-des--ot-clr color-grey-text"
                           style="appearance: none; padding-right: 28px !important"
                           >
                          <option value="0" class="label_name" selected>[Position], [Company]  </option>
                        <!-- here was job.description_id in icon -->
                          <option v-for="(job, j) in jobs" :value="j +1"  class="label_name" :key="j"
                          :selected="job.id == selectedJobId ? true : ''">
                            {{ job.position }}, {{ job.company }}
                            <span style="color:red !important;"  v-if="checkfinalJobDesc(job.id) ? true : ''">&#xf00c;</span>
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div  class="education_enhancement_sections">
                    <div v-if="checkJobCondition(current_update_position)"
                      class="edu_section_heading">Typical responsibilities of an {{ jobs[getPosition(current_update_position)].position
                      }}</div>
                    <div v-else class="edu_section_heading">Typical responsibilities of a {{ jobs[getPosition(current_update_position)].position
                    }}</div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin">
                        <div class="force-overflow space-right-contorl-mobile">
                          <div class="resposibilities_items_heading" style="background: none;">
                            <p style="max-width: 100%;">Relevant Responsibilities (pick no more than 2)</p>
                          </div>
                          <div v-for="(relevent_responsibiliti, res_index) in relevent_responsibilities"
                            :key="res_index" class="resposibilities_items_listing content-width-control">
                            <p v-if="jobs[getPosition(current_update_position)].end_month == 13">
                              {{ relevent_responsibiliti.quality_description }}</p>
                            <p v-else>{{ relevent_responsibiliti.quality_description }}</p>
                            <span class="icon">
                              <a style="text-decoration:none;" @click="addEditResposibility(relevent_responsibiliti,index2),addResposibility(relevent_responsibiliti)"
                              >
                                <i class="fas fa-plus"></i>
                              </a>
                            </span>
                          </div>

                          <div class="resposibilities_items_heading" style="background: none; margin-top: 10px;">
                            <p style="max-width: 100%;">Other Responsibilities</p>
                          </div>
                          <div v-for="(other_responsibiliti, res_index2) in other_responsibilities"
                            :key="res_index2 + relevent_responsibilities.length" class="resposibilities_items_listing content-width-control">
                            <p v-if="jobs[getPosition(current_update_position)].end_month == 13">
                              {{ other_responsibiliti.quality_description }}</p>
                            <p v-else>{{ other_responsibiliti.quality_description }}</p>
                            <span class="icon">
                              <a style="text-decoration:none;" @click="addEditResposibility(other_responsibiliti,index2)"
                                href="javascript:void(0)">
                                <i class="fas fa-plus"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div  class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="key_responsibilities_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Key
                      Responsibilities:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_textarea">
                        <textarea v-model="jobDescriptionsArray[index2].key_responsibilities" placeholder class="key_textrea input-textarea-box w-100 rounded-cureve-10"
                          @change="changeEditJobDescription(index2)"></textarea>
                      </div>
                    </div>
                  </div>
                  <div  class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="scope_of_responsibilities_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Scope
                      of Responsibility:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_field">
                        <input v-model="jobDescriptionsArray[index2].scope" type="text" value
                          placeholder="Managed 6 employees across multiple offices" class="credits-text-field"
                          @change="changeEditJobDescription(index2)" />
                      </div>
                    </div>
                  </div>
                  <div  class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="who_you_reported_to_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Who you
                      reported to:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_field">
                        <input v-model="jobDescriptionsArray[index2].reported_to" type="text" value placeholder="Reported to Chief Janitor"
                          class="credits-text-field" @change="changeEditJobDescription(index2)" />
                      </div>
                    </div>
                  </div>
                  <div  class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="final_job_description_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Final
                      Job Description
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_textarea">
                        <textarea v-model="jobDescriptionsArray[index2].final_job_description" placeholder class="key_textrea input-textarea-box w-100"></textarea>
                        <span v-if="final_job_description.length > 50" class="label" :class="
                          final_job_description.length > 200
                            ? 'success-red'
                            : final_job_description.length > 175
                              ? 'success-yellow'
                              : 'success-green'
                        ">
                          {{
                              final_job_description
                                .replace(/(^\s*)|(\s*$)/gi, "")
                                .replace(/[ ]{2,}/gi, " ")
                                .replace(/\n /, "\n")
                                .split(" ").length
                          }}
                          Words
                        </span>
                      </div>
                    </div>
                    <div
                      class="confirm confirm_finder mt-3"
                      style="
                        text-align: right;
                        display: inline-block;
                        width: 100%;
                      "
                    >
                      <i
                        class="fa fa-check-circle"
                        @click="editButton(index2)"
                        style="
                          font-size: 30px;
                          color: rgb(251, 100, 62);
                        "
                 ></i>
                      <i
                        class="fa fa-times-circle"
                        @click="cancelEditJobDescription(index2)"
                        style="
                          font-size: 30px;
                          color: rgb(251, 100, 62);
                        "
                      ></i>
                      <i
                        data-toggle="modal"
                        data-target="#exampleModal"
                          @click="deleteJobDescription(index2)"

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
                </div>
                   <!-- edit end here -->
                  </div>
                </div>
              </div>
              <div  class="row" style="max-width: 750px; margin: 0px auto !important;">
                <div v-if="showJobDesc" class="col-md-12 col-sm-12 group mr-2 education_enhacement_content_section job-discription-font-size"
                  style="margin-top: 20px;">
                  <div class="education_enhancement_sections">
                    <div class="edu_section_heading job_description_position">
                      Select the position you would like to create a job
                      description for
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section select-arrow-side">
                        <select @change="change_current_position"  name="job_name" id
                          class="select-item select-item-job-name job-des--ot-clr" style="font-family: 'Hind'; appearance: none; !important; padding-right: 28px !important" v-model="current_position">
                          <option value="0" class="label_name" style="font-family: 'Hind';" selected >[Position], [Company]</option>

                        <!-- here was job.description_id in icon -->
                          <option style='font-family: "Hind" !important;' v-for="(job, j) in jobs" :value="j + 1" class="label_name" :key="j">
                            {{ job.position }}, {{ job.company }}
                            <span style="color:red !important;" v-if="checkfinalJobDesc(job.id)"> &#xf00c</span>
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div v-if="current_position != 0" class="education_enhancement_sections">
                    <div v-if="vovels.includes(jobs[current_position - 1].position.charAt(0).toLowerCase())"
                      class="edu_section_heading">Typical responsibilities of an {{ jobs[current_position - 1].position
                      }}</div>
                    <div v-else class="edu_section_heading">Typical responsibilities of a {{ jobs[current_position
                        - 1].position
                    }}</div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin">
                        <div class="force-overflow space-right-contorl-mobile">
                          <div class="resposibilities_items_heading" style="background: none;">
                            <p style="max-width: 100%;">Relevant Responsibilities (pick no more than 2)</p>
                          </div>
                          <div v-for="(relevent_responsibiliti, res_index) in relevent_responsibilities"
                            :key="res_index" class="resposibilities_items_listing content-width-control">

                          <!-- {{ relevent_responsibiliti.quality_description }} -->

                            <p v-if="jobs[current_position - 1].end_month == 13">
                              {{ relevent_responsibiliti.quality_description }}</p>
                            <p v-else>{{ relevent_responsibiliti.quality_description }}</p>
                            <span class="icon">
                              <a style="text-decoration:none;" @click="addResposibility(relevent_responsibiliti)"
                              >
                                <i class="fas fa-plus"></i>
                              </a>
                            </span>
                          </div>

                          <div class="resposibilities_items_heading" style="background: none; margin-top: 10px;">
                            <p style="max-width: 100%;">Other Responsibilities</p>
                          </div>
                          <div v-for="(other_responsibiliti, res_index2) in other_responsibilities"
                            :key="res_index2 + relevent_responsibilities.length" class="resposibilities_items_listing content-width-control">
                            <p v-if="jobs[current_position - 1].end_month == 13">
                              {{ other_responsibiliti.quality_description }}</p>
                            <p v-else>{{ other_responsibiliti.quality_description }}</p>
                            <span class="icon">
                              <a style="text-decoration:none;" @click="addResposibility(other_responsibiliti)"
                                href="javascript:void(0)">
                                <i class="fas fa-plus"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="current_position != 0" class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="key_responsibilities_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Key
                      Responsibilities:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_textarea">
                        <textarea v-model="key_responsibilities" placeholder class="key_textrea input-textarea-box w-100"
                          @change="changeJobDescription"></textarea>
                      </div>
                    </div>
                  </div>
                  <div v-if="current_position != 0" class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="scope_of_responsibilities_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Scope
                      of Responsibility:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_field">
                        <input v-model="scope_of_responsibilities" type="text" value
                          placeholder="Managed 6 employees across multiple offices" class="credits-text-field"
                          @change="changeJobDescription" />
                      </div>
                    </div>
                  </div>
                  <div v-if="current_position != 0" class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="who_you_reported_to_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Who you
                      reported to:
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_field">
                        <input v-model="who_you_reported_to" type="text" value placeholder="Reported to Chief Janitor"
                          class="credits-text-field" @change="changeJobDescription" />
                      </div>
                    </div>
                  </div>
                  <div v-if="current_position != 0" class="education_enhancement_sections">
                    <div class="edu_section_heading edu_section_heading_logo">
                      <img v-tooltip="final_job_description_tip" :src="EnvPath + 'images/logo/yak-icon.png'" />Final
                      Job Description
                    </div>
                    <div class="edu_section_content">
                      <div class="edu_fields_section edu_section_textarea">
                        <textarea v-model="final_job_description" placeholder class="key_textrea input-textarea-box w-100"></textarea>
                        <span v-if="final_job_description.length > 50" class="label" :class="
                          final_job_description.length > 200
                            ? 'success-red'
                            : final_job_description.length > 175
                              ? 'success-yellow'
                              : 'success-green'
                        ">
                          {{
                              final_job_description
                                .replace(/(^\s*)|(\s*$)/gi, "")
                                .replace(/[ ]{2,}/gi, " ")
                                .replace(/\n /, "\n")
                                .split(" ").length
                          }}
                          Words
                        </span>
                      </div>
                    </div>
                    <div
                      class="confirm confirm_finder mt-3"
                      style="
                        text-align: right;
                        display: inline-block;
                        width: 100%;
                      "
                    >
                      <i
                        class="fa fa-check-circle"
                        @click="saveButton()"
                        style="
                          font-size: 30px;
                          color: rgb(251, 100, 62);
                        "
                      ></i>


                      <i
                        class="fa fa-times-circle"
                        @click="cancelJobDescription()"

                        style="
                          font-size: 30px;
                          color: rgb(251, 100, 62);
                        "
                      ></i>
                    </div>
                  </div>
                </div>
                  <button
                  v-if="showAddNew"
                          type="button" class="btn btn-block add_new_btn add-new-block add-new-button-box"
                          @click="addNew"
                          style="border: 3px solid rgb(230, 230, 230);color: rgb(200, 200, 200);padding: 11px 0px;font-size: 18px;border-radius: 6px;">+ Add New  </button>

                <div class="text-center" style="display: block; margin: 15px auto 10px;">
                  <button @click="moveNext" class="btn1 btn-rounded btn-next mt-0 space-none-mobile-box btn-text-arrow-right mt-4">
                    <span style="margin-left: -14px;">Next</span>
                    <span class="pl-1">
                      <i class="next-icon fas fa-chevron-right"></i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
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
                      <i class="fas fa-circle" style="color: rgb(102, 105, 109); font-size: 25%;"></i>
                    </li>
                    <li>
                      <a href>
                        <strong>Privacy Policy</strong>
                      </a>
                      <i class="fas fa-circle" style="color: rgb(102, 105, 109); font-size: 25%;"></i>
                    </li>
                    <li>
                      <a href>
                        <strong>Terms of Use</strong>
                      </a>
                      <i class="fas fa-circle" style="color: rgb(102, 105, 109); font-size: 25%;"></i>
                    </li>
                    <li>
                      <a href>
                        <strong>About Us</strong>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-5 col-sm-12">
                  <p class="text-center">2024 Resume Yak. All rights reserved</p>
                </div>
              </div>
            </div>
          </div>
        </div>

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
                      You must complete all of the fields to go further.
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
         <div class="popup-container" v-if="jobDescriptionRepeat">
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
                     You have already added description against this job! Please choose another job.
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

        <div v-if="showAddDescriptionPopUp" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Surprise.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Alert!</h4>
                  <p>
                    Please add details against all jobs.
                  </p>
                  <div class="popup-btn-fixes btns-align-popup justify-content-center">
                    <button
                      @click="closeAddJobPopup"
                      class="btnOption btn-rounded"
                      style="float: left"
                    >
                      OK
                    </button>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>

       <div v-if="showDeleteJobDescription" class="popup-container">
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
                    Are you sure you want to delete this Job Description (Did you
                    make this Job Description up)?
                  </p>
                  <div class="popup-btn-fixes btns-align-popup">
                    <button
                      @click="cancelDeleteJobDesc(currentIndex)"
                      class="btnOption btn-rounded"
                      style="float: left"
                    >
                      No
                    </button>
                    <button
                      @click="confirmDeleteJobDesc(currentIndex)"
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

      <div v-if="alertPopupMessage" class="popup-container">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img src="images/logo/Surprise.png" alt="Confused" />
                </div>
                <div class="col-8">
                  <h4>Alert!</h4>
                  <p>
                    {{alertPopupMessage}}
                  </p>
                  <div class="popup-btn-fixes btns-align-popup justify-content-center">
                    <button
                      @click="closeAddJobPopup"
                      class="btnOption btn-rounded"
                      style="float: left"
                    >
                      OK
                    </button>

                  </div>
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
import resumeSidemenu from "./resumeSidemenu";
import sidemenu from "../sidemenu";
import { environment_api } from "../../env";
import store from "../../store";
import { mapGetters } from "vuex";

// import headernav from "./header_nav";

export default {
  name: "job_descriptions",
  data() {
    return {
      alertPopupMessage:'',
      showAddDescriptionPopUp: false,
      res_count: 0,
      showEditJobDesc: false,
      edit_job_position_id: 0,
      current_update_position: 0,
      selectedJobId: 0,
      showDeleteJobDescription: false,
      showJobDesc: false,
      edit_job_description_id: 0,
      currentIndex: -1,
      showAddNew: false,
      jobDescriptionsArray: [],
      EnvPath: environment_api.api_base_url,
      pos_name: "",
      vovels: ["a", "e", "i", "o", "u"],
      jobs: [],
      current_position: 0,
      current_team: 0,
      key_responsibilities: "",
      scope_of_responsibilities: "",
      who_you_reported_to: "",
      final_job_description: "",
      key_responsibilities_tip: "",
      scope_of_responsibilities_tip: "",
      who_you_reported_to_tip: "",
      final_job_description_tip: "",
      resume_id: localStorage.getItem("resume_id"),
      position_id: 0,
      other_responsibilities: [],
      relevent_responsibilities: [],
      job_description_id: 0,
      isLoggedIn: this.$store.state.isLoggedIn,
      // page: this.$store.state.contact_Data.page,
      page: "2",
      education_enhacements: false,
      notValid: false,
      jobDescriptionRepeat: false,
      edit: false,
      delete: false,
      //Resume_Name: ""
    };
  },
  components: {
    resumeSidemenu,
    sidemenu,
  },
  mounted() {
    store.commit("storeCurrentPage", 6);
    localStorage.setItem("CurrentPage", 6);
    var that = this;
    this.$store.state.ResumeName_Data.data.map(function (value, id) {
      if (value.resume_id == that.resume_id) {
        that.pos_name = value.pos_name;
        that.position_id = value.position_id;
      }
    });

    axios
      .post(this.EnvPath + "get-all-jobs", {
        user_id: this.$store.state.contact_Data.id,
        resume_id: this.resume_id,
      })
      .then(({ data }) => {
        if (data.status == 1) {
          //update jobs
          this.jobs = data.jobs;
          let that = this;
          data.tips.forEach(function (e) {
            //code
            if (e.FIELD == "key_responsibilities") {
              that.key_responsibilities_tip = e.tip;
            } else if (e.FIELD == "scope_of_responsibilities") {
              that.scope_of_responsibilities_tip = e.tip;
            } else if (e.FIELD == "who_you_reported_to") {
              that.who_you_reported_to_tip = e.tip;
            } else if (e.FIELD == "final_job_description") {
              that.final_job_description_tip = e.tip;
            }
          });
        }
      });

    this.education_enhacements_menu();
    this.getJobDescriptionsForResume();
  },
  computed: {
    ...mapGetters(["getUserData", "getCurrentResume", "getJobDescriptions"]),
  },
  methods: {

    closeAddJobPopup() {
      this.showAddDescriptionPopUp = false;
      this.alertPopupMessage  = '';
    },
    checkfinalJobDescEdit: function (res_job_id, actual_job_id) {
      if (res_job_id !== actual_job_id) {
        return this.checkfinalJobDesc(actual_job_id);
      }
    },
    checkfinalJobDesc: function (job_id) {
      var find_j_index = this.jobDescriptionsArray.findIndex(
        (item) => item.job_id == job_id
      );
      if (find_j_index !== -1) {
        return true;
      } else {
        return false;
      }
    },
    cancelDeleteJobDesc(index) {
      this.showDeleteJobDescription = false;
      //  $("#collapseOne" + index).collapse("hide");
    },
    cancelEditJobDescription(index) {
      $("#collapseOne" + index).collapse("hide");
    },
    cancelJobDescription() {
      this.current_position = 0;
      this.key_responsibilities = "";
      this.scope_of_responsibilities = "";
      this.who_you_reported_to = "";
      this.final_job_description = "";
      this.job_description_id = 0;
      // this.showAddNew = true;
      this.showEditJobDesc = false;
    },

    checkJobCondition: function (c_position) {
      if (c_position == 0) {
        return this.vovels.includes(
          this.jobs[0].position.charAt(0).toLowerCase()
        );
      } else {
        return this.vovels.includes(
          this.jobs[c_position - 1].position.charAt(0).toLowerCase()
        );
      }
    },
    getPosition: function (c_position) {
      if (c_position == 0) {
        return 0;
      } else {
        return [c_position - 1];
      }
    },
    getJobDescriptionsForResume: function () {
      axios
        .get(
          this.EnvPath +
            "api/get-resume-job-descriptions/" +
            this.getCurrentResume.resume_id
        )
        .then(({ data }) => {
          if (data.status) {
            this.jobDescriptionsArray = data.data;
          } else {
            this.jobDescriptionsArray = [];
          }
          console.log(this.jobDescriptionsArray.length,'this.jobDescriptionsArray.length');
          this.showAddNew = this.jobDescriptionsArray.length > 0 ? true : false;
          this.showJobDesc =
          this.jobDescriptionsArray.length > 0 ? false : true;
          // store.commit("storeJobDescriptions", data.data);
        });
    },
    addNew() {
      this.showJobDesc = true;
      this.showAddNew = false;
      this.showEditJobDesc = false;
      this.res_count = 0;
      this.current_position = 0;
      this.key_responsibilities = "";
      this.scope_of_responsibilities = "";
      this.who_you_reported_to = "";
      this.final_job_description = "";
      this.job_description_id = 0;
    },
    openJobDescription(index2) {
      this.selectedJobId = 0;
      if (this.jobDescriptionsArray[index2]) {
        this.showAddNew = true;
        this.showEditJobDesc = true;
        this.showJobDesc = false;
        this.edit_job_description_id = this.jobDescriptionsArray[index2].id;
        this.selectedJobId = this.jobDescriptionsArray[index2].job_id;
        var j_id_index = this.jobs.findIndex(
          (item) => item.id === this.jobDescriptionsArray[index2].job_id
        );
        if (j_id_index != -1) {
          let new_index = j_id_index + 1;
          this.change_selected_position(new_index);
        }

        // this.cancelEndorsment(-1);
        // if (this.currentIndex != index2) {
        //   this.currentIndex = index2;
        // } else {
        //   this.currentIndex = -1;
        // }
      }
    },
    deleteJobDescription(index) {
      this.showDeleteJobDescription = true;
      this.currentIndex = index;
    },
    closePoup: function () {
      this.notValid = false;
      this.jobDescriptionRepeat = false;
    },
    fieldTipHandler: function () {
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
    change_selected_position: function (job_position_id) {
      if(job_position_id == 0){
        this.edit_job_position_id = 0;
        this.alertPopupMessage = 'Select position and company from given options.'
        return
      }

      this.res_count = 0;
      this.edit_job_position_id = job_position_id;
      // this.current_update_position = 0;
      this.current_update_position = job_position_id;
      this.edit_job_position_id = job_position_id;
      if (this.jobs[job_position_id - 1].description_id) {
        this.job_description_id = this.jobs[job_position_id - 1].description_id;
        this.key_responsibilities =
          this.jobs[job_position_id - 1].key_responsibilities;
        this.scope_of_responsibilities = this.jobs[job_position_id - 1].scope;
        this.who_you_reported_to = this.jobs[job_position_id - 1].reported_to;
        this.final_job_description =
          this.jobs[job_position_id - 1].final_job_description;
      } else {
        this.job_description_id = 0;
        this.key_responsibilities = "";
        this.scope_of_responsibilities = "";
        this.who_you_reported_to = "";
        this.final_job_description = "";
      }

      axios
        .post(this.EnvPath + "get-resposibilities", {
          position_job: this.jobs[job_position_id - 1].position_id,
          position_resume: this.position_id,
        })
        .then(({ data }) => {
          if (data.status == 1) {
            this.relevent_responsibilities = data.relevent_responsibilities;
            this.other_responsibilities = data.other_responsibilities;
          }
        });
    },
    change_current_position: function () {
      this.res_count = 0;
      if (this.jobs[this.current_position - 1].description_id) {
        this.job_description_id =
          this.jobs[this.current_position - 1].description_id;
        this.key_responsibilities =
          this.jobs[this.current_position - 1].key_responsibilities;
        this.scope_of_responsibilities =
          this.jobs[this.current_position - 1].scope;
        this.who_you_reported_to =
          this.jobs[this.current_position - 1].reported_to;
        this.final_job_description =
          this.jobs[this.current_position - 1].final_job_description;
      } else {
        this.job_description_id = 0;
        this.key_responsibilities = "";
        this.scope_of_responsibilities = "";
        this.who_you_reported_to = "";
        this.final_job_description = "";
      }

      axios
        .post(this.EnvPath + "get-resposibilities", {
          position_job: this.jobs[this.current_position - 1].position_id,
          position_resume: this.position_id,
        })
        .then(({ data }) => {
          if (data.status == 1) {
            this.relevent_responsibilities = data.relevent_responsibilities;
            this.other_responsibilities = data.other_responsibilities;
            if (
              this.key_responsibilities != "" ||
              this.scope_of_responsibilities != "" ||
              this.who_you_reported_to != "" ||
              this.final_job_description != ""
            ) {
              this.saveJobDescription(false);
            }
          }
        });
    },
    saveJobDescription: function (isNextbutton) {
      axios
        .post(this.EnvPath + "save_jobdescription", {
          job_id: this.jobs[this.current_position - 1].id,
          resume_id: this.resume_id,
          key_responsibilities: this.key_responsibilities,
          scope_of_responsibilities: this.scope_of_responsibilities,
          who_you_reported_to: this.who_you_reported_to,
          final_job_description: this.final_job_description,
          job_description_id: this.job_description_id,
        })
        .then((data) => {
          if (data.data) {
            // this.getJobDescriptions.push(data.data);
            this.jobDescriptionsArray.push(data.data.data);
            // store.commit("storeJobDescriptions", this.getJobDescriptions);
            this.current_position = 0;
            this.key_responsibilities = "";
            this.scope_of_responsibilities = "";
            this.who_you_reported_to = "";
            this.final_job_description = "";
            this.job_description_id = 0;
            this.showAddNew = true;
            this.showJobDesc = false;
          }

          // if (data.success == true) {
          // DO  NOT REMOVE
          // this.jobs[this.current_position - 1].description_id =
          //   this.job_description_id;
          // this.jobs[this.current_position - 1].key_responsibilities =
          //   this.key_responsibilities;
          // this.jobs[this.current_position - 1].scope =
          //   this.scope_of_responsibilities;
          // this.jobs[this.current_position - 1].reported_to =
          //   this.who_you_reported_to;
          // this.jobs[this.current_position - 1].final_job_description =
          //   this.final_job_description;

          if (isNextbutton) {
            //next button
            // let finishedDescription = true;
            // this.jobs.forEach(function (job) {
            //   if (!job.description_id) {
            //     finishedDescription = false;
            //   }
            // });
            // if (finishedDescription) {
            //all jobdescriptions are finished
            axios
              .post(this.EnvPath + "save-employment-description", {
                resume_id: this.resume_id,
              })
              .then(({ data }) => {
                if (data.success == true) {
                }
              });
            // }
          } else {
            this.key_responsibilities = "";
            this.scope_of_responsibilities = "";
            this.who_you_reported_to = "";
            this.final_job_description = "";
            this.job_description_id = 0;
          }

          // }
        });
    },
    moveNext: function () {
      var status = this.checkAllJobDescriptionsAdded();
      if (status) {
        if (this.getCurrentResume && this.getCurrentResume.last_step < 7) {
          var data = {
            r_id: this.getCurrentResume.resume_id,
            step: 7,
          };
          this.$store.dispatch("updateResumeLastStep", data);
          store.commit("storePageCount", 7);
          localStorage.setItem("pageCount", 7);
        }
        this.$router.push({ name: "skills" });
      }
    },
    checkAllJobDescriptionsAdded: function () {
      if (this.jobDescriptionsArray.length == this.jobs.length) {
        this.showAddDescriptionPopUp = false;
        return true;
      } else {
        this.showAddDescriptionPopUp = true;
        return false;
      }
    },
    editButton: function (index) {
      if(this.edit_job_position_id == 0){
        this.alertPopupMessage = 'Select position and company from given options.'
        return
      }
      if (
        this.jobDescriptionsArray[index].key_responsibilities != "" ||
        this.jobDescriptionsArray[index].scope != "" ||
        this.jobDescriptionsArray[index].reported_to != "" ||
        this.jobDescriptionsArray[index].final_job_description != ""
      ) {
        var checkJob = this.checkfinalJobDescEdit(
          this.jobDescriptionsArray[index].job_id,
          this.jobs[this.edit_job_position_id - 1].id
        );
        if (checkJob) {
          this.jobDescriptionRepeat = true;
        } else {
          this.jobDescriptionRepeat = false;
          this.updateJobDescription(index, false);
        }
      } else {
        this.notValid = true;
      }
    },

    updateJobDescription: function (index, isNextbutton) {
      axios
        .post(this.EnvPath + "update_jobdescription", {
          job_id: this.jobs[this.edit_job_position_id - 1].id,
          resume_id: this.resume_id,
          key_responsibilities:
            this.jobDescriptionsArray[index].key_responsibilities,
          scope_of_responsibilities: this.jobDescriptionsArray[index].scope,
          who_you_reported_to: this.jobDescriptionsArray[index].reported_to,
          final_job_description:
            this.jobDescriptionsArray[index].final_job_description,
          job_description_id: this.edit_job_description_id,
        })
        .then((data) => {
          if (data.data) {
            var db_index = this.jobDescriptionsArray.findIndex(
              (el) => el.id == data.data.data.id
            );
            this.jobDescriptionsArray.splice(db_index, 1);
            this.jobDescriptionsArray.push(data.data.data);

            // this.current_position = 0;
            // this.key_responsibilities = "";
            // this.scope_of_responsibilities = "";
            // this.who_you_reported_to = "";
            // this.final_job_description = "";
            this.job_description_id = 0;
            this.showAddNew = true;
            this.showEditJobDesc = false;
          }

          if (data.success == true) {
            this.jobs[this.current_position - 1].description_id =
              this.job_description_id;
            this.jobs[this.current_position - 1].key_responsibilities =
              this.key_responsibilities;
            this.jobs[this.current_position - 1].scope =
              this.scope_of_responsibilities;
            this.jobs[this.current_position - 1].reported_to =
              this.who_you_reported_to;
            this.jobs[this.current_position - 1].final_job_description =
              this.final_job_description;

            if (isNextbutton) {
              //next button
              let finishedDescription = true;
              this.jobs.forEach(function (job) {
                if (!job.description_id) {
                  finishedDescription = false;
                }
              });
              if (finishedDescription) {
                //all jobdescriptions are finished
                axios
                  .post(this.EnvPath + "save-employment-description", {
                    resume_id: this.resume_id,
                  })
                  .then(({ data }) => {
                    if (data.success == true) {
                    }
                  });
              }
            } else {
              this.key_responsibilities = "";
              this.scope_of_responsibilities = "";
              this.who_you_reported_to = "";
              this.final_job_description = "";
              this.job_description_id = 0;
            }
          }
        });
    },
    saveButton: function () {
      if (
        this.key_responsibilities != "" ||
        this.scope_of_responsibilities != "" ||
        this.who_you_reported_to != "" ||
        this.final_job_description != ""
      ) {
        var checkJob = this.checkfinalJobDesc(
          this.jobs[this.current_position - 1].id
        );
        if (checkJob) {
          this.jobDescriptionRepeat = true;
        } else {
          this.jobDescriptionRepeat = false;
          this.saveJobDescription(true);
        }
      } else {
        this.notValid = true;
      }
    },
    changeEditJobDescription: function (index) {
      this.update_Final_Job_Description_Edit(index);
    },

    update_Final_Job_Description_Edit: function (index) {
      //need to add pieriod
      let scope_of_responsibilities_period = "";
      let who_you_reported_to_period = "";

      if (
        this.jobDescriptionsArray[index].scope.charAt(
          this.jobDescriptionsArray[index].scope.length - 1
        ) != "."
      ) {
        scope_of_responsibilities_period = ".";
      }

      if (
        this.jobDescriptionsArray[index].reported_to.charAt(
          this.jobDescriptionsArray[index].reported_to.length - 1
        ) != "."
      ) {
        who_you_reported_to_period = ".";
      }
      // if (
      //   this.scope_of_responsibilities.charAt(
      //     this.scope_of_responsibilities.length - 1
      //   ) != "."
      // ) {
      //   scope_of_responsibilities_period = ".";
      // }

      // if (
      //   this.who_you_reported_to.charAt(this.who_you_reported_to.length - 1) !=
      //   "."
      // ) {
      //   who_you_reported_to_period = ".";
      // }
      this.jobDescriptionsArray[index].final_job_description =
        this.jobDescriptionsArray[index].key_responsibilities;
      // this.final_job_description = this.key_responsibilities;

      if (this.jobDescriptionsArray[index].scope != "") {
        this.jobDescriptionsArray[index].final_job_description +=
          " " +
          this.jobDescriptionsArray[index].scope +
          scope_of_responsibilities_period;
      }

      if (this.jobDescriptionsArray[index].reported_to != "") {
        this.jobDescriptionsArray[index].final_job_description +=
          " " +
          this.jobDescriptionsArray[index].reported_to +
          who_you_reported_to_period;
      }
    },

    changeJobDescription: function () {
      this.update_Final_Job_Description();
    },

    update_Final_Job_Description: function () {
      //need to add pieriod
      let scope_of_responsibilities_period = "";
      let who_you_reported_to_period = "";

      if (
        this.scope_of_responsibilities.charAt(
          this.scope_of_responsibilities.length - 1
        ) != "."
      ) {
        scope_of_responsibilities_period = ".";
      }

      if (
        this.who_you_reported_to.charAt(this.who_you_reported_to.length - 1) !=
        "."
      ) {
        who_you_reported_to_period = ".";
      }

      this.final_job_description = this.key_responsibilities;
      if (this.scope_of_responsibilities != "") {
        this.final_job_description +=
          " " +
          this.scope_of_responsibilities +
          scope_of_responsibilities_period;
      }
      if (this.who_you_reported_to != "") {
        this.final_job_description +=
          " " + this.who_you_reported_to + who_you_reported_to_period;
      }
    },
    confirmDeleteJobDesc(index) {
      axios
        .post(this.EnvPath + "delete-job-description", {
          job_description_id: this.jobDescriptionsArray[index].id,
          resume_id: this.resume_id,
        })
        .then(({ data }) => {
          if (data.status) {
            this.jobDescriptionsArray.splice(index, 1);
            this.showDeleteJobDescription = false;
            this.currentIndex = -1;
          }
        });
    },
    addResposibility: function (responsibiliti) {
      this.res_count = this.res_count + 1;
      if (this.res_count > 2) {
        this.alertPopupMessage = 'You can not add more then 2 responsibilities';
        return false;
      }
      let period = "";
      if (this.jobs[this.current_position - 1].end_month == 13) {
        if (
          responsibiliti.quality_description.charAt(
            responsibiliti.quality_description.length - 1
          ) != "."
        ) {
          period = ".";
        }
        this.key_responsibilities =
          this.key_responsibilities +
          " " +
          responsibiliti.quality_description +
          period;
      } else {
        if (
          responsibiliti.quality_description.charAt(
            responsibiliti.quality_description.length - 1
          ) != "."
        ) {
          period = ".";
        }
        this.key_responsibilities =
          this.key_responsibilities +
          " " +
          responsibiliti.quality_description +
          period;
      }

      this.update_Final_Job_Description();
    },
    addEditResposibility: function (responsibiliti, index) {
      let period = "";
      if (this.jobs[this.edit_job_position_id - 1].end_month == 13) {
        if (
          responsibiliti.quality_description.charAt(
            responsibiliti.quality_description.length - 1
          ) != "."
        ) {
          period = ".";
        }
        this.jobDescriptionsArray[index].key_responsibilities =
          this.jobDescriptionsArray[index].key_responsibilities +
          "" +
          responsibiliti.quality_description +
          period;
        // this.key_responsibilities =
        //   this.key_responsibilities +
        //   " " +
        //   responsibiliti.quality_description +
        //   period;
      } else {
        if (
          responsibiliti.quality_description.charAt(
            responsibiliti.quality_description.length - 1
          ) != "."
        ) {
          period = ".";
        }
        // this.key_responsibilities =
        //   this.key_responsibilities +
        //   " " +
        //   responsibiliti.quality_description +
        //   period;
        this.jobDescriptionsArray[index].key_responsibilities =
          this.jobDescriptionsArray[index].key_responsibilities +
          "" +
          responsibiliti.quality_description +
          period;
      }
      this.update_Final_Job_Description_Edit(index);
    },
  },
};
</script>

<style>
/* width */
.input-textarea-box::-webkit-scrollbar {
  width: 7px;
}

/* Track */
.input-textarea-box::-webkit-scrollbar-track {
  background-color: #e9e9eb;
  border-radius: 10px;
}

/* Handle */
.input-textarea-box::-webkit-scrollbar-thumb {
  background: #9e9f9f;
  border-radius: 10px;
}

@media (max-width: 770px) {
  button.btn1.btn-rounded.btn-next.mt-0.space-none-mobile-box {
    margin-top: 0 !important;
  }
}
@media (max-width: 450px) {
  .space-right-contorl-mobile {
    margin-right: 10px !important;
  }
  .content-width-control p {
    width: 80% !important;
  }
  .job-discription-font-size .edu_section_heading {
    font-size: 18px;
  }
  div#cross-finder .resume-editor-div h2.space-control-top-margin {
    margin-top: 0;
  }
  .resume-editor-div.space-control-top-upperbox.space-control-top-upperbox {
    padding: 30px 15px 27px 15px;
  }
  .popup-btn-fixes.btns-align-popup {
    flex-direction: column;
    margin-bottom: 10px;
  }
  .popup-btn-fixes.btns-align-popup button.btnOption.btn-rounded:first-child {
    margin-bottom: 10px;
  }
}

.edu_section_content
  .edu_fields_section.edu_section_textarea
  textarea.key_textrea.input-textarea-box.w-100,
.education_enhancement_sections
  .edu_section_content
  .edu_fields_section.edu_section_textarea
  textarea.key_textrea.input-textarea-box.w-100 {
  border-radius: 10px !important;
}

.edu_fields_section.select-arrow-side
  select.select-item.select-item-job-name.job-des--ot-clr {
  color: #767676 !important;
}

.resume-editor-div.space-control-top-upperbox {
  padding: 25px 15px 40px 15px;
}
</style>
