<template>
    <div class="mt-4">
      <ul>
        <li v-for="post in posts" :key="post.id">
          <h3> <router-link style="text-decoration: none;" :to="`/post/${post.post.id}`"> {{ post.post.title }}</router-link></h3>
          <p>Author: <router-link :to="`/author/${post.author.name}`"> {{ post.author.name }}</router-link></p>
          <p>Category: <router-link :to="`/category/${post.category.name}`"> {{ post.category.name }}</router-link></p>
          <p>Tags: 
            <ul style="display: inline;" v-for="tag in post.tags" :key="tag.id">
              <router-link :to="`/tag/${tag.name}`"> {{ tag.name }}</router-link>
            </ul>
          </p>

          <p>{{ post.post.body }}</p>
          <hr>
        </li>
      </ul>
    </div>
  </template>
  

  <script>
  export default {
    data() {
      return {
        posts: [],
      };
    },
    mounted() {
      this.fetchPosts();
    },
    methods: {
      async fetchPosts() {
        try {
          const response = await fetch('http://127.0.0.1:8000/api/posts');
          const data = await response.json();
  
          this.posts = data;

        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>

  