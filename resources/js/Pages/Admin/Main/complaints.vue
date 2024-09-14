<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";
import {CheckCircleIcon} from "@heroicons/vue/24/outline/index.js";

defineProps({
  complaints: Array
})

const update = (complaint) => {
  axios.put(route('admin.complaints.update', complaint.id)).then(()=>{
    complaint.is_solved = !complaint.is_solved
  })
}

</script>

<template>
  <AdminLayout>
    <h3 class="text-xl mb-3 underline">Complaints:</h3>
    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-800 dark:text-gray-400">
        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">ID</th>
          <th scope="col" class="px-6 py-3">Text</th>
          <th scope="col" class="px-6 py-3">User</th>
          <th scope="col" class="px-6 py-3">Message</th>
          <th scope="col" class="px-6 py-3">Status</th>
          <th scope="col" class="px-6 py-3">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="complaint in complaints" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          <td class="px-6 py-4">{{ complaint.id }}</td>
          <td class="px-6 py-4">{{ complaint.body }}</td>
          <td class="px-6 py-4">{{ complaint.user.name }}</td>
          <td class="px-6 py-4">
            <Link
                :href="route('themes.show', complaint.theme_id) + `#${complaint.message_id}`"
            >
              message - {{ complaint.message_id }}
            </Link>
          </td>
          <td class="px-6 py-4">{{ !complaint.is_solved ? 'consideration' : 'solved' }}</td>
          <td class="px-6 py-4 flex justify-center">
            <CheckCircleIcon @click="update(complaint)" :class="{'text-green-500' : !!complaint.is_solved}" class="size-6 cursor-pointer text-yellow-500"/>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>

<style scoped>

</style>