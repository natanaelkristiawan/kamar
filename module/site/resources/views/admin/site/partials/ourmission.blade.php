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
      <input type="text" placeholder="Our mission title" name="mission[id][title]" value="{{ $mission['id']['title'] }}" class="form-control">
    </div>

    <div class="form-group">
      <label>Description</label> 
      <input type="text" placeholder="Our mission description" name="mission[id][description]" value="{{ $mission['id']['description'] }}" class="form-control">
    </div>
  </div> 
  <div class="tab-pane p-3" id="ourmission-en" role="tabpanel">
    <div class="form-group">
      <label>Title</label> 
      <input type="text" placeholder="Our mission title" name="mission[en][title]" value="{{ $mission['en']['title'] }}" class="form-control">
    </div>

    <div class="form-group">
      <label>Description</label> 
      <input type="text" placeholder="Our mission description" name="mission[en][description]" value="{{ $mission['en']['description'] }}" class="form-control">
    </div>
  </div>
</div>
<div class="form-group" >
  <label>Image</label>
  <div style="position: relative; max-width: 128px;">
    <div class="lds-dual-ring hide"></div>
    <a href="javascript:;" class="upload-now">
      <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($missionBanner) || empty($missionBanner)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$missionBanner) }}" class="card-img-top img-fluid image-preview">
    </a>
    <a href="javascript:;" class="remove-image-single">
      <i class="fa fa-times"></i>
    </a>
    <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
    <input type="hidden" name="mission_banner" value="{{ $missionBanner }}" class="image-path">
  </div>
</div>
<div class="form-group">
  <label>Data</label>
  <table class="table table-bordered nowrap" id="mission-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
        <td><button type="button" class="btn btn-primary btn-block" id="add-mission">Add</button></td>
      </tr>
    </tfoot>
  </table>
</div>


@section('modal')
@parent
<div class="modal fade" id="modal-mission" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Add Data Mission</h5>
      </div>
      <div class="modal-body">
        <div class="row" id="renderModal">
         
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="addData()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop


@section('script')
@parent
<script type="x-tmpl-mustache" id="table-template">
  <input data-id="title_id" type="hidden" name="mission_data[@{{counter}}][id][title]" value="@{{ title_id }}">
  <input data-id="description_id" type="hidden" name="mission_data[@{{counter}}][id][description]" value="@{{ description_id }}">
  <input data-id="title_en" type="hidden" name="mission_data[@{{counter}}][en][title]" value="@{{ title_en }}">
  <input data-id="description_en" type="hidden" name="mission_data[@{{counter}}][en][description]" value="@{{ description_en }}">
  <input data-id="icon" type="hidden" name="mission_data[@{{counter}}][icon]" value="@{{ icon }}">
  <td>
    <span class="d-block"> id : @{{ title_id }}</span>
    <span class="d-block"> en : @{{ title_en }}</span>
  </td>
  <td>
    <span class="d-block"> id : @{{ description_id }}</span>
    <span class="d-block"> en : @{{ description_en }}</span>
  </td>
  <td>
    <button type="button" class="btn btn-primary"><i class="@{{ icon }}"></i></button>
  </td>
  <td>
    <button type="button" class="btn btn-danger" onclick="editData(this, @{{counter}})"><i class="fas fa-pencil-alt"></i></button>
    <button type="button" class="btn btn-primary" onclick="$('#data_@{{ counter }}').remove()"><i class="fas fa-trash-alt"></i></button>
  </td>
