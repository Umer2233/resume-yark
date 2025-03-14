<template>
  <div>
    <!-- <headernav
      :education_enhacements="education_enhacements"
      :isLoggedIn="isLoggedIn"
      :currentpage="parseInt(4)"
      :page="parseInt(page)"
    ></headernav> -->
    <!-- Page Wrapper #app -->
    <section class="page-resume-editor page-contact-info">
      <div class="container space-remove-sides">
        <section class="page-resume-editor page-contact-info dsd">
          <div class>
            <div
              class="row alert_yak_finder"
              v-if="this.closeBtn == true"
              style="
                margin: 20px auto;
                font-weight: 500;
                font-size: 18px;
                line-height: 21px;
              "
            >
              <div class="col-md-3">
                <img :src="EnvPath + 'images/bg/logo.png'" alt="YAK" />
              </div>
              <div
                v-if="skip_create_password == false"
                class="col-md-7 col-sm-12 job_description_alert_text"
                style="padding-left: 10px"
              >
                <p>
                  Name your resume and select the position that best matches the
                  jobs you are looking for.
                </p>
                <p>
                  You will want to create more than one resume if you are
                  applying for positions/jobs that require different skills and
                  experience.
                </p>
              </div>
              <div
                v-if="skip_create_password == true"
                class="col-md-9 col-sm-12 job_description_alert_text"
                style="padding-left: 10px"
              >
                <p>
                  Name your resume and select the position that best matches the
                  jobs you are looking for.
                </p>
                <p>
                  You will want to create more than one resume if you are
                  applying for positions/jobs that require different skills and
                  experience.
                </p>
              </div>
              <span
                id="close-yawk-popup"
                class="icon icon_close"
                v-on:click="close()"
              >
                <i class="fas fa-times"></i>
              </span>
            </div>
          </div>
          <div class="container my_resume_list_container">
            <div class="row">
              <div class="col-md-2">
                <div class="sidebar1"></div>
              </div>
              <div
                class="col-md-10 grid-container"
                style="
                  padding-right: 0px !important;
                  padding-left: 0px !important;
                "
              >
                <div class="">
                  <div
                    class="resume-editor-div"
                    id="height-control-box"
                    :class="addDynamicHeight ? 'height-control-box-75' : ''"
                  >
                    <h2>
                      <span class="icon">
                        <i class="fas fa-file-alt"></i>
                      </span>
                      My Resumes
                    </h2>
                    <div
                      class="row"
                      style="max-width: 750px; margin: 0px auto !important"
                    >
                      <div
                        class="col-md-12 col-sm-12 group mr-2 my_resume_list_items"
                        style="margin-top: 20px"
                      >
                        <div
                          class="new-resume-fields_container_section pt-2"
                          style="position: relative"
                          v-if="HaveResumeData"
                          v-for="(input, k) in ResumeNameData"
                          :key="k"
                        >
                          <h3
                            class="new_resume_heading"
                            :class="[
                              getCurrentResume
                                ? getCurrentResume.resume_id == input.resume_id
                                  ? 'bg-blue'
                                  : ''
                                : '',
                            ]"
                            @click="
                              onResumeClick(
                                input.resume_id,
                                input.last_step,
                                input
                              )
                            "
                          >
                            <div style="width: 90%">
                              <span>{{ input.name }}</span>
                              <span>/ {{ input.pos_name }}</span>
                            </div>
                            <span
                              class="remove_new_resume_input_secton"
                              @click="ResumeNameMenuOpen(k)"
                            >
                              <i class="fa fa-bars" aria-hidden="true"></i>
                            </span>
                          </h3>

                          <div
                            class="resume_list_options"
                            :class="'resume_list_options_' + k"
                          >
                            <span class="icon">
                              <i class="fas fa-caret-down"></i>
                            </span>

                            <ul>
                              <li
                                v-if="
                                  input.last_step >= 5 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'experience-finder' }"
                                  >Experience Finder</router-link
                                >
                              </li>
                              <li v-else class="resime_not_visited">
                                <a href="javascript:void(0);"
                                  >Experience Finder</a
                                >
                              </li>

                              <li
                                v-if="
                                  input.last_step >= 6 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'job_descriptions' }"
                                  >Job Descriptions</router-link
                                >
                              </li>
                              <li
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);"
                                  >Job Descriptions</a
                                >
                              </li>

                              <li
                                v-if="
                                  input.last_step >= 7 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'skills' }"
                                  >Skills</router-link
                                >
                              </li>
                              <li
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);">Skills</a>
                              </li>

                              <li
                                v-if="
                                  input.last_step >= 8 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'endorsements' }"
                                  >Endorsements</router-link
                                >
                              </li>
                              <li
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);">Endorsements</a>
                              </li>

                              <li
                                v-show="getShowEducationEnhancement"
                                v-if="
                                  input.last_step >= 9 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link
                                  :to="{ name: 'education_enhancement' }"
                                  >Educational Enhancement</router-link
                                >
                              </li>
                              <li
                                v-show="getShowEducationEnhancement"
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);"
                                  >Educational Enhancement</a
                                >
                              </li>

                              <li
                                v-if="
                                  input.last_step >= 10 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'resume_type' }"
                                  >Resume Type</router-link
                                >
                              </li>

                              <li
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);">Resume Type</a>
                              </li>

                              <li
                                v-if="
                                  input.last_step >= 10 &&
                                  input.template_id !== 0
                                "
                                class="visited-page"
                              >
                                <router-link :to="{ name: 'TwoPageResume' }"
                                  >Resume Builder</router-link
                                >
                              </li>

                              <li
                                v-else
                                class="resime_not_visited w3-opacity-less"
                              >
                                <a href="javascript:void(0);">Resume Builder</a>
                              </li>

                              <!-- <li class="visited-page">
                                <router-link :to="{ name: 'TwoPageResume' }"
                                  >Resume Builder</router-link
                                >
                              </li> -->

                              <!-- <li
                              :class="[
                                Page == 12 ? 'current-page' : 'visited-page',
                              ]"
                            >
                              <router-link
                                :to="{
                                  name: 'TwoPageResume',
                                  query: { resume_id: input.resume_id },
                                }"
                                >Resume Builder</router-link
                              >
                            </li> -->

                              <li>
                                <a
                                  href="javascript:void(0);"
                                  @click="EditResume(k, input.resume_id)"
                                  style="color: #467d86 !important"
                                  >Edit</a
                                >
                              </li>

                              <li>
                                <a
                                  href="javascript:void(0);"
                                  @click="DeleteResume(input.resume_id)"
                                  style="color: #fb643e !important"
                                  >Delete</a
                                >
                              </li>
                            </ul>
                          </div>

                          <div
                            class="col-12 resume_field_container"
                            id="editResume"
                            v-if="editResume == 'editResume_' + k"
                          >
                            <div
                              class="col-md-6 col-sm-12 group mr-2 inputP55"
                              style="height: 50px; margin-bottom: 12px"
                            >
                              <div>
                                <input
                                  style="padding: 10px 40px 0 10px !important"
                                  type="text"
                                  class="input_text_info"
                                  :class="
                                    isMouseLeaveResumeName
                                      ? 'mouseLeave'
                                      : isMouseFocusResumeName
                                      ? 'input'
                                      : ''
                                  "
                                  v-model="ResumeName[k]"
                                  @mouseleave="mouseLeaveInput('ResumeName')"
                                  v-on:keyup="hideContactError()"
                                  @click="inputFocus('ResumeName')"
                                />
                                <span class="bar"></span>
                                <label
                                  class="label_name label_name_color"
                                  :class="
                                    isMouseLeaveResumeName &&
                                    ResumeName[k] != ''
                                      ? 'mouseleavefill'
                                      : ''
                                  "
                                  >Resume Name:</label
                                >
                              </div>
                            </div>
                            <div
                              class="col-md-6 col-sm-12 group mr-2 inputP55"
                              style="height: 50px"
                            >
                              <div>
                                <input
                                  style="padding: 10px 40px 0 10px !important"
                                  type="text"
                                  class="input_text_info"
                                  :class="
                                    isMouseLeavePosition
                                      ? 'mouseLeave'
                                      : isMouseFocusPosition
                                      ? 'input'
                                      : ''
                                  "
                                  v-model="Position[k]"
                                  @mouseleave="mouseLeaveInput('Position')"
                                  v-on:keyup="hideContactError('Position', k)"
                                  @click="inputFocus('Position')"
                                />
                                <span class="bar"></span>
                                <label
                                  class="label_name label_name_color"
                                  :class="
                                    isMouseLeavePosition && Position[k] != ''
                                      ? 'mouseleavefill'
                                      : ''
                                  "
                                  >Position</label
                                >
                                <div
                                  class="main-input-suggestion-list-item scrollbar scrollbar-indigo bordered-indigo thin"
                                  ref="positionDropdown"
                                >
                                  <slot
                                    v-if="loading"
                                    name="loading"
                                    class="input-suggestion-loading"
                                    >Loading...</slot
                                  >
                                  <slot
                                    v-else-if="isPosition"
                                    :class="suggestionListClasses"
                                    name="suggestionList"
                                    class="input-suggestion-list"
                                  >
                                    <div
                                      v-for="pos in positions.data"
                                      :key="pos.header"
                                      class="input-suggestion-list-item"
                                      @click="
                                        selectItem(pos.pos_name, pos.id, k)
                                      "
                                    >
                                      <div class="dropdown-title">
                                        {{ pos.pos_name }}
                                      </div>
                                      <div class="dropdown-desc">
                                        {{ pos.pos_description }}
                                      </div>
                                    </div>
                                  </slot>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- ================================ -->
                        <div
                          class="new-resume-fields_container_section pt-2"
                          v-if="ExpandResume && editResume == ''"
                        >
                          <h3 class="new_resume_heading">
                            New Resume
                            <span
                              class="remove_new_resume_input_secton"
                              v-if="ResumeCloseBtnShow"
                            >
                              <i
                                class="fa fa-times"
                                @click="ResumeButtonClose()"
                                aria-hidden="true"
                              ></i>
                            </span>
                          </h3>
                          <div class="col-12 resume_field_container">
                            <div
                              class="col-md-6 col-sm-12 group mr-2 inputP55"
                              style="height: 50px; margin-bottom: 12px"
                            >
                              <div>
                                <input
                                  style="padding: 10px 40px 0 10px !important"
                                  type="text"
                                  class="input_text_info"
                                  :class="
                                    isMouseLeaveResumeName
                                      ? 'mouseLeave'
                                      : isMouseFocusResumeName
                                      ? 'input'
                                      : ''
                                  "
                                  v-model="ResumeNameSingle"
                                  @mouseleave="mouseLeaveInput('ResumeName')"
                                  v-on:keyup="hideContactError()"
                                  @click="inputFocus('ResumeName')"
                                />
                                <span class="bar"></span>
                                <label
                                  class="label_name label_name_color"
                                  :class="
                                    isMouseLeaveResumeName &&
                                    ResumeNameSingle != 0
                                      ? 'mouseleavefill'
                                      : ''
                                  "
                                  >Resume Name:</label
                                >
                                <!-- <div
                                  class="profession-tooltip"
                                  data-tooltip="It is a good practice to include a link to LinkedIn,Behance or another site where recuiters can learn more about your Professional profile"
                                >
                                  <img
                                    :src="EnvPath + 'images/bg/help.png'"
                                    alt
                                    class="small_logo"
                                  />
                                </div>
                                <span>
                                  <img
                                    :src="EnvPath + 'images/bg/help.png'"
                                    alt
                                    class="small_logo yak-logo"
                                    v-tooltip="field_profile"
                                  />
                                </span> -->

                                <div
                                  class="tooltip-container-box profession-tooltip"
                                >
                                  <span class="tooltip-trigger-box">
                                    <img
                                      :src="EnvPath + 'images/bg/help.png'"
                                      alt
                                      class="small_logo"
                                  /></span>
                                  <div class="tooltip-text">
                                    Enter Resume Titile Here
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div
                              class="col-md-6 col-sm-12 group mr-2 inputP55"
                              style="height: 50px"
                            >
                              <div>
                                <input
                                  style="padding: 10px 40px 0 10px !important"
                                  type="text"
                                  class="input_text_info mouseLeave"
                                  :class="
                                    isMouseLeavePosition
                                      ? 'mouseLeave'
                                      : isMouseFocusPosition
                                      ? 'input'
                                      : ''
                                  "
                                  v-model="PositionSingle"
                                  @mouseleave="mouseLeaveInput('Position')"
                                  v-on:keyup="hideContactError('Position', '')"
                                  @click="inputFocus('Position')"
                                />
                                <span class="bar"></span>
                                <label
                                  class="label_name label_name_color"
                                  :class="
                                    isMouseLeavePosition && PositionSingle != ''
                                      ? 'mouseleavefill'
                                      : ''
                                  "
                                  >Position</label
                                >
                                <div
                                  class="main-input-suggestion-list-item scrollbar scrollbar-indigo bordered-indigo thin"
                                  ref="positionDropdown"
                                >
                                  <slot
                                    v-if="loading"
                                    name="loading"
                                    class="input-suggestion-loading"
                                    >Loading...</slot
                                  >
                                  <slot
                                    v-else-if="isPosition"
                                    :class="suggestionListClasses"
                                    name="suggestionList"
                                    class="input-suggestion-list"
                                  >
                                    <div
                                      v-for="pos in positions.data"
                                      :key="pos.header"
                                      class="input-suggestion-list-item"
                                      @click="selectItem(pos.pos_name, pos.id)"
                                    >
                                      <div class="dropdown-title">
                                        {{ pos.pos_name }}
                                      </div>
                                      <div class="dropdown-desc">
                                        {{ pos.pos_description }}
                                      </div>
                                    </div>
                                  </slot>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            v-if="editResume == ''"
                            class="text-center space-bottom-control"
                            style="display: block; margin: 15px auto 30px auto"
                          >
                            <button
                              class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right"
                              @click="saveResume()"
                            >
                              <span style="margin-left: -14px">Next</span>
                              <span class="pl-1">
                                <i class="next-icon fas fa-chevron-right"></i>
                              </span>
                            </button>
                          </div>
                        </div>
                        <div
                          v-if="editResume !== ''"
                          class="text-center"
                          style="display: block; margin: 15px auto 30px auto"
                        >
                          <button
                            class="btn1 btn-rounded btn-next mt-4"
                            @click="saveResume((edit = true))"
                          >
                            <span>Save</span>
                            <span class="pl-1">
                              <i class="next-icon fas fa-chevron-right"></i>
                            </span>
                          </button>
                        </div>
                        <!-- ================================ -->
                      </div>
                      <div class="col-md-12">
                        <button
                          v-if="ExpandResume == false"
                          type="button"
                          class="btn btn-block add_new_resume_field"
                          @click="AddButtonOpen()"
                          style="
                            border: 3px solid #e7e7e7;
                            color: #cdcdcd !important;
                            padding: 11px 0px;
                            font-size: 18px;
                            margin-top: 20px;
                            margin-bottom: 5px;
                            border-radius: 6px;
                          "
                        >
                          +Add New
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="popup-container" v-if="submitedResume">
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
                            <h4>Not So Fast</h4>
                            <p>
                              You must name your resume and select the position
                              you are applying for before we can start creating
                              content for your resume.
                            </p>
                            <button
                              class="btnOk btn-rounded"
                              @click="ClosePopup()"
                            >
                              Ok
                            </button>
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
                          <a href>
                            <strong>Sitemap</strong>
                          </a>
                          <i
                            class="fas fa-circle"
                            style="color: rgb(102, 105, 109); font-size: 25%"
                          ></i>
                        </li>
                        <li>
                          <a href>
                            <strong>Privacy Policy</strong>
                          </a>
                          <i
                            class="fas fa-circle"
                            style="color: rgb(102, 105, 109); font-size: 25%"
                          ></i>
                        </li>
                        <li>
                          <a href>
                            <strong>Terms of Use</strong>
                          </a>
                          <i
                            class="fas fa-circle"
                            style="color: rgb(102, 105, 109); font-size: 25%"
                          ></i>
                        </li>
                        <li>
                          <a href>
                            <strong>About Us</strong>
                          </a>
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
        <div class="popup-container pop_up_setpassword" v-if="chkPassword">
          <!-- -->
          <div class="poup-sub-container">
            <div
              class="pop-content-section pop_confused_content"
              style="padding: 20px 20px 40px 20px"
            >
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Create Your Password</h4>
                    <div
                      class="resume-editor-div space-bottom-on-card"
                      style="padding: 10px"
                    >
                      <div
                        class="col-md-12 col-sm-12 group mr-2 inputP55"
                        style="height: 50px; margin-bottom: 10px"
                      >
                        <div>
                          <input
                            type="email"
                            readonly
                            class="input_text_info"
                            style="padding-left: 10px !important"
                            value
                            v-model="EmailAddress"
                            @mouseleave="mouseLeaveInput('emailAddress')"
                            v-on:keyup="hideContactError()"
                          />
                          <!-- <span class="highlight"></span>  -->
                          <span class="bar"></span>
                          <label
                            class="label_name label_name_color"
                            :class="
                              isMouseLeaveEmailAddress && EmailAddress != ''
                                ? 'mouseleavefill'
                                : ''
                            "
                            >Email Address:</label
                          >
                          <!-- <span class="edit_email_btn" v-on:click="emailEdit()"
                            >Edit</span
                          > -->
                          <span>
                            <img
                              data-v-7969e6e8
                              :src="EnvPath + 'images/logo/yak-icon.png'"
                              alt
                              data-original-title="null"
                              class="small_logo has-tooltip v-tooltip-open small_logo_email"
                            />
                            <div
                              aria-hidden="false"
                              x-placement="top"
                              class="tooltip"
                              style="
                                position: absolute;
                                will-change: transform;
                                top: -87px;
                                right: 0px;
                                display: none;
                                visibility: hidden;
                                width: 320px;
                              "
                            >
                              <div
                                class="tooltip-arrow"
                                style="right: 17px; left: inherit"
                              ></div>
                              <div class="tooltip-inner">
                                Changing your email address will change it on
                                your resume and for logging in to Resume Yak
                              </div>
                            </div>
                          </span>
                        </div>
                      </div>
                      <div
                        class="col-md-12 col-sm-12 group mr-2 inputP55"
                        style="height: 50px; margin-bottom: 10px"
                      >
                        <div>
                          <input
                            type="password"
                            class="input_text_info mouseLeave"
                            style="padding-left: 10px !important"
                            :class="isMouseLeavePassword ? 'mouseLeave' : ''"
                            @mouseleave="mouseLeaveInput('password')"
                            v-model="password"
                            v-on:click="hideContactError('password')"
                            v-on:blur="checkPasswordValidation()"
                          />
                          <!-- <span class="highlight"></span>  -->
                          <span class="bar"></span>
                          <label
                            class="label_name label_name_color"
                            :class="
                              isMouseLeavePassword && password != ''
                                ? 'mouseleavefill'
                                : ''
                            "
                            >Password</label
                          >
                          <span>
                            <img
                              data-v-7969e6e8
                              :src="EnvPath + 'images/logo/yak-icon.png'"
                              alt
                              data-original-title="null"
                              class="small_logo"
                              :class="
                                passTipOpen ? 'has-tooltip v-tooltip-open' : ''
                              "
                            />
                            <div
                              aria-hidden="false"
                              x-placement="top"
                              class="tooltip"
                              :style="[
                                passTipOpen
                                  ? { visibility: 'visible !important' }
                                  : '',
                              ]"
                              style="
                                position: absolute;
                                will-change: transform;
                                top: -120px;
                                right: 0px;
                                display: none;
                                visibility: hidden;
                                width: 320px;
                              "
                            >
                              <div
                                class="tooltip-arrow"
                                style="right: 17px; left: inherit"
                              ></div>
                              <div class="tooltip-inner">
                                Password must contain:
                                <ul
                                  style="padding-left: 25px; line-height: 23px"
                                >
                                  <li>At least 8 characters</li>
                                  <li>A number or special character</li>
                                  <li>A capitalized letter</li>
                                </ul>
                              </div>
                            </div>
                          </span>
                        </div>
                      </div>
                      <div
                        class="col-md-12 col-sm-12 group mr-2 inputP55"
                        style="height: 50px; margin-bottom: 10px"
                      >
                        <div>
                          <input
                            type="password"
                            class="input_text_info mouseLeave"
                            style="padding-left: 10px !important"
                            @mouseleave="mouseLeaveInput('confirmPassword')"
                            v-model="confirmPassword"
                            v-on:keyup="hideContactError()"
                            v-tooltip="{
                              content: errors[0],
                              trigger: 'manual',
                              show: isOpen,
                              placement: 'top',
                            }"
                          />
                          <!-- <span class="highlight"></span>  -->
                          <span class="bar"></span>
                          <label
                            class="label_name label_name_color"
                            :class="
                              isMouseLeaveConfirmPassword &&
                              confirmPassword != ''
                                ? 'mouseleavefill'
                                : ''
                            "
                            >Confirm Password</label
                          >
                        </div>
                      </div>
                    </div>
                    <p v-if="RequiredErrors.length"></p>
                    <p
                      v-for="(error, index) in RequiredErrors"
                      :key="index"
                      class="alert alert-warning text-center"
                      style="font-size: 14px"
                    >
                      {{ error }}
                    </p>
                    <button
                      class="btnOk btn-rounded btn-hover-createpasswrod"
                      @click="insertData()"
                      style="margin-top: 6px; padding-top: 8px; font-size: 18px"
                    >
                      Create Password
                    </button>
                    <!-- <p
                      class="skip_create_password"
                      style="font-size: 18px"
                      @click="insertData('skip')"
                    >
                      Skip for now
                    </p> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="showDeleteResume" class="popup-container">
          <div class="poup-sub-container">
            <div class="pop-content-section pop_confused_content">
              <div class="container">
                <div class="row">
                  <div class="col-4">
                    <img src="images/logo/Surprise.png" alt="Confused" />
                  </div>
                  <div class="col-8">
                    <h4 style="padding-top: 15px">Are You Sure?</h4>
                    <p>You want to delete this Resume ?</p>
                    <div class="popup-btn-fixes">
                      <button
                        @click="cancelDeleteResume()"
                        class="btnOption btn-rounded"
                        style="float: left"
                      >
                        No
                      </button>
                      <button
                        @click="DeleteResumeConfirm()"
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
      </div>
    </section>
    <chooseResumeTemplate
      :showTemplatePopup="showChooseTemplate"
      :reusmeId="reusmeId"
      :templates="templates"
      @close="closeposnextModal"
      @move-to-experiece-finder="moveToExperieceFinder"
    ></chooseResumeTemplate>
  </div>
  <!-- More Custom Script -->
