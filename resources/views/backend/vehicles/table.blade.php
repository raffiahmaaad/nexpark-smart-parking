<table id="data_table" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nomor Registrasi</th>
            <th>Kategori</th>
            <th>Pelanggan</th>
            <th>Nama Kendaraan</th>
            <th>Nomor Polisi</th>
            <th>Status</th>
            <th>Tanggal Dibuat</th>
            <th>Biaya Parkir</th>
            <th class="nosort">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $key => $vehicle)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <span class="registration-number-backend">{{ $vehicle->registration_number }}</span>
                </td>
                <td>{{ $vehicle->category->name ?? '-' }}</td>
                <td>{{ $vehicle->customer->name ?? '-' }}</td>
                <td>{{ $vehicle->name }}</td>
                <td>{{ $vehicle->plat_number }}</td>
                <td>{{ $vehicle->status == 1 ? "Active" : "InActive" }}</td>
                <td>{{ $vehicle->created_at->format('Y/m/d') }}</td>
                <td>
                    @if($vehicle->category && $vehicle->category->fee_per_hour && $vehicle->duration)
                        {{ $vehicle->category->fee_per_hour * $vehicle->duration }}
                    @else
                        -
                    @endif
                </td>
                <td class="table-action">
                    <a href="{{ route('backend.vehicles.edit', $vehicle->id) }}" class="text-warning"><i
                            class="ik ik-edit-2"></i></a>
                    <a href="#" data-toggle="modal" data-target="#delete{{ $key }}" class="text-danger"><i
                            class="ik ik-trash-2"></i></a>
                </td>
            </tr>
            @include('backend.vehicles.delete')
        @endforeach
    </tbody>
</table>

<style>
    .registration-number-backend {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #2563eb;
        background: rgba(37, 99, 235, 0.1);
        padding: 4px 8px;
        border-radius: 4px;
        letter-spacing: 0.5px;
    }
</style>