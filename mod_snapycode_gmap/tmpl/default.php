<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_snapycode_gmap
 */

// no direct access
defined('_JEXEC') or die;
?>

<div class="wrapper_snapycode_gmap<?php echo $moduleclass_sfx; ?>">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

  <script type="text/javascript">
    var map;
	var latitude;
	var longitude;
	var address = '<?php echo $map_address; ?>';
	var myCenter;
	var geocoder = new google.maps.Geocoder();
	
	
	geocoder.geocode( { 'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK)
	  {
		  // do something with the geocoded result
		  //
		  latitude = results[0].geometry.location.lat();
		  longitude = results[0].geometry.location.lng();
		  myCenter=new google.maps.LatLng(latitude,longitude);	
	  }
	});
	
	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:<?php echo $map_zoom; ?>,
	  mapTypeId:google.maps.MapTypeId.<?php echo $map_type; ?>
	  };
	
	var map=new google.maps.Map(document.getElementById("map"),mapProp);
	
	var map_icon ='';
	<?php if($map_marker != '0' ): ?>
	map_icon = '<?php echo $map_marker; ?>';	
	<?php endif; ?>
	
	if( map_icon != '' && typeof(map_icon) != 'undefined'){
		
		var marker=new google.maps.Marker({
		  position:myCenter,
		  draggable:false,
		  animation: google.maps.Animation.DROP,//Parameter For Marker Animation
		  icon: map_icon,
		});
		
	}else{
		var marker=new google.maps.Marker({
		  position:myCenter,
		  draggable:false,
		  animation: google.maps.Animation.DROP,
		});
	}
	
	marker.setMap(map);
	
	<?php if($map_enable_bubble == 1 ): ?>
	var infowindow = new google.maps.InfoWindow({
	  content:"<?php echo trim($map_address, ','); ?>"
	  });
	
	infowindow.open(map,marker);
	<?php endif; ?>
	
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	/*For IE only*/
	if(navigator.appName == 'Microsoft Internet Explorer')
	{
		window.onload = function(){
		  setTimeout(function(){
			 initialize();
		  }, 3000);
		};
	}
	/*For IE only*/
	
function myDirection(){
	var toloc = address;
	var fromloc = document.getElementById("fromloc").value;
	if(fromloc != '' && toloc != ''){
	 getDirection(toloc, fromloc);
	}
}

function getDirection(toloc, fromloc){
     var directionsService = new google.maps.DirectionsService();
     var directionsDisplay = new google.maps.DirectionsRenderer();

     var map = new google.maps.Map(document.getElementById('map'), {
       zoom:4,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     directionsDisplay.setMap(map);
     directionsDisplay.setPanel(document.getElementById('panel'));

     var request = {
       origin: toloc, 
       destination: fromloc,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
     };

     directionsService.route(request, function(response, status) {
       if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(response);
       }
     });
}

  </script>
  

<div class="snapycode_gmap">   

	<?php if( '' != trim($map_header) ): ?>
	<div class="snapycode_gmap_header"><?php echo $map_header; ?></div>
    <?php endif; ?>

<?php if($map_enable_direction == 1 ): ?>
<span class="frominput"><?php echo 'From'; ?>:- <input type="text" id="fromloc" name="fromloc" placeholder="place,city,state,country"></span>           

<span class="getdirbtn"><input type="button" value="Get Direction" onClick="myDirection();" ></span>
<?php endif;  ?>

    <div style="width: 734px;">
        <div id="map" style="width:<?php echo $map_width; ?>px; clear: none !important; margin-top: 10px; height: <?php echo $map_height; ?>px; float: left;"></div>
        <div id="panel" style="width: 300px; clear: none !important; float: right; display:none;"></div> 
    </div>
    
    <?php if( '' != trim($map_footer) ): ?>
	<div class="snapycode_gmap_footer"><?php echo $map_footer; ?></div>
    <?php endif; ?>
    
</div>

</div>    