<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="/">Yashio Blogs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <router-link class="nav-link active text-light" to="/">Home</router-link>
        </li>
  
        <li class="nav-item">
            <router-link class="nav-link active text-light" to="/">Trending</router-link>
        </li>
        <li class="nav-item">
            <router-link v-if="accessToken" class="nav-link active text-light" to="/create-post">Add Post</router-link>
        </li>

        <li class="nav-item">
            <router-link v-if="!accessToken" class="nav-link active text-light" to="/sign-up">Sign Up</router-link>
        </li>

        <li class="nav-item">
            <router-link v-if="!accessToken" class="nav-link active text-light" to="/sign-in">Sign In</router-link>
        </li>

        <li class="nav-item">
            <a style="cursor: pointer;" v-if="accessToken" class="nav-link active text-light" @click="Logout">Sign Out</a>
        </li>

      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</template>

<script>
export default {
  data() {
    return {
      accessToken: null, // Initialize accessToken to null
    };
  },
  mounted() {
    // Check if the access token exists in local storage
    this.accessToken = localStorage.getItem('access_token');
  },
  methods:{
    Logout(){
      localStorage.clear()
      window.location="/"
    }
  }
};
</script>