</script>
<script type="x-tmpl-mustache" id="modal-template">
<div class="col-lg-12">
  <input type="hidden" id="data-counter" value="@{{data_counter}}" />
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item ">
      <a class="nav-link active" data-toggle="tab" href="#ourmission-data-id" role="tab">ID</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#ourmission-data-en" role="tab">EN</a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane p-3 active" id="ourmission-data-id" role="tabpanel">
      <div class="form-group">
        <label>Title</label> 
        <input type="text" placeholder="Title" id="title-id" value="@{{ title_id }}" class="form-control">
      </div>

      <div class="form-group">
        <label></label> 
        <input type="text" placeholder="Description" id="description-id" value="@{{ description_id }}" class="form-control">
      </div>
    </div> 
    <div class="tab-pane p-3" id="ourmission-data-en" role="tabpanel">
      <div class="form-group">
        <label>Title</label> 
        <input type="text" placeholder="Title" id="title-en" value="@{{ title_en }}"  class="form-control">
      </div>

      <div class="form-group">
        <label>Description</label> 
        <input type="text" placeholder="Description" id="description-en" value="@{{ description_en }}" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Icon</label>
    <div class="input-group col-lg-4">
        <input type="text" value="@{{ icon }}"  id="icon" class="form-control icon">
        <span class="input-group-btn input-group-append">
          <button class="btn btn-primary bootstrap-touchspin-up" type="button">
            <i id="changeClass" class="@{{ icon }}"></i>    
          </button>
        </span>
    </div>
  </div>
</div>
</script>


<script type="text/javascript">
  var counter = 0;
  var counter_append = 0;
  async function renderModal(data) {
    var response = new Promise((resolve, error) => {
      var template = $('#modal-template').html();
      htmlBody = Mustache.render(template, data);
      $('#renderModal').html(htmlBody);
      var html = $('#modal-template').html();

      return resolve(true);
    });
    return await response;
  }

  async function editData(params, id) {
    var that = $(params).parents()[1];
    var inputs = $(that).find('input');
    var data = {data_counter : id};
    $.each(inputs, function(){
      data[$(this).data('id')] = $(this).val();
    });
    renderModal(data).then((response) => {
      $('.icon').iconpicker({
        placement: 'top',
      }).on('iconpickerSelected', function(event){
        $('#changeClass').attr('class',event.iconpickerValue);
      });
    }).then((response) => {
      $('#modal-mission').modal('show');
    })
  }

  async function addData(){

    if ($('#data-counter').val() !== '') {
      perhitungan = $('#data-counter').val();
    } else {
      perhitungan = counter;
    }
    
    var data = {
      counter : perhitungan,
      title_id : $('#title-id').val(),
      description_id : $('#description-id').val(),
      title_en : $('#title-en').val(),
      description_en : $('#description-en').val(),
      icon : $('#icon').val()
    }
    var html_awal = '<tr id="data_'+counter+'">';
    var template = $('#table-template').html();
    html = Mustache.render(template, data);

    if($('#data-counter').val() !== ''){
      $('#data_'+$('#data-counter').val()).html(html);
      $('#modal-mission').modal('hide');
      return true;
    }

    html_akhir = '</tr>';
    $('#mission-table tbody').append(html_awal + html + html_akhir);
    $('#modal-mission').modal('hide');
    counter++;
  }


  $(document).ready(function() {
    
    var dataMission = {!! json_encode($missionData) !!};

    $.each(dataMission, function(key, value){
      var data = {
        counter : counter,
        title_id : value.id.title,
        description_id : value.id.description,
        title_en : value.en.title,
        description_en :value.en.description,
        icon :value.icon
      }
      var html_awal = '<tr id="data_'+counter+'">';
      var template = $('#table-template').html();
      html = Mustache.render(template, data);
      html_akhir = '</tr>';
      $('#mission-table tbody').append(html_awal + html + html_akhir);
      counter++;
    });

    $('#add-mission').on('click', function(){
      renderModal({icon : 'fas fa-check'}).then((response) => {
        $('.icon').iconpicker({
          placement: 'top',
        }).on('iconpickerSelected', function(event){
          $('#changeClass').attr('class',event.iconpickerValue);
        });
      }).then((response) => {
        $('#modal-mission').modal('show');
      })
    });

  });
</script>
@stop