<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      data-backdrop="static"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content width-modal-template">
          <div class="modal-header-0">
            <button
              type="button"
              class="close template-modal-btn"
              data-dismiss="modal"
              aria-label="Close"
              @click="close((redirect = false))"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1 class="chose-template-heading">Choose Your Template</h1>
                </div>
              </div>

              <div class="row mb-5">
                <div class="col-md-12">
                  <div class="chose-template-box">
                    <div class="chose-template-header">
                      <h1>Free Templates</h1>
                    </div>

                    <div class="chose-template-card-main-box">
                      <div class="template-slidre-box">
                        <!-- <div
                          class="template-image-check"
                          v-for="(template, key) in templates"
                          :key="`#t_key_${key}`"
                        >
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput1"
                          />
                          <label class="label-for-template" for="idinput1">
                            <div class="template-image-box">
                                <img
                                src="images/template-demo-image.png"
                                alt=""
                              />
                            </div>
                          </label>
                        </div> -->

                        <div class="template-image-check">
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput1"
                            @click="selectTemplate(1)"
                          />
                          <label class="label-for-template" for="idinput1">
                            <div class="template-image-box">
                              <img
                                :src="EnvPath + '/images/template/first.jpg'"
                                alt=""
                              />
                            </div>
                          </label>
                        </div>
                        <div class="template-image-check">
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput2"
                            @click="selectTemplate(2)"
                          />
                          <label
                            class="label-for-template input-templates-box"
                            for="idinput2"
                          >
                            <div class="template-image-box">
                              <img
                                :src="EnvPath + '/images/template/second.jpg'"
                                alt=""
                              />
                            </div>
                          </label>
                        </div>
                        <div class="template-image-check">
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput3"
                            @click="selectTemplate(3)"
                          />
                          <label class="label-for-template" for="idinput3">
                            <div class="template-image-box">
                              <img
                                :src="EnvPath + '/images/template/third.jpg'"
                                alt=""
                              />
                            </div>
                          </label>
                        </div>
                        <div class="template-image-check">
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput4"
                            @click="selectTemplate(4)"
                          />
                          <label class="label-for-template" for="idinput4">
                            <div class="template-image-box">
                              <img
                                :src="EnvPath + '/images/template/forth.jpg'"
                                alt=""
                              />
                            </div>
                          </label>
                        </div>
                        <div class="template-image-check">
                          <input
                            type="radio"
                            name="template-select"
                            class="check-with-template"
                            id="idinput5"
                            @click="selectTemplate(5)"
                          />
                          <label class="label-for-template" for="idinput5">
                            <div class="template-image-box">
                              <img
                                :src="EnvPath + '/images/template/fifth.jpg'"
                                alt=""
                              />
                            </div>
                          </label>
                        </div>

                        <!-- second -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery"; // Import jQuery (required by Slick)
import "slick-carousel/slick/slick"; // Import Slick Carousel CSS
import "slick-carousel/slick/slick-theme.css"; // Import Slick Carousel Theme CSS
import { environment_api } from "../env";
export default {
  mounted() {
    this.initSlick();
  },

  beforeCreate() {
    // this.initSlick();
  },

  created() {
    this.initSlick();
  },
  beforeMount() {
    this.initSlick();
    $(".template-slidre-box").slick({
      centerMode: false,
      slidesToShow: 3,
      autoplay: true,
      autoplayspeed: 1500,
      dots: true,
      arrows: true,
      responsive: [
        {
          breakpoint: 993,
          settings: {
            arrows: true,
            centerMode: false,
            centerPadding: "0px",
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "0px",
            slidesToShow: 1,
          },
        },
      ],
    });
  },
  data() {
    return {
      EnvPath: environment_api.api_base_url,
    };
  },
  props: {
    showTemplatePopup: {
      type: [Boolean],
    },
    templates: {
      type: [Object, Array],
      default: null,
    },
    reusmeId: {
      default: null,
    },
  },
  watch: {
    showTemplatePopup(newValue, oldValue) {
      if (oldValue || newValue) {
        this.showPopupTemplates();
      } else {
        this.close();
      }
    },
  },
  methods: {
    selectTemplate(t_id) {
      axios
        .post(this.EnvPath + "save-resume-templates", {
          t_id: t_id,
          resume_id: this.reusmeId,
        })
        .then(({ data }) => {
          if (data.status) {
            const redirect = true;
            this.close(redirect);
          }
        })
        .catch((error) => console.log(error));
    },
    showPopupTemplates: function () {
      let element = document.getElementById("exampleModal");
      $(element).modal("show");
    },
    close(redirect) {
      console.log(redirect, "redirect");
      if (redirect) {
        this.$emit("move-to-experiece-finder", this.reusmeId);
      } else {
        this.$emit("move-to-experiece-finder");
      }

      let element = document.getElementById("exampleModal");
      $(element).modal("hide");
    },

    initSlick() {
      // Configure Slick Carousel options
      $(".template-slidre-box").slick({
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 1500,
        dots: true,
        arrows: true,
        responsive: [
          {
            breakpoint: 993,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "0px",
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "0px",
              slidesToShow: 1,
            },
          },
        ],
      });
    },
  },
};
</script>

