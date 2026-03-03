<x-navbar-sidebar-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Data Pesanan</h4>

        <div>
            <input type="text" class="form-control d-inline w-auto" placeholder="Search">
            <button class="btn btn-primary ms-2">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
        </div>
    </div>

    <div class="card card-custom p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Tipe</th>
                        <th>Kode Pesanan</th>
                        <th>Harga</th>
                        <th>Profil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td>
                                <img src="https://cdn-icons-png.flaticon.com/512/3050/3050525.png"
                                    class="product-img me-2" width="60">
                                Kunci Inggris
                            </td>

                            <td>
                                <span class="status-active">Active</span>
                            </td>

                            <td>Standart</td>
                            <td>9177</td>
                            <td>Rp. 100.000</td>

                            <td>
                                <img src="https://i.pravatar.cc/35?img={{ $i }}" class="profile-img">
                            </td>

                            <td>
                                <button class="btn btn-confirm btn-sm">Konfirm</button>
                                <button class="btn btn-reject btn-sm">Tolak</button>
                            </td>
                        </tr>
                    @endfor

                </tbody>
            </table>
        </div>
    </div>
</x-navbar-sidebar-layout>
