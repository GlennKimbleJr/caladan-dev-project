<template>
  <div>
  	<div id="main">
  		<button>Add Teacher</button>
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
export default {
	props: {
		teachers: {
	      required: true,
	      type: Array
	    },
	},
};
</script>
