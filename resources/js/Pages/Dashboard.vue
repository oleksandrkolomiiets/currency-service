<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <currencies-table
                    :currencies="currencies"
                    @fetch="fetch"
                    @clear="clear"
                />

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import VTable from '@/Components/VTable'
    import VTableFilter from '@/Components/VTableFilter'
    import CurrenciesTable from "@/Components/CurrenciesTable";

    export default {
        components: {
            CurrenciesTable,
            AppLayout,
            VTable,
            VTableFilter,
        },

        props: ['currencies'],

        methods: {
            fetch(params) {
                this.$inertia.visit(route('dashboard', {...params}));
            },

            clear() {
                this.$inertia.visit(route('dashboard'));
            },
        },
    }
</script>
