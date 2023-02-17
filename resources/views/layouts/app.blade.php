<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Extra details for Live View on GitHub Pages -->

    <title>
        {{ __('Paper Dashboard by Creative Tim') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/custom.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    {{-- {{ HTML::style('css/basic.css');}} --}}
</head>

<body class="{{ @$class }}">

    @auth()
        @include('layouts.page_templates.auth')
    @endauth

    @guest
        @include('layouts.page_templates.guest')
    @endguest

    <!--   Core JS Files   -->
    <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    {{-- <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Chart JS -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script src="{{ asset('paper') }}/js/custom.js"></script>


    {{-- <x-alert type="danger" message="test"/> --}}

    <script>
       const search = document.getElementById('ajaxSearch'),
       dataFor = search.getAttribute('data-for'),
       hideDiv = search.getAttribute('data-hide');

        search.addEventListener('keyup',function(){
            const $this = this;

                ajaxCall(
                    '{{route("process.ajaxRequest")}}',
                    {'search':$this.value,dataFor},
                    (response)=>{
                        document.getElementById(hideDiv).style.display = "none"
                        $('#ajaxResult').show().html(response)
                    },
                    (err)=>{
                        console.error(err.responseJSON.message)
                    }
                )

        })

        function ajaxCall(url,data,successCallBack,errorCallBack,beforeCallBack){
            $.ajax({
                    type: 'post',
                    url:url,
                    headers:{
                        'X-CSRF-TOKEN' : '{{csrf_token()}}'
                    },
                    data : data,
                    beforeSend: ()=>{
                        typeof(beforeCallBack) == 'function' ? beforeCallBack() :'';
                    },
                    success: (response)=>{
                        successCallBack(response)
                    },
                    error: (err)=>{
                        errorCallBack(err)
                    }
                })
        }
    </script>


    @stack('scripts')
</body>

</html>
