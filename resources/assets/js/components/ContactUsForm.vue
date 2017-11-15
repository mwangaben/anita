<template>	
	<div class="contact">
		<div v-if="signedIn" class="signedIn">
			<div class="col-md-12 signed">

				<div class="form-group">
					<textarea 
					v-model="form.message"
					name="message" 
					id="message" 
					cols="30" 
					rows="10" 
					class="form-control"
					placeholder="Your message Goes here"></textarea>

					<p 
					class="help-block text-danger"
					v-if="form.errors.has('message')"
					v-text="form.errors.get('message')"></p>
				</div>
			<button @click="onSubmited" id="loggedIn" class="btn btn-primary">Send</button>
			</div>
		</div> <!-- signedIn -->
		
		<div v-if="! signedIn" class="guest">	
			<form 
			id="contactForm" 
			name="sentMessage"
			@keydown="form.errors.clear($event.target.name)" 

			>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input 
						class="form-control" 
						v-model="form.name"
						id="name" 
						name="name"
						type="text" 
						placeholder="Your Name *"/> 

						<p 
						class="help-block text-danger"
						v-if="form.errors.has('name')"
						v-text="form.errors.get('name')"></p>
					</div>

					<div class="form-group">
						<input 
						v-model="form.email"
						class="form-control"
						id="email" 
						name="email" 
						placeholder="Your Email *" />

						<p 
						class="help-block text-danger"
						v-if="form.errors.has('email')"
						v-text="form.errors.get('email')"></p>
					</div>

					<div class="form-group">
						<input 
						v-model="form.phone"
						class="form-control" 
						id="phone"
						name="phone"
						placeholder="Your Phone *"/> 

						<p 
						class="help-block text-danger"
						v-if="form.errors.has('phone')"
						v-text="form.errors.get('phone')"></p>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
						<textarea 
						v-model="form.message"
						name="message" 
						id="message" 
						cols="30" 
						rows="10" 
						class="form-control"
						placeholder="Your message Goes here"></textarea>

						<p 
						class="help-block text-danger"
						v-if="form.errors.has('message')"
						v-text="form.errors.get('message')"></p>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-lg-12 text-center">
					<div v-if="response.length > 0"  v-text="response" id="success"></div>
					<button 
					:disabled="form.errors.any()"
					id="sendMessageButton"
					class="btn btn-xl"
					@click.prevent="onSubmit"
					type="submit">
					Send Message
				</button>
			</div>
		</div>
	</form>
</div> <!-- guest -->
</div> <!-- contact -->

<!-- If the user has signed no need to fill the gaps -->
</template>

<script>
import axios from 'axios';
import Form from '../utilities/Form';

export default {


	components: { Form },

	data() {
		return {
			form: new Form ({
				name: '',
				phone: '',
				email: '',
				message: '',
			}),
			response: '',

		}
	},

	computed : {
		signedIn(){
			return this.loggedIn
		}
	},

	methods: {
		onSubmit(){
			this.form.post('/messages')
			.then(response => {
				this.$emit('okay')
			})
			.catch(errors => {
				this.$emit('failed')
				console.log('failed');
			});
		},
		onSubmited(){

			axios.get('/about')
			.then(resp => {
				this.$emit('fetched')
			})
			.catch(error => console.log('Failed'));
			 // this.$emit('Okay')
			},

		  loggedIned(){
		  	 return this.loggedIn();
		  }	
		}
	}
	</script>