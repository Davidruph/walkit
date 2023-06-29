 <?php
  require('UserInfo.php');
  include('dbconn.php');
  //check if ref parameter exist
  if (isset($_GET['ref'])) {
    $ref = $_GET['ref'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE url='$ref'");
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_array($query);
      $id = $row['user_id'];
      $company_name = $row['company_name'];
      $logo = $row['logo'];
      $address = $row['address'];
      //var_dump($company_name);
    }
  }
  ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ecodemy WalkIT™</title>
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <script src="js/all.min.js"></script>
   <style>
     .calc {
       display: none;
     }
   </style>
 </head>

 <body>

   <?php
    if (!empty($id)) {
      //if there's a match display records dynamically

    ?>
     <div class="container">
       <div class="row justify-content-center mt-5">
         <div class="col-lg-6 mb-4">
           <?php if (!empty($logo)) {
            ?>
             <div class="justify-content-center">
               <img src="admin/<?= $logo ?>" class="img-fluid mx-auto d-block mb-2" width="100" height="50" alt="company logo">
             </div>

           <?php
            } ?>

           <h4 class="text-center text-color mb-0 title text-uppercase">
             <?php if (!empty($company_name)) {
                echo $company_name;
              } else {
              ?>
               Eco<span class="secondary-color">demy</span> WalkIT™

             <?php
              }
              ?>
           </h4>
           <p class="text-center lead subtitle mb-4 text-color text-uppercase">Active Transit Carbon Calculator</p>

           <div class="w-100 shadow trans card">
             <form class="form-horizontal">
               <div class=" form-group mt-4 mr-4 ml-4">
                 <input type="hidden" id="ip" class="form-control" name="ip" value="<?= UserInfo::get_ip(); ?>">
                 <input type="hidden" id="device" class="form-control" name="device" value="<?= UserInfo::get_device(); ?>">
                 <input type="hidden" id="os" class="form-control" name="os" value="<?= UserInfo::get_os(); ?>">
                 <input type="hidden" id="browser" class="form-control" name="browser" value="<?= UserInfo::get_browser(); ?>">
                 <input type="hidden" id="ref" class="form-control" name="ref" value="<?= $ref ?? '' ?>">
                 <input type="hidden" id="id" class="form-control" name="user_id" value="<?= $id ?? '' ?>">
                 <input type="hidden" id="from" placeholder="Origin" class="form-control" value="<?= $address ?? '' ?>">
                 <input type="hidden" id="saved_km" name="saved_km">
               </div>

               <div class=" form-group mt-4 mr-4 ml-4">
                 <label for="To" class="control-label text-color"><i class="fa fa-map-marker-alt"></i>&nbsp; Your Address</label>
                 <input type="text" id="to" name="to" placeholder="Destination" class="form-control" required>
               </div>

               <div class=" form-group mr-4 ml-4">
                 <input type="submit" style="visibility: hidden;" name="submit" id="log" value="log users" class="btn btn-info btn-sm submit">
               </div>

             </form>

             <div class="form-group mr-4 ml-4">
               <button class="btn btn-info calculate w-100 mt-2 mb-3 calc" name="submit" onclick="calcRoute();"><i class="fa fa-route"></i> Calculate</button>
             </div>

           </div>
         </div>

         <div class="col-lg-6" id="results">
           <h2 class="text-center text-color mb-3">Results</h2>
           <div class="w-100 shadow card">
             <div class="text-left mr-3 ml-3 mt-3 mb-3" id="output">

             </div>
           </div>
         </div>
       </div>
     </div>

     <div class="container-fluid" id="maps">
       <div class="row justify-content-center">
         <div class="col-lg-12">
           <div id="googleMap">

           </div>
         </div>
       </div>
     </div>
   <?php

    } else {
    ?>

     <div class="container">
       <div class="row justify-content-center mt-5">
         <div class="col-lg-6 mb-4">
           <h2 class="text-center text-color mb-0 title text-uppercase">Eco<span class="secondary-color">demy</span> WalkIT™</h2>
           <p class="text-center lead subtitle mb-4 text-color text-uppercase">Active Transit Carbon Calculator</p>
           <div class="w-100 shadow trans card">
             <form class="form-horizontal" role="form">
               <div class=" form-group mt-4 mr-4 ml-4">
                 <label for="From" class="control-label text-color"><i class="fa fa-dot-circle"></i>&nbsp; From</label>
                 <input type="text" id="from" placeholder="Origin" class="form-control" required>
               </div>

               <div class=" form-group mt-4 mr-4 ml-4">
                 <label for="To" class="control-label text-color"><i class="fa fa-map-marker-alt"></i>&nbsp; To</label>
                 <input type="text" id="to" placeholder="Destination" class="form-control" required>
               </div>

               <div class="form-group mt-4 mr-4 ml-4">
                 <label for="To" class="control-label text-color"><i class="fa fa-bicycle"></i>&nbsp; I would normally take</label>
                 <select id="transport_mode" class="form-control">
                   <option value="">-- select --</option>
                   <option value="DRIVING">Driving</option>
                   <option value="WALKING">Walking</option>
                   <option value="BICYCLING">Bicycling</option>
                   <option value="TRANSIT">Public Transit</option>
                 </select>

               </div>

             </form>
             <div class="form-group mr-4 ml-4">
               <button class="btn w-100 mt-2 mb-3" onclick="calcRoute();"><i class="fa fa-route"></i> Calculate</button>
             </div>
           </div>
         </div>

         <div class="col-lg-6" id="results">
           <h2 class="text-center text-info mb-3 text-color">Results</h2>
           <div class="w-100 shadow card">
             <div class="text-left mr-3 ml-3 mt-3 mb-3" id="output">

             </div>
           </div>
         </div>
       </div>
     </div>

     <div class="container-fluid" id="maps">
       <div class="row justify-content-center">
         <div class="col-lg-12">
           <div id="googleMap">

           </div>
         </div>
       </div>
     </div>
   <?php
    }
    ?>





   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtJ99NRw1wBanqdNqp7HyKGtGq_LrT2Fw&libraries=places"></script>
   <script src="js/app.js"></script>

   <script>
     $(function() {

       $('form').on('submit', function(e) {

         e.preventDefault();

         $.ajax({
           type: 'post',
           url: 'logUsers.php',
           data: $('form').serialize(),
           success: function() {
             // alert('form was submitted');
           }
         });

       });

     });
   </script>

   <script>
     $(document).ready(function() {

       // If the 'hide cookie is not set we show the message
       if (!readCookie('hide')) {
         $('.calc').show();
         // $(".calc").removeAttr("disabled");
       }

       // Add the event that closes the popup and sets the cookie that tells us to
       // not show it again until one day has passed.
       $('.calc').mouseup(function() {
         var fromVal = document.getElementById("from").value;
         var toVal = document.getElementById("to").value;
         var transport_mode = document.getElementById("transport_mode").value;

         if (fromVal.length === 0) {
           Swal.fire(
             'Ooops Sorry!',
             'Pls enter an Origin to continue!',
             'error'
           );
         } else if (toVal.length === 0) {
           Swal.fire(
             'Ooops Sorry!',
             'Pls enter a Destination to continue!',
             'error'
           );
         } else if (transport_mode.length === 0) {
           Swal.fire(
             'Ooops Sorry!',
             'Pls select a transport mode to continue!',
             'error'
           );
         } else {
           Swal.fire(
             'Good Job!',
             'Pls view distance saved and come back tomorrow to save more!',
             'success'
           );
           $('.calc').hide();
           createCookie('hide', true, 1)
           return false;
         }

       });

     });

     // ---
     // And some generic cookie logic
     // ---
     function createCookie(name, value, days) {
       if (days) {
         var date = new Date();
         date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
         var expires = "; expires=" + date.toGMTString();
       } else var expires = "";
       document.cookie = name + "=" + value + expires + "; path=/";
     }

     function readCookie(name) {
       var nameEQ = name + "=";
       var ca = document.cookie.split(';');
       for (var i = 0; i < ca.length; i++) {
         var c = ca[i];
         while (c.charAt(0) == ' ') c = c.substring(1, c.length);
         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
       }
       return null;
     }

     function eraseCookie(name) {
       createCookie(name, "", -1);
     }
   </script>
 </body>

 </html>