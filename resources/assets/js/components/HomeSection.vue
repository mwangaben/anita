<template>
	<div>
		<!-- Viewing -->
		<div v-if="!editing">
			<header class="masthead" v-for=" data in datas">
				<div class="container">
					<div class="intro-text">
						<div class="intro-lead-in">{{ data.introlead }}</div>
						<div class="intro-heading">{{ data.introhead }}</div>
						<a class="btn btn-xl js-scroll-trigger" href="#services">{{ data.infoButton }}</a>
						<button  v-if="isAdmin" @click.prevent="edit" class="btn btn btn-info" id="edit">Edit Me</button>
					</div>
				</div>
			</header>
		</div>

		<!-- Editing -->
		<div v-if="editing" class="container">
			<div>

				<form 
				id="contactForm" 
				name="sentMessage"
				@keydown="form.errors.clear($event.target.name)" 
				@submit.prevent="update">
				<div class="form-group">
					<label for="introlead">Intro Leading:</label>
					<input 
					type="text" 
					name="introlead" 
					id="introlead" 
					class="form-control"
					v-model="form.introlead">

					<p 
					class="help-block text-danger"
					v-if="form.errors.has('introlead')"
					v-text="form.errors.get('introlead')"></p>
				</div>

				<div class="form-group">
					<label for="introhead">Intro Heading</label>
					<input
					type="text" 
					name="introhead" 
					id="introhead" 
					class="form-control"
					v-model="form.introhead">


					<p 
					class="help-block text-danger"
					v-if="form.errors.has('introhead')"
					v-text="form.errors.get('introhead')"></p>
				</div>

				<div class="form-group">
					<label for="infoButton">Info Button:</label>
					<input 
					type="text" 
					name="infoButton" 
					id="infoButton" 
					class="form-control"
					v-model="form.infoButton">

					<p 
					class="help-block text-danger"
					v-if="form.errors.has('infoButton')"
					v-text="form.errors.get('infoButton')"></p>
				</div>

				<button id="update" class="btn btn-primary" @click="update">Save Changes</button>
				<button @click="editing = false" id="cancel" class="btn btn-info">Cancel</button>
			</form>
			</div>
		</div>
		
		
	</div>
</template>

<script>
import axios from 'axios';
import Form from '../utilities/Form';
export default {

	components : { Form },

	data() {
		return {
			editing : false,


			id : 1,
			datas : [{
				introlead : '',
				introhead : '',
				infoButton : ''
			}],

			form : new Form({
				introlead : '',
				introhead : '',
				infoButton : ''
			}),
		}
	},
	mounted(){
		this.fetch()
	}, 

	computed: {

		signedIn(){
			return window.App.signedIn;
		},

		isAdmin(){
			return this.admin();
			
		}
	},

	methods: {
		fetch(){
			return axios.get('/homesection')
			.then(response => this.datas = response.data)
			.catch(errors => this.dataIssue(errors));
		},

		edit() {
			this.editing = true;
				// console.log(this.datas.);
				this.datas.forEach( function(element) {
					this.form.introlead = element.introlead;
					this.form.introhead = element.introhead;
					this.form.infoButton = element.infoButton;
					// this.id = element.id;
				}.bind(this));
			},	

			update(){
				// console.log('Done')
				console.log(this.id);
				return this.form.patch('/homesection/'+ this.id)
				.then(response => this.onSucces(response))
				.catch(error => this.$emit('failed', error));
			},

			onSucces(data){
				this.fetch();
				this.$emit('updated');
				this.editing = false
			},


			dataIssue(data){
				// console.log(data);
				this.$emit('problemWithData')
			}
		}


	}
	</script>

	<style>
	.btn-nfo {
		background-color: blue;
	}
	header.masthead{
		margin-top: -1.4em;
	}
	.btn {
		text-shadow: .1em .1em black;
		font-style: italic;
		border-radius: 1em;
	}
	</style>

