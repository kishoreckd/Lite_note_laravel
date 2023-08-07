<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">Create New note</a>
            <div class=" mt-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-hidden shadow-sm  sm:rounded-lg">

                    {{-- one way of showing error  --}}
                    {{-- @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach --}}

                    <form action="{{ route('notes.update',$note) }}" method="post">
                        {{-- <input type="text"> --}}
                        @method('put')
                        @csrf
                        <x-text-input type="text" field="title" name="title" placeholder="Title" class="w-full"
                            autocomplete="off" :value="@old('title',$note->title)"></x-text-input>

                        <x-textarea type="text" name="text" field="text" placeholder="Start Typing here..."
                            rows="10" class="w-full" autocomplete="off" :value="@old('text',$note->text)"></x-textarea>

                        <x-primary-button>Save Note</x-primary-button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
