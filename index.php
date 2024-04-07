<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
								
?>
<!DOCTYPE html>
<html lang="en">

<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!--	Css Link
	========================================================-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!--	Title
	=========================================================-->
<title>NSBM Accommodation

</title>
</head>
<body>

<!--	Page Loader  -->
<!--<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>  -->
<!--	Page Loader  -->

<?php
$query = mysqli_query($con, "SELECT location, latitude, longitude FROM `property`"); 

$locArray = array();
while($row = mysqli_fetch_assoc($query)) {
    $locArray[] = array(
        'name' => $row["location"],
        'lat' => $row["latitude"], 
        'lng' => $row["longitude"]
    );
}
$phpObjectJson = json_encode($locArray);



if(isset($_POST['id'])) {
  $propertyId = $_POST['id'];

  // Assuming your isApproved column accepts values like '1' for approved
  $query = "UPDATE property SET isApprove	='APPROVED' WHERE pid='$propertyId'";

  if(mysqli_query($con, $query)) {
      echo "Property approved successfully!";
  } else {
      echo "Error: " . mysqli_error($con);
  }
}
if(isset($_POST['pid'])){
  $propertyId = $_POST['pid'];

  // Assuming your isApproved column accepts values like '1' for approved and '0' for rejected
  $query = "UPDATE property SET isApprove='REJECTED' WHERE pid='$propertyId'";

  if(mysqli_query($con, $query)) {
      echo "Property rejected successfully!";
  } else {
      echo "Error: " . mysqli_error($con);
  }
}



?>




<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("include/header.php");?>
        <!--	Header end  -->
		
        <!--	Banner Start   -->
        
        <!--	Banner End  -->
        
        <!--	Text Block One
		======================================================-->
        <div class="full-row bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-secondary double-down-line text-center mb-5">Google Map Location</h2></div>
                </div>

                <div class="container-fluid">
    <div class="row">
      <div class="col-md-7">
    
        <!-- The div element for the map -->
        <div id="map" class="rounded" style="height: 500px;"></div>
      </div>
      <div class="col-md-5">
        <div class="mt-3">
          <h4>Locations</h4>
          <div id="locations-list" class="list-group"></div>
        </div>
      </div>
    </div>
  </div>
                
            </div>
        </div>
		<!-----  Our Services  ---->
		
        <!--	Recent Properties  -->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-secondary double-down-line text-center mb-4">Recent Property</h2>
                    </div>
                    <!--- <div class="col-md-6">
                        <ul class="nav property-btn float-right" id="pills-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link py-3 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New</a> </li>
                            <li class="nav-item"> <a class="nav-link py-3" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Featured</a> </li>
                            <li class="nav-item"> <a class="nav-link py-3" id="pills-contact-tab2" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Top Sale</a> </li>
                            <li class="nav-item"> <a class="nav-link py-3" id="pills-contact-tab3" data-toggle="pill" href="#pills-resturant" role="tab" aria-controls="pills-contact" aria-selected="false">Best Sale</a> </li>
                        </ul>
                    </div> --->
                    <div class="col-md-12">
                        <div class="tab-content mt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">
                                <div class="row">
								
									<?php $query=mysqli_query($con,"SELECT * FROM `property`");
										while($row=mysqli_fetch_array($query))
										{
									?>
								
                                    <div class="col-md-6 col-lg-4">
                                        <div class="featured-thumb hover-zoomer mb-4">
                                            <div class="overlay-black overflow-hidden position-relative"> <img src="../admin/property/<?php echo $row['18'];?>" alt="pimage">
                                                <div class="featured bg-success text-white">New</div>
                                                <div class="sale bg-success text-white text-capitalize">
                                                <button type="button" id="approveButton_<?php echo $row['pid'];?>" class="btn btn-success approveBtn" data-id="<?php echo $row['pid'];?>">Approve</button>

                                                      <!-- <style>
                                                        /* Default button style */
                                                        .btn-success {
                                                          background-color: #28a745; /* Green color */
                                                          color: #fff; /* White text */
                                                        }

                                                        /* Approved button style */
                                                        .btn-approved {
                                                          background-color: #28a745; 
                                                        }
                                                      </style>

                                                      <script>
                                                        // JavaScript code to handle button click event
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                          var approveButtons = document.querySelectorAll('.approveBtn');
                                                          approveButtons.forEach(function(button) {
                                                            button.addEventListener('click', function() {
                                                              var productId = button.getAttribute('data-id');
                                                              var approveButton = document.getElementById('approveButton_' + productId);

                                                              // Change button text to "Approved"
                                                              approveButton.innerText = 'Approved';

                                                              // Add class to change button color to blue
                                                              approveButton.classList.add('btn-approved');

                                                              approveButton.disabled = true;

                                                              // You can add further logic here, like sending an AJAX request to update the status in the database
                                                            });
                                                          });
                                                        });
                                                      </script> -->

                                                      <button type="button" id="rejectButton" class="btn btn-danger rejectButton" onclick="reject(<?php echo $row['pid'];?>)">Reject</button>



                                                </div>

                                                <div class="price text-primary"><b>$<?php echo $row['13'];?> </b><span class="text-white"><?php echo $row['12'];?> Sqft</span></div>
                                            </div>
                                            <div class="featured-thumb-data shadow-one">
                                                <div class="p-3">
                                                    <h5 class="text-secondary hover-text-success mb-2 text-capitalize"><a href="propertydetail.php?pid=<?php echo $row['0'];?>"><?php echo $row['1'];?></a></h5>
                                                    <span class="location text-capitalize"><i class="fas fa-map-marker-alt text-success"></i> <?php echo $row['14'];?></span> </div>
                                                <div class="bg-gray quantity px-4 pt-4">
                                                    <ul>
                                                        <li><span><?php echo $row['12'];?></span> Sqft</li>
                                                        <li><span><?php echo $row['6'];?></span> Beds</li>
                                                        <li><span><?php echo $row['7'];?></span> Baths</li>
                                                        <li><span><?php echo $row['9'];?></span> Kitchen</li>
                                                        <li><span><?php echo $row['8'];?></span> Balcony</li>
                                                        <li><span><?php echo $row['8'];?></span> For <?php echo $row['5'];?> </li>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="p-4 d-inline-block w-100">
                                                    <div class="float-right"><i class="far fa-calendar-alt text-success mr-1"></i> <?php echo date('d-m-Y', strtotime($row['date']));?></div> 
                                                    <div class="float-left"><span class="label label-danger"><?php echo $row['isApprove']?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>

                                </div>
                            </div>
                            
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<?php include("include/footer.php");?>
		<!--	Footer   start-->
        
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-success text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div>
<!-- Wrapper End --> 

