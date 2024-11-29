<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conferences') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul role="list" class="divide-y divide-gray-100">

                        @foreach ($conferences as $conference)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm/6 font-semibold text-gray-900">
                                            <a href="{{ route('conferences.show', ['conference' => $conference]) }}"
                                                class="hover:underline">{{ $conference->title }}
                                            </a>
                                        </p>
                                        <p class="mt-1 truncate text-xs/5 text-gray-500">
                                            At {{ $conference->location }} on
                                            {{ $conference->starts_at->format('F j, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm/6 text-gray-900">
                                        @if (Auth::user()->favouritedConferences->pluck('id')->contains($conference->id))
                                            <a href="#" onclick="unfavouriteConference({{ $conference->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @else
                                            <a
                                                href="#" onclick="favouriteConference({{ $conference->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                                </svg>
                                            </a>
                                        @endif

                                    </p>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    {{ $conferences->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function favouriteConference(conferenceId){
            fetch(`/conferences/${conferenceId}/favourite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => window.location.reload());
        }

        function unfavouriteConference(conferenceId){
            fetch(`/conferences/${conferenceId}/favourite`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => window.location.reload());
        }
    </script>
</x-app-layout>
