<template>
    <TransitionRoot appear :show="isReviewModalOpen" as="template">
        <Dialog as="div" @close="closeModal">
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="min-h-screen px-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <DialogOverlay class="fixed inset-0"/>
                    </TransitionChild>

                    <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
          </span>

                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <div
                            class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900 capitalize"
                            >
                                Add Review For {{ selectedFundraiser }}
                            </DialogTitle>
                            <div class="mt-2">
                                <DialogDescription>
                                    <form id="reviewForm">
                                        <fieldset class="rating block w-full text-left">
                                            <input v-on:click="selectStars(5)" type="radio" id="star5" name="rating"
                                                   value="5"/><label class="full" for="star5" title="5 Stars"></label>
                                            <input v-on:click="selectStars(4.5)" type="radio" id="star4half"
                                                   name="rating" value="4.5"/><label class="half"
                                                                                              for="star4half"
                                                                                              title="4.5 Stars"></label>
                                            <input v-on:click="selectStars(4)" type="radio" id="star4" name="rating"
                                                   value="4"/><label class="full" for="star4" title=" Stars"></label>
                                            <input v-on:click="selectStars(3.5)" type="radio" id="star3half"
                                                   name="rating" value="3.5"/><label class="half"
                                                                                              for="star3half"
                                                                                              title="3.5 Stars"></label>
                                            <input v-on:click="selectStars(3)" type="radio" id="star3" name="rating"
                                                   value="3"/><label class="full" for="star3" title="3 Stars"></label>
                                            <input v-on:click="selectStars(2.5)" type="radio" id="star2half"
                                                   name="rating" value="2.5"/><label class="half"
                                                                                              for="star2half"
                                                                                              title="2.5 Stars"></label>
                                            <input v-on:click="selectStars(2)" type="radio" id="star2" name="rating"
                                                   value="2"/><label class="full" for="star2" title="2 Stars"></label>
                                            <input v-on:click="selectStars(1.5)" type="radio" id="star1half"
                                                   name="rating" value="1.5"/><label class="half"
                                                                                              for="star1half"
                                                                                              title="1.5 Stars"></label>
                                            <input v-on:click="selectStars(1)" type="radio" id="star1" name="rating"
                                                   value="1"/><label class="full" for="star1" title="1 star"></label>
                                            <input v-on:click="selectStars(0.5)" type="radio" id="starhalf"
                                                   name="rating" value="0.5"/><label class="half" for="starhalf"
                                                                                      title="0.5 Stars"></label>
                                        </fieldset>

                                        <label for="reviewText">Share your thoughts (please be respectful)</label>
                                        <textarea v-model="boundReviewText" name="reviewText" id="reviewText" rows="3"
                                                  class="border-0 border-b-2 border-blue-400 font-medium bg-transparent block w-full"></textarea>
                                    </form>
                                </DialogDescription>

                            </div>

                            <div class="mt-4">
                                <button
                                    v-if="user==null || user.email_verified_at==null"
                                    type="button"
                                    disabled
                                    class="disabled:opacity-50 inline-flex  justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                    @click="closeModal(true)"
                                >
                                    Verify Email To Save Review
                                </button>
                                <button
                                    v-if="user!=null && user.email_verified_at!=null"
                                    type="button"
                                    class="inline-flex  justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                    @click="closeModal(true)"
                                >
                                    Save Review
                                </button>
                                <button
                                    type="button"
                                    class="inline-flex  justify-center ml-2 px-4 py-2 text-sm font-medium text-blue-900 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500"
                                    @click="closeModal(false)"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {ref} from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogDescription,
    DialogTitle,
} from '@headlessui/vue'
import {usePage} from "@inertiajs/inertia-vue3";

export default {
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogOverlay,
        DialogDescription,
        DialogTitle,
    },
    data: function () {
        return {
            boundReviewText: '',
        }
    },
    computed: {
        selectedFundraiser() {
            return window.store.state.selectedFundraiser;
        },
        selectedFundraiserID() {
            return window.store.state.selectedFundraiserID;
        },
        selectedStars() {
            return window.store.state.selectedStars;
        },
        reviewText() {
            return window.store.state.reviewText;
        },
        isReviewModalOpen() {
            return window.store.state.isReviewModalOpen;
        },
        needsRefreshed() {
            return window.store.state.needsRefreshed;
        },
        user() {
            return usePage().props.value.auth.user;
        }

    },
    watch: {
        selectedFundraiser: function () {
            window.store.commit('reviewModal')
        },
        boundReviewText: function (newReviewText) {
            window.store.commit('reviewText', newReviewText)
        }
    },
    methods: {
        selectStars(amount) {
            window.store.commit('selectStars', amount)
        },
        openModal() {
            window.store.commit('selectStars', 0)
            window.store.commit('reviewText', '')
            window.store.commit('reviewModal')
        },
        closeModal(save) {
            if (save) {
                let thisser = this;
                let reviewForm =  new FormData(document.forms.reviewForm);
                let ogModal = this.$swal({
                    title: 'Saving review...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        thisser.$swal.showLoading();

                        let payload = {
                            fundraiserId:thisser.selectedFundraiserID,
                            rating:reviewForm.get('rating'),
                            reviewText:reviewForm.get('reviewText')

                        }
                        //if i were to go further i would limit size of review text
                        axios.post('/api/createReview',payload)
                            .then(function (response) {
                                ogModal.close();
                                thisser.$swal(response.data);
                                window.store.commit('pageNeedsRefreshed',true);
                            })
                    }
                });
            }
            window.store.commit('reviewModal')
            this.boundReviewText = '';
        }
    },

}
</script>
