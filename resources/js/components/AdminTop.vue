<template>
  <div class="nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarText"
        aria-controls="navbarText"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link class="nav-link" :to="{ name: 'dashboard' }"
              >Dashboard</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'category_list' }"
              >Category</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'post_list' }"
              >Posts</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'home_page' }"
              >Blog Home</router-link
            >
          </li>
          <li class="nav-item">
            <button class="nav-link" v-on:click="logout">Logout</button>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "AdminTop",
  methods: {
    logout() {
      localStorage.removeItem("is_loged");
      localStorage.removeItem("data");
      this.$router.push({ name: "login_page" });
      this.axios
        .post(
          process.env.MIX_API_URL + "/api/logout",
          {},
          {
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: "Bearer " + this.local_data.token,
            },
          }
        )
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
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
    console.log(this.local_data);
  },
};
</script>