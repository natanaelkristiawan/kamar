@extends('theme.admin.layouts.blank')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('types.create') }}
        </div>
      </div>
    </div>
      <!-- end row -->
    <form style="display: none;" id="upload-picture">@csrf</form>
    <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
    @csrf
    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-lg-6">
          <div class="card same-heigh">
            <div class="card-body">
              <h4 class="mt-0 header-title">Data</h4>
              <div class="form-group">
                <label>Name <span class="required">*</span></label> 
                <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Name" id="name" name="name" class="form-control">
                <div class="help-block with-errors error"></div>
              </div>
              <div class="form-group">
                <label>Slug <span class="required">*</span></label> 
                <input required="" data-error="Please enter slug" type="text" value="{{ $data->slug }}" placeholder="Slug" id="slug" name="slug" class="form-control">
                <div class="help-block with-errors error"></div>
              </div>
             
              <div class="form-group">
                <label>Owner</label>
                <select class="form-control col-lg-6" required="" data-error="Please select owner">
                  <option value="">Select Owner</option>
                 
                </select>
                <div class="help-block with-errors error"></div>
              </div>
              <div class="form-group">
                <label>Type</label>
                <select class="form-control col-lg-6" required="">
                  <option value="">Select Type</option>
                 
                </select>
                <div class="help-block with-errors error"></div>
              </div>

              <div class="form-group">
                <label>Featured</label> 
                <div>
                  <input type="hidden" name="is_featured" value="0">
                  <input type="checkbox" class="js-switch" name="is_featured" value="1" {{ (bool)$data->is_featured ?  'checked' : ''}} />
                </div>
              </div>

              <div class="form-group">
                <label>Status</label> 
                <div>
                  <input type="hidden" name="status" value="0">
                  <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card same-heigh">
            <div class="card-body">
              <h4 class="mt-0 header-title">Metadata</h4>
              <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#metadata-id" role="tab">ID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#metadata-en" role="tab">EN</a>
                  </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane p-3 active" id="metadata-id" role="tabpanel">
                 <div class="form-group">
                    <label>Meta Title</label> 
                    <input type="text" placeholder="Meta Title" name="meta[id][title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['id']['title'] : ''}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Meta Tag</label>
                    <input  type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['id']['tag'] : ''}}" name="meta[id][tag]" class="form-control tagsinput">
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label>
                    <textarea class="form-control" rows="5" name="meta[id][description]">{{ (bool)count((array)$data->meta) ? $data->meta['id']['description'] : ''}}</textarea>
                  </div>
                </div>
                <div class="tab-pane p-3" id="metadata-en" role="tabpanel">
                  <div class="form-group">
                    <label>Meta Title</label> 
                    <input type="text" placeholder="Meta Title" name="meta[en][title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['en']['title'] : ''}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Meta Tag</label>
                    <input  type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['en']['tag'] : ''}}" name="meta[en][tag]" class="form-control tagsinput">
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label>
                    <textarea class="form-control" rows="5" name="meta[en][description]">{{ (bool)count((array)$data->meta) ? $data->meta['en']['description'] : ''}}</textarea>
                  </div>
                </div>
              </div>

          </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mt-0 header-title">Content</h4>
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#content-id" role="tab">ID</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#content-en" role="tab">EN</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active p-3" id="content-id" role="tabpanel">
                  <div class="form-group">
                    <label>Title</label> 
                    <input type="text" placeholder="Title" name="title[id]" value="{{ (bool)count((array)$data->title) ? $data->title['id'] : ''}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Abstract</label>
                    <textarea name="abstract[id]" class="textarea form-control">{{ (bool)count((array)$data->abstract) ? $data->abstract['id'] : '' }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description[id]" class="textarea form-control">{{ (bool)count((array)$data->description) ? $data->description['id'] : '' }}</textarea>
                  </div>
                </div>
                <div class="tab-pane p-3" id="content-en" role="tabpanel">
                  <div class="form-group">
                    <label>Title</label> 
                    <input type="text" placeholder="Title" name="title[en]" value="{{ (bool)count((array)$data->title) ? $data->title['en'] : ''}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Abstract</label>
                    <textarea name="abstract[en]" class="textarea form-control">{{ (bool)count((array)$data->abstract) ? $data->abstract['en'] : '' }}</textarea>
                  </div>


                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description[en]" class="textarea form-control">{{ (bool)count((array)$data->description) ? $data->description['en'] : '' }}</textarea>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h4 class="mt-0 header-title">Date Off</h4>
                </div>
                <div class="col-lg-6 text-right">
                  <a href="javascript:;" class="btn btn-sm btn-primary">Add</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mt-0 header-title">Details</h4>
              <div class="form-group">
                <label>Total Room</label>
                <input required="" data-error="Please enter total room" type="number" value="{{ $data->total_room }}" placeholder="Total Room" name="total_room" class="form-control col-lg-4">
                <div class="help-block with-errors error"></div>
              </div>
              <div class="form-group">
                <label>Locations</label>
                <select class="form-control col-lg-4" required="" data-error="Please enter slug">
                  <option value="">Select Location</option>
                 
                </select>
              </div>

              <div class="form-group">
                <label>Maps</label>
                <input id="pac-input" class="form-control" type="text" placeholder="Search Address">
                <div id="map" style="min-height: 30em"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" id="address"></textarea>
              </div>
              <div class="form-group">
                <label>Ameneties</label> 
                <div>
                  <select id='custom-headers' class="searchable" multiple='multiple'>
                    <option value='elem_1' selected>elem 1</option>
                    <option value='elem_2'>elem 2</option>
                    <option value='elem_3'>elem 3</option>
                    <option value='elem_4' selected>elem 4</option>
                    <option value='elem_100'>elem 100</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mt-0 header-title">Media</h4>
              <div class="form-group" >
                <label>Photo Primary</label>
                <div style="position: relative; max-width: 128px;">
                  <div class="lds-dual-ring hide"></div>
                  <a href="javascript:;" class="upload-now">
                    <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->photo_primary) || empty($data->photo_primary)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->photo_primary) }}" class="card-img-top img-fluid image-preview">
                  </a>
                  <a href="javascript:;" class="remove-image-single">
                    <i class="fa fa-times"></i>
                  </a>
                  <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                  <input type="hidden" name="photo_primary" value="{{ $data->photo_primary }}" class="image-path">
                </div>
              </div>
              <div class="form-group">
                <label>Gallery</label>
                {!! Upload::setForm('gallery', 'master.rooms.rooms', $data->gallery) !!}
              </div>
              <div class="form-group">
                <label>Youtube</label>
                <div class="bootstrap-filestyle input-group col-lg-4 pl-0">
                  <input type="text" class="form-control" id="youtube" name="youtube" placeholder="">
                  <span class="group-span-filestyle input-group-append preview-youtube" tabindex="0">
                    <label for="filestyle-0" class="btn btn-secondary">
                      <span class="icon-span-filestyle fas fa-play"></span> 
                      <span class="buttonText">Preview</span>
                    </label>
                  </span>
                </div>
                <small class="form-text text-muted">Insert only ID video | example: https://www.youtube.com/watch?v=<b>3JXCj6RK2B4</b></small>
              </div>

              <div class="hr-line-dashed"></div>
              <div class="form-group row">
                <div class="col-lg-4 col-sm-offset-2">
                  <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                  <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                  <a href="{{ route('admin.rooms') }}" class="btn btn-danger btn-sm" >Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
    </form>
  </div>
