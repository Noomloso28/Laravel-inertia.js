<script setup>
import {computed, ref, defineEmits, onMounted} from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
    dropdown: Boolean
});
const emit = defineEmits({
  'showMenu': ref(false)
});

const classes = computed(() => {
    return props.active
        ? 'text-xs uppercase py-3 font-bold block text-emerald-500 hover:text-emerald-600'
        : 'text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block';
});

const showMenu = ref(false);
const toggleShow = ($event) => {
  showMenu.value = !showMenu.value
  emit('showMenu', showMenu.value);
}

onMounted(() => {
  const savedSubMenuState = localStorage.getItem('dropdownShow');
  if (savedSubMenuState) {
    showMenu.value = (savedSubMenuState == 'true') ? true : false;
  }
});

</script>

<template>
    <Link :href="href" :class="classes" v-if="props.dropdown" @:click.prevent="toggleShow($event);">
      <slot />
    </Link>
    <Link :href="href" :class="classes" v-else>
        <slot />
    </Link>
</template>
