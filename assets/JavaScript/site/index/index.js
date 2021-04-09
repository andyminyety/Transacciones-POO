$(document).ready(function(){

   $(".btn-delete").on("click",function(){
    
    let id = $(this).data("id");

    if(confirm("Estás seguro que deseas eliminar esta transacción?")){
        
        if(id !== null && id !== undefined && id !== "" ){
            window.location.href = "Transacciones/Eliminar.php?id=" + id;            
        }        
    }
   
   });
   
});