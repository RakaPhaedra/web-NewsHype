@extends('layouts.app')

@section('title', 'Kelola Berita - HypeNews')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Berita</h1>
    <a href="{{ route('berita.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Berita Baru
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $berita)
                    <tr>
                        <td>
                            @if($berita->gambar)
                                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" 
                                     alt="Foto Berita" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; border-radius: 4px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ Str::limit($berita->judul, 40) }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit(strip_tags($berita->konten), 60) }}</small>
                        </td>
                        <td>{{ $berita->user->name }}</td>
                        <td>
                            <span class="badge badge-info">{{ $berita->kategori->nama }}</span>
                        </td>
                        <td>
                            @if($berita->status == 'draft')
                                <span class="badge badge-secondary">Draft</span>
                            @elseif($berita->status == 'menunggu_review')
                                <span class="badge badge-warning">Menunggu Review</span>
                            @elseif($berita->status == 'published')
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $berita->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('berita.show', $berita) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if(auth()->user()->isAdmin() || auth()->user()->isEditor() || 
                                    ($berita->user_id == auth()->id() && in_array($berita->status, ['draft', 'rejected'])))
                                <a href="{{ route('berita.edit', $berita) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif

                                @if($berita->status == 'draft' && $berita->user_id == auth()->id())
                                <form action="{{ route('berita.submit-review', $berita) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary" 
                                            onclick="return confirm('Submit berita untuk review?')" title="Submit Review">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                                @endif

                                @if($berita->status == 'menunggu_review' && (auth()->user()->isEditor() || auth()->user()->isAdmin()))
                                <button type="button" class="btn btn-sm btn-success" 
                                        data-toggle="modal" data-target="#approveModal{{ $berita->id }}" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        data-toggle="modal" data-target="#rejectModal{{ $berita->id }}" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif

                                @if(auth()->user()->isAdmin() || $berita->user_id == auth()->id())
                                <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus berita ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Approve Modal -->
                    @if($berita->status == 'menunggu_review' && (auth()->user()->isEditor() || auth()->user()->isAdmin()))
                    <div class="modal fade" id="approveModal{{ $berita->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Approve Berita</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('berita.approve', $berita) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <p>Yakin ingin mempublish berita "<strong>{{ $berita->judul }}</strong>"?</p>
                                        <div class="form-group">
                                            <label>Catatan Editor (Opsional)</label>
                                            <textarea name="catatan_editor" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Publish</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal{{ $berita->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reject Berita</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('berita.reject', $berita) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <p>Yakin ingin menolak berita "<strong>{{ $berita->judul }}</strong>"?</p>
                                        <div class="form-group">
                                            <label>Alasan Penolakan <span class="text-danger">*</span></label>
                                            <textarea name="catatan_editor" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $beritas->links() }}
        </div>
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
            { "orderable": false, "targets": [0, 6] } // Disable sorting for photo and action columns
        ]
    });
});
</script>
@endpush

@push('styles')
<!-- Custom styles for this page -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
