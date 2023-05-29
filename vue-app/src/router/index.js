import { createRouter, createWebHistory } from "vue-router";
import PlayerInfo from "../components/PlayerInfo.vue";
import Board from "../components/Board.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: PlayerInfo,
    },
    {
      path: "/board",
      name: "Board",
      component: Board,
    },
  ],
});

export default router;
