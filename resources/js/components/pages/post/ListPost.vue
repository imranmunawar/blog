<template>
  <div class="add-cat-layout-vue">
    <div class="content-section" style="margin-top: 210px">
      <div class="row">
        <div class="col-lg-8">
          <div class="post-section" style="padding-left: 5%; padding-right: 5%">
            <div v-if="local_data != null" class="dashboard-page">
              <admin-top></admin-top>
              <div class="add-cat">
                <div class="row">
                  <div class="col-lg-12">
                    <router-link
                      class="btn btn-primary"
                      :to="{ name: 'post_list_add' }"
                      >Add Post</router-link
                    >
                  </div>
                  <div class="col-lg-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Slug</th>
                          <th>Published At</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody v-if="data != null">
                        <tr v-for="x in data.posts" :key="x.id">
                          <td>{{ x.title }}</td>
                          <td>{{ x.category.name }}</td>
                          <td>{{ x.slug }}</td>
                          <td>{{ x.published_at }}</td>
                          <td>{{ x.status }}</td>
                          <td>
                            <button class="btn btn-danger" v-on:click="delList(x.id)">Del</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <side-bar></side-bar>
      </div>
    </div>
  </div>
</template>
<script>
import SideBar from "./../../SideBar.vue";
import AdminTop from "./../../AdminTop.vue";
export default {
  name: "ListPost",
  components: {
    SideBar,
    AdminTop,
  },
  metaInfo() {
    return {
      title: "Post",
    };
  },
  data() {
    return {
      local_is_loged: null,
      local_data: null,
      data: null,
    };
  },
  mounted() {
    this.local_is_loged = localStorage.getItem("is_loged");
    this.local_data = localStorage.getItem("data");
    this.local_data = JSON.parse(this.local_data);
    this.allPost();
  },
  methods: {
    allPost() {
      this.axios
        .get(process.env.MIX_API_URL + "/api/post/all", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.local_data.token,
          },
        })
        .then((response) => {
          this.data = response.data.data;
          console.log(this.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delList(id) {
      // console.log(id);
      this.axios
        .post(
          process.env.MIX_API_URL + "/api/post/delete/" + id,
          { del_id: id },
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
          this.allPost();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>