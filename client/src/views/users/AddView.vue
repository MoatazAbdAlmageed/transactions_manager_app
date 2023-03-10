<script setup></script>

<template>
  <div class="container">
    <h1> Add User</h1>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input required type="text" class="form-control" id="name"
               placeholder="Enter Name" v-model="name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input required type="email" class="form-control" id="exampleInputEmail1"
               placeholder="Enter email" v-model="email">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input required type="text" class="form-control" id="phone"
               placeholder="Enter Phone" v-model="phone">
      </div>
      <br/>
      <button type="submit" class="btn btn-primary" @click="add">Submit</button>
      <div>{{ error }}</div>
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
      error: "",
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();
      if (!this.name || !this.email || !this.phone) {
        this.error = 'validation error';
        throw new Error("validation error");

      }
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