<template>
    <div class="flex flex-col mx-5 mt-5 sm:flex-row">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div v-if="withPagination" class="relative">
                <select
                    class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border border-gray-400 rounded appearance-none focus:outline-none"
                    v-model="params.per_page"
                >
                    <option>10</option>
                    <option>15</option>
                    <option>30</option>
                    <option>50</option>
                    <option value="99999">All</option>
                </select>
                <div
                    class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
            <div
                class="relative ml-2"
                v-for="(field, key) in fields"
                :key="key"
            >
                <input
                    v-if="field.type === 'date'"
                    class="block w-full h-full px-4 py-2 pr-8 text-sm leading-tight text-gray-700 placeholder-gray-400 bg-white border border-gray-400 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500 focus:placeholder-gray-600"
                    type="text"
                    :placeholder="field.title"
                    v-model="params[field.name]"
                >
                <input
                    v-else-if="field.type === 'text'"
                    class="block w-full h-full px-4 py-2 pr-8 text-sm leading-tight text-gray-700 placeholder-gray-400 bg-white border border-gray-400 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500 focus:placeholder-gray-600"
                    type="text"
                    :placeholder="field.title"
                    v-model="params[field.name]"
                >
            </div>
        </div>
        <button
            class="block h-full px-4 py-2 mt-1 leading-tight text-gray-700 bg-gray-300 border border-gray-400 rounded appearance-none sm:mt-0 hover:bg-gray-400 sm:ml-4"
            :class="applyButtonStyles"
            @click="apply"
        >
            Apply
        </button>
        <button
            class="block h-full px-4 py-2 mt-1 leading-tight text-gray-700 bg-gray-300 border border-gray-400 rounded appearance-none sm:mt-0 hover:bg-gray-400 sm:ml-4"
            @click="clear"
        >
            Clear
        </button>
    </div>
</template>

<script>
    export default {
        name: 'VTableFilter',

        props: {
            params: {
                type: Object,
                required: true,
            },
            fields: {
                type: Array,
                default: () => [],
            },
            withPagination: {
                type: Boolean,
                default: true,
            },
        },

        data: () => ({
            highlightApplyButton: false,
            oldPage: 1,
        }),

        watch: {
            params: {
                handler(value) {
                    if (this.oldPage === value.page) {
                        this.highlightApplyButton = true;
                    }

                    this.oldPage = value.page;
                },
                deep: true,
            }
        },

        computed: {
            applyButtonStyles() {
                return this.highlightApplyButton ? 'shadow-md border-green-400' : '';
            },
        },

        created() {
            this.oldPage = this.params.page;
        },

        methods: {
            apply() {
                this.$emit('apply');
                this.highlightApplyButton = false;
            },

            clear() {
                this.$emit('clear');
            },
        }
    }
</script>
