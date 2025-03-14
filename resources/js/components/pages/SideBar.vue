<template>
<!-- sidebar_cv_design -->
  <div class="col-md-4 left-space-remove-mb">
    <div class="loader-container" v-if="getCheckLoader">
        <div class="loader">
          <!-- Replace this with your preferred loading spinner or animation -->
          <div class="spinner"></div>
          <p>Please Wait</p>
        </div>
      </div>
    <div class="cv_design_sub_container">
      <ul
        class="nav nav-tabs sidebar-tabs-spacing wrap-header-sidebar"
        id="myTab"
        role="tablist"
      >
        <li class="nav-item">
          <a
            class="nav-link active tab-icon-design"
            id="content-tab"
            data-toggle="tab"
            href="#content"
            role="tab"
            aria-controls="content"
            aria-selected="true"
            ><i class="far fa-indent"></i> Content</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link tab-icon-design"
            id="design-tab"
            data-toggle="tab"
            href="#design"
            role="tab"
            aria-controls="design"
            aria-selected="false"
          >
            <i class="fal fa-pencil-paintbrush"></i> Design
          </a>
        </li>
        <li class="nav-item">
          <!-- <a
            class="nav-link"
            id="preview-tab"
            data-toggle="tab"
            href="#preview"
            role="tab"
            aria-controls="preview"
            aria-selected="false"
            >Preview</a
          > -->
          <a href="#" class="nav-link tab-icon-design" @click="downloadPDFS()"
            ><i class="far fa-download"></i>Download</a
          >
        </li>
      </ul>
      <div class="tab-content sidebar-bg-box" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="content"
          role="tabpanel"
          aria-labelledby="content-tab"
        >
          <div id="accordionSidebar">
            <div
              v-for="(sectionData, key) in sortMainSectionArray(
                resume.resume_sections
              )"
              :key="`#main_div_show${key}`"
              @dragover="
                (e) => onDragMainSectionOver(sectionData, sectionData.id, e)
              "
              @dragend="
                (e) =>
                  finishMainSectionDrag(
                    sectionData,
                    sectionData.id,
                    (hide = true),
                    e
                  )
              "
              @dragstart="
                (e) => startMainDivDrag(sectionData, sectionData.id, e)
              "
              class="accordion contact-profile-info no-border"
              :class="{
                over_main_section:
                  sectionData === over_main_section.sectionData &&
                  sectionData !== dragFrom,
                [over_main_section.dir]:
                  sectionData === over_main_section.sectionData &&
                  item !== dragFrom,
              }"
              :draggable="sectionData.type == 'contact' ? false : true"
            >
              <!-- contact start 1 -->
              <div class="card" v-if="sectionData.type == 'contact'">
                <div
                  class="card-header d-flex justify-content-start align-items-center"
                  id="headingOne"
                  data-toggle="collapse"
                  :class="[
                    sidbar_active.contact_sidebar ? 'activeSidebar' : '',
                  ]"
                  v-on:click="setActive('contact_sidebar')"
                  data-target="#collapseOne"
                  aria-expanded="false"
                  aria-controls="collapseOne"
                >
                  <!-- <img
                    :src="EnvPath + 'builder/images/logo/resume-phone.png'"
                    class="heading_icon_sidebar"
                    :class="[
                      sidbar_active.contact_sidebar ? 'iconHide' : 'iconShow',
                    ]"
                  />
                  <img
                    :src="
                      EnvPath + 'builder/images/logo/resume-phone_active.png'
                    "
                    class="heading_icon_sidebar"
                    :class="[
                      sidbar_active.contact_sidebar ? 'iconShow' : 'iconHide',
                    ]"
                  /> -->
                  <i class="fa-solid fa-phone-volume sidebar-icons-grey"></i>
                  Contact Info
                </div>
                <div
                  id="collapseOne"
                  class="collapse"
                  aria-labelledby="headingOne"
                  data-parent="#accordionSidebar"
                >
                  <div class="card-body">
                    <h2>Name</h2>
                    <div class="more_checkbox_section">
                      <div
                        class="custom-control custom-checkbox form-check form-check-inline finder_job_check sidebar-checkbox-label"
                      >
                        <input
                          class="custom-control-input form-check-input"
                          type="checkbox"
                          v-model="is_middle"
                          @click="hideMiddleName"
                          id="customCheckname"
                          value="option1"
                          :disabled="disableContactInfoMiddle"
                        />

                        <label
                          for="customCheckname"
                          class="custom-control-label form-check-label"
                          >Middle Initial</label
                        >
                      </div>
                    </div>
                    <h2>Address</h2>

                    <div class="more_checkbox_section">
                      <div
                        class="custom-control custom-radio form-check form-check-inline finder_job_check"
                      >
                        <div
                          class="custom-control custom-radio form-check form-check-inline finder_job_check"
                        >
                          <input
                            class="custom-control-input form-check-input"
                            type="radio"
                            id="is_info_full_address_city"
                            value="1"
                            v-model="is_info_full_address_city"
                            @change="infoFullAddressCity"
                            :disabled="contact_address_options == false"
                          />
                          <label
                            class="custom-control-label form-check-label space-contrlol-conteact-sidebar"
                            for="is_info_full_address_city"
                            >Full Address Country</label
                          >
                        </div>
                      </div>
                      <div
                        class="custom-control custom-radio form-check form-check-inline finder_job_check"
                      >
                        <input
                          class="custom-control-input form-check-input"
                          type="radio"
                          id="is_info_full_address"
                          value="2"
                          v-model="is_info_full_address"
                          @change="infoFullAddress"
                          :disabled="contact_address_options == false"
                        />
                        <label
                          class="custom-control-label form-check-label"
                          for="is_info_full_address"
                          >Full Address</label
                        >
                      </div>
                      <div
                        class="custom-control custom-radio form-check form-check-inline finder_job_check"
                      >
                        <input
                          class="custom-control-input form-check-input"
                          type="radio"
                          id="is_info_city_state"
                          value="3"
                          v-model="is_info_city_state"
                          @change="infoCityState"
                          :disabled="contact_address_options == false"
                        />
                        <label
                          class="custom-control-label form-check-label"
                          for="is_info_city_state"
                          >City, State</label
                        >
                      </div>
                      <div
                        class="custom-control custom-radio form-check form-check-inline finder_job_check"
                      >
                        <!-- <input
                                                              class="custom-control-input form-check-input"
                                                              type="radio"
                                                              id="is_info_location"
                                                              value="4"
                                                              v-model="is_info_location"
                                                              @change="infoLocation"
                                                            />
                                                            <label
                                                              class="custom-control-label form-check-label"
                                                              for="is_info_location"
                                                              >None</label
                                                            > -->

                        <!--                      <input type="radio" id="customCheckRadio4" value="option5"-->
                        <!--                             class="custom-control-input form-check-input" name="address_options">-->
                        <!--                      <label for="customCheckRadio4"-->
                        <!--                             class="custom-control-label form-check-label">None</label>-->
                      </div>
                    </div>
                    <h2>Contact & Profile Info</h2>
                    <!-- Contact Info Section Start  -->
                    <div>
                      <div class="contact_info_section pt-3 pb-1 mx-2">
                        <transition-group name="email-group" tag="div">
                          <li
                            v-for="item in sortedArray.filter(
                              (el) => el.active == true
                            )"
                            :key="`#color_item_id${item.id}`"
                            @dragover="(e) => onDragOver(item, item.id, e)"
                            @dragend="
                              (e) => finishDrag(item, item.id, (hide = true), e)
                            "
                            @dragstart="(e) => startDrag(item, item.id, e)"
                            class="d-flex justify-content-between align-items-center mx-3 mb-3 contact-profile-info pt-2 pb-1 px-2"
                            :class="{
                              over: item === over.item && item !== dragFrom,
                              [over.dir]:
                                item === over.item && item !== dragFrom,
                            }"
                            draggable="true"
                          >
                            <span style="width: 125px">{{ item.name }}</span>
                            <span
                              ><i
                                class="fas fa-arrows-alt contact-drag-icon"
                              ></i
                            ></span>
                            <i
                              @click="contactInfoEyeClick(item, item.id)"
                              :class="
                                item.active ? 'fa fa-eye' : 'fa fa-eye-slash'
                              "
                              class="eye-icon-contact-info"
                            ></i>
                          </li>
                        </transition-group>
                        <div class="text-center my-3">
                          <button
                            class="add-blank-spcae btn btn-block text-style-add-btn"
                            style="
                              color: #767676 !important;
                              font-size: 14px !important;
                            "
                            @click="addBlankSpace"
                          >
                            <i
                              class="fa fa-plus"
                              style="
                                color: rgb(73, 156, 249);
                                border: 1px solid rgb(73, 156, 249);
                                border-radius: 50%;
                                height: 20px;
                                width: 20px;
                                text-align: center;
                                line-height: 19px;
                                font-size: 12px;
                              "
                            ></i>
                            Add Blank Space
                          </button>
                        </div>
                        <transition-group name="email-group" tag="div">
                          <li
                            v-for="item in sortedArray.filter(
                              (el) => el.active == false
                            )"
                            :key="`#color_ods_d${item.id}`"
                            @dragover="(e) => onDragOver(item, item.id, e)"
                            @dragend="
                              (e) =>
                                finishDrag(item, item.id, (hide = false), e)
                            "
                            @dragstart="(e) => startDrag(item, item.id, e)"
                            class="d-flex justify-content-between align-items-center mx-3 mb-3 contact-profile-info pt-2 pb-1 px-2 resume-builder-non-active-item"
                            :class="{
                              over: item === over.item && item !== dragFrom,
                              [over.dir]:
                                item === over.item && item !== dragFrom,
                            }"
                            draggable="true"
                          >
                            {{ item.name }}
                            <i
                              @click="contactInfoEyeClick(item, item.id)"
                              :class="[
                                item.active ? 'fa fa-eye' : 'fa fa-eye-slash',
                              ]"
                            ></i>
                          </li>
                        </transition-group>
                        <div
                          v-for="(inactive_item, i) in inactive_items"
                          class="email-group light-blue d-flex justify-content-between mb-3 align-items-center mx-3 pt-2 pb-1 px-2"
                          :key="`#color_i${i}`"
                        >
                          <h6 class="contact-profile-info border-0">
                            {{ inactive_item.name }}
                          </h6>
                          <i class="fa fa-eye-slash"></i>
                        </div>
                      </div>
                    </div>
                    <!-- Contact Info Section End  -->
                    <!-- <div class="more_checkbox_section">
                                        <div
                                        class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                      >
                                        <input
                                          type="checkbox"
                                          v-model="is_email"
                                          @click="hideEmail"
                                          id="checkEmail"
                                          value="option1"
                                          class="custom-control-input form-check-input"
                                        />

                                        <label
                                          for="checkEmail"
                                          class="custom-control-label form-check-label"
                                          >Email</label
                                        >
                                      </div>
                                      <div
                                        class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                      >
                                        <input
                                          type="checkbox"
                                          v-model="is_phone"
                                          id="inlineCheckbox3"
                                          @click="hidePhone"
                                          value="option3"
                                          class="custom-control-input form-check-input"
                                        />
                                        <label
                                          for="inlineCheckbox3"
                                          class="custom-control-label form-check-label"
                                          >Phone Number</label
                                        >
                                      </div>
                                      <div
                                        class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                      >
                                        <input
                                          type="checkbox"
                                          v-model="is_professional_profile"
                                          id="inlineCheckbox4"
                                          value="option4"
                                          @click="hidePro"
                                          :disabled="disableProfessionalProfileDesc"
                                          class="custom-control-input form-check-input"
                                        />
                                        <label
                                          for="inlineCheckbox4"
                                          class="custom-control-label form-check-label"
                                          >Professional Profile</label
                                        >
                                      </div>
                                      <div
                                        class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                                      >
                                        <input
                                          type="checkbox"
                                          v-model="Professional_website"
                                          @click="hideWeb"
                                          :disabled="disableProfessionalWebsiteDesc"
                                          id="inlineCheckbox5"
                                          value="option5"
                                          class="custom-control-input form-check-input"
                                        />
                                        <label
                                          for="inlineCheckbox5"
                                          class="custom-control-label form-check-label"
                                          >Professional Website/Blog</label
                                        >
                                      </div>
                                    </div> -->
                  </div>
                </div>
              </div>
              <!-- contact start 2 -->
              <div class="card" v-if="sectionData.type == 'contact'">
                <div
                  class=""
                  style="min-height: 48px; position: relative"
                  :class="[
                    sidbar_active.headline_sidebar ? 'activeSidebar' : '',
                  ]"
                >
                  <span
                    v-on:click="setActive('headline_sidebar')"
                    data-toggle="collapse"
                    data-target="#collapseTwo"
                    aria-expanded="false"
                    aria-controls="collapseTwo"
                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                  >
                    <!-- <img
                      :src="EnvPath + 'builder/images/logo/resume_headline.png'"
                      :class="[
                        sidbar_active.headline_sidebar
                          ? 'iconHide'
                          : 'iconShow',
                      ]"
                      class="heading_icon_sidebar"
                    />
                    <img
                      :src="
                        EnvPath +
                        'builder/images/logo/resume_headline_active.png'
                      "
                      :class="[
                        sidbar_active.headline_sidebar
                          ? 'iconShow'
                          : 'iconHide',
                      ]"
                      class="heading_icon_sidebar heading_icon_sidebar_active"
                    /> -->
                    <i class="far fa-newspaper"   style="
                        font-size: 18px;
                        margin-right: 8px;
                        color: #b7b7b7;
                        margin-top: -4px;
                      "></i>
                    Headline</span
                  >
                  <span class="visible_section_setings visible_section_sidebar" :class="[
                    sidbar_active.headline_sidebar ? 'eye-white' : '',
                  ]"><i
                      v-show="sectionData.hidden == 1"
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                      v-on:click="showHideSidebar('headline', sectionData.id)"
                    ></i>
                    <i
                      v-show="sectionData.hidden == 0"
                      v-on:click="showHideSidebar('headline', sectionData.id)"
                      class="fa fa-eye-slash show_hide_icon"
                    ></i
                  ></span>
                </div>
                <!-- Headline Section Start -->
                <div
                  id="collapseTwo"
                  class="collapse"
                  aria-labelledby="headingTwo"
                  data-parent="#accordionSidebar"
                >
                  <div class="card-body">
                    <p class="why_hire_heading">
                      <img
                        :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                        alt="Logo"
                        align="left"
                      />
                      The purpose of the headline is to summarize why someone
                      should hire you.
                    </p>
                    <!-- <form @submit.prevent="addEndorsement"> -->
                    <form @submit.prevent="">
                      <div class="group mr-2">
                        <div class="select-arrow-side">
                          <select
                            required
                            v-model="edorsement.value"
                            name="headline_type"
                            id="headline_type"
                            class="select-item input mouseLeave"
                            style="-webkit-appearance: none"
                            @change="changeAddHeadlineTitle($event)"
                          >
                            <option value="1">Endorsement</option>
                            <option value="2">Qualification Statement</option>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label
                            style="padding-left: 10px !important"
                            class="select-label mouseLeave_"
                            >Headline Type</label
                          >
                        </div>
                      </div>

                      <div class="endorsment_headline_section">
                        <div v-if="edorsement.value == 1">
                          <p>
                            Select the Endorsement you want to use as your
                            headline
                          </p>
                          <div
                            class="endorsement_options_list_section endorsment_single_options_selection_cont"
                          >
                            <div
                              class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                            >
                              <div class="force-overflow">
                                <div
                                  class="resposibilities_items_listing"
                                  v-for="(endorse, key) in resume.user
                                    .endorsements"
                                  :key="`#color_key_ods${key}`"
                                  :class="
                                    endorse.top_endorsment_status
                                      ? 'selected_endorsment_item_option1'
                                      : ''
                                  "
                                >
                                  <h4 @click="changeEndorsement(endorse.id)">
                                    “{{ endorse.value }}”
                                    <span
                                      >– {{ endorse.author }},
                                      {{ endorse.author_description }},
                                      <span v-if="endorse.job_id"> ,{{
                                          endorse.job_id ? getJobName(endorse.job_id) : ""
                                      }}
                                      </span>
                                      <!-- {{
                                        endorse.jobs ? endorse.jobs.company : ""
                                      }} -->
                                    </span>
                                  </h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div v-if="edorsement.value == 2">
                          <div>
                            <div class="single-word">
                              <input
                                required
                                type="text"
                                v-model="qualification_statement.single_word"
                                @input="getSingleWordSuggestion"
                                @change="updatedFinalStatement"
                                class="form-control"
                                placeholder="Single word used to describe you"
                              />
                              <ul
                                class="single-word-list"
                                v-show="showSingleWord"
                              >
                                <li
                                  v-for="(
                                    value, key
                                  ) in singleWordSuggestionArray"
                                  :key="`#color_ods_iy${key}`"
                                  @click="
                                    setSingleWordSuggestion(value.suggestion)
                                  "
                                  :style="{
                                    'font-weight': matchingText(
                                      value.suggestion,
                                      qualification_statement.single_word,
                                      key
                                    )
                                      ? '600'
                                      : '500',
                                  }"
                                >
                                  {{ value.suggestion }}
                                </li>
                              </ul>
                            </div>
                            <div class="position">
                              <input
                                required
                                v-model="
                                  qualification_statement.position_sought
                                "
                                type="text"
                                @change="updatedFinalStatement"
                                @click="getTitle(resume.title_id)"
                                class="form-control"
                                placeholder="Position"
                              />
                              <!-- @blur="updatedFinalStatementDB" -->
                              <ul
                                class="position-list"
                                v-show="showPositionSought"
                              >
                                <li v-on:click="setAndHideTitle(title)">
                                  {{ title }}
                                </li>
                              </ul>
                            </div>
                            <input
                              required
                              v-model="qualification_statement.level_or_exp"
                              type="text"
                              @change="updatedFinalStatement"
                              @blur="updatedFinalStatementDB"
                              class="form-control"
                              placeholder="Level or years of experience"
                            />
                            <input
                              required
                              v-model="qualification_statement.prom_aspect"
                              type="text"
                              @change="updatedFinalStatement"
                              @blur="updatedFinalStatementDB"
                              class="form-control"
                              placeholder="Prominent aspect of your carrier"
                            />
                            <textarea
                              required
                              :value="qualification_statement.final_statement"
                              @change="updatedFinalStatement($event, 1)"
                              @blur="updatedFinalStatementDB"
                              class="form-control"
                              id="exampleFormControlTextarea1"
                              rows="3"
                              placeholder="Final statement"
                            ></textarea>
                          </div>
                        </div>
                        <router-link
                          :to="{ name: 'endorsements' }"
                          v-if="edorsement.value == 1"
                          class="btn btn-block text-style-add-btn"
                          style="
                            color: #767676;
                            font-family: 'Hind', sans-serif;
                            margin: 7px 0px;
                            font-size: 14px;
                          "
                        >
                          <i
                            class="fa fa-plus"
                            style="
                              color: #499cf9;
                              border: 1px solid #499cf9;
                              border-radius: 50%;
                              height: 20px;
                              width: 20px;
                              text-align: center;
                              line-height: 19px;
                              font-size: 12px;
                            "
                          ></i>
                          Add New<span> Endorsement</span>
                        </router-link>
                      </div>
                    </form>
                    <!-- Headline Section END -->

                    <div class="qualification_statement_headline_section">
                      <p>
                        Answer the following to build your qualification
                        Statement
                      </p>
                      <div
                        class="group mr-2 input_yak_logo input_yak_logo_label_shrink"
                      >
                        <div>
                          <input
                            maxlength="100"
                            type="text"
                            name="qualification_title"
                            id="qualification_title"
                            class="input mouseLeave"
                            style="padding-right: 40px"
                          />
                          <label class="label_name label-grey-text"
                            >Single word used to describe you</label
                          >
                        </div>
                        <span data-v-7969e6e8=""
                          ><img
                            data-v-7969e6e8=""
                            :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                            alt=""
                            data-original-title="null"
                            class="small_logo has-tooltip v-tooltip-open"
                          />
                          <div
                            aria-hidden="false"
                            x-placement="top"
                            class="tooltip"
                            style="
                              position: absolute;
                              will-change: transform;
                              top: -50px;
                              right: -128px;
                              display: none;
                              visibility: hidden;
                            "
                          >
                            <div class="tooltip-arrow" style="left: 25px"></div>
                            <div class="tooltip-inner">
                              Single word used to describe you
                            </div>
                          </div>
                        </span>
                      </div>
                      <div class="group mr-2 input_yak_logo">
                        <div>
                          <input
                            maxlength="100"
                            type="text"
                            name="qualification_position"
                            placeholder="[resumes.position_id.default_title]"
                            class="input mouseLeave"
                            style="padding-right: 40px"
                          />
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="label_name label-grey-text"
                            >Position Sought</label
                          >
                        </div>
                        <span data-v-7969e6e8=""
                          ><img
                            data-v-7969e6e8=""
                            :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                            alt=""
                            data-original-title="null"
                            class="small_logo has-tooltip v-tooltip-open"
                          />
                          <div
                            aria-hidden="false"
                            x-placement="top"
                            class="tooltip"
                            style="
                              position: absolute;
                              will-change: transform;
                              top: -50px;
                              right: -128px;
                              display: none;
                              visibility: hidden;
                            "
                          >
                            <div class="tooltip-arrow" style="left: 25px"></div>
                            <div class="tooltip-inner">
                              [resumes.position_id.default_title]
                            </div>
                          </div>
                        </span>
                      </div>
                      <div
                        class="group mr-2 input_yak_logo input_yak_logo_label_shrink"
                      >
                        <div>
                          <input
                            maxlength="100"
                            type="text"
                            name="qualification_level_experience"
                            id="qualification_level_experience"
                            class="input mouseLeave"
                            style="padding-right: 40px"
                          />
                          <label class="label_name label-grey-text"
                            >Level or years of experience</label
                          >
                        </div>
                        <span data-v-7969e6e8=""
                          ><img
                            data-v-7969e6e8=""
                            :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                            alt=""
                            data-original-title="null"
                            class="small_logo has-tooltip v-tooltip-open"
                          />
                          <div
                            aria-hidden="false"
                            x-placement="top"
                            class="tooltip"
                            style="
                              position: absolute;
                              will-change: transform;
                              top: -90px;
                              right: -128px;
                              display: none;
                              visibility: hidden;
                            "
                          >
                            <div class="tooltip-arrow" style="left: 25px"></div>
                            <div class="tooltip-inner">
                              with significant background in <br />
                              with # years of experience<br />
                              with # year history of<br />
                              with consistent history
                            </div>
                          </div>
                        </span>
                      </div>
                      <div
                        class="group mr-2 input_yak_logo input_yak_logo_label_shrink"
                      >
                        <div>
                          <input
                            maxlength="100"
                            type="text"
                            name="qualification_promoninent_aspect"
                            id="qualification_promoninent_aspect"
                            class="input mouseLeave"
                            style="padding-right: 40px"
                          />
                          <label class="label_name label-grey-text"
                            >Prominent aspect of your career</label
                          >
                        </div>
                        <span data-v-7969e6e8=""
                          ><img
                            data-v-7969e6e8=""
                            :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                            alt=""
                            data-original-title="null"
                            class="small_logo has-tooltip v-tooltip-open"
                          />
                          <div
                            aria-hidden="false"
                            x-placement="top"
                            class="tooltip"
                            style="
                              position: absolute;
                              will-change: transform;
                              top: -50px;
                              right: -128px;
                              display: none;
                              visibility: hidden;
                            "
                          >
                            <div class="tooltip-arrow" style="left: 25px"></div>
                            <div class="tooltip-inner">
                              Prominent aspect of your career
                            </div>
                          </div>
                        </span>
                      </div>
                      <div
                        class="group mr-2 input_yak_logo input_yak_logo_label_shrink"
                      >
                        <div>
                          <textarea
                            name="qualification_desc"
                            id="qualification_desc"
                            class="input mouseLeave"
                            style="padding-right: 40px; padding-top: 20px"
                          ></textarea>
                          <label class="label_name label-grey-text"
                            >Final Qualification Statement</label
                          >
                        </div>
                        <span data-v-7969e6e8=""
                          ><img
                            data-v-7969e6e8=""
                            :src="EnvPath + 'builder/images/logo/yak-icon.png'"
                            alt=""
                            data-original-title="null"
                            class="small_logo has-tooltip v-tooltip-open"
                          />
                          <div
                            aria-hidden="false"
                            x-placement="top"
                            class="tooltip"
                            style="
                              position: absolute;
                              will-change: transform;
                              top: -30px;
                              right: -128px;
                              display: none;
                              visibility: hidden;
                            "
                          >
                            <div class="tooltip-arrow" style="left: 25px"></div>
                            <div class="tooltip-inner">
                              Final Qualification Statement
                            </div>
                          </div>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- contact end  -->
              <!-- professional summary start -->
              <div
                class="card"
                v-if="sectionData.type == 'professional-summary' && resume.type == 'functional' "
              >
                <div
                  class=""
                  style="min-height: 48px; position: relative"
                  id="headingFour"
                  :class="[
                    sidbar_active.professional_summary ? 'activeSidebar' : '',
                  ]"
                >
                  <span
                    data-toggle="collapse"
                    data-target="#collapseProSec"
                    aria-expanded="false"
                    style="padding: 2px 25px 0 10px"
                    aria-controls="collapseProSec"

                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                    v-on:click="setActive('professional_summary')"
                  >
                    <!-- <img
                      :src="
                        EnvPath +
                        'builder/images/logo/education_resume_icon.png'
                      "
                      :class="[
                        sidbar_active.professional_summary
                          ? 'iconHide'
                          : 'iconShow',
                      ]"
                      class="heading_icon_sidebar"
                    />
                    <img
                      :src="
                        EnvPath +
                        'builder/images/logo/education_resume_icon_active.png'
                      "
                      class="heading_icon_sidebar heading_icon_sidebar_active"
                      :class="[
                        sidbar_active.professional_summary
                          ? 'iconShow'
                          : 'iconHide',
                      ]"
                    /> -->

                    <i
                      aria-hidden="true"
                      class="fas fa-chart-line"
                      style="
                        font-size: 18px;
                        margin-right: 8px;
                        color: #b7b7b7;
                        margin-top: -4px;
                      "
                    ></i>

                    <span class="sidebar-text-width">
                      {{
                        pro_summary_section_title
                          ? pro_summary_section_title
                          : "Professional Summary"
                      }}
                    </span>
                    <span class="drag-arrow-box"
                      ><i class="fas fa-arrows-alt"></i
                    ></span> </span
                  ><span class="visible_section_setings visible_section_sidebar" :class="[
                    sidbar_active.professional_summary ? 'eye-white' : '',
                  ]"
                    ><i
                      v-show="sectionData.hidden == 1"
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                      v-on:click="
                        showHideSidebar('professional_summary', sectionData.id)
                      "
                    ></i
                    ><i
                      v-show="sectionData.hidden == 0"
                      v-on:click="
                        showHideSidebar('professional_summary', sectionData.id)
                      "
                      class="fa fa-eye-slash show_hide_icon"
                    ></i></span
                  ><span class="Drag_Drop_section"></span>
                </div>
                <div
                  id="collapseProSec"
                  class="collapse"
                  aria-labelledby="headingFour"
                  data-parent="#accordionSidebar"
                >
                  <div id="accordionProSummary">
                    <div class="card-body">
                      <div class="sub_section_tab_button" id="collapseProSec2">
                        <button
                          type="button"
                          class="btn btn-info btn_custom_sidebar align-dropdown-arrow"
                          data-toggle="collapse"
                          data-target="#details_edu"
                          aria-expanded="false"
                          aria-controls="details_edu"
                          :style="{
                            backgroundColor: acordian_color
                              ? '#46a9fa !important'
                              : '',
                            color: acordian_color ? '#ffffff !important' : '',
                          }"
                          @click="acordianColor"
                        >
                          Settings
                          <span
                            ><i class="fa fa-caret-down"></i
                            >
                            <i class="fa fa-caret-up" style="display: none"></i>
                          </span>
                        </button>
                        <span
                          class="visible_section_setings visible_section_sidebar"
                        ></span>
                      </div>
                      <div
                        id="details_edu"
                        class="collapse"
                        aria-labelledby="collapseProSec2"
                        data-parent="#accordionProSummary"
                      >
                        <div class="group mr-2 input_yak_logo">
                          <div>
                            <input
                              maxlength="100"
                              type="text"
                              class="input mouseLeave mb-0"
                              name="section_title"
                              autocomplete="off"
                              id="section_title"
                              style="padding-right: 40px"
                              v-model="pro_summary_section_title"
                              @input="getProSummTitleSuggestion"
                              @change="updatedProSummFinalStatement"
                            />

                            <ul
                              class="single-word-list"
                              v-if="proSummTitleSuggestionArray.length > 0"
                              v-show="showProSummSectionWords"
                            >
                              <li
                                v-for="(
                                  value, key
                                ) in proSummTitleSuggestionArray"
                                :key="`#color_odds_iy${key}`"
                                @click="setProSummTitle(value.suggestion, true)"
                                :style="{
                                  'font-weight': matchingProSummTitleText(
                                    value.suggestion,
                                    pro_summary_section_title,
                                    key
                                  )
                                    ? '600'
                                    : '500',
                                }"
                              >
                                {{ value.suggestion }}
                              </li>
                            </ul>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="label_name label-grey-text"
                              >Section Title</label
                            >
                          </div>
                        </div>
                        <div class="group mr-2 input_yak_logo">
                          <textarea
                            maxlength="100"
                            type="text"
                            class="input mouseLeave mb-0 h-70"
                            name="section_title"
                            id="section_title"
                            autocomplete="off"
                            style="padding-right: 40px"
                            v-model="sectionData.content"
                            @blur="
                              saveNewSection($event, sectionData.id, 'content')
                            "
                          ></textarea>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="label_name label-grey-text bg-content-side"
                            >Custom Content</label
                          >
                        </div>
                      </div>

                      <!-- ed_array -->

                      <div
                        class="contact-profile-info no-border"
                        v-for="(
                          pro_summary_single, key
                        ) in getProSummSubSectionArray"
                        :key="`#pro_summ_${key}`"
                      >
                        <div class="sub_section_tab_button" id="SubSummary">
                          <button
                            type="button"
                            class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-color-work-experience"
                            data-toggle="collapse"
                            :data-target="`#demo_pro_summary_subsection${key}`"
                            aria-expanded="false"
                            :aria-controls="`#demo_pro_summary_subsection${key}`"
                            @click="acordianLoopActive"
                          >
                            {{
                              pro_summary_single.title ?? "Untitled Subsection"
                            }}

                            <span class="acordian-eye-icon"
                              ><i class="fa fa-caret-down"></i>
                              <i
                                class="fa fa-caret-up"
                                style="display: none"
                              ></i
                            ></span>
                          </button>
                          <span
                            class="visible_section_setings accordian-eye-arrow-two visible_section_sidebar professional-icon-eye"
                          >
                            <i
                              class="show_hide_icon"
                              @click="
                                proSummSubSectionClick(pro_summary_single.id)
                              "
                              :class="[
                                pro_summary_single.status
                                  ? 'fa fa-eye'
                                  : 'fa fa-eye-slash',
                              ]"
                            ></i>
                            <!-- <i class="fa fa-eye-slash show_hide_icon"   v-show="!pro_summary_single.status"> -->
                            <!-- </i> -->
                          </span>
                          <span
                            class="visible_section_setings visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'demo_pro_summary_subsection' + key"
                          class="collapse"
                          aria-labelledby="SubSummary"
                          data-parent="#accordionProSummary"
                        >
                          <div class="group mr-2 input_yak_logo">
                            <div class="row align-items-center">
                              <div class="col-md-9 col-sm-9 col-9">
                                <input
                                  maxlength="100"
                                  type="text"
                                  class="input mouseLeave mb-0"
                                  name="section_title"
                                  id="section_title"
                                  autocomplete="off"
                                  style="padding-right: 40px"
                                  v-model="pro_summary_single.title"
                                  @blur="
                                    saveEduSudSection(
                                      $event,
                                      pro_summary_single.id,
                                      'title'
                                    )
                                  "
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name left-26-labelname label-grey-text"
                                  >Subcategory Title</label
                                >
                              </div>
                              <div
                                class="col-md-3 col-sm-3 col-3 cursor-pointer"
                              >
                                <i
                                  @click="
                                    deleteEduSubSection(pro_summary_single.id)
                                  "
                                  class="fa fa-trash"
                                ></i>
                              </div>
                            </div>
                          </div>
                          <div class="group mr-2 input_yak_logo">
                            <div>
                              <textarea
                                maxlength="100"
                                type="text"
                                class="input mouseLeave mb-0 h-70"
                                name="section_title"
                                id="section_title"
                                autocomplete="off"
                                style="padding-right: 40px"
                                v-model="pro_summary_single.content"
                                @blur="
                                  saveEduSudSection(
                                    $event,
                                    pro_summary_single.id,
                                    'content'
                                  )
                                "
                              ></textarea>
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label class="label_name label-grey-text bg-content-side"
                                >Custom Content</label
                              >
                            </div>
                          </div>
                          <div class="endorsement_options_list_section">
                            <div
                              class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                              style="padding-right: 10px;"
                            >
                              <h6 class="f-w-500">Accomplishments</h6>
                              <!-- that are already added in the resume_experience -->
                              <div
                                class="resposibilities_items_listing selected_endorsment_item_option1"
                                v-for="(
                                  pro_summ_res_exp, resExpKeyw
                                ) in pro_summary_single.resume_experience"
                                :key="`#resExpKeyw_${resExpKeyw}`"
                              >
                                <p class="" style="padding-right: 25px">
                                  {{
                                    pro_summ_res_exp.experience
                                      ? pro_summ_res_exp.experience.description
                                      : "no data"
                                  }}
                                  <i
                                    @click="
                                      removeproSumSubSection(
                                        pro_summ_res_exp.id
                                      )
                                    "
                                    class="fa fa-trash float-right"
                                    style="
                                      position: relative;
                                      right: -20px;
                                      top: -13px;
                                    "
                                  ></i>
                                </p>
                              </div>
                              <!-- all experiences -->
                              <div
                                v-if="getResumeExperiencesArray.length > 0"
                                class="resposibilities_items_listing"
                                v-for="(
                                  res_experience, resExpKey
                                ) in filterProSummExperiences(
                                  getResumeExperiencesArray,
                                  pro_summary_single.resume_experience
                                )"
                                :key="`#resExpKey_sd${resExpKey}`"
                              >
                                <p
                                  @click.stop="
                                    checkResumeExperienceSubSection(
                                      res_experience.id,
                                      pro_summary_single.id
                                    )
                                  "
                                  class="resume-builder-non-active-item"
                                >
                                  {{ res_experience.experience.description }}
                                </p>
                              </div>

                              <div class="text-center my-4">
                                <button
                                  style="
                                    color: rgb(118, 118, 118);
                                    font-family: Hind, sans-serif;
                                    margin: 7px 0px;
                                    font-size: 14px;
                                  "
                                  class="add-blank-spcae btn btn-block text-style-add-btn"
                                  @click="addNewExperience"
                                >
                                  <i
                                    class="fa fa-plus"
                                    style="
                                      color: rgb(73, 156, 249);
                                      border: 1px solid rgb(73, 156, 249);
                                      border-radius: 50%;
                                      height: 20px;
                                      width: 20px;
                                      text-align: center;
                                      line-height: 19px;
                                      font-size: 12px;
                                    "
                                  ></i>
                                  Add New Accomplishments
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!--  edu new subsection end here -->
                      <div
                        class="card"
                        id="resume_new_section_extra_content"
                        v-if="sectionData.type == 'professional-summary'"
                      >
                        <button
                          type="button"
                          class="btn btn-block subsection-btn subsection-btn-new"
                          id="resune_new_section_button"
                          @click="addNewEduSubSection(sectionData.id)"
                        >
                          + Add New Subsection
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- professional summary end -->
              <!-- professional experience start -->
              <div class="card" v-if="sectionData.type == 'work'">
                <div
                  class="porfesional-experiance-box"
                  style="min-height: 48px; position: relative"
                  :class="[
                    sidbar_active.professional_exp ? 'activeSidebar' : '',
                  ]"
                >
                  <span
                    v-on:click="setActive('professional_exp')"
                    data-toggle="collapse"
                    data-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree"
                    id="headingThree"
                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                    style="padding-left: 10px !important"
                  >
                    <!-- <img
                      :src="
                        EnvPath +
                        'builder/images/logo/professional_experience-icon.png'
                      "
                      :class="[
                        sidbar_active.professional_exp && getJobArray.length > 0
                          ? 'iconHide'
                          : 'iconShow',
                      ]"
                      class="heading_icon_sidebar"
                    /><img
                      :src="
                        EnvPath +
                        'builder/images/logo/professional_experience-icon_active.png'
                      "
                      class="heading_icon_sidebar heading_icon_sidebar_active"
                      :class="[
                        sidbar_active.professional_exp
                          ? 'iconShow'
                          : 'iconHide',
                      ]"
                    /> -->
                    <i class="fa-solid fa-briefcase sidebar-icons-grey"></i>
                    <span class="sidebar-text-width">
                      {{
                        professional_section_title
                          ? professional_section_title
                          : "Professional Experience"
                      }}
                    </span>
                    <span class="drag-arrow-box"
                      ><i class="fas fa-arrows-alt"></i
                    ></span>
                  </span>
                  <span class="visible_section_setings visible_section_sidebar" :class="[
                    sidbar_active.professional_exp ? 'eye-white' : '',
                  ]">
                    <i
                      v-show="sectionData.hidden == 1"
                      v-on:click="
                        showHideSidebar('professional_profile', sectionData.id)
                      "
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                    ></i
                    ><i
                      v-show="sectionData.hidden == 0"
                      v-on:click="
                        showHideSidebar('professional_profile', sectionData.id)
                      "
                      class="fa fa-eye-slash show_hide_icon"
                    ></i> </span
                  ><span class="Drag_Drop_section"></span>
                </div>
                <div
                  id="collapseThree"
                  class="collapse"
                  aria-labelledby="headingThree"
                  data-parent="#accordionSidebar"
                >
                  <div id="accordion">
                    <div class="card-body">
                      <div class="sub_section_tab_button" id="headingOnehamza">
                        <button
                          type="button"
                          class="btn btn-info btn_custom_sidebar align-dropdown-arrow"
                          data-toggle="collapse"
                          data-target="#details_uni"
                          :style="{
                            backgroundColor: acordian_color
                              ? '#46a9fa !important'
                              : '',
                            color: acordian_color ? '#ffffff !important' : '',
                          }"
                          @click="acordianColor"
                          aria-expanded="false"
                          aria-controls="details_uni"
                        >
                          Settings
                          <span
                            ><i class="fa fa-caret-down"></i
                            ><i class="fa fa-caret-up" style="display: none"></i
                          ></span>
                        </button>
                        <span
                          class="visible_section_setings visible_section_sidebar"
                        ></span>
                      </div>
                      <div
                        id="details_uni"
                        class="collapse"
                        aria-labelledby="headingOnehamza"
                        data-parent="#accordion"
                      >
                        <div class="group mr-2 input_yak_logo">
                          <div>
                            <input
                              maxlength="100"
                              type="text"
                              class="input mouseLeave mb-0"
                              name="section_title"
                              id="section_title"
                              autocomplete="off"
                              style="padding-right: 40px"
                              @input="getProSectionTitleSuggestion"
                              v-model="professional_section_title"
                              @change="updatedFinalStatementPro"
                            />
                            <ul
                              class="single-word-list"
                              v-if="proTitleSuggestionArray.length > 0"
                              v-show="showProSectionWords"
                            >
                              <li
                                v-for="(value, key) in proTitleSuggestionArray"
                                :key="`#color_ods_dd_iy${key}`"
                                :style="{
                                  'font-weight': matchingProTitleText(
                                    value.suggestion,
                                    professional_section_title,
                                    key
                                  )
                                    ? '600'
                                    : '500',
                                }"
                                @click="setProSectionTitle(value.suggestion)"
                              >
                                {{ value.suggestion }}
                              </li>
                            </ul>

                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="label_name label-grey-text"
                              >Section Title</label
                            >
                          </div>
                          <span data-v-7969e6e8=""
                           ></span> <!--
                              <img
                              data-v-7969e6e8=""
                              :src="
                                EnvPath + 'builder/images/logo/yak-icon.png'
                              "
                              alt=""
                              class="small_logo has-tooltip v-tooltip-open"
                              data-original-title="null"
                            /> -->
                            <div
                              class="tooltip"
                              aria-hidden="false"
                              x-placement="top"
                              style="
                                position: absolute;
                                will-change: transform;
                                top: -91px;
                                right: -128px;
                                display: none;
                                visibility: hidden;
                              "
                            >
                              <div
                                class="tooltip-arrow"
                                style="left: 25px"
                              ></div>
                              <div
                                class="tooltip-inner"
                                style="margin-left: 0 !important"
                              >
                                Professional Summary<br />
                                Professional Experience<br />
                                Work History<br />
                                Experience
                              </div>
                            </div>
                          </span>
                        </div>
                        <h2 style="margin-top: 10px; display: inline-block">
                          Employment Dates
                        </h2>
                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_options1"
                              v-model="is_month_year"
                              @change="monthYear"
                              value="1"
                              class="custom-control-input form-check-input"
                              name="emp_options"
                            />
                            <label
                              for="emp_options1"
                              class="custom-control-label form-check-label"
                              >Month and Year</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_options2"
                              v-model="is_year"
                              @change="isYear"
                              value="2"
                              class="custom-control-input form-check-input"
                              name="emp_options"
                            />
                            <label
                              for="emp_options2"
                              class="custom-control-label form-check-label"
                              >Year Only</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_options3"
                              v-model="is_dates"
                              @change="isDate"
                              value="3"
                              class="custom-control-input form-check-input"
                              name="emp_options"
                            />
                            <label
                              for="emp_options3"
                              class="custom-control-label form-check-label"
                              >Hide Dates</label
                            >
                          </div>
                        </div>
                        <h2>Employment Locations</h2>
                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_locations1"
                              v-model="is_city_state_country"
                              @change="isCitySCW"
                              value="1"
                              class="custom-control-input form-check-input"
                              name="emp_locations"
                            />
                            <label
                              for="emp_locations1"
                              class="custom-control-label form-check-label"
                              >City, State & Country</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_locations2"
                              v-model="is_city_state"
                              @change="isCitySC"
                              value="2"
                              class="custom-control-input form-check-input"
                              name="emp_locations"
                            />
                            <label
                              for="emp_locations2"
                              class="custom-control-label form-check-label"
                              >City, State</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="emp_locations3"
                              v-model="is_location"
                              @change="isLocationW"
                              value="3"
                              class="custom-control-input form-check-input"
                              name="emp_locations"
                            />
                            <label
                              for="emp_locations3"
                              class="custom-control-label form-check-label"
                              >Hide Location</label
                            >
                          </div>
                        </div>
                        <h2>Other</h2>
                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="checkbox"
                              id="job_other_desc"
                              v-model="job_description"
                              @click="JobDescription"
                              value="option2"
                              class="custom-control-input form-check-input"
                              name="job_other_desc"
                            />
                            <label
                              for="job_other_desc"
                              class="custom-control-label form-check-label"
                              >Job Descriptions</label
                            >
                          </div>
                        </div>
                      </div>

                      <div id="JobSection">
                        <div
                          v-for="(resumejob, keyOne) in getJobArray.filter(
                            (ae) => ae.active == 1
                          )"
                          :key="`#demo_show${keyOne}`"
                          @dragover="
                            (e) => onDragJobOver(resumejob, resumejob.id, e)
                          "
                          @dragend="
                            (e) =>
                              finishJobDrag(
                                resumejob,
                                resumejob.id,
                                (hide = true),
                                e
                              )
                          "
                          @dragstart="
                            (e) => startJobDrag(resumejob, resumejob.id, e)
                          "
                          class="contact-profile-info no-border"
                          :class="{
                            over:
                              resumejob === over.resumejob &&
                              resumejob !== dragFrom,
                            [over.dir]:
                              resumejob === over.resumejob && item !== dragFrom,
                          }"
                          draggable="true"
                        >
                          <div class="sub_section_tab_button">
                            <button
                              type="button"
                              class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-color-work-experience"
                              data-toggle="collapse"
                              :data-target="`#demo${keyOne}`"
                              aria-expanded="false"
                              :aria-controls="`#demo${keyOne}`"
                              @click="acordianLoopActive(keyOne)"
                            >
                              <p style="padding-right: 45px">
                                {{ resumejob.job ? resumejob.job.company : "" }}
                              </p>

                              <span class="drag-arrow-box-work-experience"
                                ><i class="fas fa-arrows-alt"></i
                              ></span>

                              <i
                                style="margin-top: 0"
                                class="i-position acordian-eye-icon"
                                @click="
                                  jobInfoEyeClick(resumejob, resumejob.id)
                                "
                                :class="[
                                  resumejob.active
                                    ? 'fa fa-eye'
                                    : 'fa fa-eye-slash',
                                ]"
                              ></i>
                              <span class="accordian-eye-arrow"
                                ><i class="fa fa-caret-down"></i
                                ><i
                                  class="fa fa-caret-up"
                                  style="display: none"
                                ></i
                              ></span>
                            </button>
                            <span
                              class="visible_section_setings visible_section_sidebar"
                            ></span>
                          </div>
                          <div
                            :id="'demo' + keyOne"
                            class="collapse"
                            aria-labelledby="JobSection"
                            data-parent="#accordion"
                          >
                            <div class="endorsement_options_list_section">
                              <div
                                class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                              >
                                <div v-if="resume.type == 'functional'">
                                  <h6 class="f-w-500">Accomplishments</h6>
                                  <div
                                    v-if="resumejob.job.experiences.length > 0"
                                    class="d-flex justify-content-between align-items-center mx-3 mb-3 contact-profile-info pt-2 pb-1 px-2"
                                    v-for="(
                                      experience, experienceKey
                                    ) in sortArray(
                                      resumejob.job.experiences
                                    ).filter((as) => as.status == 1)"
                                    :key="`#demo_exp_show_${experienceKey}`"
                                    @dragover="
                                      (e) =>
                                        onDragExperienceOver(
                                          experience,
                                          experience.id,
                                          e
                                        )
                                    "
                                    @dragend="
                                      (e) =>
                                        finishExperienceDrag(
                                          resumejob.job.experiences,
                                          experience,
                                          experience.id,
                                          (hide = true),
                                          e
                                        )
                                    "
                                    @dragstart="
                                      (e) =>
                                        startExperienceDrag(
                                          experience,
                                          experience.id,
                                          e
                                        )
                                    "
                                    :class="{
                                      over_exp:
                                        experience === over_exp.experience &&
                                        experience !== dragFrom,
                                      [over_exp.dir]:
                                        experience === over_exp.experience &&
                                        experience !== dragFrom,
                                    }"
                                    draggable="true"
                                  >
                                    <p @click="changeExperience(experience)">
                                      {{ experience.description }}
                                    </p>
                                  </div>

                                  <div
                                    v-if="resumejob.job.experiences.length > 0"
                                    class="d-flex justify-content-between align-items-center mx-3 mb-3 contact-profile-info pt-2 pb-1 px-2 resume-builder-non-active-item"
                                    v-for="(
                                      experience, experienceKey
                                    ) in sortArray(
                                      resumejob.job.experiences
                                    ).filter((as) => as.status == 0)"
                                    :key="`#demo_exp_hide_${experienceKey}`"
                                    @dragover="
                                      (e) =>
                                        onDragExperienceOver(
                                          experience,
                                          experience.id,
                                          e
                                        )
                                    "
                                    @dragend="
                                      (e) =>
                                        finishExperienceDrag(
                                          resumejob.job.experiences,
                                          experience,
                                          experience.id,
                                          (hide = false),
                                          e
                                        )
                                    "
                                    @dragstart="
                                      (e) =>
                                        startExperienceDrag(
                                          experience,
                                          experience.id,
                                          e
                                        )
                                    "
                                    :class="{
                                      over:
                                        experience === over.experience &&
                                        experience !== dragFrom,
                                      [over.dir]:
                                        resumejob === over.experience &&
                                        item !== dragFrom,
                                    }"
                                    draggable="true"
                                  >
                                    <p @click="changeExperience(experience)">
                                      {{ experience.description }}
                                    </p>
                                  </div>

                                  <div class="text-center my-3">
                                    <button
                                      class="add-blank-spcae"
                                      style="font-size: 15px"
                                      @click="addNewExperience"
                                    >
                                      <i
                                        class="fa fa-plus"
                                        style="
                                          color: #499cf9;
                                          border: 1px solid #499cf9;
                                          border-radius: 50%;
                                          height: 20px;
                                          width: 20px;
                                          text-align: center;
                                          line-height: 19px;
                                          font-size: 12px;
                                        "
                                      ></i>
                                      Add New<span> Accomplishments</span>
                                    </button>
                                  </div>
                                </div>
                                <h6 class="f-w-500">Endorsements</h6>
                                <div class="">
                                  <div
                                    class="resposibilities_items_listing"
                                    v-for="(endorse, endorseKey) in resumejob
                                      .job.endorsements"
                                    @click="showEndorsement(endorse)"
                                    :class="[
                                      endorse.status
                                        ? 'border-red'
                                        : 'selected_endorsment_item_option1',
                                    ]"
                                    :id="'endorse_id_' + endorseKey"
                                  >
                                    <h4 @click="">
                                      “{{ endorse.value }}”
                                      <span
                                        >– {{ endorse.author }},
                                        {{ endorse.author_description }},
                                        {{ resumejob.job ? resumejob.job.company : '' }}

                                      </span>
                                    </h4>
                                  </div>

                                  <div class="text-center my-4">
                                    <button
                                      class="add-blank-spcae"
                                      style="font-size: 16px"
                                      @click="addNewEndorsement"
                                    >
                                      <i
                                        class="fa fa-plus"
                                        style="
                                          color: #499cf9;
                                          border: 1px solid #499cf9;
                                          border-radius: 50%;
                                          height: 20px;
                                          width: 20px;
                                          text-align: center;
                                          line-height: 19px;
                                          font-size: 12px;
                                        "
                                      ></i>
                                      Add New<span> Endorsement</span>
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div
                        id="deActiveJobs"
                        v-for="(resumejob, keyTwo) in getJobArray.filter(
                          (ae) => ae.active == 0
                        )"
                        :key="`#demo_hide${keyTwo}`"
                        @dragover="
                          (e) => onDragJobOver(resumejob, resumejob.id, e)
                        "
                        @dragend="
                          (e) =>
                            finishJobDrag(
                              resumejob,
                              resumejob.id,
                              (hide = true),
                              e
                            )
                        "
                        @dragstart="
                          (e) => startJobDrag(resumejob, resumejob.id, e)
                        "
                        class="resume-builder-non-active-item"
                        :class="{
                          over_exp:
                            resumejob === over_exp.resumejob &&
                            resumejob !== dragFrom,
                          [over_exp.dir]:
                            resumejob === over_exp.resumejob &&
                            item !== dragFrom,
                        }"
                        draggable="true"
                      >
                        <div class="sub_section_tab_button">
                          <button
                            type="button"
                            class="btn btn-info btn_custom_sidebar sidebar-bg-grey align-dropdown-arrow justify-content-between"
                            data-toggle="collapse"
                            :data-target="`#demo_hide${keyTwo}`"
                            aria-expanded="false"
                            :aria-controls="`#demo_hide${keyTwo}`"
                          >
                            {{ resumejob.job ? resumejob.job.company : "" }}
                            <i
                              class="i-position"
                              @click="jobInfoEyeClick(resumejob, resumejob.id)"
                              :class="[
                                resumejob.active
                                  ? 'fa fa-eye'
                                  : 'fa fa-eye-slash',
                              ]"
                            ></i>
                            <span class="acordian-eye-icon"
                              ><i class="fa fa-caret-down"></i
                              ><i
                                class="fa fa-caret-up"
                                style="display: none"
                              ></i
                            ></span>
                          </button>

                          <span
                            class="visible_section_setings visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'demo_hide' + keyTwo"
                          class="collapse"
                          aria-labelledby="deActiveJobs"
                          data-parent="#accordion"
                        >
                          <div class="endorsement_options_list_section">
                            <div
                              class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                            >
                              <div class="">
                                <h6 class="f-w-500">Accomplishments</h6>
                                <div
                                  v-if="resumejob.job.experiences.length > 0"
                                  class="resposibilities_items_listing selected_endorsment_item_option1"
                                  v-for="(
                                    experience, experienceKey
                                  ) in resumejob.job.experiences"
                                >
                                  <p class="">
                                    {{ experience.description }}
                                  </p>
                                </div>

                                <div class="text-center my-3">
                                  <button
                                    style="
                                      color: rgb(118, 118, 118);
                                      font-family: Hind, sans-serif;
                                      margin: 7px 0px;
                                      font-size: 14px;
                                    "
                                    class="add-blank-spcae btn btn-block text-style-add-btn"
                                    @click="addNewExperience"
                                  >
                                    <i
                                      class="fa fa-plus"
                                      style="
                                        color: rgb(73, 156, 249);
                                        border: 1px solid rgb(73, 156, 249);
                                        border-radius: 50%;
                                        height: 20px;
                                        width: 20px;
                                        text-align: center;
                                        line-height: 19px;
                                        font-size: 12px;
                                      "
                                    ></i>
                                    Add New Accomplishments
                                  </button>
                                </div>
                              </div>
                              <div class="">
                                <h6 class="f-w-500">Endorsement</h6>
                                <div
                                  class="resposibilities_items_listing selected_endorsment_item_option1"
                                  v-for="(endorse, endorseKey) in resumejob.job
                                    .endorsements"
                                >
                                  <p class="">“{{ endorse.value }}”</p>
                                </div>

                                <div class="text-center my-3">
                                  <button
                                    class="add-blank-spcae"
                                    @click="addNewEndorsement"
                                  >
                                    +Add New Endorsement
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                   <div
                        class="card"
                        id="resume_new_section_extra_content"

                      >
                        <button
                          type="button"
                          class="btn btn-block subsection-btn subsection-btn-new"
                          id="resune_new_section_button"
                          @click="addNewWorkExperience"
                        >
                          + Add New Work Experience
                        </button>
                      </div>
                    </div>

                  </div>


                </div>
              </div>
              <!-- professional experience end  -->
              <!-- education start -->
              <div class="card" v-if="sectionData.type == 'education'">
                <div
                  class=""
                  style="min-height: 48px; position: relative"
                  id="headingFour"
                  :class="[sidbar_active.education ? 'activeSidebar' : '']"
                >
                  <span
                    data-toggle="collapse"
                    data-target="#collapseFour"
                    aria-expanded="false"
                    style="padding: 2px 25px 0 10px"
                    aria-controls="collapseFour"
                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                    v-on:click="setActive('education')"
                  >
                    <!-- <img
                      :src="
                        EnvPath +
                        'builder/images/logo/education_resume_icon.png'
                      "
                      :class="[
                        sidbar_active.education ? 'iconHide' : 'iconShow',
                      ]"
                      class="heading_icon_sidebar"
                    /><img
                      :src="
                        EnvPath +
                        'builder/images/logo/education_resume_icon_active.png'
                      "
                      class="heading_icon_sidebar heading_icon_sidebar_active"
                      :class="[
                        sidbar_active.education ? 'iconShow' : 'iconHide',
                      ]"
                    /> -->

                     <i class="fal fa-book-open sidebar-icons-grey" style="font-weight: 800;"></i>
                    <span class="sidebar-text-width">
                      <i class="fa-regular fa-book-open-cover"></i>
                      {{
                        education_section_title
                          ? education_section_title
                          : "Education"
                      }}
                    </span>

                    <span class="drag-arrow-box"
                      ><i class="fas fa-arrows-alt"></i
                    ></span> </span
                  ><span class="visible_section_setings visible_section_sidebar" :class="[
                    sidbar_active.education ? 'eye-white' : '',
                  ]"
                    ><i
                      v-show="sectionData.hidden == 1"
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                      v-on:click="showHideSidebar('education', sectionData.id)"
                    ></i
                    ><i
                      v-show="sectionData.hidden == 0"
                      v-on:click="showHideSidebar('education', sectionData.id)"
                      class="fa fa-eye-slash show_hide_icon"
                    ></i></span
                  ><span class="Drag_Drop_section"></span>
                </div>
                <div
                  id="collapseFour"
                  class="collapse"
                  aria-labelledby="headingFour"
                  data-parent="#accordionSidebar"
                >
                  <div id="accordionEducation">
                    <div class="card-body">
                      <div class="sub_section_tab_button" id="educationAccord">
                        <button
                          type="button"
                          class="btn btn-info btn_custom_sidebar align-dropdown-arrow"
                          data-toggle="collapse"
                          data-target="#details_edu"
                          aria-expanded="false"
                          aria-controls="details_edu"
                          :style="{
                            backgroundColor: acordian_color
                              ? '#46a9fa !important'
                              : '',
                            color: acordian_color ? '#ffffff !important' : '',
                          }"
                          @click="acordianColor"
                        >
                          Settings
                          <span
                            ><i class="fa fa-caret-down"></i
                            ><i class="fa fa-caret-up" style="display: none"></i
                          ></span>
                        </button>
                        <span
                          class="visible_section_setings visible_section_sidebar"
                        ></span>
                      </div>
                      <div
                        id="details_edu"
                        aria-labelledby="educationAccord"
                        data-parent="#accordionEducation"
                        class="collapse"
                      >
                        <div class="group mr-2 input_yak_logo">
                          <div>
                            <input
                              maxlength="100"
                              type="text"
                              class="input mouseLeave mb-0"
                              name="section_title"
                              id="section_title"
                              autocomplete="off"
                              style="padding-right: 40px"
                              v-model="education_section_title"
                              @input="getEduSectionTitleSuggestion"
                              @change="updatedEduFinalStatement"
                            />

                            <ul
                              class="single-word-list"
                              v-if="eduTitleSuggestionArray.length > 0"
                              v-show="showEduSectionWords"
                            >
                              <li
                                v-for="(value, key) in eduTitleSuggestionArray"
                                :key="`#coloddr_ods_dd_iy${key}`"
                                @click="
                                  setEduSectionTitle(value.suggestion, true)
                                "
                                :style="{
                                  'font-weight': matchingEduTitleText(
                                    value.suggestion,
                                    education_section_title,
                                    key
                                  )
                                    ? '600'
                                    : '500',
                                }"
                              >
                                {{ value.suggestion }}
                              </li>
                            </ul>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="label_name label-grey-text"
                              >Section Title</label
                            >
                          </div>

                          <!-- static content box -->

                          <div class="group mr-2 input_yak_logo mt-2">
                            <textarea
                              maxlength="100"
                              type="text"
                              name="section_title"
                              id="section_title"
                              autocomplete="off"
                              class="input mouseLeave mb-0 h-70"
                              style="padding-right: 40px"
                            ></textarea>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="label_name label-grey-text bg-content-side"
                              >Custom Content</label
                            >
                          </div>

                          <!-- static content box -->
                        </div>
                        <!-- subSection Column education -->
                        <div class="sub-section-columns">

                          <div class="sub-section-column-tooltip">
                            <h1>Subsection Columns</h1>

                            <!-- <div class="sub-section-column-tooltip">
                              <div class="yawk-icon-tooltip">
                                  <div class="yewk-text-box">
                                    <span>"Clicking 'Columns' with excess content will cause overflow to the next page."</span>
                                  </div>

                                  <img
                                    :src="EnvPath + 'images/bg/help.png'"
                                    alt
                                    class="small_logo"
                                  />
                              </div>
                            </div> -->

                            <div class="yawk-icon-tooltip">
                                <div class="yewk-text-box">
                                  <span>"Clicking 'Columns' with excess content will cause overflow to the next page."</span>
                                </div>

                                <img
                                  :src="EnvPath + 'images/bg/help.png'"
                                  alt
                                  class="small_logo"
                                />
                            </div>
                          </div>

                          <div class="subsection-column-box">
                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkOne"
                                name="column-check-edu"
                                class="input-column-section"
                                value="1"
                                :checked="1 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label for="checkOne" class="single-boxes-value">
                                <span class="box-one"></span>
                                <span class="digit-circle">1</span>
                              </label>
                            </div>

                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkTwo"
                                name="column-check-edu"
                                class="input-column-section"
                                value="2"
                                :checked="2 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label for="checkTwo" class="single-boxes-value">
                                <span
                                  class="box-one"
                                  style="margin: 0 5px"
                                ></span>
                                <span
                                  class="box-one"
                                  style="margin: 0 5px"
                                ></span>
                                <span class="digit-circle">2</span>
                              </label>
                            </div>

                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkThree"
                                name="column-check-edu"
                                class="input-column-section"
                                value="3"
                                :checked="3 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label
                                for="checkThree"
                                class="single-boxes-value"
                              >
                                <span class="box-one"></span>
                                <span class="box-one"></span>
                                <span class="box-one"></span>
                                <span class="digit-circle">3</span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <!-- subSection Column -->

                        <h2 style="margin-top: 10px; display: inline-block">
                          Graduation Date Format
                        </h2>
                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="graducation_date_format1"
                              v-model="is_month_year_g"
                              @click="monthYearG"
                              value="1"
                              class="custom-control-input form-check-input"
                              name="graducation_date_format"
                            />
                            <label
                              for="graducation_date_format1"
                              class="custom-control-label form-check-label"
                              >Month and Year</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="graducation_date_format2"
                              v-model="is_year_g"
                              @click="isYearG"
                              value="2"
                              class="custom-control-input form-check-input"
                              name="graducation_date_format"
                            />
                            <label
                              for="graducation_date_format2"
                              class="custom-control-label form-check-label"
                              >Year Only</label
                            >
                          </div>
                        </div>
                        <h2>School Location</h2>

                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="school_locations1"
                              value="City, State & Country"
                              v-model="schoolLocation"
                              @click="isEduCityStateCountry"
                              class="custom-control-input form-check-input"
                              name="school_locations"
                            />
                            <label
                              for="school_locations1"
                              class="custom-control-label form-check-label"
                              >City, State & Country</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="school_locations2"
                              value="City, State"
                              v-model="schoolLocation"
                              @click="isEduCityState"
                              class="custom-control-input form-check-input"
                              name="school_locations"
                            />
                            <label
                              for="school_locations2"
                              class="custom-control-label form-check-label"
                              >City, State</label
                            >
                          </div>
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              id="school_locations3"
                              value="Hide Location"
                              v-model="schoolLocation"
                              @click="isEdulocation"
                              class="custom-control-input form-check-input"
                              name="school_locations"
                            />
                            <label
                              for="school_locations3"
                              class="custom-control-label form-check-label"
                              >Hide Location</label
                            >
                          </div>
                        </div>
                      </div>

                      <!-- ed_array -->
                      <div
                        class="contact-profile-info no-border"
                        v-for="(education, key) in getEduArray.filter(
                          (ae) => ae.status == 1
                        )"
                        :key="`#demo_resum${key}`"
                        @dragover="
                          (e) => onDragEduOver(education, education.id, e)
                        "
                        @dragend="
                          (e) =>
                            finishEduDrag(
                              education,
                              education.id,
                              (hide = true),
                              e
                            )
                        "
                        @dragstart="
                          (e) => startEduDrag(education, education.id, e)
                        "
                        :class="{
                          over_edu:
                            education === over_edu.education &&
                            education !== dragFrom,
                          [over_edu.dir]:
                            education === over_edu.education &&
                            item !== dragFrom,
                        }"
                        draggable="true"
                      >
                        <div class="sub_section_tab_button" id="EducationOne">
                          <button
                            type="button"
                            class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-color-work-experience"
                            data-toggle="collapse"
                            :data-target="`#demo_education${key}`"
                            aria-expanded="false"
                            :aria-controls="`#demo_education${key}`"
                            @click="acordianLoopActive"
                          >
                            {{ education.school }}

                            <i
                              class="i-position acordian-eye-icon"
                              @click="eduInfoEyeClick(education, education.id)"
                              :class="[
                                education.status
                                  ? 'fa fa-eye'
                                  : 'fa fa-eye-slash',
                              ]"
                            ></i>
                            <span class="accordian-eye-arrow"
                              ><i class="fa fa-caret-down"></i
                              ><i
                                class="fa fa-caret-up"
                                style="display: none"
                              ></i
                            ></span>
                          </button>
                          <span
                            class="visible_section_setings visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'demo_education' + key"
                          class="collapse"
                          aria-labelledby="EducationOne"
                          data-parent="#accordionEducation"
                        >
                          <div class="more_checkbox_section">
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                :id="education.id"
                                :value="education.id"
                                class="custom-control-input form-check-input"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_degree',
                                    false
                                  )
                                "
                                :disabled="checkEduDegree(education) == false"
                                :checked="
                                  education.is_degree == 1 ? true : false
                                "
                              />
                              <label
                                :for="`${education.id}`"
                                class="custom-control-label form-check-label"
                                >Degree</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                              v-if="education.major !== null"
                            >
                              <input
                                type="checkbox"
                                :id="'major_field_' + education.id"
                                :value="education.id"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_major_field_study',
                                    false
                                  )
                                "
                                :checked="
                                  education.is_major_field_study == 1
                                    ? true
                                    : false
                                "
                              />
                              <label
                                :for="`major_field_${education.id}`"
                                class="custom-control-label form-check-label"
                                >Major / Field of Study</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                :id="'graduatoin_date_' + education.id"
                                :value="education.id"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_grad_date',
                                    false
                                  )
                                "
                                :checked="
                                  education.is_grad_date == 1 ? true : false
                                "
                              />
                              <label
                                :for="`graduatoin_date_${education.id}`"
                                class="custom-control-label form-check-label"
                                >Hide Graduation Date</label
                              >
                            </div>

                            <div
                              v-if="
                                education.credits_completed !== null &&
                                getShowEducationEnhancement
                              "
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                :id="'credits_completed_' + education.id"
                                :value="education.id"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_credits_completed',
                                    false
                                  )
                                "
                                :checked="
                                  education.is_credits_completed == 1
                                    ? true
                                    : false
                                "
                              />
                              <label
                                :for="`credits_completed_${education.id}`"
                                class="custom-control-label form-check-label"
                                >Credits Completed</label
                              >
                            </div>

                            <div
                              v-if="
                                education.overallgpa !== null &&
                                getShowEducationEnhancement
                              "
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                :id="'overall_' + education.id"
                                :value="education.id"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_overall_gpa',
                                    false
                                  )
                                "
                                :checked="
                                  education.is_overall_gpa == 1 ? true : false
                                "
                              />
                              <label
                                :for="`overall_${education.id}`"
                                class="custom-control-label form-check-label"
                                >Overall GPA</label
                              >
                            </div>
                            <div
                              v-if="
                                education.majorgpa !== null &&
                                getShowEducationEnhancement
                              "
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                                :id="'major_gpa_' + education.id"
                                :value="education.id"
                                @click="
                                  isEducationOptionChange(
                                    $event,
                                    'is_major_gpa',
                                    false
                                  )
                                "
                                :checked="
                                  education.is_major_gpa == 1 ? true : false
                                "
                              />
                              <label
                                :for="`major_gpa_${education.id}`"
                                class="custom-control-label form-check-label"
                                >Major GPA</label
                              >
                            </div>
                          </div>
                          <div class="more_checkbox_section">
                            <div
                              v-if="
                                checkGpaVlidation(education) == true &&
                                getShowEducationEnhancement
                              "
                            >
                              <h2>GPA</h2>
                              <div
                                class="custom-control custom-radio form-check form-check-inline finder_job_check"
                              >
                                <input
                                  type="radio"
                                  class="custom-control-input form-check-input"
                                  name="school_gpa_options"
                                  :id="'gpa_format_' + education.id"
                                  :value="education.id"
                                  @change="
                                    isEducationOptionChange(
                                      $event,
                                      'gpa_format',
                                      'full'
                                    )
                                  "
                                  :checked="education.gpa_format === 'full'"
                                />
                                <label
                                  :for="`gpa_format_${education.id}`"
                                  class="custom-control-label form-check-label"
                                  >#.# out of #.#</label
                                >
                              </div>
                              <div
                                class="custom-control custom-radio form-check form-check-inline finder_job_check"
                              >
                                <input
                                  type="radio"
                                  class="custom-control-input form-check-input"
                                  name="school_gpa_options"
                                  :id="'gpa_format_simple' + education.id"
                                  :value="education.id"
                                  @change="
                                    isEducationOptionChange(
                                      $event,
                                      'gpa_format',
                                      'simple'
                                    )
                                  "
                                  :checked="education.gpa_format === 'simple'"
                                />
                                <label
                                  :for="`gpa_format_simple${education.id}`"
                                  class="custom-control-label form-check-label"
                                  >#.#</label
                                >
                              </div>
                            </div>
                            <div
                              class="endorsement_options_list_section"
                              v-if="
                                education.minors.length > 0 &&
                                getShowEducationEnhancement
                              "
                            >
                              <p><b>Minors</b></p>

                              <div
                                class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                              >
                                <div class="force-overflow">
                                  <div
                                    class="resposibilities_items_listing selected_endorsment_item_option1"
                                    v-for="(
                                      minor, keyMinorActive
                                    ) in sortMinorArray(
                                      education.minors
                                    ).filter((ae) => ae.status == 1)"
                                    :key="`#demo_minor_active${keyMinorActive}`"
                                    @dragover="
                                      (e) => onDragMinorOver(minor, minor.id, e)
                                    "
                                    @dragend="
                                      (e) =>
                                        finishMinorDrag(
                                          education.minors,
                                          minor,
                                          minor.id,
                                          (hide = true),
                                          e
                                        )
                                    "
                                    @dragstart="
                                      (e) => startMinorDrag(minor, minor.id, e)
                                    "
                                    :class="{
                                      over_minor:
                                        minor === over_minor.minor &&
                                        minor !== dragFrom,
                                      [over_minor.dir]:
                                        minor === over_minor.minor &&
                                        item !== dragFrom,
                                    }"
                                    draggable="true"
                                  >
                                    <p class="" @click="changeMinor(minor)">
                                      {{ minor.minor }}
                                    </p>
                                  </div>
                                  <div
                                    class="resposibilities_items_listing"
                                    v-for="(
                                      minor, keyMinorOff
                                    ) in sortMinorArray(
                                      education.minors
                                    ).filter((ae) => ae.status == 0)"
                                    :key="`#demo_minor_off${keyMinorOff}`"
                                    @dragover="
                                      (e) => onDragMinorOver(minor, minor.id, e)
                                    "
                                    @dragend="
                                      (e) =>
                                        finishMinorDrag(
                                          education.minors,
                                          minor,
                                          minor.id,
                                          (hide = false),
                                          e
                                        )
                                    "
                                    @dragstart="
                                      (e) => startMinorDrag(minor, minor.id, e)
                                    "
                                    :class="{
                                      over_minor:
                                        minor === over_minor.minor &&
                                        minor !== dragFrom,
                                      [over_minor.dir]:
                                        minor === over_minor.minor &&
                                        item !== dragFrom,
                                    }"
                                    draggable="true"
                                  >
                                    <div class="resposibilities_items_listing">
                                      <p @click="changeMinor(minor)">
                                        {{ minor.minor }}
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- inactive education -->
                      <div
                        class=""
                        v-for="(education, key) in getEduArray.filter(
                          (ae) => ae.status == 0
                        )"
                        :key="`#demo_resume${key}`"
                        @dragover="
                          (e) => onDragEduOver(education, education.id, e)
                        "
                        @dragend="
                          (e) =>
                            finishEduDrag(
                              education,
                              education.id,
                              (hide = false),
                              e
                            )
                        "
                        @dragstart="
                          (e) => startEduDrag(education, education.id, e)
                        "
                        :class="{
                          over_edu:
                            education === over_edu.education &&
                            education !== dragFrom,
                          [over_edu.dir]:
                            education === over_edu.education &&
                            item !== dragFrom,
                        }"
                        draggable="true"
                      >
                        <div
                          class="sub_section_tab_button"
                          id="inActiveEducation"
                        >
                          <button
                            type="button"
                            class="btn btn-info btn_custom_sidebar sidebar-bg-grey align-dropdown-arrow"
                            data-toggle="collapse"
                            :data-target="`#demo_educations${key}`"
                            aria-expanded="true"
                            :aria-controls="`#demo_educations${key}`"
                          >
                            {{ education.school }}
                            <i
                              class="i-position"
                              @click="eduInfoEyeClick(education, education.id)"
                              :class="[
                                education.status
                                  ? 'fa fa-eye'
                                  : 'fa fa-eye-slash',
                              ]"
                            ></i>
                            <span class="acordian-eye-icon"
                              ><i class="fa fa-caret-down"></i
                              ><i
                                class="fa fa-caret-up"
                                style="display: none"
                              ></i
                            ></span>
                          </button>
                          <span
                            class="visible_section_setings visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'demo_educations' + key"
                          class="collapse"
                          aria-labelledby="inActiveEducation"
                          data-parent="#accordionEducation"
                        >
                          <div class="more_checkbox_section">
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                id="school_other_options"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                              />
                              <label
                                for="school_other_options"
                                class="custom-control-label form-check-label"
                                >Degree</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                id="school_other_options2"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                              />
                              <label
                                for="school_other_options2"
                                class="custom-control-label form-check-label"
                                >Major / Field of Study</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                id="school_other_options3"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                              />
                              <label
                                for="school_other_options3"
                                class="custom-control-label form-check-label"
                                >Hide Graduation Date</label
                              >
                            </div>
                            <div
                              class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="checkbox"
                                id="school_other_options4"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_other_options"
                              />
                              <label
                                for="school_other_options4"
                                class="custom-control-label form-check-label"
                                >Credits Completed</label
                              >
                            </div>
                          </div>
                          <h2>GPA</h2>
                          <div class="more_checkbox_section">
                            <div
                              class="custom-control custom-radio form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="radio"
                                id="school_gpa_options"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_gpa_options"
                              />
                              <label
                                for="school_gpa_options"
                                class="custom-control-label form-check-label"
                                >#.# out of #.#</label
                              >
                            </div>
                            <div
                              class="custom-control custom-radio form-check form-check-inline finder_job_check"
                            >
                              <input
                                type="radio"
                                id="school_gpa_options2"
                                value="option2"
                                class="custom-control-input form-check-input"
                                name="school_gpa_options"
                              />
                              <label
                                for="school_gpa_options2"
                                class="custom-control-label form-check-label"
                                >#.#</label
                              >
                            </div>

                            <div class="endorsement_options_list_section">
                              <div
                                class="edu_fields_section scrollbar scrollbar-indigo bordered-indigo thin"
                              >
                                <div class="force-overflow">
                                  <div
                                    class="resposibilities_items_listing selected_endorsment_item_option1"
                                    v-for="(minor, keyOne) in education.minors"
                                  >
                                    <p class="">
                                      {{ minor.minor }}
                                    </p>
                                  </div>

                                  <div
                                    class="resposibilities_items_listing selected_endorsment_item_option2"
                                  >
                                    <p>Dean’s honor society</p>
                                  </div>
                                  <div class="resposibilities_items_listing">
                                    <p>Ski Club</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--  edu new subsection start here -->

                      <div
                        v-for="(eduSubSection, index) in getEduSubSectionArray"
                        :key="`#hello_${index}`"
                      >

                        <div class="sub_section_tab_button">
                          <div class="eye-btn-control" id="subSecEducation">
                            <button
                              type="button"
                              class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-open-blue-back"
                              data-toggle="collapse"
                              :data-target="`#untitled_set_${index}`"
                              aria-expanded="false"
                              :aria-controls="`#untitled_set_${index}`"
                              @click="closeAllEduSubSectionContentType"
                            >
                              <p class="span-eye-text-control">
                                {{
                                  eduSubSection.title
                                    ? eduSubSection.title
                                    : "Untitled Subsection"
                                }}
                              </p>

                              <span class="acordian-eye-icon space-remove-open"
                                ><i class="fa fa-caret-down"></i
                                ><i
                                  class="fa fa-caret-up"
                                  style="display: none"
                                ></i
                              ></span>
                            </button>

                            <i
                              style="margin-top: 0"
                              class="i-position accordian-eye-arrow eye-hide-show-section"
                              @click="
                                eduSubSectionEyeClick(
                                  eduSubSection,
                                  eduSubSection.id
                                )
                              "
                              :class="[
                                eduSubSection.status
                                  ? 'fa fa-eye'
                                  : 'fa fa-eye-slash',
                              ]"
                            ></i>
                          </div>
                          <span
                            class="visible_section_setings visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'untitled_set_' + index"
                          class="collapse"
                          aria-labelledby="subSecEducation"
                          data-parent="#accordionEducation"
                        >
                          <div class="group mr-2 input_yak_logo">
                            <div class="row align-items-center">
                              <div class="col-md-9 col-sm-9 col-9">
                                <input
                                  maxlength="100"
                                  type="text"
                                  class="input mouseLeave mb-0"
                                  name="section_title"
                                  id="section_title"
                                  autocomplete="off"
                                  style="padding-right: 40px"
                                  v-model="eduSubSection.title"
                                  @blur="
                                    saveEduSudSection(
                                      $event,
                                      eduSubSection.id,
                                      'title'
                                    )
                                  "
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name left-26-labelname label-grey-text"
                                  >SubSection Title</label
                                >
                              </div>
                              <div
                                class="col-md-3 col-sm-3 col-3 cursor-pointer"
                              >
                                <i
                                  @click="deleteEduSubSection(eduSubSection.id)"
                                  class="fa fa-trash"
                                ></i>
                              </div>
                            </div>
                          </div>
                          <div class="group mr-2 input_yak_logo">
                            <div>
                              <textarea
                                maxlength="100"
                                type="text"
                                class="input mouseLeave mb-0 h-70"
                                name="section_title"
                                id="section_title"
                                autocomplete="off"
                                style="padding-right: 40px"
                                v-model="eduSubSection.content"
                                @blur="
                                  saveEduSudSection(
                                    $event,
                                    eduSubSection.id,
                                    'content'
                                  )
                                "
                              ></textarea>
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label class="label_name label-grey-text bg-content-side"
                                >Custom Content


                                </label
                              >
                            </div>


                          </div>
                          <div class="group mr-2 input_yak_logo">
                            <div>
                              <select
                                name="list_style"
                                id="month"
                                class="select-item input-info"
                                @change="
                                  saveEduSudSection(
                                    $event,
                                    eduSubSection.id,
                                    'list_style'
                                  )
                                "
                              >
                                <option
                                  v-for="(subsetion, key) in list_styles"
                                  :value="key"
                                  class="label_name label-grey-text"
                                  :selected="
                                    key == eduSubSection.list_style ? true : ''
                                  "
                                  :disabled="checkSubSectionColumn(sectionData.column,key)"
                                >
                                  {{ subsetion.title }}
                                </option>
                              </select>
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label
                                class="label_name padding-left-list-style label-grey-text"
                                >List Style</label
                              >
                            </div>
                          </div>
                          <p><b>Content</b></p>
                          <!-- edu_sub_section_content -->
                          <div class="content-background-box">
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                eduSubSection.edu_sub_section_content.length > 0
                              "
                            >
                              <div
                                class="resposibilities_items_listing selected_endorsment_item_option1"
                                v-for="(
                                  edu_subSection_content, keyeduSub
                                ) in sortEducationArray(
                                  eduSubSection.edu_sub_section_content
                                )"
                                :key="`#keyeduSub_${keyeduSub}`"
                                @dragover="
                                  (e) =>
                                    onDragEduSubContnentOver(
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      e
                                    )
                                "
                                @dragend="
                                  (e) =>
                                    finishEduSubContentDrag(
                                      eduSubSection.edu_sub_section_content,
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      (hide = true),
                                      e
                                    )
                                "
                                @dragstart="
                                  (e) =>
                                    startEduSubContentDrag(
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      e
                                    )
                                "
                                :class="{
                                  over_edu_sub_content:
                                    edu_subSection_content ===
                                      over_edu_sub_content.edu_subSection_content &&
                                    edu_subSection_content !== dragFrom,
                                  [over_edu_sub_content.dir]:
                                    edu_subSection_content ===
                                      over_edu_sub_content.edu_subSection_content &&
                                    item !== dragFrom,
                                }"
                                draggable="true"
                              >
                                <p
                                  style="
                                    display: flex;
                                    align-items: center;
                                    background-color: #ffffff !important;
                                  "
                                  v-if="
                                    edu_subSection_content.type === 'skills'
                                  "
                                >
                                  <span
                                    style="
                                      position: relative;
                                      width: 240px;
                                      top: 8px;
                                      padding-right: 25px;
                                      word-break: break-all;
                                    "
                                  >
                                    {{
                                      edu_subSection_content
                                        .subsection_content_able.name
                                    }}
                                  </span>
                                  <i
                                    @click="
                                      removeEduSubSectionContent(
                                        edu_subSection_content.id,
                                        (active = false)
                                      )
                                    "
                                    class="fa fa-trash float-right"
                                  ></i>
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label class="label_name label-grey-text">{{
                                  removeUnderScore(  edu_subSection_content.type)
                                  }}</label>
                                </p>
                                <p
                                  style="background-color: #ffffff !important"
                                  v-else-if="
                                    edu_subSection_content.type ===
                                    'endorsement'
                                  "
                                >
                                  <span
                                    style="
                                      position: relative;
                                      width: 240px;
                                      top: 8px;
                                      padding-right: 25px;
                                      word-break: break-all;
                                    "
                                  >
                                    “{{
                                      edu_subSection_content
                                        .subsection_content_able.value
                                    }}”
                                    <span
                                      >–
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able.author
                                      }},
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able
                                          .author_description
                                      }}
                                      ,
                                      {{
                                       edu_subSection_content
                                            .subsection_content_able.job_id ?   getJobName(
                                          edu_subSection_content.subsection_content_able.job_id
                                        ) : ''
                                      }}
                                    </span>
                                  </span>
                                  <i
                                    @click="
                                      removeEduSubSectionContent(
                                        edu_subSection_content.id,
                                        (active = false)
                                      )
                                    "
                                    class="fa fa-trash float-right"
                                  ></i>
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label class="label_name label-grey-text">{{
                                 removeUnderScore(   edu_subSection_content.type)
                                  }}</label>
                                </p>
                                <div v-else>
                                  <p
                                    v-if="getShowEducationEnhancement"
                                    style="background-color: #ffffff !important"
                                  >
                                    <span
                                      style="
                                        position: relative;
                                        width: 240px;
                                        top: 8px;
                                        padding-right: 25px;
                                        word-break: break-all;
                                      "
                                    >
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able.value
                                      }}
                                    </span>
                                    <i
                                      @click="
                                        removeEduSubSectionContent(
                                          edu_subSection_content.id,
                                          (active = false)
                                        )
                                      "
                                      class="fa fa-trash float-right"
                                    ></i>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label_name label-grey-text">{{
                                    removeUnderScore(  edu_subSection_content.type)
                                    }}</label>
                                  </p>
                                </div>
                              </div>
                            </div>

                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="eduSubSection.showContentList"
                            >
                              <div>
                                <select
                                  name="content_type"
                                  id="month"
                                  class="select-item input-info border-content-box"
                                  @change="
                                    chooseEduSubSectionContent(
                                      $event,
                                      eduSubSection.id
                                    )
                                  "
                                >
                                  <option value="">Select Option</option>
                                  <option
                                    value="academin_honors"
                                    class="label_name label-grey-text"
                                  >
                                    Academic Honors / Achievements ({{
                                      getShowEducationEnhancement
                                        ? getKaunArray
                                          ? countKaunOnAchivement(
                                              getKaunArray,
                                              "ACADEMIC_ACHIVEMENTS"
                                            )
                                          : 0
                                        : 0
                                    }})
                                  </option>
                                  <option
                                    value="academic_societies"
                                    class="label_name label-grey-text"
                                  >
                                    Academic Societies / Clubs ({{
                                      getShowEducationEnhancement
                                        ? getKaunArray
                                          ? countKaunOnAchivement(
                                              getKaunArray,
                                              "ACADEMIC_ORGANIZATIONS"
                                            )
                                          : 0
                                        : 0
                                    }})
                                  </option>
                                  <option
                                    value="skills"
                                    class="label_name label-grey-text"
                                  >
                                    Skills ({{
                                      getSkillArray ? getSkillArray.length : 0
                                    }})
                                  </option>
                                  <option
                                    value="endorsements"
                                    class="label_name label-grey-text"
                                  >
                                    Endorsements ({{
                                      getEndorseArray
                                        ? getEndorseArray.length
                                        : 0
                                    }})
                                  </option>
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name label-grey-text"
                                  style="padding-left: 4px"
                                  >Content</label
                                >
                              </div>
                            </div>

                            <!--  preview data  -->

                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                eduSubSection.showAcademicAchievement &&
                                !eduSubSection.showAddMoreKaunHonors
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(achieve, key) in getKaunArray.filter(
                                  (ed) => ed.type == 'ACADEMIC_ACHIVEMENTS'
                                )"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      eduSubSection.id,
                                      achieve.id,
                                      'ACADEMIC_ACHIVEMENTS',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ achieve.value }}
                                </p>
                              </div>
                            </div>

                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="eduSubSection.showAddMoreKaunHonors"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link
                                  :to="{ name: 'education_enhancement' }"
                                >
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Achievement
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                eduSubSection.showAcademicSocieties &&
                                !eduSubSection.showAddMoreKaunSocieties
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(org, key) in getKaunArray.filter(
                                  (ed) => ed.type == 'ACADEMIC_ORGANIZATIONS'
                                )"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      eduSubSection.id,
                                      org.id,
                                      'ACADEMIC_ORGANIZATIONS',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ org.value }}
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="eduSubSection.showAddMoreKaunSocieties"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link
                                  :to="{ name: 'education_enhancement' }"
                                >
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Organizations
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                eduSubSection.showSubSectionskills &&
                                !eduSubSection.showAddMoreSkills
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(subSectionSkill, key) in getSkillArray"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      eduSubSection.id,
                                      subSectionSkill.id,
                                      'skills',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ subSectionSkill.name }}
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="eduSubSection.showAddMoreSkills"
                            >
                              <div class="resposibilities_items_listing">
                                <router-link :to="{ name: 'skills' }">
                                  <button class="add-blank-spcae">
                                    +Add More Skills
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                eduSubSection.showSubSectionEndorsement &&
                                !eduSubSection.showAddMoreEndorse
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(
                                  subSectionEndorse, key
                                ) in getEndorseArray"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      eduSubSection.id,
                                      subSectionEndorse.id,
                                      'endorsement',
                                      (active = true)
                                    )
                                  "
                                >
                                  “{{ subSectionEndorse.value }}”
                                  <span
                                    >– {{ subSectionEndorse.author }},
                                    {{ subSectionEndorse.author_description }},

                                  <span>{{
                                       subSectionEndorse.job_id ?   getJobName(
                                          subSectionEndorse.job_id
                                        ) : ''
                                      }}
                                      </span>
                                  </span>
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="eduSubSection.showAddMoreEndorse"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link :to="{ name: 'endorsements' }">
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Endorsements
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div class="text-center my-3 bg-white card">
                              <button
                                class="btn btn-block subsection-btn"
                                @click="
                                  showContentListOptions(eduSubSection.id)
                                "
                              >
                                +Add New
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--  edu new subsection end here -->

                      <div
                        class="card"
                        id="resume_new_section_extra_content"
                        v-if="sectionData.type == 'education'"
                      >
                        <button
                          type="button"
                          class="btn btn-block subsection-btn subsection-btn-new"
                          id="resune_new_section_button"
                          @click="addNewEduSubSection(sectionData.id)"
                        >
                          + Add New Subsection
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- education end -->
              <!-- skill start -->
              <div class="card" v-if="sectionData.type == 'skill'">
                <div
                  class=""
                  id="headingFive"
                  style="min-height: 48px; position: relative"
                  :class="[sidbar_active.skill ? 'activeSidebar' : '']"
                >
                  <span
                    data-toggle="collapse"
                    data-target="#collapseFive"
                    aria-expanded="false"
                    aria-controls="collapseFive"
                    style="padding: 2px 25px 0 10px"
                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                    v-on:click="setActive('skill')"
                  >
                    <!-- <img
                      :src="
                        EnvPath + 'builder/images/logo/skills_resume_icon.png'
                      "
                      class="heading_icon_sidebar"
                      :class="[sidbar_active.skill ? 'iconHide' : 'iconShow']"
                    /><img
                      :src="
                        EnvPath + 'builder/images/logo/skills_icon_active.png'
                      "
                      class="heading_icon_sidebar heading_icon_sidebar_active"
                      :class="[sidbar_active.skill ? 'iconShow' : 'iconHide']"
                    /> -->

                    <i class="fa-sharp fa-solid fa-user sidebar-icons-grey"></i>

                    <span class="sidebar-text-width">
                      {{ sectionData.title ? sectionData.title : "Skills" }}
                    </span>

                    <span class="drag-arrow-box"
                      ><i class="fas fa-arrows-alt"></i
                    ></span>
                  </span>

                  <span class="visible_section_setings visible_section_sidebar" :class="[
                    sidbar_active.skill ? 'eye-white' : '',
                  ]">
                    <i
                      v-show="sectionData.hidden == 1"
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                      v-on:click="showHideSidebar('skill', sectionData.id)"
                    ></i
                    ><i
                      v-show="sectionData.hidden == 0"
                      v-on:click="showHideSidebar('skill', sectionData.id)"
                      class="fa fa-eye-slash show_hide_icon"
                    ></i> </span
                  ><span class="Drag_Drop_section"></span>
                </div>
                <div
                  id="collapseFive"
                  class="collapse"
                  aria-labelledby="headingFive"
                  data-parent="#accordionSidebar"
                >
                  <div id="skillsAcordianBox">
                    <div class="card-body">
                      <div class="sub_section_tab_button" id="SkillsEducation">
                        <button
                          type="button"
                          class="btn btn-info btn_custom_sidebar align-dropdown-arrow"
                          data-toggle="collapse"
                          data-target="#details_skill"
                          aria-expanded="false"
                          aria-controls="details_skill"
                          :style="{
                            backgroundColor: acordian_color
                              ? '#46a9fa !important'
                              : '',
                            color: acordian_color ? '#ffffff !important' : '',
                          }"
                          @click="acordianColor"
                        >
                          Settings
                          <span
                            ><i class="fa fa-caret-down"></i
                            >
                            <!-- <i class="fa fa-caret-up" style="display: none"></i> -->
                            </span>
                        </button>
                        <span
                          class="visible_section_setings visible_section_sidebar"
                        ></span>
                      </div>
                      <div
                        id="details_skill"
                        class="collapse"
                        aria-labelledby="SkillsEducation"
                        data-parent="#skillsAcordianBox"
                      >
                        <div class="group mr-2 input_yak_logo">
                          <div>
                            <input
                              maxlength="100"
                              type="text"
                              name="skill_title"
                              id="skill_title"
                              placeholder="Skills"
                              class="input mouseLeave"
                              style="padding-right: 40px"
                              v-model="sectionData.title"
                              @blur="
                                saveNewSection($event, sectionData.id, 'title')
                              "
                            />

                            <span
                              >
                              <!-- <img
                                src="https://test2.resumeyak.com/builder/builder/images/logo/yak-icon.png"
                                alt=""
                                data-original-title="null"
                                class="small_logo has-tooltip v-tooltip-open"
                              /> -->
                              <div
                                aria-hidden="false"
                                x-placement="top"
                                class="tooltip"
                                style="
                                  position: absolute;
                                  will-change: transform;
                                  top: -33px;
                                  right: -128px;
                                  display: none;
                                  visibility: hidden;
                                "
                              >
                                <div
                                  data-v-48e4df16=""
                                  class="tooltip-arrow"
                                  style="left: 25px"
                                ></div>
                                <div
                                  data-v-48e4df16=""
                                  class="tooltip-inner"
                                  style="margin-left: 0px !important"
                                >
                                  Skill Section
                                </div>
                              </div></span
                            >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="label_name label-grey-text"
                              >Section Title</label
                            >
                          </div>
                          <span data-v-7969e6e8="">
                            <div
                              aria-hidden="false"
                              x-placement="top"
                              class="tooltip"
                              style="
                                position: absolute;
                                will-change: transform;
                                top: -30px;
                                right: -128px;
                                display: none;
                                visibility: hidden;
                              "
                            >
                              <div
                                class="tooltip-arrow"
                                style="left: 25px"
                              ></div>
                              <div class="tooltip-inner">
                                {{ sectionData.title ?? "Untitled Section" }}
                              </div>
                            </div>
                          </span>
                        </div>
                        <div class="group mr-2 input_yak_logo">
                          <div>
                            <textarea
                              maxlength="100"
                              type="text"
                              class="input mouseLeave mb-0 h-70"
                              name="section_title"
                              id="section_title"
                              autocomplete="off"
                              style="padding-right: 40px"
                              v-model="sectionData.content"
                              @blur="
                                saveNewSection(
                                  $event,
                                  sectionData.id,
                                  'content'
                                )
                              "
                            ></textarea>
                            <span
                              >
                              <!-- <img
                                src="https://test2.resumeyak.com/builder/builder/images/logo/yak-icon.png"
                                alt=""
                                data-original-title="null"
                                class="small_logo has-tooltip v-tooltip-open"
                              /> -->
                              <div
                                aria-hidden="false"
                                x-placement="top"
                                class="tooltip"
                                style="
                                  position: absolute;
                                  will-change: transform;
                                  top: -32px;
                                  right: -128px;
                                  display: none;
                                  visibility: hidden;
                                "
                              >
                                <div
                                  data-v-48e4df16=""
                                  class="tooltip-arrow"
                                  style="left: 25px"
                                ></div>
                                <div
                                  data-v-48e4df16=""
                                  class="tooltip-inner"
                                  style="margin-left: 0px !important"
                                >
                                  Skill Section Description
                                </div>
                              </div></span
                            >
                            <label
                              data-v-48e4df16=""
                              class="label_name label-grey-text bg-content-side"
                              >Custom Content</label
                            >
                          </div>
                          <span>
                            <div
                              aria-hidden="false"
                              x-placement="top"
                              class="tooltip"
                              style="
                                position: absolute;
                                will-change: transform;
                                top: -30px;
                                right: -128px;
                                display: none;
                                visibility: hidden;
                              "
                            >
                              <div
                                class="tooltip-arrow"
                                style="left: 25px"
                              ></div>
                              <div class="tooltip-inner">
                                Skills Section Description
                              </div>
                            </div>
                          </span>
                        </div>
                        <!-- subSection Column -->
                        <div class="sub-section-columns">
                          <div class="sub-section-column-tooltip">
                            <h1>Subsection Columns</h1>
                            <div class="yawk-icon-tooltip">
                                <div class="yewk-text-box">
                                  <span>"Clicking 'Columns' with excess content will cause overflow to the next page."</span>
                                </div>

                                              <img
                                :src="EnvPath + 'images/bg/help.png'"
                                alt
                                class="small_logo"
                              />
                            </div>
                          </div>
                          <div class="subsection-column-box">
                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkOneSkill"
                                name="column-check-skill"
                                class="input-column-section"
                                value="1"
                                :checked="1 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label
                                for="checkOneSkill"
                                class="single-boxes-value"
                              >
                                <span class="box-one"></span>
                                <span class="digit-circle">1</span>
                              </label>
                            </div>

                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkTwoSkill"
                                name="column-check-skill"
                                class="input-column-section"
                                value="2"
                                :checked="2 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label
                                for="checkTwoSkill"
                                class="single-boxes-value"
                              >
                                <span
                                  class="box-one"
                                  style="margin: 0 5px"
                                ></span>
                                <span
                                  class="box-one"
                                  style="margin: 0 5px"
                                ></span>
                                <span class="digit-circle">2</span>
                              </label>
                            </div>

                            <div class="subsection-column-single">
                              <input
                                type="radio"
                                id="checkThreeSkill"
                                name="column-check-skill"
                                class="input-column-section"
                                value="3"
                                :checked="3 === sectionData.column"
                                @click="
                                  changeSectionColumn(
                                    sectionData.id,
                                    $event.target.value
                                  )
                                "
                              />
                              <label
                                for="checkThreeSkill"
                                class="single-boxes-value"
                              >
                                <span class="box-one"></span>
                                <span class="box-one"></span>
                                <span class="box-one"></span>
                                <span class="digit-circle">3</span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <!-- subSection Column -->
                      </div>

                      <!-- skill array_array -->
                      <div
                        class="contact-profile-info no-border mb-3"
                        v-for="(
                          skill_subsection, key
                        ) in getSkillSubSectionArray"
                        :key="`#skill_summ_${key}`"
                      >
                        <div class="sub_section_tab_button" id="skillTwoEdu">
                          <button
                            type="button"
                            class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-color-work-experience"
                            data-toggle="collapse"
                            :data-target="`#demo_pro_summary_subsection${key}`"
                            aria-expanded="false"
                            :aria-controls="`#demo_pro_summary_subsection${key}`"
                            @click="acordianLoopActive"
                          >
                            {{
                              skill_subsection.title ?? "Untitled Subsection"
                            }}
                            <span class=""
                              ><i class="fa fa-caret-down"></i
                              ><i
                                class="fa fa-caret-up"
                                style="display: none"
                              ></i
                            ></span>
                          </button>
                          <span
                            class="visible_section_setings accordian-eye-arrow-two visible_section_sidebar"
                          ></span>
                        </div>
                        <div
                          :id="'demo_pro_summary_subsection' + key"
                          class="collapse"
                          aria-labelledby="skillTwoEdu"
                          data-parent="#skillsAcordianBox"
                        >
                          <div class="group mr-2 input_yak_logo">
                            <div class="row align-items-center">
                              <div class="col-md-9 col-sm-9 col-9">
                                <input
                                  maxlength="100"
                                  type="text"
                                  class="input mouseLeave mb-0"
                                  name="section_title"
                                  id="section_title"
                                  autocomplete="off"
                                  style="padding-right: 40px"
                                  v-model="skill_subsection.title"
                                  @blur="
                                    saveEduSudSection(
                                      $event,
                                      skill_subsection.id,
                                      'title'
                                    )
                                  "
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name left-26-labelname label-grey-text"
                                  >SubSection Title</label
                                >
                              </div>
                              <div
                                class="col-md-3 col-sm-3 col-3 cursor-pointer"
                              >
                                <i
                                  @click="
                                    deleteEduSubSection(skill_subsection.id)
                                  "
                                  class="fa fa-trash"
                                ></i>
                              </div>
                            </div>
                          </div>
                          <div class="group mr-2 input_yak_logo">
                            <div>
                              <textarea
                                maxlength="100"
                                type="text"
                                class="input mouseLeave mb-0 h-70"
                                name="section_title"
                                id="section_title"
                                autocomplete="off"
                                style="padding-right: 40px"
                                v-model="skill_subsection.content"
                                @blur="
                                  saveEduSudSection(
                                    $event,
                                    skill_subsection.id,
                                    'content'
                                  )
                                "
                              ></textarea>
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label class="label_name label-grey-text bg-content-side"
                                >Custom Content</label
                              >
                            </div>
                          </div>
                          <div class="group mr-2 input_yak_logo">
                            <div>
                              <select
                                name="list_style"
                                id="month"
                                class="select-item input-info"
                                @change="
                                  saveNewSection(
                                    $event,
                                    sectionData.id,
                                    'list_style'
                                  )
                                "
                              >
                                <option
                                  v-for="(subsetion, key) in list_styles"
                                  :value="key"
                                  class="label_name label-grey-text"
                                  :selected="
                                    key == skill_subsection.list_style
                                      ? true
                                      : ''
                                  "
                                  :disabled="checkSubSectionColumn(sectionData.column,key)"
                                >
                                  {{ subsetion.title }}
                                </option>
                              </select>
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label
                                class="label_name padding-left-list-style label-grey-text"
                                >List Style</label
                              >
                            </div>
                          </div>
                          <p><b> Content</b></p>
                          <!-- skill_sub_section_content -->
                          <div class="content-background-box">
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                skill_subsection.edu_sub_section_content
                                  .length > 0
                              "
                            >
                              <div
                                class="resposibilities_items_listing selected_endorsment_item_option1"
                                v-for="(
                                  edu_subSection_content, keyeduSub
                                ) in sortEducationArray(
                                  skill_subsection.edu_sub_section_content
                                )"
                                :key="`#keyeduSub_${keyeduSub}`"
                                @dragover="
                                  (e) =>
                                    onDragSkillSubContnentOver(
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      e
                                    )
                                "
                                @dragend="
                                  (e) =>
                                    finishSkillSubContentDrag(
                                      skill_subsection.edu_sub_section_content,
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      (hide = true),
                                      e
                                    )
                                "
                                @dragstart="
                                  (e) =>
                                    startSkillSubContentDrag(
                                      edu_subSection_content,
                                      edu_subSection_content.id,
                                      e
                                    )
                                "
                                :class="{
                                  over_skill_sub_content:
                                    edu_subSection_content ===
                                      over_skill_sub_content.edu_subSection_content &&
                                    edu_subSection_content !== dragFrom,
                                  [over_skill_sub_content.dir]:
                                    edu_subSection_content ===
                                      over_skill_sub_content.edu_subSection_content &&
                                    item !== dragFrom,
                                }"
                                draggable="true"
                              >
                                <p
                                  class=""
                                  style="display: flex; align-items: center"
                                  v-if="
                                    edu_subSection_content.type === 'skills'
                                  "
                                >
                                  <span
                                    style="
                                      position: relative;
                                      width: 240px;
                                      top: 8px;
                                      padding-right: 25px;
                                      word-break: break-all;
                                    "
                                  >
                                    {{
                                      edu_subSection_content
                                        .subsection_content_able.name
                                    }}
                                  </span>
                                  <i
                                    @click="
                                      removeEduSubSectionContent(
                                        edu_subSection_content.id,
                                        (active = false)
                                      )
                                    "
                                    class="fa fa-trash float-right"
                                  ></i>
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label class="label_name label-grey-text">{{
                                 removeUnderScore(   edu_subSection_content.type)
                                  }}</label>
                                </p>
                                <p
                                  v-else-if="
                                    edu_subSection_content.type ===
                                    'endorsement'
                                  "
                                  style="padding-right: 25px"
                                >
                                  <span
                                    style="
                                      position: relative;
                                      width: 240px;
                                      top: 8px;
                                      padding-right: 25px;
                                      word-break: break-all;
                                    "
                                  >
                                    “{{
                                      edu_subSection_content
                                        .subsection_content_able.value
                                    }}”
                                    <span
                                      >–
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able.author
                                      }},
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able
                                          .author_description
                                      }},
                                      {{
                                      edu_subSection_content
                                            .subsection_content_able.job_id ?   getJobName(
                                          edu_subSection_content
                                            .subsection_content_able.job_id
                                        ) : ''
                                      }}
                                    </span>
                                  </span>

                                  <i
                                    @click="
                                      removeEduSubSectionContent(
                                        edu_subSection_content.id,
                                        (active = false)
                                      )
                                    "
                                    class="fa fa-trash float-right"
                                    style="
                                      position: relative;
                                      right: -17px;
                                      top: 4px;
                                    "
                                  ></i>
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label class="label_name label-grey-text">{{
                                 removeUnderScore(   edu_subSection_content.type)
                                  }}</label>
                                </p>
                                <div v-else>
                                  <p v-if="getShowEducationEnhancement">
                                    <span
                                      style="
                                        position: relative;
                                        width: 240px;
                                        top: 8px;
                                        padding-right: 25px;
                                        word-break: break-all;
                                      "
                                    >
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able.value
                                      }}
                                    </span>
                                    <i
                                      @click="
                                        removeEduSubSectionContent(
                                          edu_subSection_content.id,
                                          (active = false)
                                        )
                                      "
                                      class="fa fa-trash float-right"
                                    ></i>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label_name label-grey-text">{{
                                     removeUnderScore( edu_subSection_content.type)
                                    }}</label>
                                  </p>
                                </div>
                              </div>
                            </div>

                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="skill_subsection.showContentList"
                            >
                              <div>
                                <select
                                  name="content_type"
                                  id="month"
                                  class="select-item input-info border-content-box"
                                  @change="
                                    chooseSkillSubSectionContent(
                                      $event,
                                      skill_subsection.id
                                    )
                                  "
                                >
                                  <option value="">Select Option</option>
                                  <option
                                    value="academin_honors"
                                    class="label_name label-grey-text"
                                  >
                                    Academic Honors / Achievements ({{
                                      getShowEducationEnhancement
                                        ? getKaunArray
                                          ? countKaunOnAchivement(
                                              getKaunArray,
                                              "ACADEMIC_ACHIVEMENTS"
                                            )
                                          : 0
                                        : 0
                                    }})
                                  </option>
                                  <option
                                    value="academic_societies"
                                    class="label_name label-grey-text"
                                  >
                                    Academic Societies / Clubs ({{
                                      getShowEducationEnhancement
                                        ? getKaunArray
                                          ? countKaunOnAchivement(
                                              getKaunArray,
                                              "ACADEMIC_ORGANIZATIONS"
                                            )
                                          : 0
                                        : 0
                                    }})
                                  </option>
                                  <option
                                    value="skills"
                                    class="label_name label-grey-text"
                                  >
                                    Skills ({{
                                      getSkillArray ? getSkillArray.length : 0
                                    }})
                                  </option>
                                  <option
                                    value="endorsements"
                                    class="label_name label-grey-text"
                                  >
                                    Endorsements ({{
                                      getEndorseArray
                                        ? getEndorseArray.length
                                        : 0
                                    }})
                                  </option>
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name label-grey-text"
                                  style="padding-left: 4px"
                                  >Content</label
                                >
                              </div>
                            </div>
                            <!--  preview data  -->

                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                skill_subsection.showAcademicAchievement &&
                                !skill_subsection.showAddMoreKaunHonors
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(achieve, key) in getKaunArray.filter(
                                  (ed) => ed.type == 'ACADEMIC_ACHIVEMENTS'
                                )"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      skill_subsection.id,
                                      achieve.id,
                                      'ACADEMIC_ACHIVEMENTS',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ achieve.value }}
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="skill_subsection.showAddMoreKaunHonors"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link
                                  :to="{ name: 'education_enhancement' }"
                                >
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Achievement
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                skill_subsection.showAcademicSocieties &&
                                !skill_subsection.showAddMoreKaunSocieties
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(org, key) in getKaunArray.filter(
                                  (ed) => ed.type == 'ACADEMIC_ORGANIZATIONS'
                                )"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      skill_subsection.id,
                                      org.id,
                                      'ACADEMIC_ORGANIZATIONS',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ org.value }}
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="skill_subsection.showAddMoreKaunSocieties"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link
                                  :to="{ name: 'education_enhancement' }"
                                >
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Organizations
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                skill_subsection.showSubSectionskills &&
                                !skill_subsection.showAddMoreSkills
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(subSectionSkill, key) in getSkillArray"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      skill_subsection.id,
                                      subSectionSkill.id,
                                      'skills',
                                      (active = true)
                                    )
                                  "
                                >
                                  {{ subSectionSkill.name }}
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="skill_subsection.showAddMoreSkills"
                            >
                              <div class="resposibilities_items_listing">
                                <router-link :to="{ name: 'skills' }">
                                  <button class="add-blank-spcae">
                                    +Add More Skills
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="
                                skill_subsection.showSubSectionEndorsement &&
                                !skill_subsection.showAddMoreEndorse
                              "
                            >
                              <div
                                class="resposibilities_items_listing"
                                v-for="(
                                  subSectionEndorse, key
                                ) in getEndorseArray"
                              >
                                <p
                                  @click="
                                    saveEduSubSectionContent(
                                      skill_subsection.id,
                                      subSectionEndorse.id,
                                      'endorsement',
                                      (active = true)
                                    )
                                  "
                                >
                                  “{{ subSectionEndorse.value }}”
                                  <span
                                    >– {{ subSectionEndorse.author }},
                                    {{ subSectionEndorse.author_description }},

                                    <span>{{
                                       subSectionEndorse.job_id ?   getJobName(
                                          subSectionEndorse.job_id
                                        ) : ''
                                      }}
                                      </span>
                                    </span
                                  >
                                </p>
                              </div>
                            </div>
                            <div
                              class="group mr-2 input_yak_logo"
                              v-if="skill_subsection.showAddMoreEndorse"
                            >
                              <div class="resposibilities_items_listing card">
                                <router-link :to="{ name: 'endorsements' }">
                                  <button class="btn btn-block subsection-btn">
                                    +Add More Endorsements
                                  </button>
                                </router-link>
                              </div>
                            </div>
                            <div class="text-center mt-2 mb-3 bg-white card">
                              <button
                                class="btn btn-block subsection-btn"
                                @click="
                                  showSkillContentListOptions(
                                    skill_subsection.id
                                  )
                                "
                              >
                                +Add New
                              </button>
                            </div>
                            <!-- till here -->
                          </div>
                        </div>
                      </div>

                      <div class="card" id="resume_new_section_extra_content">
                        <button
                          type="button"
                          class="btn btn-block subsection-btn subsection-btn-new"
                          id="resune_new_section_button"
                          @click="addNewEduSubSection(sectionData.id)"
                        >
                          + Add New Subsection
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- skill end  -->
              <!--  new sections start -->
              <div class="card" v-if="sectionData.type == 'new-section'">
                <div
                  class=""
                  style="min-height: 48px; position: relative"
                  id="headingNewSection"
                  :class="[sectionData.activeBar ? 'activeSidebar' : '']"
                >
                  <span
                    data-toggle="collapse"
                    :data-target="`#collapseNewSection${key}`"
                    aria-expanded="false"
                    aria-controls="collapseNewSection"
                    class="sidebar-tabs-acordian-setting heading_tab_section_sidebar d-flex justify-content-start align-items-center"
                    v-on:click="setActive('new-section', sectionData)"
                  >
                    <i
                      aria-hidden="true"
                      class="fas fa-edit"
                      style="
                        font-size: 18px;
                        margin-right: 8px;
                        color: #b7b7b7;
                        margin-top: -4px;
                      "
                    ></i>

                    <span style="word-break: break-all; padding-right: 50px">
                      {{
                        sectionData.title
                          ? sectionData.title
                          : "Untitled New Section"
                      }}
                    </span>
                    <span
                      class="drag-arrow-box"
                      style="position: absolute; right: 41px"
                      ><i class="fas fa-arrows-alt"></i
                    ></span>
                  </span>
                  <span class="visible_section_setings visible_section_sidebar" :class="[
                    sectionData.activeBar ? 'eye-white' : '',
                  ]"
                    ><i
                      v-show="sectionData.hidden == 1"
                      class="fa fa-eye show_hide_icon sidebar-eye-icon-show-hide"
                      v-on:click="
                        showHideSidebar('new-section', sectionData.id)
                      "
                    ></i>
                    <i
                      v-show="sectionData.hidden == 0"
                      v-on:click="
                        showHideSidebar('new-section', sectionData.id)
                      "
                      class="fa fa-eye-slash show_hide_icon"
                    ></i
                  ></span>
                  <span class="Drag_Drop_section"></span>
                </div>
                <div
                  :id="'collapseNewSection' + key"
                  class="collapse"
                  aria-labelledby="headingNewSection"
                  data-parent="#accordionSidebar"
                >
                  <div class="card-body">
                    <div id="details_edu">
                      <div class="group mr-2 input_yak_logo">
                        <div class="row align-items-center">
                          <div class="col-md-9 col-sm-9 col-9">
                            <input
                              maxlength="100"
                              type="text"
                              class="input mouseLeave mb-0"
                              name="section_title"
                              id="section_title"
                              autocomplete="off"
                              style="padding-right: 40px"
                              v-model="sectionData.title"
                              @blur="
                                saveNewSection($event, sectionData.id, 'title')
                              "
                            />
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label
                              class="label_name left-26-labelname label-grey-text"
                              >Section Title</label
                            >
                          </div>
                          <div class="col-md-3 col-sm-3 col-3 curson-pointer">
                            <i
                              @click="deleteNewSection(sectionData.id)"
                              class="fa fa-trash"
                            ></i>
                          </div>
                        </div>
                      </div>
                      <div class="group mr-2 input_yak_logo">
                        <div>
                          <textarea
                            maxlength="100"
                            type="text"
                            class="input mouseLeave mb-0 h-70"
                            name="section_title"
                            id="section_title"
                            autocomplete="off"
                            style="padding-right: 40px"
                            v-model="sectionData.content"
                            @blur="
                              saveNewSection($event, sectionData.id, 'content')
                            "
                          ></textarea>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label class="label_name label-grey-text bg-content-side"
                            >Custom Content</label
                          >
                        </div>
                      </div>

                      <!-- subSection Column for new section -->
                      <div class="sub-section-columns">
                        <div class="sub-section-column-tooltip">
                            <h1>Subsection Columns</h1>
                            <div class="yawk-icon-tooltip">
                                <div class="yewk-text-box">
                                  <span>"Clicking 'Columns' with excess content will cause overflow to the next page."</span>
                                </div>

                                <img
                                    :src="EnvPath + 'images/bg/help.png'"
                                    alt
                                    class="small_logo"
                                  />
                            </div>
                          </div>
                        <div class="subsection-column-box">
                          <div class="subsection-column-single">
                            <input
                              type="radio"
                              :id="'checkOneNew' + sectionData.id"
                              :name="'column-check-new' + sectionData.id"
                              class="input-column-section"
                              value="1"
                              :checked="1 === sectionData.column"
                              @click="
                                changeSectionColumn(
                                  sectionData.id,
                                  $event.target.value
                                )
                              "
                            />
                            <label
                              :for="'checkOneNew' + sectionData.id"
                              class="single-boxes-value"
                            >
                              <span class="box-one"></span>
                              <span class="digit-circle">1</span>
                            </label>
                          </div>

                          <div class="subsection-column-single">
                            <input
                              type="radio"
                              :id="'checkTwoNew' + sectionData.id"
                              :name="'column-check-new' + sectionData.id"
                              class="input-column-section"
                              value="2"
                              :checked="2 === sectionData.column"
                              @click="
                                changeSectionColumn(
                                  sectionData.id,
                                  $event.target.value
                                )
                              "
                            />
                            <label
                              :for="'checkTwoNew' + sectionData.id"
                              class="single-boxes-value"
                            >
                              <span
                                class="box-one"
                                style="margin: 0 5px"
                              ></span>
                              <span
                                class="box-one"
                                style="margin: 0 5px"
                              ></span>
                              <span class="digit-circle">2</span>
                            </label>
                          </div>

                          <div class="subsection-column-single">
                            <input
                              type="radio"
                              :id="'checkThreeNew' + sectionData.id"
                              :name="'column-check-new' + sectionData.id"
                              class="input-column-section"
                              value="3"
                              :checked="3 === sectionData.column"
                              @click="
                                changeSectionColumn(
                                  sectionData.id,
                                  $event.target.value
                                )
                              "
                            />
                            <label
                              :for="'checkThreeNew' + sectionData.id"
                              class="single-boxes-value"
                            >
                              <span class="box-one"></span>
                              <span class="box-one"></span>
                              <span class="box-one"></span>
                              <span class="digit-circle">3</span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- subSection Column -->
                      <!--   new subsection start here -->
                      <div :id="`accordionNewSection_${key}`">
                        <div
                          v-if="sectionData.resume_sub_section.length > 0"
                          v-for="(
                            newSubSection, index
                          ) in sectionData.resume_sub_section"
                          :key="`#hello_new_${index}`"
                        >

                          <div class="sub_section_tab_button">
                            <div
                              class="eye-btn-control"
                              :id="`newSubSection_modal_${newSubSection.id}_u_${index}`"
                            >
                              <button
                                type="button"
                                class="btn btn-info btn_custom_sidebar align-dropdown-arrow acordian-open-blue-back"
                                data-toggle="collapse"
                                :data-target="`#untitled_sets_${newSubSection.id}_u_${index}`"
                                aria-expanded="false"
                                :aria-controls="`#untitled_sets_${newSubSection.id}_u_${index}`"
                                @click="closeAllEduSubSectionContentType"
                              >
                                <p class="span-eye-text-control">
                                  {{
                                    newSubSection.title
                                      ? newSubSection.title
                                      : "Untitled Subsection"
                                  }}
                                </p>

                                <span
                                  class="acordian-eye-icon space-remove-open"
                                  ><i class="fa fa-caret-down"></i
                                  ><i
                                    class="fa fa-caret-up"
                                    style="display: none"
                                  ></i
                                ></span>
                              </button>
                              <i
                                style="margin-top: 0"
                                class="i-position accordian-eye-arrow eye-hide-show-section"
                                @click="
                                  newSubSectionEyeClick(
                                    newSubSection,
                                    newSubSection.id,
                                    sectionData.resume_sub_section
                                  )
                                "
                                :class="[
                                  newSubSection.status
                                    ? 'fa fa-eye'
                                    : 'fa fa-eye-slash',
                                ]"
                              ></i>
                            </div>
                            <span
                              class="visible_section_setings visible_section_sidebar"
                            ></span>
                          </div>
                          <!-- code here -->
                            <!-- :id="'untitled_sets_' + index" -->
                          <div
                            :id="`untitled_sets_${newSubSection.id}_u_${index}`"
                            class="collapse"
                            :aria-labelledby="`newSubSection_modal_${newSubSection.id}_u_${index}`"
                            :data-parent="`#accordionNewSection_${key}`"
                          >
                            <div class="group mr-2 input_yak_logo">
                              <div class="row align-items-center">
                                <div class="col-md-9 col-sm-9 col-9">
                                  <input
                                    maxlength="100"
                                    type="text"
                                    class="input mouseLeave mb-0"
                                    name="section_title"
                                    id="section_title"
                                    autocomplete="off"
                                    style="padding-right: 40px"
                                    v-model="newSubSection.title"
                                    @blur="
                                      saveEduSudSection(
                                        $event,
                                        newSubSection.id,
                                        'title'
                                      )
                                    "
                                  />
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label
                                    class="label_name left-26-labelname label-grey-text"
                                    >SubSection Title</label
                                  >
                                </div>
                                <div
                                  class="col-md-3 col-sm-3 col-3 cursor-pointer"
                                >
                                  <i
                                    @click="
                                      deleteEduSubSection(newSubSection.id)
                                    "
                                    class="fa fa-trash"
                                  ></i>
                                </div>
                              </div>
                            </div>
                            <div class="group mr-2 input_yak_logo">
                              <div>
                                <textarea
                                  maxlength="100"
                                  type="text"
                                  class="input mouseLeave mb-0 h-70"
                                  name="section_title"
                                  id="section_title"
                                  autocomplete="off"
                                  style="padding-right: 40px"
                                  v-model="newSubSection.content"
                                  @blur="
                                    saveEduSudSection(
                                      $event,
                                      newSubSection.id,
                                      'content'
                                    )
                                  "
                                ></textarea>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label_name label-grey-text bg-content-side"
                                  >Custom Content</label
                                >
                              </div>
                            </div>
                            <div class="group mr-2 input_yak_logo">
                              <div>
                                  <select
                                  name="list_style"
                                  id="month"
                                  class="select-item input-info"
                                  @change="
                                    saveEduSudSection(
                                      $event,
                                      newSubSection.id,
                                      'list_style'
                                    )
                                  "
                                >
                                  <option
                                    v-for="(subsetion, key) in list_styles"
                                    :value="key"
                                    class="label_name label-grey-text"
                                    :selected="
                                      key == newSubSection.list_style
                                        ? true
                                        : ''
                                    "
                                    :disabled="checkSubSectionColumn(sectionData.column,key)"
                                  >
                                    {{ subsetion.title }}
                                  </option>
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label
                                  class="label_name padding-left-list-style label-grey-text"
                                  >List Style</label
                                >
                              </div>
                            </div>
                            <p><b> Content</b></p>
                            <!-- edu_sub_section_content -->
                            <div class="content-background-box">
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="
                                  newSubSection.edu_sub_section_content.length >
                                  0
                                "
                              >
                                <div
                                  class="resposibilities_items_listing selected_endorsment_item_option1"
                                  v-for="(
                                    edu_subSection_content, keyeduSub
                                  ) in sortEducationArray(
                                    newSubSection.edu_sub_section_content
                                  )"
                                  :key="`#keyeduSub_${keyeduSub}`"
                                  @dragover="
                                    (e) =>
                                      onDragEduSubContnentOver(
                                        edu_subSection_content,
                                        edu_subSection_content.id,
                                        e
                                      )
                                  "
                                  @dragend="
                                    (e) =>
                                      finishEduSubContentDrag(
                                        newSubSection.edu_sub_section_content,
                                        edu_subSection_content,
                                        edu_subSection_content.id,
                                        (hide = true),
                                        e
                                      )
                                  "
                                  @dragstart="
                                    (e) =>
                                      startEduSubContentDrag(
                                        edu_subSection_content,
                                        edu_subSection_content.id,
                                        e
                                      )
                                  "
                                  :class="{
                                    over_edu_sub_content:
                                      edu_subSection_content ===
                                        over_edu_sub_content.edu_subSection_content &&
                                      edu_subSection_content !== dragFrom,
                                    [over_edu_sub_content.dir]:
                                      edu_subSection_content ===
                                        over_edu_sub_content.edu_subSection_content &&
                                      item !== dragFrom,
                                  }"
                                  draggable="true"
                                >
                                <div>
                                  <p
                                    style="
                                      display: flex;
                                      align-items: center;
                                      background-color: #ffffff !important;
                                    "
                                    v-if="
                                      edu_subSection_content.type === 'skills'
                                    "
                                  >
                                    <span
                                      style="
                                        position: relative;
                                        width: 240px;
                                        top: 8px;
                                        padding-right: 25px;
                                        word-break: break-all;
                                      "
                                    >
                                      {{
                                        edu_subSection_content
                                          .subsection_content_able.name
                                      }}

                                    </span>
                                    <i
                                      @click="
                                        removeEduSubSectionContent(
                                          edu_subSection_content.id,
                                          (active = false)
                                        )
                                      "
                                      class="fa fa-trash float-right"
                                    ></i>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label_name label-grey-text">{{
                                     removeUnderScore(edu_subSection_content.type)
                                    }}  </label>
                                  </p>
                                  <p
                                    style="background-color: #ffffff !important"
                                    v-else-if="
                                      edu_subSection_content.type ===
                                      'endorsement'
                                    "
                                  >
                                    <span
                                      style="
                                        position: relative;
                                        width: 240px;
                                        top: 8px;
                                        padding-right: 25px;
                                        word-break: break-all;
                                      "
                                    >
                                      “{{
                                        edu_subSection_content
                                          .subsection_content_able.value
                                      }}”
                                      <span
                                        >–
                                        {{
                                          edu_subSection_content
                                            .subsection_content_able.author
                                        }},
                                        {{
                                          edu_subSection_content
                                            .subsection_content_able
                                            .author_description
                                        }}

                                        <span v-if="edu_subSection_content.subsection_content_able.job_id">
                                        ,{{
                                          getJobName(
                                            edu_subSection_content.subsection_content_able.job_id
                                          )
                                        }}
                                        </span>

                                      </span>
                                    </span>
                                    <i
                                      @click="
                                        removeEduSubSectionContent(
                                          edu_subSection_content.id,
                                          (active = false)
                                        )
                                      "
                                      class="fa fa-trash float-right"
                                    ></i>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label_name label-grey-text">{{
                                    removeUnderScore(  edu_subSection_content.type)
                                    }}</label>
                                  </p>
                                  <div v-else>
                                    <p
                                      v-if="getShowEducationEnhancement"
                                      style="
                                        background-color: #ffffff !important;
                                      "
                                    >
                                      <span
                                        style="
                                          position: relative;
                                          width: 240px;
                                          top: 8px;
                                          padding-right: 25px;
                                          word-break: break-all;
                                        "
                                      >
                                        {{
                                          edu_subSection_content
                                            .subsection_content_able.value
                                        }}
                                      </span>
                                      <i
                                        @click="
                                          removeEduSubSectionContent(
                                            edu_subSection_content.id,
                                            (active = false)
                                          )
                                        "
                                        class="fa fa-trash float-right"
                                      ></i>
                                      <span class="highlight"></span>
                                      <span class="bar"></span>
                                      <label
                                        class="label_name label-grey-text"
                                        >{{
                                        removeUnderScore(  edu_subSection_content.type)
                                        }}</label
                                      >
                                    </p>
                                  </div>
                                </div>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="newSubSection.showContentList"
                              >
                                <div>
                                  <select
                                    name="content_type"
                                    id="month"
                                    class="select-item input-info border-content-box"
                                    @change="
                                      chooseNewSubSectionContent(
                                        $event,
                                        newSubSection.id,
                                        sectionData.resume_sub_section
                                      )
                                    "
                                  >
                                    <option value="">Select Option</option>
                                    <option
                                      value="academin_honors"
                                      class="label_name label-grey-text"
                                    >
                                      Academic Honors / Achievements ({{
                                        getShowEducationEnhancement
                                          ? getKaunArray
                                            ? countKaunOnAchivement(
                                                getKaunArray,
                                                "ACADEMIC_ACHIVEMENTS"
                                              )
                                            : 0
                                          : 0
                                      }})
                                    </option>
                                    <option
                                      value="academic_societies"
                                      class="label_name label-grey-text"
                                    >
                                      Academic Societies / Clubs ({{
                                        getShowEducationEnhancement
                                          ? getKaunArray
                                            ? countKaunOnAchivement(
                                                getKaunArray,
                                                "ACADEMIC_ORGANIZATIONS"
                                              )
                                            : 0
                                          : 0
                                      }})
                                    </option>
                                    <option
                                      value="skills"
                                      class="label_name label-grey-text"
                                    >
                                      Skills ({{
                                        getSkillArray
                                          ? getSkillArray.length
                                          : 0
                                      }})
                                    </option>
                                    <option
                                      value="endorsements"
                                      class="label_name label-grey-text"
                                    >
                                      Endorsements ({{
                                        getEndorseArray
                                          ? getEndorseArray.length
                                          : 0
                                      }})
                                    </option>
                                  </select>
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label
                                    class="label_name label-grey-text"
                                    style="padding-left: 4px"
                                    >Content</label
                                  >
                                </div>
                              </div>
                              <!--  preview data  -->
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="
                                  newSubSection.showAcademicAchievement &&
                                  !newSubSection.showAddMoreKaunHonors
                                "
                              >
                                <div
                                  class="resposibilities_items_listing"
                                  v-for="(achieve, key) in getKaunArray.filter(
                                    (ed) => ed.type == 'ACADEMIC_ACHIVEMENTS'
                                  )"
                                >
                                  <p
                                    @click="
                                      saveEduSubSectionContent(
                                        newSubSection.id,
                                        achieve.id,
                                        'ACADEMIC_ACHIVEMENTS',
                                        (active = true)
                                      )
                                    "
                                  >
                                    {{ achieve.value }}
                                  </p>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="newSubSection.showAddMoreKaunHonors"
                              >
                                <div class="resposibilities_items_listing card">
                                  <router-link
                                    :to="{ name: 'education_enhancement' }"
                                  >
                                    <button
                                      class="btn btn-block subsection-btn"
                                    >
                                      +Add More Achievement
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="
                                  newSubSection.showAcademicSocieties &&
                                  !newSubSection.showAddMoreKaunSocieties
                                "
                              >
                                <div
                                  class="resposibilities_items_listing"
                                  v-for="(org, key) in getKaunArray.filter(
                                    (ed) => ed.type == 'ACADEMIC_ORGANIZATIONS'
                                  )"
                                >
                                  <p
                                    @click="
                                      saveEduSubSectionContent(
                                        newSubSection.id,
                                        org.id,
                                        'ACADEMIC_ORGANIZATIONS',
                                        (active = true)
                                      )
                                    "
                                  >
                                    {{ org.value }}
                                  </p>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="newSubSection.showAddMoreKaunSocieties"
                              >
                                <div class="resposibilities_items_listing card">
                                  <router-link
                                    :to="{ name: 'education_enhancement' }"
                                  >
                                    <button
                                      class="btn btn-block subsection-btn"
                                    >
                                      +Add More Organizations
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="
                                  newSubSection.showSubSectionskills &&
                                  !newSubSection.showAddMoreSkills
                                "
                              >
                                <div
                                  class="resposibilities_items_listing"
                                  v-for="(
                                    subSectionSkill, key
                                  ) in getSkillArray"
                                >
                                  <p
                                    @click="
                                      saveEduSubSectionContent(
                                        newSubSection.id,
                                        subSectionSkill.id,
                                        'skills',
                                        (active = true)
                                      )
                                    "
                                  >
                                    {{ subSectionSkill.name }}
                                  </p>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="newSubSection.showAddMoreSkills"
                              >
                                <div class="resposibilities_items_listing">
                                  <router-link :to="{ name: 'skills' }">
                                    <button class="add-blank-spcae">
                                      +Add More Skills
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="
                                  newSubSection.showSubSectionEndorsement &&
                                  !newSubSection.showAddMoreEndorse
                                "
                              >
                                <div
                                  class="resposibilities_items_listing"
                                  v-for="(
                                    subSectionEndorse, key
                                  ) in getEndorseArray"
                                >
                                  <p
                                    @click="
                                      saveEduSubSectionContent(
                                        newSubSection.id,
                                        subSectionEndorse.id,
                                        'endorsement',
                                        (active = true)
                                      )
                                    "
                                  >
                                    “{{ subSectionEndorse.value }}”
                                    <span
                                      >– {{ subSectionEndorse.author }},
                                      {{
                                        subSectionEndorse.author_description
                                      }}
                                       <span v-if="subSectionEndorse.job_id">    ,{{
                                          subSectionEndorse.job_id ? getJobName(subSectionEndorse.job_id) : ""
                                      }}
                                      </span>
                                      <!-- {{ subSectionEndorse.jobs.company ?? "" }} -->
                                    </span>
                                  </p>
                                </div>
                              </div>
                              <div
                                class="group mr-2 input_yak_logo"
                                v-if="newSubSection.showAddMoreEndorse"
                              >
                                <div class="resposibilities_items_listing card">
                                  <router-link :to="{ name: 'endorsements' }">
                                    <button
                                      class="btn btn-block subsection-btn"
                                    >
                                      +Add More Endorsements
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                              <div class="text-center my-3 bg-white card">
                                <button
                                  class="btn btn-block subsection-btn"
                                  @click="
                                    showContentListOptionsNewSection(
                                      newSubSection.id,
                                      sectionData.resume_sub_section
                                    )
                                  "
                                >
                                  +Add New
                                </button>
                              </div>
                            </div>
                          </div>
                          <!-- code end here -->
                        </div>
                      </div>
                      <!--   new subsection start here -->
                      <div class="card" id="resume_new_section_extra_content">
                        <button
                          type="button"
                          class="btn btn-block subsection-btn subsection-btn-new"
                          id="resune_new_section_button"
                          @click="addNewEduSubSection(sectionData.id)"
                        >
                          + Add New Subsection
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--  new sections end -->
            </div>
          </div>
          <!-- v-if="sectionData.type == 'skill'" -->
          <div class="card" id="resume_new_section_extra_content">
            <button
              type="button"
              class="btn btn-block"
              id="resune_new_section_button"
              style="
                border: 3px solid rgb(230 230 230) !important;
                color: #afafaf !important;
                padding: 7px 0px;
                font-size: 14px;
                font-weight: 500;
                border-radius: 10px;
              "
              @click="addNewSection(resume.id)"
            >
              + Add New Section
            </button>
          </div>
        </div>

        <div
          class="tab-pane fade"
          id="design"
          role="tabpanel"
          aria-labelledby="design-tab"
        >
          <div class="accordion" id="accordionSidebarDesign">
            <div class="card">
              <div
                class="card-header"
                id="headingDesignOne"
                data-toggle="collapse"
                :class="[sidbar_active.template ? 'activeSidebar' : '']"
                v-on:click="setActive('template')"
                data-target="#collapseDesignOne"
                aria-expanded="false"
                aria-controls="collapseDesignOne"
              >
                <span
                  ><i
                    class="fas fa-file-invoice"
                    :class="[sidbar_active.template ? 'activeIcon' : '']"
                  ></i></span
                >Template
              </div>
              <div
                id="collapseDesignOne"
                class="collapse"
                aria-labelledby="headingDesignOne"
                data-parent="#accordionSidebarDesign"
              >
                <div
                  class="card-body scrollbar scrollbar-indigo bordered-indigo thin"
                  style="min-height: 660px; width: 100%"
                >
                  <div class="template_plans_list">
                    <div class="choose_template_header">
                      <h4>Free</h4>
                    </div>
                    <div class="col-sm-12 choose_template_free">
                      <div
                        v-for="(template, key) in templates"
                        :key="`#t_key_${key}`"
                        class="mb-3"
                      >
                        <img
                          :class="{
                            'template-border':
                              resume.template_id == template.id,
                          }"
                          :src="
                            EnvPath +
                            '/images/template/' +
                            template.name +
                            '.jpg'
                          "
                          @click="selectTemplate(template.id)"
                        />
                        <br />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                :class="[sidbar_active.colors ? 'activeSidebar' : '']"
                v-on:click="setActive('colors')"
                id="headingDesignTwo"
                data-toggle="collapse"
                data-target="#collapseDesignTwo"
                aria-expanded="false"
                aria-controls="collapseDesignTwo"
              >
                <span
                  ><i
                    class="fas fa-palette"
                    :class="[sidbar_active.colors ? 'activeIcon' : '']"
                  ></i></span
                >Colors
              </div>
              <div
                id="collapseDesignTwo"
                class="collapse"
                aria-labelledby="headingDesignTwo"
                data-parent="#accordionSidebarDesign"
              >
                <div class="card-body">
                  <div
                    class="template_plans_list Design_Color_Options_list"
                    v-for="color in colors"
                    :key="`#color_ods${color.id}`"
                  >
                    <div class="col-sm-12 choose_design_favourite">
                      <div
                        class="choose_subscription_duration choose_subscription_template_package"
                      >
                        <div class="more_checkbox_section">
                          <div
                            class="custom-control custom-radio form-check form-check-inline finder_job_check"
                          >
                            <input
                              type="radio"
                              :id="'customDesignRadio' + color.id"
                              @click="colorFun(color.id)"
                              value="option2"
                              name="address_options"
                              checked
                              class="custom-control-input form-check-input"
                            />
                            <label
                              :for="'customDesignRadio' + color.id"
                              class="custom-control-label form-check-label"
                              :class="{
                                'active-border-orange':
                                  resume.color_id == color.id,
                              }"
                            >
                              <div class="choose_template_header">
                                <h4>{{ color.name }}</h4>
                              </div>
                              <div class="choose_template_body">
                                <span>
                                  <i
                                    class="fa fa-circle"
                                    :style="'color:' + color.primaryy_color"
                                  ></i>
                                  Primary</span
                                >
                                <span>
                                  <i
                                    class="fa fa-circle"
                                    :style="'color:' + color.secondary"
                                  ></i>
                                  Secondary</span
                                >
                                <span v-if="color.accent">
                                  <i
                                    class="fa fa-circle"
                                    :style="'color:' + color.accent"
                                  ></i>
                                  Accent</span
                                >

                                <span v-if="color.font">
                                  <i
                                    class="fa fa-circle"
                                    :style="'color:' + color.font"
                                  ></i>
                                  Font</span
                                >
                              </div>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                :class="[sidbar_active.emphasis ? 'activeSidebar' : '']"
                v-on:click="setActive('emphasis')"
                id="headingDesignThree"
                data-toggle="collapse"
                data-target="#collapseDesignThree"
                aria-expanded="false"
                aria-controls="collapseDesignThree"
              >
                <span
                  ><i
                    class="fas fa-bolt"
                    :class="[sidbar_active.emphasis ? 'activeIcon' : '']"
                  ></i></span
                >Emphasis
              </div>
              <div
                id="collapseDesignThree"
                class="collapse"
                aria-labelledby="headingDesignThree"
                data-parent="#accordionSidebarDesign"
              >
                <div class="card-body emphasis_design_content">
                  <div v-if="getUserData.subscription_id == 1">

                  <p class="emphasis_note_alert">
                    <img
                      :src="EnvPath + 'builder/images/bg/yak-port.png'"
                      alt="Logo"
                      align="left"
                    />
                    Changing the emphasis of your resume requires a Plus or Pro
                    Subscription
                  </p>
                  <div
                    class="text-center"
                    style="display: block; margin: 0px auto 15px"
                  >
                    <button
                      class="btn1 btn-rounded btn-next mt-4 show_upgrade_popup_btn"
                      style="
                        width: 100%;
                        font-size: 16px;
                        border-radius: 70px !important;
                        background-color: #fb643e;
                        margin-top: 10px !important;
                        display: flex;
                        justify-content: center;
                        align-items: center;"
                        type="button"
                        data-toggle="modal"
                        data-target="#exampleModal">
                        <span>
                        Upgrade Now
                        </span>
                      <span
                        class="pl-1"
                        style="float: right; margin-right: 10px"
                        ><i
                          class="next-icon fas fa-chevron-right"
                          style="font-size: 13px"
                        ></i
                      ></span>
                    </button>
                  </div>
                </div>
                  <div class="emphasis-tooltips">
                    <h2 style="margin-top: 10px; display: inline-block">
                      Work Experience
                    </h2>
                    <div class="tooltip-container-box profession-tooltip">
                      <span class="tooltip-trigger-box">
                        <img
                          :src="EnvPath + 'images/bg/help.png'"
                          alt
                          class="small_logo"
                      /></span>
                      <div class="tooltip-text position-control-text">
                        Change work experience position
                      </div>
                    </div>
                  </div>
                  <div class="more_checkbox_section">
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="work_experience_emphasis_one"
                        value="Position"
                        name="work_experience_emphasis"
                        class="custom-control-input form-check-input"
                        v-model="employment_emphasis"
                        @change="changeEmphasisEmployment"
                         :disabled="isBasicDisabled"
                      />
                      <label
                        for="work_experience_emphasis_one"
                        class="custom-control-label form-check-label"
                        >Position</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="work_experience_emphasis_two"
                        value="Employer"
                        name="work_experience_emphasis"
                        class="custom-control-input form-check-input"
                        v-model="employment_emphasis"
                        @change="changeEmphasisEmployment"
                         :disabled="isBasicDisabled"
                      />
                      <label
                        for="work_experience_emphasis_two"
                        class="custom-control-label form-check-label"
                        >Employer</label
                      >
                    </div>
                  </div>
                  <div class="emphasis-tooltips">
                    <h2 style="margin-top: 10px; display: inline-block">
                      Education
                    </h2>
                    <div class="tooltip-container-box profession-tooltip">
                      <span class="tooltip-trigger-box">
                        <img
                          :src="EnvPath + 'images/bg/help.png'"
                          alt
                          class="small_logo"
                      /></span>
                      <div class="tooltip-text control-position-text-education">
                        Change education position
                      </div>
                    </div>
                  </div>
                  <div class="more_checkbox_section">
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="design_education_one"
                        value="Degree"
                        name="graducation_date_format"
                        class="custom-control-input form-check-input"
                        v-model="education_emphasis"
                        @change="changeEmphasisEducation"
                         :disabled="isBasicDisabled"
                      />
                      <label
                        for="design_education_one"
                        class="custom-control-label form-check-label"
                        >Degree / Major</label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        id="design_education_two"
                        value="School"
                        name="graducation_date_format"
                        class="custom-control-input form-check-input"
                        v-model="education_emphasis"
                        @change="changeEmphasisEducation"
                        :disabled="isBasicDisabled"
                      />
                      <label
                        for="design_education_two"
                        class="custom-control-label form-check-label"
                        >School</label
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div
                class="card-header"
                :class="[sidbar_active.formatting ? 'activeSidebar' : '']"
                v-on:click="setActive('formatting')"
                id="headingDesignFour"
                data-toggle="collapse"
                data-target="#collapseDesignFour"
                aria-expanded="false"
                aria-controls="collapseDesignFour"
              >
                <span
                  ><i
                    class="fas fa-text-height"
                    :class="[sidbar_active.formatting ? 'activeIcon' : '']"
                  ></i></span
                >Formatting
              </div>
              <div
                id="collapseDesignFour"
                class="collapse"
                aria-labelledby="headingDesignFour"
                data-parent="#accordionSidebarDesign"
              >
                <div
                  class="card-body scrollbar scrollbar-indigo bordered-indigo thin w-100"
                  style="min-height: 550px"
                >
                <div v-if="getUserData.subscription_id == 1">
                  <p class="emphasis_note_alert">
                    <img
                      :src="EnvPath + 'builder/images/bg/yak-port.png'"
                      alt="Logo"
                      align="left"
                    />
                    Changing the format of your resume requires a Plus or Pro
                    Subscription
                  </p>
                   <div
                    class="text-center"
                    style="display: block; margin: 0px auto 15px"
                  >
                    <button
                      class="btn1 btn-rounded btn-next mt-4 show_upgrade_popup_btn"
                      style="
                        width: 100%;
                        font-size: 16px;
                        border-radius: 70px !important;
                        background-color: #fb643e;
                        margin-top: 10px !important;
                        display: flex;
                        justify-content: center;
                        align-items: center;"
                        type="button"
                        data-toggle="modal"
                        data-target="#exampleModal">
                        <span>
                        Upgrade Now
                        </span>
                      <span
                        class="pl-1"
                        style="float: right; margin-right: 10px"
                        ><i
                          class="next-icon fas fa-chevron-right"
                          style="font-size: 13px"
                        ></i
                      ></span>
                    </button>
                  </div>
                </div>
                  <h2>Font</h2>
                  <div class="group mr-2">
                    <div class="select-arrow-side arrow-down-box">
                      <select
                        name="font_type"
                        id="font_type"
                        class="select-item input mouseLeave"
                        style="-webkit-appearance: none"
                        :disabled="templateFonts.length == 0 ? true : false"
                        @change="getTemplateFont($event)"
                      >
                        <option
                          v-for="(template_font, tf_key) in templateFonts"
                          :value="template_font.id"
                          v-if="templateFonts.length > 0"
                          :selected="
                            template_font.id == resume.font_id ? true : ''
                          "
                        >
                          {{ template_font.name }}
                        </option>
                        <option v-if="templateFonts.length == 0">
                          Add font for this template
                        </option>
                      </select>
                      <span class="highlight"></span> <span class="bar"></span>
                      <label
                        class="select-label mouseLeave_"
                        style="padding-left: 10px !important"
                        >Font Style:</label
                      >
                    </div>
                  </div>
                  <div class="range-slider">
                    <h3>Heading Font Size:</h3>
                    <span class="range-slider__value">{{ headingg }} </span>

                    <input
                      class="range-slider__range range_slider_font_heading"
                      @change="getHeadingFont()"
                      v-model="headingg"
                      type="range"
                      min="12"
                      max="26"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Subheading Font Size:</h3>
                    <span class="range-slider__value">{{ sub_heading }} </span>
                    <input
                      class="range-slider__range"
                      type="range"
                      min="9"
                      max="16"
                      v-model="sub_heading"
                      @change="getSubHeadingFont()"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Body Font Size:</h3>
                    <span class="range-slider__value"
                      >{{ body_font_size }}
                    </span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      type="range"
                      min="8"
                      max="14"
                      v-model="body_font_size"
                      @change="getBodyFontSize()"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <h2>Spacing</h2>
                  <div class="range-slider">
                    <h3>Top & Bottom Margin</h3>

                    <span class="range-slider__value">{{
                      top_bottom_margin
                    }}</span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      v-model="top_bottom_margin"
                      @change="getTopBottomMargin()"
                      type="range"
                      min="1"
                      max="10"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Left & Right Margin</h3>
                    <span class="range-slider__value">{{
                      left_right_margin
                    }}</span>

                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      v-model="left_right_margin"
                      @change="getLeftRightMargin"
                      type="range"
                      min="1"
                      max="10"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Heading Spacing</h3>
                    <span class="range-slider__value">{{
                      heading_spacing
                    }}</span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      v-model="heading_spacing"
                      type="range"
                      @change="getHeadingSpacing"
                      min="10"
                      max="150"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Subheading Spacing</h3>
                    <span class="range-slider__value">{{
                      sub_heading_spacing
                    }}</span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      type="range"
                      v-model="sub_heading_spacing"
                      @change="getSubHeadingSpacing"
                      min="10"
                      max="150"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Body Text Spacing</h3>
                    <span class="range-slider__value"
                      >{{ body_text_spacing }}
                    </span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      type="range"
                      v-model="body_text_spacing"
                      @change="getBodyTextSpacing"
                      min="0"
                      max="15"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                  <div class="range-slider">
                    <h3>Indent Spacing</h3>
                    <span class="range-slider__value"
                      >{{ indent_spacing }}
                    </span>
                    <input
                      class="range-slider__range range-slider__range_top_bottom_margin"
                      type="range"
                      v-model="indent_spacing"
                      @change="getIndendSpacing"
                      min="0"
                      max="15"
                      :disabled="isBasicDisabled"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END - Two Page Resume -->
        <div
          class="tab-pane fade"
          id="preview"
          role="tabpanel"
          aria-labelledby="preview-tab"
        >
          ...
        </div>
      </div>
    </div>
    <div class="text-center" style="display: block; margin: 0px auto 15px">
      <!-- <button
        class="btn1 btn-rounded btn-next mt-4"
        style="
          width: 60%;
          margin: 0px auto;
          font-size: 16px;
          border-radius: 70px !important;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 0;
        "
      >
        <span>Resume Review</span>
        <span class="pl-2" style="float: right"
          ><i class="next-icon fas fa-chevron-right" style="font-size: 14px"></i
        ></span>
      </button> -->
    </div>


     <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header pb-0" style="border: none">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <Subscription
                @close-subscription="closeSubscriptionModal"

              />
              <!-- @loader-action="onLoaderAction" -->
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import $ from "jquery";
import InputSuggestion from "../input-suggestion.vue";
import { environment_api } from "../../env";
import { mapGetters, mapState } from "vuex";
import store from "../../store";
import axios from "axios";
import Common from "../../mixins/Common.js";
import Subscription from "./Subscription.vue";

