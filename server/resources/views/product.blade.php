<div class="g-sidenav-show bg-gray-100">
    @include("navbar")
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="overflow-y: auto">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbar">
                    <div class="w-100">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control shadow-none" placeholder="Tìm kiếm..." id="search-input">
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm sản phẩm</button>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Danh sách sản phẩm</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0" style="overflow-x: hidden">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kích thước</th>
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
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{number_format($product['price'], 0, ",", ".")}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{$product['size']}}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-wrap" style="width: 350px">{{$product['description']}}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold" data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal"
                                                    data-id="{{ $product['id'] }}"
                                                    data-name="{{ $product['name'] }}"
                                                    data-price="{{ $product['price'] }}"
                                                    data-size="{{ $product['size'] }}"
                                                    data-description="{{ $product['description'] }}"
                                                    data-img="{{ $product['img'] }}">
                                                    <i class="fas fa-edit text-success"></i>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                                                    <i data-id="{{$product['id']}}" class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Phân trang -->
                                <div class="d-flex justify-content-center" id='pagination'>
                                    {!! $products->links('pagination::bootstrap-4', ['previous' => false, 'next' => false]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<!-- Modal Sửa Sản Phẩm -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editProductForm" method="POST"  enctype="multipart/form-data">
            {{-- @method('PUT')  <!-- Thêm dòng này để giả lập PUT --> --}}
            @csrf
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="edit-name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Giá</label>
                        <input type="number" class="form-control" name="price" id="edit-price">
                    </div>
                    <div class="mb-3">
                        <label for="edit-size" class="form-label">Kích cỡ</label>
                        <input type="text" class="form-control" name="size" id="edit-size">
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" id="edit-description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-img" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="img" id="edit-img">
                        <img id="preview-img" src="" alt="Ảnh sản phẩm" class="mt-2" style="max-height: 150px;">
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


<!-- Modal Thêm Sản Phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addProductForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="add-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-price" class="form-label">Giá</label>
                        <input type="number" class="form-control" name="price" id="add-price" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-size" class="form-label">Kích cỡ</label>
                        <input type="text" class="form-control" name="size" id="add-size" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-description" class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" id="add-description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="add-category" class="form-label">Danh mục</label>
                        <select name="categories_id" id="add-category" class="form-control">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-subcate" class="form-label">Danh mục con</label>
                        <select name="subcategories_id" id="add-subcate" class="form-control">
                            <option value="">Chọn danh mục con</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-img" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="img" id="add-img" required>
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




<style>
    /* Màu nền của các trang số */
.pagination .page-item {
    background-color: #f0f0f0; /* Thay đổi màu nền */
    border: 1px solid #ddd; /* Thay đổi màu viền */
}

/* Màu chữ của các trang số */
.pagination .page-link {
    color: gold; /* Thay đổi màu chữ */
}

/* Thay đổi màu khi hover vào trang số */
.pagination .page-item:hover .page-link {
    background-color: gold; /* Màu nền khi hover */
    color: white; /* Màu chữ khi hover */
}

/* Màu chữ của trang hiện tại */
.pagination .page-item.active .page-link {
    background-color: gold; /* Màu nền trang hiện tại */
    color: white; /* Màu chữ trang hiện tại */
}

</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            type: "GET",
            url: "/api/danhmuc",
            success: function (response) {
                $("#add-category").html(
                    '<option value="">Chọn danh mục</option>' + response.map(item =>{
                        return `<option value="${item.id}">${item.name}</option>`
                    })
                )
            }
        });


        $(".fa-trash").on("click", function (event) {
            Swal.fire({
                text: "Bạn có chắc muốn xóa không?",
                allowOutsideClick: false,
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Hủy'
            }).then(result =>{
                if(result.isConfirmed) {
                    const element = $(event.target)
                    $.ajax({
                        type: "DELETE",
                        url: "/api/sanpham/" + element.attr("data-id"),
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

        $("#add-category").on("change", function (e) {
            $.ajax({
                type: "GET",
                url: "/api/danhmuccon",
                success: function (response) {
                    const filter = response.filter(item => item.categories_id == e.target.value)
                    $("#add-subcate").html(
                        '<option value="">Chọn danh mục con</option>' + filter.map(item =>{
                            return `<option value="${item.id}">${item.name}</option>`
                        })
                    )

                }
            });

        })

        $('#editProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút được click

            // Lấy data từ thuộc tính data-*
            var id = button.data('id');
            var name = button.data('name');
            var price = button.data('price');
            var size = button.data('size');
            var description = button.data('description');
            var img = button.data("img")

            // Đổ dữ liệu vào form trong modal
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-price').val(price);
            $('#edit-size').val(size);
            $('#edit-description').val(description);
            $('#preview-img').attr('src', '/img/' + img);

        });

        $("#editProductForm").on("submit", function (e){
            e.preventDefault();


            var formData = new FormData(e.target)
            formData.append('_method', 'PUT'); // Laravel sẽ hiểu đây là PUT


            $.ajax({
                url: '/api/sanpham/' + $('#edit-id').val(),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        text: "Cập nhật sản phẩm thành công",
                        icon: "success",
                        allowOutsideClick: false,
                    }).then(result =>{
                        if(result.isConfirmed) {
                            location.reload()
                        }
                    })

                }
            })
        })

        $("#addProductForm").on("submit", function (e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '/api/sanpham', // Đảm bảo route POST /api/sanpham đã có trong Laravel
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        text: "Thêm sản phẩm thành công",
                        icon: "success",
                        allowOutsideClick: false,
                    }).then(result => {
                        if(result.isConfirmed) {
                            location.reload();
                        }
                    });

                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire("Lỗi", "Không thể thêm sản phẩm", "error");
                }
            });
        });


        $('#search-input').on('keyup', function () {
            $("#pagination").hide();

            const keyword = $(this).val().toLowerCase().trim();

            $("tbody tr").each(function () {
                const name = $(this).find("td:eq(0) h6").text().toLowerCase(); // lấy tên sản phẩm
                const price = $(this).find("td:eq(1)").text().toLowerCase();
                const size = $(this).find("td:eq(2)").text().toLowerCase();
                const description = $(this).find("td:eq(3)").text().toLowerCase();

                if (
                    name.includes(keyword) ||
                    price.includes(keyword) ||
                    size.includes(keyword) ||
                    description.includes(keyword)
                ) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

    });
</script>

