@foreach ($jurnals as $item)
    <!-- Foto Modal HTML -->
    <div id="foto{{ $item->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Foto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.jurnal.edit', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="file" id="foto{{ $item->id }}" name="foto" accept="foto/*" onchange="previewImage(event);">
                        
                        @if ($item->foto != null)
                        <img class="border-gray mt-2" width="400" height="200"
                                                        src="{{ $item->foto ? asset($item->foto) : asset('assets/img/noimg.png') }}"
                                                        alt="...">
                        @endif
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach