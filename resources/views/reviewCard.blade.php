@foreach($reviews as $review)
    <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
        <div class="flex justify-center md:justify-end -mt-16">
            <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
        </div>
        <div>
            <h2 class="text-gray-800 text-3xl font-semibold">
                @for ($x = floor($review->rating); $x > 0; $x--)
                    <span class="fa fa-star"></span>
                @endfor
                @if($review->rating-floor($review->rating)!=0)
                    <span class="fa fa-star-half"></span>
                @endif
            </h2>
            <p class="mt-2 text-gray-600">{{$review->review_text}}</p>
        </div>
        <div class="w-100 text-right">
            <span class="block text-sm font-medium text-indigo-500">-{{$review->user->name}} </span>
            <span class="block text-sm text-black"><small>{{$review->created_at}}</small></span>
        </div>
    </div>
@endforeach
