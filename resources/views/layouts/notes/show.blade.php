<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created:</strong>{{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated:</strong> {{ $note->created_at->diffForHumans() }}
                </p>
                <a href="{{ route('notes.edit',$note) }}" class="btn-link ml-auto">Edit Note</a>
            </div>
            <div class=" mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-bold text-2xl">
                        {{ $note->title }}
                    </h2>
                    <p class="mt-2">
                        {{ $note->text }}
                    </p>


                </div>

            </div>

        </div>
    </div>
</x-app-layout>
