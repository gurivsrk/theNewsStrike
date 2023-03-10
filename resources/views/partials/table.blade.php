
    <tbody id="blogTable">
        @if(!empty($blogs))
            @foreach($blogs as $key=>$blog)
            <tr {{$blog->status?'':'statusFalse'}}>
                <td>{{++$key}}</td>
                <td> <a rel="tooltip" class="btn-link" href="{{route('blog.edit',@$blog->id)}}">{{@$blog->title}}</</td>
                <td>
                <div class="flex-with-wrap">
                    @if(getTags($blog->id,'category'))
                        @foreach (getTags($blog->id,'category') as $tag)
                            <span class="tags">{{$tag}}</span>
                        @endforeach
                    @else
                    -
                    @endif
                </div>
                </td>
                <td >
                <div class="flex-with-wrap">
                    @if(getTags($blog->id,'tag'))
                        @foreach (getTags($blog->id,'tag') as $tag)
                            <span class="tags">{{$tag}}</span>
                        @endforeach
                    @else
                    -
                    @endif
                </div>
            </td>
            <td>{{@$blog->created_at}} </td>
            <td> {{@$blog->views}} </td>
            <td class="text-center">
                <div class="form-switch">
                    <input class="form-check-input font-18 status-switch"  data-id="{{@$blog->id}}" data-type="Post" data-status="{{@$blog->status}}" type="checkbox" role="switch"  {{@$blog->status?'checked':''}}>
                </div>
            </td>
                <td class="td-actions text-center">
                <a href="{{url($blog->slug)}}" target="_blank" class="font-18 text-secondary-emphasis">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                @can('admin')
                <form action="{{route('blog.destroy',$blog->id)}}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
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
