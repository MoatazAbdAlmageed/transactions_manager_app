<script setup></script>

<template>
  <div class="container">
    <h1> Add User</h1>
    <form>
      <div class="form-group">
        <label for="name">User</label>
        <input type="text" class="form-control" id="user"
               placeholder="Enter User" v-model="user_id">
      </div>
      <div class="form-group">
        <label for="name">Product</label>
        <input type="text" class="form-control" id="product"
               placeholder="Enter Product" v-model="product_id">
      </div>
      <div class="form-group">
        <label for="name">Amount</label>
        <input type="text" class="form-control" id="amount"
               placeholder="Enter Amount" v-model="amount">
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
      user_id: "",
      product_id: "",
      amount: "",
    };
  },
  methods: {
    async add(e) {
      e.preventDefault();
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