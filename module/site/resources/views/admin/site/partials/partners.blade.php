<div class="form-group">
  <label>List Partners</label>
  <table id="partner-table" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead class="thead-light">
      <tr>
        <th>Title</th>
        <th>Logo</th>
        <th width="10%">Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2"></td>
        <td><button type="button" class="btn btn-primary btn-block" id="add-partner">Add</button></td>
      </tr>
    </tfoot>
  </table>
</div>

@section('modal')
@parent
<div class="modal fade" id="modal-partner" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Add Data Mission</h5>
      </div>
      <div class="modal-body">
        <div class="row" id="partnerModal">
        
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addDataPartner()">Save</button>
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
</div>
@stop

@section('script')
@parent

<script type="x-tmpl-mustache" id="table-partner-template">
  <input data-id="title" type="hidden" name="partner[@{{counter}}][title]" value="@{{ title }}">
  <input data-id="logo" type="hidden" name="partner[@{{counter}}][logo]" value="@{{ logo }}">
  <td>
    @{{title}}
  </td>
  <td>
    <a href="#" data-featherlight="{{ url('image/original/') }}/@{{ logo }}"><img style="width:100px;border-radius:5px;" class="img-fluid"  src="{{ url('image/profile/')}}/@{{ logo }}" /></a>
  </td>
  <td>
    <button type="button" class="btn btn-danger" onclick="editDataPartner(this, @{{counter}})"><i class="fas fa-pencil-alt"></i></button>
    <button type="button" class="btn btn-primary" onclick="$('#data_partner_@{{ counter }}').remove()"><i class="fas fa-trash-alt"></i></button>
  </td>
</script>

<script type="x-tmpl-mustache" id="modal-partner-template">
  <div class="col-lg-12">
      <input type="hidden" id="data-partner" value="@{{data_partner}}" />
      <div class="form-group">
        <label>Title <span class="required">*</span></label> 
        <input type="text" placeholder="Title" id="title" value="@{{ title }}" class="form-control">
        <div class="help-block with-errors error"></div>
      </div>
      <div class="form-group">
        <label>Logo</label>
        <div style="position: relative; width: 128px;">
          <div class="lds-dual-ring hide"></div>
          <a href="javascript:;" class="upload-now">
            <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="@{{ logo_full }}" class="card-img-top img-fluid image-preview">
          </a>
          <a href="javascript:;"  class="remove-image-single">
            <i class="fa fa-times"></i>
          </a>
          <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
          <input type="hidden" name="logo" value="@{{ logo }}" id="logo" class="image-path">
          <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
        </div> 
      </div>
  </div>
</script>


<script type="text/javascript">
  var counterPartner = 0;
  async function renderModalPartner(data) {
    var response = new Promise((resolve, error) => {
      var template = $('#modal-partner-template').html();
      htmlBody = Mustache.render(template, data);
      $('#partnerModal').html(htmlBody);
      return resolve(true);
    });
    return await response;
  }


  async function addDataPartner(){

    if ($('#data-partner').val() !== '') {
      perhitungan = $('#data-partner').val();
    } else {
      perhitungan = counterPartner;
    }
    
    var data = {
      counter : perhitungan,
      title : $('#title').val(),
      logo : $('#logo').val(),
    }
    var html_awal = '<tr id="data_partner_'+counterPartner+'">';
    var template = $('#table-partner-template').html();
    html = Mustache.render(template, data);

    if($('#data-partner').val() !== ''){
      $('#data_partner_'+$('#data-partner').val()).html(html);
      $('#modal-partner').modal('hide');
      return true;
    }

    html_akhir = '</tr>';
    $('#partner-table tbody').append(html_awal + html + html_akhir);
    $('#modal-partner').modal('hide');
    counterPartner++;
  }

  async function editDataPartner(params, id) {
    var that = $(params).parents()[1];
    var inputs = $(that).find('input');
    var data = {data_partner : id};
    $.each(inputs, function(){
      data[$(this).data('id')] = $(this).val();
      if ($(this).data('id') == 'logo') {
        data['logo_full'] = "{{ url('image/original/') }}/"+$(this).val();
      }
    });
    renderModalPartner(data).then((response) => {
     $('#modal-partner').modal('show');
    })
  }


  $(document).ready(function() {
    $('#add-partner').on('click', function(){
      renderModalPartner({logo_full : 'https://via.placeholder.com/360x360'}).then((response) => {
        $('#modal-partner').modal('show');
      });
    });

    var dataPartner = {!! json_encode($partner) !!};
    $.each(dataPartner, function(key, value){
      var data = {
        counter : counterPartner,
        title : value.title,
        logo : value.logo
      }
      var html_awal = '<tr id="data_partner_'+counterPartner+'">';
      var template = $('#table-partner-template').html();
      html = Mustache.render(template, data);

      html_akhir = '</tr>';
      $('#partner-table tbody').append(html_awal + html + html_akhir);
      counterPartner++;
    })
  });
</script>
@stop