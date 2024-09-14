<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import {FolderIcon, PencilIcon, TrashIcon, DocumentIcon} from "@heroicons/vue/24/outline/index.js";

defineProps({
  branch: Object,
  errors: Object
})

</script>

<template>
  <MainLayout>
    <div class="flex items-center mb-3">
      <Link :href="route('branches.theme.create', branch.id)"
            class="block mr-4 bg-white border border-gray-300 rounded-lg text-center w-1/6 p-1 hover:border-gray-400 transition-all font-extrabold text-gray-500">
        + Theme
      </Link>
    </div>
    <h3 class="text-xl mb-3">Branch:</h3>

    <ul class="divide-y bg-white mx-auto px-4 border mb-4">
      <li class="py-4">
        <div class="flex items-center space-x-3">
          <FolderIcon class="size-4 text-blue-500"/>
          <span class="text-lg font-bold">{{branch.title}}</span>
        </div>
        <ul v-if="!!branch.children.length" class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
          <li v-for="children in branch.children" class="py-2">
            <Link :href="route('branches.show', children.id)">
              <div class="flex items-center justify-between space-x-4">
                <span class="text-md font-medium">{{children.title}}</span>
                <div class="flex space-x-3">
                  <Link :href="route('branches.edit', children.id)">
                    <PencilIcon class="size-4 text-blue-500 cursor-pointer hover:scale-[1.2]" />
                  </Link>
                  <Link :href="route('branches.destroy', children.id)" method="delete" as="button">
                    <TrashIcon class="size-4 text-red-500 cursor-pointer hover:scale-[1.2]" />
                  </Link>
                </div>
              </div>
            </Link>
          </li>
        </ul>
      </li>
    </ul>

    <h3 class="text-xl mb-3">Themes:</h3>

    <ul class="divide-y bg-white mx-auto px-4 border">
      <li v-for="theme in branch.themes" class="py-4">
        <div class="flex items-center space-x-3">
          <DocumentIcon class="size-4 text-red-500"/>
          <Link :href="route('themes.show', theme.id)">
            <span class="text-lg font-bold">{{theme.title}}</span>
          </Link>
          <Link :href="route('themes.edit', theme.id)">
            <PencilIcon class="size-4 text-blue-500 cursor-pointer hover:scale-[1.2]" />
          </Link>
          <Link :href="route('themes.destroy', theme.id)" method="delete" as="button">
            <TrashIcon class="size-4 text-red-500 cursor-pointer hover:scale-[1.2]" />
          </Link>
        </div>
        <div v-if="!!theme.description" class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
          <div class="flex items-center justify-between space-x-4">
            <span class="text-md font-medium">{{theme.description}}</span>
          </div>
        </div>
      </li>
    </ul>

  </MainLayout>
</template>

<style scoped>
</style>