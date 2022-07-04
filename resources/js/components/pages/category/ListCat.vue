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
                      :to="{ name: 'category_list_add' }"
                      >Add Category</router-link
                    >
                  </div>
                  <div class="col-lg-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody v-if="data != null">
                        <tr v-for="x in data.categories" :key="x.id">
                          <td>{{ x.name }}</td>
                          <td>
                            <router-link
                              class="btn btn-primary"
                              :to="{
                                name: 'category_list_edit',
                                params: { id: x.id },
                              }"
                              >Edit</router-link
                            >
                            <button
                              v-on:click="delCat(x.id)"
                              class="btn btn-danger"
                            >
                              Del
                            </button>
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
  name: "ListCat",
  components: {
    SideBar,
    AdminTop,
  },
  metaInfo() {
    return {
      title: "Category",
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
    this.allCatList();
  },
  methods: {
    allCatList() {
      this.axios
        .get(process.env.MIX_API_URL + "/api/cat/all", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.local_data.token,
          },
        })
        .then((response) => {
          this.data = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delCat(id) {
      // console.log(id);
      this.axios
        .post(process.env.MIX_API_URL + "/api/cat/delete/" + id, { del_id : id}, {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.local_data.token,
          },
        })
        .then((response) => {
          console.log(response);
          this.allCatList();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>