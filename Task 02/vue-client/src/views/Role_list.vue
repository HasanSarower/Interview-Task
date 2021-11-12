<template>
  <div class="home col-8 mx-auto py-5 mt-5">
      <button @click="addNewRole"> Add new (Toggle) </button>
      <div v-if="showForm">
          <p>Write Role Name:</p>
          <input v-model="newRoleInput.role_name"> 
          <button @click="submitRole">Submit</button>
      </div>
    <h1>Total roles : {{ roleList.total_role }}</h1>
      <div v-for="role in roleList.role_list" :key="role.id">
          <p> {{role.id}} </p>
          <p> {{role.role_name}} </p>
        <button @click="deleteRole(role.id)">Delete role</button>
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
      roleList:{},
      showForm:false,
      newRoleInput :{ role_name :''},
      userDaat:{}
  
  }},
  methods:{
      addNewRole()
      {
          this.showForm = !this.showForm;
      },
      deleteRole(role_id)
      {
          User.deleteRole(role_id).then(response => {
          this.userDaat = response.data;
        this.getRoleList();
        });
      },
      submitRole()
      {
          User.postNewRole(this.newRoleInput).then(response => {
          this.userDaat = response.data;
        this.getRoleList();
        });
      },
      getRoleList()
      {
          User.getRoleList().then(response => {
        this.roleList = response.data;
    });
      }
  },
  mounted() {
    // User.auth().then(response => {
    //   this.$store.commit("AUTH_USER", response.data);
    // });
    this.getRoleList();
  }
};
</script>
