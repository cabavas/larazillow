<template>
    <div v-for="listing in listings" :key='listing.id'>
        <Link>
            <Link :href="route('listing.show', listing.id)">
                <ListingAddress :listing="listing"/>
            </Link>
        </Link>
        <div>
            <Link :href="route('listing.edit', listing.id)">Edit</Link>
        </div>
        <div>
            <Link method="DELETE" :href="route('listing.destroy', listing.id)" as="button">Delete</Link>
        </div>

    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import ListingAddress from "../../Components/ListingAddress.vue";

defineProps({
    listings: Array,
})
</script>
