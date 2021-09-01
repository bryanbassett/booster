<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gray-400 border-b border-gray-200">
                    <span v-html="myStuff"></span>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    data: function(){
        return{
            myStuff:''
        }
    },
    mounted: function () {
        let thisser = this;
        axios.get('/api/getMyStuff')
            .then(function (response) {
                thisser.myStuff = response.data
            })
    },

}
</script>
