<template>
  <div class="mt-0">
    <form class="container" style="padding: 10px;">
      <div class="row">
        <div
          class="col-md-12 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
        >
          <input
            maxlength="100"
            name="name"
            type="text"
            class="input mouseLeave"
            autocomplete="off"
            v-model="card_name"
          />
          <label
            class="select-label"
            :class="card_name != '' ? 'mouseleavefill' : ''"
            >Name on Card:</label
          >
        </div>
      </div>

      <div class="row" :class="[showCardInput ? '' : 'd-none' ]">
        <div
          class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
        >
          <!-- <input type="text" name="card_number" class="input mouseLeave" ref="cardNumber" v-mask="'#### #### #### ####'"  > -->
          <!-- <label class="select-label" :class="(card_number!='') ?'mouseleavefill':''">Credit or Debit Card Number:</label> -->
          <!-- <label for="card-number">Card Number</label> -->
          <div ref="cardNumber"></div>
        </div>
        <div
          class="col-md-6 col-sm-12 group mr-2 inputP55 custom_expiration_security_div"
          style="padding: 0px; display: inherit; margin-bottom: 0px"
        >
          <div
            class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
          >
            <!-- <input type="text" name="expiration" class="input mouseLeave" ref="cardExpiry" v-mask="'##/####'" > -->
            <!-- <label class="select-label" :class="(expiration!='') ?'mouseleavefill':''">Expiration: MM/YY:</label> -->
            <!-- <label for="card-expiry">Expiration Date</label> -->
            <div ref="cardExpiry" class="stripe-card-box"></div>
          </div>
          <div
            class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
          >
            <!-- <input type="text" name="security_code" v-mask="'###'" class="input mouseLeave" ref="cardCvc" > -->
            <!-- <label class="select-label" :class="(expiration!='') ?'mouseleavefill':''">Security Code:</label> -->
            <!-- <label for="card-cvc">CVC</label> -->
            <div ref="cardCvc"></div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-sm-12 group mr-2 inputP55 select-arrow-side" :class="arrowUp">
          <select
            name="country"
            id="country"
            @click="selectArrow"
            v-model="country"
            class="select-item input mouseLeave"
            style="appearance: none; color: #7c7c7c !important"
          >
            <option
              v-for="(country, index) in countries"
              :key="index"
              :value="index"
            >
              {{ country }}
            </option>
          </select>
          <span class="bar"></span>
          <label
            class="select-label"
            :class="country != '' ? 'mouseleavefill' : ''"
            >Billing Country:</label
          >
        </div>
        <div
          class="col-md-6 col-sm-12 group mr-2 inputP55 input_yak_logo_label_shrink"
        >
          <input
            maxlength="100"
            name="postal_code"
            type="text"
            class="input mouseLeave"
            v-model="postal_code"
            autocomplete="off"
          />
          <label
            class="select-label"
            :class="postal_code != '' ? 'mouseleavefill' : ''"
            >Billing Postal Code:</label
          >
        </div>
      </div>
       <!-- Error msg -->
        <p style="margin: 0;" v-if="errors.length">
            <p v-for="(error, index) in errors" :key="index" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;">{{ removeErrorWord(error)  }} </p>
        </p>
        <!-- End -->
     <div class="row justify-content-control" v-if="save  == 'save'" >
        <button
        style="font-weight: 500;"
          type="button"
          class="btn btn-primary compare-plan-btn px-5 py-2 mr-3"
          :disabled="isSave"
          @click="addCustomerCardOnly"
        >
          Save
        </button>
        <button
          class="btn btn-primary compare-plan-btn px-5 py-2"
          @click="remvoeCardDetils"
        >
          Cancel
        </button>
      </div>
      <div v-else>
        <div class="btn-settings btn-right-align" style="padding: 5px 0 5px 10px !important; margin-right: -7px;">
                                  <i
                                    class="fa fa-times-circle hover-icon-work-history"
                                    style="font-size:30px;color:#fb643e; right: 85px; cursor:pointer;"
                                    @click="closeEditReplace"
                                  ></i>
                                  <!-- if replace -->
                                   <i
                                     v-if="showCardInput"
                                    class="replace fa fa-check-circle hover-icon-work-history"
                                    style="font-size:30px;color:#fb643e; right: 50px; cursor:pointer;"
                                  @click="replaceCardDetails"
                                    ></i>
                                    <!-- if update -->
                                  <i v-else
                                    class="edit  fa fa-check-circle hover-icon-work-history"
                                    style="font-size:30px;color:#fb643e; right: 50px; cursor:pointer;"
                                      @click="updateCardDetails"
                                    ></i>
                                </div>
      </div>
    </form>
  </div>
