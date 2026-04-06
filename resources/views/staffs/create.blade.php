<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-xl font-bold mb-4">Add Staff</h1>

        <form action="{{ route('staffs.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Name" class="w-full mb-3 border p-2">
            <input type="email" name="email" placeholder="Email" class="w-full mb-3 border p-2">

            <input type="password" name="password" placeholder="Password" class="w-full mb-3 border p-2">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full mb-3 border p-2">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>

    </div>
</x-app-layout>