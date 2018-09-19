<template>
	
	<div>
		
		<div class="card">
                <div class="card-header">
                	
                	<ou-button type='primary' @click='createPanelAction'>Create Client</ou-button>
                </div>

                <div class="card-body">






		

		<table class="table table-sm table-condensed table-hover">

			<thead>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th></th>
			</thead>

			<tbody>
				
				<tr v-for="client in clients">
					<td>{{client.f_name}} {{client.l_name}}</td>
					<td>{{client.phone}}</td>
					<td>{{client.email}}</td>
					<td>
						<ou-button type='small' @click='editPanelAction(client)'>Edit </ou-button>

						<ou-button type='small' @click='remove(client.id)' >Remove</ou-button>

						
					</td>
				</tr>
			</tbody>
			
		</table>



		<ou-panel title='Create Agent'  v-model='createPanel'>

			<ou-message-bar icon='Warning' type='severeWarning' v-if="errorMsg">
  
  				<ul>
  					<li v-for="(error, index) in errors">{{index}} : {{error}}</li>
  				</ul>
  
			</ou-message-bar>

			
    		
    		<ou-text-field v-model='name' label='Name' />

    		<ou-text-field v-model='email' label='Email' />



    		<hr>

    		<ou-button type='primary' @click='save()'>Save</ou-button>

  		</ou-panel>



  		<ou-panel title='Update Agent'  v-model='editPanel'>

			<ou-message-bar icon='Warning' type='severeWarning' v-if="errorMsg">
  
  				<ul>
  					<li v-for="(error, index) in errors">{{index}} : {{error}}</li>
  				</ul>
  
			</ou-message-bar>

			
    		
    		<ou-text-field v-model='name' label='Name' />

    		<ou-text-field v-model='email' label='Email' />

    		
    		

    		<hr>

    		<ou-button type='primary' @click='update()'>Update</ou-button>

  		</ou-panel>


	</div>

</div>

</div>
 

		


	</div>
</template>

<script type="text/javascript">
	
	export default {

		mounted(){

			this.getClients()
		},

		data(){

			return {

				clients: [],
				id: '',
				f_name: '',
				l_name: '',
				email: '',
				phone:'',
				createPanel: false,
				errors:[],
				errorMsg: false,
				editPanel: false
				
			}
		},

		methods: {

			getClients(){

				axios.get('/api/clients').then(response => {

					this.clients = response.data
				}).catch(error => {

					alert('an error occured: '+error.response.status+' : '+error.response.statusText)
				})
			},

			createPanelAction(){

				this.createPanel = true
			},

			editPanelAction(agent){
				this.name = agent.name,
				this.email = agent.email,
				this.id = agent.id
				

				this.editPanel = true
			},

			save(){

				let data = {

					name: this.name,
					email: this.email,
					
					
				}

				axios.post('/api/agents', data).then(response => {

					this.errorMsg = false
					if(response.data.status == 1){
						this.getClients();
						this.createPanel = false
					} else {
						console.log(response.data)
						this.errors = response.data.data
						this.errorMsg = true

					}
					
				}).catch(error =>{
					
					alert('an error occured: '+error.response.status+' : '+error.response.statusText)
					
				})
			},


			update(){

				let data = {
					
					name: this.name,
					email: this.email,
					
				}

				axios.put('/api/agents/'+this.id, data).then(response => {

					this.errorMsg = false
					if(response.data.status == 1){
						this.getClients();
						this.editPanel = false
						this.reset()
					} else {
						console.log(response.data)
						this.errors = response.data.data
						this.errorMsg = true
						this.reset()
					}
					
				}).catch(error =>{
					
					alert('an error occured: '+error.response.status+' : '+error.response.statusText)
					
				})

				
			},



			remove(id){

				axios.delete('/api/clients/'+id).then(response => {

					if(response.data.status == 1){
						this.getClients();
						
					} else {
						console.log(response.data)
						this.errors = response.data
						this.errorMsg = true

					}

				}).catch(error =>{

					alert('an error occured: '+error.response.status+' : '+error.response.statusText)

				})
			}

			


		}
	}
</script>

<style>

thead {
	background-color: gray;
	color: #fff;
}




</style>