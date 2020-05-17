<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active" data-toggle="tab" href="#privacy-id" role="tab">ID</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#privacy-en" role="tab">EN</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane p-3 active" id="privacy-id" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="" class="textarea form-control"></textarea>
    </div>
  </div>
  <div class="tab-pane p-3" id="privacy-en" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="" class="textarea form-control"></textarea>
    </div>
  </div>
</div>

<div class="form-group" >
  <label>Banner</label>
  <div style="position: relative; max-width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="https://via.placeholder.com/360x360" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="banner_privacy" value="" class="image-path">
  </div>
</div>