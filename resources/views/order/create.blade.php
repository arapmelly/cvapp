@extends('layouts.site')
@section('content')



@include('includes.smallBanner')


<section class="featured-area">
	<div class="container">

		
	

	
		
		<div class="row">
			
			<div class="col-md-6">

				<p><h4><b>{{$service->name}}</b></h4></p>
				
				<p>
					{{$service->description}}
				</p>
				<p>
					<b>Benefits:</b>
					<ul style="padding-left: 20px">
						<li style="padding:5px">Highlight your most marketable skills</li>
						<li style="padding:5px">Catch grammar, spelling, and formatting mistakes</li>
						<li style="padding:5px">Stand out from the competition</li>
						<li style="padding:5px">Present yourself effectively for the job</li>
					</ul>


				</p>
				
				<p>
					<b>Cost :</b> {{number_format($service->cost,2)}}
					
					
				</p>
				

			</div>

			<div class="col-md-6" style="border-left: 1px solid #BBB4B3; padding-left: 40px">
			
				

				
				<form method="post" action="{{URL::to('api/orders')}}" enctype="multipart/form-data">
					@csrf

					@if(count($errors) > 0)
                        <div class="alert alert-danger">
                           
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                           
                        </div>
                    @endif
					
					<div class="mt-10">
								<input type="text" name="f_name" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required class="single-input" value="{{old('f_name')}}">
					</div>

					<div class="mt-10">
								<input type="text" name="l_name" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required class="single-input">
					</div>

					<div class="mt-10">
								<input type="text" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required class="single-input">
					</div>

					<div class="mt-10">
								<input type="text" name="phone" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" required class="single-input">
					</div>

					
					

					<input type="hidden" value="{{$service->id}}" name="service_id">

					<input type="hidden" value="{{$service->cost}}" name="order_cost">

					<div class="mt-10">
						<label>Upload CV (.docx, .pdf)</label>
								<input type="file" name="cv_file"  required >
					</div>

					<br>
					<div class="mt-10">
						<button type="submit" class="genric-btn danger-border">Submit</button>
					</div>

				</form>
				


				

			</div>

		</div>
		
		
	</div>
</section>


			

@stop