
<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/bootstrap.min.css' ; ?>"> 
<!-- <link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/font-awesome.min.css' ; ?>">  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css" />

<?php
global $wpdb ; 

$getdata = $wpdb->get_results( "SELECT post_content
FROM $wpdb->posts
WHERE post_type = 'whatsapp-data'"
);
if($getdata){
  $mygetdata = unserialize($getdata[0]->post_content) ;
}


?>
<h1>Add Whatsapp Phone Number Notification</h1>
<div style="padding:2%">
<h5>Please register your phone number here first for Sender Whatsapp  <a target="_blank" href="https://4in44.top">REGISTER</a></h5>
<form method="post" action="">
<h5><b>Sender</b></h5>
  <div class="form-group row">
   
    <label for="no_meja" class="col-4 col-form-label">Sender Whatsapp Phone</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input placeholder="60123456789" id="luqwasapphone1" value="<?php echo (isset($_POST['luqwasapphone'][0])) ? $_POST['luqwasapphone'][0] :  (isset($mygetdata[0]) ? $mygetdata[0] : '') ; ?>" name="luqwasapphone[]" type="number"  class="form-control">
      
      </div>
    </div>
  </div> 

  <div class="form-group row">
   
    <label for="no_meja" class="col-4 col-form-label">Sender Whatsapp Token</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input placeholder="" id="luqwasapphone2" value="<?php echo (isset($_POST['luqwasapphone'][1])) ? $_POST['luqwasapphone'][1] :  (isset($mygetdata[1]) ? $mygetdata[1] : '') ; ?>" name="luqwasapphone[]" type="text"  class="form-control">
      
      </div>
    </div>
  </div> 

  <h5><b>Receiver</b></h5>
  <div class="form-group row">
 
    <label for="no_meja" class="col-4 col-form-label">Receiver Whatsapp Phone 1</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
       
        <input placeholder="60123456789" id="luqwasapphone3" value="<?php echo (isset($_POST['luqwasapphone'][2])) ? $_POST['luqwasapphone'][2] :  (isset($mygetdata[2]) ? $mygetdata[2] : '') ;  ?>" name="luqwasapphone[]" type="number"  class="form-control">
      
      </div>
    </div>
  </div> 

  <div class="form-group row">
    <label for="no_meja" class="col-4 col-form-label">Receiver Whatsapp Phone 2</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
      
        <input placeholder="60123456789" id="luqwasapphone4" value="<?php echo (isset($_POST['luqwasapphone'][3])) ? $_POST['luqwasapphone'][3] :  (isset($mygetdata[3]) ? $mygetdata[3] : '') ;  ?>" name="luqwasapphone[]" type="number"  class="form-control">
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
</div>


<?php


//https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8
if(isset($_POST['luqwasapphone'])){
  
  $tableName = $wpdb->prefix."options" ;
  $data_update = array('option_name' => 'whatsapp-data'
  ,'autoload' => 'yes'
  ,'option_value' => serialize($_POST['luqwasapphone'])
  );
  $data_where = array('option_name' => 'whatsapp-data');
  $result = $wpdb->update($tableName , $data_update, $data_where);
  //If nothing found to update, it will try and create the record.
  //print_r($data_where);print_r($result);exit();
  if ($result === FALSE || $result < 1) {
      $wpdb->insert($tableName, $data_update);
      $mengaji_id = $wpdb->insert_id;
  }

  echo "<h3>Successful Save</h3>" ;

}
