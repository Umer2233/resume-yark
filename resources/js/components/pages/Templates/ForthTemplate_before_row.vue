<template>
  <div>
    <div ref="htmlToConvertd">
      <div v-for="card in finalContent" :key="card.id">
        <div v-html="card.innerHTML"></div>
      </div>
    </div>
    <div
      class="resume-design-div work_experience_lists section"
      style="padding: 0 !important"
      :style="{
        'min-height': divHeight + 'in !important',
        'padding-top': (resume.top_bottom_margi / 10) * 96 + 'px',
        'padding-bottom': (resume.top_bottom_margi / 10) * 96 + 'px',
        'font-family': font_family + ' !important',
        'letter-spacing': resume.body_text_spacing + '%',
        background:
          'linear-gradient(270deg, rgba(255, 255, 255, 1) 66.7%, ' +
          resume.color.primaryy_color +
          ' 66.7%)',
      }"
    >
      <!-- New third template -->
      <div
        class="container"
        v-for="(resumesection, key) in sortMainSectionArray(
          resumeStateData.resume_sections
        )"
        :key="`#mains${key}`"
      >
        <!-- Contact section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 95%; margin: 0 auto"
          v-if="resumesection.type == 'contact'"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              ';margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
            style="margin-left: 25px"
          >
            <div class="sub-section side-bar-section">
              <div>
                <div
                  class="temp_03-main-heading"
                  :style="{
                    fontSize: resume.heading_font_size + 'px',
                    fontFamily: font_family + '!important',
                    color: resume.color.secondary || '',
                  }"
                  style="text-align: center !important"
                >
                  <span>
                    {{ resume.user ? resume.user.first_name + "" : "" }}
                  </span>
                  <span v-if="resume.resume_setting.is_middle">{{
                    resume.user ? resume.user.middle_initial + "." : ""
                  }}</span>
                  <br />
                  {{ resume.user ? resume.user.last_name : "" }}
                </div>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container padding-top-section-space border-bottom-dard"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="border-line-bottom">
              <div v-show="showHideContent.headline">
                <div
                  v-if="resumeStateData.resume_setting.endorsement_type == 1"
                >
                  <span
                    v-for="(
                      endorse, key
                    ) in resumeStateData.user.endorsements.filter(
                      (wa) => wa.top_endorsment_status == true
                    )"
                    :key="`#this_is${key}`"
                  >
                    <div
                      class="temp_03-rightHeading sub-section"
                      :style="{
                        fontSize: resume.heading_font_size + 'px',
                        fontFamily: font_family + ' !important',
                        paddingBottom: resume.heading_spacing + 'px',
                        color: resume.color.accent || '',
                      }"
                      style="word-break: normal !important"
                    >
                      “{{ endorse.value }}”
                    </div>
                    <div
                      class="temp_03-r-h-2 sub-section"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font +
                        '!important;'
                      "
                    >
                      – {{ endorse.author }}, {{ endorse.author_description }},
                      {{ endorse.job_id ? getJobName(endorse.job_id) : "" }}
                      <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                    </div>
                  </span>
                </div>
                <div
                  class="temp_03-rightHeading sub-section"
                  v-if="resumeStateData.resume_setting.endorsement_type == 2"
                >
                  {{
                    resumeStateData.resume_qualification_statement
                      ? resumeStateData.resume_qualification_statement
                          .final_statement
                      : ""
                  }}
                </div>
              </div>

              <div class="d-flex justify-content-between p-2">
                <div
                  class="temp_03-sub-headingData sub-section"
                  :style="
                    'fontSize:' +
                    resume.body_font_size +
                    'px !important;' +
                    'font-family:' +
                    font_family +
                    '!important;' +
                    'color:' +
                    resume.color.accent +
                    '!important;'
                  "
                >
                  <div class="row" v-if="getContactSortedItemsFromState">
                    <div
                      class="col-lg-6 col-md-12 icon-loop-style"
                      v-for="(
                        item, key
                      ) in getContactSortedItemsFromState.slice(0, 5)"
                      :key="`#thisd_is${key}`"
                    >
                      <div
                        class="col-md-6"
                        v-if="item.type == 'blank'"
                        style="color: black"
                      >
                        <span>
                          <span class="icon"></span>
                        </span>
                      </div>
                      <div class="" v-if="getContactDataByType(item.type)">
                        <h5 class="data-card d-flex">
                          <i
                            :class="getContactIconClassByType(item)"
                            class="mr-1"
                          ></i>
                          <span
                            :style="'color:' + resume.color.font + '!important'"
                          >
                            {{ getContactDataByType(item.type) }}
                          </span>
                        </h5>
                      </div>
                    </div>
                  </div>
                  <div v-else class="row">
                    <div
                      class="col-md-6"
                      v-if="resume.resume_setting.is_phone"
                      :style="'color:' + resume.color.font + '!important;'"
                    >
                      <i
                        class="fa fa-phone m-1"
                        style="color: #ffa338"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i>
                      {{ resume.user ? resume.user.phone : "" }}
                    </div>
                    <div
                      class="col-md-6 flex-align-center"
                      v-if="
                        resume.resume_setting.is_web &&
                        resume.user.website != null
                      "
                      :style="'color:' + resume.color.font + '!important;'"
                    >
                      <i
                        class="fa fa-globe m-1"
                        style="color: #ffa338"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i>
                      {{ resume.user ? resume.user.website : "" }}
                    </div>
                    <div
                      class="col-md-6 d-flex mt-3"
                      v-if="resume.resume_setting.is_email"
                      :style="'color:' + resume.color.font + '!important;'"
                    >
                      <i
                        class="fa fa-envelope m-1"
                        style="color: #ffa338"
                        :style="'color:' + resume.color.accent + '!important;'"
                      ></i>
                      {{ resume.user ? resume.user.email : "" }}
                    </div>
                    <!--  -->
                    <div
                      class="temp_03-sub-headingData col-md-6 mt-3 flex-align-center"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font +
                        '!important;'
                      "
                    >
                      <div
                        class=""
                        v-if="
                          resume.resume_setting.is_pro &&
                          resume.user.professional_profile != null
                        "
                        :style="'color:' + resume.color.font + '!important;'"
                      >
                        <i
                          class="fab fa-linkedin"
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
                          style="
                            color: #ffa338;
                            font-size: 14px;
                            margin-right: 2px;
                          "
                        ></i>
                        {{
                          resume.user ? resume.user.professional_profile : ""
                        }}
                      </div>
                    </div>
                    <div
                      class="temp_03-sub-headingData col-md-6 mt-3"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font +
                        '!important;'
                      "
                    >
                      <div class="" v-if="resume_address">
                        <i
                          class="fas fa-map-marker-alt m-1"
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
                          style="color: #ffa338"
                        ></i>
                        {{ resume_address }}
                      </div>
                    </div>
                    <!--  -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Performance Summary section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="
            resumesection.type == 'professional-summary' &&
            resume.type == 'functional'
          "
          v-show="resumesection.hidden == 1"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="sub-section side-bar-section">
              <div
                class="temp_03-sub-heading"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                  color: resume.color.secondary || '',
                }"
              >
                <span>
                  {{ resumesection.title }}
                </span>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard"
          >
            <div
              class="temp_03-rightHeading sub-section"
              :style="{
                'font-size': resume.subheading_font_s + 'px',
                'padding-top': resume.subheading_spacin + 'px',
                'padding-bottom': resume.subheading_spacin + 'px',
                color: resume.color.accent + ' !important',
                'margin-right': (resume.left_right_margin / 10) * 96 + 'px',
              }"
            >
              {{ resumesection.content }}
            </div>

            <div
              v-for="(pro_summ_subsection, i) in getProSummSubSectionArray"
              :key="`#this_isadfs${i}`"
            >
              <div
                v-if="pro_summ_subsection != null && pro_summ_subsection.status"
              >
                <div
                  class="temp_03-rightHeading sub-section"
                  :style="{
                    'font-size': resume.subheading_font_s + 'px',
                    'padding-top': resume.subheading_spacin + 'px',
                    'padding-bottom': resume.subheading_spacin + 'px',
                    color: resume.color.accent + ' !important',
                  }"
                >
                  {{ pro_summ_subsection.title }}
                </div>

                <div
                  class="temp_03-sub-headingData sub-section"
                  :style="'color:' + resume.color.font + '!important;'"
                >
                  {{ pro_summ_subsection.content }}
                </div>

                <div
                  class="temp_03-unorder-list sub-section"
                  :style="
                    'color:' +
                    resume.color.font +
                    '!important;' +
                    'text-indent:' +
                    resume.indent_spacing +
                    '%'
                  "
                >
                  <ul>
                    <li
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                      v-if="pro_summ_subsection.resume_experience.length > 0"
                      v-for="(
                        pro_sum_sub_res_experience, proSumSubSecKey
                      ) in pro_summ_subsection.resume_experience"
                      :key="`#deexp_showme_${proSumSubSecKey}`"
                    >
                      {{
                        pro_sum_sub_res_experience.experience
                          ? pro_sum_sub_res_experience.experience.description
                          : "no data"
                      }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Work Experience section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="resumesection.type == 'work'"
          v-show="resumesection.hidden == 1"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="sub-section side-bar-section">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                  color: resume.color.secondary || '',
                }"
              >
                <span> {{ resumesection.title }}</span>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              v-for="(resumejob, i) in getJobArray.filter(
                (ae) => ae.active == 1
              )"
              :key="`hello_yhi_${i}`"
            >
              <div class="d-flex justify-content-between sub-sub-heading">
                <div
                  class="temp_03-rightHeading sub-section"
                  :style="{
                    'font-size': resume.subheading_font_s + 'px',
                    'padding-top': resume.subheading_spacin + 'px',
                    'padding-bottom': resume.subheading_spacin + 'px',
                    color: resume.color.accent || '',
                  }"
                >
                  <span v-if="resume.employment_emphasis == 'Employer'">
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
                  <span v-else>
                    {{
                      resumejob.job
                        ? resumejob.job.position
                          ? resumejob.job.position.pos_name
                          : ""
                        : ""
                    }}
                  </span>
                </div>
                <div
                  class="temp_03-rightHeading sub-section"
                  style="white-space: nowrap !important"
                  :style="{
                    'font-size': resume.subheading_font_s + 'px',
                    'padding-top': resume.subheading_spacin + 'px',
                    'padding-bottom': resume.subheading_spacin + 'px',
                    color: resume.color.accent || '',
                  }"
                >
                  <div
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
                  </div>
                  <div
                    class=""
                    v-if="
                      resume.resume_setting.is_month_year &&
                      resume.resume_setting.is_dates
                    "
                  >
                    {{ resumejob.job ? resumejob.job.start_month : "" }}
                    /{{ resumejob.job ? resumejob.job.start_year : "" }}
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
                  </div>
                  <div v-if="!resume.resume_setting.is_dates"></div>
                </div>
              </div>
              <div
                class="temp-sub-heading sub-section"
                :style="
                  'fontSize:' +
                  resume.body_font_size +
                  'px !important;' +
                  'font-family:' +
                  font_family +
                  '!important;' +
                  'color:' +
                  resume.color.font +
                  '!important;'
                "
              >
                <span v-if="resume.employment_emphasis == 'Employer'">
                  {{
                    resumejob.job
                      ? resumejob.job.position
                        ? resumejob.job.position.pos_name
                        : ""
                      : ""
                  }}
                </span>
                <span v-else>
                  {{ resumejob.job ? resumejob.job.company : "" }}
                  <span
                    v-if="
                      resume.resume_setting.is_city_state_country &&
                      resume.resume_setting.is_location
                    "
                  >
                    -{{ resumejob.job ? resumejob.job.city : "" }},
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
                    -{{ resumejob.job ? resumejob.job.city : "" }},
                    {{ resumejob.job ? resumejob.job.state.state : "" }}
                  </span>
                  <span v-if="resume.resume_setting.is_location"></span>
                </span>
              </div>

              <div
                v-if="resume.resume_setting.is_job_description"
                class="mb-2 sub-section"
                :style="
                  'fontSize:' +
                  resume.body_font_size +
                  'px !important;' +
                  'font-family:' +
                  font_family +
                  '!important;' +
                  'color:' +
                  resume.color.font +
                  '!important;'
                "
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
              </div>

              <div
                class="temp_03-unorder-list sub-section"
                :style="
                  'color:' +
                  resume.color.font +
                  '!important;' +
                  'text-indent:' +
                  resume.indent_spacing +
                  '%'
                "
              >
                <ul
                  v-for="(
                    endorse, endorseKey
                  ) in resumejob.job.endorsements.filter(
                    (ea) => ea.status == 1
                  )"
                >
                  <li
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    “{{ endorse.value }}”
                    <span
                      >– {{ endorse.author }}, {{ endorse.author_description }},
                      {{ endorse.job_id ? getJobName(endorse.job_id) : "" }}
                      <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                    </span>
                  </li>
                </ul>
                <ul
                  v-if="resume.type == 'functional'"
                  style="margin-bottom: 0"
                  v-for="(experience, experienceKey) in sortArray(
                    resumejob.job.experiences
                  ).filter((as) => as.status == 1)"
                  :key="`#demo_exp_showme_${experienceKey}`"
                >
                  <li
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    {{ experience.description }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Education Section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="resumesection.type == 'education'"
          v-show="resumesection.hidden == 1"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="sub-section side-bar-section">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                  color: resume.color.secondary || '',
                }"
              >
                {{ resumesection.title }}
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              class="temp_03-rightHeading"
              :style="{
                'font-size': resume.subheading_font_s + 'px',
                'padding-top': resume.subheading_spacin + 'px',
                'padding-bottom': resume.subheading_spacin + 'px',
                color: resume.color.secondry + ' !important',
              }"
              v-for="(education, key) in sortEducationArray(getEduArray).filter(
                (ae) => ae.status == 1
              )"
              :key="`asdf_sd${key}`"
            >
              <div class="d-flex justify-content-between sub-sub-heading">
                <div
                  class="temp_03-rightHeading sub-section"
                  :style="{
                    'font-size': resume.subheading_font_s + 'px',
                    'padding-top': resume.subheading_spacin + 'px',
                    'padding-bottom': resume.subheading_spacin + 'px',
                    color: resume.color.accent + ' !important',
                  }"
                >
                  <span
                    v-if="
                      showEducationDegree(education) == true &&
                      education.is_degree
                    "
                  >
                    <span v-if="education.is_degree">
                      <span
                        v-if="
                          resume.education_emphasis == 'Degree' &&
                          education.degree
                        "
                      >
                        {{ getDegree(education.degree) }}
                      </span>
                    </span>
                    <span
                      v-if="
                        resume.education_emphasis == 'School' &&
                        education.school
                      "
                    >
                      {{ education.school }}
                    </span>
                  </span>

                  <span
                    v-if="education.is_major_field_study && education.major"
                  >
                    - {{ education.major }}
                  </span>

                  <span
                    v-if="
                      education.minors.length > 0 && getShowEducationEnhancement
                    "
                  >
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
                      <span v-if="getActiveMinorLength(education.minors) == 1"
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
                        v-else-if="getActiveMinorLength(education.minors) > 2"
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
                  </span>
                </div>
                <div
                  class="temp_03-rightHeading sub-section"
                  style="white-space: nowrap !important"
                  :style="
                    ';font-size:' +
                    resume.subheading_font_s +
                    'px' +
                    ';padding-top:' +
                    resume.subheading_spacin +
                    'px' +
                    ';padding-bottom:' +
                    resume.subheading_spacin +
                    'px' +
                    'color:' +
                    resume.color.secondary +
                    '!important;'
                  "
                >
                  <div v-if="education.is_grad_date">
                    <div
                      class="colorResume-sub-heading pt-0"
                      :style="'color:' + resume.color.accent + '!important;'"
                      v-if="
                        resume.resume_setting.is_edu_month_year &&
                        resume.resume_setting.is_edu_dates
                      "
                    >
                      {{ education.grad_month }}/ {{ education.grad_year }}
                    </div>

                    <div
                      class="colorResume-sub-heading pt-0"
                      :style="'color:' + resume.color.accent + '!important;'"
                      v-if="
                        resume.resume_setting.is_edu_year &&
                        resume.resume_setting.is_edu_dates
                      "
                    >
                      {{ education.grad_year }}
                    </div>

                    <div
                      class="colorResume-sub-heading pt-0"
                      :style="'color:' + resume.color.accent + '!important;'"
                      v-if="!resume.resume_setting.is_edu_dates"
                    ></div>
                  </div>
                </div>
              </div>
              <div
                class="temp-sub-heading sub-section"
                :style="
                  'fontSize:' +
                  resume.body_font_size +
                  'px !important;' +
                  'font-family:' +
                  font_family +
                  '!important;' +
                  'color:' +
                  resume.color.font +
                  '!important;'
                "
              >
                <span v-if="education.is_degree">
                  <span
                    v-if="
                      resume.education_emphasis == 'Degree' && education.school
                    "
                  >
                    {{ education.school }}
                  </span>
                </span>

                <span v-if="resume.education_emphasis == 'School'">
                  {{ getDegree(education.degree) }}
                </span>

                <span
                  v-if="
                    resume.resume_setting.is_edu_city_state_country &&
                    resume.resume_setting.is_edu_location
                  "
                  >,{{ education.city }}, {{ education.state.state }},{{
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
                <span v-if="!resume.resume_setting.is_edu_location"></span>
              </div>
              <div
                class="temp_03-unorder-list sub-section"
                :style="
                  'color:' +
                  resume.color.font +
                  '!important;' +
                  'text-indent:' +
                  resume.indent_spacing +
                  '%'
                "
              >
                <ul>
                  <li
                    v-if="
                      education.is_overall_gpa && getShowEducationEnhancement
                    "
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    <span v-if="education.gpa_format == 'full'">
                      GPA: {{ education.overallgpa }} out of 4.0
                    </span>
                    <span v-else> GPA: {{ education.overallgpa }} </span>
                  </li>

                  <li
                    v-if="education.is_major_gpa && getShowEducationEnhancement"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    <span v-if="education.gpa_format == 'full'">
                      Major GPA: {{ education.majorgpa }} out of 4.0
                    </span>
                    <span v-else> Major GPA: {{ education.majorgpa }} </span>
                  </li>
                  <li
                    v-if="
                      education.is_credits_completed &&
                      education.credits_completed !== null &&
                      getShowEducationEnhancement
                    "
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    {{ education.credits_completed }} Credits Completed
                  </li>
                </ul>
              </div>
            </div>

            <div class="row">
              <div
                class="col-sm-12 mb-3"
                :class="checkDynamicEduClass(resumesection.column, 4)"
                :style="'color:' + resume.color.font + '!important'"
                v-for="(eduSubSection, index) in getEduSubSectionArray.filter(
                  (el) => el.status == 1
                )"
                v-bind:key="index"
              >
                <!-- {{ eduSubSection.edu_sub_section_content }} -->
                <div
                  class="temp_03-rightHeading sub-section"
                  :style="
                    ';font-size:' +
                    resume.subheading_font_s +
                    'px' +
                    ';padding-top:' +
                    resume.subheading_spacin +
                    'px' +
                    ';padding-bottom:' +
                    resume.subheading_spacin +
                    'px;' +
                    'color:' +
                    resume.color.accent +
                    '!important;'
                  "
                >
                  <p>{{ eduSubSection.title }}</p>
                </div>
                <div class="sub-section">
                  <p
                    v-if="eduSubSection.content"
                    class=""
                    :style="'color:' + resume.color.font + ' !important'"
                  >
                    {{ eduSubSection.content }}
                  </p>
                </div>
                <div class="sub-section">
                  <div v-if="eduSubSection.list_style == 'vertical_bullets'">
                    <div
                      class="temp_03-unorder-list flex-d-column"
                      :style="
                        'color:' +
                        resume.color.font +
                        '!important;' +
                        'text-indent:' +
                        resume.indent_spacing +
                        '%'
                      "
                    >
                      <ul
                        style="margin-bottom: 0"
                        v-for="(
                          eduSubSectionContent, key
                        ) in sortEducationArray(
                          eduSubSection.edu_sub_section_content
                        )"
                      >
                        <li
                          v-if="eduSubSectionContent.type === 'skills'"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <div>
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </div>
                        </li>

                        <li
                          v-else-if="
                            eduSubSectionContent.type === 'endorsement'
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <div>
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
                              }},
                              {{
                                getJobName(
                                  eduSubSectionContent.subsection_content_able
                                    .job_id
                                )
                              }}
                            </span>
                          </div>
                        </li>
                        <li
                          v-else
                          v-show="getShowEducationEnhancement"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <div>
                            {{
                              eduSubSectionContent.subsection_content_able.value
                            }}
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div
                    v-else-if="eduSubSection.list_style == 'horizontal_bullets'"
                  >
                    <!--  -->

                    <div
                      class="d-flex temp_03-unorder-list"
                      style="margin-bottom: 0"
                      :style="'text-indent:' + resume.indent_spacing + '%'"
                    >
                      <ul
                        style="margin-bottom: 0"
                        v-for="(
                          eduSubSectionContent, key
                        ) in sortEducationArray(
                          eduSubSection.edu_sub_section_content
                        )"
                      >
                        <li v-if="eduSubSectionContent.type === 'skills'">
                          <div>
                            {{
                              eduSubSectionContent.subsection_content_able.name
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
                              }},

                              {{
                                getJobName(
                                  eduSubSectionContent.subsection_content_able
                                    .job_id
                                )
                              }}</span
                            >
                          </div>
                        </li>
                        <li v-else v-show="getShowEducationEnhancement">
                          <div>
                            {{
                              eduSubSectionContent.subsection_content_able.value
                            }}
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div v-else>
                    <!-- sub section no bulites education -->
                    <div class="additional_information vertical_buttets">
                      <ul
                        style="margin-bottom: 0; padding-left: 0 !important"
                        v-for="(
                          eduSubSectionContent, key
                        ) in sortEducationArray(
                          eduSubSection.edu_sub_section_content
                        )"
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
                              eduSubSectionContent.subsection_content_able.name
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
                              }}
                              {{
                                getJobName(
                                  eduSubSectionContent.subsection_content_able
                                    .job_id
                                )
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
                              eduSubSectionContent.subsection_content_able.value
                            }}
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- sub section no education -->

                    <!-- <div
                    v-for="(eduSubSectionContent, key) in sortEducationArray(
                      eduSubSection.edu_sub_section_content
                    )"
                  >
                    <p v-if="eduSubSectionContent.type === 'skills'">
                      {{ eduSubSectionContent.subsection_content_able.name }}
                    </p>
                    <p v-else-if="eduSubSectionContent.type === 'endorsement'">
                      “{{ eduSubSectionContent.subsection_content_able.value }}”
                      <span
                        >–
                        {{
                          eduSubSectionContent.subsection_content_able.author
                        }},
                        {{
                          eduSubSectionContent.subsection_content_able
                            .author_description
                        }}
                        {{
                          getJobName(
                            eduSubSectionContent.subsection_content_able.job_id
                          )
                        }}</span
                      >
                    </p>
                    <p v-else v-show="getShowEducationEnhancement">
                      {{ eduSubSectionContent.subsection_content_able.value }}
                    </p>
                  </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Skill section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="resumesection.type == 'skill'"
          v-show="resumesection.hidden == 1"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="sub-section side-bar-section">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                  color: resume.color.secondary || '',
                }"
              >
                {{ resumesection.title }}
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              :style="
                'font-size:' +
                resume.subheading_font_s +
                'px;' +
                'padding-top:' +
                resume.subheading_spacin +
                'px;' +
                'padding-bottom:' +
                resume.subheading_spacin +
                'px;' +
                'color:' +
                resume.color.font +
                ' !important;'
              "
            >
              {{ resumesection.content }}
            </div>
            <div>
              <div class="justify-content-between">
                <div class="row">
                  <div
                    class="col-sm-12 mb-3"
                    :class="checkDynamicEduClass(resumesection.column, 4)"
                    v-for="(
                      skill_sub_section, skillsSubSecKey
                    ) in getSkillSubSectionArray.filter(
                      (sd) => sd.status == true
                    )"
                    :key="skillsSubSecKey"
                  >
                    <div>
                      <h3
                        class="temp_03-rightHeading"
                        :style="{
                          'font-size': resume.subheading_font_s + 'px',
                          'padding-top': resume.subheading_spacin + 'px',
                          'padding-bottom': resume.subheading_spacin + 'px',
                          color: resume.color.accent + ' !important',
                        }"
                      >
                        {{ skill_sub_section.title ?? "Untitled SubSection" }}
                      </h3>
                      <div
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'color:' +
                          resume.color.font +
                          ' !important'
                        "
                        style="font-size: 13px"
                      >
                        {{ skill_sub_section.content }}
                      </div>
                      <div
                        class="mt-2"
                        :style="'color:' + resume.color.font + ' !important'"
                        v-if="
                          skill_sub_section.list_style == 'vertical_bullets'
                        "
                      >
                        <div
                          class="temp_03-unorder-list vertical_buttets"
                          :style="'text-indent:' + resume.indent_spacing + '%'"
                        >
                          <ul
                            style="margin-bottom: 0"
                            :style="
                              'color:' + resume.color.font + ' !important'
                            "
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              skill_sub_section.edu_sub_section_content
                            )"
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
                                  >–
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author
                                  }},
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .author_description
                                  }},
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
                          class="temp_03-unorder-list"
                          :style="
                            'color:' +
                            resume.color.font +
                            '!important;' +
                            'text-indent:' +
                            resume.indent_spacing +
                            '%'
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
                          >
                            <li
                              v-if="eduSubSectionContent.type === 'skills'"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
                              "
                            >
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
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
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
                                  }},
                                  {{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
                                  }}
                                </span>
                              </div>
                            </li>

                            <li
                              v-else
                              v-show="getShowEducationEnhancement"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
                              "
                            >
                              <div>
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </div>
                            </li>
                          </ul>
                        </div>

                        <!--  -->
                      </div>

                      <div v-else>
                        <!-- sub section no bulites skills -->
                        <div class="additional_information vertical_buttets">
                          <ul
                            style="margin-bottom: 0; padding-left: 0 !important"
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              skill_sub_section.edu_sub_section_content
                            )"
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
                                  }},
                                  {{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
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
                        <!-- sub section no skills -->

                        <!-- <div
                          v-for="(
                            eduSubSectionContent, key
                          ) in sortEducationArray(
                            skill_sub_section.edu_sub_section_content
                          )"
                        >
                          <p
                            v-if="eduSubSectionContent.type === 'skills'"
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;'
                            "
                          >
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </p>
                          <p
                            v-else-if="
                              eduSubSectionContent.type === 'endorsement'
                            "
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
                              }},
                              {{
                                getJobName(
                                  eduSubSectionContent.subsection_content_able
                                    .job_id
                                )
                              }}
                            </span>
                          </p>

                          <p
                            v-else
                            v-show="getShowEducationEnhancement"
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;'
                            "
                          >
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
          </div>
        </div>

        <!-- New Section -->
        <div
          class="row"
          :style="'border-bottom: 2px solid #dfdfdf !important;'"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="resumesection.type == 'new-section'"
          v-show="resumesection.hidden == 1"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div class="sub-section side-bar-section">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                  color: resume.color.secondary || '',
                }"
              >
                <p>{{ resumesection.title }}</p>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              :style="
                ';font-size:' +
                resume.subheading_font_s +
                'px' +
                ';padding-top:' +
                resume.subheading_spacin +
                'px' +
                ';padding-bottom:' +
                resume.subheading_spacin +
                'px' +
                'color:' +
                resume.color.font +
                ' !important'
              "
            >
              <p :style="'color:' + resume.color.font + ' !important'">
                {{ resumesection.content }}
              </p>
            </div>
            <div class="row">
              <div
                class="col-sm-12 mb-3"
                :class="checkDynamicEduClass(resumesection.column, 4)"
                v-for="(
                  new_sub_section, index
                ) in resumesection.resume_sub_section.filter(
                  (sd) => sd.status == true
                )"
                v-bind:key="index"
                :style="'color:' + resume.color.font + ' !important'"
              >
                <div>
                  <div>
                    <h5
                      class="working_as_Desig"
                      :style="
                        'font-size:' +
                        resume.subheading_font_s +
                        'px' +
                        ';padding-top:' +
                        resume.subheading_spacin +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px;' +
                        'color:' +
                        resume.color.font +
                        '!important'
                      "
                      style="font-weight: 500 !important"
                    >
                      <p>
                        {{ new_sub_section.title ?? "Untitled SubSection" }}
                      </p>
                    </h5>
                    <span
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font +
                        '!important'
                      "
                      class="working_as_Desig"
                      style="
                        text-decoration: none !important;
                        word-break: break-all !important;
                      "
                      >{{ new_sub_section.content }}</span
                    >
                    <div
                      v-if="new_sub_section.list_style == 'vertical_bullets'"
                    >
                      <div class="mb-3">
                        <div
                          class="temp_03-unorder-list flex-d-column"
                          :style="
                            'color:' +
                            resume.color.font +
                            '!important;' +
                            'text-indent:' +
                            resume.indent_spacing +
                            '%'
                          "
                          style="margin-bottom: 0"
                        >
                          <ul
                            style="margin-bottom: 0"
                            :style="
                              'color:' + resume.color.font + '!important;'
                            "
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              new_sub_section.edu_sub_section_content
                            )"
                          >
                            <li
                              v-if="eduSubSectionContent.type === 'skills'"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
                              "
                            >
                              <div
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;'
                                "
                              >
                                <p>
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </p>
                              </div>
                            </li>
                            <li
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
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
                                  }},{{
                                    getJobName(
                                      eduSubSectionContent
                                        .subsection_content_able.job_id
                                    )
                                  }}</span
                                >
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

                      <!--  -->

                      <!-- <div
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                new_sub_section.edu_sub_section_content
                              )"
                            >
                              <p
                                v-if="eduSubSectionContent.type === 'skills'"
                                class="bullet-point"
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </p>
                              <p v-else class="bullet-point">
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </p>
                            </div> -->
                    </div>

                    <div
                      v-else-if="
                        new_sub_section.list_style == 'horizontal_bullets'
                      "
                    >
                      <div class="mb-3">
                        <div class="d-flex" style="margin-bottom: 0">
                          <ul
                            style="margin-bottom: 0"
                            class="temp_03-unorder-list"
                            :style="
                              'color:' +
                              resume.color.font +
                              '!important;' +
                              'text-indent:' +
                              resume.indent_spacing +
                              '%'
                            "
                            v-for="(
                              eduSubSectionContent, key
                            ) in sortEducationArray(
                              new_sub_section.edu_sub_section_content
                            )"
                          >
                            <li
                              v-if="eduSubSectionContent.type === 'skills'"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
                              "
                            >
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
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
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
                                }},
                                {{
                                  getJobName(
                                    eduSubSectionContent.subsection_content_able
                                      .job_id
                                  )
                                }}</span
                              >
                            </li>

                            <li
                              v-else
                              v-show="getShowEducationEnhancement"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;'
                              "
                            >
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

                      <!--  -->

                      <!-- <div
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                new_sub_section.edu_sub_section_content
                              )"
                            >
                              <p
                                v-if="eduSubSectionContent.type === 'skills'"
                                class="bullet-point pppppppppppp"
                              >
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .name
                                }}
                              </p>
                              <p v-else class="bullet-point oooooooooo">
                                {{
                                  eduSubSectionContent.subsection_content_able
                                    .value
                                }}
                              </p>
                            </div> -->
                    </div>

                    <div v-else>
                      <!-- sub section no bulites New Section -->
                      <div class="additional_information vertical_buttets">
                        <ul
                          style="margin-bottom: 0; padding-left: 0 !important"
                          v-for="(
                            eduSubSectionContent, key
                          ) in sortEducationArray(
                            new_sub_section.edu_sub_section_content
                          )"
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
                      <!-- sub section no New Section -->

                      <!-- <div
                        v-for="(
                          eduSubSectionContent, key
                        ) in sortEducationArray(
                          new_sub_section.edu_sub_section_content
                        )"
                      >
                        <p v-if="eduSubSectionContent.type === 'skills'">
                          {{
                            eduSubSectionContent.subsection_content_able.name
                          }}
                        </p>
                        <p v-if="eduSubSectionContent.type === 'endorsement'">
                          “{{
                            eduSubSectionContent.subsection_content_able.value
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
                        <p v-else>
                          {{
                            eduSubSectionContent.subsection_content_able.value
                          }}
                        </p>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  //
  name: "ForthTemplate",
  mixins: [Common],

  data() {
    return {
      numberOfPages: 0,
      finalContent: [],
      pages: [],
      sidebar: [],
      divHeight: 11.69,
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
      "getShowEducationEnhancement",
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
    this.splitContentIntoPages();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
    },

    downloadResume: function () {
      this.checkHeight();
      this.generatePDF();
      setTimeout(() => {
        this.divHeight = 11.69;
      }, 3000);
    },
  },

  methods: {
    handlerFunction: function () {
      this.$nextTick(() => {
        this.splitContentIntoPages();
      });
    },
    splitContentIntoPages() {
      this.pages = [];
      this.sidebar = [];
      this.finalContent = [];
      var a4Height = 1000; // A4 height in pixels

      var elements = document.querySelectorAll(".section .sub-section");
      var filteredElements = Array.from(elements).filter(function (element) {
        return element.classList.contains("side-bar-section");
      });

      var mainElements = document.querySelectorAll(
        ".section .sub-section:not(.side-bar-section)"
      );

      var currentHeight = 0;
      var currentHeightSidebar = 0;
      var currentPage = document.createElement("div");

      mainElements.forEach((element) => {
        var elementHeight = element.getBoundingClientRect().height;

        if (currentHeight + elementHeight > a4Height) {
          // If the current page is not empty, add it to the list of pages
          if (currentPage.innerHTML.trim().length > 0) {
            this.pages.push(currentPage.cloneNode(true));
          }

          // Start a new page with the current element
          currentPage.innerHTML = element.outerHTML;
          currentHeight = elementHeight;
        } else {
          // Add the current element to the current page
          currentPage.innerHTML += element.outerHTML;
          currentHeight += elementHeight;
        }
      });

      var currentSidebar = document.createElement("div");
      filteredElements.forEach((element) => {
        var elementHeight = element.getBoundingClientRect().height;

        if (currentHeightSidebar + elementHeight > a4Height) {
          // If the current page is not empty, add it to the list of pages
          if (currentSidebar.innerHTML.trim().length > 0) {
            this.sidebar.push(currentSidebar.cloneNode(true));
          }

          // Start a new page with the current element
          currentSidebar.innerHTML = element.outerHTML;
          currentHeightSidebar = elementHeight;
        } else {
          // Add the current element to the current page
          currentSidebar.innerHTML += element.outerHTML;
          currentHeightSidebar += elementHeight;
        }
      });
      // Add the last page if it's not empty
      if (currentSidebar.innerHTML.trim().length > 0) {
        this.sidebar.push(currentSidebar.cloneNode(true));
      }

      if (currentPage.innerHTML.trim().length > 0) {
        this.pages.push(currentPage.cloneNode(true));
      }

      var pageLength = this.pages.length;
      var sideLength = this.sidebar.length;
      this.numberOfPages = 0;

      if (pageLength > sideLength) {
        this.numberOfPages = pageLength;
      } else {
        this.numberOfPages = sideLength;
      }

      for (let i = 0; i < this.numberOfPages; i++) {
        // Create the elements
        var card = document.createElement("div");
        card.classList.add("card", "mb-5");

        var row = document.createElement("div");
        row.classList.add("row");

        var sidebarColumn = document.createElement("div");
        sidebarColumn.classList.add("col-md-4", "sidebar-new");

        var dynamicColor = this.resume.color.accent; // You can change this color dynamically
        console.log(dynamicColor, "dynamicColor");
        sidebarColumn.style.backgroundColor = dynamicColor;

        var mainColumn = document.createElement("div");
        mainColumn.classList.add("col-md-8", "main-new");

        // Set the HTML content of sidebarColumn and mainColumn
        sidebarColumn.innerHTML = this.sidebar[i]
          ? this.sidebar[i].innerHTML
          : "";
        mainColumn.innerHTML = this.pages[i] ? this.pages[i].innerHTML : "";

        // Append sidebarColumn and mainColumn to row
        row.appendChild(sidebarColumn);
        row.appendChild(mainColumn);

        // Append row to card
        card.appendChild(row);

        // Append card to the finalContent array
        this.finalContent.push(card);
      }
    },

    checkHeight() {
      const dpi = 96;
      let workExperienceDivs = Array.from(
        document.querySelectorAll(".work_experience_lists")
      );
      var combinedHeightInPixels = 0;
      workExperienceDivs.forEach(function (workExpDiv) {
        var height = workExpDiv.clientHeight;
        combinedHeightInPixels += height;
      });

      const inches = combinedHeightInPixels / dpi;

      if (inches >= 11.7 && inches <= 22.9) {
        this.divHeight = 11.69 * 2;
      } else if (inches >= 23 && inches <= 35.1) {
        this.divHeight = 11.69 * 3;
      } else if (inches >= 35.2 && inches <= 46.9) {
        this.divHeight = 11.69 * 4;
      } else if (inches >= 47) {
        this.divHeight = 11.69 * 5;
      } else {
        this.divHeight = 11.69;
      }
    },
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

.fa-globe {
  content: "\f0e0";
  /* color: #c4e6de; */
}

@media (max-width: 993px) {
  .resume-design-div {
    min-width: 100% !important;
    max-width: 100% !important;
  }
}

.resume-design-div {
  border-radius: 0px;
  padding: 25px 55px;
  background: #fff;
  -webkit-box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  /* min-width: 690px; */
  /* max-width: 690px; */
  /* height: 100% !important; */
  min-width: 8.27in !important;
  min-height: 11.69in !important;
  max-height: 100% !important;
  background: rgb(255, 255, 255);
  /* background: linear-gradient(
    270deg,
    rgba(255, 255, 255, 1) 66.7%,
    rgba(32, 155, 206, 1) 66.7%
  ); */
}

.main-container {
  border: none !important;
}

.main-heading {
  font-weight: bolder;
  font-size: 26px;
}

.subHeading {
  margin-left: 30px;
  font-size: 10px;
}

.data-card {
  font-size: 12px !important;
  margin-top: 13px;
  /* margin-left: 20px; */
  display: flex !important;
  align-items: baseline;
}

.main-container {
  /* border: 2px solid red; */
  text-align: left;
  margin: -20px;
  font-family: Montserrat;
  padding: 16px;
  padding-bottom: 0px;
}

.heading-second {
  font-weight: bolder;
  font-size: 14px;
  padding-top: 18px;
  margin-bottom: 10px;
}

.sub-heading {
  text-decoration: underline;
  font-size: 12px;
}

.sub-sub-heading {
  font-size: 12px;
  margin-bottom: 5px;
}

.sub-sub-sub-heading {
  font-size: 12px;
}

.unorder-list {
  font-size: 13px;
}

.skills {
  font-size: 14px;
}

.section {
  margin-top: 8px;
  margin-bottom: 20px;
  font-size: 16px;
}

/* for medium screen .................................................... */
@media screen and (min-width: 550px) and (max-width: 1100px) {
  .main-heading {
    font-weight: bolder;
    font-size: 16px;
  }

  .main-heading-sub {
    font-size: 10px;
  }

  .subHeading {
    margin-left: 10px;
    font-size: 8px;
  }

  .data-card {
    font-size: 9px;
    margin-top: 8px;
  }

  .main-container {
    /* border: 2px solid red; */
    text-align: left;
    margin: -20px;

    padding: 14px;
    padding-bottom: 0px;
  }

  .heading-second {
    font-weight: bolder;
    font-size: 12px;
    padding-top: 10px;
    margin-bottom: 7px;
  }

  .sub-heading {
    text-decoration: underline;
    font-size: 10px;
  }

  .sub-sub-heading {
    font-size: 11px;
    margin-bottom: 6px;
  }

  .sub-sub-sub-heading {
    font-size: 11px;
  }

  .unorder-list {
    font-size: 8.5px;
  }

  .section {
    margin-top: 8px;
    margin-bottom: 35px;
    font-size: 11px;
  }
}

/* for mobile view ..................................................... */
@media screen and (min-width: 200px) and (max-width: 550px) {
  .main-heading {
    font-weight: bolder;
    font-size: 10px;
  }

  .main-heading-sub {
    font-size: 5px;
  }

  .subHeading {
    margin-left: 10px;
    font-size: 7px;
    font-weight: bold;
  }

  .data-card {
    font-size: 5px;
    margin-top: 5px;
  }

  .main-container {
    /* border: 2px solid red; */
    text-align: left;
    margin: -20.5px;
    padding: 10px;
    padding-bottom: 0px;
  }

  .heading-second {
    font-weight: bolder;
    font-size: 7px;
    padding-top: 5px;
    margin-bottom: 5px;
  }

  .sub-heading {
    text-decoration: underline;
    font-size: 5px;
  }

  .sub-sub-heading {
    font-size: 5px;
    margin-bottom: 5px;
  }

  .sub-sub-sub-heading {
    font-size: 5px;
  }

  .unorder-list {
    font-size: 6px;
  }

  .skills {
    font-size: 6px;
  }

  .section {
    margin-top: 5px;
    margin-bottom: 2px;
    font-size: 7px;
  }
}

/*TEMPLETE ONE CSS*/

.main-heading {
  font-weight: bolder;
  font-size: 26px;
}

.subHeading {
  margin-left: 30px;
  font-size: 10px;
}

.data-card {
  font-size: 10px;
  margin-top: 13px;
  /* margin-left: 20px; */
}

.main-container {
  /* border: 2px solid red; */
  text-align: left;
  margin: -20px;
  font-family: Montserrat;
  padding: 16px;
  padding-bottom: 0px;
}

.heading-second {
  font-weight: bolder;
  font-size: 14px;
  padding-top: 18px;
  margin-bottom: 10px;
}

.sub-heading {
  text-decoration: underline;
  font-size: 12px;
}

.sub-sub-heading {
  font-size: 12px;
  margin-bottom: 10px;
}

.sub-sub-sub-heading {
  font-size: 12px;
}

.unorder-list {
  font-size: 13px;
}

.skills {
  font-size: 14px;
}

.section {
  margin-top: 8px;
  margin-bottom: 20px;
  font-size: 16px;
}

/* for medium screen .................................................... */
@media screen and (min-width: 550px) and (max-width: 1100px) {
  .main-heading {
    font-weight: bolder;
    font-size: 16px;
  }

  .main-heading-sub {
    font-size: 10px;
  }

  .subHeading {
    margin-left: 10px;
    font-size: 8px;
  }

  .data-card {
    font-size: 9px;
    margin-top: 8px;
  }

  .main-container {
    /* border: 2px solid red; */
    text-align: left;
    margin: -20px;

    padding: 14px;
    padding-bottom: 0px;
  }

  .heading-second {
    font-weight: bolder;
    font-size: 12px;
    padding-top: 10px;
    margin-bottom: 7px;
  }

  .sub-heading {
    text-decoration: underline;
    font-size: 10px;
  }

  .sub-sub-heading {
    font-size: 11px;
    margin-bottom: 6px;
  }

  .sub-sub-sub-heading {
    font-size: 11px;
  }

  .unorder-list {
    font-size: 8.5px;
  }

  .section {
    margin-top: 8px;
    margin-bottom: 35px;
    font-size: 11px;
  }
}

/* for mobile view ..................................................... */
@media screen and (min-width: 200px) and (max-width: 550px) {
  .main-heading {
    font-weight: bolder;
    font-size: 10px;
  }

  .main-heading-sub {
    font-size: 5px;
  }

  .subHeading {
    margin-left: 10px;
    font-size: 7px;
    font-weight: bold;
  }

  .data-card {
    font-size: 5px;
    margin-top: 5px;
  }

  .main-container {
    /* border: 2px solid red; */
    text-align: left;
    margin: -20.5px;
    padding: 10px;
    padding-bottom: 0px;
  }

  .heading-second {
    font-weight: bolder;
    font-size: 7px;
    padding-top: 5px;
    margin-bottom: 5px;
  }

  .sub-heading {
    text-decoration: underline;
    font-size: 5px;
  }

  .sub-sub-heading {
    font-size: 5px;
    margin-bottom: 10px;
  }

  .sub-sub-sub-heading {
    font-size: 5px;
  }

  .unorder-list {
    font-size: 6px;
  }

  .skills {
    font-size: 6px;
  }

  .section {
    margin-top: 5px;
    margin-bottom: 2px;
    font-size: 7px;
  }
}

/*TEMPLETE SECOND*/

.left-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  /* max-height: 892px;
  min-height: 892px; */
}
.right-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  /* max-height: 892px;
  min-height: 892px; */
  padding-right: 50px;
  padding-top: 35px;
  padding-bottom: 20px;
  margin: 0%;
  padding-left: 0px;
}
.right-container-nav {
  /* max-height: 820px;
  min-height: 820px; */
  /* border-top:2px solid #C00000 ;
     border-right: 2px solid #C00000;
     border-bottom: 2px solid #C00000; */
  padding-left: 20px;
  padding-top: 10px;
  padding-left: 10px;
}
.colorResume-rightHeading {
  font-size: 20px;
  color: #209bce;
  font-weight: bolder;
  margin-bottom: 10px;
}
.colorResume-r-h-2 {
  padding-left: 50px;
  padding-top: 5px;
  margin-bottom: 20px;
}
.colorResume-main-heading {
  font-weight: bolder;
  font-size: 35px;
  padding-top: 20px;
  padding-bottom: 20px;
}
.colorResume-sub-heading {
  font-weight: 800px;
  font-size: 18px;
  padding-top: 20px;
}
.colorResume-sub-headingData {
  font-size: 12px;
}

/* for medium screen ............................................................................ */
@media screen and (min-width: 550px) and (max-width: 1100px) {
  .left-container {
    /* max-height:269px;
         min-height:269px; */
    /* min-height: 621px;
    max-height: 621px; */
    margin-left: -16.8px;
  }
  .right-container {
    border-radius: 0px;
    padding-right: 23px;
    padding-top: 20px;
    padding-bottom: 10px;
  }
  .right-container-nav {
    /* max-height: 560px;
    min-height: 585px; */
  }
  .colorResume-rightHeading {
    font-size: 12px;
    color: #209bce;
    font-weight: bolder;
    margin-bottom: 1px;
    padding-top: 9px;
    padding-left: 0px !important;
  }
  .colorResume-r-h-2 {
    padding-left: 1px;
    padding-top: 1px;
    margin-bottom: 10px;
    font-size: 10px;
  }
  .colorResume-main-heading {
    font-weight: bolder;
    font-size: 20px;
    padding-top: 15px;
    padding-bottom: 15px;
  }
  .colorResume-sub-heading {
    font-weight: 800px;
    font-size: 12px;
    padding-top: 20px;
  }
  .colorResume-sub-headingData {
    font-size: 9px;
  }
}

/* for small screen ............................................................................ */
@media screen and (min-width: 200px) and (max-width: 550px) {
  .left-container {
    /* max-height: 427px;
    min-height: 427px; */
    padding-left: 3px !important;
  }
  .right-container {
    /* font-family: Tai Heritage Pro, serif; */
    border-radius: 0px;

    padding-right: 23px;
    padding-top: 15px;
    padding-bottom: 20px;
    margin: 0%;
    padding-left: 0px;
  }
  .right-container-nav {
    /* max-height: 400px;
    min-height: 400px; */
    /* border-top:2px solid #C00000 ;
         border-right: 2px solid #C00000;
         border-bottom: 2px solid #C00000; */
    padding-left: 20px;
    padding-top: 10px;
    padding-left: 10px;
  }
  .colorResume-rightHeading {
    font-size: 9px;
    color: #209bce;
    font-weight: bolder;
    margin-bottom: 1px;
    padding-top: 10px;
  }
  .colorResume-r-h-2 {
    padding-left: 5px;
    padding-top: 0px !important;
    margin-bottom: 2px;
    font-size: 10px;
  }
  .colorResume-main-heading {
    font-weight: bolder;
    font-size: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .colorResume-sub-heading {
    font-weight: 800px;
    font-size: 7px;
    padding-top: 8px;
    padding-bottom: 2px;
  }
  .colorResume-sub-headingData {
    font-size: 7px;
  }
}

.temp_03-left-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  /* box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09); */
  /* max-height: 892px; */
  /* min-height: 892px;
    padding-left: 74px; */
}
.temp_03-right-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  /* max-height: 892px;
    min-height: 892px; */
  padding-right: 15px;
  text-align: left;
  padding-top: 10px;
  padding-bottom: 20px;
  margin: 0%;
  padding-left: 30px;
}
.temp_03-right-container-nav {
  /* max-height: 820px;
    min-height: 820px; */
  /* border-top: 2px solid #c00000;
    border-right: 2px solid #c00000;
    border-bottom: 2px solid #c00000; */

  padding-top: 10px;
}
.temp_03-rightHeading {
  font-size: 19px;
  color: #ffa338;
  font-weight: bold;
  margin-bottom: 5px;
}

