<section class="featured-area">
				<div class="container">

					<div class="row">
						@foreach($services as $service)
						<div class="col-md-4 col-xs-12">
							<div class="single-feature d-flex flex-wrap justify-content-between">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="lnr lnr-sun"></span>
								</div>
								<div class="desc justify-content-center  align-items-center">
									<h6 class="title text-uppercase">{{$service->name}}</h6>
									<p>
									{{$service->description}}.</p>
									<a href="{{URL::to('order/'.$service->id)}}" class="btn btn-danger btn-sm d-inline-flex align-items-center"><span class="mr-10">Get Started</span></a>
								</div>
							</div>
						</div>
						@endforeach

						
					</div>




				</div>
			</section>