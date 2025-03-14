<template>
  <div>
    <!-- Your HTML content goes here -->
    <div ref="htmlToConvert">
      <h1 style="color:red;">Hello, PDF!</h1>
      <p>what do you want i want nothing from you</p>

      <!-- Add the content you want to convert to PDF -->
    </div>
    <button @click="generatePDF">Generate PDF</button>
  </div>
</template>

<script>
import html2pdf from "html2pdf.js";

export default {
  data() {
    return {
      edu_current_index: "",
    };
  },
  methods: {
    generatePDF() {
      try {
        const element = this.$refs.htmlToConvert;
        // Use setTimeout to give the content time to render
          // Set up configuration options for html2pdf
          const pdfOptions = {
            margin: 10,
            filename: "my_document.pdf",
            image: { type: "jpeg", quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
          };
          console.log(this.$refs.htmlToConvert, "element");
          // Use html2pdf to generate the PDF
          // html2pdf()
          //   .from(this.$refs.htmlToConvert)
          //   .set(pdfOptions)
          //   .outputPdf()
          html2pdf(this.$refs.htmlToConvert, pdfOptions).outputPdf()
            .then((pdf) => {
              // Create a Blob containing the PDF data
              const blob = new Blob([pdf], { type: "application/pdf" });

              // Create a URL for the Blob
              const url = window.URL.createObjectURL(blob);

              // Trigger a download link for the PDF
              const link = document.createElement("a");
              link.href = url;
              link.download = "my_document.pdf";
              link.click();

              // Clean up resources
              window.URL.revokeObjectURL(url);
            });
       
      } catch (error) {
        console.error("Error generating PDF:", error);
      }
    },
  },
};
</script>