<style>
.chose-template-box {
  background-color: #f7f7f7;
  border-radius: 20px;
  /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.16); */
}

.chose-template-header {
  background-color: #fb643e;
  border-radius: 20px 20px 0 0;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.chose-template-header h1 {
  text-align: center;
  color: #ffffff;
  font-size: 29px;
  font-weight: 600;
}

.chose-template-card-main-box {
  padding: 20px;
}

label.label-for-template {
  border: 5px solid transparent;
  width: 90%;
  margin-left: 14px;
}

.check-with-template {
  display: none;
}

.check-with-template:checked + label.label-for-template {
  border: 5px solid #fb643e;
}

.template-image-box {
  width: 100%;
  margin: 0 auto;
  box-shadow: 0 0 10px 0 rgb(164 164 164 / 16%);
}

.template-image-box img {
  width: 100%;
  cursor: pointer !important;
}

h1.chose-template-heading {
  text-align: center;
  font-size: 36px;
  color: #fb643e;
  font-weight: 700;
  margin-bottom: 30px;
  margin-top: -15px;
  font-family: "Noto Sans", sans-serif !important;
}

/*  */

.template-slidre-box .slick-dots li.slick-active button:before {
  opacity: 1;
  color: #2684fe !important;
}

.template-slidre-box .slick-dots li button:before {
  font-size: 16px;
  color: #a5a5a5 !important;
  opacity: 0.7 !important;
}

.template-slidre-box .slick-next:before {
  font-family: "Font Awesome 5 Pro" !important;
  content: "\f054" !important;
  color: #ffffff !important;
  font-size: 25px;
  opacity: 1 !important;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-left: 3px;
}

.template-slidre-box .slick-prev:before {
  font-family: "Font Awesome 5 Pro" !important;
  content: "\f053" !important;
  color: #ffffff !important;
  font-size: 25px;
  opacity: 1 !important;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-right: 6px;
}

.template-slidre-box button.slick-arrow:hover {
  background-color: #fb643e !important;
}

.template-slidre-box button.slick-next.slick-arrow {
  background-color: #2684fe !important;
  width: 60px;
  height: 60px;
  border-radius: 100px;
  right: 0 !important;
}

.template-slidre-box button.slick-prev.slick-arrow {
  background-color: #2684fe !important;
  width: 60px;
  height: 60px;
  border-radius: 100px;
  left: 0 !important;
}

.template-slidre-box {
  padding: 0 90px;
}

.template-slidre-box ul.slick-dots {
  width: 84%;
}

.modal-dialog {
  max-width: 1200px !important;
}

.template-modal-btn {
  background-color: #ffffff !important;
  position: relative;
  top: -10px;
  right: -10px;
  opacity: 1 !important;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 100px;
  /* border: 2px solid #dddddd !important; */
  box-shadow: 0 0 4px 0 rgba(0, 0, 0, 16%);
}

.template-modal-btn span {
  margin-top: -3px;
}

@media (max-width: 993px) {
  .template-slidre-box button.slick-prev.slick-arrow,
  .template-slidre-box button.slick-next.slick-arrow {
    width: 50px;
    height: 50px;
  }

  .width-modal-template {
    width: 96% !important;
    margin: 0 auto !important;
  }

  .template-slidre-box .slick-prev:before,
  .template-slidre-box .slick-next:before {
    padding-right: 3;
  }

  label.label-for-template {
    width: 100%;
    margin-left: 0;
  }

  .template-slidre-box {
    padding: 0 65px;
  }

  .template-slidre-box ul.slick-dots {
    width: 80%;
  }
}

@media (max-width: 450px) {
  .template-slidre-box {
    padding: 0 !important;
  }

  button.slick-arrow {
    /* display: none !important; */
  }

  .template-slidre-box button.slick-prev.slick-arrow,
  .template-slidre-box button.slick-next.slick-arrow {
    width: 30px !important;
    height: 30px !important;
    z-index: 99;
  }
  .template-slidre-box .slick-next:before,
  .template-slidre-box .slick-prev:before {
    font-size: 16px !important;
  }

  .slick-prev,
  .slick-next {
    top: 45% !important;
  }

  .chose-template-card-main-box {
    height: 365px !important;
  }

  .template-image-check {
    padding: 0 40px;
  }

  .template-image-check .input-templates-box {
    padding: 0 !important;
  }

  .slick-dots {
    bottom: -16px !important;
    /* display: none !important; */
  }

  .template-slidre-box ul.slick-dots {
    width: 100%;
  }

  .template-image-box {
    box-shadow: none;
  }

  .input-templates-box {
    padding: 0 40px !important;
  }
}

@media (max-width: 380px) {
  .chose-template-card-main-box {
    height: 315px !important;
  }
}

@media (max-width: 330px) {
  .chose-template-card-main-box {
    height: 235px !important;
  }
}

.template-slidre-box button.slick-arrow:hover {
  background-color: #fb643e !important;
}
</style>
