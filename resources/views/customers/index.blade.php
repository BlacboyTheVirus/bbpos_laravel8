@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Laravel') }} - Customers</title>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css') }}">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
 
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Customer') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-success card-outline">
                        

                        <div class="card-header">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="icheck-info d-inline">
                                            <input type="checkbox" id="amount-due-check" >
                                            <label for="amount-due-check">View Account Receivable Customers</label>
                                          </div>   
                                    </div>

                                    <div class="card-tools">
                
                                        <a class="btn btn-block btn-success" id="add-button" href="">
                                            <i class="fa fa-plus"></i> New Customer
                                        </a>
                                      </div>

                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="card-body">
                            
                            <table id="customerTable" class="table  table-hover">
                                <thead>
                                <tr> 
                                  <th class="exportable">Customer Code</th>
                                  <th class="exportable">Name</th>
                                  <th class="exportable">Phone</th>
                                  <th class="exportable">Email</th>
                                  <th class="exportable" style="text-align: right">Invoices </th>
                                  <th class="exportable" style="text-align: right">Total Invoice</th>
                                  <th class="exportable" style="text-align: right">Previous Due</th>
                                  <th class="exportable" style="text-align: right">Sales Due</th>
                                  <th class="exportable" style="text-align: right">Total Due</th>
                                  <th class="nosort"></th>
                                </tr>
                                </thead>

                                <tbody>

                                </tbody>

                                <tfoot>
                                    <tr style="background-color:#f4f6f9 !important">
                                        <th class="exportable"></th>
                                        <th class="exportable"></th>
                                        <th class="exportable"></th>
                                        <th class="exportable" style="text-align: right">Total</th>
                                        <th class="exportable" style="text-align: right"></th>
                                        <th class="exportable" style="text-align: right"></th>
                                        <th class="exportable" style="text-align: right"></th>
                                        <th class="exportable" style="text-align: right"></th>
                                        <th class=" exportable" style="text-align: right"></th>
                                        <th class="nosort"></th> 
                                    </tr>
                                </tfoot>
                                
                              </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <style>
        #customerTable td:nth-child(4){text-align: right;}
        #customerTable td:nth-child(5){text-align: right;}
        #customerTable td:nth-child(6){text-align: right;}
        #customerTable td:nth-child(7){text-align: right;}
        #customerTable td:nth-child(8){text-align: right;}
        #customerTable td:nth-child(9){text-align: right;}
    </style>

    

@endsection


