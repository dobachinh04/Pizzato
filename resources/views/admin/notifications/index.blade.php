@extends('admin.layouts.master')

@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->time_ago }}</td>
                    <td>
                        @if ($notification->deleted_at)
                            <span class="text-danger">Đã xóa mềm</span>
                        @else
                            <span class="text-success">Hoạt động</span>
                        @endif
                    </td>
                    {{-- <td>
                        @if ($notification->deleted_at)
                            <!-- Xóa cứng -->
                            <form action="{{ route('admin.notifications.forceDelete', $notification->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa cứng thông báo này?')">Xóa cứng</button>
                            </form>
                        @else
                            <!-- Xóa mềm -->
                            <form action="{{ route('admin.notifications.softDelete', $notification->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Bạn có chắc muốn xóa mềm thông báo này?')">Xóa mềm</button>
                            </form>
                        @endif
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
