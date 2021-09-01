<template>
    <div id="fundraisersListContainer" class="grid grid-cols-12">
        <div class="col-span-12">

            <ul v-if="fundraisers!=null" id="fundraisersList">
                <li v-for="fundraiser in fundraisers" :key="fundraiser.id" class="text-white">
                    <div class="grid grid-cols-12 mb-3">
                        <div class="col-span-1">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="col-span-11">
                            <div class="font-bold d-block capitalize ">{{ fundraiser.fundraiser_title }}</div>
                            <div class="d-block font-light text-sm">{{ fundraiser.fundraiser_description }}</div>
                            <div class="d-block">&#9733; &#9733; &#9733; &#9733; &#9734; <span class="text-xs ml-2">(based off of 9 reviews)</span>
                            </div>
                            <div class="d-block">
                                <button
                                    class="d-inline-block bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded text-xs">
                                    Read Reviews
                                </button>
                                <button v-if="user!=null" v-on:click="whatGotClicked(fundraiser.fundraiser_title)"
                                        class="d-inline-block ml-2 bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded text-xs">
                                    Write Review
                                </button>
                                <button v-if="user==null" title="Login to write reviews!" disabled
                                        class="disabled:opacity-50 d-inline-block ml-2 bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded text-xs">
                                    Write Review
                                </button>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</template>
<script>
import {usePage} from '@inertiajs/inertia-vue3'

export default {

    data: function () {
        return {
            fundraisers: [],

        }
    },
    mounted: function () {
        let thisser = this;
        thisser.getFundraisers();

    },
    computed: {
        user() {
            return usePage().props.value.auth.user;
        }
    },
    methods: {
        getFundraisers: function () {
            let thisser = this;
            axios.get('/api/listFundraisers')
                .then(function (response) {
                    thisser.fundraisers = response.data

                })
        },
        whatGotClicked: function (clicked) {
            window.store.commit('selectFundraiser', clicked)
        },

    },


}
</script>
