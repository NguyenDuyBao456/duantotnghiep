
<div class="g-sidenav-show  bg-gray-100">
@include('navbar')

<main class="main-content border-radius-lg max-height-vh-100" style="overflow-y: auto">
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12 ">
              <div class="card bg-primary">
                <span class="mask  opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8">
                      <div class=" icon-shape bg-white shadow text-center border-radius-2xl">
                        <svg width="20px" height="20px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>product</title>
                            <g stroke="none" stroke-width="2" fill="none" fill-rule="evenodd">
                                <g fill="#F97316" fill-rule="nonzero">
                                    <!-- Phần nắp hộp -->
                                    <polygon points="6,14 21,4 36,14 21,24"></polygon>
                                    <!-- Phần thân hộp -->
                                    <polygon points="6,14 6,32 21,40 21,24"></polygon>
                                    <polygon points="36,14 36,32 21,40 21,24"></polygon>
                                </g>
                            </g>
                        </svg>

                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        {{$products->count()}}
                      </h5>
                      <span class="text-white text-sm">Sản phẩm</span>
                    </div>
                    <div class="col-4">
                      <div class="dropdown text-end mb-6">
                        <a href="javascript:;" class="cursor-pointer" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-h text-white"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers1">
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card bg-primary">
                <span class="mask  opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class=" icon-shape bg-white shadow text-center border-radius-2xl">
                        <svg width="20px" height="2020px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>category</title>
                            <g stroke="none" stroke-width="2" fill="none" fill-rule="evenodd">
                                <g fill="#F97316" fill-rule="nonzero">
                                    <!-- Dòng danh mục 1 -->
                                    <rect x="6" y="10" width="30" height="4" rx="2"></rect>
                                    <!-- Dòng danh mục 2 -->
                                    <rect x="6" y="20" width="30" height="4" rx="2"></rect>
                                    <!-- Dòng danh mục 3 -->
                                    <rect x="6" y="30" width="30" height="4" rx="2"></rect>
                                </g>
                            </g>
                        </svg>

                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        {{$categories->count()}}
                      </h5>
                      <span class="text-white text-sm">Danh mục</span>
                    </div>
                    <div class="col-4">
                      <div class="dropstart text-end mb-6">
                        <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-h text-white"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers2">
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card bg-primary">
                <span class="mask opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class=" icon-shape bg-white shadow text-center border-radius-2xl">
                        <svg width="20px" height="20px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>user</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g fill="#F97316" fill-rule="nonzero">
                                    <!-- Đầu người -->
                                    <circle cx="21" cy="13" r="10"></circle>
                                    <!-- Vai và thân người dạng solid -->
                                    <path d="M10,36 C10,28 16,22 21,22 C26,22 32,28 32,36 L10,36 Z"></path>
                                </g>
                            </g>
                        </svg>


                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        {{$users->count()}}
                      </h5>
                      <span class="text-white text-sm">Người dùng</span>
                    </div>
                    <div class="col-4">
                      <div class="dropdown text-end mb-6">
                        <a href="javascript:;" class="cursor-pointer" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-h text-white"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers3">
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class=" icon-shape bg-white shadow text-center border-radius-2xl">
                        <svg width="20px" height="20px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>order</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g fill="#F97316" fill-rule="nonzero">
                                    <!-- Khung hóa đơn -->
                                    <path d="M6,4 C6,2.9 6.9,2 8,2 L34,2 C35.1,2 36,2.9 36,4 L36,38 C36,38.6 35.4,39 34.8,38.8 L30,37 L25.2,38.8 C24.8,39 24.2,39 23.8,38.8 L19,37 L14.2,38.8 C13.8,39 13.2,39 12.8,38.8 L8,37 L7,37 C6.4,37 6,36.6 6,36 L6,4 Z"></path>
                                    <!-- Dòng tiêu đề -->
                                    <rect x="10" y="10" width="22" height="3" rx="1"></rect>
                                    <!-- Dòng nội dung -->
                                    <rect x="10" y="16" width="18" height="3" rx="1"></rect>
                                    <rect x="10" y="22" width="18" height="3" rx="1"></rect>
                                    <rect x="10" y="28" width="10" height="3" rx="1"></rect>
                                    <!-- Biểu tượng check (✔) để thể hiện đơn hàng hoàn tất -->
                                    <path d="M30 18 L26 24 L24 22" stroke="#FFFFFF" stroke-width="2" fill="none"></path>
                                </g>
                            </g>
                        </svg>

                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        {{$orders->count()}}
                      </h5>
                      <span class="text-white text-sm">Đơn hàng</span>
                    </div>
                    <div class="col-4">
                      <div class="dropstart text-end mb-6">
                        <a href="javascript:;" class="cursor-pointer" id="dropdownUsers4" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-h text-white"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers4">
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12 mt-4 mt-lg-0 bg-white">
            <canvas id="orderByDay"></canvas>
        </div>
      </div>
      <div class="d-flex gap-3 my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4 bg-white">
            <canvas id="orderByMonth"></canvas>
        </div>
        <div class="col-lg-4 col-md-6 bg-white">
            <canvas id="orderStatus"></canvas>
        </div>
      </div>
  </main>
