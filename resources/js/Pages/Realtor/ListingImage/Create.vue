<template>
<form @submit.prevent="submit" :action="route('realtor.listing.image.store', {listing: listing.id})">
    <input type="file" multiple name="files">
    <button type="submit">Send</button>
</form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({listing: Object})
const form = useForm(
    {
        files: []
    }
);
const submit = () => {
    form.post(
        route(
            'realtor.listing.image.store', 
            {listing: props.listing.id}
        )
    );
}
</script>