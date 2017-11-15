
<template>
	<div class="container">
		<div class="row" v-if="editing" >
			<div class="col-lg-12">
				<h2 class="section-heading text-center">About</h2>
				<h2 class="section-subheading text-center ">Editing Page</h2>
				<form 
				id="contactForm" 
				name="sentMessage"
				@keydown="form.errors.clear($event.target.name)" 
				
				>
				<div class="form-group">
					<label for="qoute">Quote:</label>
					<input 
					type="text" 
					name="quote" 
					id="quote" 
					class="form-control"
					placeholder="Qoute"
					v-model="form.quote"
					>


					<p 
					class="help-block text-danger"
					v-if="form.errors.has('quote')"
					v-text="form.errors.get('quote')"></p>


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


					<p 
					class="help-block text-danger"
					v-if="form.errors.has('title')"
					v-text="form.errors.get('title')"></p>
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

				<p 
				class="help-block text-danger"
				v-if="form.errors.has('body')"
				v-text="form.errors.get('body')"></p>
			</div>
			<div class="form-group">
				<button 
				id="update" 
				class="btn btn-primary" 
				@click.prevent="update">Save Content</button>
				<button class="btn btn-info" @click.prevent="editing=false">Cancel Editing</button>
			</div>
		</form>
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
	<span v-if="isAdmin">
	<button  id="edit" class="btn btn-info btn-xs" @click.prevent="edit">Edit Me</button>
		
	</span>
</div>


</div>
</template>

<script>
import axios from 'axios';

import Form from '../utilities/Form';

export default {

	components: { Form }, 
	data() {
		return {

			datas: [{
				quote : '',
				title : '',
				body : ''
			}],
			

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

	computed: {

		signedIn(){
			return this.loggedIn;
		},

		isAdmin(){
			 return this.signedIn ? this.admin : false;
		}
	}
	, 
	methods:{
		fetch(){
			return  axios.get('/about')
			.then(response => this.datas = response.data)
			.catch(errors => alert('errors on get'));
		},

		edit(){
			this.editing = true;
			this.datas.forEach( function(element) {
				this.form.quote = element.quote;
				this.form.title = element.title;
				this.form.body = element.body;
				this.id = element.id;
			}.bind(this));
		},

		update(){

			this.form.patch('/about/'+ this.id)
			.then(response => {
				this.$emit('updated')
				this.fetch();
				this.editing = false;
			})
			.catch(errors => this.$emit('failed', errors));
		},

		onSuccess() {
			this.$emit('updated')
			console.log('A done')
			this.fetch();
			this.editing = false;
		} 

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

.btn {
	text-shadow: .1em .1em black;
	font-style: italic;
	border-radius: 1em;
}

.btn-nfo {
	background-color: blue;
}
</style>




