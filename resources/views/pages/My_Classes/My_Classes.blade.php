@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('My_Classes_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            {{--/***************************--}}

      @include('sessions')


            <button type="button" class="btn btn-success x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('My_Classes_trans.add_class') }}
            </button>
                    <button type="button" class="btn btn-danger x-small"  id="btn_delete_all">
                        {{ trans('My_Classes_trans.delete_checkbox') }}
                    </button>
            <br><br>

            <form action="{{ route('filter_classes', 'test') }}" method="post">
                @csrf
                <select class="custom-select custom-select-lg mb-3"  name="Grade_id" required
                        onchange="this.form.submit()">
                    <option value="" selected disabled>{{trans('My_Classes_trans.Search_By_Grade')}}</option>
                   @foreach ($Grades as $Grade)
                    <option value="{{$Grade->id}}">{{ $Grade->Name }}</option>
                    @endforeach
                </select>
            </form>



{{--            destroy_all *******************--}}

            <div class="modal fade" id="delete_all" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ trans('Grades_trans.delete_Grade') }}                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
            <form action="{{ route('destroyall', 'test') }}" method="post">
                {{ method_field('Delete') }}
                @csrf
                {{ trans('Grades_trans.Warning_Grade') }}
                <input id="delete_all_id" type="hidden" name="delete_all_id"  class="text" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                    <button type="submit"
                            class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                </div>
            </form>
                        </div>


                    </div>

                </div>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input type="checkbox" style="float: left;" id="example-select-all" name="select_all" onclick="CheckAll('box1',this)"></th>
                            <th>#</th>
                            <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                            <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                            <th>{{ trans('My_Classes_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if(isset($details))
                        <?php $list_classes =$details;    ?>
                    @else
                            <?php $list_classes =$My_Classes;    ?>
                    @endif


                        <?php $i = 0; ?>
                        @foreach ($list_classes as $My_Class)
                            <tr>
{{--                                #علشان يعمل ترتيب من 1:^--}}
                                <?php $i++; ?>

                                <td>
                                        <input type="checkbox" style="float: left;" id="customCheck1" class="box1"  value="{{$My_Class->id}}">
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ $My_Class->Name_Class }}</td>
                                <td>{{ $My_Class->Grades->Name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('My_Classes_trans.edit_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class=" row mb-30" action="{{ route('Classrooms.update','test') }}" method="POST">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $My_Class->id }}">
                                                <div class="card-body">
                                                    <div class="repeater">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}:</label>
                                                            <input class="form-control" type="text" name="Name" value="{{ $My_Class->getTranslation('Name_Class', 'ar') }}"/>
                                                        </div>


                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                                :</label>
                                                            <input class="form-control" type="text" name="Name_class_en" value="{{ $My_Class->getTranslation('Name_Class', 'en')}}"/>
                                                        </div>


                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                                :</label>

                                                            <div class="box">
                                                                <select class="fancyselect" name="Grade_id">
                                                                    @foreach ($Grades as $Grade)
                                                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>


                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Grades_trans.delete_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Classrooms.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Grades_trans.Warning_Grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $My_Class->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('Classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
{{--                            #هنا هاعمل insert بدلالة ال List_Classes--}}
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}:</label>
                                            <input class="form-control" type="text" name="Name" />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name_class_en" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="Grade_id">
                                                    @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}:</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
</div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
{{--@toastr_js--}}
{{--@toastr_render--}}

@endsection
