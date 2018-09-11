@extends('layouts.site')
@section('content')



@include('includes.smallBanner')


<section class="featured-area">
	<div class="container">

		
		

		
		<div class="row">
			
			<div class="col-md-3"></div>

			<div class="col-md-6" style="border-left: 1px solid #BBB4B3; padding-left: 40px">
				
				

				
				<P>
    					<b>Payment Instructions:</b>
    					<ul style="padding-left: 20px">

    						<li style="padding:5px">Go to <b>M-PESA Menu</b> on your phone</li>
							<li style="padding:5px">Select <b>Pay Bill</b> (under <b>Lipa Na M-Pesa</b>)</li>
							<li style="padding:5px">Enter Business Number - <b>961700</b></li>
							<li style="padding:5px">Enter Account Number - <b>14877</b></li>
							<li style="padding:5px">Enter Amount - <b>KSH. {{number_format($service->cost, 2)}}</b> </li>
							<li style="padding:5px">Enter your <b>M-PESA PIN</b></li>
							<li style="padding:5px">Enter the <b>Transaction code</b> below to validate</li>

							<form method="post" action="{{URL::to('/api/payments')}}">
							@csrf

							@if(!empty($notice))

							<br><br>

								<div class="alert alert-error" style="background-color:#FF5733; color:#fff; padding:5px; opacity: 98%;">
									<p>{{$notice}}!</p>
								</div>
							@endif
							
							<input type="hidden" name="order_id" value="{{$order->id}}">
								<div class="mt-10">
									<input type="text" name="transaction_code" placeholder="Transaction Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Transaction Code'" required class="single-input">
								</div>

								<div class="mt-10">
									<button type="submit" class="genric-btn danger-border">Submit</button>
								</div>
								<hr>
								<p>* Powered by <b>Lipisha</b></p>

							</form>
    					</ul>


    				</P>

    				<p style="padding-top: 10px;">
					<i>*Due to the high number of requests we receive, we only work on paid orders</i></</p>
				


				

			</div>

		</div>
		
	</div>
</section>


			

@stop