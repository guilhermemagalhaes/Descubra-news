    var grafico1 = trends.embed.renderExploreWidget("TIMESERIES", {"comparisonItem":[{"keyword":"refugiados","geo":"","time":"today 12-m"}],"category":0,"property":""}, {"exploreQuery":"q=refugiados&date=today 12-m","guestPath":"https://trends.google.com.br:443/trends/embed/"});
    var grafico2 = trends.embed.renderExploreWidget("GEO_MAP", {"comparisonItem":[{"keyword":"refugiados","geo":"","time":"today 12-m"}],"category":0,"property":""}, {"exploreQuery":"q=refugiados&date=today 12-m","guestPath":"https://trends.google.com.br:443/trends/embed/"});

    $(document).ready(function() {        
    	$("#grafico1").html(grafico1);
    	$("#grafico2").html(grafico2);
    });


/*

    $('#pesquisa-topico').on('keypress', function(e){
    	if (e.keyCode == 13) {
    		e.preventDefault();
    		var valorPesquisa = $("#pesquisa-topico").val();

    		console.log(valorPesquisa)
    		grafico1 = trends.embed.renderExploreWidget("TIMESERIES", {"comparisonItem":[{"keyword":""+ valorPesquisa +"","geo":"","time":"today 12-m"}],"category":0,"property":""}, {"exploreQuery":"q=refugiads&date=today 12-m","guestPath":"https://trends.google.com.br:443/trends/embed/"});
    		grafico2 = trends.embed.renderExploreWidget("GEO_MAP", {"comparisonItem":[{"keyword":""+ valorPesquisa +"","geo":"","time":"today 12-m"}],"category":0,"property":""}, {"exploreQuery":"q=refugiados&date=today 12-m","guestPath":"https://trends.google.com.br:443/trends/embed/"});		    		
    		$("#grafico1").html(grafico1);
    		$("#grafico2").html(grafico2);
    	}
    });

    */