</div>


<script>
    $(document).ready(() =>{
        $.ajax({
            type: "GET",
            url: "/api/order",
            success: function (response) {
                const orders = response.map(item => item.order)
                const status = ['Chờ xác nhận','Đang xử lý', 'Đang giao', 'Đã giao']

                const orderByDay =  Array.from({length: 31}).map((_, index) =>{
                    return orders.filter(item => {
                        const day = +item.datetime.split("/")[0]
                        return day === index + 1
                    }).length
                })

                const orderByMonth = Array.from({length: 12}).map((_,index) =>{
                    return orders.filter(item => {
                        const month = +item.datetime.split("/")[1]
                        return month === index + 1
                    }).length
                })

                const orderStatus = status.map(item =>{
                    return orders.filter(ord => ord.status === item).length
                })



                var ctxOrderByDay = document.getElementById('orderByDay').getContext('2d');
                var ctxOrderByMonth = document.getElementById('orderByMonth').getContext('2d');
                var ctxOrderStatus = document.getElementById('orderStatus').getContext('2d')

                new Chart(ctxOrderByDay, {
                    type: 'line', // Loại biểu đồ (cột)
                    data: {
                        labels: Array.from({length: 31}).map((_, index) => index + 1),
                        datasets: [{
                            label: 'Số lượng đơn hàng',
                            data: orderByDay, // Dữ liệu cho các cột
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền cho các cột
                            borderColor: 'rgba(54, 162, 235, 1)', // Màu viền cho các cột
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true, // Đảm bảo trục y bắt đầu từ 0
                                ticks: {
                                    stepSize: 1, // Bước nhảy là 1
                                },
                            },
                        }
                    }
                });


                new Chart(ctxOrderByMonth, {
                    type: 'bar', // Loại biểu đồ (cột)
                    data: {
                        labels: Array.from({length: 12}).map((_, index) => `Tháng ${index + 1}`),
                        datasets: [{
                            label: 'Số lượng đơn hàng',
                            data: orderByMonth, // Dữ liệu cho các cột
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền cho các cột
                            borderColor: 'rgba(54, 162, 235, 1)', // Màu viền cho các cột
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true, // Đảm bảo trục y bắt đầu từ 0
                                ticks: {
                                    stepSize: 1, // Bước nhảy là 1
                                },
                            },
                        }
                    }
                });

                new Chart(ctxOrderStatus, {
                    type: 'pie',
                    data: {
                        labels: status,
                        datasets: [{
                            data: orderStatus,

                            backgroundColor: [
                                'secondary',
                                'red',
                                'gold',
                                'green'
                            ],
                            hoverOffset: 4

                        }]
                    },
                })
            }
        });


    })
</script>
