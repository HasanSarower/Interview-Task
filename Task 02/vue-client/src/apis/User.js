import Api from "./Api";

export default {
  register(form) {
    return Api().post("/register", form);
  },

  login(form) {
    return Api().post("/login", form);
  },

  logout() {
    return Api().post("/logout");
  },

  auth() {
    return Api().get("/user");
  },
  getAllUser(){
    return Api().get("/user-list");
  },
  getUser(id){
    return Api().get("/user-profile/"+id);
  },
  getRoleList()
  {
    return Api().get("/role-list");
  },
  postNewRole(newRole){
    return Api().post("/create-role",newRole);
  },
  deleteRole(id){
    return Api().post("/delete-role",{id:id});
  },
  assignRole(userObject){
    return Api().post("/assign-role",userObject);
  },
  deleteCurrentrole(pivot){
    return Api().post("/delete-assign-role",pivot);
  }
};
