<template>
  <div class="row">
    <div class="col-md-2">
      <div class="sidebar1">
        <ul class="vertical-center">
          <li><i class="fas fa-phone-volume"></i> Contact Info</li>
          <li v-if="parseInt(page) > 1" class="visited-page">
            <a href="/builder/contact/#/store"
              ><i class="fas fa-briefcase" style="background:#CCCCCC"></i> Work
              History</a
            >
          </li>
          <li v-else class="w3-opacity-max" style="color:black;">
            <i
              class="fas fa-briefcase"
              style="background: black;opacity: 0.3;"
            ></i>
            Work History
          </li>
          <li v-if="parseInt(page) > 2" class="visited-page">
            <a href="/builder/contact/#/workadd"
              ><i class="fas fa-book-open" style="background:#CCCCCC"></i>
              Education</a
            >
          </li>
          <li
            v-else
            class="w3-opacity-max"
            style="color:black; margin-right: 19px; "
          >
            <i
              class="fas fa-book-open"
              style="background: black;opacity: 0.3;"
            ></i>
            Education
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-10 grid-container">
      <div class="resume-editor-div mt-2">
        <h2>
          <span class="icon">
            <!-- <i class="fa fa-phone-volume"></i> -->
            <img src="../../../../public/images/logo/call.png" alt="" />
          </span>
          Contact Information
        </h2>
        <!-- Contact Form -->
        <!-- <form class="mt-3 contact-form"> -->
        <div
          class="row justify-content-center"
          style="padding-left:20px;padding-right:20px;margin-bottom:12px;"
        >
          <div class="col-md-4 col-sm-12 group mr-2 inputP55">
            <div class>
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
                style="padding-right:45px"
              />
              <!-- <span class="highlight"></span> -->
              <span class="bar"></span>
              <label
                class="label_name"
                :class="
                  isMouseLeaveFirstName && FirstName != ''
                    ? 'mouseleavefill'
                    : ''
                "
                >First Name*:</label
              >
            </div>
            <span>
              <img
                :src="EnvPath + 'images/bg/help.png'"
                alt
                class="small_logo"
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
                class="label_name"
                :class="
                  isMouseLeaveLastName && LastName != '' ? 'mouseleavefill' : ''
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
                class="label_name"
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
          style="padding-left:20px;padding-right:20px"
        >
          <div
            class="col-md-4 col-sm-12 group mr-2 inputP55"
            style="padding-bottom:20px"
          >
            <div class>
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
                style="padding-right:40px"
              />
              <!-- <span class="highlight"></span> -->
              <span class="bar"></span>
              <label
                class="label_street"
                :class="
                  isMouseLeaveStreetAddress && StreetAddress != ''
                    ? 'mouseleavefill'
                    : ''
                "
                style="padding-left:10px; padding-top:5px;"
                >Street Address:</label
              >
            </div>
            <span>
              <img
                :src="EnvPath + 'images/bg/help.png'"
                alt
                class="small_logo"
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
                    class="label_name"
                    :class="
                      isMouseLeaveCity && City != '' ? 'mouseleavefill' : ''
                    "
                    >City*:</label
                  >
                </div>
              </div>
              <div class="col-md-6 col-sm-12 group inputP55">
                <div class v-if="showStateSelect">
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
                    style="-webkit-appearance: none;"
                  >
                    <option value></option>
                    <option
                      v-for="(state, index) in states"
                      :key="index"
                      :value="index"
                      >{{ state }}</option
                    >
                  </select>
                  <!-- <span class="highlight"></span> -->
                  <span class="bar"></span>
                  <label
                    class="select-label"
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
                    class="label_name"
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
                <div class>
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
                    style="-webkit-appearance: none;"
                  >
                    <option
                      v-for="(country, index) in countries"
                      :key="index"
                      :value="index"
                      >{{ country }}</option
                    >
                  </select>
                  <!-- <span class="highlight"></span> -->
                  <span class="bar"></span>
                  <label
                    class="select-label"
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
                  <input
                    :maxlength="11"
                    v-on:blur="mouseLeaveInput('postalcode')"
                    type="text"
                    v-model="PostalCode"
                    class="input contact-form-validation"
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
                    class="label_name"
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
          style="padding-left:20px;padding-right:20px;margin-top:12px;margin-bottom:2px;"
        >
          <div class="col-md-6 col-sm-12 group mr-2 inputP55">
            <div class>
              <input
                :maxlength="20"
                v-on:blur="mouseLeaveInput('phone')"
                type="text"
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
                class="label_name"
                :class="
                  isMouseLeavePhone && Phone != '' ? 'mouseleavefill' : ''
                "
                >Phone *:</label
              >
            </div>
            <!-- end resume-editor-div -->
            <page-footer></page-footer>
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
                class="label_name"
                :class="
                  isMouseLeaveEmailAddress && EmailAddress != ''
                    ? 'mouseleavefill'
                    : ''
                "
                >Email Address *:</label
              >
            </div>
          </div>
        </div>
        <!-- end .row -->

        <div
          class="row justify-content-center"
          style="padding-left:20px;padding-right:20px"
        >
          <div class="col-md-6 col-sm-12 group mr-2 inputP55">
            <div class>
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
                style="padding-right:40px"
              />
              <!-- <span class="highlight"></span> -->
              <span class="bar"></span>
              <label
                class="label_name"
                :class="
                  isMouseLeaveProfile && Profile != '' ? 'mouseleavefill' : ''
                "
                >Professional Profile:</label
              >
            </div>
            <span>
              <img
                :src="EnvPath + 'images/bg/help.png'"
                alt
                class="small_logo"
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
                class="label_name"
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
          style="margin-bottom: -10px;font-size: 14px;"
        >
          {{ error }}
        </p>

        <div v-if="revisit" class="text-center">
          <button
            class="btn1 btn-rounded btn-cancel mt-4 pt-2 pb-2"
            @click="cancel_changes()"
          >
            <span class style="">Cancel </span>
          </button>
          <button
            class="btn1 btn-rounded btn-save mt-4 pt-2 pb-2"
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
            <span class style="">Save</span>
          </button>
        </div>
        <div v-else class="text-center">
          <button
            class="btn1 btn-rounded btn-next mt-4"
            style="padding-bottom:0px;"
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
            <span class style="margin-left:-14px;padding-bottom:0px;"
              >Next</span
            >
            <span class="pl-5">
              <i class="next-icon fas fa-chevron-right"></i>
            </span>
          </button>
        </div>
        <!-- </form> -->
      </div>
    </section>
  </div>
