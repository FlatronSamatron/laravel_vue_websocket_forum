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
        <NavLink :href="route('admin.index')">
          Admin panel
        </NavLink>
      </div>
    </div>
    <div class="w-1/2 mx-auto py-4">
      <slot/>
    </div>
  </div>
</template>

<style scoped>

</style>