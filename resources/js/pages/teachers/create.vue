<template>
  <div>
  	<div id="main">
  		<h1>Add Teacher</h1>
		  <form @submit.prevent="submit">
		  	<div>
			    <label for="first_name">First name:</label>
			    <input id="first_name" v-model="form.first_name" />
	        <div v-if="errors.first_name">{{ errors.first_name }}</div>
		  	</div>
		  	<div>	  		
			    <label for="last_name">Last name:</label>
			    <input id="last_name" v-model="form.last_name" />
			    <div v-if="errors.last_name">{{ errors.last_name }}</div>
		  	</div>
		  	<div>	  		
			    <label for="school">School:</label>
			    <input id="school" v-model="form.school" />
			    <div v-if="errors.school">{{ errors.school }}</div>
		  	</div>
		  	<div>
		  		<label for="grades">Grades:</label>
	  			<div>
						<input type="checkbox" id="1st" value="1st" v-model="form.grades">
						<label for="1st">1st</label>

						<input type="checkbox" id="5th" value="5th" v-model="form.grades">
						<label for="5th">5th</label>
	  			</div>
	  			
	  			<div>
						<input type="checkbox" id="2nd" value="2nd" v-model="form.grades">
						<label for="2nd">2nd</label>

						<input type="checkbox" id="6th" value="6th" v-model="form.grades">
						<label for="6th">6th</label>
	  			</div>
	  			
	  			<div>
						<input type="checkbox" id="3rd" value="3rd" v-model="form.grades">
						<label for="3rd">3rd</label>

						<input type="checkbox" id="7th" value="7th" v-model="form.grades">
						<label for="7th">7th</label>
	  			</div>
	  			
	  			<div>
						<input type="checkbox" id="4th" value="4th" v-model="form.grades">
						<label for="4th">4th</label>

						<input type="checkbox" id="8th" value="8th" v-model="form.grades">
						<label for="8th">8th</label>
	  			</div>

					<div v-if="errors.grades">{{ errors.grades }}</div>
		  	</div>
		  	<div>
		  		<label for="grades">Subjects:</label>
	  			<div>
						<input type="checkbox" id="Math" value="Math" v-model="form.subjects">
						<label for="Math">Math</label>

						<input type="checkbox" id="History" value="History" v-model="form.subjects">
						<label for="History">History</label>
	  			</div>
	  			
	  			<div>
						<input type="checkbox" id="Science" value="Science" v-model="form.subjects">
						<label for="Science">Science</label>

						<input type="checkbox" id="English" value="English" v-model="form.subjects">
						<label for="English">English</label>
	  			</div>

					<div v-if="errors.subjects">{{ errors.subjects }}</div>
		  	</div>
		    <button type="submit">Submit</button>
		  </form>
  		<Link :href="teacher_index_url" method="get" as="button" type="button">Go Back</Link>
		</div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import { Inertia } from '@inertiajs/inertia'

export default {
	components: {
		'Link': Link,
		'Inertia': Inertia,
	},
	props: {
		errors: Object,
		teacher_index_url: {
			required: true,
			type: String
		},
		save_teacher_url: {
			required: true,
			type: String
		},
	},
  data() {
    return {
      form: {
        first_name: null,
        last_name: null,
        school: null,
        grades: [],
        subjects: [],
      },
    }
  },
  methods: {
    submit() {
	    Inertia.post(this.save_teacher_url, this.form)
    },
  },
};
</script>
