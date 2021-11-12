<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>User</h1>
      <p>{{ user.user.id }}</p>
      <p>{{ user.user.name }}</p>
      <p>{{ user.user.email }}</p>
      <p v-for="role in user.user.roles" :key="role.id">{{ role.role_name }}<button @click="deleteCurrentrole(role.pivot)">delete this role</button></p>

      <select name="cars" v-model="assigned_role">
        <option v-for="role in role_list.role_list" :value="role.id" :key="role.id">{{ role.role_name }}</option>
      </select>
      <button @click="assignRole()">Assign role</button>
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
      userId:this.$route.params.id ,
      assigned_role:'',
      role_list:{},
      msg:''
  
  }},
  methods:{
    getRoleList()
      {
          User.getRoleList().then(response => {
          this.role_list = response.data;
    });
      },
      assignRole()
      {
        User.assignRole({role_id:this.assigned_role , user_id:this.userId}).then(response => {
      this.msg = response.data;
      this.getUser();
    });
      },
      deleteCurrentrole(pivot)
      {
        User.deleteCurrentrole(pivot).then(response => {
      this.msg = response.data;
      this.getUser();
      });
      },
      getUser()
      {
        User.getUser(this.userId).then(response => {
      this.user = response.data;
      console.log(response.data);
    });
      }
  },
  mounted() {
    // User.auth().then(response => {
    //   this.$store.commit("AUTH_USER", response.data);
    // });
    this.getRoleList();
    this.getUser();
  }
};
</script>
