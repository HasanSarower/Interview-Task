<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>User</h1>
      <p>{{ user.user.id }}</p>
      <p>{{ user.user.name }}</p>
      <p>{{ user.user.email }}</p>
      <p v-for="role in user.user.roles" :key="role.id">{{ role.role_name }}</p>
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
      user:{},
      userId:this.$route.params.id 
  
  }},
  mounted() {
    User.auth().then(response => {
      this.$store.commit("AUTH_USER", response.data);
    });
    User.getUser(this.userId).then(response => {
      this.user = response.data;
      console.log(response.data);
    });
  }
};
</script>
