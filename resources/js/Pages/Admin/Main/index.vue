<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
  statistics: Object
})

</script>

<template>
  <AdminLayout>
    <h3 class="text-xl mb-3 underline">Statistic:</h3>
    <div v-for="(value, key) in statistics" :key="key">
      <b>{{ key.toUpperCase() }}</b>: {{ value }}
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>