<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Logout from '@/Components/Logout.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};


</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 bg-white border-b border-gray-300 pb-3" style="padding-left: 340px;">
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    ABC BANK
                </div>
            </div>

            <nav class="max-w-7xl mx-auto bg-white border-b border-gray-300">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="w-1/2 mx-auto flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Home
                                </NavLink>
                                 <NavLink :href="route('deposit.index')" :active="route().current('deposit.index')">
                                    Deposit
                                </NavLink>
                                <NavLink :href="route('withdraw.index')" :active="route().current('withdraw.index')">
                                    Withdraw
                                </NavLink>
                                <NavLink :href="route('transfer.index')" :active="route().current('transfer.index')">
                                    Transfer
                                </NavLink>
                                <NavLink :href="route('statement.index')" :active="route().current('statement.index')">
                                    Statement
                                </NavLink>
                                <Logout>
                                    Logout
                                </Logout>
                               <!-- <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Withdraw
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Transfer
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Statement
                                </NavLink>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Logout
                                </NavLink> -->

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Settings Options -->
                </div>
            </nav>
            <!-- Page Content -->
            <main>
                <slot />
            </main>
    </div>
</div>
</template>
