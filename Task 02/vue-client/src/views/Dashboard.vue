<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>Dashboard</h1>
    <div class="card">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>

    <div v-for="(user,index) in allUserList.user_list" :key="user.id">
      <p>{{ index+1 }}</p>
      <p>{{ user.name }}</p>
      <p>{{ user.email }}</p>
      <router-link :to="{name:'User', params:{id:user.id}}"> <button>See more ..</button> </router-link>
    </div>
    </div>
  </div>
</template>

<script>
import User from "../apis/User";
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      user: state => state.auth.user
    })
  },
  data(){
    return {
      allUserList:{}
  
  }},
  mounted() {
    // User.auth().then(response => {
    //   this.$store.commit("AUTH_USER", response.data);
    // });
    User.getAllUser().then(response => {
      this.allUserList = response.data;
      console.log(response.data);
    });;
  }
};
</script>
