<script setup>
import WelcomeItem from "./WelcomeItem.vue";
</script>

<template>
  <WelcomeItem>
    <button @click="showTransactions">Show Transactions</button>
    <table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Amount</th>
      <th>User</th>
      <th>Product</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="p in post" :key="p.id">
       
      <td>{{ p.id }}</td>
      <td>{{ p.user }}</td>
      <td>{{ p.amount }}</td>
      <td>{{ p.product }}</td>
    
    </tr>
 
  </tbody>
</table>
  
  </WelcomeItem>
</template>
<script>
export default {
  data() {
    return {
      post: [],
    };
  },
  methods: {
    showTransactions() {
      fetch("http://localhost:8080/transactions")
        .then((response) => response.json())
        .then((data) => (this.post = data));
    },
  },
};
</script>
