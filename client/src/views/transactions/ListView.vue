<script setup>
import {RouterLink} from 'vue-router'
</script>

<template>
  <div class="container">
    <h1> {{ items.length }} Transactions </h1>
    <div>
      <RouterLink class="btn btn-primary" to="/add-transactions">Add</RouterLink>
    </div>
    <br/>
    <table class="table table-dark">
      <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Product</th>
        <th>Amount</th>

      </tr>
      </thead>
      <tbody>
      <tr v-for="({ id,user,amount,product }, index) in items" :key="index">
        <td>{{ id }}</td>
        <td>{{ user }}</td>
        <td>{{ product }}</td>
        <td>{{ amount }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    fetch("http://localhost:8080/api/v1/transactions")
        .then((response) => response.json())
        .then((data) => (this.items = data));
  },
  data() {
    return {
      items: [],
    };
  },
};

</script>