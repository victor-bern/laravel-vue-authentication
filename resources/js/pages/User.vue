<template>
    <div class="container">

        <div class="modal" v-bind:class="{active: isActive}">
            <div class="modal-container">

            </div>
        </div>

        <h2>Gerencie seus jogos</h2>
        <div class="games">
            <div class="add">
                <button type="button" style="display: flex; justify-content: center" v-on:click.prevent="showModal" class="btn btn-primary">Adicionar game <i class="material-icons" style="margin-left: 8px">add</i></button>
            </div>
            <div class="list-games">

            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        data: function(){
          return {
              isActive: false,
              user: "",
              user_token: ""
          }
        },
        computed: {
            ...mapGetters([
                "getToken",
                "getUser"
            ])
        },
        methods: {
          showModal: function () {
              this.isActive = true;
          }
        },
        mounted() {
            var userToken = window.localStorage.getItem("User_Token");
            var user = window.localStorage.getItem("User");
            if(!userToken){
                this.$router.push('/');
            }
            this.user = user;
            this.user_token = userToken;
            console.log({
                user: this.user,
                token: this.user_token
            })
        }
    }
</script>

<style scoped>
    .container{
        position: fixed;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background: linear-gradient(0deg, #FFC0CB 30%, #00FFFF 90%)
    }

    .games{
        width: 80%;
        height: 85%;
        background: white;
        border-radius: 5px;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    .add{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .add button::after{
        content: ""
    }

    .modal{
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

    .modal.active{
        visibility: visible;
    }
    .modal-container{
        border-radius: 5px;
        background: white;
        width: 450px;
        height: 450px;
    }

</style>
