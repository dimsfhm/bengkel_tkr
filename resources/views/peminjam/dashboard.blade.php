<x-navbar-sidebar-layout>
    <div class="p-6">

    {{-- Title --}}
    <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

        {{-- Riwayat --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Riwayat Pesanan</p>
            <h3 class="text-2xl font-bold">0 Riwayat</h3>
        </div>

        {{-- Alat --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Alat tersedia</p>
            <h3 class="text-2xl font-bold">0 Tersedia</h3>
        </div>

        {{-- Keranjang --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Keranjang</p>
            <h3 class="text-2xl font-bold">0 Produk</h3>
        </div>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="text-lg font-semibold mb-4">Peminjaman Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-600">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="p-3 text-left">Produk</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Tipe</th>
                        <th class="p-3 text-left">Kode Pesanan</th>
                        <th class="p-3 text-left">Harga</th>
                    </tr>
                
            </table>
        </div>
    </div>

</div>
</x-navbar-sidebar-layout>