@extends('layout.master')
@section('title')
    Employees
@endsection

@section('container')
<div class="container-fluid">
    <div class="row pl-lg-5 pr-lg-5">
        <div class="col-lg-12 mt-3">
            <h2>Employee List</h2>
        </div>
        @if(Session::has('msg'))
        <div class="alert alert-success col-lg-12 mt-3" role="alert">
            {{ Session::get('msg'); }}
        </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger col-lg-12 mt-3" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-12 mt-3">
            <button class="btn btn-success" id="add-new">+Add New</button>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="company-details">
                @if($employees->count() < 1)
                <div style="text-align: center;color:red;">No Record Found!</div>
                @else
                <table width="100%" cellspacing="0" class="items">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">
                                SL No.
                            </th>
                            <th width="12%">
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Company
                            </th>
                            <th  width="12%">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($employees as $key=>$employee)
                        <tr>
                            <td align="center">
                               {{ ++$key }}
                            </td>
                            <td>
                                {{ $employee->f_name.' '.$employee->l_name }}
                            </td>
                            <td>
                                {{ $employee->email }}
                            </td>
                            <td>
                                {{ $employee->phone_no }}
                            </td>
                            <td>
                                {{ $employee->company->name }}
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm mb-1" onclick="editEmployee({{ $employee->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm mb-1" onclick="removeEmployee({{ $employee->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{$employees->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!--modal add new -->
    <div class="modal fade" id="add-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{ route('employees.store') }}">
                @csrf
            <div class="modal-body">

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" required id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" required id="recipient-name">
                  </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="message-text">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Phone No.</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Select Company</label>
                    <select required name="company" id="cid" class="form-control">
                        <option value="" disabled selected>--Please Select--</option>
                        @foreach ($companies as $company)
                         <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add New</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- edit company modal -->
    <div class="modal fade" id="edit-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="update-emp" method="post" >
            <div class="modal-body">
              @csrf
              {{ method_field('PATCH') }}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" required id="fname">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" required id="lname">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Phone No.</label>
                    <input type="text" class="form-control" name="phone" id="contact">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Select Company</label>
                    <select required name="company" id="companyid" class="form-control">
                        <option value="" disabled selected>--Please Select--</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="id" id="eid" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Change</button>
            </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('css')
<style>
    .company-details{
        -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        padding: 20px;
        border-radius: 5px;
    }

    th{
        padding:10px 14px;
        border:solid 1px #eeefef;
        background-color: #e7eaec;
        color:rgb(58, 52, 52);
    }
    td{
        padding:8px 14px;
        border:solid 1px #fafafa;
        background-color: #ffffff;
        color:rgb(58, 52, 52);
    }


</style>
@endsection

@section('js')
 <script>
     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     $('#add-new').click(function(){
        $('#add-employee').modal('show');
     });

    //open edit modal
    function editEmployee(id){
        $('#edit-employee').modal('show');
        let eid = id;
        $.ajax({
            url : 'employees/'+id+'/edit',
            method : 'GET',
            success : function(e){
                var data = JSON.parse(e)
                $('#fname').val(data.f_name)
                $('#lname').val(data.l_name)
                $('#email').val(data.email)
                $('#contact').val(data.phone_no)
                $('#update-emp').attr('action','employees/'+id);
                $('#eid').val(id);
                $('#companyid').val(data.company_id);
            }
        });
    }

    function removeEmployee(id){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url : 'employees/'+id,
                    method : "DELETE",
                    success : function(e){
                        swal("Success! Your data has been deleted!", {
                            icon: "success",
                        });
                        location.reload();
                    },
                    error : function(e){
                        console.log(e);
                    }
                });

            }
            });
    }


</script>
@endsection
