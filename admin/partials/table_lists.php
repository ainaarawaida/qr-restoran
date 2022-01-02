
<div id="wpbody" role="main" style="margin-top: 10px;">
<div id="wpbody-content" style="padding: 2%;">


<h3>Table Lists</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        
<?php

global $wpdb ; 
$getdata = $wpdb->get_results( "SELECT post_title, post_content, post_status
FROM $wpdb->posts
WHERE post_type = 'no_meja'"
);


?>

        <thead>
            <tr>
                <th>No Meja</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No Meja</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>


<script>
$(document).ready(function() {

    var table =  $('#example').DataTable({
        ajax: {
            url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
            type: 'POST',
            data: {
                'action': 'luq_qrr_tablelist_process'
            },
        }
    });

    setInterval( function () {
        table.ajax.reload();
    }, 30000 );


} );



</script>