</div>
@stop

@section('modal')
@parent
<div class="modal fade" id="modal-preview" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Preview Youtube</h4>
      </div>
      <div  style="height: 500px" class="modal-body">
        <div id="player"></div>
      </div>
      <div class="modal-footer">
        <button onclick="player.stopVideo()" type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@stop

@section('script')
@parent
<link href="{{ asset('themes/additionals/lou-multi-select/css') }}/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src="{{ asset('themes/additionals/lou-multi-select/js') }}/jquery.multi-select.js" type="text/javascript"></script>
<script src="{{ asset('themes/additionals/lou-multi-select/js') }}/jquery.quicksearch.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6hoGyKmhX5TUFJB9ucNsNvb-wm8wZxfI&libraries=places"></script>
<script src="{{ asset('themes/additionals/gmaps') }}/gmaps.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
<style type="text/css">
  .search-input {
    margin-bottom: 1em;
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
</style>
<script type="text/javascript">
  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.rooms.rooms')).'/'.date('Y/m/d').'/file/file' }}"
  elems.forEach(function(html) {
    var switchery = new Switchery(html, { color: '#1AB394' });
  });
  $('.textarea').summernote({
    tabsize: 2,
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        sendFile(files[0], $(this), "{{ url(env('ADMIN_URL', 'admin').'/upload/'.'master.articles/'.date('Y/m/d').'/articles/file') }}");
      }
    }
  });


  $(document).ready(function(){

    $('.preview-youtube').on('click', function(){
      var videoID = $('#youtube').val();
      if (videoID == '') {
        toastr.error('Youtube cannot be empty');
        return;
      }
      $('#modal-preview').modal('show');
      playerLoadById(videoID);
    });

    $('#name').on('keyup', function(){
      var name = $(this).val();
      var slug = slugify(name);
      $('#slug').val(slug);
    });


    $('.searchable').multiSelect({
      selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Select Ameneties'>",
      selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Select Ameneties'>",
      afterInit: function(ms){
        var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });
  });
</script>


<!-- youtube -->

<script type="text/javascript">
var player;

function renderFirst(videoID) {
  player = new YT.Player('player', {
    height: '100%',
    width: '100%',
    videoId : videoID,
    events: {
      'onReady': onPlayerReady,
    },
    playerVars: {rel: 0},
  });
}


function onPlayerReady(event) {
  event.target.playVideo();
}

function playerLoadById(videoID) {

  if (typeof player == 'undefined') {
    renderFirst(videoID);
    return;
  }

  player.loadVideoById(videoID);
}

</script>


<!-- gmaps -->
<script type="text/javascript">

function similarity(s1, s2) {
  var longer = s1;
  var shorter = s2;
  if (s1.length < s2.length) {
    longer = s2;
    shorter = s1;
  }
  var longerLength = longer.length;
  if (longerLength == 0) {
    return 1.0;
  }
  return (longerLength - editDistance(longer, shorter)) / parseFloat(longerLength);
}


var map,
def_lat,
def_lng,
def_value = {
  lat: def_lat,
  lng: def_lng
};


function generateInputSearch() {
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    places.forEach(function(place) {
      $('#address').val(place.formatted_address)
      var latlng = place.geometry.location;
      map.removeMarkers();
      map.setCenter(latlng.lat(), latlng.lng());
        map.addMarker({
        lat: latlng.lat(),
        lng: latlng.lng(),
        draggable: true,
        dragend: function(e) {
          mapIsDragged(e);
        }
      });

      input.value = '';
    })
  });  
}

