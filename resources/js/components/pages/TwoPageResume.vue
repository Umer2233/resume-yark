<template>
  <div>
    <div>
      <!-- Header Part -->
      <section class="page-resume-editor page-contact-info">
        <div
          class="container page-cv-design-main-container second-template-main-container"
        >
          <div class="row">
            <SideBar
              :resume="resume"
              @clicked-show-detail="clickedShowDetailModal"
              @hide-email="hideEmail"
              @hide-phone="hidePhone"
              @hide-middle="hideMiddle"
              @hide-pro="hidePro"
              @hide-physical-address="hidePhysicalAddress"
              @hide-web="hideWeb"
              @is-date="isDateFun"
              @is-month-year="isMonthYearFun"
              @is-year="isYearFun"
              @is-location-work="isLocationWork"
              @is-city-scw="isCityStateCountryWork"
              @is-city-sw="isCitySCWork"
              @hide-job-description="isJobDescriptionn"
              @is-month-year-g="isMonthYearFunG"
              @is-year-g="isYearG"
              @is_edu_city_state="isEduCityState"
              @is_edu_city_state_country="isEduCityStateCountry"
              @is_edu_location="isEduLocation"
              @is-skill="isSKill"
              @is-color="isColor"
              @is_info_location="infoLocation"
              @is_info_city_state="infoCityState"
              @is_info_full-address="infoFullAddress"
              @is_info_full_address_city="infoFullAddressCity"
              @get-heading-font="getHeadingFont"
              @get-top-bottom-margin="getTopBottomMargin"
              @get-sub-heading-font="getSubHeadingFont"
              @get-body-font-size="getBodyFontSize"
              @get-template-font="getTemplateFont"
              @get-left-right-margin="getLeftRightMargin"
              @get_heading_spacing="getHeadingSpacing"
              @get_sub_heading_spacing="getSubHeadingSpacing"
              @get_body_text_spacing="getBodyTextSpacing"
              @get_indend_spacing="getIndendSpacing"
              @select-template="selectTemplate"
              @delete-subsection-popup="deleteSubsectionPopup"
              @delete-new-subsection-popup="deleteNewSecitonPopup"
              @get-endorsement="getendorsement"
              @delete-new-section="deleteNewSection"
              @get-sorting="getSorting"
              @get-job-sorting="getJobSorting"
              @get-main-section-sorting="getMainSectionSorting"
              @get-experience-sorting="getExpSorting"
              @get-minor-sorting="getMinorSorting"
              @get-education-sorting="getEduSorting"
              @get-job-sorting-preview="getJobSortingPreview"
              @get-prosumm-subsec-sorting-preview="getProSummSubSectionPreview"
              @get-edu-subsection-preview="getEduSubSectionPreview"
              @get-edu-sorting-preview="getEduSortingPreview"
              @change-pro-section-title="changeProSectionTitle"
              @change-edu-section-title="changeEduSectionTitle"
              @change-pro-summ-section-title="changeProSummSectionTitle"
              @showHideEmitted="showHideEmitted"
              @UserInfoUpdate="UserInfoUpdate"
              @update-resume-formatting="updateResumeFormatting"
              @change-section-column="changeSectionColumn"
              @get-resume-detail="getResumeDetails"
              @change-edu-options="changeEduOptions"
              @create-edu-sub-section="createEduSubSection"
              @store-sub-section="storeEduSubSection"
              @create-new-section="createNewSection"
              @delete-edu-subsection-content="deleteEduSubsectionContent"
              @store-sub-section-content="storeEduSubSectionContent"
              @store-skill-sub-section-content="storeSkillSubSectionContent"
              @remove-res-exp-pro-sum-sub-section="removeResExpProSumSubSection"
              @show-validation-eduSubContent="showValidationEduSubSection"
              @show-validation-pro-summ-subsecion="
                showValidationProSummSubSection
              "
              @create-res-exp-sub-section="createResExpSubSection"
              @get-edu-sub-content-sorting="getEduSubContentSorting"
              @store-new-section-update="storeNewSectionUpdate"
              @downloadPdf="downloadPdf"
            ></SideBar>
            <div
              v-if="
                resume.template_id == 1 ||
                resume.template_id == 2 ||
                resume.template_id == 3 ||
                resume.template_id == 4 ||
                resume.template_id == 5
              "
              class="col-md-8 cv_design_right_container"
            >
              <component
                :is="currentComponent"
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></component>

              <!-- <forth-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></forth-template> -->

              <!-- <resume-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></resume-template>

              <first-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></first-template>

              <second-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></second-template> -->

              <!-- <third-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></third-template> -->

              <!-- <forth-template
                :resume="resume"
                :showHideContent="showHideContent"
                :downloadResume="downloadResume"
              ></forth-template> -->
            </div>
            <div v-else class="col-md-8 cv_design_right_container my-4">
              <div
                class="container resume-design-div2"
                :style="
                  'letter-spacing:' +
                  resume.body_text_spacing +
                  'px;' +
                  'text-indent:' +
                  resume.indent_spacing +
                  'px'
                "
              >
                <div
                  class="my-1 main-container second-template-main-container"
                  :style="
                    'margin-top:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px' +
                    ';margin-bottom:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px' +
                    ';margin-right:' +
                    (resume.left_right_margin / 10) * 96 +
                    'px' +
                    ';margin-left:' +
                    (resume.left_right_margin / 10) * 96 +
                    'px'
                  "
                  v-if="resume.resume_sections"
                >
                  <div
                    v-for="(resumesection, key) in resume.resume_sections"
                    :key="key"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div id="footer-bg"><img src="images/bg/footer-bg.png" /></div>
      <div id="clouds-bg"><img src="images/bg/clouds-bg.png" /></div>
    </div>
    <div id="resume_complete_preview_container">
      <span class="close_pop_up" @click="hidePreview()"
        ><i class="fa fa-times-circle"></i
      ></span>
      <div
        class="resume_compplete_preview_sub_container scrollbar scrollbar-indigo bordered-indigo thin"
      >
        <div class="resume-design-div">
          <h2
            class="resume-title"
            :style="
              'color:' + resume.color
                ? resume.color.primaryy_color
                : '' + ';font-size:' + resume.heading_font_size + 'px'
            "
          >
            {{ resume.user ? resume.user.first_name + " " : "" }}
            <span
              v-if="resume.resume_setting && resume.resume_setting.is_middle"
              >{{ resume.user ? resume.user.middle_initial : "" }}</span
            >
            {{ resume.user ? resume.user.last_name : "" }}
          </h2>
          <hr
            noshade
            size="100%"
            style="
              height: 3px;
              background: #ecf6f6;
              border: 0px;
              margin-bottom: 7px;
            "
          />
          <div
            class="container margin-remove-1024"
            v-if="getContactSortedItemsFromState"
          >
            <div class="resume_info_sub_section row d-flex flex-row">
              <div class="resume_contact_section col-md-12">
                <div class="container">
                  <div class="row">
                    <div
                      v-for="(
                        item, key
                      ) in getContactSortedItemsFromState.slice(0, 5)"
                      :key="key"
                      class="col-md-4 contact_email"
                    >
                      <div
                        class="pb-3"
                        v-if="item.type == 'blank'"
                        style="color: black"
                      >
                        <span>
                          <span class="icon"></span>
                        </span>
                      </div>
                      <div class="pb-3" v-if="getContactDataByType(item.type)">
                        <span>
                          <span class="icon"
                            ><i
                              :class="getContactIconClassByType(item)"
                            ></i></span
                          >{{ getContactDataByType(item.type) }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="resume_info_sub_section">
              <div class="resume_contact_section">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 contact_email resume-text-control">
                      <span class="icon"><i class="fa fa-envelope"></i></span>
                      <p>{{ resume.user ? resume.user.email : "" }}</p>
                    </div>

                    <div class="col-md-4 contact_phone">
                      <span class="icon"><i class="fa fa-phone-alt"></i></span>
                      {{ resume.user ? resume.user.phone : "" }}
                    </div>
                    <div
                      class="col-md-4 professional_profile mb-1"
                      v-if="
                        resume.resume_setting &&
                        resume.resume_setting.is_pro &&
                        resume.user.professional_profile != null
                      "
                    >
                      <span>
                        <span class="icon profile-icon"
                          ><i class="fa fa-user" s></i
                        ></span>
                        <span class="ml-1">
                          {{
                            resume.user ? resume.user.professional_profile : ""
                          }}
                        </span>
                      </span>
                    </div>

                    <div
                      class="col-md-4 professional_profile mb-1"
                      v-if="
                        resume.resume_setting.is_web &&
                        resume.user.website != null
                      "
                    >
                      <span>
                        <span class="icon profile-icon"
                          ><i class="fa fa-globe"></i
                        ></span>
                        <span class="ml-1">
                          {{ resume.user ? resume.user.website : "" }}
                        </span>
                      </span>
                    </div>
                    <div class="col-md-4 contact_loc" v-if="getAddress">
                      <span class="icon"
                        ><i class="fa fa-map-marker-alt"></i
                      ></span>
                      {{ getAddress }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="resume_info_sub_section">
            <div class="endorsments_resume_list">
              <p>
                “ Richard is one of the best employees that has ever worked for
                me ”
              </p>
              <span>– Scott Keynes, COO, World Information Systems</span>
            </div>
          </div> -->

          <div
            class="resume_info_sub_section"
            v-show="showHideContent.headline"
          >
            <div class="endorsments_resume_list">
              <div v-if="resumeStateData.resume_setting.endorsement_type == 1">
                <span
                  v-for="(
                    endorse, key
                  ) in resumeStateData.user.endorsements.filter(
                    (wa) => wa.top_endorsment_status == true
                  )"
                  :key="key"
                >
                  <div v-if="endorse.top_endorsment_status">
                    <p style="font-family: sans-serif">“{{ endorse.value }}”</p>
                    <span style="font-family: sans-serif"
                      >– {{ endorse.author }},
                      {{ endorse.author_description }}</span
                    >
                  </div>
                </span>
              </div>
              <div v-if="resumeStateData.resume_setting.endorsement_type == 2">
                <span>{{
                  resumeStateData.resume_qualification_statement
                    ? resumeStateData.resume_qualification_statement
                        .final_statement
                    : ""
                }}</span>
              </div>
            </div>
          </div>

          <div class="resume_info_sub_section" v-if="resume.resume_sections">
            <div
              class="work_experience_list"
              v-for="(resumesection, key) in resume.resume_sections"
              :key="key"
            >
              <div v-if="resumesection.type == 'work'">
                <h2 class="resume_section_heading text-control-wrap">
                  <i
                    class="fa fa-id-card"
                    style="font-size: 17px"
                    :style="'color:' + resume.color.accent"
                    aria-hidden="true"
                  ></i>
                  <span
                    :style="
                      'color:' + resume.color
                        ? resume.color.primaryy_color
                        : '' + ';font-size:' + resume.heading_font_size + 'px'
                    "
                  >
                    {{ resumesection.title }}</span
                  >
                </h2>

                <div
                  v-for="(resumejob, i) in getJobArray.filter(
                    (ae) => ae.active == 1
                  )"
                  :key="i"
                >
                  <div v-if="resumejob.job != null">
                    <h3
                      class="resume_sub_section_heading"
                      :style="
                        'background-color:' +
                        resume.color.secondary +
                        ';font-size:' +
                        resume.subheading_font_s +
                        'px' +
                        ';padding-top:' +
                        resume.subheading_spacin +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px'
                      "
                    >
                      {{ resumejob.job ? resumejob.job.company : "" }}
                      <span
                        v-if="
                          resume.resume_setting.is_city_state_country &&
                          resume.resume_setting.is_location
                        "
                        >{{ resumejob.job ? resumejob.job.city : "" }}
                        {{ resumejob.job ? resumejob.job.state : "" }} ,
                        {{
                          resumejob.job
                            ? resumejob.job.country.country_name
                            : ""
                        }}
                      </span>
                      <span
                        v-if="
                          resume.resume_setting.is_city_state &&
                          resume.resume_setting.is_location
                        "
                      >
                        {{ resumejob.job ? resumejob.job.city : "" }},
                        {{ resumejob.job ? resumejob.job.state : "" }}
                      </span>
                      <span v-if="resume.resume_setting.is_location"></span>
                      <span
                        class="right_resume_heading_year"
                        v-if="
                          resume.resume_setting.is_year &&
                          resume.resume_setting.is_dates
                        "
                      >
                        {{ resumejob.job ? resumejob.job.start_year : "" }}
                        -

                        {{ resumejob.job ? resumejob.job.end_year : "" }}
                      </span>
                      <span
                        class="right_resume_heading_year"
                        v-if="
                          resume.resume_setting.is_month_year &&
                          resume.resume_setting.is_dates
                        "
                      >
                        {{ resumejob.job ? resumejob.job.start_month : "" }}
                        /{{ resumejob.job ? resumejob.job.start_year : "" }}
                        -
                        {{ resumejob.job ? resumejob.job.end_month : "" }}
                        /{{ resumejob.job ? resumejob.job.end_year : "" }}
                      </span>
                      <span
                        class="right_resume_heading_year"
                        v-if="!resume.resume_setting.is_dates"
                      ></span>
                    </h3>
                    <!-- {{ resumejob.job.endorsement[0] }} -->
                    <span
                      v-for="(
                        endorse, endorseKey
                      ) in resumejob.job.endorsements.filter(
                        (ea) => ea.status == 1
                      )"
                    >
                      “{{ endorse.value }}”
                    </span>
                    <span class="working_as_Desig">{{
                      resumejob.job
                        ? resumejob.job.position
                          ? resumejob.job.position.pos_name
                          : ""
                        : ""
                    }}</span>
                    <div
                      class="additional_information"
                      v-if="resume.resume_setting.is_job_description"
                    >
                      <p>
                        {{
                          resumejob.job
                            ? resumejob.job.position
                              ? resumejob.job.position.pos_description
                              : ""
                            : ""
                        }}
                      </p>
                    </div>
                    <div v-else>
                      <p></p>
                    </div>

                    <!-- <div>
                      <p class="bullet-point">
                        {{ experience.description }}
                      </p>
                    </div> -->

                    <div class="additional_information">
                      <ul
                        v-for="(experience, experienceKey) in sortArray(
                          resumejob.job.experiences
                        ).filter((as) => as.status == 1)"
                        :key="`#demo_exp_showme_${experienceKey}`"
                      >
                        <li>
                          <div
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;'
                            "
                          >
                            {{ experience.description }}
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="resumesection.type == 'education'">
                <h2 class="resume_section_heading text-control-wrap">
                  <i
                    class="fa fa-book"
                    style="font-size: 17px"
                    :style="'color:' + resume.color.accent"
                    aria-hidden="true"
                  ></i>
                  {{ resumesection.title }}
                </h2>
                <div v-for="(education, key) in getEduArray" :key="key">
                  <div
                    class="sub-sub-heading"
                    :style="
                      'font-size:' +
                      resume.subheading_font_s +
                      'px' +
                      ';padding-top:' +
                      resume.subheading_spacin +
                      'px' +
                      ';padding-bottom:' +
                      resume.subheading_spacin +
                      'px'
                    "
                  >
                    <span v-if="education.is_major_field_study == 1">
                      {{ education.major }}</span
                    >
                  </div>
                  <div
                    class="d-flex justify-content-between sub-sub-heading resume_sub_section_heading"
                    :style="
                      'font-size:' +
                      resume.subheading_font_s +
                      'px' +
                      ';padding-top:' +
                      resume.subheading_spacin +
                      'px' +
                      ';padding-bottom:' +
                      resume.subheading_spacin +
                      'px'
                    "
                  >
                    <div class="working_as_Desig mb-0">
                      {{ education.school }} (
                      <span
                        v-if="
                          resume.resume_setting.is_edu_city_state_country &&
                          resume.resume_setting.is_edu_location
                        "
                        >{{ education.city }}, {{ education.state }},{{
                          education.country
                        }}</span
                      >
                      <span
                        v-if="
                          resume.resume_setting.is_edu_city_state &&
                          resume.resume_setting.is_edu_location
                        "
                        >{{ education.city }}, {{ education.state }}</span
                      >
                      <span v-if="!resume.resume_setting.is_edu_location"></span
                      >)
                    </div>

                    <div class="resume_sub_section_heading mb-0">
                      <span
                        class="right_resume_heading_year"
                        v-if="
                          resume.resume_setting.is_edu_month_year &&
                          resume.resume_setting.is_edu_dates
                        "
                        >{{ education.grad_month }}/
                        {{ education.grad_year }}</span
                      >
                      <span
                        class="right_resume_heading_year"
                        v-if="
                          resume.resume_setting.is_edu_year &&
                          resume.resume_setting.is_edu_dates
                        "
                      >
                        {{ education.grad_year }}</span
                      >
                      <span
                        class="right_resume_heading_year"
                        v-if="!resume.resume_setting.is_edu_dates"
                      ></span>
                    </div>
                  </div>
                  <div class="unorder-list">
                    <!-- <ul> -->
                    <!-- <li>GPA: 3.78</li> -->
                    <!--                            <li>Major GPA: 3.92</li>-->
                    <!--                            <li>32 Credits Completed</li>-->
                    <!-- </ul> -->
                  </div>
                </div>
              </div>
              <div v-if="resumesection.type == 'skill'">
                <div class="Skills_experience_list" style="margin-top: 20px">
                  <h2 class="resume_section_heading text-control-wrap">
                    <i
                      class="fa fa-users"
                      style="font-size: 17px"
                      :style="'color:' + resume.color.accent"
                      aria-hidden="true"
                    ></i>
                    {{ resumesection.title }}
                  </h2>
                  <div class="additional_information">
                    <ul>
                      <li v-for="(skill, key) in resume.user.skills" :key="key">
                        <span v-if="skill.pivot.is_active">
                          {{ skill.name }}
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="upgrade_popup_container">
      <div class="upgrade_plans_list">
        <h2
          class="subscription_page_heading"
          style="font-weight: 500; padding: 0px 30px"
        >
          Upgrade to the Pro Subscription
        </h2>
        <span class="close_pop_up_upgrade_form"
          ><i class="fa fa-times-circle"></i
        ></span>
        <div class="subscription_plans_list">
          <div class="col-md-5 col-sm-12 subscription_plus">
            <div class="subscription_header">
              <h3>PLUS</h3>
              <h4>
                $8.99 <span class="small_dur">/ Month</span><br />
                <span style="margin-left: -28px; font-size: 18px">or</span>
                $24.99 <span class="small_dur">/ Year</span>
              </h4>
            </div>
            <div class="subscription_body">
              <ul class="subscription_list_options">
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Choose between
                  X resume designs
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Chronological
                  and functional resume format
                </li>
                <li style="min-height: 64px">
                  <span><i class="fa fa-angle-right"></i></span> Download your
                  resume in PDF format
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> 17 point Resume
                  Review to help you make your resume better
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Access to
                  additional resume enhancements
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Priority
                  support
                </li>
              </ul>
              <button
                class="btnonlyBorder_FillSolid btn-rounded mt-4 get_upgade_subscription_btn"
              >
                Get the Plus Subscription
              </button>
            </div>
          </div>
          <div class="col-md-5 col-sm-12 subscription_pro">
            <div class="subscription_header">
              <h3>PRO</h3>
              <h4>
                $19.99 <span class="small_dur">/ Month</span><br />
                <span style="margin-left: -37px; font-size: 18px">or</span>
                $49.99 <span class="small_dur">/ Year</span>
              </h4>
            </div>
            <div class="subscription_body">
              <ul class="subscription_list_options">
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Choose between
                  Y resume designs
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Chronological
                  and functional resume format
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Download your
                  resume in PDF format and Word format
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> 23 point Resume
                  Review to help you make your resume better
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Access to
                  additional resume enhancements
                </li>
                <li>
                  <span><i class="fa fa-angle-right"></i></span> Priority
                  support
                </li>
              </ul>
              <button
                class="btnonlyBorder_FillSolid btn-rounded mt-4 get_upgade_subscription_btn"
              >
                Get the Pro Subscription
              </button>
            </div>
          </div>
        </div>
        <div
          class="subscription_plans_form_container subscription_upgrade_form_container"
          style="display: none"
        >
          <div class="resume-editor-div">
            <div
              class="row"
              style="max-width: 780px; margin: 0px auto !important"
            >
              <div
                class="col-sm-12 inputP55"
                style="max-width: 320px; margin: 0px auto"
              >
                <select
                  name="subscription_plan_option"
                  id="subscription_plan_option"
                  class="select-item input mouseLeave"
                  style="-webkit-appearance: none"
                >
                  <option value="1">Plus</option>
                  <option value="2">Pro</option>
                </select>
                <span class="highlight"></span> <span class="bar"></span>
                <label data-v-7969e6e8="" class="select-label mouseLeave_"
                  >Subscription:</label
                >
              </div>
              <div class="col-12 choose_subscription_form">
                <h5>Choose Your Billing Cycle</h5>
                <div class="choose_subscription_duration">
                  <div class="more_checkbox_section">
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="customRadioupgrade1"
                        value="option2"
                        name="address_options"
                        checked="checked"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        for="customRadioupgrade1"
                        class="custom-control-label form-check-label"
                      >
                        <p>Monthly<br /><span>$8.99 / month</span></p>
                      </label>
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="customRadioupgrade2"
                        value="option3"
                        name="address_options"
                        class="custom-control-input form-check-input"
                      />
                      <label
                        for="customRadioupgrade2"
                        class="custom-control-label form-check-label"
                      >
                        <p>
                          Annual<br /><span
                            >$24.99 / year <span>(save $82.89)</span></span
                          >
                        </p>
                        <span class="best_value">Best Value</span>
                      </label>
                    </div>
                  </div>
                </div>
                <h5>Credit Card Details</h5>
                <div class="choose_subscription_fields">
                  <div class="row">
                    <div
                      class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                    >
                      <div>
                        <input
                          maxlength="100"
                          type="text"
                          class="input mouseLeave"
                        />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="label_name">Name on Card</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                    >
                      <div>
                        <input
                          type="text"
                          placeholder="____ ____ ____"
                          data-slots="_"
                          class="input mouseLeave hide_placeholder_dataset"
                        />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="label_name"
                          >Credit or Debit Card Number</label
                        >
                      </div>
                    </div>
                    <div
                      class="col-md-6 col-sm-12 group mr-2 inputP55 custom_expiration_security_div"
                      style="padding: 0px; display: inherit; margin-bottom: 0px"
                    >
                      <div
                        class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                      >
                        <div>
                          <input
                            type="text"
                            class="input mouseLeave hide_placeholder_dataset"
                            placeholder="MM/YY"
                            data-slots="MY"
                          />
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="label_name">Expiration: MM/YY</label>
                        </div>
                      </div>
                      <div
                        class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                      >
                        <div>
                          <input
                            type="text"
                            maxlength="4"
                            class="input mouseLeave"
                          />
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="label_name">Security Code:</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 group mr-2 inputP55">
                      <select
                        name="country"
                        id="country"
                        class="select-item input mouseLeave"
                        style="-webkit-appearance: none"
                      >
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                      </select>
                      <span class="highlight"></span> <span class="bar"></span>
                      <label class="select-label mouseLeave_">Country:</label>
                    </div>
                    <div
                      class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                    >
                      <div>
                        <input
                          maxlength="100"
                          type="text"
                          class="input mouseLeave"
                        />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="label_name">Postal Code</label>
                      </div>
                    </div>
                  </div>
                  <div class="sub_buttons_container">
                    <button class="btnOption btn_color_option btn-rounded">
                      Upgrade
                    </button>
                    <button
                      class="btnGray btn-rounded close_pop_up_upgrade_form"
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- popup validation -->
    <div class="popup-container" v-if="eduSubSectionContent">
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
                <h4>Are you Sure?</h4>
                <p>
                  You are about to add a content to this section and remove it
                  from the section it is already on. Do you want to move
                  forward?
                </p>
                <input type="hidden" v-model="new_resumeSection_id" />
                <input type="hidden" v-model="eduSubSection_id" />
                <div class="d-flex flex-control-mobile">
                  <button
                    @click="
                      changeSubSectionContent(
                        eduSubSection_id,
                        new_resumeSection_id
                      )
                    "
                    class="btnOk btn-rounded btn-transparent"
                  >
                    Yes
                  </button>
                  <button @click="closePoup()" class="btnOk btn-rounded">
                    No
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- professional summ validation -->
    <div class="popup-container" v-if="proSumSubSection">
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
                <h4>Are you Sure?</h4>
                <p>
                  You are about to add a content to this Sub section and remove
                  it from the section it is already on. Do you want to move
                  forward?
                </p>
                <input type="hidden" v-model="res_exp_id" />
                <input type="hidden" v-model="subSection_id" />

                <div class="d-flex">
                  <button
                    @click="changeProSumSubSection(res_exp_id, subSection_id)"
                    class="btnOk btn-rounded btn-modal-two-page-resume btn-transparent-two-page-resume"
                  >
                    Yes
                  </button>
                  <button
                    @click="closePoup()"
                    class="btnOk btn-rounded btn-modal-two-page-resume"
                  >
                    No
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- template change popup -->
    <div class="popup-container" v-if="showChangeTemplateModal">
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
                <h4>Reset Formatting?</h4>
                <p>
                  It looks like you have customized the spacing and font size on
                  your resume. Now that you are using a new template, would you
                  like to reset your changes to the default set by the resume
                  template?
                </p>
                <div class="d-flex reset-formating-btns-box">
                  <button @click="closePoup()" class="btnOk btn-rounded btn1">
                    No
                  </button>
                  <button
                    @click="changeTemplate()"
                    class="btnOk btn-rounded transparent-btn"
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
    <!-- delete subsection popup -->

    <div class="popup-container" v-if="showDeleteSubSection">
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
                <h4>Delete Subsection?</h4>
                <p>Are you sure you want to delete Subsection?</p>
                <div class="d-flex reset-formating-btns-box">
                  <button @click="closePoup()" class="btnOk btn-rounded btn1">
                    No
                  </button>
                  <button
                    @click="deleteEduSubsectionContent()"
                    class="btnOk btn-rounded transparent-btn"
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

    <div class="popup-container" v-if="showDeleteNewSection">
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
                <h4>Delete New Section?</h4>
                <p>Are you sure you want to delete New Section?</p>
                <div class="d-flex reset-formating-btns-box">
                  <button @click="closePoup()" class="btnOk btn-rounded btn1">
                    No
                  </button>
                  <button
                    @click="deleteNewSection()"
                    class="btnOk btn-rounded transparent-btn"
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
  </div>
