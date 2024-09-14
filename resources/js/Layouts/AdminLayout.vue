<script setup>
import NavLink from '@/Components/NavLink.vue';

</script>

<template>
  <div>
    <div class="bg-white border-b border-gray-300 py-4">
      <div class="w-1/2 mx-auto">
        <NavLink class="mr-4" :href="route('sections.index')" :active="route().current('sections.index')">
          Forum
        </NavLink>
        <NavLink class="mr-4" :href="route('users.personal')" :active="route().current('users.personal')">
          {{$page.props.auth.user.name}}
        </NavLink>
        <NavLink :href="route('admin.index')" :active=true>
          Admin panel
        </NavLink>
      </div>
    </div>
    <div class="w-1/2 mx-auto flex mt-4">
      <div class="w-1/4 p-4 mr-4 shadow-md bg-white rounded-md flex flex-col">
        <h3 class="text-xl mb-3">Menu</h3>
        <NavLink class="mr-4" :href="route('admin.index')" :active="route().current('admin.index')">
          Statistics
        </NavLink>
        <NavLink class="mr-4" :href="route('admin.complaints')" :active="route().current('admin.complaints')">
          Complaints
        </NavLink>
      </div>
      <div class="w-3/4 p-4 shadow-md bg-white rounded-md">
        <slot/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>