</template>

<script>
import store from "../../store";
import Common from "../../mixins/Common";
import headernav from "./header_nav";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";
import chooseResumeTemplate from "../chooseResumeTemplate.vue";

export default {
  components: {
    headernav,
    chooseResumeTemplate,
  },
  name: "my-resume",
  mixins: [Common],
  data() {
    return {
      deleteResumeId: "",
      showDeleteResume: false,
      addDynamicHeight: false,
      NextButton: true,
      EnvPath: environment_api.api_base_url,
      EmailAddress: "",
      password: "",
      chkPassword: false,
      confirmPassword: "",
      errors: [],
      RequiredErrors: [],
      isMouseLeaveEmailAddress: false,
      isMouseLeavePassword: false,
      isMouseLeaveConfirmPassword: false,
      isOpen: false,
      passTipOpen: false,
      closeBtn: true,
      skip_create_password: false,
      emailEditBtn: false,
      ResumeName: [],
      Position: [],
      ResumeNameSingle: "",
      PositionSingle: "",
      PositionId: [],
      PositionIdSingle: "",
      isMouseLeaveResumeName: false,
      isMouseFocusResumeName: false,
      isMouseLeavePosition: false,
      isMouseLeavePosition: false,
      isMouseFocusPosition: false,
      positions: [],
      loading: false,
      isPosition: false,
      full_address_display: "",
      professional_profile: "",
      user_id: "",
      website: "",
      HaveResumeData: false,
      ExpandResume: false,
      submitedResume: false,
      ResumeNameData: [],
      ResumeCloseBtnShow: false,
      editResume: "",
      id: [],
      fade: "",
      page: 4,
      Page: localStorage.getItem("page"),
      pageFromDB: "",
      grad_Date: this.$store.state.grad_Date,
      AC2: this.$store.state.AC2,
      isLoggedIn: this.$store.state.isLoggedIn,
      education_enhacements: false,
      showChooseTemplate: false,
      templates: [],
      reusmeId: "",
      showPopUp: false,
    };
  },
  computed: {
    ...mapGetters([
      "getPageCount",
      "getCurrentResume",
      "getShowEducationEnhancement",
    ]),
  },
  methods: {
    moveToExperieceFinder: function (r_id = false) {
      this.showChooseTemplate = false;
      this.loadResumes(r_id);
    },
    closeposnextModal: function () {
      this.showChooseTemplate = false;
    },
    openTemplateModal: function (r_id) {
      this.reusmeId = r_id;
      this.showChooseTemplate = true;
    },
    gettemplates: function () {
      axios
        .get(this.EnvPath + "api/get-templates")
        .then(({ data }) => {
          if (data.status) {
            this.templates = data.data;
          }
        })
        .catch((error) => console.log(error));
    },
    cancelDeleteResume: function () {
      this.deleteResumeId = "";
      this.showDeleteResume = false;
    },
    checkCache() {
      var token = localStorage.getItem("token");
      var user_id = localStorage.getItem("user_id");
      if (user_id == null) {
        // if (user_id == null && token == null) {
        console.log("here ");
        this.$router.push({ name: "login" });
        return;
      }
    },
    checkPassword: function () {
      var token = localStorage.getItem("token");
      if (token) {
        this.chkPassword = false;
      } else {
        this.chkPassword = true;
      }
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
    experience_finder(resume_id) {
      localStorage.setItem("resume_id", resume_id);
      this.$router.push({ name: "experience-finder" });
      //localStorage.getItem("resume_id")
    },
    onClick() {
      $(".resume_list_options").fadeOut(400);
    },
    insertData: function (skip = "") {
      if (skip === "") {
        if (
          this.EmailAddress != "" &&
          this.password != "" &&
          this.confirmPassword != ""
        ) {
          if (!this.validEmail(this.EmailAddress)) {
            this.RequiredErrors = [];
            this.RequiredErrors.push("Valid email required");
          } else if (this.password !== this.confirmPassword) {
            this.errors = [];
            this.errors.push("The passwords don't match");
            this.isOpen = true;
          } else if (this.checkPasswordValidation() === true) {
          } else {
            var querystring = require("querystring");

            window.axios
              .post(
                this.EnvPath + "create_password",
                querystring.stringify({
                  EmailAddress: this.EmailAddress,
                  id: this.$store.state.contact_Data.id,
                  password: this.password,
                  skip: false,
                })
              )
              .then(({ data }) => {
                if (data.success) {
                  $(".pop_up_setpassword").fadeOut("slow");
                  store.commit("LoginUser", data);
                  this.chkPassword = false;
                  // this.$router.push({ name: "" });
                } else {
                  this.chkPassword = true;
                  this.RequiredErrors = [];
                  this.RequiredErrors.push(data.message);
                }
              });
          }
        } else {
          this.RequiredErrors = [];
          this.RequiredErrors.push("Please complete all of the fields");
        }
      } else {
        this.skip_create_password = true;
        var querystring = require("querystring");
        window.axios
          .post(
            this.EnvPath + "create_password",
            querystring.stringify({
              skip: true,
              email: this.$store.state.contact_Data.email,
              id: this.$store.state.contact_Data.id,
            })
          )
          .then(({ data }) => {
            if (data.status == 1) {
              $(".pop_up_setpassword").fadeOut("slow");
            } else {
              this.errors = [];
              this.errors.push(data.message);
            }
          });
      }
    },
    async EditResume(k, resume_id) {
      this.editResume = "editResume_" + k;
      this.ExpandResume = true;
      this.ResumeNameSingle = "edit";
      this.PositionSingle = "edit";
      this.isMouseLeaveResumeName = true;
      this.isMouseLeavePosition = true;
      this.loading = false;
    },
    ClosePopup() {
      this.submitedResume = false;
    },
    AddButtonOpen: function (e) {
      this.ExpandResume = true;
      this.ResumeCloseBtnShow = true;
    },
    ResumeButtonClose(e) {
      this.ExpandResume = false;
      this.ResumeCloseBtnShow = false;
      // $(".new-resume-fields_container_section").remove();
      // $(".add_new_resume_field").show("fast");
    },
    ResumeNameMenuOpen(k) {
      if (this.fade !== "") {
        if (this.fade !== k) {
          $(".resume_list_options_" + this.fade).fadeOut(400);
        }
      }
      this.fade = "";
      this.fade = k;
      $(".resume_list_options_" + k).fadeToggle(400);
      event.stopPropagation();
    },

    validEmail: function (email) {
      var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    checkPasswordValidation: function () {
      var regularExpression =
        /^(?=.*[0-9])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}$/;
      if (this.password.match(regularExpression)) {
        return (this.passTipOpen = false);
      } else {
        return (this.passTipOpen = true);
      }
    },
    mouseLeaveInput(inputName) {
      if (inputName === "emailAddress") {
        this.isMouseLeaveEmailAddress = true;
      }
      if (inputName === "password") {
        this.isMouseLeavePassword = true;
      }
      if (inputName === "confirmPassword") {
        this.isMouseLeaveConfirmPassword = true;
      }
      if (inputName === "ResumeName") {
        this.isMouseLeaveResumeName = true;
        this.isMouseFocusResumeName = false;
      }
      if (inputName === "Position") {
        this.isMouseLeavePosition = true;
        this.isMouseFocusPosition = false;
      }
    },
    inputFocus(inputName) {
      if (inputName === "emailAddress") {
        this.isMouseLeaveEmailAddress = true;
      }
      if (inputName === "password") {
        this.isMouseLeavePassword = true;
      }
      if (inputName === "confirmPassword") {
        this.isMouseLeaveConfirmPassword = true;
      }
      if (inputName === "ResumeName") {
        this.isMouseFocusResumeName = true;
        this.isMouseLeaveResumeName = false;
      }
      if (inputName === "Position") {
        this.isMouseFocusPosition = true;
        this.isMouseLeavePosition = false;
      }
    },
    selectItem(item, id, k = "") {
      if (k !== "") {
        this.Position[k] = item;
        this.PositionId[k] = id;
      } else {
        this.PositionSingle = item;
        this.PositionIdSingle = id;
      }
      this.isPosition = false;
    },
    closeDropdownOnClickOutside(event) {
      if (
        this.isPosition &&
        !this.$refs.positionDropdown.contains(event.target)
      ) {
        this.isPosition = false;
      }
    },
    saveResume(edit = false) {
      // if(this.ResumeName.length > 0 && this.PositionId.length > 0){
      if (this.ResumeNameSingle !== "" && this.PositionSingle !== "") {
        if (
          this.ResumeNameSingle !== "edit" &&
          this.PositionSingle !== "edit"
        ) {
          let newEle = this.ResumeName.length;
          this.ResumeName[newEle] = this.ResumeNameSingle;
          let newEle2 = this.PositionId.length;
          this.PositionId[newEle2] = this.PositionIdSingle;
        } else if (this.ResumeName.length !== this.PositionId.length) {
          this.submitedResume = true;
        } else if (this.ResumeName.length == this.PositionId.length) {
          let that = this;
          for (let i = 0; i < that.ResumeName.length; i++) {
            if (that.ResumeName[i] == "" || that.Position[i] == "") {
              that.submitedResume = true;
              return false;
            }
          }
        }
      } else {
        this.submitedResume = true;
        return false;
      }

      if (this.ResumeName.length === this.PositionId.length) {
        this.submitedResume = false;
        let that = this;

        if (this.$store.state.userData.street_address !== "") {
          this.full_address_display =
            this.$store.state.userData.street_address +
            ", " +
            this.$store.state.userData.city +
            ", " +
            this.$store.state.userData.state;
        } else {
          this.full_address_display =
            this.$store.state.userData.city +
            ", " +
            this.$store.state.userData.state;
        }

        if (this.$store.state.userData.professional_profile !== "") {
          this.professional_profile = 4;
        } else {
          this.professional_profile = 0;
        }

        if (this.$store.state.userData.website !== "") {
          this.website = 4;
        } else {
          this.website = 0;
        }
        // if(this.PositionIdSingle !== '' && this.ResumeNameSingle !== ''){
        //   let newEle = this.Position.length;
        //   this.PositionId[newEle]=this.PositionIdSingle
        //   this.ResumeName[newEle]=this.ResumeNameSingle
        // }
        // this.NextButton = false;
        axios
          .post(this.EnvPath + "save-resume", {
            id: this.id,
            position_id: this.PositionId,
            name: this.ResumeName,
            middle_initial: false,
            address_display: this.full_address_display,
            email: 1,
            address: 2,
            phone: 3,
            profile: this.professional_profile,
            website: this.website,
            hide_headline: false,
            employment_date: "Month and Year",
            employment_location: "City, State",
            employment_description: null,
            employment_emphasis: "Position",
            education_date: "Month and Year",
            education_location: "City, State",
            education_emphasis: "Degree",
            page: this.page + 1,
          })
          .then((response) => {
            this.editResume = "";
            // this.NextButton = true;
            that.getEducationEnhancement();
            if (response.data.status == 1) {
              // $(".new-resume-fields_container_section").remove();
              if (response.data.resume_id != "") {
                // localStorage.setItem("resume_id", response.data.resume_id);
              }
              that.ExpandResume = false;
              that.loading = !that.loading;
              that.isPosition = true;
              that.positions = response.data;

              that.ResumeNameSingle = "";
              that.PositionSingle = "";

              if (this.getPageCount < 4) {
                store.commit("storePageCount", 4);
              }

              if (edit) {
                that.loadResumes();
              } else {
                that.openTemplateModal(response.data.resume_id);
                that.loadResumes();
              }
            } else {
              this.$toaster.error(response.data.message);
              this.chkPassword = true;
            }
          });
      } else {
        // this.NextButton = true;
        this.submitedResume = true;
      }
      // }
      // else
      // {
      //    this.submitedResume = true
      // }
    },
    checkTemplate: function (r_id) {
      this.ResumeNameData.map((value) => {
        if (value.resume_id == r_id) {
          if (value.template_id == null || value.template_id == 0) {
            this.showPopUp = true;
            this.openTemplateModal(value.resume_id);
          } else {
            this.showPopUp = false;
          }
        }
      });
      if (this.showPopUp) {
        return false;
      } else {
        return true;
      }
    },
    onResumeClick(id, last_step, resume) {
      console.log(id, "id");
      var template_status = this.checkTemplate(id);
      if (!template_status) {
        return false;
      }

      store.commit("storeCurrentResume", resume);
      var currentRes = JSON.stringify(resume);
      localStorage.setItem("resume_id", id);
      localStorage.setItem("CurrentResume", currentRes);
      localStorage.setItem("user_id", resume.user_id);
      axios
        .post(this.EnvPath + "api/update-resume-current-resume-id", {
          id: this.$store.state.contact_Data.id,
          resume_id: id,
        })
        .then(({ data }) => {
          if (data.status) {
            store.commit("updateResumeCurrentId", id);
            if (this.getCurrentResume && this.getCurrentResume.last_step < 5) {
              var data = {
                r_id: this.getCurrentResume.resume_id,
                step: 5,
              };
              this.$store.dispatch("updateResumeLastStep", data);
              store.commit("storePageCount", 5);
              localStorage.setItem("pageCount", 5);
            }
          }
        })
        .catch((error) => console.log(error));

      this.$router.push({ name: "experience-finder" });

      // if (last_step == 5) {
      //   //window.location.href = "/builder/contact/#/experience-finder";
      //   //this.$router.go(0);
      //   this.$router.push({ name: "experience-finder" });
      // } else if (last_step == 6) {
      //   //window.location.href = "/builder/contact/#/education_enhancement";
      //   this.$router.push({ name: "education_enhancement" });
      // } else if (last_step == 7) {
      //   this.$router.push({ name: "job_descriptions" });
      // } else {
      // }
    },
    DeleteResume(id) {
      this.deleteResumeId = id;
      this.showDeleteResume = true;
    },
    DeleteResumeConfirm() {
      var id = this.deleteResumeId;
      this.editResume = "";

      axios
        .post(this.EnvPath + "delete-resume", {
          id: id,
        })
        .then(({ data }) => {
          if (this.getCurrentResume && this.getCurrentResume.resume_id == id) {
            store.commit("storeCurrentResume", "");
            localStorage.setItem("CurrentResume", "");
            localStorage.setItem("resume_id", "");
          }
          if (data.status == 1) {
            this.showDeleteResume = false;
            store.commit("ResumeNameData", data);
            var that = this;
            this.ExpandResume = false;
            this.HaveResumeData = false;
            if (data.data.length > 0) {
              data.data.map(function (value, key) {
                that.HaveResumeData = true;
                if (
                  value.template_id != null &&
                  value.position_id == null &&
                  value.name == null
                ) {
                  that.ExpandResume = true;
                } else {
                  if (key <= 0) {
                    that.ResumeNameData = [];
                    that.ResumeName = [];
                    that.Position = [];
                    that.PositionId = [];
                    that.id = [];
                  }
                  that.ResumeNameData.push(value);
                  that.ResumeName.push(value.name);
                  that.Position.push(value.pos_name);
                  that.PositionId.push(value.pos_id);
                  that.id.push(value.resume_id);
                }
              });
            } else {
              that.ResumeNameData = [];
              that.ResumeName = [];
              that.Position = [];
              that.PositionId = [];
              that.id = [];
            }
          } else {
            this.ExpandResume = true;
            this.HaveResumeData = false;
            this.showDeleteResume = false;
          }
        });
    },

    hideContactError: function (e = "", k = "") {
      if (e == "password") {
        this.passTipOpen = false;
      }
      if (e == "Position") {
        let pos;
        if (k === "") {
          pos = this.PositionSingle;
        } else {
          pos = this.Position[k];
        }
        let that = this;
        this.loading = true;
        this.isMouseLeavePosition = true;
        axios
          .post(this.EnvPath + "get-position", {
            position: pos,
          })
          .then(function (response) {
            if (that.Position == "" && that.Position.length == 0) {
              that.loading = false;
              that.isPosition = true;
            } else {
              that.loading = false;
              that.isPosition = true;
            }
            that.positions = response.data;
          });
      }
      this.errors = [];
      if (
        this.EmailAddress != "" &&
        this.password != "" &&
        this.confirmPassword != ""
      ) {
        this.errors = [];
      }
    },
    loadContact() {
      axios.get(this.EnvPath + "getcontact").then(({ data }) => {
        if (data.status == 1) {
          if (data.user.length > 0) {
            store.commit("contactData", data);
            localStorage.setItem("user_id", data.user[0].id);
          }
          this.isMouseLeaveEmailAddress = this.EmailAddress =
            this.$store.state.contact_Data.email;
          if (this.$store.state.contact_Data.password !== null) {
            // this.password = this.$store.state.contact_Data.password;
            // this.chkPassword = this.$store.state.contact_Data.password;
          } else {
            this.password = "";
            // this.chkPassword = false;
          }
        }
      });
    },
    loadResumes(resume_id = false) {
      if (this.$store.state.userData !== null) {
        this.user_id = this.$store.state.userData.id;
      } else {
        this.user_id = "";
      }
      var that = this;
      axios.post(this.EnvPath + "get-resume", {}).then(({ data }) => {
        if (data.status == 1) {
          that.ResumeNameData = [];
          that.PositionId = [];
          that.Position = [];
          that.ResumeName = [];
          that.ResumeNameData = [];
          that.id = [];
          store.commit("ResumeNameData", data);
          data.data.map(function (value, key) {
            that.HaveResumeData = true;
            if (
              value.template_id != null &&
              value.position_id == null &&
              value.name == null
            ) {
              that.ExpandResume = true;
            } else {
              that.ResumeNameData.push(value);
              that.ResumeName.push(value.name);
              that.Position.push(value.pos_name);
              that.PositionId.push(value.pos_id);
              that.id.push(value.resume_id);
            }
          });
          if (resume_id) {
            var res_obj = that.ResumeNameData.find(
              (item) => item.resume_id == resume_id
            );
            that.onResumeClick(resume_id, res_obj.last_step, res_obj);
          }
        } else {
          this.ExpandResume = true;
          this.HaveResumeData = false;
        }
      });
    },

    getEducationEnhancement() {
      axios
        .get(this.EnvPath + "education_enhancement2")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
        })
        .catch((error) => console.log(error));
    },

    close: function (event) {
      this.closeBtn = !this.closeBtn;
      this.addDynamicHeight = true;
    },
    emailEdit: function () {
      $(".input_text_info").attr("readonly", false);
      $(".small_logo_email").fadeIn("slow");
    },
  },

  beforeMount() {
    // this.checkCache();
    this.getEducationEnhancement();
    this.loadContact();
    this.loadResumes();
  },

  watch: {
    isPosition(newValue) {
      if (newValue) {
        document.addEventListener("click", this.closeDropdownOnClickOutside);
      } else {
        document.removeEventListener("click", this.closeDropdownOnClickOutside);
      }
    },
  },

  mounted() {
    this.checkPassword();
    localStorage.setItem("pageCount", 4);
    store.commit("storeCurrentPage", 4);
    localStorage.setItem("CurrentPage", 4);
    localStorage.setItem("page", 4);
    document.addEventListener("click", this.onClick);
    if (this.$store.state.userData.page != null) {
      this.pageFromDB = this.$store.state.userData.page;
    }
    this.education_enhacements_menu();
    $(".has_sub_nav_my_profile").removeClass("active_nav");
    $(".my_resumes").addClass("active_nav");
    this.gettemplates();
  },
  beforeDestroy() {
    document.removeEventListener("click", this.closeDropdownOnClickOutside);
    document.removeEventListener("click", this.onClick);
  },

  created() {
    // console.log("hello");
    // console.log(this.EnvPath);
  },
};
</script>
<style>
.bg-blue {
  background-color: #3d96f9;
  color: white;
}
.tooltip .tooltip-inner {
  margin-left: 42px !important;
}

