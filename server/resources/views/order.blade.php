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
                                <button  class="btn btnStatus
                                    @switch($order['status'])
                                        @case('Chờ xác nhận') bg-secondary text-white @break
                                        @case('Đang xử lý') bg-danger text-white @break
                                        @case('Đang giao') bg-warning text-white @break
                                        @case('Đã giao') bg-success text-white @break
                                        @default bg-light
                                    @endswitch
                                        "  data-id='{{$order['id']}}'>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
    const status = [
        'Chờ xác nhận', 'Đang xử lý', 'Đang giao', 'Đã giao'
    ];

    $('.btnStatus').on('click', function () {
        const currentText = $(this).text().trim();
        const currentIndex = status.indexOf(currentText);
        const nextStatus = status[currentIndex + 1];
        const orderId = $(this).data('id');


        if(currentIndex + 1 === status.length) {
            return
        }

        Swal.fire({
            text: `Bạn có chắc muốn đổi trạng thái đơn hàng không?`,
            allowOutsideClick: false,
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "PUT",
                    url: "/api/order/" + orderId,
                    data: {
                        _token: "{{ csrf_token() }}", // Chỉ dùng được trong file blade
                        status: nextStatus
                    },
                    success: function (response) {
                        Swal.fire({
                            text: 'Cập nhật trạng thái đơn hàng thành công',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            text: 'Có lỗi xảy ra khi cập nhật',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});


</script>



