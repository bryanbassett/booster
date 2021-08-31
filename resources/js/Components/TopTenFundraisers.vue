<template>
    <div id="topTenContain" class="grid grid-cols-12">
        <div class="col-span-12" >
            <ul id="topTen">
                <li v-for="n in 10" class="text-white">
                    <div class="grid grid-cols-12 mb-2">
                        <div class="col-span-2">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="col-span-10">
                            <div class="font-bold d-block">Fundraiser {{ n }}</div>
                            <div class="d-block font-light text-sm">(fundraiser description) Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi ...</div>
                            <div class="d-block">&#9733; &#9733; &#9733; &#9733; &#9734;</div>
                            <div class="d-block">
                                <button class="d-inline-block bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded text-xs">Read Reviews</button>
                                <button class="d-inline-block ml-2 bg-transparent hover:bg-yellow-500 text-yellow-500 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded text-xs">Review Fundraiser</button>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
            <div class="text-center mt-5">
                <button class="d-inline-block bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded text-xs">More Fundraisers</button>
            </div>
        </div>
    </div>
</template>
