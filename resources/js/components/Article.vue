<template>
  <div>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
      <div class="px-6 py-4">
        <router-link :to="`/articles/${article.id}`">
          <div class="mb-4">
            <img
              class="w-10 h-10 mr-3 rounded-full inline"
              :src="`/storage/${article.featured_image.image}`"
              :alt="article.title"
            >
            <h4 class="font-bold text-xl mb-2 inline">{{ article.title }}</h4>
          </div>
        </router-link>
        <p
          class="text-gray-700 text-base block"
          v-html="$options.filters.limitText(article.content)"
        ></p>
      </div>
      <div class="px-6 py-4 mb-2">
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

  export default {
    name: "Article",
    props: ["article"],
    data() {
      return {
        moment: moment
      };
    },
    filters: {
      limitText(value) {
        return value.trim().substring(0, 50) + "...";
      }
    }
  };
</script>
