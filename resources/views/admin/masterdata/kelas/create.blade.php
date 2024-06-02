<!-- Add Kelas -->
<div id="add-kelas" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.masterdata.kelas.add') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kelas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Kelas</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}">
                        <small class="form-text text-muted text-sm">*contoh: X RPL 1</small>
                    </div>
                    @error('name')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="jumlah_siswa">Jumlah Siswa</label>
                        <input type="text" id="jumlah_siswa" class="form-control @error('jumlah_siswa') is-invalid @enderror"
                            name="jumlah_siswa" value="{{ old('jumlah_siswa') }}">
                        <small class="form-text text-muted text-sm">*contoh: 16</small>
                    </div>
                    @error('jumlah_siswa')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <!-- <label for="status">Status</label><br> -->
                        <input type="hidden" name="status" value="inactive">
                        <input type="checkbox" id="status" name="status" value="active" checked>
                        <label for="status">Active</label>
                    </div>
                    @error('status')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default  mr-2" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>