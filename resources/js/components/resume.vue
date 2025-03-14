<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      .page {
        page-break-before: always;
      }
    </style>
    <title>Resume App</title>
  </head>
  <body>
    <div id="app">
      <div class="resume">
        <div class="resume-section">
          <!-- Your section content goes here -->
          <p>Education and Qualifications...</p>
        </div>
        <div class="resume-section">
          <!-- Your section content goes here -->
          <p>Work Experience...</p>
        </div>
        <div class="resume-section">
          <!-- Your section content goes here -->
          <p>Skills...</p>
        </div>
        <!-- Add more sections as needed -->
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const resumeSections = document.querySelectorAll(".resume-section");

        let currentPage = 1;
        let currentHeight = 0;
        const maxHeight = 500; // Set the maximum height for each page

        resumeSections.forEach((section) => {
          const sectionHeight = section.offsetHeight;

          if (currentHeight + sectionHeight > maxHeight) {
            // If adding the current section exceeds the maximum height, start a new page
            section.classList.add("page");
            currentPage++;
            currentHeight = sectionHeight;
          } else {
            currentHeight += sectionHeight;
          }
        });
      });
    </script>
  </body>
</html>
