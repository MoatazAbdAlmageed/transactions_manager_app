<script setup></script>
<template>
      <button @click="showTransactions">Transactions</button>
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
    <tr v-for="transaction in transactions" :key="transaction.id">
       
      <td>{{ transaction.id }}</td>
      <td>{{ transaction.user }}</td>
      <td>{{ transaction.amount }}</td>
      <td>{{ transaction.product }}</td>
    
    </tr>
 
  </tbody>
</table>
</template>

<script>
export default {
  data() {
    return {
      transactions: [],
    };
  },
  methods: {
   showTransactions() {
      this.products=[];
      this.users=[];
      fetch("http://localhost:8080/api/v1/transactions")
        .then((response) => response.json())
        .then((data) => (this.transactions = data));
    },
  },
};
</script>