</template>

<script>
import store from "../../store";
import { environment_api } from "../../env";

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
  components: {
    headernav,
    lhsMenu,
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
      EnvPath: environment_api.api_url,
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
    };
  },
  mounted() {
    this.loadCountries();
    this.country = "";
    this.prev_country = "232";
    this.loadStates();
    //console.log("hi");
    this.loadContact();
    $("#aContact").attr("href", "/builder/contact/#/new");
    $("#aContact").parent().removeClass("resume-visited-page");
    $("#aContact").parent().addClass("current-page");
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
    loadCountries() {
      axios
        .get(this.EnvPath + "countries")
        .then((response) => {
          store.commit("LocationData", response.data);
          this.countries = this.$store.state.countriesData;
        })
        .catch((error) => console.log(error));
    },
    loadStates() {
      axios
        .get(this.EnvPath + "states")
        .then((response) => {
          store.commit("LocationData", response.data);
          this.states = this.$store.state.statesData;
        })
        .catch((error) => console.log(error));
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
        this.isMouseLeaveState = true;
        this.isMouseFocusState = false;
      }
      if (inputName === "country") {
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
        this.isMouseLeaveState = false;
        this.isMouseFocusState = true;
      }
      if (inputName === "country") {
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
              if (data.status == 1) {
                this.IsNext_f = true;
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
</style>
