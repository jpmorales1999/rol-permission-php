    <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url ?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
    <script src="<?php echo base_url ?>assets/js/dataTables.min.js""></script>
    <script text="javascript">
        function disabledEnableButtonRemoveAll(isDisabled=true) {
          var delete_permission = document.getElementById('special_permission');
          var btremovePermmission = document.getElementById('removePermmission');
          if (isDisabled || document.getElementById('special_permission').textContent == ""){
            delete_permission.innerHTML = "Sin permisos adicionales al rol";
            btremovePermmission.classList.add("disabled");
          }else{
            btremovePermmission.classList.remove("disabled");
          }
        }

        function removePermissionAll(){
          var permission_selected = document.querySelectorAll('.select2-selection__choice__display');
          var special_permission = document.getElementById('special_permission').children;
          var remove_permission = [];
          var change_permissions = [];

          for (let z = 0; z < special_permission.length; z++) {
            remove_permission.push(special_permission[z].childNodes[0].data);
          }
          
          for (let i = 0; i < permission_selected.length; i++) {
              if (!remove_permission.includes(permission_selected[i].textContent)){
                change_permissions.push(permission_selected[i].textContent);
              }
          }
          disabledEnableButtonRemoveAll();
          $('.js-example-basic-multiple').val(change_permissions);
          $('.js-example-basic-multiple').trigger('change');
        }

        function removePermission(index, permission){
          var permission_selected = document.querySelectorAll('.select2-selection__choice__display');
          var delete_permission = document.getElementById('p-'+permission+'');
          var change_permissions = [];
          
          for (let i = 0; i < permission_selected.length; i++) {
            if (permission_selected[i].textContent != permission)
            change_permissions.push(permission_selected[i].textContent);
          }
          // console.log(permission);
          // console.log(change_permissions);
          disabledEnableButtonRemoveAll(change_permissions==[]);
          delete_permission.style.display = "none";
          $('.js-example-basic-multiple').val(change_permissions);
          $('.js-example-basic-multiple').trigger('change');
        }
            
        function refreshSpecialPermission(speccial_permission){
          var span = "";
          var permission_html = "Sin permisos adicionales al rol";
          if (speccial_permission){
            permission_html= speccial_permission.map(function(f, i){
              span = "<span class='btn btn-secondary btn-sm' style='margin: 3px;' id='p-"+f+"'>"+f+"<span onclick=\"removePermission('"+i+"', '"+f+"')\" style='color:red'>x</span></span>";
              return span;
            });
            disabledEnableButtonRemoveAll(false);
          }else{
            disabledEnableButtonRemoveAll();
          }
          
          $("#special_permission").html(permission_html);
        }

        function refreshPermission(permission, speccial_permission) {
          if (speccial_permission){
            permission.push(...speccial_permission);
            disabledEnableButtonRemoveAll(false);
          }else{
            disabledEnableButtonRemoveAll();
          }
          $('.js-example-basic-multiple').val(permission);
          $('.js-example-basic-multiple').trigger('change');
        }

        $(document).ready(function() {
            var mySelectPermissions = $('.js-example-basic-multiple');

            mySelectPermissions.select2();
            

            if($('.rols').length){
              var idr = $("#idr").val();
              var permission_user = $("#permision_user").val().split(", ");
              var mySelectRols = $('.rols');
              var idUser = $('#id')[0].attributes[3].nodeValue;
              var idRol = $("#idrol").val();

              let ids = {
                id_user: idUser,
                id_rol: idRol,
              };

              mySelectRols.select2();
              
              fetch(window.origin+'/rol-permission/request.php', {
                method: "POST",
                credentials: "include",
                body: JSON.stringify(ids),
                cache: "no-cache",
              })
              .then( function (response) {
                if (response.status !== 200) {
                  console.log('El estado de respuesta no fue de 200: ${response.status}');
                  return ;
                }
                response.json().then(function (data) {
                  var new_permission = data.new_permission ? data.new_permission.split(", ") : false;
                  var new_special_permission = data.new_special_permission ? data.new_special_permission.split(", ") : false;
                  // console.log(new_permission);
                  // console.log(new_special_permission);
                  refreshSpecialPermission(new_special_permission);
                  //refreshPermission(new_permission, new_special_permission)
                })
              });
              
              mySelectRols.on('select2:select', function (e) {
                idRol = e.params.data.id;
                let ids = {
                  id_user: idUser,
                  id_rol: idRol,
                };
                fetch(window.origin+'/rol-permission/request.php', {
                  method: "POST",
                  credentials: "include",
                  body: JSON.stringify(ids),
                  cache: "no-cache",
                })
                .then( function (response) {
                  if (response.status !== 200) {
                    console.log('El estado de respuesta no fue de 200: ${response.status}');
                    return ;
                  }
                  response.json().then(function (data) {
                    var new_permission = data.new_permission ? data.new_permission.split(", ") : false;
                    var new_special_permission = data.new_special_permission ? data.new_special_permission.split(", ") : false;
                    // console.log(new_permission);
                    // console.log(new_special_permission);
                    refreshSpecialPermission(new_special_permission);
                    console.log(permission_user);
                    if(idr==idRol){
                      refreshPermission(permission_user, new_special_permission);
                    }else{
                      refreshPermission(new_permission, new_special_permission);
                    }
                  })
                })
                .catch(function(error) {
                  console.log('Hubo un problema con la petición Fetch:' + error.message);
                });           
              });
            }
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>