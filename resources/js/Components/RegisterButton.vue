<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    value:Boolean
});


const style = {
    margin: "0 auto",
    paddingLeft: "175px",
    paddingRight: "175px",
};

</script>

<style scoped>

.style-in{
    margin: 0 auto;
    padding-left: 175px;
    padding-right: 155px;
    background-color: #337CCF;
}

</style>

<template>
    <button :type="type" style="{{ {style} }}" class="style-in inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
