<x-user.app>
    <x-slot:title>About Us | Penbatik</x-slot:title>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-6 py-24 border-b border-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="space-y-8">
                    <h4 class="text-[10px] font-bold text-red-500 uppercase tracking-[0.4em]">Our Philosophy</h4>
                    <h1 class="text-5xl font-extrabold text-gray-900 leading-[1.1] tracking-tighter">
                        Tradisi yang <br> Bernapas Kembali.
                    </h1>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-md uppercase tracking-wide">
                        Para penbatik lahir dari keinginan untuk membawa keanggunan motif tradisional ke dalam dinamika dunia modern. Kami tidak hanya menjual kain, kami menjaga cerita di setiap goresan malam.
                    </p>
                    <div class="pt-4">
                        <div class="h-[1px] w-20 bg-black"></div>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] bg-gray-100 rounded-2xl overflow-hidden shadow-2xl transition-transform hover:scale-[1.02] duration-700">
                        <img src="{{asset('/images/ab2.jfif')}}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000">
                    </div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-white p-4 hidden md:block border border-gray-100 rounded-xl shadow-lg">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-loose">
                            EST. 2024 <br> DEPOK, INDONESIA <br> CRAFTED WITH PASSION
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-24 text-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="space-y-4">
                    <h3 class="text-[11px] font-bold uppercase tracking-[0.3em]">Quality First</h3>
                    <p class="text-[10px] text-gray-400 leading-relaxed uppercase">Material pilihan dengan standar tinggi untuk kenyamanan maksimal.</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-[11px] font-bold uppercase tracking-[0.3em]">Authenticity</h3>
                    <p class="text-[10px] text-gray-400 leading-relaxed uppercase">Motif yang menghormati akar budaya namun tetap relevan.</p>
                </div>
                <div class="space-y-4">
                    <h3 class="text-[11px] font-bold uppercase tracking-[0.3em]">Modern Fit</h3>
                    <p class="text-[10px] text-gray-400 leading-relaxed uppercase">Potongan kontemporer yang dirancang untuk gaya hidup urban.</p>
                </div>
            </div>
        </div>
    </div>
</x-user.app>