.temp_03-r-h-2 {
  padding-left: 50px;
  padding-top: 5px;
  margin-bottom: 20px;
}
.temp_03-unorder-list {
  font-size: 11.5px;
}
.temp-sub-heading {
  margin-top: -15px !important;
  /* margin-left: 10px; */
  margin-bottom: 10px;
  font-size: 13px;
}
.temp_03-main-heading {
  font-weight: bolder;
  font-size: 35px;
  padding-top: 25px;
  padding-bottom: 20px;
}
.temp_03-sub-heading {
  font-size: 22px;
  padding-top: 13px;
  /* text-align: right; */
  word-break: break-all;
  font-weight: 600;
}
.temp_03-sub-headingData {
  font-size: 13px;
}
.colorResume-sub-headingData ul li {
  list-style: none;
}
.temp-left-first-box {
  border-bottom: 2px solid rgb(215, 207, 207);
  height: 74px;
  margin-right: -15px;
}
.temp-left-second-box {
  border-bottom: 2px solid rgb(215, 207, 207);
  height: 316px;
  margin-right: -15px;
}
.temp-left-third-box {
  border-bottom: 2px solid rgb(215, 207, 207);
  height: 254px;
  margin-right: -15px;
}
.temp-left-fourth-box {
  border-bottom: 2px solid rgb(215, 207, 207);
  height: 110px;
  margin-right: -15px;
}
.temp-left-fifth-box {
  border-bottom: 2px solid rgb(215, 207, 207);
  height: 35px;
  margin-right: -15px;
}
/* for medium screen ............................................................................ */
@media screen and (min-width: 550px) and (max-width: 1100px) {
  .temp_03-left-container {
    /* max-height:269px;
           min-height:269px; */
    /* min-height: 621px;
      max-height: 621px; */
    margin-left: -16.8px;
    padding-left: 53px;
    padding-top: 10px;
  }
  .temp_03-unorder-list {
    font-size: 8px;
  }
  .temp_03-right-container {
    border-radius: 0px;
    padding-right: 23px;
    padding-top: 20px;
    padding-bottom: 10px;
  }
  .temp_03-right-container-nav {
    /* max-height: 560px;
      min-height: 585px; */
  }
  .temp_03-rightHeading {
    font-size: 9px;
    font-weight: bolder;
    margin-bottom: 1px;
    padding-top: 0px;
    padding-left: 0px !important;
  }
  .temp_03-r-h-2 {
    padding-left: 21px;
    padding-top: 6px;
    margin-bottom: 2px;
    font-size: 10px;
  }
  .temp_03-main-heading {
    font-weight: bolder;
    font-size: 20px;
    padding-top: 15px;
    padding-bottom: 15px;
  }
  .temp_03-sub-heading {
    font-weight: 800px;
    font-size: 12px;
    padding-top: 20px;
  }
  .temp_03-sub-headingData {
    font-size: 9px;
  }
  .temp-left-first-box {
    height: 39px;
    margin-right: -15px;
  }
  .temp-left-second-box {
    height: 233px;
    margin-right: -15px;
  }
  .temp-sub-heading {
    margin-top: 12px !important;
    margin-left: 10px;
    margin-bottom: 10px;
    font-size: 13px;
  }
  .temp-left-third-box {
    height: 195px;
  }
  .temp-left-fourth-box {
    height: 77px;
  }
  .temp-left-fifth-box {
    height: 27px;
  }
}

