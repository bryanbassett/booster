<template>
    <Head title="Welcome"/>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mt-10 mb-10 sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <div class="grid grid-cols-10">
                    <div class="col-span-7">
                        <ApplicationLogo/>
                    </div>
                </div>

            </div>
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1">
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div v-if="$page.props.auth.user" class="relative">
                            <button v-on:click="createFundraiser()" title="Add New Fundraiser" class=" absolute -top-5 -right-5 special p-4 rounded-full transition ease-in duration-200 focus:outline-none">
                                <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6">
                                    <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                     C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                     C15.952,9,16,9.447,16,10z" />
                                </svg>
                            </button>
                        </div>

                        <ReviewModal/>
                        <FundraisersList/>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>


<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import ApplicationLogo from "../Components/ApplicationLogo";
import FundraisersList from "@/Components/FundraisersList";
import ReviewModal from "../Components/ReviewModal";

export default {
    components: {
        ReviewModal,
        FundraisersList,
        ApplicationLogo,
        Head,
        Link,
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        size: String
    },
    methods:{
        createFundraiser(){
            let thisser = this;
            this.$swal({title:'Create New Fundraiser',
                html:"<form id='createFundraiser'><label for='fundraiserTitle'>Fundraiser Title</label><input class='block w-full' type='text' name='fundraiserTitle'><label for='fundraiserDescription'>Description</label><textarea class='block w-full' name='fundraiserDescription'></textarea>" +
                    "</form>",
                confirmButtonText: 'Add Fundraiser',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let createFundraiserForm =  new FormData(document.forms.createFundraiser);
                    let title = createFundraiserForm.get('fundraiserTitle');
                    let description = createFundraiserForm.get('fundraiserDescription');
                    if(title == '' || description ==''){
                        thisser.$swal('You have to fill out both the title and the description');
                    }else{
                        let payload = {
                            fundraiserTitle:title,
                            fundraiserDescription:description,
                        }

                        axios.post('/api/createFundraiser',payload)
                            .then(function (response) {
                                thisser.$swal(response.data);
                                window.store.commit('pageNeedsRefreshed',true);
                            })
                    }
                } else if ( result.dismiss === thisser.$swal.DismissReason.cancel
                ) {
                    thisser.$swal('Cancelled creating a new fundraiser.');
                }
            })
        }
    }


}
</script>
