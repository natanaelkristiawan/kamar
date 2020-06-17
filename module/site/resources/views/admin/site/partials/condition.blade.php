<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active" data-toggle="tab" href="#condition-id" role="tab">ID</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#condition-en" role="tab">EN</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane p-3 active" id="condition-id" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="{{ $condition['id']['title'] }}" name="condition[id][title]" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="textarea form-control" name="condition[id][description]">{!! $condition['id']['description'] !!}</textarea>
    </div>
  </div>
  <div class="tab-pane p-3" id="condition-en" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="{{ $condition['en']['title'] }}" name="condition[en][title]" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="condition[en][description]" class="textarea form-control">{!! $condition['en']['description'] !!}</textarea>
    </div>
  </div>
</div>

<div class="form-group" >
  <label>Banner</label>
  <div style="position: relative; width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($conditionBanner) || empty($conditionBanner)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$conditionBanner) }}" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="condition_banner" value="{{ $conditionBanner }}" class="image-path">
    <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
  </div>
</div>