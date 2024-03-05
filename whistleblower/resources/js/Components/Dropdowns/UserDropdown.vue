<template>
  <div>
    <a
      class="text-blueGray-500 block"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
        >
          <img
            alt="profile"
            class="w-full h-full rounded-full align-middle border-none shadow-lg"
            :src="profile($page)"
          />
        </span>
      </div>
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <Link
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
        :href="route('profile.show')"
      >
        {{$t('Profile')}}
      </Link>
      <div class="h-0 my-2 border border-solid border-blueGray-100" />
      <Link href="/logout" method="post" as="button" type="button" class="text-sm text-left py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
        {{$t('Logout')}}
      </Link>
    </div>
  </div>
</template>


<script>
import { createPopper } from "@popperjs/core";
import image from "@/assets/img/team-1-800x800.jpg";
import {Link} from "@inertiajs/vue3";

export default {
  data() {
    return {
      dropdownPopoverShow: false,
      image: image,
    };
  },
  methods: {
    profile: function ($page){
      return $page.props.user.profile_photo_url ?? image;
    },
    toggleDropdown: function (event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
  components: {
    Link
  }
};
</script>
