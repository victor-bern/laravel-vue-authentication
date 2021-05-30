<template>
  <div class="list">
    <div v-if="isActive">
      <span v-on:click="activeInput">{{ game.name }}</span>
      <span class="badge badge-primary badge-pill">
        <font-awesome-icon v-if="game.finished" :icon="['fa', 'check']" />
      </span>
    </div>
    <input
      type="text"
      v-else
      v-model="game.name"
      @keypress.enter="updateName(game, game.id, game.name)"
    />
  </div>
</template>

<script>
import { updateName } from "../services/gameService.js";
export default {
  name: "list-item",
  props: {
    game: Object,
  },
  data: function () {
    return {
      isActive: true,
    };
  },
  mounted() {
    console.log(this.game);
  },
  methods: {
    activeInput: function () {
      this.isActive = false;
    },
    updateName: async function (game, gameId, gameName) {
      const token = window.localStorage.getItem("User_Token");
      console.log(token);
      const response = await updateName(gameId, gameName, token);
      if (response.sucess) {
        game.name = gameName;
      }
      this.isActive = true;
    },
  },
};
</script>

<style scoped>
.list-group-item {
  width: 90%;
  margin-bottom: 8px;
  display: flex;
  justify-content: space-between;
}
</style>
