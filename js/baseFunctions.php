<script>
	function papws_getJsonValue(jsonObject, title) {
		for (var prop in jsonObject) {
    		if (title == prop) {
        		return jsonObject[prop];
    		}
    	}
    	return "";
	}

	function pawps_formatAmount(amount) {
		return parseFloat(amount).toFixed(2);
	}

</script>