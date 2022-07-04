<template>
  <div class="home-layout-vue">
    <div class="content-section" style="margin-top: 210px">
      <div class="row">
        <div class="col-lg-8">
          <div
            class="post-section"
            style="padding-left: 5%; padding-right: 5%"
            v-if="data != null"
          >
            <div
              class="single-post mt-3 mb-3"
              v-for="x in data.posts"
              :key="x.id"
            >
              <div class="row">
                <div class="col-lg-12">
                  <div
                    class="single-post-layout"
                    style="background-color: hsl(0deg 0% 94%)"
                  >
                    <div class="post-meta p-3">
                      <h1>
                        <router-link :to="{ name: 'blog_page', params: { slug : x.slug} }">{{
                          x.title
                        }}</router-link>
                      </h1>
                      <h4>{{ x.published_at }}</h4>
                      <p>{{ x.content }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end-->
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
  name: "HomeLayout",
  components: {
    SideBar,
  },
  data() {
    return {
      data: null,
    };
  },
  metaInfo() {
    return {
      title: "Home",
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      this.axios
        .get(process.env.MIX_API_URL + "/api/front/post/all", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
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
  },
};
</script>