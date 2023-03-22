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
            </div>
        </div>
    </div>
    <style>
        .delete-icon {
            width: 16px;
            fill: red;
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
