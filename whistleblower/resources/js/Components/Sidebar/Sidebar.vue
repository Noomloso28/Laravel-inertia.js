<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
    >
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
            <!-- Toggler -->
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button"
                v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
            >
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
            {{$t('Whistleblower Software')}}
          </NavLink>
            <!-- User -->
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <notification-dropdown/>
                </li>
                <li class="inline-block relative">
                    <user-dropdown/>
                </li>
            </ul>
            <!-- Collapse -->
            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
                v-bind:class="collapseShow"
            >
                <!-- Collapse header -->
                <div
                    class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
                >
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                          <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                            {{$t('Whistleblower Software')}}
                          </NavLink>

                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                type="button"
                                v-on:click="toggleCollapseShow('hidden')"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    <li class="items-center">
                      <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <i class="fas fa-tv mr-2 text-sm opacity-75"></i> {{$t('Dashboard')}}
                      </NavLink>
                    </li>
                    <li class="items-center" v-if="$page.props.user.permissions.includes('view-notifications')">
                      <NavLink :href="route('notification.index')" :active="isActive([route().current('notification.index'), route().current('notification.create'), route().current('notification.show'), route().current('notification.edit') ])">
                        <i class="fas fa-bell opacity-75 mr-2 text-sm"></i> {{$t('Notifications')}}
                      </NavLink>
                    </li>
                    <li class="items-center" v-if="$page.props.user.permissions.includes('view-companies')">
                      <NavLink :href="route('companies.index')" :active="isActive([route().current('companies.index'), route().current('companies.create'), route().current('companies.show'), route().current('companies.edit') ])">
                        <i class="fas fa-buildings fa-building-columns opacity-75 mr-2 text-sm"></i> {{$t('Companies')}}
                      </NavLink>
                    </li>
                  <li class="items-center" v-if="$page.props.user.permissions.includes('view-user-company')">
                    <NavLink :href="route('companies-user.index')" :active="isActive([route().current('companies-user.index'), route().current('companies-user.create')])">
                      <i class="fas fa-building opacity-75 mr-2 text-sm"></i> {{$t('My Companies')}}
                    </NavLink>
                  </li>
                  <li class="items-center" v-if="$page.props.user.permissions.includes('view-occurrences')">
                    <NavLink :href="route('occurrences.index')" :active="isActive([route().current('occurrences.index'), route().current('occurrences.create'), route().current('occurrences.show'), route().current('occurrences.edit')])">
                      <i class="fas fa-calendar opacity-75 mr-2 text-sm"></i> {{$t('Occurrences')}}
                    </NavLink>
                  </li>

                  <li class="items-center" v-if="$page.props.user.permissions.includes('view-departments')">
                    <NavLink :href="route('departments.index')" :active="isActive([route().current('departments.index'), route().current('departments.create'), route().current('departments.show'), route().current('departments.edit')])">
                      <i class="fas fa-code-branch opacity-75 mr-2 text-sm"></i> {{$t('Departments')}}
                    </NavLink>
                  </li>
                  <li class="items-center">
                    <NavLink :href="route('integration.index')" :active="route().current('integration.index')">
                      <i class="fas fa-arrows-up-to-line opacity-75 mr-2 text-sm"></i> {{$t('Integration')}}
                    </NavLink>
                  </li>

                  <li class="items-center">
                    <NavLink :href="route('user.settings.index')" :active="route().current('user.settings.index')" :dropdown="true"  @showMenu="showMenu">
                      <i class="fas fa-tools opacity-75 mr-2 text-sm"></i> {{$t('Settings')}}
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" :class="{'rotate-90' : dropdownShow}" class="dropdown-menu float-right" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                      </svg>
                    </NavLink>

                    <ul class="ml-4 py-2 space-y-2" :class="classOpen">
                      <li class="items-center" v-if="$page.props.user.permissions.includes('view-categories')">
                        <NavLink :href="route('categories.index')" :active="isActive([route().current('categories.index'), route().current('categories.create'), route().current('categories.show'), route().current('categories.edit')])">
                          <i class="fas fa-folder-open opacity-75 mr-2 text-sm"></i> {{$t('Categories')}}
                        </NavLink>
                      </li>
                      <li class="items-center" v-if="$page.props.user.permissions.includes('view-users-in-company')">
                        <NavLink :href="route('companies-user.lists')" :active="isActive([route().current('companies-user.lists'), route().current('companies-user.add'), route().current('companies-user.show'), route().current('companies-user.edit')])">
                          <i class="fas fa-building-user opacity-75 mr-2 text-sm"></i> {{$t('Users Companies')}}
                        </NavLink>
                      </li>
                      <li class="items-center" v-if="$page.props.user.permissions.includes('view-users')">
                        <NavLink :href="route('users.index')" :active="isActive([route().current('users.index'), route().current('users.create'), route().current('users.show'), route().current('users.edit')])">
                          <i class="fas fa-user opacity-75 mr-2 text-sm"></i> {{$t('Users')}}
                        </NavLink>
                      </li>
                      <li class="items-center" v-if="$page.props.user.permissions.includes('view-roles')">
                        <NavLink :href="route('roles.index')" :active="isActive([route().current('roles.index'), route().current('roles.create'), route().current('roles.show'), route().current('roles.edit')])">
                          <i class="fas fa-shield opacity-75 mr-2 text-sm"></i> {{$t('Roles managements')}}
                        </NavLink>
                      </li>
                      <li class="items-center" v-if="$page.props.user.permissions.includes('view-email')">
                        <NavLink :href="route('email.index')" :active="isActive( [route().current('email.index'), route().current('email.create'), route().current('email.show'), route().current('email.edit')] )">
                          <i class="fas fa-envelope opacity-75 mr-2 text-sm"></i> {{$t('E-mail')}}
                        </NavLink>
                      </li>
                      <li class="items-center">
                        <NavLink :href="route('profile.show')" :active="route().current('profile.show')">
                          <i class="fas fa-id-card opacity-75 mr-2 text-sm"></i> {{$t('Profile')}}
                        </NavLink>
                      </li>
                      <li class="items-center">
                        <NavLink :href="route('dashboard.companies')" :active="route().current('dashboard.companies')">
                          <i class="fas fa-recycle opacity-75 mr-2 text-sm"></i> {{$t('Switch Company')}}
                        </NavLink>
                      </li>
                    </ul>

                  </li>

                </ul>
              <LanguageSwitcher :component="$page.component" :props="$page.props" />

            </div>
        </div>
    </nav>

</template>
<script setup>
import NotificationDropdown from "@/Components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import {computed, onMounted, ref} from "vue";
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';


// const height = ref('hidden');
const collapseShow = ref("hidden");
const classOpen = ref('hidden');
const dropdownShow = ref(false);

onMounted(() => {
  const savedSubMenuState = localStorage.getItem('dropdownShow');
  if (savedSubMenuState) {
    dropdownShow.value  = (savedSubMenuState == 'true') ? true : false;
  }

  const savedclassOpenSubMenu = localStorage.getItem('classOpen');
  if (savedclassOpenSubMenu) {
    classOpen.value  = savedclassOpenSubMenu;
  }

});

const toggleCollapseShow = (classes) => {
   return collapseShow.value = classes;
}

const isActive = (urls) => {
  return urls.some((value) => value === true );
};


const showMenu = ($action) => {
  classOpen.value = ($action) ? 'relation' : 'hidden';
  dropdownShow.value = $action;

  localStorage.setItem('classOpen', classOpen.value);
  localStorage.setItem('dropdownShow', $action);

};

</script>
<style scoped>
  .dropdown-menu {
    transition: 300ms;
  }
  svg.rotate-90 {
    transform: rotate(90deg);
  }
</style>


