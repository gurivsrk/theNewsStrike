
@extends('layouts.app', [
    'class' => 'All FAQs',
    'elementHead' => 'faqs',
    'elementSub' => 'faqs',
])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">All FAQs</h4>
            <p class="card-category">Find all FAQs here</p>
          </div>
          <div class="card-body">
                <div class="col-12 text-right add-new-btn">
                  <a href="{{route('faqs.create')}}" class="btn btn-sm btn-info" data-id="single">Add New faq</a>
                </div>
            <div class="table-responsive">
                @can('admin')
                    <x-table-btn />
                @endcan

              <table class="table table-sort2">
                <thead >
                  <th class="pr-3 text-light" style="width:40px"> Sno.</th>
                  <th style="width:350px"> Question</th>
                  <th>Answer</th>
                  <th class="pr-3 text-light" style="width:100px"> Category </th>
                  <th class="pr-3 text-light" style="width:40px"> </th>
                </thead>
                <tbody>
                 @if(!empty($item))
                  @foreach($item as $key=>$faq)
                    <tr {{$faq->status?'':'statusFalse'}}>
                      <td>{{++$key}}</td>
                      <td> <a rel="tooltip" class="btn-link" href="{{route('faqs.edit',@$faq->id)}}">{{@$faq->question}}</a></td>
                      <td> {!! Str::limit(@$faq->answer, 100) !!}</td>
                      <td> {{@$faq->category->name}}</td>
                      <td class="td-actions text-center">
                        @can('admin')
                        <form action="{{route('faqs.destroy',$faq->id)}}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-link"> <i class="material-icons">delete</i> </button>
                        </form>
                        @endcan
                          </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
