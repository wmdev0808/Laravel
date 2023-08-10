<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <nav class="mt-6">
        <ul class="list-disc">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'"
                    >Home</NavLink
                >
            </li>
            <li>
                <NavLink href="/users" :active="$page.component === 'Users'"
                    >Users</NavLink
                >
            </li>
            <li>
                <NavLink
                    href="/settings"
                    :active="$page.component === 'Settings'"
                    >Settings</NavLink
                >
            </li>
            <!-- <li>
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="text-blue-500 hover:underline"
                    >Log Out</Link
                >
            </li> -->
        </ul>
    </nav>
</template>
