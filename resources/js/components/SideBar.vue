<template>
  <div class="col-lg-4">
    <div
      class="category-section mt-4"
      style="padding-left: 5%; padding-right: 25%"
    >
      <ul style="list-style: none" v-if="data != null">
        <li v-for="x in data.categories" :key="x.id">
          <h5 style="margin-bottom: -16px; color: hsl(67deg 21% 68%)">
           {{ x.name }}
          </h5>
          <hr style="height: 3px" />
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "SideBar",
  data(){
    return {
      data: null
    }
  },
  mounted(){
    this.allCatList();
  },
  methods: {
    allCatList() {
      this.axios
        .get(process.env.MIX_API_URL + "/api/front/cat/all", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          this.data = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
