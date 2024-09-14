<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const file = ref(null);

const props = defineProps({
  user: Object
})

const storeAvatar = (e) => {
  const file = e.target.files[0]
  const formData = new FormData()
  formData.append('avatar', file)
  formData.append('_method', 'put')

  axios.post(route('users.personal.update'), formData).then(data => {
    props.user.avatar = data.data.avatar
  })
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">{{user.name}}</h3>
    <div class="bg-white p-4 rounded-lg border border-gray-300">
      Change avatar
      <div @click="file.click()" class="mt-2 block w-24 h-24 rounded-full bg-sky-500 cursor-pointer overflow-hidden">
        <img v-if="user.avatar" :src="user.avatar" :alt="user.name">
      </div>
      <input @change="storeAvatar" ref="file" hidden type="file">
    </div>
  </MainLayout>
</template>

<style scoped>
</style>