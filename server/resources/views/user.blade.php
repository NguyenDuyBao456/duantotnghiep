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
                  <h6>Danh sách người dùng</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên người dùng</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                          <th class="text-secondary opacity-7"></th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0">{{$user['id']}}</p>
                              {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
                            </td>
                            <td >
                                <p class="text-xs font-weight-bold mb-0 " >{{$user['name']}}</p>
                                {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
                              </td>
                              <td >
                                <p class="text-xs font-weight-bold mb-0 ">{{$user['email']}}</p>
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
