<!-- Add Jampel -->
<div id="add-jampel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.masterdata.jampel.add') }}" method="post">
            @csrf
                <div class="modal-header">						
                    <h4 class="modal-title">Tambah Jampel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label for="jam_ke">Jam Pelajaran</label>
                        <input type="text" id="jam_ke" class="form-control @error('jam_ke') is-invalid @enderror" 
                            name="jam_ke" value="{{ old('jam_ke') }}">
                            <small class="form-text text-muted text-sm">*contoh: 1</small>
                    </div>
                    @error('jam_ke')
                        <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="pukul">Jam Pelajaran</label>
                        <input type="text" id="pukul" class="form-control @error('pukul') is-invalid @enderror" 
                            name="pukul" value="{{ old('pukul') }}">
                            <small class="form-text text-muted text-sm">*contoh: 07.00-08.00</small>
                    </div>
                    @error('pukul')
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