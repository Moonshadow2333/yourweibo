<form method="post" action="{{route('statuses.store')}}">
    @include('shared._errors')
    {{csrf_field()}}
    <textarea class="form-control" cols="10" name="content" placeholder="聊聊新鲜事儿~" rows="3">
        {{old('content')}}
    </textarea>
    <div class="text-right">
        <button type="submit" class="btn btn-primary mt-3">
            发布
        </button>
    </div>
</form>
