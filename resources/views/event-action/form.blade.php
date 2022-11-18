<div class="mb-3">
    <label class="block mb-1" for="title">Title</label>
    <input class="w-full rounded border-slate-300 @error('title') border-red-500 @enderror" type="text" name="title"
           id="title" value="{{old('title', isset($event) ? $event->title : '')}}">
    @error('title')
    <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="block mb-1" for="description">Description</label>
    <textarea rows="10" class="w-full rounded border-slate-300 @error('description') border-red-500 @enderror" name="description"
              id="description">{{old('description', isset($event) ? $event->description : '')}}</textarea>
    @error('description')
    <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 grid grid-cols-2 gap-8">
    <div>
        <label class="block mb-1" for="start_date">Start Date</label>
        <input class="w-full rounded border-slate-300 @error('start_date') border-red-500 @enderror" type="date"
               name="start_date" id="start_date"
               value="{{old('start_date', isset($event) ? $event->start_date->format('Y-m-d') : '')}}">
        @error('start_date')
        <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1" for="end_date">End Date</label>
        <input class="w-full rounded border-slate-300 @error('end_date') border-red-500 @enderror" type="date"
               name="end_date" id="end_date" value="{{old('end_date', isset($event) ? $event->end_date->format('Y-m-d') : '')}}">
        @error('end_date')
        <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="my-3">
    <x-primary-button class="bg-blue-700 hover:bg-blue-600">Submit</x-primary-button>
</div>