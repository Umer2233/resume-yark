<template>
  <section class="page-contact-info subscription_main_page">
    <!-- <h2 class="subscription_page_heading" style="font-weight: 500; padding: 0px 30px;"> Upgrade Your Subscription </h2> -->
    <!-- <p style="max-width: 850px; width: 90%; margin: 0px auto; text-align: left; color: rgb(118, 118, 118);">To use the functional resume format, you will need to upgrade to either the Plus or Pro subscription plans. The functional resume format is ideal for highlighting your experience on the first page of your resume.</p><br>
        <p v-if="this.msg != ''" class="alert alert-warning text-center" style="margin-bottom: -20px;font-size: 14px;">{{ this.msg }}</p>  -->
    <h2
    v-if="handlesubPkg"
      class="subscription_page_heading mt-0 mb-3 subs-plans"
      style="font-weight: 500; padding: 0px 30px; justify-content: center"
    >
      Compare Plans
    </h2>
    <h2
    v-else
      class="subscription_page_heading mt-0 mb-3 subs-plans"
      style="font-weight: 500; padding: 0px 30px; justify-content: center"
    >
      Upgrade your Subscription
    </h2>

    <div class="container mt-4">
      <div class="row subs-plans">
        <!-- <div class="subscription_plans_list"> -->
        <div
          class="col-md-4 col-sm-12"
          :class="subscriptions.month_price == 0 ? 'subscription_free' : ''"
          v-for="(subscriptions, index) in subscriptionList"
          :key="'subscriptions' + index"
        >
          <div class="subscription_header">
            <h3 style="text-transform: uppercase">{{ subscriptions.name }}</h3>
            <h4 v-if="subscriptions.month_price == 0">Free</h4>
            <h4 v-else>
              ${{ subscriptions.month_price }}
              <span class="small_dur">/ Month</span><br />
              <span style="margin-left: -28px; font-size: 18px">or</span> ${{
                subscriptions.year_price
              }}
              <span class="small_dur">/ Year</span>
            </h4>
          </div>
          <div class="subscription_body height-control-box">
            <ul
              class="subscription_list_options"
              v-if="plan_count == subscriptions.option_count"
            >
              <li
                v-for="(option1, index) in subscriptions.subscription_option"
                :key="'option1' + index"
              >
                <span><i class="fa fa-angle-right"></i></span>
                    <span class="inherit-width">{{ option1.content }}</span>
              </li>
            </ul>
            <ul class="subscription_list_options" v-else>
              <li
                v-for="(option2, index) in subscriptions.subscription_option"
                :key="'option2' + index"
              >
                <span><i class="fa fa-angle-right"></i></span>
                 <span class="inherit-width">{{ option2.content }}</span>
              </li>
              <li
                v-for="(option3, index) in plan_count -
                subscriptions.option_count"
                :key="'option3' + index"
              ></li>
            </ul>

            <div v-if="getUserData.subscription_id == 1">
              <div
                v-if="getUserData.subscription_id == 1 && subscriptions.id == 1"
              >
                <button
                  v-if="subscriptions.month_price == 0"
                  class="keep_subscription btn-rounded mt-4 keep-my-subs-btn"
                  @click="revertCancleClick()"
                >
                  Keep my Subscription
                </button>
              </div>
              <div v-else>
                <button
                  class="btnonlyBorder_FillSolid btn-rounded mt-4"
                  @click="addSubscriptionPlan(subscriptions.id)"
                >
                  {{ subscriptions.text }}
                </button>
              </div>
            </div>
            <div v-else-if="!handlesubPkg && subscriptions.id == 1">

                <button
                  class="btn-rounded mt-4 keep-my-subs-btn btnonlyBorder"
                  @click="update_resume_types('chronological')"
                >
                 Revert to chronological Format
                </button>
              </div>

            <!-- second subscription -->

            <div v-if="getUserData.subscription_id == 2">
              <div
                v-if="getUserData.subscription_id == 2 && subscriptions.id == 2"
              >
                <button
                  class="keep_subscription btn-rounded button-keep-subs-style"
                  @click="revertCancleClick()"
                >
                  Keep my Subscription
                </button>
              </div>

              <div v-else-if="subscriptions.id == 3">
                <button
                  class="btnonlyBorder_FillSolid btn-rounded mt-4"
                  @click="addSubscriptionPlan(subscriptions.id)"
                >
                  {{ subscriptions.text }}
                </button>
              </div>
            </div>
            <div v-if="getUserData.subscription_id == 3">
              <div
                v-if="getUserData.subscription_id == 3 && subscriptions.id == 3"
              >
                <button
                  class="keep_subscription btn-rounded mt-2 keep-mysubs-btn"
                  disabled
                  @click="revertCancleClick()"
                >
                  Keep my Subscription
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row payment-plan">
        <div
          class="col-md-12 grid-container resume_type_no_sidebar_container subscription_plans_form_container"
        >
          <div
            class="resume-editor-div payment-subscription-heading pt-0"
            style="display: none"
          >
            <h2
              class="subscription_page_heading mt-0 mb-3 mt-3 text-center text-space-control-res"
              style="font-weight: 500; padding: 0px 30px"
            >
              <div v-if="getUserData.subscription_id == 2 && subscription == 3">
                Upgrade to Pro Subscription
              </div>

              <div v-else>Upgrade Your Subscription</div>
            </h2>

            <div
              class="row"
              style="max-width: 780px; margin: 0px auto !important"
            >
              <div
                id="plan_detail"
                class="col-sm-12 inputP55 billing-detail"
                style="max-width: 320px; margin: 0px auto; display: none"
              >
                <!-- Select drop down appear here  -->
              </div>
              <div
                class="col-12 choose_subscription_form billing-detail padding-remove-sides"
                style="display: none; z-index: 0"
              >
                <h5>Choose Your Billing Cycle</h5>
                <div class="choose_subscription_duration">
                  <div class="more_checkbox_section" id="plusBillingCycle">
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        v-model="billing_plan"
                        id="billingPlan1"
                        value="1"
                        name="billingPlan1"
                        class="custom-control-input form-check-input"
                        style="cursor: pointer"
                        @click="selectBillingCycle()"
                      />
                      <label
                        for="billingPlan1"
                        class="custom-control-label form-check-label"
                        ><p>
                          Monthly<br /><span
                            >${{ this.month_price }} / month</span
                          >
                        </p></label
                      >
                    </div>
                    <div
                      class="custom-control custom-radio form-check form-check-inline finder_job_check"
                    >
                      <input
                        type="radio"
                        v-model="billing_plan"
                        id="billingPlan2"
                        value="2"
                        name="billingPlan2"
                        class="custom-control-input form-check-input"
                        style="cursor: pointer"
                        @click="selectBillingCycle()"
                      />
                      <label
                        for="billingPlan2"
                        class="custom-control-label form-check-label"
                        ><p class="text-mb-450">
                          Annual<br /><span
                            >${{ this.year_price }} / year
                          </span>
                        </p>
                        <span class="best_value">Best Value</span></label
                      >
                    </div>
                  </div>
                </div>
                 <p v-if="errors.length">
                  <p v-for="(error, index) in errors" :key="index" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;"> {{ removeErrorWord(error)  }}</p>
                </p><br>
              </div>

              <div class="col-12 choose_subscription_form padding-remove-sides">
                <div
                  v-if="getUserData.subscription_id == 2 && subscription == 3"
                >
                  <!-- <p>
                    You are about to upgrade to the Pro subscription. Your
                    credit card will immediately be charged an additional
                    [$11.00] this month and $19.99 per month after that.
                  </p> -->
                </div>
                <div v-else>
                  <credit-card-actions
                  @empty-errors="emptyErrors"
                    ></credit-card-actions>
                </div>

                <div
                  class="sub_buttons_container d-flex align-item-center subs-btn-save-cancel flex-column-box"
                  v-if="!getUpgradeCancelbtns"
                  >
                  <button
                    class="btnOption btn_color_option btn-rounded"
                    @click="updateSubscription()"
                  >
                    Upgrade
                  </button>
                  <button
                    class="btnGray btn-rounded btn-grey-align btn-height-control"
                    @click="backToSubscription()"
                  >
                    Cancel
                  </button>
                </div>
              </div>
              <!-- <div
                class="sub_buttons_container cancel-btn"
                style="max-width: 650px; margin: 10px auto"
              >
                <button
                  class="btnGray btn-rounded"
                  style="width: 150px"
                  @click="backToSubscription()"
                >
                  Back
                </button> -->
            </div>
          </div>
        </div>
      </div>
      <!-- popup next button -->
      <div class="popup-container" v-if="CreditCard">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/Confused.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8">
                  <h4 style="padding-top: 15px;">Who's There!</h4>
                  <p v-if="errorMessage">
                    {{ errorMessage }}
                  </p>
                  <p v-else>
                    You must complete all of the fields before upgrading Button
                  </p>

                  <div class="d-flex justify-content-center">
                    <button
                      class="btnOption btn_color_option btn-rounded"
                      @click="okClick()"
                      style="float: right"
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

      <div class="popup-container" v-if="showUpgradePopUp">
        <div class="poup-sub-container">
          <div class="pop-content-section pop_confused_content popup-position-top subs-popup">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <img
                    :src="EnvPath + 'images/bg/yak-port.png'"
                    alt="Confused"
                  />
                </div>
                <div class="col-8">
                  <h4>{{ showUpgradePopHead }}</h4>
                  <p>{{ showUpgradeMessage }}</p>

                  <div class="d-flex align-items-center mt-4">
                    <button
                      class="btnOption btn_color_option btn-rounded mt-0"
                      @click="upgradeUserSubscription()"
                      style="float: right"
                    >
                      Upgrade
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
      <!-- popup -->

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

                  <div class="d-flex align-items-center justify-content-center mt-4">
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
  </section>
