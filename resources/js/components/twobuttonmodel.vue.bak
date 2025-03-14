<template>
  <div class="popup-container">
    <div class="poup-sub-container">
      <div v-bind:style="{ height: this.popupHeight + 'px !important' }" class="pop-content-section pop_confused_content">
        <div class="container">
          <div class="row">
            <div class="col-4"><img :src="EnvPath+'/images/logo/Surprise.png'" alt="Confused" /></div>
            <div class="col-8">
              <h4 v-html="this.popupTitle"></h4>
              <p v-html="this.popupText"></p>
              <button @click="close()" class="btnOption btn-rounded" style="float:left;">No</button>
              <button @click="proceed()" class="btnOption btn_color_option btn-rounded" style="float:right;">Yes</button>
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
    name: 'twobuttonmodel',
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
        type: String,
        default: 300
      }
    },
    data() {
      return {
        EnvPath: environment_api.api_url,
      };
    },
    methods: {
      close(){
        this.$emit('close', true);
      },
      proceed(){
        this.$emit('proceed', true);
      },
    },
  };
  </script>
