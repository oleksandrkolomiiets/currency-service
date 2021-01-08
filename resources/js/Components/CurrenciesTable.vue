<template>
    <div>
        <h3 class="font-semibold p-2 text-center text-lg text-gray-800 leading-tight">
            Currencies
        </h3>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <v-table-filter
                :params="params"
                :fields="filters"
                @apply="fetch"
            />

            <v-table
                class="m-5 mt-0"
                :titles="titles"
            >
                <template v-slot:body>
                    <tr
                        v-for="field in fields" :key="field.id"
                        class="cursor-pointer hover:bg-blue-100"
                        @click="goToHistory(field.code)"
                    >
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            {{ field.code }}
                        </td>
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            {{ field.name }}
                        </td>
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            {{ field.rate }}
                        </td>
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            {{ field.nominal }}
                        </td>
                        <td class="px-5 py-5 text-sm border-b border-gray-200">
                            {{ field.date }}
                        </td>
                    </tr>
                </template>
                <template v-slot:footer>
                    <span class="text-xs text-gray-900 xs:text-sm">
                        Page {{ currentPage }} of {{ lastPage }}, total entries: {{ total }}
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="px-4 py-2 text-sm text-gray-800 bg-gray-300 rounded-l"
                            :class="getPaginationButtonStyles(previousPageButtonDisabled)"
                            :disabled="previousPageButtonDisabled"
                            @click="previousPage"
                        >
                            Prev
                        </button>
                        <button
                            class="px-4 py-2 text-sm text-gray-800 bg-gray-300 rounded-r"
                            :class="getPaginationButtonStyles(nextPageButtonDisabled)"
                            :disabled="nextPageButtonDisabled"
                            @click="nextPage"
                        >
                            Next
                        </button>
                    </div>
                </template>
            </v-table>

        </div>
    </div>
</template>

<script>
    import VTable from '@/Components/VTable'
    import VTableFilter from '@/Components/VTableFilter'

    export default {
        components: {
            VTable,
            VTableFilter,
        },

        props: ['currencies', 'path', 'withDatesFilter', 'appliedParams'],

        data: () => ({
            titles: [
                'Code',
                'Name',
                'Rate',
                'Nominal',
                'Date',
            ],
            fields: [],
            filters: [],
            params: {
                page: 1,
                per_page: 15,
                date_from: null,
                date_to: null,
            },
            currentPage: 1,
            lastPage: 1,
            perPage: 15,
            total: 0,
        }),

        computed: {
            nextPageButtonDisabled() {
                return this.currentPage === this.lastPage;
            },
            previousPageButtonDisabled() {
                return this.currentPage === 1;
            },
        },

        created() {
            if (this.appliedParams) {
                this.params = this.appliedParams;
            }

            if (this.withDatesFilter) {
                this.filters = [
                    {
                        name: 'date_from',
                        title: 'Date From',
                        type: 'date',
                    },
                    {
                        name: 'date_to',
                        title: 'Date To',
                        type: 'date',
                    },
                ];
            }

            this.setData(this.currencies);
        },

        methods: {
            fetch() {
                this.$emit('fetch', this.params);
            },

            setData(data) {
                this.fields = data.data;
                this.currentPage = data.current_page;
                this.lastPage = data.last_page;
                this.perPage = data.per_page;
                this.total = data.total;
            },

            nextPage() {
                this.params.page = this.currentPage < this.lastPage ? this.currentPage + 1 : this.currentPage;
                this.fetch();
            },

            previousPage() {
                this.params.page = this.currentPage > 1 ? this.currentPage - 1 : this.currentPage;
                this.fetch();
            },

            goToHistory(code) {
                this.$inertia.visit(route('history', {currency: code}));
            },

            getPaginationButtonStyles(status) {
                return status ? 'font-normal cursor-not-allowed' : 'font-semibold hover:bg-gray-400';
            },
        },
    }
</script>
