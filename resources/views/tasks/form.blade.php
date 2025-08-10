{{-- resources/views/tasks/form.blade.php --}}

@csrf

{{-- Title --}}
<div>
    <label for="title" class="block font-medium mb-1">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $task->title ?? '') }}"
        class="w-full border-gray-300 rounded px-3 py-2">
</div>

{{-- Description --}}
<div>
    <label for="description" class="block font-medium mb-1">Description</label>
    <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded px-3 py-2">{{ old('description', $task->description ?? '') }}</textarea>
</div>

{{-- Due Date --}}
<div>
    <label for="due_date" class="block font-medium mb-1">Due Date</label>
    <input type="date" name="due_date" id="due_date"
        value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d') : '') }}"
        class="w-full border-gray-300 rounded px-3 py-2">
</div>

{{-- Category --}}
<div>
    <label for="category_id" class="block font-medium mb-1">Category</label>
    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded px-3 py-2">
        <option value="">-- None --</option>
        @foreach ($categories as $id => $name)
            <option value="{{ $id }}"
                {{ old('category_id', $task->category_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>
{{-- Recurring checkbox --}}
<div>
    <label class="inline-flex items-center">
        <input type="checkbox" name="is_recurring" value="1"
            {{ old('is_recurring', $task->is_recurring ?? false) ? 'checked' : '' }} class="mr-2">
        <span>Repeat this task</span>
    </label>
</div>

{{-- Recurrence type --}}
<div>
    <label for="recurrence" class="block font-medium mb-1">Recurrence</label>
    <select name="recurrence" id="recurrence" class="w-full border-gray-300 rounded px-3 py-2">
        <option value="">-- None --</option>
        <option value="daily" {{ old('recurrence', $task->recurrence ?? '') == 'daily' ? 'selected' : '' }}>Daily
        </option>
        <option value="weekly" {{ old('recurrence', $task->recurrence ?? '') == 'weekly' ? 'selected' : '' }}>Weekly
        </option>
        <option value="monthly" {{ old('recurrence', $task->recurrence ?? '') == 'monthly' ? 'selected' : '' }}>Monthly
        </option>
    </select>
</div>

{{-- Repeat interval --}}
<div>
    <label for="repeat_interval" class="block font-medium mb-1">Repeat Every</label>
    <input type="number" name="repeat_interval" id="repeat_interval" min="1"
        value="{{ old('repeat_interval', $task->repeat_interval ?? 1) }}"
        class="w-full border-gray-300 rounded px-3 py-2">
</div>

{{-- Recurs Until --}}
<div>
    <label for="recurs_until" class="block font-medium mb-1">Repeat Until</label>
    <input type="date" name="recurs_until" id="recurs_until"
        value="{{ old('recurs_until', isset($task) && $task->recurs_until ? $task->recurs_until->format('Y-m-d') : '') }}"
        class="w-full border-gray-300 rounded px-3 py-2">
</div>



{{-- Submit --}}
<div>
    <button type="submit" class="ml-2 text-gray-600 hover:underline">
        {{ $submitText ?? 'Save' }}
    </button>
    <a href="{{ route('tasks.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>

</div>
