<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Welcome, {{ auth()->user()->name }}</h3>
                    <p>Role: {{ auth()->user()->role->name }}</p>
                </div>
            </div>

            @if(auth()->user()->role->name === 'User')
                <!-- Attendance Section -->

                <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-lg mb-4">Today's Attendance</h3>
                        
                        @if(!$todayAttendance)
                            <form action="{{ route('attendance.check-in') }}" method="POST">
                                @csrf
                                <button type="submit" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer;">
                                    Check In
                                </button>
                            </form>
                        @elseif(!$todayAttendance->check_out)
                            <form action="{{ route('attendance.check-out') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <p>Checked in at: {{ $todayAttendance->check_in }}</p>
                                </div>
                                <button type="submit" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer;">
                                    Check Out
                                </button>
                            </form>
                        @else
                            <div>
                                <p>Today's attendance completed</p>
                                <p>Check in: {{ $todayAttendance->check_in }}</p>
                                <p>Check out: {{ $todayAttendance->check_out }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Daily Report Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-semibold text-lg mb-4">Daily Report</h3>
                        
                        @if(!$todayReport)
                            <form action="{{ route('daily-report.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Today's Activities</label>
                                    <textarea name="activity" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                </div>

                                <button type="submit" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer;">
                                    Submit Report
                                </button>
                            </form>
                        @else
                            <div>
                                <p class="font-bold">Today's report submitted</p>
                                <p class="mt-2"><span class="font-semibold">Activities:</span> {{ $todayReport->activity }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