</template>

<script>
import CreditCardActions from "./CreditCardActions.vue";
import store from "../../store";
import { environment_api } from "../../env";
import Vue from "vue";
import JQuery from "jquery";
import VueTheMask from "vue-the-mask";
import axios from "axios";
import Common from "../../mixins/Common.js";
import { mapGetters } from "vuex";
var querystring = require("querystring");

Vue.use(VueTheMask);
let $ = JQuery;
export default {
  name: "resume_type",
  mixins: [Common],
  components: {
    CreditCardActions,
  },
  data() {
    return {
      hideUpgradeCancel: false,
      freeSubscription: false,
      plusAnnualProMonthPaid: false,
      showUpgradePopUp: false,
      showUpgradeMessage: "",
      showUpgradePopHead: "",
      subscriptionList: this.$store.state.Subscription_Data || [],
      plan_count: this.$store.state.Subscription_count || 0,
      EnvPath: environment_api.api_base_url,
      countries: [],
      country: "232",
      subscription: "",
      billing_plan: "",
      errors: [],
      CreditCard: false,
      month_price: 0,
      year_price: 0,
      msg: "",
    };
  },

  mounted() {
    localStorage.setItem("page", 11);
    $(".my_resumes").removeClass("active_nav");
    $(".has_sub_nav_my_profile").removeClass("active_nav");
    // this.loadCountries();
    this.country = "232";
    this.loadSubscriptions();
  },
  props: {
    handlesubPkg: {
      type: Boolean,
    },
  },
  computed: {
    ...mapGetters([
      "getPageCount",
      "getUserData",
      "getPersonalDetail",
      "getSubcriptionArray",
      "getSubcriptionCount",
      "getUpgradeCancelbtns",
    ]),
  },
  methods: {
    closeAllModals() {
      location.reload();
    },
    emptyErrors() {
      this.errors = [];
    },
    async update_resume_types(resume_type) {
      try {
        const { data } = await axios.post(
          this.EnvPath + "update-resume-type",
          querystring.stringify({
            resume_id: localStorage.getItem("resume_id"),
            resume_type: resume_type,
            chronological_score: "NULL",
            type_assessment_questions: "NULL",
          })
        );
        if (data.success) {
          this.$router.push({ name: "TwoPageResume" });
        }
      } catch (error) {
        console.log(error);
      }
    },

    cancelUpgradation() {
      this.showUpgradePopUp = false;
      this.freeSubscription = false;
      this.plusAnnualProMonthPaid = false;
    },
    cancelUpgradition() {
      this.$emit("close-subscription", true);
    },
    loadSubscriptionsdd() {
      // this.subscriptionList = this.$store.state.Subscription_Data;
      // this.plan_count = this.$store.state.Subscription_count;
    },
    async loadSubscriptions() {
      if (this.getSubcriptionArray.length == 0) {
        try {
          const { data } = await axios.post(this.EnvPath + "subscription_list");
          if (data.api_status) {
            store.commit("SubscriptionData", data.data);
            store.commit("SubscriptionCount", data.count);
            this.subscriptionList = this.$store.state.Subscription_Data;
            this.plan_count = this.$store.state.Subscription_count;
            if (this.handlesubPkg) {
              this.handlesubscriptionPkg(
                this.getUserData.subscription_id,
                false
              );
            }
          } else {
            throw newError(data.message);
          }
        } catch (error) {
          console.log("error", error);
        }
      } else {
        this.subscriptionList = this.$store.state.Subscription_Data;
        this.plan_count = this.$store.state.Subscription_count;
      }
    },

    addSubscriptionPlan(id) {
      $(".subs-plans").css("display", "none");
      $(".payment-plan").css("display", "block");
      axios
        .post(this.EnvPath + "get_subscription_list", { subscription_id: id })
        .then((response) => {
          this.month_price = response.data.data.month_price;
          this.year_price = response.data.data.year_price;
          this.subscription = response.data.data.id;
          // if (id != 2) {
          $("#plan_detail").html(
            '<div class="select-arrow-side"><select name="subscription_plan_option" id="subscription_plan_option" class="select-item input mouseLeave" style="appearance: none;">' +
              '<option value="' +
              response.data.data.id +
              '">' +
              response.data.data.name +
              "</option>" +
              "</select>" +
              '<label data-v-7969e6e8="" class=" select-label mouseLeave_">Subscription:</label></div>'
          );
          // }
        })
        .catch((error) => console.log(error));
      $(".resume-editor-div").css("display", "block");
      $(".billing-detail").css("display", "block");
      $(".subscription_plans_list").css("display", "none");

      $(document).on("click", "#subscription_plan_option", function () {
        $(this).parent().toggleClass("arrowUp");
      });
    },
    selectBillingCycle() {
      $(".choose_subscription_form").css("display", "block");
      $(".subscription_plans_list").css("display", "none");
      $(".cancel-btn").css("display", "none");
    },
    okClick() {
      this.CreditCard = false;
    },
    async updateSubscription() {
      store.commit("storeCheckLoader", true);
      try {
        if (this.subscription != 0 && this.billing_plan != 0) {
          if (
            this.getUserData.subscription_id == 1 &&
            (this.subscription == 2 || this.subscription == 3)
          ) {
            const { data } = await axios.post(
              this.EnvPath + "api/update-subscription",
              {
                subscription_id: this.subscription,
                billing_plan: this.billing_plan,
              },
              {
                headers: {
                  Authorization: "Bearer " + this.$store.state.token,
                },
              }
            );
            if (data.status) {
              try {
                const res = await this.getEducationEnhancement();
                if (res) {
                  this.openSuccessModal(this.subscription);
                }
              } catch (error) {
                throw new Error("error Occured at get Education enhance");
              }
            } else {
              throw new Error(data.message); // Throw an error if api_status is falsy
            }
          } else if (
            this.getUserData.subscription_id == 2 &&
            this.getUserData.subscription_frequency == "annual" &&
            this.subscription == 3 &&
            this.billing_plan == 1
          ) {
            const renewal_date = this.getUserData.renewal_date;
            const renewatDaysLeft = this.getDateDifference(renewal_date);

            if (renewatDaysLeft < 335) {
              this.showUpgradePopHead = "Upgrade to Pro Subscription";
              this.showUpgradeMessage = `You are about to upgrade to the Pro subscription.
            Your credit card will immediately be charged $19.99 and $19.99 every
             month afterwards`;
              this.showUpgradePopUp = true;
              this.plusAnnualProMonthPaid = true;
            } else {
              this.showUpgradePopHead = "Upgrade to Pro Subscription";
              this.showUpgradeMessage = `You are about to upgrade to the Pro subscription.
             Since you recently signed up or renewed your Plus subscription, we will
             give you a month free of your Pro subscription. Your credit card will
              immediately be charged $19.99 starting 1 month from today
               and every month afterwards.`;
              this.freeSubscription = true;
              this.showUpgradePopUp = true;
            }
          } else {
            const { data } = await axios.post(
              this.EnvPath + "api/check-amount-upgrade-subscription",
              {
                subscription_id: this.subscription,
                billing_plan: this.billing_plan,
              },
              {
                headers: {
                  Authorization: "Bearer " + this.$store.state.token,
                },
              }
            );
            if (data.api_status) {
              const remaning_amount = data.amount;
              const renewal_date = data.renewal_date;
              this.showUpgradePopHead = "Upgrade to Pro Subscription";
              if (this.billing_plan == 1) {
                this.showUpgradeMessage =
                  `You are about to upgrade to the Pro subscription.
              Your credit card will immediately be charged an additional
             $` +
                  remaning_amount +
                  ` this month and $19.99 per month.
              `;
              } else {
                this.showUpgradeMessage =
                  `You are about to upgrade to the Pro subscription.
               Your credit card will immediately be charged an
              additional $` +
                  remaning_amount +
                  ` and $49.99 when your plan renews on ` +
                  renewal_date;
              }

              this.showUpgradePopUp = true;
            } else {
              throw new Error(data.message); // Throw an error if api_status is falsy
            }
          }
        } else {
          this.CreditCard = true;
          this.errorMessage = "Please select the Billing Plan.";
        }
      } catch (error) {
        this.errors = [];
        console.log("error");
        this.errors.push(error);
        if (error.response && error.response.status === 401) {
          this.logoutUser();
        }
        // console.log(error, "error occured at upgrade pop up");
      }
      store.commit("storeCheckLoader", false);
    },
    getDateDifference(renewal_date) {
      var daysDifference = "";
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed
      const day = String(today.getDate()).padStart(2, "0");
      const dateToday = year + `-` + month + `-` + day;
      console.log(dateToday, "dateToday");
      console.log(renewal_date, "renewal_date");
      if (renewal_date) {
        const startDate = new Date(dateToday);
        const endDate = new Date(renewal_date);
        var daysDifference = (endDate - startDate) / (1000 * 60 * 60 * 24);
      }
      return daysDifference;
    },

    async upgradeUserSubscription() {
      store.commit("storeCheckLoader", true);
      try {
        const { data } = await axios.post(
          this.EnvPath + "api/update-user-subscription",
          {
            subscription_id: this.subscription,
            billing_plan: this.billing_plan,
            plus_annual_pro_month: this.freeSubscription,
            plus_annual_pro_month_paid: this.plusAnnualProMonthPaid,
          },
          {
            headers: {
              Authorization: "Bearer " + this.$store.state.token,
            },
          }
        );

        if (data.api_status) {
          this.showUpgradePopUp = false;
          this.freeSubscription = false;
          this.plusAnnualProMonthPaid = false;
          await this.getEducationEnhancement();
          this.openSuccessModal(this.subscription);
          this.freeSubscription = false;
          this.plusAnnualProMonthPaid = false;
        }
        this.freeSubscription = false;
        this.plusAnnualProMonthPaid = false;
      } catch (error) {
        console.log(error, "error occurred at update user subscription");
      }
      store.commit("storeCheckLoader", false);
    },

    backToSubscription() {
      $(".subs-plans").css("display", "flex");
      $(".payment-plan").css("display", "none");
    },
    revertCancleClick() {
      // axios
      //   .post(this.EnvPath + "change-resume-type", {
      //     resume_id: localStorage.getItem("resume_id"),
      //   })
      //   .then(({ data }) => {
      //     if (data.status == 1) {
      //       this.$router.push({ name: "my-resume" });
      //     } else {
      //     }
      //   });
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&display=swap");
.resume-editor-div {
  margin: 50px auto 30px auto;
}
.keep_subscription {
  font-size: 14px;
  padding: 9px 20px;
  border: none;
  color: white;
  background: grey;
}
.keep_subscription:hover {
  /* background: #d9d9d9;
  color: #767676 !important; */
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

.select-arrow-side:before {
  right: 12px !important;
  z-index: 9;
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

.sub_buttons_container.d-flex.align-item-center.subs-btn-save-cancel {
  justify-content: flex-end !important;
  width: 95% !important;
}

button.keep_subscription.btn-rounded.mt-4.keep-my-subs-btn {
  margin-top: 8px !important;
  border-radius: 100px !important;
  padding: 10px 35px;
}

button.keep_subscription.btn-rounded.button-keep-subs-style {
  border-radius: 100px !important;
  padding: 10px 35px !important;
  margin-top: 7px !important;
  font-family: "Hind" !important;
  font-weight: 500 !important;
}

.d-flex.align-items-center.mt-4 button.btnGray.btn-rounded.mt-0 {
  font-size: 17px !important;
  height: 45px !important;
  padding-top: 8.4px !important;
}

.btn-white-blue-line {
  color: #2684fe !important;
  background-color: transparent !important;
}

.btn-grey-align {
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 0px !important;
}

.inherit-width {
  width: inherit;
  margin-top: -1px;
}
@media (max-width: 450px) {
  h2.subscription_page_heading.mt-0.mb-3.mt-3.text-center.text-space-control-res {
    font-size: 26px !important;
    padding: 0 !important;
  }

  .pop-content-section.pop_confused_content.popup-position-top.subs-popup {
    transform: translateY(-3vh) !important;
  }

  p.text-mb-450 {
    padding-top: 27px;
  }

  .popup-position-top {
    transform: translateY(-14vh);
  }

  .subscription_list_options li {
    margin-bottom: 5px;
  }

  .padding-remove-sides {
    padding: 0 !important;
  }

  .sub_buttons_container.d-flex.align-item-center.subs-btn-save-cancel.flex-column-box
    button {
    min-width: 100px;
  }
  .sub_buttons_container.d-flex.align-item-center.subs-btn-save-cancel.flex-column-box
    button.btnOption.btn_color_option.btn-rounded {
    margin-right: 5px;
  }
  button.btnGray.btn-rounded.btn-grey-align.btn-height-control {
    height: 45px;
  }
  .sub_buttons_container.d-flex.align-item-center.subs-btn-save-cancel {
    width: 100% !important;
  }
}

.keep-mysubs-btn:hover {
  background-color: gray !important;
  color: #ffffff !important;
}

.height-control-box {
  height: 73% !important;
  margin-bottom: 30px;
}
</style>
