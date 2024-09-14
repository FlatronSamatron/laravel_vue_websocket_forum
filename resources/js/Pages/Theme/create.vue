<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  branch: Object
})

const form = useForm({
  title: '',
  description: '',
  branch_id: props.branch.id
});

const store = () => {
  form.post(route('themes.store'), {
    onFinish: () => form.reset(),
  });
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">Add Theme to > <span class="underline">{{branch.title}}</span></h3>
    <div class="flex flex-col space-y-3">
      <input type="text" v-model="form.title" class="border-gray-300 p-2 w-1/4 rounded-md" placeholder="title">
      <textarea v-model="form.description" rows="4" class="block p-2.5 w-full text-gray-900 bg-white rounded-lg border border-gray-300" placeholder="description"></textarea>
      <div class="cursor-pointer w-1/4 rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all" @click="store">Add</div>
    </div>
  </MainLayout>
</template>

<style scoped>
</style>