/* for small screen ............................................................................ */
@media screen and (min-width: 200px) and (max-width: 550px) {
  .temp_03-left-container {
    /* max-height: 427px;
      min-height: 427px; */
    padding-left: 14px !important;
  }
  .temp_03-right-container {
    /* font-family: Tai Heritage Pro, serif; */
    border-radius: 0px;

    padding-right: 23px;
    padding-top: 15px;
    padding-bottom: 20px;
    margin: 0%;
    padding-left: 0px;
  }
  .temp_03-unorder-list {
    font-size: 6px;
  }
  .temp_03-right-container-nav {
    /* max-height: 400px;
      min-height: 400px; */

    padding-left: 20px;
    padding-top: 10px;
    padding-left: 0px;
  }
  .temp_03-rightHeading {
    font-size: 7px;
    padding-top: 0px;
    margin-bottom: 2px;
  }
  .temp_03-r-h-2 {
    padding-left: 20px;
    padding-top: 0px !important;
    margin-bottom: -6px;
    font-size: 7px;
  }
  .temp_03-main-heading {
    font-weight: bolder;
    font-size: 14px;
    padding-top: 18px;
    padding-bottom: 10px;
  }
  .temp_03-sub-heading {
    font-weight: 800px;
    font-size: 12px;
    padding-top: 8px;
    padding-bottom: 2px;
  }
  .temp_03-sub-headingData {
    font-size: 7px;
  }
  .temp-left-first-box {
    height: 38px;
  }
  .temp-left-second-box {
    height: 166px;
  }
  .temp-sub-heading {
    margin-top: -9px !important;
    margin-left: 10px;
    margin-bottom: -1px;
    font-size: 7px;
  }
  .temp-left-third-box {
    height: 141px;
  }
  .temp-left-fourth-box {
    height: 41px;
  }
  .temp-left-fifth-box {
    height: 27px;
  }
}
/*  */

