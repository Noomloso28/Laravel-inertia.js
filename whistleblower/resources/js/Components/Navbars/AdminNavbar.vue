<template>
  <!-- Navbar -->
  <nav
    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
  >
    <div
      class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
    >
      <Link :href="route('dashboard')" :active="route().current('dashboard')" class="text-white text-sm uppercase hidden lg:inline-block font-semibold">
        <span class="text-emerald-600 font-bold">{{$page.props.user.company.name}}</span> {{$t('Dashboard')}}
      </Link>
<!--      <a-->
<!--        class="text-white text-sm uppercase hidden lg:inline-block font-semibold"-->
<!--        href="javascript:void(0)"-->
<!--      >-->
<!--        <span class="text-emerald-600 font-bold">{{$page.props.user.company.name}}</span> {{$t('Dashboard')}}-->
<!--      </a>-->
      <!-- Form -->
<!--      <form-->
<!--        class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"-->
<!--      >-->
<!--        <div class="relative flex w-full flex-wrap items-stretch">-->
<!--          <span-->
<!--            class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"-->
<!--          >-->
<!--            <i class="fas fa-search"></i>-->
<!--          </span>-->
<!--          <input-->
<!--            type="text"-->
<!--            placeholder="Search here..."-->
<!--            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"-->
<!--          />-->
<!--        </div>-->
<!--      </form>-->
      <!-- User -->
      <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
        <user-dropdown />
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</template>

<script>
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import {Link} from "@inertiajs/vue3";

export default {
  components: {
    Link,
    UserDropdown,
  },
};
</script>
