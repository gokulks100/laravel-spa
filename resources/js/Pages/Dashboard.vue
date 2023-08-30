<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    user: Object,
});

</script>


<template>
    <AppLayout title="Home">
        <template #header>
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2> -->
        </template>

        <div class="mx-auto mt-10 bg-white border border-gray-300" style="width: 35%;">
            <div class="mx-auto">
                <div class="border-b border-gray-300 pb-3 px-4 py-3 text-lg">
                        Welcome  {{ props.user.name }}
                </div>
                <div class="border-b border-gray-300 pb-3 px-4 py-3 font-medium">
                    Your Id  <span class="ml-12">{{ props.user.email }}</span>
                </div>
                <div class="border-b border-gray-300 pb-3 px-4 py-3 font-medium">
                    Balance  <span class="ml-12">{{ props.user.banks.amount }}</span>
                </div>
            </div>
        </div>



    </AppLayout>
</template>
