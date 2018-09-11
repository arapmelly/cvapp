<template>

	<div>
		
			<!-- list view -->

			<div class="card" v-if="listOrdersView">
                <div class="card-header">
                	
                	
    				<ou-command-button icon='CircleRing' @click="setStatus('new')">New Orders</ou-command-button>
    
    				<ou-command-button icon='CircleRing' @click="setStatus('assigned')">Assigned Orders</ou-command-button>
    				<ou-command-button icon='CircleRing' @click="setStatus('completed')">Completed Orders</ou-command-button>
   	 				<ou-command-button icon='CircleRing' @click="setStatus('closed')">Closed Orders</ou-command-button>
                </div>

                <div class="card-body">



                	

                	<table class="table table-sm table-condensed table-hover">

						<thead>
							<th>Client</th>
							<th>Service</th>
							<th>Deadline</th>
							
							<th></th>
						</thead>

						<tbody>
				
							<tr v-for="order in orders">
								<td>{{order.client.f_name}} {{order.client.l_name}} </td>
								<td>{{order.service.name}}</td>
								<td>{{order.deadline}}</td>
								
								<td>
									<ou-button type='primary' @click='manageOrder(order)'>manage </ou-button>
									
								</td>
							</tr>
						</tbody>
			
					</table>



                </div>
            </div>

            <!-- // end of listy view -->

            <!-- manage view -->

            <div v-if="manageOrderView">

            	

            <div class="card" >
                

                <div class="card-body">


                	<div class="order-head">

                		<p><b>#{{selectedOrder.order.ref_number}} </b><br>
                		 {{selectedOrder.client.f_name}} {{selectedOrder.client.l_name}}    <br/> 



                	


                	


                	

 </p>
                	</div>

                	<ou-pivot type='tabs'>
  						<ou-pivot-item label='Order Details'>
  							<table class="table table-condensed">

  								<tr >
  									<td>Order Date</td><td>{{selectedOrder.order.created_at}}</td>
  								</tr>
  								<tr >
  									<td>Client</td><td>{{selectedOrder.client.f_name}} {{selectedOrder.client.l_name}} </td>
  								</tr>
  								<tr >
  									<td>Service</td><td>{{selectedOrder.service.name}}</td>
  								</tr>
  								<tr >
  									<td>Deadline</td><td>{{selectedOrder.deadline}}</td>
  								</tr>
  								<tr >
  									<td>Status</td><td>{{selectedOrder.order.order_status}}</td>
  								</tr>

  								
  							</table>
  						</ou-pivot-item>
  						<ou-pivot-item label='Client Details'>
  							
  							<table class="table table-condensed">

  								<tr >
  									<td>First Name</td><td>{{selectedOrder.client.f_name}}</td>
  								</tr>
  								<tr >
  									<td>Last Name</td><td>{{selectedOrder.client.l_name}}  </td>
  								</tr>
  								<tr >
  									<td>Phone</td><td>{{selectedOrder.client.phone}}</td>
  								</tr>
  								<tr >
  									<td>Email</td><td>{{selectedOrder.client.email}}</td>
  								</tr>
  								

  								
  							</table>

  						</ou-pivot-item>
  						<ou-pivot-item label='Payment Details'>
  								
  								<span v-for="payment in selectedOrder.order.payments">

  							<table class="table table-condensed" >


  								<tr >
  									<td>Payment Date</td><td>{{payment.created_at}}</td>
  								</tr>
  								<tr >
  									<td>Transaction Code</td><td>{{payment.transaction_code}}  </td>
  								</tr>
  								<tr >
  									<td>Amount</td><td>{{payment.amount}}</td>
  								</tr>
  								<tr >
  									<td>Paid</td><td>{{payment.is_paid}}</td>
  								</tr>
  								

  								
  							</table>

  							<br>

  						</span>

  						</ou-pivot-item>
  						<ou-pivot-item label='CV Preview'>
  							

  							<iframe :src="cvUrl" width="100%" height="600px"></iframe>

  							

  							
  						</ou-pivot-item>


  						<ou-pivot-item label='Requests'>
  							

  								<table class="table table-condensed" >

  									<thead>
  										<th>Agent</th>
  										<th></th>
  									</thead>
  									<tbody>

  										<tr v-for="request in selectedOrder.order.requests">
  											<td>{{request.user.name}}</td>
  											<td>

  												<ou-button type='primary' @click="viewAgentProfile(request.user)">View Profile</ou-button>

  												<span v-if="!selectedOrder.is_assigned ">
  													<ou-button type='primary' @click="assignAgent(request.id)">Assign</ou-button>
  												</span>
  												
  											</td>
  										</tr>
  										
  									</tbody>
  								
  								</table>
  							

  							
  						</ou-pivot-item>


					</ou-pivot>
                	

                	



                </div>
            </div>

        </div>
            <!-- //end of manage view -->

	</div> 
	
</template>

<script type="text/javascript">
	
	export default {

		mounted(){

			this.getOrders(this.status)

		},

		data(){

			return {

				orders: [],
				status: 'new',
				manageOrderView: false,
				listOrdersView: true,
				selectedOrder: [],
				cvUrl: ""
			}
		},

		methods : {

			getOrders(status){

				

				axios.get('/orders/status/'+status).then(response => {
					console.log(response.data)
					this.orders = response.data
				}).catch(error => {

					alert(error.data.data)
				})
			},

			setStatus(status){

				this.status = status
				this.getOrders(this.status)
			},

			manageOrder(order){
				console.log(order)

				this.selectedOrder = order

				this.cvUrl = 'http://docs.google.com/gview?url='+this.selectedOrder.client.cv_link+'&embedded=true'

				this.listOrdersView = false

				this.manageOrderView = true

			},

			showOrders(){
				console.log('we here')
				this.listOrdersView = true

				this.manageOrderView = false
			},

			assignAgent(id){

				axios.get('/requests/assign/'+id).then(response => {

					this.manageOrderView = false
					this.listOrdersView = true

					this.getOrders('new');

				}).catch(error=> {

					alert(error)
				})
			}
		}
	}
</script>