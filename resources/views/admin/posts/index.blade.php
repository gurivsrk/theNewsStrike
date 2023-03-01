
@extends('layouts.app', [
    'class' => 'All Posts',
    'elementHead' => 'posts',
    'elementSub' => 'posts',
])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">All Blogs</h4>
            <p class="card-category">Find all blogs here</p>
          </div>
          <div class="card-body">
          <div class="col-12 text-right">
                  <a href="{{route('blog.create')}}" class="btn btn-sm btn-info" target="_blank" data-id="single">Add New Blog</a>
                  {{-- <a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="bulk">Add new schemes { Bulk } </a> --}}
                </div>
            <div class="table-responsive">
              <table class="table table-sort">
                <thead class="text-primary">
                  <th style="width:40px"> Sno.</th>
                  <th> Title</th>
                  <th style="width:100px"> Category</th>
                  <th> Tags</th>
                  <th> Date</th>
                  <th style="width:40px"> Views</th>
                  <th style="width:40px"> </th>
                </thead>
                <tbody>
                 @if(!empty($blogs))
                  @foreach($blogs as $key=>$blog)
                    <tr>
                      <td>{{++$key}}</td>
                      <td> <a rel="tooltip" class="btn-link" href="{{route('blog.edit',@$blog->id)}}">{{@$blog->title}}</</td>
                      <td> {{@$blog->categoryName->name}}</td>
                      <td> [] </td>
                      <td>{{@$blog->created_at}} </td>
                      <td> {{@$blog->views}} </td>
                     {{-- <td> {{ !empty($form->form_link) ? $form->form_link : '-' }} </td> --}}
                      <td class="td-actions text-center">
                          <form action="{{route('blog.destroy',$blog->id)}}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
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
              {{$blogs->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
