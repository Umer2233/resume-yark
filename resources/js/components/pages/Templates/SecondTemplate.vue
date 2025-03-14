<template>
  <div>
    <div>
      <div ref="">
        <div v-for="(page, index) in pages" :key="index" class="mb-1">
          <div
            class="page resume-design-div resume-control-preview"
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
            v-html="page.innerHTML"
          ></div>
        </div>
      </div>
      <div class="content">
        <div class="section">
          <div
            :class="getResumeBuilderClasses ? '' : 'hide-template-box'"
            ref="htmlToConvert"
            class="resume-design-div font-family-montrest none-second-perview"
            :style="
              'font-family:' +
              font_family +
              '!important;letter-spacing:' +
              resume.body_text_spacing +
              '% ;' +
              'letter-spacing:' +
              resume.body_text_spacing +
              'px;' +
              'padding-top:' +
              (resume.top_bottom_margi / 10) * 96 +
              'px;' +
              'padding-bottom:' +
              (resume.top_bottom_margi / 10) * 96 +
              'px'
            "
          >
            <div
              :style="
                'margin-right:' +
                (resume.left_right_margin / 10) * 96 +
                'px' +
                ';margin-left:' +
                (resume.left_right_margin / 10) * 96 +
                'px'
              "
              class="work_experience_list-0"
              v-for="(resumesection, key) in sortMainSectionArray(
                resumeStateData.resume_sections
              )"
              :key="key"
            >
              <div class="my-1 main-container p-0">
                <!-- Contact Section start -->
                <div
                  class="row section"
                  style="padding: 25px 45px"
                  v-if="resumesection.type == 'contact'"
                >
                  <div
                    class="col-lg-12 d-flex contact-bottom-line sub-section pr-0 pl-0"
                    v-show="resumesection.hidden == 1"
                  >
                    <div class="col-lg-8 pl-0">
                      <h1
                        class="main-heading"
                        :style="
                          'fontFamily:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.primaryy_color +
                          '!important;' +
                          'font-size:' +
                          resume.heading_font_size +
                          'px !important'
                        "
                      >
                        {{ resume.user ? resume.user.first_name + "" : "" }}
                        <span v-if="resume.resume_setting.is_middle">{{
                          resume.user ? resume.user.middle_initial + "." : ""
                        }}</span
                        ><br />
                        {{ resume.user ? resume.user.last_name : "" }}
                      </h1>
                      <div
                        v-show="showHideContent.headline"
                        style="word-break: break-all"
                      >
                        <div v-if="resume.resume_setting.endorsement_type == 1">
                          <span
                            v-for="(
                              endorse, key
                            ) in resume.user.endorsements.filter(
                              (wa) => wa.top_endorsment_status == true
                            )"
                            :key="key"
                          >
                            <div v-if="endorse.top_endorsment_status">
                              <h3
                                class="d-flex w-100"
                                style="
                                  font-weight: 700;
                                  word-break: break-all !important;
                                "
                                :style="{
                                  'font-size': resume.subheading_font_s + 'px',
                                  'padding-top':
                                    resume.subheading_spacin + 'px',
                                  'padding-bottom':
                                    resume.subheading_spacin + 'px',
                                  color: resume.color.secondary,
                                }"
                              >
                                “{{ endorse.value }}”
                              </h3>

                              <p
                                class="subHeading ml-0"
                                style="text-align: right"
                              >
                                <span
                                  :style="{
                                    fontSize:
                                      resume.subheading_font_s +
                                      'px !important',
                                    fontFamily: font_family + ' !important',
                                    color: resume.color.accent + ' !important',
                                  }"
                                  >– {{ endorse.author }},
                                  {{ endorse.author_description }},
                                  <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                                  {{
                                    endorse.job_id
                                      ? getJobName(endorse.job_id)
                                      : ""
                                  }}
                                </span>
                              </p>
                            </div>
                          </span>
                        </div>
                        <div v-if="resume.resume_setting.endorsement_type == 2">
                          <p
                            class="qualification_statement_para flex-control-resume-text"
                          >
                            {{
                              resume.resume_qualification_statement
                                ? resume.resume_qualification_statement
                                    .final_statement
                                : ""
                            }}
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 pr-0">
                      <div v-if="getContactSortedItemsFromState">
                        <div
                          v-for="(
                            item, key
                          ) in getContactSortedItemsFromState.slice(0, 5)"
                          :key="key"
                          class="col-md-12 contact_email"
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
                          <div class="" v-if="getContactDataByType(item.type)">
                            <h5 class="data-card d-flex align-items-center">
                              <i
                                :class="getContactIconClassByType(item)"
                                class="mr-1"
                                :style="
                                  'color:' +
                                  resume.color.primaryy_color +
                                  '!important'
                                "
                              ></i>
                              <span>
                                {{ getContactDataByType(item.type) }}
                              </span>
                            </h5>
                          </div>
                        </div>
                      </div>
                      <div v-else>
                        <h5
                          class="data-card d-flex align-items-center"
                          v-if="resume.resume_setting.is_email"
                        >
                          <i
                            class="mr-1 far fa-envelope"
                            :style="'color:' + resume.color.primaryy_color"
                          ></i>
                          <span
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              fontFamily: font_family + ' !important',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{ resume.user ? resume.user.email : "" }}
                          </span>
                        </h5>
                        <h5
                          class="data-card d-flex align-items-center"
                          v-if="getResumeAddress"
                        >
                          <i
                            class="mr-1 fa fa-map-marker-alt"
                            :style="
                              'color:' +
                              resume.color.primaryy_color +
                              '!important'
                            "
                          ></i>
                          <span
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              fontFamily: font_family + ' !important',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{ getResumeAddress }}
                          </span>
                        </h5>
                        <h5
                          class="data-card d-flex align-items-center"
                          v-if="resume.resume_setting.is_phone"
                        >
                          <i
                            class="mr-1 fa fa-phone-alt"
                            :style="
                              'color:' +
                              resume.color.primaryy_color +
                              '!important'
                            "
                          ></i>
                          <span
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              fontFamily: font_family + ' !important',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{ resume.user ? resume.user.phone : "" }}
                          </span>
                        </h5>
                        <h5
                          class="data-card d-flex align-items-center"
                          v-if="
                            resume.resume_setting.is_pro &&
                            resume.user.professional_profile != null
                          "
                        >
                          <i
                            class="mr-1 fab fa-linkedin"
                            :style="
                              'color:' +
                              resume.color.primaryy_color +
                              '!important'
                            "
                          ></i>
                          <span
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              fontFamily: font_family + ' !important',
                              color: resume.color.accent + ' !important',
                            }"
                          >
                            {{
                              resume.user
                                ? resume.user.professional_profile
                                : ""
                            }}
                          </span>
                        </h5>

                        <h5
                          class="data-card d-flex align-items-center"
                          v-if="
                            resume.resume_setting.is_web &&
                            resume.user.website != null
                          "
                        >
                          <i
                            class="mr-1 fas fa-globe-europe"
                            :style="
                              'color:' +
                              resume.color.primaryy_color +
                              '!important'
                            "
                          ></i>
                          <span
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
                          </span>
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Contact Section end -->
                <!-- professional summary start -->
                <div
                  class="professional-summary-dummy work_experience_list"
                  v-if="
                    resumesection.type == 'professional-summary' &&
                    resume.type == 'functional'
                  "
                  v-show="resumesection.hidden == 1"
                  style="border-bottom: 2px solid #d9d9d9"
                >
                  <div class="" v-show="resumesection.hidden == 1">
                    <div
                      class="heading-second sub-section"
                      :style="{
                        fontSize: resume.heading_font_size + 'px',
                        fontFamily: font_family + ' !important',
                        paddingBottom: resume.heading_spacing + 'px',
                        color: resume.color.primaryy_color,
                      }"
                    >
                      {{ resumesection.title }}
                    </div>
                  </div>
                  <div class="sub-section" v-show="resumesection.hidden == 1">
                    <span
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
                        resume.color.accent
                      "
                    >
                      {{ resumesection.content }}
                    </span>
                  </div>
                  <div
                    v-for="(
                      pro_summ_subsection, i
                    ) in resumesection.resume_sub_section"
                    :key="i"
                  >
                    <div
                      v-if="
                        pro_summ_subsection != null &&
                        pro_summ_subsection.status
                      "
                    >
                      <div
                        class="sub-heading sub-section"
                        v-show="resumesection.hidden == 1"
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
                          resume.color.accent +
                          '!important;'
                        "
                      >
                        <p
                          :style="
                            'color:' +
                            resume.color.primaryy_color +
                            '!important;'
                          "
                          style="
                            font-weight: 600 !important;
                            text-decoration: underline;
                          "
                        >
                          {{ pro_summ_subsection.title }}
                        </p>
                      </div>
                      <div
                        class="sub-section"
                        v-show="resumesection.hidden == 1"
                      >
                        <span class="data-card data-card-basic-text">
                          <p>{{ pro_summ_subsection.content }}</p>
                        </span>
                      </div>
                      <div
                        class="unorder-list"
                        v-show="resumesection.hidden == 1"
                        :style="'text-indent:' + resume.indent_spacing + '%;'"
                      >
                        <ul>
                          <li
                            class="sub-section li-section-box"
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;' +
                              'font-family:' +
                              font_family +
                              '!important;'
                            "
                            v-if="
                              pro_summ_subsection.resume_experience.length > 0
                            "
                            v-for="(
                              pro_sum_sub_res_experience, proSumSubSecKey
                            ) in pro_summ_subsection.resume_experience"
                            :key="proSumSubSecKey"
                          >
                            <div class="display-inline">
                              {{
                                pro_sum_sub_res_experience.experience
                                  ? pro_sum_sub_res_experience.experience
                                      .description
                                  : "no data"
                              }}
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- professional summary end -->
                <!-- Work Experience  start -->
                <div
                  class="work-experience-dummy work_experience_list"
                  v-if="resumesection.type == 'work'"
                  v-show="resumesection.hidden == 1"
                  style="border-bottom: 2px solid #d9d9d9"
                >
                  <div
                    class="heading-second sub-section"
                    v-show="resumesection.hidden == 1"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                  >
                    <p>{{ resumesection.title }}</p>
                  </div>

                  <div
                    v-for="(resumejob, i) in getJobArray.filter(
                      (ae) => ae.active == 1
                    )"
                    :key="i"
                    class="mb-2"
                  >
                    <div
                      class="sub-heading sub-section"
                      v-show="resumesection.hidden == 1"
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
                        resume.color.accent
                      "
                    >
                      <span
                        v-if="resume.employment_emphasis == 'Employer'"
                        class="border-line-bottom"
                      >
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
                          - {{ resumejob.job ? resumejob.job.city : "" }},
                          {{ resumejob.job ? getState(resumejob.job) : "" }}
                        </span>
                        <span v-if="resume.resume_setting.is_location"></span>
                      </span>
                      <span v-else class="border-line-bottom">
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
                      class="sub-section d-flex justify-content-between sub-sub-heading"
                      v-show="resumesection.hidden == 1"
                    >
                      <div>
                        <span
                          v-if="resume.employment_emphasis == 'Employer'"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
                          "
                        >
                          {{
                            resumejob.job
                              ? resumejob.job.position
                                ? resumejob.job.position.pos_name
                                : ""
                              : ""
                          }}
                        </span>
                        <span
                          v-else
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
                          "
                        >
                          {{ resumejob.job ? resumejob.job.company : "" }},
                          <span
                            v-if="
                              resume.resume_setting.is_city_state_country &&
                              resume.resume_setting.is_location
                            "
                          >
                            {{ resumejob.job ? resumejob.job.city : "" }},
                            {{ resumejob.job ? getState(resumejob.job) : "" }},
                            {{
                              resumejob.job
                                ? resumejob.job.country.country_name
                                : ""
                            }}
                          </span>
                          <span
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;' +
                              'font-family:' +
                              font_family +
                              '!important;' +
                              'color:' +
                              resume.color.accent
                            "
                            v-if="
                              resume.resume_setting.is_city_state &&
                              resume.resume_setting.is_location
                            "
                          >
                            {{ resumejob.job ? resumejob.job.city : "" }},
                            {{ resumejob.job ? getState(resumejob.job) : "" }}
                          </span>
                          <span
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;' +
                              'font-family:' +
                              font_family +
                              '!important;' +
                              'color:' +
                              resume.color.accent
                            "
                            v-if="resume.resume_setting.is_location"
                          ></span>
                        </span>
                      </div>
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
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.accent
                        "
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
                      <div
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.accent
                        "
                        v-if="!resume.resume_setting.is_dates"
                      ></div>
                    </div>
                    <div
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.accent
                      "
                      v-if="resume.resume_setting.is_job_description"
                      class="mb-2 sub-section"
                      v-show="resumesection.hidden == 1"
                    >
                      <p>{{ getJobDescription(resumejob) }}</p>
                    </div>
                    <div
                      class="unorder-list"
                      v-show="resumesection.hidden == 1"
                      :style="'text-indent:' + resume.indent_spacing + '%;'"
                    >
                      <ul
                        style="margin-bottom: 0"
                        v-for="(
                          endorse, endorseKey
                        ) in resumejob.job.endorsements.filter(
                          (ea) => ea.status == 1
                        )"
                      >
                        <li
                          class="sub-section li-section-box"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
                          "
                        >
                          <div class="display-inline">
                            “{{ endorse.value }}”
                            <span style="font-family: sans-serif"
                              >– {{ endorse.author }},
                              {{ endorse.author_description }},
                              {{
                                endorse.job_id ? getJobName(endorse.job_id) : ""
                              }}
                            </span>
                          </div>
                        </li>
                      </ul>
                      <ul
                        v-if="resume.type == 'functional'"
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.accent
                        "
                        style="margin-bottom: 0"
                        v-for="(experience, experienceKey) in sortArray(
                          resumejob.job.experiences
                        ).filter((as) => as.status == 1)"
                        :key="`#demo_exp_showme_${experienceKey}`"
                      >
                        <li
                          class="sub-section li-section-box"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
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
                <!-- Work Experience  end -->
                <!--Education Section start here  -->
                <div
                  style="height: 100%; border-bottom: 2px solid #d9d9d9"
                  class="work_experience_list"
                  v-if="resumesection.type == 'education'"
                  v-show="resumesection.hidden == 1"
                  :style="
                    'padding-to:' +
                    resume.heading_spacing +
                    'px' +
                    'font-family:' +
                    font_family +
                    '!important;' +
                    'color:' +
                    resume.color.accent
                  "
                >
                  <div
                    class="heading-second sub-section"
                    v-show="resumesection.hidden == 1"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                  >
                    <p>{{ resumesection.title }}</p>
                  </div>
                  <div
                    v-for="(education, key) in sortEducationArray(
                      getEduArray
                    ).filter((ae) => ae.status == 1)"
                    :key="key"
                  >
                    <div
                      class="d-flex justify-content-between"
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        class="sub-section"
                        v-show="resumesection.hidden == 1"
                      >
                        <div
                          class="sub-sub-sub-heading text-decoration-none border-line-bottom"
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
                            resume.color.accent
                          "
                        >
                          <span v-if="education.is_degree">
                            <span v-if="resume.education_emphasis == 'Degree'">
                              {{ getDegree(education.degree) }}
                            </span>
                            <span v-else> {{ education.school }} - </span>
                          </span>
                          <span
                            v-if="
                              education.is_major_field_study && education.major
                            "
                          >
                            {{ education.major }}
                          </span>

                          <span
                            v-if="
                              education.minors.length > 0 &&
                              getShowEducationEnhancement
                            "
                          >
                            <span
                              v-if="getActiveMinorLength(education.minors) > 0"
                            >
                              - Minor<span
                                v-if="
                                  getActiveMinorLength(education.minors) > 1
                                "
                                >s</span
                              >
                              In</span
                            >
                            <span
                              v-for="(
                                minor, keyMinorshow
                              ) in sortEducationArray(education.minors).filter(
                                (ae) => ae.status == 1
                              )"
                              :key="`#demo_minor_onss${minor.id}`"
                            >
                              {{ minor.minor }}
                              <span
                                v-if="
                                  getActiveMinorLength(education.minors) == 1
                                "
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
                          </span>
                        </div>
                        <div>
                          <span v-if="!education.is_grad_date">
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
                          </span>
                        </div>
                      </div>
                    </div>
                    <div
                      class="sub-sub-heading sub-section"
                      v-show="resumesection.hidden == 1"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.accent
                      "
                    >
                      <div>
                        <span v-if="education.is_degree">
                          <span v-if="resume.education_emphasis == 'Degree'">
                            {{ education.school }} ,
                          </span>
                          <span v-else>
                            {{ getDegree(education.degree) }},
                          </span>
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
                          >{{ education.city }},
                          {{ education.state.state }}</span
                        >
                        <span
                          v-if="!resume.resume_setting.is_edu_location"
                        ></span>
                      </div>
                    </div>

                    <div
                      class="unorder-list"
                      v-show="resumesection.hidden == 1"
                      :style="'text-indent:' + resume.indent_spacing + '%;'"
                    >
                      <ul>
                        <li
                          class="sub-section li-section-box"
                          v-if="
                            education.is_overall_gpa &&
                            getShowEducationEnhancement
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
                          "
                        >
                          <div class="display-inline">
                            <span v-if="education.gpa_format == 'full'">
                              GPA: {{ education.overallgpa }} out of 4.0
                            </span>
                            <span v-else>
                              GPA: {{ education.overallgpa }}
                            </span>
                          </div>
                        </li>

                        <li
                          class="sub-section li-section-box"
                          v-if="
                            education.is_major_gpa &&
                            getShowEducationEnhancement
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;' +
                            'color:' +
                            resume.color.accent
                          "
                        >
                          <div class="display-inline">
                            <span v-if="education.gpa_format == 'full'">
                              Major GPA: {{ education.majorgpa }} out of 4.0
                            </span>
                            <span v-else>
                              Major GPA: {{ education.majorgpa }}
                            </span>
                          </div>
                        </li>
                        <li
                          class="sub-section li-section-box"
                          v-if="
                            education.is_credits_completed &&
                            education.credits_completed !== null &&
                            getShowEducationEnhancement
                          "
                        >
                          <div class="display-inline">
                            {{ education.credits_completed }} Credits Completed
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- edu subsection start -->
                  <div
                    v-if="checkDynamicColumnClass(resumesection.column, 2) != 1"
                  >
                    <div
                      class="row sub-section"
                      v-for="(eduSubSections, index) in groupedData(
                        getEduSubSectionArray,
                        checkDynamicColumnClass(resumesection.column, 2)
                      )"
                      :key="index"
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        class="col-sm-12 mb-3"
                        :class="checkDynamicEduClass(resumesection.column, 2)"
                        v-for="(eduSubSection, index) in eduSubSections.filter(
                          (el) => el.status == 1
                        )"
                        v-bind:key="'edu_sub_sec' + index"
                      >
                        <div class="" v-show="resumesection.hidden == 1">
                          <h5
                            class="working_as_Desig mb-0"
                            style="font-weight: 600"
                            :style="'color:' + resume.color.primaryy_color"
                            v-if="eduSubSection.title"
                          >
                            {{ eduSubSection.title }}
                          </h5>
                        </div>
                        <div class="" v-show="resumesection.hidden == 1">
                          <p
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              color: resume.color.accent + ' !important',
                              fontFamily: font_family + ' !important',
                            }"
                            v-if="eduSubSection.content"
                            class="working_as_Desig text-decoration-none mt-0"
                          >
                            {{ eduSubSection.content }}
                          </p>
                        </div>
                        <div>
                          <div
                            v-if="
                              eduSubSection.list_style == 'vertical_bullets'
                            "
                          >
                            <div class="" v-show="resumesection.hidden == 1">
                              <div
                                class="additional_information vertical_buttets"
                                :style="
                                  'text-indent:' + resume.indent_spacing + '%;'
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
                                    class="li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
                                    "
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
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
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>

                                  <li
                                    class="li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
                                    "
                                  >
                                    <div
                                      class="display-inline"
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      “{{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}”
                                      <span
                                        style="font-family: sans-serif"
                                        v-if="
                                          eduSubSectionContent
                                            .subsection_content_able.author
                                        "
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
                                    class="li-section-box"
                                    v-else
                                    v-show="getShowEducationEnhancement"
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
                                    "
                                  >
                                    <div
                                      class="display-inline"
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                          <div
                            v-else-if="
                              eduSubSection.list_style == 'horizontal_bullets'
                            "
                          >
                            <div class="" v-show="resumesection.hidden == 1">
                              <div
                                class="additional_information d-flex"
                                style="margin-bottom: 0"
                                :style="
                                  'font-family:' +
                                  font_family +
                                  '!important;' +
                                  'text-indent:' +
                                  resume.indent_spacing +
                                  '% ;'
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
                                    class="li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
                                    "
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
                                    "
                                  >
                                    <div class="display-inline">
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>
                                  <li
                                    class="li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
                                    "
                                  >
                                    <div class="display-inline">
                                      “{{
                                        eduSubSectionContent
                                          .subsection_content_able.value
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
                                        }}</span
                                      >
                                    </div>
                                  </li>
                                  <li class="li-section-box" v-else>
                                    <div class="display-inline">
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                          <div v-else>
                            <!-- sub section no bulites Education -->
                            <div class="" v-show="resumesection.hidden == 1">
                              <div
                                class="additional_information vertical_buttets"
                                :style="
                                  'text-indent:' + resume.indent_spacing + '%;'
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
                                    class="no-builets-test li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
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
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>

                                  <li
                                    class="no-builets-test li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
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
                                        eduSubSectionContent
                                          .subsection_content_able.value
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
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <!-- sub section no bulites Education -->

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
                          }},
                          {{
                            getJobName(
                              eduSubSectionContent.subsection_content_able.job_id
                            )
                          }}
                        </span>
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
                  <div v-else>
                    <div class="row">
                      <div
                        class="col-sm-12 mb-3"
                        :class="checkDynamicEduClass(resumesection.column, 2)"
                        v-for="(
                          eduSubSection, index
                        ) in getEduSubSectionArray.filter(
                          (el) => el.status == 1
                        )"
                        v-bind:key="'edu_sub_sec' + index"
                      >
                        <div
                          class="sub-section"
                          v-show="resumesection.hidden == 1"
                        >
                          <h5
                            class="working_as_Desig mb-0"
                            style="font-weight: 600"
                            :style="'color:' + resume.color.primaryy_color"
                            v-if="eduSubSection.title"
                          >
                            {{ eduSubSection.title }}
                          </h5>
                        </div>
                        <div
                          class="sub-section"
                          v-show="resumesection.hidden == 1"
                        >
                          <p
                            :style="{
                              fontSize: resume.body_font_size + 'px !important',
                              color: resume.color.accent + ' !important',
                              fontFamily: font_family + ' !important',
                            }"
                            v-if="eduSubSection.content"
                            class="working_as_Desig text-decoration-none mt-0"
                          >
                            {{ eduSubSection.content }}
                          </p>
                        </div>
                        <div>
                          <div
                            v-if="
                              eduSubSection.list_style == 'vertical_bullets'
                            "
                          >
                            <div class="" v-show="resumesection.hidden == 1">
                              <div
                                class="additional_information vertical_buttets"
                                :style="
                                  'text-indent:' + resume.indent_spacing + '%;'
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
                                    class="sub-section li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
                                    "
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
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
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>

                                  <li
                                    class="sub-section li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
                                    "
                                  >
                                    <div
                                      class="display-inline"
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      “{{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}”
                                      <span
                                        style="font-family: sans-serif"
                                        v-if="
                                          eduSubSectionContent
                                            .subsection_content_able.author
                                        "
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
                                    class="sub-section li-section-box"
                                    v-else
                                    v-show="getShowEducationEnhancement"
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
                                    "
                                  >
                                    <div
                                      class="display-inline"
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                          <div
                            v-else-if="
                              eduSubSection.list_style == 'horizontal_bullets'
                            "
                          >
                            <div
                              class="sub-section"
                              v-show="resumesection.hidden == 1"
                            >
                              <div
                                class="additional_information d-flex"
                                style="margin-bottom: 0"
                                :style="
                                  'font-family:' +
                                  font_family +
                                  '!important;' +
                                  'text-indent:' +
                                  resume.indent_spacing +
                                  '% ;'
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
                                    class="li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
                                    "
                                    :style="
                                      'fontSize:' +
                                      resume.body_font_size +
                                      'px !important;' +
                                      'font-family:' +
                                      font_family +
                                      '!important;' +
                                      'color:' +
                                      resume.color.accent
                                    "
                                  >
                                    <div class="display-inline">
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>
                                  <li
                                    class="li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
                                    "
                                  >
                                    <div class="display-inline">
                                      “{{
                                        eduSubSectionContent
                                          .subsection_content_able.value
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
                                        }}</span
                                      >
                                    </div>
                                  </li>
                                  <li class="li-section-box" v-else>
                                    <div class="display-inline">
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                          <div v-else>
                            <!-- sub section no bulites Education -->
                            <div class="" v-show="resumesection.hidden == 1">
                              <div
                                class="additional_information vertical_buttets"
                                :style="
                                  'text-indent:' + resume.indent_spacing + '%;'
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
                                    class="no-builets-test sub-section li-section-box"
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
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
                                      {{
                                        eduSubSectionContent
                                          .subsection_content_able.name
                                      }}
                                    </div>
                                  </li>

                                  <li
                                    class="no-builets-test sub-section li-section-box"
                                    v-else-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
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
                                        eduSubSectionContent
                                          .subsection_content_able.value
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
                                    class="no-builets-test sub-section li-section-box"
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
                                        eduSubSectionContent
                                          .subsection_content_able.value
                                      }}
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <!-- sub section no bulites Education -->

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
                          }},
                          {{
                            getJobName(
                              eduSubSectionContent.subsection_content_able.job_id
                            )
                          }}
                        </span>
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
                <!--Education Section end here  -->
                <!-- skill section start here -->
                <div
                  class="work_experience_list"
                  v-if="resumesection.type == 'skill'"
                  v-show="resumesection.hidden == 1"
                  style="border-bottom: 2px solid #d9d9d9"
                  :style="
                    'padding-to:' +
                    resume.heading_spacing +
                    'px' +
                    'font-family:' +
                    font_family +
                    '!important;'
                  "
                >
                  <div
                    class="heading-second sub-section"
                    v-show="resumesection.hidden == 1"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                  >
                    <p>{{ resumesection.title }}</p>
                  </div>
                  <div class="sub-section" v-show="resumesection.hidden == 1">
                    <span
                      style="font-size: 13px; color: #2c3e50"
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
                        resume.color.accent
                      "
                    >
                      {{ resumesection.content }}
                    </span>
                  </div>
                  <div
                    v-if="checkDynamicColumnClass(resumesection.column, 2) != 1"
                  >
                    <div
                      class="row sub-section"
                      v-for="(rowSkillSubSection, index) in groupedData(
                        getSkillSubSectionArray,
                        checkDynamicColumnClass(resumesection.column, 2)
                      )"
                      :key="index"
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        class="col-sm-12 mb-3"
                        :class="checkDynamicEduClass(resumesection.column, 1)"
                        v-for="(
                          skill_sub_section, skillsSubSecKey
                        ) in rowSkillSubSection.filter(
                          (sd) => sd.status == true
                        )"
                        :key="skillsSubSecKey"
                      >
                        <div class="mt-2">
                          <div
                            class="working_as_Desig text-decoration-none mb-0"
                            v-show="resumesection.hidden == 1"
                            style="font-weight: 600"
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;' +
                              'font-family:' +
                              font_family +
                              '!important;' +
                              'color:' +
                              resume.color.primaryy_color
                            "
                          >
                            {{
                              skill_sub_section.title ?? "Untitled SubSection"
                            }}
                          </div>
                          <div class="" v-show="resumesection.hidden == 1">
                            <span
                              class="working_as_Desig text-decoration-none mb-0"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;' +
                                'color:' +
                                resume.color.accent
                              "
                              >{{ skill_sub_section.content }}</span
                            >
                          </div>
                          <div>
                            <div
                              v-if="
                                skill_sub_section.list_style ==
                                'vertical_bullets'
                              "
                            >
                              <div v-show="resumesection.hidden == 1">
                                <div
                                  class="additional_information vertical_buttets"
                                  :style="
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '%;'
                                  "
                                >
                                  <ul
                                    style="margin-bottom: 0"
                                    v-for="(
                                      eduSubSectionContent, key
                                    ) in sortEducationArray(
                                      skill_sub_section.edu_sub_section_content
                                    ).filter((er) => er.status == 1)"
                                  >
                                    <li
                                      class="li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>

                                    <li
                                      class="li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        “{{
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                            <div
                              v-else-if="
                                skill_sub_section.list_style ==
                                'horizontal_bullets'
                              "
                            >
                              <div v-show="resumesection.hidden == 1">
                                <div
                                  class="additional_information d-flex skils-horizontal"
                                  style="margin-bottom: 0"
                                  :style="
                                    'font-family:' +
                                    font_family +
                                    '!important;' +
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '% ;'
                                  "
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
                                      class="li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>
                                    <li
                                      class="li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        “{{
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                            <div v-else>
                              <!-- sub section no bulites Skills -->
                              <div class="" v-show="resumesection.hidden == 1">
                                <div
                                  class="additional_information vertical_buttets"
                                  :style="
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '%;'
                                  "
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
                                      class="no-builets-test li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
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
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>

                                    <li
                                      class="no-builets-test li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
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
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <!-- sub section no bulites Skills -->

                              <!-- <div
                        v-for="(eduSubSectionContent, key) in sortEducationArray(
                          skill_sub_section.edu_sub_section_content
                        )"
                      >
                        <p v-if="eduSubSectionContent.type === 'skills'">
                          {{ eduSubSectionContent.subsection_content_able.name }}
                        </p>
                        <p
                          v-else-if="eduSubSectionContent.type === 'endorsement'"
                        >
                          “{{
                            eduSubSectionContent.subsection_content_able.value
                          }}”
                          <span
                            >–
                            {{
                              eduSubSectionContent.subsection_content_able.author
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
                        <p v-else v-show="getShowEducationEnhancement">
                          {{ eduSubSectionContent.subsection_content_able.value }}
                        </p>
                      </div> -->
                            </div>
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
                        :class="checkDynamicEduClass(resumesection.column, 1)"
                        v-for="(
                          skill_sub_section, skillsSubSecKey
                        ) in getSkillSubSectionArray.filter(
                          (sd) => sd.status == true
                        )"
                        :key="skillsSubSecKey"
                      >
                        <div class="mt-2">
                          <div
                            class="working_as_Desig text-decoration-none mb-0 sub-section"
                            v-show="resumesection.hidden == 1"
                            style="font-weight: 600"
                            :style="
                              'fontSize:' +
                              resume.body_font_size +
                              'px !important;' +
                              'font-family:' +
                              font_family +
                              '!important;' +
                              'color:' +
                              resume.color.primaryy_color
                            "
                          >
                            {{
                              skill_sub_section.title ?? "Untitled SubSection"
                            }}
                          </div>
                          <div
                            class="sub-section"
                            v-show="resumesection.hidden == 1"
                          >
                            <span
                              class="working_as_Desig text-decoration-none mb-0"
                              :style="
                                'fontSize:' +
                                resume.body_font_size +
                                'px !important;' +
                                'font-family:' +
                                font_family +
                                '!important;' +
                                'color:' +
                                resume.color.accent
                              "
                              >{{ skill_sub_section.content }}</span
                            >
                          </div>
                          <div>
                            <!-- horizontal_bullets -->
                            <div
                              v-if="
                                skill_sub_section.list_style ==
                                'vertical_bullets'
                              "
                            >
                              <div v-show="resumesection.hidden == 1">
                                <div
                                  class="additional_information vertical_buttets"
                                  :style="
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '%;'
                                  "
                                >
                                  <ul
                                    style="margin-bottom: 0"
                                    v-for="(
                                      eduSubSectionContent, key
                                    ) in sortEducationArray(
                                      skill_sub_section.edu_sub_section_content
                                    ).filter((er) => er.status == 1)"
                                  >
                                    <li
                                      class="sub-section li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>

                                    <li
                                      class="sub-section li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        “{{
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                      class="sub-section li-section-box"
                                      v-else
                                      v-show="getShowEducationEnhancement"
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <!-- horizontal_bullets -->
                            <div
                              v-else-if="
                                skill_sub_section.list_style ==
                                'horizontal_bullets'
                              "
                            >
                              <div
                                class="sub-section"
                                v-show="resumesection.hidden == 1"
                              >
                                <div
                                  class="additional_information d-flex skils-horizontal"
                                  style="margin-bottom: 0"
                                  :style="
                                    'font-family:' +
                                    font_family +
                                    '!important;' +
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '% ;'
                                  "
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
                                      class="li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>
                                    <li
                                      class="li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
                                      "
                                      :style="
                                        'fontSize:' +
                                        resume.body_font_size +
                                        'px !important;' +
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'color:' +
                                        resume.color.accent
                                      "
                                    >
                                      <div
                                        class="display-inline"
                                        :style="
                                          'fontSize:' +
                                          resume.body_font_size +
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        “{{
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                          'px !important;' +
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'color:' +
                                          resume.color.accent
                                        "
                                      >
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <!-- no bullet -->
                            <div v-else>
                              <!-- sub section no bulites Skills -->
                              <div
                                class="sub-section"
                                v-show="resumesection.hidden == 1"
                              >
                                <div
                                  class="additional_information vertical_buttets"
                                  :style="
                                    'text-indent:' +
                                    resume.indent_spacing +
                                    '%;'
                                  "
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
                                      class="no-builets-test sub-section li-section-box"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
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
                                        {{
                                          eduSubSectionContent
                                            .subsection_content_able.name
                                        }}
                                      </div>
                                    </li>

                                    <li
                                      class="no-builets-test sub-section li-section-box"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
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
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                      class="no-builets-test sub-section li-section-box"
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
                                          eduSubSectionContent
                                            .subsection_content_able.value
                                        }}
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <!-- sub section no bulites Skills -->

                              <!-- <div
                        v-for="(eduSubSectionContent, key) in sortEducationArray(
                          skill_sub_section.edu_sub_section_content
                        )"
                      >
                        <p v-if="eduSubSectionContent.type === 'skills'">
                          {{ eduSubSectionContent.subsection_content_able.name }}
                        </p>
                        <p
                          v-else-if="eduSubSectionContent.type === 'endorsement'"
                        >
                          “{{
                            eduSubSectionContent.subsection_content_able.value
                          }}”
                          <span
                            >–
                            {{
                              eduSubSectionContent.subsection_content_able.author
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
                        <p v-else v-show="getShowEducationEnhancement">
                          {{ eduSubSectionContent.subsection_content_able.value }}
                        </p>
                      </div> -->
                            </div>
                          </div>
                          <!-- end here -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Skill section end here  -->
                <!-- New section start here -->
                <div
                  v-if="resumesection.type == 'new-section'"
                  v-show="resumesection.hidden == 1"
                  class="work_experience_list"
                  style="border-bottom: 2px solid #d9d9d9"
                >
                  <div
                    class="heading-second sub-section"
                    v-show="resumesection.hidden == 1"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                  >
                    <p>{{ resumesection.title }}</p>
                  </div>
                  <div class="sub-section" v-show="resumesection.hidden == 1">
                    <span
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
                        resume.color.accent
                      "
                      style="font-size: 13px; color: #2c3e50"
                    >
                      {{ resumesection.content }}
                    </span>
                  </div>
                  <div class="section">
                    <div
                      v-if="
                        checkDynamicColumnClass(resumesection.column, 2) != 1
                      "
                    >
                      <div
                        class="row sub-section"
                        v-for="(rowNewSections, index) in groupedData(
                          resumesection.resume_sub_section,
                          checkDynamicColumnClass(resumesection.column, 2)
                        )"
                        :key="index"
                        v-show="resumesection.hidden == 1"
                      >
                        <div
                          class="col-sm-12 mb-3"
                          :class="checkDynamicEduClass(resumesection.column, 1)"
                          v-for="(
                            new_sub_section, index
                          ) in rowNewSections.filter((wa) => wa.status == true)"
                          v-bind:key="index"
                        >
                          <div>
                            <div>
                              <div class="" v-show="resumesection.hidden == 1">
                                <h5
                                  class="working_as_Desig mb-0"
                                  style="font-weight: 600"
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
                                    resume.color.primaryy_color +
                                    '!important'
                                  "
                                >
                                  {{
                                    new_sub_section.title ??
                                    "Untitled SubSection"
                                  }}
                                </h5>
                              </div>
                              <div class="" v-show="resumesection.hidden == 1">
                                <span
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;' +
                                    'font-family:' +
                                    font_family +
                                    '!important'
                                  "
                                  class="working_as_Desig mb-0 text-decoration-none"
                                  style="border-bottom: 0 !important"
                                  >{{ new_sub_section.content }}</span
                                >
                              </div>
                              <div>
                                <div
                                  v-if="
                                    new_sub_section.list_style ==
                                    'vertical_bullets'
                                  "
                                >
                                  <div
                                    class=""
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div class="mb-3">
                                      <div
                                        class="additional_information text-color-black-box"
                                        style="margin-bottom: 0"
                                      >
                                        <ul
                                          style="margin-bottom: 0"
                                          v-for="(
                                            eduSubSectionContent, key
                                          ) in sortEducationArray(
                                            new_sub_section.edu_sub_section_content
                                          )"
                                        >
                                          <li
                                            class="li-section-box"
                                            v-if="
                                              eduSubSectionContent.type ===
                                              'skills'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.name
                                              }}
                                            </div>
                                          </li>
                                          <li
                                            class="li-section-box"
                                            v-else-if="
                                              eduSubSectionContent.type ===
                                              'endorsement'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              “{{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .value
                                              }}”
                                              <span
                                                >–
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author
                                                }},
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author_description
                                                }},
                                                {{
                                                  getJobName(
                                                    eduSubSectionContent
                                                      .subsection_content_able
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
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.value
                                              }}
                                            </div>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div
                                  v-else-if="
                                    new_sub_section.list_style ==
                                    'horizontal_bullets'
                                  "
                                >
                                  <div
                                    class=""
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div class="mb-3">
                                      <div
                                        class="additional_information d-flex"
                                        style="margin-bottom: 0"
                                        :style="
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'text-indent:' +
                                          resume.indent_spacing +
                                          '% ;'
                                        "
                                      >
                                        <ul
                                          style="margin-bottom: 0"
                                          v-for="(
                                            eduSubSectionContent, key
                                          ) in sortEducationArray(
                                            new_sub_section.edu_sub_section_content
                                          )"
                                        >
                                          <li
                                            class="li-section-box"
                                            v-if="
                                              eduSubSectionContent.type ===
                                              'skills'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div class="display-inline">
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.name
                                              }}
                                            </div>
                                          </li>
                                          <li
                                            class="li-section-box"
                                            v-else-if="
                                              eduSubSectionContent.type ===
                                              'endorsement'
                                            "
                                          >
                                            <div class="display-inline">
                                              “{{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .value
                                              }}”
                                              <span
                                                >–
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author
                                                }},
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author_description
                                                }},
                                                {{
                                                  getJobName(
                                                    eduSubSectionContent
                                                      .subsection_content_able
                                                      .job_id
                                                  )
                                                }}
                                              </span>
                                            </div>
                                          </li>

                                          <li
                                            v-else
                                            v-show="getShowEducationEnhancement"
                                            class="li-section-box"
                                          >
                                            <div class="display-inline">
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.value
                                              }}
                                            </div>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div v-else>
                                  <!-- sub section no bulites new section -->
                                  <div
                                    class=""
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div
                                      class="additional_information vertical_buttets"
                                      :style="
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'text-indent:' +
                                        resume.indent_spacing +
                                        '% ;'
                                      "
                                    >
                                      <ul
                                        style="margin-bottom: 0"
                                        v-for="(
                                          eduSubSectionContent, key
                                        ) in sortEducationArray(
                                          new_sub_section.edu_sub_section_content
                                        )"
                                      >
                                        <li
                                          class="no-builets-test li-section-box"
                                          v-if="
                                            eduSubSectionContent.type ===
                                            'skills'
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
                                            {{
                                              eduSubSectionContent
                                                .subsection_content_able.name
                                            }}
                                          </div>
                                        </li>

                                        <li
                                          class="no-builets-test li-section-box"
                                          v-else-if="
                                            eduSubSectionContent.type ===
                                            'endorsement'
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
                                              eduSubSectionContent
                                                .subsection_content_able.value
                                            }}”
                                            <span
                                              >–
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .author
                                              }},
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .author_description
                                              }},
                                              {{
                                                getJobName(
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .job_id
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
                                              eduSubSectionContent
                                                .subsection_content_able.value
                                            }}
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                  <!-- sub section no bulites new section -->

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
                            <p v-else v-show="getShowEducationEnhancement">
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
                    <div v-else>
                      <div class="row">
                        <div
                          class="col-sm-12 mb-3"
                          :class="checkDynamicEduClass(resumesection.column, 1)"
                          v-for="(
                            new_sub_section, index
                          ) in resumesection.resume_sub_section.filter(
                            (wa) => wa.status == true
                          )"
                          v-bind:key="index"
                        >
                          <div>
                            <div>
                              <div
                                class="sub-section"
                                v-show="resumesection.hidden == 1"
                              >
                                <h5
                                  class="working_as_Desig mb-0"
                                  style="font-weight: 600"
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
                                    resume.color.primaryy_color +
                                    '!important'
                                  "
                                >
                                  {{
                                    new_sub_section.title ??
                                    "Untitled SubSection"
                                  }}
                                </h5>
                              </div>
                              <div
                                class="sub-section"
                                v-show="resumesection.hidden == 1"
                              >
                                <span
                                  :style="
                                    'fontSize:' +
                                    resume.body_font_size +
                                    'px !important;' +
                                    'font-family:' +
                                    font_family +
                                    '!important'
                                  "
                                  class="working_as_Desig mb-0 text-decoration-none"
                                  style="border-bottom: 0 !important"
                                  >{{ new_sub_section.content }}</span
                                >
                              </div>
                              <div>
                                <div
                                  v-if="
                                    new_sub_section.list_style ==
                                    'vertical_bullets'
                                  "
                                >
                                  <div
                                    class=""
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div class="mb-3">
                                      <div
                                        class="additional_information text-color-black-box"
                                        style="margin-bottom: 0"
                                      >
                                        <ul
                                          style="margin-bottom: 0"
                                          v-for="(
                                            eduSubSectionContent, key
                                          ) in sortEducationArray(
                                            new_sub_section.edu_sub_section_content
                                          )"
                                        >
                                          <li
                                            class="sub-section li-section-box"
                                            v-if="
                                              eduSubSectionContent.type ===
                                              'skills'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.name
                                              }}
                                            </div>
                                          </li>
                                          <li
                                            class="sub-section li-section-box"
                                            v-else-if="
                                              eduSubSectionContent.type ===
                                              'endorsement'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              “{{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .value
                                              }}”
                                              <span
                                                >–
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author
                                                }},
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author_description
                                                }},
                                                {{
                                                  getJobName(
                                                    eduSubSectionContent
                                                      .subsection_content_able
                                                      .job_id
                                                  )
                                                }}
                                              </span>
                                            </div>
                                          </li>

                                          <li
                                            class="sub-section li-section-box"
                                            v-else
                                            v-show="getShowEducationEnhancement"
                                          >
                                            <div
                                              class="display-inline"
                                              :style="
                                                'fontSize:' +
                                                resume.body_font_size +
                                                'px !important;' +
                                                'color:' +
                                                resume.color.accent
                                              "
                                            >
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.value
                                              }}
                                            </div>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div
                                  v-else-if="
                                    new_sub_section.list_style ==
                                    'horizontal_bullets'
                                  "
                                >
                                  <div
                                    class="sub-section"
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div class="mb-3">
                                      <div
                                        class="additional_information d-flex"
                                        style="margin-bottom: 0"
                                        :style="
                                          'font-family:' +
                                          font_family +
                                          '!important;' +
                                          'text-indent:' +
                                          resume.indent_spacing +
                                          '% ;'
                                        "
                                      >
                                        <ul
                                          style="margin-bottom: 0"
                                          v-for="(
                                            eduSubSectionContent, key
                                          ) in sortEducationArray(
                                            new_sub_section.edu_sub_section_content
                                          )"
                                        >
                                          <li
                                            class="li-section-box"
                                            v-if="
                                              eduSubSectionContent.type ===
                                              'skills'
                                            "
                                            :style="
                                              'fontSize:' +
                                              resume.body_font_size +
                                              'px !important;' +
                                              'font-family:' +
                                              font_family +
                                              '!important;' +
                                              'color:' +
                                              resume.color.accent
                                            "
                                          >
                                            <div class="display-inline">
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.name
                                              }}
                                            </div>
                                          </li>
                                          <li
                                            class="li-section-box"
                                            v-else-if="
                                              eduSubSectionContent.type ===
                                              'endorsement'
                                            "
                                          >
                                            <div class="display-inline">
                                              “{{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .value
                                              }}”
                                              <span
                                                >–
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author
                                                }},
                                                {{
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .author_description
                                                }},
                                                {{
                                                  getJobName(
                                                    eduSubSectionContent
                                                      .subsection_content_able
                                                      .job_id
                                                  )
                                                }}
                                              </span>
                                            </div>
                                          </li>

                                          <li
                                            v-else
                                            v-show="getShowEducationEnhancement"
                                            class="li-section-box"
                                          >
                                            <div class="display-inline">
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able.value
                                              }}
                                            </div>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div v-else>
                                  <!-- sub section no bulites new section -->
                                  <div
                                    class=""
                                    v-show="resumesection.hidden == 1"
                                  >
                                    <div
                                      class="additional_information vertical_buttets"
                                      :style="
                                        'font-family:' +
                                        font_family +
                                        '!important;' +
                                        'text-indent:' +
                                        resume.indent_spacing +
                                        '% ;'
                                      "
                                    >
                                      <ul
                                        style="margin-bottom: 0"
                                        v-for="(
                                          eduSubSectionContent, key
                                        ) in sortEducationArray(
                                          new_sub_section.edu_sub_section_content
                                        )"
                                      >
                                        <li
                                          class="no-builets-test sub-section li-section-box"
                                          v-if="
                                            eduSubSectionContent.type ===
                                            'skills'
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
                                            {{
                                              eduSubSectionContent
                                                .subsection_content_able.name
                                            }}
                                          </div>
                                        </li>

                                        <li
                                          class="no-builets-test sub-section li-section-box"
                                          v-else-if="
                                            eduSubSectionContent.type ===
                                            'endorsement'
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
                                              eduSubSectionContent
                                                .subsection_content_able.value
                                            }}”
                                            <span
                                              >–
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .author
                                              }},
                                              {{
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .author_description
                                              }},
                                              {{
                                                getJobName(
                                                  eduSubSectionContent
                                                    .subsection_content_able
                                                    .job_id
                                                )
                                              }}
                                            </span>
                                          </div>
                                        </li>

                                        <li
                                          class="no-builets-test sub-section li-section-box"
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
                                              eduSubSectionContent
                                                .subsection_content_able.value
                                            }}
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                  <!-- sub section no bulites new section -->

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
                            <p v-else v-show="getShowEducationEnhancement">
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
                <!-- new section end here -->
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
      pages: [],
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
      "getResumeAddress",
      "getResumeBuilderClasses",
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
    this.splitContentIntoPages();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
      this.handlerFunction();
    },
    downloadResume: function () {
      const margin_add = [10, 0, 10, 0];
      this.generatePDF(margin_add);
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
        this.splitContentIntoPages();
      });
    },
    splitContentIntoPages() {
      this.pages = [];
      var a4Height = 842; // A4 height in pixels
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
      console.log(this.pages, "this.pages");
    },
    splitContent(content, length) {
      var tempDiv = document.createElement("div");
      tempDiv.innerHTML = content;

      var clonedNodes = [];
      var remainingLength = length;

      while (tempDiv.firstChild && remainingLength > 0) {
        var childNode = tempDiv.firstChild;
        var clonedNode = childNode.cloneNode(true);

        var tempChildDiv = document.createElement("div");
        tempChildDiv.appendChild(clonedNode);

        if (tempChildDiv.offsetHeight <= remainingLength) {
          clonedNodes.push(clonedNode);
          remainingLength -= tempChildDiv.offsetHeight;
        } else {
          break;
        }

        tempDiv.removeChild(childNode);
      }

      return clonedNodes.map((node) => node.outerHTML).join("");
    },

    getRemainingContent: function (content, length) {
      // Create a temporary div element
      var tempDiv = document.createElement("div");
      // Set the HTML content of the div
      tempDiv.innerHTML = content;
      // Create a document fragment to hold the remaining nodes
      var remainingFragment = document.createDocumentFragment();
      // Variable to keep track of the remaining length
      var remainingLength = length;
      // Clone and append child nodes until the remaining length is exhausted
      while (tempDiv.firstChild && remainingLength > 0) {
        var childNode = tempDiv.firstChild;
        // Check if the child node is an element
        if (childNode.nodeType === 1) {
          // Calculate the height of the element
          var elementHeight = childNode.getBoundingClientRect().height;
          // If the element fits within the remaining length, clone and append it
          if (elementHeight <= remainingLength) {
            var nestedDiv = document.createElement("div");
            nestedDiv.appendChild(childNode.cloneNode(true));
            remainingFragment.appendChild(nestedDiv);
            remainingLength -= elementHeight;
          } else {
            // If the element is taller than the remaining length, break the loop
            break;
          }
        } else if (childNode.nodeType === 3) {
          // Text node, handle differently (you can adjust based on your needs)
          var textContent = childNode.nodeValue;
          if (textContent.length <= remainingLength) {
            remainingFragment.appendChild(childNode.cloneNode(true));
            remainingLength -= textContent.length;
          } else {
            break;
          }
        }

        // Remove the processed child node
        tempDiv.removeChild(childNode);
      }

      // console.log(remainingFragment.childNodes);
      // return remainingFragment.childNodes;
      // Flatten the array and return the remaining nodes as an array of HTML strings

      return remainingFragment.childNodes[0].innerHTML;

      // return Array.from(remainingFragment.childNodes)
      //   .map((node) => node.outerHTML.trim()) // Trim whitespace
      //   .flat();
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
      // this.resume_address = address;
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
    },
  },
};
</script>
<style scoped>
.sub-section {
  text-align: left;
}
@import url("https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Exo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
.fa-globe {
  content: "\f0e0";
  color: #c4e6de;
}

.resume-design-div.font-family-montrest {
  font-family: "Montserrat", sans-serif !important;
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
  /* min-width: 690px;
  max-width: 690px; */

  min-width: 8.27in !important;
  min-height: 11.69in !important;
  max-height: 100% !important;
  /* height: 100% !important; */
}

.main-container {
  border: none !important;
}

.main-heading {
  font-weight: bolder;
  font-size: 26px;
  font-family: "Montserrat", sans-serif;
}

.subHeading {
  margin-left: 30px;
  font-size: 10px;
}

.data-card {
  font-size: 10px;
  margin-top: 13px;
  margin-left: 20px;
  align-content: center;
}

h5.data-card.d-flex i {
  font-size: 16px !important;
  margin-top: 4px;
  margin-right: 5px !important;
}

.main-container {
  /* border: 2px solid red; */
  text-align: left;
  margin: -20px;
  /* font-family: Montserrat; */
  padding: 16px;
  padding-bottom: 0px;
}

.heading-second {
  font-weight: bolder;
  font-size: 14px;
  padding-top: 18px;
  /* margin-bottom: 10px; */
}

.sub-heading {
  text-decoration: none;
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
    /* margin-bottom: 7px; */
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
    /* margin-bottom: 5px; */
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

h5.data-card.d-flex i.mr-1.fa.fa-globe {
  color: #000000 !important;
}
.unorder-list ul li {
  word-break: break-all;
}

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

.work_experience_list {
  margin: 0 30px 0 30px !important;
  padding-bottom: 20px;
}

.broder-line-bottom {
  position: relative;
}

.broder-line-bottom:before {
  position: absolute;
  content: "";
  background-color: #d9d9d9;
  width: 100%;
  height: 2px;
  bottom: 0 !important;
}

li.no-builets-test {
  list-style: none;
}

.contact-bottom-line {
  position: relative;
  padding-bottom: 20px;
}
.contact-bottom-line:before {
  position: absolute;
  content: "";
  background-color: #d9d9d9 !important;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

@media (max-width: 450px) {
  h3.d-flex.w-100 {
    font-size: 10px;
  }

  .work-experience-dummy.work_experience_list .mb-2 {
    font-size: 5px;
  }

  .professional-summary-dummy.work_experience_list span,
  .work_experience_list span {
    font-size: 8px;
  }
}

.additional_information.d-flex.skils-horizontal ul {
  width: 50%;
  margin-top: 5px;
}

.unorder-list ul li {
  word-break: normal !important;
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

.border-line-bottom {
  border-bottom: 1px solid #afafaf;
  margin-bottom: 5px;
}

span.data-card.data-card-basic-text {
  margin-top: 0 !important;
  margin-left: 0 !important;
}
.display-inline {
  display: inline;
}
li.li-section-box {
  padding-left: 12px;
}
.hide-template-box {
  min-height: 0px !important;
  height: 0px !important;
  padding: 0 !important;
  overflow: hidden !important;
}

.sub-sub-sub-heading.text-decoration-none.border-line-bottom {
  display: inline;
}
</style>
