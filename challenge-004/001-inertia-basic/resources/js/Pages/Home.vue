<!-- <script lang="ts">
import Layout from "@/Shared/Layout.vue";

export default {
    // Using a render function...
    // layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,
};
</script> -->

<script setup lang="ts">
import Layout from "@/Shared/Layout.vue";

defineOptions({
    layout: Layout,
});
</script>

<template>
    <h1 class="text-3xl">Home</h1>
</template>
