<x-admin-layout>
    <div class="space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="card-title">Quản lý thể loại</h2>
                    <label for="add-category-modal" class="btn btn-primary">Thêm thể loại</label>
                </div>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên thể loại</th>
                                <th>Mô tả</th>
                                <th>Số truyện</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->novels_count }}</td>
                                <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <label for="edit-category-{{ $category->id }}" class="btn btn-sm btn-info">Sửa</label>
                                        <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc muốn xóa thể loại này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <input type="checkbox" id="add-category-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Thêm thể loại mới</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Tên thể loại</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" required />
                </div>
                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Mô tả</span>
                    </label>
                    <textarea name="description" class="textarea textarea-bordered" rows="3"></textarea>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <label for="add-category-modal" class="btn">Hủy</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modals -->
    @foreach($categories as $category)
    <input type="checkbox" id="edit-category-{{ $category->id }}" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Sửa thể loại</h3>
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Tên thể loại</span>
                    </label>
                    <input type="text" name="name" value="{{ $category->name }}" class="input input-bordered" required />
                </div>
                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Mô tả</span>
                    </label>
                    <textarea name="description" class="textarea textarea-bordered" rows="3">{{ $category->description }}</textarea>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <label for="edit-category-{{ $category->id }}" class="btn">Hủy</label>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</x-admin-layout> 