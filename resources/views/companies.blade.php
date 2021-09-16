@extends('layout.master')
@section('title')
    Companies
@endsection
@section('container')
<div class="container-fluid">
    <div class="row pl-lg-5 pr-lg-5">
        <div class="col-lg-12 mt-3">
            <h2>Company List</h2>
        </div>
        @if(Session::has('msg'))
        <div class="alert alert-success col-lg-12 mt-3" role="alert">
            {{ Session::get('msg') }}
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
            <button class="btn btn-info" id="add-new">+Add New</button>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="company-details">
                @if($companies->count() < 1)
                <div style="text-align: center;color:red;">No Record Found!</div>
                @else
                <table width="100%" cellspacing="0" class="items">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">
                                SL No.
                            </th>
                            <th width="10%">
                                Logo
                            </th>
                            <th width="25%">
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Website
                            </th>
                            <th  width="12%">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($companies as $key=>$company)
                        <tr>
                            <td align="center">
                               {{ ++$key }}
                            </td>
                            <td>
                                @if($company->logo != null)
                                    <img src=" {{ asset('public/storage/images/logos/'.$company->logo) }}" style="border-radius: 5px;" alt="" height="60" width="60">
                               @else
                                    <span style="color: red;">Not Upload</span>
                                @endif
                            </td>
                            <td>
                                {{ $company->name }}
                            </td>
                            <td>
                                {{ $company->email }}
                            </td>
                            <td>
                                {{ $company->website }}
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm mb-1" onclick="editCompany({{ $company->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm mb-1" onclick="removeCompany({{ $company->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{$companies->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!--modal add new -->
    <div class="modal fade" id="add-company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Company</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="{{route('companies.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="name" required id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="message-text">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Website</label>
                    <input type="text" class="form-control" name="website" id="message-text">
                </div>
                <div class="mb-2">
                    Upload Logo
                </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="logo" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Add New</button>
            </div>
            </form>
          </div>
        </div>
      </div>


      <!-- edit company modal -->
    <div class="modal fade" id="edit-company" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="update-company" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              @csrf
              {{ method_field('PATCH') }}
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="name" required id="name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Email</label>
                  <input type="email" class="form-control" required name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Website</label>
                    <input type="text" class="form-control" name="website" id="website">
                </div>
                <div class="mb-2">
                    Upload Logo
                </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="logo" id="file">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  <input type="hidden" name="id" id="cid" value="">
            </div>
                <div class="form-group ml-3">
                    <img src=" " style="border-radius: 5px;" alt="" height="160" width="160" id="clogo">
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
        $('#add-company').modal('show');
     });

    //custom input file
     $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //open edit modal
    function editCompany(id){
        $('#edit-company').modal('show');

        $.ajax({
            url : 'companies/'+id+'/edit',
            method : 'GET',
            success : function(e){
                var data = JSON.parse(e)
                $('#name').val(data.name)
                $('#email').val(data.email)
                $('#website').val(data.website)
                $('#update-company').attr('action','companies/'+id);
                $('#cid').val(id);
                $('#clogo').attr('src',"{{ asset('public/storage/images/logos/') }}"+'/'+data.logo)
            }
        });
    }

    function removeCompany(id){
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
                    url : 'companies/'+id,
                    method : "DELETE",
                    success : function(){
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
