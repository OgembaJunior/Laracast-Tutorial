<template>
  <Navigation/>
  <router-view/>
</template>

<script>
  import Navigation from './components/navigationBar.vue'
  import 'bootstrap/dist/css/bootstrap.css';
  import 'bootstrap/dist/js/bootstrap.js';



  export default {
  name: 'App',
  components: {
    Navigation
  }
}
</script>

