<template>
  <div class="container">
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
export default Vue.extend({});
</script>

<style scoped>
    .container{
        position: fixed;
        max-width: 100%;
        height: 100%;
    }
</style>
