<x-navbar-sidebar-layout>
    <table class="table">
    <tr>
        <th>User</th>
        <th>Role</th>
        <th>Aksi</th>
        <th>Deskripsi</th>
        <th>Data</th>
        <th>Waktu</th>
    </tr>

    @foreach($logs as $log)
        @php
            $data = json_decode($log->aktivitas, true);
        @endphp
        <tr>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->role }}</td>
            <td>{{ $data['aksi'] ?? '-' }}</td>
            <td>{{ $data['deskripsi'] ?? '-' }}</td>
            <td>{{ json_encode($data['data'] ?? []) }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
    @endforeach
</table>

{{ $logs->links() }}
</x-navbar-sidebar-layout>