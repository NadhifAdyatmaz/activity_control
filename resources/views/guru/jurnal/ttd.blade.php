@foreach ($jurnals as $item)
    <!-- TTD Modal HTML -->
    <div id="ttd{{ $item->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TTD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                        <form action="{{ route('guru.jurnal.ttd', $item->id) }}" method="post" enctype="multipart/form-data">
                        @if ($item->ttd != null)
                        <img class="border-gray mb-2" width="200" height="100"
                                                        src="{{ $item->ttd ? asset($item->ttd) : asset('assets/img/noimg.png') }}"
                                                        alt="...">
                        @endif
                        <div class="form-group mt-3">
                            <label>Tanda Tangan</label>
                            <div id="signature-pad-{{ $item->id }}" class="signature-pad">
                                <div class="signature-pad-body">
                                    <canvas id="canvas-{{ $item->id }}" style="border: 1px solid #ccc;"></canvas>
                                </div>
                                <div class="signature-pad-footer" style="text-align: left">
                                    <button type="button" id="clear-signature-{{ $item->id }}" class="btn btn-danger">Clear</button>
                                </div>
                            </div>
                            <input type="hidden" name="signature" id="signature-{{ $item->id }}" value="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                        @csrf
                        @method('POST')
                        <input type="submit" class="btn btn-danger" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script>
    $(document).ready(function () {
        @foreach ($jurnals as $item)
            var canvas{{ $item->id }} = document.getElementById('canvas-{{ $item->id }}');
            var signaturePad{{ $item->id }} = new SignaturePad(canvas{{ $item->id }});

            document.getElementById('clear-signature-{{ $item->id }}').addEventListener('click', function () {
                signaturePad{{ $item->id }}.clear();
            });

            document.querySelector('#ttd{{ $item->id }} form').addEventListener('submit', function (e) {
                var signatureInput{{ $item->id }} = document.getElementById('signature-{{ $item->id }}');
                if (signaturePad{{ $item->id }}.isEmpty()) {
                    e.preventDefault();
                    alert('Tanda tangan harus diisi.');
                } else {
                    signatureInput{{ $item->id }}.value = signaturePad{{ $item->id }}.toDataURL();
                }
            });
        @endforeach
    });
</script>