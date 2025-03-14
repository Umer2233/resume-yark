<template>
  <div>
    <div class="card finder_card">
      <div class="card-header finder_head" id="headingOne">
        <div
          data-toggle="collapse"
          @click="addClass(k)"
          :data-target="['#collapseOne' + k]"
          aria-expanded="false"
          :aria-controls="['#collapseOne' + k]"
        >
          <div class="tab-number" :class="['tab-number-' + k]">
            <span>{{ k + 1 }}.</span>
          </div>
          <div v-if="k < 9" class="tab-content-div">
            <p>{{ ExperienceQuestions[k] }}</p>
            <button
              v-if="
                UserExperienceCount[k] != 0 &&
                UserExperienceCount[k] != undefined
              "
              type="button"
              class="btn btn-link fill_number"
            >
              <span>{{ UserExperienceCount[k] }}</span>
            </button>
            <button v-else class="btn btn-link" type="button">
              <i class="fa fa-plus"></i>
            </button>
          </div>
          <div v-else class="tab-content-div" style="margin-left: 80px">
            <p>{{ ExperienceQuestions[k] }}</p>
            <button
              v-if="
                UserExperienceCount[k] != 0 &&
                UserExperienceCount[k] != undefined
              "
              type="button"
              class="btn btn-link fill_number"
            >
              <span>{{ UserExperienceCount[k] }}</span>
            </button>
            <button v-else class="btn btn-link" type="button">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
      <div
        :id="['collapseOne' + k]"
        class="collapse"
        aria-labelledby="headingOne"
        data-parent="#accordionExample"
      >
        <div class="card-body-content">
          <div
            class="card-body"
            v-if="
              Answer_description[0] == 0 ||
              Answer_description[k].length == 0 ||
              editQuestion == true ||
              addMore == true
            "
          >
            <!-- <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
                            <div role="document" class="modal-dialog" style="top: 250px; width: 300px;">
                              <div class="modal-content">
                                <div class="modal-body">Do you want to delete this degree?</div>
                                <div  class="modal-footer">
                                  <button type="button" data-dismiss="modal" class="btn">Yes</button>
                                  <button type="button" data-dismiss="modal" class="btn">No</button>
                                </div>
                              </div>
                            </div>
                          </div> -->
            <div
              class="row finder_text"
              style="padding-left: 5px; padding-right: 5px"
            >
              <div class="col-12">
                <textarea
                  rows="3"
                  style="width: 100%; margin-bottom: 0"
                  v-model="ExperienceAnswer[0]"
                  @keyup="DataCount(k)"
                  >{{ ExperienceAnswer[0] }}</textarea
                >
                <span
                  v-if="WordTab == true"
                  class="label"
                  :class="
                    green === true
                      ? 'success-green'
                      : yellow === true
                      ? 'success-yellow'
                      : 'success-red'
                  "
                  >{{ wordCount[k] == null ? 0 : wordCount[k] }} Words</span
                >
              </div>

              <div class="col-12">
                <div
                  class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                >
                  <input
                    class="custom-control-input form-check-input"
                    @click="checkBoxClick('made_money')"
                    :checked="DisplayCheckType[0] == 'made_money'"
                    name="type"
                    type="checkbox"
                    :id="['customCheck' + k]"
                    value="made_money"
                  />
                  <label
                    class="custom-control-label form-check-label"
                    :for="['customCheck' + k]"
                    >Made Money</label
                  >
                </div>
                <div
                  class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                >
                  <input
                    class="custom-control-input form-check-input"
                    @click="checkBoxClick('more_efficient')"
                    :checked="DisplayCheckType[0] == 'more_efficient'"
                    name="type"
                    type="checkbox"
                    :id="['customCheck' + k]"
                    value="more_efficient"
                  />
                  <label
                    class="custom-control-label form-check-label"
                    for="customCheck"
                    >More Efficient</label
                  >
                </div>
                <div
                  class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                >
                  <input
                    class="custom-control-input form-check-input"
                    @click="checkBoxClick('cur_cost')"
                    :checked="DisplayCheckType[0] == 'cur_cost'"
                    name="type"
                    type="checkbox"
                    :id="['customCheck' + k]"
                    value="cur_cost"
                  />
                  <label
                    class="custom-control-label form-check-label"
                    :for="['customCheck' + k]"
                    >Cut Costs</label
                  >
                </div>
                <div
                  class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                >
                  <input
                    class="custom-control-input form-check-input"
                    @click="checkBoxClick('solve_problem')"
                    :checked="DisplayCheckType[0] == 'solve_problem'"
                    name="type"
                    type="checkbox"
                    :id="['customCheck' + k]"
                    value="solve_problem"
                  />
                  <label
                    class="custom-control-label form-check-label"
                    :for="['customCheck' + k]"
                    >Solved a Problem</label
                  >
                </div>
                <div
                  class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
                >
                  <input
                    class="custom-control-input form-check-input"
                    @click="checkBoxClick('other')"
                    name="type"
                    :checked="DisplayCheckType[0] == 'other'"
                    type="checkbox"
                    :id="['customCheck' + k]"
                    value="other"
                  />
                  <label
                    class="custom-control-label form-check-label"
                    :for="['customCheck' + k]"
                    >Other</label
                  >
                </div>
              </div>

              <div
                class="col-md-5 col-sm-6 job_finder_label"
                style="max-width: 280px"
              >
                <p
                  style="
                    font-family: Hind;
                    font-weight: 700;
                    font-size: 16px;
                    color: #767676;
                    text-align: left;
                  "
                >
                  Position this experience relates to:
                </p>
              </div>
              <div class="col-md-6 select-arrow-side col-sm-6 job_name_finder inputP55">
                <select
                  v-on:change="GetjobId"
                  name="job_name"
                  id=""
                  class="select-item select-item-job-name input mouseLeave"
                  style="-webkit-appearance: none"
                >
                  <option>Select</option>
                  <option
                    :value="Job.id"
                    v-for="(Job, index) in JobDropDown"
                    v-bind:key="index"
                    :selected="Job.id == jobData"
                  >
                    {{ Job.position }} ({{ Job.company }})
                  </option>
                  <option :selected="jobData == null" value="school_volu_exp">
                    School / Volunteer Experience
                  </option>
                </select>
              </div>
            </div>
            <div
              class="confirm confirm_finder"
              style="text-align: right; display: inline-block; width: 100%"
            >
              <i
                class="fa fa-check-circle"
                style="font-size: 30px; color: rgb(251, 100, 62)"
                @click="saveData(k)"
              ></i>
              <i
                class="fa fa-times-circle"
                style="font-size: 30px; color: rgb(251, 100, 62)"
                @click="clearData()"
              ></i>
              <i
                data-toggle="modal"
                data-target="#exampleModal"
                class="fa fa-2x fa fa-trash experience-trash"
                @click="DeleteClick()"
              ></i>
            </div>
          </div>
          <div
            v-if="
              (Answer_description[k].length > 0 &&
                Answer_description[k] != 0) ||
              Answer_description[0] != 0
            "
          >
            <div
              class="card-body"
              v-for="(des_data, k2) in Answer_description[k]"
              :key="k2"
            >
              <!-- <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
                              <div role="document" class="modal-dialog" style="top: 250px; width: 300px;">
                                <div class="modal-content">
                                  <div class="modal-body"> Do you want to delete this degree?</div>
                                    <div class="modal-footer">
                                      <button type="button" data-dismiss="modal" class="btn">Yes</button>
                                      <button type="button" data-dismiss="modal" class="btn">No</button>
                                    </div>
                                </div>
                              </div>
                            </div> -->
              <div class="containers" @click="EditQuestion(k, k2)">
                <div
                  class="row finder_text"
                  style="padding-left: 5px; padding-right: 5px"
                >
                  <div class="col-12 text-left save-text">
                    <div class="hover-text">{{ des_data.description }}</div>
                    <br /><span class="hover-text">
                      <strong v-if="des_data.type == 'made_money'"
                        >Made Money</strong
                      >
                      <strong v-if="des_data.type == 'more_efficient'"
                        >More Efficient</strong
                      >
                      <strong v-if="des_data.type == 'cur_cost'"
                        >Cur Cost</strong
                      >
                      <strong v-if="des_data.type == 'solve_problem'"
                        >Solve a Problem</strong
                      >
                      <strong v-if="des_data.type == 'other'">Other</strong>
                      <span
                        v-for="(Job, index) in JobDropDown"
                        v-bind:key="index"
                      >
                        <span v-if="Job.id == des_data.job_id">
                          as <strong>{{ Job.position }}</strong> at
                          <strong>{{ Job.company }}</strong>
                        </span>
                      </span>
                    </span>
                    <div class="middle">
                      <div class="text">
                        <img
                          class="edit-image"
                          :src="EnvPath + 'images/button/edit.svg'"
                          alt=""
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-12"
            v-if="Answer_description[k] != 0 || Answer_description[0] == 0"
          >
            <button
              type="button"
              @click="addMoreAnswer(k)"
              class="btn btn-block"
              style="
                border: 3px solid rgb(244, 244, 245);
                color: rgb(223, 223, 223);
                padding: 8px 0px;
                font-size: 18px;
                margin-top: 20px;
                margin-bottom: 15px;
                border-radius: 10px;
              "
            >
              +Add New
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import Common from "../../mixins/Common";
import { environment_api } from "../../env";
import resumeSidemenu from "./resumeSidemenu";
import store from "../../store";

