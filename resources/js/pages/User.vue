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
      <div class="list-games"></div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
  data: function () {
    return {
      isActive: false,
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
    addGame: function () {
      const config = {
        headers: {
          Authorization: "Bearer " + "this.user_token",
          Accept: "application/json",
        },
      };
      const data = {
        name: this.game.name,
        finished: this.game.finished,
        id: this.user,
      };
      console.log(data);
      axios
        .post("http://127.0.0.1:8000/api/game/addgame", data, config)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          if ((error.status = 401)) {
            console.log({
              error: error,
              massage: "Unauthorized",
            });
          }
        });

      this.hideModal();
    },
  },
  mounted() {
    const userToken = window.localStorage.getItem("User_Token");
    const user = window.localStorage.getItem("User");
    if (!userToken) {
      this.$router.push("/");
    }
    this.user = user;
    this.user_token = userToken;

    const config = {
      headers: {
        Authorization: "Bearer " + "",
        Accept: "application/json",
      },
    };
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
</style>
