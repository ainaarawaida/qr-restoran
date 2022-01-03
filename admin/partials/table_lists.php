
<div id="wpbody" role="main" style="margin-top: 10px;">
<div id="wpbody-content" style="padding: 2%;">


<h3>Table Lists</h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        
<?php

global $wpdb ; 


if(isset($_GET['action']) && $_GET['action'] === 'deletetable'){
   
    $getdata = $wpdb->get_results( "SELECT post_title, post_content, post_status
    FROM $wpdb->posts
    WHERE post_type = 'no_meja'"
    );
    $wpdb->delete( $wpdb->posts, array( 'id' => $_GET['post_id'] ) );

    ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Table success deleted.
  </div>
  
    <?php
}




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


<!-- Modal -->
<div class="modal fade" id="qrgenerate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog" >
    <div class="modal-content">
        <div   id="printSection">
            <style>

@media print {
      body, html, #wrapper {
          width: 100%;
      }
}
</style>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">No meja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$link_url.'%2F&choe=UTF-8" alt="QR Code" width="300" height="300">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="printthis" >Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
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


    document.getElementById("example").addEventListener("click", function(e) {
        if(e.target.id == 'datadelete'){
            if (confirm("Confirm to Delete?")) {
                window.location.href = "<?php echo admin_url( 'admin.php?page=luq_qrr-lib-table-lists&action=deletetable&post_id="+e.target.getAttribute("dataid")+"' ) ?>";
                return false;
            } else {
                return false;
            }
        }else if(e.target.id == 'dataqr'){
            document.getElementById('exampleModalLabel').innerHTML = "No Meja "+ e.target.getAttribute("dataid"); 
        }
       
    });

    document.getElementById("qrgenerate").addEventListener("click", function(e) {
        if(e.target.id == 'printthis'){
            printDiv('printSection');
        }
       
    });

  

} );


function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
 
     document.body.innerHTML = printContents;
 
     window.print();
     
    location.reload(); 
}




</script>

