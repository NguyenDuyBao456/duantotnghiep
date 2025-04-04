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
              <h6>Danh sách sản phẩm</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden">
                <table class="table align-items-center mb-0" >
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="/img/{{$product['img']}}" class="avatar avatar-sm me-3" alt="user6">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{$product['name']}}</h6>
                              {{-- <p class="text-xs text-secondary mb-0">{{$product['name']}}</p> --}}
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{number_format($product['price'],0,",",".")}}</p>
                          {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
                        </td>
                        <td >
                            <p class="text-xs font-weight-bold mb-0 text-wrap" style="width: 350px">{{$product['description']}}</p>
                            {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
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
