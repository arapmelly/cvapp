@extends('layouts.email')
@section('content')


<p style=" font-size:20px;">Hello {{ucfirst($order->client->f_name)}},</p>

            <p style="text-align:center; font-size:18px; font-weight: bold; background-color: #f48359; color:#fff; padding: 10px;">With only 30 seconds to impress, it is clearly vital for your CV to stand out from the crowd.</p>

            <p>
            	The purpose of our review service is to identify key areas of your CV that are currently failing you and provide basic feedback to help you improve. </p>

            	<p>Please find your review report attached.</p>

            	<p>This service does not extend to actually re-writing and re-formatting it; for that please check out our other services below.
            </p>

            <p>

            	<table style="padding:10px;">
            		
            		<tr>
            			@foreach($services as $service)
            			<td style="padding:10px;">

            				<p><strong style="padding:0px; text-transform: uppercase; color:#f48359;">{{$service->name}} </strong><br><span>{{$service->description}}<br><br>
            				<a href="{{URL::to('order/'.$service->id)}}" style="text-decoration: none; padding:5px; background-color: #f48359; color:#fff;">Order {{$service->name}}</a></span>
            			</p>
            				
            			</td>
            			@endforeach
            		</tr>
            	</table>
            	
            </p>

            <hr>

            <p>Regards,<br/>
            	Jack K Melly, <br>
            	Customer Representative<br>
            	CVMAMA CAREER SERVICES<br>
            	info@cvmama.co.ke | www.cvmama.co.ke
        </p>



@stop