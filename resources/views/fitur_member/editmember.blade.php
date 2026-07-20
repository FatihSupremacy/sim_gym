@extends('layout.master')

@section('content')
<section aria-labelledby="form-title">

    <div class="card border-0 shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div style="background-color: #4f6ef7;">
            <div class="py-3 px-4 d-flex align-items-center gap-3">
                <div class="rounded-2 bg-white bg-opacity-25 text-center text-white"
                    style="width: 42px; height: 42px; line-height: 42px; font-size: 1.25rem;">
                    <i class="bi bi-person-gear" aria-hidden="true"></i>
                </div>
                <div>
                    <h1 id="form-title" class="h5 fw-bold text-white mb-0">Edit Data Member</h1>
                    <p class="text-white-50 small mb-0">Perbarui informasi member yang sudah terdaftar</p>
                </div>
            </div>
        </div>

        {{-- Card Body --}}
        <div class="card-body p-4">
            <form action="/members/{{ $data->id }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                {{-- Foto Profil --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Foto Profil
                    </legend>
                    <div class="mb-3">
                        @if($data->foto)
                        <img
                            src="{{ asset('foto_member/' . $data->foto) }}"
                            alt="Foto {{ $data->nama }}"
                            width="90" height="90"
                            class="rounded-2 object-fit-cover border">
                        @else
                        <div class="rounded-2 bg-secondary-subtle border text-center text-secondary"
                            style="width: 90px; height: 90px; line-height: 90px; font-size: 2.5rem;">
                            <i class="bi bi-person-fill" aria-hidden="true"></i>
                        </div>
                        @endif
                        <p class="text-muted small mt-2 mb-0">
                            Kosongkan input di bawah jika tidak ingin mengganti foto.
                        </p>
                    </div>
                    <div>
                        <label for="foto" class="form-label">Ganti Foto</label>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept="image/*"
                            class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>

                {{-- Informasi Pribadi --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Informasi Pribadi
                    </legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                placeholder="Masukan nama lengkap"
                                value="{{ old('nama', $data->nama) }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="tel" id="no_hp" name="no_hp"
                                placeholder="Masukan nomor handphone"
                                value="{{ old('no_hp', $data->no_hp) }}"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                placeholder="Masukan email"
                                value="{{ old('email', $data->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                placeholder="Masukan alamat lengkap"
                                class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $data->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- Data Membership --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Data Membership
                    </legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="paket_id" class="form-label">Paket Membership</label>
                            <select id="paket_id" name="paket_id"
                                class="form-select @error('paket_id') is-invalid @enderror">
                                <option value="" disabled>Pilih Paket</option>
                                @foreach($paket as $p)
                                <option value="{{ $p->id }}" {{ old('paket_id', $data->paket_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_paket }}
                                </option>
                                @endforeach
                            </select>
                            @error('paket_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                            <input type="text" id="tanggal_daftar" name="tanggal_daftar"
                                placeholder="Pilih tanggal (dd-mm-yyyy)..."
                                value="{{ old('tanggal_daftar', \Carbon\Carbon::parse($data->tanggal_daftar)->format('d-m-Y')) }}"
                                class="form-control @error('tanggal_daftar') is-invalid @enderror">
                            @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_kadaluwarsa" class="form-label">Tanggal Kadaluwarsa</label>
                            <input type="text" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa"
                                placeholder="Pilih tanggal kadaluwarsa (dd-mm-yyyy)..."
                                value="{{ old('tanggal_kadaluwarsa', \Carbon\Carbon::parse($data->tanggal_kadaluwarsa)->format('d-m-Y')) }}"
                                class="form-control @error('tanggal_kadaluwarsa') is-invalid @enderror"
                                required>
                            @error('tanggal_kadaluwarsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end gap-2 pt-2">
                    <a href="/members" class="btn btn-danger rounded-2">
                        <i class="bi bi-x-circle-fill me-1" aria-hidden="true"></i> Batal
                    </a>
                    <button type="submit" class="btn rounded-2 text-white" style="background-color: #4f6ef7;">
                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i> Update
                    </button>
                </div>

            </form>
        </div>

    </div>

</section>

@push('scripts')
<script>
    flatpickr("#tanggal_daftar", {
        dateFormat: "d-m-Y",
    });
    flatpickr("#tanggal_kadaluwarsa", {
        dateFormat: "d-m-Y",
    });
</script>
@endpush

@endsection