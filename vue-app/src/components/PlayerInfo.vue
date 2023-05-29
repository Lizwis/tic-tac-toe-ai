<template>
  <div class="col-12 wrapper">
    <div class="d-flex justify-content-center">
      <form>
        <div class="col-12">
          <label for="playerName" class="playerName">Player Name</label>
          <div v-if="error" class="text-danger">You must enter your name</div>
          <input
            type="text"
            class="form-control my-2"
            :class="{ 'is-invalid': error }"
            id="playerName"
            v-model="playerName"
            placeholder="Enter your name"
            style="width: 100%"
          />
        </div>
        <button type="submit" @click="saveName" class="btn btn-warning">
          Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";

export default {
  name: "PlayerInfo",
  setup() {
    const playerName = ref("");
    const error = ref(false);

    const router = useRouter();

    const saveName = async (e) => {
      e.preventDefault();
      localStorage.setItem("playerName", playerName.value);

      if (playerName.value != "") {
        await router.push({ path: "/board" });
      } else {
        error.value = true;
      }
    };
    return {
      playerName,
      saveName,
      error,
    };
  },
};
</script>

<style scoped>
.playerName {
  font-size: 1.5rem;
  color: #fff;
  font-weight: bold;
}
button {
  font-weight: 500 !important;
}

.wrapper {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
