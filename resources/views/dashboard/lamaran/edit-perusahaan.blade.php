@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid p-0">
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <h1 class="h3 mb-3">Update Status Lamaran</h1>
            <a href="{{ route('dashboard.lamaran.index') }}" type="button" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.lamaran.update-status', $lamaran->id) }}" method="POST">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Lamaran</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="pending" {{ $lamaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $lamaran->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $lamaran->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
