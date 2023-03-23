@extends('layouts.default')
@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid py-lg-4 py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-right">
                    @if(!$errors)
                    <button type="button" class="btn btn-proceed" data-backdrop="static" data-keyboard="false"
                            data-toggle="modal" data-target="#newUser">
                        Add new user
                    </button>
                    @endif
                </div>
                <div class="col-sm-12 py-3 px-lg-3 px-0">
                    @if($errors)
                        <div class="row">
                            <div class="col-lg-1 col-3">
                                <svg class="db-error-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z"/></svg>
                            </div>
                            <div class="col-lg-11 col-9 pt-lg-2">
                                <p class="mb-0 db-error"><b>
                                       Database connection errors!</b> <br>You might need to run <b>migrations</b>,
                                    looks like your database does not exist.
                                </p>
                            </div>
                        </div>
                    @else
                        @if($allUsers->isEmpty())
                            <div class="row">
                                <div class="col-lg-1 col-3">
                                    <svg class="no-users" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L440.6 320H618.7c11.8 0 21.3-9.6 21.3-21.3C640 239.8 592.2 192 533.3 192H490.7c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 30.2-10.5 58-28 79.9l-25.2-19.7C408.1 267.7 416 246.8 416 224c0-53-43-96-96-96c-31.1 0-58.7 14.8-76.3 37.7l-40.6-31.8c13-14.2 20.9-33.1 20.9-53.9c0-44.2-35.8-80-80-80C116.3 0 91.9 14.1 77.5 35.5L38.8 5.1zM106.7 192C47.8 192 0 239.8 0 298.7C0 310.4 9.6 320 21.3 320H234.7c.2 0 .4 0 .7 0c-20.6-18.2-35.2-42.8-40.8-70.8L121.8 192H106.7zM261.3 352C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7H485.3c10.5 0 19.5-6 23.9-14.8L324.9 352H261.3zM512 160A80 80 0 1 0 512 0a80 80 0 1 0 0 160z"/></svg>
                                </div>
                                <div class="col-lg-11 col-9 pt-lg-1">
                                    <p class="mb-0"><b>
                                            No users found!</b> <br>Add a new user or run seeder to populate the table with 100 records.</p>
                                </div>
                            </div>
                        @else
                            <table class="table table-striped">
                                <tbody>
                                @foreach($allUsers as $user)
                                    <tr>
                                        <td>
                                            <p class="mb-0">{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</p>
                                        </td>
                                        <td><p class="mb-0">{{$user->email}}</p></td>
                                        <td>
                                            <p class="mb-0">
                                                <a href="javascript:void(0)"
                                                   data-url="{{ route('users.destroy', $user->user_id) }}"
                                                   data-toggle="modal"
                                                   data-backdrop="static" data-keyboard="false"
                                                   data-target="#deleteUser"
                                                   class=" delete-user">
                                                    <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 448 512">
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
                                <button type="button" class="btn create-loader px-4" disabled>
                                    <div class="spinner-border text-light" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                                &nbsp;&nbsp;
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
                        <p class="mb-0">Please confirm you would like to delete this user?</p>
                        <input type="hidden" id="isConfirmed" value="">
                    </div>
                    <div class="form-group text-right">

                        <button type="button" class="btn confirm-loader px-4" disabled>
                            <div class="spinner-border text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-gray notConfirmed">Cancel</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-proceed confirmed">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $( document ).ready(function() {

        $(".confirm-loader").hide();
        $(".create-loader").hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function (e) {
            e.preventDefault();
            $(".create-loader").show();

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
                        printSuccess(data.success);
                        $(".create-loader").hide();
                    } else {
                        printErrorMsg(data.error);
                        $(".create-loader").hide();
                    }
                }
            });

        });

        $(".create-exit").click(function () {
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

            $('.notConfirmed').click(function () {
                $('#isConfirmed').val(false);
                $('#deleteUser').modal('hide');
            });
            $('.confirmed').click(function () {
                $(".confirm-loader").show();
                $('#isConfirmed').val(true);
                $.ajax({
                    url: user_URL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        //alert(data.success);
                        $('#deleteUser').modal('hide');
                        $(".confirm-loader").hide();
                        rowOjb.parents("tr").remove();
                    }
                });
            });

        });
        });

    </script>
    <style>
        .delete-icon {
            width: 16px;
            fill: red;
        }
        .spinner-border {
            width: 1.5rem!important;
            height: 1.5rem!important;
        }
        .db-error-icon {
            width: 100%;
            fill: red;
        }
        .no-users{
            width:100%;
        }

        .db-error {
            color: red;
        }
        .confirm-loader:disabled,.create-loader:disabled {
            opacity: 1!important;
        }
        .pagination div a {
            background-color: gray !important;
            color: #fff;
        }

        p.leading-5 {
            color: #fff !important;
        }

        .cursor-default {
            background: #000 !important;
            color: #fff;
        }

        nav svg {
            width: 22px;
        }

        .btn-proceed,.confirm-loader,.create-loader {
            background: #000;
            color: #fff;
            border: 2px solid #000;
        }

        .btn-proceed:hover, btn-proceed:active {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            box-shadow: none !important;
        }

        .btn-gray {
            background: #fff;
            color: gray;
            border: 2px solid gray;
        }

        .btn-gray:hover, .btn-gray:active {
            background: gray;
            color: #fff;
            border: 2px solid gray;
            box-shadow: none !important;
        }

        .modal-header {
            border-bottom: 0px !important;
        }

        @media only screen and (max-width: 600px) {
            .table p {
                font-size: 13px;
            }
        }
    </style>
@endsection
