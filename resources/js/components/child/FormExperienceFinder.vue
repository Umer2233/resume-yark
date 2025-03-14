<template>
  <div class="card-body" id="addCard">
    <!-- <div
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      class="modal fade"
    >
      <div
        role="document"
        class="modal-dialog"
        style="top: 250px; width: 300px"
      >
        <div class="modal-content">
          <div class="modal-body">Do you want to delete this degree?</div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn">Yes</button>
            <button type="button" data-dismiss="modal" class="btn">No</button>
          </div>
        </div>
      </div>
    </div> -->
    <div class="row finder_text" style="padding-left: 5px; padding-right: 5px">
      <div class="col-12">
        <textarea
          @keyup="experienceDescription($event, formId)"
          style="width: 100%"
          :value="experience_object[formId]"
        ></textarea>
        <span
          v-if="
            experience_object[formId] && experience_object[formId].length > 50
          "
          class="label"
          :class="
            experience_object[formId].length > 195
              ? 'success-red'
              : experience_object[formId].length > 130
              ? 'success-yellow'
              : 'success-green'
          "
        >
          {{
            experience_object[formId]
              .replace(/(^\s*)|(\s*$)/gi, "")
              .replace(/[ ]{2,}/gi, " ")
              .replace(/\n /, "\n")
              .split(" ").length
          }}
          Words
        </span>
      </div>
      <div class="col-12 center-box-flex">
        <div
          class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
        >
          <input
            type="checkbox"
            value="option1"
            :id="'made_money' + id"
            class="custom-control-input form-check-input"
            @click="checkBoxClick('made_money')"
            :checked="exp_type == 'made_money' ? true : false"
          />

          <button
            class="custom-control-label form-check-label hide-btn-specs"
            for="customCheck"
            @click="checkBoxClick('made_money')"
          >
            Made Money
          </button>
        </div>
        <div
          class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
        >
          <input
            type="checkbox"
            :id="'more_efficient' + id"
            value="option2"
            class="custom-control-input form-check-input"
            :checked="exp_type == 'more_efficient' ? true : false"
            @click="checkBoxClick('more_efficient')"
          />

          <button
            class="custom-control-label form-check-label hide-btn-specs"
            for="customCheck"
            @click="checkBoxClick('more_efficient')"
          >
            More Efficient
          </button>
        </div>
        <div
          class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
        >
          <input
            type="checkbox"
            :id="'cut_cost' + id"
            value="option3"
            class="custom-control-input form-check-input"
            :checked="exp_type == 'cut_cost'"
            @click="checkBoxClick('cut_cost')"
          />
          <button
            class="custom-control-label form-check-label hide-btn-specs"
            for="inlineCheckbox3"
            @click="checkBoxClick('cut_cost')"
          >
            Cut Costs
          </button>
        </div>
        <div
          class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
        >
          <input
            type="checkbox"
            :id="'solve_problem' + id"
            value="option4"
            class="custom-control-input form-check-input"
            :checked="exp_type == 'solve_problem'"
            @click="checkBoxClick('solve_problem')"
          />
          <button
            class="custom-control-label form-check-label hide-btn-specs"
            for="customCheck"
            @click="checkBoxClick('solve_problem')"
          >
            Solved a Problem
          </button>
        </div>
        <div
          class="custom-control custom-checkbox form-check form-check-inline finder_job_check"
        >
          <input
            type="checkbox"
            :id="'other' + id"
            value="option5"
            class="custom-control-input form-check-input"
            :checked="exp_type == 'other'"
            @click="checkBoxClick('other')"
          />

          <button
            class="custom-control-label form-check-label hide-btn-specs"
            for="customCheck"
            @click="checkBoxClick('other')"
          >
            Other
          </button>
        </div>
      </div>
      <div class="col-md-5 col-sm-6 job_finder_label" style="max-width: 280px">
        <p
          style="
            font-family: Hind;
            font-weight: 700;
            font-size: 16px;
            color: rgb(118, 118, 118);
            text-align: left;
          "
        >
          Position this experience relates to:
        </p>
      </div>
      <div class="col-md-6 col-sm-6 job_name_finder select-arrow-side inputP55">
        <select
          name="job_name"
          id=""
          class="select-item select-item-job-name input mouseLeave"
          style="appearance: none"
          v-model="experince_job_name"
        >
          <option value="0">Select</option>
          <option
            :value="Job.id"
            v-for="(Job, index) in JobDropDown"
            v-bind:key="index"
          >
            {{ Job.position }} ({{ Job.company }})
          </option>
          <!-- <option value="school_volu_exp">School / Volunteer Experience</option> -->
          <!-- <option value="0" class="label_name">Select</option>
          <option value="1" class="label_name">Job name</option> -->
        </select>
      </div>
    </div>
    <div
      class="confirm confirm_finder"
      style="text-align: right; display: inline-block; width: 100%"
    >
      <i
        class="fa fa-check-circle"
        @click="save(formId)"
        style="font-size: 30px; color: rgb(251, 100, 62)"
      ></i>
      <i
        class="fa fa-times-circle"
        style="font-size: 30px; color: rgb(251, 100, 62)"
        @click="cancel(id, formId)"
      ></i>
    </div>
  </div>