export default {
  name: "experience-finder",
  mixins: [Common],

  data() {
    return {
      EnvPath: environment_api.api_url,
      classVar: "",
      ExperienceQuestions: [],
      UserExperienceCount: [],
      userPosition_id: [],
      userQuestion_id: [],
      Answer_description: [],
      Answer_description_only: [],
      Answer_id: [],
      dataSaved: false,
      green: true,
      yellow: false,
      red: false,
      WordTab: false,
      wordCount: [],
      JobDropDown: [],
      JobDropdownId: "",
      jobData: [],
      ExperienceAnswer: [],
      editQuestion: false,
      addMore: false,
      Answer_question_id: "",
      Answer_position_id: "",
      CloseInfo: false,
      notValid: false,
      DeleteData: false,
      NextClick: false,
      expand_experience_finder: [],
      checkType: [],
      DisplayCheckType: [],
      popupCheck: "",
      addQuestionBtn: false,
      MoreQuestions: false,
      Expand_Experienc: "",
      page: 0,
      MoreText: true,
    };
  },
  components: {
    resumeSidemenu,
  },
  methods: {
    checkBoxClick(data) {
      $('input[type="checkbox"]').on("change", function () {
        $('input[type="checkbox"]').not(this).prop("checked", false);
      });
      this.DisplayCheckType = [];
      // this.DisplayCheckType = data;
      this.DisplayCheckType.push(data);
    },
    nextClick() {
      this.NextClick = this.popupCheck;
      if (this.popupCheck == false) {
        if (this.$store.state.userData.page == 6) {
          this.$router.push({ name: "education_enhancement" });
        }
      }
      // else if(this.popupCheck == true){
      //   if(this.$store.state.userData.page == 7) {
      //     this.$router.push({ name: "education_enhancement" });
      //   }
      // }
    },
    cancelBtn() {
      this.addQuestionBtn = !this.addQuestionBtn;
    },
    AddQuestionBtn() {
      this.addQuestionBtn = !this.addQuestionBtn;
    },
    NoThanks() {
      this.NextClick = !this.NextClick;
      if (
        localStorage.getItem("resume_id") != "" ||
        localStorage.getItem("resume_id") != undefined
      ) {
        var resume_id = localStorage.getItem("resume_id");
      } else if (this.$store.state.ResumeName_Data !== "") {
        if (this.$store.state.ResumeName_Data.data.length > 0) {
          var resume_id =
            this.$store.state.ResumeName_Data.data[
              this.$store.state.ResumeName_Data.data.length - 1
            ].resume_id;
        }
      }
      //  if (this.$store.state.ResumeName_Data !== "") {
      //    if (this.$store.state.ResumeName_Data.data.length > 0) {
      //      var resume_id = this.$store.state.ResumeName_Data.data[
      //        this.$store.state.ResumeName_Data.data.length - 1
      //     ].resume_id;
      //   }
      // }
      // if(localStorage.getItem('resume_id') != '' || localStorage.getItem('resume_id') != undefined){
      //   var resume_id = localStorage.getItem('resume_id')
      // }
      var that = this;
      axios
        .post(this.EnvPath + "show-more-question", {
          resume_id: resume_id,
          page: 7,
          btnClick: "noThanks",
        })
        .then(({ data }) => {
          if (data.status == 1) {
            if (data != null) {
              if (that.$store.state.userData.page == 7) {
                that.$router.push({ name: "education_enhancement" });
              }
            }
          }
        });
    },
    showMeMoreQuestion(btn, fromOtherCall = "", index = "") {
      if (btn == 1) {
        if (fromOtherCall == "") {
          this.NextClick = false;
          this.addQuestionBtn = false;
          var showMeMoreQuestion = "showMeMoreQuestion";
        } else {
          var showMeMoreQuestion = "FromOtherCall";
        }
        this.MoreQuestions = true;
        // if (this.$store.state.ResumeName_Data !== "") {
        //   if (this.$store.state.ResumeName_Data.data.length > 0) {
        //     var resume_id = this.$store.state.ResumeName_Data.data[
        //       this.$store.state.ResumeName_Data.data.length - 1
        //     ].resume_id;
        //   }
        // }
        // if(localStorage.getItem('resume_id') != '' || localStorage.getItem('resume_id') != undefined){
        //   var resume_id = localStorage.getItem('resume_id')
        // }

        if (
          localStorage.getItem("resume_id") != "" ||
          localStorage.getItem("resume_id") != undefined
        ) {
          var resume_id = localStorage.getItem("resume_id");
        } else if (this.$store.state.ResumeName_Data !== "") {
          if (this.$store.state.ResumeName_Data.data.length > 0) {
            var resume_id =
              this.$store.state.ResumeName_Data.data[
                this.$store.state.ResumeName_Data.data.length - 1
              ].resume_id;
          }
        }

        var that = this;
        axios
          .post(this.EnvPath + "show-more-question", {
            resume_id: resume_id,
            btnClick: showMeMoreQuestion,
          })
          .then(({ data }) => {
            if (data.status == 1) {
              this.MoreText = false;
              if (data != null) {
                if (
                  that.Answer_description_only.length !==
                  that.Answer_description.length
                ) {
                  that.Answer_description.splice(
                    that.Answer_description_only.length - 1,
                    that.Answer_description.length - 1
                  );
                }
                data.data.map(function (value, id) {
                  if (value.profile_question != "") {
                    that.ExperienceQuestions.push(value.profile_question);
                  } else {
                    that.ExperienceQuestions.push(value.question);
                  }

                  if (value.experience_time !== undefined) {
                    that.UserExperienceCount.push(value.experience_time);
                  }
                  that.userPosition_id.push(value.position_id);
                  that.userQuestion_id.push(value.que_id);
                  // value.Experience !== undefined
                  if (
                    typeof value.Experience != "undefined" ||
                    value.Experience.length == 0 ||
                    value.Experience != null ||
                    value.Experience.length != null ||
                    value.Experience.length > 0
                  ) {
                    that.Answer_description.push(value.Experience);
                    // that.Answer_description_only.push(value.Experience)
                  } else {
                    that.Answer_description.push("0");
                    // that.Answer_description_only.push('0')
                  }

                  if (value.expand_experienc !== null) {
                    that.expand_experience_finder.push(value.expand_experienc);
                  } else {
                    that.expand_experience_finder.push(null);
                  }

                  if (value.Experience !== undefined) {
                    if (value.Experience.length > 0) {
                      that.dataSaved = true;
                    }
                  }
                  value.Experience.map(function (value, id) {
                    if (value.type != null) {
                      that.checkType.push(value.type);
                    } else {
                      that.checkType.push("0");
                    }
                  });
                });
              }
            }
          });
      }
      // this.checkNextCondition();
    },
    closePoup() {
      this.notValid = false;
    },
    GetjobId(e) {
      this.jobData = e.target.value;
    },
    closeInfo() {
      this.CloseInfo = true;
    },
    addMoreAnswer(k) {
      this.Answer_description[k] = [];
      this.addMore = true;
      this.ExperienceAnswer = [];
      this.WordTab = false;
      this.checkType = [];
    },
    addClass(no) {
      this.ExperienceAnswer = [];
      this.jobData = [];
      this.editQuestion = false;
      this.addMore = false;
      this.WordTab = false;
      this.green = true;
      this.yellow = false;
      this.red = false;
      $(".finder_card").removeClass("finder_active");
      $(".tab-number-" + no)
        .closest(".finder_card")
        .toggleClass("finder_active");
      // $('.collapse').removeClass('show')
      if (this.Answer_description_only.length - 1 >= no) {
        if (this.MoreQuestions == true) {
          this.LoadQuestion(no);
          this.showMeMoreQuestion(1, "FromOtherCall");
        }
      } else {
      }
    },
    WordCount(str) {
      return str.split(" ").length;
    },
    DataCount(id) {
      let strlength = this.ExperienceAnswer[0].length;
      let str = this.ExperienceAnswer[0];
      var newText = str.split(/\s/).join("");
      let trim = newText.length;
      this.wordCount[id] = this.WordCount(str);
      if ((strlength >= 50 && strlength < 130) || (trim >= 45 && trim < 110)) {
        this.green = true;
        this.yellow = false;
        this.red = false;
        this.WordTab = true;
      } else if (
        (strlength < 195 && strlength >= 130) ||
        (trim < 166 && trim >= 110)
      ) {
        this.yellow = true;
        this.red = false;
        this.green = false;
        this.WordTab = true;
      } else if (strlength >= 195 || trim >= 166) {
        this.yellow = false;
        this.red = true;
        this.green = false;
        this.WordTab = true;
      }
    },
    LoadQuestion(no = "") {
      // if (this.$store.state.ResumeName_Data !== "" && this.$store.state.ResumeName_Data.length != 0) {
      //   if (this.$store.state.ResumeName_Data.data.length > 0) {
      //     var resume_id = this.$store.state.ResumeName_Data.data[
      //       this.$store.state.ResumeName_Data.data.length - 1
      //     ].resume_id;
      //    }
      // }
      // if(localStorage.getItem('resume_id') != '' || localStorage.getItem('resume_id') != undefined){
      //   var resume_id = localStorage.getItem('resume_id')
      // }
      if (
        localStorage.getItem("resume_id") != "" ||
        localStorage.getItem("resume_id") != undefined
      ) {
        var resume_id = localStorage.getItem("resume_id");
      } else if (this.$store.state.ResumeName_Data !== "") {
        if (this.$store.state.ResumeName_Data.data.length > 0) {
          var resume_id =
            this.$store.state.ResumeName_Data.data[
              this.$store.state.ResumeName_Data.data.length - 1
            ].resume_id;
        }
      }
      let that = this;
      axios
        .post(this.EnvPath + "load-questions", { resume_id: resume_id })
        .then(({ data }) => {
          if (data.status == 1) {
            store.commit("loadQuestions", data.data);
            if (data != null) {
              that.ExperienceQuestions = [];
              that.UserExperienceCount = [];
              that.userPosition_id = [];
              that.userQuestion_id = [];
              that.Answer_description = [];
              that.Answer_description_only = [];
              that.checkType = [];
              data.data.map(function (value, id) {
                if (value.profile_question != "") {
                  that.ExperienceQuestions.push(value.profile_question);
                } else {
                  that.ExperienceQuestions.push(value.question);
                }

                if (value.experience_time !== undefined) {
                  that.UserExperienceCount.push(value.experience_time);
                }
                that.userPosition_id.push(value.position_id);
                that.userQuestion_id.push(value.que_id);
                if (value.Experience !== undefined) {
                  that.Answer_description.push(value.Experience);
                  that.Answer_description_only.push(value.Experience);
                } else {
                  that.Answer_description.push("0");
                  that.Answer_description_only.push("0");
                }

                if (value.expand_experienc !== null) {
                  that.expand_experience_finder.push(value.expand_experienc);
                } else {
                  that.expand_experience_finder.push(null);
                }

                if (value.Experience !== undefined) {
                  if (value.Experience.length > 0) {
                    that.dataSaved = true;
                  }
                }
                value.Experience.map(function (value, id) {
                  if (value.type != null) {
                    that.checkType.push(value.type);
                  } else {
                    that.checkType.push("0");
                  }
                });
              });
            }
          }
        });
    },
    getJob() {
      axios.get(this.EnvPath + "get-job").then(({ data }) => {
        if (data.status == 1) {
          store.commit("GetJob", data.data);
          if (data != null) {
            this.JobDropDown = data.data;
          }
        }
      });
    },
    checkNextCondition() {
      if (
        localStorage.getItem("resume_id") != "" ||
        localStorage.getItem("resume_id") != undefined
      ) {
        var resume_id = localStorage.getItem("resume_id");
      } else if (this.$store.state.ResumeName_Data !== "") {
        if (this.$store.state.ResumeName_Data.data.length > 0) {
          var resume_id =
            this.$store.state.ResumeName_Data.data[
              this.$store.state.ResumeName_Data.data.length - 1
            ].resume_id;
        }
      }
      var data = {
        resume_id: resume_id,
      };
      axios
        .post(this.EnvPath + "check-next-condition", data)
        .then(({ data }) => {
          if (data.status == 1) {
            if (data != null) {
              this.popupCheck = data.popup;
              if (data.expand_experienc == 1) {
                this.MoreText = false;
              } else {
                this.MoreText = true;
              }
            }
            this.showMeMoreQuestion(1, "FromOtherCall");
          }
        });
    },
    saveData(k) {
      if (this.jobData == "school_volu_exp") {
        this.jobData = null;
      }
      let that = this;
      if (
        that.jobData != "" &&
        that.ExperienceAnswer[0] != "" &&
        that.DisplayCheckType[0] != ""
      ) {
        // if (this.$store.state.ResumeName_Data !== "") {
        //   if (this.$store.state.ResumeName_Data.data.length > 0) {
        //     var resume_id = this.$store.state.ResumeName_Data.data[
        //       this.$store.state.ResumeName_Data.data.length - 1
        //     ].resume_id;
        //   }
        // }
        // if(localStorage.getItem('resume_id') != '' || localStorage.getItem('resume_id') != undefined){
        //       var resume_id = localStorage.getItem('resume_id')
        // }
        if (
          localStorage.getItem("resume_id") != "" ||
          localStorage.getItem("resume_id") != undefined
        ) {
          var resume_id = localStorage.getItem("resume_id");
        } else if (this.$store.state.ResumeName_Data !== "") {
          if (this.$store.state.ResumeName_Data.data.length > 0) {
            var resume_id =
              this.$store.state.ResumeName_Data.data[
                this.$store.state.ResumeName_Data.data.length - 1
              ].resume_id;
          }
        }
        if (this.editQuestion == false) {
          this.addMore = false;
          const data = {
            description: that.ExperienceAnswer[0],
            job_id: that.jobData,
            question_id: that.userQuestion_id[k],
            position_id: that.userPosition_id[k],
            result_id: null,
            resume_id: resume_id,
            type: that.DisplayCheckType[0],
            page: 6,
          };
          axios
            .post(this.EnvPath + "save-experience-finder", data)
            .then(function (response) {
              if (response.data.status == 1) {
                that.dataSaved = true;
                store.commit("loadQuestions", response.data);
                if (response.data != null) {
                  that.ExperienceQuestions = [];
                  that.UserExperienceCount = [];
                  that.userPosition_id = [];
                  that.userQuestion_id = [];
                  that.Answer_description = [];
                  that.Answer_description_only = [];
                  that.checkType = [];
                  response.data.data.map(function (value, id) {
                    //   that.ExperienceQuestions.push(value.profile_question);
                    //   that.UserExperienceCount.push(value.experience_time);
                    //   that.userPosition_id.push(value.position_id);
                    //   that.userQuestion_id.push(value.que_id);
                    //   that.Answer_description.push(value.Experience)
                    //   that.checkType.push(value.type)
                    //   if(value.Experience.length > 0){
                    //         that.dataSaved = true;
                    //   }
                    // value.Experience.map(function (value, id) {
                    //     that.checkType.push(value.type)
                    // })
                    if (value.profile_question != "") {
                      that.ExperienceQuestions.push(value.profile_question);
                    } else {
                      that.ExperienceQuestions.push(value.question);
                    }
                    if (value.experience_time !== undefined) {
                      that.UserExperienceCount.push(value.experience_time);
                    }
                    that.userPosition_id.push(value.position_id);
                    that.userQuestion_id.push(value.que_id);
                    if (value.Experience !== undefined) {
                      that.Answer_description.push(value.Experience);
                      that.Answer_description_only.push(value.Experience);
                    } else {
                      that.Answer_description.push("0");
                      that.Answer_description_only.push("0");
                    }

                    if (value.expand_experienc !== null) {
                      that.expand_experience_finder.push(
                        value.expand_experienc
                      );
                    } else {
                      that.expand_experience_finder.push(null);
                    }

                    if (value.Experience !== undefined) {
                      if (value.Experience.length > 0) {
                        that.dataSaved = true;
                      }
                    }
                    value.Experience.map(function (value, id) {
                      if (value.type != null) {
                        that.checkType.push(value.type);
                      } else {
                        that.checkType.push("0");
                      }
                    });
                  });
                }
              }
            });
          this.showMeMoreQuestion(1, "FromOtherCall");
        } else {
          this.editQuestion = false;
          axios
            .post(this.EnvPath + "edit-experience-finder", {
              id: that.Answer_id,
              description: that.ExperienceAnswer[0],
              job_id: that.jobData,
              question_id: that.Answer_question_id,
              position_id: that.Answer_position_id,
              result_id: null,
              resume_id: resume_id,
              type: that.DisplayCheckType[0],
              page: 6,
            })
            .then(function (response) {
              if (response.data.status == 1) {
                that.dataSaved = true;
                store.commit("loadQuestions", response.data);
                if (response.data != null) {
                  that.ExperienceQuestions = [];
                  that.UserExperienceCount = [];
                  that.userPosition_id = [];
                  that.userQuestion_id = [];
                  that.Answer_description = [];
                  that.Answer_description_only = [];
                  that.checkType = [];
                  response.data.data.map(function (value, id) {
                    //   that.ExperienceQuestions.push(value.profile_question);
                    //   that.UserExperienceCount.push(value.experience_time);
                    //   that.userPosition_id.push(value.position_id);
                    //   that.userQuestion_id.push(value.que_id);
                    //   that.Answer_description.push(value.Experience)
                    //   that.checkType.push(value.type)
                    //   if(value.Experience.length > 0){
                    //       that.dataSaved = true;
                    //   }
                    // value.Experience.map(function (value, id) {
                    //     that.checkType.push(value.type)
                    // })
                    that.ExperienceQuestions.push(value.profile_question);
                    if (value.experience_time !== undefined) {
                      that.UserExperienceCount.push(value.experience_time);
                    }
                    that.userPosition_id.push(value.position_id);
                    that.userQuestion_id.push(value.que_id);
                    if (value.Experience !== undefined) {
                      that.Answer_description.push(value.Experience);
                      that.Answer_description_only.push(value.Experience);
                    } else {
                      that.Answer_description.push("0");
                      that.Answer_description_only.push("0");
                    }

                    if (value.expand_experienc !== null) {
                      that.expand_experience_finder.push(
                        value.expand_experienc
                      );
                    } else {
                      that.expand_experience_finder.push(null);
                    }

                    if (value.Experience !== undefined) {
                      if (value.Experience.length > 0) {
                        that.dataSaved = true;
                      }
                    }
                    value.Experience.map(function (value, id) {
                      if (value.type != null) {
                        that.checkType.push(value.type);
                      } else {
                        that.checkType.push("0");
                      }
                    });
                  });
                }
              }
            });
          this.showMeMoreQuestion(1, "FromOtherCall");
        }
      } else {
        this.notValid = true;
      }
    },
    clearData() {
      this.ExperienceAnswer = [];
      this.jobData = [];
      this.editQuestion = false;
      this.addMore = false;
      this.WordTab = false;
      this.green = true;
      this.yellow = false;
      this.red = false;
      this.LoadQuestion();
      this.showMeMoreQuestion(1, "FromOtherCall");
    },
    deleteRecourd() {
      this.editQuestion = false;
      let that = this;
      axios
        .post(this.EnvPath + "delete-experience-finder", {
          id: this.Answer_id,
        })
        .then(function (response) {
          if (response.data.status == 1) {
            that.DeleteData = false;
            that.clearData();
          }
        });
    },
    DeleteClick() {
      this.DeleteData = !this.DeleteData;
    },
    getEducationEnhancement() {
      axios
        .get(this.EnvPath + "education_enhancement")
        .then((response) => {
          store.commit("EducationEnhancementData", response.data);
        })
        .catch((error) => console.log(error));
    },
    EditQuestion(k, k2) {
      this.ExperienceAnswer = [];
      this.DisplayCheckType = [];
      this.jobData = [];
      this.Answer_id = [];
      this.ExperienceAnswer.push(this.Answer_description[k][k2].description);
      this.DisplayCheckType.push(this.Answer_description[k][k2].type, k2);
      this.dataSaved = false;
      this.editQuestion = true;
      this.jobData = this.Answer_description[k][k2].job_id;
      this.Answer_id = this.Answer_description[k][k2].id;
      this.Answer_question_id = this.Answer_description[k][k2].question_id;
      this.Answer_position_id = this.Answer_description[k][k2].position_id;
      this.Answer_description[k] = [];

      let strlength = this.ExperienceAnswer[0].length;
      let str = this.ExperienceAnswer[0];
      var newText = str.split(/\s/).join("");
      let trim = newText.length;
      this.wordCount[k] = this.WordCount(str);
      if ((strlength >= 50 && strlength < 130) || (trim >= 45 && trim < 110)) {
        this.green = true;
        this.yellow = false;
        this.red = false;
        this.WordTab = true;
      } else if (
        (strlength < 195 && strlength >= 130) ||
        (trim < 166 && trim >= 110)
      ) {
        this.yellow = true;
        this.red = false;
        this.green = false;
        this.WordTab = true;
      } else if (strlength >= 195 || trim >= 166) {
        this.yellow = false;
        this.red = true;
        this.green = false;
        this.WordTab = true;
      }
    },
  },
  beforeMount() {
    this.loadResumes();
  },
};
</script>
  
  