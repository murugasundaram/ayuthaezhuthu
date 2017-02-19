$(document).ready(function()    {

    // Adding a method
    $.validator.addMethod("regex",function(value,element,regexp)    {
        var re= new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Please use letters and numbers");

});

/**
 * Validate and add user
 */
$('.process-user-submission').click(function()   {

    $("#add-tenant-user").validate({
        submitHandler: function(form) {
            form.submit();
        }
    });

});

/**
 * Validate and process report
 */
$('.process-tenant-submission').click(function()   {

    $("#edit_tenant").validate({
        rules:   {
            organisation_unique_name: {
                regex: "^[a-zA-Z0-9]+$" // Only Characters and numbers
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

});

/**
 * Edit a tenant
 */
$('.edit-a-tenant').on('click', function()  {

    var url = $(this).data('url');
    window.location.href = url;

});

/**
 * Delete tenant
 */
$('.delete-a-tenant').click(function()    {

    var delete_confirm = confirm('Are you sure you want to delete this tenant ?');
    if(delete_confirm) {
        var id = $(this).data('id');
        window.location.href = 'tenants/destroy/' + id;
    }

});

/**
 * redirect to detail view of Reports
 */
$('.tenants-list tr td:not(:last-child)').click(function()  {

    var id = $(this).parent('tr').data('tenant-id');
    window.location.href = 'tenants/' + id;

});

/**
 * Get HTML for comments
 */
$('.change-tenant-status').on('click', function()   {

    var tenant_id = $(this).data('tenant-id');
    var status_id = $(this).data('status-id');
    var current_status_id = $(this).data('current-status-id');
    var url = $(this).data('url');

    // Clearing the html inside the div
    $('#add-comment-container').html('');

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            tenant_id: tenant_id,
            status_id: status_id,
            current_status_id: current_status_id
        },
        success:function(data)  {
            if(data.success == true)    {
                $('#modal-loading').hide();
                // Appending the generated HTML
                $('#add-comment-container').html(data.result);
            }
            else {
                // TODO capture failure and show error message

            }
        }
        // TODO capture failure and show error message
    });

});

