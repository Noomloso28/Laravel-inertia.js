<script setup>
defineProps({
    value: String,
    forAttr: String
});
</script>

<template>
    <label class="block text-sm font-medium font-bold md:text-left mb-3 md:mb-0 pr-4" :for="forAttr ?? ''">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
