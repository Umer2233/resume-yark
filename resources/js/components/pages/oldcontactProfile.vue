<template>
  <div class="row">
    <div class="col-md-2">
      <div class="sidebar1">
        <ul class="vertical-center">
          <li class="visited-page">
            <a href="/builder/contact/#/new"><i class="fas fa-phone-volume" style="background:#CCCCCC;"></i> Contact Info</a>
          </li>
          <li style="">
            <i class="fas fa-briefcase" ></i> Work History
          </li>
          <li v-if="parseInt(page) > 2" class="visited-page">
            <a href="/builder/contact/#/workadd"><i class="fas fa-book-open" style="background:#CCCCCC"></i> Education</a>
          </li>
          <li v-else class="w3-opacity-max" style="color:black; margin-right: 19px; ">
            <i class="fas fa-book-open" style="background: black;opacity: 0.3;"></i> Education
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-10 grid-container">
      <div class="resume-editor-div">
        <h2 class="mt-4">
          <span class="icon">
            <i class="fas fa-briefcase"></i>
          </span>
          Work History
        </h2>

              <twobuttonmodel
                popupHeight="340"
                popupTitle="Are You Sure?"
                popupText="It looks like you haven't entered any work history. You might consider adding unpaid volunteer work (raising children) or other opportunities that provided experiences that may be relevant to the positions you may apply for."
                v-if="showposnextModal"
                @close="closeposnextModal"
                @proceed="proceedposnextModel"
              ></twobuttonmodel>

              <twobuttonmodel
                popupTitle="Are you Sure You Want to Delete?"
                popupText="I'm sure you worked hard for this position. Are you sure you just want to throw it away with the click of a button?"
                v-if="showdelModal"
                @close="closedelModal"
                @proceed="proceeddelModel"
              ></twobuttonmodel>


              <div
                v-for="(workhistory_line,index) in workhistory_lines"
                v-bind:key="index"
                class="accordion purple"
              >
                <div @click="showEditwh(workhistory_line.show,index)" class="header">
                  <slot name="header">
                    <div
                      slot="header"
                      style="font-family:'Hind', sans-serif; font-size: 18px; color: #767676;padding-top:2px"
                    >
                      <strong v-html="workhistory_line.position_head"></strong>
                    </div>
                  </slot>
                  <i
                    class="fa fa-2x fa-chevron-down header-icon"
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
            <div class="body" v-show="workhistory_line.show">
              <div class="body-inner">
                <slot>
                  <!-- Contact Form -->
                  <!-- <form class="mt-3 contact-form"> -->
                  <div class="row justify-content-center" style="padding-left: 10px;padding-right: 10px; margin-bottom:18px;margin-top:11px;">
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;margin-top: 3px;">
                      <div class>
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
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px; margin-top: 3px;">
                      <div class>
                        <input maxlength="70" v-on:blur="mouseLeaveInput2('Position',index)" type="text" v-model="workhistory_line.Position" class="input-info"
                               v-on:keyup="hideValidarion(index)"
                               :class="workhistory_line.isMouseLeavePosition?'mouseLeave':(workhistory_line.isMouseFocusPosition?'input':'')"
                          @click="inputFocus2('Position',index)"
                          @mouseleave="mouseLeaveInput2('Position',index)"
                          style="padding-right:40px"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name" :class="(workhistory_line.isMouseLeavePosition && (workhistory_line.Position!='') || (!workhistory_line.isMouseFocusPosition && (workhistory_line.Position!='')))?'mouseLeave_':''">Position*:</label>
                      </div>
                      <span>
                        <img :src="EnvPath+'images/bg/help.png'"
                          alt
                          class="small_logo"
                          v-tooltip="field_position"
                        />
                      </span>
                    </div>
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;margin-top: 3px;">
                      <div class>
                        <input type="hidden"
                        :id="'hdnPosClass-' + index"
                        v-model="workhistory_line.PositionClassificationID" />
                        <input type="hidden"
                               :id="'hdnTitle-' + index"
                               v-model="workhistory_line.TitleID"
                        />
                        <input ref="'popover_' + index" v-on:blur="mouseLeaveInput2('PositionClassification',index)"
                               :id="'popover-' + index"
                               type="text"
                               v-model="workhistory_line.PositionClassification"
                               class="input-info"
                          :class="workhistory_line.isMouseLeavePositionClassification?'mouseLeave':(workhistory_line.isMouseFocusPositionClassification?'input':'')"
                               v-on:keyup.tab="inputFocus21('PositionClassification',index)"
                               @click="inputFocus2('PositionClassification',index)"
                          @mouseleave="mouseLeaveInput2('PositionClassification',index)"
                          autocomplete="off"
                               style="padding-right:40px"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name" :class="(workhistory_line.isMouseLeavePositionClassification && (workhistory_line.PositionClassification!='') || (!workhistory_line.isMouseFocusPositionClassification && (workhistory_line.PositionClassification!='')))?'mouseLeave_':''">Position Classification:</label>
                      </div>
                      <span>
                        <img :src="EnvPath+'images/bg/help.png'" alt class="small_logo"
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

                  <div class="row justify-content-center" style="padding-left: 10px;padding-right: 10px; margin-bottom:18px;">
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
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
                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                      <div class v-if="workhistory_line.showStateSelect  != ''">
                        <select name="state" id="state" class="select-item input-info" v-model="workhistory_line.state"
                                v-on:change="hideValidarion(index)"
                          :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')"
                          @click="inputFocus2('state',index)" @mouseleave="mouseLeaveInput2('state',index)" style="-webkit-appearance: none;">
                          <option value></option>
                          <option v-for="(state,index) in states" :value="index">{{ state }}</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label
                          class="select-label"
                          :class="!workhistory_line.state?'unselected':((workhistory_line.isMouseLeaveState && (workhistory_line.state!=0) || (!workhistory_line.isMouseFocusState && (workhistory_line.state!=0)))?'mouseLeave_':'')"
                        >State*:</label>
                      </div>
                      <div class v-if="workhistory_line.showStateText != ''">
                        <input :maxlength="255" v-on:blur="mouseLeaveInput2('state',index)" type="text" v-model="workhistory_line.state" class="input" :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')" @click="inputFocus2('state',index)"
                               v-on:keyup="hideValidarion(index)"
                               @mouseleave="mouseLeaveInput2('state',index)"/>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>
                        <label class="label_name" :class="(workhistory_line.isMouseLeaveState && workhistory_line.state!='') ?'mouseleavefill':''">State*:</label>
                      </div>
                    </div>

                    <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                      <div class>
                        <select name="country" id="country" class="select-item input-info" v-model="workhistory_line.country"
                                :class="workhistory_line.isMouseLeaveCountry?'mouseLeave':(workhistory_line.isMouseFocusCountry?'input':'')"
                                @click="inputFocus2('country',index)" @mouseleave="mouseLeaveInput2('country',index)" @change="hideStateSelect2($event,index)" style="-webkit-appearance: none;">
                          <option v-for="(country,index) in countries" :value="index" >{{ country }}</option>
                        </select>
                        <!-- <span class="highlight"></span> -->
                        <span class="bar"></span>

                      </div>
                    </div>
                  </div>
                  <!-- end .row -->

                  <div class="row justify-content-center">
                    <div class="row justify-content-center col-md-6 col-sm-12 group mr-2"
                      style="padding-right:0px;padding-left:0px; margin-bottom: -7px;">
                      <div class="col-md-3 col-sm-3 workdate">
                        <p style="font-family: Hind; font-size:15px; color:#767676; align-items:center">Start Date*:</p>
                      </div>
                      <div class="row col-md-9 col-sm-9">
                        <div class="col-md-6 col-sm-6 inputP55">
                          <div class>
                            <select name="month" id="month" class="select-item input-info" v-model="workhistory_line.month"
                              :class="workhistory_line.isMouseLeaveMonth?'mouseLeave':(workhistory_line.isMouseFocusMonth?'input':'')"
                                    v-on:change="hideValidarion(index)"
                              @click="inputFocus2('month',index)" @mouseleave="mouseLeaveInput2('month',index)" style="-webkit-appearance: none;">
                              <option value="" ></option>
                              <option value="1" class="label_name">January</option>
                              <option value="2" class="label_name">February</option>
                              <option value="3" class="label_name">March</option>
                              <option value="4" class="label_name">April</option>
                              <option value="5" class="label_name">May</option>
                              <option value="6" class="label_name">June</option>
                              <option value="7" class="label_name">July</option>
                              <option value="8" class="label_name">August</option>
                              <option value="9" class="label_name">September</option>
                              <option value="10" class="label_name">October</option>
                              <option value="11" class="label_name">November</option>
                              <option value="12" class="label_name">December</option>
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
                        <div class="col-md-6 col-sm-6 year inputP55" style="height:50px">
                      <div class>
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
                      <div class="col-md-3 col-sm-3 workdate" style="padding-left:30px !important;">
                        <p style="font-family: Hind; font-size:15px; color:#767676;">End Date*:</p>
                      </div>
                      <div class="row col-md-9 col-sm-9">
                          <div class="col-md-6 col-sm-6 inputP55">

                            <div class>
                              <input
                                v-on:blur="mouseLeaveInput2('Company',index)"
                                type="text"
                                v-model="workhistory_line.Company"
                                class="input-info"
                                v-on:keyup="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeaveCompany?'mouseLeave':(workhistory_line.isMouseFocusCompany?'input':'')"
                                @click="inputFocus2('Company',index)"
                                @mouseleave="mouseLeaveInput2('Company',index)"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(workhistory_line.isMouseLeaveCompany && (workhistory_line.Company!='') || (!workhistory_line.isMouseFocusCompany && (workhistory_line.Company!='')))?'mouseLeave_':''"
                            </div>
                          </div>
                          <div
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px; margin-top: 3px;"
                          >
                            <div class>
                              <input
                                v-on:blur="mouseLeaveInput2('Position',index)"
                                type="text"
                                v-model="workhistory_line.Position"
                                class="input-info"
                                v-on:keyup="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeavePosition?'mouseLeave':(workhistory_line.isMouseFocusPosition?'input':'')"
                                @click="inputFocus2('Position',index)"
                                @mouseleave="mouseLeaveInput2('Position',index)"
                                style="padding-right:40px"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(workhistory_line.isMouseLeavePosition && (workhistory_line.Position!='') || (!workhistory_line.isMouseFocusPosition && (workhistory_line.Position!='')))?'mouseLeave_':''"
                              >Position*:</label>
                            </div>
                            <span>
                              <img
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_position"
                              />
                            </span>
                          </div>
                          <div
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px;margin-top: 3px;"
                          >
                            <div class>
                              <input
                                type="hidden"
                                :id="'hdnPosClass-' + index"
                                v-model="workhistory_line.PositionClassificationID"
                              />
                              <input
                                type="hidden"
                                :id="'hdnTitle-' + index"
                                v-model="workhistory_line.TitleID"
                              />
                              <input
                                ref="'popover_' + index"
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
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(workhistory_line.isMouseLeavePositionClassification && (workhistory_line.PositionClassification!='') || (!workhistory_line.isMouseFocusPositionClassification && (workhistory_line.PositionClassification!='')))?'mouseLeave_':''"
                              >Position Classification:</label>
                            </div>
                            <span>
                              <img
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_positionclassification"
                              />
                            </span>
                          </div>
                          <b-popover
                            :show.sync="workhistory_line.pop_show"
                            :target="'popover-' + index"
                            placement="bottom"
                          >
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

                        <div
                          class="row justify-content-center"
                          style="padding-left: 10px;padding-right: 10px;"
                        >
                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class>
                              <input
                                v-on:blur="mouseLeaveInput2('city',index)"
                                type="text"
                                v-model="workhistory_line.City"
                                class="input-info"
                                v-on:keyup="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeaveCity?'mouseLeave':(workhistory_line.isMouseFocusCity?'input':'')"
                                @click="inputFocus2('city',index)"
                                @mouseleave="mouseLeaveInput2('city',index)"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(workhistory_line.isMouseLeaveCity && (workhistory_line.City!='') || (!workhistory_line.isMouseFocusCity && (workhistory_line.City!='')))?'mouseLeave_':''"
                              >City*:</label>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class v-if="workhistory_line.showStateSelect  != ''">
                              <select
                                name="state"
                                id="state"
                                class="select-item input-info"
                                v-model="workhistory_line.state"
                                v-on:change="hideValidarion(index)"
                                :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')"
                                @click="inputFocus2('state',index)"
                                @mouseleave="mouseLeaveInput2('state',index)"
                                style="-webkit-appearance: none;"
                              >
                                <option value></option>
                                <option
                                  v-for="(state,index) in states"
                                  :key="index"
                                  :value="index"
                                >{{ state }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!workhistory_line.state?'unselected':((workhistory_line.isMouseLeaveState && (workhistory_line.state!=0) || (!workhistory_line.isMouseFocusState && (workhistory_line.state!=0)))?'mouseLeave_':'')"
                              >State*:</label>
                            </div>
                            <div class v-if="workhistory_line.showStateText != ''">
                              <input
                                :maxlength="255"
                                v-on:blur="mouseLeaveInput2('state',index)"
                                type="text"
                                v-model="workhistory_line.state"
                                class="input"
                                :class="workhistory_line.isMouseLeaveState?'mouseLeave':(workhistory_line.isMouseFocusState?'input':'')"
                                @click="inputFocus2('state',index)"
                                v-on:keyup="hideValidarion(index)"
                                @mouseleave="mouseLeaveInput2('state',index)"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(workhistory_line.isMouseLeaveState && workhistory_line.state!='') ?'mouseleavefill':''"
                              >State*:</label>
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class>
                              <select
                                name="country"
                                id="country"
                                class="select-item input-info"
                                v-model="workhistory_line.country"
                                :class="workhistory_line.isMouseLeaveCountry?'mouseLeave':(workhistory_line.isMouseFocusCountry?'input':'')"
                                @click="inputFocus2('country',index)"
                                @mouseleave="mouseLeaveInput2('country',index)"
                                @change="hideStateSelect2($event,index)"
                                style="-webkit-appearance: none;"
                              >
                                <option
                                  v-for="(country,index) in countries"
                                  :key="index"
                                  :value="index"
                                >{{ country }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!workhistory_line.country?'unselected':((workhistory_line.isMouseLeaveCountry && (workhistory_line.country!=0) || (!workhistory_line.isMouseFocusCountry && (workhistory_line.country!=0)))?'mouseLeave_':'')"
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
                            <div class="col-md-3 col-sm-3 workdate">
                              <p
                                style="font-family: Hind; font-size:15px; color:#767676; align-items:center"
                              >Start Date*:</p>
                            </div>
                            <div class="row col-md-9 col-sm-9">
                              <div class="col-md-6 col-sm-6 inputP55">
                                <div class>
                                  <select
                                    name="month"
                                    id="month"
                                    class="select-item input-info"
                                    v-model="workhistory_line.month"
                                    :class="workhistory_line.isMouseLeaveMonth?'mouseLeave':(workhistory_line.isMouseFocusMonth?'input':'')"
                                    v-on:change="hideValidarion(index)"
                                    @click="inputFocus2('month',index)"
                                    @mouseleave="mouseLeaveInput2('month',index)"
                                    style="-webkit-appearance: none;"
                                  >
                                    <option value></option>
                                    <option value="1" class="label_name">January</option>
                                    <option value="2" class="label_name">February</option>
                                    <option value="3" class="label_name">March</option>
                                    <option value="4" class="label_name">April</option>
                                    <option value="5" class="label_name">May</option>
                                    <option value="6" class="label_name">June</option>
                                    <option value="7" class="label_name">July</option>
                                    <option value="8" class="label_name">August</option>
                                    <option value="9" class="label_name">September</option>
                                    <option value="10" class="label_name">October</option>
                                    <option value="11" class="label_name">November</option>
                                    <option value="12" class="label_name">December</option>
                                  </select>
                                  <!-- <span class="highlight"></span> -->
                                  <span class="bar"></span>
                                  <label
                                    class="select-label"
                                    :class="!workhistory_line.month?'unselected':((workhistory_line.isMouseLeaveMonth && (workhistory_line.month!=0) || (!workhistory_line.isMouseFocusMonth && (workhistory_line.month!=0)))?'mouseLeave_':'')"
                                  >Month:</label>
                                </div>
                              </div>
                              <div class="col-md-6 col-sm-6 year inputP55" style="height:50px">
                                <div class>
                                  <select
                                    name="year"
                                    id="year"
                                    class="select-item input-info"
                                    v-model="workhistory_line.year"
                                    :class="workhistory_line.isMouseLeaveYear?'mouseLeave':(workhistory_line.isMouseFocusYear?'input':'')"
                                    v-on:change="hideValidarion(index)"
                                    @click="inputFocus2('year',index)"
                                    @mouseleave="mouseLeaveInput2('year',index)"
                                    style="-webkit-appearance: none;"
                                  >
                                    <option value></option>
                                    <option
                                      value="1"
                                      :value="current_year"
                                      class="label_name"
                                    >{{ current_year }}</option>
                                    <option
                                      v-for="index in 75"
                                      :value="current_year - index"
                                      class="label_name"
                                    >{{ current_year - index }}</option>
                                  </select>
                                  <!-- <span class="highlight"></span> -->
                                  <span class="bar"></span>
                                  <label
                                    class="select-label"
                                    :class="!workhistory_line.year?'unselected':((workhistory_line.isMouseLeaveYear && (workhistory_line.year!=0) || (!workhistory_line.isMouseFocusYear && (workhistory_line.year!=0)))?'mouseLeave_':'')"
                                  >Year:</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="row justify-content-center col-md-6 col-sm-12 group mr-2"
                            style="padding-right:0px;padding-left:0px; margin-bottom: -7px;"
                          >
                            <div
                              class="col-md-3 col-sm-3 workdate"
                              style="padding-left:30px !important;"
                            >
                              <p
                                style="font-family: Hind; font-size:15px; color:#767676;"
                              >End Date*:</p>
                            </div>
                            <div class="row col-md-9 col-sm-9">
                              <div class="col-md-6 col-sm-6 inputP55">
                                <div class>
                                  <select
                                    name="month_"
                                    id="month_"
                                    class="select-item input-info"
                                    v-model="workhistory_line.month_"
                                    v-on:change="hideValidarion(index)"
                                    :class="workhistory_line.isMouseLeaveMonth_?'mouseLeave':(workhistory_line.isMouseFocusMonth_?'input':'')"
                                    @click="inputFocus2('month_',index)"
                                    @mouseleave="mouseLeaveInput2('month_',index)"
                                    style="-webkit-appearance: none;"
                                  >
                                    <option value></option>
                                    <option value="13" class="label_name">Present</option>
                                    <option value="1" class="label_name">January</option>
                                    <option value="2" class="label_name">February</option>
                                    <option value="3" class="label_name">March</option>
                                    <option value="4" class="label_name">April</option>
                                    <option value="5" class="label_name">May</option>
                                    <option value="6" class="label_name">June</option>
                                    <option value="7" class="label_name">July</option>
                                    <option value="8" class="label_name">August</option>
                                    <option value="9" class="label_name">September</option>
                                    <option value="10" class="label_name">October</option>
                                    <option value="11" class="label_name">November</option>
                                    <option value="12" class="label_name">December</option>
                                  </select>
                                  <!-- <span class="highlight"></span> -->
                                  <span class="bar"></span>
                                  <label
                                    class="select-label"
                                    :class="!workhistory_line.month_?'unselected':((workhistory_line.isMouseLeaveMonth_ && (workhistory_line.month_!=0) || (!workhistory_line.isMouseFocusMonth_ && (workhistory_line.month_!=0)))?'mouseLeave_':'')"
                                  >Month:</label>
                                </div>
                              </div>
                              <div
                                v-if="workhistory_line.month_ != '13'"
                                class="col-md-6 col-sm-6 year inputP55"
                                style="height:50px;"
                              >
                                <div class>
                                  <select
                                    name="_"
                                    id="year_"
                                    class="select-item input-info"
                                    v-model="workhistory_line.year_"
                                    v-on:change="hideValidarion(index)"
                                    :class="workhistory_line.isMouseLeaveYear_?'mouseLeave':(workhistory_line.isMouseFocusYear_?'input':'')"
                                    @click="inputFocus2('year_',index)"
                                    @mouseleave="mouseLeaveInput2('year_',index)"
                                    style="-webkit-appearance: none;"
                                  >
                                    <option value></option>
                                    <option
                                      value="1"
                                      :value="current_year"
                                      class="label_name"
                                    >{{ current_year }}</option>
                                    <option
                                      v-for="index in 75"
                                      :value="current_year - index"
                                      class="label_name"
                                    >{{ current_year - index }}</option>
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
                        <div class="confirm" style="margin-bottom: 32px;margin-top: -4px;">
                          <i
                            class="fa fa-2x fa fa-trash header-icon1"
                            v-if="workhistory_line.db_comp_id !== 0"
                            data-toggle="modal"
                            @click="save_delete_history(index)"
                            style="display: inline; position: absolute; left: 45px; cursor:pointer;"
                          ></i>
                          <i
                            class="fa fa-times-circle"
                            style="font-size:30px;color:#fb643e;position: absolute;right: 85px; cursor:pointer;"
                            @click="cancel(index)"
                          ></i>
                          <i
                            class="fa fa-check-circle"
                            style="font-size:30px;color:#fb643e;position: absolute;right: 50px; cursor:pointer;"
                            @click="IsNext(workhistory_line.Company, workhistory_line.Position, workhistory_line.City,false,false,index)"
                          ></i>
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
          class="btn btn-block"
          @click="wh_IsNext(false,true,current_index)"
          style="border: 3px solid #f4f4f5;color: #dfdfdf; padding: 11px 0px; font-size:18px;border-radius:6px"
        >+ Add New </button>
        <!--<p v-if="wh_error"
          class="text-danger text-center"
          style="margin-bottom: -10px;font-size: 14px;"
        >Please complete all of the required fields with the *</p>-->
        <p v-if="errors.length">
        <p v-for="error in errors" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;">{{ error }}</p>
        </p>
        <div class="text-center">
          <button class="btn1 btn-rounded btn-next mt-4 btn-text-arrow-right" style="padding-bottom:0px;" @click="wh_IsNext(true,false,current_index)">
            <span class style="margin-left:-14px">Next</span>
            <span class="pl-1">
              <i class="next-icon fas fa-chevron-right"></i>
            </span>
          </button>
        </div>
        <!-- </form> -->
      </div>

            <!-- end resume-editor-div -->
            <!-- <page-workhistory></page-workhistory> -->
            <page-footer></page-footer>
          </div>
        </div>
      </div>
    </section>
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
import { environment_api } from "../../env";
import headernav from "./header_nav";
import lhsMenu from "./lhsMenu";

export default {
  name: "app",
  components: {
    twobuttonmodel,
    InputSuggestion,
    Button,
    headernav,
    lhsMenu,
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
      EnvPath: environment_api.api_url,
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
      page: 2,
      isLoggedIn: this.$store.state.isLoggedIn,
      // searchText: "",
      // showList: false,
      // cursor: 0
    };
  },
  mounted() {
    if (this.$store.state.contact_Data.first_name == "") {
      this.loadContact();
    }

    this.countries = this.$store.state.countriesData;
    this.states = this.$store.state.statesData;
    // this.loadCountries();
    //this.workhistory_lines.country = '232';
    //this.workhistory_lines.prev_country = '232';
    // this.loadStates();
    this.get_current_year();
    this.load_work_history();
    //this.addLine();
    //console.log(this.workhistory_lines);
  },
  methods: {
    loadContact() {
      axios.get(this.EnvPath + "getcontact").then(({ data }) => {
        //console.log(data.jobs);
        if (data.status == 1) {
          store.commit("contactData", data);
          if (this.$store.state.contact_Data.first_name != "") {
            this.FirstName = this.$store.state.contact_Data.first_name;
            this.FirstName_ = this.$store.state.contact_Data.first_name;
            this.isMouseLeaveFirstName = true;
          }
          this.Middle = this.Middle_ =
            this.$store.state.contact_Data.middle_initial;
          this.isMouseLeaveMiddle = true;
          this.LastName = this.LastName_ =
            this.$store.state.contact_Data.last_name;
          this.isMouseLeaveLastName = true;
          this.StreetAddress = this.StreetAddress_ =
            this.$store.state.contact_Data.street_address;
          this.isMouseLeaveStreetAddress = true;
          this.City = this.City_ = this.$store.state.contact_Data.city;
          this.isMouseLeaveCity = true;
          this.state = this.state_ = this.$store.state.contact_Data.state;
          this.isMouseLeaveState = true;
          this.country = this.country_ = this.$store.state.contact_Data.country;
          this.isMouseLeaveCountry = true;
          this.PostalCode = this.PostalCode_ =
            this.$store.state.contact_Data.postal_code;
          this.isMouseLeavePostalCode = true;
          this.Phone = this.Phone_ = this.$store.state.contact_Data.phone;
          this.isMouseLeavePhone = true;
          this.EmailAddress = this.EmailAddress_ =
            this.$store.state.contact_Data.email;
          this.isMouseLeaveEmailAddress = true;
          this.page = this.$store.state.contact_Data.page;
          if (this.$store.state.contact_Data.professional_profile != "") {
            this.Profile = this.Profile_ =
              this.$store.state.contact_Data.professional_profile;
            this.isMouseLeaveProfile = true;
          }
          if (this.$store.state.contact_Data.website != "") {
            this.Website = this.Website_ =
              this.$store.state.contact_Data.website;
            this.isMouseLeaveWebsite = true;
          }
          this.revisit = true;
          if (this.$store.state.contact_Data.state == "232") {
            this.showStateSelect = true;
            this.showStateText = false;
          } else {
            this.showStateSelect = false;
            this.showStateText = true;
          }
        } else {
          // console.log(data);
        }
      });
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
      //console.log(value);
      //console.log(arindex);
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
            console.log(this.items);
          }
        })
        .catch((error) => console.log(error));
    },
    load_work_history() {
      axios
        .get(this.EnvPath + "workhisory")
        .then(({ data }) => {
          console.log("data.jobs1", data.status);
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
            console.log(this.workhistory_lines);
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
      let db_id = this.workhistory_lines[index].db_comp_id;
      this.workhistory_lines.splice(index, 1);

      window.axios
        .delete("/workhisory", {
          data: {
            db_id: db_id,
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
      console.log(text);
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
        this.workhistory_lines[index].isMouseLeaveState = true;
        this.workhistory_lines[index].isMouseFocusState = false;
      }
      if (inputName === "country") {
        this.workhistory_lines[index].isMouseLeaveCountry = true;
        this.workhistory_lines[index].isMouseFocusCountry = false;
      }
      if (inputName === "month") {
        this.workhistory_lines[index].isMouseLeaveMonth = true;
        this.workhistory_lines[index].isMouseFocusMonth = false;
      }
      if (inputName === "year") {
        this.workhistory_lines[index].isMouseLeaveYear = true;
        this.workhistory_lines[index].isMouseFocusYear = false;
      }
      if (inputName === "month_") {
        this.workhistory_lines[index].isMouseLeaveMonth_ = true;
        this.workhistory_lines[index].isMouseFocusMonth_ = false;
      }
      if (inputName === "year_") {
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
        this.workhistory_lines[index].isMouseLeaveState = false;
        this.workhistory_lines[index].isMouseFocusState = true;
      }
      if (inputName === "country") {
        this.workhistory_lines[index].isMouseLeaveCountry = false;
        this.workhistory_lines[index].isMouseFocusCountry = true;
      }
      if (inputName === "month") {
        this.workhistory_lines[index].isMouseLeaveMonth = false;
        this.workhistory_lines[index].isMouseFocusMonth = true;
      }
      if (inputName === "year") {
        this.workhistory_lines[index].isMouseLeaveYear = false;
        this.workhistory_lines[index].isMouseFocusYear = true;
      }
      if (inputName === "month_") {
        this.workhistory_lines[index].isMouseLeaveMonth_ = false;
        this.workhistory_lines[index].isMouseFocusMonth_ = true;
      }
      if (inputName === "year_") {
        this.workhistory_lines[index].isMouseLeaveYear_ = false;
        this.workhistory_lines[index].isMouseFocusYear_ = true;
      }
    },
    wh_IsNext(gotonext, addnew, current_index) {
      if (this.workhistory_lines[current_index] == null) {
        if (addnew) {
          this.addLine();
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
      /*
      if (addnew) {
        if(!this.wh_error) {
          this.addLine();
        }
      }
      */
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
            this.wh_error = true;
            this.errors = [];
            this.errors.push("The End Date must be after the Start Date");
            nodateerror = false;
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
                //console.log(data);
                /*
        this.IsNext_f = true;
      this.$router.push({ name: "Store" });
         */
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
        this.workhistory_lines[index].PositionClassification =
          this.workhistory_lines[index].b4_PositionClassification;
        this.workhistory_lines[index].PositionClassificationID =
          this.workhistory_lines[index].b4_PositionClassificationID;
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
  padding-left: 10px !important;
}

.unselected {
  font-size: 15px !important;
  color: #999 !important;
}
</style>
