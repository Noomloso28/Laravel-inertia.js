<template>
  <div v-if="dropdownStatus($page.props.user.permissions)">
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
        <Link v-if="displayAction($page.props.user.permissions, 'view-users-in-company', 'view')"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            :href="route('companies.show', prop.company_id)"
        >
          {{$t('View')}}
        </Link>

        <Link v-if="displayAction($page.props.user.permissions, 'update-users-in-company', 'edit')"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            :href="route('companies.edit', prop.company_id)"
        >
          {{$t('Edit')}}
        </Link>

        <form v-if="displayAction($page.props.user.permissions, 'delete-users-in-company', 'delete')">
            <a
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                href="#"
                @click="$emit('freshCompany', {'id': prop.id, 'company_id': prop.company_id, 'confirm': destroy(id)});"
            >
              {{$t('Delete')}}
            </a>
        </form>


    </div>
  </div>
</template>

<script setup>
import {useForm } from '@inertiajs/vue3';
import {computed, ref} from "vue";
const prop = defineProps({
    id: Number,
    company_id: Number,
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
const dropdownStatus = ($permission) => {

  if(displayAction($permission, 'view-users-in-company', 'view')){
    return true;
  }

  if(displayAction($permission, 'update-users-in-company' , 'edit')){
    return true;
  }

  if(displayAction($permission, 'delete-users-in-company' , 'delete')){
    return true;
  }

  return false;
}

const form = useForm({
    'id': prop.id
});

function destroy(id) {
    if (id && confirm("Are you sure you want to Delete")) {
        form.delete(route(prop.group+'.destroy', id));
      return true;
    }
    return false;
}
</script>


<script>
import { createPopper } from "@popperjs/core";
import { Link } from '@inertiajs/vue3';

export default {
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
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
};
</script>
