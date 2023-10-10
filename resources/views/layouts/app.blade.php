<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href=”https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css” rel=”stylesheet”
        type=”text/css” />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body >
    <div class=" bg-gray-100 h-100">
        {{-- HEADER --}}
        <div class="header">
            <nav x-data="{ open: false }" class=" " style="background-color: #0D6EFD; height: 150px;">
                <!-- Primary Navigation Menu -->
                <div class="px-5 py-0">
                    <div class="d-flex justify-content-between ">
                        <div class="d-flex">
                            <!-- Logo -->
                            <div class=" " style="padding-top: 40px">
                                <a href="{{ route('home') }}">
                                    <h1 style="color: aliceblue">AI CONTENT</h1>
                                </a>
                            </div>
            
            
                        </div>
            
                        <!-- Settings Dropdown -->
                        <div class="d-flex align-items-center">
                            <div class="dropdown ">
                                <a class="btn btn-primary dropdown-toggle d-flex w-100 gap-1" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>User: </span> <div >{{ Auth::user()->name }}</div>
                                </a>
                              
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <li><a class="dropdown-item" href="\profile"> {{ __('Profile') }}</a></li>
                                  <form method="POST" action="{{ route('logout') }}">
                                    @csrf
        
                                  <li><a 
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();" class="dropdown-item" href="#">  {{ __('Log Out') }}</a></li>
                                </form>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid page-content">
            <div class="row">
                <div class="col-2 sidebar  shadow">
                    <a href="/" id="createPostLink" class="my-button"><i class="fas fa-clipboard fa-lg"></i> Tạo
                        bài viết</a>
                    <a href="/history" id="historyPostLink" class="my-button"><i class="fas fa-history fa-lg"></i>Lịch
                        sử</a>
                    <a href="/setting" id="settingPostLink" class="my-button"><i class="fas fa-cogs fa-lg"></i> Cài đặt
                        liên kết</a>
                </div>

                <!-- Main Content -->
                <div class="col-10 py-5">
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Times New Roman';
        /* font-weight: 700; */
        font-size: 24px;
    }

    .sidebar {
        margin: 0;
        padding: 0;
        max-width: 400px;
        background-color: #F5F5F5;
        min-height: 900px;
        overflow: auto;
    }
    .page-content {
        background-color: #EEEEEE;
    }
    .sidebar a {
        gap: 20px;
        justify-content: center;
        align-items: center;
        height: 150px;
        display: flex;
        flex-direction: column;
        color: black;
        text-decoration: none;
        border-bottom: solid 1px #DDDDDD;
    }

    .sidebar a.active {
        background-color: #E5E5E5;
        color: #2E5EE8;
    }

    .sidebar a:hover:not(.active) {
        background-color: #E5E5E5;
        color: #2E5EE8;
    }
.dropdown-toggle::after{
    content:none;
}
    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
</style>
