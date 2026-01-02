<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Product Management</h2>
        <p class="text-sm text-gray-500">Edit product details</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-[#f8fafc] border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">Edit Product: <span
                        class="text-indigo-600">{{ $product->name }}</span></h3>
            </div>

            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
                class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Core Info -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">
                            Core Information</h4>

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Product Name')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="name"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="text" name="name" :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- SKU -->
                        <div>
                            <x-input-label for="sku" :value="__('SKU Code')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <x-text-input id="sku"
                                    class="block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors font-mono uppercase"
                                    type="text" name="sku" :value="old('sku', $product->sku)" required />
                            </div>
                            <x-input-error :messages="$errors->get('sku')" class="mt-1" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <select id="category_id" name="category_id"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                        </div>

                        <!-- Type -->
                        <div>
                            <x-input-label for="type" :value="__('Product Type')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <select id="type" name="type"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="raw_material" {{ old('type', $product->type) == 'raw_material' ? 'selected' : '' }}>Raw Material</option>
                                <option value="finished_good" {{ old('type', $product->type) == 'finished_good' ? 'selected' : '' }}>Finished Good</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-1" />
                        </div>

                        <!-- Unit -->
                        <div>
                            <x-input-label for="unit" :value="__('Unit of Measure')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="unit"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="text" name="unit" :value="old('unit', $product->unit)" required />
                            <x-input-error :messages="$errors->get('unit')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Right Column: Inventory & Details -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">
                            Inventory Details</h4>

                        <!-- Min Stock -->
                        <div>
                            <x-input-label for="min_stock" :value="__('Low Stock Alert Level')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <input type="number" name="min_stock" id="min_stock"
                                    class="block w-full rounded-lg border-gray-300 pl-3 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    value="{{ old('min_stock', $product->min_stock) }}" required />
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">units</span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('min_stock')" class="mt-1" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description (Optional)')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <textarea id="description" name="description" rows="4"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-1" />
                        </div>

                        <!-- Image -->
                        <div>
                            <x-input-label for="image" :value="__('Product Image (Optional)')"
                                class="text-xs font-bold text-gray-700 uppercase" />

                            @if($product->image)
                                <div class="mb-3 p-2 bg-gray-50 rounded-lg border border-gray-100 inline-block">
                                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                        class="w-20 h-20 object-cover rounded-md">
                                </div>
                            @endif

                            <div
                                class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10 hover:bg-gray-50 transition-colors">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                        <label for="image"
                                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Change file</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                    <a href="{{ route('products.index') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900 uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">{{ __('Cancel') }}</a>
                    <x-primary-button
                        class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 px-6 py-2.5 rounded-lg shadow-sm font-semibold text-white uppercase tracking-widest transition-all">
                        {{ __('Update Product') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>