.input-suggestion {
  position: relative;
}

.input-suggestion .input-suggestion-list {
  position: absolute;
}

.input-suggestion-list-item {
  cursor: pointer;
}

.input-suggestion
  .input-suggestion-list
  .input-suggestion-list-item.input-suggestion-item-active {
  background-color: #f3f6fa;
}

.dropdown-title {
  font-size: 16px;
  color: rgb(38, 132, 254);
  font-family: Hind;
  padding: 8px 20px 0px;
}

.dropdown-desc {
  font-size: 14px;
  font-family: Hind;
  padding: 0px 20px 5px;
}

.main-input-suggestion-list-item {
  text-align: left;
  background: #fff;
  position: relative;
  z-index: 9;
}

.resime_not_visited a {
  /* font-family: "Hind", sans-serif; */
  /* font-weight: 500;
    font-size: 18px; */
  color: #9dc5cc !important;
  display: block;
  cursor: auto;
  /* padding: 0px 10px !important; */
  /* cursor: auto; */
}

.resume_list_options ul li a {
  /* font-family: "Hind", sans-serif; */
  /* font-weight: 500;
    font-size: 18px;
    color: #9dc5cc !important;
    display: block;
    padding: 0px 10px !important; */
  /* cursor: auto; */
  cursor: pointer !important;
}

