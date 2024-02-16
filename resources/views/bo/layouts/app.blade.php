<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Back-Office SharkStudio">
        <meta name="keywords" content="Shark STD">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Shark-STD - Back Office</title>

        </style>
        @include("bo.layouts.style")
        @stack("addon-style")
    </head>
    <body>

        {{-- <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div> --}}
        <div class="page-container">
            @include("bo.layouts.navbar")
            @include("bo.layouts.sidebar")
            <div class="page-content">
                @if (session("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session("error") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
              @yield("content")
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    are you sure end this session?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route("bo.login.logout") }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        
        @include("bo.layouts.script")
        @stack("addon-script")
    </body>
</html>