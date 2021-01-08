<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>
                </svg>
                History - {{ currency }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <currencies-table
                    :currencies="currencies"
                    :with-dates-filter="true"
                    :applied-params="params"
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

        props: ['currency', 'currencies', 'params'],

        methods: {
            fetch(params) {
                this.$inertia.visit(route('history', {
                    currency: this.currency,
                    ...params
                }));
            },

            clear() {
                this.$inertia.visit(route('history', {
                    currency: this.currency,
                }));
            }
        },
    }
</script>
