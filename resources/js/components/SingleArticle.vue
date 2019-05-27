<template>
  <div>
    <div class="container mx-auto pb-10">
      <navbar></navbar>

      <img :src="`${article.featured_image.image}`" :alt="article.title" class="w-full h-64 mb-5">

      <p
        class="text-lg mb-8"
      >Posted on {{ moment(article.created_at).format('DD/MM/YYYY') }} by {{ article.author.name }}</p>

      <p class="text-base mb-12" v-html="article.content"></p>

      <div class="mb-10">
        <span
          v-for="(tag, index) in article.tags"
          :key="index"
          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-1"
        >{{ tag.name }}</span>
      </div>
    </div>
  </div>
</template>

<script>
  import moment from "moment";
  import Navbar from "./Navbar";

  export default {
    name: "SingleArticle",
    components: {
      Navbar
    },
    data() {
      return {
        article: {},
        moment: moment
      };
    },
    created() {
      this.fetchArticle();
    },
    methods: {
      fetchArticle() {
        axios
          .get(`/api/articles/${this.$route.params.id}`)
          .then(res => {
            this.article = res.data;
            document.title = res.data.title;
          })
          .catch(err => console.log(err.response));
      }
    },
    destroyed() {
      document.title = "Mediumly";
    }
  };
</script>
