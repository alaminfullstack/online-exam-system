<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    <meta name="robots" content="index, follow">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:site_name" content="BD nursing academy">
    <meta property="og:description" content="@yield('description')">

    <meta property="og:type" content="website|course|education|exam|Tution|Study">
    <meta property="og:author" content="alamingemamin@gmail.com">
    <meta property="og:url" content="">
    <meta property="og:image" content="@yield('image')">

    <link rel="shortcut icon" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicon.png') }}">

    @stack('css')
    <link rel="stylesheet" id="css-main" href="{{ asset('assets') }}/css/dashmix.min.css">
    <link href='http://mdminhazulhaque.github.io/solaimanlipi/css/solaimanlipi.css' rel='stylesheet' type='text/css'>

    <style>
        * {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        body {
            font-family: 'Merriweather', 'SolaimanLipi', sans-serif;
        }

        #page-footer {
            position: fixed;
            bottom: 0;
        }
    </style>

    @stack('style')

</head>

<body>
    <div id="page-container" class="enable-page-overlay side-scroll  page-header-fixed main-content-boxed">
        @auth
            <aside id="side-overlay">
                <div class="bg-primary">
                    <div class="content-header">
                        <a class="img-link me-1" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32 img-avatar-thumb"
                                src="{{ asset('assets') }}/media/category.png" alt="">
                        </a>
                        <div class="ms-2">
                            <a class="text-white fw-semibold" href="javascript:void(0)">
                                {{ auth()->user()->name ?? 'guest' }}
                            </a>
                        </div>
                        <a class="ms-auto text-white" href="javascript:void(0)" data-toggle="layout"
                            data-action="side_overlay_close">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name">Home</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.exams.index') }}">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name">Exams</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.examiners.index') }}">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name">Examiners</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.banners.index') }}">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name">Banners</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('admin.logout') }}">
                                <i class="nav-main-link-icon fa fa-home"></i>
                                <span class="nav-main-link-name">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <header id="page-header">
                <div class="content-header">
                    <div>
                        <a class="fw-semibold text-dual tracking-wide" href="/">
                            <img src="{{ asset('assets/media/logo.png') }}" style="width: 100%; height: 50px;" />
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="layout"
                            data-action="side_overlay_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                </div>

                <div id="page-header-loader" class="overlay-header bg-header-dark">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-2x fa-sun fa-spin"></i>
                        </div>
                    </div>
                </div>
            </header>

        @endauth

        <main id="main-container">
            <div class="content pb-5 pt-3 px-0">
                <div class="container">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <p class="mb-0">{{ session()->get('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <p class="mb-0">{{ session()->get('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                @yield('content')

                <div class="container">
                    <div class="row fs-sm pt-3">
                        <div class="col-12 text-center">
                            <div>
                                Copyright &copy; 2022 - {{ now()->format('Y') }}
                                <a class="fw-semibold" href="/">
                                    BD Nursing Academy
                                </a>

                                All Rights Reserved. &nbsp; &nbsp; &nbsp;
                                <!--<" Develop By "> &nbsp;-->
                                <!--<a class="fw-semibold" target="_blank" href="https://itgeliyor.com">-->
                                <!--    Itgeliyor-->
                                <!--</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap-notify.min.js"></script>

    @stack('js')


    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        $('body').bind('cut copy', function(e) {
            e.preventDefault();
        });

        // submit form script 
        $(document).on('submit', '.submit-form', function(e) {
            e.preventDefault();
            let self = $(this);
            let url = self.attr('action');
            let data = self.serializeArray();
            let old_text = self.find('button[type="submit"]').text();
            self.find('button[type="submit"]').html('<i class="fa fa-sync fa-spin"></i>');
            self.find('button[type="submit"]').attr("disabled");

            let options = {
                // available options: 
                beforeSubmit: showRequest, // pre-submit callback 
                url: url, // override for form's 'action' attribute 
                type: 'post', // 'get' or 'post', override for form's 'method' attribute 
                dataType: 'json', // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                // resetForm: true,        // reset the form after successful submit 
                success: function(response) {
                    get_notify(response)
                    self.find('button[type="submit"]').text(old_text);
                },
                error: function(response) {
                    console.log(response)
                    get_notify(response)
                    self.find('button[type="submit"]').text(old_text);
                },
                statusCode: {
                    404: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Page or Url Not Found!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    500: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Internal Server Error!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    419: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Csrf Token mismatch!!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },
                    405: function() {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'Bad Method Call!!'
                        });
                        self.find('button[type="submit"]').text(old_text);
                    },

                }
            };

            // inside event callbacks 'this' is the DOM element so we first 
            // wrap it in a jQuery object and then invoke ajaxSubmit 
            $(this).ajaxSubmit(options);

            // !!! Important !!! 
            // always return false to prevent standard browser submit and page navigation 
            return false;
        });

        function showRequest(formData, jqForm, options) {
            // formData is an array; here we use $.param to convert it to a string to display it 
            // but the form plugin does this for you automatically when it submits the data 
            var queryString = $.param(formData);

            // jqForm is a jQuery object encapsulating the form element.  To access the 
            // DOM element for the form do this: 
            // var formElement = jqForm[0]; 

            // here we could return false to prevent the form from being submitted; 
            // returning anything other than false will allow the form submit to continue 
            return true;
        }



        // get notification script 
        function get_notify(response) {

            if (response.errors) {
                response.errors.forEach(error => {
                    Dashmix.helpers('jq-notify', {
                        type: 'danger',
                        icon: 'fa fa-info me-1',
                        message: error + ' !'
                    });
                });
            }


            if (response.error) {
                Dashmix.helpers('jq-notify', {
                    type: 'danger',
                    icon: 'fa fa-times me-1',
                    message: response.error + ' !'
                });
            }


            if (response.success) {
                Dashmix.helpers('jq-notify', {
                    type: 'success',
                    icon: 'fa fa-check me-1',
                    message: response.success + ' !'
                });

                if (typeof table !== 'undefined') {
                    table.ajax.reload();
                }

                $('.view-modal').modal('hide');
                $('.modal-backdrop').hide();
                $('body').css({
                    'overflow': 'auto',
                    'padding-right': '0'
                });
            }
        }
    </script>

    @stack('script')

</body>

</html>
