<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$is_elementor_theme_exist = function_exists( 'elementor_theme_do_location' );

// print_r(plugins_url().'/qr-restoran/public/css/font-awesome.min.css');
?>

<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/bootstrap.min.css' ; ?>"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
        <input id="no_meja" name="no_meja" type="number" required="required" class="form-control">
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>


<?php
//https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8
if(isset($_POST)){
    echo "<div style='padding:2%'><input type='button' id='btn' value='Print' onclick='printDiv();'><div id='myqrcode'><h1>Meja No:". $_POST['no_meja']."</h1>" ; 
    $link_url = home_url("senarai_menu?mejaid="). $_POST['no_meja'] ;
    //print_r($link_url);
    echo '<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$link_url.'%2F&choe=UTF-8" alt="QR Code" width="300" height="300"></div></div>' ;
    ?>
    <div style='padding:2%'>
    
    </div>
            <!-- luqman koperasi certificate -->
            <br><br>
            <div id="mycard" >
        <!-- content that wan t to print -->
        <style>
        * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
            color-adjust: exact !important;                 /*Firefox*/
        }
        </style>
        </div>
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
    <?php


}

get_footer();