<!--	Js Link
============================================================--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
  <script src="js/popper.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/owl.carousel.min.js"></script> 
  <script src="js/tmpl.js"></script> <!-- Include tmpl.js before jquery.slider.js -->
  <script src="js/jquery.dependClass-0.1.js"></script> 
  <script src="js/draggable-0.1.js"></script> 
  <script src="js/jquery.slider.js"></script> 
  <script src="js/wow.js"></script> 
  <script src="js/YouTubePopUp.jquery.js"></script> 
  <script src="js/validate.js"></script> 
  <script src="js/jquery.cookie.js"></script> 
  <script src="js/custom.js"></script>          <!DOCTYPE html>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({key: "", v: "weekly"});</script>
    <script>
$(document).ready(function() {
    $('.approveBtn').click(function() {
        var propertyId = $(this).data('id'); // Get property ID

        $.ajax({
            url: 'index.php', // Path to your PHP script
            type: 'POST',
            data: {id: propertyId},
            success: function(response) {
                // Handle success (e.g., show a message, update the button state)
                alert("Property Approved!");
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error("Error: " + status + " - " + error);
            }
        });
    });
});


function reject(pid){
  $.ajax({
            url: 'index.php', // Path to your PHP script
            type: 'POST',
            data: {pid: pid},
            success: function(response) {
                // Handle success (e.g., show a message, update the button state)
                alert("Property Rejected!");
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error("Error: " + status + " - " + error);
            }
        });

}




document.addEventListener('DOMContentLoaded', function() {
  let map;

  async function initMap() {
    // Ensure the PHP object is properly parsed into JavaScript.
    // If you're not seeing expected results, double-check the PHP JSON encoding and HTTP response.
    // Note: Directly embedding PHP in JavaScript only works if this script is in a `.php` file.
    const positions = JSON.parse('<?php echo $phpObjectJson; ?>').map(position => ({
      lat: Number(position.lat),
      lng: Number(position.lng),
      name: position.name // Ensure you're fetching and encoding `name` in your PHP.
    }));

    // Request needed libraries.
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // Check if positions array is not empty to avoid errors
    if (positions.length > 0) {
      // The map, centered at the first position
      map = new Map(document.getElementById("map"), {
        zoom: 4,
        center: positions[0],
        mapId: "DEMO_MAP_ID",
      });
    } else {
      console.error("Positions array is empty.");
      return;
    }

    // Loop through the positions and add markers
    positions.forEach((position, index) => {
      // Create a marker for each position
      const marker = new AdvancedMarkerElement({
        map: map,
        position: {lat: position.lat, lng: position.lng},
        title: position.name, // Use location name as title
      });

      // Add location to the list
      addLocationToList(position);
    });
  }

  function addLocationToList(position) {
    const locationList = document.getElementById("locations-list");
    const locationItem = document.createElement("a");
    locationItem.href = "#";
    locationItem.className = "list-group-item list-group-item-action";
    locationItem.textContent = position.name; // Display location name
    locationItem.onclick = function(event) {
      event.preventDefault(); // Prevent the default anchor link behavior
      // Pan the map to the clicked location
      map.panTo({lat: position.lat, lng: position.lng});
    };
    locationList.appendChild(locationItem);
  }

  initMap();
});
</script>




</body>

</html>