@section('modals')
        <!-- ADD CUSTOMER MODAL -->
        <div class="modal hide fade" tabindex="-1" id="modal-create">
            <div class="modal-dialog modal-dialog-centered">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Customer <span id="new_customer_code" class="text-info"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        
                        <form action = "{{ route('customers.store') }}" id="customers-create-form" method="post"> 
                            @csrf
                            
                            <input type="hidden" id="count_id"  name="count_id"  value="">
                            <input type="hidden" id="customer_code"  name="customer_code"  value="">

                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" class="form-control form-control-border basicAutoComplete" id="customer_name" name="customer_name"  placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="text" class="form-control form-control-border" id="customer_phone" name="customer_phone"  placeholder="Enter Phone">
                            </div>

                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="email" class="form-control form-control-border" id="customer_email" placeholder="Enter Email">
                            </div>

                            <div class="form-group">
                                <label for="customer_amount_due">Amount Due</label>
                                <input type="customer_amount_due" class="form-control form-control-border" id="customer_amount_due" placeholder="Enter Amount (eg 0.00)" value="0.00">
                            </div>

                            
                            
                            
                    
                        </form>

                    </div>

                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createSave" >Save changes</button>
                    </div>
                </div> 

            </div>  
        </div>

        <!-- EDIT CUSTOMER MODAL -->  
        <div class="modal hide fade" tabindex="-1" id="modal-edit">
            <div class="modal-dialog modal-dialog-centered">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Customer <span class="text-info" id="edit_customer_code"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        
                        <form action = "{{ route('customers.update') }}" id="customers-edit-form" method="post"> 
                            @csrf
                        
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" class="form-control form-control-border" id="customer_name" name="customer_name"  placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="text" class="form-control form-control-border" id="customer_phone" name="customer_phone"  placeholder="Enter Phone">
                            </div>

                            <div class="form-group">
                                <label for="customer_email">Customer Email</label>
                                <input type="text" class="form-control form-control-border" id="customer_email" placeholder="Enter Email">
                            </div>

                            <div class="form-group">
                                <label for="customer_amount_due">Previous Amount Due</label>
                                 <input type="text" class="form-control form-control-border" id="customer_amount_due" name="customer_amount_due" placeholder="Enter Previous Amount Due">
                            </div>

                            <input type="hidden" id="customer_id"  name="customer_id"  value="">
                            
                            
                    
                        </form>

                    </div>

                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editSave" >Save changes</button>
                    </div>
                </div> 

            </div>  
        </div>

      


        <!-- VIEW PAY PREVIOUS DUE  MODAL -->  
        <div class="modal hide fade" tabindex="-1" id="modal-paypreviousdue">
            <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pay Previous Due</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                            <form id="paydue_form" method="post">
                                <input type="hidden" id="prev_customer_id" name="prev_customer_id" value="">
                                <label class="text-md">Previous Due: <b>N <span id="previous_amt_due"></span></b> </label>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="text" class="form-control form-control-border" id="prev_amount_paid" name="prev_amount_paid" placeholder="Enter Amount Paid" aria-invalid="false">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="prev_payment_method">Payment Method</label>
                                        <select type="text" class="form-control form-control-border" id="prev_payment_method" name="prev_payment_method"  aria-invalid="false">
                                            <option value="">--Select Payment Option --</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                            <option value="pos">POS</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                    </div>

                    <div class="modal-footer justify-content-right">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="paySave">Save </button>
                    </div>
                </div> 

            </div>  
        </div>

        <!-- VIEW PAYMENTS MODAL -->  
        <div class="modal hide fade" tabindex="-1" id="modal-transactions">
            <div class="modal-dialog  modal-lg">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transactions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" id="modal-transactions-detail">

                    </div>

                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div> 

            </div>  
        </div>


@endsection


