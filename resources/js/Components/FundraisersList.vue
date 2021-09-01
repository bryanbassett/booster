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
                            <div v-if="fundraiser.reviews!=null && (fundraiser.reviews).length > 0" class="d-block">
                                <span class="text-yellow-500" v-html="avgReviewStars(fundraiser.averageReviews)"></span>

                                <span class="text-xs ml-2">(based on {{(fundraiser.reviews).length}} review{{(fundraiser.reviews).length >1 ? 's' : ''}})</span>
                            </div>
                            <div v-if="fundraiser.reviews.length==0 " class="d-block">&#9734; &#9734; &#9734; &#9734; &#9734; <span class="text-xs ml-2">(no reviews yet)</span>
                            </div>
                            <div class="d-block mt-1">
                                <button
                                    class="d-inline-block bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded text-xs">
                                    Read Reviews
                                </button>
                                <button v-if="user!=null && !fundraiser.reviewedAlready" v-on:click="whatGotClicked(fundraiser.fundraiser_title,fundraiser.id)"
                                        class="d-inline-block ml-2 bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded text-xs">
                                    Write Review
                                </button>
                                <button v-if="fundraiser.reviewedAlready" v-on:click="whatGotClicked(fundraiser.fundraiser_title,fundraiser.id)" disabled
                                        class="disabled:opacity-50 d-inline-block ml-2 bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded text-xs">
                                    Already Reviewed
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
        avgReviewStars(avg){
           avg = Math.round(avg);
           let starString = '';
           for(let x=0;x<avg;x++){
               starString+='&#9733; ';
           }
           if(avg<5){
               for(let x=0;x<(5-avg);x++){
                   starString+='&#9734; ';
               }
           }
           return starString;
        },
        showAlert: function(message) {
            // Use sweetalert2
            this.$swal(message);
        },
        getFundraisers: function () {
            let thisser = this;
            axios.get('/api/listFundraisers')
                .then(function (response) {
                    console.log(response.data);
                    thisser.fundraisers = response.data

                })
        },
        whatGotClicked: function (clickedName,clickedID) {
            let thisser = this;
            axios.get('/api/alreadyReviewed?fundraiserId='+clickedID)
                .then(function (response) {
                    if(response.data == 1){
                        thisser.showAlert('You already reviewed this fundraiser!');
                    }else{
                        window.store.commit('selectFundraiserID', clickedID)
                        window.store.commit('selectFundraiser', clickedName)
                    }
                })
        },

    },


}
</script>
