<template>
    <h1>{{user}}</h1>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        data: function(){
          return {
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

</style>
