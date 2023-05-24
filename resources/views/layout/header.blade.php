<header class="card">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header-body">
                    <div class="row ">
                        <div class="col">
                            <div class="d-flex justify-content-between flex-wrap">
                                <a class="ml-3 my-1"
                                    href="@if (auth()->user()->role == 'admin') /dashboard @else /employee @endif">
                                    <img src="./assets/images/logo.png" class="logoAdmin" alt="...">
                                    <span class="link-primary logoText">Care in Touch</span>
                                </a>
                                <a href="/" class="my-1">
                                    <img src="./assets/images/ccr.png" class=" mx-auto mr-2" alt="..."
                                        height="20" width="30">
                                    <span class="link-primary logoText mt-2">{{ now()->format('M d Y') }}</span>
                                </a>
                                <div class="mx-5 my-1">
                                    <img src="./assets/images/avator.png" alt="" srcset="">
                                    <span class="username"> {{ auth()->user()->name }} </span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
</header>
