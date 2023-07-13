<template>
  <div class="mt-4">
      <ul>
        <li v-for="post in post" :key="post.id">
          <h3>{{ post.post.title }}</h3>
          <p>Author: <router-link :to="`/author/${post.author.name}`"> {{ post.author.name }}</router-link></p>
          <p>Category: <router-link :to="`/category/${post.category.name}`"> {{ post.category.name }}</router-link></p>

          <p>{{ post.post.body }}</p>
        </li>
      </ul>
    </div>
</template>


<script>
export default {
  data() {
    return {
      post: [],
    };
  },
  mounted() {
    this.fetchPost();
    this.id = this.$route.params.id;
  },
  methods: {
    async fetchPost() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/post/${this.$route.params.id}`);
        const data = await response.json();

        this.post = data;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>