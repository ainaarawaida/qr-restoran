


<h1>Generate QR Code</h1>
<div style="padding:2%">
<form method="post" action="">
  <div class="form-group row">
    <label for="no_meja" class="col-4 col-form-label">No Meja</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input id="no_meja" name="no_meja" value="<?php echo isset($_GET['no_meja']) ? $_GET['no_meja'] : '' ; ?>" type="number" required="required" class="form-control">
      </div>
    </div>
  </div> 

  <div class="form-group row">
    <label for="textarea" class="col-4 col-form-label">Penerangan</label> 
    <div class="col-8">
      <textarea id="keterangan_meja" name="keterangan_meja" placeholder="Jumlah Kerusi" cols="40" rows="5" class="form-control"></textarea>
    </div>
  </div> 
  
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>



<?php
//https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8
if(isset($_POST['no_meja'])){

  global $wpdb ;

  $link_url = home_url("shop/?setmejaid="). $_POST['no_meja'] ;

  $tableName = $wpdb->prefix."posts" ;
  $data_update = array('post_type' => 'no_meja'
  ,'post_title' => $wpdb->esc_like( $_POST['no_meja'] )
  ,'post_content' => $wpdb->esc_like( $_POST['keterangan_meja'] )
  ,'post_status' => 'kosong' 
  ,'guid' => $wpdb->esc_like( $link_url )
  );

  $data_where = array('post_title' => $wpdb->esc_like( $_POST['no_meja'] ));
  $result = $wpdb->update($tableName , $data_update, $data_where);
  //If nothing found to update, it will try and create the record.
  //print_r($data_where);print_r($result);exit();
  if ($result === FALSE || $result < 1) {
      $wpdb->insert($tableName, $data_update);
      $meja_id = $wpdb->insert_id;
      ?>
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success Insert New!</strong> New Table Inserted.
      </div>
      <?php
    
  }else{
    ?>
    <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success Updated!</strong> Table Updated.
    </div>
    <?php
  }

    ?>
      <div style='padding:2%'>
      <style>
        * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
            color-adjust: exact !important;                 /*Firefox*/
        }
        </style>
      <input type='button' id='btn' value='Print' onclick='printDiv();'><div id='myqrcode'>
    <?php
    echo "<h1>Meja No:". $_POST['no_meja']."</h1>" ; 
    //print_r($link_url);
    echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$link_url.'%2F&choe=UTF-8" alt="QR Code" width="300" height="300"></div></div>' ;
    ?>
          
        <script>
        function printDiv()
        {
        
        var divToPrint=document.getElementById('myqrcode');
        
        var newWin=window.open('','Print-Window');
        
        newWin.document.open();
        
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        
        newWin.document.close();
        newWin.document.focus(); // necessary for IE >= 10*/
        newWin.document.print();
        
        setTimeout(function(){newWin.close();},20);
        
        }
        </script>
</div>
    <?php



}
