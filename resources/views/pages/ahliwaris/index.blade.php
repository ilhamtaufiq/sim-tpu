@extends('layouts.master')

@section('title')
    Data Ahli Waris
@endsection

@section('css')
    <link href="{{ asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Ahli Waris
        @endslot
        @slot('title')
            Data Ahliwaris
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Daftar Ahli Waris</h4>
                        <div class="ms-auto">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <button class="btn btn-primary btn-sm" onClick="add()" href="javascript:void(0)">Tambah
                                        Data
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-toolbar">
                        <div class="d-flex flex-wrap gap-2">

                        </div>
                    </div>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>Nomor Telepon</th>
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
    {{-- Modal Tambah Registrasi --}}
    <div class="modal fade bs-example-modal-lg tambah" id="ahliwaris-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AhliwarisModal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="ModalForm" name="ModalForm" class="needs-validation" novalidate
                        method="POST">
                        <div>
                            <input type="hidden" name="id" id="id">
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Ahli Waris</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Ahli Waris"
                                        name="nama" required>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat"
                                        placeholder="Alamat Ahli Waris" name="alamat" required>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5><i class="mdi mdi-arrow-right text-primary"></i> Data Diri</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">NIK</label>
                                    <input data-inputmask="'alias': 'numeric'" class="form-control input-mask text-start" id="nik" placeholder="NIK"
                                        name="nik" required>
                                    <div class="invalid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nomor Telepon/WhatsApp</label>
                                    <input type="text" class="form-control" id="nomor_telepon"
                                        placeholder="Nomor Telepon" name="nomor_telepon" required>
                                    <div class="valid-feedback">
                                        Benar!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Nomor Telepon/WhatsApp</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="email" name="email" required>
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
                                    <label for="validationCustom04" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir"
                                        placeholder="Tempat Lahir" name="tempat_lahir" required>
                                    <div class="invalid-feedback">
                                        Wajib Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir"
                                        placeholder="Tanggal Lahir" name="tanggal_lahir" required>
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
    <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->

    <script src="{{ asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/nik-parse.js') }}"></script>
    <script src="{{ asset('/assets/libs/inputmask/inputmask.min.js') }}"></script>

    <!-- form mask init -->
    <script src="{{ asset('/assets/js/pages/form-mask.init.js') }}"></script>

    <script>
        // jQuery(document).ready(function() {
        //     jQuery($('#nik')).on('change', function() {
        //         var nik = jQuery(this).val();
        //         nikParse(nik, function(result) {
        //            console.log(result.data.provinsi)
        //         });
        //     })
        // })
    </script>
    <script>
        @if ($message = Session::get('success'))
            Swal.fire({
                title: 'Info',
                text: '{{ $message }}',
                icon: 'success',
            })
        @endif
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        @php
            $i = 1;
        @endphp
        $(document).ready(function() {

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ahliwaris') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    }, // row index
                    {
                        data: 'nama'
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'tempat_lahir'
                    },
                    {
                        data: 'tanggal_lahir'
                    },
                    {
                        data: 'agama'
                    },
                    {
                        data: 'nomor_telepon'
                    },
                    {
                        data: 'action'
                    },
                ],
            });
        });

        function add() {
            $('#ModalForm').trigger("reset");
            $('#AhliwarisModal').html("Tambah Data");
            $('#ahliwaris-modal').modal('show');
            $('#id').val('').trigger('change');

        }

        function update(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('ahliwaris/update') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#AhliwarisModal').html("Ubah Data");
                    $('#ahliwaris-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama').val(res.nama);
                    $('#alamat').val(res.alamat);
                    $('#nik').val(res.nik);
                    $('#nomor_telepon').val(res.nomor_telepon);
                    $('#agama').find('option[value="' + res.agama + '"]').prop('selected', true);
                    $('#tempat_lahir').val(res.tempat_lahir);
                    $('#tanggal_lahir').val(res.tanggal_lahir);
                    $('#nomor_telepon').val(res.nomor_telepon);
                }
            });
        }

        function hapus(id) {
            var url = '{{ route('ahliwaris.hapus') }}';
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
                url: "{{ url('ahliwaris') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#ahliwaris-modal").modal('hide');
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
                    console.log(data);
                }
            });
        });
    </script>
@endsection
