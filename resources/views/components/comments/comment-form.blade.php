@props(['route'])

<form action="{{ $route }}" method="POST" class="mb-6">
    @csrf
    <div class="form-control">
        <textarea class="textarea textarea-bordered h-24 w-full" name="content" placeholder="Nhập bình luận của bạn"></textarea>
    </div>
    <div class="form-control mt-4">
        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
    </div>
</form>