if (typeof def_lat == 'undefined') {
  if (def_lat != '') {
    def_value.lat = -6.209933;
  }
}

if (typeof def_lng == 'undefined') {
  if (def_lng != '') {
    def_value.lng = 106.843239;
  }
}


function initMap(zoom, data) {
  if ($('#map').length == 1) {
    if (typeof zoom == 'undefined') {
      zoom = 14;
    }

    latest_lat = $('#latitude').val();
    latest_lng = $('#longitude').val();


    if (latest_lat == '') {
      latest_lat = def_value.lat;
    }

    if (latest_lng == '') {
      latest_lng = def_value.lng
    }
    map = new GMaps({
      div: '#map',
      lat: latest_lat,
      lng: latest_lng,
      zoom: 14,
      textSearch: true
    });
  }
}


function search_by_city(reset, address) {
  if (typeof reset == 'undefined') {
    reset = false;
  }

  if (typeof address == 'undefined') {
    address = true;
  }


  latest_lat = $('#latitude').val();
  latest_lng = $('#longitude').val();

  GMaps.geocode({
    address: address,
    callback: function(results, status) {
      if (status == 'OK') {
        var latlng = results[0].geometry.location;
        map.removeMarkers();
        dataTest = results;
        if (typeof latest_lat == 'undefined' || reset == true || latest_lat == "") {
          map.setCenter(latlng.lat(), latlng.lng());
          map.addMarker({
            lat: latlng.lat(),
            lng: latlng.lng(),
            draggable: true,
            dragend: function(e) {
              mapIsDragged(e);
            }
          });
          return;
        }

        map.setCenter(latest_lat, latest_lng);
        map.addMarker({
          lat: latest_lat,
          lng: latest_lng,
          draggable: true,
            dragend: function(e) {
              mapIsDragged(e);
            }
      });
        
      }
    }
  });
}

function mapIsDragged(evt) {
  lat = evt.latLng.lat();
  lng = evt.latLng.lng(); 

  GMaps.geocode({
    lat: lat,
    lng: lng,
    callback: function(results, status) {
      place = results[0];
      $('#address').val(place.formatted_address)
    }
  });

  $('#latitude').val(lat);
  $('#longitude').val(lng);
}

function generateAll() {
  initMap();
  search_by_city(true, 'denpasar');
  generateInputSearch();
}


$(document).ready(function(){
  initMap();
  generateInputSearch();
});


</script>
@stop