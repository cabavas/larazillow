<template>
    <Link :href="route('listing.index')">Listings</Link>&nbsp;
    <Link :href="route('listing.create')">New Listing</Link>
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot></slot>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3"
import { computed } from 'vue'

const page = usePage()
const flashSuccess = computed(
    () => page.props.flash?.success

)
</script>


<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
