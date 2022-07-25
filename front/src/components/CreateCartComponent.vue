<template>
  <div class="createForm">
    <form @submit.prevent="handleCreateSubmit(cart)" method="post">
      <div class="mb-3">
        <label class="form-label">Cart name</label>
        <input @focus.native="ClearErrors" type="text" class="form-control" v-model="cart.name" aria-describedby="nameHelp">
        <div id="nameHelp" class="form-text">input option name pls</div>
      </div>
      <div v-if="isError" class="alert alert-danger" role="alert">
         {{ errorMessage }}
        <ul>
          <li v-for="error in errors">
            {{ error }}
          </li>
        </ul>
      </div>
      <button type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "CreateCartComponent",
  data() {
    return {
      isError: false,
      errorMessage:'',
      errors: [],
      cart: {
        name: ''
      }
    }
  },
  methods: {
    handleCreateSubmit: function (cart) {
      const form = new FormData();
      for (let key in cart) {
        form.append(key, cart[key]);
      }

      axios.post("http://localhost:8081/carts", form)
          .catch(error => {
            this.isError = true;
            this.errorMessage = error.response.data.message
            this.errors = error.response.data.errors
          })
          .then(() => {
            cart.name = '';
            this.updateParentOptions()
          })
    },
    updateParentOptions() {
      axios
          .get('http://localhost:8081/carts')
          .then(response => {
            this.$emit('updateParent', response.data.carts)
          })
    },
    clearErrors() {
      this.isError = false;
    }
  }
}
</script>

<style lang="scss" scoped>

.createForm {
  margin-bottom: 40px;
}

</style>