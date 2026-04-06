<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Staff List</h1>

        <a href="{{ route('staffs.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded">
           + Add Staff
        </a>

        @if ($message = Session::get('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ $message }}
            </div>
        @endif

        <table class="w-full mt-6 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">No</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($staffs as $staff)
                <tr class="text-center border-t">
                    <td>{{ ++$i }}</td>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->email }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('staffs.show',$staff->id) }}" class="bg-green-500 px-2 py-1 text-white rounded">Show</a>
                        <a href="{{ route('staffs.edit',$staff->id) }}" class="bg-yellow-500 px-2 py-1 text-white rounded">Edit</a>

                        <form action="{{ route('staffs.destroy',$staff->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin?')" class="bg-red-500 px-2 py-1 text-white rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {!! $staffs->links() !!}
        </div>
    </div>
</x-app-layout>