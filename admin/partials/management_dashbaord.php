
<?php
echo "<h1>Dashboard</h1>";

global $wpdb;

if(isset($_POST['luq_qrr_query_report'])){

}else{
    $date_curr = date('Ym');
}

$totaldate = $wpdb->get_results(
    $wpdb->prepare("SELECT DATE_FORMAT(a.post_date,'%Y%m') FROM `wp_posts` 
    WHERE post_type = 'shop_order' AND
    post_status IN ('wc-completed') 
    group BY DATE_FORMAT(a.post_date,'%Y%m') 
    ")
);

$totalsum = $wpdb->get_results(
        $wpdb->prepare("SELECT sum(b.meta_value) as totalsum FROM wp_posts a LEFT JOIN wp_postmeta b ON a.id = b.post_id WHERE 
        b.meta_key = '_order_total' AND
        a.post_type = 'shop_order' AND
        a.post_status IN ('wc-completed') AND
        DATE_FORMAT(a.post_date,'%Y%m') = '{$date_curr}'
        ")
);

// deb(count($totaldate));

?>

<form method="post" action="">
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Select Month</label> 
    <div class="col-8">
      <select id="select" name="luq_qrr_query_report" class="custom-select">
    <?php if (isset($totaldate) && count($totaldate) > 0){ 
        foreach($totaldate AS $key => $val) { ?>
  <option value="<?php echo $val ; ?>"><?php echo $val ; ?></option>

    <?php   } 
        }else{  ?>
        <option value="0">Current</option>

    <?php } ?>
      
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/bootstrap.min.css' ; ?>"> 
<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/font-awesome.min.css' ; ?>"> 

<div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <h2>Total Sales Current Month (<?php echo  date('M Y'); ?>)</h2>
        </div>  
        
        <div class="row">
            <h3>RM <?php echo $totalsum[0]->totalsum == '' ? number_format((float)0, 2, '.', '') :number_format((float)$totalsum[0]->totalsum, 2, '.', '') ;   ?> </h3>
        </div>    
        

        

        <hr>

      </div>