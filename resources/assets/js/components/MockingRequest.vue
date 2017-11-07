<template>
	<div>
	<!-- View the question -->
		<div v-if="!editing">
			<h2 v-text="question.title"></h2>
			<p v-text="question.body"></p>
			<button @click="editing =true" class="edit">Edit</button>	
		</div>

   <!-- Editing the question -->
		<form v-else>
			<input name="title" type="text" v-model="form.title">
			<textarea name="body" id="body" v-model="form.body"></textarea>

			<button @click="cancel" class="cancel">Cancel</button>
			<button @click="update" class="update">Update</button>
		</form>
	</div>
</template>

<script>
// import axios from 'axios';
	export default {
    props: ['dataQuestion'],
         data() {
         	return {
         		editing : false,
         		form : {
         			title : this.dataQuestion.title,
         			body : this.dataQuestion.body,
         		},
         		question: this.dataQuestion,
         	}
         },

         methods: {
         	update() {
    		       this.question.title = this.form.title;
    		       this.question.body  = this.form.body;
         		
    		      axios.post('/questions/1',this.form)
    		        .then(response => {
    		        	console.log('DONE');
    		        })
    		        .catch(error => {
 						console.log(error);
    		        });
    		        
    		       this.editing = false;
         	},

         	cancel(){
         		this.editing = false;
         	}
         }
	}
</script>