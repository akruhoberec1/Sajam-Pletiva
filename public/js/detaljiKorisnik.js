
     $( '#uvjet' ).autocomplete({
        source: function(req,res){
           $.ajax({
               url: url + 'polaznik/trazi?term=' + req.term + 
                    '&grupa=' + grupa,
               success:function(odgovor){
                   res(JSON.parse(odgovor));
                //console.log(odgovor);
            }
           }); 
        },
        minLength: 2,
        select:function(dogadaj,ui){
            console.log(ui.item);
            spremi(ui.item);
        }
    }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
        return $( '<li>' )
          .append( '<div>' + item.ime + ' ' + item.prezime + '<div>')
          .appendTo( ul );
      };