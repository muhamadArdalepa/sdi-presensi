<!DOCTYPE html>
<html lang="en">
@include('template.head')

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    {{-- sidebar --}}
    @include('template.sidebar')
    {{-- end sidebar --}}
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('template.navbar')
        {{-- end navbar --}}

        <!--start container-->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('msg'))
                    <div class="alert alert-success" style="color:white;">
                        {{ session()->get('msg') }}
                        <div style="float: right">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    @if(session()->has('pesan'))
                    <div class="alert alert-success" style="color:white;">
                        {{ session()->get('pesan')}}
                        <div style="float: right">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @foreach($user as $key => $p)
                    <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h6>Absen Manual</h6>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nip" class="form-label">Nama pegawai</label>
                                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                                    <option value="0" selected disabled>-- Pilih Nama Pegawai -- </option>
                                                    @foreach ($user as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nip" class="form-label">NIP</label>
                                                <input required type="number" name="nip" id="nip" value="{{ old('nip') }}"
                                                    class="form-control @error('nip') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nip" class="form-label">Tanggal Absen</label>
                                                <input required type="date" name="tgl_masuk" id="tgl_awal" value="{{ old('tgl_masuk') }}"
                                                    class="form-control @error('tgl_masuk') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>
                                      
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nip" class="form-label">Jam Absen</label>
                                                <input required type="time" name="jam_absen" id="jam_absen" value="{{ old('jam_absen') }}"
                                                    class="form-control @error('jam_absen') is-invalid @enderror" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nip" class="form-label">Keterangan</label>
                                                <textarea required type="text" name="Keterangan" id="Keterangan" value="{{ old('Keterangan') }}"
                                                    class="form-control @error('Keterangan') is-invalid @enderror" autofocus rows="3"> </textarea>
                                            </div>
                                        </div>
                                        <div style="float: right">
                                            <button id="save" type="button" class="btn btn-primary mb-2">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                
            </div>
        </div>
        <!--end container-->
        {{-- footer --}}
        @include('template.footer')
        {{-- end footer --}}
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('template.script')

</body>

</html>
