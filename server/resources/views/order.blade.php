{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


<div class="g-sidenav-show  bg-gray-100">
    @include("navbar")
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style="overflow-y: auto">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg  shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
          <div class="container">

            <div class="collapse navbar-collapse " id="navbar">
              <div class="  w-100">
                <div class="input-group">
                  <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                  <input type="text" class="form-control shadow-none" placeholder="Type here...">
                </div>
              </div>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h6>Danh sách đơn hàng</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Họ tên</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Địa chỉ</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số điện thoại</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày đặt</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tổng tiền</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0">{{$order['id']}}</p>
                            </td>
                            <td >
                                <p class="text-xs font-weight-bold mb-0 " >{{$order['name']}}</p>
                              </td>
                              <td >
                                <p class="text-xs font-weight-bold mb-0 ">{{$order['address']}}</p>
                              </td>
                              <td >
                                <p class="text-xs font-weight-bold mb-0 ">{{$order['phone']}}</p>
                              </td>
                              <td >
                                <p class="text-xs font-weight-bold mb-0 ">{{$order['datetime']}}</p>
                              </td>
                              <td >
                                <p class="text-xs font-weight-bold mb-0 ">{{number_format($order['amount'], 0, ',', '.')}}</p>
                              </td>
                              <td>
                                <button class="btn
                                    @switch($order['status'])
                                        @case('Chờ xác nhận') bg-secondary text-white @break
                                        @case('Đang xử lý') bg-danger text-white @break
                                        @case('Đang giao') bg-warning text-white @break
                                        @case('Đã giao') bg-success text-white @break
                                        @default bg-light
                                    @endswitch
                                        " data-bs-toggle="modal" data-bs-target="#orderStatusModal-{{$order->id}}">
                                        {{$order['status']}}
                                </button>

                              </td>
                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </main>
    </div>

    @foreach ($orders as $order)
    <div class="modal fade" id="orderStatusModal-{{$order->id}}" tabindex="-1" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderStatusModalLabel">Cập nhật trạng thái đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 text-center">
                        <div class="col-md-3">
                            <div class="status-box bg-secondary text-white p-3 rounded" data-id="{{$order->id}}" data-status='Chờ xác nhận'>Chờ xác nhận</div>
                        </div>
                        <div class="col-md-3">
                            <div class="status-box bg-danger text-white p-3 rounded" data-id="{{$order->id}}" data-status="Đang xử lý">Đang xử lý</div>
                        </div>
                        <div class="col-md-3">
                            <div class="status-box bg-warning text-white p-3 rounded" data-id="{{$order->id}}" data-status="Đang giao">Đang giao</div>
                        </div>
                        <div class="col-md-3">
                            <div class="status-box bg-success text-white p-3 rounded" data-id="{{$order->id}}" data-status="Đã giao">Đã giao</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <script>
        $(document).ready(function() {
            $(".status-box").on("click", function() {
                let orderId = $(this).data("id");
                let newStatus = $(this).data("status");

                $.ajax({
                    url: "/api/order/" + orderId,
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response) {
                        alert("Cập nhật trạng thái thành công!");
                        location.reload(); // Reload lại trang để cập nhật UI
                    },
                    error: function(e) {
                        alert("Có lỗi xảy ra, vui lòng thử lại!");
                    }
                });
            });
        });
    </script>
