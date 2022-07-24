<template>
  <CreateCartComponent
    @updateParent="updateOptions"
  />

  <SelectComponent
    :options="options"
    @updateParent="updateOptions"
  />
</template>

<script>
import axios from "axios";
import CreateCartComponent from "@/components/CreateCartComponent.vue";
import SelectComponent from "@/components/SelectComponent.vue";

export default {
  name: "CartComponent",
  components: {
    CreateCartComponent,
    SelectComponent
  },

  data() {
    return {
      options: []
    }
  },
  mounted() {
    axios
        .get('http://localhost:8081/carts')
        .then(response => {
          this.options = response.data.carts
        })
  },
  methods: {
    updateOptions(options) {
      this.options = options
    }
  }
}
</script>

<style scoped>

</style>