<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

var success = false;

const props = defineProps({
   items:Object
})

</script>


<template>
    <AppLayout title="Statement">
        <div class="w-1/2 mx-auto mt-10 bg-white border border-gray-300" style="width: 35%;">
            <div class="border-b border-gray-300 pb-3 px-4 py-3 text-lg">
                Statement of account
            </div>
            <div>
                <table class="mb-4 table-auto text-center w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DateTime</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item ,index) in items.data" :key="item.id" class="prose border-2 mb-4 prose">
                            <td>{{ index + 1 }}</td>
                            <td class="mx-6 px-6 w-60">{{ item.createdAt }}</td>
                            <td>{{ item.amount }}</td>
                            <td>{{ item.status }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.balance }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
