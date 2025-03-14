<template>
  <div>
    <div
      ref="htmlToConvert"
      class="resume-design-div get-height-box work_experience_lists padding-remove-template3"
      style="padding: 0%; text-align: left"
      :style="
        'font-family:' +
        font_family +
        '!important;letter-spacing:' +
        resume.body_text_spacing +
        '% ;' +
        'letter-spacing:' +
        resume.body_text_spacing +
        'px;' +
        'min-height:' +
        divHeight +
        'in !important;'
      "
    >
      <div class="container padding-remove-template3">
        <div class="row wrap-remove">
          <div
            class="col-lg-5 col-md-5 col-sm-4 left-container"
            :style="{
              'background-color': resume.color.primaryy_color + ' !important',
              'min-height': divHeight + 'in !important',
              'padding-top': (resume.top_bottom_margi / 10) * 96 + 'px',
              'padding-bottom': (resume.top_bottom_margi / 10) * 96 + 'px',
            }"
            style="
              background-color: #209bce;
              color: white;
              padding-left: 45px;
              min-height: 11.69in !important;
              max-height: 100in !important;
              <!-- word-break: break-all; -->
            "
          >
            <div
              :style="
                'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
              "
              class=""
              v-for="(resumesection, key) in sortMainSectionArray(
                resume.resume_sections
              )"
              :key="key"
            >
              <div
                :style="
                  'border-bottom: 2px solid' +
                  resume.color.accent +
                  '!important;'
                "
                style="
                  border-bottom: 2px solid #00b0fb;
                  padding-bottom: 8px;
                  word-break: break-all;
                "
                v-if="resumesection.type == 'contact'"
              >
                <div
                  class="colorResume-main-heading"
                  :style="
                    'fontFamily:' +
                    font_family +
                    '!important;' +
                    'color:' +
                    resume.color.secondary +
                    '!important;' +
                    'font-size:' +
                    resume.heading_font_size +
                    'px !important'
                  "
                >
                  {{ resume.user ? resume.user.first_name + "" : "" }}
                  <span v-if="resume.resume_setting.is_middle"
                    >{{ resume.user ? resume.user.middle_initial + "." : "" }}
                  </span>
                  <br />
                  {{ resume.user ? resume.user.last_name : "" }}
                </div>
                <div
                  class="-sub-headingData"
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
                  <div class="mb-1" v-if="getContactSortedItemsFromState">
                    <div
                      v-for="(
                        item, key
                      ) in getContactSortedItemsFromState.slice(0, 5)"
                      :key="key"
                      class="col-md-12 mb-2 contact_email"
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

                      <div
                        v-if="getContactDataByType(item.type)"
                        style="display: flex; align-items: baseline"
                      >
                        <i
                          class="mr-1"
                          :class="getContactIconClassByType(item)"
                          :style="
                            'color:' + resume.color.secondary + '!important'
                          "
                        ></i>
                        <span
                          class="pl-1"
                          style="word-break: break-all !important"
                          >{{ getContactDataByType(item.type) }}</span
                        >
                      </div>
                    </div>
                  </div>
                  <div v-else>
                    <div
                      class="mb-1"
                      v-if="resume.resume_setting.is_email"
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fa fa-envelope mr-1"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                      ></i
                      ><span style="word-break: break-all !important">{{
                        resume.user ? resume.user.email : ""
                      }}</span>
                    </div>

                    <div
                      class="mb-1"
                      v-if="resume.resume_setting.is_phone"
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fa fa-phone mr-1"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                      ></i>
                      {{ resume.user ? resume.user.phone : "" }}
                    </div>

                    <div
                      class="mb-1"
                      v-if="
                        resume.resume_setting.is_web &&
                        resume.user.website != null
                      "
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fal fa-globe mr-1"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                      ></i>
                      {{ resume.user ? resume.user.website : "" }}
                    </div>

                    <div
                      class="d-flex align-items-baseline"
                      style="margin-left: 2px"
                      v-if="resume_address"
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fal fa-map-marker-alt"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                        style="margin-right: 7px"
                      ></i>
                      <span>{{ resume_address }}</span>
                    </div>

                    <div
                      v-if="
                        resume.resume_setting.is_pro &&
                        resume.user.professional_profile != null
                      "
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fab fa-linkedin mr-1"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                        style="margin-left: 1px; margin-top: 8px"
                      ></i>
                      {{ resume.user ? resume.user.professional_profile : "" }}
                    </div>
                  </div>
                </div>
              </div>
              <div
                v-if="resumesection.type == 'education'"
                v-show="resumesection.hidden == 1"
              >
                <div
                  class="colorResume-sub-heading"
                  style="font-weight: 700"
                  :style="
                    'font-size:' +
                    resume.heading_font_size +
                    'px;' +
                    'font-family:' +
                    font_family +
                    '!important;' +
                    'color:' +
                    resume.color.secondary +
                    '!important;'
                  "
                >
                  <p style="word-wrap: break-word">{{ resumesection.title }}</p>
                </div>
                <div
                  v-for="(education, key) in sortEducationArray(
                    getEduArray
                  ).filter((ae) => ae.status == 1)"
                  :key="key"
                  :style="'color:' + resume.color.accent + '!important;'"
                >
                  <div
                    style="text-decoration: underline; font-size: 14px"
                    class="colorResume-sub-heading pt-0 pb-3"
                    :style="{
                      fontSize: resume.subheading_font_size + 'px',
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
                          :style="
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
                        education.minors.length > 0 &&
                        getShowEducationEnhancement
                      "
                    >
                      <span v-if="getActiveMinorLength(education.minors) > 0">
                        - Minor<span
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
                    class="colorResume-sub-headingData pb-3"
                    :style="
                      'fontSize:' + resume.body_font_size + 'px !important;'
                    "
                  >
                    <span v-if="education.is_degree">
                      <span
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                        v-if="
                          resume.education_emphasis == 'Degree' &&
                          education.school
                        "
                      >
                        {{ education.school }}
                      </span>
                    </span>

                    <span
                      v-if="resume.education_emphasis == 'School'"
                      :style="
                        'fontSize:' + resume.body_font_size + 'px !important;'
                      "
                    >
                      {{ getDegree(education.degree) }}
                    </span>
                    <span
                      :style="
                        'fontSize:' + resume.body_font_size + 'px !important;'
                      "
                      v-if="
                        resume.resume_setting.is_edu_city_state_country &&
                        resume.resume_setting.is_edu_location
                      "
                      >,{{ education.city }}, {{ education.state.state }},{{
                        education.country
                      }}</span
                    >
                    <span
                      :style="
                        'fontSize:' + resume.body_font_size + 'px !important;'
                      "
                      v-if="
                        resume.resume_setting.is_edu_city_state &&
                        resume.resume_setting.is_edu_location
                      "
                      >{{ education.city }}, {{ education.state.state }}</span
                    >
                    <span v-if="!resume.resume_setting.is_edu_location"></span>
                  </div>
                  <div v-if="education.is_grad_date">
                    <div
                      class="colorResume-sub-heading"
                      style="font-weight: 700"
                      :style="
                        'font-size:' +
                        resume.heading_font_size +
                        'px;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                      v-if="
                        resume.resume_setting.is_edu_month_year &&
                        resume.resume_setting.is_edu_dates
                      "
                    >
                      {{ education.grad_month }}/ {{ education.grad_year }}
                    </div>
                    <div
                      class="colorResume-sub-heading"
                      style="font-weight: 700"
                      :style="
                        'font-size:' +
                        resume.heading_font_size +
                        'px;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                      v-if="
                        resume.resume_setting.is_edu_year &&
                        resume.resume_setting.is_edu_dates
                      "
                    >
                      {{ education.grad_year }}
                    </div>
                    <div
                      class="colorResume-sub-heading"
                      style="font-weight: 700"
                      :style="
                        'font-size:' +
                        resume.heading_font_size +
                        'px;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                      v-if="!resume.resume_setting.is_edu_dates"
                    ></div>
                  </div>
                  <div
                    class="colorResume-sub-headingData"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'text-indent:' +
                      resume.indent_spacing +
                      '% ;'
                    "
                  >
                    <ul>
                      <li
                        v-if="
                          education.is_overall_gpa &&
                          getShowEducationEnhancement
                        "
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        <span v-if="education.gpa_format == 'full'">
                          GPA: {{ education.overallgpa }} out of 4.0
                        </span>
                        <span v-else> GPA: {{ education.overallgpa }} </span>
                      </li>

                      <li
                        v-if="
                          education.is_major_gpa && getShowEducationEnhancement
                        "
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        <span v-if="education.gpa_format == 'full'">
                          Major GPA: {{ education.majorgpa }} out of 4.0
                        </span>
                        <span v-else>
                          Major GPA: {{ education.majorgpa }}
                        </span>
                      </li>
                      <li
                        v-if="
                          education.is_credits_completed &&
                          education.credits_completed !== null &&
                          getShowEducationEnhancement
                        "
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
                      >
                        {{ education.credits_completed }} Credits Completed
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- education subsection -->
                <div
                  class="colorResume-sub-headingData"
                  :style="
                    'color:' +
                    resume.color.accent +
                    '!important;' +
                    'text-indent:' +
                    resume.indent_spacing +
                    '% ;'
                  "
                >
                  <div
                    class="colorResume-sub-headingData"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important' +
                      'text-indent:' +
                      resume.indent_spacing +
                      '% ;'
                    "
                  >
                    <div
                      v-for="(
                        eduSubSection, index
                      ) in getEduSubSectionArray.filter((el) => el.status == 1)"
                      v-bind:key="index"
                    >
                      <div class="mt-2">
                        <div
                          class=""
                          :style="
                            'color:' + resume.color.secondary + '!important;'
                          "
                        >
                          {{ eduSubSection.title ?? "Untitled SubSection" }}
                        </div>
                        <span>{{ eduSubSection.content }}</span>
                        <div>
                          <div class="additional_information vertical_buttets">
                            <ul
                              style="margin-bottom: 0"
                              v-for="(
                                eduSubSectionContent, key
                              ) in sortEducationArray(
                                eduSubSection.edu_sub_section_content
                              ).filter((er) => er.status == 1)"
                              :style="
                                'color:' + resume.color.accent + '!important;'
                              "
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
                        <!-- end here -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- edcation subsection end -->
              </div>
              <div
                v-if="resumesection.type == 'skill'"
                v-show="resumesection.hidden == 1"
              >
                <div
                  class="colorResume-sub-heading"
                  style="font-weight: 700"
                  :style="
                    'font-size:' +
                    resume.heading_font_size +
                    'px;' +
                    'font-family:' +
                    font_family +
                    '!important;' +
                    'color:' +
                    resume.color.secondary +
                    '!important;'
                  "
                >
                  <p style="word-wrap: break-word">{{ resumesection.title }}</p>
                </div>
                <div
                  :style="
                    ';font-size:' +
                    resume.subheading_font_size +
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
                  <p>{{ resumesection.content }}</p>
                </div>
                <div
                  class="colorResume-sub-headingData"
                  :style="
                    'color:' +
                    resume.color.accent +
                    '!important;' +
                    'font-family:' +
                    font_family +
                    '!important;' +
                    'font-size:' +
                    resume.heading_font_size +
                    'px;' +
                    'text-indent:' +
                    resume.indent_spacing +
                    '% ;'
                  "
                >
                  <div
                    class="colorResume-sub-headingData"
                    :style="
                      'fontSize:' +
                      resume.body_font_size +
                      'px !important;' +
                      'text-indent:' +
                      resume.indent_spacing +
                      '% ;'
                    "
                  >
                    <div
                      v-for="(
                        skill_sub_section, skillsSubSecKey
                      ) in getSkillSubSectionArray"
                      :key="skillsSubSecKey"
                    >
                      <div class="mt-2">
                        <div class="">
                          {{ skill_sub_section.title ?? "Untitled SubSection" }}
                        </div>
                        <span>{{ skill_sub_section.content }}</span>
                        <div>
                          <div
                            class="additional_information vertical_buttets"
                            :style="
                              'color:' + resume.color.accent + '!important;'
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

                        <!-- end here -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-lg-7 col-md-7 col-sm-8 right-container"
            style="word-break: break-all"
            :style="
              'padding-top:' +
              (resume.top_bottom_margi / 10) * 96 +
              'px' +
              ';padding-bottom:' +
              (resume.top_bottom_margi / 10) * 96 +
              'px'
            "
          >
            <div class="right-container-nav">
              <div
                v-for="(resumesection, key) in sortMainSectionArray(
                  resume.resume_sections
                )"
                :key="key"
                :style="
                  'margin-right:' + (resume.left_right_margin / 10) * 96 + 'px'
                "
                class=""
              >
                <div
                  v-if="resumesection.type === 'contact'"
                  v-show="resumesection.hidden == 1"
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
                      :key="key"
                    >
                      <div v-if="endorse.top_endorsment_status">
                        <div
                          class="colorResume-rightHeading"
                          :style="
                            'font-size:' +
                            resume.heading_font_size +
                            'px;' +
                            'font-family:' +
                            font_family +
                            ' !important;' +
                            'padding-bottom:' +
                            resume.heading_spacing +
                            'px;' +
                            'color:' +
                            (resume.color.swap
                              ? resume.color.secondary
                              : resume.color.primaryy_color) +
                            '!important;'
                          "
                          style="word-break: normal !important"
                        >
                          “{{ endorse.value }}”
                        </div>
                        <div
                          class="colorResume-r-h-2"
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
                          – {{ endorse.author }},
                          {{ endorse.author_description }},
                          {{ endorse.job_id ? getJobName(endorse.job_id) : "" }}
                          <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                        </div>
                      </div>
                    </span>
                  </div>
                  <div
                    v-if="resumeStateData.resume_setting.endorsement_type == 2"
                  >
                    <p
                      class="qualification_statement_para flex-control-resume-text"
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
                <div
                  v-if="
                    resumesection.type == 'professional-summary' &&
                    resume.type == 'functional'
                  "
                  v-show="resumesection.hidden == 1"
                  :style="
                    'margin-top:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px' +
                    ';margin-bottom:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px'
                  "
                >
                  <div class="row">
                    <div class="col-12 d-flex align-items-center">
                      <div
                        class="col-lg-7 col-md-7 col-sm-7 colorResume-rightHeading pl-0 mb-0"
                        :style="{
                          fontSize: resume.heading_font_size + 'px',
                          fontFamily: font_family + ' !important',
                          paddingBottom: resume.heading_spacing + 'px',
                          color: resume.color.swap
                            ? resume.color.secondary
                            : resume.color.primaryy_color + '!important',
                        }"
                      >
                        <p
                          :style="{
                            'font-family': font_family + ' !important',
                          }"
                        >
                          {{ resumesection.title }}
                        </p>
                      </div>
                      <br />

                      <div
                        class="col-lg-5 col-md-5 col-sm-5 border"
                        style="height: 0px"
                        :style="
                          'border: 1px solid' +
                          getBarColor(resume.color) +
                          '!important'
                        "
                      ></div>
                    </div>

                    <div class="col-12">
                      <p
                        :style="{
                          fontSize: resume.body_font_size + 'px',
                          fontFamily: font_family + ' !important',
                          paddingBottom: resume.heading_spacing + 'px',
                          color: resume.color.font + '!important',
                        }"
                      >
                        {{ resumesection.content }}
                      </p>
                    </div>
                  </div>
                  <div
                    v-for="(
                      pro_summ_subsection, i
                    ) in getProSummSubSectionArray"
                    :key="i"
                  >
                    <div
                      v-if="
                        pro_summ_subsection != null &&
                        pro_summ_subsection.status
                      "
                      :style="'color:' + resume.color.font + '!important;'"
                    >
                      <div
                        class="sub-heading work-heading-fontsize"
                        :style="
                          ';font-size:' +
                          resume.subheading_font_si +
                          'px' +
                          ';padding-top:' +
                          resume.subheading_spacin +
                          'px' +
                          ';padding-bottom:' +
                          resume.subheading_spacin +
                          'px'
                        "
                      >
                        <span>{{ pro_summ_subsection.title }}</span>
                      </div>
                      <span
                        :style="
                          'font-size:' +
                          resume.body_font_size +
                          'px;' +
                          'color:' +
                          resume.color.font +
                          '!important;'
                        "
                      >
                        {{ pro_summ_subsection.content }}
                      </span>

                      <div
                        class="unorder-list"
                        :style="'text-indent:' + resume.indent_spacing + '% ;'"
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
                            v-if="
                              pro_summ_subsection.resume_experience.length > 0
                            "
                            v-for="(
                              pro_sum_sub_res_experience, proSumSubSecKey
                            ) in pro_summ_subsection.resume_experience"
                            :key="proSumSubSecKey"
                          >
                            {{
                              pro_sum_sub_res_experience.experience
                                ? pro_sum_sub_res_experience.experience
                                    .description
                                : "no data"
                            }}
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  v-if="resumesection.type == 'work'"
                  v-show="resumesection.hidden == 1"
                  :style="
                    'margin-top:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px' +
                    ';margin-bottom:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px'
                  "
                >
                  <div class="row">
                    <div class="col-12 d-flex align-items-center">
                      <div
                        class="col-lg-7 col-md-7 col-sm-7 colorResume-rightHeading pl-0 mb-0"
                        :style="{
                          fontSize: resume.heading_font_size + 'px',
                          fontFamily: font_family + ' !important',
                          paddingBottom: resume.heading_spacing + 'px',
                          color: resume.color.swap
                            ? resume.color.secondary
                            : resume.color.primaryy_color + '!important',
                        }"
                      >
                        <p
                          :style="{
                            'font-family': font_family + ' !important',
                          }"
                        >
                          {{ resumesection.title }}
                        </p>
                      </div>
                      <div
                        class="col-lg-5 col-md-5 col-sm-5 border"
                        style="height: 0px"
                        :style="
                          'border: 1px solid' +
                          getBarColor(resume.color) +
                          '!important'
                        "
                      ></div>
                    </div>
                  </div>
                  <div
                    v-for="(resumejob, i) in getJobArray.filter(
                      (ae) => ae.active == 1
                    )"
                    :key="i"
                    :style="'color:' + resume.color.font + '!important;'"
                  >
                    <div
                      class="sub-heading work-heading-fontsize"
                      :style="
                        'font-size:' +
                        resume.subheading_font_size +
                        'px' +
                        ';padding-top:' +
                        resume.subheading_spacin +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px'
                      "
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
                      class="d-flex justify-content-between sub-sub-heading"
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
                          {{ resumejob.job ? resumejob.job.company : "" }},
                          <span
                            v-if="
                              resume.resume_setting.is_city_state_country &&
                              resume.resume_setting.is_location
                            "
                          >
                            {{ resumejob.job ? resumejob.job.city : "" }},
                            {{
                              resumejob.job ? resumejob.job.state.state : ""
                            }},
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
                            {{ resumejob.job ? resumejob.job.state.state : "" }}
                          </span>
                          <span v-if="resume.resume_setting.is_location"></span>
                        </span>
                      </div>
                      <div>
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
                      v-if="resume.resume_setting.is_job_description"
                      class="mb-2"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                    >
                      <p
                        style="word-break: normal !important"
                        :style="
                          'fontSize:' + resume.body_font_size + 'px !important;'
                        "
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
                    <div
                      class="unorder-list"
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
                            >– {{ endorse.author }},
                            {{ endorse.author_description }},

                            <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                            {{
                              endorse.job_id ? getJobName(endorse.job_id) : ""
                            }}
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
                <div
                  v-if="resumesection.type == 'new-section'"
                  v-show="resumesection.hidden == 1"
                  :style="
                    'margin-top:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px' +
                    ';margin-bottom:' +
                    (resume.top_bottom_margi / 10) * 96 +
                    'px'
                  "
                >
                  <div class="row">
                    <div class="col-12 d-flex align-items-center">
                      <div
                        class="col-lg-7 col-md-7 col-sm-7 colorResume-rightHeading pl-0 mb-0"
                        :style="{
                          fontSize: resume.heading_font_size + 'px',
                          fontFamily: font_family + ' !important',
                          paddingBottom: resume.heading_spacing + 'px',
                          color: resume.color.swap
                            ? resume.color.secondary
                            : resume.color.primaryy_color + '!important',
                        }"
                      >
                        <p
                          :style="{
                            fontFamily: font_family + ' !important',
                          }"
                        >
                          {{ resumesection.title }}
                        </p>
                      </div>
                      <div
                        class="col-lg-5 col-md-5 col-sm-5 border"
                        style="height: 0px"
                        :style="
                          'border: 1px solid' +
                          getBarColor(resume.color) +
                          '!important'
                        "
                      ></div>
                    </div>
                  </div>
                  <div style="height: 100%">
                    <span
                      :style="
                        ';font-size:' +
                        resume.body_font_size +
                        'px !important' +
                        ';padding-top:' +
                        resume.subheading_spacin +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px;' +
                        'color:' +
                        resume.color.font +
                        '!important;'
                      "
                      style="font-size: 13px; color: #2c3e50"
                    >
                      <p>{{ resumesection.content }}</p>
                    </span>

                    <div class="section">
                      <div class="row">
                        <div
                          class="col-sm-12 mb-3"
                          :class="checkDynamicEduClass(resumesection.column, 3)"
                          v-for="(
                            new_sub_section, index
                          ) in resumesection.resume_sub_section.filter(
                            (sd) => sd.status == true
                          )"
                          v-bind:key="index"
                        >
                          <div>
                            <div>
                              <span
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
                                  '!important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                                style="font-weight: 500"
                              >
                                {{
                                  new_sub_section.title ?? "Untitled SubSection"
                                }}
                              </span>
                              <span
                                :style="
                                  'fontSize:' +
                                  resume.body_font_size +
                                  'px !important;' +
                                  'font-family:' +
                                  font_family +
                                  '!important;'
                                "
                                class="working_as_Desig"
                                style="
                                  border-bottom: 0 !important;
                                  word-break: break-all !important;
                                "
                                >{{ new_sub_section.content }}</span
                              >
                              <div
                                v-if="
                                  new_sub_section.list_style ==
                                  'vertical_bullets'
                                "
                                :style="
                                  'text-indent:' +
                                  resume.indent_spacing +
                                  '%; font-size:' +
                                  resume.body_font_size +
                                  '!important;'
                                "
                              >
                                <div class="mb-3">
                                  <div
                                    class="unorder-list"
                                    :style="
                                      'text-indent:' +
                                      resume.indent_spacing +
                                      '% ;'
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
                                    >
                                      <li
                                        v-if="
                                          eduSubSectionContent.type === 'skills'
                                        "
                                      >
                                        <div
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
                                        v-else-if="
                                          eduSubSectionContent.type ===
                                          'endorsement'
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
                                            }}
                                            ,
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
                                      >
                                        <div
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
                              </div>

                              <div
                                v-else-if="
                                  new_sub_section.list_style ==
                                  'horizontal_bullets'
                                "
                              >
                                <div class="mb-3">
                                  <div
                                    class="additional_information d-flex"
                                    :style="
                                      'text-indent:' +
                                      resume.indent_spacing +
                                      '%; font-size:' +
                                      resume.body_font_size +
                                      '!important;'
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
                                    >
                                      <li
                                        v-if="
                                          eduSubSectionContent.type === 'skills'
                                        "
                                      >
                                        <div>
                                          {{
                                            eduSubSectionContent
                                              .subsection_content_able.name
                                          }}
                                        </div>
                                      </li>
                                      <li
                                        v-else-if="
                                          eduSubSectionContent.type ===
                                          'endorsement'
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
                                      </li>

                                      <li
                                        v-else
                                        v-show="getShowEducationEnhancement"
                                      >
                                        <div>
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
                                <!-- sub section no bulites new section -->
                                <div
                                  class="additional_information vertical_buttets"
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
                                      class="no-builets-test"
                                      v-if="
                                        eduSubSectionContent.type === 'skills'
                                      "
                                    >
                                      <div
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
                                      class="no-builets-test"
                                      v-else-if="
                                        eduSubSectionContent.type ===
                                        'endorsement'
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
                                          eduSubSectionContent
                                            .subsection_content_able.value
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
                                >
                                  <p
                                    v-if="
                                      eduSubSectionContent.type === 'skills'
                                    "
                                  >
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.name
                                    }}
                                  </p>
                                  <p
                                    v-if="
                                      eduSubSectionContent.type ===
                                      'endorsement'
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
                                  </p>
                                  <p
                                    v-else
                                    v-show="getShowEducationEnhancement"
                                  >
                                    {{
                                      eduSubSectionContent
                                        .subsection_content_able.value
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
  name: "SecondTemplate",
  mixins: [Common],

  data() {
    return {
      divHeight: 11.69,
      elementHeight: 0,
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
    this.getFontFamily();
    this.getJobDescriptionsForResume();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
    },

    downloadResume() {
      this.checkHeight();
      this.generatePDF();
      setTimeout(() => {
        this.divHeight = 11.69;
      }, 3000);
    },
  },

  methods: {
    // generatePDF() {
    //   // try {
    //   const element = this.$refs.htmlToConvert;
    //   const pdfOptions = {
    //     margin: 3,
    //     filename: this.resume.name + ".pdf",
    //     image: { type: "jpeg", quality: 0.98 },
    //     html2canvas: {
    //       dpi: 96,
    //       letterRendering: true,
    //     },
    //     pagebreak: {
    //       avoid: "p,h3,br,h1,h2,h4,h5,strong,span,ul,li,a",
    //     },

    //     jsPDF: {
    //       unit: "mm",
    //       format: "a4",
    //       orientation: "portrait",
    //     },
    //   };

    //   html2pdf()
    //     .from(element)
    //     .set(pdfOptions)
    //     .toPdf()
    //     .get("pdf")
    //     .then(function (pdf) {
    //       var totalPages = pdf.internal.getNumberOfPages();
    //       // pdf.internal.pageSize.getWidth() / 2.4;
    //       // console.log("hamza kahn");
    //       for (var i = 1; i <= totalPages; i++) {
    //         console.log("totalPages");
    //         // pdf.internal.pageSize.getWidth()/2.40
    //          pdf.text('This is the header text', (pdf.internal.pageSize.getWidth()/2.40), (pdf.internal.pageSize.getHeight()-8));
    //          pdf.text('Page ' + i + ' of ' + totalPages, (pdf.internal.pageSize.getWidth()/2.25), (pdf.internal.pageSize.getHeight() - 1));
    //         console.log( pdf,' pdf')
    //         }
    //       // pdf.save();
    //     })
    //     .save();
    //   //  for (i = 1; i <= totalPages; i++) {
    //   //     pdf.setPage(i);
    //   //     pdf.setFontSize(10);
    //   //     pdf.setTextColor(150);
    //   //     pdf.text(
    //   //       "This is the header text",
    //   //       pdf.internal.pageSize.getWidth() / 2.4,
    //   //       pdf.internal.pageSize.getHeight() - 8
    //   //     );
    //   //     pdf.text(
    //   //       "Page " + i + " of " + totalPages,
    //   //       pdf.internal.pageSize.getWidth() / 2.25
    //   //     ),
    //   //       pdf.internal.pageSize.getHeight() - 1;
    //   //   }
    //   // html2pdf(element, pdfOptions)
    //   //   .outputPdf()
    //   //   .then((pdf) => {

    //   //     const blob = new Blob([pdf], { type: "application/pdf" });
    //   //     const url = window.URL.createObjectURL(blob);
    //   //   }).save();

    //   // console.log("hamz akhan");
    //   // } catch (error) {
    //   //   console.error("Error generating PDF:", error);
    //   // }
    // },
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

      if (inches >= 11.7 && inches <= 20.0) {
        this.divHeight = 11.69 * 2;
      } else if (inches >= 20.1 && inches <= 33.73) {
        this.divHeight = 11.69 * 3;
      } else if (inches >= 33.74 && inches <= 50) {
        this.divHeight = 11.69 * 4;
      } else if (inches > 50) {
        this.divHeight = 11.69 * 5;
      } else {
        this.divHeight = 11.69;
      }
    },
    getBarColor(obj) {
      if (obj.primaryy_color == "#209BCE") {
        return obj.primaryy_color;
      } else {
        return obj.secondary;
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
  /* min-width: 690px;
  max-width: 690px; */
  /* height: 100% !important; */
  min-width: 8.27in !important;
  /* min-height: 11.69in !important; */
  /* max-height: 100% !important; */
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
  font-size: 10px;
  margin-top: 13px;
  margin-left: 20px;
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
  margin-bottom: 0 !important;
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
  margin-left: 20px;
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
  padding-right: 0;
  padding-top: 35px;
  padding-bottom: 20px;
  margin: 0%;
  padding-left: 30px;
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
    padding-left: 10px !important;
  }
  .right-container {
    /* font-family: Tai Heritage Pro, serif; */
    border-radius: 0px;
    padding-right: 25px;
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

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

li.no-builets-test {
  list-style: none;
}

.sub-heading {
  font-weight: 500;
}
/* #after2d {
  height: 100px;
  color: red;
  background-color: green;
}
#after1d {
  height: 100px;
  color: red;
  background-color: green;
} */
.beforeClass {
  /* margin-top: 40px !important; */
  /* margin-bottom: 20px !important; */
  /* height: 100px; */
  /* color: red !important; */
  /* background-color: green; */
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

.sub-heading.work-heading-fontsize {
  font-size: 14px;
  margin-bottom: 5px;
}

.col-md-12.mb-2.contact_email i {
  font-size: 14px !important;
}

@media (max-width: 450px) {
  .wrap-remove {
    flex-wrap: nowrap;
  }

  .unorder-list ul {
    padding-left: 15px;
  }

  .colorResume-sub-headingData ul {
    padding-left: 15px;
  }

  .additional_information.vertical_buttets ul {
    padding-left: 7px;
  }
  .padding-remove-template3 {
    padding: 0 !important;
  }
  .col-md-12.mb-2.contact_email {
    width: 100% !important;
  }
  .col-md-12.mb-2.contact_email span.pl-1 {
    font-size: 10px;
  }
  .col-md-12.mb-2.contact_email i {
    font-size: 10px !important;
  }
}
</style>
