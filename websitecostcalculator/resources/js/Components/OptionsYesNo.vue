<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    name: {
        type: String,
        default: null
    },
    checked: {
        type: String,
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>

    <label class="inline-flex items-center">
        <input v-model="proxyChecked" type="radio" class="form-radio text-indigo-600" :name="props.name" value="Yes">
        <span class="ml-2">Yes</span>
    </label>
    <label class="inline-flex items-center ml-6">
        <input v-model="proxyChecked" type="radio" class="form-radio" :name="props.name" value="No">
        <span class="ml-2">No</span>
    </label>

</template>
