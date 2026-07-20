@extends('layout.master')

@section('content')
<section aria-labelledby="form-title">

    <div class="card border-0 shadow-sm overflow-hidden">

        <div style="background-color: #4f6ef7;">
            <div class="py-3 px-4 d-flex align-items-center gap-3">
                <div class="rounded-2 bg-white bg-opacity-25 text-center text-white"
                    style="width: 42px; height: 42px; line-height: 42px; font-size: 1.25rem;">
                    <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
                </div>
                <div>
                    <h1 id="form-title" class="h5 fw-bold text-white mb-0">Perpanjang Membership</h1>
                    <p class="text-white-50 small mb-0">Perbarui masa aktif membership member</p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="/members/{{ $data->id }}/perpanjang" method="POST" novalidate>
                @csrf
                @method('PUT')

                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Profil Member
                    </legend>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-2">
                            @if($data->foto)
                            <img
                                src="{{ asset('foto_member/' . $data->foto) }}"
                                alt="Foto {{ $data->nama }}"
                                width="150" height="150"
                                class="rounded-2 object-fit-cover border">
                            @else
                            <div class="rounded-2 bg-secondary-subtle border text-center text-secondary"
                                style="width: 150px; height: 150px; line-height: 150px; font-size: 2.5rem;">
                                <i class="bi bi-person-fill" aria-hidden="true"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $data->nama }}" readonly>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" readonly>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Data Membership
                    </legend>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="paket_id" class="form-label">Paket Membership</label>
                            <select id="paket_id" name="paket_id"
                                class="form-select @error('paket_id') is-invalid @enderror">
                                <option value="" disabled>Pilih Paket</option>
                                @foreach($paket as $p)
                                <option value="{{ $p->id }}"
                                    data-durasi="{{ (int) $p->durasi }}"
                                    data-tipe-durasi="{{ $p->tipe_durasi }}"
                                    {{ old('paket_id', $data->paket_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_paket }}
                                </option>
                                @endforeach
                            </select>
                            @error('paket_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_daftar" class="form-label">Tanggal Perpanjang</label>
                            <input type="text" id="tanggal_daftar" name="tanggal_daftar"
                                placeholder="Pilih tanggal (dd-mm-yyyy)..."
                                value="{{ old('tanggal_daftar', $tanggalPerpanjangDefault) }}"
                                class="form-control @error('tanggal_daftar') is-invalid @enderror">
                            @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_kadaluwarsa" class="form-label">Tanggal Kadaluwarsa</label>
                            <input type="text" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa"
                                placeholder="Pilih tanggal (dd-mm-yyyy)..."
                                value="{{ old('tanggal_kadaluwarsa', $tanggalKadaluwarsaDefault) }}"
                                class="form-control @error('tanggal_kadaluwarsa') is-invalid @enderror">
                            @error('tanggal_kadaluwarsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <div class="d-flex justify-content-end gap-2 pt-2">
                    <a href="/members" class="btn btn-danger rounded-2">
                        <i class="bi bi-x-circle-fill me-1" aria-hidden="true"></i> Batal
                    </a>
                    <button type="submit" class="btn rounded-2 text-white" style="background-color: #4f6ef7;">
                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</section>

@push('scripts')
<script>
    const paketSelect = document.getElementById('paket_id');
    const tanggalPerpanjangInput = document.getElementById('tanggal_daftar');

    const tanggalPerpanjangPicker = flatpickr(tanggalPerpanjangInput, {
        dateFormat: "d-m-Y",
        allowInput: true,
        onChange: hitungTanggalKadaluwarsa,
    });

    const tanggalKadaluwarsaPicker = flatpickr("#tanggal_kadaluwarsa", {
        dateFormat: "d-m-Y",
        allowInput: true,
    });

    function parseTanggal(tanggal) {
        const bagian = /^(\d{2})-(\d{2})-(\d{4})$/.exec((tanggal || '').trim());
        if (!bagian) return null;

        const hari = Number(bagian[1]);
        const bulan = Number(bagian[2]);
        const tahun = Number(bagian[3]);
        const hasil = new Date(tahun, bulan - 1, hari);

        if (
            hasil.getFullYear() !== tahun ||
            hasil.getMonth() !== bulan - 1 ||
            hasil.getDate() !== hari
        ) {
            return null;
        }

        return hasil;
    }

    function formatTanggal(tanggal) {
        const hari = String(tanggal.getDate()).padStart(2, '0');
        const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');

        return `${hari}-${bulan}-${tanggal.getFullYear()}`;
    }

    function tambahDurasi(tanggalAwal, durasi, tipeDurasi) {
        const hasil = new Date(tanggalAwal.getTime());

        if (tipeDurasi === 'bulan') {
            const tanggalAsli = hasil.getDate();
            hasil.setDate(1);
            hasil.setMonth(hasil.getMonth() + durasi);

            const hariTerakhir = new Date(
                hasil.getFullYear(),
                hasil.getMonth() + 1,
                0
            ).getDate();

            hasil.setDate(Math.min(tanggalAsli, hariTerakhir));
        } else {
            hasil.setDate(hasil.getDate() + durasi);
        }

        return hasil;
    }

    function hitungTanggalKadaluwarsa() {
        const tanggalAwal = parseTanggal(tanggalPerpanjangInput.value);
        const paket = paketSelect.options[paketSelect.selectedIndex];

        if (!tanggalAwal || !paket || !paket.value) return;

        const durasi = Math.max(Number.parseInt(paket.dataset.durasi, 10) || 0, 0);
        const tanggalKadaluwarsa = tambahDurasi(
            tanggalAwal,
            durasi,
            paket.dataset.tipeDurasi
        );

        tanggalKadaluwarsaPicker.setDate(
            formatTanggal(tanggalKadaluwarsa),
            false,
            "d-m-Y"
        );
    }

    paketSelect.addEventListener('change', hitungTanggalKadaluwarsa);
    tanggalPerpanjangInput.addEventListener('change', hitungTanggalKadaluwarsa);
    tanggalPerpanjangInput.addEventListener('blur', hitungTanggalKadaluwarsa);
</script>
@endpush

@endsection