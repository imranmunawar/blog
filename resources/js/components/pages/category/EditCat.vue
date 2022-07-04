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
                    <form v-on:submit="catAddFormSubmit" method="post">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="name"
                          aria-describedby="emailHelp"
                          placeholder="Enter Name"
                          v-model="catForm.name"
                        />
                      </div>
                      <br />
                      <button type="submit" class="btn btn-primary">
                        Update Category
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
  name: "AddCat",
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
      catForm: {
        edit_id: null,
        name: null,
      },
      data: null,
    };
  },
  mounted() {
    this.local_is_loged = localStorage.getItem("is_loged");
    this.local_data = localStorage.getItem("data");
    this.local_data = JSON.parse(this.local_data);
    this.catForm.edit_id = this.$route.params.id;
    this.getEditData();
  },
  methods: {
    catAddFormSubmit(e) {
      e.preventDefault();
      console.log(this.catForm);
      if (this.catForm.name == null || this.catForm.name == "") {
        this.$swal({
          title: "Error!",
          text: "Invalid Fields!",
          type: "danger",
        });
      } else {
        this.axios
          .post(
            process.env.MIX_API_URL + "/api/cat/edit/" + this.catForm.edit_id,
            this.catForm,
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
            this.$router.push({ name: "category_list" });
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getEditData() {
      this.axios
        .get(
          process.env.MIX_API_URL + "/api/cat/edit/" + this.catForm.edit_id,
          {
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              Authorization: "Bearer " + this.local_data.token,
            },
          }
        )
        .then((response) => {
          this.data = response.data.data;
          this.catForm.name = this.data.name;
          this.catForm.edit_id = this.data.id;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>