<template>
  <div class="container">
      <div class="forms">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <button
                      class="nav-link active"
                      id="home-tab"
                      data-bs-toggle="tab"
                      data-bs-target="#home"
                      type="button"
                      role="tab"
                      aria-controls="home"
                      aria-selected="true"
                  >
                      Login
                  </button>
              </li>
              <li class="nav-item" role="presentation">
                  <button
                      class="nav-link"
                      id="profile-tab"
                      data-bs-toggle="tab"
                      data-bs-target="#profile"
                      type="button"
                      role="tab"
                      aria-controls="profile"
                      aria-selected="false"
                  >
                      Register
                  </button>
              </li>
          </ul>
          <div class="tab-content mt-4" id="myTabContent">
              <div
                  class="tab-pane fade show active"
                  id="home"
                  role="tabpanel"
                  aria-labelledby="home-tab"
              >
                  <form class="my-4" novalidate>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email address</label>
                          <input
                              type="email"
                              class="form-control"
                              id="email"
                              aria-describedby="email"
                              v-model="userLogin.email"
                          />
                      </div>
                      <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" v-model="userLogin.password" class="form-control" id="password" />
                      </div>
                      <button type="submit" v-on:click.prevent="login" class="btn btn-primary">Submit</button>
                  </form>
              </div>
              <div
                  class="tab-pane fade"
                  id="profile"
                  role="tabpanel"
                  aria-labelledby="profile-tab"
              >
                  <form class="my-4" novalidate>
                      <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input
                              type="text"
                              class="form-control"
                              id="name"
                              aria-describedby="name"
                              v-model="userRegister.name"
                          />
                      </div>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email address</label>
                          <input
                              type="email"
                              class="form-control"
                              id="email"
                              aria-describedby="email"
                              v-model="userRegister.email"
                          />
                      </div>
                      <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" v-model="userRegister.password"
                          />
                      </div>
                      <button class="btn btn-primary" v-on:click.prevent="addUser">Submit</button>
                  </form>
              </div>
          </div>
          <div class="b-toaster" v-if="error" v-bind:class="{ hide: isHide }">
              <span class="alert alert-danger">{{error}}</span>
          </div>
          <div class="b-toaster" v-if="sucess" v-bind:class="{ hide: isHide }">
              <span class="alert alert-success">{{sucess}}</span>
          </div>
      </div>
  </div>
</template>


<script lang="ts">
    import Vue from "vue";
    import axios from "axios";
    import { mapGetters } from 'vuex'

    export default Vue.extend({
        data(){
            return {
                isHide: false,
                error: "",
                sucess: "",
                userRegister: {
                    name: "",
                    email: "",
                    password: ""
                },
                userLogin: {
                    email: "",
                    password: ""
                }
            }
        },
        methods: {
            addUser: function () {
                axios.post("api/user/register", this.userRegister)
                    .then(response => {
                        if(response.data.Erro){
                            this.error = response.data.Erro;
                            this.hideToast();
                            return;
                        }
                        console.log(response.data);
                        window.localStorage.setItem("token", response.data.token);
                        this.sucess = "Conta criada com sucesso";
                        this.userRegister.name = "";
                        this.userRegister.email = "";
                        this.userRegister.password = "";
                        this.hideToast();
                    });
            },
            login: function(){
                axios.post("api/user/login", this.userLogin)
                    .then(response => {
                        if(response.data.Erro){
                            this.error = response.data.Erro;
                            this.hideToast();
                            return;
                        }
                        this.$store.dispatch("setToken", {
                            token: response.data.access_token,
                            user: response.data.user});
                        window.localStorage.setItem("User_Token", response.data.access_token);
                        window.localStorage.setItem("User", response.data.user);
                        this.$router.push('user');
                    })
            },
            hideToast: function () {
                setTimeout(
                    () => {
                        this.isHide = true;
                    }, 5000);
            }

        },
        computed: {
            // mix the getters into computed with object spread operator
            ...mapGetters([
                'getToken',
                // ...
            ])
        },
    });
</script>


<style scoped>
.container {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.forms {
  width: 500px;
  height: 500px;
  background: white;
  border-radius: 10px;
}

#myTab {
  display: flex;
  justify-content: center;
}

form {
  padding: 14px;
}

form button {
  width: 100%;
}
    .b-toaster{
        position: absolute;
        top: 35px;
        right: 45px;
        min-width: 220px;
        max-width: 400px;
        animation-duration: 1s;
        animation-name: slidein;
    }

    .b-toaster.hide{
        animation-duration: 3s;
        animation-name: slideOut;
        visibility: hidden;
    }

@keyframes slidein {
    from {
        visibility: hidden;
        top: -12px;
        right: -1px;
    }

    to {
        visibility: visible;
       top: 35px;
        right: 45px;
    }
}

@keyframes slideOut {
    from {
        visibility: visible;
        top: 35px;
        right: 45px;
    }

    to {
        visibility: hidden;
        top: -100px;
        right: -100px;
    }
}
</style>
