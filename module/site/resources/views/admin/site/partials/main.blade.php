<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active" data-toggle="tab" href="#metadata-id" role="tab">Meta ID</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#metadata-en" role="tab">Meta EN</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane p-3 active" id="metadata-id" role="tabpanel">
   <div class="form-group">
      <label>Meta Title</label> 
      <input type="text" placeholder="Meta Title" name="meta[id][title]" value="" class="form-control">
    </div>
    <div class="form-group">
      <label>Meta Tag</label>
      <input  type="text" placeholder="Meta Tag" value="" name="meta[id][tag]" class="form-control tagsinput">
    </div>
    <div class="form-group">
      <label>Meta Description</label>
      <textarea class="form-control" rows="5" name="meta[id][description]"></textarea>
    </div>
  </div>
  <div class="tab-pane p-3" id="metadata-en" role="tabpanel">
    <div class="form-group">
      <label>Meta Title</label> 
      <input type="text" placeholder="Meta Title" name="meta[en][title]" value="" class="form-control">
    </div>
    <div class="form-group">
      <label>Meta Tag</label>
      <input  type="text" placeholder="Meta Tag" value="" name="meta[en][tag]" class="form-control tagsinput">
    </div>
    <div class="form-group">
      <label>Meta Description</label>
      <textarea class="form-control" rows="5" name="meta[en][description]"></textarea>
    </div>
  </div>
</div>


<div class="form-group" >
  <label>Banner Main</label>
  <div style="position: relative; max-width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="https://via.placeholder.com/360x360" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="banner_main" value="" class="image-path">
  </div>
</div>


<div class="form-group">
  <label>Phone Number</label>
  <input type="text" value="" placeholder="Phone Number" name="phone_number" class="form-control">
</div>
<div class="form-group">
  <label>Email</label>
  <input type="email" value="" placeholder="Email" name="email" class="form-control">
</div>
<div class="form-group">
  <label>Address</label>
  <textarea name="address" class="form-control"></textarea>
</div>
