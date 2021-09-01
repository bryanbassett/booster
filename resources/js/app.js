require('./bootstrap');
import { createApp, h, VueElement } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Vuex from 'vuex'
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const store = new Vuex.Store({
    state: {
        selectedFundraiser: '',
        selectedStars:0,
        isReviewModalOpen:false,
        reviewText:''
    },
    mutations: {
        selectFundraiser (state,input) {
            state.selectedFundraiser = input;
        },
        selectStars (state,input) {
            state.selectedStars = input;
        },
        reviewModal (state) {
           state.isReviewModalOpen = !state.isReviewModalOpen;
        },
        reviewText(state,input){
            state.reviewText = input;
        }
    }
})
window.store = store;
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Vuex)
            .mixin({ methods: { route },props:store})
            .mount(el);
    },
});



InertiaProgress.init({ color: '#4B5563' });
