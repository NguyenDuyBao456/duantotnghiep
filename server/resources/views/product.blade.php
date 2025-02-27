@include('defaut')

<!-- Main Content -->
<div class="content" style="overflow: auto">
  <h3>Quản lý sản phẩm</h3>

  <!-- Nút Thêm Sản Phẩm -->
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
    Thêm Sản Phẩm
  </button>

  <!-- Bảng Sản Phẩm -->
  <table class="product-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Hình</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Kích thước</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>


    @if(isset($products) && count($products) > 0)

            @foreach ($products as $product)
            <tr>
               <th> {{ $product['id'] }} </th>
               <th> <img src="{{ asset('img/' . $product['img']) }}" width="100"></th>
               <th> {{ $product['name'] }} </th>
               <th> {{ $product['price'] }} </th>
               <th>{{$product['size']}}</th>
               <th>
                    <button type="button" class="button-btn btn btn-success" name="Sửa">Sửa</button>
                    <button type="button" class="button-btn btn btn-danger" name="xóa">Xóa</button>
                </th>
            </tr>
            @endforeach

    @else
        <p>Không có sản phẩm nào!</p>
    @endif


    </tbody>
  </table>

  <!-- Modal Thêm Sản Phẩm -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" action="index.php?ctrl=admin&views=product">
            <div class="form-group">
              <label for="productImage" class="form-label">Hình Ảnh Sản Phẩm</label>
              <input type="file" id="productImage" class="form-control" name="img" required>
            </div>
            <div class="form-group">
              <label for="productName" class="form-label">Tên Sản Phẩm</label>
              <input type="text" id="productName" class="form-control" placeholder="Nhập tên sản phẩm" name="name" required>
            </div>
            <div class="form-group">
              <label for="productPrice" class="form-label">Giá Sản Phẩm (VND)</label>
              <input type="number" id="productPrice" class="form-control" placeholder="Nhập giá sản phẩm" name="price" required>
            </div>
            <div class="form-group">
              <label for="productDesc" class="form-label">Mô tả sản phẩm</label>
              <input type="text" id="productName" class="form-control" placeholder="Nhập mô tả sản phẩm" name="description" required>
            </div>
            <!-- <div class="form-group">
              <label for="productCategory" class="form-label">Danh Mục</label>
              <select id="productCategory" class="form-control" required name="cate">
              </select>
            </div> -->
            <button type="submit" class="submit-btn btn btn-primary" name="add">Thêm Sản Phẩm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>



