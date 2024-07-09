
$(document).ready(function(){
    deleteVaxRec = function(id) {
         $.ajax({
           url: 'controllers/admin/softDelete.php',
           method: 'POST',
           data: {action: 'deleteVaxRec', id: id }, 
           success: function(response){
             if(response == 1){
               alert(`Record deleted successfully!`);
               document.getElementById(id).style.display = "none";
             } else if(response == 0){
               alert(`This field cannot be deleted. ${id}`);
             } else{
               alert(`Unexpected response ${response}`);
             }
           },
           error: function(jqXHR, textStatus, errorThrown) {
           alert(`Error: ${textStatus}, ${errorThrown}`);
           }
         })
       }

    deleteAptRec = function(id) {
         $.ajax({
           url: 'controllers/admin/softDelete.php',
           method: 'POST',
           data: {action: 'deleteAptRec', id: id},
           success:function(response){
             if(response == 1){
               alert(`Record deleted successfully!`);
               document.getElementById(id).style.display = "none";
             } else if(response == 0){
               alert(`This field cannot be deleted. ${id}`);
             }
           }
         })
     }

     deleteHw = function(id) {
        $.ajax({
          url: 'controllers/admin/softDelete.php',
          method: 'POST',
          data: {action: 'deleteHw', id: id},
          success:function(response){
            if(response == 1){
              alert(`Record deleted successfully!`);
              document.getElementById(id).style.display = "none";
            } else if(response == 0){
              alert(`This field cannot be deleted. ${id}`);
            }
          }
        })
    }

    deletePatient = function(id) {
        $.ajax({
          url: 'controllers/admin/softDelete.php',
          method: 'POST',
          data: {action: 'deletePatient', id: id},
          success:function(response){
            if(response == 1){
              alert(`Record deleted successfully!`);
              document.getElementById(id).style.display = "none";
            } else if(response == 0){
              alert(`This field cannot be deleted. ${id}`);
            }
          }
      })
    }
    unblockUser = function(id) {
      $.ajax({
        url: 'controllers/admin/unblockUser.php',
        method: 'POST',
        data: {id: id},
        success: function(response){
          if(response == 1){
            alert('User unblocked successfully!');
            document.getElementById(id).style.display = 'none';
          } else if(response == 0){
            alert(`this user cannot be deleted. ${id}`)
          } else {
            alert(`invalid response: ${response}`);
          }
        }
      })
    }
   })