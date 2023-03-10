
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
                <x-search  hide="blogTable"  type="search" for="posts"/>
                <div class="col-12 text-right add-new-btn">
                  <a href="{{route('blog.create')}}" class="btn btn-sm btn-info" data-id="single">Add New Blog</a>
                </div>
                <div  class="table-responsive">
                    @can('admin')
                        <x-table-btn />
                    @endcan
                    <table class="table table-sort">
                    <thead >
                        <th class="pr-3 text-light" style="width:40px"> Sno.</th>
                        <th class="pr-3 text-light" style="width:200px"> Title</th>
                        <th class="pr-3 text-light" style="width:100px"> Category</th>
                        <th class="pr-3 text-light"> Tags</th>
                        <th class="pr-3 text-light"> Date</th>
                        <th class="pr-3 text-light" style="width:40px"> Views</th>
                        <th class="pr-3 text-light"> status</th>
                        <th class="pr-3 text-light" style="width:40px"> </th>
                    </thead>
                                @include('partials.table')

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
