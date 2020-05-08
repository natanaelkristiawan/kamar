<script src="{{ asset('themes/vertical') }}/assets/js/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>

<script src="{{ asset('themes') }}/additionals/chosen/chosen.js"></script>
<script src="{{ asset('themes') }}/additionals/switchery/switchery.js"></script>
<script src="{{ asset('themes') }}/additionals/sortable/Sortable.min.js"></script>
<script src="{{ asset('themes') }}/additionals/sortable/jquery-sortable.js"></script>
<script src="{{ asset('themes') }}/additionals/dropzone/dropzone.min.js"></script>
<script src="{{ asset('themes') }}/additionals/toastr/toastr.min.js"></script>
<script src="{{ asset('themes') }}/additionals/summernote/summernote-bs4.js"></script>
<script src="{{ asset('themes') }}/additionals/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- jQuery  -->
<script src="{{ asset('themes/vertical') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('themes/vertical') }}/assets/js/metisMenu.min.js"></script>
<script src="{{ asset('themes/vertical') }}/assets/js/jquery.slimscroll.js"></script>
<script src="{{ asset('themes/vertical') }}/assets/js/waves.min.js"></script>
<script src="{{ asset('themes') }}/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>


<!-- Required datatable js -->
<script src="{{ asset('themes') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ asset('themes') }}/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/jszip.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/pdfmake.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/vfs_fonts.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/buttons.print.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="{{ asset('themes') }}/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{ asset('themes') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>


<!-- App js -->
<script src="{{ asset('themes/vertical') }}/assets/js/app.js"></script>

<script type="text/javascript">
  Dropzone.autoDiscover = false; 
  function sendFile(file, editor, uploadUrl) { 
    data = new FormData();
    data.append("file", file);
    data.append("_token", $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
      data: data,
      type: "POST",
      url: uploadUrl,
      cache: false,
      beforeSend: function() {
        ajax_start();
      },
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(url) {
        var image = $('<img>').attr('src',url.url);
        editor.summernote("insertNode", image[0]);
      },
      complete: function(){
        ajax_stop();
      }
    });
  }


  ajax_running = false;
  function ajax_start() {
    ajax_running = true;
  }
  function ajax_stop() {
    ajax_running = false;
  }
  function slugify(text)
  {
    return text.toString().toLowerCase()
      .replace(/\s+/g, '-')           // Replace spaces with -
      .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start of text
      .replace(/-+$/, '');            // Trim - from end of text
  }
  $(window).on('load', function(){

    $('.chosen-select').chosen({width: "100%"}).change(function(event, info) {


      if (info.selected) {
        var allSelected = this.querySelectorAll('option[selected]');
        var lastSelected = allSelected[allSelected.length - 1];
        var selected = this.querySelector(`option[value="${info.selected}"]`);
        selected.setAttribute('selected', '');

        if (typeof lastSelected !== "undefined") {
          lastSelected.insertAdjacentElement('afterEnd', selected);
        }
      } else { // info.deselected
        var removed = this.querySelector(`option[value="${info.deselected}"]`);
        removed.setAttribute('selected', false); // this step is required for Edge
        removed.removeAttribute('selected');
      }
      $(this).trigger("chosen:updated");
    });
    $('.tagsinput').tagsinput({
      tagClass: 'btn btn-sm mb-2 btn-primary'
    });


    $('.bootstrap-tagsinput input').keydown(function( event ) {
      if ( event.which == 13 ) {
          $(this).blur();
          $(this).focus();
          return false;
      }
    });
  });


@if(session()->has('status'))
  toastr.success("{{session()->get('status')}}");
@endif


@if(session()->has('status_error'))
  toastr.error("{{session()->get('status_error')}}");
@endif
</script>
@section('script')
@show