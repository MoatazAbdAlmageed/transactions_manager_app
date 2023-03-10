<script setup></script>

<template>
  <div class="container">
    <h1> Add Product</h1>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input required type="text" class="form-control" id="name"
               placeholder="Enter Name" v-model="name">
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
      error: '',
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();
      if (!this.name) {
        this.error = 'validation error';
        throw new Error("validation error")
      }
      axios.post("http://localhost:8080/api/v1/products/add", {
        name: this.name,
      })
          .then((messages) => {
            console.log(messages)
            this.$router.push('products')

          });
    }
  }
};

</script>