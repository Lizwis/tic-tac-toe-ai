import Axios from "./Axios";

export default {
  topScores() {
    return Axios().get("top_players");
  },
  saveScore(form) {
    return Axios().post("save_score", form);
  },
};
