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
                <label>Owner <span class="required">*</span></label>
                <select class="form-control select-owner" name="owner_id" required="" data-error="Please select owner"></select>
                <div class="help-block with-errors error"></div>
              </div>
              <div class="form-group">
                <label>Type <span class="required">*</span></label>
                <select class="form-control select-type" name="type_id" required="" data-error="Please select type"></select>
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
                  <div class="form-group">
                    <label>House Rules</label>
                    <textarea name="house_rules[id]" class="textarea form-control">{{ (bool)count((array)$data->house_rules) ? $data->house_rules['id'] : '' }}</textarea>
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
                  <div class="form-group">
                    <label>House Rules</label>
                    <textarea name="house_rules[en]" class="textarea form-control">{{ (bool)count((array)$data->house_rules) ? $data->house_rules['en'] : '' }}</textarea>
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
                  <a href="javascript:;" id="addDateOff" class="btn btn-sm btn-primary">Add</a>
                </div>
              </div>
              <table id="table-date-off" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light">
                  <tr>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mt-0 header-title">Details</h4>
              <div class="form-group">
                <label>Total Room <span class="required">*</span></label>
                <input required="" data-error="Please enter total room" type="number" value="{{ $data->total_room }}" placeholder="Total Room" name="total_room" class="form-control col-lg-4">
                <div class="help-block with-errors error"></div>
              </div> 
              <div class="form-group">
                <label>Price <span class="required">*</span></label>
                <input required="" data-error="Please enter total room" type="number" value="{{ $data->price }}" placeholder="Price" name="price" class="form-control col-lg-4">
                <div class="help-block with-errors error"></div>
              </div>
              <div class="form-group">
                <label>Locations <span class="required">*</span></label>
                <select class="form-control select-location" name="location_id" required="" data-error="Please enter location"></select>
              </div>

              <div class="form-group">
                <label>Maps</label>
                <input id="pac-input" class="form-control" type="text" placeholder="Search Address">
                <div id="map" style="min-height: 30em"></div>
                <input type="hidden" value="{{ $data->latitude }}" name="latitude" id="latitude">
                <input type="hidden" value="{{ $data->longitude }}" name="longitude" id="longitude">
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" id="address">{!! $data->address !!}</textarea>
              </div>
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#addressDetail-id" role="tab">ID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#addressDetail-en" role="tab">EN</a>
                  </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane p-3 active" id="addressDetail-id" role="tabpanel">
                  <div class="form-group">
                    <label>Address Detail</label>
                    <textarea class="form-control" name="address_detail[id]">{!! (bool)count((array)$data->address_detail) ? $data->address_detail['id'] : '' !!}</textarea>
                  </div>
                </div>
                <div class="tab-pane p-3" id="addressDetail-en" role="tabpanel">
                  <div class="form-group">
                    <label>Address Detail</label>
                    <textarea class="form-control" name="address_detail[en]">{!! (bool)count((array)$data->address_detail) ? $data->address_detail['en'] : '' !!}</textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Ameneties</label> 
                <div>
                  <select id='custom-headers' class="searchable" name="ameneties_ids[]" multiple='multiple'></select>
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
                <div style="position: relative; width: 128px;">
                  <div class="lds-dual-ring hide"></div>
                  <a href="javascript:;" class="upload-now">
                    <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->photo_primary) || empty($data->photo_primary)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->photo_primary) }}" class="card-img-top img-fluid image-preview">
                  </a>
                  <a href="javascript:;" class="remove-image-single">
                    <i class="fa fa-times"></i>
                  </a>
                  <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                  <input type="hidden" name="photo_primary" value="{{ $data->photo_primary }}" class="image-path">
                  <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
                </div>
              </div>
              <div class="form-group">
                <label>Gallery</label>
                {!! Upload::setForm('gallery', 'master.rooms.rooms', $data->gallery) !!}
                <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
              </div>
              <div class="form-group">
                <label>Youtube</label>
                <div class="bootstrap-filestyle input-group col-lg-4 pl-0">
                  <input type="text" class="form-control" value="{{ $data->youtube }}" id="youtube" name="youtube" placeholder="">
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

