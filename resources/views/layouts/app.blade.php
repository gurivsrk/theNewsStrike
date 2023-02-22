<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ getImageById(siteInfo('favicon')) }}">
    <link rel="icon" type="image/png" href="{{ getImageById(siteInfo('favicon')) }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        {{siteinfo('website_title') .' - '. @$class}}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('paper/css/dropzone.css')}}" type="text/css" />

    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    {{-- {{ HTML::style('css/basic.css');}} --}}
    @stack('css')
    <!-- Custom Code Head-->
    {{customCode('head')}}
    <!--End Custom Code Head-->
</head>

<body class="{{ @$class }}">

    @auth()
        @include('layouts.page_templates.auth')
        <div id="selectMediaModel">
            <div id="select-Media-Model-body" class="position-relative">
                <div class="close" onclick="closeModel('selectMediaModel')" >X</div>
            </div>
            <div id="showImageAjax"></div>
        </div>
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

    <script src="{{asset('paper')}}/js/plugins/dropzone5.js"></script>

    <script src="{{ asset('paper') }}/js/custom.js"></script>

    {{-- <x-alert type="danger" message="test"/> --}}

    <script>
        ajaxSearch()

        Dropzone.options.dropZoneFileUpload = {
        url: '{{route("gallery.store")}}',
        maxFilesize: 20, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        paramName: 'dropZoneImage',
        success: function (file, response) {
            $('.dz-preview.dz-image-preview').remove();
            $('.dz-message').show();
            $('#media').html(response);
            $('#add-media').text('Add Media')
            $('#uploadMedia').slideUp();
            $('#showImageAjax .showModel').on('click',function(){
                for(let check of document.getElementsByClassName('media-checkbox')){
                    check.checked = false;
                    check.disabled = true;
                }

                let boxId = $(this).attr('for')
                document.getElementById(boxId).disabled = false;
            })
        },
        error: function (file, response) {
            console.log(response)
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = response.message)
            }

            return _results
        }
        };

        function ajaxSearch(){
            if(document.getElementById('ajaxSearch')){
                const search = document.getElementById('ajaxSearch');
                const  dataFor = search.getAttribute('data-for'),
                hideDiv = search.getAttribute('data-hide');

                search.addEventListener('keyup',function(){
                    const $this = this;

                        ajaxCall(
                            '{{route("process.ajaxRequest")}}',
                            {'search':$this.value,dataFor},
                            (response)=>{
                                document.getElementById(hideDiv).innerHTML = response
                            },
                            (err)=>{
                                console.error(err.responseJSON.message)
                            }
                        )
                    })
            }
        }


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
