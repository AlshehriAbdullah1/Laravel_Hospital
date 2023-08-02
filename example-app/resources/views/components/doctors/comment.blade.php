@props(['comment'])

<article class="max-w-md mx-auto bg-white border border-gray-200 p-6 rounded-xl mb-4">
    <div class="flex items-center mb-4">
        <div class="m-1">
        <img class="rounded-full h-12 w-12 mr-4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROhuTdLL3qV-93rNnSS-4R2vVPcdVyKOJ6KA&usqp=CAU" alt="Profile Image">
        <p class="text-2xs text-gray-600">{{$comment->name}}</p>
    </div>
        <div>
            <h3 class="font-bold text-gray-800">{{ $comment->title }}</h3>
            <p class="text-xs text-gray-500">Posted
                <time>{{ $comment->created_at->diffForHumans() }}</time>
            </p>
            @if ($comment->rating)
                <div class="flex items-center mt-1">
                    @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $comment->rating)
                        <span class="text-yellow-500">&#9733;</span>
                    @else
                        <span class="text-gray-300">&#9733;</span>
                    @endif
                @endfor
                </div>
            @endif
        </div>
    </div>

    <p class="text-gray-800">
        {{ $comment->body }}
    </p>
</article>
