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
                                        {{--<p class="mb-0">
                                            <a href="javascript:void(0)"
                                               data-url="{{ route('users.deleteUser', $user->user_id) }}"
                                               data-toggle="modal"
                                               data-backdrop="static" data-keyboard="false"
                                               data-target="#deleteUser"
                                               class=" delete-user">
                                                <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path
                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                                </svg>
                                            </a>
                                        </p>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            {{ $allUsers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .delete-icon {
            width: 16px;
            fill: red;
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
