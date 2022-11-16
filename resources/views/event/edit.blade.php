<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-2 font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Events') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="py-6 px-8">
                    <form action="{{route('events.update', $event->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        @include('event.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
