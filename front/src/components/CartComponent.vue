<template>
  <form @submit="postData" method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Option name</label>
      <input type="text" class="form-control" v-model="cart.name" required aria-describedby="nameHelp">
      <div id="nameHelp" class="form-text">input option name pls</div>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
  </form>
</template>

<script lang="ts">
export default {
  name: "CartComponent",
  data() {
    return {
      cart: {
        name: ''
      }
    }
  },
  methods: {
    postData(e: { preventDefault: () => void; }) {
      e.preventDefault();
    }
  }
}
</script>

<style scoped>

</style>