@section('scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>

    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    
    <script>


        $('document').ready(function(){

           

            ///////////////////////////////////////
            // Validate EDIT FORM
            ///////////////////////////////////////
              var editvalidator = $('#customers-edit-form').validate({
                    rules: {
                        customer_name: {
                            required: true,
                        },
                        customer_phone: {
                            required: false,
                        },
                        customer_email: {
                            required: false,
                            email: true,
                        },
                    },
                    messages: {
                        customer_email: {
                            email: "Please enter a valid email address"
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });

            /////////////////////////////////////////
            // Validate PAY PREVIOUS DUE  FORM
            ////////////////////////////////////////
              var payvalidator = $('#paydue_form').validate({
                    rules: {
                        prev_amount_paid: {
                            required: true,
                        },
                        prev_payment_method: {
                            required: true,
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });

            //////////////////////////
            //validate CREATE FORM
            //////////////////////////
              var createvalidator = $('#customers-create-form').validate({
                    rules: {
                        customer_name: {
                            required: true,
                        },
                        customer_phone: {
                            required: false,
                        },
                        customer_email: {
                            required: false,
                            email: true,
                        },
                    },
                    messages: {
                        customer_email: {
                            email: "Please enter a valid email address"
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });

            /////////////////////////////////////////////
            // Add button clicked
            ////////////////////////////////////////////
            $( 'body' ).on('click', "#add-button", function(e){
                e.preventDefault();
                
                //ajax call
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                 $.get('{{route('customers.create')}}', function (cdata) {
                   $('#customers-create-form #count_id').val(cdata.count_id);
                   $('#customers-create-form #customer_code').val(cdata.customer_code);
                   $(' #new_customer_code').html(cdata.customer_code);
                   
                }); //end get

                $('#modal-create').modal('show');

            });


           

            ////////////////////////////////////////////
            // CREATE BUTTON CLICK TO SAVE
            ///////////////////////////////////////////
            $('#createSave').click(function(e){
                e.preventDefault();
                
                if(!createvalidator.form()){
                    return false;
                };
                
                //submit
                var formData = {
                    count_id: $('#count_id').val(),
                    customer_code: $("#customers-create-form #customer_code").val(),
                    customer_name: $("#customers-create-form #customer_name").val(),
                    customer_phone: $("#customers-create-form #customer_phone").val(),
                    customer_email: $("#customers-create-form #customer_email").val(),
                    customer_amount_due: $("#customers-create-form #customer_amount_due").val(),
                };

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('customers.store') }}',
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    if (data.status){
                        $('#modal-create').modal('hide'); 
                        $('#customerTable').DataTable().ajax.reload();
                        $('#customers-create-form').trigger('reset');
                        toastr.success(data.message);
                    } else{
                        toastr.error(data.message);
                    }
                });
                
            });

            

             ////////////////////////////////////////////
            // PAY PREVIOUS SAVE  BUTTON CLICK
            ///////////////////////////////////////////
            $('#paySave').click(function(e){
                e.preventDefault();
                
                if(!payvalidator.form()){
                    return false;
                };

                if( $('#prev_amount_paid').val() < parseFloat($('#previous_amt_due').text().replace(/,/g, ''))  ){
                    toastr.error("Amount paid must NOT be less than amount due.");
                    return false;
                }
                
                //submit
                var formData = {
                    customer_id: $("#paydue_form #prev_customer_id").val(),
                    prev_amt_paid: $("#paydue_form #prev_amount_paid").val(),
                    prev_payment_method: $("#paydue_form #prev_payment_method").val(),
                };

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('customers.payprevious') }}',
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    if (data.status){
                        $('#modal-paypreviousdue').modal('hide'); 
                        $('#customerTable').DataTable().ajax.reload();
                        $('#paydue_form').trigger('reset');
                        toastr.success(data.message);
                    } else{
                        toastr.error(data.message);
                    }
                });
                
            })
            



            /////////////////////////////////////////////
            // Edit Button Clicked
            ////////////////////////////////////////////
            $( '#customerTable' ).on('click', ".edit-button", function(e){

                e.preventDefault(); 
                
                $('#customers-edit-form').trigger('reset');

                var customer_id = $(this).attr('id');
                $('#customers-edit-form #customer_id').val( customer_id );
                
                //ajax call
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                //populate edit form field
                var url = "{{ route('customers.edit', ':customer_id') }}";
                url = url.replace(':customer_id', customer_id);
                $.get(url, function (edata) {
                   $('#customers-edit-form #customer_name').val(edata.customer_name);
                   $('#customers-edit-form #customer_phone').val(edata.customer_phone);
                   $('#customers-edit-form #customer_email').val(edata.customer_email);
                   $('#customers-edit-form #customer_amount_due').val(edata.customer_amount_due);
                   $('#edit_customer_code').html(edata.customer_code);

                   $('#modal-edit').modal('show'); 
                }); //end get

            });  // END EDIT BUTTON CLICKED

            $('#modal-create').on('shown.bs.modal', function() {
               // $(this).find('[autofocus]').focus();
                $('#customer_name').focus();
            });


            ////////////////////////////////////////////
            // EDIT BUTTON SAVE CLICKED
            ///////////////////////////////////////////
            $('#editSave').click(function(e){
                e.preventDefault();
                
                if(!editvalidator.form()){
                    return false;
                };
                
                //submit
                var formData = {
                    customer_id: $('#customers-edit-form #customer_id').val(),
                    customer_name: $("#customers-edit-form #customer_name").val(),
                    customer_phone: $("#customers-edit-form #customer_phone").val(),
                    customer_email: $("#customers-edit-form #customer_email").val(),
                    customer_amount_due: $("#customers-edit-form #customer_amount_due").val(),
                };

                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                $.ajax({
                    type: "POST",
                    url: '{{ route('customers.update') }}',
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    if (data.status){
                        $('#modal-edit').modal('hide'); 
                        $('#customerTable').DataTable().ajax.reload();
                        toastr.success(data.message);
                    } else{
                        toastr.error(data.message);
                    }
                });
                
            });


          
            /////////////////////////////////////////////
            //Fetch all Customer Records for Datatable
            ////////////////////////////////////////////
            function load_datatable(show_account_receivable ='unchecked'){
                table =   $('#customerTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true, 
                    fixedHeader: {
                    header: true,
                        headerOffset: $('.main-header').height()+15
                    },
                    lengthChange: true,
                    autoWidth: false,
                    info: true,
                    ajax: {
                        url: "{{route('customers.ajax')}}",
                        data: {
                            'show_account_receivable': show_account_receivable
                        }
                    },
                    columns: [
                        { data: 'customer_code' },
                        { data: 'customer_name' },
                        { data: 'customer_phone' },
                        { data: 'customer_email' },
                        { data: 'invoice_count', 
                          sType: "numeric",
                          render: function ( data, type, row, meta ) {
                                         return ( parseFloat(data));
                          }
                        },
                        { data: 'total_invoice', 
                          sType: "numeric",
                          render: function ( data, type, row, meta ) {
                                         return ( parseFloat(data).toLocaleString(undefined, {minimumFractionDigits:2}) );
                          }
                        },
                        { data: 'customer_amount_due', 
                          sType: "numeric",
                          render: function ( data, type, row, meta ) {
                                         return ( parseFloat(data).toLocaleString(undefined, {minimumFractionDigits:2}) );
                          }
                        },
                        { data: 'customer_invoice_due', 
                          sType: "numeric",
                          render: function ( data, type, row, meta ) {
                                         return ( parseFloat(data).toLocaleString(undefined, {minimumFractionDigits:2}) );
                          }
                        },
                        { data: 'total_dues', 
                          sType: "numeric",
                          render: function ( data, type, row, meta ) {
                                         return ( parseFloat(data).toLocaleString(undefined, {minimumFractionDigits:2}) );
                          }
                        },
                        { data: 'action'},
                    ],
                    language: {
                        processing: '<div style="padding:0.75rem;position: relative;z-index:99999;overflow: visible; background:#fff">Loading...</div>'
                    },
                    aoColumnDefs: [
                        
                        {bSortable: false,'aTargets': ['nosort']},
                        {searchable: false, "aTargets": ['nosort'] }
                    ],
                    buttons: [
                                {extend: "copy", footer:true, exportOptions: {columns: [ '.exportable' ]} },
                                {extend: "csv", footer:true, exportOptions: {columns: [ '.exportable' ]} },
                                {extend: "excel", footer:true, exportOptions: {columns: [ '.exportable' ]} },
                                {extend: "pdfHtml5", footer:true, exportOptions: {columns: [ '.exportable' ]} },
                                {extend: 'print', footer:true, exportOptions: {columns: [ '.exportable' ]} }, 
                                "colvis"
                                ],
                    dom: '<"row" <"col-md-3"l> <"#top.col-md-6">  <"col-md-3"f> > rt <"row"  <"col-md-6"i> <"col-md-6"p> ><"clear">',
                    "initComplete": function(settings, json) {
                                    $(this).DataTable().buttons().container()
                                    .appendTo( ('#top'));
                                    },
                    
                                    drawCallback: function () {
                                        var api = this.api();
                                        var sum = 0;
                                        var formated = 0;
                                        //to show first th
                                        $(api.column(3).footer()).html('Total');

                                        sum = api.column(4, {page:'current'}).data().sum();
                                            //to format this sum
                                            formated = parseFloat(sum);
                                            $(api.column(4).footer()).html(formated);

                                            sum = api.column(5, {page:'current'}).data().sum();
                                            //to format this sum
                                            formated = parseFloat(sum).toLocaleString( "en-US", {minimumFractionDigits:2});
                                            $(api.column(5).footer()).html('₦ '+ formated);

                                            sum = api.column(6, {page:'current'}).data().sum();
                                            //to format this sum
                                            formated = parseFloat(sum).toLocaleString( "en-US", {minimumFractionDigits:2});
                                            $(api.column(6).footer()).html('₦ '+ formated);

                                             sum = api.column(7, {page:'current'}).data().sum();
                                            //to format this sum
                                            formated = parseFloat(sum).toLocaleString( "en-US", {minimumFractionDigits:2});
                                            $(api.column(7).footer()).html('₦ '+ formated);

                                            sum = api.column(8, {page:'current'}).data().sum();
                                            //to format this sum
                                            formated = parseFloat(sum).toLocaleString( "en-US", {minimumFractionDigits:2});
                                            $(api.column(8).footer()).html('₦ '+ formated);
                                        
		                             }

                                    
                }); // end DataTable

                            
            } // end load_datatable
            
            load_datatable();

            //Positive Decimal
             $("#customer_amount_due , #prev_amount_paid" ).inputFilter(function(value) {
                 return /^\d*[.]?\d{0,2}$/.test(value); 
            });

            $("#amount-due-check").change(function() {
                    $('#customerTable').DataTable().destroy();
                    if(this.checked){
                        load_datatable('checked');
                    } else {
                        load_datatable();//default unchecked
                    }
                    
                });

        }); //end Document Ready

        var AdminLTEOptions = {
            sidebarExpandOnHover: true,
            navbarMenuHeight: "200px", //The height of the inner menu
            animationSpeed: 250,
        };
        

    //////////////////////////////////////////////
    // DELETE CUSTOMER
    /////////////////////////////////////////////
    function delete_customer(id){
        if (confirm("Do you want to delete the Customer? All Invoices will be moved to Walk-In-Customer") == true) {
            $.ajax({
                url: "/customers/delete/"+id,
                type: "get", //send it through get method
                success: function(response) {
                    if (response.status == 1){
                        $('#customerTable').DataTable().ajax.reload();
                        toastr.success(response.message);
                        
                    } else {
                        toastr.error(response.message);
                    }
                
                },
                error: function(xhr) {
                    toastr.error('Ooopsy! Something unintended just happened. ')
                }
            }); // end ajax
        }

    }

  
    //////////////////////////////////////////////
    // Delete Invoice 
    //////////////////////////////////////////////

    function delete_invoice(id){
        if (confirm("Do you want to delete the Invoice?") == true) {
            $.ajax({
                url: "/invoices/delete/"+id,
                type: "get", //send it through get method
                success: function(response) {
                    if (response.status == 1){
                        $('#invoice_'+id).remove(); 
                        var total_invoice_row = 0;
                        var total_payment_row = 0;
                        var total_due_row = 0;
                        $('.grandtotal_row').each(function(){
                            total_invoice_row  +=  parseFloat($(this).text().replace(/,/g, ''));
                        });
                        $('.payment_row').each(function(){
                            total_payment_row   +=  parseFloat($(this).text().replace(/,/g, ''));
                        });
                        $('.amountdue_row').each(function(){
                            total_due_row  +=  parseFloat($(this).text().replace(/,/g, ''));
                        });

                        
                        $('.add_total_invoice').html('₦ '+parseFloat(total_invoice_row).toLocaleString(undefined, {minimumFractionDigits:2}));
                        $('.add_total_payment').html('₦ '+parseFloat(total_payment_row).toLocaleString(undefined, {minimumFractionDigits:2}));
                        $('.add_total_due').html('₦ '+parseFloat(total_due_row).toLocaleString(undefined, {minimumFractionDigits:2}));
                        
                        $('#customerTable').DataTable().ajax.reload();

                        toastr.success(response.message);
                        
                    } else {
                        toastr.error(response.message);
                    }
                
                },
                error: function(xhr) {
                    toastr.error('Ooopsy! Something unintended just happened. ')
                }
            }); // end ajax
        }

    } // end delete_payment()


    ////////////////////////////////////////
    /// VIEW PAYMENTS
    ////////////////////////////////////////
                            
        function view_transactions(id){
                //ajax call
                 $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                $.ajax({
                    url: "{{ route('customers.transactions') }}",
                    type: "get", //send it through get method
                    data: { 
                        id: id, 
                    },
                    success: function(response) {
                        $('#modal-transactions-detail').html(response);
                        $('#modal-transactions').modal('show');
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }
                });
                
        }   



         ////////////////////////////////////////
        /// PAY PREVIOUS
        ////////////////////////////////////
                            
        function show_pay_previous(id){
                //ajax call
                 $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
                });

                $.ajax({
                    url: "{{ route('customers.showpayprevious') }}",
                    type: "get", //send it through get method
                    data: { 
                        id: id, 
                    },
                    success: function(response) {
                        $('#previous_amt_due').html(response);
                        $('#prev_customer_id').val(id);                        
                        $('#modal-paypreviousdue').modal('show');
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }
                });
                
        }   

        
    </script>
@endsection