<script setup lang="ts">
defineProps<{ name: string; frameworks: string[] }>();
</script>

<template>
    <h1>Home</h1>

    <p>In this series, we will use the following frameworks:</p>

    <ul>
        <li v-for="framework of frameworks" v-text="framework"></li>
    </ul>
</template>