<script type="x-tmpl-mustache" id="date-off-template">
<tr id="dateoff_@{{ counter }}">
  <td>
      <input type="hidden" name="date_off[@{{counter}}][status]" value="1">
    <input type="text" value="@{{ date_start }}" name="date_off[@{{counter}}][date_start]" id="datestart@{{counter}}" class="datetime form-control datestart" >
  </td>
  <td>
    <input type="text"  value="@{{ date_end }}" name="date_off[@{{counter}}][date_end]" id="dateend@{{counter}}" class="datetime form-control dateend" >
  </td>
  <td>
    <button type="button" onclick="$('#dateoff_@{{ counter }}').remove()" class="btn btn-danger btn-sm">Delete</button>
  </td>
</tr>
</script>


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
  .switchery-small {
    border-radius: 20px;
    height: 20px;
    width: 33px;
  }
  .switchery-small > small {
    height: 20px;
    width: 20px;
  }

  .has-danger .select2-selection--single {
    border-color: #f16c69 !important
  }
</style>

<script type="text/javascript">
  var counter = 0;
  async function generateDateTime(counter, data) {
    var response = new Promise((resolve, error)=> {
      var template = $('#date-off-template').html()
      htmlBody = Mustache.render(template, data);
      $('#table-date-off tbody').append(htmlBody);

      var dateStart = $('#datestart'+counter).datepicker({
        format: 'yyyy-mm-dd',
        autoclose : true,
        startDate: new Date(),
        clearBtn: true
      }).on('changeDate', function (selected) {
        var that = $($(selected.currentTarget).parents()[1]).find('.dateend');
        if (typeof selected.date == 'undefined') {
          that.val('');
          that.datepicker('setStartDate', new Date());
          that.datepicker('setDate', false);
          return;
        }
        var minDate = new Date(selected.date.valueOf());

        that.datepicker('setStartDate', minDate);
        that.datepicker('setDate', minDate);
      });

      var dateEndStart = (typeof data.date_start == 'undefined' ? new Date() : new Date(data.date_start));

      var dateEnd = $('#dateend'+counter).datepicker({
        format: 'yyyy-mm-dd',
        autoclose : true,
        startDate: dateEndStart,
      });

      var elem = document.querySelector('#status'+counter);

      if (typeof data.status != 'undefined') {
        if (Boolean(data.status) == true) {
          $('#status'+counter).attr('checked', true)
        }
      }

      resolve({
        dateStart: dateStart,
        dateEnd: dateEnd
      });
    });

    return await response;

  }
  $(document).ready(function(){


    var dateOff = {!! json_encode($data->date_off) !!}

    $.each(dateOff, function(){
      var data = {
        counter : counter,
        date_start  : this.date_start,
        date_end : this.date_end,
        status: this.status
      }
      generateDateTime(counter, data).then((response)=> {
        counter++;
      })
    })


    $('#addDateOff').on('click', function(){
      var data = {
        counter : counter
      }
      generateDateTime(counter, data).then((response)=> {
        counter++;
      })
    })
  });
</script>

<!-- khusus select2 -->
<script type="text/javascript">
  var owners = {!! json_encode($owners) !!}
  var types = {!! json_encode($types) !!}
  var locations = {!! json_encode($locations) !!}
  var ameneties = {!! json_encode($ameneties) !!}
  $(document).ready(function(){
    initSelect2('.select-owner', owners).then((result) => {
      result.val("{{ $data->owner_id }}").trigger('change');
      result.on('select2:select', function (e) {
        var data = e.params.data;
      });
    });

    initSelect2('.select-type', types).then((result) => {
      result.val("{{ $data->type_id }}").trigger('change');
      result.on('select2:select', function (e) {
        var data = e.params.data;
      });
    });

    initSelect2('.select-location', locations).then((result) => {
      result.val("{{ $data->location_id }}").trigger('change');
      result.on('select2:select', function (e) {
        var data = e.params.data;
        search_by_city(true, data.text);
      });
    });
  });
</script>
<script type="text/javascript">
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.rooms.rooms')).'/'.date('Y/m/d').'/file/file' }}"
  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
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
        this.addOption(ameneties)
        this.select({!! json_encode($data->ameneties_ids) !!}, 'init');

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
$("#pac-input").keypress(function(event) {
 if (event.keyCode == 13 ){
  return false;
 }
})

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
    def_value.lat = -8.669513;
  }
}
if (typeof def_lng == 'undefined') {
  if (def_lng != '') {
    def_value.lng = 115.21500;
  }
}
function initMap(zoom, data) {
  if ($('#map').length == 1) {
    if (typeof zoom == 'undefined') {
      zoom = 15;
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
       $('#address').val(results[0].formatted_address)
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
$(document).ready(function(){
  initMap();
  generateInputSearch();
});
</script>
@stop