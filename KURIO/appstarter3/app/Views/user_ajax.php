<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD App Codigniter4  & Ajax</title>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
<link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
</head>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="firstname">First Name</label>
              <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lastname">Last Name</label>
              <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>

          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>

          <div class="my-2">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
          </div>

            <div class="my-2">
              <label for="text">Text</label>
              <input type="text" name="text" class="form-control" placeholder="Enter a Text" required>
            </div>

            <div class="my-2">
              <label for="profile">Profile</label>
              <input type="file" name="image" id="image" class="form-control"  required>
            </div>

         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Of Add Employee Modal -->



<!-- Edit Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="pid">
         <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="firstname">First Name</label>
              <input type="text" name="firstname" id="fname" class="form-control" placeholder="First Name" required>
              </div>
              <div class="col-lg">
              <label for="lastname">Last Name</label>
              <input type="text" name="lastname" id="lname" class="form-control" placeholder="Last Name" required>
              </div>
          </div>

          <div class="my-2">
              <label for="email">E-mail</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
              <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
            </div>
         
           <div class="my-2">
            <label for="text">Text</label>
            <input type="text" name="text" id="text" class="form-control" placeholder="Text" required>
          </div>

            <div class="my-2">
              <label for="profile">Profile</label>
              <input type="file" name="image" id="image" class="form-control"  required>
            </div>

 
            <div class="mt-2" id="avatar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-primary">Submit </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End of Edit Modal -->
<!-- Add Employee Body Content -->

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Employees</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Add New Employee</button>
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(function(){

      // add new employee ajax request
      $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
          url: '<?php echo site_url('/store'); ?>',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Employee Added Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#add_employee_btn").text('Add Employee');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
      });


      // edit employee ajax request
    $(document).on('click', '.editIcon', function(e){
        e.preventDefault();
          var id = $(this).attr('id');
          var firstname=$(this).attr('firstname');
          var lastname=$(this).attr('lastname');
          var email=$(this).attr('email');
          var phone=$(this).attr('phone');
          var text=$(this).attr('text');
          var image=$(this).attr('image');
         

            //TO Show the input fields on edit.

            $("#fname").val(firstname);
            $("#lname").val(lastname);
            $("#email").val(email);
            $("#phone").val(phone);
            $("#text").val(text);  
            $("#avatar").html(
             '<img src="<?php echo site_url("Public/Ajax_Uploads"); ?>/'+ image +'" width="70 px" height="70 px" class="img-fluid img-thumbnail">');
            

            $("#pid").val(id);
            $("#emp_avatar").val(image);

            
        // $.ajax({
        //   url: '<?= site_url("edit/") ?>/' + id,
        //   method: 'get',
        //   success: function(response){
        //     const b= JSON.parse(response);
        //     console.log(b);
        //     $("#pid").val(b.id);
        //      $("#fname").val(b.firstname);
        //     $('#fname').attr('placeholder','Enter a Firstname').val(b.firstname);
        //     $('#lname').attr('placeholder','Enter a Lastname').val(b.lastname);
        //     $('#email').attr('placeholder','Enter a Valid Email').val(b.email);
        //     $('#phone').attr('placeholder','Enter a Valid Phone').val(b.phone);
        //     $('#text').attr('placeholder','Enter a Valid Text').val(b.text);
           
         
        //   }
        // });


      });

      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Submitting...');
        $.ajax({
          url: '<?php echo site_url('/update');?>',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){

            if (response.status == 200){
              Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            // $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');


          }
        });
      });


     // delete employee ajax request
      $(document).on('click', '.deleteIcon', function(e){
        e.preventDefault();
        let id = $(this).attr('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed){
            $.ajax({
              url: '<?php echo site_url('/delete');?>/'+id,
              method: 'get',
              data: {
                id: id,
              },
              success: function(response) {
              console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your data has been deleted.',
                  'success'
                )
                fetchAllEmployees();
              }
            });
          }
        })
      });


      // fetch all employees ajax request
      fetchAllEmployees();

      function fetchAllEmployees(){
        $.ajax({
          url: '<?php echo site_url('/fetchall');?>',
          method: 'get',
          success: function(response) {
            $("#show_all_employees").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });

</script>
</body>
<!-- End of Body Content -->

</html>