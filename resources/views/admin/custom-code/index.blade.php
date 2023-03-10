
@extends('layouts.app', [
    'class' => 'Custom Code',
    'elementHead' => 'customization',
    'elementSub' => 'customCode',
])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Custom Code</h4>
            <p class="card-category">Find all Custom code files here</p>
          </div>
          <div class="card-body">
          <div class="col-12 text-right">
                  <a href="{{route('custom-code.create')}}" class="btn btn-sm btn-info" target="_blank" data-id="single">Add New code </a>
                  {{-- <a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="bulk">Add new schemes { Bulk } </a> --}}
                </div>
            <div class="table-responsive">
              <table class="table table-sort">
                <thead class="text-primary">
                  <th style="width:40px"> Sno.</th>
                  <th> Page Name</th>
                  <th> Type</th>
                  <th> location</th>
                  {{--<th> link (if any) </th>--}}
                  <th class="text-center" style="width:40px"> Actions </th>
                </thead>
                <tbody>
                 @if(!empty($pages))
                  @foreach($pages as $key=>$page)
                    <tr>
                      <td>{{++$key}}</td>
                      <td> <a rel="tooltip" class="btn-link" href="{{route('custom-code.edit',$page->id)}}">{{$page->page_name}}</</td>
                      <td> {{$page->type}}</td>
                      <td> {{$page->where}}</td>
                     {{-- <td> {{ !empty($form->form_link) ? $form->form_link : '-' }} </td> --}}
                      <td class="td-actions text-center">
                          <form action="{{route('custom-code.destroy',$page->id)}}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                              @method('delete')
                              @csrf
                              <button class="btn btn-danger btn-link"> <i class="material-icons">delete</i> </button>
                          </form>
                          </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              {{$pages->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
