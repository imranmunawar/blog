<template>
  <div class="master-layout-vue">
    <div class="container-fluid zero-p">
      <div class="header-section top-bar p-2">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <p class="white-text mt-3 ms-5">Company Name</p>
          </div>
        </div>
      </div>
      <div class="blog-img-section">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div
              class="blog-img-placeholder"
              :style="{ width: '100%', height: '200px', backgroundImage: 'url('+ this.url +'/assets/img/blog-back.jpg)', position: 'absolute' }"
            >
              <div class="blog-text-placeholder" style="margin-top: 68px">
                <h1 class="text-center white-text">
                  <span>Blog</span>
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <router-view></router-view>
      <br><br>
      <div class="foot-section bottom-bar p-2">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <p class="white-text mt-3 ms-5">Copyright 2022 Ascensor</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "MasterLayout",
  data(){
    return{
      url : process.env.MIX_API_URL
    }
  }
};
</script>