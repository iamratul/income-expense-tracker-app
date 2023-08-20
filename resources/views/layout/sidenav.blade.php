<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Income and Expense Tracker</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar fixed-top px-0 shadow-sm bg-white">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <img class="nav-logo-sm mx-2" src="{{ asset('images/menu.svg') }}" alt="logo" />
                </span>
                <img class="nav-logo  mx-2" src="{{ asset('images/logo.png') }}" alt="logo" />
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" id="NavUserImage" src="" alt="" />
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" id="userImage" src="" alt="" />
                            <h6 id="userName"></h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/user-profile-page') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Profile</span>
                        </a>
                        <a href="{{ url('/logout') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div id="sideNavRef" class="side-nav-open shadow">
        <a href="{{ url('/dashboard') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Dashboard</span>
        </a>

        <a href="{{ url('/income-category') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Income Category</span>
        </a>

        <a href="{{ url('/income') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Income</span>
        </a>

        <a href="{{ url('/expense-category') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Expense Category</span>
        </a>

        <a href="{{ url('/expense') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption">Expense</span>
        </a>
    </div>

    <div id="contentRef" class="content">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        function MenuBarClickHandler()
        {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }

        getProfile();
        async function getProfile() {
            showLoader();
            let res = await axios.get("/user-profile");
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                let data = res.data['data'];
                document.getElementById('userName').innerHTML = data['name'];
                document.getElementById('NavUserImage').src = data['image'];
                document.getElementById('userImage').src = data['image'];
            } else {
                errorToast(res.data['message']);
            }
        }
    </script>

</body>

</html>
