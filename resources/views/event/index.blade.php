<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-2 font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <form>
                    <div class="bg-white border-b border-gray-100 flex justify-between">
                        <div class="px-6 py-5 flex items-center">
                            <div class="mr-1">
                                <select name="filter" onchange="this.form.submit()"
                                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">-- Select Filter --</option>
                                    <option @selected(request('filter') == 'finished') value="finished">
                                        Finished events
                                    </option>
                                    <option @selected(request('filter') == 'finished_last_7_days') value="finished_last_7_days">
                                        Finished events of the last 7 days.
                                    </option>
                                    <option @selected(request('filter') == 'upcoming') value="upcoming">
                                        Upcoming events
                                    </option>
                                    <option @selected(request('filter') == 'upcoming_within_7_day') value="upcoming_within_7_day">
                                        Upcoming events within 7 days
                                    </option>

                                    <option @selected(request('filter') == 'running') value="running">
                                        Running events
                                    </option>
                                </select>
                            </div>
                            <div class="mr-1">
                                <x-text-input
                                        type="text"
                                        placeholder="Search..."
                                        class="block w-full"
                                        name="search"
                                        :value="request('search')"
                                />
                            </div>
                            <div>
                                <x-primary-button>Search</x-primary-button>
                            </div>
                            @if(request('filter') || request('search'))
                                <div class="ml-2">
                                    <a class="text-blue-700" href="{{route('events.index')}}">Clear search</a>
                                </div>
                            @endif
                        </div>
                        <div class="px-6 py-5 flex items-center">
                            <a class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-lg" href="{{route('events.create')}}">Add new</a>
                        </div>
                    </div>
                </form>

                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Title</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Start Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">End Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Action</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($events as $event)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{$event->title}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{$event->start_date->format('M d, Y H:00')}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{$event->end_date->format('M d, Y  H:00')}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{$event->event_status}}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center flex">
                                            <a href="{{route('events.edit', $event->id)}}" class="text-blue-700 mr-3">Edit</a>
                                            <form onsubmit="return confirm('Do you really want to delete?')" action="{{route('events.destroy', $event->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-700">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-1">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
