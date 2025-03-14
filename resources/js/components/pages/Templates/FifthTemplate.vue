<template>
  <div>
    <div class="">
      <div ref="" class="mymain">
        <div v-for="(card, index) in finalContent" :key="`#card_${index}`">
          <div v-html="card.innerHTML"></div>
        </div>
      </div>
      <!-- -->
      <div
        ref="htmlToConvert"
        :class="getResumeBuilderClasses ? '' : 'hide-template-box'"
        class="resume-design-div work_experience_lists space-remove-tem5 section"
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
        <!-- vertical  bar .................................................................... -->
        <div class="container space-remove-tem5">
          <div class="first-section">
            <div class="row text-on-mobile">
              <div
                class="col-lg-12 col-md-12 col-sm-12 vertical-container"
                style="text-align: center; color: white"
                :style="
                  'background-color:' +
                  resume.color.primaryy_color +
                  '!important;' +
                  'padding-top:' +
                  (resume.top_bottom_margi / 10) * 96 +
                  'px'
                "
              >
                <div
                  class="temp_4-main-heading"
                  :style="{
                    fontSize: resume.heading_font_size + 'px',
                    fontFamily: font_family + '!important',
                  }"
                  style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                  "
                >
                  <span class="side-charecter-name" v-if="resume.user">{{
                    resume.user.first_name[0] + resume.user.last_name[0]
                  }}</span>
                  {{ resume.user ? resume.user.first_name + "" : "" }}
                  <span
                    style="margin: 0 0px 0 7px"
                    v-if="resume.resume_setting.is_middle"
                    >{{
                      resume.user ? resume.user.middle_initial + "." : ""
                    }}</span
                  >
                  <span style="font-weight: 400" class="ml-2">{{
                    resume.user ? resume.user.last_name : ""
                  }}</span>
                </div>

                <!-- top contact info area -->
                <div class="container">
                  <!-- <div class="row"> -->
                  <div
                    v-if="getContactSortedItemsFromState"
                    class="row justify-content-between head-contact-section align-items-start"
                    :style="'font-family:' + font_family + '!important;'"
                  >
                    <div
                      v-for="(
                        item, key
                      ) in getContactSortedItemsFromState.slice(0, 5)"
                      :key="`#mains${key}`"
                      class="widht-control-contact-section-top"
                      style="word-break: break-all"
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
                        style="display: flex; align-items: center"
                      >
                        <i
                          class="mr-1"
                          :class="getContactIconClassByType(item)"
                        ></i
                        ><span style="text-align: left">{{
                          getContactDataByType(item.type)
                        }}</span>
                      </div>
                    </div>
                  </div>

                  <div v-else class="ppppppppppppp">
                    <div
                      class="d-flex justify-content-between temp_4-sub-headingData"
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
                        v-if="resume.resume_setting.is_phone"
                        :style="'color:' + resume.color.secondary"
                      >
                        <i class="fa fa-phone mr-1"></i>
                        {{ resume.user ? resume.user.phone : "" }}
                      </div>
                      <div
                        v-if="
                          resume.resume_setting.is_web &&
                          resume.user.website != null
                        "
                        :style="'color:' + resume.color.secondary"
                      >
                        <i
                          class="fa fa-globe mr-1"
                          :style="'color:' + resume.color.secondary"
                        ></i>
                        {{ resume.user ? resume.user.website : "" }}
                      </div>
                      <div v-if="resume.resume_setting.is_email">
                        <i class="far fa-envelope mr-1"></i
                        >{{ resume.user ? resume.user.email : "" }}
                      </div>
                    </div>

                    <div
                      class="d-flex justify-content-between temp_4-sub-headingData"
                      style="margin-bottom: 25px"
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
                        v-if="getResumeAddress"
                        :style="'color:' + resume.color.secondary"
                      >
                        <i class="far fa-map-marker-alt mr-1"></i>
                        {{ getResumeAddress }}
                      </div>
                      <div
                        v-if="
                          resume.resume_setting.is_pro &&
                          resume.user.professional_profile != null
                        "
                        :style="'color:' + resume.color.secondary"
                      >
                        <i class="fab fa-linkedin mr-1"></i>
                        {{
                          resume.user ? resume.user.professional_profile : ""
                        }}
                      </div>
                    </div>
                  </div>
                  <!-- </div> -->
                </div>
                <!-- top contact info area -->
              </div>
            </div>
          </div>
          <!-- left bar .................................................................................. -->
          <div class="row flex-wrap-temp5">
            <div
              class="col-lg-4 col-md-4 col-sm-4 temp_4-left-container"
              style="
                background-color: #f1f1f1;
                color: #7f7f7f;
                padding-left: 30px;
              "
              :style="
                'font-family:' +
                font_family +
                '!important;' +
                'background-color:' +
                resume.color.accent +
                '!important; min-height:' +
                divHeight +
                'in !important;' +
                'padding-bottom:' +
                (resume.top_bottom_margi / 10) * 96 +
                'px'
              "
            >
              <div
                class=""
                v-for="(resumesection, key) in sortMainSectionArray(
                  resume.resume_sections
                )"
                :key="`#maiddns${key}`"
                :style="
                  'margin-left:' + (resume.left_right_margin / 10) * 96 + 'px'
                "
              >
                <div style="padding-bottom: 5px"></div>
                <!--  -->
                <div
                  v-if="resumesection.type == 'education'"
                  v-show="resumesection.hidden == 1"
                >
                  <div
                    class="temp_4-sub-heading pt-0 sub-section side-bar-section pt-4"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                    style="font-weight: 700"
                    v-show="resumesection.hidden == 1"
                  >
                    {{ resumesection.title }}
                  </div>
                  <div
                    v-for="(education, key) in sortEducationArray(
                      getEduArray
                    ).filter((ae) => ae.status == 1)"
                    :key="`#dmains${key}`"
                    :style="'color:' + resume.color.font"
                  >
                    <div
                      style="font-weight: 500; margin-top: -15px"
                      class="temp_4-sub-heading sub-section side-bar-section underline-text"
                      v-show="resumesection.hidden == 1"
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
                        '!important;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                    >
                      <span
                        class="remove-underline-box"
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
                            v-if="
                              education.is_major_field_study && education.major
                            "
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
                          education.minors.length > 0 &&
                          getShowEducationEnhancement
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
                      class="temp_4-sub-headingData sub-section side-bar-section"
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'text-indent:' +
                        resume.indent_spacing +
                        '% ;'
                      "
                      v-show="resumesection.hidden == 1"
                    >
                      <span v-if="education.is_degree">
                        <span
                          v-if="
                            resume.education_emphasis == 'Degree' &&
                            education.school
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
                        }}
                      </span>

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
                    </div>

                    <div v-if="education.is_grad_date">
                      <div
                        class="temp_4-sub-heading sub-section side-bar-section"
                        style="font-weight: 700; padding-top: 0 !important"
                        :style="{
                          'font-size': resume.body_font_size + 'px !important',
                          'font-family': font_family + ' !important',
                          color: resume.color.primaryy_color,
                        }"
                        v-if="
                          resume.resume_setting.is_edu_month_year &&
                          resume.resume_setting.is_edu_dates
                        "
                        v-show="resumesection.hidden == 1"
                      >
                        {{ education.grad_month }}/ {{ education.grad_year }}
                      </div>
                      <div
                        class="temp_4-sub-heading sub-section side-bar-section"
                        style="font-weight: 500"
                        v-if="
                          resume.resume_setting.is_edu_year &&
                          resume.resume_setting.is_edu_dates
                        "
                        v-show="resumesection.hidden == 1"
                      >
                        {{ education.grad_year }}
                      </div>
                      <div
                        class="temp_4-sub-heading sub-section side-bar-section"
                        style="font-weight: 500"
                        v-if="!resume.resume_setting.is_edu_dates"
                        v-show="resumesection.hidden == 1"
                      ></div>
                    </div>
                    <div
                      class="temp_4-sub-headingData"
                      :style="'text-indent:' + resume.indent_spacing + '% ;'"
                      v-show="resumesection.hidden == 1"
                    >
                      <!-- GPA List Item -->
                      <ul class="mb-0">
                        <li
                          class="sub-section side-bar-section li-section-box font-13-text"
                          v-show="resumesection.hidden == 1"
                          v-if="
                            education.is_overall_gpa &&
                            getShowEducationEnhancement
                          "
                          :style="{
                            'font-size':
                              resume.body_font_size + 'px !important',
                            'font-family': font_family + ' !important',
                          }"
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
                          class="sub-section side-bar-section li-section-box font-13-text"
                          v-show="resumesection.hidden == 1"
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
                            '!important;'
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
                            'px !important;' +
                            'font-family:' +
                            font_family +
                            '!important;'
                          "
                        >
                          <span class="display-inline">
                            {{ education.credits_completed }} Credits Completed
                          </span>
                        </li>
                      </ul>
                      <!-- GPA List Item -->
                    </div>
                  </div>
                  <div
                    v-for="(
                      eduSubSection, index
                    ) in getEduSubSectionArray.filter((el) => el.status == 1)"
                    v-bind:key="index"
                  >
                    <h5
                      class="working_as_Desig mb-0 sub-section side-bar-section"
                      v-show="resumesection.hidden == 1"
                      style="
                        font-weight: 600;
                        text-decoration: underline !important;
                        text-underline-offset: 1px !important;
                        padding-bottom: 2px;
                      "
                      :style="'font-family:' + font_family + '!important;'"
                    >
                      {{ eduSubSection.title }}
                    </h5>
                    <p
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font +
                        '; !important'
                      "
                      v-if="eduSubSection.content"
                      class="working_as_Desig mt-0 mb-0 sub-section side-bar-section"
                      style="text-decoration: none !important"
                      v-show="resumesection.hidden == 1"
                    >
                      {{ eduSubSection.content }}
                    </p>
                    <div
                      class="additional_information vertical_buttets"
                      :style="
                        'text-indent:' +
                        resume.indent_spacing +
                        '% ;' +
                        'color:' +
                        resume.color.font +
                        ';'
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
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          v-if="eduSubSectionContent.type === 'skills'"
                          :style="
                            'fontSize:' + resume.body_font_size + '!important'
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
                              '!important;'
                            "
                          >
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </div>
                        </li>
                        <li
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          v-else
                          :style="
                            'fontSize:' + resume.body_font_size + '!important;'
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
                              '!important;'
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
                              }}</span
                            >
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--  -->
                <div
                  v-if="resumesection.type == 'skill'"
                  v-show="resumesection.hidden == 1"
                >
                  <div
                    class="temp_4-sub-heading sub-section side-bar-section"
                    v-show="resumesection.hidden == 1"
                    :style="{
                      fontSize: resume.heading_font_size + 'px',
                      fontFamily: font_family + ' !important',
                      paddingBottom: resume.heading_spacing + 'px',
                      color: resume.color.primaryy_color,
                    }"
                    style="font-weight: 700; word-wrap: break-word"
                  >
                    <span> {{ resumesection.title }}</span>
                  </div>
                  <div
                    class="sub-section side-bar-section"
                    v-show="resumesection.hidden == 1"
                    :style="
                      ';font-size:' +
                      resume.subheading_font_s +
                      'px' +
                      ';padding-bottom:' +
                      resume.subheading_spacin +
                      'px;' +
                      'color:' +
                      resume.color.font
                    "
                  >
                    <span
                      :style="'font-family:' + font_family + '!important;'"
                      >{{ resumesection.content }}</span
                    >
                  </div>

                  <div
                    v-for="(
                      skill_sub_section, skillsSubSecKey
                    ) in getSkillSubSectionArray"
                    :key="skillsSubSecKey"
                    :style="'color:' + resume.color.font"
                  >
                    <h5
                      :style="
                        ';font-size:' +
                        resume.subheading_font_s +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px;' +
                        'font-family:' +
                        font_family +
                        '!important;'
                      "
                      class="working_as_Desig pt-2 m-0 sub-section side-bar-section"
                      style="
                        font-weight: 600;
                        text-decoration: underline !important;
                        text-underline-offset: 1px !important;
                        padding-bottom: 2px;
                      "
                      v-show="resumesection.hidden == 1"
                    >
                      {{ skill_sub_section.title ?? "Untitled SubSection" }}
                    </h5>
                    <p
                      :style="
                        ';font-size:' +
                        resume.subheading_font_s +
                        'px' +
                        ';padding-bottom:' +
                        resume.subheading_spacin +
                        'px;' +
                        'color:' +
                        resume.color.font +
                        ';'
                      "
                      class="working_as_Desig mt-0 mb-0 sub-section side-bar-section"
                      v-show="resumesection.hidden == 1"
                      style="text-decoration: none !important"
                    >
                      {{ skill_sub_section.content }}
                    </p>
                    <div
                      class="temp_4-sub-headingData"
                      :style="'text-indent:' + resume.indent_spacing + '% ;'"
                      v-show="resumesection.hidden == 1"
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
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
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
                            {{
                              eduSubSectionContent.subsection_content_able.name
                            }}
                          </div>
                        </li>

                        <li
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
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
                          class="sub-section side-bar-section li-section-box"
                          v-show="resumesection.hidden == 1"
                          v-else
                          :style="
                            'fontSize:' + resume.body_font_size + '!important;'
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
                              '!important;'
                            "
                          >
                            {{
                              eduSubSectionContent.subsection_content_able.value
                            }}
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
                              }}</span
                            >
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Right bar .................................................................... -->
            <div
              class="col-lg-8 col-md-8 col-sm-8 temp_4-right-container"
              style="color: #7f7f7f; word-break: break-all"
              :style="
                'padding-bottom:' + (resume.top_bottom_margi / 10) * 96 + 'px'
              "
            >
              <div>
                <div v-show="showHideContent.headline" class="sub-section">
                  <div
                    class="border-line-bottom"
                    v-if="resumeStateData.resume_setting.endorsement_type == 1"
                    :style="
                      'margin-top:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-bottom:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-right:' +
                      (resume.left_right_margin / 10) * 96 +
                      'px'
                    "
                  >
                    <span
                      v-for="(
                        endorse, key
                      ) in resumeStateData.user.endorsements.filter(
                        (wa) => wa.top_endorsment_status == true
                      )"
                      :key="`#madins${key}`"
                      class="border-bottom-line"
                      style="word-break: break-word !important"
                    >
                      <div
                        class="temp_4-rightHeading"
                        :style="{
                          fontSize: resume.heading_font_size + 'px',
                          fontFamily: font_family + ' !important',
                          paddingBottom: resume.heading_spacing + 'px',
                          color: resume.color.primaryy_color,
                        }"
                        style="word-wrap: break-word"
                      >
                        “{{ endorse.value }}”
                      </div>
                      <div
                        class="temp_4-r-h-2"
                        style="padding-bottom: 9px; margin-bottom: 0px"
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.font
                        "
                      >
                        <span>– {{ endorse.author }},</span>
                        <span>{{ endorse.author_description }},</span>
                        <!-- {{
                          endorse.jobs ? endorse.jobs.company : ""
                        }} -->
                        <span>{{
                          endorse.job_id ? getJobName(endorse.job_id) : ""
                        }}</span>
                      </div>
                    </span>
                  </div>

                  <div
                    class="border-line-bottom"
                    v-if="resumeStateData.resume_setting.endorsement_type == 2"
                    :style="
                      'margin-top:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-bottom:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-right:' +
                      (resume.left_right_margin / 10) * 96 +
                      'px'
                    "
                  >
                    <div>
                      <p>
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
                <div
                  v-for="(resumesection, key) in sortMainSectionArray(
                    resumeStateData.resume_sections
                  )"
                  :key="`#hello_hi${key}`"
                  class=""
                >
                  <!-- professional summary start here -->
                  <div
                    class="border-line-bottom"
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
                      'px' +
                      ';margin-right:' +
                      (resume.left_right_margin / 10) * 96 +
                      'px'
                    "
                  >
                    <div
                      class="temp_4-rightHeading sub-section"
                      :style="{
                        fontSize: resume.heading_font_size + 'px',
                        fontFamily: font_family + ' !important',
                        paddingBottom: resume.heading_spacing + 'px',
                        color: resume.color.primaryy_color,
                      }"
                      v-show="resumesection.hidden == 1"
                    >
                      {{ resumesection.title }}
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
                        resume.color.font
                      "
                      class="sub-section"
                      v-show="resumesection.hidden == 1"
                    >
                      {{ resumesection.content }}
                    </div>

                    <div
                      v-if="getProSummSubSectionArray.length > 0"
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
                      >
                        <div
                          class="working_as_Desig pl-0 pt-2 mb-0 sub-section"
                          v-show="resumesection.hidden == 1"
                          style="
                            font-weight: 600;
                            text-decoration: none !important;
                          "
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
                            resume.color.primaryy_color
                          "
                        >
                          <p
                            :style="
                              'font-family:' + font_family + '!important;'
                            "
                          >
                            {{ pro_summ_subsection.title }}
                          </p>
                        </div>

                        <div
                          class="sub-section underline-text"
                          :style="'color:' + resume.color.font + ';'"
                          v-show="resumesection.hidden == 1"
                        >
                          <p
                            :style="
                              'font-family:' + font_family + '!important;'
                            "
                          >
                            {{ pro_summ_subsection.content }}
                          </p>
                        </div>
                        <div
                          class="unorder-list"
                          :style="
                            'color:' +
                            resume.color.font +
                            ';' +
                            'text-indent:' +
                            resume.indent_spacing +
                            '% ;'
                          "
                        >
                          <ul
                            v-for="(
                              pro_sum_sub_res_experience, proSumSubSecKey
                            ) in pro_summ_subsection.resume_experience"
                            :key="proSumSubSecKey"
                          >
                            <li
                              v-if="
                                pro_summ_subsection.resume_experience.length > 0
                              "
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
                  <!-- professional summary end here -->

                  <!-- work section start here -->
                  <div
                    class="border-line-bottom"
                    :style="
                      'margin-top:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-bottom:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-right:' +
                      (resume.left_right_margin / 10) * 96 +
                      'px'
                    "
                    v-if="resumesection.type == 'work'"
                    v-show="resumesection.hidden == 1"
                  >
                    <div
                      class="temp_4-rightHeading sub-section"
                      v-show="resumesection.hidden == 1"
                      :style="{
                        fontSize: resume.heading_font_size + 'px',
                        fontFamily: font_family + ' !important',
                        paddingBottom: resume.heading_spacing + 'px',
                        color: resume.color.primaryy_color,
                      }"
                    >
                      {{ resumesection.title }}
                    </div>
                    <div
                      v-for="(resumejob, i) in getJobArray.filter(
                        (ae) => ae.active == 1
                      )"
                      :key="`#mainsa${i}`"
                      :style="'color:' + resume.color.font"
                    >
                      <div
                        class="sub-heading mb-2 sub-section"
                        v-show="resumesection.hidden == 1"
                        style="font-weight: 500"
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
                          '!important;' +
                          'font-family:' +
                          font_family +
                          '!important;'
                        "
                      >
                        <!-- emphasis effect start -->
                        <span
                          v-show="resumesection.hidden == 1"
                          v-if="resume.employment_emphasis == 'Employer'"
                        >
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
                        <span v-show="resumesection.hidden == 1" v-else>
                          <b>
                            {{ resumejob.job ? resumejob.job.company : "" }}</b
                          >
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
                        <!-- emphasis effect end -->
                      </div>

                      <div
                        class="d-flex justify-content-between sub-sub-heading sub-section"
                        v-show="resumesection.hidden == 1"
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.font
                        "
                      >
                        <div v-show="resumesection.hidden == 1">
                          <!-- KGP Logistics-TEKsystems, New Century, KS -->

                          <span
                            v-if="resume.employment_emphasis == 'Employer'"
                            class=""
                          >
                            {{ resumejob.job ? resumejob.job.company : "" }}
                            <span
                              v-if="
                                resume.resume_setting.is_city_state_country &&
                                resume.resume_setting.is_location
                              "
                            >
                              - {{ resumejob.job ? resumejob.job.city : "" }},

                              {{ resumejob.job ? getState(resumejob.job) : "" }}
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
                            <span
                              v-if="resume.resume_setting.is_location"
                            ></span>
                          </span>
                          <span v-else class="">
                            {{
                              resumejob.job
                                ? resumejob.job.position
                                  ? resumejob.job.position.pos_name
                                  : ""
                                : ""
                            }}
                          </span>
                        </div>

                        <div v-show="resumesection.hidden == 1">
                          <span
                            class=""
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
                          </span>
                          <span
                            class=""
                            v-if="!resume.resume_setting.is_dates"
                          ></span>
                        </div>
                      </div>

                      <div
                        class="sub-section"
                        v-show="resumesection.hidden == 1"
                        v-if="resume.resume_setting.is_job_description"
                        :style="
                          'fontSize:' +
                          resume.body_font_size +
                          'px !important;' +
                          'font-family:' +
                          font_family +
                          '!important;' +
                          'color:' +
                          resume.color.font
                        "
                        style="font-size: 12px; margin-bottom: 10px"
                      >
                        <p>{{ getJobDescription(resumejob) }}</p>
                      </div>
                      <div
                        class="unorder-list"
                        :style="
                          'color:' +
                          resume.color.font +
                          ';' +
                          'text-indent:' +
                          resume.indent_spacing +
                          '% ;'
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
                              <span style="font-family: sans-serif"
                                >– {{ endorse.author }},
                                {{ endorse.author_description }},
                                {{
                                  endorse.job_id
                                    ? getJobName(endorse.job_id)
                                    : ""
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
                              'px !important;'
                            "
                          >
                            <span class="display-inline">
                              {{ experience.description }}
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- work section end here -->
                  <!-- neew section start here -->
                  <div
                    class="border-line-bottom"
                    v-if="resumesection.type == 'new-section'"
                    v-show="resumesection.hidden == 1"
                    :style="
                      'margin-top:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-bottom:' +
                      (resume.top_bottom_margi / 10) * 96 +
                      'px' +
                      ';margin-right:' +
                      (resume.left_right_margin / 10) * 96 +
                      'px'
                    "
                  >
                    <div
                      class="temp_4-rightHeading sub-section"
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
                      :style="
                        'fontSize:' +
                        resume.body_font_size +
                        'px !important;' +
                        'font-family:' +
                        font_family +
                        '!important;' +
                        'color:' +
                        resume.color.font
                      "
                      class="sub-section"
                      v-show="resumesection.hidden == 1"
                    >
                      <p
                        :style="{
                          fontSize:
                            resume.body_font_size + 'px' + ' !important',
                        }"
                      >
                        {{ resumesection.content }}
                      </p>
                    </div>
                    <div
                      v-if="
                        checkDynamicColumnClass(resumesection.column, 5) != 1
                      "
                    >
                      <div
                        class="row sub-section"
                        v-for="(rowNewSections, index) in groupedData(
                          resumesection.resume_sub_section,
                          checkDynamicColumnClass(resumesection.column, 5)
                        )"
                        :key="index"
                        v-show="resumesection.hidden == 1"
                      >
                        <div
                          class="col-sm-12 mb-3"
                          :class="checkDynamicEduClass(resumesection.column, 5)"
                          v-for="(
                            new_sub_section, index
                          ) in rowNewSections.filter((sd) => sd.status == true)"
                          v-bind:key="index"
                        >
                          <div>
                            <div style="padding-left: 11px">
                              <div class="" v-show="resumesection.hidden == 1">
                                <h5
                                  class="working_as_Desig pl-0 mb-0"
                                  style="
                                    font-weight: 600;
                                    text-decoration: none;
                                    word-break: break-all !important;
                                  "
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
                                    '!important;' +
                                    'font-family:' +
                                    font_family +
                                    '!important;'
                                  "
                                >
                                  {{
                                    new_sub_section.title ??
                                    "Untitled SubSection"
                                  }}
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
                                    ';'
                                  "
                                  class="working_as_Desig pl-0 mb-0"
                                  style="text-decoration: none !important"
                                >
                                  {{ new_sub_section.content }}
                                </span>
                              </div>
                              <div v-show="resumesection.hidden == 1">
                                <div
                                  v-if="
                                    new_sub_section.list_style ==
                                    'vertical_bullets'
                                  "
                                >
                                  <div class="mb-3">
                                    <div
                                      class="additional_information"
                                      style="margin-bottom: 0"
                                      :style="
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
                                          v-show="resumesection.hidden == 1"
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
                                            {{
                                              eduSubSectionContent
                                                .subsection_content_able.name
                                            }}
                                          </div>
                                        </li>
                                        <li
                                          class="li-section-box"
                                          v-show="resumesection.hidden == 1"
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
                                          class="li-section-box"
                                          v-show="
                                            getShowEducationEnhancement &&
                                            resumesection.hidden == 1
                                          "
                                          v-else
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
                                          class="li-section-box"
                                          v-show="resumesection.hidden == 1"
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
                                            '!important;'
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
                                          v-show="resumesection.hidden == 1"
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
                                            '!important;'
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
                                          </span>
                                        </li>

                                        <li
                                          class="li-section-box"
                                          v-show="
                                            getShowEducationEnhancement &&
                                            resumesection.hidden == 1
                                          "
                                          v-else
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
                                  <!-- sub section no bulites education -->
                                  <div
                                    class="additional_information vertical_buttets"
                                    :style="
                                      'text-indent:' +
                                      resume.indent_spacing +
                                      '% ;'
                                    "
                                  >
                                    <ul
                                      style="
                                        margin-bottom: 0;
                                        padding-left: 0 !important;
                                      "
                                      v-for="(
                                        eduSubSectionContent, key
                                      ) in sortEducationArray(
                                        new_sub_section.edu_sub_section_content
                                      )"
                                    >
                                      <li
                                        class="li-section-box no-builets-test"
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
                                        class="li-section-box no-builets-test"
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
                                            }},{{
                                              getJobName(
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .job_id
                                              )
                                            }}</span
                                          >
                                        </div>
                                      </li>

                                      <li
                                        class="side-bar-section no-builets-test"
                                        v-else
                                        v-show="
                                          getShowEducationEnhancement &&
                                          resumesection.hidden == 1
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
                                              .subsection_content_able.value
                                          }}
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                  <!-- sub section no ew section -->

                                  <!-- <div
                                v-for="(
                                  eduSubSectionContent, key
                                ) in sortEducationArray(
                                  new_sub_section.edu_sub_section_content
                                )"
                              >
                                <p
                                  v-if="eduSubSectionContent.type === 'skills'"
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </p>
                                <p
                                  v-if="
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
                                </p>
                                <p v-else v-show="getShowEducationEnhancement">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
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
                          :class="checkDynamicEduClass(resumesection.column, 5)"
                          v-for="(
                            new_sub_section, index
                          ) in resumesection.resume_sub_section.filter(
                            (sd) => sd.status == true
                          )"
                          v-bind:key="index"
                        >
                          <div>
                            <div style="padding-left: 11px">
                              <div
                                class="sub-section"
                                v-show="resumesection.hidden == 1"
                              >
                                <h5
                                  class="working_as_Desig pl-0 mb-0"
                                  style="
                                    font-weight: 600;
                                    text-decoration: none;
                                  "
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
                                    '!important;' +
                                    'font-family:' +
                                    font_family +
                                    '!important;'
                                  "
                                >
                                  {{
                                    new_sub_section.title ??
                                    "Untitled SubSection"
                                  }}
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
                                    ';'
                                  "
                                  class="working_as_Desig pl-0 mb-0"
                                  style="text-decoration: none !important"
                                >
                                  {{ new_sub_section.content }}
                                </span>
                              </div>
                              <div v-show="resumesection.hidden == 1">
                                <div
                                  v-if="
                                    new_sub_section.list_style ==
                                    'vertical_bullets'
                                  "
                                >
                                  <div class="mb-3">
                                    <div
                                      class="additional_information"
                                      style="margin-bottom: 0"
                                      :style="
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
                                          class="sub-section li-section-box"
                                          v-show="resumesection.hidden == 1"
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
                                          class="sub-section li-section-box"
                                          v-show="
                                            getShowEducationEnhancement &&
                                            resumesection.hidden == 1
                                          "
                                          v-else
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
                                  <div class="sub-section mb-3">
                                    <div
                                      class="additional_information d-flex"
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
                                          class="li-section-box"
                                          v-show="resumesection.hidden == 1"
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
                                            '!important;'
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
                                          v-show="resumesection.hidden == 1"
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
                                            '!important;'
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
                                          </span>
                                        </li>

                                        <li
                                          class="li-section-box"
                                          v-show="
                                            getShowEducationEnhancement &&
                                            resumesection.hidden == 1
                                          "
                                          v-else
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
                                  <!-- sub section no bulites education -->
                                  <div
                                    class="additional_information vertical_buttets"
                                    :style="
                                      'text-indent:' +
                                      resume.indent_spacing +
                                      '% ;'
                                    "
                                  >
                                    <ul
                                      style="
                                        margin-bottom: 0;
                                        padding-left: 0 !important;
                                      "
                                      v-for="(
                                        eduSubSectionContent, key
                                      ) in sortEducationArray(
                                        new_sub_section.edu_sub_section_content
                                      )"
                                    >
                                      <li
                                        class="no-builets-test sub-section li-section-box"
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
                                        class="no-builets-test sub-section li-section-box"
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
                                            }},{{
                                              getJobName(
                                                eduSubSectionContent
                                                  .subsection_content_able
                                                  .job_id
                                              )
                                            }}</span
                                          >
                                        </div>
                                      </li>

                                      <li
                                        class="no-builets-test sub-section side-bar-section"
                                        v-else
                                        v-show="
                                          getShowEducationEnhancement &&
                                          resumesection.hidden == 1
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
                                              .subsection_content_able.value
                                          }}
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                  <!-- sub section no ew section -->

                                  <!-- <div
                                v-for="(
                                  eduSubSectionContent, key
                                ) in sortEducationArray(
                                  new_sub_section.edu_sub_section_content
                                )"
                              >
                                <p
                                  v-if="eduSubSectionContent.type === 'skills'"
                                >
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .name
                                  }}
                                </p>
                                <p
                                  v-if="
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
                                </p>
                                <p v-else v-show="getShowEducationEnhancement">
                                  {{
                                    eduSubSectionContent.subsection_content_able
                                      .value
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

                    <!-- professional summary end here -->
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
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import { environment_api } from "../../../env";
import store from "../../../store";
import html2pdf from "html2pdf.js";
import Common from "../../../mixins/Common";

export default {
  name: "FifthTemplate",
  mixins: [Common],

  data() {
    return {
      finalContent: [],
      pages: [],
      sidebar: [],
      divHeight: 9,
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
        this.splitContentIntoPages();
      });
    },

    splitContentIntoPages() {
      this.pages = [];
      this.sidebar = [];
      this.finalContent = [];
      var a4Height = 842; // A4 height in pixels
      var elements = document.querySelectorAll(".section .sub-section");

      var firstSectionContent =
        document.querySelector(".first-section").innerHTML;
      var firstSectionDiv = document.createElement("div");
      firstSectionDiv.innerHTML = firstSectionContent;
      this.finalContent.push(firstSectionDiv);

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

        var dynamicColor = this.resume.color.accent; // You can change this color dynamically
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

      var inches = combinedHeightInPixels / dpi;

      console.log(inches, "inches");
      const minusHeight = 2.1;
      const height = 10.3;
      var inches = inches - minusHeight;

      if (inches >= 11 && inches <= 21.4) {
        this.divHeight = height * 2 - minusHeight;
      } else if (inches >= 21.5 && inches <= 31.8) {
        this.divHeight = height * 3 - minusHeight;
      } else if (inches >= 31.9 && inches <= 42.3) {
        this.divHeight = height * 4 - minusHeight;
      } else if (inches > 42.4) {
        this.divHeight = height * 5 - minusHeight;
      } else {
        this.divHeight = height - minusHeight;
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
  margin-top: 0px !important;
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

/*  */

.temp_4-left-container {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  /* max-height: 722px;
  min-height: 722px; */
}
.temp_4-right-container {
  /* font-family: Tai Heritage Pro, serif; */
  /* max-height: 722px;
  min-height: 722px; */
  /* max-width: 465px;
  min-width: 465px; */
  padding-right: 46px;
  padding-top: 15px;
  margin: 0%;
  padding-left: 20px;
  background-color: #ffffff;
}
.temp_4-left-container_2 {
  /* font-family: Tai Heritage Pro, serif; */
  border-radius: 0px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
  /* max-height: 892px;
  min-height: 892px; */
}
.temp_4-right-container_2 {
  /* font-family: Tai Heritage Pro, serif; */
  /* max-height: 892px;
  min-height: 892px; */
  max-width: 465px;
  min-width: 465px;
  padding-right: 46px;
  padding-top: 15px;
  margin: 0%;
  padding-left: 20px;
  background-color: #f1f1f1;
}
.vertical-container {
  /* font-family: Tai Heritage Pro, serif; */
  /* max-height: 170px;
  min-height: 170px; */
  /* max-width: 705px;
  min-width: 705px; */
  background-color: #6abeda;
}

.temp_4-rightHeading {
  font-size: 16px;
  color: #6abeda;
  font-weight: bolder;
  margin-bottom: 4px;
  margin-top: 5px;
}
.temp_4-r-h-2 {
  padding-left: 38px;
  padding-top: 0px;
  margin-bottom: 9px;
  font-size: 14px;
}
.temp_4-main-heading {
  font-weight: bolder;
  font-size: 35px;
  padding-top: 20px;
  padding-bottom: 20px;
}
.temp_4-sub-heading {
  font-weight: 800px;
  font-size: 16px;
  padding-top: 20px;
}
.temp_4-sub-headingData {
  font-size: 12px;
  padding-bottom: 5px;
  padding-top: 3px;
}

/* for medium screen ............................................................................ */
@media screen and (min-width: 550px) and (max-width: 1100px) {
  .temp_4-left-container {
    /* min-height: 503px;
    max-height: 503px; */
    margin-left: -16.8px;
    max-width: 134px;
    min-width: 134px;
  }
  .temp_4-right-container {
    padding-right: 23px;
    padding-top: 0px;
    padding-bottom: 10px;
    /* max-height: 503px;
    min-height: 503px; */
    /* max-width: 346px;
    min-width: 346px; */
  }
  .temp_4-left-container_2 {
    min-height: 621px;
    max-height: 621px;
    margin-left: -16.8px;
    /* max-width: 134px;
    min-width: 134px; */
  }
  .temp_4-right-container_2 {
    padding-right: 23px;
    padding-top: 20px;
    padding-bottom: 10px;
    /* max-height: 621px;
    min-height: 621px; */
    max-width: 346px;
    min-width: 346px;
  }
  .vertical-container {
    margin-left: -18px !important;
    /* max-height: 118px;
    min-height: 118px; */
    max-width: 481px;
    min-width: 481px;
    background-color: #6abeda;
  }

  .temp_4-rightHeading {
    font-size: 12px;
    color: #209bce;
    font-weight: bolder;
    margin-bottom: 1px;
    padding-top: 9px;
    padding-left: 0px !important;
  }
  .temp_4-r-h-2 {
    padding-left: 1px;
    padding-top: 1px;
    margin-bottom: 10px;
    font-size: 10px;
  }
  .temp_4-main-heading {
    font-weight: bolder;
    font-size: 20px;
    padding-top: 15px;
    padding-bottom: 15px;
  }
  .temp_4-sub-heading {
    font-weight: 800px;
    font-size: 9px;
    padding-top: 20px;
  }
  .temp_4-sub-headingData {
    font-size: 9px;
  }
}

/* for small screen ............................................................................ */
@media screen and (min-width: 200px) and (max-width: 550px) {
  .temp_4-left-container {
    /* max-height: 352px;
    min-height: 352px; */
    padding-left: 15px !important;
  }
  .temp_4-right-container {
    /* font-family: Tai Heritage Pro, serif; */
    border-radius: 0px;
    /* max-width: 255px;
    min-width: 255px; */
    /* max-height: 352px;
    min-height: 352px; */
    padding-right: 15px;
    padding-top: 0px;
    padding-bottom: 20px;
    margin: 0%;
    padding-left: 5px;
  }
  .temp_4-left-container_2 {
    /* font-family: Tai Heritage Pro, serif; */
    border-radius: 0px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.09);
    max-height: 427px;
    min-height: 427px;
  }
  .temp_4-right-container_2 {
    /* font-family: Tai Heritage Pro, serif; */
    max-width: 255px;
    min-width: 255px;
    /* max-height: 427px;
    min-height: 427px; */
    padding-right: 46px;
    padding-top: 15px;
    margin: 0%;
    padding-left: 20px;
    background-color: #f1f1f1;
  }
  .vertical-container {
    /* font-family: Tai Heritage Pro, serif; */
    /* max-height: 75px;
    min-height: 75px; */
    max-width: 344px;
    min-width: 344px;
    background-color: #6abeda;
  }

  .temp_4-rightHeading {
    font-size: 8px;
    color: #209bce;
    font-weight: bolder;
    margin-bottom: 1px;
    padding-top: 3px;
  }
  .temp_4-r-h-2 {
    padding-left: 5px;
    padding-top: 0px !important;
    margin-bottom: 2px;
    font-size: 10px;
  }
  .temp_4-main-heading {
    font-weight: bolder;
    font-size: 14px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .temp_4-sub-heading {
    font-weight: 800px;
    font-size: 7px;
    padding-top: 8px;
    padding-bottom: 2px;
  }
  .temp_4-sub-headingData {
    font-size: 7px;
  }
}

.border-line-bottom {
  border-bottom: 2px solid #d9d9d9;
  padding-bottom: 20px;
  margin-bottom: 20px;
}

.border-line-bottom:last-child {
  border-bottom: none Important;
}

@media (max-width: 1300px) {
  .resume-design-div {
    min-width: 100% !important;
  }
}

.widht-control-contact-section-top {
  width: 30%;
  margin-bottom: 15px;
}

li.no-builets-test {
  list-style: none !important;
}

span.side-charecter-name {
  font-weight: 500;
  width: 55px;
  height: 55px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 13px;
  border: 3.5px solid #ffffff;
  border-radius: 100px;
  font-size: 23px;
  text-transform: uppercase;
}

.widht-control-contact-section-top:nth-child(3),
.widht-control-contact-section-top:nth-child(5) {
  text-align: right;
}

.widht-control-contact-section-top:nth-child(1),
.widht-control-contact-section-top:nth-child(4) {
  text-align: left;
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

.widht-control-contact-section-top i {
  font-size: 14px !important;
}

.row.text-on-mobile .col-lg-12.col-md-12.col-sm-12.vertical-container {
  padding: 20px 30px !important;
}

@media (max-width: 450px) {
  .space-remove-tem5 {
    padding: 0 !important;
  }

  .temp_4-sub-headingData ul {
    padding-left: 17px;
  }

  span.side-charecter-name {
    margin-right: 7px;
  }

  i.mr-1.fas.fa-globe-europe,
  i.mr-1.fa.fa-phone-alt {
    margin-top: 0 !important;
  }

  .temp_4-sub-heading.pt-0 {
    margin-bottom: 4px;
  }

  .widht-control-contact-section-top {
    font-size: 10px;
  }

  .col-md-8.cv_design_right_container {
    padding-left: 0 !important;
  }

  .sidebar_cv_design {
    padding: 0;
  }

  .page-cv-design-main-container .row {
    width: 100%;
  }

  .text-on-mobile {
    word-wrap: break-word;
  }
  .flex-wrap-temp5 {
    flex-wrap: nowrap !important;
  }

  .col-lg-12.col-md-12.col-sm-12.vertical-container {
    min-width: 100% !important;
    max-width: 100% !important;
  }
  .col-md-8.cv_design_right_container {
    padding-left: 0 !important;
  }

  .row.text-on-mobile .col-lg-12.col-md-12.col-sm-12.vertical-container {
    padding-right: 0px !important;
    padding-bottom: 0px !important;
    padding-left: 0px !important;
  }

  .temp_4-main-heading span.side-charecter-name {
    width: 35px !important;
    height: 35px !important;
    font-size: 12px !important;
  }
}
.sidebar-new {
  padding: 20px;
  margin-bottom: 10px;
  height: 1200;
}
.main-new {
  background-color: white !important;
  padding: 20px;
  margin-bottom: 10px;
  height: 1200px;
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
/* NEW CSS 5/8/24 */
.head-contact-section .widht-control-contact-section-top:nth-child(3),
.head-contact-section .widht-control-contact-section-top:nth-child(5) {
  display: flex;
  justify-content: flex-end;
}

li.sub-section.side-bar-section.li-section-box.font-13-text {
  /* font-size: 13px; */
}

.underline-text {
  text-decoration: underline !important;
}
</style>
