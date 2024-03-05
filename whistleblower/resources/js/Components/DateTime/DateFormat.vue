<template>
  <span v-text="date"></span>
</template>

<script setup>
import {computed} from "vue";
import {unref as o} from "@vue/reactivity";
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  date: {
    type: [String, Date],
    default: new Date()
  },
  hasTime: {
    type: Boolean,
    default: !1
  },
  noSeconds: {
    type: Boolean,
    default: !1
  },
  noDays: {
    type: Boolean,
    default: !1
  },
  noYears: {
    type: Boolean,
    default: !1
  },
  noMonths: {
    type: Boolean,
    default: !1
  },
  shortMonth: {
    type: Boolean,
    default: !1
  },
  classes: {
    type: String,
    default: ""
  },
  locales: ''
});
const t = props, l = computed(() => {
  let e = {};
  return e.year = "numeric", t.noDays || (e.day = "numeric"), t.noYears || (e.year = "numeric"), t.noMonth || (e.month = "numeric"), t.shortMonth ? e.month = "short" : e.month = "long", t.hasTime && (e.hour = "numeric", e.minute = "numeric", t.noSeconds || (e.second = "numeric")), e;
}), s = computed(() => {
  let e = "";
  return t.small && (e += "dateformat-small"), e;
});

const date = computed(()=>{
  return new Date(t.date).toLocaleString(locales(props), o(l));
})

const locales = ($props) => {
  /** first priority from setup **/
  if($props.locales){
    return $props.locales;
  }

  /** check german **/
  if(usePage().props.current_locale === 'de'){
    return 'de-DE';
  }

  /** check english **/
  if(usePage().props.current_locale === 'en'){
    return 'en-GB';
  }

  return navigator.languages;
}

</script>


<style scoped>

</style>