</template>

<script>
import { environment_api } from "../../env";
import SideBar from "./SideBar.vue";
import FirstTemplate from "./Templates/FirstTemplate.vue";
import SecondTemplate from "./Templates/SecondTemplate.vue";
import ThirdTemplate from "./Templates/ThirdTemplate.vue";
import ForthTemplate from "./Templates/ForthTemplate.vue";
import FifthTemplate from "./Templates/FifthTemplate.vue";
import store from "../../store";
import "../../../../public/custom/custom.js";
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "TwoPageResume",
  // props: ['resume'],
  components: {
    SideBar,

    FirstTemplate,
    SecondTemplate,
    ThirdTemplate,
    ForthTemplate,
    FifthTemplate,
  },

  data() {
    return {
      deleteNewsectionId: "",
      changeTemplateId: null,
      showChangeTemplateModal: false,
      showDeleteSubSection: false,
      showDeleteNewSection: false,
      deleteSubsectionId: "",
      currentComponent: null,
      downloadResume: false,
      EnvPath: environment_api.api_base_url,
      activeEmail: true,
      eduSubSection_id: "",
      new_resumeSection_id: "",
      activePhone: true,
      activeMiddle: false,
      activePro: true,
      activeWeb: true,
      isDates: false,
      isMonthYear: false,
      isYear: false,
      isLocationW: true,
      isCityStateCountryW: false,
      isCitySW: false,
      workLocation: true,
      isJobDescription: false,
      isMonthYearFunGr: false,
      isYearGr: true,
      second: true,
      selected_resume_id: "",
      eduSubSectionContent: false,
      proSumSubSection: false,
      testme: false,
      subSection_id: "",
      res_exp_id: "",
      resume: {},
      jobDescriptionsArray: [],
      showHideContent: {
        headline: true,
        professional_experience: true,
        education: true,
        skill: true,
        new_section: true,
        professional_summary: true,
      },
      degrees: [
        "",
        "High School Diploma",
        "GED",
        "Associate of Arts",
        "Associate of Science",
        "Associate of Applied Science",
        "Bachelor of Arts",
        "Bachelor of Science",
        "BBA",
        "Master of Arts",
        "Master of Science",
        "MBA",
        "J.D.",
        "M.D.",
        "Ph.D.",
        "Other Degree (specify)",
        "Some College",
      ],
    };
  },

  created() {},

  beforeMount() {
    this.getResumeDetails();
  },
  mounted() {
    store.commit("storeCurrentPage", 11);
    localStorage.setItem("CurrentPage", 11);
    localStorage.setItem("page", 11);
    localStorage.setItem("pageCount", 11);
    this.getEducationEnhancement();
  },
  computed: {
    ...mapGetters([
      "getContactSortedItemsFromState",
      "getContactAddress",
      "getJobArray",
      "getEduArray",
      "getEduSubSectionArray",
      "getNewSectionArray",
      "getProSummSubSectionArray",
      "getSkillSubSectionArray",
      "getCurrentResume",
    ]),
    ...mapState({
      // arrow functions can make the code very succinct!
      resumeStateData: (state) => state.Two_Page_Resume,
    }),

    getAddress() {
      let address = "";
      if (!this.resume.resume_setting.is_info_location) {
        return "";
      }

      if (
        this.resume.user.street_address &&
        (this.resume.resume_setting.is_info_full_address ||
          this.resume.resume_setting.is_info_full_address_city)
      ) {
        address += this.resume.user.street_address + " ";
      }

      if (this.resume.user.city) {
        address += this.resume.user.city + " ";
      }
      if (this.resume.user.state) {
        address += this.resume.user.state + " ";
      }
      if (
        this.resume.user.countries.country_name &&
        this.resume.resume_setting.is_info_full_address_city
      ) {
        address += this.resume.user.countries.country_name;
      }

      return address;
    },
    getContactSortedItems() {
      let data = null;
      if (this.resume.resume_sorting) {
        this.resume.resume_sorting.map((value) => {
          if (value.type == "contact") {
            data = value.value ? JSON.parse(value.value) : null;
          }
        });
      }
      return data;
    },
  },
  methods: {
    createResExpSubSection: function (data) {
      this.callAxios(this.EnvPath + "api/create-res-exp-sub-section", data);
    },
    deleteNewSection: function () {
      var data = {
        id: this.deleteNewsectionId,
        resume_id: this.resume.id,
      };
      this.callAxios(this.EnvPath + "api/delete-new-section", data);
    },
    deleteEduSubsectionContent: function () {
      var data = {
        id: this.deleteSubsectionId,
        resume_id: this.resume.id,
      };

      this.callAxios(this.EnvPath + "api/delete-edu-subsection-content", data);
    },
    downloadPdf(value) {
      this.downloadResume = value;
    },
    getEducationEnhancement() {
      axios
        .get(this.EnvPath + "education_enhancement2")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
        })
        .catch((error) => console.log(error));
    },
    storeNewSectionUpdate: function (data) {
      this.callAxios(this.EnvPath + "api/store-new-section-update", data);
    },
    changeProSumSubSection: function (res_exp_id, subSection_id) {
      var data = {
        res_exp_id: res_exp_id,
        subSection_id: subSection_id,
        resume_id: this.resume.id,
      };
      this.callAxios(this.EnvPath + "api/create-res-exp-sub-section", data);
    },

    changeSubSectionContent(edu_id, r_sub_id) {
      var data = {
        edu_id: edu_id,
        r_sub_id: r_sub_id,
        resume_id: this.resume.id,
      };
      this.callAxios(this.EnvPath + "api/update-edu-subsectionId", data);
    },
    closePoup: function () {
      this.eduSubSectionContent = false;
      this.proSumSubSection = false;
      this.testme = false;
      this.showChangeTemplateModal = false;
      this.showDeleteSubSection = false;
      this.showDeleteNewSection = false;
    },
    showValidationEduSubSection: function (data) {
      this.new_resumeSection_id = data.new_resumeSec_id;
      this.eduSubSection_id = data.eduSubSection_id;
      this.eduSubSectionContent = true;
    },
    showValidationProSummSubSection: function (data) {
      this.res_exp_id = data.res_exp_id;
      this.subSection_id = data.subSection_id;

      this.proSumSubSection = true;
    },
    createNewSection: function (data) {
      this.callAxios(this.EnvPath + "api/create-new-section", data);
    },
    storeEduSubSection: function (data) {
      this.callAxios(this.EnvPath + "api/resume-edu-subsection-update", data);
    },
    removeResExpProSumSubSection: function (data) {
      this.callAxios(
        this.EnvPath + "api/remove-res-exp-pro-sum-subsection",
        data
      );
    },
    storeSkillSubSectionContent: function (data) {
      this.callAxios(this.EnvPath + "api/store-skill-subsection-content", data);
      // axios
      //   .post(this.EnvPath + "api/store-skill-subsection-content", data)
      //   .then(({ data }) => {
      //     if (data.status) {
      //       this.getResumeDetails();
      //     }
      //   })
      //   .catch((error) => console.log(error));
    },
    storeEduSubSectionContent: function (data) {
      axios
        .post(this.EnvPath + "api/store-edu-subsection-content", data)
        .then(({ data }) => {
          if (data.status) {
            this.getResumeDetails();
          }
        })
        .catch((error) => console.log(error));
    },

    updateEducationSubSection: function (data) {},
    changeEduOptions: function (data) {
      this.updateEducationOptions(data);
    },
    updateEducationOptions: function (data) {
      this.callAxios(this.EnvPath + "api/resume-education-update", data);
    },

    createEduSubSection: function (data) {
      this.callAxios(this.EnvPath + "api/create-edu-sub-section", data);
    },
    showEducationDegree: function (value) {
      if (value.degree == 16) {
        // if Some college
        return false;
      } else {
        return true;
      }
    },
    getDegree: function (value) {
      if (value) {
        if (Number.isInteger(value)) {
          return this.degrees[value];
        } else {
          return value;
        }
      }
    },
    sortArray: function (array) {
      return array.slice().sort(function (a, b) {
        return a.resume_experience.order < b.resume_experience.order ? -1 : 1;
      });
    },
    sortEducationArray: function (value) {
      return value.slice().sort(function (a, b) {
        return a.orderBy < b.orderBy ? -1 : 1;
      });
    },
    changeProSectionTitle: function (title) {
      const findWork = this.resume.resume_sections.find(function (item) {
        if (item.type == "work") {
          item.title = title;
          return item;
        }
      });
      if (findWork) {
        this.updateResume(findWork);
      }
    },
    changeEduSectionTitle: function (title) {
      const findWork = this.resume.resume_sections.find(function (item) {
        if (item.type == "education") {
          item.title = title;
          return item;
        }
      });
      if (findWork) {
        this.updateResume(findWork);
      }
    },
    changeProSummSectionTitle: function (title) {
      const findWork = this.resume.resume_sections.find(function (item) {
        if (item.type == "professional-summary") {
          item.title = title;
          return item;
        }
      });
      if (findWork) {
        this.updateResume(findWork);
      }
    },
    updateResume: function (obj) {
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          resume_section: obj,
        })
        .then(({ data }) => {
          if (data.id) {
            // store.commit("TwoPageResumeData", data);
            this.getResumeDetails();
          }
        })
        .catch((error) => console.log(error));
    },
    getResumeDetails() {
      this.resume = {};
      var r_id = localStorage.getItem("resume_id");
      var user_id = localStorage.getItem("user_id");
      axios
        .get(
          this.EnvPath + "api/get-resume-information/" + user_id + "/" + r_id
        )
        .then(({ data }) => {
          this.resume = data;
          console.log(this.resume, "this.resume");
          this.updateResumeAndArrays(this.resume);
          this.$store.dispatch("setResumeAddress", this.resume);
        })
        .catch((error) => console.log(error));
    },
    updateResumeAndArrays(data) {
      this.selected_resume_id = this.$route.query.resume_id;
      var jobArr = [];
      var EduArr = [];
      var kaunArr = [];
      var endorseArr = [];
      var skillArr = [];
      var firstArray = [];
      var eduSubSectionArray = [];
      var newSectionArray = [];
      var proSummarySubSectionArray = [];
      var resumeExperiences = [];
      var pro_summary = "";
      var skillSubSectionArray = [];

      if (this.resume.resume_sections.length > 0) {
        this.resume.resume_sections.forEach(function (value) {
          if (value.type == "work") {
            if (value.resume_section_job.length > 0) {
              value.resume_section_job.map(function (obj) {
                firstArray.push(obj);
              });
            }
          }

          // for resume sub section
          if (value.type == "education") {
            if (value.resume_sub_section.length > 0) {
              eduSubSectionArray = value.resume_sub_section;
            }
          }

          if (value.type == "professional-summary") {
            if (value.resume_sub_section.length > 0) {
              proSummarySubSectionArray = value.resume_sub_section;
            }
          }

          if (value.type == "skill") {
            if (value.resume_sub_section.length > 0) {
              skillSubSectionArray = value.resume_sub_section;
            }
          }

          if (value.type == "new-section") {
            newSectionArray.push(value);
          }
        });

        var jobArr = firstArray.sort((a, b) => {
          if (b.orderBy > a.orderBy) return -1;
          if (b.orderBy < a.orderBy) return 1;
          return 0;
        });
      }
      // education array
      if (this.resume.user.educations.length > 0) {
        EduArr = this.resume.user.educations.sort((a, b) => {
          if (b.orderBy > a.orderBy) return -1;
          if (b.orderBy < a.orderBy) return 1;
          return 0;
        });
      }

      // kaun length
      if (this.resume.user.kaun.length > 0) {
        kaunArr = this.resume.user.kaun;
      }
      // Skills Array
      if (this.resume.resume_skill.length > 0) {
        skillArr = this.resume.resume_skill;
      }
      //Endorsement Array
      if (this.resume.user.endorsements.length > 0) {
        endorseArr = this.resume.user.endorsements;
      }
      if (this.resume.resume_experience.length > 0) {
        resumeExperiences = this.resume.resume_experience;
      }

      store.commit("storeResumeExperiencesArray", resumeExperiences);
      store.commit("storeproSummSubSectionArray", proSummarySubSectionArray);
      store.commit("storeSkillSubSectionArray", skillSubSectionArray);
      store.commit("storeNewSectionArray", newSectionArray);

      store.commit("storeEduArray", EduArr);
      store.commit("storeEndorseArray", endorseArr);

      store.commit("storeKaunArray", kaunArr);
      store.commit("storeSkillArray", skillArr);

      store.commit("storeEduSubSectionArray", eduSubSectionArray);
      store.commit("storeJobArray", jobArr);
      store.commit("TwoPageResumeData", data);

      if (this.getContactAddress !== "") {
        // store.commit("storeContactAddress", "is_info_city_state");
      }
      if (!this.resume.resume_setting.is_dates) {
        this.isDates = true;
      }
      if (
        this.resume.resume_setting.is_year &&
        this.resume.resume_setting.is_dates
      ) {
        this.isYear = true;
        this.isDates = true;
      }
      if (
        this.resume.resume_setting.is_month_year &&
        this.resume.resume_setting.is_dates
      ) {
        this.isMonthYear = true;
        this.isDates = true;
      }

      if (
        this.resume.resume_setting.is_city_state_country &&
        this.resume.resume_setting.is_location
      ) {
        this.isLocationW = true;
        this.isCityStateCountryW = true;
      }

      if (
        this.resume.resume_setting.is_city_state &&
        this.resume.resume_setting.is_location
      ) {
        this.isLocationW = true;
        this.isCitySW = true;
      }
      if (!this.resume.resume_setting.is_location) {
        this.isLocationW = true;
      }

      if (
        this.resume.resume_setting.is_job_description &&
        this.resume.resume_setting.is_job_description
      ) {
        this.isJobDescription = true;
      }
      console.log("to the end");
      this.currentComponent = this.resume.template.name;
      this.currentComponent = this.currentComponent + "-template";
    },
    hidePreview() {
      $("#resume_complete_preview_container").fadeOut(600);
    },

    showHideEmitted(name) {
      if (name.type == "headline") {
        this.showHideContent.headline = name.status;
      }
      var section_id = name.section_id;
      this.callAxios(this.EnvPath + "api/res-section-hide-show", {
        section_id: section_id,
      });
      return;
      if (name.type == "headline") {
        this.showHideContent.headline = name.status;
      } else if (name.type == "professional_profile") {
        this.showHideContent.professional_experience = name.status;
      } else if (name.type == "professional_summary") {
        this.showHideContent.professional_summary = name.status;
      } else if (name.type == "education") {
        this.showHideContent.education = name.status;
      } else if (name.type == "new-section") {
        var obj = name.status;
        var section_id = name.status.id;
        var item = "";
        // this.resume.resume_sections.find(function (rs) {
        //   if (rs.id == obj.id) {
        //     item = rs;
        //   }
        // });
        // var db_index = this.resume.resume_sections.findIndex(
        //   (el) => el.id == obj.id
        // );
        // this.resume.resume_sections.splice(db_index, 1, item);

        // this.callAxios(this.EnvPath + "api/res-section-hide-show", {
        //   section_id: section_id,
        // });
      } else if (name.type == "skill") {
        this.showHideContent.skill = name.status;
      }
    },

    isColor(id) {
      this.callAxios(this.EnvPath + "api/update-color", {
        id: id,
      });

      setTimeout(() => {
        this.getResumeDetails();
      }, 1000);
    },
    getContactDataByType(type) {
      if (type == "email_address") {
        return this.resume.resume_setting.is_email
          ? this.resume.user.email
          : "";
      }

      if (type == "phone_num") {
        return this.resume.resume_setting.is_phone
          ? this.resume.user.phone
          : "";
      }

      if (type == "prof_prof") {
        return this.resume.resume_setting
          ? this.resume.resume_setting.is_pro
            ? this.resume.user.professional_profile
            : ""
          : "";
      }

      if (type == "website") {
        return this.resume.resume_setting.is_web
          ? this.resume.user.website
          : "";
      }
      if (type == "phy_address") {
        return this.getAddressWithoutUsingState();
      }
    },
    getContactIconClassByType(item) {
      if (item.type == "blank") {
        return "";
      } else {
        return item.icon;
      }
    },
    getAddressWithoutUsingState() {
      let address = "";
      if (!this.resume.resume_setting.is_info_location) {
        return "";
      }
      if (
        this.resume.user.street_address &&
        (this.resume.resume_setting.is_info_full_address ||
          this.resume.resume_setting.is_info_full_address_city)
      ) {
        address += this.resume.user.street_address + " ";
      }
      if (this.resume.user.city) {
        address += this.resume.user.city + " ";
      }
      if (this.resume.user.state) {
        address += this.resume.user.state + " ";
      }
      if (
        this.resume.user.countries.country_name &&
        this.resume.resume_setting.is_info_full_address_city
      ) {
        address += this.resume.user.countries.country_name;
      }
      return address;
    },
    isSKill(id) {
      this.callAxios(this.EnvPath + "api/update-skill", {
        id: id,
      });
    },

    isMonthYearFunG() {
      this.UserJobUpdate("is_edu_month_year");
    },
    isYearG() {
      this.UserJobUpdate("is_edu_year");
    },
    // JobFunction(jobData) {
    //   //
    //   // if(jobData[0].job.is_city_state_country && jobData[0].job.is_location){
    //   //   this.isCityStateCountryW = true;
    //   //   this.workLocation = true;
    //   //
    //   // }
    //   // if(jobData[0].job.is_city_state && jobData[0].job.is_location){
    //   //
    //   //   this.isCitySW = true;
    //   //   this.workLocation = true;
    //   // }
    //
    //
    // },
    clickedShowDetailModal(id) {
      this.callAxios(this.EnvPath + "api/resume-update", {
        endorsement_id: id,
        resume_id: this.resume.id,
      });
    },
    isLocationWork() {
      this.UserJobUpdate("is-location-work");
    },
    isCityStateCountryWork() {
      if (this.isCityStateCountryW) {
        this.isLocationW = true;
        this.isCitySW = false;
        this.UserJobUpdate("is-city-state-country-work");
      } else {
        this.isCitySW = false;
        this.isCityStateCountryW = true;
        this.isLocationW = true;
        this.UserJobUpdate("is-city-state-country-work");
      }
    },
    isCitySCWork() {
      if (this.isCitySW) {
        this.isLocationW = true;
        this.isCityStateCountryW = false;
        this.UserJobUpdate("is-city-state-work");
      } else {
        this.isCityStateCountryW = false;
        this.isCitySW = true;
        this.isLocationW = true;
        this.UserJobUpdate("is-city-state-work");
      }
    },
    isDateFun() {
      if (this.isDates) {
        this.isDates = true;
        this.isYear = false;
        this.isMonthYear = false;
        this.UserJobUpdate("dates");
      } else {
        this.isDates = true;
        this.isYear = false;
        this.isMonthYear = false;
        this.UserJobUpdate("dates");
      }
    },
    isMonthYearFun() {
      if (this.isMonthYear) {
        this.isYear = false;
        this.isDates = true;
        // this.isMonthYear = false;
      } else {
        this.isYear = false;
        this.isMonthYear = true;
        this.isDates = true;
      }
      this.UserJobUpdate("monthyears");
    },
    isYearFun() {
      if (this.isYear) {
        this.isMonthYear = false;

        this.UserJobUpdate("years");
      } else {
        this.isMonthYear = false;
        this.isYear = true;
        this.UserJobUpdate("years");
      }

      // if (this.isYear) {
      //
      //   this.UserJobUpdate('years', jobIds);
      // } else {
      //   this.isYear = true;
      //   this.isDates = false;
      //
      //   this.isMonthYear = false;
      //   this.UserJobUpdate('years', jobIds);
      // }
    },
    isJobDescriptionn() {
      if (this.isJobDescription) {
        this.isJobDescription = false;
      } else {
        this.isJobDescription = true;
      }
      this.UserJobUpdate("job_description");
    },
    hideEmail() {
      this.UserInfoUpdate("email");
    },
    infoLocation() {
      this.UserInfoUpdate("info-location");
    },

    infoFullAddress() {
      this.UserInfoUpdate("is_info_full_address");
    },
    getHeadingFont(font) {
      this.resumeStyle(font, "heading");
    },
    getTemplateFont(font) {
      this.resumeStyle(font, "font_id");
    },
    getSubHeadingFont(font) {
      this.resumeStyle(font, "sub_heading");
    },
    getBodyFontSize(font) {
      this.resumeStyle(font, "body_font_size");
    },
    getLeftRightMargin(font) {
      this.resumeStyle(font, "left_right_margin");
    },
    getHeadingSpacing(font) {
      this.resumeStyle(font, "haeding_spacing");
    },

    getSubHeadingSpacing(font) {
      this.resumeStyle(font, "sub_haeding_spacing");
    },
    getBodyTextSpacing(font) {
      this.resumeStyle(font, "body_text_spacing");
    },
    getTopBottomMargin(font) {
      this.resumeStyle(font, "top_bottom_margin");
    },
    getIndendSpacing(font) {
      this.resumeStyle(font, "indent_spacing");
    },
    selectTemplate(TemplateId) {
      this.changeTemplateId = TemplateId;
      this.showChangeTemplateModal = true;
    },
    deleteNewSecitonPopup(new_section_id) {
      this.deleteNewsectionId = new_section_id;
      this.showDeleteNewSection = true;
    },
    deleteSubsectionPopup(edu_subsection_id) {
      this.deleteSubsectionId = edu_subsection_id;
      this.showDeleteSubSection = true;
    },
    changeTemplate() {
      this.resumeStyle(this.changeTemplateId, "template");
    },
    getendorsement(mydata) {
      this.callAxios(this.EnvPath + "api/endorsement", mydata);
    },
    getSorting(data) {
      this.callAxios(this.EnvPath + "api/updateResumeSorting", data);
    },

    getExpSorting(data) {
      let url = this.EnvPath + "api/updateExpOrder";
      this.callAxios(url, data);
    },
    getMinorSorting(data) {
      let url = this.EnvPath + "api/updateMinorOrder";
      this.callAxios(url, data);
    },
    getEduSorting: function (data) {
      let url = this.EnvPath + "api/updateEduOrder";
      axios.post(url, data).then(function (response) {});
      setTimeout(() => this.getResumeDetails(), 1000);
    },
    getEduSubContentSorting: function (data) {
      let url = this.EnvPath + "api/updateEduSubContentOrder";
      axios.post(url, data).then(function (response) {});
      setTimeout(() => this.getResumeDetails(), 1000);
    },
    getJobSorting(data) {
      let url = this.EnvPath + "api/updateJobOrder";
      this.callAxios(url, data);
    },
    getMainSectionSorting(data) {
      let url = this.EnvPath + "api/updateMainSectionOrder";
      this.callAxios(url, data);
    },
    getEduSortingPreview(data) {
      let url = this.EnvPath + "api/updateEduPreview";
      this.callAxios(url, data);
    },
    getJobSortingPreview(data) {
      let url = this.EnvPath + "api/updateJobPreview";
      this.callAxios(url, data);
    },
    getProSummSubSectionPreview(data) {
      let url = this.EnvPath + "api/updateProSummSubSection";
      this.callAxios(url, data);
    },
    getEduSubSectionPreview(data) {
      let url = this.EnvPath + "api/updateEduSubsectionPreview";
      this.callAxios(url, data);
    },
    resumeStyle(font, type) {
      this.callAxios(this.EnvPath + "api/resume-style-update", {
        resume_id: this.resume.id,
        font: font,
        type: type,
      });
    },

    infoFullAddressCity() {
      this.UserInfoUpdate("is_info_full_address_city");
    },
    infoCityState() {
      this.UserInfoUpdate("is_info_city_state");
    },
    isEduLocation() {
      this.UserJobUpdate("is_edu_location");
    },
    isEduCityStateCountry() {
      this.UserJobUpdate("is_edu_city_state_country");
    },
    isEduCityState() {
      this.UserJobUpdate("is_edu_city_state");
    },

    UserJobUpdate(type) {
      this.callAxios(this.EnvPath + "api/resume-job-update/" + this.resume.id, {
        type: type,
      });
    },

    hideMiddle() {
      this.UserInfoUpdate("middle");
    },

    hidePhone() {
      this.UserInfoUpdate("phone");
    },
    hidePro() {
      this.UserInfoUpdate("pro");
    },
    hidePhysicalAddress() {
      this.UserInfoUpdate("physical_address");
    },
    hideWeb() {
      this.UserInfoUpdate("web");
    },
    updateResumeFormatting(data) {
      this.callAxios(this.EnvPath + "api/update-resume-formatting", data);
    },
    changeSectionColumn(data) {
      this.callAxios(this.EnvPath + "api/update-section-column", data);
    },
    UserInfoUpdate(type) {
      this.callAxios(
        this.EnvPath + "api/resume-info-update/" + this.resumeStateData.id,
        {
          type: type,
        }
      );
    },
    callAxios(url, data = null) {
      const self = this;
      data.resume_id = this.resume.id;
      axios
        .post(url, data)
        .then(({ data }) => {
          self.resume = {};
          store.commit("TwoPageResumeData", data);
          Object.assign(self.resume, data);
          this.updateResumeAndArrays(data);
          this.closePoup();
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
<!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Tai+Heritage+Pro&display=swap" rel="stylesheet">-->
<!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Tai+Heritage+Pro&display=swap" rel="stylesheet">-->

<style scoped>
@import "https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Tai+Heritage+Pro&display=swap";
@import "https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Tai+Heritage+Pro&display=swap";

.professional_profile {
  float: left;
  padding: 0px !important;
  font-size: 13px;
  font-family: "Hind", sans-serif;
  color: #767676;
  line-height: 20px;
  width: 33.33%;
}

.fa-user {
  content: "\f0e0";
  color: #c4e6de;
}

.fa-globe {
  content: "\f0e0";
  color: #c4e6de;
}

.resume-design-div {
  border-radius: 0px;
  padding: 25px 55px;
  background: #fff;
  -webkit-box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  min-width: 690px;
  max-width: 690px;
  max-height: 100%;
  min-height: 892px;
}
.resume_compplete_preview_sub_container.scrollbar.scrollbar-indigo.bordered-indigo.thin
  .resume-design-div {
  max-height: inherit !important;
}
.resume-control-preview {
  /* height: 100% !important; */
  /* width: 100% !important;
  min-width: 100% !important;
  max-width: 100% !important; */
}

.resume-design-div {
  min-width: 8.27in !important;
  max-height: 100% !important;
}

.working_as_Desig {
  text-decoration: auto;
}

.second-template-sub-heading-weight {
  font-weight: 500;
}

.second-template-main-container {
  border: 0;
}

.resume-design-div2 {
  border-radius: 0px;
  padding: 25px 40px;
  background: #fff;
  box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  min-width: 690px;
  max-width: 690px;
  max-height: 993px;
  min-height: 892px;
}
.qualification_statement_para {
  text-align: center;
  padding-left: 20px;
  font-size: 17px;
  font-weight: 500;
  margin: 0px;
  font-family: sans-serif;
}

.flex-control-resume-text {
  display: flex;
  width: 100%;
}

h2.resume_section_heading.text-control-wrap span {
  word-break: break-all;
}

.align-degree-education-card {
  display: flex;
  align-items: center;
}
.align-degree-education-card span {
  font-weight: 600;
}
.align-degree-education-card p {
  margin-left: 5px;
  margin-bottom: 0;
  margin-top: 0;
  font-weight: 400 !important;
}

.endorsments_resume_list p {
  font-weight: 600;
  text-align: center;
}
.working_as_Desig_second {
  font-family: "Hind", sans-serif;
  font-weight: 400;
  font-size: 13px;
  text-align: left;
  margin-bottom: 10px;
}

.d-flex.reset-formating-btns-box .btn-rounded {
  min-width: 45%;
  margin: 7px 10px 10px 0;
  padding: 5px 0 0 0;
}

.transparent-btn {
  background-color: transparent;
  border: 2px solid #2684fe;
  color: #2684fe !important;
  padding: 5px 0 0 0;
}

.btn-modal-two-page-resume {
  min-width: 170px;
  margin-left: 18px;
  border: 2px solid #2684fe !important;
}
.btn-modal-two-page-resume.btn-transparent-two-page-resume {
  background-color: transparent !important;
  border: 2px solid #2684fe !important;
  color: #2684fe !important;
}

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

.d-flex.flex-control-mobile button.btnOk.btn-rounded.btn-transparent {
  background-color: transparent;
  color: #2684fe !important;
  border: 2px solid #2684fe;
}

.d-flex.flex-control-mobile button {
  min-width: 48%;
  margin-left: 12px;
}
</style>
