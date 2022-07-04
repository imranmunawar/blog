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
                    <form v-on:submit="postAddFormSubmit" method="post">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input
                          type="text"
                          name="title"
                          class="form-control"
                          id="title"
                          aria-describedby="emailHelp"
                          placeholder="Enter Title"
                          v-model="postForm.title"
                        />
                      </div>
                      <div class="form-group">
                        <label for="content">Content</label>
                        <textarea
                          name="content"
                          id="content"
                          class="form-control"
                          v-model="postForm.content"
                        ></textarea>
                      </div>
                      <div class="form-group" v-if="cat_data != null">
                        <label for="category_id">Category</label>
                        <select
                          name="category_id"
                          id="category_id"
                          v-model="postForm.category_id"
                          class="form-control"
                        >
                          <option
                            v-for="x in cat_data.categories"
                            :key="x.id"
                            :value="x.id"
                          >
                            {{ x.name }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select
                          name="status"
                          id="status"
                          v-model="postForm.status"
                          class="form-control"
                        >
                          <option value="Active">Active</option>
                          <option value="InActive">InActive</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Published At</label>
                        <input
                          type="datetime-local"
                          class="form-control"
                          name="published_at"
                          id="published_at"
                          v-model="postForm.published_at"
                        />
                      </div>
                      <br />
                      <button type="submit" class="btn btn-primary">
                        Add Post
                      </button>
                    </form>
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
  name: "AddPost",
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
      postForm: {
        title: null,
        content: null,
        category_id: null,
        status: null,
        published_at: null,
      },
      cat_data: null,
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
          this.cat_data = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    postAddFormSubmit(e) {
      e.preventDefault();
      if (this.postForm.title == null || this.postForm.title == "") {
        this.$swal({
          title: "Error!",
          text: "Invalid Fields!",
          type: "danger",
        });
      } else {
        console.log(this.postForm);
        this.axios
          .post(process.env.MIX_API_URL + "/api/post/add", this.postForm, {
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: "Bearer " + this.local_data.token,
            },
          })
          .then((response) => {
            console.log(response);
            this.$router.push({ name: "post_list" });
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>