@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Manage Own Products') }}
                    <span id="addProductModalButton" style="text-decoration: underline; cursor: pointer;"> {{ __('Add Products') }} </span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable1" class="table table-hover mb-0 display compact nowrap">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD PRODUCT MODAL -->
<div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="product_name" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_name" type="text" class="form-control" name="product_name" required maxlength="255">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_desc" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Description') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_desc" type="text" class="form-control" name="product_desc" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_price" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Price') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_price" type="number" class="form-control" name="product_price" required step="0.01" onblur="formatPrice(this)">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#addProductModal">Close</button>
                <button type="button" class="btn btn-primary" id="addProduct">Add Product</button>
            </div>
        </div>
    </div>
</div>

<!-- PRODUCT ADDED MODAL -->
<div id="productAddedModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productAddedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productAddedModalLabel">Product Added</h5>
            </div>
            <div class="modal-body">
                <p>Product successfully added.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#productAddedModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- INCOMPLETE PRODUCT DETAILS MODAL -->
<div id="errorAddModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorAddModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorAddModalLabel">ERROR</h5>
            </div>
            <div class="modal-body">
                <p>Please complete the details for the product.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#errorAddModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ERROR IN ADD PRODUCT MODAL -->
<div id="errorProductAddedModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorProductAddedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorProductAddedModalLabel">ERROR</h5>
            </div>
            <div class="modal-body">
                <p>There was an error in adding the product.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#errorProductAddedModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT PRODUCT MODAL -->
<div id="editProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="product_name" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_name" type="text" class="form-control" name="product_name" required maxlength="255">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_desc" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Description') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_desc" type="text" class="form-control" name="product_desc" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_price" class="col-12 col-sm-4 col-form-label text-md-end">{{ __('Product Price') }}</label>
                    <div class="col-12 col-sm-8">
                        <input id="product_price" type="number" class="form-control" name="product_price" required step="0.01" onblur="formatPrice(this)">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#editProductModal">Close</button>
                <button type="button" class="btn btn-primary" id="editProduct">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- PRODUCT EDIT SUCCESS MODAL -->
<div id="productEditedModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productEditedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productEditedModalLabel">Product Edited</h5>
            </div>
            <div class="modal-body">
                <p>Product successfully edited.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#productEditedModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- INCOMPLETE EDIT PRODUCT DETAILS MODAL -->
<div id="errorEditDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorEditDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorEditDetailsModalLabel">ERROR</h5>
            </div>
            <div class="modal-body">
                <p>Please complete the details for the product.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#errorEditDetailsModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- PRODUCT EDIT ERROR MODAL -->
<div id="productEditErrorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productEditErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productEditErrorModalLabel">Product Edit Error</h5>
            </div>
            <div class="modal-body">
                <p>There was an error in updating your product.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#productEditErrorModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#deleteProductModal">Close</button>
                <button type="button" class="btn btn-primary" id="deleteProduct">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- DELETE SUCCESS MODAL -->
<div id="productRemovedModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productRemovedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productRemovedModalLabel">Product Removed</h5>
            </div>
            <div class="modal-body">
                <p>Product successfully removed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#productRemovedModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ERROR DELETE MODAL -->
<div id="errorProductRemoveModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorProductRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorProductRemoveModalLabel">Error Product Removal</h5>
            </div>
            <div class="modal-body">
                <p>There was an error in removing the product.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#errorProductRemoveModal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- AJAX ERROR MODAL -->
<div id="ajaxErrorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ajaxErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajaxErrorModalLabel">AJAX FUNCTION ERROR</h5>
            </div>
            <div class="modal-body">
                <p>There was an error in the AJAX function.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-target="#ajaxErrorModal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function formatPrice(input) {
    var value = parseFloat(input.value);
    if (isNaN(value)) {
        input.value = "";
    } else {
        input.value = value.toFixed(2);
    }
}
</script>

<script>
    $(document).on('click', '.close-button', function() {
        var modalId = $(this).data('target');

        $('#product_name').val('');
        $('#product_desc').val('');
        $('#product_price').val('');

        $(modalId).modal('hide');
    });
</script>

<!-- DATATABLE LOADING SCRIPT -->
<script>
    function format(d) {
        // `d` is the original data object for the row
        return (
            '<dl>' +
            '<dt>' + d.product_name + ' Description: </dt><dd>' + d.product_desc + '</dd>' +
            '</dl>'
        );
    }

    var table = $('#dataTable1').DataTable({
        processing: true,
        serverSide: true,
        scrollX: false,
        ajax: {
            url: '{{route('get_product')}}',
            type: 'GET'
        },
        columns: [
            {
                data: 'product_name',
                name: 'product_name',
                className: 'dt-control',
            },
            { data: 'product_price', name: 'product_price' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    return moment(data).format('MM/DD/YYYY HH:mm:ss');
                }
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function(data, type, row) {
                    return moment(data).format('MM/DD/YYYY HH:mm:ss');
                }
            },
            {
                data: null,
                name: 'actions',
                render: function(data, type, row) {
                    return `<button class="btn btn-primary edit-button" id="${row.id}">Edit</button> <button class="btn btn-danger delete-button" id="${row.id}">Delete</button>`;
                }
            },
        ]
    });

    table.on('click', 'td.dt-control', function (e) {
        let tr = e.target.closest('tr');
        let row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
        }
        else {
            row.child(format(row.data())).show();
        }
    });
