<link rel="stylesheet" href="{{ asset("vendor/laravel-powerbi-embed/css/styles.css") }}" />
<script src="{{ asset("vendor/laravel-powerbi-embed/js/powerbi.js") }}"></script>

<div id="powerBIReport{{ $reportId }}" class="powerBIReportContainer"></div>

<script>
	const powerBiClientModels = window['powerbi-client'].models;
	let powerBIEmbedConfiguration = {
		type: 'report',
		id: '{{ $reportId }}',
		embedUrl: '{{ $embedUrl }}',
		tokenType: powerBiClientModels.TokenType.Embed,
		accessToken: '{{ $embedToken }}'
	};
	let powerBIReportContainer = document.getElementById("powerBIReport{{ $reportId }}");
	let powerBIReport = powerbi.embed(powerBIReportContainer, powerBIEmbedConfiguration);
</script>
