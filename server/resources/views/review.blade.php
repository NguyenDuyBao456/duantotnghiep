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
                  <h6>Danh sách đánh giá</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID người dùng</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID sản phẩm</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nội dung</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số sao</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thời gian</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($preview as $item)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['MaDG']}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['id_user']}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['id_product']}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['content']}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['Rating']}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$item['updated_at']}}</p>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user">
                                      <i class="fas fa-trash text-danger" data-id="{{$item['MaDG']}}"></i>
                                    </a>
                                  </td>
                              </tr>
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
    $(document).ready(() =>{
        $(".fa-trash").on("click", function(){
            Swal.fire({
                text: "Bạn có chắc muốn xóa không?",
                allowOutsideClick: false,
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Hủy'
            }).then(result =>{
                if(result.isConfirmed) {
                    const id = $(this).data("id");
                    $.ajax({
                        type: "DELETE",
                        url: "/api/preview/" + id,
                        success: function (response) {
                            Swal.fire({
                                text: "Xóa thành công",
                                icon: "success",
                                allowOutsideClick: false,
                            }).then(result =>{
                                if(result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    });
                }
            })



        })
    })
</script>
