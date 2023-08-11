<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <nav>
        <ul class="flex list-disc list-inside">
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
            <li>
                <NavLink href="/logout" method="post" as="button"
                    >Log Out</NavLink
                >
            </li>
        </ul>
    </nav>
</template>
