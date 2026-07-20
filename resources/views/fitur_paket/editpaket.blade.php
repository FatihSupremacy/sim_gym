@extends('layout.master')

@section('content')
<section id="edit-paket-form" aria-labelledby="form-title">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12 col-xl-13">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header border-0 bg-primary py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-25 rounded-2 d-flex align-items-center justify-content-center"
                            style="width: 42px; height: 42px; flex-shrink: 0; line-height: 1;">
                            <i class="bi bi-pencil-fill text-white" style="font-size: 16px; line-height: 1;" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-semibold text-white fs-5" id="form-title">
                                Edit Paket Membership
                            </h4>
                            <p class="mb-0 text-white-50 small mt-1">
                                Ubah data paket membership yang sudah ada
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="/paket/{{ $paket->id }}" class="form" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">

                            {{-- Nama Paket --}}
                            <div class="col-md-6">
                                <label class="form-label fw-medium small" for="nama_paket">Nama Paket</label>
                                <input type="text"
                                    id="nama_paket"
                                    class="form-control rounded-2 @error('nama_paket') is-invalid @enderror"
                                    name="nama_paket"
                                    placeholder="Masukan nama paket"
                                    value="{{ old('nama_paket', $paket->nama_paket) }}"
                                    autocomplete="off"
                                    required
                                    aria-required="true"
                                    aria-describedby="@error('nama_paket') nama_paket_error @enderror">
                                @error('nama_paket')
                                <div class="invalid-feedback" id="nama_paket_error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div class="col-md-6">
                                <label class="form-label fw-medium small" for="harga">Harga</label>
                                <div class="input-group rounded-2 overflow-hidden">
                                    <span class="input-group-text bg-primary bg-opacity-10 text-primary fw-semibold border-primary border-opacity-25"
                                        aria-hidden="true">Rp</span>
                                    <input type="number"
                                        id="harga"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        name="harga"
                                        placeholder="Masukan harga"
                                        value="{{ old('harga', $paket->harga) }}"
                                        min="0"
                                        required
                                        aria-required="true"
                                        aria-label="Harga dalam Rupiah"
                                        aria-describedby="@error('harga') harga_error @enderror">
                                </div>
                                @error('harga')
                                <div class="invalid-feedback d-block" id="harga_error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Durasi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-medium small" for="durasi">Durasi</label>
                                <input type="number"
                                    id="durasi"
                                    class="form-control rounded-2 @error('durasi') is-invalid @enderror"
                                    name="durasi"
                                    placeholder="Contoh: 1"
                                    min="1"
                                    required
                                    aria-required="true"
                                    value="{{ old('durasi', $paket->durasi) }}"
                                    aria-describedby="@error('durasi') durasi_error @enderror">
                                @error('durasi')
                                <div class="invalid-feedback" id="durasi_error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tipe Durasi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-medium small" for="tipe_durasi">Tipe Durasi</label>
                                <select
                                    id="tipe_durasi"
                                    class="form-select rounded-2 @error('tipe_durasi') is-invalid @enderror"
                                    name="tipe_durasi"
                                    required
                                    aria-required="true"
                                    aria-describedby="@error('tipe_durasi') tipe_durasi_error @enderror">
                                    <option value="" disabled {{ old('tipe_durasi', $paket->tipe_durasi) ? '' : 'selected' }}>-- Pilih tipe durasi --</option>
                                    <option value="hari" {{ old('tipe_durasi', $paket->tipe_durasi) == 'hari' ? 'selected' : '' }}>Hari</option>
                                    <option value="bulan" {{ old('tipe_durasi', $paket->tipe_durasi) == 'bulan' ? 'selected' : '' }}>Bulan</option>
                                </select>
                                @error('tipe_durasi')
                                <div class="invalid-feedback" id="tipe_durasi_error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="form-label fw-medium small" for="deskripsi">Deskripsi</label>
                                <textarea
                                    id="deskripsi"
                                    class="form-control rounded-2 @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi"
                                    rows="3"
                                    placeholder="Masukan deskripsi paket"
                                    aria-describedby="@error('deskripsi') deskripsi_error @enderror">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback" id="deskripsi_error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="text-body-tertiary my-4">

                        {{-- Tombol --}}
                        <div class="text-end mt-2 d-flex justify-content-end gap-2">
                            <a href="{{ route('paket.index') }}" class="btn btn-danger">
                                <i class="bi bi-x-circle-fill me-1"></i> Batal
                            </a>
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save-fill me-1"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection