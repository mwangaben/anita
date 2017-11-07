<template>
	<div>
		<ul class="list">
			<li></li>
		</ul>
	</div>
</template>

<script>
	export default {

		data(){
			return {
               data: ''
			}
		},

		methods: {
			fetchData(){
				return axios.get('/mocks')
				.then(response =>  this.data = response.data)
				.catch(error => response.data);
			}
		}

	}
</script>