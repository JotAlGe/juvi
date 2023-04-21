<script setup>
// import Layout from './Layout'
// import { Head } from '@inertiajs/vue3'

defineProps({ users: Object })
</script>

<template>
  <h1 class="text-green-500">Listado de usuarios</h1>
  <p v-for="user in users" :key="user.id">{{ user.name }} - {{ user.email }}</p>
</template>