.new-resume-fields_container_section:hover {
  cursor: pointer;
}

#height-control-box {
  min-height: 55vh;
}

.tooltip-container-box {
  position: relative;
  /* display: inline-block;
  margin-top: 50px;
  margin-left: 50px; */
}

.tooltip-trigger-box {
  cursor: pointer;
  position: absolute;
  right: -3px;
  top: -48px;
}

.tooltip-text {
  opacity: 0;
  position: absolute;
  background-color: #ffba00;
  color: #000;
  padding: 5px;
  border-radius: 3px;
  z-index: 1;
  /* right: -30px; */
  right: -26px;
  top: -73px;
  font-size: 11px;
  font-weight: 400;
  font-family: "Hind";
}

.tooltip-container-box:hover .tooltip-text {
  opacity: 1;
}
.tooltip-text:before {
  position: absolute;
  content: "\f0d7";
  font-weight: 900 !important;
  font-family: "Font Awesome 5 Pro" !important;
  font-size: 16px;
  right: 36%;
  transform: translateX(-50%);
  top: 17px;
}

@media (max-width: 993px) {
  .main-input-suggestion-list-item.scrollbar {
    max-height: 200px !important;
  }
}

@media (max-width: 450px) {
  div#height-control-box h2 {
    /* margin-top: 0 !important; */
  }
  .my_profile_sub_menu {
    padding-top: 0 !important;
    margin-top: 39px;
    box-shadow: 0 0 4px 0 rgba(0, 0, 0, 16%);
    border-radius: 10px;
    overflow: hidden;
  }

  .space-remove-sides {
    padding: 0;
  }

  .my_profile_sub_menu span.icon {
    display: none;
  }
  .resume_list_options {
    bottom: 65px;
  }

  .space-bottom-on-card {
    margin-bottom: 5px;
    padding: 0 !important;
  }
  .resume-editor-div.space-bottom-on-card .inputP55 {
    padding: 0 !important;
    margin-bottom: 10px;
  }
  .pop_up_setpassword .tooltip .tooltip-inner,
  .login_input_field .tooltip .tooltip-inner {
    font-size: 14px !important;
  }
}

.resume-editor-div.height-control-box-75 {
  min-height: 75vh !important;
}

.space-bottom-control {
  margin-bottom: 0 !important;
}

.new-resume-fields_container_section.pt-2 span.icon {
  padding-right: 4px !important;
}

.btn-hover-createpasswrod {
  font-size: 16px !important;
}

.btn-hover-createpasswrod:hover {
  background-color: #0d5fca !important;
}
</style>
