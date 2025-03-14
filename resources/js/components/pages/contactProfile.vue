<template>
  <div class="row">
    <div class="col-md-2 p-0">
        <contact-sidebar />
    </div>
    <div class="col-md-10 grid-container popup-align-box">
       <div class="section-height-footer">
      <div class="resume-editor-div card-height-control-box space-control-mobile-wrokhistory">
        <h2 class="mt-2">
          <span class="icon">
            <i class="fas fa-briefcase"></i>
          </span>
          Work History
        </h2>
        <!-- popupHeight="340" -->
        <twobuttonmodel :popupHeight="p_height" popupTitle="Are You Sure?" popupText="It looks like you haven't entered any work history. You might consider adding unpaid volunteer work (raising children) or other opportunities that provided experiences that may be relevant to the positions you may apply for." v-if="showposnextModal" @close="closeposnextModal" @proceed="proceedposnextModel" ></twobuttonmodel>
        <twobuttonmodel :popupHeight="p_height" popupTitle="Are you Sure You Want to Delete?" popupText="I'm sure you worked hard for this position. Are you sure you just want to throw it away with the click of a button?" v-if="showdelModal" @close="closedelModal" @proceed="proceeddelModel" ></twobuttonmodel>
        <div v-for="(workhistory_line,index) in workhistory_lines" v-bind:key="index" class="accordion purple">
          <div @click="showEditwh(workhistory_line.show,index)" class="header">
            <slot name="header">
              <div slot="header" style="font-family:'Hind', sans-serif; font-size: 20px; color: #767676;padding-top:2px;margin-top: 15px;">
                <strong class="text-left" v-html="workhistory_line.position_head"></strong>
              </div>
            </slot>
           <!-- <img class="header-icon" src="../../../../public/images/logo/resume-zoom.png" alt=""> -->
            <i class="fa fa-2x fa-chevron-down header-icon" v-bind:class="{ rotate: workhistory_line.show }" v-on:click="toggle"></i>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="top: 250px; width: 300px;">
              <div class="modal-content">
                <div class="modal-body">Do you want to delete this position?</div>
                <div class="modal-footer">
                  <button type="button" class="btn" data-dismiss="modal" @click="delete_history(current_index,current_db_id)">Yes</button>
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
            v-on:leave="leave">
            <div class="body " v-show="workhistory_line.show">
              <div class="body-inner">
                <slot>
                  <!-- Contact Form -->
                  <!-- <form class="mt-3 contact-form"> -->
                  <div class="row justify-content-center mb-md-4 spce-adjsut-on-acordin-column">
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile" style="height: 50px;margin-top: 3px;">
                      <div >
                        <input maxlength="70" v-on:blur="mouseLeaveInput2('Company',index)" type="text" v-model="workhistory_line.Company" class="input-info"
                               v-on:keyup="hideValidarion(index)"
                          :class="workhistory_line.isMouseLeaveCompany?'mouseLeave':(workhistory_line.isMouseFocusCompany?'input':'')"
                               @click="inputFocus2('Company',index)"
                          @mouseleave="mouseLeaveInput2('Company',index)" />
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name"
                          :class="(workhistory_line.isMouseLeaveCompany && (workhistory_line.Company!='') || (!workhistory_line.isMouseFocusCompany && (workhistory_line.Company!='')))?'mouseLeave_':''">Company*:</label>
                      </div>
                    </div>
                    <div class="d-flex col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile" style="height: 50px; margin-top: 3px;">
                      <div class="w-100">
                        <input maxlength="70" v-on:blur="mouseLeaveInput2('Position',index)" type="text" v-model="workhistory_line.Position" class="input-info"
                               v-on:keyup="hideValidarion(index)"
                               :class="workhistory_line.isMouseLeavePosition?'mouseLeave':(workhistory_line.isMouseFocusPosition?'input':'')"
                          @click="inputFocus2('Position',index)"
                          @mouseleave="mouseLeaveInput2('Position',index)"
                          style="padding-right:45px"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name" :class="(workhistory_line.isMouseLeavePosition && (workhistory_line.Position!='') || (!workhistory_line.isMouseFocusPosition && (workhistory_line.Position!='')))?'mouseLeave_':''">Position*:</label>
                      </div>
                       <div
                class="position-tooltip"
                data-tooltip="If the bulk of your experience is with one employer,you consider adding the employer multiple times to illustrate the differnet positions you have held and when you held them.However,if you already have several employers,consider just using the most recent position."
              >
                <img
                  :src="EnvPath + 'images/bg/help.png'"
                  alt
                  class="small_logo"
                />
              </div>
                      <span class="laptop-tooltip ">
                        <img :src="EnvPath+'images/bg/help.png'"
                          alt
                          class="small_logo yak-logo"
                          v-tooltip="field_position"
                        />
                      </span>
                    </div>
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile" style="height: 50px;margin-top: 3px;">
                      <div class>
                        <input type="hidden"
                        :id="'hdnPosClass-' + index"
                        v-model="workhistory_line.PositionClassificationID" />
                        <input type="hidden"
                               :id="'hdnTitle-' + index"
                               v-model="workhistory_line.TitleID"
                        />

                        <input ref="'popover_' + index"
                              v-on:blur="mouseLeaveInput2('PositionClassification',index)"
                              :id="'popover-' + index"
                              type="text"
                              v-model="workhistory_line.PositionClassification"
                              class="input-info"
                              :class="workhistory_line.isMouseLeavePositionClassification?'mouseLeave':(workhistory_line.isMouseFocusPositionClassification?'input':'')"
                              v-on:keyup.tab="inputFocus21('PositionClassification',index)"
                              @click="inputFocus2('PositionClassification',index)"
                              @mouseleave="mouseLeaveInput2('PositionClassification',index)"
                              autocomplete="off"
                              style="padding-right:40px"
                              @input="handlePositionClassification(index)"
                              />
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name"
                        :class="(workhistory_line.isMouseLeavePositionClassification && (workhistory_line.PositionClassification!='') || (!workhistory_line.isMouseFocusPositionClassification && (workhistory_line.PositionClassification!='')))
                        ?'mouseLeave_':''">Position Classification*:</label>
                      </div>
                      <span>
                        <img :src="EnvPath+'images/bg/help.png'" alt class="small_logo yak-logo"
                          v-tooltip="field_positionclassification"/>
                      </span>
                    </div>
                    <b-popover :show.sync="workhistory_line.pop_show" :target="'popover-' + index" placement="bottom">
                      <input-suggestion
                        style="max-height:400px !important"
                        :items="items"
                        :arindex="index"
                        v-model="item"
                        :minLen="0"
                        :setLabel="setLabel"
                        :itemTemplate="itemTemplate"

                        @onInputChange="inputChange"
                        @onitemselected="itemSelected23"
                        :text="(workhistory_line.PositionClassification != ''? workhistory_line.PositionClassification : workhistory_line.Position)"
                        placeholder="Search:"
                      ></input-suggestion>
                    </b-popover>
                  </div>
                  <!-- end .row -->

                  <div class="row justify-content-center space-adjust-feilds">
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile" style="height: 50px;">
                      <div class>
                        <input v-on:blur="mouseLeaveInput2('city',index)" type="text" v-model="workhistory_line.City" class="input-info"
                               v-on:keyup="hideValidarion(index)"
                          :class="workhistory_line.isMouseLeaveCity?'mouseLeave':(workhistory_line.isMouseFocusCity?'input':'')"
                          @click="inputFocus2('city',index)" @mouseleave="mouseLeaveInput2('city',index)"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="label_name"
                          :class="(workhistory_line.isMouseLeaveCity && (workhistory_line.City!='') || (!workhistory_line.isMouseFocusCity && (workhistory_line.City!='')))?'mouseLeave_':''"
                        >City*:</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile" style="height: 50px;">
                      <div class="select-arrow-side" :class="(arrowTrue == 'state') ? 'arrowUp' : ''" v-if="workhistory_line.showStateSelect  != ''">
                        <select name="state" id="state" class="select-item input-info" v-model="workhistory_line.state"
                                v-on:change="hideValidarion(index)"
                          :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')"
                          @click="inputFocus2('state',index)" @mouseleave="mouseLeaveInput2('state',index)" style="-webkit-appearance: none;">
                          <option value></option>
                          <option v-for="(state,index) in getStateData" :key="state" :value="index">{{ state }}</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="select-label"
                          :class="!workhistory_line.state?'unselected':((workhistory_line.isMouseLeaveState && (workhistory_line.state!=0) || (!workhistory_line.isMouseFocusState && (workhistory_line.state!=0)))?'mouseLeave_':'')"
                        >State*:</label>
                      </div>
                      <div class v-if="workhistory_line.showStateText != ''">
                        <input :maxlength="255" v-on:blur="mouseLeaveInput2('state',index)" type="text" v-model="workhistory_line.state" class="input-info" :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')" @click="inputFocus2('state',index)"
                               v-on:keyup="hideValidarion(index)"
                               @mouseleave="mouseLeaveInput2('state',index)"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name" :class="(workhistory_line.isMouseLeaveState && workhistory_line.state!='') ?'mouseleavefill':''">State*:</label>
                      </div>
                    </div>

                    <div class="col-md-4 col-sm-12 group mr-2 inputP55 mb-mb-10 space-adjsut-mobile mb-0-mobile" style="height: 50px;">
                      <div class="select-arrow-side" :class="(arrowTrue == 'country') ? 'arrowUp' : ''">

                        <select name="country" id="country" class="select-item input-info"  v-model="workhistory_line.country"
                                :class="workhistory_line.isMouseLeaveCountry?'mouseLeave':(workhistory_line.isMouseFocusCountry?'input':'')"
                                @click="inputFocus2('country',index)" @mouseleave="mouseLeaveInput2('country',index)" @change="hideStateSelect2($event,index)" style="-webkit-appearance: none;">
                          <option v-for="(country,index) in getCountriesData" :value="index" >{{ country }}</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="select-label mouseleavefill" style="left: 10px;">Country*:</label>
                      </div>
                    </div>
                  </div>
                  <!-- end .row -->

                  <div class="row justify-content-between padding-on-tablet">
                    <div class="row justify-content-center col-md-6 col-sm-12 group mr-2"
                      style="padding-right:0px;padding-left:0px; margin-bottom: -7px;">
                      <div class="col-md-3 col-sm-12 workdate mobile-text-heading-height-control">
                        <p style="font-family: Hind; font-size:15px; color:#767676; align-items:center">Start Date*:</p>
                      </div>
                      <div class="row col-md-9 col-sm-12 padding-remvoe-end-mobile padding-left-remove-in-tablet">
                        <div class="col-md-6 col-sm-12 inputP55">
                          <div class="select-arrow-side space-remove-left-text" :class="(arrowTrue == 'month') ? 'arrowUp' : ''">
                            <select name="month" id="month" class="select-item input-info" v-model="workhistory_line.month"
                              :class="workhistory_line.isMouseLeaveMonth?'mouseLeave':(workhistory_line.isMouseFocusMonth?'input':'')"
                                    v-on:change="hideValidarion(index)"
                              @click="inputFocus2('month',index)" @mouseleave="mouseLeaveInput2('month',index)" style="-webkit-appearance: none;">
                              <option value="" ></option>
                              <option value="1" class="label_name">Jan</option>
                              <option value="2" class="label_name">Feb</option>
                              <option value="3" class="label_name">Mar</option>
                              <option value="4" class="label_name">Apr</option>
                              <option value="5" class="label_name">May</option>
                              <option value="6" class="label_name">Jun</option>
                              <option value="7" class="label_name">Jul</option>
                              <option value="8" class="label_name">Aug</option>
                              <option value="9" class="label_name">Sep</option>
                              <option value="10" class="label_name">Oct</option>
                              <option value="11" class="label_name">Nov</option>
                              <option value="12" class="label_name">Dec</option>
                            </select>
                            <!-- <span class="highlight"></span> -->
                            <!-- <i class="fas fa-caret-down bar"></i> -->
                            <span class="bar"></span>
                            <label
                              class="select-label"
                              :class="!workhistory_line.month?'unselected':((workhistory_line.isMouseLeaveMonth && (workhistory_line.month!=0) || (!workhistory_line.isMouseFocusMonth && (workhistory_line.month!=0)))?'mouseLeave_':'')"
                            >Month:</label>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 year mb-mb-15 inputP55" style="height:50px">
                      <div class="select-arrow-side space-remove-left-text" :class="(arrowTrue == 'year') ? 'arrowUp' : ''">
                        <select name="year" id="year" class="select-item input-info" v-model="workhistory_line.year"
                          :class="workhistory_line.isMouseLeaveYear?'mouseLeave':(workhistory_line.isMouseFocusYear?'input':'')"
                                v-on:change="hideValidarion(index)"
                          @click="inputFocus2('year',index)" @mouseleave="mouseLeaveInput2('year',index)" style="-webkit-appearance: none;">
                          <option value="" ></option>
                          <option value="1" :value="current_year" class="label_name">{{ current_year }}</option>
                          <option v-for="index in 75" :value="current_year - index" class="label_name" >{{ current_year - index }}</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="select-label"
                          :class="!workhistory_line.year?'unselected':((workhistory_line.isMouseLeaveYear && (workhistory_line.year!=0) || (!workhistory_line.isMouseFocusYear && (workhistory_line.year!=0)))?'mouseLeave_':'')">Year:</label>
                      </div>
                    </div>
                      </div>
                    </div>
                    <div class="row justify-content-center col-md-6 col-sm-12 group mr-2" style="padding-right:0px;padding-left:0px; margin-bottom: -7px;">
                      <div class="col-md-3 col-sm-12 workdate date-end">
                        <p style="font-family: Hind; font-size:15px; padding-left: 12px; color:#767676;" class="text-control-tabletscreen space-remove-mobile-control text-end">End Date*:</p>
                      </div>
                      <div class="row col-md-9 col-sm-12 padding-remvoe-end-mobile">
                          <div class="col-md-6 col-sm-12 inputP55">
                            <div class="select-arrow-side space-remove-left-text":class="(arrowTrue == 'month_') ? 'arrowUp' : ''">
                              <select name="month_" id="month_" class="select-item input-info" v-model="workhistory_line.month_"
                                      v-on:change="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeaveMonth_?'mouseLeave':(workhistory_line.isMouseFocusMonth_?'input':'')"
                                @click="inputFocus2('month_',index)"
                                @mouseleave="mouseLeaveInput2('month_',index)"
                                style="-webkit-appearance: none;">
                                <option value="" ></option>
                                <option value="13" class="label_name">Present</option>
                                <option value="1" class="label_name">Jan</option>
                                <option value="2" class="label_name">Feb</option>
                                <option value="3" class="label_name">Mar</option>
                                <option value="4" class="label_name">Apr</option>
                                <option value="5" class="label_name">May</option>
                                <option value="6" class="label_name">Jun</option>
                                <option value="7" class="label_name">Jul</option>
                                <option value="8" class="label_name">Aug</option>
                                <option value="9" class="label_name">Sep</option>
                                <option value="10" class="label_name">Oct</option>
                                <option value="11" class="label_name">Nov</option>
                                <option value="12" class="label_name">Dec</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label class="select-label"
                                :class="!workhistory_line.month_?'unselected':((workhistory_line.isMouseLeaveMonth_ && (workhistory_line.month_!=0) || (!workhistory_line.isMouseFocusMonth_ && (workhistory_line.month_!=0)))?'mouseLeave_':'')">Month:</label>
                            </div>
                          </div>
                          <div v-if="workhistory_line.month_ != '13'" class="col-md-6 col-sm-12 year inputP55 mb-mb-15" style="height:50px;">
                            <div class="select-arrow-side space-remove-left-text" :class="(arrowTrue == 'year_') ? 'arrowUp' : ''">
                              <select name="_" id="year_" class="select-item input-info" v-model="workhistory_line.year_"
                                      v-on:change="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeaveYear_?'mouseLeave':(workhistory_line.isMouseFocusYear_?'input':'')"
                                @click="inputFocus2('year_',index)" @mouseleave="mouseLeaveInput2('year_',index)" style="-webkit-appearance: none;">
                                <option value=""></option>
                                <option value="1" :value="current_year" class="label_name">{{ current_year }}</option>
                                <option v-for="index in 75" :value="current_year - index" class="label_name" >{{ current_year - index }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!workhistory_line.year_?'unselected':((workhistory_line.isMouseLeaveYear_ && (workhistory_line.year_!=0) || (!workhistory_line.isMouseFocusYear_ && (workhistory_line.year_!=0)))?'mouseLeave_':'')"
                              >Year:</label>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="confirm space-chek-and-del flex-btns-control" style="padding-bottom: 15px;">
                    <i
                      class="fa fa-2x fa fa-trash header-icon1 hover-icon-del"
                      v-if="workhistory_line.db_comp_id !== 0"
                      data-toggle="modal"
                      @click="save_delete_history(index)"
                      style="display: inline;   left: 45px; cursor:pointer;"
                    ></i>
                  <div class="tick-or-cross-btns">

                    <i
                      class="fa fa-times-circle hover-icon-work-history"
                      style="font-size:30px;color:#fb643e; right: 85px; cursor:pointer;"
                      @click="cancel(index)"
                    ></i>
                    <i
                      class="fa fa-check-circle hover-icon-work-history"
                      style="font-size:30px;color:#fb643e; right: 50px; cursor:pointer;"
                      @click="IsNext(workhistory_line.Company, workhistory_line.Position, workhistory_line.City,false,false,index)"
                    ></i>
                  </div>
                  </div>
                </slot>
              </div>
            </div>
          </transition>
        </div>
            <input type="hidden" v-model="current_index">
        <!-- end -->
        <button
          type="button"
          class="btn btn-block add_new_btn add-new-block add-new-button-box"
          @click="wh_IsNext(false,true,current_index)"
          style="    border: 3px solid rgb(230, 230, 230);
    color: rgb(200, 200, 200);
    padding: 11px 0px;
    font-size: 18px;
    border-radius: 6px;"
        >+ Add New  </button>
        <!--<p v-if="wh_error"
          class="text-danger text-center"
          style="margin-bottom: -10px;font-size: 14px;"
        >Please complete all of the required fields with the *</p>-->
        <p v-if="errors.length">
        <p v-for="error in errors" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;">{{ error }}</p>
        </p>
        <div class="text-center">
          <button class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right"  @click="wh_IsNext(true,false,current_index)">Next
            <!-- <span class style="margin-left:-14px">Next</span> -->
            <span class="pl-1">
              <i class="next-icon fas fa-chevron-right"></i>
            </span>
          </button>
        </div>
        <!-- </form> -->
      </div>
      </div>

      <!-- end resume-editor-div -->
      <!-- <page-workhistory></page-workhistory> -->
      <page-footer></page-footer>
    </div>
  </div>
</template>


<script>
import store from "../../store";
import InputSuggestion from "../input-suggestion.vue";
import twobuttonmodel from "../twobuttonmodel.vue";
import itemTemplate from "../item-template.vue";
import JQuery from "jquery";
let $ = JQuery;
import Vue from "vue";
import Button from "./Button.vue";
import { mapGetters } from "vuex";
import { environment_api } from "../../env";
import ContactSidebar from "./ContactSidebar.vue";

export default {
  name: "app",
  components: {
    twobuttonmodel,
    InputSuggestion,
    Button,
    ContactSidebar,
  },
  props: {
    field_position: {
      type: String,
      required: true,
    },
    field_positionclassification: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      p_height: 340,
      education_btn: false,
      EnvPath: environment_api.api_base_url,
      showposnextModal: false,
      showdelModal: false,
      errors: [],
      wh_error: false,
      placements: ["bottomleft"],
      item: {},
      items: [],
      current_index: 0,
      workhistory_lines: [],
      items_first: [],
      countries: [],
      states: [],
      itemTemplate,
      position_head: "New Position Details",
      current_year: 0,
      current_db_id: 0,
      page: 0,
      r_id: 0,
      arrowTrue: "",
      // searchText: "",
      // showList: false,
      // cursor: 0
    };
  },
  mounted() {
    store.commit("storeCurrentPage", 2);
    if (localStorage.getItem("education_btn")) {
      this.education_btn = true;
    }
    this.countries = this.getCountriesData;
    this.states = this.getStateData;
    // this.loadCountries();
    //this.workhistory_lines.country = '232';
    //this.workhistory_lines.prev_country = '232';
    // this.loadStates();
    this.get_current_year();
    this.load_work_history();
  },
  computed: {
    ...mapGetters(["getPageCount", "getStateData", "getCountriesData"]),
  },
  methods: {
        handlePositionClassification(index) {
            this.workhistory_lines[index].PositionClassificationID = '';
        },

    closeposnextModal() {
      this.showposnextModal = false;
    },
    proceedposnextModel() {
      //this.showposnextModal = false;
      var querystring = require("querystring");
      window.axios
        .post(
          this.EnvPath + "savepage",
          querystring.stringify({
            Page: 3,
          })
        )
        .then(({ data }) => {
          if (data.status == 1) {
            if (this.getPageCount < 3) {
              store.commit("storePageCount", 3);
              localStorage.setItem("pageCount", 3);
            }
            this.$router.push({ name: "WorkAdd" });
          }
        });
    },
    closedelModal() {
      this.showdelModal = false;
    },
    proceeddelModel() {
      this.delete_history(this.current_index);
      this.showdelModal = false;
      this.current_index = 0;
    },
    itemSelected23(value, arindex) {
      this.workhistory_lines[arindex].PositionClassification = value.name;
      this.workhistory_lines[arindex].PositionClassificationID = value.id;
      this.workhistory_lines[arindex].TitleID = value.titleid;
      this.$root.$emit("bv::hide::popover");
      this.hideValidarion(arindex);
    },
    convertHTMLEntity(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    },
    loads_position_classifications(search) {
      this.items = [];
      axios
        .get(this.EnvPath + "positions/" + search)
        .then(({ data }) => {
          if (data.status == 1) {
            store.commit("positionData", data.positions);
            this.items = [];
            for (let i = 0; i < this.$store.state.position_Data.length; i++) {
              this.items.push({
                id: this.$store.state.position_Data[i].id, //
                name: this.$store.state.position_Data[i].title,
                titleid: this.$store.state.position_Data[i].titleid,
                content: this.convertHTMLEntity(
                  this.$store.state.position_Data[i].pos_description
                ),
                suggestionGroup: this.$store.state.position_Data[i].id,
              });
            }
          }
        })
        .catch((error) => console.log(error));
    },
    load_work_history() {
      axios
        .get(this.EnvPath + "workhisory")
        .then(({ data }) => {
          if (data.status == 1) {
            store.commit("workHisory", data.jobs);
            for (let i = 0; i < this.$store.state.work_Hisory.length; i++) {
              this.workhistory_lines.push({
                position_head:
                  this.$store.state.work_Hisory[i].company +
                  ", " +
                  this.$store.state.work_Hisory[i].position,
                show: false,
                db_comp_id: this.$store.state.work_Hisory[i].id,
                Company: this.$store.state.work_Hisory[i].company,
                isMouseLeaveCompany: false,
                isMouseFocusCompany: false,
                Position: this.$store.state.work_Hisory[i].position,
                isMouseLeavePosition: false,
                isMouseFocusPosition: false,
                PositionClassification: this.$store.state.work_Hisory[i].title,
                PositionClassificationID:
                  this.$store.state.work_Hisory[i].position_id,
                TitleID: this.$store.state.work_Hisory[i].titleid,
                isMouseLeavePositionClassification: false,
                isMouseFocusPositionClassification: false,
                City: this.$store.state.work_Hisory[i].city,
                isMouseLeaveCity: false,
                isMouseFocusCity: false,
                showStateSelect:
                  this.$store.state.work_Hisory[i].country == "232" ? true : "",
                state: this.$store.state.work_Hisory[i].state,
                isMouseLeaveState: true,
                isMouseFocusState: false,
                showStateText:
                  this.$store.state.work_Hisory[i].country != "232" ? true : "",
                country: this.$store.state.work_Hisory[i].country,
                prev_country: this.$store.state.work_Hisory[i].country,
                isMouseLeaveCountry: false,
                isMouseFocusCountry: false,

                month: this.$store.state.work_Hisory[i].start_month,
                isMouseLeaveMonth: false,
                isMouseFocusMonth: false,

                year: this.$store.state.work_Hisory[i].start_year,
                isMouseLeaveYear: false,
                isMouseFocusYear: false,

                month_: this.$store.state.work_Hisory[i].end_month,
                isMouseLeaveMonth_: false,
                isMouseFocusMonth_: false,

                year_: this.$store.state.work_Hisory[i].end_year,
                isMouseLeaveYear_: false,
                isMouseFocusYear_: false,

                b4_Company: this.$store.state.work_Hisory[i].company,
                b4_Position: this.$store.state.work_Hisory[i].position,
                b4_PositionClassification:
                  this.$store.state.work_Hisory[i].title,
                b4_PositionClassificationID:
                  this.$store.state.work_Hisory[i].position_id,
                b4_City: this.$store.state.work_Hisory[i].city,
                b4_country: this.$store.state.work_Hisory[i].country,
                b4_state: this.$store.state.work_Hisory[i].state,
                b4_month: this.$store.state.work_Hisory[i].start_month,
                b4_year: this.$store.state.work_Hisory[i].start_year,
                b4_month_: this.$store.state.work_Hisory[i].end_month,
                b4_year_: this.$store.state.work_Hisory[i].end_year,
                pop_show: false,
              });
            }
            this.page = data.users[0].page;
            if (this.page == 3) {
              $("#aEdu").parent().removeClass("current-page");
              $("#aEdu").parent().addClass("resume-visited-page");
              $("#aEdu").attr("href", "/builder/contact/#/workadd");
            }
          } else {
            this.addLine();
          }
        })
        .catch((error) => console.log(error));
    },
    save_delete_history(index, db_id) {
      this.current_index = index;
      this.showdelModal = true;
    },
    delete_history(index) {
      if (localStorage.getItem("resume_id")) {
        this.r_id = localStorage.getItem("resume_id");
      }
      let db_id = this.workhistory_lines[index].db_comp_id;
      this.workhistory_lines.splice(index, 1);

      window.axios
        .delete(this.EnvPath + "workhisory", {
          data: {
            db_id: db_id,
            r_id: this.r_id,
          },
        })
        .then(({ data }) => {
          if (data.status == 1) {
            this.$toaster.success("Work History Remove Successfully");
          }
        });
    },
    showEditwh(show, index) {
      this.workhistory_lines.map(function (workhistory_line, line_index) {
        workhistory_line.show = false;
      });
      if (show) {
        this.workhistory_lines[index].show = false;
      } else {
        this.workhistory_lines[index].show = true;
      }
    },
    addLine: function () {
      let checkEmptyLines = this.workhistory_lines.filter(
        (line) => line.number === null
      );

      if (checkEmptyLines.length >= 1 && this.workhistory_lines.length > 0)
        return;

      this.workhistory_lines.push({
        position_head: "New Position Details",
        show: true,
        db_comp_id: 0,
        Company: "",
        isMouseLeaveCompany: false,
        isMouseFocusCompany: false,
        Position: "",
        isMouseLeavePosition: false,
        isMouseFocusPosition: false,
        PositionClassification: "",
        PositionClassificationID: "",
        TitleID: "",
        isMouseLeavePositionClassification: false,
        isMouseFocusPositionClassification: false,
        City: "",
        isMouseLeaveCity: false,
        isMouseFocusCity: false,
        showStateSelect: true,
        state: "",
        isMouseLeaveState: false,
        isMouseFocusState: false,
        showStateText: false,
        country: "232",
        prev_country: "232",
        isMouseLeaveCountry: false,
        isMouseFocusCountry: false,

        month: "",
        isMouseLeaveMonth: false,
        isMouseFocusMonth: false,

        year: "",
        isMouseLeaveYear: false,
        isMouseFocusYear: false,

        month_: "",
        isMouseLeaveMonth_: false,
        isMouseFocusMonth_: false,

        year_: "",
        isMouseLeaveYear_: false,
        isMouseFocusYear_: false,

        b4_Company: "",
        b4_Position: "",
        b4_PositionClassification: "",
        b4_PositionClassificationID: "",
        b4_City: "",
        b4_country: "232",
        b4_state: "",
        b4_month: 0,
        b4_year: 0,
        b4_month_: 0,
        b4_year_: 0,
        pop_show: false,
      });
      this.current_index = this.workhistory_lines.length - 1;
    },
    get_current_year: function () {
      var d = new Date();
      this.current_year = d.getFullYear();
    },
    hideStateSelect2: function (e, index) {
      if (e.target.value == "232") {
        this.workhistory_lines[index].showStateSelect = true;
        this.workhistory_lines[index].showStateText = false;
        this.workhistory_lines[index].prev_country = e.target.value;
      } else {
        if (this.workhistory_lines[index].prev_country == "232") {
          this.workhistory_lines[index].state = "";
        }
        this.workhistory_lines[index].showStateSelect = false;
        this.workhistory_lines[index].showStateText = true;
        this.workhistory_lines[index].prev_country = e.target.value;
        //this.state = '';
      }
    },
    // loadCountries() {
    //   axios.get('/countries').then(response => this.countries =response.data.countries).catch(error => console.log(error))
    // },
    // loadStates() {
    //   axios.get('/states').then(response => this.states =response.data.states).catch(error => console.log(error))
    // },
    itemSelected(item) {
      this.item = item;
    },
    setLabel(item) {
      return item.name;
    },
    inputChange(text) {
      console.log("text", text);
      if (text.length > 3) {
        this.loads_position_classifications(text);
      }
      this.PositionClassification = text;
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

    mouseLeaveInput2(inputName, index) {
      if (inputName === "Company") {
        this.workhistory_lines[index].isMouseLeaveCompany = true;
        this.workhistory_lines[index].isMouseFocusCompany = false;
      }
      if (inputName === "Position") {
        this.workhistory_lines[index].isMouseLeavePosition = true;
        this.workhistory_lines[index].isMouseFocusPosition = false;
      }
      if (inputName === "PositionClassification") {
        console.log('here');
        this.workhistory_lines[index].isMouseLeavePositionClassification = true;
        this.workhistory_lines[
          index
        ].isMouseFocusPositionClassification = false;
      }
      if (inputName === "city") {
        this.workhistory_lines[index].isMouseLeaveCity = true;
        this.workhistory_lines[index].isMouseFocusCity = false;
      }
      if (inputName === "state") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveState = true;
        this.workhistory_lines[index].isMouseFocusState = false;
      }
      if (inputName === "country") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveCountry = true;
        this.workhistory_lines[index].isMouseFocusCountry = false;
      }
      if (inputName === "month") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveMonth = true;
        this.workhistory_lines[index].isMouseFocusMonth = false;
      }
      if (inputName === "year") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveYear = true;
        this.workhistory_lines[index].isMouseFocusYear = false;
      }
      if (inputName === "month_") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveMonth_ = true;
        this.workhistory_lines[index].isMouseFocusMonth_ = false;
      }
      if (inputName === "year_") {
        this.arrowTrue = "";
        this.workhistory_lines[index].isMouseLeaveYear_ = true;
        this.workhistory_lines[index].isMouseFocusYear_ = false;
      }
    },
    hideValidarion(index) {
      if (this.wh_error) {
        if (
          this.workhistory_lines[index].Company != "" &&
          this.workhistory_lines[index].Position != "" &&
          this.workhistory_lines[index].PositionClassification != "" &&
          this.workhistory_lines[index].City != "" &&
          this.workhistory_lines[index].state != "" &&
          this.workhistory_lines[index].month != "" &&
          this.workhistory_lines[index].year != "" &&
          this.workhistory_lines[index].month_ != ""
        ) {
          if (this.workhistory_lines[index].month_ != "13") {
            if (this.workhistory_lines[index].year_ != "") {
              this.wh_error = false;
              this.errors = [];
            }
          } else {
            this.wh_error = false;
            this.errors = [];
          }
        }
      }
    },
    inputFocus21(inputName, index) {
      console.log('it is ');
      this.inputFocus2(inputName, index);
      this.workhistory_lines[index].pop_show = true;
    },
    inputFocus2(inputName, index) {
      if (inputName === "Company") {
        this.workhistory_lines[index].isMouseFocusCompany = true;
        this.workhistory_lines[index].isMouseLeaveCompany = false;
      }
      if (inputName === "Position") {
        this.workhistory_lines[index].isMouseFocusPosition = true;
        this.workhistory_lines[index].isMouseLeavePosition = false;
      }
      if (inputName === "PositionClassification") {
        this.loads_position_classifications(
          this.workhistory_lines[index].Position
        );
        this.workhistory_lines[
          index
        ].isMouseLeavePositionClassification = false;
        this.workhistory_lines[index].isMouseFocusPositionClassification = true;
      }
      if (inputName === "city") {
        this.workhistory_lines[index].isMouseLeaveCity = false;
        this.workhistory_lines[index].isMouseFocusCity = true;
      }
      if (inputName === "state") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveState = false;
        this.workhistory_lines[index].isMouseFocusState = true;
      }
      if (inputName === "country") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveCountry = false;
        this.workhistory_lines[index].isMouseFocusCountry = true;
      }
      if (inputName === "month") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveMonth = false;
        this.workhistory_lines[index].isMouseFocusMonth = true;
      }
      if (inputName === "year") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveYear = false;
        this.workhistory_lines[index].isMouseFocusYear = true;
      }
      if (inputName === "month_") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveMonth_ = false;
        this.workhistory_lines[index].isMouseFocusMonth_ = true;
      }
      if (inputName === "year_") {
        this.arrowTrue = inputName;
        this.workhistory_lines[index].isMouseLeaveYear_ = false;
        this.workhistory_lines[index].isMouseFocusYear_ = true;
      }
    },
    wh_IsNext(gotonext, addnew, current_index) {
      if (this.workhistory_lines[current_index] == null) {
        if (addnew) {
          this.addLine();
        } else {
          // Added this if in case customer chose to remove all work histories
          if (this.workhistory_lines.length == 0) {
            this.showposnextModal = true;
          }
        }
      } else {
        this.IsNext(
          this.workhistory_lines[current_index].Company,
          this.workhistory_lines[current_index].Position,
          this.workhistory_lines[current_index].City,
          gotonext,
          addnew,
          current_index
        );
      }
    },
    IsNext(Company, Position, City, gotonext, addnew, index) {
      if (
        Company != "" &&
        Position != "" &&
        this.workhistory_lines[index].PositionClassification != "" &&
        City != "" &&
        this.workhistory_lines[index].state != "" &&
        this.workhistory_lines[index].country != "" &&
        this.workhistory_lines[index].month != "" &&
        this.workhistory_lines[index].year != "" &&
        this.workhistory_lines[index].month_ != ""
      ) {
        let nodateerror = true;
        if (this.workhistory_lines[index].month_ != "13") {
          if (
            this.workhistory_lines[index].year >
            this.workhistory_lines[index].year_
          ) {
            console.log( this.workhistory_lines[index].year,' this.workhistory_lines[index].year');
            console.log( this.workhistory_lines[index].year_,' this.workhistory_lines[index].year_');
            if (
              this.workhistory_lines[index].month >
              this.workhistory_lines[index].month_
            ) {
              this.wh_error = true;
              this.errors = [];
              this.errors.push("The End Date must be after the Start Date");
              nodateerror = false;
            }
            if (
              this.workhistory_lines[index].year >
              this.workhistory_lines[index].year_
            ) {
              this.wh_error = true;
              this.errors = [];
              this.errors.push("The End Year must be after the Start Year");
              nodateerror = false;
            }

          } else if (
            this.workhistory_lines[index].year ==
            this.workhistory_lines[index].year_
          ) {
            if (
              this.workhistory_lines[index].month >
              this.workhistory_lines[index].month_
            ) {
              this.wh_error = true;
              this.errors = [];
              this.errors.push("The End Date must be after the Start Date");
              nodateerror = false;
            }
          }
        }
        if (nodateerror) {
          if (
            this.workhistory_lines[index].month_ != "13" &&
            this.workhistory_lines[index].year_ == ""
          ) {
            this.IsNext_f = false;
          } else {
            let state = this.workhistory_lines[index].state;
            let country = this.workhistory_lines[index].country;
            let PositionClassification = "";
            let PositionClassificationID =
              this.workhistory_lines[index].PositionClassificationID;
            let TitleID = this.workhistory_lines[index].TitleID;
            let page = this.page;
            if (gotonext) {
              page = 3;
            }
            var querystring = require("querystring");
            var self = this;
            window.axios
              .post(
                this.EnvPath + "workhisory",
                querystring.stringify({
                  Company: Company,
                  Position: Position,
                  PositionClassification: PositionClassification,
                  PositionClassificationID: PositionClassificationID,
                  TitleID: TitleID,
                  City: City,
                  State: state,
                  Country: country,
                  db_id: this.workhistory_lines[index].db_comp_id,
                  StartMonth: this.workhistory_lines[index].month,
                  StartYear: this.workhistory_lines[index].year,
                  EndMonth: this.workhistory_lines[index].month_,
                  EndYear: this.workhistory_lines[index].year_,
                  Page: page,
                })
              )
              .then(({ data }) => {
                if (data.status == 1) {
                  this.workhistory_lines[index].db_comp_id = data.db_id;
                  //this.IsNext_f = true;
                  if (gotonext) {
                    if (this.getPageCount < 3) {
                      store.commit("storePageCount", 3);
                      localStorage.setItem("pageCount", 3);
                    }
                    this.$router.push({ name: "WorkAdd" });
                  } else {
                    this.workhistory_lines[index].b4_Company = Company;
                    this.workhistory_lines[index].b4_Position = Position;
                    this.workhistory_lines[index].b4_PositionClassification =
                      PositionClassification;
                    this.workhistory_lines[index].b4_PositionClassificationID =
                      PositionClassificationID;
                    this.workhistory_lines[index].b4_City = City;
                    this.workhistory_lines[index].b4_country = country;
                    this.workhistory_lines[index].b4_state = state;
                    this.workhistory_lines[index].b4_month =
                      this.workhistory_lines[index].month;
                    this.workhistory_lines[index].b4_year =
                      this.workhistory_lines[index].year;
                    this.workhistory_lines[index].b4_month_ =
                      this.workhistory_lines[index].month_;
                    this.workhistory_lines[index].b4_year_ =
                      this.workhistory_lines[index].year_;

                    this.workhistory_lines[index].show = false;
                    this.workhistory_lines[index].position_head =
                      Company + ", " + Position;

                    if (addnew) {
                      this.addLine();
                    }
                  }
                  this.wh_error = false;
                  this.errors = [];
                } else {
                  this.wh_error = false;
                  this.errors = [];
                  //this.errors.push(data.message);
                }
                /*
        this.IsNext_f = true;
      this.$router.push({ name: "Store" });
         */
              })
              .catch(function (error) {
                self.errors = [];
                if (error.response.status === 422) {
                  var v_errors = error.response.data.errors;

                  // Loop through errors and handle them (e.g., display them on the form)
                  for (var key in v_errors) {
                    if (v_errors.hasOwnProperty(key)) {
                      self.errors.push(v_errors[key][0]);
                      break;
                    }
                  }
                } else {
                  self.errors.push("Unexpected error occurred.");
                }
              });
            //this.IsNext_f = true;
          }
        }
      } else {
        if (Company != "") {
          if (this.workhistory_lines[index].PositionClassification == "") {
            this.workhistory_lines[index].pop_show = true;
          } else {
            this.IsNext_f = false;
            this.wh_error = true;
            this.errors = [];
            this.errors.push(
              "Please complete all of the required fields with the *"
            );
          }
        } else {
          //if company also null then we can move to next page
          if (gotonext) {
            this.showposnextModal = true;
          } else {
            this.IsNext_f = false;
            this.wh_error = true;
            this.errors = [];
            this.errors.push(
              "Please complete all of the required fields with the *"
            );
          }
        }
      }
      document.getElementById("education-nav").removeAttribute("disabled");
      var contact = document.getElementById("workhistory");
      contact.classList.remove("active");
      contact.classList.remove("active1");
      var workhistory = document.getElementById("education");
      workhistory.classList.add("active");
      contact.classList.add("visited");
      workhistory.classList.remove("active1");
      this.education_btn = true;
      localStorage.setItem("education_btn", true);
    },
    toggle: function () {
      this.show = !this.show;
    },
    reloadPage() {
      //window.location.reload();
      this.Company = " isr";
    },
    cancel: function (index) {

      if (this.workhistory_lines[index].b4_Company != "") {
        this.workhistory_lines[index].show = false;
        this.workhistory_lines[index].Company =
          this.workhistory_lines[index].b4_Company;
        this.workhistory_lines[index].Position =
          this.workhistory_lines[index].b4_Position;
        // this.workhistory_lines[index].PositionClassification =
        //   this.workhistory_lines[index].b4_PositionClassification;
        this.workhistory_lines[index].PositionClassificationID =  this.workhistory_lines[index].b4_PositionClassificationID;
        this.workhistory_lines[index].City =
          this.workhistory_lines[index].b4_City;
        this.workhistory_lines[index].country =
          this.workhistory_lines[index].b4_country;
        this.workhistory_lines[index].state =
          this.workhistory_lines[index].b4_state;
        this.workhistory_lines[index].month =
          this.workhistory_lines[index].b4_month;
        this.workhistory_lines[index].year =
          this.workhistory_lines[index].b4_year;
        this.workhistory_lines[index].month_ =
          this.workhistory_lines[index].b4_month_;
        this.workhistory_lines[index].year_ =
          this.workhistory_lines[index].b4_year_;
      } else {
        this.workhistory_lines.splice(index, 1);
      }
      this.current_index = this.workhistory_lines.length - 1;
      this.wh_error = false;
      this.errors = [];
    },
    beforeEnter: function (el) {
      el.style.height = "0";
    },
    enter: function (el) {
      el.style.height = el.scrollHeight + "px";
    },
    beforeLeave: function (el) {
      el.style.height = el.scrollHeight + "px";
    },
    leave: function (el) {
      el.style.height = "0";
    },
  },
  created() {
    this.items_first = this.items;
  },
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
  padding-left: 0 !important;
}

