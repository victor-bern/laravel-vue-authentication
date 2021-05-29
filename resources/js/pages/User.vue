<template>
  <div class="container">
    <div class="modal" v-bind:class="{ active: isActive }">
      <div class="modal-container">
        <form style="padding: 25px">
          <div class="mb-3">
            <label for="Name" class="form-label">Nome do Jogo</label>
            <input
              type="text"
              class="form-control"
              v-model="game.name"
              id="Name"
              placeholder="Nome do Jogo"
            />
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              v-model="game.finished"
              id="flexCheckDefault"
            />
            <label class="form-check-label" for="flexCheckDefault">
              Zerado
            </label>
          </div>
          <button class="btn btn-primary mt-2" v-on:click.prevent="addGame">
            Adicionar
          </button>
        </form>
      </div>
    </div>

    <h2>Gerencie seus jogos</h2>
    <div class="games">
      <div class="add">
        <button
          type="button"
          style="display: flex; justify-content: center"
          v-on:click.prevent="showModal"
          class="btn btn-primary"
        >
          Adicionar game
          <i class="material-icons" style="margin-left: 8px">add</i>
        </button>
      </div>
      <div class="list-games">
        <ul class="list-group">
          <li
            class="list-group-item active"
            v-for="game in games"
            v-bind:key="game.name"
          >
            {{ game.name }}
            <span v-if="game.finished" class="badge badge-primary badge-pill">
              <font-awesome-icon :icon="['fa', 'check']"
            /></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { mapGetters } from "vuex";
import axios from "axios";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faCheck } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { getGames, addGames } from "../services/userServices.js";

library.add(faCheck);

Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;
export default {
  data: function () {
    return {
      isActive: false,
      games: [],
      user: "",
      user_token: "",
      game: {
        name: "",
        finished: false,
      },
    };
  },
  computed: {
    ...mapGetters(["getToken", "getUser"]),
  },
  methods: {
    showModal: function () {
      this.isActive = true;
    },
    hideModal: function () {
      this.isActive = false;
    },
    addGame: async function () {
      const response = await addGames(
        {
          user_id: this.user,
          name: this.game.name,
          finished: this.game.finished,
        },
        this.user_token
      );
      this.games.push({
        id: response.game.id,
        name: response.game.name,
        finished: response.game.finished,
      });
      this.hideModal();
    },
  },
  async mounted() {
    const userToken = window.localStorage.getItem("User_Token");
    const user = window.localStorage.getItem("User");
    if (!userToken) {
      this.$router.push("/");
    }
    this.user = user;
    this.user_token = userToken;

    const response = await getGames(user, userToken);
    if (response) {
      this.games = response.user;
    }
  },
};
</script>

<style scoped>
.container {
  position: fixed;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background: linear-gradient(0deg, #ffc0cb 30%, #00ffff 90%);
}

.games {
  width: 80%;
  height: 85%;
  background: white;
  border-radius: 5px;
  display: grid;
  grid-template-columns: 1fr 1fr;
}
.add {
  display: flex;
  align-items: center;
  justify-content: center;
}

.add button::after {
  content: "";
}

.modal {
  visibility: hidden;
  position: fixed;
  width: 100%;
  height: 100%;
  background: gray;
  opacity: 0.95;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal.active {
  visibility: visible;
}
.modal-container {
  border-radius: 5px;
  background: white;
  width: 550px;
  height: 200px;
}

.list-games {
  display: flex;
  max-width: 100%;
}
.list-group {
  padding: 16px;
  width: 100%;
}
.list-group-item {
  width: 90%;
  margin-bottom: 8px;
  display: flex;
  justify-content: space-between;
}
</style>
