<template>
  <div>
    <!-- Page Wrapper #app -->
    <div
      id="app"
      class="page-start page-resume"
      style="
        min-height: 100vh;
        <!-- background: #d5f8f0; -->
        z-index: 99;
        position: relative;
      "
    >
      <!-- Header Part -->

      <!-- End Header Part -->
      <section class="page-resume-editor page-contact-info">
        <div class="container page-cv-design-main-container">
          <div class="row">
            <SideBar
              :resume="resume"
              @clicked-show-detail="clickedShowDetailModal"
              @hide-email="hideEmail"
              @hide-phone="hidePhone"
              @hide-middle="hideMiddle"
              @hide-pro="hidePro"
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
              @get-left-right-margin="getLeftRightMargin"
              @get_heading_spacing="getHeadingSpacing"
              @get_sub_heading_spacing="getSubHeadingSpacing"
              @get_body_text_spacing="getBodyTextSpacing"
              @get_indend_spacing="getIndendSpacing"
            ></SideBar>
            <div v-if="!second" class="col-md-8 cv_design_right_container">
              <div
                class="resume-design-div"
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
                  class="resume_info_sub_section"
                  :style="
                    'margin-top:' +
                    resume.top_bottom_margi +
                    'px' +
                    ';margin-bottom:' +
                    resume.top_bottom_margi +
                    'px' +
                    ';margin-right:' +
                    resume.left_right_margin +
                    'px' +
                    ';margin-left:' +
                    resume.left_right_margin +
                    'px'
                  "
                  v-if="resume.resume_sections"
                >
                  <div
                    class="work_experience_list"
                    v-for="resumesection in resume.resume_sections"
                  >
                    <div v-if="resumesection.type == 'contact'">
                      <h2
                        class="resume-title"
                        :style="
                          'color:' +
                          resume.color.primary +
                          ';font-size:' +
                          resume.heading_font_size +
                          'px; padding-bottom:' +
                          resume.heading_spacing +
                          'px;' +
                          'padding-to:' +
                          resume.heading_spacing +
                          'px'
                        "
                      >
                        {{ resume.user ? resume.user.first_name + " " : "" }}
                        <span v-if="resume.resume_setting.is_middle">{{
                          resume.user ? resume.user.middle_initial : ""
                        }}</span>
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
                      <div class="resume_info_sub_section">
                        <div class="resume_contact_section">
                          <div class="col-md-4 contact_email">
                            <span v-if="resume.resume_setting.is_email">
                              <span class="icon"
                                ><i class="fa fa-envelope"></i></span
                              >{{ resume.user ? resume.user.email : "" }}
                            </span>
                          </div>
                          <div
                            class="col-md-4 contact_loc"
                            v-if="
                              resume.resume_setting.is_info_full_address &&
                              resume.resume_setting.is_info_location
                            "
                          >
                            <span class="icon"
                              ><i class="fa fa-map-marker-alt"></i
                            ></span>
                            {{
                              resume.user.street_address
                                ? resume.user.street_address
                                : ""
                            }}
                            {{ resume.user.city ? resume.user.city : "" }}
                            {{ resume.user.state ? resume.user.state : "" }}
                          </div>

                          <div
                            class="col-md-4 contact_loc"
                            v-if="
                              resume.resume_setting.is_info_full_address_city &&
                              resume.resume_setting.is_info_location
                            "
                          >
                            <span class="icon"
                              ><i class="fa fa-map-marker-alt"></i
                            ></span>
                            {{
                              resume.user.street_address
                                ? resume.user.street_address
                                : ""
                            }}
                            {{ resume.user.city ? resume.user.city : "" }}
                            {{ resume.user.state ? resume.user.state : "" }}
                            {{ resume.user.country ? resume.user.country : "" }}
                          </div>

                          <div
                            class="col-md-4 contact_loc"
                            v-if="
                              resume.resume_setting.is_info_city_state &&
                              resume.resume_setting.is_info_location
                            "
                          >
                            <span class="icon"
                              ><i class="fa fa-map-marker-alt"></i
                            ></span>

                            {{ resume.user.city ? resume.user.city : "" }}
                            {{ resume.user.state ? resume.user.state : "" }}
                          </div>
                          <div
                            class="col-md-4 contact_loc"
                            v-if="!resume.resume_setting.is_info_location"
                          >
                            <span class="icon"> </span>
                          </div>
                          <div class="col-md-4 contact_phone">
                            <span v-if="resume.resume_setting.is_phone">
                              <span class="icon"
                                ><i class="fa fa-phone-alt"></i
                              ></span>
                              {{ resume.user ? resume.user.phone : "" }}
                            </span>
                          </div>
                        </div>
                        <div
                          class="col-md-12 professional_profile"
                          v-if="resume.resume_setting.is_pro"
                        >
                          <span>
                            <span class="icon profile-icon"
                              ><i class="fa fa-user eeeeeeeeeeeeeeee"></i
                            ></span>
                            <span class="ml-1">
                              {{
                                resume.user
                                  ? resume.user.professional_profile
                                  : ""
                              }}
                            </span>
                          </span>
                        </div>
                        <div
                          class="col-md-12 professional_profile mb-3"
                          v-if="resume.resume_setting.is_web"
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
                      </div>

                      <div class="resume_info_sub_section">
                        <div class="endorsments_resume_list">
                          <span v-for="endorse in resume.user.endorsements">
                            <div v-if="endorse.status">
                              <p>
                                “{{ endorse.author }}
                                {{ endorse.author_description }}”
                              </p>
                              <span
                                >– Scott Keynes, COO, World Information
                                Systems</span
                              >
                            </div>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div v-if="resumesection.type == 'work'">
                      <h2
                        class="resume_section_heading"
                        :style="
                          'padding-bottom:' +
                          resume.heading_spacing +
                          'px;' +
                          'padding-to:' +
                          resume.heading_spacing +
                          'px'
                        "
                      >
                        <!--                        <img src="images/logo/professional_experience-icon_active.png"-->
                        <!--                             alt="Experience"/>-->

                        <i
                          class="fa fa-id-card"
                          style="font-size: 17px"
                          :style="'color:' + resume.color.accent"
                          aria-hidden="true"
                        ></i>

                        <span
                          class="ml-1"
                          :style="
                            'color:' +
                            resume.color.primary +
                            ';font-size:' +
                            resume.heading_font_size +
                            'px'
                          "
                        >
                          {{ resumesection.title }}
                        </span>
                      </h2>
                      <div
                        v-for="resumejob in resumesection.resume_section_job"
                      >
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
                            England
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
                            {{
                              resumejob.job ? resumejob.job.start_year : ""
                            }}
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
                            {{
                              resumejob.job ? resumejob.job.start_month : ""
                            }}
                            /{{
                              resumejob.job ? resumejob.job.start_year : ""
                            }}
                            -
                            {{
                              resumejob.job ? resumejob.job.end_month : ""
                            }}
                            /{{ resumejob.job ? resumejob.job.end_year : "" }}
                          </span>
                          <span
                            class="right_resume_heading_year"
                            v-if="!resume.resume_setting.is_dates"
                          ></span>
                        </h3>
                        <span class="working_as_Desig">{{
                          resumejob.job.position.pos_name
                        }}</span>
                        <div
                          class="additional_information"
                          v-if="resume.resume_setting.is_job_description"
                        >
                          <p>{{ resumejob.job.position.pos_description }}</p>
                        </div>
                        <div v-else><p></p></div>
                      </div>
                    </div>
                    <div v-if="resumesection.type == 'education'">
                      <div class="resume_info_sub_section">
                        <div class="edu_qualification_list">
                          <h2
                            class="resume_section_heading"
                            :style="
                              'padding-bottom:' +
                              resume.heading_spacing +
                              'px;' +
                              'padding-to:' +
                              resume.heading_spacing +
                              'px'
                            "
                          >
                            <i
                              class="fa fa-book"
                              style="font-size: 17px"
                              :style="'color:' + resume.color.accent"
                              aria-hidden="true"
                            ></i>
                            <span
                              class="ml-1"
                              :style="
                                'color:' +
                                resume.color.primary +
                                ';font-size:' +
                                resume.heading_font_size +
                                'px'
                              "
                            >
                              {{ resumesection.title }}
                            </span>
                          </h2>
                          <div v-for="education in resume.user.educations">
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
                              {{ education.major }}<span> </span>
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
                            </h3>
                            <span class="working_as_Desig"
                              >{{ education.school }}
                              <span
                                v-if="
                                  resume.resume_setting
                                    .is_edu_city_state_country &&
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
                                >{{ education.city }},
                                {{ education.state }}</span
                              >
                              <span
                                v-if="!resume.resume_setting.is_edu_location"
                              ></span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-if="resumesection.type == 'skill'">
                      <div
                        class="Skills_experience_list"
                        style="margin-top: 20px"
                      >
                        <h2
                          class="resume_section_heading"
                          :style="
                            'padding-bottom:' +
                            resume.heading_spacing +
                            'px;' +
                            'padding-to:' +
                            resume.heading_spacing +
                            'px'
                          "
                        >
                          <i
                            class="fa fa-users"
                            style="font-size: 17px"
                            :style="'color:' + resume.color.accent"
                            aria-hidden="true"
                          ></i>
                          <span
                            class="ml-1"
                            :style="
                              'color:' +
                              resume.color.primary +
                              ';font-size:' +
                              resume.heading_font_size +
                              'px'
                            "
                          >
                            {{ resumesection.title }}
                          </span>
                        </h2>
                        <div class="additional_information">
                          <ul>
                            <li
                              v-for="skill in resume.user.skills"
                              v-if="skill.pivot.is_active"
                            >
                              {{ skill.name }}
                            </li>
                          </ul>
                        </div>
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
                        <a href=""><strong>Sitemap</strong></a>
                        <i
                          class="fas fa-circle"
                          style="color: rgb(102, 105, 109); font-size: 25%"
                        ></i>
                      </li>
                      <li>
                        <a href=""><strong>Privacy Policy</strong></a>
                        <i
                          class="fas fa-circle"
                          style="color: rgb(102, 105, 109); font-size: 25%"
                        ></i>
                      </li>
                      <li>
                        <a href=""><strong>Terms of Use</strong></a>
                        <i
                          class="fas fa-circle"
                          style="color: rgb(102, 105, 109); font-size: 25%"
                        ></i>
                      </li>
                      <li>
                        <a href=""><strong>About Us</strong></a>
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

      <div id="footer-bg"><img src="http://html.resumeyak.com/images/bg/footer-bg.png" /></div>
      <div id="clouds-bg"><img src="http://html.resumeyak.com/images/bg/clouds-bg.png" /></div>

    </div>
    <div id="resume_complete_preview_container">
      <span class="close_pop_up"><i class="fa fa-times-circle"></i></span>
      <div
        class="resume_compplete_preview_sub_container scrollbar scrollbar-indigo bordered-indigo thin"
      >
        <div class="resume-design-div">
          <h2
            class="resume-title"
            :style="
              'color:' +
              resume.color.primary +
              ';font-size:' +
              resume.heading_font_size +
              'px'
            "
          >
            {{ resume.user ? resume.user.first_name + " " : "" }}
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
          <div class="resume_info_sub_section">
            <div class="resume_contact_section">
              <div class="col-md-4 contact_email">
                <span class="icon"><i class="fa fa-envelope"></i></span
                >{{ resume.user ? resume.user.email : "" }}
              </div>
              <div class="col-md-4 contact_loc">
                <span class="icon"><i class="fa fa-map-marker-alt"></i></span>
                {{ resume.address_display ? resume.address_display : "" }}
              </div>
              <div class="col-md-4 contact_phone">
                <span class="icon"><i class="fa fa-phone-alt"></i></span>
                {{ resume.user ? resume.user.phone : "" }}
              </div>
            </div>
          </div>
          <div class="resume_info_sub_section">
            <div class="endorsments_resume_list">
              <p>
                “ Richard is one of the best employees that has ever worked for
                me ”
              </p>
              <span>– Scott Keynes, COO, World Information Systems</span>
            </div>
          </div>
          <div class="resume_info_sub_section" v-if="resume.resume_sections">
            <div
              class="work_experience_list"
              v-for="resumesection in resume.resume_sections"
            >
              <div v-if="resumesection.type == 'work'">
                <h2 class="resume_section_heading">
                  <img
                    src="images/logo/professional_experience-icon_active.png"
                    alt="Experience"
                  />
                  <span
                    :style="
                      'color:' +
                      resume.color.primary +
                      ';font-size:' +
                      resume.heading_font_size +
                      'px'
                    "
                  >
                    {{ resumesection.title }}</span
                  >
                </h2>
                <div v-for="resumejob in resumesection.resume_section_job">
                  <h3 class="resume_sub_section_heading">
                    {{ resumejob.job ? resumejob.job.company : ""
                    }}<span
                      >, {{ resumejob.job ? resumejob.job.city : "" }} </span
                    ><span class="right_resume_heading_year"
                      >{{ resumejob.job ? resumejob.job.start_month : "" }} /{{
                        resumejob.job ? resumejob.job.start_year : ""
                      }}
                      - {{ resumejob.job ? resumejob.job.end_month : "" }} /{{
                        resumejob.job ? resumejob.job.end_year : ""
                      }}
                    </span>
                  </h3>
                  <span class="working_as_Desig">{{
                    resumejob.job.position.pos_name
                  }}</span>
                  <div class="additional_information">
                    <p>{{ resumejob.job.position.pos_description }}</p>
                    <!--                      <ul>-->
                    <!--                        <li>-->
                    <!--                        </li>-->
                    <!--                        -->
                    <!--                      </ul>-->
                  </div>
                </div>
              </div>
              <div v-if="resumesection.type == 'work'">
                <h2 class="resume_section_heading">
                  <img
                    src="images/logo/professional_experience-icon_active.png"
                    alt="Experience"
                  />{{ resumesection.title }}
                </h2>
                <div v-for="resumejob in resumesection.resume_section_job">
                  <h3 class="resume_sub_section_heading">
                    <span class="right_resume_heading_year"
                      >{{ resumejob.job ? resumejob.job.start_month : "" }} /{{
                        resumejob.job ? resumejob.job.start_year : ""
                      }}
                      - {{ resumejob.job ? resumejob.job.end_month : "" }} /{{
                        resumejob.job ? resumejob.job.end_year : ""
                      }}
                    </span>
                  </h3>
                  <span class="working_as_Desig">{{
                    resumejob.job.position.pos_name
                  }}</span>
                  <div class="additional_information">
                    <p>{{ resumejob.job.position.pos_description }}</p>
                    <!--                      <ul>-->
                    <!--                        <li>-->
                    <!--                        </li>-->
                    <!--                        -->
                    <!--                      </ul>-->
                  </div>
                </div>
              </div>
              <div v-if="resumesection.type == 'skill'">
                <div class="Skills_experience_list" style="margin-top: 20px">
                  <h2 class="resume_section_heading">
                    <img src="images/logo/skills_icon.png" alt="Skills" />
                    {{ resumesection.title }}
                  </h2>
                  <div class="additional_information">
                    <ul>
                      <li v-for="skill in resume.user.skills">
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
                        <p>Monthly<br /><span>$8.99 / month</span></p></label
                      >
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
                        <span class="best_value">Best Value</span></label
                      >
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
  </div>
