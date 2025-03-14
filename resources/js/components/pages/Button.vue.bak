<template>
  <div class="grid-container" style="padding-top:0px;padding-bottom:0px;">
    <div class="resume-editor-div" style="padding-top:0px;padding-bottom:0px; padding:0px">
      <div class="accordion purple" id="accordion">
        <div class="header">
          <slot name="header">
            <div
              slot="header"
              style="font-family:'Hind', sans-serif; font-size: 18px; color: #767676;padding-top:2px"
            >
              <strong>New Position Details</strong>
            </div>
          </slot>
          <i
            class="fa fa-2x fa-chevron-down header-icon"
            v-bind:class="{ rotate: show }"
            v-on:click="toggle"
          ></i>
        </div>
        <!-- Modal -->
        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document" style="top: 250px; width: 300px;">
            <div class="modal-content">
              <!-- <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>-->
              <div class="modal-body">Do you want to delete this position?</div>
              <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Yes</button>
                <button type="button" class="btn" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>
        <transition
          name="accordion"
          v-on:before-enter="beforeEnter"
          v-on:enter="enter"
          v-on:before-leave="beforeLeave"
          v-on:leave="leave"
        >
          <div class="body" v-show="show">
            <div class="body-inner">
              <slot>
                <!-- Contact Form -->
                <!-- <form class="mt-3 contact-form"> -->
                <div
                  class="row justify-content-center"
                  style="padding-left: 10px;padding-right: 10px;"
                >
                  <div
                    class="col-md-4 col-sm-12 group mr-2 inputP55"
                    style="height: 50px;margin-top: 3px;"
                  >
                    <div class>
                      <input
                        type="text"
                        v-model="Company"
                        class="input"
                        :class="isMouseLeaveCompany?'mouseLeave':(isMouseFocusCompany?'input':'')"
                        @click="inputFocus('Company')"
                        @mouseleave="mouseLeaveInput('Company')"
                      />
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="label_name"
                        :class="(isMouseLeaveCompany && (Company!='') || (!isMouseFocusCompany && (Company!='')))?'mouseLeave_':''"
                      >Company*:</label>
                    </div>
                  </div>
                  <div
                    class="col-md-4 col-sm-12 group mr-2 inputP55"
                    style="height: 50px; margin-top: 3px;"
                  >
                    <div class>
                      <input
                        type="text"
                        v-model="Position"
                        class="input"
                        :class="isMouseLeavePosition?'mouseLeave':(isMouseFocusPosition?'input':'')"
                        @click="inputFocus('Position')"
                        @mouseleave="mouseLeaveInput('Position')"
                        style="padding-right:40px"
                      />
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="label_name"
                        :class="(isMouseLeavePosition && (Position!='') || (!isMouseFocusPosition && (Position!='')))?'mouseLeave_':''"
                      >Position*:</label>
                    </div>

                    <span>
                      <img
                        :src="'//test.resumeyak.com'+'/images/bg/logo.png'"
                        alt
                        class="small_logo"
                        v-tooltip="'I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
                      />
                    </span>
                  </div>

                  <div
                    class="col-md-4 col-sm-12 group mr-2 inputP55"
                    style="height: 50px;margin-top: 3px;"
                  >
                    <div class>
                      <input
                        id="popover-1"
                        type="text"
                        v-model="PositionClassification"
                        class="input"
                        :class="isMouseLeavePositionClassification?'mouseLeave':(isMouseFocusPositionClassification?'input':'')"
                        @click="inputFocus('PositionClassification')"
                        @mouseleave="mouseLeaveInput('PositionClassification')"
                        style="padding-right:40px"
                      />
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="label_name"
                        :class="(isMouseLeavePositionClassification && (PositionClassification!='') || (!isMouseFocusPositionClassification && (PositionClassification!='')))?'mouseLeave_':''"
                      >Position Classification:</label>
                    </div>
                    <span>
                      <img
                        :src="'//test.resumeyak.com'+'/images/bg/logo.png'"
                        alt
                        class="small_logo"
                        v-tooltip="'I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
                      />
                    </span>
                  </div>
                </div>
                <!-- end .row -->

                <div
                  class="row justify-content-center"
                  style="padding-left: 10px;padding-right: 10px;"
                >
                  <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                    <div class>
                      <input
                        type="text"
                        v-model="City"
                        class="input"
                        :class="isMouseLeaveCity?'mouseLeave':(isMouseFocusCity?'input':'')"
                        @click="inputFocus('city')"
                        @mouseleave="mouseLeaveInput('city')"
                      />
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="label_name"
                        :class="(isMouseLeaveCity && (City!='') || (!isMouseFocusCity && (City!='')))?'mouseLeave_':''"
                      >City*:</label>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                    <div class>
                      <select
                        name="state"
                        id="state"
                        class="select-item input"
                        v-model="state"
                        :class="isMouseLeaveState?'mouseLeave':(isMouseFocusState?'input':'')"
                        @click="inputFocus('state')"
                        @mouseleave="mouseLeaveInput('state')"
                        style="-webkit-appearance: none;"
                      >
                        <option value></option>
                        <option value="1">State 1</option>
                        <option value="2">State 2</option>
                      </select>
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="select-label"
                        :class="!state?'unselected':((isMouseLeaveState && (state!=0) || (!isMouseFocusState && (state!=0)))?'mouseLeave_':'')"
                      >State*:</label>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                    <div class>
                      <select
                        name="country"
                        id="country"
                        class="select-item input"
                        v-model="country"
                        :class="isMouseLeaveCountry?'mouseLeave':(isMouseFocusCountry?'input':'')"
                        @click="inputFocus('country')"
                        @mouseleave="mouseLeaveInput('country')"
                        style="-webkit-appearance: none;"
                      >
                        <option value="0" class="label_name"></option>
                        <option value="1" class="label_name">country 1</option>
                        <option value="2" class="label_name">country 2</option>
                      </select>
                      <!-- <span class="highlight"></span> -->
                      <span class="bar"></span>
                      <label
                        class="select-label"
                        :class="!country?'unselected':((isMouseLeaveCountry && (country!=0) || (!isMouseFocusCountry && (country!=0)))?'mouseLeave_':'')"
                      >Country*:</label>
                    </div>
                  </div>
                </div>
                <!-- end .row -->

                <div class="row justify-content-center">
                  <div
                    class="row justify-content-center col-md-6 col-sm-12 group mr-2"
                    style="padding-right:0px;padding-left:0px; margin-bottom: -7px;"
                  >
                    <div class="col-md-4 col-sm-4 workdate">
                      <p
                        style="font-family: Hind; font-size:16px color:#767676 align-items:center"
                      >Start Date*:</p>
                    </div>
                    <div class="col-md-4 col-sm-4 inputP55">
                      <div class>
                        <select
                          name="month"
                          id="month"
                          class="select-item input"
                          v-model="month"
                          :class="isMouseLeaveMonth?'mouseLeave':(isMouseFocusMonth?'input':'')"
                          @click="inputFocus('month')"
                          @mouseleave="mouseLeaveInput('month')"
                          style="-webkit-appearance: none;"
                        >
                          <option value="0" class="label_name"></option>
                          <option value="1" class="label_name">Jan</option>
                          <option value="2" class="label_name">Feb</option>
                          <option value="3" class="label_name">March</option>
                          <option value="4" class="label_name">April</option>
                          <option value="5" class="label_name">May</option>
                          <option value="6" class="label_name">June</option>
                          <option value="7" class="label_name">July</option>
                          <option value="8" class="label_name">Aug</option>
                          <option value="9" class="label_name">Sep</option>
                          <option value="10" class="label_name">Oct</option>
                          <option value="11" class="label_name">Nov</option>
                          <option value="12" class="label_name">Dec</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="select-label"
                          :class="!month?'unselected':((isMouseLeaveMonth && (month!=0) || (!isMouseFocusMonth && (month!=0)))?'mouseLeave_':'')"
                        >Month:</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 year inputP55" style="height:50px">
                      <div class>
                        <select
                          name="year"
                          id="year"
                          class="select-item input"
                          v-model="year"
                          :class="isMouseLeaveYear?'mouseLeave':(isMouseFocusYear?'input':'')"
                          @click="inputFocus('year')"
                          @mouseleave="mouseLeaveInput('year')"
                          style="-webkit-appearance: none;"
                        >
                          <option value="0" class="label_name"></option>
                          <option value="1" class="label_name">2019</option>
                          <option value="2" class="label_name">2020</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="select-label"
                          :class="!year?'unselected':((isMouseLeaveYear && (year!=0) || (!isMouseFocusYear && (year!=0)))?'mouseLeave_':'')"
                        >Year:</label>
                      </div>
                    </div>
                  </div>
                  <div
                    class="row justify-content-center col-md-6 col-sm-12 group mr-2"
                    style="padding-right:0px;padding-left:0px; margin-bottom: -7px;"
                  >
                    <div class="col-md-4 col-sm-4 workdate">
                      <p style="font-family: Hind; font-size:16px; color:#767676">End Date*:</p>
                    </div>
                    <div class="col-md-4 col-sm-4 inputP55">
                      <div class>
                        <select
                          name="month_"
                          id="month_"
                          class="select-item input"
                          v-model="month_"
                          :class="isMouseLeaveMonth_?'mouseLeave':(isMouseFocusMonth_?'input':'')"
                          @click="inputFocus('month_')"
                          @mouseleave="mouseLeaveInput('month_')"
                          style="-webkit-appearance: none;"
                        >
                          <option value="0" class="label_name"></option>
                          <option value="1" class="label_name">Jan</option>
                          <option value="2" class="label_name">Feb</option>
                          <option value="3" class="label_name">March</option>
                          <option value="4" class="label_name">April</option>
                          <option value="5" class="label_name">May</option>
                          <option value="6" class="label_name">June</option>
                          <option value="7" class="label_name">July</option>
                          <option value="8" class="label_name">Aug</option>
                          <option value="9" class="label_name">Sep</option>
                          <option value="10" class="label_name">Oct</option>
                          <option value="11" class="label_name">Nov</option>
                          <option value="12" class="label_name">Dec</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="select-label"
                          :class="!month_?'unselected':((isMouseLeaveMonth_ && (month_!=0) || (!isMouseFocusMonth_ && (month_!=0)))?'mouseLeave_':'')"
                        >Month:</label>
                      </div>
                    </div>
                    <div
                      class="col-md-4 col-sm-4 year inputP55"
                      style="height:50px padding-top:10px"
                    >
                      <div class>
                        <select
                          name="_"
                          id="year_"
                          class="select-item input"
                          v-model="year_"
                          :class="isMouseLeaveYear_?'mouseLeave':(isMouseFocusYear_?'input':'')"
                          @click="inputFocus('year_')"
                          @mouseleave="mouseLeaveInput('year_')"
                          style="-webkit-appearance: none;"
                        >
                          <option value="0" class="label_name"></option>
                          <option value="1" class="label_name">2019</option>
                          <option value="2" class="label_name">2020</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="select-label"
                          :class="!year_?'unselected':((isMouseLeaveYear_ && (year_!=0) || (!isMouseFocusYear_ && (year_!=0)))?'mouseLeave_':'')">Year:</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="confirm" style="margin-bottom: 32px;margin-top: -4px;">
                    <i class="fa fa-2x fa fa-trash header-icon1"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    style="display: inline; position: absolute; left: 45px;">
                  </i>
                  <i class="fa fa-times-circle"
                    style="font-size:30px;color:#ec5366;position: absolute;right: 85px;"
                    @click="cancel()">
                  </i>
                  <i class="fa fa-check-circle"
                    style="font-size:30px;color:#ec5366;position: absolute;right: 50px;"
                    @click="IsNext_(Company, Position, City)">
                  </i>
                </div>
              </slot>
            </div>
          </div>
        </transition>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "Button",
  props: ["type"],
  components: {
  },
  data() {
    return {
      placements: ["bottomleft"],
      item: {},
      items: [
        {
          id: 1,
          name: "First title",
          content:
            "First content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        },
        {
          id: 2,
          name: "Second title",
          content:
            "Second content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        },
        {
          id: 3,
          name: "Third title",
          content:
            "Third Content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        },
        {
          id: 4,
          name: "First title",
          content:
            "First content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        },
        {
          id: 5,
          name: "Second title",
          content:
            "Second content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        },
        {
          id: 6,
          name: "Third title",
          content:
            "Third Content:I heard you have to give away your first-born child to use this site, so you better read these carefully!'"
        }
      ],
      items_first: [],
      isMouseLeaveCompany: false,
      isMouseFocusCompany: false,
      isMouseLeavePosition: false,
      isMouseFocusPosition: false,
      isMouseLeavePositionClassification: false,
      isMouseFocusPositionClassification: false,
      isMouseLeaveCity: false,
      isMouseFocusCity: false,
      isMouseLeaveState: false,
      isMouseFocusState: false,
      isMouseLeaveCountry: false,
      isMouseFocusCountry: false,
      isMouseLeaveMonth: false,
      isMouseFocusMonth: false,
      isMouseLeaveYear: false,
      isMouseFocusYear: false,
      isMouseLeaveMonth_: false,
      isMouseFocusMonth_: false,
      isMouseLeaveYear_: false,
      isMouseFocusYear_: false,
      Company: [],
      Position: [],
      PositionClassification: [],
      City: [],
      state: 0,
      country: 0,
      month: 0,
      year: 0,
      month_: 0,
      year_: 0,
      IsNext_f: true,
      IsNext_f_: true,
      IsNext_f__: true,
      show: false

      // searchText: "",
      // showList: false,
      // cursor: 0
    };
  },
  methods: {
    itemSelected(item) {
      this.item = item;
    },
    setLabel(item) {
      return item.name;
    },
    inputChange(text) {
      // your search method

      var key,
        count = 0;
      for (key in this.items_first) {
        if (this.items_first.hasOwnProperty(key)) {
          count++;
        }
      }
      var bbb = [];
      for (var i = 0; i < count; i++) {
        const aaa = this.items_first[i].name.toLowerCase();
        if (aaa.includes(text) == true) {
          bbb.push(this.items_first[i]);
        }
      }
      setTimeout(() => {
        this.items = bbb;
      }, 100);
    },

    mouseLeaveInput(inputName) {
      if (inputName === "Company") {
        this.isMouseLeaveCompany = true;
        this.isMouseFocusCompany = false;
      }
      if (inputName === "Position") {
        this.isMouseLeavePosition = true;
        this.isMouseFocusPosition = false;
      }
      if (inputName === "PositionClassification") {
        this.isMouseLeavePositionClassification = true;
        this.isMouseFocusPositionClassification = false;
      }
      if (inputName === "city") {
        this.isMouseLeaveCity = true;
        this.isMouseFocusCity = false;
      }
      if (inputName === "state") {
        this.isMouseLeaveState = true;
        this.isMouseFocusState = false;
      }
      if (inputName === "country") {
        this.isMouseLeaveCountry = true;
        this.isMouseFocusCountry = false;
      }
      if (inputName === "month") {
        this.isMouseLeaveMonth = true;
        this.isMouseFocusMonth = false;
      }
      if (inputName === "year") {
        this.isMouseLeaveYear = true;
        this.isMouseFocusYear = false;
      }
      if (inputName === "month_") {
        this.isMouseLeaveMonth_ = true;
        this.isMouseFocusMonth_ = false;
      }
      if (inputName === "year_") {
        this.isMouseLeaveYear_ = true;
        this.isMouseFocusYear_ = false;
      }
    },
    inputFocus(inputName) {
      if (inputName === "Company") {
        this.isMouseFocusCompany = true;
        this.isMouseLeaveCompany = false;
      }
      if (inputName === "Position") {
        this.isMouseFocusPosition = true;
        this.isMouseLeavePosition = false;
      }
      if (inputName === "PositionClassification") {
        this.isMouseLeavePositionClassification = false;
        this.isMouseFocusPositionClassification = true;
      }
      if (inputName === "city") {
        this.isMouseLeaveCity = false;
        this.isMouseFocusCity = true;
      }
      if (inputName === "state") {
        this.isMouseLeaveState = false;
        this.isMouseFocusState = true;
      }
      if (inputName === "country") {
        this.isMouseLeaveCountry = false;
        this.isMouseFocusCountry = true;
      }
      if (inputName === "month") {
        this.isMouseLeaveMonth = false;
        this.isMouseFocusMonth = true;
      }
      if (inputName === "year") {
        this.isMouseLeaveYear = false;
        this.isMouseFocusYear = true;
      }
      if (inputName === "month_") {
        this.isMouseLeaveMonth_ = false;
        this.isMouseFocusMonth_ = true;
      }
      if (inputName === "year_") {
        this.isMouseLeaveYear_ = false;
        this.isMouseFocusYear_ = true;
      }
    },
    IsNext(Company, Position, City) {
      if (
        Company != "" &&
        Position != "" &&
        City != "" &&
        this.state != 0 &&
        this.country != 0 &&
        this.month != 0 &&
        this.year != 0 &&
        this.month_ != 0 &&
        this.year_ != 0
      ) {
        this.IsNext_f = true;
        this.$router.push({ name: "WorkAdd" });
      } else {
        this.IsNext_f = false;
      }
    },
    IsNext_(Company, Position, City) {
      if (
        Company != "" &&
        Position != "" &&
        City != "" &&
        this.state != 0 &&
        this.country != 0 &&
        this.month != 0 &&
        this.year != 0 &&
        this.month_ != 0 &&
        this.year_ != 0
      ) {
        this.IsNext_f_ = true;
        // this.$router.push({ name: "WorkAdd" });
      } else {
        this.IsNext_f_ = false;
      }
      if (this.IsNext_f_ == true) {
        this.show = !this.show;
      }
    },
    IsNext__(Company, Position, City) {
      if (
        Company != "" &&
        Position != "" &&
        City != "" &&
        this.state != 0 &&
        this.country != 0 &&
        this.month != 0 &&
        this.year != 0 &&
        this.month_ != 0 &&
        this.year_ != 0
      ) {
        this.IsNext_f__ = true;
        // this.$router.push({ name: "WorkAdd" });
      } else {
        this.IsNext_f__ = false;
      }
    },
    toggle: function() {
      this.show = !this.show;
    },
    reloadPage() {
      window.location.reload();
    },
    cancel: function() {
      this.show = false;
      // Company = "";
      // Position = "";
      // City = "";
      // this.state = 0;
      // this.country = 0;
      // this.month = 0;
      // this.year = 0;
      // this.month_ = 0;
      // this.year_ = 0;
      // PositionClassification = "";
      reloadPage();
      IsNext_f = true;
      IsNext_f_ = true;
      IsNext_f__ = true;
    },
    beforeEnter: function(el) {
      el.style.height = "0";
    },
    enter: function(el) {
      el.style.height = el.scrollHeight + "px";
    },
    beforeLeave: function(el) {
      el.style.height = el.scrollHeight + "px";
    },
    leave: function(el) {
      el.style.height = "0";
    }
  },
  created() {
    this.items_first = this.items;
  }
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
</style>

