<template>
  <div>
    <div v-if="flash_message" class="alert">
      {{ flash_message }}
    </div>
  	<div id="main">
  		<Link :href="create_teacher_url" method="get" as="button" type="button">Add Teacher</Link>
	  	<table>
	  		<thead>
	  			<tr>
	  				<th>ID</th>
	  				<th>Teacher</th>
	  				<th>School</th>
	  				<th>Grade(s)</th>
	  			</tr>
	  		</thead>
	  		<tbody>
			  	<tr v-for="teacher in teachers">
			  		<td>{{ teacher.id }}</td>
			  		<td>{{ teacher.full_name }}</td>
			  		<td>{{ teacher.school }}</td>		  		
			  		<td>{{ teacher.grades.join(', ') }}</td>	
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
	}
};
</script>
