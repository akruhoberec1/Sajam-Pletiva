$(function(){
    $('sifraModal').on('submit', function(e){
         e.preventDefault();
         $.ajax({
             url: "/korisnici/promjenaSifre",
             type: "POST",
             data: $("sifraModal").serialize(),
             success: function(data){
                 alert("Uspješno promijenjeno")
             }
         });
    }); 
 });