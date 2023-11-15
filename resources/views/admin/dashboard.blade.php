@extends('admin.layouts.app')

@section('content')
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-5">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="widget-icon bg-light-dark text-dark mx-auto">
                        <i class="bi bi-basket2-fill"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="text-dark mb-1">4.6K</h3>
                        <p class="text-muted mb-4">Total Orders</p>
                        <p class="text-dark font-13 mb-0"><i class="bi bi-arrow-up"></i><span>45.5%</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="widget-icon bg-light-dark text-dark mx-auto">
                        <i class="bi bi-wallet-fill"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="text-dark mb-1">$25M</h3>
                        <p class="text-muted mb-4">Total Income</p>
                        <p class="text-dark font-13 mb-0"><i class="bi bi-arrow-up"></i><span>24.5%</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="widget-icon bg-light-dark text-dark mx-auto">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="text-dark mb-1">5.6K</h3>
                        <p class="text-muted mb-4">Total Visitors</p>
                        <p class="text-dark font-13 mb-0"><i class="bi bi-arrow-down"></i><span>15.8%</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="widget-icon bg-light-dark text-dark mx-auto">
                        <i class="bi bi-chat-text-fill"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="text-dark mb-1">752</h3>
                        <p class="text-muted mb-4">Total Comments</p>
                        <p class="text-dark font-13 mb-0"><i class="bi bi-arrow-up"></i><span>35.2%</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="widget-icon bg-light-dark text-dark mx-auto">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <div class="mt-3 text-center">
                        <h3 class="text-dark mb-1">42.8%</h3>
                        <p class="text-muted mb-4">Bounce Rate</p>
                        <p class="text-dark font-13 mb-0"><i class="bi bi-arrow-down"></i><span>28.5%</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->



    <div class="row">
        <div class="col-12 col-lg-8 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Statistics</h6>
                        <div class="ms-auto">
                            <div class="d-flex align-items-center font-13 gap-2">
                                <span class="cursor-pointer rounded border px-1"><i
                                        class="bx bxs-circle text-dark me-1"></i>Downloads</span>
                                <span class="cursor-pointer rounded border px-1"><i
                                        class="bx bxs-circle text-dark me-1 opacity-25"></i>Earnings</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4 d-flex">
            <div class="card radius-10 w-100 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Top Categories</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container6">
                        <div class="piechart-legend">
                            <h2 class="mb-1">$85K</h2>
                            <h6 class="mb-0">Total Sales</h6>
                        </div>
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                        Clothing
                        <span class="badge bg-dark rounded-pill">55</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Electronics
                        <span class="badge bg-dark rounded-pill opacity-75">20</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Furniture
                        <span class="badge bg-dark rounded-pill opacity-25">10</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end row-->


    <div class="row">
        <div class="col-12 col-lg-12 col-xl-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Customers</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-3 align-items-center">
                        <div class="col-lg-7 col-xl-7 col-xxl-7">
                            <div class="chart-container5">
                                <div class="piechart-legend">
                                    <h2 class="mb-1">48K</h2>
                                    <h6 class="mb-0">Customers</h6>
                                </div>
                                <canvas id="chart3"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-5 col-xxl-5">
                            <div class="">
                                <div class="d-flex align-items-start mb-3 gap-2">
                                    <div>
                                        <ion-icon name="ellipse-sharp" class="text-dark"></ion-icon>
                                    </div>
                                    <div>
                                        <p class="mb-1">Current Customers</p>
                                        <p class="h5 mb-0">66%</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3 gap-2">
                                    <div>
                                        <ion-icon name="ellipse-sharp" class="text-dark opacity-50"></ion-icon>
                                    </div>
                                    <div>
                                        <p class="mb-1">New Customers</p>
                                        <p class="h5 mb-0">48%</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <ion-icon name="ellipse-sharp" class="text-dark opacity-25"></ion-icon>
                                    </div>
                                    <div>
                                        <p class="mb-1">Retargeted Customers</p>
                                        <p class="h5 mb-0">25%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Sales By Country</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                    aria-label="ellipsis horizontal sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-borderless mb-0 table align-middle">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="country-icon">
                                            <img src="assets/images/icons/india.png" alt="" width="32">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-name h6 mb-0">India</div>
                                    </td>
                                    <td class="w-100">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 82%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="percent-data">82%</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="country-icon">
                                            <img src="assets/images/icons/usa.png" alt="" width="32">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-name h6 mb-0">USA</div>
                                    </td>
                                    <td class="w-100">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 70%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="percent-data">70%</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="country-icon">
                                            <img src="assets/images/icons/china.png" alt="" width="32">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-name h6 mb-0">China</div>
                                    </td>
                                    <td class="w-100">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 60%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="percent-data">60%</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="country-icon">
                                            <img src="assets/images/icons/russia.png" alt="" width="32">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-name h6 mb-0">Russia</div>
                                    </td>
                                    <td class="w-100">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 45%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="percent-data">45%</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="country-icon">
                                            <img src="assets/images/icons/china.png" alt="" width="32">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-name h6 mb-0">China</div>
                                    </td>
                                    <td class="w-100">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 30%;">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="percent-data">30%</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Visitors</h6>
                        <div class="fs-5 dropdown ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="chart5" class=""></div>
                    <div class="d-flex align-items-center justify-content-center radius-10 mt-3 gap-5 border p-2">
                        <div class="text-center">
                            <h3 class="text-dark mb-2">8,546</h3>
                            <p class="mb-0">New Visitors</p>
                        </div>
                        <div class="border-end sepration"></div>
                        <div class="text-center">
                            <h3 class="text-dark mb-2 opacity-50">3,723</h3>
                            <p class="mb-0">Old Visitors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Traffic Source</h6>
                        <div class="fs-5 dropdown ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="chart4" class=""></div>
                    <div class="traffic-widget">
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">Social <span class="float-end">8,475</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 80%;">
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">Direct <span class="float-end">7,989</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 65%;">
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-0">
                            <p class="mb-1">Search <span class="float-end">6,359</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 50%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Sales By Country</h6>
                        <div class="fs-5 dropdown ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="geographic-map" class="mt-2"></div>
                    <div class="traffic-widget">
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">United States <span class="float-end">$2.5K</span></p>
                            <div class="progress rounded-0" style="height: 6px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 75%;">
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">Russia <span class="float-end">$4.5K</span></p>
                            <div class="progress rounded-0" style="height: 6px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 55%;">
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-0">
                            <p class="mb-1">Australia <span class="float-end">$8.5K</span></p>
                            <div class="progress rounded-0" style="height: 6px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 80%;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!--end row-->


    <div class="row">
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100 bg-transparent shadow-none">
                <div class="card-body p-0">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="widget-icon radius-10 bg-dark text-white">
                                    <ion-icon name="wallet-sharp" role="img" class="md hydrated"
                                        aria-label="wallet sharp">
                                    </ion-icon>
                                </div>
                                <div class="fs-5 ms-auto">
                                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                        aria-label="ellipsis horizontal sharp"></ion-icon>
                                </div>
                            </div>
                            <h4 class="my-3">$4,580</h4>
                            <div class="progress mt-1" style="height: 5px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 65%">
                                </div>
                            </div>
                            <p class="mb-0 mt-2">Earned This Month <span class="float-end">+2.4%</span>
                            </p>
                        </div>
                    </div>
                    <div class="card radius-10 mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="widget-icon-2 bg-dark text-white">
                                    <ion-icon name="people-sharp" role="img" class="md hydrated"
                                        aria-label="people sharp">
                                    </ion-icon>
                                </div>
                                <div class="fs-5 ms-auto">
                                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                        aria-label="ellipsis horizontal sharp"></ion-icon>
                                </div>
                            </div>
                            <h4 class="my-3">8,126</h4>
                            <div class="progress mt-1" style="height: 5px;">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: 65%">
                                </div>
                            </div>
                            <p class="mb-0 mt-2">New Clients <span class="float-end">+5.3%</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">User Activity</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container3">
                        <canvas id="chart6"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100 bg-transparent shadow-none">
                <div class="card-body p-0">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <p class="mb-2">Total Session</p>
                                    <h4 class="mb-0">15,690 <span class="font-13 text-success ms-1">+36%</span></h4>
                                </div>
                                <div class="fs-5">
                                    <ion-icon name="ellipsis-vertical-sharp"></ion-icon>
                                </div>
                            </div>
                            <div class="mt-3" id="chart7"></div>
                        </div>
                    </div>
                    <div class="card radius-10 mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <p class="mb-2">Page Views</p>
                                    <h4 class="mb-0">28,963 <span class="font-13 text-danger ms-1">-4.5%</span></h4>
                                </div>
                                <div class="fs-5">
                                    <ion-icon name="ellipsis-vertical-sharp"></ion-icon>
                                </div>
                            </div>
                            <div class="mt-3" id="chart8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->


    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Recent Orders</h6>
                <div class="fs-5 dropdown ms-auto">
                    <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="mb-0 table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#89742</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Smart Mobile Phone</h6>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td>$214</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 8, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#68570</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Sports Time Watch</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$185</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 9, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#38567</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Women Red Heals</h6>
                                    </div>
                                </div>
                            </td>
                            <td>3</td>
                            <td>$356</td>
                            <td><span class="badge alert-dark">Cancelled</span></td>
                            <td>Apr 10, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#48572</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Yellow Winter Jacket</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$149</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 11, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#96857</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Orange Micro Headphone</h6>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td>$199</td>
                            <td><span class="badge alert-dark">Cancelled</span></td>
                            <td>Apr 15, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#96857</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Pro Samsung Laptop</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$699</td>
                            <td><span class="badge alert-dark">Pending</span></td>
                            <td>Apr 18, 2021</td>
                            <td>
                                <div class="d-flex align-items-center fs-6 gap-3">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
