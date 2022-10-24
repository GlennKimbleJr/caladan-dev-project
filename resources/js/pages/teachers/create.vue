<template>
  <div>
  	<div id="main">
		  <form @submit.prevent="submit" class="w-full max-w-lg">
	  		<h1 class="text-2xl font-bold border-b mb-6">Add Teacher</h1>

			  <div class="flex flex-wrap -mx-3 mb-6">
			    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
				    <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First name:</label>
				    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first_name" v-model="form.first_name" />
		        <div v-if="errors.first_name" class="text-red-400">{{ errors.first_name }}</div>
			  	</div>

			  	<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
				    <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last name:</label>
				    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" v-model="form.last_name" />
				    <div v-if="errors.last_name" class="text-red-400">{{ errors.last_name }}</div>
			  	</div>
			  </div>

		  	<div class="mb-6">
			    <label class="block text-gray-700 text-sm font-bold mb-2" for="school">School:</label>
			    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="school" v-model="form.school" />
			    <div v-if="errors.school" class="text-red-400">{{ errors.school }}</div>
		  	</div>

		  	<div class="mb-6">
		  		<label class="block text-gray-700 text-sm font-bold mb-2" for="grades">Grade(s):</label>

				  <div class="flex flex-wrap -mx-3 mb-6">
				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="1st" value="1st" v-model="form.grades">
							<label for="1st">1st</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="2nd" value="2nd" v-model="form.grades">
							<label for="2nd">2nd</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="3rd" value="3rd" v-model="form.grades">
							<label for="3rd">3rd</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="4th" value="4th" v-model="form.grades">
							<label for="4th">4th</label>
						</div>
	  			</div>

				  <div class="flex flex-wrap -mx-3 mb-6">
				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="5th" value="5th" v-model="form.grades">
							<label for="5th">5th</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="6th" value="6th" v-model="form.grades">
							<label for="6th">6th</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="7th" value="7th" v-model="form.grades">
							<label for="7th">7th</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="8th" value="8th" v-model="form.grades">
							<label for="8th">8th</label>
						</div>
	  			</div>

	  			<div v-if="errors.grades" class="-mt-4 text-red-400">{{ errors.grades }}</div>
		  	</div>

		  	<div class="mb-6">
		  		<label class="block text-gray-700 text-sm font-bold mb-2" for="grades">Subject(s):</label>

				  <div class="flex flex-wrap -mx-3 mb-6">
				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="Math" value="Math" v-model="form.subjects">
							<label for="Math">Math</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="History" value="History" v-model="form.subjects">
							<label for="History">History</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="Science" value="Science" v-model="form.subjects">
							<label for="Science">Science</label>
						</div>

				    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
							<input type="checkbox" id="English" value="English" v-model="form.subjects">
							<label for="English">English</label>
						</div>
					</div>

					<div v-if="errors.subjects" class="-mt-4 text-red-400">{{ errors.subjects }}</div>
		  	</div>

		  	<div class="mb-6">
		  		<label class="block text-gray-700 text-sm font-bold mb-2" for="grades">Profile Photo:</label>

			    <input type="file" @input="form.profile_photo = $event.target.files[0]" />
			    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
			      {{ form.progress.percentage }}%
			    </progress>

			    <div v-if="errors.profile_photo" class="text-red-400">{{ errors.profile_photo }}</div>
		  	</div>

			  <div class="flex flex-wrap -mx-3 mb-6">
			    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
				    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
				  </div>

			    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 text-right">
					  <Link :href="teacher_index_url" method="get" as="button" type="button" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded">Cancel</Link>
				  </div>
				</div>
		  </form>
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
        profile_photo: null,
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
