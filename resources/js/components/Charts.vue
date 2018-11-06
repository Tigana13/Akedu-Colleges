<template>
	<div class="chart-container">
		 
	</div>
</template>

<script>
	export default {
		props: ['chart'],
		created() {
			console.log("created");
		}, 
		mounted() {
			//Add scripts
			let chartScript = document.createElement('script');
		    chartScript.innerHTML = this.chart.script.replace(/(<([^>]+)>)/ig,"");
		    document.head.appendChild(chartScript);
			console.log("Mounted");
		}
	}
</script>