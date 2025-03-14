<!-- resources/js/components/PaymentForm.vue -->
<template>
  <div>
    <div v-if="cardList">
      <div v-for="(list, key) in cardList.data" :key="list.id">
        <p>
          <b class="text-primary">VISA</b> ending in {{ list.card.last4 }}
          <i class="fa fa-edit text-info" @click="editCard(key)"></i>
          <i class="fa fa-trash c-red" @click="deleteCard(key)"></i>
        </p>
      </div>
    </div>
    <form @submit.prevent="submitPayment">
      <div class="row">
        <div class="col-md-4">
          <label for="card-number">Card Number</label>
          <div ref="cardNumber"></div>
        </div>

        <div class="col-md-4">
          <label for="card-expiry">Expiration Date</label>
          <div ref="cardExpiry"></div>
        </div>
        <div class="col-md-4">
          <label for="card-cvc">CVC</label>
          <div ref="cardCvc"></div>
        </div>

        <div class="col-md-4 mt-2">
          <label for="card-name">Cardholder Name</label> <br />
          <input
            type="text"
            class="StripeElement"
            v-model="cardName"
            required
          />
        </div>
        <br />

        <div class="col-md-4 mt-2">
          <label for="country">Country</label><br />

          <select
            name="country"
            id="country"
            class="select-item StripeElement"
            v-model="country"
          >
            <option value="USA">UNITED STATES OF AMERICA</option>
            <option value="pk">Pakistan</option>
            <option value="nz">NewZeland</option>
          </select>
        </div>
      </div>
      <br />

      <button type="submit" class="btn btn-primary">Submit Card</button>
    </form>
    <div class="mt-3">
      <button type="button " class="btn btn-secondary" @click="payPayment">
        Pay Amount
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    this.publishableKey =
      "pk_test_51O6sfEL0rQTvXrynzfVdQj6s258tahWSen8StmBV87He1vBha4Vl8f24HSHyMqP5ZiqEkxm8zGtBiJswRLFQgb9N00x8pcs5Un";
    return {
      loading: false,
      token: null,
      customerId: "cus_OvF91WoOOzBE5P",
      cardList: [],
      card: "card_1O7ydlL0rQTvXrynBmec7NxV",
      stripe: null,
      cardNumber: "",
      cardExpiry: "",
      cardCvc: "",
      elements: null,
      cardName: "",
      country: "",
      STRIPE_SECRET_KEY:
        "sk_test_51O6sfEL0rQTvXryn88k6jNjTZQnrSmByzerlBOchvoXK68g9HPEefT5VBBbBdCQ3dSIf4nHlJLjvLUAtebTgxoox00kurD3Ksw",
      STRIPE_PUBLISHABLE_KEY:
        "pk_test_51O6sfEL0rQTvXrynzfVdQj6s258tahWSen8StmBV87He1vBha4Vl8f24HSHyMqP5ZiqEkxm8zGtBiJswRLFQgb9N00x8pcs5Un",
    };
  },
  mounted() {
    this.getCustomerCards();
    this.setupStripe();
  },
  methods: {
    async payPayment() {
      try {
        const response = await axios
          .post("api/createPaymentIntent", {
            customerId: this.customerId,
            amount: 1000,
            card_id: this.card,
          })
          .then((response) => {
            if (response.data.api_status) {
              alert("payment paid");
            }
          })
          .catch((error) => {
            console.log(error, "error at getting cards");
          });
        console.log(response, "response response");
      } catch (error) {
        console.error("Error sending token to server:", error);
      }
    },
    async setupStripe() {
      const stripe = Stripe(this.publishableKey);
      const elements = stripe.elements();

      const cardNumber = elements.create("cardNumber");
      cardNumber.mount(this.$refs.cardNumber);

      const cardExpiry = elements.create("cardExpiry");
      cardExpiry.mount(this.$refs.cardExpiry);

      const cardCvc = elements.create("cardCvc");
      cardCvc.mount(this.$refs.cardCvc);

      this.stripe = stripe;
      this.cardNumber = cardNumber;
      this.cardExpiry = cardExpiry;
      this.cardCvc = cardCvc;
    },
    async submitPayment() {
      const { token, error } = await this.stripe.createToken(this.cardNumber);
      console.log(token, "token");
      if (error) {
        console.error(error);
      } else {
        // this.sendTokenToServer(token);
        this.attachCard(token);
      }
    },
    attachCard: function (token) {
      axios
        .post("api/customer/attach", {
          customerId: this.customerId,
          token: token.id,
        })
        .then((response) => {
          if (response.data.api_status) {
            this.getCustomerCards();
          }
        })
        .catch((error) => {
          console.log(error, "error at getting cards");
        });
    },

    getCustomerCards: function () {
      axios
        .post("api/customer/get/cards", {
          customerId: this.customerId,
        })
        .then((response) => {
          var response = response.data;
          if (response.api_status) {
            this.cardList = response.data;
          }
        })
        .catch((error) => {
          console.log(error, "error at getting cards");
        });
    },
    editCard: function (index) {
      axios
        .post("api/customer/edit/card", {
          index: index,
          customerId: this.customerId,
        })
        .then((response) => {
          if (response.data.api_status) {
            this.getCustomerCards();
          }
        })
        .catch((error) => {
          console.log(error, "error at getting cards");
        });
    },
    deleteCard: function (index) {
      axios
        .post("api/customer/delete/card", {
          index: index,
          customerId: this.customerId,
        })
        .then((response) => {
          if (response.data.api_status) {
            this.getCustomerCards();
          }
        })
        .catch((error) => {
          console.log(error, "error at getting cards");
        });
    },
  },
};
</script>
<style>
.StripeElement {
  border: 1px solid black !important;
  height: 33px !important;
  background: white !important;
  width: 100%;
}
.c-red {
  color: red;
}
</style>
