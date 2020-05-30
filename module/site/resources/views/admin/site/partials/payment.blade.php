<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active" data-toggle="tab" href="#payment-id" role="tab">ID</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#payment-en" role="tab">EN</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane p-3 active" id="payment-id" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="{{ $payment['id']['title'] }}" name="payment[id][title]" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="textarea form-control" name="payment[id][description]">{!! $payment['id']['description'] !!}</textarea>
    </div>
  </div>
  <div class="tab-pane p-3" id="payment-en" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Title" value="{{ $payment['en']['title'] }}" name="payment[en][title]" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="payment[en][description]" class="textarea form-control">{!! $payment['en']['description'] !!}</textarea>
    </div>
  </div>
</div>

<div class="form-group" >
  <label>Banner</label>
  <div style="position: relative; width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($paymentBanner) || empty($paymentBanner)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$paymentBanner) }}" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="payment_banner" value="{{ $paymentBanner }}" class="image-path">
  </div>
</div>