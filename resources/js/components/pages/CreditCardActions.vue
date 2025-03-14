<template>
    <div>
      <div class="col-12 choose_subscription_form padding-remove-sides">
            <h5 class="col-12 text-left-space-sides">Credit Card</h5>
            <div class="choose_subscription_fields">
              <div class="row" v-if="!showAddCardBtn">
                <div
                  class="col-md-12 col-sm-12 group mr-2 inputP55 mt-1"
                  v-for="(detail, index) in getCardList"
                  :key="index"
                >
                <div class="visa-styling d-flex" v-if="editReplace == 'replace'">
                    <p class="text-dark">
                      <b class=""> New Credit Card</b>
                    </p>
                  </div>
                  <div class="visa-styling d-flex" v-else>
                    <p class="text-dark">
                      <b class="uppercase-first-letter"> {{ detail.card.brand }}</b>
                      ending in
                      {{ detail.card.last4 }}
                      <div class="card-btn-div" v-if="card_info_bar" >
                        <button   class="btn btn-card" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" @click="replaceOrEdit('replace')">Replace</button>
                        <button class="btn btn-card" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" @click="replaceOrEdit('edit')">Edit</button>
                      </div>
                    </p>
                  </div>

                    <!-- replace collapse -->
                      <div class="collapse collapseExample grey-back-side" id="collapseExample">
                         <card-edit-replace-form
                          :cardInputAction="showCardInput"
                          :replaceAndEdit="editReplace"
                          @close-collapse="closeCollapse"
                          @loader-actions=loaderActions
                          ></card-edit-replace-form>
                      </div>
                    <!-- replace collapse -->
                </div>
              </div>
              <div class="row mt-4" v-else>
                <div class="col-md-12 col-sm-12 group mr-2 inputP55">
                  <button
                    v-if="addCreditCard"
                    type="button"
                    @click="cardFeildFunction"
                    class="btn btn-block add-new-block add-new-btn"
                  >
                    +Add Credit Card
                  </button>
                  <!-- credit card details -->
                  <div class="choose_subscription_fields card-input-box mt-0" v-if="cardFeild">
                        <card-form
                        @remvoeCardDetils="remvoeCardDetils"
                        @loader-actions=loaderActions
                        @card-popup="CreditCardPopUp"

                        :save="saveCard"
                        ></card-form>
                  </div>

                  <!-- credit card details -->
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
                <img :src="EnvPath + 'images/bg/yak-port.png'" alt="Confused" />
              </div>
              <div class="col-8">
                <h4>Whoa There!</h4>
                <p>
                  You must complete all of the fields before upgrading Button
                </p>
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
    <!-- popup -->
    </div>
</template>
<script>
import CardForm from "./CardForm.vue";
import CardEditReplaceForm from "./CardEditReplaceForm.vue";
import twobuttonmodel from "../twobuttonmodel.vue";
import Vue from "vue";
import Button from "./Button.vue";
import JQuery from "jquery";
import store from "../../store";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";
import Common from "../../mixins/Common.js";

