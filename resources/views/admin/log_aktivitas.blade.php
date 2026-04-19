<x-navbar-sidebar-layout>

<div class="table-responsive">

<table class="table table-hover align-middle border">

    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Role</th>
            <th>Aksi</th>
            <th>Deskripsi</th>
            <th>Detail</th>
            <th>Waktu</th>
        </tr>
    </thead>

    <tbody>
    @foreach($logs as $log)
        @php
            $data = json_decode($log->aktivitas, true);
            $aksi = $data['aksi'] ?? '-';

            $badgeColor = match($aksi) {
                'create' => 'success',
                'update' => 'warning',
                'delete' => 'danger',
                default => 'primary'
            };
        @endphp

        <tr class="align-top">
            <td class="fw-semibold">
                {{ $log->user->name ?? 'System' }}
            </td>

            <td>
                <span class="text-muted small">
                    {{ $log->role ?? '-' }}
                </span>
            </td>

            <td>
                <span class="badge bg-{{ $badgeColor }}">
                    {{ strtoupper($aksi) }}
                </span>
            </td>

            <td style="max-width: 220px;">
                <span class="text-truncate d-inline-block" style="max-width: 220px;">
                    {{ $data['deskripsi'] ?? '-' }}
                </span>
            </td>

            <td style="min-width: 180px;">
                @if(isset($data['data']) && is_array($data['data']))
                    
                    <button class="btn btn-sm btn-outline-secondary"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#detail-{{ $log->id }}">
                        Lihat Detail
                    </button>

                    <div class="collapse mt-2" id="detail-{{ $log->id }}">
                        <div class="card card-body p-2 small bg-light">
                            @foreach($data['data'] as $key => $value)
                                <div>
                                    <span class="text-muted">{{ $key }}:</span>
                                    <span class="fw-semibold">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @else
                    <span class="text-muted">-</span>
                @endif
            </td>

            <td class="text-muted small">
                {{ $log->created_at->format('d M Y, H:i') }}
            </td>
        </tr>

    @endforeach
    </tbody>

</table>
</div>

<div class="mt-3">
    {{ $logs->links() }}
</div>

</x-navbar-sidebar-layout>