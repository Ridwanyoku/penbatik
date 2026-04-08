<x-app-layout>
    <div class="p-8 bg-white min-h-screen">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Staff Management</h1>
                <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-[0.2em] font-medium">Manage your team and platform access</p>
            </div>
            
            <a href="{{ route('staffs.create') }}" 
               class="border border-[#FF3B3B] text-[#FF3B3B] px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#FF3B3B] hover:text-white transition-all duration-300 shadow-sm">
                + Add New Staff
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-lg text-[11px] font-bold uppercase tracking-wider flex items-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ $message }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-50 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                        <th class="px-6 py-5 font-semibold text-center w-16">No</th>
                        <th class="px-6 py-5 font-semibold">Staff Details</th>
                        <th class="px-6 py-5 font-semibold">Email Address</th>
                        <th class="px-6 py-5 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($staffs as $staff)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-6 text-center text-[11px] font-mono text-gray-400">
                                {{ str_pad($loop->iteration + ($staffs->currentPage() - 1) * $staffs->perPage(), 2, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-[11px] font-bold text-gray-400 border border-gray-200 uppercase">
                                        {{ substr($staff->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[12px] font-bold text-gray-900 leading-none mb-1">
                                            {{ $staff->name }}
                                        </div>
                                        <div class="text-[9px] text-gray-400 uppercase tracking-tighter">
                                            Staff Member
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 text-[11px] text-gray-600 font-medium">
                                {{ $staff->email }}
                            </td>

                            <td class="px-6 py-6 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    {{-- <a href="{{ route('staffs.show', $staff->id) }}" 
                                       class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-black transition">
                                        Show
                                    </a> --}}
                                    
                                    <a href="{{ route('staffs.edit', $staff->id) }}" 
                                       class="text-[10px] font-bold text-blue-500 uppercase tracking-widest hover:text-blue-700 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this staff member?')" 
                                                class="text-[10px] font-bold text-[#FF3B3B] uppercase tracking-widest hover:text-red-700 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-gray-300 text-[10px] font-bold uppercase tracking-[0.3em]">No staff members found</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staffs->hasPages())
            <div class="mt-8 flex justify-between items-center text-[10px] text-gray-400 font-bold tracking-[0.1em] border-t border-gray-50 pt-8">
                <div>
                    SHOWING <span class="text-gray-900">{{ $staffs->firstItem() }}-{{ $staffs->lastItem() }}</span> OF {{ $staffs->total() }} STAFF
                </div>
                <div class="flex items-center gap-4">
                    {{ $staffs->links('pagination::simple-tailwind') }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>