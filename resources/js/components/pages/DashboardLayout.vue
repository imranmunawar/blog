<template>
  <div class="dashboard-layout-vue">
    <div class="content-section" style="margin-top: 210px">
      <div class="row">
        <div class="col-lg-8">
          <div class="post-section" style="padding-left: 5%; padding-right: 5%">
            <div v-if="local_data != null" class="dashboard-page">
              <admin-top></admin-top>
              <h2>Welcome {{ local_data.user.name }} to Dashboard</h2>
            </div>
          </div>
        </div>
        <side-bar></side-bar>
      </div>
    </div>
  </div>
</template>
<script>
import SideBar from "./../SideBar.vue";
import AdminTop from "./../AdminTop.vue";
export default {
  name: "DashboardLayout",
  components: {
    SideBar,
    AdminTop,
  },
  metaInfo() {
    return {
      title: "Dashboard",
    };
  },
  data() {
    return {
      local_is_loged: null,
      local_data: null,
    };
  },
  mounted() {
    this.local_is_loged = localStorage.getItem("is_loged");
    this.local_data = localStorage.getItem("data");
    this.local_data = JSON.parse(this.local_data);
  },
};
</script>