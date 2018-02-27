 $('.niveaux').click(function(){
	var id_niveau = $(this).val();
	var id = this.id.split("_")[2];
	var id_groupe = $('#groupe_hidden_'+id).val();

	$('#id_groupe_'+id).empty();
	$.getJSON({
		url: 'gets/groupes.php',
		data: 'id='+id_niveau,
		type: 'GET',
		dataType: 'json',
		success: function(result){
			$('#id_groupe_'+id).append( "<option value='0'>---</option>");	

			$(result).each(function(i,val){
				
				if(id_groupe == val["id_groupe"]) 
					$('#id_groupe_'+id).append( "<option selected value='"+val["id_groupe"]+"'>"+val["Libelle_groupe"]+"</option>");
				else 
					$('#id_groupe_'+id).append( "<option value='"+val["id_groupe"]+"'>"+val["Libelle_groupe"]+"</option>");
				
			});
		}});
});