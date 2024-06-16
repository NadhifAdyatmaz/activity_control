<style>
    .modal-body .form-group {
        display: flex;
        align-items: center;
    }

    .modal-body .form-group label {
        width: 150px;
        margin-bottom: 0;
    }

    .modal-body .form-group .form-control {
        flex: 1;
    }
</style>
<!-- Add Jadwal -->
<div id="add-jadwal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.jadwal.add') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label for="tanggal_jadwal">Tanggal: </label>
                        <input type="date" id="tanggal_jadwal"
                            class="form-control @error('tanggal_jadwal') is-invalid @enderror" name="tanggal_jadwal"
                            value="{{ old('tanggal_jadwal') }}">
                    </div>
                    @error('tanggal_jadwal')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror -->

                    <div class="form-group">
                        <label for="hari">Hari : </label>
                        <select name="hari" id="hari" class="form-control">
                            <option value="">Pilih Hari</option>

                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                        </select>
                    </div>
                    @error('hari')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="periode_id">Tahun Ajaran :</label>
                        <select name="periode_id" id="periode_id" class="form-control">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->name }}-{{ $periode->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('periode_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>
                    @enderror

                    <!-- Kelas -->
                    <div class="form-group">
                        <label for="kelas_id">Kelas :</label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('kelas_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>
                    @enderror

                    <!-- Jam Pelajaran -->
                    <div class="form-group">
                        <label for="jampel_id">Jam Ke :</label>
                        <select name="jampel_id" id="jampel_id" class="form-control">
                            <option value="">Pilih Jam</option>
                            @foreach ($jampels as $jampel)
                                <option value="{{ $jampel->id }}">{{ $jampel->jam_ke }}. {{ $jampel->pukul }} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('jampel_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>
                    @enderror

                    <!-- Mata Pelajaran -->
                    <div class="form-group">
                        <label for="mapel_id">Mapel :</label>
                        <select name="mapel_id" id="mapel_id" class="form-control">
                            <option value="">Pilih Mapel</option>
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('mapel_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>
                    @enderror

                    <!-- Guru -->
                    <div class="form-group">
                        <label for="user_id">Guru :</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">Pilih Guru</option>
                            @foreach ($users as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default mr-2" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>