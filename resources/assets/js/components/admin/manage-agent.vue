<template>
	
	<div>
		
		<div class="card">
                <div class="card-header">
                	
                	<ou-button type='primary' @click='createPanelAction'>Create Agent</ou-button>
                </div>

                <div class="card-body">






		

		<table class="table table-sm table-condensed table-hover">

			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Status</th>
				<th></th>
			</thead>

			<tbody>
				
				<tr v-for="agent in agents">
					<td>{{agent.name}}</td>
					<td>{{agent.email}}</td>
					<td>{{agent.is_active}}</td>
					<td>
						<ou-button type='small' @click='editPanelAction(agent)'>Edit </ou-button>

						<ou-button type='small' @click='remove(agent.id)' v-if="agent.is_active">Deactivate</ou-button>

						<ou-button type='small' @click='remove(agent.id)' v-if="!agent.is_active">Activate</ou-button>
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

			this.getAgents()
		},

		data(){

			return {

				agents: [],
				id: '',
				name: '',
				email: '',
				createPanel: false,
				errors:[],
				errorMsg: false,
				editPanel: false
				
			}
		},

		methods: {

			getAgents(){

				axios.get('/api/agents').then(response => {

					this.agents = response.data
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
						this.getAgents();
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
						this.getAgents();
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

				axios.delete('/api/agents/'+id).then(response => {

					if(response.data.status == 1){
						this.getAgents();
						
					} else {
						console.log(response.data)
						this.errors = response.data
						this.errorMsg = true

					}

				}).catch(error =>{

					alert('an error occured: '+error.response.status+' : '+error.response.statusText)

				})
			},

			reset(){

				this.id = '',
				this.name = '',
				this.email = ''
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