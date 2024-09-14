<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const form = useForm({
  title: '',
  section_id: null,
  parent_id: null
});

defineProps({
  sections: Array,
  errors: Object
})

const branches = ref([]);

const store = () => {
  form.post(route('branches.store'), {
    onFinish: () => form.reset(),
  });
}

const getBranches = () => {
    form.parent_id = null
    axios(route('sections.branches', form.section_id)).then(body => branches.value = body.data)
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">Add Branch</h3>
    <div class="flex flex-col w-1/4 gap-3">
      <select @change="getBranches" v-if="!!sections.length" v-model="form.section_id" class="rounded-md border-gray-300 cursor-pointer">
        <option value="null" selected disabled>Choose section</option>
        <option :key="section.id" :value="section.id" v-for="section in sections">{{section.title}}</option>
      </select>
      <select v-if="!!branches.length" v-model="form.parent_id" class="rounded-md border-gray-300 cursor-pointer">
        <option value="null" selected disabled>Choose branch</option>
        <option :key="branch.id" :value="branch.id" v-for="branch in branches">{{branch.title}}</option>
      </select>
      <input type="text" v-model="form.title" class="border-gray-300 p-2 rounded-md" placeholder="title">
      <div class="cursor-pointer rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all" @click="store">Add</div>
    </div>
    <div class="mt-4 text-red-500" v-if="errors">
      <div v-for="error in errors">{{error}}</div>
    </div>
  </MainLayout>
</template>

<style scoped>
</style>