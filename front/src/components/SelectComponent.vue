<template>
  <div class="d-flex align-items-start">
    <div class="v-select d-inline-block">
      <p>Carts</p>
      <div>
        <form>
          <div class="mt-1">
            <input type="text" v-model="searchTermOne" class="form-control" placeholder="Search for cart" aria-describedby="nameHelp">
          </div>
        </form>
      </div>
      <div
          class="options"
      >
        <template
            v-if="options.length > 0"
            v-for="option in filteredOptions(false)"
            :key="option.id"
        >
          <p
              v-if="!option.isSelected"
              @click="selectOption(option)" :class="{selectable:selected == option.id}"
              v-bind:id="option.id"
          >
            {{ option.name }}
          </p>
        </template>
        <p v-if="searchTermOne.length && !filteredOptions(false).length">No results found!</p>
      </div>
    </div>
    <div class="v-select d-inline-block d-flex justify-content-center align-items-center ">
      <form class="align-self-center" @submit.prevent="moveAllOptions()" method="post">
        <button class="btn btn-primary" type="submit"><i class="bi bi-chevron-double-right"></i></button>
      </form>
      <form class="align-self-center" @submit.prevent="moveOneOption()" method="post">
        <button class="btn btn-primary" type="submit"><i class="bi bi-chevron-compact-right"></i></button>
      </form>
      <form class="align-self-center" @submit.prevent="moveOneOptionBack()" method="post">
        <button class="btn btn-primary" type="submit"><i class="bi bi-chevron-compact-left"></i></button>
      </form>
      <form class="align-self-center" @submit.prevent="moveAllOptionsBack()" method="post">
        <button class="btn btn-primary" type="submit"><i class="bi bi-chevron-double-left"></i></button>
      </form>
    </div>
    <div class="v-select d-inline-block">
      <p>Selected carts</p>
      <div>
        <form>
          <div class="mt-1">
            <input type="text" v-model="searchTermTwo" class="form-control" placeholder="Search for cart" aria-describedby="nameHelp">
          </div>
        </form>
      </div>
      <div
          class="options"
      >
        <template
            v-if="options.length > 0"
            v-for="option in filteredOptions(true)"
            :key="option.id"
        >
          <p
              v-if="option.isSelected"
              @click="selectOption(option)" :class="{selectable:selected == option.id}"
              v-bind:id="option.id"
          >
            {{ option.name }}
          </p>
        </template>
        <p v-if="searchTermTwo.length && !filteredOptions(true).length">No results found!</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SelectComponent",
  data() {
    return {
      selected: 0,
      searchTermOne: "",
      searchTermTwo: "",
    }
  },
  props: {
    options: {
      type: Array,
      default() {
        return []
      }
    }
  },
  methods: {
    filteredOptions(isSelected) {
      return this.options.filter(option => {
        if (isSelected === true) {
          if (option.isSelected === isSelected) {
            return option.name.toLowerCase().includes(this.searchTermTwo.toLowerCase())
          }
        } else {
          if (option.isSelected === isSelected) {
            return option.name.toLowerCase().includes(this.searchTermOne.toLowerCase())
          }
        }
      }
      );
    },
    selectOption(option) {
      this.selected = option.id
    },
    updateParentOptions() {
      axios
          .get('http://localhost:8081/carts')
          .then(response => {
            this.$emit('updateParent', response.data.carts)
          })
    },
    moveOneOption() {
      const form = new FormData();
      form.append('name', this.$el.querySelector(".selectable").innerText);
      form.append('isSelected', 'true');
      axios.post("http://localhost:8081/carts/" + this.$el.querySelector(".selectable").id, form)
          .then(() => this.updateParentOptions())
    },
    moveOneOptionBack() {
      const form = new FormData();
      form.append('name', this.$el.querySelector(".selectable").innerText);
      form.append('isSelected', 'false');
      axios.post("http://localhost:8081/carts/" + this.$el.querySelector(".selectable").id, form)
          .then(() => this.updateParentOptions())
    },
    moveAllOptions() {
      for (const option of this.options) {
        if (option.isSelected == false) {
          const form = new FormData();
          form.append('name', option.name);
          form.append('isSelected', 'true');
          axios.post("http://localhost:8081/carts/" + option.id, form)
        }
      }

      this.updateParentOptions()
    },
    moveAllOptionsBack() {
      for (const option of this.options) {
        if (option.isSelected == true) {
          const form = new FormData();
          form.append('name', option.name);
          form.append('isSelected', 'false');
          axios.post("http://localhost:8081/carts/" + option.id, form)
        }
      }

      this.updateParentOptions()
    },
  }
}
</script>

<style scoped>
  .v-select {
    width: 100%;
    min-height: 300px;
    cursor: pointer;
  }

  .v-select p {
    margin: 0;
  }

  .options {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 5px;
    position: relative;
    top: 20px;
    right: 0;
    width: 100%;
    min-height: 300px;
  }

  .options p:hover {
    background: #e7e7e7;
  }

  .selectable{
    background: #e7e7e7;
  }
</style>