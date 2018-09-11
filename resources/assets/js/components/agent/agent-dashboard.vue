<template>
	<div>

		
		<div class="row">

			<div class="col-md-12">

				

				<div class="row">

					<div class="card stat-card col-md-3">
			
						<span class="stat-count">{{stats.new}}</span>
						<p class="stat-text">New Orders</p>
					</div>

			
					<div class="card stat-card col-md-3">
			
						<span class="stat-count">{{stats.assigned}}</span>
						<p class="stat-text">Assigned Orders</p>
					</div>

			
					<div class="card stat-card col-md-3">
			
						<span class="stat-count">{{stats.completed}}</span>
						<p class="stat-text">Completed Orders</p>
					</div>

			
					<div class="card stat-card col-md-2">
			
						<span class="stat-count">{{stats.closed}}</span>
						<p class="stat-text">Closed Orders</p>
					</div>

				</div>


				<agent-order></agent-order>

			
			</div>


		</div>

	</div>
</template>

<script type="text/javascript">
	

	export default {

		mounted(){

			this.getStats()
		},

		data(){

			return {

				stats: []
			}
		},


		methods: {

			getStats(){

				axios.get('/agentstats').then(response => {

					this.stats = response.data
				}).catch(error => {

					alert(error)
				})
			}
		}
	}
</script>

<style>

.stat-card {

	border-left: 10px solid #3399FF ;
	margin:10px;
	
}

.stat-count {

	color: #3399FF;
	font-size: 30px;
	font-weight: bold;
	text-align: center;
}


.stat-text {

	color: #3399FF;
	font-size: 20px;
	text-align: center;
}


</style>