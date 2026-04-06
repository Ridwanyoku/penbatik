<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-xl font-bold mb-4">Edit Staff</h1>

        <form action="{{ route('staffs.update',$staff->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $staff->name }}" class="w-full mb-3 border p-2">
            <input type="email" name="email" value="{{ $staff->email }}" class="w-full mb-3 border p-2">

            <input type="password" name="password" placeholder="New Password" class="w-full mb-3 border p-2">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full mb-3 border p-2">

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>

    </div>
</x-app-layout>