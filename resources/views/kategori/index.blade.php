@extends('layouts.app')

@section('title', 'Kelola Kategori - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
    </div>
    <div class="card-body">
        @if($kategoris->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Berita</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->id }}</td>
                        <td>
                            <strong>{{ $kategori->nama }}</strong>
                        </td>
                        <td>
                            <code>{{ $kategori->slug }}</code>
                        </td>
                        <td>
                            {{ $kategori->deskripsi ? Str::limit($kategori->deskripsi, 50) : '-' }}
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $kategori->beritas_count }} berita</span>
                        </td>
                        <td>{{ $kategori->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if($kategori->beritas_count == 0)
                                <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="btn btn-sm btn-danger" disabled title="Tidak bisa dihapus, masih ada berita">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $kategoris->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada kategori</h5>
            <p class="text-muted">Mulai dengan menambahkan kategori pertama</p>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "columnDefs": [
            { "orderable": false, "targets": [6] } // Disable sorting for action column
        ]
    });
});
</script>
@endpush

@push('styles')
<!-- Custom styles for this page -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
