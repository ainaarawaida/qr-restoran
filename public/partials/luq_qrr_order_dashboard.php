
<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/bootstrap.min.css' ; ?>"> 
<!-- <link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/font-awesome.min.css' ; ?>">  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<h1>Dashboard Order</h1>
<div style="padding:2%" id="luq_qrr_ordertable">

<?php
global $wpdb ; 

$output_data = $wpdb->get_results(
    $wpdb->prepare("SELECT ID, post_status, post_date FROM `wp_posts` 
    WHERE post_type = 'shop_order' AND
    post_status IN ('wc-on-hold', 'wc-processing') ORDER BY ID ASC
    ")
);


?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Table</th>
      <th scope="col">Order Time</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
      <?php $count = 0 ; 
      foreach ($output_data AS $key => $val){ 
          ?>
    <tr>
      <th scope="row"><?php echo $val->ID ; ?> </th>
      <td><?php echo get_post_meta( $val->ID, 'mejaid', true ) ; ?></td>
      <td><?php echo $val->post_date ; ?></td>
      <td><?php echo substr($val->post_status, 3) ; ?></td>
    </tr>
    <?php 
        if($count > 10)
            break ;

} ?>
   
  </tbody>
</table>
<h3>Total Current in-Order : <?php echo count($output_data) ; ?>
</div>

<script src="<?php echo plugins_url().'/qr-restoran/public/js/jquery.min.js' ; ?>"></script>
<script> 
$(document).ready(function(){
//     setTimeout(function(){
//    window.location.reload(1);
// }, 20000);

setInterval(function(){
      $("#luq_qrr_ordertable").load(window.location.href + " #luq_qrr_ordertable" );
}, 20000);


});
</script>
