<aside class="sidebar col-lg-3">
						<div class="widget widget-dashboard">
							<h3 class="widget-title">My Account</h3>

							<ul class="list">
								<li class="active"><a href="{{route('home')}}">Dashboard</a></li>
								<li><a href="{{route('profile',Auth::id())}}">Account Information</a></li>
                                <li><a href="{{route('orders.index')}}">My Orders</a></li>
								
							</ul>
						</div><!-- End .widget -->
					</aside><!-- End .col-lg-3 -->