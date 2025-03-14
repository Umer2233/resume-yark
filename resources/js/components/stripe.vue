<template>
  <div>
    <div v-if="cardList">
      <div v-for="(list, key) in cardList.data" :key="list.id">
        <p>
          <b>VISA</b> ending in {{ list.card.last4 }}
          <i class="fa fa-trash" @click="deleteCard(key)"></i>
          <i class="fa fa-edit" @click="editCard(key)"></i>
        </p>
      </div>
    </div>
    <div class="">
      <stripe-element-card
        ref="elementRef"
        :pk="publishableKey"
        @token="tokenCreated"
      />
    </div>
    <button class="mt-3" @click="submit">Generate token</button>
  </div>
</template>

<script>
import { StripeElementCard } from "@vue-stripe/vue-stripe";

export default {
  components: {
    StripeElementCard,
  },
  data() {
    this.publishableKey =
      "pk_test_51O6sfEL0rQTvXrynzfVdQj6s258tahWSen8StmBV87He1vBha4Vl8f24HSHyMqP5ZiqEkxm8zGtBiJswRLFQgb9N00x8pcs5Un";
    return {
      loading: false,
      token: null,
      customerId: "cus_OvF91WoOOzBE5P",
      cardList: [],
      card: "card_1O7ZrjL0rQTvXrynd8aAOgfI",
      stripe: null,
      elements: null,
      STRIPE_SECRET_KEY:
        "sk_test_51O6sfEL0rQTvXryn88k6jNjTZQnrSmByzerlBOchvoXK68g9HPEefT5VBBbBdCQ3dSIf4nHlJLjvLUAtebTgxoox00kurD3Ksw",
      STRIPE_PUBLISHABLE_KEY:
        "pk_test_51O6sfEL0rQTvXrynzfVdQj6s258tahWSen8StmBV87He1vBha4Vl8f24HSHyMqP5ZiqEkxm8zGtBiJswRLFQgb9N00x8pcs5Un",
    };
  },
  mounted() {
    this.getCustomerCards();
  },
  methods: {
    getCustomerCards: function () {
      axios
        .post("api/customer/get/cards", {
          customerId: this.customerId,
        })
        .then((response) => {
          console.log(response, "response response");

          var response = response.data;
          if (response.api_status) {
            this.cardList = response.data;
          }
        })
        .catch((error) => {
          console.log(error, "error at getting cards");
        });
    },
    submit() {
      this.$refs.elementRef.submit();
    },
    tokenCreated(token) {
      this.attachCard(token);
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
