<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-8">
        <RealtorFilters :filters="filters" />
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id">
            <div class="flex flex-colmd:flex-rowgap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price=listing.price class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:test-grey-300">
                    <a class="btn-outline text-xs font-medium" :href="route('listing.show', { listing: listing.id })"
                        target="_blank">Preview</a>
                    <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit', {listing: listing.id})">Edit</Link>
                    <Link class="btn-outline text-xs font-medium"
                        :href="route('realtor.listing.destroy', { listing: listing.id })" as="button" method="delete">
                    Delete
                    </Link>
                </div>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import Box from '../../Components/UI/Box.vue';
import Price from '../../Components/Price.vue';
import ListingSpace from '../../Components/ListingSpace.vue';
import ListingAddress from '../../Components/ListingAddress.vue';
import { Link } from '@inertiajs/vue3';
import RealtorFilters from './Index/Components/RealtorFilters.vue';
import Pagination from '../../Components/UI/Pagination.vue';

defineProps({
    listings: Object,
    filters: Object,
})
</script>