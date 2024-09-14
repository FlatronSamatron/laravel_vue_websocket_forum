<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
  title: '',
});

const store = () => {
  form.post(route('sections.store'), {
    onFinish: () => form.reset(),
  });
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">Add Section</h3>
    <div>
      <input type="text" v-model="form.title" class="border-gray-300 p-2 w-1/4 rounded-md mb-3" placeholder="title">
      <div class="cursor-pointer w-1/4 rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all" @click="store">Add</div>
    </div>
  </MainLayout>
</template>

<style scoped>
</style>