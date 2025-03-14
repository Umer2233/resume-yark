<template>
  <div class="resume-bottom">
    <div class="row mt-3">
      <div class="col-md-12 col-sm-12">
        <div class="flex-align-control-footer">
          <ul class="footer-ul-links pl-0">
            <li>
              <a href=""><strong>Sitemap</strong></a>
              <i
                class="fas fa-circle"
                style="color: #66696d; font-size: 25%"
              ></i>
            </li>
            <li>
              <a href=""><strong>Privacy Policy</strong></a>
              <i
                class="fas fa-circle"
                style="color: #66696d; font-size: 25%"
              ></i>
            </li>
            <li>
              <a href=""><strong>Terms of Use</strong></a>
              <i
                class="fas fa-circle"
                style="color: #66696d; font-size: 25%"
              ></i>
            </li>
            <li>
              <a href=""><strong>About Us</strong></a>
            </li>
          </ul>

          <div>
            <p class="text-center">
              © {{ new Date().getFullYear() }} Resume Yak. All rights reserved
            </p>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-5 col-sm-12">
        <p class="text-center">
          © {{ new Date().getFullYear() }} Resume Yak. All rights reserved
        </p>
      </div> -->
    </div>
  </div>
</template>


<style>
.flex-align-control-footer ul.footer-ul-links {
  margin-right: 50px;
}
.flex-align-control-footer {
  display: flex;
  justify-content: center;
}

@media (max-width: 765px) {
  .flex-align-control-footer {
    flex-direction: column;
  }
  .flex-align-control-footer ul.footer-ul-links {
    margin-right: 0;
  }
}
</style>