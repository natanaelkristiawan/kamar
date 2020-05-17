<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active" data-toggle="tab" href="#ourmission-id" role="tab">ID</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ourmission-en" role="tab">EN</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane p-3 active" id="ourmission-id" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Our mission title" name="" value="" class="form-control">
    </div>

    <div class="form-group">
      <label>Description</label> 
      <input type="text" placeholder="Our mission description" name="" value="" class="form-control">
    </div>
  </div> 
  <div class="tab-pane p-3" id="ourmission-en" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Our mission title" name="" value="" class="form-control">
    </div>

    <div class="form-group">
      <label>Description</label> 
      <input type="text" placeholder="Our mission description" name="" value="" class="form-control">
    </div>
  </div>
</div>
<div class="form-group" >
  <label>Image</label>
  <div style="position: relative; max-width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="https://via.placeholder.com/360x360" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="image_ourmission" value="" class="image-path">
  </div>
</div>
<div class="form-group">
  <label>Data</label>
  <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="thead-light">
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Icon</th>
        <th width="10%">Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"></td>
        <td><button type="button" class="btn btn-primary btn-block">Add</button></td>
      </tr>
    </tfoot>
  </table>
</div>