</template>

<script>
import Common from "../../mixins/Common.js";
import Vue from "vue";
import JQuery from "jquery";
import store from "../../store";
import { environment_api } from "../../env";
import { mapGetters } from "vuex";

export default {
  name: "CreditCardActions",
  mixins: [Common],
  data() {
    this.publishableKey = environment_api.publishableKey;
    return {
      isSave: false,
      arrowUp: "",
      postal_code: "",
      cardNumber: "",
      card_name: "",
      cardExpiry: "",
      cardCvc: "",
      errors: [],
      elements: null,
      stripe: null,
      country: "232",
      countries: this.$store.state.countriesData,
      saveOrUpdate: "",
      showCardInput: true,
    };
  },
  props: ["save", "replaceOrEdit"],
  mounted() {
    this.setupStripe();
  },
  watch: {
    save(newValue, oldValue) {
      this.saveOrUpdate = newValue;
    },
    replaceOrEdit(newValue, oldValue) {
      this.errors = [];
      if (newValue == "edit") {
        this.showCardInput = false;
        this.editBtn();
      } else if (newValue == "replace") {
        this.showCardInput = true;
      }
    },
  },
  methods: {
    remvoeCardDetils() {
      this.$emit("remvoeCardDetils");
      store.commit("storeUpgradeCancelbtns", false);
    },
    selectArrow() {
      // $(this).parent().toggleClass("arrowUp");
      if (this.arrowUp === "") {
        this.arrowUp = "arrowUp";
      } else {
        this.arrowUp = "";
      }
    },
    async setupStripe() {
      const stripe = Stripe(this.publishableKey);
      const elements = stripe.elements();

      var style = {
        base: {
          color: "#000000",
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: "antialiased",
          height: "40px",
          "::placeholder": {
            color: "#999999",
          },
        },
        invalid: {
          color: "red",
          iconColor: "green",
        },
      };

      const cardNumber = elements.create("cardNumber", { style: style });
      cardNumber.mount(this.$refs.cardNumber);
      // const cardNumber = elements.create("cardNumber");
      // cardNumber.mount(this.$refs.cardNumber);

      const cardExpiry = elements.create("cardExpiry", { style: style });
      cardExpiry.mount(this.$refs.cardExpiry);

      const cardCvc = elements.create("cardCvc", { style: style });
      cardCvc.mount(this.$refs.cardCvc);

      this.stripe = stripe;
      this.cardNumber = cardNumber;
      this.cardExpiry = cardExpiry;
      this.cardCvc = cardCvc;
    },

    async replaceCustomerOldCard(token) {

      try {
        const { data } = await axios.post(
          this.EnvPath + "api/replace-customer-card",
          {
            card_name: this.card_name,
            postal_code: this.postal_code,
            country: this.country,
            token: token.id,
            card_id: token.card.id,
          },
          {
            headers: {
              Authorization: "Bearer " + this.$store.state.token,
            },
          }
        );
        if (data.api_status) {
          this.card_name = "";
          this.postal_code = "";
          this.country = "";
          try {
            const res = await this.getUserCardDetails(
              this.getUserData.customer_token,
              true
            );
            if (res) {
              this.closeCollapseExample();
              store.commit("storeCheckLoader", false);
              this.setupStripe();
            }
          } catch (error) {
            const err = "Error Occured while getting user card Details";
            throw new Error(err);
          }
        } else {
          throw new Error(data);
        }
      } catch (error) {
        store.commit("storeCheckLoader", false);
        this.errors = [];
        if (error.response && error.response.status === 422) {
          // Validation error
          this.errors = Object.values(error.response.data.errors).flat();
        } else if (error.response && error.response.status === 401) {
          this.logoutUser();
        } else if (error.message) {
          // Handle other types of errors
          this.errors.push(error.message);
        } else {
          this.errors.push(error);
        }
        return true;
      }
    },
    async createCustomerAccountCard(token) {
      try {
        const { data } = await axios.post(
          "api/create-customer-card-with-token",
          {
            token: token.id,
            card_id: token.card.id,
            card_name: this.card_name,
            postal_code: this.postal_code,
            country: this.country,
          },
          {
            headers: {
              Authorization: "Bearer " + this.$store.state.token,
            },
          }
        );
        if (data.api_status) {
          this.card_name = "";
          this.postal_code = "";
          this.country = "";
          await this.getUserCardDetails(data.customer_token, true);
        } else {
          if (typeof data == "object") {
            throw new Error(data.message);
          } else {
            throw new Error(data);
          }
        }
      } catch (error) {
        store.commit("storeCheckLoader", false);
        this.errors = [];
        if (error.response && error.response.status === 422) {
          console.log(error, 1);
          // Validation error
          this.errors = Object.values(error.response.data.errors).flat();
        } else if (error.response && error.response.status === 401) {
          this.logoutUser();
        } else if (error.message) {
          console.log(error.message, "error.message");
          if (typeof error === "object" && error !== null) {
            // Check if it's an array
            if (Array.isArray(error)) {
              // Convert the array to a string
              let resultString = JSON.stringify(error);
              console.log("Converted array to string:", resultString);
            } else {
              // Convert the object to a string
              let resultString = JSON.stringify(error);
              console.log("Converted object to string:", resultString);
            }
          } else {
            console.error("The result is not a valid object.");
          }

          // Handle other types of errors
          this.errors.push(error.message);
        } else {
          console.log(error, 3);
          this.errors.push(error);
        }
        return true;
      }
    },
    async submitPayment(newAccount) {
      const { token, error } = await this.stripe.createToken(this.cardNumber);
      if (error) {
        store.commit("storeCheckLoader", false);
        this.errors = [];
        this.errors.push(error.message);
      } else {
        try {
          if (newAccount) {
            await this.createCustomerAccountCard(token);
          } else {
            await this.replaceCustomerOldCard(token);
          }
        } catch (error) {
          console.log(error, "error at create Customer New");
        }
      }
      return true;
    },
    async addCustomerCardOnly() {
      this.errors = [];
      this.isSave = true;
      store.commit("storeCheckLoader", true);
      try {
        if (
          this.card_name != "" &&
          this.postal_code != "" &&
          this.country != 0
        ) {
          await this.submitPayment(true);
          store.commit("storeUpgradeCancelbtns", false);
          store.commit("storeCheckLoader", false);
        } else {
          store.commit("storeCheckLoader", false);
          if (
            this.card_name == "" &&
            this.postal_code == "" &&
            this.country == ""
          ) {
            this.$emit("card-popup", true);
          } else {
            this.errors = [];
            this.errors.push(
              "Please complete all of the required fields with the *"
            );
          }
        }
      } catch (error) {
        console.error(error, "my error");
      } finally {
        this.isSave = false;
        store.commit("storeCheckLoader", false);
      }
    },
    closeEditReplace() {
      this.closeCollapseExample();
      $(".visa-styling").removeClass("border-box");
    },

    closeCollapseExample() {
      this.$emit("close-collapse");
    },

    async replaceCardDetails() {
      this.errors = [];
      store.commit("storeCheckLoader", true);
      try {
        if (
          this.card_name != "" &&
          this.postal_code != "" &&
          this.country != 0
        ) {
          await this.submitPayment(false);
        } else {
          store.commit("storeCheckLoader", false);

          if (
            this.card_name == "" &&
            this.postal_code == "" &&
            this.country == ""
          ) {
            this.$emit("card-popup", true);
          } else {
            const err = "Please complete all of the required fields with the *";
            throw new Error(err);
          }
        }
      } catch (error) {
        this.errors = [];
        if (error.response && error.response.status === 422) {
          this.errors = Object.values(error.response.data.errors).flat(); // Validation error
        } else if (error.response && error.response.status === 401) {
          this.logoutUser();
        } else if (error.message) {
          this.errors.push(error.message);
        } else {
          this.errors.push(error);
        }
      } finally {
        store.commit("storeCheckLoader", false);
      }
    },
    async updateCardDetails() {
      this.errors = [];
      store.commit("storeCheckLoader", true);
      try {
        if (
          this.card_name != "" &&
          // this.expiration != "" &&
          this.postal_code != "" &&
          this.country != 0
        ) {
          const { data } = await axios.post(
            this.EnvPath + "api/update-customer-card",
            {
              card_name: this.card_name,
              // expiration: this.expiration,
              postal_code: this.postal_code,
              country: this.country,
            },
            {
              headers: {
                Authorization: "Bearer " + this.$store.state.token,
              },
            }
          );

          if (data.api_status) {
            await this.getUserCardDetails(
              this.getUserData.customer_token,
              true
            );
            this.closeCollapseExample();
          } else {
            throw new Error(data.message); // Throw an error if api_status is falsy
          }
        } else {
          if (
            this.card_name == "" &&
            // this.card_name == "" &&
            //  this.card_number == "" &&
            // this.expiration == "" &&
            // this.security_code == "" &&
            this.postal_code == "" &&
            this.country == ""
          ) {
            // this.CreditCard = true;
            this.$emit("card-popup", true);
          } else {
            throw new Error(
              "Please complete all of the required fields with the *"
            );
          }
        }
      } catch (error) {
        this.errors = [];
        if (error.response && error.response.status === 422) {
          // Validation error
          this.errors = Object.values(error.response.data.errors).flat();
        } else if (error.response && error.response.status === 401) {
          this.logoutUser();
        } else {
          // Handle other types of errors
          this.errors.push(error);
        }
      } finally {
        store.commit("storeCheckLoader", false);
      }
    },

    editBtn() {
      this.showCardInput = false;
      this.card_name = this.getPersonalDetail.name;
      this.country = this.getPersonalDetail.country;
      // this.expiration = this.getPersonalDetail.expiration;
      this.postal_code = this.getPersonalDetail.postal_code;
    },

    inputFocus() {
      this.arrowTrue = true;
    },

    inputChangeValue() {
      this.arrowTrue = false;
    },
  },
};
</script>
<style>
.opacity-0 {
  opacity: 0;
}

.col-md-6.col-sm-12.group.mr-2.inputP55.input_yak_logo_label_shrink
  .StripeElement {
  border: 3px solid #e6e6e6 !important;
  height: 50px !important;
  border-radius: 10px;
  margin-bottom: 20px;
  padding: 14px;
}

button.btn.btn-primary.compare-plan-btn.px-5.py-2.mr-3,
button.btn.btn-primary.compare-plan-btn.px-5.py-2 {
  border-radius: 100px;
}

.btn-right-align i {
  margin-left: 5px;
}

.btn-right-align {
  display: flex;
  justify-content: flex-end;
}

.justify-content-control {
  justify-content: flex-end;
}

@media (max-width: 450px) {
  .justify-content-control {
    display: flex;
    justify-content: center;
  }
}
</style>
