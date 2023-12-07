<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },

});
</script>

<template>
    <h2 class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl"><slot /></h2>
</template>
