<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('peserta/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],
 
    });
 
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
            function add_peserta()
            {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                $('#modal_peserta').modal('show'); // show bootstrap modal
                $('.modal-title').text('Add Peserta'); // Set Title to Bootstrap modal title
                
                $('#photo-preview').hide(); // hide photo preview modal
 
                $('#label-photo').text('Upload Photo'); // label photo upload
            }

            function edit_peserta(id)
            {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string

                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('peserta/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="fullname"]').val(data.fullname);
                        $('[name="gender"]').val(data.gender);
                        $('[name="email"]').val(data.email);
                        $('[name="phoneNumber"]').val(data.phoneNumber);
                        $('[name="dateOfBirth"]').datepicker('update',data.dateOfBirth);
                        
                        $('#modal_peserta').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Peserta'); // Set title to Bootstrap modal title
                        $('#photo-preview').show(); // show photo preview modal
 
                        if(data.photo)
                        {
                            $('#label-photo').text('Change Photo'); // label photo upload
                            $('#photo-preview div').html('<img src="'+base_url+'public/photo/'+data.photo+'" class="img-responsive">'); // show photo
                            $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo
            
                        }
                        else
                        {
                            $('#label-photo').text('Upload Photo'); // label photo upload
                            $('#photo-preview div').text('(No photo)');
                        }
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function reload_table()
            {
                table.ajax.reload(null,false); //reload datatable ajax 
            }

            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;

                if(save_method == 'add') {
                    url = "<?php echo site_url('peserta/ajax_add')?>";
                } else {
                    url = "<?php echo site_url('peserta/ajax_update')?>";
                }
                var formData = new FormData($('#form')[0]);
                $.ajax({
                    url : url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data)
                    {
            
                        if(data.status) //if success close modal and reload ajax table
                        {
                            $('#modal_peserta').modal('hide');
                            reload_table();
                        }
                        else
                        {
                            for (var i = 0; i < data.inputerror.length; i++) 
                            {
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
            
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
            
                    }
                });
            }

            function delete_peserta(id)
            {
                if(confirm('Are you sure delete this data?'))
                {
                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('peserta/ajax_delete')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            $('#modal_peserta').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });

                }
            }

        </script>|       