<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Categories</h2>
        <p class="text-sm text-gray-500">Edit category details</p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-[#f8fafc] border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">Edit Category: <span
                        class="text-indigo-600">{{ $category->name }}</span></h3>
            </div>

            <form action="{{ route('categories.update', $category) }}" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Category Name')"
                            class="text-xs font-bold text-gray-700 uppercase" />
                        <x-text-input id="name"
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                            type="text" name="name" :value="old('name', $category->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Description (Optional)')"
                            class="text-xs font-bold text-gray-700 uppercase" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $category->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                    <a href="{{ route('categories.index') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900 uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">{{ __('Cancel') }}</a>
                    <x-primary-button
                        class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 px-6 py-2.5 rounded-lg shadow-sm font-semibold text-white uppercase tracking-widest transition-all">
                        {{ __('Update Category') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>