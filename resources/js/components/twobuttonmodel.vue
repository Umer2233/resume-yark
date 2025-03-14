<template>
  <div class="popup-container">
    <div class="poup-sub-container">
      <div
        v-bind:style="{ height: this.popupHeight + 'px ' }"
        class="pop-content-section pop_confused_content space-control-on-mobile"
      >
        <div class="container">
          <div class="row">
            <div class="col-4 mt-4 space-control-box">
              <img src="images/Confused.png" class="pt-3" alt="Confused" />
            </div>
            <div class="col-8">
              <h4 v-html="this.popupTitle"></h4>
              <p v-html="this.popupText"></p>
              <div class="d-flex flex-control-mobile">
                <button
                  @click="close()"
                  class="btnOption btn-rounded"
                  style="float: left"
                >
                  No
                </button>
                <button
                  @click="proceed()"
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
  <!--
  <div id="twobuttonmodel" class="popup-container modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="poup-sub-container">
      <div class="pop-content-section pop_confused_content">
        <div class="container">
          <div class="row">
            <div class="col-4"><img src="/images/logo/Surprise.png" alt="Confused"></div>
            <div class="col-8">
              <h4>Do you want to proceed?</h4>
              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</p>
              <button @click="close()" data-dismiss="modal" class="btnOption btn-rounded" style="float:left;">No</button>
              <button @click="proceed()" data-dismiss="modal" class="btnOption btn_color_option btn-rounded" style="float:right;">Yes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  -->
</template>

<script>
import { environment_api } from "../env";

export default {
  name: "twobuttonmodel",
  props: {
    popupTitle: {
      type: String,
      required: true,
    },
    popupText: {
      type: String,
      required: true,
    },
    popupHeight: {
      type: Number,
      default: 300,
    },
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
    };
  },
  methods: {
    close() {
      this.$emit("close", true);
    },
    proceed() {
      this.$emit("proceed", true);
    },
  },
};
</script>

<style>
.pop-content-section.pop_confused_content {
  height: auto !important;
}

@media (max-width: 450px) {
  .flex-control-mobile {
    flex-direction: column;
  }
  .col-4.mt-4.space-control-box {
    margin-top: 0 !important;
  }
  .space-control-on-mobile {
    padding: 22px 20px 30px 20px !important;
  }
}
</style>
