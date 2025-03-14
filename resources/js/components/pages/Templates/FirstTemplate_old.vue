<template>
  <div>
    <div
      ref="htmlToConvert"
      class="resume-design-div resume-control-preview"
      :style="
        'font-family:' +
        font_family +
        '!important;letter-spacing:' +
        resume.body_text_spacing +
        '% ;' +
        'letter-spacing:' +
        resume.body_text_spacing +
        'px'
      "
    >
      <div
        class="resume_info_sub_section"
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
          class="work_experience_list"
          v-for="(resumesection, key) in sortMainSectionArray(
            resume.resume_sections
          )"
          :key="key"
        >
          <!-- Title of Resume Here -->
          <div v-if="resumesection.type == 'contact'">
            <h2
              class="resume-title-no-font"
              :style="{
                fontFamily: font_family + ' !important',
                color: resume.color.primaryy_color,
                fontSize: resume.heading_font_size + 'px !important',
              }"
            >
              <!-- fontSize: resume.heading_font_size + 'px', -->
              {{ resume.user ? resume.user.first_name + "" : "" }}

              <span v-if="resume.resume_setting.is_middle">{{
                resume.user ? resume.user.middle_initial + "." : ""
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
            <!-- Start Contact section Data -->
            <div
              class="container margin-remove-1024"
              v-if="getContactSortedItemsFromState"
            >
              <div class="resume_info_sub_section row d-flex flex-row">
                <div class="resume_contact_section col-md-12">
                  <div class="container">
                    <div class="row justify-content-between">
                      <div
                        v-for="(
                          item, key
                        ) in getContactSortedItemsFromState.slice(0, 5)"
                        :key="key"
                        class="top-contact-icon-list contact_email"
                      >
                        <div
                          class="pb-3"
                          v-if="item.type == 'blank'"
                          style="color: black"
                        >
                          <span>
                            <span
                              class="icon"
                              :style="
                                'color:' + resume.color.accent + '!important;'
                              "
                            ></span>
                          </span>
                        </div>
                        <div
                          class="pb-3"
                          v-if="getContactDataByType(item.type)"
                        >
                          <span class="d-flex align-items-baseline">
                            <span
                              class="icon"
                              :style="
                                'color:' + resume.color.accent + '!important;'
                              "
                              ><i
                                :class="getContactIconClassByType(item)"
                              ></i></span
                            ><span
                              class="contact-icon-text"
                              :style="
                                'color:' +
                                resume.color.font +
                                '!important;' +
                                'font-size:' +
                                resume.body_font_size +
                                'px !important;'
                              "
                              >{{ getContactDataByType(item.type) }}</span
                            >
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Else Part of the contact section -->
            <div v-else>
              <div class="resume_info_sub_section">
                <div class="resume_contact_section">
                  <div
                    class="col-md-4 contact_email"
                    v-if="resume.resume_setting.is_email"
                  >
                    <span
                      class="resume-text-control"
                      :style="'font-family:' + font_family + '!important;'"
                    >
                      <span class="icon"
                        ><i
                          class="far fa-envelope"
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
                        ></i
                      ></span>
                      <p
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        {{ resume.user ? resume.user.email : "" }}
                      </p>
                    </span>
                  </div>

                  <div
                    class="col-md-4 contact_loc resume-text-control justify-content-center"
                    v-if="resume_address"
                  >
                    <span class="icon"
                      ><i
                        class="fa fa-map-marker-alt"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i
                    ></span>
                    <p
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                    >
                      {{ resume_address }}
                    </p>
                  </div>
                  <div
                    class="col-md-4 contact_phone text-align-right"
                    v-if="resume.resume_setting.is_phone"
                  >
                    <span class="resume-text-control">
                      <span class="icon"
                        ><i
                          class="fas fa-phone-alt"
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
                        ></i>
                      </span>
                      <p
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                      >
                        {{ resume.user ? resume.user.phone : "" }}
                      </p>
                    </span>
                  </div>
                </div>

                <div
                  class="col-md-6 professional_profile mb-1"
                  v-if="
                    resume.resume_setting.is_pro &&
                    resume.user.professional_profile != null
                  "
                >
                  <span class="resume-text-control">
                    <span class="icon profile-icon"
                      ><i
                        class="fab fa-linkedin"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i
                    ></span>
                    <span class="ml-1">
                      <p
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                      >
                        {{
                          resume.user ? resume.user.professional_profile : ""
                        }}
                      </p>
                    </span>
                  </span>
                </div>

                <div
                  class="col-md-6 professional_profile mb-1 d-flex justify-content-end"
                  v-if="
                    resume.resume_setting.is_web && resume.user.website != null
                  "
                >
                  <span class="resume-text-control justify-content-center">
                    <span class="icon profile-icon"
                      ><i
                        class="fas fa-globe-europe"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i
                    ></span>
                    <span class="ml-1">
                      <p
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                      >
                        {{ resume.user ? resume.user.website : "" }}
                      </p>
                    </span>
                  </span>
                </div>
              </div>
            </div>

            <!-- END Contact Section Data -->
            <!-- Headline Content Resume  -->
            <div
              class="resume_info_sub_section"
              v-show="showHideContent.headline"
            >
              <div class="endorsments_resume_list">
                <div
                  v-if="resumeStateData.resume_setting.endorsement_type == 1"
                >
                  <span
                    v-for="(
                      endorse, key
                    ) in resumeStateData.user.endorsements.filter(
                      (wa) => wa.top_endorsment_status == true
                    )"
                    :key="key"
                  >
                    <div v-if="endorse.top_endorsment_status">
                      <p
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                        class="d-flex w-100"
                        style="word-break: normal !important"
                      >
                        “{{ endorse.value }}”
                      </p>
                      <span
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                        >– {{ endorse.author }},
                        {{ endorse.author_description }},
                        {{ endorse.jobs ? endorse.jobs.company : "" }}
                      </span>
                    </div>
                  </span>
                </div>
                <div
                  v-if="resumeStateData.resume_setting.endorsement_type == 2"
                >
                  <p
                    class="qualification_statement_para flex-control-resume-text"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    {{
                      resumeStateData.resume_qualification_statement
                        ? resumeStateData.resume_qualification_statement
                            .final_statement
                        : ""
                    }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Work Experience  -->
          <div
            v-if="resumesection.type == 'work' && getJobArray.length > 0"
            v-show="resumesection.hidden == 1"
          >
            <h2
              class="resume_section_heading text-control-wrap d-flex w-100 align-items-center"
              :style="
                'padding-bottom:' +
                resume.heading_spacing +
                'px;' +
                'padding-to:' +
                resume.heading_spacing +
                'px' +
                'font-family:' +
                font_family +
                '!important;' +
                'color:' +
                resume.color.primaryy_color +
                '!important;'
              "
            >
              <i
                class="fas fa-briefcase"
                style="font-size: 17px"
                :style="'color:' + resume.color.accent"
                aria-hidden="true"
              ></i>
              <!-- {{resume.heading_font_size }} -->
              <span
                class="ml-1"
                :style="{
                  color: resume.color.primaryy_color + '!important',
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + '!important',
                }"
              >
                {{ resumesection.title }}
              </span>
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
                  <!-- emphasis effect start -->
                  <span v-if="resume.employment_emphasis == 'Employer'">
                    <b>
                      {{
                        resumejob.job
                          ? resumejob.job.position
                            ? resumejob.job.position.pos_name
                            : ""
                          : ""
                      }}
                    </b>
                  </span>
                  <span v-else>
                    <b> {{ resumejob.job ? resumejob.job.company : "" }} </b>

                    <span
                      v-if="
                        resume.resume_setting.is_city_state_country &&
                        resume.resume_setting.is_location
                      "
                    >
                      - {{ resumejob.job ? resumejob.job.city : "" }},
                      {{ resumejob.job ? resumejob.job.state.state : "" }},
                      {{
                        resumejob.job ? resumejob.job.country.country_name : ""
                      }}
                    </span>
                    <span
                      v-if="
                        resume.resume_setting.is_city_state &&
                        resume.resume_setting.is_location
                      "
                    >
                      - {{ resumejob.job ? resumejob.job.city : "" }},
                      {{ resumejob.job ? resumejob.job.state.state : "" }}
                    </span>
                    <span v-if="resume.resume_setting.is_location"></span>
                  </span>
                  <!-- emphasis effect end -->

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
                    <span
                      v-if="
                        resumejob.job.end_date == '0000-00-00' ||
                        resumejob.job.end_date == null
                      "
                    >
                      Present
                    </span>
                    <span v-else>
                      {{ resumejob.job ? resumejob.job.end_year : "" }}
                    </span>
                  </span>
                  <span
                    class="right_resume_heading_year"
                    v-if="
                      resume.resume_setting.is_month_year &&
                      resume.resume_setting.is_dates
                    "
                  >
                    {{ resumejob.job ? resumejob.job.start_month : "" }}/{{
                      resumejob.job ? resumejob.job.start_year : ""
                    }}
                    -
                    <span
                      v-if="
                        resumejob.job.end_date == '0000-00-00' ||
                        resumejob.job.end_date == null
                      "
                    >
                      Present
                    </span>
                    <span v-else>
                      {{ resumejob.job ? resumejob.job.end_month : "" }}
                      /{{ resumejob.job ? resumejob.job.end_year : "" }}
                    </span>
                  </span>
                  <span
                    class="right_resume_heading_year"
                    v-if="!resume.resume_setting.is_dates"
                  ></span>
                </h3>
                <span
                  v-if="resume.employment_emphasis == 'Employer'"
                  class="working_as_Desig border-bottom-control mb-0"
                >
                  {{ resumejob.job ? resumejob.job.company : "" }}
                  <span
                    v-if="
                      resume.resume_setting.is_city_state_country &&
                      resume.resume_setting.is_location
                    "
                  >
                    - {{ resumejob.job ? resumejob.job.city : "" }},
                    {{ resumejob.job ? resumejob.job.state.state : "" }},
                    {{
                      resumejob.job ? resumejob.job.country.country_name : ""
                    }}
                  </span>
                  <span
                    v-if="
                      resume.resume_setting.is_city_state &&
                      resume.resume_setting.is_location
                    "
                  >
                    - {{ resumejob.job ? resumejob.job.city : "" }},
                    {{ resumejob.job ? resumejob.job.state.state : "" }}
                  </span>
                  <span v-if="resume.resume_setting.is_location"></span>
                </span>
                <span
                  v-else
                  class="working_as_Desig border-bottom-control mb-0"
                >
                  {{
                    resumejob.job
                      ? resumejob.job.position
                        ? resumejob.job.position.pos_name
                        : ""
                      : ""
                  }}
                </span>
                <div
                  class="additional_information"
                  :style="'text-indent:' + resume.indent_spacing + '% ;'"
                  v-if="resume.resume_setting.is_job_description"
                >
                  <p
                    :style="
                      'fontSize:' + resume.body_font_size + 'px !important;'
                    "
                    class="mt-0"
                    style="word-break: normal !important"
                  >
                    {{
                      resumejob.job
                        ? checkJobDescription(resumejob.job.id)
                          ? checkJobDescription(resumejob.job.id)
                          : resumejob.job.position
                          ? resumejob.job.position.pos_description
                          : "You can add description from job description page"
                        : "You can add description from job description page"
                    }}
                  </p>
                </div>
                <div v-else>
                  <p
                    :style="
                      'fontSize:' + resume.body_font_size + 'px !important;'
                    "
                  ></p>
                </div>

                <div
                  class="additional_information"
                  :style="'text-indent:' + resume.indent_spacing + '% ;'"
                >
                  <ul
                    style="margin-bottom: 0"
                    v-for="(
                      endorse, endorseKey
                    ) in resumejob.job.endorsements.filter(
                      (ea) => ea.status == 1
                    )"
                  >
                    <li>
                      <div
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        “{{ endorse.value }}”
                        <span style="font-family: sans-serif"
                          >– {{ endorse.author }},
                          {{ endorse.author_description }}
                          ,{{ resumejob.job.company }}
                        </span>
                      </div>
                    </li>
                  </ul>
                </div>
                <div
                  v-if="resume.type == 'functional'"
                  class="additional_information"
                  :style="'text-indent:' + resume.indent_spacing + '% ;'"
                >
                  <ul
                    style="margin-bottom: 0"
                    v-for="(experience, experienceKey) in sortArray(
                      resumejob.job.experiences
                    ).filter((as) => as.status == 1)"
                    :key="`#demo_exp_showme_${experienceKey}`"
                  >
                    <li
                      :style="
                        'fontSize:' + resume.body_font_size + 'px !important;'
                      "
                    >
                      <div>
                        {{ experience.description }}
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Professional Summary  -->
          <div
            v-if="resumesection.type == 'professional-summary'"
            v-show="resumesection.hidden == 1"
          >
            <h2
              class="resume_section_heading text-control-wrap d-flex w-100 align-items-center"
              :style="
                'padding-bottom:' +
                resume.heading_spacing +
                'px;' +
                'padding-to:' +
                resume.heading_spacing +
                'px;' +
                'font-family:' +
                font_family +
                '!important;'
              "
            >
              <i
                class="fas fa-chart-line"
                style="font-size: 17px"
                :style="'color:' + resume.color.accent"
                aria-hidden="true"
              ></i>
              <span
                class="ml-1"
                :style="{
                  color: resume.color.primaryy_color || '',
                  fontSize: resume.heading_font_size + 'px',
                }"
              >
                {{ resumesection.title }}
              </span>
            </h2>
            <p
              class="working_as_Desig"
              :style="
                'fontSize:' +
                resume.body_font_size +
                'px !important;' +
                'font-family:' +
                font_family +
                '!important;'
              "
              style="word-break: normal !important"
            >
              {{ resumesection.content }}
            </p>

            <div
              v-for="(pro_summ_subsection, i) in getProSummSubSectionArray"
              :key="i"
              :style="'fontSize:' + resume.body_font_size + 'px !important;'"
            >
              <div
                v-if="pro_summ_subsection != null && pro_summ_subsection.status"
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
                  {{ pro_summ_subsection.title }}
                </h3>
                <span
                  class="working_as_Desig"
                  :style="
                    'fontSize:' + resume.body_font_size + 'px !important;'
                  "
                  >{{ pro_summ_subsection.content }}</span
                >
                <!-- experience against resume subsection -->
                <div
                  class="additional_information"
                  :style="'text-indent:' + resume.indent_spacing + '% ;'"
                >
                  <ul>
                    <li
                      v-if="pro_summ_subsection.resume_experience.length > 0"
                      v-for="(
                        pro_sum_sub_res_experience, proSumSubSecKey
                      ) in pro_summ_subsection.resume_experience"
                      :key="proSumSubSecKey"
                    >
                      <div
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        {{
                          pro_sum_sub_res_experience.experience
                            ? pro_sum_sub_res_experience.experience.description
                            : "no data"
                        }}
                      </div>
                    </li>
                  </ul>
                </div>

                <!--  -->
              </div>
            </div>
          </div>
          <!-- Education Section  -->
          <div
            v-if="resumesection.type == 'education'"
            v-show="resumesection.hidden == 1"
          >
            <div class="resume_info_sub_section">
              <div class="edu_qualification_list">
                <h2
                  class="resume_section_heading text-control-wrap d-flex w-100 align-items-center"
                  :style="
                    'padding-bottom:' +
                    resume.heading_spacing +
                    'px;' +
                    'padding-to:' +
                    resume.heading_spacing +
                    'px' +
                    'font-family:' +
                    font_family +
                    '!important;'
                  "
                >
                  <i
                    class="fal fa-book-open"
                    style="font-size: 17px; font-weight: 800"
                    :style="'color:' + resume.color.accent"
                    aria-hidden="true"
                  ></i>
                  <span
                    class="ml-1"
                    :style="{
                      color: resume.color.primaryy_color || '',
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + '!important',
                    }"
                  >
                    {{ resumesection.title }}
                  </span>
                </h2>
                <div
                  v-for="(education, key) in sortEducationArray(
                    getEduArray
                  ).filter((ae) => ae.status == 1)"
                  :key="key"
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
                    <div class="align-degree-education-card">
                      <span
                        v-if="
                          showEducationDegree(education) == true &&
                          education.is_degree
                        "
                      >
                        <span v-if="resume.education_emphasis == 'Degree'">
                          {{ getDegree(education.degree) }}
                        </span>
                        <span v-else>
                          {{ education.school }}
                        </span>
                      </span>

                      <p
                        v-if="education.is_major_field_study && education.major"
                      >
                        - {{ education.major }}
                      </p>
                      <p
                        v-if="
                          education.minors.length > 0 &&
                          getShowEducationEnhancement
                        "
                      >
                        -
                        <span v-if="getActiveMinorLength(education.minors) > 0">
                          Minor<span
                            v-if="getActiveMinorLength(education.minors) > 1"
                            >s</span
                          >
                          In</span
                        >
                        <span
                          v-for="(minor, keyMinorshow) in sortEducationArray(
                            education.minors
                          ).filter((ae) => ae.status == 1)"
                          :key="`#demo_minor_onss${minor.id}`"
                        >
                          {{ minor.minor }}
                          <span
                            v-if="getActiveMinorLength(education.minors) == 1"
                            >.</span
                          >
                          <span
                            v-else-if="
                              getActiveMinorLength(education.minors) == 2 &&
                              keyMinorshow !== 1
                            "
                            >and</span
                          >

                          <span
                            v-else-if="
                              getActiveMinorLength(education.minors) > 2
                            "
                          >
                            <span
                              v-if="
                                getActiveMinorLength(education.minors) -
                                  keyMinorshow ==
                                2
                              "
                              >and</span
                            >
                            <span
                              v-else-if="
                                getActiveMinorLength(education.minors) -
                                  keyMinorshow ==
                                1
                              "
                              >.</span
                            >
                            <span v-else>,</span>
                          </span>
                        </span>
                      </p>
                    </div>

                    <span v-if="!education.is_grad_date">
                      <span
                        class="right_resume_heading_year"
                        v-if="
                          resume.resume_setting.is_edu_month_year &&
                          resume.resume_setting.is_edu_dates
                        "
                        >{{ education.grad_month }}/{{
                          education.grad_year
                        }}</span
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
                    </span>
                    <span class="working_as_Desig pl-0">
                      <span v-if="resume.education_emphasis == 'Degree'">
                        {{ education.school }}
                      </span>
                      <span v-else>
                        {{ getDegree(education.degree) }}
                      </span>

                      <span
                        v-if="
                          resume.resume_setting.is_edu_city_state_country &&
                          resume.resume_setting.is_edu_location
                        "
                        >{{ education.city }}, {{ education.state.state }},{{
                          education.country
                        }}</span
                      >
                      <span
                        v-if="
                          resume.resume_setting.is_edu_city_state &&
                          resume.resume_setting.is_edu_location
                        "
                        >{{ education.city }}, {{ education.state.state }}</span
                      >
                      <span
                        v-if="!resume.resume_setting.is_edu_location"
                      ></span>
                    </span>
                  </h3>

                  <div
                    class="additional_information"
                    :style="'text-indent:' + resume.indent_spacing + '% ;'"
                    style="margin-bottom: 0"
                    v-if="
                      education.is_credits_completed &&
                      education.credits_completed !== null &&
                      getShowEducationEnhancement
                    "
                  >
                    <ul style="margin-bottom: 0">
                      <li>
                        <p>
                          {{ education.credits_completed }} - Credits Complete
                        </p>
                      </li>
                    </ul>
                  </div>

                  <div
                    class="additional_information"
                    :style="'text-indent:' + resume.indent_spacing + '% ;'"
                    style="margin-bottom: 0"
                    v-if="education.is_major_gpa && getShowEducationEnhancement"
                  >
                    <ul style="margin-bottom: 0">
                      <li>
                        <p>
                          <span v-if="education.gpa_format == 'full'">
                            Major GPA - {{ education.majorgpa }} out of 4.0
                          </span>
                          <span v-else>
                            Major GPA - {{ education.majorgpa }}
                          </span>
                        </p>
                      </li>
                    </ul>
                  </div>

                  <div
                    class="additional_information"
                    :style="'text-indent:' + resume.indent_spacing + '% ;'"
                    style="margin-bottom: 0"
                    v-if="
                      education.is_overall_gpa && getShowEducationEnhancement
                    "
                  >
                    <ul style="margin-bottom: 0">
                      <li>
                        <p>
                          <span v-if="education.gpa_format == 'full'">
                            Overall GPA - {{ education.overallgpa }} out of 4.0
                          </span>
                          <span v-else>
                            Overall GPA - {{ education.overallgpa }}
                          </span>
                        </p>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- edu subsection start -->

                <div class="container">
                  <div class="row">
                    <div
                      :class="checkDynamicEduClass(resumesection.column, 1)"
                      class="col-sm-12"
                      v-for="(
                        eduSubSection, index
                      ) in getEduSubSectionArray.filter((el) => el.status == 1)"
                      v-bind:key="index"
                    >
                      <!-- {{ eduSubSection.edu_sub_section_content }} -->
                      <h5
                        :style="
                          'background-color:' +
                          resume.color.secondary +
                          '!important;'
                        "
                        class="resume_sub_section_heading"
                        v-if="eduSubSection.title"
                      >
                        {{ eduSubSection.title }}
                      </h5>
                      <p
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                        v-if="eduSubSection.content"
                        class="working_as_Desig"
                      >
                        {{ eduSubSection.content }}
                      </p>
                      <div
                        v-if="eduSubSection.list_style == 'vertical_bullets'"
                      >
                        <div
                          class="additional_information vertical_buttets"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              eduSubSection.edu_sub_section_content
                            )"
                            :key="`#demo_edu_st_${key}`"
                          >
                            <li v-if="eduSubSectionContent.type === 'skills'">
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>

                            <li
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  style="font-family: sans-serif"
                                  v-if="
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  "
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                </span>
                              </div>
                            </li>

                            <li v-else v-show="getShowEducationEnhancement">
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>

                          <!-- <p
                                  v-if="eduSubSectionContent.type === 'skills'"
                                  class="bullet-point"
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </p> -->

                          <!-- <p v-else class="bullet-point">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </p> -->
                        </div>
                      </div>

                      <div
                        v-else-if="
                          eduSubSection.list_style == 'horizontal_bullets'
                        "
                      >
                        <div
                          class="additional_information d-flex"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                          style="margin-bottom: 0"
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              eduSubSection.edu_sub_section_content
                            )"
                            :key="`#demo_edu_sat_${key}`"
                          >
                            <li v-if="eduSubSectionContent.type === 'skills'">
                              <div>
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>

                            <li
                              v-if="eduSubSectionContent.type === 'endorsement'"
                            >
                              <div>
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                  ,
                                  {{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
                                  }}
                                </span>
                              </div>
                            </li>
                            <li v-else v-show="getShowEducationEnhancement">
                              <div>
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div v-else>
                        <!-- sub section no bulites -->
                        <div
                          class="additional_information vertical_buttets"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              eduSubSection.edu_sub_section_content
                            )"
                            :key="`#demo_edu_stel_${key}`"
                          >
                            <li
                              class="no-builets-test"
                              v-if="eduSubSectionContent.type === 'skills'"
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>

                            <li
                              class="no-builets-test"
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  style="font-family: sans-serif"
                                  v-if="
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  "
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                </span>
                              </div>
                            </li>

                            <li
                              class="no-builets-test"
                              v-else
                              v-show="getShowEducationEnhancement"
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>
                        <!-- sub section no bulites -->

                        <!-- <div
                          v-for="(
                            eduSubSectionContent, key
                          ) in sortEducationArray(
                            eduSubSection.edu_sub_section_content
                          )"
                          :key="`#demo_edu_stel_${key}`"
                        >
                          <p v-if="eduSubSectionContent.type === 'skills'">
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </p>

                          <p
                            v-else-if="
                              eduSubSectionContent.type === 'endorsement'
                            "
                          >
                            “{{
                              eduSubSectionContent.subsection_content_able
                                .value
                            }}”
                            <span
                              >–
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .author
                              }},
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .author_description
                              }}</span
                            >
                          </p>

                          <p v-else v-show="getShowEducationEnhancement">
                            {{
                              eduSubSectionContent.subsection_content_able.value
                            }}
                          </p>
                        </div> -->
                      </div>

                      <!-- <hr /> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Skill Section  -->
          <div
            v-if="resumesection.type == 'skill'"
            v-show="resumesection.hidden == 1"
          >
            <div class="Skills_experience_list" style="margin-top: 20px">
              <h2
                class="resume_section_heading text-control-wrap d-flex w-100 align-items-center"
                :style="
                  'padding-bottom:' +
                  resume.heading_spacing +
                  'px;' +
                  'padding-to:' +
                  resume.heading_spacing +
                  'px' +
                  'font-family:' +
                  font_family +
                  '!important;'
                "
              >
                <i
                  class="fa fa-user"
                  style="font-size: 17px"
                  :style="'color:' + resume.color.accent"
                  aria-hidden="true"
                ></i>

                <span
                  class="ml-1"
                  :style="{
                    color: resume.color.primaryy_color || '',
                    fontSize: resume.heading_font_size + 'px',
                    fontFamily: font_family + '!important',
                  }"
                >
                  {{ resumesection.title }}
                </span>
              </h2>

              <p
                :style="'fontSize:' + resume.body_font_size + 'px !important;'"
                class="working_as_Desig"
              >
                {{ resumesection.content }}
              </p>
              <div class="container column-devide-container">
                <div class="row">
                  <div
                    class="col-sm-12 mb-3"
                    :class="checkDynamicSkillClass(resumesection.column)"
                    v-for="(
                      skill_sub_section, skillsSubSecKey
                    ) in getSkillSubSectionArray"
                    :key="skillsSubSecKey"
                    :style="
                      'fontSize:' + resume.body_font_size + 'px !important;'
                    "
                  >
                    <div>
                      <div>
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
                          {{ skill_sub_section.title ?? "Untitled SubSection" }}
                        </h3>
                        <span
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;'
                          "
                          class="working_as_Desig border-bottom-control"
                          style="border-bottom: 0 !important"
                          >{{ skill_sub_section.content }}</span
                        >

                        <div
                          v-if="
                            skill_sub_section.list_style == 'vertical_bullets'
                          "
                        >
                          <div
                            class="additional_information vertical_buttets"
                            :style="
                              'text-indent:' + resume.indent_spacing + '% ;'
                            "
                          >
                            <ul
                              style="margin-bottom: 0"
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                skill_sub_section.edu_sub_section_content
                              )"
                              :key="`#demo_exp_showme,kk_${key}`"
                            >
                              <li v-if="eduSubSectionContent.type == 'skills'">
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>

                              <li
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  “{{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}”
                                  <span
                                    >–
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.author
                                    }},
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able
                                        .author_description
                                    }}
                                    ,
                                    {{
                                      getJobName(
                                        eduSubSectionContent
                                          .subsection_content_able.job_id
                                      )
                                    }}
                                  </span>
                                </div>
                              </li>
                              <li v-else v-show="getShowEducationEnhancement">
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>

                        <div
                          v-else-if="
                            skill_sub_section.list_style == 'horizontal_bullets'
                          "
                          class="d-flex"
                        >
                          <div
                            class="additional_information d-flex skil-horizontal"
                            :style="
                              'text-indent:' + resume.indent_spacing + '% ;'
                            "
                            style="margin-bottom: 0"
                          >
                            <ul
                              style="margin-bottom: 0"
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                skill_sub_section.edu_sub_section_content
                              )"
                              :key="`#demo_exp_sjkljhowme_${key}`"
                            >
                              <li v-if="eduSubSectionContent.type === 'skills'">
                                <div>
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>
                              <li
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div>
                                  “{{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}”
                                  <span
                                    >–
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.author
                                    }},
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able
                                        .author_description
                                    }}
                                    ,
                                    {{
                                      getJobName(
                                        eduSubSectionContent
                                          .subsection_content_able.job_id
                                      )
                                    }}
                                  </span>
                                </div>
                              </li>

                              <li v-else v-show="getShowEducationEnhancement">
                                <div>
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>

                        <div v-else>
                          <!-- sub section no bulites new section -->
                          <div
                            class="additional_information vertical_buttets"
                            :style="
                              'text-indent:' + resume.indent_spacing + '% ;'
                            "
                          >
                            <ul
                              style="margin-bottom: 0"
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                skill_sub_section.edu_sub_section_content
                              )"
                              :key="`#demo_exp_sjkljkkkkhowme_${key}`"
                            >
                              <li
                                class="no-builets-test"
                                v-if="eduSubSectionContent.type === 'skills'"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>

                              <li
                                class="no-builets-test"
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  “{{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}”
                                  <span
                                    >–
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.author
                                    }},
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able
                                        .author_description
                                    }}</span
                                  >
                                </div>
                              </li>

                              <li
                                class="no-builets-test"
                                v-else
                                v-show="getShowEducationEnhancement"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </div>
                              </li>
                            </ul>
                          </div>
                          <!-- sub section no bulites new section -->

                          <!-- <div
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              skill_sub_section.edu_sub_section_content
                            )"
                            :key="`#demo_exp_sjkljkkkkhowme_${key}`"
                          >
                            <p v-if="eduSubSectionContent.type === 'skills'">
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .name
                              }}
                            </p>
                            <p
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              “{{
                                eduSubSectionContent.subsection_content_able
                                  .value
                              }}”
                              <span
                                >–
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .author
                                }},
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .author_description
                                }}</span
                              >
                            </p>

                            <p v-else v-show="getShowEducationEnhancement">
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .value
                              }}
                            </p>
                          </div> -->
                        </div>
                        <!-- end here -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- skill section end -->
          </div>
          <!-- new section start -->
          <div
            v-if="resumesection.type == 'new-section'"
            v-show="resumesection.hidden == 1"
          >
            <h2
              class="resume_section_heading text-control-wrap d-flex w-100 align-items-center"
              :style="
                'padding-bottom:' +
                resume.heading_spacing +
                'px;' +
                'padding-to:' +
                resume.heading_spacing +
                'px;' +
                'font-family:' +
                font_family +
                '!important;'
              "
            >
              <i
                class="fas fa-edit"
                style="font-size: 17px"
                :style="'color:' + resume.color.accent"
                aria-hidden="true"
              ></i>
              <span
                class="ml-1"
                :style="{
                  color: resume.color.primaryy_color || '',
                  fontSize: resume.heading_font_size + 'px',
                }"
              >
                {{ resumesection.title }}
              </span>
            </h2>

            <p
              :style="'fontSize:' + resume.body_font_size + 'px !important;'"
              class="working_as_Desig"
              style="text-decoration: none"
              v-if="resumesection.content"
            >
              {{ resumesection.content }}
            </p>

            <div class="container column-devide-container">
              <div class="row">
                <div
                  class="col-sm-12 mb-3"
                  :class="checkDynamicNewSectionClass(resumesection.column)"
                  v-for="(
                    new_sub_section, skillsSubSecKey
                  ) in resumesection.resume_sub_section.filter(
                    (wa) => wa.status == true
                  )"
                  :key="skillsSubSecKey"
                  :style="
                    'fontSize:' + resume.body_font_size + 'px !important;'
                  "
                >
                  <div>
                    <div>
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
                        {{ new_sub_section.title ?? "Untitled SubSection" }}
                      </h3>
                      <span
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                        class="working_as_Desig border-bottom-control"
                        style="border-bottom: 0 !important"
                        >{{ new_sub_section.content }}</span
                      >

                      <div
                        v-if="new_sub_section.list_style == 'vertical_bullets'"
                      >
                        <div
                          class="additional_information vertical_buttets"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              new_sub_section.edu_sub_section_content
                            )"
                            :key="`#demo_exp_showme,kk_${key}`"
                          >
                            <li v-if="eduSubSectionContent.type == 'skills'">
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>

                            <li
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                  ,
                                  {{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
                                  }}
                                </span>
                              </div>
                            </li>

                            <li v-else v-show="getShowEducationEnhancement">
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div
                        v-else-if="
                          new_sub_section.list_style == 'horizontal_bullets'
                        "
                        class="d-flex"
                      >
                        <div
                          class="additional_information d-flex"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                          style="margin-bottom: 0"
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              new_sub_section.edu_sub_section_content
                            )"
                            :key="`#demo_exp_sjkljhowme_${key}`"
                          >
                            <li v-if="eduSubSectionContent.type === 'skills'">
                              <div>
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>
                            <li
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div>
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}
                                  ,
                                  {{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
                                  }}
                                </span>
                              </div>
                            </li>

                            <li v-else v-show="getShowEducationEnhancement">
                              <div>
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div v-else>
                        <!-- sub section no bulites new section -->
                        <div
                          class="additional_information vertical_buttets"
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                        >
                          <ul
                            style="margin-bottom: 0"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              new_sub_section.edu_sub_section_content
                            )"
                            :key="`#demo_exp_sjkljkkkkhowme_${key}`"
                          >
                            <li
                              class="no-builets-test"
                              v-if="eduSubSectionContent.type === 'skills'"
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </div>
                            </li>

                            <li
                              class="no-builets-test"
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                “{{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}”
                                <span
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }}</span
                                >
                              </div>
                            </li>

                            <li
                              class="no-builets-test"
                              v-else
                              v-show="getShowEducationEnhancement"
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>
                        <!-- sub section no bulites new section -->

                        <!-- <div
                          v-for="(
                            eduSubSectionContent, key
                          ) in sortEducationArray(
                            new_sub_section.edu_sub_section_content
                          )"
                          :key="`#demo_exp_sjkljkkkkhowme_${key}`"
                        >
                          <p v-if="eduSubSectionContent.type === 'skills'">
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </p>
                          <p
                            v-else-if="
                              eduSubSectionContent.type === 'endorsement'
                            "
                          >
                            “{{
                              eduSubSectionContent.subsection_content_able
                                .value
                            }}”
                            <span
                              >–
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .author
                              }},
                              {{
                                eduSubSectionContent.subsection_content_able
                                  .author_description
                              }}</span
                            >
                          </p>

                          <p v-else v-show="getShowEducationEnhancement">
                            {{
                              eduSubSectionContent.subsection_content_able.value
                            }}
                          </p>
                        </div> -->
                      </div>
                      <!-- end here -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- <hr /> -->
          </div>

          <!-- end section -->
        </div>
      </div>
    </div>

    <div class="resume-bottom">
      <div class="row mt-3">
        <div class="col-md-7 col-sm-12 footer-spacing-remove-mobile">
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
          <p class="text-center">2024 Resume Yak. All rights reserved</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import { environment_api } from "../../../env";