let $ = JQuery;
export default {
  name: "CreditCardActions",
  mixins: [Common],
  components: {
    twobuttonmodel,
    Button,
    CardForm,
    CardEditReplaceForm,
  },

  data() {
    this.publishableKey = environment_api.publishableKey;

    return {
      card_info_bar:true,
      saveCard: "save",
      countries: [],
      isSave: false,
      arrowTrue: "",
      activeFeild: "",
      deleteAccount: false,
      showCardInput: true,
      user: {},
      token: null,
      card_name: "",
      country: "232",
      card_number: "",
      expiration: "",
      security_code: "",
      subscriptionList: [],
      CreditCard: false,
      cardFeild: false,
      plan_count: "",
      month_price: 0,
      year_price: 0,
      msg: "",
      stripe: null,
      publishableKey: environment_api.publishableKey,
      token: store.state.token,
      postal_code: "",
      cardNumber: "",
      cardExpiry: "",
      cardCvc: "",
      elements: null,
      cardName: "",
      country: "",
      editReplace: "",
    };
  },

  mounted() {
    this.getUser();
    this.getUserCardDetails(this.getUserData.customer_token, false);
    this.loadCountries();
  },

  computed: {
    ...mapGetters([
      "getPageCount",
      "getUserData",
      "getPersonalDetail",
      "getCardList",
    ]),
  },
  props: ["callGetCustomerDetail"],
  watch: {
    getPersonalDetail: {
      handler(newValue, oldValue) {
        this.getUserCardDetails(this.getUserData.customer_token, false);
      },
      deep: true, // Watch nested properties within getPersonalDetail
    },
    // callGetCustomerDetail:{
    //   immediate: true,
    //   handler(newValue, oldValue) {
    //    if(newValue){
    //       this.getUserCardDetails(this.getUserData.customer_token, false);
    //    }
    //   },
    // },
  },
  methods: {
    closeCollapseExample() {
      this.$emit("close-collapse");
    },

    closeCollapse() {
      $("#collapseExample").collapse("hide");
      $(".collapseExample").collapse("hide");
      this.editReplace = '';
      this.card_info_bar = true;
    },
    replaceOrEdit(data) {
      this.editReplace = data;
      $(".visa-styling").toggleClass("border-box");
      this.card_info_bar = false;
    },
    CreditCardPopUp() {
      this.CreditCard = true;
    },
    deleteUserAccount() {
      this.deleteAccount = true;
    },
    inputFocus() {
      this.arrowTrue = true;
    },
    loaderActions(status) {
      this.$emit("loader-action", status);
    },
    emptyInputs() {
      this.card_number = "";
      this.card_name = "";
      this.country = "232";
      this.expiration = "";
      this.postal_code = "";
      this.security_code = "";
    },

    okClick() {
      this.CreditCard = false;
    },
    cardFeildFunction() {
      this.$emit("empty-errors", true);
      store.commit("storeUpgradeCancelbtns", true);
      this.addCreditCard = false;
      this.cardFeild = true;
    },
    remvoeCardDetils() {
      this.addCreditCard = true;
      this.cardFeild = false;
    },
    revertCancleClick() {
      this.$router.push({ name: "my-resume" });
    },
    addSubscriptionPlan(id) {
      axios
        .post(this.EnvPath + "get_subscription_list", { subscription_id: id })
        .then((response) => {
          this.month_price = response.data.data.month_price;
          this.year_price = response.data.data.year_price;
          this.subscription = response.data.data.id;
          $("#plan_detail").html(
            '<select name="subscription_plan_option" id="subscription_plan_option" class="select-item input mouseLeave" style="appearance: none;">' +
              '<option value="' +
              response.data.data.id +
              '">' +
              response.data.data.name +
              "</option>" +
              "</select>" +
              '<label data-v-7969e6e8="" class="select-label mouseLeave_">Subscription:</label>'
          );
        })
        .catch((error) => console.log(error));
      $(".resume-editor-div").css("display", "block");
      $(".billing-detail").css("display", "block");
      $(".subscription_plans_list").css("display", "none");
    },
    getUser() {
      this.user = this.getUserData;
    },
  },
  created() {},
};
</script>
<style scoped>
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
  .text-left-space-sides {
    padding-left: 0 !important;
    margin-left: -8px;
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
  border-radius: 10px;
}

.visa-styling.d-flex.border-box {
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

button.btn.btn-primary.reset-password.reset-btn-account {
  color: #3d96f9 !important;
  border-radius: 100px;
  border: 3px solid #3d96f9 !important;
  font-weight: 600;
  font-family: "Hind" !important;
}
button.btn.btn-block.add-new-block.add-new-btn {
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

button.btn.btn-primary.compare-plan-btn:hover,
button.btn.btn-primary.compare-plan-btn:hover {
  background-color: #0d5fca !important;
}

button.btn.btn-primary.compare-plan-btn a:hover {
  color: #ffffff !important;
}

.button-delete a {
  cursor: pointer;
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

.col-md-12.col-sm-12.group.mr-2.inputP55.input_yak_logo_label_shrink.activeFeild
  label,
.col-md-6.col-sm-12.group.mr-2.inputP55.input_yak_logo_label_shrink.activeFeild
  label {
  font-size: 12px;
  top: 4px;
  left: 7px;
}

.loader-box {
  width: 100% !important;
  height: 100vh;
  background-color: #ffffff;
  position: relative;
}

.loader-box img {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.col-md-6.col-sm-12.group.mr-2.inputP55.select-arrow-side:before {
  right: 20px !important;
}

@media (max-width: 450px) {
  .col-md-12.col-sm-12.group.mr-2.inputP55.mt-1 .visa-styling.d-flex {
    flex-direction: column !important;
    align-items: start !important;
  }
  .card-btn-div {
    margin-left: 0 !important;
  }

  .card-btn-div {
    display: flex;
    justify-content: space-between;
  }
  .card-btn-div button.btn.btn-card {
    margin-right: 10px;
  }
}

.card.card-body.replace-collapse-box .btn-settings {
  display: flex;
  justify-content: flex-end;
  width: 100%;
}

.card.card-body.replace-collapse-box .btn-settings i {
  margin-left: 5px;
}

.col-md-6.col-sm-12.group.mr-2.inputP55.select-arrow-side.arrowUpRemove:before {
  transform: rotate(0deg) !important;
}

/* .col-md-6.col-sm-12.group.mr-2.inputP55.select-arrow-side:focus-within:before {
  transform: rotate(180deg);
} */

.grey-back-side {
  background-color: #f4f4f5 !important;
  padding: 10px;
  border-radius: 0 0 10px 10px;
}
</style>
