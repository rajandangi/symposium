<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $talk->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="font-bold text-xl my-4 text-gray-500">Abstract</div>
                    <p>{{ $talk->abstract }}</p>

                    <div class="font-bold text-xl my-4 text-gray-500">Organizer Notes</div>
                    <p>{{ $talk->organizer_notes }}</p>


                    <div class="pt-6 pb-2">
                        <x-tag :title="'By ' . $talk->author->name" />
                        <x-tag :title="ucfirst($talk->type)" />
                        @if ($talk->length)
                            <x-tag :title="'Length ' . ucfirst($talk->length) . ' minutes'" />
                        @endif
                    </div>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2 px-8 py-4 m-auto w-max flex gap-1 items-center justify-center">
                <x-delete-item :route="route('talks.destroy', ['talk' => $talk])" text="Delete" />
                <a href="{{ route('talks.edit', ['talk' => $talk]) }}"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
