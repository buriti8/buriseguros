<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center vertical-center">@lang('base_lang.detail')</th>
            <th class="text-center vertical-center">@lang('posts.image')</th>
            <th class="text-center vertical-center">@lang('posts.title')</th>
            <th class="text-center vertical-center">@lang('posts.created_at')</th>

            @permission(['edit_posts', 'all_posts'])
            <th class="text-center vertical-center">@lang('base_lang.status')</th>
            <th class="text-center vertical-center">@lang('base_lang.edit')</th>
            @endpermission

            @permission(['delete_posts', 'all_posts'])
            <th class="text-center vertical-center">@lang('base_lang.delete')</th>
            @endpermission
        </tr>
    </thead>
    @forelse($posts as $post)
    <tr>
        <td class="text-center">
            <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-default btn-xs"
                title="@lang('base_lang.detail')">
                <i class="fa fa-fw fa-file-alt icon_color"></i>
            </a>
        </td>
        <td class="text-center">
            <div class="img_small">
                <div class="container d-flex h-100">
                    <div class="row justify-content-center align-self-center">
                        <img alt="" @if ($post->image)
                        src="{{ route('post.image', $post->id) }}?{{rand(0, 1000)}}"
                        @else
                        src="{{ asset('img/logo.png') }}"
                        @endif>
                    </div>
                </div>
            </div>
        </td>
        <td>{{ $post->title ?? '' }}</td>
        <td>{{ getCurrentDate($post->created_at) ?? '' }}</td>

        @permission(['edit_posts', 'all_posts'])
        <td class="text-center">
            <form method="POST" action="{{url('/admin/posts/' . $post->id)}}">
                @method('put')
                @csrf
                <input type="hidden" name="status" value="{{$post->status ? 0 : 1}}" />
                <button type="button" class="btn btn-sm btn-primary btn-xs btn-status"
                    title="@lang('base_lang.status')">
                    {{$post->status ? __('base_lang.disabled') : __('base_lang.enabled')}}
                </button>
            </form>
        </td>
        <td class="text-center">
            <div class="section_edit">
                <a href="{{url('/admin/posts/' . $post->id . '/edit')}}" class="btn btn-sm  btn-default btn-xs"
                    title="@lang('base_lang.edit')"><i class="fa fa-fw fa-edit icon_color"></i></a>
            </div>
        </td>
        @endpermission

        @permission(['delete_posts', 'all_posts'])
        <td class="text-center">
            <form class="form-horizontal" role="form" method="POST" action="{{url('/admin/posts/' . $post->id)}}">
                @method('delete')
                @csrf
                <button type="button" class="btn btn-sm  btn-default btn-xs btn-delete"
                    title="@lang('base_lang.delete') {{$post->name}}">
                    <i class="fa fa-fw fa-times delete"></i>
                </button>
            </form>
        </td>
        @endpermission
    </tr>
    @empty
    <tr>
        <td colspan="10">
            <em>@lang('base_lang.no_records')</em>
        </td>
    </tr>
    @endforelse
</table>