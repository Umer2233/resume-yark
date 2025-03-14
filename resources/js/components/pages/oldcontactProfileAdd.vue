<template>
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar1">
                <ul class="vertical-center">
                  <li class="visited-page">
                  <a href="/builder/contact/#/new"><i class="fas fa-phone-volume" style="background:#CCCCCC;"></i> Contact Info</a>
                </li>
                  <li class="visited-page">
                    <a href="/builder/contact/#/store"><i class="fas fa-briefcase" style="background:#CCCCCC;"></i> Work History</a>
                  </li>
                  <li style="">
                    <i class="fas fa-book-open" ></i> Education
                  </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 grid-container">
            <div class="resume-editor-div resume-editor-firefox" style="margin-top:-11px !important;">
                <h2>
                  <span class="icon">
                    <img :src="EnvPath+'images/pages/book_open.png'"/>
                  </span>
                    Education
                </h2>
              <twobuttonmodel popupHeight="310" popupTitle="Are You Sure?" popupText="It looks like you haven't entered any education. If you are currently in school, you can add the education and put your expected graduation date. If you aren't in school, sometimes the best education is school of hard knocks." v-if="showedunextModal" @close="closeedunextModal" @proceed="proceededunextModel" ></twobuttonmodel>

              <twobuttonmodel
                popupTitle="Do you want to proceed?"
                popupText="You have not completed all of the required fields. If you proceed then you will cancel creating a new record. Do you want to continue?"
                v-if="showModal"
                @close="closeModal"
                @proceed="proceedModel"
              ></twobuttonmodel>

              <twobuttonmodel
                popupTitle="Are you Sure You Want to Delete?"
                popupText="I'm sure you worked hard for this education. Are you sure you just want to throw it away with the click of a button?"
                v-if="showdelModal"
                @close="closedelModal"
                @proceed="proceeddelModel"
              ></twobuttonmodel>

                <div v-for="(education_line,index) in education_lines" v-bind:key="index"  class="accordion purple"> <!-- id="accordion" -->
                    <div @click="showEducationEdit(education_line.show,index)" class="header">
                        <slot name="header">
                            <div slot="header"
                                 style="word-break: break-all; font-family:'Hind', sans-serif; font-size: 18px; color: #767676;padding-top:2px;text-align:left; ">
                                <strong v-html="education_line.education_head"></strong>
                            </div>
                        </slot>
                        <i class="fa fa-2x fa-chevron-down header-icon" v-bind:class="{ rotate: education_line.show }"
                           v-on:click="toggle">
                        </i>
                    </div>
                  </slot>
                  <i
                    class="fa fa-2x fa-chevron-down header-icon"
                    v-bind:class="{ rotate: education_line.show }"
                    v-on:click="toggle"
                  ></i>
                </div>
                <!-- Modal -->
                <!--<div class="popup-container modal" id="exampleModal">
                      <div class="poup-sub-container">
                        <div class="pop-content-section pop_confused_content">
                          <div class="container">
                            <div class="row">
                              <div class="col-4"><img src="/images/logo/Surprise.png" alt="Confused"></div>
                              <div class="col-8">
                                <h4>Are you Sure You Want to Delete?</h4>
                                <p>I'm sure you worked hard for this education. Are you sure you just want to throw it away with the click of a button?</p>
                                <button data-dismiss="modal" class="btnOption btn-rounded" style="float:left;">No</button>
                                <button @click="delete_education_history(index)" data-dismiss="modal" class="btnOption btn_color_option btn-rounded" style="float:right;">Yes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>-->
                <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="top: 250px; width: 300px;">
                            <div class="modal-content">
                                <div class="modal-body">Do you want to delete this degree?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" @click="delete_education_history(index)" data-dismiss="modal">Yes</button>
                                    <button type="button" class="btn" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <transition
                            name="accordion"
                            v-on:before-enter="beforeEnter"
                            v-on:enter="enter"
                            v-on:before-leave="beforeLeave"
                            v-on:leave="leave">
                        <div class="body" v-show="education_line.show">
                            <div class="body-inner">
                                <slot>
                                    <!-- Contact Form -->
                                    <!-- <form class="mt-3 contact-form"> -->
                                    <div class="row justify-content-center"
                                         style="padding-left: 10px;padding-right: 10px;">
                                        <div class="col-md-12 col-sm-12 group mr-2 inputP55"
                                             style="height: 50px;margin-top: 3px;margin-top: 10px;
    margin-bottom: 20px;">
                                            <div class="autocomplete">
                                                <input maxlength="70" ref="School" autocomplete="off" v-on:blur="mouseLeaveInputEducation('School',index)" type="text" v-model="education_line.School" class="input"
                                                       :class="education_line.isMouseLeaveSchool?'mouseLeave':(education_line.isMouseFocusSchool?'input':'')"
                                                       @click="inputFocusEducation('School',index)"
                                                       v-on:keyup="schoolinputChange(index)"
                                                       @mouseleave="mouseLeaveInputEducation('School',index)"/>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="label_name" :class="(education_line.isMouseLeaveSchool && (education_line.School!='') || (!education_line.isMouseFocusSchool && (education_line.School!='')))?'mouseLeave_':''">School*:</label>
                                            </div>
                                          <span>
                                            <img :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationschool"/>
                                          </span>
                                          <ul class="autocomplete-results" v-if="isOpen && schools.length > 0" style="width:100%">
                                            <li v-for="(school,i) in schools" :key="school.id" @click="setResult(i,index)" class="autocomplete-result" >
                                              {{ school.name }} ({{ school.city }},{{ school.state }})
                                            </li>
                                          </ul>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center"
                                         style="padding-left: 10px;padding-right: 10px;margin-bottom: 23px;">
                                        <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                                            <div class>
                                                <input maxlength="50" v-on:blur="mouseLeaveInputEducation('city',index)" type="text" v-model="education_line.City" class="input"
                                                       v-on:keyup="education_validation('city',index)"
                                                       :class="education_line.isMouseLeaveCity?'mouseLeave':(education_line.isMouseFocusCity?'input':'')"
                                                       @click="inputFocusEducation('city',index)"
                                                       @mouseleave="mouseLeaveInputEducation('city',index)"/>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="label_name"
                                                       :class="(education_line.isMouseLeaveCity && (education_line.City!='') || (!education_line.isMouseFocusCity && (education_line.City!='')))?'mouseLeave_':''">City*:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                                            <div class v-if="education_line.showStateSelect">
                                                <select name="state" id="state" class="select-item input" v-model="education_line.state"
                                                        v-on:change="education_validation('state',index)"
                                                        :class="education_line.isMouseLeaveState?'mouseLeave':(education_line.isMouseFocusState?'input':'')"
                                                        @click="inputFocusEducation('state',index)" @mouseleave="mouseLeaveInputEducation('state',index)" style="-webkit-appearance: none;">
                                                    <option value=""></option>
                                                  <option v-for="(state,index) in states" :value="index">{{ state }}</option>
                                                </select>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="select-label" :class="!education_line.state?'unselected':((education_line.isMouseLeaveState && (education_line.state!=0) || (!education_line.isMouseFocusState && (education_line.state!=0)))?'mouseLeave_':'')">State*:</label>
                                            </div>
                                          <div class v-if="education_line.showStateText">
                                            <input :maxlength="255" v-on:blur="mouseLeaveInputEducation('state',index)" type="text" v-model="education_line.state" class="input" :class="education_line.isMouseLeaveState?'mouseLeave':(education_line.isMouseFocusState?'input':'')" @click="inputFocusEducation('state',index)"
                                                   v-on:keyup="education_validation('state',index)"
                                                   @mouseleave="mouseLeaveInputEducation('state',index)"/>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label class="label_name" :class="(education_line.state!='') ?'mouseleavefill':''">State*:</label>
                                          </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                                            <div class>
                                                <select name="country" id="country" class="select-item input"
                                                        v-on:change="education_validation('country',index)"
                                                        v-model="education_line.country"
                                                        :class="education_line.isMouseLeaveCountry?'mouseLeave':(education_line.isMouseFocusCountry?'input':'')"
                                                        @click="inputFocusEducation('country',index)"
                                                        @mouseleave="mouseLeaveInputEducation('country',index)"
                                                        @change="hideStateSelectEducation($event,index)"
                                                        style="-webkit-appearance: none;">
                                                  <option v-for="(country,index) in countries" :value="index" >{{ country }}</option>
                                                </select>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="select-label"
                                                       :class="!education_line.country?'unselected':((education_line.isMouseLeaveCountry && (education_line.country!=0) || (!education_line.isMouseFocusCountry && (education_line.country!=0)))?'mouseLeave_':'')">Country*:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .row -->
                                    <div class="row justify-content-center" style="padding-left: 10px;padding-right: 10px;margin-bottom: 23px;">
                                        <div class=" col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;margin-top: 3px;">
                                            <div class>
                                                <select class="select-item input" v-model="education_line.degree"
                                                        :class="education_line.isMouseLeaveDegree?'mouseLeave':(education_line.isMouseFocusDegree?'input':'')"
                                                        @click="inputFocusEducation('degree',index)"
                                                        @mouseleave="mouseLeaveInputEducation('degree',index)"
                                                        v-on:change="education_validation('degree', index)"
                                                        style="-webkit-appearance: none;">
                                                    <option value="" class="label_name"></option>
                                                  <option v-for="(single_degree,i) in degrees" :value="i + 1" >{{ single_degree }}</option>

                                                </select>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="select-label"
                                                       :class="!education_line.degree?'unselected':((education_line.isMouseLeaveDegree && (education_line.degree!=0) || (!education_line.isMouseFocusDegree && (education_line.degree!=0)))?'mouseLeave_':'')">Degree*:</label>
                                            </div>
                                          <span>
                                            <img :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationdegree"/>
                                          </span>
                                        </div>

                                        <div v-if="education_line.showOtherDegree" class=" col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px; margin-top: 3px;">
                                          <div>
                                            <input type="text" v-model="education_line.OtherDegree" class="input"
                                                   v-on:keyup="education_validation('OtherDegree',index)"
                                                   :class="education_line.isMouseLeaveOtherDegree?'mouseLeave':(education_line.isMouseFocusOtherDegree?'input':'')"
                                                   @click="inputFocusEducation('OtherDegree',index)"
                                                   @mouseleave="mouseLeaveInputEducation('OtherDegree',index)"
                                                   style="padding-right:40px"/>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label class="label_name"
                                                   :class="(education_line.isMouseLeaveOtherDegree && (education_line.OtherDegree!='') || (!education_line.isMouseFocusOtherDegree && (education_line.OtherDegree!='')))?'mouseLeave_':''">Other Degree*:</label>
                                          </div>
                                        </div>

                                        <div  class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px; margin-top: 3px;">
                                            <div v-if="education_line.showMajorField" class>
                                                <input type="text" v-model="education_line.MajorField" class="input"
                                                       v-on:keyup="education_validation('MajorField',index)"
                                                       :class="education_line.isMouseLeaveMajorField?'mouseLeave':(education_line.isMouseFocusMajorField?'input':'')"
                                                       @click="inputFocusEducation('MajorField',index)"
                                                       @mouseleave="mouseLeaveInputEducation('MajorField',index)"
                                                       style="padding-right:40px"/>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="label_name"
                                                       :class="(education_line.isMouseLeaveMajorField && (education_line.MajorField!='') || (!education_line.isMouseFocusMajorField && (education_line.MajorField!='')))?'mouseLeave_':''">Major / Field of Study:</label>
                                            </div>
                                            <span v-if="education_line.showMajorField">
                                                <img :src="EnvPath+'images/bg/help.png'" alt class="small_logo"
                                                     v-tooltip="field_educationmajor"/>
                                            </span>
                                        </div>
                                        <div  v-if="education_line.showOtherDegree != true" class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px; margin-top: 3px;">


                                          <div v-if="education_line.showCreditCompleted" class>
                                            <input type="text" v-model="education_line.CreditCompleted" class="input"
                                                   v-on:keyup="education_validation('CreditCompleted',index)"
                                                   :class="education_line.isMouseLeaveCreditCompleted?'mouseLeave':(education_line.isMouseFocusCreditCompleted?'input':'')"
                                                   @click="inputFocusEducation('CreditCompleted',index)"
                                                   @mouseleave="mouseLeaveInputEducation('CreditCompleted',index)"
                                                   @keypress="isNumber($event)"
                                                   style="padding-right:40px"/>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label class="label_name"
                                                   :class="(education_line.isMouseLeaveCreditCompleted && (education_line.CreditCompleted!='') || (!education_line.isMouseFocusCreditCompleted && (education_line.CreditCompleted!='')))?'mouseLeave_':''">Credits completed*:</label>
                                          </div>


                                        </div>
                                    </div>
                                    <div class="row justify-content-center" style="padding-left: 10px;padding-right: 10px; margin-bottom: -7px;">
                                        <div class="col-md-4 col-sm-4 workdate">
                                            <p style="font-family: Hind; font-size:16px; color:#767676; align-items:center">{{Graduation_Lable}}:</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 inputP55">
                                            <div class>
                                                <select name="month" id="month" class="select-item input"
                                                        v-on:change="education_validation('month', index)"
                                                        v-model="education_line.month"
                                                        :class="education_line.isMouseLeaveMonth?'mouseLeave':(education_line.isMouseFocusMonth?'input':'')"
                                                        @click="inputFocusEducation('month',index)"
                                                        @mouseleave="mouseLeaveInputEducation('month',index)"
                                                        style="-webkit-appearance: none;">
                                                    <option value="" class="label_name"></option>
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
                                                <label class="select-label"
                                                       :class="!education_line.month?'unselected':((education_line.isMouseLeaveMonth && (education_line.month!=0) || (!education_line.isMouseFocusMonth && (education_line.month!=0)))?'mouseLeave_':'')">Month:</label>
                                            </div>
                                          <span>
                                            <img v-if="Graduation_Lable == 'Date Last Attended'" :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationGradYearLastAttendedDate"/>
                                            <img v-else :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationgradmonth"/>
                                          </span>
                                        </div>
                                        <div class="col-md-4 col-sm-4 year inputP55" style="height:50px">
                                            <div class>
                                                <select name="year" id="year" class="select-item input"
                                                        v-on:change="education_validation('year', index)"
                                                        v-model="education_line.year"
                                                        :class="education_line.isMouseLeaveYear?'mouseLeave':(education_line.isMouseFocusYear?'input':'')"
                                                        @click="inputFocusEducation('year',index)"
                                                        @mouseleave="mouseLeaveInputEducation('year',index)"
                                                        style="-webkit-appearance: none;">
                                                  <option value="" ></option>
                                                  <option value="1" :value="current_year" class="label_name">{{ current_year }}</option>
                                                  <option v-for="index in 81" :value="current_year - index" class="label_name" >{{ current_year - index }}</option>
                                                </select>
                                                <!-- <span class="highlight"></span> -->
                                                <span class="bar"></span>
                                                <label class="select-label"
                                                       :class="!education_line.year?'unselected':((education_line.isMouseLeaveYear && (education_line.year!=0) || (!education_line.isMouseFocusYear && (education_line.year!=0)))?'mouseLeave_':'')">Year:</label>
                                            </div>
                                          <span>
                                            <img v-if="Graduation_Lable == 'Date Last Attended'" :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationGradYearLastAttendedDate"/>
                                            <img v-else :src="EnvPath+'images/bg/help.png'" alt class="small_logo" v-tooltip="field_educationgradyear"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="confirm" style="margin-bottom: 32px;margin-top: -4px;">
                                      <!-- data-target="#exampleModal" -->
                                        <i v-if="education_line.db_education_id != 0" class="fa fa-2x fa fa-trash header-icon1" data-toggle="modal" @click="deleteEducation(index)"
                                           style="display: inline; position: absolute; left: 45px; cursor:pointer;"></i>
                                        <i class="fa fa-times-circle" style="font-size:30px;color:#fb643e;position: absolute;right: 85px; cursor:pointer;"
                                           @click="cancel(index)"></i>
                                        <i class="fa fa-check-circle" style="font-size:30px;color:#fb643e;position: absolute;right: 50px; cursor:pointer;"
                                           @click="IsNextEducation(false,false,index)"></i>
                                    </div>
                                </slot>
                            </div>
                            <span>
                              <img
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationschool"
                              />
                            </span>
                            <ul
                              class="autocomplete-results"
                              v-if="isOpen && schools.length > 0"
                              style="width:100%"
                            >
                              <li
                                v-for="(school,i) in schools"
                                :key="school.id"
                                @click="setResult(i,index)"
                                class="autocomplete-result"
                              >{{ school.name }} ({{ school.city }},{{ school.state }})</li>
                            </ul>
                          </div>
                        </div>

                        <div
                          class="row justify-content-center"
                          style="padding-left: 10px;padding-right: 10px;"
                        >
                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class>
                              <input
                                v-on:blur="mouseLeaveInputEducation('city',index)"
                                type="text"
                                v-model="education_line.City"
                                class="input"
                                v-on:keyup="education_validation('city',index)"
                                :class="education_line.isMouseLeaveCity?'mouseLeave':(education_line.isMouseFocusCity?'input':'')"
                                @click="inputFocusEducation('city',index)"
                                @mouseleave="mouseLeaveInputEducation('city',index)"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(education_line.isMouseLeaveCity && (education_line.City!='') || (!education_line.isMouseFocusCity && (education_line.City!='')))?'mouseLeave_':''"
                              >City*:</label>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class v-if="education_line.showStateSelect">
                              <select
                                name="state"
                                id="state"
                                class="select-item input"
                                v-model="education_line.state"
                                v-on:change="education_validation('state',index)"
                                :class="education_line.isMouseLeaveState?'mouseLeave':(education_line.isMouseFocusState?'input':'')"
                                @click="inputFocusEducation('state',index)"
                                @mouseleave="mouseLeaveInputEducation('state',index)"
                                style="-webkit-appearance: none;"
                              >
                                <option value></option>
                                <option v-for="(state,index) in states" :value="index">{{ state }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!education_line.state?'unselected':((education_line.isMouseLeaveState && (education_line.state!=0) || (!education_line.isMouseFocusState && (education_line.state!=0)))?'mouseLeave_':'')"
                              >State*:</label>
                            </div>
                            <div class v-if="education_line.showStateText">
                              <input
                                :maxlength="255"
                                v-on:blur="mouseLeaveInputEducation('state',index)"
                                type="text"
                                v-model="education_line.state"
                                class="input"
                                :class="education_line.isMouseLeaveState?'mouseLeave':(education_line.isMouseFocusState?'input':'')"
                                @click="inputFocusEducation('state',index)"
                                v-on:keyup="education_validation('state',index)"
                                @mouseleave="mouseLeaveInputEducation('state',index)"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(education_line.state!='') ?'mouseleavefill':''"
                              >State*:</label>
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-12 group mr-2 inputP55" style="height: 50px;">
                            <div class>
                              <select
                                name="country"
                                id="country"
                                class="select-item input"
                                v-on:change="education_validation('country',index)"
                                v-model="education_line.country"
                                :class="education_line.isMouseLeaveCountry?'mouseLeave':(education_line.isMouseFocusCountry?'input':'')"
                                @click="inputFocusEducation('country',index)"
                                @mouseleave="mouseLeaveInputEducation('country',index)"
                                @change="hideStateSelectEducation($event,index)"
                                style="-webkit-appearance: none;"
                              >
                                <option
                                  v-for="(country,index) in countries"
                                  :value="index"
                                >{{ country }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!education_line.country?'unselected':((education_line.isMouseLeaveCountry && (education_line.country!=0) || (!education_line.isMouseFocusCountry && (education_line.country!=0)))?'mouseLeave_':'')"
                              >Country*:</label>
                            </div>
                          </div>
                        </div>
                        <!-- end .row -->
                        <div
                          class="row justify-content-center"
                          style="padding-left: 10px;padding-right: 10px;"
                        >
                          <div
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px;margin-top: 3px;"
                          >
                            <div class>
                              <select
                                class="select-item input"
                                v-model="education_line.degree"
                                :class="education_line.isMouseLeaveDegree?'mouseLeave':(education_line.isMouseFocusDegree?'input':'')"
                                @click="inputFocusEducation('degree',index)"
                                @mouseleave="mouseLeaveInputEducation('degree',index)"
                                v-on:change="education_validation('degree', index)"
                                style="-webkit-appearance: none;"
                              >
                                <option value class="label_name"></option>
                                <option
                                  v-for="(single_degree,i) in degrees"
                                  :value="i + 1"
                                >{{ single_degree }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!education_line.degree?'unselected':((education_line.isMouseLeaveDegree && (education_line.degree!=0) || (!education_line.isMouseFocusDegree && (education_line.degree!=0)))?'mouseLeave_':'')"
                              >Degree*:</label>
                            </div>
                            <span>
                              <img
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationdegree"
                              />
                            </span>
                          </div>

                          <div
                            v-if="education_line.showOtherDegree"
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px; margin-top: 3px;"
                          >
                            <div>
                              <input
                                type="text"
                                v-model="education_line.OtherDegree"
                                class="input"
                                v-on:keyup="education_validation('OtherDegree',index)"
                                :class="education_line.isMouseLeaveOtherDegree?'mouseLeave':(education_line.isMouseFocusOtherDegree?'input':'')"
                                @click="inputFocusEducation('OtherDegree',index)"
                                @mouseleave="mouseLeaveInputEducation('OtherDegree',index)"
                                style="padding-right:40px"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(education_line.isMouseLeaveOtherDegree && (education_line.OtherDegree!='') || (!education_line.isMouseFocusOtherDegree && (education_line.OtherDegree!='')))?'mouseLeave_':''"
                              >Other Degree*:</label>
                            </div>
                          </div>

                          <div
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px; margin-top: 3px;"
                          >
                            <div v-if="education_line.showMajorField" class>
                              <input
                                type="text"
                                v-model="education_line.MajorField"
                                class="input"
                                v-on:keyup="education_validation('MajorField',index)"
                                :class="education_line.isMouseLeaveMajorField?'mouseLeave':(education_line.isMouseFocusMajorField?'input':'')"
                                @click="inputFocusEducation('MajorField',index)"
                                @mouseleave="mouseLeaveInputEducation('MajorField',index)"
                                style="padding-right:40px"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(education_line.isMouseLeaveMajorField && (education_line.MajorField!='') || (!education_line.isMouseFocusMajorField && (education_line.MajorField!='')))?'mouseLeave_':''"
                              >Major / Field of Study:</label>
                            </div>
                            <span v-if="education_line.showMajorField">
                              <img
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationmajor"
                              />
                            </span>
                          </div>
                          <div
                            v-if="education_line.showOtherDegree != true"
                            class="col-md-4 col-sm-12 group mr-2 inputP55"
                            style="height: 50px; margin-top: 3px;"
                          >
                            <div v-if="education_line.showCreditCompleted" class>
                              <input
                                type="text"
                                v-model="education_line.CreditCompleted"
                                class="input"
                                v-on:keyup="education_validation('CreditCompleted',index)"
                                :class="education_line.isMouseLeaveCreditCompleted?'mouseLeave':(education_line.isMouseFocusCreditCompleted?'input':'')"
                                @click="inputFocusEducation('CreditCompleted',index)"
                                @mouseleave="mouseLeaveInputEducation('CreditCompleted',index)"
                                @keypress="isNumber($event)"
                                style="padding-right:40px"
                              />
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="label_name"
                                :class="(education_line.isMouseLeaveCreditCompleted && (education_line.CreditCompleted!='') || (!education_line.isMouseFocusCreditCompleted && (education_line.CreditCompleted!='')))?'mouseLeave_':''"
                              >Credits completed*:</label>
                            </div>
                          </div>
                        </div>
                        <div
                          class="row justify-content-center"
                          style="padding-left: 10px;padding-right: 10px; margin-bottom: -7px;"
                        >
                          <div class="col-md-4 col-sm-4 workdate">
                            <p
                              style="font-family: Hind; font-size:16px; color:#767676; align-items:center"
                            >{{Graduation_Lable}}:</p>
                          </div>
                          <div class="col-md-4 col-sm-4 inputP55">
                            <div class>
                              <select
                                name="month"
                                id="month"
                                class="select-item input"
                                v-on:change="education_validation('month', index)"
                                v-model="education_line.month"
                                :class="education_line.isMouseLeaveMonth?'mouseLeave':(education_line.isMouseFocusMonth?'input':'')"
                                @click="inputFocusEducation('month',index)"
                                @mouseleave="mouseLeaveInputEducation('month',index)"
                                style="-webkit-appearance: none;"
                              >
                                <option value class="label_name"></option>
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
                                :class="!education_line.month?'unselected':((education_line.isMouseLeaveMonth && (education_line.month!=0) || (!education_line.isMouseFocusMonth && (education_line.month!=0)))?'mouseLeave_':'')"
                              >Month:</label>
                            </div>
                            <span>
                              <img
                                v-if="Graduation_Lable == 'Date Last Attended'"
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationGradYearLastAttendedDate"
                              />
                              <img
                                v-else
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationgradmonth"
                              />
                            </span>
                          </div>
                          <div class="col-md-4 col-sm-4 year inputP55" style="height:50px">
                            <div class>
                              <select
                                name="year"
                                id="year"
                                class="select-item input"
                                v-on:change="education_validation('year', index)"
                                v-model="education_line.year"
                                :class="education_line.isMouseLeaveYear?'mouseLeave':(education_line.isMouseFocusYear?'input':'')"
                                @click="inputFocusEducation('year',index)"
                                @mouseleave="mouseLeaveInputEducation('year',index)"
                                style="-webkit-appearance: none;"
                              >
                                <option value></option>
                                <option
                                  value="1"
                                  :value="current_year"
                                  class="label_name"
                                >{{ current_year }}</option>
                                <option
                                  v-for="index in 81"
                                  :value="current_year - index"
                                  class="label_name"
                                >{{ current_year - index }}</option>
                              </select>
                              <!-- <span class="highlight"></span> -->
                              <span class="bar"></span>
                              <label
                                class="select-label"
                                :class="!education_line.year?'unselected':((education_line.isMouseLeaveYear && (education_line.year!=0) || (!education_line.isMouseFocusYear && (education_line.year!=0)))?'mouseLeave_':'')"
                              >Year:</label>
                            </div>
                            <span>
                              <img
                                v-if="Graduation_Lable == 'Date Last Attended'"
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationGradYearLastAttendedDate"
                              />
                              <img
                                v-else
                                :src="EnvPath+'images/bg/help.png'"
                                alt
                                class="small_logo"
                                v-tooltip="field_educationgradyear"
                              />
                            </span>
                          </div>
                        </div>
                        <div class="confirm" style="margin-bottom: 32px;margin-top: -4px;">
                          <!-- data-target="#exampleModal" -->
                          <i
                            v-if="education_line.db_education_id != 0"
                            class="fa fa-2x fa fa-trash header-icon1"
                            data-toggle="modal"
                            @click="deleteEducation(index)"
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
                            @click="IsNextEducation(false,false,index)"
                          ></i>
                        </div>
                      </slot>
                    </div>
                  </div>
                </transition>
              </div>
              <button
                type="button"
                class="btn btn-block"
                @click="wh_IsNextEducation(false,true)"
                style="border: 3px solid rgb(244, 244, 245); color: rgb(223, 223, 223); padding: 11px 0px; font-size: 18px; border-radius: 6px;"
              >+Add New</button>
              <!--<p v-if="!IsNext_f__||!IsNext_f||!IsNext_f_" class="text-danger text-center" style="margin-bottom: -10px;font-size: 14px;">Please complete all of the required fields with the *</p>-->
              <p v-if="errors.length">
                <p v-for="error in errors" class="alert alert-warning text-center" style="margin-bottom: -10px;font-size: 14px;">{{ error }}</p>
              </p>
                <div class="text-center">
                    <button class="btn1 btn-rounded btn-next mt-4" style="padding-bottom:0px !important;" @click="wh_IsNextEducation(true,false)">
                        <span class style="margin-left:-14px;">Next</span>
                        <span class="pl-1">
                            <i class="next-icon fas fa-chevron-right"></i>
                        </span>
                    </button>
                </div>
                <!-- </form> -->
            </div>
            <!-- <page-workhistory></page-workhistory> -->
            <page-footer></page-footer>
          </div>
          <div v-if="FutureORCurrent" class="popup-container">
            <div class="poup-sub-container">
              <div class="pop-content-section pop_confused_content">
                <div class="container">
                  <div class="row">
                    <div class="col-4">
                      <img :src="EnvPath+'images/logo/Surprise.png'" alt="Confused" />
                    </div>
                    <div class="col-8">
                      <h4>Are You Sure?</h4>
                      <p>It looks like you expect to graduate in the near future. Instead of selecting "Some College" as your degree, I recommend you select the degree you expect to obtain. That way we can put the degree on your resume. Do you want to stick with "Some College"?</p>

                      <div class="d-flex">
                        <button
                            @click="FutureORCurrent_No()"
                            class="btnOption btn_color_option btn-rounded"
                            style="float:left;"
                          >No</button>
                          <button
                            class="btnOption btn-rounded"
                            @click="FutureORCurrent_Yes()"
                            style="float:right;"
                          >Yes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="Year_null" class="popup-container">
            <div class="poup-sub-container">
              <div class="pop-content-section pop_confused_content">
                <div class="container">
                  <div class="row">
                    <div class="col-4">
                      <img :src="EnvPath+'images/logo/Surprise.png'" alt="Confused" />
                    </div>
                    <div class="col-8">
                      <h4>Are You Sure?</h4>
                      <p>You didn't provide a graduation year. By providing a graduation year, we will be able to provide better advice when you create your resume. Many of the checks we will run requires us to know when you went to school. Do you want to move forward anyways?</p>
                     <div class="d-flex">
                       <button
                        @click="FutureORCurrent_No()"
                        class="btnOption btn_color_option btn-rounded"
                        style="float:left;"
                      >No</button>
                      <button
                        class="btnOption btn-rounded"
                        @click="FutureORCurrent_Yes()"
                        style="float:right;"
                      >Yes</button>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="Year_null_some_collage" class="popup-container">
            <div class="poup-sub-container">
              <div class="pop-content-section pop_confused_content">
                <div class="container">
                  <div class="row">
                    <div class="col-4">
                      <img :src="EnvPath+'images/logo/Surprise.png'" alt="Confused" />
                    </div>
                    <div class="col-8">
                      <h4>Are You Sure?</h4>
                      <p>Are You Sure? Body: You didn't provide the year you last attended school. By providing the year, we will be able to provide better advice when you create your resume. Many of the checks we will run requires us to know when you went to school. Do you want to move forward anyways?</p>
                      <button
                        @click="FutureORCurrent_No()"
                        class="btnOption btn_color_option btn-rounded"
                        style="float:left;"
                      >No</button>
                      <button
                        class="btnOption btn-rounded"
                        @click="FutureORCurrent_Yes()"
                        style="float:right;"
                      >Yes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import twobuttonmodel from "../twobuttonmodel.vue";
import Vue from "vue";
import Button from "./Button.vue";
import JQuery from "jquery";
import store from "../../store";
import { environment_api } from "../../env";
import { log } from "util";
import headernav from "./header_nav";
import lhsMenu from "./lhsMenu";

let $ = JQuery;
export default {
  name: "app",
  beforeRouteLeave(to, from, next) {
    if (this.education_lines[this.current_index].School != "") {
      if (
        !(
          this.education_lines[this.current_index].City != "" &&
          this.education_lines[this.current_index].state != "" &&
          this.education_lines[this.current_index].country != "" &&
          this.education_lines[this.current_index].degree != ""
        )
      ) {
        this.showModal = true;
        this.v_next = next;
      } else {
        this.IsNextEducation(false, false, this.current_index);
        next();
      }
    } else {
      next();
    }
  },
  components: {
    twobuttonmodel,
    Button,
    headernav,
    lhsMenu,
  },
  props: {
    field_educationschool: {
      type: String,
      required: true,
    },
    field_educationdegree: {
      type: String,
      required: true,
    },
    field_educationgradyear: {
      type: String,
      required: true,
    },
    field_educationgradmonth: {
      type: String,
      required: true,
    },
    field_educationmajor: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
      showedunextModal: false,
      showdelModal: false,
      showModal: false,
      element: null,
      v_next: null,
      showModel: true,
      errors: [],
      current_index: 0,
      placements: ["bottomleft"],
      item: {},
      major_tooltip:
        "I heard you have to give away your first-born child to use this site, so you better read these carefully!",
      items_first: [],
      education_lines: [],
      isOpen: false,
      IsNext_f: true,
      IsNext_f_: true,
      IsNext_f__: true,
      show: true,
      countries: [],
      states: [],
      schools: [],
      degrees: [
        "High School Diploma",
        "GED",
        "Associate of Arts",
        "Associate of Science",
        "Associate of Applied Science",
        "Bachelor of Arts",
        "Bachelor of Science",
        "BBA",
        "Master of Arts",
        "Master of Science",
        "MBA",
        "J.D.",
        "M.D.",
        "Ph.D.",
        "Other Degree (specify)",
        "Some College",
      ],
      Graduation_Lable: "Graduation Date",
      lastAttendedDate: false,
      FutureORCurrent: false,
      Year_null: false,
      Year_null_some_collage: false,
      field_educationGradYearLastAttendedDate:
        "Add the date you last attended this school. If you are still attending this school, then change your degree to the degree you expect to earn.",
      Gotonext: "",
      Addnew: "",
      Index: "",
      page: 0,
      isLoggedIn: this.$store.state.isLoggedIn,
    };
  },
  mounted() {
    if (this.$store.state.contact_Data.first_name == "") {
      this.loadContact();
    }
    this.countries = this.$store.state.countriesData;
    this.states = this.$store.state.statesData;
    this.get_current_year();
    this.load_education_history();
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
    FutureORCurrent_No: function () {
      this.FutureORCurrent = !this.FutureORCurrent;
    },
    FutureORCurrent_Yes: function () {
      this.FutureORCurrent = !this.FutureORCurrent;
      let nodateerror = true;
      if (nodateerror) {
        let querystring = require("querystring");
        let page = 3;
        if (this.Gotonext) {
          page = 4;
        }
        window.axios
          .post(
            this.EnvPath + "educationhistory",
            querystring.stringify({
              School: this.education_lines[this.Index].School,
              City: this.education_lines[this.Index].City,
              State: this.education_lines[this.Index].state,
              Country: this.education_lines[this.Index].country,
              Degree: this.education_lines[this.Index].degree,
              MajorField: this.education_lines[this.Index].MajorField,
              CreditCompleted: this.education_lines[this.Index].CreditCompleted,
              OtherDegree: this.education_lines[this.Index].OtherDegree,
              master_school_id:
                this.education_lines[this.Index].master_school_id,
              Month: this.education_lines[this.Index].month,
              Year: this.education_lines[this.Index].year,
              db_education_id: this.education_lines[this.Index].db_education_id,
              b4_CreditCompleted:
                this.education_lines[this.Index].b4_CreditCompleted,
              Page: page,
            })
          )
          .then(({ data }) => {
            if (data.status == 1) {
              this.education_lines[this.Index].db_education_id = data.db_id;
              //this.IsNext_f = true;
              if (this.Gotonext) {
                this.$router.push({ name: "my-resume" });
              } else {
                this.education_lines[this.Index].b4_master_school_id =
                  this.education_lines[this.Index].master_school_id;
                this.education_lines[this.Index].b4_School =
                  this.education_lines[this.Index].School;
                this.education_lines[this.Index].b4_City =
                  this.education_lines[this.Index].City;
                this.education_lines[this.Index].b4_state =
                  this.education_lines[this.Index].state;
                this.education_lines[this.Index].b4_country =
                  this.education_lines[this.Index].country;
                this.education_lines[this.Index].b4_degree =
                  this.education_lines[this.Index].degree;
                this.education_lines[this.Index].b4_MajorField =
                  this.education_lines[this.Index].MajorField;
                this.education_lines[this.Index].b4_month =
                  this.education_lines[this.Index].month;
                this.education_lines[this.Index].b4_year =
                  this.education_lines[this.Index].year;

                this.education_lines[this.Index].show = false;
                this.education_lines[this.Index].education_head =
                  this.education_lines[this.Index].School +
                  ", " +
                  this.degrees[this.education_lines[this.Index].degree - 1];

                if (this.addnew) {
                  if (
                    this.education_lines[this.education_lines.length - 1]
                      .School != ""
                  ) {
                    this.addEducationLine();
                  } else {
                    this.education_lines[
                      this.education_lines.length - 1
                    ].show = true;
                    this.current_index = this.education_lines.length - 1;
                  }
                }
              }
              this.wh_error = false;
              this.errors = [];
            } else {
              this.wh_error = false;
              this.errors = [];
              //this.errors.push(data.message);
            }
          });
      }
    },
    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    closeedunextModal() {
      this.showedunextModal = false;
    },
    proceededunextModel() {
      var querystring = require("querystring");
      window.axios
        .post(
          this.EnvPath + "savepage",
          querystring.stringify({
            Page: 4,
          })
        )
        .then(({ data }) => {
          if (data.status == 1) {
            this.$router.push({ name: "my-resume" });
            // this.$router.push({ name: "store" });
          }
        });
    },
    deleteEducation(index) {
      this.current_index = index;
      this.showdelModal = true;
    },
    closedelModal() {
      this.showdelModal = false;
    },
    proceeddelModel() {
      this.delete_education_history(this.current_index);
      this.showdelModal = false;
      this.current_index = 0;
    },
    closeModal() {
      console.log("close model");
      this.showModal = false;
      this.v_next(false);
    },
    proceedModel() {
      this.showModal = false;
      this.v_next();
    },
    wh_IsNextEducation: function (gotonext, addnew) {
      let current_index = this.current_index;
      if (this.education_lines[current_index] == null) {
        if (addnew) {
          this.addEducationLine();
        } else if (gotonext) {
          this.$router.push({ name: "store" });
        }
      } else {
        //if(this.education_lines[current_index].School != "" || this.education_lines[current_index].City != "" || this.education_lines[current_index].state != "" || this.education_lines[current_index].degree != "") {
        this.IsNextEducation(gotonext, addnew, current_index);
        /*}
            else{
              if(gotonext) {
                this.$router.push({name: "store"});
              }
              else{
                this.IsNextEducation(gotonext, addnew, current_index);
              }
            }*/
      }
    },
    showEducationEdit: function (show, index) {
      this.education_lines[this.current_index].show = false;
      this.education_lines[index].show = !show;
      this.current_index = index;
      /*
          this.education_lines.forEach(function (item,ar_index){
            if(ar_index != this.current_index){
              this.education_lines[ar_index].show = false;
            }
          });
          */
    },
    load_education_history: function () {
      axios.get(this.EnvPath + "educationhistory").then(({ data }) => {
        if (data.status == 1) {
          store.commit("educationHistory", data.education);
          console.log("education_History", this.$store.state.education_History);
          for (let i = 0; i < this.$store.state.education_History.length; i++) {
            this.education_lines.push({
              master_school_id:
                this.$store.state.education_History[i].school_id,
              isMouseLeaveSchool: false,
              isMouseFocusSchool: false,
              isMouseLeaveMajorField: false,
              isMouseFocusMajorField: false,
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
              isMouseLeaveCreditCompleted: false,
              isMouseFocusCreditCompleted: false,
              isMouseLeaveOtherDegree: false,
              isMouseFocusOtherDegree: false,
              School: this.$store.state.education_History[i].school,
              b4_School: this.$store.state.education_History[i].school,
              MajorField: this.$store.state.education_History[i].major,
              b4_MajorField: this.$store.state.education_History[i].major,
              showMajorField: true,
              City: this.$store.state.education_History[i].city,
              b4_City: this.$store.state.education_History[i].city,
              state: this.$store.state.education_History[i].state,
              b4_state: this.$store.state.education_History[i].state,
              country: this.$store.state.education_History[i].country,
              b4_country: this.$store.state.education_History[i].country,
              prev_country: this.$store.state.education_History[i].country,
              month: this.$store.state.education_History[i].grad_month,
              b4_month: this.$store.state.education_History[i].grad_month,
              year: this.$store.state.education_History[i].grad_year,
              b4_year: this.$store.state.education_History[i].grad_year,
              degree: this.$store.state.education_History[i].degree,
              OtherDegree: this.$store.state.education_History[i].other_degree,
              b4_degree: this.$store.state.education_History[i].degree,
              db_education_id: this.$store.state.education_History[i].id,
              isMouseLeaveDegree: false,
              isMouseFocusDegree: false,
              showCreditCompleted: false,
              showOtherDegree: false,
              education_head:
                this.$store.state.education_History[i].school +
                ", " +
                this.degrees[this.$store.state.education_History[i].degree - 1],
              show: false,
            });

            if (this.$store.state.education_History[i].country == "232") {
              this.education_lines[i].showStateSelect = true;
              this.education_lines[i].showStateText = false;
            } else {
              this.education_lines[i].showStateSelect = false;
              this.education_lines[i].showStateText = true;
            }
            if (this.$store.state.education_History[i].degree == 16) {
              this.education_lines[i].b4_CreditCompleted =
                this.$store.state.education_History[i].credits_completed;
              this.education_lines[i].CreditCompleted =
                this.$store.state.education_History[i].credits_completed;
              this.education_lines[i].showCreditCompleted = true;
              this.Graduation_Lable = "Date Last Attended";
              this.lastAttendedDate = true;
            } else if (
              this.$store.state.education_History[i].degree == 1 ||
              this.$store.state.education_History[i].degree == 2
            ) {
              this.education_lines[i].CreditCompleted = "";
              this.education_lines[i].showMajorField = false;
              this.education_lines[i].MajorField = "";
            } else if (this.$store.state.education_History[i].degree == 15) {
              this.education_lines[i].CreditCompleted = "";
              this.education_lines[i].showOtherDegree = true;
            } else {
              this.education_lines[i].CreditCompleted = "";
            }
          }
        } else {
          this.addEducationLine();
        }
      });
      this.page = this.$store.state.contact_Data.page;
    },
    delete_education_history: function (index) {
      let db_education_id = this.education_lines[index].db_education_id;
      this.education_lines.splice(index, 1);

      window.axios
        .delete("/educationhistory", {
          data: {
            db_education_id: db_education_id,
          },
        })
        .then(({ data }) => {
          if (data.status == 1) {
            /*if(this.education_lines.length > 0){
                this.education_lines[this.education_lines.length - 1].show = false;
              }*/
          }
        });
    },
    education_validation: function (field, index) {
      if (field == "degree") {
        if (
          this.education_lines[index].degree == "1" ||
          this.education_lines[index].degree == "2"
        ) {
          this.education_lines[index].MajorField = "";
          this.education_lines[index].showMajorField = false;
        } else {
          this.education_lines[index].showMajorField = true;
        }

        if (this.education_lines[index].degree == "15") {
          this.education_lines[index].showOtherDegree = true;
        } else {
          this.education_lines[index].showOtherDegree = false;
          this.education_lines[index].OtherDegree = "";
        }

        if (this.education_lines[index].degree == "16") {
          this.education_lines[index].showCreditCompleted = true;
          this.Graduation_Lable = "Date Last Attended";
          this.lastAttendedDate = true;
        } else {
          this.education_lines[index].showCreditCompleted = false;
          this.education_lines[index].CreditCompleted = "";
          this.Graduation_Lable = "Graduation Date";
        }
      }

      if (
        this.education_lines[index].School != "" &&
        this.education_lines[index].City != "" &&
        this.education_lines[index].state != "" &&
        this.education_lines[index].country != "" &&
        this.education_lines[index].degree != ""
      ) {
        if (this.education_lines[index].showCreditCompleted) {
          if (this.education_lines[index].CreditCompleted != "") {
            this.errors = [];
          }
        } else {
          this.errors = [];
        }
      }
    },
    setResult: function (i, index) {
      this.education_lines[index].School = this.schools[i].name;
      this.isOpen = false;
      this.education_lines[index].master_school_id = this.schools[i].id;
      this.education_lines[index].City = this.schools[i].city;
      this.education_lines[index].state = this.schools[i].state_id;
      this.education_lines[index].country = "232";
      if (this.schools[i].type == "High") {
        this.education_lines[index].degree = 1;
        this.education_lines[index].showMajorField = false;
        this.education_lines[index].MajorField = "";
        this.education_lines[index].CreditCompleted = "";
        this.education_lines[index].showCreditCompleted = false;
        this.education_lines[index].showOtherDegree = false;
      } else {
        this.education_lines[index].degree = "";
        this.education_lines[index].showMajorField = true;
        this.education_lines[index].MajorField = "";
      }
    },
    addEducationLine: function () {
      this.education_lines.push({
        master_school_id: 0,
        isMouseLeaveSchool: false,
        isMouseFocusSchool: false,
        isMouseLeaveMajorField: false,
        isMouseFocusMajorField: false,
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
        isMouseLeaveCreditCompleted: false,
        isMouseFocusCreditCompleted: false,
        School: "",
        MajorField: "",
        showMajorField: true,
        City: "",
        state: "",
        country: "232",
        prev_country: "232",
        month: 0,
        year: 0,
        CreditCompleted: "",
        showCreditCompleted: false,
        showOtherDegree: false,
        degree: "",
        db_education_id: 0,
        isMouseLeaveDegree: false,
        isMouseFocusDegree: false,
        showStateSelect: true,
        showStateText: false,
        education_head: "New Education",
        show: true,
        b4_School: "",
        b4_City: "",
        b4_state: "",
        b4_country: "",
        b4_degree: "",
        b4_MajorField: "",
        b4_CreditCompleted: "",
        b4_month: "",
        b4_year: "",
      });
      this.current_index = this.education_lines.length - 1;
      this.$nextTick(() => {
        this.$refs.School[this.current_index].focus();
        //this.education_lines[this.current_index].School.focus();
      });
    },
    schoolinputChange: function (index) {
      if (
        this.education_lines[index].School != "" &&
        this.education_lines[index].city != "" &&
        this.education_lines[index].state != "" &&
        this.education_lines[index].country != "" &&
        this.education_lines[index].degree != ""
      ) {
        if (this.education_lines[index].showCreditCompleted) {
          if (this.education_lines[index].CreditCompleted != "") {
            this.errors = [];
          }
        } else {
          this.errors = [];
        }
      }
      if (this.education_lines[index].School.length > 3) {
        axios
          .get(this.EnvPath + "school/" + this.education_lines[index].School)
          .then(({ data }) => {
            if (data.status == 1) {
              this.schools = [];
              for (let i = 0; i < data.school.length; i++) {
                this.schools.push({
                  id: data.school[i].id, //
                  name: data.school[i].name,
                  type: data.school[i].type,
                  source: data.school[i].source,
                  source_id: data.school[i].source_id,
                  city: data.school[i].city,
                  state: data.school[i].state,
                  state_id: data.school[i].state_id,
                  country: data.school[i].country,
                  db_education_id: data.school[i].db_education_id,
                });
              }
              //console.log(this.items);
              this.isOpen = true;
            } else {
              this.isOpen = true;
              this.schools = [];
            }
          })
          .catch((error) => console.log(error));
      } else {
        this.isOpen = true;
        this.schools = [];
      }
    },
    get_current_year: function () {
      var d = new Date();
      this.current_year = d.getFullYear() + 6;
    },
    hideStateSelectEducation: function (e, index) {
      if (e.target.value == "232") {
        this.education_lines[index].showStateSelect = true;
        this.education_lines[index].showStateText = false;
        this.education_lines[index].prev_country = e.target.value;
      } else {
        if (this.education_lines[index].prev_country == "232") {
          this.education_lines[index].state = "";
        }
        this.education_lines[index].showStateSelect = false;
        this.education_lines[index].showStateText = true;
        this.education_lines[index].prev_country = e.target.value;
        //this.state = '';
      }
    },
    // loadCountries() {
    //   axios.get('/countries').then(response => this.countries =response.data.countries).catch(error => console.log(error))
    // },
    // loadStates() {
    //   axios.get('/states').then(response => this.states =response.data.states).catch(error => console.log(error))
    // },
    blurInput(event) {
      console.log("event", event);
    },
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

    mouseLeaveInputEducation(inputName, index) {
      if (inputName === "School") {
        this.education_lines[index].isMouseLeaveSchool = true;
        this.education_lines[index].isMouseFocusSchool = false;
      }
      if (inputName === "MajorField") {
        this.education_lines[index].isMouseLeaveMajorField = true;
        this.education_lines[index].isMouseFocusMajorField = false;
      }
      if (inputName === "degree") {
        this.education_lines[index].isMouseLeaveDegree = true;
        this.education_lines[index].isMouseFocusDegree = false;
      }
      if (inputName === "city") {
        this.education_lines[index].isMouseLeaveCity = true;
        this.education_lines[index].isMouseFocusCity = false;
      }
      if (inputName === "state") {
        this.education_lines[index].isMouseLeaveState = true;
        this.education_lines[index].isMouseFocusState = false;
      }
      if (inputName === "country") {
        this.education_lines[index].isMouseLeaveCountry = true;
        this.education_lines[index].isMouseFocusCountry = false;
      }
      if (inputName === "month") {
        this.education_lines[index].isMouseLeaveMonth = true;
        this.education_lines[index].isMouseFocusMonth = false;
      }
      if (inputName === "year") {
        this.education_lines[index].isMouseLeaveYear = true;
        this.education_lines[index].isMouseFocusYear = false;
      }
      if (inputName === "CreditCompleted") {
        this.education_lines[index].isMouseLeaveCreditCompleted = true;
        this.education_lines[index].isMouseFocusCreditCompleted = false;
      }
    },
    inputFocusEducation(inputName, index) {
      if (inputName === "School") {
        this.education_lines[index].isMouseFocusSchool = true;
        this.education_lines[index].isMouseLeaveSchool = false;
      }
      if (inputName === "MajorField") {
        this.education_lines[index].isMouseFocusMajorField = true;
        this.education_lines[index].isMouseLeaveMajorField = false;
      }
      if (inputName === "degree") {
        this.education_lines[index].isMouseFocusDegree = true;
        this.education_lines[index].isMouseLeaveDegree = false;
      }
      if (inputName === "city") {
        this.education_lines[index].isMouseLeaveCity = false;
        this.education_lines[index].isMouseFocusCity = true;
      }
      if (inputName === "state") {
        this.education_lines[index].isMouseLeaveState = false;
        this.education_lines[index].isMouseFocusState = true;
      }
      if (inputName === "country") {
        this.education_lines[index].isMouseLeaveCountry = false;
        this.education_lines[index].isMouseFocusCountry = true;
      }
      if (inputName === "month") {
        this.education_lines[index].isMouseLeaveMonth = false;
        this.education_lines[index].isMouseFocusMonth = true;
      }
      if (inputName === "year") {
        this.education_lines[index].isMouseLeaveYear = false;
        this.education_lines[index].isMouseFocusYear = true;
      }
      if (inputName === "CreditCompleted") {
        this.education_lines[index].isMouseLeaveCreditCompleted = false;
        this.education_lines[index].isMouseFocusCreditCompleted = true;
      }
    },
    IsNextEducation(gotonext, addnew, index) {
      if (
        this.education_lines[index].School != "" &&
        this.education_lines[index].City != "" &&
        this.education_lines[index].state != "" &&
        this.education_lines[index].country != "" &&
        this.education_lines[index].degree != ""
      ) {
        this.Gotonext = gotonext;
        this.Addnew = addnew;
        this.Index = index;
        let nodateerror = true;

        if (this.education_lines[index].showCreditCompleted) {
          if (this.education_lines[index].CreditCompleted == "") {
            this.wh_error = true;
            this.errors = [];
            this.errors.push(
              "Please complete all of the required fields with the *"
            );
            nodateerror = false;
          }
        }

        if (nodateerror) {
          let querystring = require("querystring");
          let page = 3;
          if (gotonext) {
            page = 4;
          }
          var Month = this.education_lines[index].month;
          var Year = this.education_lines[index].year;
          var d = new Date();
          var Form_month = d.getMonth() + 1;
          var Form_year = d.getFullYear();

          if (
            Year >= Form_year &&
            this.education_lines[index].showCreditCompleted
          ) {
            if (Month >= Form_month) {
              this.FutureORCurrent = true;
              return false;
            } else {
              this.FutureORCurrent = false;
            }
          } else {
            this.FutureORCurrent = false;
          }

          if (
            (Year == null || Year == "") &&
            this.education_lines[index].showCreditCompleted != true
          ) {
            this.FutureORCurrent = true;
            return false;
          } else {
            this.FutureORCurrent = false;
          }

          if (
            (Year == null || Year == "") &&
            this.education_lines[index].showCreditCompleted
          ) {
            this.FutureORCurrent = true;
            return false;
          } else {
            this.FutureORCurrent = false;
          }

          window.axios
            .post(
              this.EnvPath + "educationhistory",
              querystring.stringify({
                School: this.education_lines[index].School,
                City: this.education_lines[index].City,
                State: this.education_lines[index].state,
                Country: this.education_lines[index].country,
                Degree: this.education_lines[index].degree,
                MajorField: this.education_lines[index].MajorField,
                CreditCompleted: this.education_lines[index].CreditCompleted,
                OtherDegree: this.education_lines[index].OtherDegree,
                master_school_id: this.education_lines[index].master_school_id,
                Month: this.education_lines[index].month,
                Year: this.education_lines[index].year,
                db_education_id: this.education_lines[index].db_education_id,
                b4_CreditCompleted:
                  this.education_lines[index].b4_CreditCompleted,
                Page: page,
              })
            )
            .then(({ data }) => {
              if (data.status == 1) {
                this.education_lines[index].db_education_id = data.db_id;
                //this.IsNext_f = true;
                if (gotonext) {
                  this.$router.push({ name: "my-resume" });
                } else {
                  this.education_lines[index].b4_master_school_id =
                    this.education_lines[index].master_school_id;
                  this.education_lines[index].b4_School =
                    this.education_lines[index].School;
                  this.education_lines[index].b4_City =
                    this.education_lines[index].City;
                  this.education_lines[index].b4_state =
                    this.education_lines[index].state;
                  this.education_lines[index].b4_country =
                    this.education_lines[index].country;
                  this.education_lines[index].b4_degree =
                    this.education_lines[index].degree;
                  this.education_lines[index].b4_MajorField =
                    this.education_lines[index].MajorField;
                  this.education_lines[index].b4_month =
                    this.education_lines[index].month;
                  this.education_lines[index].b4_year =
                    this.education_lines[index].year;

                  this.education_lines[index].show = false;
                  this.education_lines[index].education_head =
                    this.education_lines[index].School +
                    ", " +
                    this.degrees[this.education_lines[index].degree - 1];

                  if (addnew) {
                    if (
                      this.education_lines[this.education_lines.length - 1]
                        .School != ""
                    ) {
                      this.addEducationLine();
                    } else {
                      this.education_lines[
                        this.education_lines.length - 1
                      ].show = true;
                      this.current_index = this.education_lines.length - 1;
                    }
                  }
                }
                this.wh_error = false;
                this.errors = [];
              } else {
                this.wh_error = false;
                this.errors = [];
                //this.errors.push(data.message);
              }
            });
        }
      } else {
        if (this.education_lines[index].School != "") {
          this.wh_error = true;
          this.errors = [];
          this.errors.push(
            "Please complete all of the required fields with the *"
          );
        } else {
          if (gotonext) {
            this.showedunextModal = true;
          } else {
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
      window.location.reload();
    },
    cancel: function (index) {
      if (this.education_lines[index].b4_School != "") {
        this.education_lines[index].show = false;
        this.education_lines[index].School =
          this.education_lines[index].b4_School;
        this.education_lines[index].City = this.education_lines[index].b4_City;
        this.education_lines[index].state =
          this.education_lines[index].b4_state;
        this.education_lines[index].country =
          this.education_lines[index].b4_country;
        this.education_lines[index].degree =
          this.education_lines[index].b4_degree;
        this.education_lines[index].MajorField =
          this.education_lines[index].b4_MajorField;
        this.education_lines[index].CreditCompleted =
          this.education_lines[index].b4_CreditCompleted;
        this.education_lines[index].month =
          this.education_lines[index].b4_month;
        this.education_lines[index].year = this.education_lines[index].b4_year;

        if (
          this.education_lines[index].b4_degree == 1 ||
          this.education_lines[index].b4_degree == 2
        ) {
          this.education_lines[index].showMajorField = false;
          this.education_lines[index].showCreditCompleted = false;
        } else if (this.education_lines[index].b4_degree == 16) {
          this.education_lines[index].showMajorField = true;
          this.education_lines[index].showCreditCompleted = true;
        } else {
          this.education_lines[index].showMajorField = true;
          this.education_lines[index].showCreditCompleted = false;
        }
      } else {
        this.education_lines.splice(index, 1);
      }
      this.current_index = this.education_lines.length - 1;
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

