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

            <div class="clock-container d-flex ">
                <h5>{{}}</h5>
                <h5 class="font-weight-bolder me-3 text-white">
                    <?php echo date("Y-m-d"); ?>
                </h5>
                <h5 class="font-weight-bolder text-white" id="clock" onload="currentTime()"></h5>
            </div>
            <form method="POST" action="{{ route('presensi.store') }}">
                @csrf
                <div class="col-md-12">
                    <div id="my_camera" class="bg-secondary mb-3" style="width:400px; height:300px; "></div>
                    <button class="btn btn-primary" type=button onClick="startCamera(this)">Start
                        Camera</button>
                    <button class="btn btn-success">Presensi</button>
                    <input type="hidden" name="image" class="image-tag">
                </div>

            </form>
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
        }
        
        function take_snapshot(btn) {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'" />';
            } );
            btn.setAttribute('onclick','startCamera(this)');
            btn.innerHTML = 'Retake'
        }

        
    </script>
</body>

</html>