export default {
  name: "SideBar",
  props: ["resume"],
  mixins: [Common],
  components: {
    InputSuggestion,
    Subscription,
  },

  data() {
    return {
      isBasicDisabled: false,
      side_company_name: "",
      EnvPath: environment_api.api_base_url,
      templates: [],
      pdfDownload: false,
      acordian_color: false,
      selectedIndex: null,
      acordianLoopColorActive: false,
      list_styles: {
        vertical_bullets: {
          title: "Vertical Bullets",
        },
        horizontal_bullets: {
          title: "Horizontal Bullets",
        },
        no_bullets: {
          title: "No Bullets",
        },
      },
      edu_current_index: 0,
      degreeCheck: "",
      degree_type: false,

      schoolLocation: false,
      is_middle: false,
      is_email: false,
      endorsSidebarActive: false,
      is_phone: false,
      showPositionSought: false,
      showSingleWord: false,
      singleWordSuggestionArray: [],
      proTitleSuggestionArray: [],
      eduTitleSuggestionArray: [],
      proSummTitleSuggestionArray: [],
      over_edu_sub_content: [],
      over_new_sub_content: [],
      over_skill_sub_content: [],
      over_main_section: [],
      eduSubSection_lines: [],
      eduSubSection_object: {},
      title: "",
      single_word: "",
      job_description: false,
      is_professional_profile: false,
      is_physical_address: false,
      Professional_website: false,
      is_month_year: 0,
      is_month_year_g: 0,
      is_year_g: 0,
      is_year: 0,
      is_dates: 0,
      is_city_state_country: 0,
      is_city_state: 0,
      is_location: 0,
      is_info_full_address_city: 0,
      is_info_full_address: 0,
      is_info_city_state: 0,
      is_info_location: 0,
      headingg: 0,
      sub_heading: 0,
      body_font_size: 0,
      top_bottom_margin: 0,
      left_right_margin: 0,
      heading_spacing: 0,
      sub_heading_spacing: 0,
      body_text_spacing: 0,
      indent_spacing: 0,
      professional_section_title: false,
      education_section_title: false,
      pro_summary_section_title: false,
      contact_address_options: true,
      showProSectionWords: false,
      showEduSectionWords: false,
      showProSummSectionWords: false,
      eye_status: {
        headline: true,
        professional_profile: true,
        education: true,
        skill: true,
        new_section: true,
        professional_summary: true,
      },
      sidbar_active: {
        contact_sidebar: false,
        headline_sidebar: false,
        professional_exp: false,
        education: false,
        skill: false,
        new_section: false,
        template: false,
        colors: false,
        emphasis: false,
        formatting: false,
        professional_summary: false,
      },
      picked: 0,
      skills: [],
      colors: [],
      edorsement: {
        value: 1,
      },
      qualification_statement: {
        single_word: "",
        position_sought: "",
        level_or_exp: "",
        prom_aspect: "",
        final_statement: "",
      },
      addHeadlineType: "Endorsement",
      items: [
        {
          id: 1,
          type: "email_address",
          name: "Email Address",
          active: true,
          main_class: "contact_email",
          icon: "far fa-envelope",
        },
        {
          id: 2,
          type: "phy_address",
          name: "Physical Address",
          active: true,
          main_class: "contact_loc",
          icon: "fa fa-map-marker-alt",
        },
        {
          id: 3,
          type: "phone_num",
          name: "Phone Number",
          active: true,
          main_class: "contact_phone",
          icon: "fa fa-phone-alt",
        },
        {
          id: 4,
          type: "website",
          name: "Website Blog",
          active: true,
          main_class: "contact_website",
          icon: "fas fa-globe-europe",
        },
        {
          id: 5,
          type: "prof_prof",
          name: "Professional Profile",
          active: true,
          main_class: "",
          icon: "fab fa-linkedin",
        },
      ],
      inactive_items: [],
      over: {},
      over_exp: {},
      over_edu: {},
      over_minor: {},
      startLoc: 0,
      dragging: false,
      dragFrom: {},
      templateFonts: [],
      education_degree_option: false,
      employment_emphasis: "",
      education_emphasis: "",
    };
  },
  computed: {
    ...mapGetters([
      "getContactSortedItemsFromState",
      "fieldSuggestionsFromState",
      "getContactAddress",
      "getJobArray",
      "getProTitles",
      "getEduArray",
      "getKaunArray",
      "getSkillArray",
      "getEndorseArray",
      "getEduSubSectionArray",
      "getNewSectionArray",
      "getMainSectionArray",
      "getProSummSubSectionArray",
      "getResumeExperiencesArray",
      "getSkillSubSectionArray",
      "getTwoPageResume",
      "getShowEducationEnhancement",
      "getUserData",
      "getCheckLoader",
    ]),
    ...mapState({
      resumeStateData: (state) => state.Two_Page_Resume,

      disableProfessionalProfileDesc(state) {
        return !state.Two_Page_Resume.user.professional_profile;
      },
      disableProfessionalWebsiteDesc(state) {
        return !state.Two_Page_Resume.user.website;
      },
      disableContactInfoMiddle(state) {
        return state.Two_Page_Resume.user.middle_initial == null ? true : false;
      },
    }),
    sortedArray: function () {
      let data =
        this.getContactSortedItemsFromState == null
          ? this.items
          : this.getContactSortedItemsFromState;
      return data;
    },

    // sections: function () {
    //   return this.sections
    // }
  },

  beforeMount() {
    if (this.resume.template) {
      if (this.resume.template.fonts.length > 0) {
        this.templateFonts = this.resume.template.fonts;
      }
      if (this.resume.template.colors.length > 0) {
        this.colors = this.resume.template.colors;
      }
    }

    if (this.getJobArray.length > 0) {
      this.eye_status.professional_profile = true;
    } else {
      this.eye_status.professional_profile = false;
    }
    if (this.resume.user.professional_profile == null) {
      this.items = this.items.filter(function (item) {
        return item.type !== "prof_prof";
      });
    }
    if (this.resume.user.website == null) {
      this.items = this.items.filter(function (item) {
        return item.type !== "website";
      });
    }

    if (this.resume.resume_sorting) {
      this.resume.resume_sorting.map((value) => {
        if (value.type == "contact") {
          this.items = JSON.parse(value.value);
          if (value.inactive_list) {
            this.inactive_items = JSON.parse(value.inactive_list);
          }
        }
      });
    }
    if (this.resume.resume_setting.is_email) {
      this.is_email = true;
    }
    // Setters for contact section
    if (this.resume.employment_emphasis) {
      this.employment_emphasis = this.resume.employment_emphasis;
    }
    if (this.resume.education_emphasis) {
      this.education_emphasis = this.resume.education_emphasis;
    }

    if (this.resume.resume_setting.is_web) {
      this.Professional_website = true;
    }
    if (this.resume.resume_setting.is_phone) {
      this.is_phone = true;
    }
    if (this.resume.resume_setting.is_pro) {
      this.is_professional_profile = true;
    }
    if (this.resume.resume_setting.is_physical_address) {
      this.is_physical_address = true;
    }
    if (this.resume.education_location) {
      this.schoolLocation = this.resume.education_location;
    }

    // End Setters for COntact section

    //Setters for headline section

    if (this.resume.resume_setting.endorsement_type) {
      this.edorsement.value = this.resume.resume_setting.endorsement_type;
    }

    // END setters for headline

    //Setters for Qualification Statement
    if (this.resume.resume_qualification_statement != null) {
      this.qualification_statement = this.resume.resume_qualification_statement;
    }

    if (this.resume.resume_setting.is_middle) {
      this.is_middle = true;
    }
    if (this.resume.resume_setting.is_job_description) {
      this.job_description = true;
    }
    if (this.resume.resume_setting.is_month_year) {
      this.is_month_year = 1;
    }
    if (this.resume.resume_setting.is_year) {
      this.is_year = 2;
    }
    if (!this.resume.resume_setting.is_dates) {
      this.is_dates = 3;
    }
    if (this.resume.resume_setting.is_city_state_country) {
      this.is_city_state_country = 1;
    }
    if (this.resume.resume_setting.is_city_state) {
      this.is_city_state = 2;
    }
    if (!this.resume.resume_setting.is_location) {
      this.is_location = 3;
    }

    if (this.resume.resume_setting.is_edu_month_year) {
      this.is_month_year_g = 1;
    }
    if (this.resume.resume_setting.is_edu_year) {
      this.is_year_g = 2;
    }
    if (
      this.resume.resume_setting.is_info_full_address_city &&
      this.resume.resume_setting.is_info_location
    ) {
      this.is_info_full_address_city = 1;
    }

    if (
      this.resume.resume_setting.is_info_full_address &&
      this.resume.resume_setting.is_info_location
    ) {
      this.is_info_full_address = 2;
    }

    if (
      this.resume.resume_setting.is_info_city_state &&
      this.resume.resume_setting.is_info_location
    ) {
      this.is_info_city_state = 3;
    }
    if (!this.resume.resume_setting.is_info_location) {
      this.is_info_location = 4;
    }

    if (this.resume.heading_font_size) {
      this.headingg = this.resume.heading_font_size;
    } else if (this.resume.template) {
      this.headingg = this.resume.template.heading_font_size;
    }

    if (this.resume.subheading_font_s) {
      this.sub_heading = this.resume.subheading_font_s;
    } else if (this.resume.template) {
      this.sub_heading = this.resume.template.subheading_font_size;
    }

    if (this.resume.body_font_size) {
      this.body_font_size = this.resume.body_font_size;
    } else if (this.resume.template) {
      this.body_font_size = this.resume.template.body_font_size;
    }

    if (this.resume.top_bottom_margi) {
      this.top_bottom_margin = this.resume.top_bottom_margi;
    } else if (this.resume.template) {
      this.top_bottom_margin = this.resume.template.top_bottom_margin;
    }

    if (this.resume.left_right_margin) {
      this.left_right_margin = this.resume.left_right_margin;
    } else if (this.resume.template) {
      this.left_right_margin = this.resume.template.left_right_margin;
    }

    if (this.resume.heading_spacing) {
      this.heading_spacing = this.resume.heading_spacing;
    } else if (this.resume.template) {
      this.heading_spacing = this.resume.template.heading_spacing;
    }

    if (this.resume.subheading_spacin) {
      this.sub_heading_spacing = this.resume.subheading_spacin;
    } else if (this.resume.template) {
      this.sub_heading_spacing = this.resume.template.subheading_spacing;
    }

    if (this.resume.body_text_spacing) {
      this.body_text_spacing = this.resume.body_text_spacing;
    } else if (this.resume.template) {
      this.body_text_spacing = this.resume.template.body_text_spacing;
    }

    if (this.resume.indent_spacing) {
      this.indent_spacing = this.resume.indent_spacing;
    } else if (this.resume.template) {
      this.indent_spacing = this.resume.template.indent_spacing;
    }

    if (this.resume.resume_sections.length > 0) {
      let title = this.resume.resume_sections.find(function (item) {
        if (item.type == "work") {
          return item.title;
        }
      });

      if (title) {
        this.professional_section_title = title.title;
      } else {
        this.professional_section_title = "";
      }

      let education = this.resume.resume_sections.find(function (item) {
        if (item.type == "education") {
          return item.title;
        }
      });

      if (education) {
        this.education_section_title = education.title;
      } else {
        this.education_section_title = "";
      }
      // for professional summary
      let pro_summary = this.resume.resume_sections.find(function (item) {
        if (item.type == "professional-summary") {
          return item.title;
        }
      });

      if (pro_summary) {
        this.pro_summary_section_title = pro_summary.title;
      } else {
        this.pro_summary_section_title = "";
      }
    }
  },

  mounted() {
    store.commit("storeCheckLoader", false);
    store.commit("storeResumeBuilderClasses", false);

    this.checkBasicPlan();
    axios
      .get(this.EnvPath + "api/get-skills")
      .then(({ data }) => {
        this.skills = data;
      })
      .catch((error) => console.log(error));

    this.gettemplates();
  },

  created() {},
  watch: {
    "resume.template": function () {
      this.getFontsAndColors();
    },
  },
  methods: {
    checkSubSectionColumn(column, key) {
      if (column == 1) {
        return false;
      } else if (
        (column == 2 || column == 3) &&
        (key === "vertical_bullets" || key === "no_bullets")
      ) {
        return false;
      }
      return true;
    },
    removeUnderScore(str) {
      if (str.includes("_")) {
        const words = str.split("_").map((word) => {
          return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
        return words.join(" ");
      } else {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
      }
    },
    removeClassesFromMainHeight() {
      store.commit("storeResumeBuilderClasses", true);
    },
    closeSubscriptionModal() {
      $("#exampleModal").modal("hide");
      $(".exampleModal").modal("hide");
    },

    eyecolorChangeFunc(event) {
      $(this)
        .parent()
        .find(".visible_section_setings")
        .toggleClass("eye-white");
      // const attributeValue = event.target.getAttribute("aria-expanded");
      // if (attributeValue) {
      //   this.eyeWhiteClass = "eye-white";
      // }else{
      //   this.eyeWhiteClass = ""
      // }
    },

    goToAccountDetail() {
      this.$router.push({
        name: "account-details",
      });
    },
    checkBasicPlan() {
      this.isBasicDisabled =
        this.getUserData.subscription_id == 1 ? true : false;
    },
    changeSectionColumn: function (section_id, column_val) {
      var data = {
        section_id: section_id,
        column_val: column_val,
        resume_id: this.resume.id,
      };
      console.log(data, "hello how ad ");

      this.$emit("change-section-column", data);
    },
    getFontsAndColors: function () {
      if (this.resume.template) {
        if (this.resume.template.fonts.length > 0) {
          this.templateFonts = this.resume.template.fonts;
        }
        if (this.resume.template.colors.length > 0) {
          this.colors = this.resume.template.colors;
        }
      }
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
    acordianColor() {
      this.acordianLoopColorActive = false;
      this.acordian_color = !this.acordian_color;
    },

    acordianLoopActive(index) {
      this.acordian_color = false;
      // this.selectedIndex = index;
      // this.acordianLoopColorActive = !this.acordianLoopColorActive;
    },

    downloadPDFS: function () {
      store.commit("storeCheckLoader", true);
      this.removeClassesFromMainHeight();
      this.pdfDownload = !this.pdfDownload;
      this.$emit("downloadPdf", this.pdfDownload);
    },
    changeEmphasisEducation: function () {
      var data = {
        value: this.education_emphasis,
        type: "education_emphasis",
        resume_id: this.resume.id,
      };
      this.$emit("update-resume-formatting", data);
    },
    changeEmphasisEmployment: function () {
      var data = {
        value: this.employment_emphasis,
        type: "employment_emphasis",
        resume_id: this.resume.id,
      };
      this.$emit("update-resume-formatting", data);
    },
    changeFontTemplate: function (e, type) {
      var data = {
        value: e.target.value,
        type: type,
        resume_id: this.resume.id,
      };
      this.$emit("update-resume-formatting", data);
    },

    checkSkillSubSectionContent: function (model_id, subsection_id) {
      var bodydata = {
        subsection_id: subsection_id,
        model_id: model_id,
        type: "skills",
      };
      axios
        .post(this.EnvPath + "api/check-skill-subsection-content", bodydata)
        .then(({ data }) => {
          if (data.status) {
            var newData = {
              eduSubSection_id: data.eduSubSection_id,
              new_resumeSec_id: bodydata.subsection_id,
            };
            this.$emit("show-validation-eduSubContent", newData);
          } else {
            this.storeSkillSubSectionContent(bodydata);
          }
        })
        .catch((error) => console.log(error));
    },
    checkResumeExperienceSubSection: function (res_exp_id, subSection_id) {
      var url = this.EnvPath + "api/check-res-exp-sub-section";
      var data = {
        res_exp_id: res_exp_id,
        subSection_id: subSection_id,
      };
      axios
        .post(url, data)
        .then(({ data }) => {
          if (data.status) {
            var newData = {
              res_exp_id: res_exp_id,
              subSection_id: subSection_id,
            };
            this.$emit("show-validation-pro-summ-subsecion", newData);
          } else {
            this.addResumeExpForSubSection(res_exp_id, subSection_id);
          }
        })
        .catch((error) => console.log(error));
    },
    addResumeExpForSubSection: function (res_exp_id, subSection_id) {
      var data = {
        res_exp_id: res_exp_id,
        subSection_id: subSection_id,
        resume_id: this.resume.id,
      };
      this.$emit("create-res-exp-sub-section", data);
    },
    filterProSummExperiences: function (mainArray, secondObject) {
      var s_id = [];

      secondObject.forEach(function (value) {
        s_id.push(value.id);
      });

      return (mainArray = mainArray.filter((val) => !s_id.includes(val.id)));
    },
    filterSelectedSkills: function (mainSkillArray, filterObject) {
      var s_id = [];

      filterObject.forEach(function (value) {
        s_id.push(value.subsection_content_able_id);
      });
      return (mainSkillArray = mainSkillArray.filter(
        (val) => !s_id.includes(val.id)
      ));
    },

    saveNewSection: function (e, db_id, type) {
      var data = {
        resumeSection_id: db_id,
        value: e.target.value,
        type: type,
        resume_id: this.resume.id,
      };
      this.storeNewSection(data);
    },
    storeNewSection: function (data) {
      this.$emit("store-new-section-update", data);
    },

    finishNewSectionDrag(eduContentArray, item, pos, hide) {
      if (this.over_new_sub_content.pos != pos) {
        let targetIndex = eduContentArray.findIndex(
          (el) => el.id == this.over_new_sub_content.pos
        );

        let targetObj = eduContentArray[targetIndex];
        let startIndex = eduContentArray.findIndex((el) => el.id == pos);

        let startObj = eduContentArray[startIndex];

        targetObj.id = pos;
        startObj.id = this.over_new_sub_content.pos;

        eduContentArray[startIndex] = targetObj;
        eduContentArray[targetIndex] = startObj;
        let second_id = this.over_new_sub_content.pos;

        targetIndex = targetObj.orderBy;
        startIndex = startObj.orderBy;

        let replace_ob = [
          {
            id: pos,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateEduSubContentSorting(replace_ob);
        if (item.status !== targetObj.status) {
          console.log(targetObj, "if status not equal");
          // this.changeEducation(targetObj);
        }
      } else {
        // console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },
    finishEduSubContentDrag(eduContentArray, item, poss, hide) {
      var contact_type = "";
      if (this.over_edu_sub_content.pos != poss) {
        let targetIndex = eduContentArray.findIndex(
          (el) => el.id == this.over_edu_sub_content.pos
        );

        let targetObj = eduContentArray[targetIndex];
        let startIndex = eduContentArray.findIndex((el) => el.id == poss);

        let startObj = eduContentArray[startIndex];

        targetObj.id = poss;
        startObj.id = this.over_edu_sub_content.poss;

        eduContentArray[startIndex] = targetObj;
        eduContentArray[targetIndex] = startObj;
        let second_id = this.over_edu_sub_content.pos;

        targetIndex = targetObj.orderBy;
        startIndex = startObj.orderBy;

        let replace_ob = [
          {
            id: poss,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateEduSubContentSorting(replace_ob);
        if (item.status !== targetObj.status) {
          console.log(targetObj, "if status not equal");
          // this.changeEducation(targetObj);
        }
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, poss);
    },
    finishSkillSubContentDrag(skillContentArray, item, poss, hide) {
      console.log(skillContentArray, "skillContentArray");
      if (this.over_skill_sub_content.pos != poss) {
        let targetIndex = skillContentArray.findIndex(
          (el) => el.id == this.over_skill_sub_content.pos
        );

        let targetObj = skillContentArray[targetIndex];
        let startIndex = skillContentArray.findIndex((el) => el.id == poss);

        let startObj = skillContentArray[startIndex];

        targetObj.id = poss;
        startObj.id = this.over_skill_sub_content.poss;

        skillContentArray[startIndex] = targetObj;
        skillContentArray[targetIndex] = startObj;
        let second_id = this.over_skill_sub_content.pos;

        targetIndex = targetObj.orderBy;
        startIndex = startObj.orderBy;

        let replace_ob = [
          {
            id: poss,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateEduSubContentSorting(replace_ob);
        if (item.status !== targetObj.status) {
          console.log(targetObj, "if status not equal");
          // this.changeEducation(targetObj);
        }
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, poss);
    },
    updateEduSubContentSorting(data) {
      this.$emit("get-edu-sub-content-sorting", {
        value: JSON.stringify(data),
      });
    },

    startEduSubContentDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    startSkillSubContentDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },

    startNewSectionDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    onDragEduSubContnentOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_edu_sub_content = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    onDragSkillSubContnentOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_skill_sub_content = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    onDragNewSubContnentOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_new_sub_content = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    closeAllEduSubSectionContentType: function () {
      var list = [];
      this.getEduSubSectionArray.map(function (value, key) {
        value.showContentList = false;
        value.showAddMoreSkills = false;
        value.showAddMoreKaunHonors = false;
        value.showAddMoreKaunSocieties = false;
        value.showAddMoreEndorse = false;
        value.showAcademicAchievement = false;
        value.showAcademicSocieties = false;
        value.showSubSectionskills = false;
        value.showSubSectionEndorsement = false;
        list.push(value);
      });
      store.commit("storeEduSubSectionArray", list);
    },
    deleteNewSection: function (section_id) {
      // var data = {
      //   id: section_id,
      //   resume_id: this.resume.id,
      // };
      // this.$emit("delete-new-section", data);
      this.$emit("delete-new-subsection-popup", section_id);
    },
    deleteEduSubSection: function (edu_subsection_id) {
      this.$emit("delete-subsection-popup", edu_subsection_id);
    },
    showContentListOptionsNewSection: function (
      new_sec_subsection_id,
      allsubSection
    ) {
      var item_found = allsubSection.find(function (item) {
        if (item.id == new_sec_subsection_id) {
          return item;
        }
      });

      if (item_found != "undefined" && item_found != "") {
        item_found.showContentList = true;

        var db_index = allsubSection.findIndex(
          (el) => el.id == new_sec_subsection_id
        );
        allsubSection.splice(db_index, 1, item_found);
        // store.commit("storeEduSubSectionArray", this.getEduSubSectionArray);
      }
    },
    showContentListOptions: function (edu_subsection_id) {
      var item_found = this.getEduSubSectionArray.find(function (item) {
        if (item.id == edu_subsection_id) {
          return item;
        }
      });

      if (item_found != "undefined" && item_found != "") {
        item_found.showContentList = true;

        var db_index = this.getEduSubSectionArray.findIndex(
          (el) => el.id == edu_subsection_id
        );
        this.getEduSubSectionArray.splice(db_index, 1, item_found);
        store.commit("storeEduSubSectionArray", this.getEduSubSectionArray);
      }
    },

    showSkillContentListOptions: function (skill_subsection_id) {
      var item_found = this.getSkillSubSectionArray.find(function (item) {
        if (item.id == skill_subsection_id) {
          return item;
        }
      });

      if (item_found != "undefined" && item_found != "") {
        item_found.showContentList = true;

        var db_index = this.getSkillSubSectionArray.findIndex(
          (el) => el.id == skill_subsection_id
        );
        this.getSkillSubSectionArray.splice(db_index, 1, item_found);
        store.commit("storeSkillSubSectionArray", this.getSkillSubSectionArray);
      }
    },

    showSectionContentListOptions: function (
      SectionArray,
      edu_subsection_id,
      db_id
    ) {
      var resumeSectionArray = this.resume.resume_sections;
      // find the element in loop
      resumeSectionArray.find(function (item) {
        if (item.id == edu_subsection_id) {
          item.resume_sub_section.find(function (da) {
            if (da.id == db_id) {
              da.showContentList = true;
            }
          });
        }
      });

      var item = "";
      // find its item
      this.resume.resume_sections.find(function (rs) {
        if (rs.id == SectionArray.id) {
          item = rs;
        }
      });

      // find its index
      var db_index = this.resume.resume_sections.findIndex(
        (el) => el.id == edu_subsection_id
      );

      this.resume.resume_sections.splice(db_index, 1, item);
      store.commit("TwoPageResumeData", this.resume);
    },
    removeEduSubSectionContent: function (edu_subsection_id, active) {
      var data = {
        edu_subsection_id: edu_subsection_id,
        active: active,
      };

      this.storeEduSubSectionContent(data);
    },
    removeproSumSubSection: function (res_exp_id) {
      var data = {
        res_exp_id: res_exp_id,
        resume_id: this.resume.id,
      };
      this.removeproSumSubSectionEntry(data);
    },
    removeproSumSubSectionEntry: function (data) {
      this.$emit("remove-res-exp-pro-sum-sub-section", data);
    },

    saveEduSubSectionContent: function (subsection_id, model_id, type, active) {
      var data = {
        subsection_id: subsection_id,
        model_id: model_id,
        type: type,
        active: active,
      };
      this.checkEduSubSectionContent(data);
    },
    checkEduSubSectionContent: function (bodydata) {
      axios
        .post(this.EnvPath + "api/check-edu-subsection-content", bodydata)
        .then(({ data }) => {
          if (data.status) {
            var newData = {
              eduSubSection_id: data.eduSubSection_id,
              new_resumeSec_id: bodydata.subsection_id,
            };
            this.$emit("show-validation-eduSubContent", newData);
            return false;
          } else {
            this.storeEduSubSectionContent(bodydata);
          }
        })
        .catch((error) => console.log(error));
    },
    storeEduSubSectionContent: function (data) {
      this.$emit("store-sub-section-content", data);
    },
    storeSkillSubSectionContent: function (data) {
      this.$emit("store-skill-sub-section-content", data);
    },
    countKaunOnAchivement: function (kaun, type) {
      var count = 0;
      if (kaun.length > 0) {
        kaun.find(function (item) {
          if (item.type == type) {
            count++;
          }
        });
        return count;
      } else {
        return count;
      }
    },
    chooseNewSubSectionContent: function (e, db_id, allNewSubSectionArray) {
      if (
        !this.getShowEducationEnhancement &&
        (e.target.value == "academin_honors" ||
          e.target.value == "academic_societies")
      ) {
        return false;
      }
      var item_found = allNewSubSectionArray.find(function (item) {
        if (item.id == db_id) {
          return (item = item);
        }
      });
      if (item_found != "undefined" && item_found != "") {
        if (e.target.value == "academin_honors") {
          var ach_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ACHIVEMENTS"
          );
          if (ach_count == 0) {
            item_found.showAddMoreKaunHonors = true;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = true;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "academic_societies") {
          var org_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ORGANIZATIONS"
          );
          if (org_count == 0) {
            item_found.showAddMoreKaunSocieties = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = true;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "skills") {
          if (this.getSkillArray.length == 0) {
            item_found.showAddMoreSkills = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = true;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "endorsements") {
          if (this.getEndorseArray.length == 0) {
            item_found.showAddMoreEndorse = true;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = true;
          }
        }

        var db_index = allNewSubSectionArray.findIndex((el) => el.id == db_id);
        allNewSubSectionArray.splice(db_index, 1, item_found);
        // store.commit("storeEduSubSectionArray", this.getEduSubSectionArray);
      }
    },
    chooseEduSubSectionContent: function (e, db_id) {
      if (
        !this.getShowEducationEnhancement &&
        (e.target.value == "academin_honors" ||
          e.target.value == "academic_societies")
      ) {
        return false;
      }
      var item_found = this.getEduSubSectionArray.find(function (item) {
        if (item.id == db_id) {
          return (item = item);
        }
      });
      if (item_found != "undefined" && item_found != "") {
        if (e.target.value == "academin_honors") {
          var ach_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ACHIVEMENTS"
          );
          if (ach_count == 0) {
            item_found.showAddMoreKaunHonors = true;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = true;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "academic_societies") {
          var org_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ORGANIZATIONS"
          );
          if (org_count == 0) {
            item_found.showAddMoreKaunSocieties = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = true;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "skills") {
          if (this.getSkillArray.length == 0) {
            item_found.showAddMoreSkills = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = true;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "endorsements") {
          if (this.getEndorseArray.length == 0) {
            item_found.showAddMoreEndorse = true;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = true;
          }
        }

        var db_index = this.getEduSubSectionArray.findIndex(
          (el) => el.id == db_id
        );
        this.getEduSubSectionArray.splice(db_index, 1, item_found);
        store.commit("storeEduSubSectionArray", this.getEduSubSectionArray);
      }
    },
    chooseSkillSubSectionContent: function (e, db_id) {
      if (
        !this.getShowEducationEnhancement &&
        (e.target.value == "academin_honors" ||
          e.target.value == "academic_societies")
      ) {
        return false;
      }
      var item_found = this.getSkillSubSectionArray.find(function (item) {
        if (item.id == db_id) {
          return (item = item);
        }
      });
      if (item_found != "undefined" && item_found != "") {
        if (e.target.value == "academin_honors") {
          var ach_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ACHIVEMENTS"
          );
          if (ach_count == 0) {
            item_found.showAddMoreKaunHonors = true;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = true;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "academic_societies") {
          var org_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ORGANIZATIONS"
          );
          if (org_count == 0) {
            item_found.showAddMoreKaunSocieties = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = true;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "skills") {
          if (this.getSkillArray.length == 0) {
            item_found.showAddMoreSkills = true;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = true;
            item_found.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "endorsements") {
          if (this.getEndorseArray.length == 0) {
            item_found.showAddMoreEndorse = true;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = false;
          } else {
            item_found.showAddMoreKaunHonors = false;
            item_found.showAddMoreKaunSocieties = false;
            item_found.showAddMoreSkills = false;
            item_found.showAddMoreEndorse = false;
            //dropdown
            item_found.showAcademicAchievement = false;
            item_found.showAcademicSocieties = false;
            item_found.showSubSectionskills = false;
            item_found.showSubSectionEndorsement = true;
          }
        }

        var db_index = this.getSkillSubSectionArray.findIndex(
          (el) => el.id == db_id
        );
        this.getSkillSubSectionArray.splice(db_index, 1, item_found);
        store.commit("storeSkillSubSectionArray", this.getSkillSubSectionArray);
      }
    },

    chooseNewSectionContent: function (
      e,
      SectionArray,
      edu_subsection_id,
      db_id
    ) {
      if (
        !this.getShowEducationEnhancement &&
        (e.target.value == "academin_honors" ||
          e.target.value == "academic_societies")
      ) {
        return false;
      }
      var obj = "";
      var resumeSectionArray = this.resume.resume_sections;
      resumeSectionArray.find(function (item) {
        if (item.id == edu_subsection_id) {
          item.resume_sub_section.find(function (give) {
            if (give.id == db_id) {
              obj = give;
            }
          });
        }
      });

      if (obj != "undefined" && obj != "") {
        if (e.target.value == "academin_honors") {
          var ach_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ACHIVEMENTS"
          );
          if (ach_count == 0) {
            obj.showAddMoreKaunHonors = true;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          } else {
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = true;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "academic_societies") {
          var org_count = this.countKaunOnAchivement(
            this.getKaunArray,
            "ACADEMIC_ORGANIZATIONS"
          );
          if (org_count == 0) {
            obj.showAddMoreKaunSocieties = true;
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          } else {
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = true;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "skills") {
          if (this.getSkillArray.length == 0) {
            obj.showAddMoreSkills = true;
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          } else {
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = true;
            obj.showSubSectionEndorsement = false;
          }
        } else if (e.target.value == "endorsements") {
          if (this.getEndorseArray.length == 0) {
            obj.showAddMoreEndorse = true;
            obj.showAddMoreSkills = false;
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = false;
          } else {
            obj.showAddMoreKaunHonors = false;
            obj.showAddMoreKaunSocieties = false;
            obj.showAddMoreSkills = false;
            obj.showAddMoreEndorse = false;
            //dropdown
            obj.showAcademicAchievement = false;
            obj.showAcademicSocieties = false;
            obj.showSubSectionskills = false;
            obj.showSubSectionEndorsement = true;
          }
        }

        resumeSectionArray.find(function (item) {
          if (item.id == edu_subsection_id) {
            item.resume_sub_section.find(function (take) {
              if (take.id == db_id) {
                item.resume_sub_section.splice(0, 1, take);
              }
            });
          }
        });
      }
    },
    saveEduSudSection: function (e, db_id, type) {
      var data = {
        resumeSubSection_id: db_id,
        value: e.target.value,
        type: type,
        resume_id: this.resume.id,
      };
      this.storeEduSubSection(data);
    },
    storeEduSubSection: function (data) {
      this.$emit("store-sub-section", data);
    },
    addNewSection: function (resume_id) {
      this.createDbSection(resume_id);
    },
    createDbSection: function (resume_id) {
      var data = {
        resume_id: this.resume.id,
      };
      this.$emit("create-new-section", data);
      // window.axios
      //   .post(this.EnvPath + "api/create-new-section", {
      //     resume_id: resume_id,
      //   })
      //   .then(({ data }) => {
      //     if (data.status == 1) {
      //       this.addSection(data.db_id);
      //     } else {
      //       this.errors = [];
      //       this.errors.push(data.message);
      //     }
      //   });
    },
    addNewEduSubSection: function (resumesection_id) {
      this.createEduSubSection(resumesection_id);
    },

    createEduSubSection: function (education_id) {
      var data = {
        resumesection_id: education_id,
        resume_id: this.resume.id,
      };
      this.$emit("create-edu-sub-section", data);
    },

    addEduSubSection: function (db_id) {
      this.$emit("get-resume-detail");
    },
    isEducationOptionChange(e, type, format) {
      var data = {
        id: e.target.value,
        type: type,
        format: format,
        resume_id: this.resume.id,
      };
      this.$emit("change-edu-options", {
        data,
      });
    },

    checkGpaVlidation: function (education) {
      if (education.overallgpa >= 1 || education.majorgpa >= 1) {
        return true;
      }
      return false;
    },
    checkEduDegree: function (education) {
      if (education.degree == 15 && education.other_degree == null) {
        return false;
      } else if (education.degree == 15) {
        // if Degree specify
        return true;
      } else if (education.degree == 16) {
        // if Some College
        return false;
      }
    },
    updatedProSectionTitleDB: function (e) {
      this.setProSectionTitle(e.target.value);
    },
    updatedEduSectionTitleDB: function (e) {
      this.setEduSectionTitle(e.target.value);
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
    sortMinorArray: function (value) {
      return value.slice().sort(function (a, b) {
        return a.orderBy < b.orderBy ? -1 : 1;
      });
    },
    sortMainSectionArray: function (value) {
      return value.slice().sort(function (a, b) {
        return a.order < b.order ? -1 : 1;
      });
    },

    // functions for drag and drop job description
    startExperienceDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    finishExperienceDrag(experiencesArray, item, pos, hide) {
      if (this.over_exp.pos != pos) {
        let targetIndex = experiencesArray.findIndex(
          (el) => el.id == this.over_exp.pos
        );
        let targetObj = experiencesArray[targetIndex];
        let startIndex = experiencesArray.findIndex((el) => el.id == pos);
        let startObj = experiencesArray[startIndex];
        targetObj.id = pos;
        startObj.id = this.over_exp.pos;

        experiencesArray[startIndex] = targetObj;
        experiencesArray[targetIndex] = startObj;
        let second_id = this.over_exp.pos;
        targetIndex = targetObj.resume_experience.order;
        startIndex = startObj.resume_experience.order;
        let replace_ob = [
          {
            id: pos,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];
        this.updateExpSortingDB(replace_ob);
        // for open and close
        if (item.status !== targetObj.status) {
          this.changeExperience(targetObj);
        }
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },
    finishMinorDrag(minorArray, item, pos, hide) {
      if (this.over_minor.pos != pos) {
        let targetIndex = minorArray.findIndex(
          (el) => el.id == this.over_minor.pos
        );
        let targetObj = minorArray[targetIndex];
        let startIndex = minorArray.findIndex((el) => el.id == pos);
        let startObj = minorArray[startIndex];

        targetObj.id = pos;
        startObj.id = this.over_minor.pos;

        minorArray[startIndex] = targetObj;
        minorArray[targetIndex] = startObj;

        let second_id = this.over_minor.pos;
        //  when minor is by default incremented
        targetIndex = targetObj.orderBy;
        startIndex = startObj.orderBy;
        // custom adding

        let replace_ob = [
          {
            id: pos,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];
        this.updateMinorSortingDB(replace_ob);
        // for open and close

        if (item.status !== targetObj.status) {
          this.changeMinor(targetObj);
        }
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },
    updateMinorSortingDB(data) {
      this.$emit("get-minor-sorting", {
        value: JSON.stringify(data),
      });
    },
    updateExpSortingDB(data) {
      this.$emit("get-experience-sorting", {
        value: JSON.stringify(data),
      });
    },
    updateEduSortingDB(data) {
      this.$emit("get-education-sorting", {
        value: JSON.stringify(data),
      });
    },

    onDragExperienceOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_exp = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    changeExperience: function (experience) {
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          experience_section: experience,
        })
        .then(({ data }) => {
          this.$emit("get-resume-detail");
        })
        .catch((error) => console.log(error));
    },
    changeMinor: function (minor) {
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          minor_section: minor,
        })
        .then(({ data }) => {
          this.$emit("get-resume-detail");
        })
        .catch((error) => console.log(error));
    },
    changeEducation: function (experience) {
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          education_section: experience,
        })
        .then(({ data }) => {
          this.$emit("get-resume-detail");
        })
        .catch((error) => console.log(error));
    },
    removeEndorsement: function (endorse, endorseKey) {
      endorse.status = !endorse.status;
    },
    showEndorsement(endorse) {
      this.updateJobEndorsement(endorse);
    },
    updateJobEndorsement: function (endorse) {
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          endorsement_section: endorse,
        })
        .then(({ data }) => {
          this.$emit("get-resume-detail");
        })
        .catch((error) => console.log(error));
    },
    addNewEndorsement: function () {
      this.$router.push({
        name: "endorsements",
      });
    },
    updatedProSummFinalStatement(e) {
      this.pro_summary_section_title = e.target.value;
      this.updatedProSummSectionFinal();
    },
    updatedEduFinalStatement(e, type = null, title_id = null) {
      this.education_section_title = e.target.value;
      this.updatedEduSectionFinal();
    },

    setEduSectionTitle(value, select) {
      this.education_section_title = value;
      this.updatedEduSectionFinal();
    },
    updatedEduSectionFinal: function () {
      this.$emit("change-edu-section-title", this.education_section_title);
      setTimeout(() => {
        this.showEduSectionWords = false;
      }, 100);
    },

    updatedProSummFinalStatementDB(e) {
      this.showProSummSectionWords = false;
    },

    setProSummTitle(value, select) {
      this.pro_summary_section_title = value;
      this.updatedProSummSectionFinal();
    },
    updatedProSummSectionFinal: function () {
      this.$emit(
        "change-pro-summ-section-title",
        this.pro_summary_section_title
      );
      setTimeout(() => {
        this.showProSummSectionWords = false;
      }, 100);
    },
    setProSectionTitle(value) {
      this.professional_section_title = value;
      this.updatedProSectionFinal(value);
    },
    updatedProSectionFinal: function () {
      this.$emit("change-pro-section-title", this.professional_section_title);
      setTimeout(() => {
        this.showProSectionWords = false;
      }, 100);
    },
    addNewWorkExperience:function(){
       this.$router.push({
        name: "Store",
      });
    },
    addNewExperience: function () {
      this.$router.push({
        name: "experience-finder",
      });
    },
    convertHTMLEntity(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    },
    showPreview() {
      $("#resume_complete_preview_container").fadeIn(600);
    },
    showHideSidebar(type, obj = false) {
      if (type == "headline") {
        this.eye_status.headline = this.eye_status.headline ? false : true;
        this.$emit("showHideEmitted", {
          type: type,
          status: this.eye_status.headline,
          section_id: obj,
        });
      } else if (type == "professional_profile") {
        this.eye_status.professional_profile = this.eye_status
          .professional_profile
          ? false
          : true;
        this.$emit("showHideEmitted", {
          type: type,
          status: this.eye_status.professional_profile,
          section_id: obj,
        });
      } else if (type == "education") {
        this.eye_status.education = this.eye_status.education ? false : true;
        this.$emit("showHideEmitted", {
          type: type,
          status: this.eye_status.education,
          section_id: obj,
        });
      } else if (type == "professional_summary") {
        this.eye_status.professional_summary = this.eye_status
          .professional_summary
          ? false
          : true;

        this.$emit("showHideEmitted", {
          type: type,
          status: this.eye_status.professional_summary,
          section_id: obj,
        });
      } else if (type == "new-section") {
        // if (!obj.eyeStatus) {
        //   obj.eyeStatus = true;
        // } else {
        //   obj.eyeStatus = false;
        // }
        this.$emit("showHideEmitted", {
          type: type,

          section_id: obj,
        });
      } else if (type == "skill") {
        this.eye_status.skill = this.eye_status.skill ? false : true;
        this.$emit("showHideEmitted", {
          type: type,
          status: this.eye_status.skill,
          section_id: obj,
        });
      }
    },
    setActive(name, obj = false) {
      console.log(name, "setActive");

      $("#accordionSidebar .sidebar-tabs-acordian-setting").on(
        "click",
        async function () {
          var ariaExpanded = await $(this).attr("aria-expanded");
          $(".sidebar-tabs-acordian-setting")
            .parent()
            .removeClass("eye-box-off");
          if (ariaExpanded === "false") {
            $(this).parent().addClass("eye-box-off");
          }
        }
      );

      if (name == "contact_sidebar") {
        if (!this.sidbar_active.contact_sidebar) {
          this.sidbar_active.contact_sidebar = true;
          this.sidbar_active.headline_sidebar = false;
        } else {
          this.sidbar_active.contact_sidebar = false;
        }
      }
      if (name == "headline_sidebar") {
        if (!this.sidbar_active.headline_sidebar) {
          this.sidbar_active.headline_sidebar = true;
          this.sidbar_active.contact_sidebar = false;
        } else {
          this.sidbar_active.headline_sidebar = false;
        }
      }
      if (name == "professional_exp") {
        if (!this.sidbar_active.professional_exp) {
          this.sidbar_active.professional_exp = true;
          this.sidbar_active.contact_sidebar = false;
          this.sidbar_active.headline_sidebar = false;
        } else {
          this.sidbar_active.professional_exp = false;
        }
      }
      if (name == "education") {
        if (!this.sidbar_active.education) {
          this.sidbar_active.education = true;
        } else {
          this.sidbar_active.education = false;
        }
      }
      if (name == "professional_summary") {
        if (!this.sidbar_active.professional_summary) {
          this.sidbar_active.professional_summary = true;
        } else {
          this.sidbar_active.professional_summary = false;
        }
      }

      if (name == "new-section") {
        console.log(name, "setActive");
        if (!obj.activeBar) {
          obj.activeBar = true;
        } else {
          obj.activeBar = false;
        }

        var item = "";
        this.resume.resume_sections.find(function (rs) {
          if (rs.id == obj.id) {
            item = rs;
          } else {
            rs.activeBar = false;
          }
        });
        var db_index = this.resume.resume_sections.findIndex(
          (el) => el.id == obj.id
        );

        this.resume.resume_sections.splice(db_index, 1, item);
      }
      if (name == "skill") {
        if (!this.sidbar_active.skill) {
          this.sidbar_active.skill = true;
        } else {
          this.sidbar_active.skill = false;
        }
      }
      if (name == "template") {
        if (!this.sidbar_active.template) {
          this.sidbar_active.colors = false;
          this.sidbar_active.template = true;
          this.sidbar_active.emphasis = false;
          this.sidbar_active.formatting = false;
        } else {
          this.sidbar_active.template = false;
        }
      }
      if (name == "colors") {
        if (!this.sidbar_active.colors) {
          this.sidbar_active.colors = true;
          this.sidbar_active.template = false;
          this.sidbar_active.emphasis = false;
          this.sidbar_active.formatting = false;
        } else {
          this.sidbar_active.colors = false;
        }
      }
      if (name == "emphasis") {
        if (!this.sidbar_active.emphasis) {
          this.sidbar_active.colors = false;
          this.sidbar_active.template = false;
          this.sidbar_active.emphasis = true;
          this.sidbar_active.formatting = false;
        } else {
          this.sidbar_active.emphasis = false;
        }
      }
      if (name == "formatting") {
        if (!this.sidbar_active.formatting) {
          this.sidbar_active.colors = false;
          this.sidbar_active.template = false;
          this.sidbar_active.emphasis = false;
          this.sidbar_active.formatting = true;
        } else {
          this.sidbar_active.formatting = false;
        }
      }
    },
    startDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    finishDrag(item, pos, hide) {
      var contact_type = "";
      if (this.over.pos != pos) {
        let targetIndex = this.items.findIndex((el) => el.id == this.over.pos);

        let targetObj = this.items[targetIndex];
        let startIndex = this.items.findIndex((el) => el.id == pos);
        let startObj = this.items[startIndex];

        targetObj.id = pos;
        // targetObj.active = startObj.active;
        startObj.id = this.over.pos;
        startObj.active = targetObj.active;

        this.items[startIndex] = targetObj;
        this.items[targetIndex] = startObj;

        if (item.active !== targetObj.active) {
          if (targetObj.type == "blank") {
            let index = this.items.findIndex((el) => el.id == targetObj.id);
            this.items.splice(index, 1);
            if (this.inactive_items.length > 0) {
              const first = this.inactive_items.find(
                (e) => typeof e !== "undefined"
              );
              this.inactive_items.shift();
              this.items.push(first);
            }
          }

          if (startObj.type == "blank") {
            let index = this.items.findIndex((el) => el.id == startObj.id);
            this.items.splice(index, 1);
            if (this.inactive_items.length > 0) {
              const first = this.inactive_items.find(
                (e) => typeof e !== "undefined"
              );
              this.inactive_items.shift();
              this.items.push(first);
            }
          }
          if (item.type === "email_address") {
            this.hideEmail();
          }

          if (item.type === "website") {
            this.hideWeb();
          }
          if (item.type === "phone_num") {
            this.hidePhone();
          }
          if (item.type === "prof_prof") {
            this.hidePro();
          }
          if (item.type === "phy_address") {
            this.hidePhysicalAddress();
          }
          let activeList = this.items.filter((el) => el.active == true);
          if (activeList.length >= 6) {
            console.log("active in running");
            let lastActive = this.items.filter(
              (el) => el.type == "blank" && el.active == true
            )[
              this.items.filter((el) => el.type == "blank" && el.active == true)
                .length - 1
            ];
            let lastActiveIndex = this.items.findIndex(
              (el) => el.id == lastActive.id
            );
            this.items.splice(lastActiveIndex, 1);
          }
          this.items.sort((a, b) => Number(b.active) - Number(a.active));
        }
        this.updateSortingDB("contact");
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },

    onDragOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over = {
          item,
          pos,
          dir,
        };
      }, 50);
    },

    // functions for drag and drop job description
    startJobDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    startMainDivDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    startEduDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },
    startMinorDrag(item, i, e) {
      this.startLoc = e.clientY;
      this.dragging = true;
      this.dragFrom = item;
    },

    finishEduDrag(item, poss, hide) {
      var contact_type = "";
      if (this.over_edu.pos != poss) {
        let targetIndex = this.getEduArray.findIndex(
          (el) => el.id == this.over_edu.pos
        );

        let targetObj = this.getEduArray[targetIndex];
        let startIndex = this.getEduArray.findIndex((el) => el.id == poss);

        let startObj = this.getEduArray[startIndex];

        targetObj.id = poss;
        startObj.id = this.over_edu.poss;

        this.getEduArray[startIndex] = targetObj;
        this.getEduArray[targetIndex] = startObj;
        let second_id = this.over_edu.pos;

        targetIndex = targetObj.orderBy;
        startIndex = startObj.orderBy;

        let replace_ob = [
          {
            id: poss,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateEduSortingDB(replace_ob);
        if (item.status !== targetObj.status) {
          console.log(targetObj, "if status not equal");
          this.changeEducation(targetObj);
        }
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, poss);
    },
    finishMainSectionDrag(item, pos, hide) {
      if (this.over_main_section.item.type === "contact") {
        return false;
      }
      var contact_type = "";
      if (this.over_main_section.pos != pos) {
        let targetIndex = this.resume.resume_sections.findIndex(
          (el) => el.id == this.over_main_section.pos
        );

        let targetObj = this.resume.resume_sections[targetIndex];

        let startIndex = this.resume.resume_sections.findIndex(
          (el) => el.id == pos
        );

        let startObj = this.resume.resume_sections[startIndex];
        if (startObj.type === "contact") {
          return false;
        }

        targetObj.id = pos;

        startObj.id = this.over_main_section.pos;

        this.resume.resume_sections[startIndex] = targetObj;
        this.resume.resume_sections[targetIndex] = startObj;
        let second_id = this.over_main_section.pos;

        targetIndex = targetObj.order;
        startIndex = startObj.order;

        let replace_ob = [
          {
            id: pos,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateMainSectionSorting(replace_ob);
        //
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },
    finishJobDrag(item, pos, hide) {
      var contact_type = "";
      if (this.over.pos != pos) {
        let targetIndex = this.getJobArray.findIndex(
          (el) => el.id == this.over.pos
        );

        let targetObj = this.getJobArray[targetIndex];
        let startIndex = this.getJobArray.findIndex((el) => el.id == pos);

        let startObj = this.getJobArray[startIndex];
        targetObj.id = pos;

        startObj.id = this.over.pos;

        this.getJobArray[startIndex] = targetObj;
        this.getJobArray[targetIndex] = startObj;
        let second_id = this.over.pos;

        targetIndex = targetIndex + 1;
        startIndex = startIndex + 1;

        let replace_ob = [
          {
            id: pos,
            orderBy: targetIndex,
          },
          {
            id: second_id,
            orderBy: startIndex,
          },
        ];

        this.updateJobSortingDB(replace_ob);
        //
      } else {
        console.log("You can't move");
      }
      console.log("Finish Drag", item, pos);
    },

    onDragJobOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    onDragMainSectionOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_main_section = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    onDragEduOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_edu = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    onDragMinorOver(item, pos, e) {
      const dir = this.startLoc < e.clientY ? "down" : "up";
      setTimeout(() => {
        this.over_minor = {
          item,
          pos,
          dir,
        };
      }, 50);
    },
    updatedFinalStatementPro(e) {
      this.professional_section_title = e.target.value;
      this.updatedProSectionFinal();
    },
    // Functions for Qualification statement

    getSingleWordSuggestion() {
      this.showSingleWord = true;
      const findSingleWord = this.resume.field_suggestions.filter((item) => {
        return item.field === "single-word";
      });
      this.singleWordSuggestionArray = findSingleWord;
    },

    setSingleWordSuggestion(value) {
      this.qualification_statement.single_word = value;
      this.updatedFinalStatement();
    },
    updatedFinalStatement(e, type = null, title_id = null) {
      if (type == null) {
        this.qualification_statement.final_statement =
          this.qualification_statement.single_word +
          " " +
          this.qualification_statement.position_sought +
          " " +
          this.qualification_statement.level_or_exp +
          " " +
          " " +
          this.qualification_statement.prom_aspect;
        // this.changeAddHeadlineTitle(2);
      } else {
        this.qualification_statement.final_statement = e.target.value;
        // this.changeAddHeadlineTitle(2);
      }
      this.updatedFinalStatementDB();
    },
    updatedFinalStatementDB() {
      this.qualification_statement.resume_id = this.resume.id;
      axios
        .post(
          this.EnvPath + "api/resume-qualif-statement",
          this.qualification_statement
        )
        .then(({ data }) => {
          if (data[0].id) {
            this.$emit("get-resume-detail");

            // store.commit("TwoPageResumeData", data[0]);
          }
          this.showSingleWord = false;
          this.showPositionSought = false;
        })
        .catch((error) => console.log(error));
    },

    changeAddHeadlineTitle(event) {
      this.addHeadlineType = event?.target?.value;
      axios
        .post(this.EnvPath + "api/resume-info-update/" + this.resume.id, {
          endorsement_type: event?.target?.value,
        })
        .then(({ data }) => {
          if (data.id) {
            this.$emit("get-resume-detail");
            // store.commit("TwoPageResumeData", data);
          }
        })
        .catch((error) => console.log(error));
    },

    getProSectionTitleSuggestion() {
      if (this.resume.field_suggestions.length > 0) {
        this.showProSectionWords = true;
        const findSectionWord = this.resume.field_suggestions.filter((item) => {
          return item.field === "work-section";
        });
        this.proTitleSuggestionArray = findSectionWord;
      } else {
        this.showProSectionWords = false;
      }
    },
    getEduSectionTitleSuggestion() {
      if (this.resume.field_suggestions.length > 0) {
        this.showEduSectionWords = true;
        const findSectionWord = this.resume.field_suggestions.filter((item) => {
          return item.field === "education-section";
        });
        this.eduTitleSuggestionArray = findSectionWord;
      } else {
        this.showEduSectionWords = false;
      }
    },

    getProSummTitleSuggestion() {
      if (this.resume.field_suggestions && this.resume.field_suggestions.length > 0) {
        this.showProSummSectionWords = true;
        const findSectionWord = this.resume.field_suggestions.filter((item) => {
          return item.field === "function-section";
        });
        this.proSummTitleSuggestionArray = findSectionWord;
      } else {
        this.showProSummSectionWords = false;
      }
    },

    getTitle(title_id) {
      axios
        .post(this.EnvPath + "api/get-title", {
          title_id: title_id,
        })
        .then((data) => {
          this.title = data.data.title;
          this.showPositionSought = true;
        });
    },
    setAndHideTitle(title) {
      this.qualification_statement.position_sought = title;
      this.updatedFinalStatement();
    },

    eduInfoEyeClick: function (item, i) {
      let index = this.getEduArray.findIndex((el) => el.id == i);
      this.getEduArray[index].status = !this.getEduArray[index].status;
      this.updateEduPreview(this.getEduArray[index]);
    },
    updateEduPreview(edu) {
      this.$emit("get-edu-sorting-preview", {
        value: edu,
      });
    },
    //END  Functions for Qualification statement
    jobInfoEyeClick(item, i) {
      let index = this.getJobArray.findIndex((el) => el.id == i);
      // For resorting of items array
      this.getJobArray[index].active = !this.getJobArray[index].active;
      this.updateJobPreview(this.getJobArray[index]);
    },
    proSummSubSectionClick(i) {
      let index = this.getProSummSubSectionArray.findIndex((el) => el.id == i);
      // For resorting of items array
      this.getProSummSubSectionArray[index].status =
        !this.getProSummSubSectionArray[index].status;
      this.updateProSummSubSecPreview(this.getProSummSubSectionArray[index]);
    },
    eduSubSectionEyeClick(item, i) {
      let index = this.getEduSubSectionArray.findIndex((el) => el.id == i);

      // For resorting of items array
      this.getEduSubSectionArray[index].status =
        !this.getEduSubSectionArray[index].status;

      this.updateEduSubSectionPreview(this.getEduSubSectionArray[index]);
    },
    newSubSectionEyeClick(item, i, newSubSectionArray) {
      let index = newSubSectionArray.findIndex((el) => el.id == i);
      // For resorting of items array
      newSubSectionArray[index].status = !newSubSectionArray[index].status;

      this.updateEduSubSectionPreview(newSubSectionArray[index]);
    },
    updateEduSubSectionPreview(eduSubSection) {
      this.$emit("get-edu-subsection-preview", {
        value: eduSubSection,
      });
    },
    updateProSummSubSecPreview(proSumm) {
      this.$emit("get-prosumm-subsec-sorting-preview", {
        value: proSumm,
      });
    },
    updateJobPreview(job) {
      this.$emit("get-job-sorting-preview", {
        value: job,
      });
    },
    contactInfoEyeClick(item, i) {
      let index = this.items.findIndex((el) => el.id == i);
      // For resorting of items array
      this.items[index].active = !this.items[index].active;

      if (item.type == "blank") {
        this.items.splice(index, 1);
        if (this.inactive_items.length > 0) {
          const first = this.inactive_items.find(
            (e) => typeof e !== "undefined"
          );
          this.inactive_items.shift();
          this.items.push(first);
        }
      }
      if (item.type == "email_address") {
        this.hideEmail();
      }

      if (item.type == "website") {
        this.hideWeb();
      }
      if (item.type == "phone_num") {
        this.hidePhone();
      }
      if (item.type == "prof_prof") {
        this.hidePro();
      }
      if (item.type == "phy_address") {
        this.hidePhysicalAddress();
      }
      let activeList = this.items.filter((el) => el.active == true);
      if (activeList.length >= 6) {
        let lastActive = this.items.filter(
          (el) => el.type == "blank" && el.active == true
        )[
          this.items.filter((el) => el.type == "blank" && el.active == true)
            .length - 1
        ];
        let lastActiveIndex = this.items.findIndex(
          (el) => el.id == lastActive.id
        );
        this.items.splice(lastActiveIndex, 1);
      }
      this.items.sort((a, b) => Number(b.active) - Number(a.active));
      this.updateSortingDB("contact");
    },
    checkActiveContactDetail(type) {
      if (type == "blank") {
        return true;
      }
      if (type == "email_address") {
        return this.is_email;
      }
      if (type == "website") {
        return this.Professional_website;
      }
      if (type == "phone_num") {
        return this.is_phone;
      }
      if (type == "prof_prof") {
        return this.is_professional_profile;
      }
      if (type == "phy_address") {
        return this.is_physical_address;
      }
      return false;
    },

    async addBlankSpace() {
      if (this.items.filter((el) => el.active == true).length >= 5) {
        let item = this.items.filter(
          (el) => el.active == true && el.type != "blank"
        )[
          this.items.filter((el) => el.active == true && el.type != "blank")
            .length - 1
        ];
        item.active = false;
        this.checkActiveContactDetail(item.type);
        // let max_ids_list = ...this.items;
        this.items.push({
          id: Math.max(...this.items.map((o) => o.id)) + 1,
          type: "blank",
          name: "Blank Space",
          active: true,
          main_class: "",
          icon: "empty",
        });
        if (item.type == "blank") {
          // this.items.splice(index, 1);
          // if (this.inactive_items.length > 0) {
          //   const first = this.inactive_items.find(e => typeof e !== "undefined");
          //   this.inactive_items.shift();
          //   this.items.push(first);
          // }
        }
        if (item.type == "email_address") {
          this.hideEmail();
        }

        if (item.type == "website") {
          this.hideWeb();
        }
        if (item.type == "phone_num") {
          this.hidePhone();
        }
        if (item.type == "prof_prof") {
          this.hidePro();
        }
        if (item.type == "phy_address") {
          this.hidePhysicalAddress();
        }
        this.items.sort((a, b) => Number(b.active) - Number(a.active));
        this.updateSortingDB("contact");
      }
    },
    updateMainSectionSorting(data) {
      this.$emit("get-main-section-sorting", {
        value: JSON.stringify(data),
      });
    },
    updateJobSortingDB(data) {
      this.$emit("get-job-sorting", {
        value: JSON.stringify(data),
      });
    },
    updateSortingDB(type) {
      this.$emit("get-sorting", {
        resume_id: this.resume.id,
        type: type,
        value: JSON.stringify(this.items),
        inactive_items: JSON.stringify(this.inactive_items),
      });
    },
    removeObjectFromArray() {
      const arr = [
        {
          id: 1,
        },
        {
          id: 3,
        },
        {
          id: 5,
        },
      ];

      const indexOfObject = arr.findIndex((object) => {
        return object.id === 3;
      });

      console.log(indexOfObject); // 👉️ 1

      arr.splice(indexOfObject, 1);

      console.log(arr); // 👉️ [{id: 1}, {id: 5}]
    },

    async addEndorsement() {
      var data = {
        edorsement: this.edorsement,
        resume_id: this.resume.id,
      };
      await this.$emit("get-endorsement", data);
      this.edorsement.author_description = "";
      this.edorsement.author = "";
    },

    matchingProTitleText(typed, other, key) {
      if (other !== "") {
        const pattern = new RegExp(other, "i");
        if (pattern.test(typed)) {
          if (other.toLowerCase() == typed.toLowerCase()) {
            // const selectArray = this.proTitleSuggestionArray.splice(key, 1);
            // this.proTitleSuggestionArray.unshift(selectArray[0]);
          }
          return true;
        }
      }
      return false;
    },
    matchingEduTitleText(typed, other, key) {
      if (other !== "") {
        const pattern = new RegExp(other, "i");
        if (pattern.test(typed)) {
          if (other.toLowerCase() == typed.toLowerCase()) {
            //  const selectArray = this.eduTitleSuggestionArray.splice(key, 1);
            //  console.log(selectArray,'selectArray');
            // this.eduTitleSuggestionArray.unshift(key);
          }
          return true;
        }
        return false;
      }
      return false;
    },
    matchingProSummTitleText(typed, other, key) {
      if (other !== "") {
        const pattern = new RegExp(other, "i");
        if (pattern.test(typed)) {
          if (other.toLowerCase() == typed.toLowerCase()) {
            // const selectArray = this.proSummTitleSuggestionArray.splice(key, 1);
            // this.proSummTitleSuggestionArray.unshift(selectArray[0]);
          }
          return true;
        }
      }
      return false;
    },
    matchingText(typed, other, key) {
      if (other !== "") {
        const pattern = new RegExp(other, "i");
        if (pattern.test(typed)) {
          if (other.toLowerCase() == typed.toLowerCase()) {
            // const selectArray = this.singleWordSuggestionArray.splice(key, 1);
            // this.singleWordSuggestionArray.unshift(selectArray[0]);
          }

          // const filteredArray = this.singleWordSuggestionArray.filter((obj) =>
          //   obj.suggestion.toLowerCase().startsWith(other.toLowerCase())
          // );

          return true;
        }
      }
      return false;
    },

    getHeadingFont() {
      this.$emit("get-heading-font", this.headingg);
    },
    getTemplateFont(e) {
      this.$emit("get-template-font", e.target.value);
    },
    getSubHeadingFont() {
      this.$emit("get-sub-heading-font", this.sub_heading);
    },
    getBodyFontSize() {
      this.$emit("get-body-font-size", this.body_font_size);
    },
    getTopBottomMargin() {
      this.$emit("get-top-bottom-margin", this.top_bottom_margin);
    },
    getLeftRightMargin() {
      this.$emit("get-left-right-margin", this.left_right_margin);
    },
    getHeadingSpacing() {
      this.$emit("get_heading_spacing", this.heading_spacing);
    },

    getSubHeadingSpacing() {
      this.$emit("get_sub_heading_spacing", this.sub_heading_spacing);
    },
    getBodyTextSpacing() {
      this.$emit("get_body_text_spacing", this.body_text_spacing);
    },
    getIndendSpacing() {
      this.$emit("get_indend_spacing", this.indent_spacing);
    },
    colorFun(id) {
      this.$emit("is-color", id);
    },

    isSkill(id) {
      this.$emit("is-skill", id);
    },

    infoLocation() {
      (this.is_info_full_address_city = 0),
        (this.is_info_full_address = 0),
        (this.is_info_city_state = 0),
        (this.is_info_location = 4);

      this.$emit("is_info_location");
    },

    infoFullAddress() {
      let data = "is_info_full_address";
      store.commit("storeContactAddress", data);
      (this.is_info_full_address_city = 0),
        (this.is_info_city_state = 0),
        (this.is_info_location = 0);
      (this.is_info_full_address = 2), this.$emit("is_info_full-address");
    },
    selectTemplate(id) {
      if (id == this.resume.template_id) {
        return false;
      }
      this.$emit("select-template", id);
    },
    infoFullAddressCity() {
      let data = "is_info_full_address_city";
      store.commit("storeContactAddress", data);
      (this.is_info_full_address_city = 1),
        (this.is_info_city_state = 0),
        (this.is_info_location = 0);
      (this.is_info_full_address = 0), this.$emit("is_info_full_address_city");
    },

    infoCityState() {
      let data = "is_info_city_state";
      store.commit("storeContactAddress", data);
      (this.is_info_full_address_city = 0),
        (this.is_info_full_address = 0),
        (this.is_info_city_state = 3),
        (this.is_info_location = 0);
      this.$emit("is_info_city_state");
    },

    isEduCityStateCountry() {
      this.$emit("is_edu_city_state_country");
    },
    isEduCityState() {
      this.$emit("is_edu_city_state");
    },
    isEdulocation() {
      this.$emit("is_edu_location");
    },
    isCitySCW() {
      this.is_city_state_country = 1;
      this.$emit("is-city-scw");
    },
    isCitySC() {
      this.is_city_state = 2;
      this.$emit("is-city-sw");
    },

    isLocationW() {
      this.is_location = 3;
      this.$emit("is-location-work");
    },
    monthYear() {
      this.$emit("is-month-year");
    },
    isYear() {
      this.$emit("is-year");
    },
    isDate(sectionData) {
      this.$emit("is-date");
    },

    hideMiddleName() {
      this.is_middle = true;
      this.$emit("hide-middle");
    },

    monthYearG() {
      this.$emit("is-month-year-g");
    },
    isYearG() {
      this.$emit("is-year-g");
    },

    JobDescription() {
      this.job_description = true;
      this.$emit("hide-job-description");
    },

    hideEmail() {
      this.is_email = !this.is_email;
      this.$emit("hide-email");
    },

    hidePhone() {
      this.is_phone = !this.is_phone;
      this.$emit("hide-phone");
    },

    hideMiddle() {
      this.is_middle = true;
      this.$emit("hide-middle");
    },

    hidePro() {
      this.is_professional_profile = !this.is_professional_profile;
      this.$emit("hide-pro");
    },
    hidePhysicalAddress() {
      this.is_physical_address = !this.is_physical_address;
      this.$emit("hide-physical-address");
      if (this.is_physical_address) {
        // this.infoCityState();
        this.checkContactInStore();
        var status = true;
      } else {
        var status = false;
        this.infoLocation();
      }
      this.hideContactAdressOptions(status);
    },
    checkContactInStore() {
      if (this.getContactAddress === "is_info_city_state") {
        this.infoCityState();
      } else if (this.getContactAddress === "is_info_full_address") {
        this.infoFullAddress();
      } else if (this.getContactAddress === "is_info_full_address_city") {
        this.infoFullAddressCity();
      } else {
        this.infoCityState();
      }
    },
    hideContactAdressOptions(status) {
      this.contact_address_options = status;
    },

    hideWeb() {
      this.Professional_website = !this.Professional_website;
      this.$emit("hide-web");
    },

    changeEndorsement(id) {
      this.$emit("clicked-show-detail", id);
    },
  },
};
</script>

<style scoped>
select option:disabled {
  color: #999;
}
.endorsement_options_list_section .scrollbar {
  height: 150px;
}

.position {
  position: relative;
}

.position-list {
  position: absolute;
  list-style: none;
  width: 100%;
  background-color: white;
  border-radius: 3px;
  padding-top: 5px;
  padding-bottom: 5px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
  padding-left: 0;
}

.position-list li {
  padding-left: 13px;
}

.position-list li:hover {
  background: #eee;
}

.single-word {
  position: relative;
}

.single-word-list {
  position: absolute;
  z-index: 2 !important;
  list-style: none;
  width: 100%;
  background-color: white;
  border-radius: 3px;
  padding-top: 5px;
  padding-bottom: 5px;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
  padding-left: 0;
}

.single-word-list li {
  padding-left: 13px;
}

.single-word-list li:hover {
  background: #eee;
}

#myTab .nav-link {
  padding: 8px 13px;
}

/*.sidebar_cv_design {*/
/*  padding: 0px;*/
/*  max-width: 100%;*/
/*  margin: 0px auto;*/
/*}*/
.drop-zone {
  background-color: #eee;
  margin-bottom: 10px;
  padding: 10px;
}

.drag-el {
  background-color: #fff;
  margin-bottom: 10px;
  padding: 5px;
}

.sidebar-tabs-acordian-setting {
  background-color: #e6e6e6;
  border-radius: 10px 10px 0px 0px;
  text-align: left;
  font-family: "Hind", sans-serif;
  color: #767676;
  font-weight: 500;
  font-size: 15px;
  cursor: pointer;
  padding: 12px 10px !important;
}

.sidebar-eye-icon-show-hide,
i.fa.fa-eye-slash.show_hide_icon {
  right: 12px;
}

.heading_tab_section_sidebar[aria-expanded="true"] i.fas.fa-edit,
.heading_tab_section_sidebar[aria-expanded="true"] i.fas.fa-book-reader {
  color: #f6dc4a !important;
}
.heading_tab_section_sidebar[aria-expanded="true"] {
  background-color: #46a9fa !important;
  color: #fff !important;
}

.heading_tab_section_sidebar[aria-expanded="true"] #subSecEducation {
  background-color: #46a9fa !important;
}

.heading_tab_section_sidebar[aria-expanded="true"] #subSecEducations {
  background-color: #46a9fa !important;
}

/* button.align-dropdown-arrow[aria-expanded="true"] {
  background-color: #46a9fa !important;
  color: #fff !important;
} */

.activeSidebar[aria-expanded="true"] {
  background-color: #46a9fa !important;
  color: #fff !important;
}

.iconShow {
  visibility: visible !important;
  display: block;
}

.iconHide {
  visibility: hidden !important;
  display: none;
}

.activeIcon {
  color: #dbd465 !important;
}

.contact-profile-info {
  cursor: grabbing;
}
/*  */
.left-26-labelname {
  left: 26px;
}

label.label_name.padding-left-list-style {
  padding-left: 4px !important;
}

span.drag-arrow-box i {
  color: #bbbebf;
  font-size: 14px;
  background-color: #ffffff;
  width: 22px;
  height: 22px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 100px;
}

span.sidebar-text-width {
  width: 170px;
  word-break: break-all;
}

.card-header.activeSidebar i.fa.fa-eye-slash.show_hide_icon {
  color: #ffffff;
}
.card-header.activeSidebar i.fa.fa-eye {
  color: #ffffff;
}
.col-md-3.curson-pointer i.fa.fa-trash {
  color: #8b8b8b;
}

label.custom-control-label.form-check-label.active-border-orange,
label.custom-control-label.form-check-label.active-border-orange:active,
label.custom-control-label.form-check-label.active-border-orange:focus,
label.custom-control-label.form-check-label.active-border-orange:focus-visible {
  border: 3px solid #fb643e !important;
  outline: #fb643e !important;
  transition: none !important;
}
label.custom-control-label.form-check-label.active-border-orange:before {
  border: none !important;
}
.col-md-3.col-sm-3.col-3.cursor-pointer i.fa.fa-trash {
  color: #8b8b8b;
}
@media (max-width: 450px) {
  .col-md-9.col-sm-9.col-9 {
    padding-left: 0;
  }
  .left-26-labelname {
    left: 10px;
  }
  #accordionSidebar select,
  #accordionSidebarDesign select {
    font-size: 13px;
  }
  .card-header.porfesional-experiance-box span.sidebar-text-width,
  span.heading_tab_section_sidebar.d-flex.justify-content-start.align-items-center
    span.sidebar-text-width {
    width: 240px !important;
  }
}

@media (max-width: 330px) {
  .card-header.porfesional-experiance-box span.sidebar-text-width,
  span.heading_tab_section_sidebar.d-flex.justify-content-start.align-items-center
    span.sidebar-text-width {
    width: 135px !important;
  }

  span.drag-arrow-box {
    top: 50%;
    right: 37px !important;
    position: absolute;
    transform: translateY(-50%);
    margin-top: 3px;
  }
}

@media (max-width: 450px) {
  span.drag-arrow-box {
    top: 50%;
    right: 37px !important;
    position: absolute;
    transform: translateY(-50%);
    margin-top: 3px;
  }

  .sidebar-tabs-spacing {
    justify-content: space-between !important;
  }
}

@media (max-width: 810px) {
  span.sidebar-text-width {
    width: 90px !important;
  }
  span.drag-arrow-box i {
    top: -4px;
    position: relative;
  }
  button.add-blank-spcae {
    font-size: 12px !important;
  }
  span.drag-arrow-box i {
    font-size: 13px;
    width: 18px;
    height: 18px;
  }
}

@media (max-width: 993px) {
  button.btn1.btn-rounded.btn-next.mt-4.show_upgrade_popup_btn {
    padding: 0 !important;
    font-size: 14px !important;
    white-space: nowrap;
    text-align: center !important;
  }
  button.btn1.btn-rounded.btn-next.mt-4.show_upgrade_popup_btn span {
    margin-right: 10px !important;
    padding-left: 0 !important;
  }
  button.btn1.btn-rounded.btn-next.mt-4.show_upgrade_popup_btn span i {
    font-size: 14px !important;
  }
  .text-center.my-3 button.add-blank-spcae {
    font-size: 13px !important;
  }
}

@media (max-width: 1030px) {
  .row.align-items-center .col-md-9.col-sm-9.col-9 {
    padding-left: 0 !important;
  }
  .left-26-labelname {
    left: 12px;
  }
}

span.skill-width-control {
  width: 200px !important;
  display: flex;
}

.resposibilities_items_listing.card.mt-3 button.btn.btn-block,
.text-center.my-3.bg-white.card button.btn.btn-block.subsection-btn {
  color: #2684fe !important;
  font-weight: 500;
}

.card-header.activeSidebar i.fas.fa-edit,
.card-header.activeSidebar i.fa-book-reader {
  color: #f6dc4c !important;
}
.emphasis-tooltips .tooltip-container-box.profession-tooltip {
  margin-top: 5px;
}
.emphasis-tooltips .tooltip-trigger-box,
.emphasis-tooltips .tooltip-trigger-box img {
  right: 0 !important;
}
.tooltip-text.position-control-text {
  right: -53px !important;
}
.control-position-text-education {
  right: -44px;
}

span.visible_section_setings.visible_section_sidebar.professional-icon-eye {
  margin-right: 20px !important;
}

a.tab-icon-design {
  display: flex;
  align-items: center;
}
a.tab-icon-design i {
  margin-right: 5px !important;
  font-weight: 600;
  font-size: 19px;
}

a.tab-icon-design[aria-selected="true"] i {
  color: #f6dc4c !important;
}
i.contact-drag-icon {
  background-color: #d0d0d0;
  padding: 4px;
  border-radius: 100px;
  font-size: 12px;
  color: #ffffff;
  position: relative;
  top: -1px;
  right: -4px;
}

.eye-icon-contact-info {
  color: #d0d0d0 !important;
}

/* span.accordian-eye-arrow {
  position: relative;
  right: 23px;
  top: -2px;
}

i.acordian-eye-icon {
  margin: 0;
  position: relative;
  right: -12px;
  z-index: 9999;
} */

/* button.btn.btn-info.btn_custom_sidebar.align-dropdown-arrow
  span.acordian-eye-icon {
  margin-right: 23px !important;
  margin-top: -6px;
}
i.i-position.accordian-eye-arrow.eye-hide-show-section.fa.fa-eye {
  position: relative;
  padding: 0;
  margin: 0;
  right: 10px;
  color: #767676;
} */

button.btn.btn-info.btn_custom_sidebar.align-dropdown-arrow {
  word-break: break-all;
}

i.accordian-eye-arrow,
i.acordian-eye-icon {
  margin-right: 0;
  z-index: 9999;
  color: #b6b6b6;
  font-size: 16px !important;
}

button.btn.btn-info.btn_custom_sidebar.sidebar-bg-grey.align-dropdown-arrow
  i.i-position.fa.fa-eye-slash {
  margin: 0;
  z-index: 9999;
}

span.acordian-eye-icon {
  margin-right: 25px !important;
}
span.accordian-eye-arrow {
  margin-right: 25px !important;
  margin-top: -4px;
}
#SubSummary span.visible_section_setings.accordian-eye-arrow-two {
  margin-right: 0 !important;
  z-index: 99;
}
.acordian-color-work-experience[aria-expanded="true"],
.acordian-open-blue-back[aria-expanded="true"] {
  background-color: #46a9fa !important;
  color: #ffffff !important;
  position: relative;
}
.acordian-open-blue-back[aria-expanded="true"] .span-eye-text-control {
  color: #ffffff !important;
}
.acordian-open-blue-back[aria-expanded="true"]
  span.acordian-eye-icon.space-remove-open {
  right: 0;
  top: 7px;
  margin-right: 0 !important;
}
.acordian-open-blue-back[aria-expanded="true"]:before {
  position: absolute;
  content: "";
  width: 22%;
  height: 100%;
  background-color: #46a9fa;
  right: -37px;
  border-radius: 0 10px 10px 0;
  z-index: 0;
}

label.label_name.label-grey-text {
  color: #767676 !important;
}

#myTabContent .resposibilities_items_listing p {
  background-color: #f4fafa;
}

button.subsection-btn-new {
  border: 3px solid rgb(230 230 230) !important;
  color: #afafaf !important;
  border-radius: 10px !important;
}

#myTabContent .resposibilities_items_listing p.white-bg-text,
span.drag-arrow-box-work-experience i {
  position: relative;
  right: 42px;
  font-size: 13px;
  background-color: #d0d0d0;
  padding: 3px;
  border-radius: 100px;
  color: #ffffff;
  top: -3px;
}

.contact-profile-info.no-border.mb-3
  .group.mr-2.input_yak_logo
  .resposibilities_items_listing.selected_endorsment_item_option1
  p {
  background-color: #ffffff !important;
}

/*******************
SUBSECTION COLUMN
********************/
.sub-section-columns h1 {
  font-size: 14px;
  font-weight: 700;
  font-family: "Hind", sans-serif;
  color: #767676;
  margin: 15px 0 10px 5px;
}

label.single-boxes-value {
  background-color: #ffffff;
  height: 55px;
  display: flex;
  border-radius: 5px;
  padding: 9px 5px;
  position: relative;
}

input.input-column-section {
  display: none;
}

.subsection-column-box {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.subsection-column-single {
  flex: 1;
  margin: 0 5px;
}
span.box-one {
  width: 100%;
  height: 100%;
  background-color: #d2d2d2;
  margin: 0 3px;
}

span.digit-circle {
  color: #000000;
  font-size: 14px;
  font-weight: 600;
  font-family: monospace;
  position: absolute;
  width: 25px;
  height: 25px;
  border-radius: 100px;
  background-color: #dedede;
  display: flex;
  justify-content: center;
  align-items: center;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

input.input-column-section:checked + label {
  background-color: #ff5656 !important;
}
input.input-column-section:checked + label span.box-one {
  background-color: #ffffff !important;
}
.col-md-3.col-sm-3.col-3.cursor-pointer i.fa.fa-trash {
  padding-left: 25px;
}

div#myTabContent div#content div#accordionSidebar .selected-text-bar {
  background-color: #ffffff !important;
}

.add-organization-btn-control {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 37px;
  border-radius: 10px;
}
.add-organization-btn-control a button.add-blank-spcae {
  font-size: 14px !important;
}

#myTabContent .resposibilities_items_listing p {
  background-color: #f4fafa;
}

button.subsection-btn-new {
  border: 3px solid rgb(230 230 230) !important;
  color: #afafaf !important;
  font-weight: 500;
}

span.drag-arrow-box-work-experience i {
  position: relative;
  right: 42px;
  font-size: 13px;
  background-color: #d0d0d0;
  padding: 3px;
  border-radius: 100px;
  color: #ffffff;
  top: -3px;
}

.contact-profile-info.no-border.mb-3
  .group.mr-2.input_yak_logo
  .resposibilities_items_listing.selected_endorsment_item_option1
  p {
  background-color: #ffffff !important;
}
.template-border {
  border: 3px solid #fb643e !important;
}

.content-background-box {
  background-color: #ffffff !important;
  margin-bottom: 15px;
  border-radius: 10px;
  padding: 5px;
}

.content-background-box .resposibilities_items_listing {
  margin: 10px;
}

.text-center.mt-2.mb-3.bg-white.card {
  margin: 0 !important;
  padding: 0;
  /* border: 1px solid red !important; */
}

.text-center.mt-2.mb-3.bg-white.card button.btn.btn-block.subsection-btn {
  padding: 5px !important;
}

.text-center.my-3.bg-white.card,
.text-center.my-3.bg-white.card button.btn.btn-block.subsection-btn {
  margin: 0 !important;
  padding: 0 !important;
}

select.select-item.input-info.border-content-box {
  border: 2px solid #e6e6e6 !important;
}

.card-header.d-flex.justify-content-start.align-items-center[aria-expanded="true"]
  i.fa-solid.fa-phone-volume.sidebar-icons-grey,
.heading_tab_section_sidebar[aria-expanded="true"] i.fa-solid.fa-briefcase,
.heading_tab_section_sidebar[aria-expanded="true"] i.fa-sharp.fa-solid.fa-user,
.heading_tab_section_sidebar[aria-expanded="true"]
  i.fal.fa-book-open.sidebar-icons-grey,
.heading_tab_section_sidebar[aria-expanded="true"] i.fas.fa-chart-line,
.heading_tab_section_sidebar[aria-expanded="true"] i.far.fa-newspaper {
  color: #f6dc4c !important;
}

.activeSidebar span.visible_section_setings.visible_section_sidebar i.fa.fa-eye,
.activeSidebar
  span.visible_section_setings.visible_section_sidebar
  i.fa.fa-eye-slash {
  /* color: #ffffff !important; */
}

.wrap-header-sidebar {
  flex-wrap: nowrap;
}

@media (max-width: 780px) {
  .wrap-header-sidebar {
    flex-wrap: wrap !important;
  }
}

@media (max-width: 450px) {
  .wrap-header-sidebar {
    flex-wrap: nowrap !important;
  }

  .sidebar_cv_design {
    /* padding-left: 15px !important; */
    padding-right: 15px !important;
  }
}

.sidebar-icons-grey {
  color: #b7b7b7;
  font-size: 18px;
  margin-right: 8px;
}
.loader-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(
    255,
    255,
    255,
    0.8
  ); /* Adjust the background color and opacity */
  backdrop-filter: blur(1px); /* Adjust the blur intensity */
  z-index: 999999; /* Adjust the z-index to ensure it's on top of other elements */
}

.loader {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.spinner {
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

input[type="radio"],
input[type="checkbox"] {
  cursor: pointer !important;
}

label {
  cursor: pointer !important;
}

.eye-box-off span.visible_section_setings.visible_section_sidebar i {
  color: #ffffff !important;
}

label.label_name.label-grey-text.bg-content-side {
  background-color: #ffffff;
  display: block;
  width: 90%;
}

/* .custom-control.custom-checkbox.form-check.form-check-inline.finder_job_check.sidebar-checkbox-label{
  padding-left: 27px !important;
} */

.group.mr-2.input_yak_logo i.fa.fa-trash.float-right {
  bottom: -9px;
  position: relative;
}

/**********************
  SCROLL BAR
***********************/
/* width */
::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #e8e8e8;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #979797;
  border-radius: 100px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #979797;
}

@media (max-width: 325px) {
  /* .cv_design_sub_container ul#myTab {
    flex-wrap: wrap !important;
  }

  .cv_design_sub_container ul#myTab li {
    width: 50% !important;
  } */

  ul#myTab li .nav-link {
    padding: 10px !important;
    font-size: 12px !important;
  }

  .left-space-remove-mb {
    padding-left: 0 !important;
  }
}

.sub-section-column-tooltip {
  display: flex;
  align-items: center;
  position: relative;
}

.yewk-text-box {
  background-color: #ebb30b;
  color: #000000;
  font-size: 12px;
  padding: 10px;
  border-radius: 10px;
  text-align: center;
  position: absolute;
  transition: all 0.3s ease-in-out;
  top: -80px;
  width: 185px;
  z-index: 9;
  right: -75px;
  display: none;
}
.yawk-icon-tooltip:hover .yewk-text-box {
  display: block !important;
}

.yewk-text-box:before {
  position: absolute;
  content: "";
  background-color: #000000;
  width: 15px;
  height: 7px;
  clip-path: polygon(0 0, 47% 100%, 100% 0);
  bottom: -6px;
  left: 50%;
  transform: translateX(-50%);
}

.yawk-icon-tooltip .small_logo {
  right: 0 !important;
  top: 2px !important;
}
</style>
