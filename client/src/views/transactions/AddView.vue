<script setup></script>

<template>
  <div class="container">
    <h1> Add User</h1>
    <form>
      <div class="form-group">
        <label for="name">User</label>
        <input required type="text" class="form-control" id="user"
               placeholder="Enter User" v-model="user_id">
      </div>
      <div class="form-group">
        <label for="name">Product</label>
        <input required type="text" class="form-control" id="product"
               placeholder="Enter Product" v-model="product_id">
      </div>
      <div class="form-group">
        <label for="name">Amount</label>
        <input required type="text" class="form-control" id="amount"
               placeholder="Enter Amount" v-model="amount">
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
      user_id: "",
      product_id: "",
      amount: "",
      error: "",
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();
      if (!this.user_id || !this.product_id || !this.amount) {
        this.error = 'validation error';
        throw new Error("validation error");

      }
      axios.post("http://localhost:8080/api/v1/transactions/add", {
        user_id: this.user_id,
        product_id: this.product_id,
        amount: this.amount
      })
          .then((messages) => {
            console.log(messages)
            this.$router.push('transactions')
          });
    }
  }
};

</script>