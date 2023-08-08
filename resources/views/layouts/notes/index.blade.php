<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (request()->routeIs('notes.index'))

            <a href="{{route('notes.create')}}" class="btn-link btn-lg mb-2">Create New note</a>

            @endif


            @forelse ($notes as $note)
                <div class=" mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-bold text-2xl">

                           <a
                           @if (request()->routeIs('notes.index'))

                            href="{{route('notes.show',$note)}}"

                            @else
                            href="{{route('trashed.show',$note)}}"

                            @endif
                            > {{ $note->title }}</a>
                        </h2>
                        <p class="mt-2">
                            {{ Str::limit($note->text,200)  }}
                        </p>
                        <p class="block mt-4 text-sm opacity-40">
                            {{ $note->updated_at->diffForHumans() }}
                        </p>
                    </div>

                </div>
                 @empty
                 @if (request()->routeIs('notes.index'))
                <p>You have No Notes Yet.</p>
                @else
                <p>No Items in the Trash</p>
                @endif



            @endforelse

            {{$notes->links()}}
        </div>
    </div>
</x-app-layout>
