 $('.affecter').click(function(){
	var id_eleve = this.id.split("_")[1];
	var id_groupe = $(this).parent().parent().find("#id_groupe_"+id_eleve).val();
	var id_niveau = $(this).parent().parent().find("#id_niveau_"+id_eleve).val();
	var id_groupe_eleve = $(this).parent().parent().find("#id_groupe_eleve_"+id_eleve).val();
	console.log( id_groupe_eleve );
	$.getJSON({
		url: 'sets/affecter.php',
		data: 'id_groupe_eleve='+id_groupe_eleve+'&id_eleve='+id_eleve+'&id_groupe='+id_groupe+'&id_niveau='+id_niveau,
		type: 'GET',
		dataType: 'json',
		success: function(result){

			$(result).each(function(i,val){
				
			});
		}});
});