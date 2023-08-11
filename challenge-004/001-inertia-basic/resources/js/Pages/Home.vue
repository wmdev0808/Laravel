<!-- <script lang="ts">
import Layout from "@/Shared/Layout.vue";

export default {
    // Using a render function...
    // layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,
};
</script> -->

<!-- <script setup lang="ts">
import Layout from "@/Shared/Layout.vue";

defineOptions({
    layout: Layout,
});
</script> -->

<template>
    <Head>
        <title>Home</title>
        <meta
            head-key="description"
            type="description"
            content="Home information"
        />
    </Head>
    <h1 class="text-3xl">Home</h1>
</template>
