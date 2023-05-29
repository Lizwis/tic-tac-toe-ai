<template>
  <div class="col-12 game-satus mb-4">Top Scores</div>

  <ul v-for="score in scores" :key="score.id" style="color: #fff">
    <li>{{ score.name }} : {{ score.total_score }} Wins</li>
  </ul>
</template>

<script>
import { ref, onMounted } from "vue";

import ScoresApi from "../api/scores";

export default {
  name: "TopScores",

  setup() {
    const scores = ref(null);

    const getScores = async () => {
      const response = await ScoresApi.topScores();
      scores.value = response.data;
    };

    onMounted(async () => {
      await getScores();
    });
    return {
      scores,
    };
  },
};
</script>

<style scoped></style>
