<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {ref, onMounted} from "vue";

const props = defineProps({
  sections: Array,
  branch: Object,
  errors: Object
})

const form = useForm({
  title: props.branch.title,
  section_id: props.branch.section_id,
  parent_id: null
});



const branches = ref([]);

const update = () => {
  form.put(route('branches.update', props.branch.id), {
    onFinish: () => form.reset(),
  });
}

onMounted(() => {
  getBranches()
  form.parent_id = props.branch.parent_id
})

const getBranches = () => {
  form.parent_id = null
  axios(route('sections.branches', form.section_id)).then(body => {
    branches.value = body.data.filter( el => el.id !== props.branch.id)
  })
}


</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">Edit Branch</h3>
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
      <div class="cursor-pointer rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all" @click="update">Save</div>
    </div>
    <div class="mt-4 text-red-500" v-if="errors">
      <div v-for="error in errors">{{error}}</div>
    </div>
  </MainLayout>
</template>

<style scoped>
</style>