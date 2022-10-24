<template>
  <div>
  	<div id="main">
			<div v-if="flash_message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
			  <span class="block sm:inline">{{ flash_message }}</span>
			  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
			    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" @click="closeFlashMessage()"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
			  </span>
			</div>

  		<Link :href="create_teacher_url" method="get" as="button" type="button" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 mb-4 rounded float-right">Add Teacher</Link>

	  	<table class="min-w-full text-center table-auto">
	  		<thead class="sticky top-0 border-b bg-slate-200">
	  			<tr>
	  				<th class="text-sm font-medium px-6 py-4">ID</th>
	  				<th class="text-sm font-medium px-6 py-4">Profile Photo</th>
	  				<th class="text-sm font-medium px-6 py-4">Teacher</th>
	  				<th class="text-sm font-medium px-6 py-4">School</th>
	  				<th class="text-sm font-medium px-6 py-4">Grade(s)</th>
	  				<th class="text-sm font-medium px-6 py-4">Subject(s)</th>
	  			</tr>
	  		</thead>
	  		<tbody>
			  	<tr v-for="teacher in teachers" class="hover:bg-slate-200">
			  		<td>{{ teacher.id }}</td>
			  		<td><img :src="teacher.profile_photo_path" class="max-w-[100px] mx-auto"></td>
			  		<td>{{ teacher.full_name }}</td>
			  		<td>{{ teacher.school }}</td>		  		
			  		<td>{{ teacher.grades.join(', ') }}</td>	
			  		<td>{{ teacher.subjects.join(', ') }}</td>	
			  	</tr>
				</tbody>
	  	</table>
	</div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import { usePage } from '@inertiajs/inertia-vue'

export default {
	components: {
		'Link': Link,
	},
	props: {
		create_teacher_url: {
			required: true,
			type: String
		},
		teachers: {
			required: true,
			type: Array
		},
		flash_message: {
			required: false,
			type: String
		},
	},
	methods: {
		closeFlashMessage() {
			this.flash_message = null
		}
	}
};
</script>
