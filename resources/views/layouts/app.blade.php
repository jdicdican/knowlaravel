<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/open-iconic.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <div class="container">
            @include('layouts.navbar')
            @yield('content')
        </div>
        
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script language='javascript'>
        $(function(){
            $('#paginator').bind('change', function () {
                var url = window.location.pathname+'?items_per_page='+$('#paginator').val()+
                                                   '&sort_by='+$('#sort_by').val();
                if (url) {
                    window.location = url; 
                }
                return false;
            });

            $('#sort_by').bind('change', function () {
                var url = window.location.pathname+'?items_per_page='+$('#paginator').val()+
                                                   '&sort_by='+$('#sort_by').val();
                if (url) {
                    window.location = url; 
                }
                return false;
            });

            $('#submit-comment').bind('click', function () {
                $.post('{{ route('comment-article') }}', { '_token': '{{ csrf_token() }}', 'article_id': $('#article_id').val(), 'comment': $('#comment').val() })
                    .done(function() {
                        location.reload();
                    })
                    .fail(function() {
                        alert('An error occured when trying to comment.')
                    });
                return false;
            });

            $('#submit-like').bind('click', function () {
                $.post('{{ route('like-article') }}', { '_token': '{{ csrf_token() }}', 'article_id': $('#article_id').val()})
                    .done(function() {
                        location.reload();
                    })
                    .fail(function() {
                        alert('An error occured when trying to like.')
                    });
                return false;
            });

            $('#save').bind('click', function() {
                $.post('{{ route('save-article') }}', { _token: '{{ csrf_token() }}',
                                                        article_id: $('#article_id').val(),
                                                        title: $('#title').val(),
                                                        body: $('#body').val(),
                                                        is_draft: $('#is_draft').prop('checked') ? 1 : 0 })
                    .done(function(data) {
                        window.location = JSON.parse(data).redirect;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown ) {
                        alert(textStatus);
                    });
                return false;
            });

            $('#delete').bind('click', function() {
                $.post('{{ route('delete-article') }}', { _token: '{{ csrf_token() }}',
                                                          article_id: $('#article_id').val() })
                    .done(function(data) {
                        window.location = '{{ route('published') }}';
                    })
                    .fail(function(jqXHR, textStatus, errorThrown ) {
                        alert(textStatus);
                    });
                return false;
            });
        });
    </script>
</body>
</html>
