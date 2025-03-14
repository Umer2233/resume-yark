<template>
  <div>
    <div ref="htmlToConvert" class="mymain">
      <div v-for="card in finalContent" :key="card.id">
        <div v-html="card.innerHTML"></div>
      </div>
      <!-- <div v-for="(page, index) in pages" :key="index">
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
      </div> -->
    </div>

    <div
      ref="htmlToConver"
      class="resume-design-div get-height-box work_experience_lists padding-remove-template3 height-none"
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
        'in;'
      "
    >
      <div class="container padding-remove-template3">
        <div class="row wrap-remove section">
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
                  class="colorResume-main-heading sub-section side-bar-section"
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
                  class="-sub-headingData side-bar-section"
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
                  <div
                    class="mb-1 sub-section side-bar-section"
                    v-if="getContactSortedItemsFromState"
                  >
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
                          :style="
                            'color:' + resume.color.secondary + '!important'
                          "
                          class="pl-1"
                          style="word-break: break-all !important"
                          >{{ getContactDataByType(item.type) }}</span
                        >
                      </div>
                    </div>
                  </div>
                  <div v-else>
                    <div
                      class="mb-1 sub-section side-bar-section"
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
                      class="mb-1 sub-section side-bar-section"
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
                      class="mb-1 sub-section side-bar-section"
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
                      class="d-flex align-items-baseline sub-section side-bar-section"
                      style="margin-left: 2px"
                      v-if="getResumeAddress"
                      :style="'color:' + resume.color.accent + '!important;'"
                    >
                      <i
                        class="fal fa-map-marker-alt"
                        :style="
                          'color:' + resume.color.secondary + '!important;'
                        "
                        style="margin-right: 7px"
                      ></i>
                      <span>{{ getResumeAddress }}</span>
                    </div>

                    <div
                      class="sub-section side-bar-section"
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

              <div v-if="resumesection.type == 'education'">
                <div>
                  <div
                    class="colorResume-sub-heading sub-section side-bar-section"
                    v-show="resumesection.hidden == 1"
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
                    <p style="word-wrap: break-word">
                      {{ resumesection.title }}
                    </p>
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
                      class="colorResume-sub-heading pt-0 pb-3 sub-section side-bar-section"
                      :style="{
                        fontSize: resume.subheading_font_size + 'px',
                        color: resume.color.secondary + '!important',
                      }"
                      v-show="resumesection.hidden == 1"
                    >
                      <span
                        v-if="
                          showEducationDegree(education) == true &&
                          education.is_degree
                        "
                        v-show="resumesection.hidden == 1"
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
                        v-show="resumesection.hidden == 1"
                      >
                        - {{ education.major }}
                      </span>
                      <span
                        v-if="
                          education.minors.length > 0 &&
                          getShowEducationEnhancement
                        "
                        v-show="resumesection.hidden == 1"
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
                      </span>
                    </div>

                    <div
                      class="colorResume-sub-headingData pb-3 sub-section side-bar-section"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                      v-show="resumesection.hidden == 1"
                    >
                      <span
                        v-show="resumesection.hidden == 1"
                        v-if="education.is_degree"
                      >
                        <span
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;'
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
                        v-show="resumesection.hidden == 1"
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
                        v-show="resumesection.hidden == 1"
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
                        v-show="resumesection.hidden == 1"
                        v-if="
                          resume.resume_setting.is_edu_city_state &&
                          resume.resume_setting.is_edu_location
                        "
                        >{{ education.city }}, {{ education.state.state }}</span
                      >
                      <span
                        v-show="resumesection.hidden == 1"
                        v-if="!resume.resume_setting.is_edu_location"
                      ></span>
                    </div>

                    <div
                      v-if="education.is_grad_date"
                      class=""
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        v-show="resumesection.hidden == 1"
                        class="colorResume-sub-heading sub-section side-bar-section"
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
                        v-show="resumesection.hidden == 1"
                        class="colorResume-sub-heading sub-section side-bar-section"
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
                        class="colorResume-sub-heading sub-section side-bar-section"
                        v-show="resumesection.hidden == 1"
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
                        '% ;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                    >
                      <ul>
                        <li
                          class="sub-section side-bar-section li-section-box"
                          v-if="
                            education.is_overall_gpa &&
                            getShowEducationEnhancement
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;'
                          "
                          v-show="resumesection.hidden == 1"
                        >
                          <span class="display-inline">
                            <span v-if="education.gpa_format == 'full'">
                              GPA: {{ education.overallgpa }} out of 4.0
                            </span>
                            <span v-else>
                              GPA: {{ education.overallgpa }}
                            </span>
                          </span>
                        </li>

                        <li
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          v-if="
                            education.is_major_gpa &&
                            getShowEducationEnhancement
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;'
                          "
                        >
                          <span class="display-inline">
                            <span v-if="education.gpa_format == 'full'">
                              Major GPA: {{ education.majorgpa }} out of 4.0
                            </span>
                            <span v-else>
                              Major GPA: {{ education.majorgpa }}
                            </span>
                          </span>
                        </li>
                        <li
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          v-if="
                            education.is_credits_completed &&
                            education.credits_completed !== null &&
                            getShowEducationEnhancement
                          "
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;'
                          "
                        >
                          <span class="display-inline">
                            {{ education.credits_completed }} Credits Completed
                          </span>
                        </li>
                      </ul>
                    </div>
                    <!-- </div> -->
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
                        '% ;' +
                        'color:' +
                        resume.color.secondary +
                        '!important;'
                      "
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        v-for="(
                          eduSubSection, index
                        ) in getEduSubSectionArray.filter(
                          (el) => el.status == 1
                        )"
                        v-bind:key="index"
                      >
                        <div
                          class="mt-2 text-left"
                          :style="
                            'color:' + resume.color.secondary + '!important'
                          "
                        >
                          <div
                            class="sub-section side-bar-section"
                            :style="
                              'color:' + resume.color.secondary + '!important;'
                            "
                            v-show="resumesection.hidden == 1"
                          >
                            {{ eduSubSection.title ?? "Untitled SubSection" }}
                          </div>
                          <div
                            class="sub-section side-bar-section"
                            v-show="resumesection.hidden == 1"
                          >
                            <span>{{ eduSubSection.content }}</span>
                          </div>
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
                              v-show="resumesection.hidden == 1"
                            >
                              <li
                                class="sub-section side-bar-section li-section-box"
                                v-if="eduSubSectionContent.type === 'skills'"
                                v-show="resumesection.hidden == 1"
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
                                class="sub-section side-bar-section li-section-box"
                                v-show="resumesection.hidden == 1"
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
                                    }}</span
                                  >
                                </div>
                              </li>

                              <li
                                class="sub-section side-bar-section li-section-box"
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
                      </div>
                    </div>
                  </div>
                  <!-- edcation subsection end -->
                </div>
              </div>

              <div
                v-if="resumesection.type == 'skill'"
                v-show="resumesection.hidden == 1"
              >
                <div
                  class="colorResume-sub-heading sub-section side-bar-section"
                  v-show="resumesection.hidden == 1"
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
                  <p style="word-wrap: break-word">
                    {{ resumesection.title }}
                  </p>
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
                    resume.color.secondary +
                    '!important;'
                  "
                  class="sub-section side-bar-section"
                  v-show="resumesection.hidden == 1"
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
                      '% ;' +
                      'color:' +
                      resume.color.secondary +
                      '!important;'
                    "
                  >
                    <div
                      v-for="(
                        skill_sub_section, skillsSubSecKey
                      ) in getSkillSubSectionArray"
                      :key="skillsSubSecKey"
                    >
                      <div v-show="resumesection.hidden == 1">
                        <div
                          class="mt-2 text-left"
                          :style="
                            'color:' + resume.color.secondary + '!important'
                          "
                        >
                          <div
                            v-show="resumesection.hidden == 1"
                            class="sub-section side-bar-section"
                          >
                            {{
                              skill_sub_section.title ?? "Untitled SubSection"
                            }}
                          </div>
                          <span
                            class="sub-section side-bar-section"
                            v-show="resumesection.hidden == 1"
                            >{{ skill_sub_section.content }}
                          </span>
                          <div>
                            <div
                              class="additional_information vertical_buttets"
                              :style="
                                'color:' +
                                resume.color.secondary +
                                '!important;'
                              "
                            >
                              <ul
                                style="margin-bottom: 0"
                                v-for="(
                                  eduSubSectionContent, key
                                ) in sortEducationArray(
                                  skill_sub_section.edu_sub_section_content
                                ).filter((er) => er.status == 1)"
                                v-show="resumesection.hidden == 1"
                              >
                                <li
                                  class="sub-section li-section-box side-bar-section"
                                  v-if="eduSubSectionContent.type === 'skills'"
                                  v-show="resumesection.hidden == 1"
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
                                  class="sub-section li-section-box side-bar-section"
                                  v-else-if="
                                    eduSubSectionContent.type === 'endorsement'
                                  "
                                  v-show="resumesection.hidden == 1"
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
                                      }}</span
                                    >
                                  </div>
                                </li>
                                <li
                                  class="sub-section li-section-box side-bar-section"
                                  v-else
                                  v-show="
                                    getShowEducationEnhancement &&
                                    resumesection.hidden == 1
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
                                        .subsection_content_able.value
                                    }}
                                  </div>
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
                    v-show="resumesection.hidden == 1"
                  >
                    <span
                      v-for="(
                        endorse, key
                      ) in resumeStateData.user.endorsements.filter(
                        (wa) => wa.top_endorsment_status == true
                      )"
                      :key="key"
                    >
                      <div
                        class="sub-section"
                        v-show="resumesection.hidden == 1"
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
                            {{
                              endorse.job_id ? getJobName(endorse.job_id) : ""
                            }}
                            <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                          </div>
                        </div>
                      </div>
                    </span>
                  </div>
                  <div
                    v-if="resumeStateData.resume_setting.endorsement_type == 2"
                    class="sub-section"
                    v-show="resumesection.hidden == 1"
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
                  <div class="row" v-show="resumesection.hidden == 1">
                    <div
                      class="col-12 d-flex align-items-center sub-section pl-0"
                      v-show="resumesection.hidden == 1"
                    >
                      <div
                        v-show="resumesection.hidden == 1"
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
                        v-show="resumesection.hidden == 1"
                        style="height: 0px"
                        :style="
                          'border: 1px solid' +
                          getBarColor(resume.color) +
                          '!important'
                        "
                      ></div>
                    </div>

                    <div
                      class="col-12 sub-section pl-0"
                      v-show="resumesection.hidden == 1"
                    >
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
                    <div v-show="resumesection.hidden == 1">
                      <div
                        v-if="
                          pro_summ_subsection != null &&
                          pro_summ_subsection.status
                        "
                        :style="'color:' + resume.color.font + '!important;'"
                      >
                        <div
                          class="sub-section sub-heading work-heading-fontsize"
                          v-show="resumesection.hidden == 1"
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
                          class="sub-section d-block"
                          v-show="resumesection.hidden == 1"
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
                          :style="
                            'text-indent:' + resume.indent_spacing + '% ;'
                          "
                        >
                          <ul>
                            <li
                              class="sub-section li-section-box"
                              v-show="resumesection.hidden == 1"
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
                        class="d-flex align-items-center sub-section"
                        v-show="resumesection.hidden == 1"
                      >
                        <div
                          v-show="resumesection.hidden == 1"
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
                          v-show="resumesection.hidden == 1"
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
                  </div>
                  <div
                    v-for="(resumejob, i) in getJobArray.filter(
                      (ae) => ae.active == 1
                    )"
                    :key="i"
                    :style="'color:' + resume.color.font + '!important;'"
                  >
                    <div
                      class="sub-section sub-heading work-heading-fontsize"
                      v-show="resumesection.hidden == 1"
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
                          {{
                            resumejob.job ? getState(resumejob.job.state) : ""
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
                          - {{ resumejob.job ? resumejob.job.city : "" }},
                          {{
                            resumejob.job ? getState(resumejob.job.state) : ""
                          }}
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
                      class="sub-section d-flex justify-content-between sub-sub-heading"
                      v-show="resumesection.hidden == 1"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                    >
                      <div v-show="resumesection.hidden == 1">
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
                              resumejob.job
                                ? getState(resumejob.job.state)
                                : ""
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
                            {{
                              resumejob.job ? getState(resumejob.job.state) : ""
                            }}
                          </span>
                          <span v-if="resume.resume_setting.is_location"></span>
                        </span>
                      </div>

                      <div v-show="resumesection.hidden == 1">
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
                      class="sub-section mb-2"
                      v-show="resumesection.hidden == 1"
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
                        {{ getJobDescription(resumejob) }}
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
                          class="sub-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <span class="display-inline">
                            “{{ endorse.value }}”
                            <span
                              >– {{ endorse.author }},
                              {{ endorse.author_description }},

                              <!-- {{ endorse.jobs ? endorse.jobs.company : "" }} -->
                              {{
                                endorse.job_id ? getJobName(endorse.job_id) : ""
                              }}
                            </span>
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
                          class="sub-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          :style="
                            'fontSize:' +
                            resume.body_font_size +
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <span class="display-inline">
                            {{ experience.description }}</span
                          >
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
                        class="sub-section d-flex align-items-center"
                        v-show="resumesection.hidden == 1"
                      >
                        <div
                          v-show="resumesection.hidden == 1"
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
                          v-show="resumesection.hidden == 1"
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
                  </div>
                  <div style="height: 100%">
                    <div class="sub-section" v-show="resumesection.hidden == 1">
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
                    </div>
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
                              <div class="">
                                <span
                                  class="working_as_Desig sub-section"
                                  v-show="resumesection.hidden == 1"
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
                                    new_sub_section.title ??
                                    "Untitled SubSection"
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
                                  class="sub-section working_as_Desig"
                                  v-show="resumesection.hidden == 1"
                                  style="
                                    border-bottom: 0 !important;
                                    word-break: break-all !important;
                                  "
                                  >{{ new_sub_section.content }}</span
                                >
                              </div>
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
                                        class="sub-section li-section-box"
                                        v-show="resumesection.hidden == 1"
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
                                        class="sub-section li-section-box"
                                        v-show="resumesection.hidden == 1"
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
                                        class="sub-section li-section-box"
                                        v-else
                                        v-show="
                                          getShowEducationEnhancement &&
                                          resumesection.hidden == 1
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
                                        v-show="resumesection.hidden == 1"
                                        class="sub-section li-section-box"
                                        v-if="
                                          eduSubSectionContent.type === 'skills'
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
                                        v-show="resumesection.hidden == 1"
                                        class="sub-section li-section-box"
                                        v-else-if="
                                          eduSubSectionContent.type ===
                                          'endorsement'
                                        "
                                      >
                                        <span class="display-inline">
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
                                                  .subsection_content_able
                                                  .job_id
                                              )
                                            }}
                                          </span>
                                        </span>
                                      </li>

                                      <li
                                        class="sub-section li-section-box"
                                        v-else
                                        v-show="
                                          getShowEducationEnhancement &&
                                          resumesection.hidden == 1
                                        "
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
                                      v-show="resumesection.hidden == 1"
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
                                      v-show="resumesection.hidden == 1"
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
                                      v-show="
                                        getShowEducationEnhancement &&
                                        resumesection.hidden == 1
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
      numberOfPages: 0,
      finalContent: [],
      pages: [],
      sidebar: [],
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
      "getResumeAddress",
    ]),
    ...mapState({
      // arrow functions can make the code very succinct!
      resumeStateData: (state) => state.Two_Page_Resume,
    }),
  },
  mounted() {
    this.getAddress();
    this.getFontFamily();
    this.getJobDescriptionsForResume(this.resume.id);
    this.splitContentIntoPages();
  },
  watch: {
    resume: function () {
      this.getFontFamily();
      this.getAddress();
      this.handlerFunction();
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
    getState(state) {
      if (typeof state == "object" && state != null) {
        return state.state;
      } else {
        return state;
      }
    },
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
      this.sidebar = [];
      this.finalContent = [];
      var a4Height = 842; // A4 height in pixels
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
      var font_family = this.getFontFamily();
      var myMainDiv = document.querySelector(".mymain");
      myMainDiv.style.fontFamily = font_family;

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

        var dynamicColor = this.resume.color.primaryy_color; // You can change this color dynamically
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
.sub-section {
  text-align: left;
}
.contentheading {
  color: #209bce;
  font-size: 27px;
  font-weight: 600;
  position: relative;
}
.contentheading:after {
  position: absolute;
  content: "";
  width: 50%;
  height: 2px;
  right: 0;
  top: 17px;
  background-color: #209bce !important;
}
.sidebar-new {
  /* background-color: #209bce !important; */
  padding: 20px;
  margin-bottom: 10px;
  height: 1140px;
}
.main-new {
  background-color: white !important;
  padding: 20px;
  margin-bottom: 10px;
  height: 1140px;
}
</style>

<style scoped>
.card {
  /* padding: 25px 55px; */
  width: 842px;
  background-color: #ffffff;
  height: 1140px;
  margin: 0 auto;
  margin-bottom: 10px;
}

.contentheading {
  color: #209bce;
  font-size: 27px;
  font-weight: 600;
  position: relative;
}
.contentheading:after {
  position: absolute;
  content: "";
  width: 50%;
  height: 2px;
  right: 0;
  top: 17px;
  background-color: #209bce !important;
}

.main-new {
  padding: 20px;
  margin-bottom: 10px;
  height: 1140px;
}

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

.resume-design-div.get-height-box.work_experience_lists.padding-remove-template3.height-none {
  height: 0px !important;
  min-height: 0px !important;
  overflow: hidden !important;
}
.display-inline {
  display: inline;
}

li.li-section-box {
  padding-left: 12px;
}
</style>