.border-bottom-white {
  /* border-bottom: 2px solid #ffffff !important; */
  /* background-color: #209bce; */
  color: #ffffff !important;
}
.border-bottom-dard {
  /* border-bottom: 2px solid#dfdfdf !important; */
  background-color: #ffffff;
  word-break: break-all;
}
.padding-top-section-space.border-bottom-dard {
  padding-top: 30px !important;
}

.temp_03-unorder-list ul {
  padding-left: 27px;
}

i.mr-1.fa.fa-map-marker-alt,
i.mr-1.fa.fa-globe,
i.mr-1.fa.fa-user,
i.mr-1.fa.fa-phone-alt,
i.mr-1.fa.fa-envelope {
  /* color: #ffa338 !important; */
  font-size: 14px !important;
}

.temp_03-unorder-list {
  display: flex;
  flex-wrap: wrap;
}

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

li.no-builets-test {
  list-style: none !important;
  padding-left: 0 !important;
}

.temp_03-unorder-list ul {
  font-weight: 400;
}

.temp-sub-heading span {
  font-weight: 400;
}

.flex-align-center {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.col-md-6.icon-loop-style:nth-child(2),
.col-md-6.icon-loop-style:nth-child(4) {
  display: flex;
  justify-content: flex-end !important;
}

.temp_03-unorder-list.flex-d-column {
  flex-direction: column;
}
.beforeClass {
  margin-top: 40px !important;
  margin-bottom: 20px !important;
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

@media (max-width: 450px) {
  .col-md-6.icon-loop-style:nth-child(2),
  .col-md-6.icon-loop-style:nth-child(4) {
    justify-content: flex-start;
  }
  .col-lg-7.col-md-7.col-sm-8.temp_03-right-container.border-bottom-dard .mb-2 {
    padding-left: 27px;
    /* font-size: 6px; */
  }

  .temp_03-sub-headingData.col-md-6.mt-3.flex-align-center i {
    font-size: 7px !important;
  }

  .temp_03-sub-headingData.col-md-6.mt-3.flex-align-center {
    padding-left: 19px;
  }

  .col-md-6.d-flex.mt-3,
  .temp_03-sub-headingData.col-md-6.mt-3.flex-align-center,
  .temp_03-sub-headingData.col-md-6.mt-3 {
    margin-top: 0px !important;
  }

  .col-md-6.flex-align-center {
    justify-content: flex-start !important;
  }
}
</style>
