
<template>
	<div class="container">
		<div class="row" v-if="editing" >
			<div class="col-lg-12">
				<h2 class="section-heading text-center">About</h2>
				<h2 class="section-subheading text-center ">Editing Page</h2>
				<div class="form-group">
					<label for="qoute">Quote:</label>
					<input 
					type="text" 
					name="qoute" 
					id="quote" 
					class="form-control"
					placeholder="Qoute"
					v-model="form.quote"
					>
				</div>
				<div class="form-group">
					<label for="title">Title:</label>
					<input 
					type="text" 
					name="title" 
					id="title" 
					class="form-control" 
					placeholder="title"
					v-model="form.title">
				</div>

				<div class="form-group">
					<label for="body">Content</label>
					<textarea 
					name="body" 
					id="body" 
					cols="30" 
					rows="10"
					class="form-control" 
					placeholder="Your content goes here"
					v-model="form.body" 
					>	
				</textarea>
			</div>
			<div class="form-group">
				<button 
				class="btn btn-primary" 
				@click.prevent="update">Save Content</button>
				<button class="btn btn-danger" @click.prevent="editing=false">Cancel Editing</button>
			</div>
		</div>
	</div>
	<div v-else>
		<div class="row" v-for="data in datas">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">About</h2>
				<h3 class="section-subheading text-muted">{{ data.quote }}</h3>
			</div>
		</div>

		<div class="row" v-for="data in datas">
			<div class="col-lg-4">
				<h1>{{ data.title }}</h1>
			</div>
			<div class="col-lg-8">
				<p>{{ data.body }}</p>
			</div>
		</div>
		<button class="btn btn-xs" @click.prevent="edit">Edit</button>
	</div>


</div>
</template>

<script>
import Form from '../utilities/Form';

export default {

	components: { Form }, 
	data() {
		return {

			datas: {},

			form: new Form({
				quote: '',
				title: '',
				body: '',
			}),

			editing: false,
		}
	},

	mounted(){
		this.fetch()
	}, 
	methods:{
		fetch(){
			return  axios.get('/about')
			.then(response => this.datas = response.data)
			.catch(errors => alert('errors on get'));
		},

		edit(){
			this.datas.forEach( function(element) {
				this.form.quote = element.quote;
				this.form.title = element.title;
				this.form.body = element.body;
				this.id = element.id;
			}.bind(this));
			this.editing = true;
		},

		update(){
			return this.form.patch('/about/'+ this.id)
			.then(response => this.onSuccess())
			.catch(response => alert('Errors'));
		},

		onSuccess() {
	 		// flash a message to the session
	 		this.fetch();
	 		this.editing = false;
	 	}, 

	 }


	}
	</script>

	<style>
	
	.btn-primary{
		background-color: #3e3e;
	}
	.btn-primary:hover{
		background-color: green;
	}
	</style>




