<template>
  <div>
    <div ref="">
      <div v-for="(page, index) in pages" :key="`index_${index}`" class="mb-2">
        <div
          class="page resume-design-div resume-control-preview additional_information space-left-box"
          :style="
            'font-family:' +
            font_family +
            '!important; letter-spacing:' +
            resume.body_text_spacing +
            '%; background: linear-gradient(270deg, rgba(255, 255, 255, 1) 65%, ' +
            resume.color.primaryy_color +
            ' 65%)'
          "
          v-html="page.innerHTML"
        ></div>
      </div>
    </div>
    <!--  -->
    <div ref="" class="container section height-remove-box">
      <div v-for="(card, count) in finalContent" :key="`tex_${count}`">
        <div v-html="card.innerHTML"></div>
      </div>
    </div>
    <!-- hide-template-box  -->

    <div
      ref="htmlToConvert"
      :class="getResumeBuilderClasses ? '' : 'hide-template-box'"
      class="resume-design-div work_experience_lists"
      style="padding: 0 !important"
      :style="{
        'min-height': divHeight + 'in',
        'padding-top': (resume.top_bottom_margi / 10) * 96 + 'px',
        'padding-bottom': (resume.top_bottom_margi / 10) * 96 + 'px',
        'font-family': font_family + ' !important',
        'letter-spacing': resume.body_text_spacing + '%',
        background:
          'linear-gradient(270deg, rgba(255, 255, 255, 1) 65%, ' +
          resume.color.primaryy_color +
          ' 65%)',
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
        <!-- :style="'border-bottom: 2px solid #dfdfdf !important;'" -->
        <div
          class="row"
          style="flex-wrap: nowrap; width: 98%; margin: 0 auto"
          v-if="resumesection.type == 'contact'"
        >
          <div
            class="col-lg-5 col-md-5 col-sm-4 temp_03-left-container border-bottom-white"
            :style="
              ';margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
            style="margin-left: 25px; padding-top: 30px"
          >
            <div class="sidebar-heading-contact">
              <div
                class="temp_03-main-heading"
                :style="{
                  'font-size': resume.heading_font_size + 'px',
                  'font-family': font_family,
                }"
              >
                <div style="text-align: right">
                  <div class="d-flex justify-content-end">
                    <span style="margin-right: 7px">
                      {{ resume.user ? resume.user.first_name + "" : "" }}
                    </span>
                    <span v-if="resume.resume_setting.is_middle">{{
                      resume.user ? resume.user.middle_initial + "." : ""
                    }}</span>
                  </div>

                  <span>{{ resume.user ? resume.user.last_name : "" }}</span>
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
            <div class="border-line-bottom select-content">
              <div>
                <div
                  class="main-contnent-heading-contacts"
                  v-show="resumesection.hidden == 1"
                  v-if="resumesection.hidden == 1"
                >
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
                        class="temp_03-rightHeading"
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
                        class="temp_03-r-h-2"
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
                        – {{ endorse.author }},
                        {{ endorse.author_description }},
                        {{ endorse.job_id ? getJobName(endorse.job_id) : "" }}
                        <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                      </div>
                    </span>
                  </div>
                  <div
                    class="temp_03-rightHeading"
                    v-if="resumeStateData.resume_setting.endorsement_type == 2"
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
                    {{
                      resumeStateData.resume_qualification_statement
                        ? resumeStateData.resume_qualification_statement
                            .final_statement
                        : ""
                    }}
                  </div>
                </div>
              </div>
              <div class="main-contnent-heading-contacts">
                <div class="d-flex justify-content-between p-2">
                  <div
                    class="temp_03-sub-headingData"
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
                          <h5 class="data-card d-flex align-items-center">
                            <i
                              :class="getContactIconClassByType(item)"
                              class="mr-1"
                            ></i>
                            <span
                              :style="
                                'color:' + resume.color.font + '!important'
                              "
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
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
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
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
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
                          :style="
                            'color:' + resume.color.accent + '!important;'
                          "
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
                        <div class="" v-if="getResumeAddress">
                          <i
                            class="fas fa-map-marker-alt m-1"
                            :style="
                              'color:' + resume.color.accent + '!important;'
                            "
                            style="color: #ffa338"
                          ></i>
                          {{ getResumeAddress }}
                        </div>
                      </div>
                      <!--  -->
                    </div>
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
            <div class="sidebar-heading-professional">
              <div
                class="temp_03-sub-heading"
                style="text-align: right"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                }"
              >
                <!-- color: resume.color.secondary || '', -->
                <span>
                  {{ resumesection.title }}
                </span>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard select-content"
          >
            <div class="">
              <div
                class="temp_03-rightHeading main-contnent-heading-professional"
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
                  v-if="
                    pro_summ_subsection != null && pro_summ_subsection.status
                  "
                >
                  <div
                    class="temp_03-rightHeading main-contnent-heading-professional underline-text"
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
                    class="temp_03-sub-headingData main-contnent-heading-professional"
                    :style="'color:' + resume.color.font + '!important;'"
                  >
                    {{ pro_summ_subsection.content }}
                  </div>

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
                  >
                    <ul
                      v-for="(
                        pro_sum_sub_res_experience, proSumSubSecKey
                      ) in pro_summ_subsection.resume_experience"
                      :key="`#deexp_showme_${proSumSubSecKey}`"
                    >
                      <li
                        class="main-contnent-heading-professional li-section-box"
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                        v-if="pro_summ_subsection.resume_experience.length > 0"
                      >
                        <span class="display-inline">
                          {{
                            pro_sum_sub_res_experience.experience
                              ? pro_sum_sub_res_experience.experience
                                  .description
                              : "no data"
                          }}
                        </span>
                      </li>
                    </ul>
                  </div>
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
            <div class="sidebar-heading-work right-heading-flex pt-2">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                }"
              >
                <!-- color: resume.color.secondary || '', -->
                <span> {{ resumesection.title }}</span>
              </div>
            </div>
          </div>
          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard select-content"
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
                  class="temp_03-rightHeading main-contnent-heading-work pt-2"
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

                      {{ resumejob.job ? getState(resumejob.job) : "" }},
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

                      {{ resumejob.job ? getState(resumejob.job) : "" }},
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
                  class="temp_03-rightHeading main-contnent-heading-work"
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
                class="temp-sub-heading main-contnent-heading-work"
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

                    {{ resumejob.job ? getState(resumejob.job) : "" }},
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
                    {{ resumejob.job ? getState(resumejob.job) : "" }}
                  </span>
                  <span v-if="resume.resume_setting.is_location"></span>
                </span>
              </div>

              <div
                v-if="resume.resume_setting.is_job_description"
                class="mb-2 main-contnent-heading-work"
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
                <p>{{ getJobDescription(resumejob) }}</p>
              </div>

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
              >
                <ul
                  v-for="(
                    endorse, endorseKey
                  ) in resumejob.job.endorsements.filter(
                    (ea) => ea.status == 1
                  )"
                >
                  <li
                    class="main-contnent-heading-work li-section-box"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    <div class="display-inline">
                      “{{ endorse.value }}”
                      <span
                        >– {{ endorse.author }},
                        {{ endorse.author_description }},
                        {{ endorse.job_id ? getJobName(endorse.job_id) : "" }}
                        <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                      </span>
                    </div>
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
                    class="main-contnent-heading-work li-section-box"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'font-family:' +
                      font_family +
                      '!important;'
                    "
                  >
                    <div class="display-inline">
                      {{ experience.description }}
                    </div>
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
            <div class="sidebar-heading-education right-heading-flex pt-2">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                }"
              >
                <!-- color: resume.color.secondary || '', -->
                {{ resumesection.title }}
              </div>
            </div>
          </div>
          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard select-content"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              class="temp_03-rightHeading select-content"
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
                  class="temp_03-rightHeading main-contnent-heading-education pt-2"
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
                      <span
                        v-if="education.is_major_field_study && education.major"
                      >
                        -</span
                      >
                    </span>
                  </span>
                  <span
                    v-if="education.is_major_field_study && education.major"
                  >
                    {{ education.major }}
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
                  class="temp_03-rightHeading main-contnent-heading-education"
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
                  <div v-if="!education.is_grad_date">
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
                class="temp-sub-heading main-contnent-heading-education"
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
                class="temp_03-unorder-list"
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
                    class="main-contnent-heading-education li-section-box"
                  >
                    <div class="display-inline">
                      <span v-if="education.gpa_format == 'full'">
                        GPA: {{ education.overallgpa }} out of 4.0
                      </span>
                      <span v-else> GPA: {{ education.overallgpa }} </span>
                    </div>
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
                    class="main-contnent-heading-education li-section-box"
                  >
                    <div class="display-inline">
                      <span v-if="education.gpa_format == 'full'">
                        Major GPA: {{ education.majorgpa }} out of 4.0
                      </span>
                      <span v-else> Major GPA: {{ education.majorgpa }} </span>
                    </div>
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
                    class="main-contnent-heading-education li-section-box"
                  >
                    <div class="display-inline">
                      {{ education.credits_completed }} Credits Completed
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <div
              v-if="checkDynamicColumnClass(resumesection.column, 4) != 1"
              class="select-content"
            >
              <div
                class="row main-contnent-heading-education"
                v-for="(eduSubSections, index) in groupedData(
                  getEduSubSectionArray,
                  checkDynamicColumnClass(resumesection.column, 4)
                )"
                :key="index"
                v-show="resumesection.hidden == 1"
              >
                <div
                  class="col-sm-12 mb-3"
                  :class="checkDynamicEduClass(resumesection.column, 4)"
                  :style="'color:' + resume.color.font + '!important'"
                  v-for="(eduSubSection, index) in eduSubSections.filter(
                    (el) => el.status == 1
                  )"
                  v-bind:key="index"
                >
                  <!-- {{ eduSubSection.edu_sub_section_content }} -->
                  <div
                    class="temp_03-rightHeading"
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
                  <div class="">
                    <p
                      v-if="eduSubSection.content"
                      class=""
                      :style="'color:' + resume.color.font + ' !important'"
                    >
                      {{ eduSubSection.content }}
                    </p>
                  </div>

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
                          class="li-section-box"
                        >
                          <div class="display-inline">
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
                          class="li-section-box"
                        >
                          <div class="display-inline">
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
                          class="li-section-box"
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
                          <div class="display-inline">
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
                        <li
                          class="li-section-box"
                          v-if="eduSubSectionContent.type === 'skills'"
                        >
                          <div class="display-inline">
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </div>
                        </li>
                        <li
                          class="li-section-box"
                          v-else-if="
                            eduSubSectionContent.type === 'endorsement'
                          "
                        >
                          <div class="display-inline">
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
                        <li
                          class="li-section-box"
                          v-else
                          v-show="getShowEducationEnhancement"
                        >
                          <div class="display-inline">
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
                          class="li-section-box no-builets-test"
                          v-if="eduSubSectionContent.type === 'skills'"
                        >
                          <div
                            class="display-inline"
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
                          class="no-builets-test li-section-box"
                          v-else-if="
                            eduSubSectionContent.type === 'endorsement'
                          "
                        >
                          <div
                            class="display-inline"
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
                          class="no-builets-test li-section-box"
                          v-else
                          v-show="getShowEducationEnhancement"
                        >
                          <div
                            class="display-inline"
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
            <div v-else>
              <div class="row select-content">
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
                    class="temp_03-rightHeading main-contnent-heading-education"
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
                  <div class="main-contnent-heading-education">
                    <p
                      v-if="eduSubSection.content"
                      class=""
                      :style="'color:' + resume.color.font + ' !important'"
                    >
                      {{ eduSubSection.content }}
                    </p>
                  </div>

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
                          class="main-contnent-heading-education li-section-box"
                        >
                          <div class="display-inline">
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
                          class="main-contnent-heading-education li-section-box"
                        >
                          <div class="display-inline">
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
                          class="main-contnent-heading-education li-section-box"
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
                          <div class="display-inline">
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
                        <li
                          class="main-contnent-heading-education li-section-box"
                          v-if="eduSubSectionContent.type === 'skills'"
                        >
                          <div class="display-inline">
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </div>
                        </li>
                        <li
                          class="main-contnent-heading-education li-section-box"
                          v-else-if="
                            eduSubSectionContent.type === 'endorsement'
                          "
                        >
                          <div class="display-inline">
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
                        <li
                          class="main-contnent-heading-education li-section-box"
                          v-else
                          v-show="getShowEducationEnhancement"
                        >
                          <div class="display-inline">
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
                          class="main-contnent-heading-education li-section-box no-builets-test"
                          v-if="eduSubSectionContent.type === 'skills'"
                        >
                          <div
                            class="display-inline"
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
                          class="no-builets-test main-contnent-heading-education li-section-box"
                          v-else-if="
                            eduSubSectionContent.type === 'endorsement'
                          "
                        >
                          <div
                            class="display-inline"
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
                          class="no-builets-test main-contnent-heading-education li-section-box"
                          v-else
                          v-show="getShowEducationEnhancement"
                        >
                          <div
                            class="display-inline"
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
            <div class="sidebar-heading-skill right-heading-flex">
              <div
                class="temp_03-sub-heading"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                }"
              >
                <!-- color: resume.color.secondary || '', -->
                {{ resumesection.title }}
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard select-content"
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
              class="main-contnent-heading-skill"
            >
              {{ resumesection.content }}
            </div>
            <div>
              <div class="justify-content-between">
                <div
                  v-if="checkDynamicColumnClass(resumesection.column, 4) != 1"
                >
                  <div
                    class="row main-contnent-heading-skill"
                    v-for="(rowSubSectionSkill, index) in groupedData(
                      getSkillSubSectionArray,
                      checkDynamicColumnClass(resumesection.column, 4)
                    )"
                    :key="index"
                    v-show="resumesection.hidden == 1"
                  >
                    <div
                      class="col-sm-12 mb-3"
                      :class="checkDynamicEduClass(resumesection.column, 4)"
                      v-for="(
                        skill_sub_section, skillsSubSecKey
                      ) in rowSubSectionSkill.filter((sd) => sd.status == true)"
                      :key="skillsSubSecKey"
                    >
                      <div>
                        <div class="">
                          <h3
                            class="temp_03-rightHeading"
                            :style="{
                              'font-size': resume.subheading_font_s + 'px',
                              'padding-top': resume.subheading_spacin + 'px',
                              'padding-bottom': resume.subheading_spacin + 'px',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{
                              skill_sub_section.title ?? "Untitled SubSection"
                            }}
                          </h3>
                        </div>
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
                          class=""
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
                            :style="
                              'text-indent:' + resume.indent_spacing + '%'
                            "
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
                              <li
                                class="li-section-box"
                                v-if="eduSubSectionContent.type === 'skills'"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  <div class="display-inline">
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.name
                                    }}
                                  </div>
                                </div>
                              </li>

                              <li
                                class="li-section-box"
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  class="display-inline"
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
                                class="li-section-box"
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
                                  <div class="display-inline">
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.value
                                    }}
                                  </div>
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
                                class="li-section-box"
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                              >
                                <div class="display-inline">
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
                                class="li-section-box"
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                              >
                                <div class="display-inline">
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
                                class="li-section-box"
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
                                <div class="display-inline">
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
                              style="
                                margin-bottom: 0;
                                padding-left: 0 !important;
                              "
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                skill_sub_section.edu_sub_section_content
                              )"
                            >
                              <li
                                class="no-builets-test li-section-box"
                                v-if="eduSubSectionContent.type === 'skills'"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                  class="display-inline"
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>

                              <li
                                class="no-builets-test li-section-box"
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  class="display-inline"
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
                                class="no-builets-test li-section-box"
                                v-else
                                v-show="getShowEducationEnhancement"
                              >
                                <div
                                  class="display-inline"
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
                <div v-else>
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
                        <div class="main-contnent-heading-skill">
                          <h3
                            class="temp_03-rightHeading"
                            :style="{
                              'font-size': resume.subheading_font_s + 'px',
                              'padding-top': resume.subheading_spacin + 'px',
                              'padding-bottom': resume.subheading_spacin + 'px',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{
                              skill_sub_section.title ?? "Untitled SubSection"
                            }}
                          </h3>
                        </div>
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
                          class="main-contnent-heading-skill"
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
                            :style="
                              'text-indent:' + resume.indent_spacing + '%'
                            "
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
                              <li
                                class="main-contnent-heading-skill li-section-box"
                                v-if="eduSubSectionContent.type === 'skills'"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  <div class="display-inline">
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.name
                                    }}
                                  </div>
                                </div>
                              </li>

                              <li
                                class="main-contnent-heading-skill li-section-box"
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  class="display-inline"
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
                                class="main-contnent-heading-skill li-section-box"
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
                                  <div class="display-inline">
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.value
                                    }}
                                  </div>
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
                                class="main-contnent-heading-skill li-section-box"
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                              >
                                <div class="display-inline">
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
                                class="main-contnent-heading-skill li-section-box"
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                              >
                                <div class="display-inline">
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
                                class="main-contnent-heading-skill li-section-box"
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
                                <div class="display-inline">
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
                              style="
                                margin-bottom: 0;
                                padding-left: 0 !important;
                              "
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                skill_sub_section.edu_sub_section_content
                              )"
                            >
                              <li
                                class="no-builets-test main-contnent-heading-skill li-section-box"
                                v-if="eduSubSectionContent.type === 'skills'"
                              >
                                <div
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                  class="display-inline"
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>

                              <li
                                class="no-builets-test main-contnent-heading-skill li-section-box"
                                v-else-if="
                                  eduSubSectionContent.type === 'endorsement'
                                "
                              >
                                <div
                                  class="display-inline"
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
                                class="no-builets-test main-contnent-heading-skill li-section-box"
                                v-else
                                v-show="getShowEducationEnhancement"
                              >
                                <div
                                  class="display-inline"
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
            <div
              :class="`right-heading-flex sidebar-new-section-${resumesection.id}`"
            >
              <div
                class="temp_03-sub-heading sidebar-heading-new-section right-heading-text"
                style="word-wrap: break-word"
                :style="{
                  fontSize: resume.heading_font_size + 'px',
                  fontFamily: font_family + ' !important',
                  paddingBottom: resume.heading_spacing + 'px',
                }"
              >
                <!-- color: resume.color.secondary || '', -->
                <p>{{ resumesection.title }}</p>
              </div>
            </div>
          </div>

          <div
            class="col-lg-7 col-md-7 col-sm-8 temp_03-right-container border-bottom-dard select-content"
            :style="
              'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
            "
          >
            <div
              :class="`main-content-new-section-${resumesection.id}`"
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
            <div
              v-if="checkDynamicColumnClass(resumesection.column, 4) != 1"
              class="select-content"
            >
              <div
                class="row"
                :class="`main-content-new-section-${resumesection.id}`"
                v-for="(rowNewSections, index) in groupedData(
                  resumesection.resume_sub_section,
                  checkDynamicColumnClass(resumesection.column, 4)
                )"
                :key="index"
                v-show="resumesection.hidden == 1"
              >
                <div
                  class="col-sm-12 mb-3"
                  :class="checkDynamicEduClass(resumesection.column, 4)"
                  v-for="(new_sub_section, index) in rowNewSections.filter(
                    (sd) => sd.status == true
                  )"
                  v-bind:key="index"
                  :style="'color:' + resume.color.font + ' !important'"
                >
                  <div>
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
                      </div>
                      <div>
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
                          >{{ new_sub_section.content }}
                        </span>
                      </div>
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
                                class="li-section-box"
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
                                  class="display-inline"
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  <p>
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.name
                                    }}
                                  </p>
                                </div>
                              </li>
                              <li
                                class="li-section-box"
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
                                  class="display-inline"
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
                                    }},{{
                                      getJobName(
                                        eduSubSectionContent
                                          .subsection_content_able.job_id
                                      )
                                    }}</span
                                  >
                                </div>
                              </li>
                              <li
                                class="li-section-box"
                                v-else
                                v-show="getShowEducationEnhancement"
                              >
                                <div
                                  class="display-inline"
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
                                class="li-section-box"
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
                                <div class="display-inline">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>
                              <li
                                class="li-section-box"
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
                                <div class="display-inline">
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
                                class="li-section-box"
                              >
                                <div class="display-inline">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>

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
                              class="li-section-box no-builets-test"
                              v-if="eduSubSectionContent.type === 'skills'"
                            >
                              <div
                                class="display-inline"
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
                              class="li-section-box no-builets-test"
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                class="display-inline"
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
                              class="li-section-box no-builets-test"
                              v-else
                              v-show="getShowEducationEnhancement"
                            >
                              <div
                                class="display-inline"
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
            <div v-else>
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
                      <div
                        :class="`main-content-new-section-${resumesection.id}`"
                      >
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
                      </div>
                      <div
                        :class="`main-content-new-section-${resumesection.id}`"
                      >
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
                          >{{ new_sub_section.content }}
                        </span>
                      </div>
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
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
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
                                  class="display-inline"
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;'
                                  "
                                >
                                  <p>
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.name
                                    }}
                                  </p>
                                </div>
                              </li>
                              <li
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
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
                                  class="display-inline"
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
                                    }},{{
                                      getJobName(
                                        eduSubSectionContent
                                          .subsection_content_able.job_id
                                      )
                                    }}</span
                                  >
                                </div>
                              </li>
                              <li
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
                                v-else
                                v-show="getShowEducationEnhancement"
                              >
                                <div
                                  class="display-inline"
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
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
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
                                <div class="display-inline">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </div>
                              </li>
                              <li
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
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
                                <div class="display-inline">
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
                                :class="`main-content-new-section-${resumesection.id}`"
                                class="li-section-box"
                              >
                                <div class="display-inline">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
                                  }}
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>

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
                              :class="`main-content-new-section-${resumesection.id}`"
                              class="li-section-box no-builets-test"
                              v-if="eduSubSectionContent.type === 'skills'"
                            >
                              <div
                                class="display-inline"
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
                              :class="`main-content-new-section-${resumesection.id}`"
                              class="li-section-box no-builets-test"
                              v-else-if="
                                eduSubSectionContent.type === 'endorsement'
                              "
                            >
                              <div
                                class="display-inline"
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
                              :class="`main-content-new-section-${resumesection.id}`"
                              class="li-section-box no-builets-test"
                              v-else
                              v-show="getShowEducationEnhancement"
                            >
                              <div
                                class="display-inline"
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
    </div>

    <div class="resume-bottom">
      <div class="row mt-3">
        <div
          class="col-md-7 col-sm-12 footer-spacing-remove-mobile remove-bulits-footer"
        >
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
      finalContent: [],
      pages: [],
      divHeight: 10,
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
      "getResumeBuilderClasses",
      "getResumeAddress",
      "getForthSidebarFontColor",
    ]),
    ...mapState({
      // arrow functions can make the code very succinct!
      resumeStateData: (state) => state.Two_Page_Resume,
    }),
    groupedData() {
      return (data, colSize) => {
        return this.groupDataIntoRows(data, colSize);
      };
    },
  },
  mounted() {
    this.getAddress();
    this.getJobDescriptionsForResume(this.resume.id);
    this.getFontFamily();
    this.convertPageIntoRow();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
      this.handlerFunction();
    },
    downloadResume: function () {
      var elements = document.querySelectorAll(
        ".col-lg-5.col-md-5.col-sm-4.temp_03-left-container.border-bottom-white"
      );
      var that = this;
      elements.forEach(function (element) {
        if (element) {
          var dynamicColor = that.resume.color.secondary;
          var style = document.createElement("style");
          var cssRule =
            ".col-lg-5.col-md-5.col-sm-4.temp_03-left-container.border-bottom-white { color: " +
            dynamicColor +
            " !important; }";
          style.appendChild(document.createTextNode(cssRule));
          document.head.appendChild(style);
        }
      });
      setTimeout(() => {
        this.checkHeight();
        const margin_add = [1, 0, 1, 0];
        this.generatePDF(margin_add);
      }, 100);
    },
  },

  methods: {
    getJobDescription(resumejob) {
      if (resumejob && resumejob.job) {
        if (this.checkJobDescription(resumejob.job.id)) {
          return this.checkJobDescription(resumejob.job.id);
        } else if (
          resumejob.job.position &&
          resumejob.job.position.pos_description
        ) {
          return resumejob.job.position.pos_description;
        }
      }
      return "You can add description from job description page";
    },
    handlerFunction: function () {
      this.$nextTick(() => {
        this.convertPageIntoRow();
      });
    },

    convertPageIntoRow() {
      this.finalContent = [];
      var sidebarHeadingSelector = "";
      var mainContentHeadingSelector = "";
      this.resume.resume_sections.forEach((section) => {
        if (section.type === "contact") {
          sidebarHeadingSelector = `.sidebar-heading-contact`;
          mainContentHeadingSelector = `.select-content .main-contnent-heading-contacts`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        } else if (section.type === "education" && section.hidden == 1) {
          sidebarHeadingSelector = `.sidebar-heading-education`;
          mainContentHeadingSelector = `.select-content .main-contnent-heading-education`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        } else if (section.type === "work" && section.hidden == 1) {
          sidebarHeadingSelector = `.sidebar-heading-work`;
          mainContentHeadingSelector = `.select-content .main-contnent-heading-work`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        } else if (
          section.type === "professional-summary" &&
          section.hidden == 1
        ) {
          sidebarHeadingSelector = `.sidebar-heading-professional`;
          mainContentHeadingSelector = `.select-content .main-contnent-heading-professional`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        } else if (section.type === "skill" && section.hidden == 1) {
          sidebarHeadingSelector = `.sidebar-heading-skill`;
          mainContentHeadingSelector = `.select-content .main-contnent-heading-skill`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        } else if (section.type === "new-section" && section.hidden == 1) {
          sidebarHeadingSelector = `.sidebar-new-section-${section.id}`;
          mainContentHeadingSelector = `.select-content .main-content-new-section-${section.id}`;
          this.renderSection.call(
            this,
            sidebarHeadingSelector,
            mainContentHeadingSelector,
            section
          );
        }
      });

      setTimeout(() => {
        this.splitContentIntoPages();
      }, 100);
    },
    renderSection(sidebarHeadingSelector, mainContentHeadingSelector, section) {
      var sidebarHeading = document.querySelector(sidebarHeadingSelector);
      var mainContentHeadings = document.querySelectorAll(
        mainContentHeadingSelector
      );

      var dynamicColor = this.resume.color.secondary;
      var style = document.createElement("style");
      var cssRule =
        ".col-md-4.color-sidebar { color: " + dynamicColor + " !important; }";
      style.appendChild(document.createTextNode(cssRule));
      document.head.appendChild(style);
      // Loop through each main content heading
      var mainLength = mainContentHeadings.length;
      mainContentHeadings.forEach((mainContentHeading, index) => {
        // Create a new row for each iteration
        var card = document.createElement("div");
        card.classList.add("card");
        // Create columns for sidebar and main content
        var sidebarColumn = document.createElement("div");
        sidebarColumn.classList.add("col-md-4", "color-sidebar");

        var mainColumn = document.createElement("div");
        mainColumn.classList.add("col-md-8");
        mainColumn.appendChild(mainContentHeading.cloneNode(true));

        if (index === 0 && sidebarHeading) {
          sidebarColumn.appendChild(sidebarHeading.cloneNode(true));
        }

        var rowMe = document.createElement("div");
        rowMe.classList.add("row", "sub-section");

        // Append columns to the row
        rowMe.appendChild(sidebarColumn);
        rowMe.appendChild(mainColumn);
        // to put  border
        if (index == mainLength - 1) {
          var sidebarColumn = document.createElement("div");
          sidebarColumn.classList.add("col-md-4", "border-bottom-sidebar");
          sidebarColumn.style.borderBottom = `1px solid ${this.resume.color.secondary}`;

          var mainColumn = document.createElement("div");
          mainColumn.classList.add("col-md-8", "border-bottom-main");
          if (this.resume.color.primaryy_color == "#F9ACAC") {
            mainColumn.style.borderBottom = `1px solid #dfdfdf`;
          } else {
            mainColumn.style.borderBottom = `1px solid ${this.resume.color.font}`;
          }
          rowMe.appendChild(sidebarColumn);
          rowMe.appendChild(mainColumn);
        }

        card.appendChild(rowMe);
        this.finalContent.push(card);
      });
    },

    splitContentIntoPages() {
      this.pages = [];
      var a4Height = 960; // A4 height in pixels
      var elements = document.querySelectorAll(".section .sub-section");
      var currentHeight = 0;
      var currentPage = document.createElement("div");

      elements.forEach((element) => {
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

      // Add the last page if it's not empty
      if (currentPage.innerHTML.trim().length > 0) {
        this.pages.push(currentPage.cloneNode(true));
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
      var page_size = 10.9;
      const inches = combinedHeightInPixels / dpi;
      if (inches >= 11 && inches <= 21.9) {
        this.divHeight = page_size * 2;
      } else if (inches >= 22 && inches <= 32.09) {
        this.divHeight = page_size * 3;
      } else if (inches >= 33.1 && inches <= 44) {
        this.divHeight = page_size * 4;
      } else if (inches >= 44.1 && inches <= 55) {
        this.divHeight = page_size * 5;
      } else if (inches >= 55.1 && inches <= 65.9) {
        this.divHeight = page_size * 6;
      } else {
        this.divHeight = page_size;
      }
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

      store.commit("storeResumeAddress", address);
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
<style>
.col-md-4.color-sidebar {
  color: red !important;
}
.border-bottom-sidebar {
  margin-top: 20px !important;
}
</style>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Exo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
.card {
  /* width: 842px;  */
  background-color: #ffffff !important;
  height: 3400px;
  margin: 0 auto;
  margin-bottom: 10px;
}

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
  padding: 25px 45px;
  background: #fff;
  -webkit-box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 9%);
  /* min-width: 690px; */
  /* max-width: 690px; */
  /* height: 100% !important; */
  min-width: 8.27in !important;
  min-height: 9.99in !important;
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
  padding-top: 20px;
}

.temp_03-right-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  /* max-height: 892px;
    min-height: 892px; */
  padding-right: 15px;
  text-align: left;
  padding-top: 20px;
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
  /* margin-top: -15px !important; */
  /* margin-left: 10px; */
  margin-bottom: 10px;
  font-size: 13px;
}
.temp_03-main-heading {
  font-weight: bolder;
  font-size: 35px;
  line-height: 35px;
  padding-bottom: 20px;
}
.temp_03-sub-heading {
  font-size: 22px;
  /* padding-top: 13px; */
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

    line-height: 35px;
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
    /* padding-top: 18px; */
    line-height: 35px;
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

li.no-builets-test::before {
  display: none;
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
  margin-top: 0 !important;
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
.display-inline {
  display: inline;
}

li.li-section-box {
  padding-left: 12px;
}
.temp_03-sub-heading {
  position: absolute;
}

.sidebar-heading-skill,
.sidebar-heading-professional,
.sidebar-heading-contact,
.sidebar-heading-work,
.sidebar-heading-new-section {
  position: absolute;
  /* z-index: 99; */
  width: 85%;
  text-align: left;
}

.height-remove-box {
  height: 0px !important;
  min-height: 0px !important;
  overflow: hidden !important;
}
.hide-template-box {
  min-height: 0px !important;
  height: 0px !important;
  padding: 0 !important;
  overflow: hidden !important;
}

.border-bottom-main {
  border-bottom: 2px solid grey !important;
  margin-bottom: 10px !important;
}

.border-bottom-sidebar {
  border-bottom: 2px solid grey !important;
  margin-bottom: 10px !important;
}

.right-heading-text p {
  text-align: right !important;
}

.right-heading-flex {
  display: flex;
  justify-content: flex-end;
}

.underline-text {
  text-decoration: underline !important;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  display: grid;
  grid-template-columns: auto 1fr;
  gap: 10px;
  align-items: start;
}

li::before {
  content: "\2022";
  font-size: 0.8em;
  display: inline-block;
  /* position: relative; */
  /* top: -8px; */
}

.temp_03-unorder-list.vertical_buttets ul {
  padding-left: 0px !important;
}

.right-heading-flex .temp_03-sub-heading {
  text-align: right !important;
}

.remove-bulits-footer ul li:before {
  display: none;
}
</style>
