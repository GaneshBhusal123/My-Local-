
    <body class="sb-nav-fixed">   
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                                    <a class="nav-link" href="<?php echo site_url(
                                        "kurio/dashboard"
                                    ); ?>">
                                      <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                      Dashboard
                                     </a>
                                      <a class="nav-link" href="<?php echo site_url(
                                          "kurio/file"
                                      ); ?>">
                                       <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                      Files
                                      </a>
                                     <a class="nav-link" href="<?php echo site_url(
                                         "kurio/dropdown"
                                     ); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profile Page Add Address 
                            </a>          
                              </div>
                          </div>
                          <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                        </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                       
                            <div class="card-body">
                             
                      <div class="container-fluid px-4">
                        <h1 class="mt-4">Tablelist</h1>
                            <div class="card-body">
                                       <?php if (
                                           session()->getFlashdata("msg")
                                       ): ?>
                                         <div class="alert alert-success">
                                            <?= session()->getFlashdata(
                                                "msg"
                                            ) ?>
                                            </div>
                                        <?php endif; ?>          
                   <!-- Listed Records of the filelist -->                
                      <table  id="" >   
                     <button type="button" class="btn btn-danger" onclick="delete_record()" id="buttonDelete" >Delete All
                        </button><br> 
                         <button type="button" class="btn btn-danger" onclick="delete_selected()" id="delete_button" >Delete Checked Item
                        </button> 
                    <thead>
                        <tr>
                            <th>
                            <input type="checkbox" id="mastercheck"  value="<?php echo $user[ "id"]; ?>" />&nbsp;&nbsp;
                            </th>
                            <th>S.N &nbsp;&nbsp; </th>
                            <th>Image&nbsp;&nbsp;</th>
                            <th>Address&nbsp;&nbsp;</th>
                            <th>Country&nbsp;&nbsp;</th>
                            <th>State&nbsp;&nbsp;</th>
                            <th>City&nbsp;&nbsp;</th>
                            <th>pincode&nbsp;&nbsp;</th>
                            <th>Created_at&nbsp;&nbsp;</th>
                            <th>Actions</th>
                        </tr> 
                            <tbody> 

                              <?php if ($userslist):
                                  $i = 1; ?>
                                <?php foreach ($userslist as $user): ?>

                                <?php $img =
                                    site_url() .
                                    "Public/Single_Uploads/" .
                                    $user["image"]; ?>
                            <tr>
                                  <td>
                                    <input type="checkbox"  class="subCheckbox"   name="subCheckbox[]" value="<?php echo $user[ "id"]; ?>" />
                                    </td>
                                        <td> <?php echo $i; ?></td>
                                          <td>
                                          <img src='<?php echo $img; ?>'height="70px" width="70px"/>
                                           </td>

                                          <td><?php echo $user["address"]; ?></td>
                                        <td>
                                      <?php echo $user["Country_Name"]; ?>  
                                      </td>
                                      <td><?php echo $user[
                                          "State_Name"
                                      ]; ?></td>
                                          <td><?php echo $user[
                                              "City_Name"
                                          ]; ?>  
                                       </td>
                                      <td><?php echo $user["pincode"]; ?></td>
                                        <td>
                                           <?php
                                           $timestamp = new Datetime(
                                               $user["created_at"]
                                           );
                                           $date = $user["created_at"];
                                           echo date(
                                               "h:i:s A  d-m-Y",
                                               strtotime($date)
                                           );
                                           ?>
                                        </td>
                                        <td>
                                           <a href="<?php echo base_url(
                                               "kurio/edit_list/" . $user["id"]
                                           ); ?>" class="btn btn-primary ">Edit
                                           </a>
                                            <a href="<?php echo base_url(
                                                "kurio/delete_file/" .
                                                    $user["id"]
                                            ); ?>" class="btn btn-danger">Delete
                                            </a>
                                           
                                      </td>  
                                    </tr> 
                                    <?php $i++;endforeach; ?>
                                    <?php
                                   endif; ?>
                                      </tbody>       
                                  </table>
                               </form>     
                               <!-- End of Table Listing. -->
                                  <a href="<?php echo site_url(
                                     "kurio/dropdown"
                                 ); ?>" class="btn btn-light">Back to the Page
                                  </a>

                                  </div>
                              </div>
                            </div>
                          </thead>
                      </div>
                    </div>
                  </main>            
              </div>
          </div>   
      </body>
      <script
  src="https://code.jquery.com/jquery-3.7.1.js"
 ></script>
  <script>

 document.getElementById("mastercheck").onclick = function checkClickFunc(){
                    debugger;
                var  masterCheckbox =  document.getElementById('mastercheck');
                var  subCheckboxes = document.querySelectorAll('.subCheckbox');
                          if(masterCheckbox.checked ==true)
                                {
                                for(var i = 0; i < subCheckboxes.length; i++)
                                    {
                                      subCheckboxes[i].checked = true;

                                    }  
                                }
                            else{
                                  for(var i = 0; i < subCheckboxes.length; i++)
                                    {
                                      subCheckboxes[i].checked = false;
                                    }
                                }




                        }


                       

              function delete_record()
                      {
                        var  subCheckboxes = document.querySelectorAll('.subCheckbox');
                        var vals=[];
                        for(var i = 0; i < subCheckboxes.length; i++){
                            vals.push(subCheckboxes[i].value);
                          }
                                if(confirm('Are you want  to sure to  delete All User Record')){
                                  $.ajax({
                                      url: '<?php echo site_url('kurio/delete_selected'); ?>',
                                      dataType: 'json',
                                      type: 'POST',
                                      data: {"vals" : vals},
                                      success: function(res){  
                                            if(res==true)
                                              {
                                            location.reload(true);
                                              } 
                                     
                                            }
                                     });
                                  }
                             }

                         function delete_selected(){
                                var  subCheckboxes = document.getElementsByClassName("subCheckbox");
                                  var vals=[];
                                  for(var i = 0; i < subCheckboxes.length; i++)
                                          {
                                            if(subCheckboxes[i].checked==true){
                                               vals.push(subCheckboxes[i].value);
                                              }
                                          }

                                        if(confirm('Please Select Atleast One User')){        
                                          $.ajax({
                                          url: '<?php echo site_url('kurio/delete_checked'); ?>',
                                          dataType: 'json',
                                          type: 'POST',
                                          data: {"vals" : vals},
                                          success: function(res){  
                                            if(res==true)
                                              {
                                                location.reload(true);
                                              } 
                                          }
                                     });

                                  }   
                              }
                      //datatablesSimple Column Disable.
                         // $(document).ready(function (){
                         //    $('#datatablesSimple').dataTable({
                         //         "searching":true,
                         //          "paging":true,
                         //          "order": [[0,"asc"]],
                         //          "ordering": true,
                         //          "columnDefs": [ {
                         //          "targets": [0,1,2], 
                         //          "orderable": false
                         //            }];
                         //      });
                         //  });

       
                     
                </script>


  