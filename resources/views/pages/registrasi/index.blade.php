@extends('layouts.master')

@section('title')
    Data Registrasi Makam
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>

    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Data
        @endslot
        @slot('title')
            Registrasi Makam
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Daftar Registrasi Pemakaman</h4>
                        <div class="ms-auto">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <button class="btn btn-primary btn-sm" onClick="add()" href="javascript:void(0)">Tambah
                                        Data</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-toolbar">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-lg">Import
                                data</button>
                            <a href="{{ route('export_registrasi') }}">
                                <button class="btn btn-success btn-sm">export data</button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Meninggal</th>
                                        <th>Nama Ahli Waris</th>
                                        <th>Alamat Ahli Waris</th>
                                        <th>Nama Meninggal</th>
                                        <th>Tempat Meninggal</th>
                                        <th>NIK</th>
                                        <th>Nama TPU</th>
                                        <th>Nomor Blok TPU</th>
                                        <th>Retribusi</th>
                                        <th>Ambulance</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    {{-- Modal Import Excel --}}
    <div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Import Data Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="{{ route('import_registrasi') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <div class="">
                                    <input type="file" name="file" class="form-control" id="validationTooltip03"
                                        required>
                                </div>
                                <div class="invalid-tooltip">
                                    Anda belum mengunggah File!
                                </div>
                            </div>
                    </div>
                </div><!-- /.modal-content -->
                <div class="modal-footer">
                    <button class="btn btn-primary">Import data</button>
                    </form>
                </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    {{-- Modal Tambah Registrasi --}}
    <div class="modal fade bs-example-modal-lg tambah" data-focus="false" id="registrasi-modal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegistrasiModal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="ModalForm" name="ModalForm" class="needs-validation" novalidate
                        method="POST">
                        <div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="kode_registrasi" id="kode_registrasi">
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Ahli Waris</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nama Ahli Waris</label>
                                    {{-- <input type="text" class="form-control" id="nama_ahliwaris"
                                        placeholder="Nama Ahli Waris" name="nama_ahliwaris" required> --}}
                                    <select data-width="100%" name="id_ahliwaris" id="id_ahliwaris"
                                        class="form-control select2" required></select>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Orang yang Meninggal</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_meninggal" placeholder="Nama"
                                        name="nama_meninggal" required>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" placeholder="NIK"
                                        name="nik" required>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Agama</label>
                                    <select class="form-select" id="agama" name="agama" required>
                                        <option selected disabled value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Khatolik">Khatolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Tempat Meninggal</label>
                                    <input type="text" class="form-control" id="tempat_meninggal"
                                        placeholder="Tempat" name="tempat_meninggal" required>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Tanggal Meninggal</label>
                                    <input type="date" class="form-control" id="tanggal_meninggal"
                                        placeholder="Tanggal" name="tanggal_meninggal" required>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Makam</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Nama TPU</label>
                                    <select class="form-select" id="nama_tpu" name="nama_tpu" required>
                                        <option selected disabled value="">Pilih TPU</option>
                                        @foreach ($tpu as $item)
                                            <option value="{{ $item->kode_tpu }}">{{ $item->nama_tpu }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Nomor dan Blok</label>
                                    <input type="text" class="form-control" id="blok_makam" placeholder="Blok Makam"
                                        name="blok_makam" required>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Retribusi</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Retribusi</label>
                                    {{-- <input data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" class="form-control" id="retribusi" placeholder="Retribusi"
                                        name="retribusi" required> --}}
                                    <input id="retribusi" name="retribusi" class="form-control input-mask text-start"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': '.', 'radixPoint': ',', 'autoGroup': true, 'prefix': 'Rp', 'placeholder': '0', 'autoUnmask': true, 'removeMaskOnSubmit': true">
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom04" class="form-label">Ambulans</label>
                                    <input class="form-control input-mask text-start" id="ambulance"
                                        placeholder="Ambulans" name="ambulance"
                                        data-inputmask="'alias': 'numeric', 'groupSeparator': '.', 'radixPoint': ',', 'autoGroup': true, 'prefix': 'Rp', 'placeholder': '0', 'autoUnmask': true, 'removeMaskOnSubmit': true"
                                        required>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                        </div>
                </div><!-- /.modal-content -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                    </form>
                </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->

    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/inputmask/inputmask.min.js') }}"></script>

    <!-- form mask init -->
    <script src="{{ asset('/assets/js/pages/form-mask.init.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.select2').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2-dropdown').select2();
        });
        $(document).ready(function() {
            $('#id_ahliwaris').select2({
                dropdownParent: $('#registrasi-modal'),
                minimumInputLength: 3,
                language: {
                    inputTooShort: function() {
                        return 'Ketik Minimal 3 Huruf';
                    }
                },
                ajax: {
                    url: '{{ route('ahliwaris.search') }}',
                    dataType: 'json',
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('registrasi') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    }, // row index
                    { data: 'tanggal_meninggal' },
                    { data: 'nama_ahliwaris', name: 'ahliwaris.nama'},
                    { data: 'alamat_ahliwaris', name: 'alhiwaris.alamat'},
                    { data: 'nama_meninggal'},
                    { data: 'tempat_meninggal'},
                    { data: 'nik'},
                    { data: 'nama_tpu'},
                    { data: 'blok_makam'},
                    { data: 'retribusi'},
                    { data: 'ambulance'},
                    { data: 'action', name: 'action'},
                ],
            });
        });

        function add() {
            $('#ModalForm').trigger("reset");
            $('#RegistrasiModal').html("Tambah Data");
            $('#registrasi-modal').modal('show');
            $('#id').val('').trigger('change');
            $('#kode_registrasi').val('').trigger('change');
            $("#id_ahliwaris").val('').trigger('change');

        }

        function update(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('registrasi/update') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#RegistrasiModal').html("Ubah Data");
                    $('#registrasi-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kode_registrasi').val(res.kode_registrasi);
                    var $newOption = $("<option selected='selected'></option>").val(res.ahliwaris.id).text(res.ahliwaris.nama)
                    $("#id_ahliwaris").append($newOption).trigger('change');
                    $('#alamat_ahliwaris').val(res.alamat_ahliwaris);
                    $('#nama_meninggal').val(res.nama_meninggal);
                    $('#nik').val(res.nik);
                    $('#agama').find('option[value="' + res.agama + '"]').prop('selected', true);
                    $('#tempat_meninggal').val(res.tempat_meninggal);
                    $('#tanggal_meninggal').val(res.tanggal_meninggal);
                    $('#nama_tpu').find('option[value="' + res.nama_tpu + '"]').prop('selected', true);
                    $('#blok_makam').val(res.blok_makam);
                    $('#retribusi').val(res.retribusi);
                    $('#ambulance').val(res.ambulance);
                }
            });
        }

        function hapus(id) {
            var url = '{{ route('registrasi.hapus') }}';
            var id = id;
            Swal.fire({
                title: "Apakah Anda Yakin ?",
                text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Tetap Hapus!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            "id": id,
                        },
                        success: function(response) {
                            swal.fire({
                                title: 'Hapus Data',
                                text: 'Data Berhasil Dihapus.',
                                icon: 'success',
                                timer: 2000,
                            });
                            $('.table').DataTable().ajax.reload(null, false);
                        }
                    })
                }
            })
        }

        $('#ModalForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('registrasi') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#registrasi-modal").modal('hide');
                    var oTable = $('.table').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    swal.fire({
                        title: 'Berhasil',
                        text: 'Data Berhasil Disimpan.',
                        icon: 'success',
                        timer: 2000,
                    });
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        $.each(value, function(key, val) {
                            Swal.fire({
                                title: 'Error!',
                                text: val,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        })
                    });
                }
            });
        });
    </script>
@endsection
