<template>
  <div>
    <div class="loader-container" v-if="getCheckLoader">
      <div class="loader">
        <!-- Replace this with your preferred loading spinner or animation -->
        <div class="spinner"></div>
        <p>Please Wait</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 p-0">
        <contact-sidebar />
      </div>
      <div class="col-md-10 grid-container">
        <div class="section-height-footer">
          <div
            class="resume-editor-div resume-editor-firefox w-100 popup-align-center-box space-control-box-side"
          >
            <h2>Account Details</h2>
            <div class="col-12 choose_subscription_form">
              <div class="col-12 mb-4 space-remove-left">
                <h5 class="mb-0">Reset Password</h5>
              </div>

              <div class="choose_subscription_fields mb-4 space-top-heading">
                <div class="row">
                  <div class="col-md-6 col-sm-12 group mr-2 inputP55">
                    <router-link :to="{ name: 'forgot-password' }">
                      <button
                        class="btn btn-primary reset-password reset-btn-account"
                      >
                        Reset Password
                      </button>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

            <!-- reset password end -->

            <div class="col-12 choose_subscription_form">
              <div class="container">
                <div class="row mb-4 d-flex">
                  <div class="col-md-6 col-12 mb-0 d-flex space-remove-left">
                    <h5 class="mb-0">Subscription Details</h5>
                    <div
                      class="custom-plan-margin"
                      v-if="this.user.subscription_id != 1"
                    >
                      <div class="">
                        <p class="compare-plan-link">
                          <a
                            href="#"
                            type="button"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            class="fs-13"
                            style="border-radius: 100px !important"
                          >
                            Compare plans
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="choose_subscription_fields space-top-responsive">
                <div class="row">
                  <div
                    class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink account-input-height"
                  >
                    <!-- <div class="select-arrow-side" >
                      <select
                        ref="subPkg"
                        name="subscription_pkg"
                        class="select-item input mouseLeave"
                        v-model="sub_db_id"
                        v-on:change="
                          handlesubscriptionPkg(
                            $event.target.value,
                            (basic = true)
                          )
                        "
                      >
                        <option
                          v-for="sub_array in getSubcriptionArray"
                          :key="sub_array.id"
                          :value="sub_array.id"
                          :selected="user.subscription_id === sub_array.id"
                        >
                          {{ sub_array.name }}
                        </option>
                      </select>
                      <span class="bar"></span>
                      <label class="label_name">Subscription</label>
                    </div> -->

                    <div
                      class="select-arrow-side"
                      :class="{
                        'show-side-open': sub_db_id === 'open',
                      }"
                    >
                      <select
                        ref="subPkg"
                        name="subscription_pkg"
                        class="select-item input mouseLeave"
                        v-model="sub_db_id"
                        @change="
                          handlesubscriptionPkg(
                            $event.target.value,
                            (basic = true)
                          )
                        "
                      >
                        <option
                          v-for="sub_array in getSubcriptionArray"
                          :key="sub_array.id"
                          :value="sub_array.id"
                          :selected="user.subscription_id === sub_array.id"
                        >
                          {{ sub_array.name }}
                        </option>
                      </select>
                      <span class="bar"></span>
                      <label class="label_name">Subscription</label>
                    </div>
                  </div>
                  <div
                    class="col-md-6 col-sm-12 text-center"
                    v-if="this.user.subscription_id == 1"
                  >
                    <!-- <button class="btn btn-primary compare-plan-btn">
                    <router-link :to="{ name: 'subscription' }">
                      Compare plans
                    </router-link>
                  </button> -->
                    <p class="text-end">
                      <a
                        class="compare-btn-custom"
                        style="font-size: 14px"
                        @click="openSubscriptionModal()"
                        href="#"
                        type="button"
                        data-toggle="modal"
                        data-target="#exampleModal"
                      >
                        Compare plansss
                      </a>
                    </p>
                  </div>
                  <div
                    v-else
                    class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink account-input-height"
                  >
                    <div
                      class="select-arrow-side"
                      :class="{
                        'show-side-open': openArrow,
                      }"
                      v-if="pkg_array.length > 0"
                    >
                      <select
                        v-on:change="changeSubscriptionTerm()"
                        ref="sub_frequency"
                        name="country"
                        id="country"
                        class="select-item input mouseLeave"
                        style="appearance: none"
                        v-model="sub_freq_db"
                        @click="handleOpenArrow"
                        @mouseleave="handleArrowRemove"
                      >
                        <option
                          v-for="option in pkg_array"
                          :key="option.id"
                          :value="option.id"
                        >
                          {{ capitalizeFirstLetter(option.label) }} (${{
                            option.amount
                          }}
                          / {{ option.valid }})
                        </option>
                      </select>
                      <span class="bar"></span>
                      <label class="label_name">Subscription Term</label>
                    </div>
                    <!-- <div v-else>
                  <p class="text-end">
                    <a
                    class="compare-btn-custom"
                      @click="openSubscriptionModal()"
                      href="#"
                      type="button"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >
                      Compare plans
                    </a>
                  </p>
                </div>-->
                  </div>
                </div>
              </div>
            </div>

            <div
              v-if="
                getUserData.subscription_downgrade == 1 &&
                getUserData.downgrade_subscription
              "
            >
              <p class="msg-p">
                You have downgraded to
                {{
                  checkSubscription(
                    getUserData.downgrade_subscription.subscription_id,
                    getUserData.downgrade_subscription.subscription_frequency
                  )
                }}
                . Your new subscribed plan will be start on
                {{
                  changeDateFormat(
                    getUserData.downgrade_subscription.renewal_date
                  )
                }}.Thanks
              </p>
            </div>
            <credit-card-actions
              :callGetCustomerDetail="callCardDetail"
            ></credit-card-actions>
            <div class="button-delete">
              <a href="#" @click="deleteUserAccount()">Delete Account</a>
            </div>
          </div>
        </div>
        <page-footer></page-footer>
      </div>

      <!-- modals -->

      <!-- Modal -->
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
                :handlesubPkg="true"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="popup-container" v-if="deleteAccount">
        <div class="poup-sub-container">
          <div
            class="pop-content-section pop_confused_content are-you-sure-popup-box"
          >
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/logo/Confused.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8 text-center-box">
                  <h4 class="text-left">Are you Sure?</h4>

                  <p class="text-left">
                    You are about to delete your account. All your information
                    will be deleted. This includes your personal information,
                    the content you created for your resume(s), and the actual
                    finished resumes. <br />
                    <br />
                    Type the word "Delete" into the field below and select the
                    'Yes' button to proceed.
                  </p>

                  <div class="row">
                    <div
                      class="col-md-12 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
                      style="display: flex; margin-left: 10px"
                    >
                      <input
                        type="text"
                        v-model="inputValueDelModal"
                        class="input mouseLeave mb-0"
                        placeholder="Type “Delete” to continue"
                        style="font-size: 14px"
                      />
                    </div>
                  </div>

                  <div v-if="deleteAccountError">
                    <p
                      class="alert alert-warning text-center"
                      style="margin-top: 0; font-size: 14px"
                    >
                      {{ deleteAccountError }}
                    </p>
                  </div>
                  <br />
                  <div class="delete-buutton-popup">
                    <button
                      class="btnOption btn_color_option btn-rounded mt-0"
                      @click="deleteAccountModal()"
                      style="float: right"
                    >
                      Yes
                    </button>
                    <button
                      class="btnOption btn_color_option btn-rounded grey-btn-delete-popup mt-0"
                      @click="okClick()"
                      style="float: right"
                    >
                      No
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="popup-container" v-if="showUpgradePopUp">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/bg/yak-port.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8">
                  <h4>Smart Move</h4>
                  <p>{{ showUpgrademsg }}</p>
                  <div class="d-flex align-items-center mt-4">
                    <button
                      class="btnOption btn_color_option btn-rounded mt-0"
                      @click="upgradeUserSubscription()"
                      style="float: right"
                    >
                      Upgrade
                    </button>
                    <button
                      class="btnGray btn-rounded align-items-center mt-0"
                      @click="cancelUpgradation()"
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="popup-container" v-if="cantUpandDown">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/bg/yak-port.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8">
                  <h4>Alert!</h4>
                  <p>{{ cantUpandDown }}</p>
                  <div
                    class="d-flex align-items-center justify-content-center mt-4"
                  >
                    <button
                      class="btnGray btn-rounded mt-0"
                      @click="cancelUpgradation()"
                    >
                      Ok
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="popup-container" v-if="showbasicDowngrade">
        <div class="poup-sub-container">
          <div
            class="pop-content-section pop_confused_content payment-subscription-popup"
          >
            <div class="container">
              <div class="row">
                <div class="col-4" v-if="!showSubFreqBtn">
                  <img
                    :src="EnvPath + 'images/bg/yak-port.png'"
                    alt="Confused"
                  />
                </div>
                <div class="" :class="[showSubFreqBtn ? 'col-12' : 'col-8']">
                  <h4 v-if="showSubFreqBtn" class="plus-subs-text-heading">
                    Change to Plus Subscription
                  </h4>
                  <h4 v-else>Are You sure!</h4>
                  <div
                    class="row choose_subscription_form billing-detail"
                    v-if="showSubFreqBtn"
                  >
                    <h5>Choose Your Billing Cycle</h5>
                    <div class="choose_subscription_duration">
                      <div class="more_checkbox_section" id="plusBillingCycle">
                        <div
                          class="col-md-6 custom-control custom-radio form-check form-check-inline finder_job_check"
                        >
                          <input
                            type="radio"
                            v-model="sub_frequency"
                            id="billingPlan4"
                            value="1"
                            name="billingPlan4"
                            class="custom-control-input form-check-input"
                            style="cursor: pointer"
                          />
                          <label
                            for="billingPlan4"
                            class="custom-control-label form-check-label"
                            ><p>
                              Monthly<br /><span>$8.99 / month</span>
                            </p></label
                          >
                        </div>
                        <div
                          class="col-md-6 custom-control custom-radio form-check form-check-inline finder_job_check"
                        >
                          <input
                            type="radio"
                            v-model="sub_frequency"
                            id="billingPlan3"
                            value="2"
                            name="billingPlan3"
                            class="custom-control-input form-check-input"
                            style="cursor: pointer"
                          />
                          <label
                            for="billingPlan3"
                            class="custom-control-label form-check-label"
                            ><p>Annual<br /><span>$24.99 / year </span></p>
                            <span class="best_value">Best Value</span></label
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <p>{{ showbasicDowngrade }}</p>
                  <div class="d-flex align-items-center mt-4">
                    <button
                      class="btnOption btn_color_option btn-rounded mt-0 btn-subs-plane-box"
                      @click="downgradeSubscription()"
                      style="float: right"
                    >
                      Change Subscription Plan
                    </button>
                    <button
                      class="btnGray btn-rounded mt-0"
                      @click="cancelUpgradation()"
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="popup-container" v-if="showSuccessPopUp">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/bg/yak-port.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8">
                  <h4>Congratulations!</h4>
                  <p>{{ showSuccessPopUp }}</p>

                  <div
                    class="d-flex align-items-center justify-content-center mt-4"
                  >
                    <button
                      class="btnOption btn_color_option btn-rounded mt-0"
                      @click="closeAllModals()"
                      style="float: right"
                    >
                      ok
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
import twobuttonmodel from "../twobuttonmodel.vue";
import Vue from "vue";
import Button from "./Button.vue";
import JQuery from "jquery";
import store from "../../store";
import { environment_api } from "../../env";
import { log } from "util";
import { mapGetters } from "vuex";
import ContactSidebar from "./ContactSidebar.vue";
import Common from "../../mixins/Common.js";
import Subscription from "./Subscription.vue";
import CreditCardActions from "./CreditCardActions.vue";
import axios from "axios";
import { Modal } from "vue-js-modal";
import moment from "moment";

