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
                          <th class="text-secondary opacity-7"></th>
                          <th class="text-secondary opacity-7"></th>
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
                                <p class="
                                    @switch($order['status'])
                                        @case('Đang xử lý') badge bg-danger  @break
                                        @case('Đang giao') badge bg-warning @break
                                        @case('Đã giao') badge-success  @break
                                    @endswitch
                                text-xs font-weight-bold mb-0 ">{{$order['status']}}</p>
                              </td>
                            <td class="align-middle">
                              <a href="javascript:;" class="text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user">
                                <i class="fas fa-edit text-success "></i>
                              </a>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user">
                                  <i class="fas fa-trash text-danger"></i>
                                </a>
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
