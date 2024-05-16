@props(['username', 'rating', 'ulasan', 'avatar'])


<div class="flex">
    <div class="h-10 w-10 flex-shrink-0">
        <img class="h-full w-full rounded-full" src="{{ $avatar }}" alt="user1">
    </div>
    <div class="flex flex-col ml-2">
        {{-- username --}}
        <p class="text-sm font-medium text-gray-700">{{ $username }}</p>
        {{-- rating --}}
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4 text-yellow-500" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 2.472l2.761 5.653 6.23.904-4.513 4.39 1.068 6.192-5.546-2.917-5.547 2.917 1.068-6.192L1 9.029l6.231-.904L10 2.472z"
                    clip-rule="evenodd" />
            </svg>
            <p class="font-semibold text-gray-700">{{ $rating }}</p>
        </div>
        {{-- ulasan --}}
        <p class="text-sm text-gray-700">{{ $ulasan }}</p>
    </div>
</div>