let $ = JQuery;
export default {
  name: "accountDetails",
  mixins: [Common],
  components: {
    twobuttonmodel,
    Button,
    ContactSidebar,
    Subscription,
    CreditCardActions,
    Modal,
  },
  props: {},
  data() {
    return {
      openArrow: false,
      sub_freq_db: null,
      showSuccessPopUp: "",
      sub_db_id: "",
      cantUpandDown: false,
      // isLoading: false,
      showSubFreqBtn: false,
      showbasicDowngrade: "",
      deleteAccountError: false,
      deleteAccount: false,
      showCardInput: true,
      inputValueDelModal: "",
      userId: "",
      errors: [],
      user: {},
      card_name: "",
      country: "",
      card_number: "",
      expiration: "",
      security_code: "",
      postal_code: "",
      subscriptionDropdown: [],
      CreditCard: false,
      cardFeild: false,
      plan_count: "",
      month_price: 0,
      year_price: 0,
      msg: "",
      sub_id: "",
      sub_frequency: "",
      sub_pkg_id: "",
      showUpgradePopUp: false,
      showUpgrademsg: "",
      pkg_array: [],
    };
  },
  mounted() {
    this.getUser();
    this.loadSubscriptions();
    this.callCardData();
    console.log(this.getUserData.subscription_frequency, "data");
    this.handlesubscriptionPkg(this.getUserData.subscription_id, false);
  },
  computed: {
    ...mapGetters([
      "getPageCount",
      "getUserData",
      "getPersonalDetail",
      "getSubcriptionArray",
      "getCheckLoader",
    ]),
  },

  methods: {
    handleOpenArrow() {
      this.openArrow = true;
    },

    handleArrowRemove() {
      this.openArrow = false;
    },

    changeDateFormat(date) {
      return moment(date).format("MM/DD/YYYY");
    },
    handlesubPkg() {
      this.handlesubscriptionPkg(this.getUserData.subscription_id, false);
    },
    callCardData() {
      this.callCardDetail = true;
    },
    checkSubscription(sub_id, frequency) {
      var plan = "";
      if (sub_id == 1) {
        plan = "Basic";
      } else if (sub_id == 2) {
        plan = "Plus/" + frequency;
      } else if (sub_id == 3) {
        plan = "Plus/" + frequency;
      }
      return plan;
    },

    cancelUpgradation() {
      this.handlesubscriptionPkg(this.getUserData.subscription_id, false);
      this.showUpgradePopUp = false;
      this.showbasicDowngrade = false;
      this.cantUpandDown = false;
    },
    async downgradeSubscription() {
      store.commit("storeCheckLoader", true);
      try {
        const { data } = await axios.post(
          this.EnvPath + "api/downgrade-subscription",
          {
            subscription_id: this.sub_pkg_id,
            billing_plan: this.sub_frequency,
          },
          {
            headers: {
              Authorization: "Bearer " + this.$store.state.token,
            },
          }
        );
        if (data.api_status) {
          await this.getEducationEnhancement();
          location.reload();
        }
      } catch (error) {
        console.log(error, "error at downgrade-subscription");
      }
      store.commit("storeCheckLoader", false);
    },
    checkDowngradeSubscription() {
      if (
        this.getUserData.subscription_downgrade == 1 &&
        this.getUserData.downgrade_subscription
      ) {
        this.cantUpandDown =
          `Thank you for adjusting your subscription. Your plan had successfully downgraded to ` +
          this.checkSubscription(
            this.getUserData.downgrade_subscription.subscription_id,
            this.getUserData.downgrade_subscription.subscription_frequency
          ) +
          `. You will continue to enjoy the benefits of your current plan until the end of your current billing period.
          Please note that you won't be able to subscribe to a new package or upgrade until your next renewal date. Any changes made will take
          effect at the beginning of your next billing cycle.`;
        return false;
      }
      return true;
    },
    async changeSubscriptionTerm() {
      const checkStatus = this.checkDowngradeSubscription();
      if (!checkStatus) {
        return false;
      }
      store.commit("storeCheckLoader", true);
      this.showSubFreqBtn = false;
      this.sub_pkg_id = this.$refs.subPkg.value;
      this.sub_frequency = this.$refs.sub_frequency.value;
      // this.sub_frequency = sub_frequency;
      const upgradeStatus = this.upgradeSubscriptionCombinations();
      if (upgradeStatus) {
        await this.updateSubscription();
      } else {
        const downgradeStatus = this.downgradeSubscriptionCombinations();
        if (downgradeStatus) {
          const proYearToMonthly = this.proYearToMonthly();
          const plusYearToMonthly = this.plusYearToMonthly();
          if (plusYearToMonthly || proYearToMonthly) {
            const renewal_date = this.user.renewal_date;
            this.showUpgrade = "Are You sure";
            if (plusYearToMonthly) {
              var amount = 8.99;
            } else {
              var amount = 19.99;
            }

            this.showbasicDowngrade =
              `You have changed your subscription term from yearly to monthly.
             Your credit card will be charged $` +
              amount +
              ` when your plan renews on ` +
              renewal_date +
              `
              and  $` +
              amount +
              ` every month afterward`;
          } else if (this.proPlusToBasic) {
            // it means he wants to come on basic
          } else {
          }
        }
        console.log("do nothing");
      }
      store.commit("storeCheckLoader", false);
    },
    proYearToMonthly() {
      if (
        this.user.subscription_id == 3 &&
        this.user.subscription_frequency === "annual" &&
        this.sub_pkg_id == 3 &&
        this.sub_frequency == 1
      ) {
        return true;
      }
      return false;
    },

    proPlusToBasic() {
      if (
        (this.user.subscription_id == 3 || this.user.subscription_id == 2) &&
        (this.user.subscription_frequency === "annual" ||
          this.user.subscription_frequency === "monthly") &&
        this.sub_pkg_id == 1
        // this.sub_frequency == 1
      ) {
        return true;
      }
      return false;
    },
    plusYearToMonthly() {
      console.log(this.sub_pkg_id, "this.sub_pkg_id");
      if (
        this.user.subscription_id == 2 &&
        this.user.subscription_frequency === "annual" &&
        this.sub_pkg_id == 2 &&
        this.sub_frequency == 1
      ) {
        return true;
      }
      return false;
    },

    downgradeSubscriptionCombinations() {
      switch (true) {
        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency == "annual" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 1:
          return true;
          break;
        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency == "monthly" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 1:
          return true;
          break;
        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency == "monthly" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 2:
          return true;
          break;

        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 2:
          return true;
          break;

        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 1:
          return true;
          break;

        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 1:
          // && this.sub_frequency == 1:
          return true;
          break;
        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency == "monthly" &&
          this.sub_pkg_id == 1:
          // this.sub_frequency == 2:
          return true;
          break;
        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 1:
          return true;
          break;

        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 1:
          //  &&   this.sub_frequency == 2:
          return true;
          break;

        default:
          return false;
          break;
      }
    },
    upgradeSubscriptionCombinations() {
      switch (true) {
        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency == "monthly" &&
          this.sub_pkg_id == 2 &&
          this.sub_frequency == 2:
          return true;
          break;

        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "monthly" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 1:
          return true;
          break;

        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "monthly" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 2:
          return true;
          break;

        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 1:
          return true;
          break;

        case this.user.subscription_id == 2 &&
          this.user.subscription_frequency === "annual" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 2:
          return true;
          break;

        case this.user.subscription_id == 3 &&
          this.user.subscription_frequency === "monthly" &&
          this.sub_pkg_id == 3 &&
          this.sub_frequency == 2:
          return true;
          break;

        default:
          return false;
          break;
      }
    },

    async updateSubscription() {
      store.commit("storeCheckLoader", true);
      try {
        const { data } = await axios.post(
          this.EnvPath + "api/check-amount-upgrade-subscription",
          {
            subscription_id: this.sub_pkg_id,
            billing_plan: this.sub_frequency,
          },
          {
            headers: {
              Authorization: "Bearer " + this.$store.state.token,
            },
          }
        );
        if (data.api_status) {
          store.commit("storeCheckLoader", false);
          const remaning_amount = data.amount;
          const renewal_date = data.renewal_date;
          const sub_amount = data.sub_amount
            ? data.sub_amount > 0
              ? data.sub_amount
              : 0
            : 0;
          this.showUpgrade = "Smart Move";
          const pkg = this.sub_pkg_id == 2 ? "Plus" : "Pro";
          if (this.sub_frequency == 2) {
            this.showUpgrademsg =
              `You are about to upgrade to the ` +
              pkg +
              ` subscription.
                      Your credit card will immediately be charged an additional
                      $` +
              remaning_amount +
              ` and your subscription
                      won't renew until ` +
              this.getUserData.renewal_date +
              ` + 365`;
          } else if (this.sub_frequency == 1) {
            this.showUpgrademsg =
              `You are about to upgrade to the ` +
              pkg +
              ` subscription.
              Your credit card will immediately be charged an additional
               $` +
              remaning_amount +
              ` this month and $` +
              sub_amount +
              ` per month `;
          }
          this.showUpgradePopUp = true;
        }
      } catch (error) {
        console.log(error, "error occured at upgrade pop up");
      }
      store.commit("storeCheckLoader", false);
    },
    async upgradeUserSubscription() {
      store.commit("storeCheckLoader", true);
      const { data } = await axios.post(
        this.EnvPath + "api/update-user-subscription",
        {
          subscription_id: this.sub_pkg_id,
          billing_plan: this.sub_frequency,
        },
        {
          headers: {
            Authorization: "Bearer " + this.$store.state.token,
          },
        }
      );
      if (data.api_status) {
        this.showUpgradePopUp = false;
        await this.getEducationEnhancement();
        this.openSuccessModal(this.sub_pkg_id);
      }
      store.commit("storeCheckLoader", false);
    },
    openSuccessModal(s_id) {
      let sub_name = "";
      if (s_id == 2) {
        sub_name = "Plus";
      } else if (s_id == 3) {
        sub_name = "Pro";
      } else {
        sub_name = "Basic";
      }
      this.showSuccessPopUp =
        `You are now a ` +
        sub_name +
        ` subscriber.
       Your resume will end up being better because of it.`;
    },
    closeAllModals() {
      location.reload();
    },

    capitalizeFirstLetter(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
    checkSubFrequency(db_freq) {
      if (db_freq == "monthly") {
        this.sub_freq_db = 1;
      } else if (db_freq == "annual") {
        this.sub_freq_db = 2;
      }
    },
    handlesubscriptionPkg(value, downgradeBasic) {
      this.sub_db_id = value;
      this.checkSubFrequency(this.getUserData.subscription_frequency);

      this.showSubFreqBtn = false;
      this.sub_pkg_id = this.$refs.subPkg.value;
      const idToFind = parseInt(value);
      if (idToFind != 1) {
        const foundObject = this.getSubcriptionArray.find(
          (item) => item.id === idToFind
        );
        this.pkg_array = [
          {
            id: 1,
            label: "monthly",
            amount: foundObject.month_price,
            valid: "Month",
          },
          {
            id: 2,
            label: "annual",
            amount: foundObject.year_price,
            valid: "Year",
          },
        ];
      } else {
        this.pkg_array = [];
      }

      if (downgradeBasic) {
        var checkStatus = this.checkDowngradeSubscription();
        if (!checkStatus) {
          return false;
        }

        this.showSubFreqBtn = false;
        if (this.user.subscription_id != 1 && this.sub_pkg_id == 1) {
          // it means he wants to come on basic
          this.showbasicDowngrade =
            `Your subscription will be downgraded to the basic (free) plan on ` +
            this.user.renewal_date;
        }

        if (this.user.subscription_id == 3 && this.sub_pkg_id == 2) {
          this.showSubFreqBtn = true;
          this.sub_frequency = 1;
          this.showbasicDowngrade =
            `Your subscription will be downgraded when your
        current plan renews on ` +
            this.user.renewal_date +
            `. Your credit card will be charged the new
            amount of $8.99 every month and $24.99 every year afterwards`;
        }

        if (this.user.subscription_id == 2 && this.sub_pkg_id == 3) {
          $("#exampleModal").modal("show");
        }
      }
    },
    async loadSubscriptions() {
      this.handlesubscriptionPkg(this.getUserData.subscription_id, false);
      if (this.getSubcriptionArray && this.getSubcriptionArray.length == 0) {
        try {
          const { data } = await axios.post(this.EnvPath + "subscription_list");
          if (data.api_status) {
            store.commit("SubscriptionData", data.data);
            store.commit("SubscriptionCount", data.count);
            this.subscriptionDropdown = this.$store.state.Subscription_Data;
          } else {
            throw newError(data.message);
          }
        } catch (error) {
          console.log("error", error);
        }
      }
    },
    openSubscriptionModal() {
      this.backToSubscription();
      // $("#exampleModal").show();
    },
    closeSubscriptionModal() {
      $("#exampleModal").modal("hide");
    },
    backToSubscription() {
      $(".subs-plans").css("display", "flex");
      $(".payment-plan").css("display", "none");
    },
    deleteUserAccount() {
      this.deleteAccount = true;
    },
    async deleteAccountModal() {
      this.deleteAccountError = false;
      if (
        this.inputValueDelModal == "Delete" ||
        this.inputValueDelModal == "delete"
      ) {
        try {
          const { data } = await axios.post(this.EnvPath + "api/delete-user", {
            delete: true,
          });
          if (data.api_status) {
            store.commit("LogoutUser");
            window.location.href = environment_api.api_base_url + "/";
          }
        } catch (error) {}
      } else {
        this.deleteAccountError =
          "You must type the word “Delete” into the field above to continue";
      }
    },
    okClick() {
      this.CreditCard = false;
      this.deleteAccount = false;
    },

    revertCancleClick() {
      axios
        .post(this.EnvPath + "change-resume-type", {
          resume_id: localStorage.getItem("resume_id"),
        })
        .then(({ data }) => {
          if (data.status == 1) {
            this.$router.push({ name: "my-resume" });
            // if (data.page == 6) {
            //   this.$router.push({ name: "education_enhancement" });
            // } else {
            //   this.$router.push({ name: "job_descriptions" });
            // }
          } else {
          }
        });
    },

    getUser() {
      this.user = this.getUserData;
    },
  },
  created() {
    const userId = localStorage.getItem("user_id");
    if (userId) {
      this.userId = userId;
    }
  },
};
</script>

<style scoped>
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
.compare-btn-custom {
  background: #3d96f9 !important;
  padding: 7px 15px;
  border-radius: 100px !important;
  color: #ffffff !important;
  font-family: "Hind" !important;
}
.mouseLeave {
  /* top: 0px;
          font-size: 11px;
          color: #66696d !important; */
}

.mouseLeave_ {
  top: 3px !important;
  font-size: 11px !important;
  color: #66696d !important;
  padding-left: 10px !important;
}
.unselected {
  font-size: 15px !important;
  color: #999 !important;
}

.space-adjust-education-box {
  height: 50px;
  margin-top: 30px;
  margin-bottom: 20px;
}

.space-adjust-education-box .autocomplete input {
  padding-right: 52px;
}

.space-edu-back {
  margin-bottom: 32px;
  padding-top: 25px;
}

@media (max-width: 768px) {
  .space-on-education-feilds {
    margin-bottom: 20px !important;
  }
}

@media (max-width: 993px) {
  .text-left-control-space {
    padding-left: 0 !important;
  }
}

@media (max-width: 768px) {
  .space-on-education-feilds {
    margin-bottom: 20px !important;
  }
}

@media (max-width: 450px) {
  .space-remove-left {
    padding-left: 0 !important;
    margin-left: -8px;
  }

  .text-center-box .text-left {
    text-align: center !important;
  }

  .space-top-heading {
    margin-top: -10px;
    margin-bottom: 10px !important;
  }

  .row.justify-content-center .col-md-4.col-lg-4.col-sm-12.group.mr-2.inputP55 {
    margin-top: 15px !important;
  }
  .yawk-head-tooltip img.small_logo.yak-logo.has-tooltip {
    right: 14px !important;
  }

  .space-control-left-text {
    padding-left: 11px !important;
  }
  .row.justify-content-center
    .tooltip-on-mobile-yawk-head
    span
    img.small_logo.yak-logo.has-tooltip {
    right: 14px !important;
  }

  .space-left-phone-align-icon {
    margin-left: 7px;
  }

  .space-bottom-align-icons {
    margin-bottom: 0 !important;
  }
}

.select-arrow-side {
  position: relative;
}

.select-arrow-side:before {
  position: absolute;
  font-family: "Font Awesome 5 Pro";
  content: "\f0d7";
  font-weight: 700;
  right: 8px;
  top: 10px;
  color: #fb643e;
  /* transform: rotate(180deg); */
  font-size: 19px;
  transition: all 0.3s ease-in-out;
}

.select-arrow-side.yawk-image-arrow:before {
  right: 38px !important;
}

.page-center-box {
  display: flex;
  align-items: center;
}

.select-arrow-side.yawk-image-arrow.arrow-control-down:before {
  right: 45px !important;
}

.align-icons-box {
  display: flex;
  align-items: center;
  margin-top: 40px;
  padding-top: 0 !important;
  margin-bottom: 10px !important;
}

.yawk-head-tooltip img.small_logo.yak-logo.has-tooltip {
  right: 8px !important;
}
.yawk-head-tooltip .select-arrow-side.yawk-image-arrow:before {
  right: 44px !important;
}

.month-input-select .select-label {
  padding-left: 0 !important;
}
.other-degree-label-red:focus-within label.label_name.mouseLeave_ {
  color: red !important;
}

.space-bottom-align-icons {
  margin-bottom: 30px;
}

/* label.label_name.padding-left-label-space.mouseLeave_{
  padding-left: 6.8px !important;
} */
.reset-password {
  background: white !important;
  color: #227dc7 !important;
  border-color: #2176bd !important;
  border-radius: 10px;
  cursor: pointer;
  border-radius: 10px;
  padding: 6px 14px;
}

.choose_subscription_fields select {
  border: 3px solid #e6e6e6;
}

.add-new-btn {
  border: 3px solid #e6e6e6;
  color: #c8c8c8;
  padding: 10px 0px;
  font-size: 18px;
  border-radius: 10px;
  font-weight: 500;
}
.compare-plan-btn {
  padding: 3px 15px;
  /* font-size: 18px; */
  border-radius: 100px;
  font-family: "Hind" I !important;
}
.visa-styling {
  background: #7676763b;
  color: #767676;
  padding: 10px 20px;
  font-family: "Hind", sans-serif;
  font-size: 15px;
  text-align: left;
  border-radius: 10px 10px 0 0 !important;
}
.compare-plan-link {
  color: #2176bd !important;
  font-size: 12px;
  margin: 0px;
  text-align: end;
  margin-bottom: 0px;
}
.btn-card {
  background: white;
  border-radius: 10px;
  border: 2px solid #918c8c;
}
.card-btn-div {
  margin: auto;
  margin-right: 16px;
}
.uppercase-first-letter {
  text-transform: uppercase;
}

button.btn.btn-primary.reset-password.reset-btn-account:hover {
  background-color: #0d5fca !important;
  border-color: #0d5fca !important;
  color: #ffffff !important;
}

a.compare-btn-custom:hover {
  background-color: #0d5fca !important;
}

button.btn.btn-primary.compare-plan-btn:hover,
button.btn.btn-primary.compare-plan-btn:hover {
  background-color: #0d5fca !important;
}

button.btn.btn-primary.reset-password.reset-btn-account {
  color: #3d96f9 !important;
  border-radius: 100px;
  border: 3px solid #3d96f9 !important;
  font-weight: 600;
  font-family: "Hind" !important;
}

p.compare-plan-link.text-end a:hover {
  color: #ffffff !important;
}
p.compare-plan-link.text-end {
  background-color: #3d96f9;
  color: #ffffff !important;
  padding: 5px 20px;
  border-radius: 100px;
  font-size: 16px;
  font-weight: 900;
  text-transform: capitalize;
}

button.btn.btn-card {
  border: 3px solid #918c8c;
  border-radius: 100px;
  font-size: 16px;
  font-weight: 500;
  padding: 3px 15px;
  color: #7a7878;
}

.replace-collapse-box {
  background-color: #f4f4f5;
  border-radius: 0 0 10px 10px;
  border: none;
}

button.btn.btn-primary.compare-plan-btn:hover {
  background-color: #2684fe;
}

button.btn.btn-primary.compare-plan-btn a:hover {
  color: #ffffff !important;
}

.button-delete a {
  color: #7f7f7f;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0.5px;
  font-family: "Hind" !important;
  padding-right: 10px;
}

.button-delete {
  display: flex;
  justify-content: flex-end;
  margin-top: 50px;
}
.resume-editor-div.resume-editor-firefox.w-100.popup-align-center-box.space-control-box-side {
  padding: 25px 15px 20px 15px !important;
}
.delete-buutton-popup {
  display: flex;
}

.delete-buutton-popup .grey-btn-delete-popup {
  background-color: #d9d9d9 !important;
  border-color: #d9d9d9 !important;
  color: #8a8987 !important;
}

.delete-buutton-popup .grey-btn-delete-popup:hover {
  background-color: #8a8987 !important;
  border-color: #8a8987 !important;
  color: #d9d9d9 !important;
}

.delete-buutton-popup button {
  width: 120px;
  border-radius: 100px !important;
}

@import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&display=swap");
.resume-editor-div {
  margin: 50px auto 30px auto;
}
.keep_subscription {
  font-size: 14px;
  padding: 12px 20px;
  border: none;
  color: white;
  background: grey;
}
.visa-styling {
  background: #7676763b;
  color: #767676;
  padding: 10px;
  font-family: "Hind", sans-serif;
  font-size: 15px;
  text-align: left;
  border-radius: 17px;
}

.resume-editor-div.payment-subscription-heading {
  margin-top: 10px !important;
}

.sub_buttons_container {
  text-align: center;
  display: flex;
  justify-content: space-between;
}

h2.subscription_page_heading.mt-0.mb-3.text-center {
  font-family: "Noto Sans", sans-serif !important;
  font-size: 36px !important;
  font-weight: 700 !important;
  margin-bottom: 30px !important;
}

.pop-content-section.pop_confused_content.payment-subscription-popup {
  transform: translateY(-25%);
}

button.btnOption.btn_color_option.btn-rounded.mt-0.btn-subs-plane-box {
  width: 100%;
}

.pop-content-section.pop_confused_content.are-you-sure-popup-box {
  top: 35% !important;
}
.msg-p {
  color: #2684fe;
}

.col-md-6.col-sm-12.group.mr-2.inputP55.input_yak_logo_label_shrink.account-input-height
  select {
  height: 52px !important;
  color: #767676 !important;
}

p.compare-plan-link a {
  padding: 7px 14px !important;
  text-transform: capitalize;
}

p.compare-plan-link a.btn.btn-primary:hover {
  background-color: #0d5fca !important;
}

@media (max-width: 450px) {
  .choose_subscription_fields.mb-4 {
    margin-bottom: 8px !important;
  }

  .plus-subs-text-heading {
    line-height: 35px !important;
  }

  .space-top-responsive {
    margin-top: -13px !important;
  }

  p.compare-plan-link a {
    margin-top: 20px !important;
    margin-left: -6px !important;
  }
  .col-md-12.col-sm-12.group.mr-2.inputP55.mt-1 .visa-styling.d-flex {
    flex-direction: column !important;
    align-items: start !important;
  }
  .card-btn-div {
    margin-left: 0 !important;
  }
}

.d-flex.align-items-center.justify-content-center.mt-4
  button.btnGray.btn-rounded.mt-0:hover {
  background-color: #0d5fca !important;
  border-color: #0d5fca !important;
}

.d-flex.align-items-center.justify-content-center.mt-4
  button.btnGray.btn-rounded.mt-0 {
  background-color: #2684fe !important;
  border-color: #2684fe !important;
  color: #ffffff !important;
}
.custom-plan-margin {
  margin: auto;
  margin-right: 0px;
}
.fs-13 {
  font-size: 13px;
}

.select-arrow-side.show-side-open:before {
  transform: rotate(180deg) !important;
}

.show-side-open:before {
  right: 12px !important;
  z-index: 0;
}
</style>