</script>

<!-- EDIT PRODUCT SCRIPT -->
<script>
    var product_id;

    $('#dataTable1').on('click', '.edit-button', function(){
        product_id = $(this).attr('id');
        $('#editProductModal').modal('show');

        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: product_id
        };

        $.ajax({
            url: '{{ route('view_product_details') }}',
            type: 'GET',
            data: data,
            success: function(response){
                if(response.status_code == 200){
                    var product_details = response.product;

                    $('#editProductModal input[name="product_name"]').val(product_details.product_name);
                    $('#editProductModal input[name="product_desc"]').val(product_details.product_desc);
                    $('#editProductModal input[name="product_price"]').val(product_details.product_price);
                } else if (response.status_code == 400) {
                    $('#editProductModal').modal('hide');
                    $('#productEditErrorModal').modal('show');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                $('#editProductModal').modal('hide');
                $('#ajaxErrorModal').modal('show');
            }
        });
    });

    $('#editProduct').on('click', function(){
        var productName = $('#editProductModal input[name="product_name"]').val();
        var productDesc = $('#editProductModal input[name="product_desc"]').val();
        var productPrice = $('#editProductModal input[name="product_price"]').val();

        if (productName.trim() === '' || productDesc.trim() === '' || productPrice.trim() === '') {
            $('#editProductModal').modal('hide');
            $('#errorEditDetailsModal').modal('show');
            return;
        }

        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: product_id,
            product_name: productName,
            product_desc: productDesc,
            product_price: parseFloat(productPrice)
        };

        console.log(data);

        $.ajax({
            type: 'POST',
            url: '{{route('edit_product')}}',
            data: data,
            success: function(response){
                if(response.status_code == 200){
                    $('#editProductModal').modal('hide');
                    $('#productEditedModal').modal('show');
                    reloadTable();
                } else if (response.status_code == 400){
                    $('#editProductModal').modal('hide');
                    $('#ajaxErrorModal').modal('show');
                } else if (response.status_code == 422) {
                    $('#editProductModal').modal('hide');
                    $('#productEditErrorModal').modal('show');
                    $('#productEditErrorModal .modal-body').html('Are you sure you want to delete the product "' + JSON.stringify(response.errors) + '"?');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                $('#editProductModal').modal('hide');
                $('#ajaxErrorModal').modal('show');
            }
        });

    });
</script>

<!-- DELETE PRODUCT SCRIPT -->
<script>
    var product_id;

    $('#dataTable1').on('click', '.delete-button', function(){
        product_id = $(this).attr('id');
        var product_name = $(this).closest('tr').find('td:first').text();

        $('#deleteProductModal .modal-body').html('Are you sure you want to delete the product "' + product_name + '"?');

        $('#deleteProductModal').modal('show');
    });

    $('#deleteProduct').on('click', function(){
        var data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: product_id
        };

        $.ajax({
            type: 'DELETE',
            url: '{{ route('delete_product') }}',
            data: data,
            success: function(response){
                if(response.status_code == 200){
                    $('#deleteProductModal').modal('hide');
                    $('#productRemovedModal').modal('show');
                    reloadTable();
                } else if (response.status_code == 400){
                    $('#deleteProductModal').modal('hide');
                    $('#errorProductRemoveModal').modal('show');
                } else if (response.status_code == 422) {
                    $('#deleteProductModal').modal('hide');
                    $('#errorProductRemoveModal').modal('show');
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                $('#deleteProductModal').modal('hide');
                $('#ajaxErrorModal').modal('show');
            }
        });
    });
</script>

<!-- ADD PRODUCT SCRIPT -->
<script>
    $(document).ready(function() {
        $('#addProductModalButton').on('click', function(){
            $('#addProductModal').modal('show');
        });

        $('#addProduct').on('click', function () {
            var product_name = $('#product_name').val();
            var product_desc = $('#product_desc').val();
            var product_price = $('#product_price').val();

            if (product_name.trim() === '' || product_desc.trim() === '' || product_price.trim() === '') {
                $('#addProductModal').modal('hide');
                $('#errorAddModal').modal('show');
                return;
            }

            var data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_name: product_name,
                product_desc: product_desc,
                product_price: parseFloat(product_price)
            };

            $.ajax({
                type: 'POST',
                url: '{{route('add_product')}}',
                data: data,
                success: function(response){
                    if(response.status_code == 200){
                        $('#addProductModal').modal('hide');
                        $('#productAddedModal').modal('show');
                        reloadTable();
                    } else if (response.status_code == 400) {
                        $('#addProductModal').modal('hide');
                        $('#errorProductAddedModal').modal('show');
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                    $('#addProductModal').modal('hide');
                    $('#ajaxErrorModal').modal('show');
                }
            });
        });
    });
</script>

<!-- RELOAD DATATABLE SCRIPT -->
<script>
    $(document).ready(function() {
        function reloadTable(){
            table.ajax.reload(null, false);
        }

        window.reloadTable = reloadTable;
    });
</script>
@endsection