</template>

<script>
import { environment_api } from "../../env";

export default {
  name: "FormExperienceFinder",

  data() {
    return {
      EnvPath: environment_api.api_base_url,
      experince_description: "",
      exp_type: "",
      experince_job_name: 0,
      experience_object: {},
    };
  },

  props: {
    id: {
      type: Number,
      required: true,
    },
    resume_id: {
      type: String,
      required: true,
    },
    // formid is the incremented id of form you can call it index
    formId: {
      type: Number,
      required: true,
    },
    position_id: {
      type: Number,
    },
    JobDropDown: {
      type: Array,
    },
    ExperienceQuestions: {
      type: Array,
    },
  },

  methods: {
    save: function (formId) {
      this.experince_description = this.experience_object[formId];
      if (
        this.experince_description != "" &&
        this.exp_type != "" &&
        this.experince_job_name != 0
      ) {
        const obj = {
          description: this.experince_description,
          job_id: this.experince_job_name,
          question_id: this.id,
          position_id: this.position_id,
          result_id: null,
          resume_id: this.resume_id,
          type: this.exp_type,
          page: 1,
        };

        axios
          .post(this.EnvPath + "save-experience-finder", obj)
          .then(({ data }) => {
            if (data.status == 1) {
              if (data.data[formId]) {
                this.ExperienceQuestions[formId].Experience =
                  data.data[formId].Experience;

                this.ExperienceQuestions[formId].experience_time =
                  this.ExperienceQuestions[formId].experience_time + 1;
              } else {
                if (data.experience_id) {
                  obj.id = data.experience_id;
                  this.ExperienceQuestions[formId].Experience.push(obj);
                }
              }

              // this.$store.dispatch(
              //   "ExperienceFinderObject",
              //   this.experience_object
              // );

              this.experince_description = "";
              this.exp_type = "";
              this.experince_job_name = 0;
              this.$emit("dynamicFormAction", true);
            }
          });
      } else {
        this.$emit("validationPopUp", true);
      }
    },
    checkBoxClick: function (type) {
      if (this.exp_type === type || this.exp_type == "undefined") {
        this.exp_type = "";
      } else {
        this.exp_type = type;
      }
    },
    experienceDescription: function (e, formId) {
      let value = e.target?.value;
      let experience_obj = {
        [formId]: value,
      };
      let objectData = this.experience_object;
      this.experience_object = { ...objectData, ...experience_obj };
      this.$store.dispatch("ExperienceFinderObject", this.experience_object);
    },
    cancel(id, formId) {
      this.$emit("dynamicFormAction", false);
    },
  },
};
</script>

<style>
.select-arrow-side:before {
  right: 12px !important;
  z-index: 0;
}

#plan_detail .select-arrow-side:before {
  right: 12px !important;
  z-index: 1 !important;
}

.center-box-flex {
  display: flex;
  justify-content: space-evenly;
}
</style>
