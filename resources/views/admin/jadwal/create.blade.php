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
            <form action="" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tanggal: </label>
                        <input type="date" id="name" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="hari">Hari : </label>
                        <select name="hari" id="hari" class="form-control">
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                        </select>
                    </div>
                    @error('hari')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="periode_id">Tahun Ajaran : </label>
                        <select name="periode_id" id="periode_id" class="form-control">
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                    @error('periode_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="kelas_id">Kelas : </label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    @error('kelas_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="jampel_id">Jam Ke : </label>
                        <select name="jampel_id" id="jampel_id" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    @error('jampel_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="mapel_id">Mapel : </label>
                        <select name="mapel_id" id="mapel_id" class="form-control">
                            <option value="matematika">Matematika</option>
                            <option value="bahasa_indonesia">Bahasa Indonesia</option>
                            <option value="ipa">IPA</option>
                        </select>
                    </div>
                    @error('mapel_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="guru_id">Guru : </label>
                        <select name="guru_id" id="guru_id" class="form-control">
                            <option value="1">Ghafur</option>
                            <option value="2">Anas</option>
                            <option value="3">Jakfar</option>
                            <option value="4">Dio</option>
                        </select>
                    </div>
                    @error('guru_id')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
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