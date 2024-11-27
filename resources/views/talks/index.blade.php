<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Talks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul role="list" class="divide-y divide-gray-100">

                        @foreach ($talks as $talk)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm/6 font-semibold text-gray-900">
                                            <a href="{{ route('talks.show', ['talk' => $talk]) }}"
                                                class="hover:underline">{{ $talk->title }}
                                            </a>
                                        </p>
                                        <p class="mt-1 truncate text-xs/5 text-gray-500">
                                            By {{ $talk->author->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm/6 text-gray-900">{{ ucfirst($talk->type) }}
                                        @if ($talk->length)
                                            | Length {{ $talk->length }} minute
                                        @endif
                                    </p>

                                    <p class="mt-1 text-xs/5 text-gray-500">Posted At
                                        <time datetime="{{ $talk->created_at->toIso8601String() }}">
                                            {{ $talk->created_at->diffForHumans() }}
                                        </time>
                                    </p>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
