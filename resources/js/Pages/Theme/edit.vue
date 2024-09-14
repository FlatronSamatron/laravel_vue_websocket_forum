<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  theme: Object
})

const form = useForm({
  title: props.theme.title,
  description: props.theme.description
});

const update = () => {
  form.put(route('themes.update', props.theme.id), {
    onFinish: () => form.reset(),
  });
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">Edit Theme</h3>
    <div class="flex flex-col space-y-3">
      <input type="text" v-model="form.title" class="border-gray-300 p-2 w-1/4 rounded-md" placeholder="title">
      <textarea v-model="form.description" rows="4" class="block p-2.5 w-full text-gray-900 bg-white rounded-lg border border-gray-300" placeholder="description"></textarea>
      <div class="cursor-pointer w-1/4 rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all" @click="update">Save</div>
    </div>
  </MainLayout>
</template>

<style scoped>
</style>