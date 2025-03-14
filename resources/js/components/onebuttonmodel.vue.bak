<template>
  <div class="popup-container">
    <div class="poup-sub-container">
      <div v-bind:style="{ height: this.popupHeight + 'px !important' }" class="pop-content-section pop_confused_content">
        <div class="container">
          <div class="row">
            <div class="col-4"><img src="/builder/images/logo/Confused.png" alt="Confused"></div>
            <div class="col-8">
              <h4 v-html="this.popupTitle"></h4>
              <p v-html="this.popupText"></p>
              <button @click="close()" class="btnOk btn-rounded">Ok</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'onebuttonmodel',
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
      return {};
    },
    methods: {
      close(){
        this.$emit('close', true);
      },
    },
  };
</script>
