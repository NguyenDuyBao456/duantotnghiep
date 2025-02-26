@include('defaut')

<div class="content" style="overflow: auto">

  <h3>Quản lý danh mục</h3>

  <!-- Nút Thêm Danh Mục -->
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    Thêm Danh Mục
  </button>

  <!-- Bảng Danh Mục -->
  <table class="product-table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($categories) && count($categories) > 0)
                @foreach ($categories as $category)
                    <tr>
                        {{-- <th>{{ $category->id }}</th> --}}
                        <th>{{ $category->name }}</th>
                        <th>
                            <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                        </th>
                    </tr>
                @endforeach

                @foreach ($subcategory as $sub)
                    <tr>
                        {{-- <th>{{ $sub->id }}</th> --}}
                        <th>{{ $sub->name }}</th>
                        <th>
                            <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                        </th>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">Không có danh mục!</td>
                </tr>
            @endif
        </tbody>
    </table>

  <!-- Modal Thêm Danh Mục -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="index.php?ctrl=admin&views=category">
            <div class="form-group">
              <label for="categoryName" class="form-label">Tên Danh Mục</label>
              <input type="text" id="categoryName" class="form-control" placeholder="Nhập tên danh mục" name="name" required>
            </div>
            <button type="submit" class="submit-btn btn btn-primary" name="add">Thêm Danh Mục</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap JS và các phụ thuộc -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
