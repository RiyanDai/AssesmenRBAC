<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports & Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Attendance Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Attendance Records</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Check In</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Check Out</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->check_in }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $attendance->check_out ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Daily Reports Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Daily Reports</h3>
                    <div class="space-y-6">
                        @foreach($reports as $report)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-semibold">{{ $report->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $report->date }}</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="font-medium">Activities:</p>
                                    <p class="text-gray-700">{{ $report->activity }}</p>
                                </div>
                                @if($report->challenges)
                                <div>
                                    <p class="font-medium">Challenges:</p>
                                    <p class="text-gray-700">{{ $report->challenges }}</p>
                                </div>
                                @endif
                                @if($report->plans)
                                <div>
                                    <p class="font-medium">Tomorrow's Plan:</p>
                                    <p class="text-gray-700">{{ $report->plans }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 