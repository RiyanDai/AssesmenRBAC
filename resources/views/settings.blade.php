<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="block font-medium text-sm text-gray-700">Site Name</label>
                            <input type="text" name="site_name" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   value="{{ $settings->site_name ?? 'RBAC Laravel' }}"
                                   placeholder="Enter site name">
                        </div>

                        <div class="mb-3">
                            <label class="block font-medium text-sm text-gray-700">Theme Settings</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="dark_mode" 
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                           {{ $settings->dark_mode ?? false ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Enable Dark Mode</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="block font-medium text-sm text-gray-700">Email Notifications</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="email_notifications" 
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                           {{ $settings->email_notifications ?? false ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Enable email notifications</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 