import store from "../../../store";
import html2pdf from "html2pdf.js";
import Common from "../../../mixins/Common";

export default {
  mixins: [Common],
  name: "FirstTemplate",
  data() {
    return {
      EnvPath: environment_api.api_base_url,
      resume_address: "",
      jobDescriptionsArray: [],
      font_family: "",
      printPdf: false,
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
  props: {
    showHideContent: {
      type: [Object, Array],
      default: null,
    },
    resume: {
      type: [Object, Array],
      default: null,
    },
    downloadResume: {
      type: [Boolean],
    },
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
    ]),
    ...mapState({
      // arrow functions can make the code very succinct!
      resumeStateData: (state) => state.Two_Page_Resume,
    }),
  },
  mounted() {
    this.getAddress();
    this.getJobDescriptionsForResume();
    this.getFontFamily();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
    },

    downloadResume: function () {
      this.generatePDF();
    },
  },

  methods: {
    // generatePDF() {
    //   try {
    //     const element = this.$refs.htmlToConvert;
    //     const pdfOptions = {
    //       margin: [2, 0, 3, 0],
    //       filename: this.resume.name + ".pdf",
    //       image: { type: "jpeg", quality: 0.98 },
    //       html2canvas: {
    //         dpi: 96,
    //         letterRendering: true,
    //       },
    //       pagebreak: {
    //         avoid: "p ,h3,br,h1,h2,h4,h5,strong,span,ul,li,a",
    //       },

    //       jsPDF: {
    //         unit: "mm",
    //         format: "a4",
    //         orientation: "portrait",
    //       },
    //     };

    //     html2pdf(element, pdfOptions)
    //       .outputPdf()
    //       .then((pdf) => {
    //         const blob = new Blob([pdf], { type: "application/pdf" });
    //         const url = window.URL.createObjectURL(blob);
    //       });
    //   } catch (error) {
    //     console.error("Error generating PDF:", error);
    //   }
    // },
    checkJobDescription(job_id) {
      var findJob = this.jobDescriptionsArray.find(
        (item) => item.job_id === job_id
      );
      if (findJob && findJob.final_job_description !== null) {
        return findJob.final_job_description;
      } else {
        return false;
      }
    },
    getJobDescriptionsForResume: function () {
      axios
        .get(this.EnvPath + "api/get-resume-job-descriptions/" + this.resume.id)
        .then(({ data }) => {
          if (data.status) {
            this.jobDescriptionsArray = data.data;
          } else {
            this.jobDescriptionsArray = [];
          }
        });
    },
    getActiveMinorLength: function (minors) {
      var count = minors.filter((sa) => sa.status == 1).length;
      return count;
    },
    getFontFamily() {
      let font = "";
      if (!this.resume.font) {
        this.font_family = font;
      } else {
        this.font_family = this.resume.font.font_family;
      }
    },
    getAddress() {
      let address = "";
      if (!this.resume.resume_setting.is_info_location) {
        this.resume_address = address;
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
        address += this.resume.user.state.state + " ";
      }
      if (
        this.resume.user.countries.country_name &&
        this.resume.resume_setting.is_info_full_address_city
      ) {
        address += this.resume.user.countries.country_name;
      }
      this.resume_address = address;
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
    sortMainSectionArray: function (value) {
      return value.slice().sort(function (a, b) {
        return a.order < b.order ? -1 : 1;
      });
    },
    showEducationDegree: function (value) {
      if (value.degree == 16) {
        // if Some college
        return false;
      } else {
        return true;
      }
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
        return this.resume.resume_setting.is_pro
          ? this.resume.user.professional_profile
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
        address += this.resume.user.state.state + " ";
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
      // const self = this;
      // axios
      //   .post(this.EnvPath + "api/update-skill", {
      //     id: id
      //   })
      //   .then(function(response) {
      //     self.resume = {};
      //     store.commit("TwoPageResumeData", response.data);
      //     Object.assign(self.resume, response.data);
      //     // this.resume = response.data;
      //   });
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Exo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

.professional_profile {
  float: left;
  padding: 0px !important;
  font-size: 13px;
  font-family: "Hind", sans-serif;
  color: #767676;
  line-height: 20px;
  min-width: 33.33%;
}

.fa-user {
  content: "\f0e0";
}

i.fas.fa-globe-europe {
  content: "\f0e0";
  /* color: #c4e6de; */
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
  height: 100% !important;
}

.resume-control-preview {
  /* height: 100% !important; */
  /* width: 100% !important;
  min-width: 100% !important;
  max-width: 100% !important; */
  min-width: 8.27in !important;
  min-height: 11.69in !important;
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
  /* min-width: 690px;
  max-width: 690px;
  max-height: 993px;
  min-height: 892px; */
  min-width: 8.27in !important;
  min-height: 11.69in !important;
  max-height: 100% !important;
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
  /* word-break: break-all; */
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

.footer-spacing-remove-mobile {
  padding: 0;
  margin-left: -10px;
  text-align: center;
}
i.fab.fa-linkedin {
  color: #c4e6de;
  font-size: 14px;
}

.col-md-4.professional_profile.mb-1 .resume-text-control {
  align-items: center;
}

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

li.no-builets-test {
  list-style: none !important;
}

.top-contact-icon-list {
  width: 32% !important;
}

span.contact-icon-text {
  font-size: 14px;
  color: #767676;
  padding-right: 5px;
  padding-left: 5px;
  vertical-align: -webkit-baseline-middle;
}

@media (max-width: 450px) {
  .border-bottom-control:before {
    width: 92%;
    bottom: 0;
  }

  h2.resume-title-no-font {
    font-size: 16px;
  }
}

.col-md-4.contact_phone.text-align-right .resume-text-control {
  justify-content: flex-end !important;
}

.top-contact-icon-list.contact_email:nth-child(2) {
  display: flex;
  justify-content: center;
}
.top-contact-icon-list.contact_email:nth-child(3),
.top-contact-icon-list.contact_email:nth-child(5) {
  display: flex;
  justify-content: flex-end;
}

.col-md-6.professional_profile.mb-1.d-flex.justify-content-end {
  padding-right: 23px !important;
}

.additional_information.d-flex.skil-horizontal ul {
  width: 50%;
}

span,
p,
h1,
h2,
h3,
h4,
h5,
h6,
div,
strong {
  word-break: normal !important;
}
</style>
