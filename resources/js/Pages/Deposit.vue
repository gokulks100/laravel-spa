<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import CommonButton from '@/Components/CommonButton.vue';
import TextInput from '@/Components/TextInput.vue';

// var success = false;


const props = defineProps({
    sucess: String,
    title: String,
    route:String,
    input:Boolean,
    btn:String,
    success:String,
    error:String
})

const form = useForm({
    amount: '',
    email:''
});

const submit = (event) => {
    event.preventDefault();
    form.post(route(props.route), {
        preserveScroll: true,
        onSuccess: () => finish(),
    });
};

const finish = (event) => {
    form.reset('amount')
    // success =true;
    // setTimeout(()=>{
    //     success = false;
    // },2000)
};

</script>


<template>
    <AppLayout :title="props.title">
        <template #header>
            <!-- <ActionMessage :on="form.recentlySuccessful" v-if="success" class="mr-3">
                Saved.
            </ActionMessage> -->
        </template>
        <div v-if = "$page.props.flash.success" class="mt-3 text-center">
            {{ $page.props.flash.success }}
        </div>

        <div v-if = "$page.props.flash.error" class="mt-3 tex-red-500 text-center">
            {{ $page.props.flash.error }}
        </div>


        <div class="mx-auto mt-10 bg-white border border-gray-300" style="width: 35%;">
            <div class="border-b border-gray-300 pb-3 px-4 py-3 text-lg">
                          {{ props.title }}
            </div>
            <form @submit.prevent="submit">
            <div class="mt-4 mx-auto px-4" v-if="props.input">
                <InputLabel for="email" value="Email Address" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="mt-4 mx-auto px-4">
                <InputLabel for="amount" value="Amount" />
                <TextInput
                    id="amount"
                    v-model="form.amount"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="flex items-center md:grid mx-auto my-4 pr-4">
                <CommonButton class="ml-4 mb-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ btn }}
                </CommonButton>
            </div>

        </form>
        </div>
        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>
        </template>

    </AppLayout>
</template>
