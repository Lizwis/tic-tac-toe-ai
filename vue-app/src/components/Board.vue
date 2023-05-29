<template>
  <div>
    <div class="col-12 text-center py-3">
      <h1>Tic Tac Toe</h1>
    </div>
    <div class="d-flex justify-content-center">
      <div class="col-2">
        <TopScores :key="reloadScores" />
      </div>
      <div class="col-3 d-flex text-center mb-2 shadow-sm board">
        <div v-for="(row, x) in board" :key="x" class="col-4">
          <div
            v-for="(cell, y) in row"
            :key="y"
            @click="handleMove(x, y)"
            class="col pt-5 cells mx-1 my-2 rounded"
          >
            {{ cell === "X" ? "X" : cell === "O" ? "O" : "" }}
          </div>
        </div>
      </div>
      <div class="col-2 mx-4 text-end">
        <div class="game-satus" v-if="winner == 'X'">
          Congratulations You Won
        </div>
        <div class="game-satus" v-if="winner == 'O'">Sorry You Lost</div>
        <div class="game-satus" v-if="isTie">It's a tie!</div>
        <button
          v-if="winner || isTie"
          @click="resetGame"
          class="btn btn-warning mt-2 btn-md"
        >
          Reset
        </button>
        <button
          v-if="winner || isTie"
          @click="restartGame"
          class="btn btn-secondary mt-2 btn-md mx-2"
        >
          Back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, nextTick } from "vue";

import TopScores from "./TopScores.vue";

import ScoresApi from "../api/scores";

import { useRouter } from "vue-router";

export default {
  name: "Board",
  components: { TopScores },

  setup() {
    const player = ref("X");
    const reloadScores = ref(0);
    const board = ref([
      ["", "", ""],
      ["", "", ""],
      ["", "", ""],
    ]);

    const calculateWinner = (squares) => {
      const lines = [
        // Horizontal lines
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],

        // Vertical lines
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],

        // Diagonal lines
        [0, 4, 8],
        [6, 4, 2],
      ];

      for (const [a, b, c] of lines) {
        if (
          squares[a] &&
          squares[a] === squares[b] &&
          squares[a] === squares[c]
        ) {
          return squares[a];
        }
      }

      return null;
    };

    const winner = computed(() => {
      return calculateWinner(board.value.flat());
    });

    const isTie = computed(() => {
      return board.value.flat().every((cell) => cell !== "") && !winner.value;
    });

    const handleMove = (x, y) => {
      if (winner.value || isTie.value || board.value[x][y]) return;

      board.value[x][y] = player.value;

      if (!winner.value && !isTie.value && player.value === "X") {
        nextTick(makeBotMove);
      }

      player.value = player.value === "X" ? "O" : "X";

      if (winner.value) {
        saveScore();
      }
    };

    const saveScore = () => {
      // console.log(winner.value);
      const playerName = localStorage.getItem("playerName");

      ScoresApi.saveScore({ winner: winner.value, playerName: playerName });
      reloadScores.value = +1;
    };

    const makeBotMove = () => {
      const ai = player.value;
      const human = ai === "X" ? "O" : "X";

      const emptyCells = getEmptyCells();

      // Check if AI can win in the next move
      const aiWinningMove = findWinningMove(ai, emptyCells);
      if (aiWinningMove) {
        handleMove(aiWinningMove.x, aiWinningMove.y);
        return;
      }

      // Check if human can win in the next move and block
      const humanBlockingMove = findWinningMove(human, emptyCells);
      if (humanBlockingMove) {
        handleMove(humanBlockingMove.x, humanBlockingMove.y);
        return;
      }

      // Select a random empty cell
      const randomIndex = Math.floor(Math.random() * emptyCells.length);
      const { x, y } = emptyCells[randomIndex];
      handleMove(x, y);
    };

    const getEmptyCells = () => {
      const emptyCells = [];
      for (let i = 0; i < board.value.length; i++) {
        for (let j = 0; j < board.value[i].length; j++) {
          if (!board.value[i][j]) {
            emptyCells.push({ x: i, y: j });
          }
        }
      }
      return emptyCells;
    };

    const findWinningMove = (player, cells) => {
      for (const cell of cells) {
        const { x, y } = cell;
        board.value[x][y] = player;
        if (calculateWinner(board.value.flat()) === player) {
          board.value[x][y] = "";
          return cell;
        }
        board.value[x][y] = "";
      }
      return null;
    };

    const resetGame = () => {
      player.value = "X";
      reloadScores.value = 0;

      board.value = [
        ["", "", ""],
        ["", "", ""],
        ["", "", ""],
      ];
    };

    const router = useRouter();

    const restartGame = () => {
      router.push({ path: "/" });
    };

    return {
      player,
      board,
      winner,
      isTie,
      handleMove,
      resetGame,
      reloadScores,
      restartGame,
    };
  },
};
</script>

<style scoped>
.cells {
  cursor: pointer;
  font-size: 15px;
  font-weight: bold;
  height: 120px;
  background-color: #fff;
}

.board {
  background-color: #f9d459;
}
</style>
