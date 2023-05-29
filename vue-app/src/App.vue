<script setup>
import { RouterView } from "vue-router";

//import PlayerInfo from "./components/PlayerInfo.vue";
</script>

<template>
  <div class="wrapper">
    <RouterView />
  </div>
</template>

<style>
body {
  background-color: #f9d459 !important;
}

.game-satus {
  font-size: 20px;
  font-weight: bold;
  color: #fff;
}
</style>
