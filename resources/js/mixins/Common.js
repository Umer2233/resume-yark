import store from "../store";
import { mapGetters, mapState } from "vuex";
import { environment_api } from "../env";
import html2pdf from "html2pdf.js";
export default {
  data() {
    return {
      showSuccessPopUp: "",
      isLoading: false,
      cardList: [],
      showAddCardBtn: false,
      addCreditCard: false,
      sharedData: "This is shared data from the mixin",
      showEducationEnhancement: this.getShowEducationEnhancement,
      currentYear: new Date().getFullYear(),
      company_name: "",
      EnvPath: environment_api.api_base_url,
      currentDate: new Date().toISOString().split("T")[0], // Get current date in YYYY-MM-DD format
      previousDate: localStorage.getItem("savedDate"),
      callCardDetail: "",
    };
  },

  computed: {
    ...mapGetters([
      "getShowEducationEnhancement",
      "getJobArray",
      "getUserData",
      "getPersonalDetail",
      "getJobDescriptionsArray",
    ]),
    // ...mapState({
    //   resumeStateData: (state) => state.Two_Page_Resume,
    // }),
  },
  watch: {},
  beforeMount() {
    $(".template-slidre-box").slick({
      slidesToShow: 3,
      autoplay: true,
      // autoplaySpeed:100,
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

  mounted() {
    this.getEducationEnhancement();
  },
  created() {},
  methods: {
    getState(job) {
      if (typeof job.state_relation == "object" && job.state_relation != null) {
        return job.state_relation.state;
      } else {
        return job.state;
      }
    },
    getJobDescriptionsForResume: function (id) {
      axios
        .get(this.EnvPath + "api/get-resume-job-descriptions/" + id)
        .then(({ data }) => {
          if (data.status) {
            store.commit("storeJobDescriptionsArray", data.data);
          } else {
            store.commit("storeJobDescriptionsArray", []);
          }
        });
    },
    checkJobDescription(job_id) {
      var findJob = this.getJobDescriptionsArray.find(
        (item) => item.job_id === job_id
      );
      if (findJob && findJob.final_job_description !== null) {
        return findJob.final_job_description;
      } else {
        return false;
      }
    },
    removeLocalStorage() {
      if (this.previousDate == null || this.previousDate !== this.currentDate) {
        this.$store.commit("LogoutUser");
      }
    },
    loadResumes() {
      axios.post(this.EnvPath + "get-resume", {}).then(({ data }) => {
        if (data.status == 1) {
          store.commit("ResumeNameData", data);
        }
      });
    },
    async getEducationEnhancement() {
      try {
        const { data } = await axios.get(
          this.EnvPath + "education_enhancement2"
        );
        if (data.success) {
          // Assuming store.commit returns a promise (or is synchronous)
          await store.commit("EducationEnhancementData", data);
          await this.checkEducationInfiveYears();
          return true;
        }
      } catch (error) {
        console.log(error);
      }
    },

    async updatePersonalData(card_detail) {
      try {
        var customer_card_data = {
          name: this.getUserData.cardData.card_name,
          expiration:
            card_detail[0].card.exp_month +
            "/" +
            String(card_detail[0].card.exp_year).slice(-2),
          country: this.getUserData.cardData.country,
          postal_code: this.getUserData.cardData.postal_code,
        };
        await this.$store.commit("storeCardDetail", customer_card_data);
        return true;
      } catch (error) {
        console.log(error, "error occured at update Personal Data");
      }
    },
    checkEducationInfiveYears() {
      if (this.$store.state.SchoolData.length > 0) {
        let conditionMet = false;
        this.$store.state.SchoolData.forEach((value) => {
          const diff = this.currentYear - value.grad_year;
          if (diff < 6) {
            conditionMet = true;
          }
        });
        if (conditionMet) {
          this.$store.commit("storeShowEducationEnhancement", true);
        } else {
          this.$store.commit("storeShowEducationEnhancement", false);
        }
      } else {
        store.commit("storeShowEducationEnhancement", false);
        return false;
      }
    },

    getJobName(job_id) {
      var foundItem = this.getJobArray.find((item) => item.job.id === job_id);
      if (foundItem) {
        return foundItem.job.company;
      }
    },
    checkDynamicEduClass: function (column_val, t_id) {
      if (t_id == 3 || t_id == 4 || t_id == 5) {
        if (column_val == 3 || column_val == 2) {
          return "col-md-6";
        } else {
          return "col-md-12";
        }
      } else {
        if (column_val == 3) {
          return "col-md-4";
        } else if (column_val == 2) {
          return "col-md-6";
        } else {
          return "col-md-12";
        }
      }
    },

    checkDynamicSkillClass: function (column_val) {
      if (column_val == 3) {
        return "col-md-4";
      } else if (column_val == 2) {
        return "col-md-6";
      } else {
        return "col-md-12";
      }
    },
    checkDynamicNewSectionClass: function (column_val) {
      if (column_val == 3) {
        return "col-md-4";
      } else if (column_val == 2) {
        return "col-md-6";
      } else {
        return "col-md-12";
      }
    },

    // checkDynamicColumnClass: function (column_val) {
    //   if (column_val == 3) {
    //     return 3;
    //   } else if (column_val == 2) {
    //     return 2;
    //   } else {
    //     return 1;
    //   }
    // },

    checkDynamicColumnClass: function (column_val, t_id) {
      if (t_id == 3 || t_id == 4 || t_id == 5) {
        if (column_val == 3 || column_val == 2) {
          return 2;
        } else {
          return 1;
        }
      } else {
        if (column_val == 3) {
          return 3;
        } else if (column_val == 2) {
          return 2;
        } else {
          return 1;
        }
      }
    },
    groupDataIntoRows(data, colSize) {
      const grouped = [];
      let currentRow = [];

      data.forEach((item, index) => {
        // Push item to currentRow
        currentRow.push(item);

        // If currentRow is complete or we've reached the end of the array, push it to grouped and start a new row
        if (currentRow.length === colSize || index === data.length - 1) {
          grouped.push(currentRow);
          currentRow = [];
        }
      });

      return grouped;
    },

    generatePDsF(margin = false) {
      const element = this.$refs.htmlToConvert;
      const addSpaceAfterPageBreaks = () => {
        const content = document.getElementById("content");
        const pages = content.children; // Get all children of the content element

        let currentPageTop = 0;
        let previousPageBottom = 0;

        for (let i = 0; i < pages.length; i++) {
          const page = pages[i];
          const pageHeight = page.getBoundingClientRect().height;

          // Check if adding this page would overflow the current page
          if (currentPageTop + pageHeight > previousPageBottom && i !== 0) {
            // Add padding to the previous page
            const paddingNeeded =
              currentPageTop + pageHeight - previousPageBottom;
            pages[i - 1].style.paddingBottom = `${paddingNeeded}px`;

            // Create an empty space div
            const spaceDiv = document.createElement("div");
            spaceDiv.style.height = "30px !important"; // Adjust the height as needed
            spaceDiv.style.width = "100% !important"; // Ensure the space div spans the full width of the page
            spaceDiv.style.clear = "both !important"; // Clear any floats
            // Insert the space div after the current page
            page.insertAdjacentElement("beforebegin", spaceDiv);

            // Update the position for the next page
            previousPageBottom = currentPageTop + pageHeight;
          }

          // Update the current page position
          currentPageTop += pageHeight;
        }
      };

      html2pdf()
        .from(element)
        .toPdf()
        .get("pdf")
        .then((pdf) => {
          pdf.internal.events.add("addPage", () => {
            // Add space after each page break
            addSpaceAfterPageBreaks();
          });
          pdf.save();
        });
    },
    generatePDF(margin = false) {
      if (!margin) {
        margin = [0, 0, 0, 0];
      }

      try {
        const element = this.$refs.htmlToConvert;
        const pdfOptions = {
          margin: margin,

          filename: this.resume.name + ".pdf",
          image: { type: "jpeg", quality: 0.98 },
          html2canvas: {
            scale: 2,
          },
          pagebreak: {
            avoid: "p,br,h1,h2,h3,h4,h5,h6,strong,span,ul,li,a,b",
          },

          jsPDF: {
            unit: "mm",
            format: "letter",
            orientation: "portrait",
            // format: [216, heightInMm],
          },
        };
        html2pdf(element, pdfOptions)
          .outputPdf()
          .then((pdf) => {
            const blob = new Blob([pdf], { type: "application/pdf" });
            store.commit("storeResumeBuilderClasses", false);
            store.commit("storeCheckLoader", false);
          });
      } catch (error) {
        store.commit("storeCheckLoader", false);
        console.error("Error generating PDF:", error);
      }
    },
    loadCountries() {
      axios
        .get(this.EnvPath + "countries")
        .then((response) => {
          store.commit("LocationData", response.data);
          this.countries = this.$store.state.countriesData;
        })
        .catch((error) => console.log(error));
    },
    loadStates() {
      axios
        .get(this.EnvPath + "states")
        .then((response) => {
          store.commit("LocationData", response.data);
          this.states = this.$store.state.statesData;
        })
        .catch((error) => console.log(error));
    },

    async getUserCardDetails(customer_token, recall) {
      this.isLoading = false;
      if (customer_token) {
        this.showAddCardBtn = false;
        this.addCreditCard = false;
        try {
          const { data } = await axios.post(
            this.EnvPath + "api/get-customer-card-detail",
            {
              customer_id: customer_token,
            },
            {
              headers: {
                Authorization: "Bearer " + this.$store.state.token,
              },
            }
          );

          if (data.api_status) {
            var card_detail = data.data.data;
            this.cardList = card_detail;
            store.commit("storeCardList", card_detail);
            this.showAddCardBtn = false;
            this.addCreditCard = true;
            if (recall) {
              try {
                await this.getEducationEnhancement();
              } catch (error) {
                console.log(error, "error");
              }
              await this.updatePersonalData(this.cardList);
            }
            this.closeCollapseExample();
            store.commit("storeCheckLoader", false);
          } else {
            if (this.getCardList.length > 0) {
              this.showAddCardBtn = false;
            } else {
              this.showAddCardBtn = true;
            }
            this.addCreditCard = true;
          }
          this.isLoading = false;
          return true;
        } catch (error) {
          console.error(error, "on the get user card details");

          this.showAddCardBtn = true;
          this.addCreditCard = true;
          if (error.response && error.response.status === 401) {
            this.logoutUser();
          }
          return true;
        }
        this.callCardDetail = false;
      } else {
        this.showAddCardBtn = true;
        this.addCreditCard = true;
      }
      this.isLoading = false;
    },
    closeCollapseExample() {
      this.$emit("close-collapse");
    },
    openSuccessModal(s_id) {
      let sub_name = "";
      if (s_id == 2) {
        sub_name = "Plus";
      } else if (s_id == 3) {
        sub_name = "Pro";
      } else {
        sub_name = "Basic";
      }
      this.showSuccessPopUp =
        `You are now a ` +
        sub_name +
        ` subscriber.
       Your resume will end up being better because of it.`;
    },
    async logoutUser() {
      store.commit("LogoutUser");
      window.location.href = environment_api.api_base_url + "login";
    },
    removeErrorWord(error) {
      if (typeof error === "string") {
        return error.replace(/^Error: /, "");
      } else if (typeof error === "object") {
        let errorMessageString = error.message.toString();
        return errorMessageString;
      } else {
        return error;
      }
    },
  },
};
