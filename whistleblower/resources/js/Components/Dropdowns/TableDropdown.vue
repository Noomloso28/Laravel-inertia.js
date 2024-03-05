<template>
  <div v-if="dropdownStatus($page.props.user.permissions, permissionGroup)">
    <a
      class="text-blueGray-500 py-1 px-3"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <i class="fas fa-ellipsis-v"></i>
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
        <Link v-if="displayAction($page.props.user.permissions, 'view-'+ permissionGroup, 'view')"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            :href="route(prop.group+'.show', id)"
        >
            {{$t('View')}}
        </Link>

        <Link v-if="displayAction($page.props.user.permissions, 'update-'+ permissionGroup, 'edit')"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            :href="route(prop.group+'.edit', id)"
        >
          {{$t('Edit')}}
        </Link>

        <form v-if="displayAction($page.props.user.permissions, 'delete-'+ permissionGroup, 'delete')">
            <a
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                href="#"
                @click="destroy(id)"
            >
              {{$t('Delete')}}
            </a>
        </form>


    </div>
  </div>
</template>

<script setup>
import {useForm, Link } from '@inertiajs/vue3';
import {computed, ref} from "vue";
import {createPopper} from "@popperjs/core";

const prop = defineProps({
    id: Number,
    group: String,
    permissionGroup: String,
    view: {
      type: Boolean,
      default: 1
    },
    edit: {
      type: Boolean,
      default: 1
    },
    delete: {
      type: Boolean,
      default: 1
    },
});
/**
 * In case need set Permission name not use automatic.
 * @returns {String | StringConstructor}
 */
const permissionGroup = computed(() => {
  return prop.permissionGroup ?? prop.group;
});

/**
 * display by permissions roles.
 * @param $permission
 * @param $action
 * @returns {boolean}
 */
const displayAction = ($permission, $action, name = 'view') =>{
    /** check properties status */
    if (name === 'view' && !prop.view ){
      return false;
    }
    if (name === 'edit' && !prop.edit ){
      return false;
    }
    if (name === 'delete' && !prop.delete ){
      return false;
    }

    if(!Array.isArray($permission)){
      return false;
    }

    if ($permission.includes($action)){
      return true;
    }

    return false;
}
/**
 * check display action buttons status.
 * @param $permission
 * @returns {boolean}
 */
const dropdownStatus = ($permission, permissionGroups) => {

  if(displayAction($permission, 'view-'+ permissionGroups, 'view')){
    return true;
  }

  if(displayAction($permission, 'update-'+ permissionGroups, 'edit')){
    return true;
  }

  if(displayAction($permission, 'delete-'+ permissionGroups, 'delete')){
    return true;
  }

  return false;
}

const form = useForm({
    'id': prop.id
});
const dropdownPopoverShow = ref(false);
const btnDropdownRef = ref(null);
const popoverDropdownRef = ref(null);

const toggleDropdown = (event) => {
  event.preventDefault();
  if (dropdownPopoverShow.value) {
    dropdownPopoverShow.value = false;
  } else {
    dropdownPopoverShow.value = true;
    createPopper(btnDropdownRef.value, popoverDropdownRef.value, {
      placement: "bottom-start",
    });
  }
}

function destroy(id) {
    if (id && confirm("Are you sure you want to Delete")) {
        form.delete(route(prop.group+'.destroy', id));
        dropdownPopoverShow.value = !dropdownPopoverShow;
    }
}
</script>
