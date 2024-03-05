<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
 // import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
// import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";

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

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div v-if="$page.props.user.id">
        <sidebar />
        <div class="relative md:ml-64 bg-blueGray-100">
            <admin-navbar />
            <header-stats />
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <Banner />
                <div v-if="$page.props.flash.message" class="alert">
                  {{ $page.props.flash.message }}
                </div>
                <!--router-view /-->
                <!-- Page Content -->
                <slot />
                <footer-admin />
            </div>

        </div>
    </div>
  <slot v-else />
</template>
