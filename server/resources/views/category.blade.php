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
                  <input type="text" class="form-control shadow-none" placeholder="Tìm kiếm...">
                </div>
              </div>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Thêm sản phẩm</button>

          <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h6>Danh sách danh mục</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th> --}}
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  ps-2">Tên</th>
                          <th class="text-secondary opacity-7"></th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            {{-- <th>
                              <p class="text-xs font-weight-bold mb-0">{{$category['id']}}</p>
                            </th> --}}
                            <td >
                                <p class="text-xs font-weight-bold mb-0 " style="width: 400px">{{$category['name']}}</p>
                              </td>

                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold btn-edit"
                                    data-id="{{ $category['id'] }}"
                                    data-name="{{ $category['name'] }}"
                                    data-parent="">
                                    <i class="fas fa-edit text-success"></i>
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user">
                                  <i data-id="{{ $category['id'] }}"
                                  data-name="{{ $category['name'] }}"
                                  data-parent="" class="fas fa-trash text-danger"></i>
                                </a>
                              </td>
                          </tr>
                        @endforeach

                        @foreach ($subcategory as $subcate)
                        <tr>
                            {{-- <th>
                              <p class="text-xs font-weight-bold mb-0">{{$subcate['id']}}</p>
                            </th> --}}
                            <td >
                                <p class="text-xs font-weight-bold mb-0 " style="width: 400px">{{$subcate['name']}}</p>
                              </td>

                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold btn-edit"
                                    data-id="{{ $subcate['id'] }}"
                                    data-name="{{ $subcate['name'] }}"
                                    data-parent="{{ $subcate['categories_id'] }}">
                                    <i class="fas fa-edit text-success"></i>
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="text-secondary font-weight-bold " data-toggle="tooltip" data-original-title="Edit user">
                                  <i data-id="{{ $subcate['id'] }}"
                                  data-name="{{ $subcate['name'] }}"
                                  data-parent="{{ $subcate['categories_id'] }}" class="fas fa-trash text-danger"></i>
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



<!-- Modal Thêm Danh Mục -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addCategoryForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category-name" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="category-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category-type" class="form-label">Loại</label>
                        <select name="type" id="category-type" class="form-control" required>
                            <option value="">Chọn danh mục</option>
                            <option value="parent">Danh mục chính</option>
                            <option value="child">Danh mục con</option>
                        </select>
                    </div>
                    <div class="mb-3" id="parent-category-group" style="display: none;">
                        <label for="parent-category" class="form-label">Chọn danh mục cha</label>
                        <select name="categories_id" id="parent-category" class="form-control">
                            <option value="">-- Chọn --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal Sửa Danh Mục -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editCategoryForm" method="POST">
            @csrf
            <input type="hidden" name="id" id="edit-category-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Sửa danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-category-name" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="edit-category-name" name="name" required>
                    </div>
                    <div class="mb-3" id="edit-parent-group">
                        <label for="edit-parent-id" class="form-label">Danh mục cha</label>
                        <select name="categories_id" id="edit-parent-id" class="form-control">
                            <option value="">-- Không có (danh mục chính) --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#category-type').on('change', function () {
            if ($(this).val() === 'child') {
                $('#parent-category-group').show();
            } else {
                $('#parent-category-group').hide();
            }
        });

        $('#addCategoryForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this)
            const type = formData.get("type")

            if(type === 'parent') {
                $.ajax({
                    url: '/api/danhmuc', // Đảm bảo đã có route POST /api/danhmuc
                    type: 'POST',
                    data: {
                        name: formData.get("name")
                    },
                    success: function (res) {
                        Swal.fire('Thành công', 'Đã thêm danh mục', 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire('Lỗi', 'Không thể thêm danh mục', 'error');
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $.ajax({
                    url: '/api/danhmuccon', // Đảm bảo đã có route POST /api/danhmuc
                    type: 'POST',
                    data: {
                        name: formData.get("name"),
                        categories_id: formData.get("categories_id")
                    },
                    success: function (res) {
                        Swal.fire('Thành công', 'Đã thêm danh mục', 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire('Lỗi', 'Không thể thêm danh mục', 'error');
                        console.error(xhr.responseText);
                    }
                });
            }

        });

    })


    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const parentId = $(this).data('parent');

        $('#edit-category-id').val(id);
        $('#edit-category-name').val(name);


        if(parentId === "") {
            $('#edit-parent-id').hide();
        } else {
            $('#edit-parent-id').val(parentId ?? ''); // nếu là null thì set ''
            $('#edit-parent-id').show()
        }

        $('#editCategoryModal').modal('show');
    });

    $('#editCategoryForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('_method', 'PUT'); // Laravel sẽ hiểu đây là PUT



        if($('#edit-parent-id').val() === ""){
            $.ajax({
                url: '/api/danhmuc/' + $('#edit-category-id').val(), // cần route PUT hoặc POST
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire('Thành công', 'Cập nhật danh mục thành công', 'success').then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire('Lỗi', 'Không thể cập nhật', 'error');
                    console.error(xhr.responseText);
                }
            });
        } else {
            $.ajax({
                url: '/api/danhmuccon/' + $('#edit-category-id').val(), // cần route PUT hoặc POST
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire('Thành công', 'Cập nhật danh mục thành công', 'success').then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire('Lỗi', 'Không thể cập nhật', 'error');
                    console.error(xhr.responseText);
                }
            });
        }

    });

    $(".fa-trash").on("click", function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const parentId = $(this).data('parent');

        if(parentId === ""){
            $.ajax({
                type: "DELETE",
                url: "/api/danhmuc/" + id,
                success: function (response) {
                    console.log(response);

                }
            });

            $.ajax({
                type: "GET",
                url: "/api/danhmuccon",
                success: function (response) {
                    const filter = response.filter(item => item.categories_id === id)
                    filter.map(item => {
                        $.ajax({
                            type: "DELETE",
                            url: "/api/danhmuccon/" + item.id,
                            success: function (response) {
                                console.log(response);
                            }
                        });
                    })
                    console.log(response);
                }
            });


        } else {
            $.ajax({
                type: "DELETE",
                url: "/api/danhmuccon/" + id,
                success: function (response) {
                    console.log(response);
                }
            });
        }
        location.reload();
    })


</script>
