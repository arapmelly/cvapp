<template>

	<div>
		
			<!-- list view -->

			<div class="card" v-if="listOrdersView">
                <div class="card-header">
                	
                	
    				<ou-command-button icon='CircleRing' @click="setStatus('new')">New Orders</ou-command-button>
    
    				<ou-command-button icon='CircleRing' @click="getAgentOrders('assigned')">Assigned Orders</ou-command-button>
    				<ou-command-button icon='CircleRing' @click="getAgentOrders('completed')">Completed Orders</ou-command-button>
   	 				<ou-command-button icon='CircleRing' @click="getAgentOrders('closed')">Closed Orders</ou-command-button>
                </div>

                <div class="card-body">



                	

                	<table class="table table-sm table-condensed table-hover">

						<thead>
							<th>Client</th>
							<th>Service</th>
							<th>Deadline</th>
							<th>Status</th>
							
							<th></th>
						</thead>

						<tbody>

						
				
							<tr v-for="order in orders"  >


								<td>{{order.client.f_name}} {{order.client.l_name}} </td>
								<td>{{order.service.name}}</td>
								<td>{{order.deadline}}</td>
								<td>
									<ou-message-bar icon='Completed' type='success' v-if="order.is_requested">
											REQUESTED &nbsp; &nbsp; 
										</ou-message-bar>


										

								</td>

								<td>
									

									<ou-button type='primary' @click='openPreviewPanel(order)'>View CV</ou-button>


									<span v-if="order.order.order_status != 'new' ">
										<ou-button type='primary' @click='uploadAttachment(order)' v-if="order.is_assigned">upload work</ou-button>
								</span>

								
										<ou-button type='primary' @click='requestOrder(order)' v-if="!order.is_requested"> Request </ou-button>

										

										
									
									
								</td>
							</tr>
						
						</tbody>
			
					</table>



                </div>
            </div>

            <!-- // end of listy view -->

            <!-- preview view -->


            <ou-panel title='Preview Panel' size='xl' v-model='previewPanel'>
    			
    			

    			<p>this is the preview of the CV submitted by the client. if the CV does not appear refresh your browser</p>
    			<hr>

    			<iframe :src="cvUrl" width="100%" height="600px"></iframe>
  			
  			</ou-panel>

          
            <!-- //end of preview view -->


            <!-- preview view -->


            <ou-panel title='Upload Work' size='md' v-model='uploadAttachmentPanel'>
    			
    			

    			<p>upload your finished work here and mark the order as completed </p>

    			<hr>

    			<label>Attachment</label>
    			<input type="file" name="attachment_file" required>


    			<ou-text-field type='multiline' v-model='attachment_comment' label='Comment' />

    			<ou-checkbox v-model='is_completed'>Mark as Completed</ou-checkbox>

    			<br>

    			<ou-button type='primary'>Save</ou-button>
  			
  			</ou-panel>

          
            <!-- //end of preview view -->

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
				cvUrl: "",
				previewPanel: false,
				uploadAttachmentPanel: false,
				attachment_file: '',
				attachment_comment: '',
				is_completed: false
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


			getAgentOrders(status){

				this.status = status

				axios.get('/agent-orders/status/'+status).then(response => {
					console.log(response.data)
					this.orders = response.data
				}).catch(error => {

					alert(error.data.data)
				})
				
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

			openPreviewPanel(order){

				this.selectedOrder = order

				this.cvUrl = 'http://docs.google.com/gview?url='+this.selectedOrder.client.cv_link+'&embedded=true'

				this.previewPanel = true
			},

			requestOrder(order){

				let data = {
					'order_id': order.id
				}

				axios.post('/requests', data).then(response =>{
					this.getOrders('new');
				}).catch(error => {
					alert(error)
				})
			},


			uploadAttachment(order){

				this.uploadAttachmentPanel = true;
			}
		}
	}
</script>