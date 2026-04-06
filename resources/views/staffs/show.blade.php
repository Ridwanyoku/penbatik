<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-xl font-bold mb-4">Staff Detail</h1>

        <p><strong>Name:</strong> {{ $staff->name }}</p>
        <p><strong>Email:</strong> {{ $staff->email }}</p>

        <a href="{{ route('staffs.index') }}" 
           class="inline-block mt-4 bg-gray-500 text-white px-4 py-2 rounded">
           Back
        </a>

    </div>
</x-app-layout>