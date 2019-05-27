<template>
  <div>
    <div class="container mx-auto">
      <Navbar/>

      <div class="px-2">
        <h4
          class="text-2xl text-indigo-700 font-medium mb-5 border-b sm:border-none"
        >Recently Added Articles</h4>

        <div class="flex flex-wrap -mx-2 sm:-mx-2 md:-mx-2 lg:-mx-2">
          <div
            class="w-full mb-5 sm:w-1/3 sm:mb-5 my-2 sm:mb-10"
            v-for="(article, index) in articles"
            :key="index"
          >
            <Article :article="article"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Article from "./Article";
  import Navbar from "./Navbar";

  export default {
    name: "Homepage",
    components: {
      Article,
      Navbar
    },
    data() {
      return {
        articles: []
      };
    },
    created() {
      this.fetchArticles();
    },
    methods: {
      fetchArticles() {
        axios.get("/api/articles").then(res => (this.articles = res.data));
      }
    }
  };
</script>