.space-chek-and-del {
  padding-top: 30px !important;
}
.unselected {
  font-size: 15px !important;
  color: #999 !important;
}

.spce-adjsut-on-acordin-column {
  padding-left: 10px;
  padding-right: 10px;
  margin-bottom: 18px;
  margin-top: 25px;
}

.space-adjust-feilds {
  padding-left: 10px;
  padding-right: 10px;
  margin-bottom: 18px;
}

@media (max-width: 768px) {
  .space-adjust-feilds {
    margin-bottom: 0;
  }
  .mb-0-mobile {
    margin-bottom: 0 !important;
  }
  .padding-remvoe-end-mobile {
    padding-right: 0 !important;
  }
}
</style>


<style>
@media (max-width: 450px) {
  .pop-content-section.pop_confused_content .col-8 h4 {
    line-height: 1.2;
  }
  .mobile-text-heading-height-control {
    height: 42px !important;
  }
  .popup-align-box
    .pop-content-section.pop_confused_content.space-control-on-mobile {
    top: 79%;
    transform: translateY(-50%);
    position: absolute;
  }

  .resume-editor-div.card-height-control-box.space-control-mobile-wrokhistory {
    margin-bottom: 20px !important;
  }
  p.text-control-tabletscreen.space-remove-mobile {
    padding-left: 0 !important;
  }
  .section-height-footer
    .resume-editor-div.card-height-control-box.space-control-mobile-wrokhistory
    .pop-content-section.pop_confused_content.space-control-on-mobile {
    left: 7.5% !important;
  }
  p.text-control-tabletscreen.space-remove-mobile-control {
    padding-left: 0 !important;
  }
  .select-arrow-side.space-remove-left-text .input-info {
    margin-bottom: 20px !important;
  }

  .col-md-3.col-sm-12.workdate.mobile-text-heading-height-control p {
    justify-content: start !important;
    padding-left: 0 !important;
  }

  .select-arrow-side.space-remove-left-text {
    width: 99% !important;
    margin-left: 8px !important;
  }
}

.select-arrow-side.space-remove-left-text .select-label {
  padding-left: 0 !important;
}

@media (max-width: 993px) {
  .resume-editor-div.card-height-control-box.space-control-mobile-wrokhistory
    .pop-content-section.pop_confused_content.space-control-on-mobile {
    left: 56% !important;
  }
}

@media (max-width: 330px) {
  .row.col-md-9.col-sm-12.padding-remvoe-end-mobile.padding-left-remove-in-tablet,
  .row.col-md-9.col-sm-12.padding-remvoe-end-mobile {
    margin-right: -26px !important;
  }
  .select-arrow-side.space-remove-left-text {
    margin-left: 0 !important;
  }
}

.col-md-3.col-sm-12.workdate.mobile-text-heading-height-control p {
  justify-content: center;
  display: flex !important;
  padding-left: 5px;
}

.select-arrow-side.arrowUp .red-label-color {
  color: #fb643e !important;
}
</style>
