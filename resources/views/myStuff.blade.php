<p class="ml-2 text-3xl text-black uppercase tracking-loose mb-2">My Fundraisers</p>
@foreach($fundraisers as $fundraiser)
        <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl mb-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-16 h-16 rounded-2xl p-3 border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <div class="font-medium leading-none  uppercase">{{$fundraiser->fundraiser_title}}</div>
                        <h2 class="text-yellow-500 text-1xl font-semibold">
                            @for ($x = floor($fundraiser->averageRating); $x > 0; $x--)
                                <span class="fa fa-star"></span>
                            @endfor
                            @if($fundraiser->averageRating-floor($fundraiser->averageRating)!=0)
                                <span class="fa fa-star-half"></span>
                            @endif
                        </h2>
                        <p class="text-sm text-gray-600 leading-none mt-1">{{$fundraiser->fundraiser_description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
<p class="ml-2  text-3xl text-black  uppercase tracking-loose mb-2">My Reviews</p>
@foreach($reviews as $review)
    <div class="flex flex-col p-8 bg-gray-800 shadow-md hover:shodow-lg rounded-2xl mb-2">

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-16 h-16 rounded-2xl p-3 border border-gray-800 text-blue-400 bg-gray-900" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex flex-col ml-3">
                    <div class="font-medium leading-none text-gray-100  uppercase">{{$review->fundraiser->fundraiser_title}}</div>
                    <h2 class="text-yellow-500 text-1xl font-semibold">
                        @for ($x = floor($review->rating); $x > 0; $x--)
                            <span class="fa fa-star"></span>
                        @endfor
                        @if($review->rating-floor($review->rating)!=0)
                            <span class="fa fa-star-half"></span>
                        @endif
                    </h2>
                    <p class="text-sm text-gray-500 leading-none mt-1">"{{$review->review_text}}"
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
