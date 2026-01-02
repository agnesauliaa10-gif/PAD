<x-app-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1e293b] tracking-tight uppercase">Suppliers</h2>
        <p class="text-sm text-gray-500">Register a new supplier</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-[#f8fafc] border-b border-gray-100">
                <h3 class="font-bold text-[#1e293b] uppercase tracking-wider text-sm">New Supplier Entry</h3>
            </div>

            <form action="{{ route('suppliers.store') }}" method="POST" class="p-6 md:p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left: Basic Info -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">
                            Company Details</h4>

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Company Name')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="name"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="text" name="name" :value="old('name')" required autofocus
                                placeholder="e.g. Acme Medical Supplies" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <textarea id="address" name="address" rows="3"
                                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Full company address...">{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Right: Contact Info -->
                    <div class="space-y-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-widest border-b pb-2 mb-4">
                            Contact Information</h4>

                        <!-- Contact Person -->
                        <div>
                            <x-input-label for="contact_person" :value="__('Contact Person')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="contact_person"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="text" name="contact_person" :value="old('contact_person')"
                                placeholder="e.g. John Doe" />
                            <x-input-error :messages="$errors->get('contact_person')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email Address')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="email"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="email" name="email" :value="old('email')" placeholder="contact@supplier.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')"
                                class="text-xs font-bold text-gray-700 uppercase" />
                            <x-text-input id="phone"
                                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-colors"
                                type="text" name="phone" :value="old('phone')" placeholder="+1 234 567 890" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-4">
                    <a href="{{ route('suppliers.index') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900 uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">{{ __('Cancel') }}</a>
                    <x-primary-button
                        class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 px-6 py-2.5 rounded-lg shadow-sm font-semibold text-white uppercase tracking-widest transition-all">
                        {{ __('Save Supplier') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>