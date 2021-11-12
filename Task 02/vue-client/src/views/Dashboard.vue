<template>
  <div class="col-8 mx-auto py-5 mt-5">
    
      <h3>User List</h3>

      <table style="width: 100%">
        <tr>
          <th style="width:30px;">#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        <tr v-for="(user,index) in allUserList.user_list" :key="user.id">

      <td>{{ index+1 }}</td>
      <td>{{ user.name }}</td>
      <td>{{ user.email }}</td>
      <td><router-link :to="{name:'User', params:{id:user.id}}"> <button>See more ..</button> </router-link></td>
        </tr>
      </table>
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