</template>

<script>
import { environment_api } from "../../env";
import SideBar from "./SideBar";
import "../../../../public/custom/custom.js";

export default {
  name: "my",
  props: ["resume"],
  components: {
    SideBar,
  },

  data() {
    return {
      EnvPath: environment_api.api_url,
      activeEmail: true,
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
      resume: {},
    };
  },

  // watch: {
  //   resume: {
  //     // the callback will be called immediately after the start of the observation
  //     immediate: true,
  //     handler(val, oldVal) {
  //      this.resume = resume;
  //     }
  //   }
  // },

  created() {},
  mounted() {
    console.log(this.resume, "ooo");
    axios
      .get(this.EnvPath + "api/get-resume-information")
      .then(({ data }) => {
        console.log(data, "data");
        this.resume = data;
        if (!this.resume.resume_setting.is_dates) {
          this.isDates = true;
          console.log("yyyyy");
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

        //
        //
        // if (this.resume.resume_setting.is_city_state_country) {
        //   this.isCityStateCountryW = true;
        // }
        // if (this.resume.resume_setting.is_city_state) {
        //   this.isCitySW = true;
        // }
      })
      .catch((error) => console.log(error));
  },
  methods: {
    isColor(id) {
      const self = this;
      axios
        .post(this.EnvPath + "api/update-color", {
          id: id,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
          // this.resume = response.data;
          console.log("9898", self.resume);
        });
    },
    isSKill(id) {
      const self = this;
      axios
        .post(this.EnvPath + "api/update-skill", {
          id: id,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
          // this.resume = response.data;
          console.log("9898", self.resume);
        });

      console.log(id);
    },

    isMonthYearFunG() {
      this.UserJobUpdate("is_edu_month_year");
    },
    isYearG() {
      this.UserJobUpdate("is_edu_year");
    },
    // JobFunction(jobData) {
    //   console.log('yuyu')
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
      const self = this;
      axios
        .post("http://127.0.0.1:8000/api/resume-update", {
          endorsement_id: id,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
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
        this.UserJobUpdate("monthyears");
      } else {
        this.isYear = false;
        this.isMonthYear = true;
        this.isDates = true;
        this.UserJobUpdate("monthyears");
      }
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
        this.UserJobUpdate("job_description");
      } else {
        this.isJobDescription = true;
        this.UserJobUpdate("job_description");
      }
    },
    hideEmail() {
      console.log("gas");
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
    getSubHeadingFont(font) {
      this.resumeStyle(font, "sub_heading");
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
    getTopBottomMargin(margin) {
      this.resumeStyle(margin, "margin");
    },
    getIndendSpacing(font) {
      this.resumeStyle(font, "indent_spacing");
    },
    resumeStyle(font, type) {
      const self = this;
      axios
        .post(this.EnvPath + "api/resume-style-update", {
          resume_id: this.resume.id,
          font: font,
          type: type,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
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
      const self = this;
      axios
        .post(this.EnvPath + "api/resume-job-update", {
          type: type,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
          // this.resume = response.data;
          console.log("9898", self.resume);
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

    hideWeb() {
      this.UserInfoUpdate("web");
    },

    UserInfoUpdate(type) {
      const self = this;
      axios
        .post(this.EnvPath + "api/resume-info-update", {
          type: type,
        })
        .then(function (response) {
          self.resume = {};
          Object.assign(self.resume, response.data);
        });
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
  max-height: 947px;
  min-height: 892px;
}

/*  */

#footer-bg {
    position: absolute;
    bottom: 0px;
    left: 0px;
    z-index: -99;
}

#clouds-bg {
    position: absolute;
    top: 135px;
    left: 9%;
    z-index: -99;
}

#footer-bg img, #clouds-bg img {
    max-width: 100%;
    width: 100% !important;
}
</style>
