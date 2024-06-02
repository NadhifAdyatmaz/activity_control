@foreach ($periodes as $item)
    <!-- Add Periode -->
    <div id="edit-per{{ $item->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.masterdata.periode.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Periode</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Tahun Ajaran</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $item->name) }}">
                            <!-- <small class="form-text text-muted text-sm">*ex: 2023-2024</small> -->
                        </div>
                        @error('name')
                            <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester"
                                class="form-control @error('semester') is-invalid @enderror">
                                @if($item->semester == 'ganjil')
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                @elseif ($item->semester == 'genap')
                                    <option value="genap">Genap</option>
                                    <option value="ganjil">Ganjil</option>
                                @endif
                            </select>
                        </div>

                        @error('semester')
                            <div class="alert-danger mx-4 my-2 px-2 py-2"> {{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <input type="hidden" name="status" value="inactive">
                            <input type="checkbox" id="status" name="status"
                                value="{{ old('status', $item->status) == 'active' ? 'checked' : '' }}">
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
@endforeach