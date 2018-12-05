@extends('layouts.layout')

@section('content')
<div class="content">
	<div class="panel panel-flat" style="font-size: 1.2em">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-5">
					<h5 class="panel-title" style="float: left;"><b>Hubungi kami di :</b></h5>
					<div class="contact">
						<ul type="none">
							<li>Social Media</li>
							<li><a href=""><img src="/assets/images/brands/facebook.png">Shabby Organizer</a></li>
							<li><a href=""><img src="/assets/images/brands/twitter.png">@orgShabby</a></li>
							<li><a href="https://www.instagram.com/organizershabby"><img src="/assets/images/brands/insta.png">@organizershabby</a></li><hr>
							<li>E-mail</li>
							<li><img src="/assets/images/brands/gmail.png">shabby.org@gmail.com</li><hr>
							<li>Contact</li>
							<li><img src="/assets/images/brands/whatsapp.png">+62 8132 231 12321</li>
							<li><img src="/assets/images/brands/line.png">@shabbyOrg</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-7">
					<h5 class="panel-title"><b>Kunjungi kami di :</b></h5>
			      	<div id="map" style="height: 300px; border: 1px solid #e6e6e6e6; margin: 10px 0px"></div>
				    <script>
				      function initMap() {
				        // Create a map object and specify the DOM element for display.
				        var map = new google.maps.Map(document.getElementById('map'), {
				          center: {lat: -6.9163257, lng: 107.71921040000007},
				          zoom: 8
				        });
				      }

				    </script>
				    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer>
				    	
				    </script>
			      	<p><span class="glyphicon glyphicon-map-marker"></span> Cibiru, Bandung, Jawa Barat, Indonesia</p>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection