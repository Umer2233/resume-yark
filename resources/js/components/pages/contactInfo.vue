<template>
  <div>
    <!-- <Header /> -->
    <div class="row">
      <!-- Sidebar  -->
      <div class="col-md-2 p-0">
        <contact-sidebar />
      </div>
      <!-- End Sidebar  -->
      <div class="col-md-10 grid-container">
        <div class="resume-editor-div mt-2">
          <h2>
            <span class="icon spce-remove-from-mobile">
              <img src="images/logo/call.png" alt="" />
            </span>
            Contact Information
          </h2>
          <!-- Contact Form -->
          <!-- <form class="mt-3 contact-form"> -->
          <div class="row justify-content-center spacee-row-bottom" style="">
            <div class="d-flex col-md-4 col-sm-12 group mr-2 inputP55">
              <div class="w-100">
                <input
                  :maxlength="50"
                  v-on:blur="mouseLeaveInput('firstName')"
                  type="text"
                  v-model="FirstName"
                  class="input"
                  :class="
                    isMouseLeaveFirstName
                      ? 'mouseLeave'
                      : isMouseFocusFirstName
                      ? 'input'
                      : ''
                  "
                  @click="inputFocus('firstName')"
                  v-on:keyup="hideContactError()"
                  @mouseleave="mouseLeaveInput('firstName')"
                  style="padding-right: 45px"
                />

                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveFirstName && FirstName != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  >First Name*:</label
                >
              </div>
              <div
                class="firstname-tooltip"
                data-tooltip="Feel free to use your nickname as long as it doesn't detract from the rest of your resume"
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
                  v-tooltip="field_firstname"
                />
              </span>
            </div>
            <div class="col-md-4 col-sm-12 group mr-2 inputP55">
              <div class>
                <input
                  :maxlength="50"
                  v-on:blur="mouseLeaveInput('lastName')"
                  type="text"
                  v-model="LastName"
                  class="input"
                  v-on:keyup="hideContactError()"
                  :class="
                    isMouseLeaveLastName
                      ? 'mouseLeave'
                      : isMouseFocusLastName
                      ? 'input'
                      : ''
                  "
                  @click="inputFocus('lastName')"
                  @mouseleave="mouseLeaveInput('lastName')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveLastName && LastName != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  >Last Name*:</label
                >
              </div>
            </div>
            <div class="col-md-4 col-sm-12 group mr-2 inputP55">
              <div class>
                <input
                  :maxlength="1"
                  v-on:blur="mouseLeaveInput('middle')"
                  type="text"
                  v-model="Middle"
                  class="input"
                  v-on:keyup="hideContactError()"
                  :class="
                    isMouseLeaveMiddle
                      ? 'mouseLeave'
                      : isMouseFocusMiddle
                      ? 'input'
                      : ''
                  "
                  @click="inputFocus('middle')"
                  @mouseleave="mouseLeaveInput('middle')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveMiddle && Middle != '' ? 'mouseleavefill' : ''
                  "
                  >Middle Initial:</label
                >
              </div>
            </div>
          </div>
          <!-- end .row -->

          <div
            class="row justify-content-center"
            style="padding-left: 20px; padding-right: 20px"
          >
            <div
              class="d-flex col-md-4 col-sm-12 group mr-2 inputP55 padding-bottom-20"
            >
              <div class="w-100">
                <textarea
                  type="text"
                  v-model="StreetAddress"
                  class="textarea"
                  placeholder=""
                  v-on:keyup="hideContactError()"
                  :class="
                    isMouseLeaveStreetAddress
                      ? 'mouseLeave'
                      : isMouseFocusStreetAddress
                      ? 'textarea'
                      : ''
                  "
                  @click="inputFocus('streetaddress')"
                  @mouseleave="mouseLeaveInput('streetaddress')"
                  style="padding-right: 45px"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_street space-top-label-text top-space-control-street-address"
                  :class="
                    isMouseLeaveStreetAddress && StreetAddress != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  style="padding-left: 2px; padding-top: 5px"
                  >Street Address:</label
                >
              </div>
              <div
                class="streetaddress-tooltip"
                data-tooltip="I am 50/50 on whether you actually need to include your street address on your resume.You can always enter it here and exclude if from your resume later."
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
                  v-tooltip="field_streetaddress"
                />
              </span>
            </div>

            <div class="col-md-8 col-sm-12">
              <div class="row">
                <div class="col-md-6 col-sm-12 group mr-2 inputP55">
                  <div class>
                    <input
                      v-on:keyup="hideContactError()"
                      :maxlength="100"
                      v-on:blur="mouseLeaveInput('city')"
                      type="text"
                      v-model="City"
                      class="input"
                      :class="
                        isMouseLeaveCity
                          ? 'mouseLeave'
                          : isMouseFocusCity
                          ? 'input'
                          : ''
                      "
                      @click="inputFocus('city')"
                      @mouseleave="mouseLeaveInput('city')"
                    />
                    <!-- <span class="highlight"></span> -->
                    <span class="bar"></span>
                    <label
                      class="label_name space-top-label-text"
                      :class="
                        isMouseLeaveCity && City != '' ? 'mouseleavefill' : ''
                      "
                      >City*:</label
                    >
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 group inputP55">
                  <div
                    class="select-arrow-side"
                    :class="arrowTrue == 'state' ? 'arrowUp' : ''"
                    v-if="showStateSelect"
                  >
                    <select
                      name="state"
                      id="state"
                      class="select-item input"
                      v-model="state"
                      v-on:change="hideContactError()"
                      :class="
                        isMouseLeaveState
                          ? 'mouseLeave'
                          : isMouseFocusState
                          ? 'input'
                          : ''
                      "
                      @click="inputFocus('state')"
                      @mouseleave="mouseLeaveInput('state')"
                      style="-webkit-appearance: none"
                    >
                      <option value></option>
                      <option
                        v-for="(state, index) in states"
                        :key="index"
                        :value="index"
                      >
                        {{ state }}
                      </option>
                    </select>
                    <!-- <span class="highlight"></span> -->
                    <span class="bar"></span>
                    <label
                      class="select-label space-top-label-text"
                      style="padding-left: 0 !important"
                      :class="
                        !state
                          ? 'unselected'
                          : (isMouseLeaveState && state != 0) ||
                            (!isMouseFocusState && state != 0)
                          ? 'mouseLeave_'
                          : ''
                      "
                      >State*:</label
                    >
                  </div>
                  <div class v-if="showStateText">
                    <input
                      v-on:keyup="hideContactError()"
                      :maxlength="70"
                      v-on:blur="mouseLeaveInput('state')"
                      type="text"
                      v-model="state"
                      class="input"
                      :class="
                        isMouseLeaveState
                          ? 'mouseLeave'
                          : isMouseFocusState
                          ? 'input-info'
                          : ''
                      "
                      @click="inputFocus('state')"
                      @mouseleave="mouseLeaveInput('state')"
                    />
                    <!-- <span class="highlight"></span> -->
                    <span class="bar"></span>
                    <label
                      class="label_name space-top-label-text"
                      :class="
                        isMouseLeaveState && state != '' ? 'mouseleavefill' : ''
                      "
                      >State*:</label
                    >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12 group mr-2 inputP55">
                  <div
                    class="select-arrow-side country-focus-red-label"
                    :class="arrowTrue == 'country' ? 'arrowUp' : ''"
                  >
                    <select
                      name="country"
                      id="country"
                      class="select-item input"
                      v-model="country"
                      v-on:change="hideContactError()"
                      :class="
                        isMouseLeaveCountry
                          ? 'mouseLeave'
                          : isMouseFocusCountry
                          ? 'input'
                          : ''
                      "
                      @click="inputFocus('country')"
                      @mouseleave="mouseLeaveInput('country')"
                      @change="hideStateSelect"
                      style="-webkit-appearance: none; padding-right: 30px"
                    >
                      <option
                        v-for="(country, index) in countries"
                        :key="index"
                        :value="index"
                      >
                        {{ country }}
                      </option>
                    </select>
                    <!-- <span class="highlight"></span> -->
                    <span class="bar"></span>
                    <label
                      style="
                        left: 11px;
                        padding-left: 0 !important;
                        top: 3px;
                        color: #66696d !important;
                      "
                      class="select-label space-top-label-text red-label-text"
                      :class="
                        !country
                          ? 'unselected'
                          : (isMouseLeaveCountry && country != 0) ||
                            (!isMouseFocusCountry && country != 0)
                          ? 'mouseLeave_'
                          : ''
                      "
                      >Country*:</label
                    >
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 group inputP55">
                  <div class>
                    <!-- contact-form-validation -->
                    <input
                      :maxlength="9"
                      v-on:blur="mouseLeaveInput('postalcode')"
                      type="text"
                      v-model="PostalCode"
                      class="input margin-bottom-control"
                      v-on:keyup="hideContactError()"
                      :class="
                        isMouseLeavePostalCode
                          ? 'mouseLeave'
                          : isMouseFocusPostalCode
                          ? 'input'
                          : ''
                      "
                      @click="inputFocus('postalcode')"
                      @mouseleave="mouseLeaveInput('postalcode')"
                    />
                    <!-- <span class="highlight"></span> -->
                    <span class="bar"></span>
                    <label
                      class="label_name space-top-label-text"
                      :class="
                        isMouseLeavePostalCode && PostalCode != ''
                          ? 'mouseleavefill'
                          : ''
                      "
                      >Postal Code*:</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end .row -->

          <div
            class="row justify-content-center"
            style="
              padding-left: 20px;
              padding-right: 20px;
              margin-top: 12px;
              margin-bottom: 2px;
            "
          >
            <div class="col-md-6 col-sm-12 group mr-2 inputP55">
              <div class>
                <input
                  :maxlength="15"
                  v-on:blur="mouseLeaveInput('phone')"
                  type="number"
                  v-model="Phone"
                  class="input contact-form-validation"
                  :class="
                    isMouseLeavePhone
                      ? 'mouseLeave'
                      : isMouseFocusPhone
                      ? 'input'
                      : ''
                  "
                  v-on:keyup="hideContactError()"
                  @click="inputFocus('phone')"
                  @mouseleave="mouseLeaveInput('phone')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeavePhone && Phone != '' ? 'mouseleavefill' : ''
                  "
                  >Phone*:</label
                >
              </div>
            </div>
            <div class="col-md-6 col-sm-12 group mr-2 inputP55">
              <div class>
                <input
                  :maxlength="100"
                  v-on:blur="mouseLeaveInput('emailaddress')"
                  type="email"
                  v-model="EmailAddress"
                  class="input"
                  v-on:keyup="hideContactError()"
                  :class="
                    isMouseLeaveEmailAddress
                      ? 'mouseLeave'
                      : isMouseFocusEmailAddress
                      ? 'input'
                      : ''
                  "
                  @click="inputFocus('emailaddress')"
                  @mouseleave="mouseLeaveInput('emailaddress')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveEmailAddress && EmailAddress != ''
                      ? 'mouseleavefill'
                      : ''
                  "
                  >Email Address*:</label
                >
              </div>
            </div>
          </div>
          <!-- end .row -->

          <div
            class="row justify-content-center"
            style="padding-left: 20px; padding-right: 20px"
          >
            <div class="d-flex col-md-6 col-sm-12 group mr-2 inputP55">
              <div class="w-100">
                <input
                  :maxlength="255"
                  v-on:blur="mouseLeaveInput('profile')"
                  type="text"
                  v-model="Profile"
                  class="input"
                  :class="
                    isMouseLeaveProfile
                      ? 'mouseLeave'
                      : isMouseFocusProfile
                      ? 'input'
                      : ''
                  "
                  v-on:keyup="hideContactError()"
                  @click="inputFocus('profile')"
                  @mouseleave="mouseLeaveInput('profile')"
                  style="padding-right: 45px"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveProfile && Profile != '' ? 'mouseleavefill' : ''
                  "
                  >Professional Profile:</label
                >
              </div>
              <div
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
              </span>
            </div>
            <div class="col-md-6 col-sm-12 group mr-2 inputP55">
              <div class>
                <input
                  :maxlength="50"
                  v-on:blur="mouseLeaveInput('website')"
                  type="text"
                  v-model="Website"
                  class="input"
                  :class="
                    isMouseLeaveWebsite
                      ? 'mouseLeave'
                      : isMouseFocusWebsite
                      ? 'input'
                      : ''
                  "
                  v-on:keyup="hideContactError()"
                  @click="inputFocus('website')"
                  @mouseleave="mouseLeaveInput('website')"
                />
                <!-- <span class="highlight"></span> -->
                <span class="bar"></span>
                <label
                  class="label_name space-top-label-text"
                  :class="
                    isMouseLeaveWebsite && Website != '' ? 'mouseleavefill' : ''
                  "
                  >Professional Website/Blog:</label
                >
              </div>
            </div>
          </div>
          <!-- end .row -->
          <!--<p v-if="!IsNext_f" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;">Please complete all of the required fields with the *</p>-->
          <p v-if="errors.length"></p>
          <p
            v-for="(error, index) in errors"
            :key="index"
            class="alert alert-warning text-center"
            style="margin-bottom: 10px; font-size: 14px"
          >
            {{ error }}
          </p>

          <div v-if="revisit" class="text-center">
            <button
              class="btn1 btn-rounded btn-cancel mt-3 white-btn-transparent"
              @click="cancel_changes()"
            >
              Cancel
              <!-- <span class style=""> </span> -->
            </button>
            <button
              class="btn1 btn-rounded btn-save mt-4 blue-btn-border"
              @click="
                IsNext(
                  FirstName,
                  LastName,
                  Middle,
                  StreetAddress,
                  City,
                  PostalCode,
                  Phone,
                  EmailAddress,
                  Profile,
                  Website
                )
              "
            >
              Save
              <!-- <span class style="">Save</span> -->
            </button>
          </div>
          <div v-else class="text-center">
            <button
              class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right"
              @click="
                IsNext(
                  FirstName,
                  LastName,
                  Middle,
                  StreetAddress,
                  City,
                  PostalCode,
                  Phone,
                  EmailAddress,
                  Profile,
                  Website
                )
              "
            >
              Next
              <!-- <span class style="margin-left:-14px;padding-bottom:0px;"
              >Next</span
            > -->

              <span class="pl-1">
                <i class="next-icon fas fa-chevron-right"></i
              ></span>
            </button>
          </div>
          <!-- </form> -->
        </div>
        <!-- end resume-editor-div -->
        <page-footer></page-footer>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../store";
