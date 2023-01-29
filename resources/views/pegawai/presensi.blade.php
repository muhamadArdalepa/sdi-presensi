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
        <div class="container">
            <form method="POST" action="
            @if(!isset($presensi))
            {{ route('presensi.masuk')}}
            @else
            {{ route('presensi.pulang',$presensi->id)}}
            @endif
            ">
                @csrf
                <div class="p-5 bg-white rounded-3">

                    <div class="clock-container d-flex justify-content-center">
                        <h5 class="font-weight-bolder me-3">

                            @if(!isset($presensi))
                            Absen Masuk
                            @else
                            @if(!isset(($presensi->jam_pulang)))
                            Absen Keluar
                            @else
                            Kamu Sudah Absen Hari Ini
                            @endif
                            @endif
                        </h5>

                        <h5 class="font-weight-bolder me-3">
                            <?php echo date("Y-m-d"); ?>
                        </h5>
                        <h5 class="font-weight-bolder" id="clock" onload="currentTime()"></h5>
                    </div>

                    @if(!isset(($presensi->jam_pulang)))

                    @if(isset($presensi)){{ method_field('PUT') }}@endif
                    <input type="hidden" name="image" class="image-tag">
                    <div class="text-center">
                        <div id="my_camera" class="bg-secondary mb-3 d-inline-block" style="height:300px; width: 400px">
                        </div>
                        <br />
                        <div class="d-inline-flex justify-content-between align-items-center col-md-6">
                            <div class="">

                                <button class="btn btn-primary" type=button onClick="startCamera(this)">Start
                                    Camera</button>
                                <button id="btn-presensi" class="btn btn-success">Presensi</button>
                            </div>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="izin" name="izin" id="izin">
                                <label class="form-check-label" for="izin">
                                    Izin
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
            @endif


        </div>
        <!--end container-->
        {{-- footer --}}
        @include('template.footer')
        {{-- end footer --}}
    </main>
    <!--   Core JS Files   -->
    @include('template.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script language="JavaScript">
        $('#btn-presensi').hide();

        function currentTime() {
            let date = new Date();
            let hh = date.getHours();
            let mm = date.getMinutes();
            let ss = date.getSeconds();
            let session = "AM";
    
            if (hh == 0) {
                hh = 12;
            }
            if (hh > 12) {
                hh = hh - 12;
                session = "PM";
            }
    
            hh = (hh < 10) ? "0" + hh : hh;
            mm = (mm < 10) ? "0" + mm : mm;
            ss = (ss < 10) ? "0" + ss : ss;
    
            let time = hh + ":" + mm + ":" + ss + " " + session;
    
            document.getElementById("clock").innerText = time;
            let t = setTimeout(function () {
                currentTime()
            }, 1000);
        }
        currentTime();
    
        function startCamera(btn) {
            Webcam.set({
            width: 400,
            height: 300,
            image_format: 'jpeg',
            jpeg_quality: 50
            });
    
            Webcam.attach( '#my_camera' );
            btn.setAttribute('onclick','take_snapshot(this)');
            btn.innerHTML = 'Take Picture';
            $('#btn-presensi').hide();
        }
        
        function take_snapshot(btn) {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'" />';
            } );
            btn.setAttribute('onclick','startCamera(this)');
            btn.innerHTML = 'Retake'
            $('#btn-presensi').show();
        }

        
    </script>
</body>

</html>