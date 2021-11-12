<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <button @click="addNewRole">Toggle to Add new Role</button>
    <div v-if="showForm" class="mt-3">
      <p>Write Role Name:</p>
      <input v-model="newRoleInput.role_name" />
      <button @click="submitRole">Submit</button>
    </div>
    <h1 class="mt-3">Total roles : {{ roleList.total_role }}</h1>

    <table style="width: 100%">
      <tr>
        <th style="width:30px;">Id</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
      <tr v-for="role in roleList.role_list" :key="role.id">
        <td>{{ role.id }}</td>
        <td>{{ role.role_name }}</td>
        <td><button class="btn btn-secondary" @click="deleteRole(role.id)">Delete role</button></td>
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
      user: (state) => state.auth.user,
    }),
  },
  data() {
    return {
      roleList: {},
      showForm: false,
      newRoleInput: { role_name: "" },
      userDaat: {},
    };
  },
  methods: {
    addNewRole() {
      this.showForm = !this.showForm;
    },
    deleteRole(role_id) {
      User.deleteRole(role_id).then((response) => {
        this.userDaat = response.data;
        this.getRoleList();
      });
    },
    submitRole() {
      User.postNewRole(this.newRoleInput).then((response) => {
        this.userDaat = response.data;
        this.getRoleList();
      });
    },
    getRoleList() {
      User.getRoleList().then((response) => {
        this.roleList = response.data;
      });
    },
  },
  mounted() {
    // User.auth().then(response => {
    //   this.$store.commit("AUTH_USER", response.data);
    // });
    this.getRoleList();
  },
};
</script>
