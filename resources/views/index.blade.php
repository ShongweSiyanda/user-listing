@extends('layouts.default')
@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid py-lg-4 py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-proceed" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#newUser">
                        Add new user
                    </button>
                </div>
                <div class="col-sm-12 py-3 px-lg-3 px-0">
                    @if($allUsers->isEmpty())
                        <p class="mb-0">No users found!</p>
                    @else
                        <table class="table table-striped">
                            <tbody>
                            @foreach($allUsers as $user)
                                <tr>
                                    <td><p class="mb-0">{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</p></td>
                                    <td><p class="mb-0">{{$user->email}}</p></td>
                                    <td>
                                        <p class="mb-0">
                                            <a href="javascript:void(0)"
                                               data-url="{{ route('users.destroy', $user->user_id) }}"
                                               data-toggle="modal"
                                               data-backdrop="static" data-keyboard="false"
                                               data-target="#deleteUser"
                                               class=" delete-user">
                                                <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path
                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                                </svg>
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 pagination">
                            {{ $allUsers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- create modal -->
    <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form if="new_user">
                            {{ csrf_field() }}
                            <div class="alert status-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <div class="form-group">
                                <label for="first_name">Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                       placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Surname</label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       placeholder="Enter your surname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="email">Position</label>
                                <input type="text" class="form-control" name="position" id="position"
                                       placeholder="Enter your position">
                            </div>
                            <div class="form-group text-right">

                                <button type="button" class="btn btn-gray create-exit">Cancel</button>
                                &nbsp;&nbsp;
                                <button type="submit" class="btn btn-proceed btn-submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--confirm delete -->
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="alert status-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <p class="mb-0">Are you sure you want to delete this user?</p>
                        <input type="hidden" id="isConfirmed" value="">
                    </div>
                    <div class="form-group text-right">

                        <button type="button" class="btn btn-gray notConfirmed">Cancel</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-proceed confirmed">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function (e) {
            e.preventDefault();

            let first_name = $("#first_name").val();
            let last_name = $("#last_name").val();
            let email = $("#email").val();
            let position = $("#position").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('users.store') }}",
                data: {first_name: first_name, last_name: last_name, email: email, position: position},
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        //alert(data.success);
                        printSuccess(data.success)
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        $(".create-exit").click(function (){
            $('#newUser').modal('hide');
            location.reload();
        });

        function printErrorMsg(msg) {
            $(".status-msg").find("ul").html('');
            $(".status-msg").css('display', 'block');
            $(".status-msg p").css('display', 'none');
            $(".status-msg ul").css('display', 'block');
            $(".status-msg").addClass('alert-danger');
            $.each(msg, function (key, value) {
                $(".status-msg").find("ul").append('<li>' + value + '</li>');
            });

        }
        function resetForm() {
            $('#first_name').val('');
            $('#last_name').val('');
            $('#email').val('');
            $('#position').val('');
        }
        function printSuccess(msg) {
            $(".status-msg").css('display', 'block');
            $(".status-msg").removeClass('alert-danger').addClass('alert-success');
            $(".status-msg ul").css('display', 'none');
            $(".status-msg").append('<p class="alert-success">' + msg + '</p>');
            resetForm();
        }

        $(document).on('click', '.delete-user', function () {

            let user_URL = $(this).data('url');
            let rowOjb = $(this);

            $('.notConfirmed').click(function (){
                $('#isConfirmed').val(false);
                $('#deleteUser').modal('hide');
            });
            $('.confirmed').click(function (){
                $('#isConfirmed').val(true);
                $.ajax({
                    url: user_URL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        //alert(data.success);
                        $('#deleteUser').modal('hide');
                        rowOjb.parents("tr").remove();
                    }
                });
            });

        });

        </script>
    <style>
        .delete-icon {
            width: 16px;
            fill: red;
        }
        .pagination div a {
            background-color: gray !important;
            color: #fff;
        }
        p.leading-5{
            color:#fff!important;
        }
        .cursor-default {
            background: #000 !important;
            color: #fff;
        }
        nav svg{
            width:22px;
        }
        .btn-proceed{
            background: #000;
            color:#fff;
            border: 3px solid #000;
        }
        .btn-proceed:hover,btn-proceed:active{
            background: #fff;
            color:#000;
            border: 3px solid #000;
            box-shadow: none!important;
        }
        .btn-gray{
            background: gray;
            color:#fff;
            border: 3px solid gray;
        }
        .btn-gray:hover,.btn-gray:active{
            background: transparent;
            color:gray;
            border: 3px solid gray;
            box-shadow: none!important;
        }
        .modal-header {
            border-bottom: 0px!important;
        }

        @media only screen and (max-width: 600px) {
            .table p{
                font-size: 13px;
            }
        }
    </style>
@endsection
