<script setup lang="ts">
import { computed } from "vue";
import Nav from "./Nav.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const username = computed(() => page.props.auth.user.name);
</script>

<template>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
            </div>

            <p class="text-sm ml-4">Welcome Back, {{ username }}</p>
            <Nav />
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <iframe
                class="mb-6"
                width="100%"
                frameborder="no"
                scrolling="no"
                seamless
                src="https://player.simplecast.com/fd0bd2ba-c553-466c-a060-b144797ce369?dark=false"
            />
            <slot />
        </div>
    </section>
</template>
