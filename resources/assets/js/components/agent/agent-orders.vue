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
							
							
							<th></th>
						</thead>

						<tbody>

						
				
							<tr v-for="order in orders"  >


								<td>{{order.client.f_name}} {{order.client.l_name}} </td>
								<td>{{order.service.name}}</td>
								<td>{{order.deadline}}</td>
								

								


								<td>
									
									<tr>

										<td>
									<ou-button type='primary' @click='openPreviewPanel(order)'>View CV</ou-button>
								</td>

								<td>
									<span v-if="order.order.order_status == 'assigned' ">
										<ou-button type='primary' @click='uploadAttachment(order)' v-if="order.is_assigned">upload work</ou-button>
								</span>

								
										<ou-button type='primary' @click='requestOrder(order)' v-if="!order.is_requested"> Request </ou-button>

										<span v-if="status == 'new' ">
											
											<ou-message-bar icon='Completed' type='success' v-if="order.is_requested" >
											REQUESTED &nbsp; &nbsp; 
										</ou-message-bar>

										</span>

										<ou-button type='primary' @click='openWorkPreviewPanel(order)' v-if="status == 'completed' ">View Work</ou-button>

										
									</td>
								</tr>
										
									
									
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


  			<ou-panel title='Work Preview Panel' size='xl' v-model='workPreviewPanel'>
    			
    			

    			<p>this is the preview of the work submitted. if it does not appear refresh your browser</p>
    			<hr>

    			<iframe :src="workUrl" width="100%" height="600px"></iframe>
  			
  			</ou-panel>

          
            <!-- //end of preview view -->


            <!-- preview view -->


            <ou-panel title='Upload Work' size='md' v-model='uploadAttachmentPanel'>
    			
    			

    			<p>upload your finished work here and mark the order as completed </p>

    			<hr>

    			<label>Attachment</label>
    			<input type="file" name="work_file" ref="work_file" v-on:change="handleFileUpload()" required>


    			<ou-text-field type='multiline' v-model='work_comment' label='Comment' />

    			<ou-checkbox v-model='is_completed'>Mark as Completed</ou-checkbox>

    			<br>

    			<ou-button type='primary' @click="submitWork(selectedOrder.order.id)">Save</ou-button>
  			
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
				work_file: '',
				work_comment: '',
				is_completed: false,
				workUrl: '',
				workPreviewPanel: false
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

			openWorkPreviewPanel(order){

				this.selectedOrder = order

				this.workUrl = 'http://docs.google.com/gview?url='+this.selectedOrder.order.attachment+'&embedded=true'

				this.workPreviewPanel = true
			},

			requestOrder(order){

				let data = {
					'order_id': order.order.id
				}

				axios.post('/requests', data).then(response =>{
					this.getOrders('new');
				}).catch(error => {
					alert(error)
				})
			},


			uploadAttachment(order){
				this.selectedOrder = order

				this.uploadAttachmentPanel = true;
			},

			handleFileUpload(){

				this.work_file = this.$refs.work_file.files[0];

				console.log(this.work_file)
			},

			submitWork(id){
				

				let formData = new FormData()
				formData.append('work_file', this.work_file)
				formData.append('work_comment', this.work_comment)
				formData.append('order_id', id)

				console.log(formData)

				axios.post('/orders/work', formData, { headers: {'Content-Type': 'multipart/form-data' } }).then(response => {

					this.uploadAttachmentPanel = false

				}).catch(error =>{
					alert(error)
				})
			}
		}
	}
</script>