import { environment_api } from "../../env";
import Header from "../includes/Header.vue";
import { mapGetters } from "vuex";
import ContactSidebar from "./ContactSidebar.vue";
import Common from "../../mixins/Common.js";
import { log } from "util";

$(document).ready(function () {
  //called when key is pressed in textbox
  $(".contact-form-validation").on("keypress", function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message

      return false;
    }
  });
});
export default {
  mixins: [Common],
  components: {
    ContactSidebar,
    Header,
  },

  props: {
    field_firstname: {
      type: String,
      required: true,
    },
    field_streetaddress: {
      type: String,
      required: true,
    },
    field_profile: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      EnvPath: environment_api.api_base_url,
      arrowTrue: "",
      errors: [],
      countries: [],
      states: [],
      index: 0,
      country: "232",
      country_: "232",
      state: "",
      state_: "",
      isMouseLeaveFirstName: false,
      isMouseFocusFirstName: false,
      isMouseLeaveLastName: false,
      isMouseFocusLastName: false,
      isMouseLeaveMiddle: false,
      isMouseFocusMiddle: false,
      isMouseLeaveCity: false,
      isMouseFocusCity: false,
      isMouseLeavePostalCode: false,
      isMouseFocusPostalCode: false,
      isMouseLeaveProfile: false,
      isMouseFocusProfile: false,
      isMouseLeaveWebsite: false,
      isMouseFocusWebsite: false,
      isMouseLeavePhone: false,
      isMouseFocusPhone: false,
      isMouseLeaveEmailAddress: false,
      isMouseFocusEmailAddress: false,
      isMouseLeaveStreetAddress: false,
      isMouseFocusStreetAddress: false,
      isMouseLeaveState: false,
      isMouseFocusState: false,
      isMouseLeaveCountry: false,
      isMouseFocusCountry: false,
      FirstName: "",
      FirstName_: "",
      LastName: "",
      LastName_: "",
      Middle: "",
      Middle_: "",
      StreetAddress: "",
      StreetAddress_: "",
      City: "",
      City_: "",
      PostalCode: "",
      PostalCode_: "",
      Phone: "",
      Phone_: "",
      EmailAddress: "",
      EmailAddress_: "",
      Profile: "",
      Profile_: "",
      Website: "",
      Website_: "",
      IsNext_f: true,
      prev_country: 0,
      showStateSelect: true,
      showStateText: false,
      page: 1,
      revisit: false,
      iscanceled: false,
      currentDate: new Date().toISOString().split("T")[0],
    };
  },
  watch: {
    FirstName(newValue, oldValue) {
      if (!/^[a-zA-Z ]+$/.test(newValue)) {
        this.FirstName = oldValue;
      }
    },
    LastName(newValue, oldValue) {
      if (!/^[a-zA-Z ]+$/.test(newValue)) {
        this.LastName = oldValue;
      }
    },
    Middle(newValue, oldValue) {
      if (!/^[a-zA-Z]+$/.test(newValue)) {
        this.Middle = "";
      }
    },
  },
  mounted() {
    store.commit("storeCurrentPage", 1);
    this.loadCountries();
    this.country = "232";
    this.prev_country = "232";
    this.loadStates();
    this.loadContact();
    $("#aContact").attr("href", "/builder/contact/");
    $("#aContact").parent().removeClass("resume-visited-page");
    $("#aContact").parent().addClass("current-page");
  },
  computed: {
    ...mapGetters(["getPageCount"]),
  },
  methods: {
    cancel_changes: function (e) {
      this.FirstName = this.FirstName_;
      this.Middle = this.Middle_;
      this.LastName = this.LastName_;
      this.StreetAddress = this.StreetAddress_;
      this.City = this.City_;
      this.state = this.state_;
      this.country = this.country_;
      this.PostalCode = this.PostalCode_;
      this.Phone = this.Phone_;
      this.EmailAddress = this.EmailAddress_;
      this.Profile = this.Profile_;
      this.Website = this.Website_;
      this.errors = [];
      this.errors.push("Changes have been canceled");
      this.iscanceled = true;
    },
    hideContactError: function (e) {
      if (this.iscanceled) {
        this.errors = [];
        this.iscanceled = false;
      } else {
        if (
          this.FirstName != "" &&
          this.LastName != "" &&
          this.Middle != "" &&
          this.StreetAddress != "" &&
          this.City != "" &&
          this.state != "" &&
          this.country != "" &&
          this.PostalCode != "" &&
          this.Phone != "" &&
          this.EmailAddress != ""
        ) {
          this.errors = [];
        }
      }
    },
    hideStateSelect: function (e) {
      if (e.target.value == "232") {
        this.showStateSelect = true;
        this.showStateText = false;
        this.prev_country = e.target.value;
      } else {
        if (this.prev_country == "232") {
          this.state = "";
        }
        this.showStateSelect = false;
        this.showStateText = true;
        this.prev_country = e.target.value;
        //this.state = '';
      }
    },
    loadContact() {
      axios.get(this.EnvPath + "getcontact").then(({ data }) => {
        //console.log(data.jobs);
        if (data.status == 1) {
          store.commit("contactData", data);
          if (this.$store.state.contact_Data.first_name != "") {
            this.FirstName = this.$store.state.contact_Data.first_name;
            this.FirstName_ = this.$store.state.contact_Data.first_name;
            this.isMouseLeaveFirstName = true;
          }

          this.Middle = this.Middle_ =
            this.$store.state.contact_Data.middle_initial;
          this.isMouseLeaveMiddle = true;
          this.LastName = this.LastName_ =
            this.$store.state.contact_Data.last_name;
          this.isMouseLeaveLastName = true;
          this.StreetAddress = this.StreetAddress_ =
            this.$store.state.contact_Data.street_address;
          this.isMouseLeaveStreetAddress = true;
          this.City = this.City_ = this.$store.state.contact_Data.city;
          this.isMouseLeaveCity = true;
          this.state = this.state_ = this.$store.state.contact_Data.state;
          this.isMouseLeaveState = true;
          this.country = this.country_ = this.$store.state.contact_Data.country;
          this.isMouseLeaveCountry = true;
          this.PostalCode = this.PostalCode_ =
            this.$store.state.contact_Data.postal_code;
          this.isMouseLeavePostalCode = true;
          this.Phone = this.Phone_ = this.$store.state.contact_Data.phone;
          this.isMouseLeavePhone = true;
          this.EmailAddress = this.EmailAddress_ =
            this.$store.state.contact_Data.email;
          this.isMouseLeaveEmailAddress = true;
          this.page = this.$store.state.contact_Data.page;
          if (this.$store.state.contact_Data.professional_profile != "") {
            this.Profile = this.Profile_ =
              this.$store.state.contact_Data.professional_profile;
            this.isMouseLeaveProfile = true;
          }
          if (this.$store.state.contact_Data.website != "") {
            this.Website = this.Website_ =
              this.$store.state.contact_Data.website;
            this.isMouseLeaveWebsite = true;
          }
          this.revisit = true;
          if (this.$store.state.contact_Data.page == 2) {
            $("#aWork_His").parent().addClass("resume-visited-page");
            $("#aWork_His").parent().removeClass("current-page");
            $("#aWork_His").attr("href", "/builder/contact/#/store");
          } else if (this.$store.state.contact_Data.page == 3) {
            $("#aWork_His").parent().addClass("resume-visited-page");
            $("#aWork_His").parent().removeClass("current-page");
            $("#aWork_His").attr("href", "/builder/contact/#/store");

            $("#aEdu").parent().addClass("resume-visited-page");
            $("#aEdu").parent().removeClass("current-page");
            $("#aEdu").attr("href", "/builder/contact/#/workadd");
          }
          if (this.$store.state.contact_Data.state == "232") {
            this.showStateSelect = true;
            this.showStateText = false;
          } else {
            this.showStateSelect = false;
            this.showStateText = true;
          }
        } else {
          // console.log(data);
        }
      });
    },
    createContact() {
      //alert("Hi");
    },

    mouseLeaveInput(inputName) {
      if (inputName === "firstName") {
        this.isMouseLeaveFirstName = true;
        this.isMouseFocusFirstName = false;
      }
      if (inputName === "lastName") {
        this.isMouseLeaveLastName = true;
        this.isMouseFocusLastName = false;
      }
      if (inputName === "middle") {
        this.isMouseLeaveMiddle = true;
        this.isMouseFocusMiddle = false;
      }
      if (inputName === "city") {
        this.isMouseLeaveCity = true;
        this.isMouseFocusCity = false;
      }
      if (inputName === "postalcode") {
        this.isMouseLeavePostalCode = true;
        this.isMouseFocusPostalCode = false;
      }
      if (inputName === "profile") {
        this.isMouseLeaveProfile = true;
        this.isMouseFocusProfile = false;
      }
      if (inputName === "website") {
        this.isMouseLeaveWebsite = true;
        this.isMouseFocusWebsite = false;
      }
      if (inputName === "phone") {
        this.isMouseLeavePhone = true;
        this.isMouseFocusPhone = false;
      }
      if (inputName === "emailaddress") {
        this.isMouseLeaveEmailAddress = true;
        this.isMouseFocusEmailAddress = false;
      }
      if (inputName === "streetaddress") {
        this.isMouseLeaveStreetAddress = true;
        this.isMouseFocusStreetAddress = false;
      }
      if (inputName === "state") {
        this.arrowTrue = "";
        this.isMouseLeaveState = true;
        this.isMouseFocusState = false;
      }
      if (inputName === "country") {
        this.arrowTrue = "";
        this.isMouseLeaveCountry = true;
        this.isMouseFocusCountry = false;
      }
    },
    inputFocus(inputName) {
      if (inputName === "firstName") {
        this.isMouseFocusFirstName = true;
        this.isMouseLeaveFirstName = false;
      }
      if (inputName === "lastName") {
        this.isMouseFocusLastName = true;
        this.isMouseLeaveLastName = false;
      }
      if (inputName === "middle") {
        this.isMouseLeaveMiddle = false;
        this.isMouseFocusMiddle = true;
      }
      if (inputName === "city") {
        this.isMouseLeaveCity = false;
        this.isMouseFocusCity = true;
      }
      if (inputName === "postalcode") {
        this.isMouseLeavePostalCode = false;
        this.isMouseFocusPostalCode = true;
      }
      if (inputName === "profile") {
        this.isMouseLeaveProfile = false;
        this.isMouseFocusProfile = true;
      }
      if (inputName === "website") {
        this.isMouseLeaveWebsite = false;
        this.isMouseFocusWebsite = true;
      }
      if (inputName === "phone") {
        this.isMouseLeavePhone = false;
        this.isMouseFocusPhone = true;
      }
      if (inputName === "emailaddress") {
        this.isMouseLeaveEmailAddress = false;
        this.isMouseFocusEmailAddress = true;
      }
      if (inputName === "streetaddress") {
        this.isMouseLeaveStreetAddress = false;
        this.isMouseFocusStreetAddress = true;
      }
      if (inputName === "state") {
        this.arrowTrue = inputName;
        this.isMouseLeaveState = false;
        this.isMouseFocusState = true;
      }
      if (inputName === "country") {
        this.arrowTrue = inputName;
        this.isMouseLeaveCountry = false;
        this.isMouseFocusCountry = true;
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    IsNext(
      FirstName,
      LastName,
      Middle,
      StreetAddress,
      City,
      PostalCode,
      Phone,
      EmailAddress,
      Profile,
      Website
    ) {
      if (
        FirstName != "" &&
        LastName != "" &&
        City != "" &&
        PostalCode != "" &&
        Phone != "" &&
        EmailAddress != "" &&
        this.state != 0 &&
        this.country != 0
      ) {
        if (!this.validEmail(EmailAddress)) {
          this.errors = [];
          this.errors.push("Valid email required");
        } else {
          let state = this.state;
          let country = this.country;
          let page = this.page;
          if (page == 1) {
            page = 2;
          }
          var querystring = require("querystring");
          window.axios
            .post(
              this.EnvPath + "contact",
              querystring.stringify({
                FirstName: FirstName,
                LastName: LastName,
                Middle: Middle,
                StreetAddress: StreetAddress,
                City: City,
                state: state,
                country: country,
                PostalCode: PostalCode,
                Phone: Phone,
                EmailAddress: EmailAddress,
                Profile: Profile,
                Website: Website,
                Page: page,
              })
            )
            .then(({ data }) => {
              // document
              //   .getElementById("work-history-nav")
              //   .removeAttribute("disabled");

              // var contact = document.getElementById("workhistory");
              // contact.classList.add("active");
              // contact.classList.remove("active1");

              // var workhistory = document.getElementById("contact-btn");
              // workhistory.classList.remove("active");
              // workhistory.classList.add("visited");
              // workhistory.classList.remove("active");
              // workhistory.classList.add("visited");
              // document.getElementById("contact-btn").removeClass("active");
              // document.getElementById("workhistory").addClass("active");

              if (data.status == 1) {
                this.IsNext_f = true;
                if (this.getPageCount < 2) {
                  store.commit("storePageCount", 2);
                  localStorage.setItem("pageCount", 2);
                  localStorage.setItem("savedDate", this.currentDate);
                }
                this.$router.push({ name: "Store" });
              } else {
                this.errors = [];
                this.errors.push(data.message);
              }
            });
        }
      } else {
        this.errors = [];
        this.errors.push(
          "Please complete all of the required fields with the *"
        );
      }
    },
  },
  created() {
    require("../../bootstrap");
  },
};
</script>

<style scoped>
.mouseLeave {
  /* top: 0px;
    font-size: 11px;
    color: #66696d !important; */
}
.mouseLeave_ {
  padding-left: 10px !important;
}
.unselected {
  font-size: 15px !important;
  color: #999 !important;
}
label.label_name.space-top-label-text.mouseleavefill {
  top: 6px;
}

@media (max-width: 450px) {
  .spce-remove-from-mobile {
    padding-right: 0 !important;
  }
  .spce-remove-from-mobile img {
    width: 22px !important;
  }
  label.label_name.space-top-label-text.mouseleavefill {
    top: 1px !important;
  }
  .d-flex.col-md-4.col-sm-12.group.mr-2.inputP55.padding-bottom-20
    .w-100
    label.label_street.space-top-label-text.top-space-control-street-address.mouseleavefill {
    padding-top: 3px !important;
  }
}

label.select-label.red-label-text.mouseLeave_ {
  color: rgb(102, 105, 109) !important;
}
.select-arrow-side.country-focus-red-label.arrowUp.show-side-arrow
  label.select-label.red-label-text {
  color: #fb643e !important;
}

.white-btn-transparent {
  background-color: transparent;
  color: #2684fe !important;
  border: 2px solid #2684fe;
  margin-right: 15px;
  border-radius: 100px !important;
  font-family: "Hind" !important;
}
.blue-btn-border:hover {
  border-color: #0d5fca !important;
}
.blue-btn-border {
  border: 2px solid #2684fe;
  border-radius: 100px !important;
  font-family: "Hind" !important;
}

.select-arrow-side.country-focus-red-label label.select-label.red-label-text {
  color: red;
}

.select-arrow-side.country-focus-red-label
  label.select-label.red-label-text.mouseLeave_ {
  color: rgb(102, 105, 109) !important;
}

label.label_street.space-top-label-text.top-space-control-street-address.mouseleavefill {
  padding-top: 5px !important;
}
label.label_street.space-top-label-text.top-space-control-street-address {
  padding-top: 3px !important;
}
.text-center
  button.btn1.btn-rounded.btn-cancel.mt-3.white-btn-transparent:hover {
  border-color: #0064e7 !important;
  color: #0064e7 !important;
}
.white-btn-transparent:hover {
  border-color: #0064e7 !important;
}
</style>
