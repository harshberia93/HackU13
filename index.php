
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	<link href="default.css" rel="stylesheet">
		<link href="trycss.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="css/style.css" /> -->
    <title>Smart Shopping Alert</title>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
     <script type="text/javascript">
	var category = new Array();
	var description = new Array();
	var lat;
	var lon;
	var bl=0;
	var newObject;
function event1(o){
	newObject = jQuery.extend(true, {}, o);

	}
	
function event2(){

	category.push(newObject.innerHTML);
	description.push(document.getElementById('abc').value);
	initialize();
}

      var map, placesList;
	function getLocation()
	{
	if (navigator.geolocation)
		{
		navigator.geolocation.watchPosition(showPosition);
		
		}
	else{}
	}
	function showPosition(position)
	{
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	//alert("Latitude: "+position.coords.latitude+"<br>Longitude: "+position.coords.longitude);
		initialize();
	}
      function initialize() {
        var pyrmont = new google.maps.LatLng(lat,lon);
        map = new google.maps.Map(document.getElementById('map_canvas'), {
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: pyrmont,
          zoom: 17
        });
				            var pos = new google.maps.LatLng(lat,lon);

            var infowindow = new google.maps.InfoWindow({
              map: map,
              position: pos,
              content: 'Your Current Location',
            });
        placesList = document.getElementById('places');
	

        var service = new google.maps.places.PlacesService(map);
		placesList.innerHTML='';
		for(var k=0;k<category.length;k++)
		{
        var request = {
			name :category[k],
          location: pyrmont,
          radius: 500
        };


        service.nearbySearch(request, callback);
	}
      }

      function callback(results, status, pagination) {
        if (status != google.maps.places.PlacesServiceStatus.OK) {
          return;
        } else {
          createMarkers(results);

          if (pagination.hasNextPage) {
            var moreButton = document.getElementById('more');

            moreButton.disabled = false;

            google.maps.event.addDomListenerOnce(moreButton, 'click',
                function() {
              moreButton.disabled = true;
              pagination.nextPage();
            });
          }
        }
      }
		var strPlaces="";
      function createMarkers(places) {
	  strPlaces="";
        var bounds = new google.maps.LatLngBounds();
		 for (var i = 0, place; place = places[i]; i++) {
          var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };
		bl=1;
          var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
          });
			
          placesList.innerHTML += '<li>' + place.name + '</li>';
			strPlaces+=(place.name+" , ");
          bounds.extend(place.geometry.location);
        }
			
	 if(bl==1)
		{	document.getElementById('player').play();
			var r=confirm("You are under 500m from the following locations."+strPlaces+". Do you want to buy your items? ");
	if (r==true)
	{
	x="You pressed OK!";
	}
	else
	{
	x="You pressed Cancel!";
	}
	document.getElementById('player').pause();
			
			bl=0;
	}
        map.fitBounds(bounds);
 

	}

      google.maps.event.addDomListener(window, 'load', getLocation);
    </script>

  </head>
   
  <body>
<audio id="player" src="Yahoo.mp3" loop> </audio>
  <div id="myToggler">
  <h4 class="header aui-toggler-header-collapsed"><span><img src="event.png" id="imgevent"/> </h4>
	
	<ul class="content aui-toggler-content-collapsed" id="category">
	
	<li class="opener" id="A1" onClick="javascript:event1(this)">Garment</li>
	<li class="opener" id="A2" onClick="javascript:event1(this)">Footwear</li>
	<li class="opener" id="A3" onClick="javascript:event1(this)">Mobile</li>
	<li class="opener" id="A4" onClick="javascript:event1(this)">Computers</li>
	<li class="opener" id="A5" onClick="javascript:event1(this)">Watches</li>
	<li class="opener" id="A6" onClick="javascript:event1(this)">Electronics</li>
	<li class="opener" id="A7" onClick="javascript:event1(this)">Stationary</li>
	<li class="opener" id="A8" onClick="javascript:event1(this)">Kitchen</li>
	<li class="opener" id="A9" onClick="javascript:event1(this)">General Store</li>
	<li class="opener" id="A10" onClick="javascript:event1(this)">Games</li>
	<li class="opener" id="A11" onClick="javascript:event1(this)">Grocery</li>
	<li class="opener" id="A12" onClick="javascript:event1(this)">Theatre</li>
	<li class="opener" id="A13" onClick="javascript:event1(this)">Gifts</li>
	<li class="opener" id="A14" onClick="javascript:event1(this)">Sports</li>


	</ul>


 </div>
<ol id="myList" class="rounded-list">

</ol>

<div id="dialog" title="Enter item name">


	<input type="text"  id="abc" value=""><br>
	<input type="submit" id ="addlistitem" value="Submit" onclick="event2()">

</div>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="http://cdn.alloyui.com/2.0.0pr2/aui/aui-min.js"></script>
<!-- <script src="http://yui.yahooapis.com/3.5.0/build/yui/yui-min.js"></script>  -->




<!-- 
category.push()
description.push(document.getElementById('abc').value);
 -->


<script>
YUI().use(
  'aui-toggler','aui-sortable',
    function(Y) {
	
	Y.one('#addlistitem').on('click', function(e){
	
	var c = document.getElementById('abc').value;
	var content = "<li class='rounded-list'>"+c+"</li>";
	Y.one('#myList').append(content);
		new Y.SortableList(
      {
        dropCondition: function(event) {
          return true;
        },
        dropOn: 'myList',
        nodes: '#myList li',

      }
	  
    );
	
	});
	var placeholder = Y.Node.create('<li class="placeholder"></li>');
	new Y.SortableList(
      {
        dropCondition: function(event) {
          return true;
        },
        dropOn: 'myList',
        nodes: '#myList li',

      }
    );
    new Y.TogglerDelegate(
      {
        animated: true,
        closeAllOnExpand: true,
        container: '#myToggler',
        content: '.content',
        expanded: false,
        header: '.header',
        transition: {
          duration: 0.2,
          easing: 'cubic-bezier'
        }
      }
    );
	
  }
);
</script>
<script>
	
  

  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( ".opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  
  function showHideMap() {

    var el = document.getElementById('map_canvas');
	if(el.style.visibility == 'visible')
	{
	   el.style.visibility = 'hidden';
		el.value = 'Show Map';
	}
	else
	{
        el.style.visibility = 'visible';
		el.value = 'Hide Map';
	}

}
  
  
  </script>
 <button type="button" class="ShowMap" onclick="showHideMap()">Show Map</button>
  
    <div id="map_canvas" style="visibility: hidden"></div>
    <div class="results">
      <h2>Nearby Location</h2>
      <ul id="places"></ul>
      <button id="more">More results</button>
	  
    </div>
  </body>
</html>
