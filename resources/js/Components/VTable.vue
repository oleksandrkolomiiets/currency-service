<template>
    <div>
        <div class="py-4 overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden border rounded-lg shadow">
                <div class="v-table-overflow overflow-auto overflow-y-scroll h-50screen">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="sticky top-0 z-10 px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-200 border-b-2 border-gray-300"
                                v-for="(title, key) in titles"
                                :key="key"
                            >
                                {{ title }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <slot name="body"/>
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col px-5 py-5 bg-white border-t xs:flex-row sm:items-center xs:justify-between">
                    <slot name="footer"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'VTable',

        props: {
            titles: {
                type: Array,
                default: () => [],
            },
        },
    }
</script>
