<template>
  <div class="login-layout-vue">
    <div class="content-section" style="margin-top: 210px">
      <div class="row">
        <div class="col-lg-8">
          <div class="post-section" style="padding-left: 5%; padding-right: 5%">
            <div class="login-pgae">
              <form v-on:submit="loginFormSubmit">
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="email"
                    aria-describedby="emailHelp"
                    placeholder="Enter email"
                    v-model="loginForm.email"
                  />
                  <small id="emailHelp" class="form-text text-muted"
                    >We'll never share your email with anyone else.</small
                  >
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="password"
                    placeholder="Password"
                    v-model="loginForm.password"
                  />
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Submit</button>
                <br />
                <router-link :to="{ name: 'home_page' }"
                  >Back To Home</router-link
                >
              </form>
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
export default {
  name: "LoginLayout",
  components: {
    SideBar,
  },
  metaInfo() {
    return {
      title: "Login",
    };
  },
  data() {
    return {
      loginForm: {
        email: null,
        password: null,
      },
      errors: [],
    };
  },
  methods: {
    loginFormSubmit(e) {
      this.errors = [];
      e.preventDefault();
      if (this.loginForm.email == null || this.loginForm.email == "") {
        this.errors.push("Invalid Email");
      } else if (
        this.loginForm.password == null ||
        this.loginForm.password == ""
      ) {
        this.errors.push("Invalid Password");
      }
      if (this.errors.length > 0) {
        this.$swal({
          title: "Error!",
          text: "Invalid Fields!",
          type: "danger",
        });
      } else {
        this.axios
          .post(process.env.MIX_API_URL + "/api/login", this.loginForm, {
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },
          })
          .then((response) => {
            if (response.data.status == "success") {
              localStorage.setItem("is_loged", "true");
              localStorage.setItem("data", JSON.stringify(response.data.data));
              this.$router.push({ name: "dashboard" });
            }
          })
          .catch((error) => {
            console.log(error);
            if (error.response.status === 401) {
              this.$swal("Wrong Credientials");
            }
          });
      }
    },
  },
};
</script>