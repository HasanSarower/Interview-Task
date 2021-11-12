<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>User Profile</h1>
    <div class="d-flex flex-column">
      <span><label>ID: </label> {{ user.user.id }}</span>
     <span> <label>Name: </label> {{ user.user.name }}</span>
     <span> <label>Email: </label> {{ user.user.email }}</span>
     
      <p v-for="role in user.user.roles" :key="role.id"><label>Role: </label> {{ role.role_name }} <button class="ml-5" @click="deleteCurrentrole(role.pivot)">delete this role</button></p>

      <div><label>Assign Role: </label>
      <select name="cars" v-model="assigned_role">
        <option v-for="role in role_list.role_list" :value="role.id" :key="role.id"> {{ role.role_name }}</option>
      </select> &nbsp;
      <button class="ml-4" @click="assignRole()">Confirm</button>
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

<style scoped>
label{
  font-weight: bold;
  width: 110px;
}
</style>