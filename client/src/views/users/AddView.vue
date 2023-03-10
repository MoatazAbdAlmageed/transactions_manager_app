<script setup></script>

<template>
  <div class="container">
    <h1> Add User</h1>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name"
               placeholder="Enter Name" v-model="name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1"
               placeholder="Enter email" v-model="email">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone"
               placeholder="Enter Phone" v-model="phone">
      </div>
      <br/>
      <button type="submit" class="btn btn-primary" @click="add">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      items: [],
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();
      axios.post("http://localhost:8080/api/v1/users/add", {
        name: this.name,
        phone: this.phone,
        email: this.email
      })
          .then((messages) => {
            console.log(messages)
            this.$router.push('users')

          });
    }
  }
};

</script>