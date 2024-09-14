<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import { PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'

defineProps({
  sections: Array
})

</script>

<template>
  <MainLayout>
    <div>
      <div class="flex items-center">
        <Link :href="route('sections.create')"
              class="block mr-4 bg-white border border-gray-300 rounded-lg text-center w-1/6 p-1 hover:border-gray-400 transition-all font-extrabold text-gray-500">
          + Section
        </Link>
        <Link :href="route('branches.create')"
              class="block bg-white border border-gray-300 rounded-lg text-center w-1/6 p-1 hover:border-gray-400 transition-all font-extrabold text-gray-500">
          + Branch
        </Link>
      </div>
      <div>
        <h3 class="my-3 text-xl">Sections:</h3>

        <ul class="divide-y bg-white mx-auto px-4 border">
          <li v-for="section in sections" class="py-4">
              <div class="flex items-center space-x-3">
                <span class="text-lg font-bold">{{section.title}}</span>
                <Link :href="route('sections.edit', section.id)">
                  <PencilIcon class="size-4 text-blue-500 cursor-pointer hover:scale-[1.2]" />
                </Link>
                <Link :href="route('sections.destroy', section.id)" method="delete" as="button">
                  <TrashIcon class="size-4 text-red-500 cursor-pointer hover:scale-[1.2]" />
                </Link>
              </div>
            <ul v-if="!!section.branches.length" class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
              <li v-for="branch in section.branches" class="py-2">
                <Link :href="route('branches.show', branch.id)">
                  <div class="flex items-center justify-between space-x-4">
                    <span class="text-md font-medium">{{branch.title}}</span>
                    <div class="flex space-x-3">
                      <Link :href="route('branches.edit', branch.id)">
                        <PencilIcon class="size-4 text-blue-500 cursor-pointer hover:scale-[1.2]" />
                      </Link>
                      <Link :href="route('branches.destroy', branch.id)" method="delete" as="button">
                        <TrashIcon class="size-4 text-red-500 cursor-pointer hover:scale-[1.2]" />
                      </Link>
                    </div>
                  </div>
                </Link>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </MainLayout>
</template>

<style scoped>

</style>