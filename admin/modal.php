
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form  method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="_id" id="id" >
            <label for="name">Name</label>
            <input id="name" type="text" name="_name" class="form-control">
            <label for="name">Categories</label>
            <select id="category" name="_category" class="form-select" >
                <option value=""></option>
                <option value="Shose">Shose</option>
                <option value="Clothes">Clothes</option>
                <option value="Accessories">Accessories</option>
                <option value="Eatery">Eatery</option>
            </select>
            <label for="_brand">Brand</label>
            <input id="brand" type="text" name="_brand" class="form-control">
            <label for="name">Price</label>
            <input id="price" type="text" name="_price" class="form-control">
            <input type="hidden" id="old_img" name="_old_img">
            <label for="_file">Image</label>
            <input type="file" name="_file" id="file" class = " form-control">
          </div>
          <div class="modal-footer">
              <button name="btn_cancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              <input id="accept_add" name="_AddPro"  value="ADD" type="submit" class="btn btn-success"/>
              <input id="accept_edit" name="_Edit"  value="Edit" type="submit" class="btn btn-secondary"/>
          </div>
      </form>
    </div>
  </div>
</div>